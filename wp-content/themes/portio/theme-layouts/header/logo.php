<?php
// Metabox
global $post;
$portio_id    = ( isset( $post ) ) ? $post->ID : false;
$portio_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $portio_id;
$portio_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $portio_id;
$portio_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('service') ) ? $portio_id : false;
$portio_meta  = get_post_meta( $portio_id, 'page_type_metabox', true );
// Header Style

$portio_logo = cs_get_option( 'portio_logo' );

$logo_url = wp_get_attachment_url( $portio_logo );
$portio_logo_alt = get_post_meta( $portio_logo, '_wp_attachment_image_alt', true );

if ( $logo_url ) {
  $logo_url = $logo_url;
} else {
 $logo_url = PORTIO_IMAGES.'/logo.svg';
}

if ( has_nav_menu( 'primary' ) ) {
  $logo_padding = ' has_menu ';
}
else {
   $logo_padding = ' dont_has_menu ';
}


// Logo Spacings
// Logo Spacings
$portio_brand_logo_top = cs_get_option( 'portio_logo_top' );
$portio_brand_logo_bottom = cs_get_option( 'portio_logo_bottom' );
if ( $portio_brand_logo_top ) {
  $portio_brand_logo_top = 'padding-top:'. portio_check_px( $portio_brand_logo_top ) .';';
} else { $portio_brand_logo_top = ''; }
if ( $portio_brand_logo_bottom ) {
  $portio_brand_logo_bottom = 'padding-bottom:'. portio_check_px( $portio_brand_logo_bottom ) .';';
} else { $portio_brand_logo_bottom = ''; }
?>
<div class="site-logo <?php echo esc_attr( $logo_padding ); ?>"  style="<?php echo esc_attr( $portio_brand_logo_top ); echo esc_attr( $portio_brand_logo_bottom ); ?>">
   <?php if ( $portio_logo ) {
    ?>
      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $logo_url ); ?>" alt=" <?php echo esc_attr( $portio_logo_alt ); ?>">
     </a>
   <?php } elseif( has_custom_logo() ) {
      the_custom_logo();
    } else {
    ?>
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo get_bloginfo('name'); ?>">
     </a>
   <?php
  } ?>
</div>