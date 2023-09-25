<?php
// Load style.css file
function enqueue_custom_styles() {
    wp_enqueue_style('theme-style', get_stylesheet_directory_uri() . '/style.css');
}

add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Crée emplacement menu principal
function register_custom_menu() {
    register_nav_menu('primary-menu', __('Primary Menu'));
}
add_action('after_setup_theme', 'register_custom_menu');

// Crée emplacement menu footer
function register_footer_menu() {
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('after_setup_theme', 'register_footer_menu');

// associe single_photo.php aux contenus 'photo'
function custom_single_template($single_template) {
    global $post;

    if ($post->post_type == 'photo') {
        // Utilisez le modèle single_photo.php pour les articles de type "photo".
        $single_template = dirname(__FILE__) . '/single_photo.php';
    }

    return $single_template;
}
add_filter('template_include', 'custom_single_template');


/* GESTION LOAD-MORE */

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), null, true);

    // Passer la variable ajaxurl au script JavaScript
    wp_localize_script('custom-scripts', 'load_more_params', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}

add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');


function load_more_posts() {
    $page = $_POST['page'];

    // Déclaration de la variable $query ici
    $args = array(
        'post_type' => 'photo',
        'order' => 'DESC',
        'orderby' => 'date',
        'posts_per_page' => 12,
        'offset' => ($page-1)*12,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

        get_template_part( 'template-parts/content/photo_block' );

        endwhile;
        wp_reset_postdata();
    endif;

    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');


/* GESTION FILTRES PHOTOS 

function filter_photos() {
    $categorie = $_POST['categorie'];
    $format = $_POST['format'];
    $order = $_POST['order'];
    $page = $_POST['page'];

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => 12,
        'paged' => $page, // Utilisez la pagination pour charger la page suivante
        'orderby' => 'date',
        'order' => ($order === 'asc') ? 'ASC' : 'DESC',
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'categorie',
                'field' => 'slug',
                'terms' => $categorie,
            ),
            array(
                'taxonomy' => 'format',
                'field' => 'slug',
                'terms' => $format,
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            // Générez le contenu HTML des photos ici
            // Utilisez les balises <figure> par exemple
            the_content();
            
        endwhile;
        wp_reset_postdata();
    endif;

    die();
}

add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');
*/