<?php
/*
 * Portio Theme's Functions
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Define - Folder Paths
 */

define( 'PORTIO_THEMEROOT_URI', get_template_directory_uri() );
define( 'PORTIO_CSS', PORTIO_THEMEROOT_URI . '/assets/css' );
define( 'PORTIO_IMAGES', PORTIO_THEMEROOT_URI . '/assets/images' );
define( 'PORTIO_SCRIPTS', PORTIO_THEMEROOT_URI . '/assets/js' );
define( 'PORTIO_FRAMEWORK', get_template_directory() . '/includes' );
define( 'PORTIO_LAYOUT', get_template_directory() . '/theme-layouts' );
define( 'PORTIO_CS_IMAGES', PORTIO_THEMEROOT_URI . '/includes/theme-options/framework-extend/images' );
define( 'PORTIO_CS_FRAMEWORK', get_template_directory() . '/includes/theme-options/framework-extend' ); // Called in Icons field *.json
define( 'PORTIO_ADMIN_PATH', get_template_directory() . '/includes/theme-options/cs-framework' ); // Called in Icons field *.json

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$portio_theme_child = wp_get_theme();
	$portio_get_parent = $portio_theme_child->Template;
	$portio_theme = wp_get_theme($portio_get_parent);
} else { // Parent Theme Active
	$portio_theme = wp_get_theme();
}
define('PORTIO_NAME', $portio_theme->get( 'Name' ));
define('PORTIO_VERSION', $portio_theme->get( 'Version' ));
define('PORTIO_BRAND_URL', $portio_theme->get( 'AuthorURI' ));
define('PORTIO_BRAND_NAME', $portio_theme->get( 'Author' ));

/**
 * All Main Files Include
 */
require_once( PORTIO_FRAMEWORK . '/init.php' );

/**
 * thumbnail size
 */
add_image_size( 'portio-post-image-one', 415, 450, true );