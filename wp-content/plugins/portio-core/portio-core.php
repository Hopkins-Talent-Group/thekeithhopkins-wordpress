<?php
/*
Plugin Name: Portio Core
Plugin URI: http://themeforest.net/user/wpoceans
Description: Plugin to contain shortcodes and custom post types of the portio theme.
Author: wpoceans
Author URI: http://themeforest.net/user/wpoceans/portfolio
Version: 1.0
Text Domain: portio-core
*/

if( ! function_exists( 'portio_block_direct_access' ) ) {
	function portio_block_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Forbidden' );
		}
	}
}

// Plugin URL
define( 'GRAFCO_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

// Plugin PATH
define( 'GRAFCO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'GRAFCO_PLUGIN_ASTS', GRAFCO_PLUGIN_URL . 'assets' );
define( 'GRAFCO_PLUGIN_IMGS', GRAFCO_PLUGIN_ASTS . '/images' );
define( 'GRAFCO_PLUGIN_INC', GRAFCO_PLUGIN_PATH . 'include' );

// DIRECTORY SEPARATOR
define ( 'DS' , DIRECTORY_SEPARATOR );

// Portio Elementor Shortcode Path
define( 'GRAFCO_EM_SHORTCODE_BASE_PATH', GRAFCO_PLUGIN_PATH . 'elementor/' );
define( 'GRAFCO_EM_SHORTCODE_PATH', GRAFCO_EM_SHORTCODE_BASE_PATH . 'widgets/' );

/**
 * Check if Codestar Framework is Active or Not!
 */
function portio_framework_active() {
  return ( defined( 'CS_VERSION' ) ) ? true : false;
}

/* GRAFCO_THEME_NAME_PLUGIN */
define('GRAFCO_THEME_NAME_PLUGIN', 'Portio' );

// Initial File
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('portio-core/portio-core.php')) {

	// Custom Post Type
  require_once( GRAFCO_PLUGIN_INC . '/custom-post-type.php' );

  if ( is_plugin_active('kingcomposer/kingcomposer.php') ) {

    define( 'GRAFCO_KC_SHORTCODE_BASE_PATH', GRAFCO_PLUGIN_PATH . 'kc/' );
    define( 'GRAFCO_KC_SHORTCODE_PATH', GRAFCO_KC_SHORTCODE_BASE_PATH . 'shortcodes/' );
    // Shortcodes
    require_once( GRAFCO_KC_SHORTCODE_BASE_PATH . '/kc-setup.php' );
    require_once( GRAFCO_KC_SHORTCODE_BASE_PATH . '/library.php' );
  }

  // Theme Custom Shortcode
  require_once( GRAFCO_PLUGIN_INC . '/custom-shortcodes/theme-shortcodes.php' );
  require_once( GRAFCO_PLUGIN_INC . '/custom-shortcodes/custom-shortcodes.php' );

  // Importer
  require_once( GRAFCO_PLUGIN_INC . '/demo/importer.php' );


  if (class_exists('WP_Widget') && is_plugin_active('codestar-framework/cs-framework.php') ) {
    // Widgets

    require_once( GRAFCO_PLUGIN_INC . '/widgets/nav-widget.php' );
    require_once( GRAFCO_PLUGIN_INC . '/widgets/recent-posts.php' );
    require_once( GRAFCO_PLUGIN_INC . '/widgets/recent-case.php' );
    require_once( GRAFCO_PLUGIN_INC . '/widgets/text-widget.php' );
    require_once( GRAFCO_PLUGIN_INC . '/widgets/widget-extra-fields.php' );

    // Elementor
    if(file_exists( GRAFCO_EM_SHORTCODE_BASE_PATH . '/em-setup.php' ) ){
      require_once( GRAFCO_EM_SHORTCODE_BASE_PATH . '/em-setup.php' );
      require_once( GRAFCO_EM_SHORTCODE_BASE_PATH . 'lib/fields/icons.php' );
      require_once( GRAFCO_EM_SHORTCODE_BASE_PATH . 'lib/icons-manager/icons-manager.php' );
    }
  }

  add_action('wp_enqueue_scripts', 'portio_plugin_enqueue_scripts');
  function portio_plugin_enqueue_scripts() {
    wp_enqueue_script('plugin-scripts', GRAFCO_PLUGIN_ASTS.'/plugin-scripts.js', array('jquery'), '', true);
  }

}

// Extra functions
require_once( GRAFCO_PLUGIN_INC . '/theme-functions.php' );