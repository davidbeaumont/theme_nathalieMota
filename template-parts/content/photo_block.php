<div class="photo_block">
    <div class="photo-thumbnail" 
        data-reference="<?php echo esc_attr(get_post_meta(get_the_ID(), 'reference', true)); ?>" 
        data-categorie="<?php echo esc_attr(get_post_meta(get_the_ID(), 'categorie', true)); ?>">
        <?php the_post_thumbnail(); ?>
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

