<?php
/*
 * All CSS and JS files are enqueued from this file
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Enqueue Files for FrontEnd
 */
function portio_google_font_url() {
    $font_url = '';
    if ( 'off' !== esc_html__( 'on', 'portio' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Inter:wght@100..900&display=swap' ), "//fonts.googleapis.com/css2" );
    }
     return str_replace( array("%3A","%40", "%3B", "%26", "%3D"), array(":", "@", ";", "&", "="), $font_url );
}

function portio_heading_google_font_url() {
    $font_url = '';
    if ( 'off' !== esc_html__( 'on', 'portio' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Marcellus&display=swap' ), "//fonts.googleapis.com/css2" );
    }
     return str_replace( array("%3A","%40", "%3B", "%26", "%3D"), array(":", "@", ";", "&", "="), $font_url );
}

if ( ! function_exists( 'portio_scripts_styles' ) ) {
  function portio_scripts_styles() {

    // Styles
    wp_enqueue_style( 'themify-icons', PORTIO_CSS .'/themify-icons.css', array(), '4.6.3', 'all' );
    wp_enqueue_style( 'flaticon', PORTIO_CSS .'/flaticon.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'bootstrap', PORTIO_CSS .'/bootstrap.min.css', array(), '5.3.2', 'all' );
    wp_enqueue_style( 'animate', PORTIO_CSS .'/animate.css', array(), '3.5.1', 'all' );
    wp_enqueue_style( 'odometer', PORTIO_CSS .'/odometer.css', array(), '0.4.8', 'all' );
    wp_enqueue_style( 'progresscircle', PORTIO_CSS .'/progresscircle.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'owl-carousel', PORTIO_CSS .'/owl.carousel.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'owl-theme', PORTIO_CSS .'/owl.theme.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'slick', PORTIO_CSS .'/slick.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'swiper', PORTIO_CSS .'/swiper.min.css', array(), '11.0.7', 'all' );
    wp_enqueue_style( 'slick-theme', PORTIO_CSS .'/slick-theme.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'owl-transitions', PORTIO_CSS .'/owl.transitions.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'fancybox', PORTIO_CSS .'/fancybox.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'portio-style', PORTIO_CSS .'/styles.css', array(), PORTIO_VERSION, 'all' );
    wp_enqueue_style( 'element', PORTIO_CSS .'/elements.css', array(), PORTIO_VERSION, 'all' );
    if ( !function_exists('cs_framework_init') ) {
      wp_enqueue_style('portio-default-style', get_template_directory_uri() . '/style.css', array(),  PORTIO_VERSION, 'all' );
    }
    wp_enqueue_style( 'consoel-google-fonts', esc_url( portio_google_font_url() ), array(), PORTIO_VERSION, 'all' );
    wp_enqueue_style( 'consoel-heading-google-fonts', esc_url( portio_heading_google_font_url() ), array(), PORTIO_VERSION, 'all' );
    // Scripts
    wp_enqueue_script( 'bootstrap', PORTIO_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), '5.3.2', true );
    wp_enqueue_script( 'imagesloaded');
    wp_enqueue_script( 'isotope', PORTIO_SCRIPTS . '/isotope.min.js', array( 'jquery' ), '2.2.2', true );
    wp_enqueue_script( 'fancybox', PORTIO_SCRIPTS . '/fancybox.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'instafeed', PORTIO_SCRIPTS . '/instafeed.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'circle-progress', PORTIO_SCRIPTS . '/progresscircle.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'masonry');
    wp_enqueue_script( 'owl-carousel', PORTIO_SCRIPTS . '/owl-carousel.js', array( 'jquery' ), '2.0.0', true );
    wp_enqueue_script( 'jquery-easing', PORTIO_SCRIPTS . '/jquery-easing.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'wow', PORTIO_SCRIPTS . '/wow.min.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'odometer', PORTIO_SCRIPTS . '/odometer.min.js', array( 'jquery' ), '0.4.8', true );
    wp_enqueue_script( 'magnific-popup', PORTIO_SCRIPTS . '/magnific-popup.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'slick-slider', PORTIO_SCRIPTS . '/slick-slider.js', array( 'jquery' ), '1.6.0', true );
    wp_enqueue_script( 'slick-animation', PORTIO_SCRIPTS . '/slick-animation.min.js', array( 'jquery' ), '0.3.3', true );
    wp_enqueue_script( 'moving-animation', PORTIO_SCRIPTS . '/moving-animation.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'gsap', PORTIO_SCRIPTS . '/gsap.js', array( 'jquery' ), '3.12.5', true );
    wp_enqueue_script( 'ScrollToPlugin', PORTIO_SCRIPTS . '/gsap-scroll-to-plugin.js', array( 'jquery' ), '3.11.4', true );
    wp_enqueue_script( 'ScrollTrigger', PORTIO_SCRIPTS . '/gsap-scroll-trigger.js', array( 'jquery' ), '3.12.5', true );
    wp_enqueue_script( 'ScrollSmoother', PORTIO_SCRIPTS . '/gsap-scroll-smoother.js', array( 'jquery' ), '3.11.4', true );
    wp_enqueue_script( 'SplitText', PORTIO_SCRIPTS . '/gsap-split-text.js', array( 'jquery' ), '3.11.2', true );
    wp_enqueue_script( 'simpleParallax', PORTIO_SCRIPTS . '/simpleParallax.js', array( 'jquery' ), '5.6.2', true );
    wp_enqueue_script( 'swiper', PORTIO_SCRIPTS . '/swiper.min.js', array( 'jquery' ), '11.0.7', true );
    wp_enqueue_script( 'wc-quantity-increment', PORTIO_SCRIPTS . '/wc-quantity-increment.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'animation-scripts', PORTIO_SCRIPTS . '/animation-active.js', array( 'jquery' ), PORTIO_VERSION, true );
    wp_enqueue_script( 'portio-scripts', PORTIO_SCRIPTS . '/scripts.js', array( 'jquery' ), PORTIO_VERSION, true );
    // Comments
    wp_enqueue_script( 'portio-inline-validate', PORTIO_SCRIPTS . '/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
    wp_add_inline_script( 'portio-validate', 'jQuery(document).ready(function($) {$("#commentform").validate({rules: {author: {required: true,minlength: 2},email: {required: true,email: true},comment: {required: true,minlength: 10}}});});' );

    // Responsive Active
    $portio_viewport = cs_get_option('theme_responsive');
    if( !$portio_viewport ) {
      wp_enqueue_style( 'portio-responsive', PORTIO_CSS .'/responsive.css', array(), PORTIO_VERSION, 'all' );
    }

    // Adds support for pages with threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'portio_scripts_styles' );
}

/**
 * Enqueue Files for BackEnd
 */
if ( ! function_exists( 'portio_admin_scripts_styles' ) ) {
  function portio_admin_scripts_styles() {

    wp_enqueue_style( 'portio-admin-main', PORTIO_CSS . '/admin-styles.css', true );
    wp_enqueue_style( 'flaticon', PORTIO_CSS . '/flaticon.css', true );
    wp_enqueue_style( 'themify-icons', PORTIO_CSS . '/themify-icons.css', true );
    wp_enqueue_script( 'portio-admin-scripts', PORTIO_SCRIPTS . '/admin-scripts.js', true );

  }
  add_action( 'admin_enqueue_scripts', 'portio_admin_scripts_styles' );
}
