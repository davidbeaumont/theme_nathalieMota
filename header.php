<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Nathalie Mota - Photographe event</title>
        <!-- ajout de la référence à la bibliothèque jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>
    <header class="header">
        <div class="navbar">
            <div class="logo">
                <a href="<?php echo home_url( '/' ); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo">
                </a>
            </div>
            <nav class="primary-menu">  
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
            ));
            ?>
            </nav>
            <div id="icons" class="burger">
                <span></span>
            </div>
            <div id="nav" class="mobile-menu">  
            <?php
            wp_nav_menu(array(
                'theme_location' => 'mobile-menu',
            ));
            ?>
            </div>
        </div>
    </header>
    <?php wp_body_open(); ?>