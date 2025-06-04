<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Theme Setup
function ekomart_setup() {
    add_theme_support('woocommerce');

    add_theme_support('title-tag');

    // Add support for post thumbnails
    add_theme_support('post-thumbnails');

    // Add support for custom logo
    add_theme_support('custom-logo');

    // Register nav menus
    register_nav_menus([
        'primary' => __('Primary Menu', 'ekomart-wp'),
        'footer'  => __('Footer Menu', 'ekomart-wp'),
    ]);

    // Add support for HTML5 markup
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
}
add_action('after_setup_theme', 'ekomart_setup');

// Enqueue Styles and Scripts
function ekomart_enqueue_scripts() {

    wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper.min.css', [], false, 'all');
    wp_enqueue_style('font-awesome-pro', get_template_directory_uri() . '/assets/css/font-awesome.min.css', [], false, 'all');
    wp_enqueue_style('metismenu', get_template_directory_uri() . '/assets/css/metismenu.min.css', [], false, 'all');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', [], false, 'all');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', [], false, 'all');

    // Main stylesheet
    wp_enqueue_style('main', get_stylesheet_uri());

    // JavaScript
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', ['jquery'], false, true);
    wp_enqueue_script('waypoint', get_template_directory_uri() . '/assets/js/waypoint.min.js', ['jquery'], false, true);
    wp_enqueue_script('counterup', get_template_directory_uri() . '/assets/js/counterup.min.js', ['jquery'], false, true);
    wp_enqueue_script('metismenu', get_template_directory_uri() . '/assets/js/metismenu.min.js', ['jquery'], false, true);
    wp_enqueue_script('swiper', get_template_directory_uri() . '/assets/js/swiper.min.js', ['jquery'], false, true);
    wp_enqueue_script('theasticky', get_template_directory_uri() . '/assets/js/theasticky.min.js', ['jquery'], false, true);
    wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js', ['jquery'], false, true);
}
add_action('wp_enqueue_scripts', 'ekomart_enqueue_scripts');

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10 );

add_action( 'init', function() {
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
});

