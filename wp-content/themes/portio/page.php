<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
$portio_id    = (isset($post)) ? $post->ID : 0;
$portio_id    = (is_home()) ? get_option('page_for_posts') : $portio_id;
$portio_meta  = get_post_meta($portio_id, 'page_type_metabox', true);
if ($portio_meta) {
	$portio_content_padding = $portio_meta['content_spacings'];
} else {
	$portio_content_padding = 'section-padding';
}
// Top and Bottom Padding
if ($portio_content_padding && $portio_content_padding !== 'padding-default') {
	$portio_content_top_spacings = isset($portio_meta['content_top_spacings']) ? $portio_meta['content_top_spacings'] : '';
	$portio_content_bottom_spacings = isset($portio_meta['content_bottom_spacings']) ? $portio_meta['content_bottom_spacings'] : '';
	if ($portio_content_padding === 'padding-custom') {
		$portio_content_top_spacings = $portio_content_top_spacings ? 'padding-top:' . portio_check_px($portio_content_top_spacings) . ';' : '';
		$portio_content_bottom_spacings = $portio_content_bottom_spacings ? 'padding-bottom:' . portio_check_px($portio_content_bottom_spacings) . ';' : '';
		$portio_custom_padding = $portio_content_top_spacings . $portio_content_bottom_spacings;
	} else {
		$portio_custom_padding = '';
	}
	$padding_class = '';
} else {
	$portio_custom_padding = '';
	$padding_class = '';
}

// Page Layout
$page_layout_options = get_post_meta(get_the_ID(), 'page_layout_options', true);
if ($page_layout_options) {
	$portio_page_layout = $page_layout_options['page_layout'];
	$page_sidebar_widget = $page_layout_options['page_sidebar_widget'];
} else {
	$portio_page_layout = 'right-sidebar';
	$page_sidebar_widget = '';
}
$page_sidebar_widget = $page_sidebar_widget ? $page_sidebar_widget : 'sidebar-1';
if ($portio_page_layout === 'extra-width') {
	$portio_page_column = 'extra-width';
	$portio_page_container = 'container-fluid';
} elseif ($portio_page_layout === 'full-width') {
	$portio_page_column = 'col-md-12';
	$portio_page_container = 'container ';
} elseif (($portio_page_layout === 'left-sidebar' || $portio_page_layout === 'right-sidebar') && is_active_sidebar($page_sidebar_widget)) {
	if ($portio_page_layout === 'left-sidebar') {
		$portio_page_column = 'col-md-8 order-12';
	} else {
		$portio_page_column = 'col-md-8';
	}
	$portio_page_container = 'container ';
} else {
	$portio_page_column = 'col-md-12';
	$portio_page_container = 'container ';
}
$portio_theme_page_comments = cs_get_option('theme_page_comments');
get_header();
?>
<div class="page-wrap <?php echo esc_attr($padding_class . '' . $portio_content_padding); ?>">
	<div class="<?php echo esc_attr($portio_page_container . '' . $portio_page_layout); ?>" style="<?php echo esc_attr($portio_custom_padding); ?>">
		<div class="row">
			<div class="<?php echo esc_attr($portio_page_column); ?>">
				<div class="page-wraper clearfix">
					<?php
					while (have_posts()) : the_post();
						the_content();
						if (!$portio_theme_page_comments && (comments_open() || get_comments_number())) :
							comments_template();
						endif;
					endwhile; // End of the loop.
					?>
				</div>
				<div class="page-link-wrap">
					<?php portio_wp_link_pages(); ?>
				</div>
			</div>
			<?php
			// Sidebar
			if (($portio_page_layout === 'left-sidebar' || $portio_page_layout === 'right-sidebar') && is_active_sidebar($page_sidebar_widget)) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php
get_footer();
