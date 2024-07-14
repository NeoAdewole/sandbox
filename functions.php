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
define('SANDBOX__DIR', get_template_directory());
define('SANDBOX__BLOCK_DIR', get_template_directory() . '/build/blocks/');


// Includes
include(get_theme_file_path('/includes/front/enqueue.php'));
include(get_theme_file_path('/includes/front/head.php'));
include(get_theme_file_path('/includes/setup.php'));
include(get_theme_file_path('/includes/register-plugins.php'));
include(get_theme_file_path('/includes/register-blocks.php'));
include(get_theme_file_path('/includes/class-tgm-plugin-activation.php'));

// Hooks
add_action('wp_enqueue_scripts', 'sandbox_enqueue');
add_action('wp_head', 'sandbox_head', 5);
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

function get_cat_id_by_slug($slugs = [])
{
  foreach ($slugs as $slug) {
    $category = get_category_by_slug($slug);
    $cat_ids[] = (int) $category->term_id;
  }
  return $cat_ids;
}


// Get first image from post when featured image is missing
/**
 * 
 */
// function sandbox_get_image_src($object, $field_name, $request)
function sandbox_get_image_src($query)
{
  // Slugs to exclude in query
  $slugs = array("publication", "newsletter");
  // $excludeids = get_cat_id_by_slug($slugs);
  if ($query->is_main_query() && $query->is_archive()) {
    // $query->set( 'category__not_in', $excludeids );
    print_r($query);
  }
  // return;
  // if ($query['featured_media'] == 0) {
  //   return $query['featured_media'];
  // }
  // $feat_img_array = wp_get_attachment_image_src($query['featured_media'], 'thumbnail', true);
  // return $feat_img_array[0];
}
// add_action('pre_get_posts', 'sandbox_get_image_src');

// function wporg_debug()
// {
//   echo '<p>' . current_action() . '</p>';
// }
// add_action('all', 'wporg_debug');


function sandbox_set_default_thumbnail($post)
{
  if ($post->post_type != 'post') {
    return;
  }

  $cover_id = get_template_directory_uri() . '/assets/sandbox.png';
  print_r($post);
  print_r($cover_id);

  // if (!has_post_thumbnail($post->ID)) {
  //   $thumbnail_url = $cover_id;
  //   $thumbnail_id = attachment_url_to_postid($thumbnail_url);

  //   set_post_thumbnail($post->ID, $thumbnail_id);
  // }
}
// add_action('rest_after_insert', 'sandbox_set_default_thumbnail', 10, 3);


function add_fallback_thumbnails_to_post($hooked_block_types, $relative_position, $anchor_block_type, $context)
{
  // post-featured-image
  if ('before' === $relative_position && 'core/post-title' === $anchor_block_type && 'single' === $context->slug) {
    $hooked_block_types[] = 'clearblocks/social-summary';
  }
  return $hooked_block_types;
}
add_filter('hooked_block_types', 'add_fallback_thumbnails_to_post', 10, 4);


function handle_archive_displays($query)
{
  if (is_main_query() && is_archive()) {
    echo '<br/>';
    print_r("You are on an archive!");
    echo '<br/>';
  }
}
// add_filter('archive_template', 'handle_archive_displays');
