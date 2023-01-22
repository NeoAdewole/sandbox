<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sanddbox
 * @since 1.0.0
 */

// Error logs wp_remote calls
if( ! function_exists( 'debug_wp_remote_post_and_get_request' ) ) :
  function debug_wp_remote_post_and_get_request( $response, $context, $class, $r, $url ) {
    error_log( '------------------------------' );
    error_log( $url );
    error_log( json_encode( $response ) );
    error_log( $class );
    error_log( $context );
    error_log( json_encode( $r ) );
      }
    add_action( 'http_api_debug', 'debug_wp_remote_post_and_get_request', 10, 5 );
endif;

/**
 * Enqueue the style.css file.
 * 
 * @since 1.0.0
 */
function sandbox_styles() {
	wp_enqueue_style(
		'sandbox-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'sandbox_styles' );