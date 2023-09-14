<?php wp_footer(); ?>
<div class="footer-bar">
    <div class="menu-footer">
        <?php
        wp_nav_menu(array(
            'theme_location' => 'footer-menu',
        ));
        ?>
    </div>
</div>

<!-- appel de la modale de contact -->
<?php get_template_part( 'template-parts/content/modale_contact' ); ?>

</body>
</html>