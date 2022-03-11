<?php

namespace MyListing;

if ( ! defined('ABSPATH') ) {
	exit;
}

function is_debug_mode() {
	return defined('WP_DEBUG') && WP_DEBUG;
}

function is_dev_mode() {
	return defined('MYLISTING_DEV_MODE') && MYLISTING_DEV_MODE;
}

function is_running_tests() {
	return defined('MYLISTING_RUNNING_TESTS') && MYLISTING_RUNNING_TESTS;
}

// Load textdomain early to include strings that are localized before
// the 'after_setup_theme' is called.
load_theme_textdomain( 'moteur24', trailingslashit( get_template_directory() ) . 'languages' );

// Load classes.
require_once trailingslashit( get_template_directory() ) . 'includes/autoload.php';


add_filter( 'acf/settings/show_admin', '__return_true', 50 );


// Notify admin on new subscribers
add_action( 'woocommerce_created_customer', function( $id ) {
	wp_new_user_notification( $id, null, 'admin' );
} );

// Use listing cover image in share dialog instead of the logo
add_filter( 'mylisting\single\og:image', function() {
    return 'cover';
} );


// Modify Social Networks field (Add WhatsApp link)
add_filter( 'mylisting\links-list', function( $links ) {
    // Add new link
    $links['WhatsApp'] = [
        'name' => 'WhatsApp',
        'key' => 'WhatsApp',
        'icon' => 'fa fa-whatsapp',
        'color' => '#128c7e',
    ];
    
    // Remove a link
    unset( $links['Pinterest'] );
    unset( $links['DeviantArt'] );
    return $links;
} );