<?php
get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

// On récupère les champs ACF nécessaires
$reference=get_field('reference');
$type=get_field('type');
$annee=get_field('annee');

// On récupère les taxonomies nécessaires
$categories = get_the_term_list(get_the_ID(), 'categorie', '', ', ');
$formats = get_the_term_list(get_the_ID(), 'format', '', ', ');
?> 
<article class="single_photo" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
        the_content();
        ?>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
    
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
        // Obtenez l'ID du post actuel
        $current_post_id = get_the_ID();

        // Obtenez le post précédent
        $previous_post = get_adjacent_post(false, '', true);

        // Obtenez le post suivant
        $next_post = get_adjacent_post(false, '', false);

        // Affiche la miniature du post précédent s'il existe
        if ($previous_post) {
            ?>
            <div class="post-thumbnail">
                <a href="<?php echo get_permalink($previous_post); ?>" class="thumbnail-link">
                    <div class="hover-image">
                    <?php echo get_the_post_thumbnail($previous_post, 'thumbnail'); ?>
                    </div>
                    <img src="../../wp-content/themes/theme_nathalieMota/img/prev.png" alt="Article précédent" class="arrow"/>
                </a>
            </div>

            <?php
        }

        // Affiche la miniature du post suivant s'il existe
        if ($next_post) {
            ?>
            <div class="post-thumbnail">
                <a href="<?php echo get_permalink($next_post); ?>" class="thumbnail-link">
                    <div class="hover-image">
                    <?php echo get_the_post_thumbnail($next_post, 'thumbnail'); ?>
                    </div>
                    <img src="../../wp-content/themes/theme_nathalieMota/img/next.png" alt="Article suivant" class="arrow"/>
                </a>
            </div>
            <?php
        } ?>

    </div>
</div>
<div class="section_photos">
<h3>vous aimerez aussi</h2>
    <div class="photos_list">
        <?php 
        // Récupérer la catégorie de la photo actuellement affichée
        $current_category = implode(', ', wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names')));
            
        // Obtenez l'ID du post actuel
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

endwhile; // End of the loop.

get_footer();
