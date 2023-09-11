<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<?php
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
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__( 'Page', 'theme_nathalieMota' ) . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__( 'Page %', 'theme_nathalieMota' ),
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer default-max-width">
	</footer><!-- .entry-footer -->

	<?php if ( ! is_singular( 'attachment' ) ) : ?>
		<?php get_template_part( 'template-parts/post/author-bio' ); ?>
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
