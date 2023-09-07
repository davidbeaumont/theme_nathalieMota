<?php
// Load style.css file
function enqueue_custom_styles() {
    // Enqueue le fichier style.css du thème
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_script( 'scripts', get_stylesheet_directory_uri() . '/js/scripts.js', array(), 1.1, true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

// Crée emplacement menu principal
function register_custom_menu() {
    register_nav_menu('primary-menu', __('Primary Menu'));
}
add_action('after_setup_theme', 'register_custom_menu');

// Crée emplacement menu footer
function register_footer_menu() {
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('after_setup_theme', 'register_footer_menu');

