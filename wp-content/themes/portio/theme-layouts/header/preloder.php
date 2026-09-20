<?php
	// Logo Image
	// Metabox - Header Transparent
	$portio_id    = ( isset( $post ) ) ? $post->ID : 0;
	$portio_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $portio_id;
	$portio_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $portio_id;
	$portio_meta  = get_post_meta( $portio_id, 'page_type_metabox'. true );
    $portio_preloader_image  = cs_get_option( 'preloader_image' );

    $portio_preloader_url = wp_get_attachment_url( $portio_preloader_image );
    $portio_preloader_alt = get_post_meta( $portio_preloader_image, '_wp_attachment_image_alt', true );

    if ( $portio_preloader_url ) {
        $portio_preloader_url = $portio_preloader_url;
    } else {
        $portio_preloader_url = PORTIO_IMAGES.'/preloader.png';
    }

?>
<!-- start preloader -->
<div class="preloader">
    <div class="vertical-centered-box">
        <div class="content">
            <div class="loader-circle"></div>
            <div class="loader-line-mask">
                <div class="loader-line"></div>
            </div>
           <img src="<?php echo esc_url( $portio_preloader_url ); ?>" alt="<?php echo esc_attr( $portio_preloader_alt ); ?>">
        </div>
    </div>
</div>
<!-- end preloader -->