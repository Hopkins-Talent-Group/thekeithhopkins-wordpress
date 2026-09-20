<?php
  // Metabox
  $portio_id    = ( isset( $post ) ) ? $post->ID : 0;
  $portio_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $portio_id;
  $portio_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $portio_id;
  $portio_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $portio_id : false;
  $portio_meta  = get_post_meta( $portio_id, 'page_type_metabox', true );

  // Header Style
  if ( $portio_meta ) {
    $portio_header_design  = $portio_meta['select_header_design'];
    $portio_sticky_header = isset( $portio_meta['sticky_header'] ) ? $portio_meta['sticky_header'] : '' ;
    $portio_search = isset( $portio_meta['portio_search'] ) ? $portio_meta['portio_search'] : '';
  } else {
    $portio_header_design  = cs_get_option( 'select_header_design' );
    $portio_sticky_header  = cs_get_option( 'sticky_header' );
    $portio_search  = cs_get_option( 'portio_search' );
  }

  $portio_cart_widget  = cs_get_option( 'portio_cart_widget' );

  if ( $portio_header_design === 'default' ) {
    $portio_header_design_actual  = cs_get_option( 'select_header_design' );
  } else {
    $portio_header_design_actual = ( $portio_header_design ) ? $portio_header_design : cs_get_option('select_header_design');
  }
  $portio_header_design_actual = $portio_header_design_actual ? $portio_header_design_actual : 'style_two';

  if ( $portio_meta && $portio_header_design !== 'default') {
   $portio_search = isset( $portio_meta['portio_search'] ) ? $portio_meta['portio_search'] : '';
  } else {
    $portio_search  = cs_get_option( 'portio_search' );
  }

  if ( $portio_header_design_actual == 'style_two' ) { 
    $menu_container = 'container-fluid';
  } else {
    $menu_container = 'container-fluid';
  }

  if ( $portio_cart_widget ) {
    $cart_class = 'has-cart ';
  } else {
    $cart_class = 'not-has-cart ';
  }
  if ( $portio_search ) {
   $search_class = 'not-has-search ';
  } else {
    $search_class = 'has-search ';
  }
  if ( has_nav_menu( 'primary' ) ) {
     $menu_padding = ' has-menu ';
  } else {
     $menu_padding = ' dont-has-menu ';
  }
  if ($portio_meta) {
    $portio_choose_menu = isset( $portio_meta['choose_menu'] ) ? $portio_meta['choose_menu'] : '' ;
  } else { $portio_choose_menu = ''; }
  $portio_choose_menu = $portio_choose_menu ? $portio_choose_menu : '';

?>
<!-- Navigation & Search -->
 <div class="<?php echo esc_attr( $menu_container ); ?>">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-3 col-3 d-lg-none dl-block">
          <div class="mobail-menu">
              <button type="button" class="navbar-toggler open-btn">
                  <span class="sr-only"><?php echo esc_html__( 'Toggle navigation','portio' ) ?></span>
                  <span class="icon-bar first-angle"></span>
                  <span class="icon-bar middle-angle"></span>
                  <span class="icon-bar last-angle"></span>
              </button>
          </div>
      </div>
      <div class="col-lg-2 col-md-6 col-6"><!-- Start of Logo -->
          <div class="navbar-header">
            <?php get_template_part( 'theme-layouts/header/logo' ); ?>
          </div>
      </div>
      <div class="col-lg-8 col-md-1 col-1"><!-- Start of nav-collapse -->
        <div id="navbar" class="collapse navbar-collapse navigation-holder <?php echo esc_attr( $menu_padding.$cart_class.$search_class ); ?>">
            <button class="menu-close"><i class="ti-close"></i></button>
            <?php
              wp_nav_menu(
                array(
                  'menu'              => 'primary',
                  'theme_location'    => 'primary',
                  'container'         => '',
                  'container_class'   => '',
                  'container_id'      => '',
                  'menu_class'        => 'nav navbar-nav menu nav-menu mb-2 mb-lg-0',
                  'fallback_cb'       => '__return_false',
                )
              );
            ?>
        </div><!-- end of nav-collapse -->
      </div>
      <?php get_template_part( 'theme-layouts/header/search','bar' ); ?>
    </div><!-- end of row -->
  </div><!-- end of container -->


