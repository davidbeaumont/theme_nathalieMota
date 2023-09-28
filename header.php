<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Nathalie Mota - Photographe event</title>
        <!--<link rel="stylesheet" id="theme-style-css" href="/Nathalie_Mota/wp-content/themes/theme_nathalieMota/style.css" type="text/css" media="all"> -->
        <!-- ajout de la référence à la bibliothèque jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/lightbox.js" type="module" defer></script>
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
            <div class="menu">  
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
            ));
            ?>
            </div>
        </div>
    </header>
    <?php wp_body_open(); ?>