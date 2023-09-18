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
    <div class="photos_apparentees">
        <div class="photo_block">
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
                'posts_per_page' => 12,
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
        <input class="" type="submit" value="Charger plus"> 

    </div>
</article>
<?php get_footer(); ?>