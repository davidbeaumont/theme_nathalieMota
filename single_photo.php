<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

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
    
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
        <header class="entry-header alignwide">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            <ul>
                <li>référence : <?php echo $reference; ?></li>
                <li>catégorie : <?php echo $categories; ?></li>
                <li>format : <?php echo $formats; ?></li>
                <li>type : <?php echo $type; ?></li>
                <li>année : <?php echo $annee; ?></li>
            </ul>
        </header><!-- .entry-header -->
    
        <div class="entry-content">
            <?php
            the_content();
    
            ?>
        </div><!-- .entry-content -->
    
    </article><!-- #post-<?php the_ID(); ?> -->
    
    <div class="contact_nav">
        <div class="entry-contact">
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
        // On définit les arguments pour définir ce que l'on souhaite récupérer
        $args = array(
            'post_type' => 'photo',
            'order' => 'ASC', // ASC ou DESC 
            'orderby' => 'date', // title, date, comment_count…
        );
        // On exécute la WP Query
        $my_query = new WP_Query( $args );

        // On lance la boucle !
        if( $my_query->have_posts() ) : while( $my_query->have_posts() ) : $my_query->the_post();
            
            // the_title();
            // the_content();
            // the_post_thumbnail('thumbnail');

        endwhile;
        endif;

        // On réinitialise à la requête principale (important)
        wp_reset_postdata();

        // On affiche les éléments de navigation
        $previous_post = get_previous_post();
        $next_post = get_next_post();

        if (!empty($previous_post)) :
            $previous_post_thumbnail = get_the_post_thumbnail($previous_post->ID, 'thumbnail');
        ?>
        <div class="nav__prev__next">
            <div class="site__navigation__prev">
            <div class="nav-thumbnail"><?php echo $previous_post_thumbnail; ?></div>
                <a class="lien-nav" href="<?php echo get_permalink($previous_post->ID); ?>">
                <img src="../../wp-content/themes/theme_nathalieMota/img/prev.png" alt="Article précédent"/>
                </a>
            </div>
        <?php endif; ?>

        <?php if (!empty($next_post)) :
            $next_post_thumbnail = get_the_post_thumbnail($next_post->ID, 'thumbnail');
        ?>
            <div class="site__navigation__next">
            <div class="nav-thumbnail"><?php echo $next_post_thumbnail; ?></div>
                <a class="lien-nav" href="<?php echo get_permalink($next_post->ID); ?>">
                <img src="../../wp-content/themes/theme_nathalieMota/img/next.png" alt="Article suivant"/>
                </a>
            </div>
        </div>
        <?php endif; ?>


        </div>
    </div>
    <div class="photos_apparentees">
    <h2>vous aimerez aussi</h2>

        <?php get_template_part('template-parts/content/photo_block');?>

</div>
<?php 

endwhile; // End of the loop.

get_footer();
