<?php
// Metabox
global $post;
$portio_id    = ( isset( $post ) ) ? $post->ID : false;
$portio_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $portio_id;
$portio_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $portio_id;
$portio_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $portio_id : false;
$portio_meta  = get_post_meta( $portio_id, 'page_type_metabox', true );
  if ($portio_meta) {
    $portio_topbar_options = $portio_meta['topbar_options'];
  } else {
    $portio_topbar_options = '';
  }

  if ( $portio_meta ) {
    $portio_header_design  = $portio_meta['select_header_design'];
  } else {
    $portio_header_design  = cs_get_option( 'select_header_design' );
  }

 if ( $portio_header_design === 'default' ) {
    $portio_header_design_actual  = cs_get_option( 'select_header_design' );
  } else {
    $portio_header_design_actual = ( $portio_header_design ) ? $portio_header_design : cs_get_option('select_header_design');
  }
  
$portio_header_design_actual = $portio_header_design_actual ? $portio_header_design_actual : 'style_two';

// Define Theme Options and Metabox varials in right way!
if ($portio_meta) {
  if ($portio_topbar_options === 'custom' && $portio_topbar_options !== 'default') {
    $portio_top_left          = $portio_meta['top_left'];
    $portio_top_right          = $portio_meta['top_right'];
    $portio_hide_topbar        = $portio_topbar_options;
    $portio_topbar_bg          = $portio_meta['topbar_bg'];
    if ($portio_topbar_bg) {
      $portio_topbar_bg = 'background-color: '. $portio_topbar_bg .';';
    } else {$portio_topbar_bg = '';}
  } else {
    $portio_top_left          = cs_get_option('top_left');
    $portio_top_right          = cs_get_option('top_right');
    $portio_hide_topbar        = cs_get_option('top_bar');
    $portio_topbar_bg          = '';
  }
} else {
  // Theme Options fields
  $portio_top_left         = cs_get_option('top_left');
  $portio_top_right          = cs_get_option('top_right');
  $portio_hide_topbar        = cs_get_option('top_bar');
  $portio_topbar_bg          = '';
}
// All options
if ( $portio_meta && $portio_topbar_options === 'custom' && $portio_topbar_options !== 'default' ) {
  $portio_top_right = ( $portio_top_right ) ? $portio_meta['top_right'] : cs_get_option('top_right');
  $portio_top_left = ( $portio_top_left ) ? $portio_meta['top_left'] : cs_get_option('top_left');
} else {
  $portio_top_right = cs_get_option('top_right');
  $portio_top_left = cs_get_option('top_left');
}
if ( $portio_meta && $portio_topbar_options !== 'default' ) {
  if ( $portio_topbar_options === 'hide_topbar' ) {
    $portio_hide_topbar = 'hide';
  } else {
    $portio_hide_topbar = 'show';
  }
} else {
  $portio_hide_topbar_check = cs_get_option( 'top_bar' );
  if ( $portio_hide_topbar_check === true ) {
     $portio_hide_topbar = 'hide';
  } else {
     $portio_hide_topbar = 'show';
  }
}
if ( $portio_meta ) {
  $portio_topbar_bg = ( $portio_topbar_bg ) ? $portio_meta['topbar_bg'] : '';
} else {
  $portio_topbar_bg = '';
}
if ( $portio_topbar_bg ) {
  $portio_topbar_bg = 'background-color: '. $portio_topbar_bg .';';
} else { $portio_topbar_bg = ''; }

if( $portio_hide_topbar === 'show' && ( $portio_top_left || $portio_top_right ) ) {
?>
 <div class="topbar" style="<?php echo esc_attr( $portio_topbar_bg ); ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-7 col-sm-12 col-12">
               <?php echo do_shortcode( $portio_top_left ); ?>
            </div>
            <div class="col col-md-5 col-sm-12 col-12">
                <?php echo do_shortcode( $portio_top_right ); ?>
            </div>
        </div>
    </div>
</div> <!-- end topbar -->
<?php } // Hide Topbar - From Metabox