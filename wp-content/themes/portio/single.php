<?php
/*
 * The template for displaying all single posts.
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
		$portio_content_padding = $portio_meta['content_spacings'];
	} else { $portio_content_padding = ''; }
	// Padding - Metabox
	if ( $portio_content_padding && $portio_content_padding !== 'padding-default' ) {
		$portio_content_top_spacings = $portio_meta['content_top_spacings'];
		$portio_content_bottom_spacings = $portio_meta['content_bottom_spacings'];
		if ( $portio_content_padding === 'padding-custom' ) {
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
	$portio_single_comment = cs_get_option( 'single_comment_form' );
	$portio_sidebar_position = cs_get_option( 'blog_sidebar_position' );
	$portio_sidebar_position = $portio_sidebar_position ?$portio_sidebar_position : 'sidebar-right';
	$portio_blog_widget = cs_get_option( 'blog_widget' );
	$portio_blog_widget = $portio_blog_widget ? $portio_blog_widget : 'sidebar-1';

	$portio_sidebar_position = $portio_sidebar_position ? $portio_sidebar_position : 'sidebar-right';

	if (isset($_GET['sidebar'])) {
	  $portio_sidebar_position = $_GET['sidebar'];
	}
	
	// Sidebar Position
	if ( $portio_sidebar_position === 'sidebar-hide' ) {
		$layout_class = 'col col-lg-10 offset-lg-1';
		$portio_sidebar_class = 'hide-sidebar';
	} elseif ( $portio_sidebar_position === 'sidebar-left' && is_active_sidebar( $portio_blog_widget ) ) {
		$layout_class = 'col col-lg-8 order-lg-2';
		$portio_sidebar_class = 'left-sidebar';
	} elseif( is_active_sidebar( $portio_blog_widget ) ) {
		$layout_class = 'col col-lg-8';
		$portio_sidebar_class = 'right-sidebar';
	} else {
		$layout_class = 'col col-lg-12';
		$portio_sidebar_class = 'hide-sidebar';
	}
?>
<div class="wpo-blog-single-section section-padding <?php echo esc_attr( $portio_content_padding .' '. $portio_sidebar_class ); ?>" style="<?php echo esc_attr( $portio_custom_padding ); ?>">
	<div class="container content-area ">
		<div class="row">
			<div class="single-content-wrap <?php echo esc_attr( $layout_class ); ?>">
				<div class="wpo-blog-content">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							if ( post_password_required() ) {
									echo '<div class="password-form">'.get_the_password_form().'</div>';
								} else {
									get_template_part( 'theme-layouts/post/content', 'single' );
									$portio_single_comment = !$portio_single_comment ? comments_template() : '';

								}
						endwhile;
					else :
						get_template_part( 'theme-layouts/post/content', 'none' );
					endif; ?>
				</div><!-- Blog Div -->
				<?php
		    wp_reset_postdata(); ?>
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