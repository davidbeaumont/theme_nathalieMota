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
</article>
<?php get_footer(); ?>