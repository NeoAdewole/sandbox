<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Sanddbox
 * @since 1.0.0
 */

// Variables


// Includes
include(get_theme_file_path('/includes/front/enqueue.php'));
include(get_theme_file_path('/includes/front/head.php'));
include(get_theme_file_path('/includes/setup.php'));
include(get_theme_file_path('/includes/class-tgm-plugin-activation.php'));
include(get_theme_file_path('/includes/register-plugins.php'));

// Hooks
add_action('wp_enqueue_scripts', 'u_enqueue');
add_action('wp_head', 'u_head', 5);
add_action('after_setup_theme', 'sandbox_setup_theme');
add_action('tgmpa_register', 'sandbox_register_plugins');

// Error logs wp_remote calls
if (!function_exists('debug_wp_remote_post_and_get_request')) :
  function debug_wp_remote_post_and_get_request($response, $context, $class, $r, $url)
  {
    error_log('------------------------------');
    error_log($url);
    error_log(json_encode($response));
    error_log($class);
    error_log($context);
    error_log(json_encode($r));
  }
  add_action('http_api_debug', 'debug_wp_remote_post_and_get_request', 10, 5);
endif;

// Convert hex values to rgb values
function hex2rgb($colour)
{
  if ($colour[0] == '#') {
    $colour = substr($colour, 1);
  }
  if (strlen($colour) == 6) {
    list($r, $g, $b) = array($colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5]);
  } elseif (strlen($colour) == 3) {
    list($r, $g, $b) = array($colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2]);
  } else {
    return false;
  }
  $r = hexdec($r);
  $g = hexdec($g);
  $b = hexdec($b);
  return array('red' => $r, 'green' => $g, 'blue' => $b);
}

/**
 * Enqueue the style.css file.
 * 
 * @since 1.0.0
 */
function sandbox_styles()
{
  wp_enqueue_style(
    'sandbox-style',
    get_stylesheet_uri(),
    array(),
    wp_get_theme()->get('Version')
  );
}
add_action('wp_enqueue_scripts', 'sandbox_styles');

// Custom ACF functions for block theme
/**
 * Add 'custom Settings' page to WP admin Settings menu
 */
if (function_exists('acf_add_options_page')) {
  acf_add_options_page(array(
    'parent_slug'   => 'options-general.php',
    'page_title'    => __('Custom Settings'),
    'menu_title'    => __('Custom Settings'),
    'menu_slug'     => 'custom-theme-settings',
    'capability'    => 'edit_posts',
    'redirect'      => false
  ));
  // acf_add_options_sub_page(array(
  //     'page_title'    => 'Theme Header Settings',
  //     'menu_title'    => 'Header',
  //     'parent_slug'   => 'theme-general-settings',
  // ));
  // acf_add_options_sub_page(array(
  //     'page_title'    => 'Theme Footer Settings',
  //     'menu_title'    => 'Footer',
  //     'parent_slug'   => 'theme-general-settings',
  // ));
}
