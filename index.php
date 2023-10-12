<?php get_header(); ?>

<header>
    <div class="hero-header-random">
        <?php
            // On définit les arguments pour définir ce que l'on souhaite récupérer
            $args = array(
                'post_type' => 'photo',
                'posts_per_page' => 1,
                'taxonomy' => 'format',
                'format' => 'paysage',
                'orderby' => 'rand',
            );
            // On exécute la WP Query
            $my_query = new WP_Query( $args );

            // On lance la boucle !
            if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
            
            // Récupérez l'URL de l'image à partir du champ personnalisé ACF
            $image_url = get_field('photo');

            // Vérifiez si l'URL de l'image existe
            if ($image_url) {
                echo '<figure><img src="' . esc_url($image_url) . '" alt="Image de l\'article"></figure>';
            } else {
                echo 'Aucune image n\'a été associée à cet article.';
            }
            
            endwhile;
            endif;

            // On réinitialise à la requête principale (important)
            wp_reset_postdata();
        ?>
        <div class="titre-header">
        <!--<h1>Photographe event</h1> -->
        <img src="<?php echo get_template_directory_uri() . '/img/titreHeader.png'; ?>" alt="Photographe event">
        </div>
    </div>

</header>
<article>
    <div id="all-photos" class="section_photos">

        <?php get_template_part( 'template-parts/content/selectors' )?>
        
        <div class="list-wrapper">
            <div class="photos_list">
                <?php 

                // On définit les arguments pour définir ce que l'on souhaite récupérer
                $args = array(
                    'post_type' => 'photo',
                    'order' => 'DESC', // ASC ou DESC 
                    'orderby' => 'date', // title, date, comment_count…
                    'posts_per_page' => 12,
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
            <input id="load-more-button" type="submit" value="Charger plus">
        </div>
    </div>
</article>
<?php get_footer(); ?>