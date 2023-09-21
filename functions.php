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
        'order' => $selected_order,
        'orderby' => 'date',
        'posts_per_page' => 8,
        'offset' => ($page-1)*8,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

        the_content();

        endwhile;
        wp_reset_postdata();
    endif;

    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

