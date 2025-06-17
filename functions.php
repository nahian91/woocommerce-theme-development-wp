<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Redux Famework
require_once get_template_directory() . '/inc/theme-options.php';

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

// Remove the Additional Information (Order Notes) field from the checkout
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

// add_action( 'wp_enqueue_scripts', 'remove_woocommerce_checkout_styles', 99 );

// function remove_woocommerce_checkout_styles() {
//     if (is_checkout()) {
//         // Common WooCommerce style handles
//         wp_dequeue_style( 'woocommerce-general' );
//         wp_dequeue_style( 'woocommerce-layout' );
//         wp_dequeue_style( 'woocommerce-smallscreen' );
//     }
// }

add_filter( 'woocommerce_checkout_fields', 'custom_move_email_before_first_name' );

function custom_move_email_before_first_name( $fields ) {

    // Save the email field temporarily
    $email = $fields['billing']['billing_email'];

    // Remove the original email field
    unset( $fields['billing']['billing_email'] );

    // Rebuild the billing fields array with email first
    $new_billing_fields = [];

    // Add email field first
    $new_billing_fields['billing_email'] = $email;

    // Add the rest of the fields
    foreach ( $fields['billing'] as $key => $field ) {
        $new_billing_fields[$key] = $field;
    }

    // Assign the modified billing fields back
    $fields['billing'] = $new_billing_fields;

    return $fields;
}

add_filter( 'woocommerce_checkout_cart_item_name', 'add_product_image_before_name', 10, 3 );

function add_product_image_before_name( $product_name, $cart_item, $cart_item_key ) {
    $product = $cart_item['data'];
    $thumbnail = $product->get_image( array( 40, 40 ) ); // Change size as needed

    // Return image before product name
    return '<span class="wc-checkout-product-thumb" style="margin-right:10px; vertical-align:middle;">' . $thumbnail . '</span>' . $product_name;
}

add_filter( 'woocommerce_checkout_fields', 'remove_all_checkout_placeholders' );

function remove_all_checkout_placeholders( $fields ) {
    foreach ( $fields as $fieldset_key => $fieldset ) {
        foreach ( $fieldset as $field_key => $field ) {
            if ( isset( $fields[$fieldset_key][$field_key]['placeholder'] ) ) {
                $fields[$fieldset_key][$field_key]['placeholder'] = '';
            }
        }
    }
    return $fields;
}


add_action( 'init', function() {
    if ( ! is_admin() && isset( $_GET['generate_demo_reviews'] ) ) {
        // Example: Add demo reviews to all published products
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );
        $products = get_posts( $args );

        foreach ( $products as $product ) {
            // Check if the product already has reviews
            $comments = get_comments( array(
                'post_id' => $product->ID,
                'type'    => 'review',
                'count'   => true,
            ) );

            if ( $comments === 0 ) {
                // Insert a demo comment
                $comment_id = wp_insert_comment( array(
                    'comment_post_ID'      => $product->ID,
                    'comment_author'       => 'Demo User',
                    'comment_author_email' => 'demo@example.com',
                    'comment_content'      => 'This is a demo review for this product.',
                    'comment_approved'     => 1,
                    'comment_type'         => 'review',
                    'user_id'              => 0,
                    'comment_date'         => current_time( 'mysql' ),
                ) );

                if ( $comment_id ) {
                    // Add a random rating (1-5)
                    add_comment_meta( $comment_id, 'rating', rand( 3, 5 ) );
                    add_comment_meta( $comment_id, 'verified', 1 );
                }
            }
        }

        echo '✅ Demo reviews added!';
        exit;
    }
} );
