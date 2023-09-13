<div class="photo_block">
<?php 
 // Récupérer la catégorie de la photo actuellement affichée
 $current_category = implode(', ', wp_get_post_terms(get_the_ID(), 'categorie', array('fields' => 'names')));
        
// On définit les arguments pour définir ce que l'on souhaite récupérer
$args = array(
    'post_type' => 'photo',
    'order' => 'ASC', // ASC ou DESC 
    'orderby' => 'date', // title, date, comment_count…
    'categorie' => $current_category,
    'posts_per_page' => 2
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
<input class="" type="submit" value="Toutes les photos">