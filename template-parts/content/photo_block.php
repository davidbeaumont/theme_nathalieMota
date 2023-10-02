<?php
// On récupère les champs ACF nécessaires
$reference=get_field('reference');
$type=get_field('type');
$image_url = get_field('photo');
// On récupère les taxonomies nécessaires
$terms = wp_get_post_terms(get_the_ID(), 'categorie');
$categories = array();
foreach ($terms as $term) {
    $categories[] = $term->name;
}
$categories = implode(', ', $categories);
?> 
<div class="photo_block">
    <div class="photo-thumbnail">
        <?php echo '<img src="' . esc_url($image_url) . '" alt="Image de l\'article">'; ?>
        <div class="image-ref">
            Ref : <?php echo $reference ?> 
        </div>
        <div class="image-cat">
            Catégorie : <?php echo $categories ?>
        </div>
        <div class="calque-photo">
            <div id="container-fullscreen">
                <a href="#myLightbox">
                    <img class="icon-fullscreen"
                    src="<?php echo get_template_directory_uri() . './img/Icon_fullscreen.png'; ?>"
                    alt="Icône Fullscreen">
                </a>
            </div>
            <div id="container-eye">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <img src="<?php echo get_template_directory_uri() . './img/eye.png'; ?>"
                    alt="Icône oeil">
                </a>
            </div>
        </div>
    </div>
</div>

