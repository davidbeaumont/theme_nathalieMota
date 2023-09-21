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
            
            the_content();

        endwhile;
        endif;

        // On réinitialise à la requête principale (important)
        wp_reset_postdata();
    ?>
    </div>
    <div class="titre-header">
        <!--<h1>Photographe event</h1> -->
    </div>
</header>
<article>
    <div id="all-photos" class="section_photos">

        <?php get_template_part( 'template-parts/content/selectors' )?>
        
        <div class="photos_list">
            <?php 
            // Récupérer la catégorie de la photo actuellement affichée
            $current_category = implode(', ', wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names')));
                
            // Obtenez l'ID du post actuel
            $current_post_id = get_the_ID();
            
            // On définit les arguments pour définir ce que l'on souhaite récupérer
            $args = array(
                'post_type' => 'photo',
                'order' => 'DESC', // ASC ou DESC 
                'orderby' => 'date', // title, date, comment_count…
                'posts_per_page' => 8,
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
        <input id="load-more-button" type="submit" value="Charger plus">
    </div>
</article>
<?php get_footer(); ?>