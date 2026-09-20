<?php
add_action( 'wp_enqueue_scripts', 'portio_enqueue_styles' );
function portio_enqueue_styles() {
  $parent_style = 'portio-style';
  wp_enqueue_style( $parent_style, get_template_directory_uri() . '/assets/css/styles.css', array('themify-icons', 'flaticon', 'bootstrap', 'animate','owl-carousel','owl-theme', 'slick', 'slick-theme','owl-transitions','fancybox','fancybox') );
  wp_enqueue_style( 'portio-child',
      get_stylesheet_directory_uri() . '/style.css',
      array( $parent_style ),
      wp_get_theme()->get('Version')
    );
}
if( ! function_exists( 'portio_child_theme_language_setup' ) ) {
  function portio_child_theme_language_setup(){
    load_theme_textdomain( 'portio-child', get_template_directory() . '/languages' );
  }
  add_action('after_setup_theme', 'portio_child_theme_language_setup');
}


function add_fancybox_for_carousel() {
    // Fancybox CSS
    wp_enqueue_style( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css', array(), null );

    // Fancybox JS
    wp_enqueue_script( 'fancybox', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js', array('jquery'), null, true );
}
add_action( 'wp_enqueue_scripts', 'add_fancybox_for_carousel' );