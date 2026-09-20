<?php
/*
 * The main template file.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
get_header();
	// Metabox
	$portio_id    = ( isset( $post ) ) ? $post->ID : 0;
	$portio_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $portio_id;
	$portio_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $portio_id;
	$portio_meta  = get_post_meta( $portio_id, 'page_type_metabox', true );
	if ( $portio_meta ) {
		$portio_content_padding = isset( $portio_meta['content_spacings'] ) ? $portio_meta['content_spacings'] : '';
	} else { $portio_content_padding = ''; }
	// Padding - Metabox
	if ($portio_content_padding && $portio_content_padding !== 'padding-default') {
		$portio_content_top_spacings = $portio_meta['content_top_spacings'];
		$portio_content_bottom_spacings = $portio_meta['content_bottom_spacings'];
		if ($portio_content_padding === 'padding-custom') {
			$portio_content_top_spacings = $portio_content_top_spacings ? 'padding-top:'. portio_check_px($portio_content_top_spacings) .';' : '';
			$portio_content_bottom_spacings = $portio_content_bottom_spacings ? 'padding-bottom:'. portio_check_px($portio_content_bottom_spacings) .';' : '';
			$portio_custom_padding = $portio_content_top_spacings . $portio_content_bottom_spacings;
		} else {
			$portio_custom_padding = '';
		}
	} else {
		$portio_custom_padding = '';
	}
	// Theme Options
	$portio_sidebar_position = cs_get_option( 'blog_sidebar_position' );
	$portio_sidebar_position = $portio_sidebar_position ?$portio_sidebar_position : 'sidebar-right';
	$portio_blog_widget = cs_get_option( 'blog_widget' );
	$portio_blog_widget = $portio_blog_widget ? $portio_blog_widget : 'sidebar-1';

	if (isset($_GET['sidebar'])) {
	  $portio_sidebar_position = $_GET['sidebar'];
	}

	$portio_sidebar_position = $portio_sidebar_position ? $portio_sidebar_position : 'sidebar-right';

	// Sidebar Position
	if ( $portio_sidebar_position === 'sidebar-hide' ) {
		$layout_class = 'col col col-md-10 col-md-offset-1';
		$portio_sidebar_class = 'hide-sidebar';
	} elseif ( $portio_sidebar_position === 'sidebar-left' && is_active_sidebar( $portio_blog_widget ) ) {
		$layout_class = 'col col-md-8 col-md-push-4';
		$portio_sidebar_class = 'left-sidebar';
	} elseif( is_active_sidebar( $portio_blog_widget ) ) {
		$layout_class = 'col col-md-8';
		$portio_sidebar_class = 'right-sidebar';
	} else {
		$layout_class = 'col col-md-12';
		$portio_sidebar_class = 'hide-sidebar';
	}

	?>
<div class="wpo-blog-pg-section section-padding">
	<div class="container <?php echo esc_attr( $portio_content_padding .' '. $portio_sidebar_class ); ?>" style="<?php echo esc_attr( $portio_custom_padding ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $layout_class ); ?>">
				<div class="blog-content">
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						get_template_part( 'theme-layouts/post/content' );
					endwhile;
				else :
					get_template_part( 'theme-layouts/post/content', 'none' );
				endif;
				portio_posts_navigation();
		    wp_reset_postdata(); ?>
		    </div>
			</div><!-- Content Area -->
			<?php
			if ( $portio_sidebar_position !== 'sidebar-hide' && is_active_sidebar( $portio_blog_widget ) ) {
				get_sidebar(); // Sidebar
			} ?>
		</div>
	</div>
</div>
<?php
get_footer();