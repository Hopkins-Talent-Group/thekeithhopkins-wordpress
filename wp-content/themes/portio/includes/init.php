<?php
/*
 * All Portio Theme Related Functions Files are Linked here
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/* Theme All Portio Setup */
require_once( PORTIO_FRAMEWORK . '/theme-support.php' );
require_once( PORTIO_FRAMEWORK . '/backend-functions.php' );
require_once( PORTIO_FRAMEWORK . '/frontend-functions.php' );
require_once( PORTIO_FRAMEWORK . '/enqueue-files.php' );
require_once( PORTIO_CS_FRAMEWORK . '/custom-style.php' );
require_once( PORTIO_CS_FRAMEWORK . '/config.php' );

/* Install Plugins */
require_once( PORTIO_FRAMEWORK . '/theme-options/plugins/activation.php' );

/* Breadcrumbs */
require_once( PORTIO_FRAMEWORK . '/theme-options/plugins/breadcrumb-trail.php' );

/* Aqua Resizer */
require_once( PORTIO_FRAMEWORK . '/theme-options/plugins/aq_resizer.php' );

/* Bootstrap Menu Walker */
require_once( PORTIO_FRAMEWORK . '/core/wp_bootstrap_navwalker.php' );

/* Sidebars */
require_once( PORTIO_FRAMEWORK . '/core/sidebars.php' );

if ( class_exists( 'WooCommerce' ) ) :
	require_once( PORTIO_FRAMEWORK . '/woocommerce-extend.php' );
endif;