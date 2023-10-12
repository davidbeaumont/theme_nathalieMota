<?php
get_header();

// On récupère les champs ACF nécessaires
$reference=get_field('reference');
$type=get_field('type');
$annee=get_field('annee');

// On récupère les taxonomies nécessaires
$catTerms = wp_get_post_terms(get_the_ID(), 'categorie');
$categories = array();
foreach ($catTerms as $catTerm) {
    $categories[] = $catTerm->name;
}
$categories = implode(', ', $categories);

$formTerms = wp_get_post_terms(get_the_ID(), 'format');
$formats = array();
foreach ($formTerms as $formTerm) {
    $formats[] = $formTerm->name;
}
$formats = implode(', ', $formats);

?> 
<div class="article-wrapper">
    <div class="single_photo" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header-photo alignwide">
            <?php the_title( '<h1 class="entry-title-photo">', '</h1>' ); ?>
            <ul>
                <li>référence : <?php echo $reference; ?></li>
                <li>catégorie : <?php echo $categories; ?></li>
                <li>format : <?php echo $formats; ?></li>
                <li>type : <?php echo $type; ?></li>
                <li>année : <?php echo $annee; ?></li>
            </ul>
        </header><!-- .entry-header -->
        <div class="entry-content-photo">
        <?php
        $image_url = get_field('image');

        // Vérifiez si l'URL de l'image existe
        if ($image_url) {
            echo '<div class="wrapper-photo-single"><img class="photo-single" src="' . esc_url($image_url) . '" alt="Image de l\'article"></div>';
        } else {
            echo 'Aucune image n\'a été associée à cet article.';
        }
        ?>
        </div><!-- .entry-content -->
    </div><!-- #post-<?php the_ID(); ?> -->    
    <div class="contact_nav">
        <div class="entry-contact-photo">
            <p>Cette photo vous intéresse ?</p>
            <input class="myBtn" type="submit" value="Contact">
                <script>
                    $(document).ready(function(){
                        $(".refPhoto").val("<?php echo $reference; ?>");
                    });
                </script>
            </input>
        </div>
        <div class="site__navigation">
            <?php
            // Récupère l'ID du post actuel
            $current_post_id = get_the_ID();
            // Récupère le post précédent
            $previous_post = get_adjacent_post(false, '', true);
            // Récupère le post suivant
            $next_post = get_adjacent_post(false, '', false);  
            ?>           
            <div class="post-thumbnail">
                <div id="hover-image">
                    <div class="prev-thumbnail">
                        <?php echo get_the_post_thumbnail($previous_post, 'thumbnail'); ?>
                    </div>
                    <div class="next-thumbnail">
                        <?php echo get_the_post_thumbnail($next_post, 'thumbnail'); ?>
                    </div>
                </div>
            </div>
            <div class="thumbnail-link">
            <?php
            // Affiche la miniature du post précédent s'il existe
            if ($previous_post) {
                ?>
                <div class="prev-nav">
                    <a href="<?php echo get_permalink($previous_post); ?>">
                    <img src="../../wp-content/themes/theme_nathalieMota/img/prev.png" alt="Article précédent" class="arrow"/>
                    </a>
                </div>
                <?php
            }
            // Affiche la miniature du post suivant s'il existe
            if ($next_post) {
                ?>
                <div class="next-nav">
                    <a href="<?php echo get_permalink($next_post); ?>">
                    <img src="../../wp-content/themes/theme_nathalieMota/img/next.png" alt="Article suivant" class="arrow"/>
                    </a>
                </div>
                <?php
            } 
            ?>
            </div>
        </div>
    </div>
</div>
<div class="section_photos">
<h3>vous aimerez aussi</h2>
    <div class="photos_list">
        <?php 
        // Récupére la catégorie de la photo actuellement affichée
        $current_category = implode(', ', wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names')));
            
        // Récupère l'ID du post actuel
        $current_post_id = get_the_ID();
        
         // On définit les arguments pour définir ce que l'on souhaite récupérer
        $args = array(
            'post_type' => 'photo',
            'orderby' => 'rand', 
            'categorie' => $current_category,
            'posts_per_page' => 2,
            'post__not_in' => array($current_post_id), // Exclure le post actuel de la liste
        );
        
        // On exécute la WP Query
        $my_query = new WP_Query( $args );

        // On lance la boucle !
        if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
            
            get_template_part( 'template-parts/content/photo_block' );

        endwhile;
        endif;

        // On réinitialise à la requête principale (important)
        wp_reset_postdata();
        ?>
    </div>
    <div class="add_photos_list"></div>
    <input
        id="all-photos-button" 
        type="submit"
        onclick="window.location.href ='../../index.php/#all-photos';"
        value="Toutes les photos"
    />
</div>
<?php 

get_footer();
