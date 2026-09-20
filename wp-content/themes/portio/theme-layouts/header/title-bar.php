<?php
// Metabox
$portio_id    = (isset($post)) ? $post->ID : 0;
$portio_id    = (is_home()) ? get_option('page_for_posts') : $portio_id;
$portio_id    = (is_woocommerce_shop()) ? wc_get_page_id('shop') : $portio_id;
$portio_meta  = get_post_meta($portio_id, 'page_type_metabox', true);
if ($portio_meta && is_page()) {
	$portio_title_bar_padding = $portio_meta['title_area_spacings'];
} else {
	$portio_title_bar_padding = '';
}
// Padding - Theme Options
if ($portio_title_bar_padding && $portio_title_bar_padding !== 'padding-default') {
	$portio_title_top_spacings = $portio_meta['title_top_spacings'];
	$portio_title_bottom_spacings = $portio_meta['title_bottom_spacings'];
	if ($portio_title_bar_padding === 'padding-custom') {
		$portio_title_top_spacings = $portio_title_top_spacings ? 'padding-top:' . portio_check_px($portio_title_top_spacings) . ';' : '';
		$portio_title_bottom_spacings = $portio_title_bottom_spacings ? 'padding-bottom:' . portio_check_px($portio_title_bottom_spacings) . ';' : '';
		$portio_custom_padding = $portio_title_top_spacings . $portio_title_bottom_spacings;
	} else {
		$portio_custom_padding = '';
	}
} else {
	$portio_title_bar_padding = cs_get_option('title_bar_padding');
	$portio_titlebar_top_padding = cs_get_option('titlebar_top_padding');
	$portio_titlebar_bottom_padding = cs_get_option('titlebar_bottom_padding');
	if ($portio_title_bar_padding === 'padding-custom') {
		$portio_titlebar_top_padding = $portio_titlebar_top_padding ? 'padding-top:' . portio_check_px($portio_titlebar_top_padding) . ';' : '';
		$portio_titlebar_bottom_padding = $portio_titlebar_bottom_padding ? 'padding-bottom:' . portio_check_px($portio_titlebar_bottom_padding) . ';' : '';
		$portio_custom_padding = $portio_titlebar_top_padding . $portio_titlebar_bottom_padding;
	} else {
		$portio_custom_padding = '';
	}
}
// Banner Type - Meta Box
if ($portio_meta && is_page()) {
	$portio_banner_type = $portio_meta['banner_type'];
} else {
	$portio_banner_type = '';
}
// Header Style
if ($portio_meta) {
	$portio_header_design  = $portio_meta['select_header_design'];
	$portio_hide_breadcrumbs  = $portio_meta['hide_breadcrumbs'];
} else {
	$portio_header_design  = cs_get_option('select_header_design');
	$portio_hide_breadcrumbs = cs_get_option('need_breadcrumbs');
}
if ($portio_header_design === 'default') {
	$portio_header_design_actual  = cs_get_option('select_header_design');
} else {
	$portio_header_design_actual = ($portio_header_design) ? $portio_header_design : cs_get_option('select_header_design');
}
if ($portio_header_design_actual == 'style_two') {
	$overly_class = ' overly';
} else {
	$overly_class = ' ';
}
// Overlay Color - Theme Options
if ($portio_meta && is_page()) {
	$portio_bg_overlay_color = $portio_meta['titlebar_bg_overlay_color'];
	$title_color = isset($portio_meta['title_color']) ? $portio_meta['title_color'] : '';
} else {
	$portio_bg_overlay_color = '';
}
if (!empty($portio_bg_overlay_color)) {
	$portio_bg_overlay_color = $portio_bg_overlay_color;
	$title_color = $title_color;
} else {
	$portio_bg_overlay_color = cs_get_option('titlebar_bg_overlay_color');
	$title_color = cs_get_option('title_color');
}
$e_uniqid        = uniqid();
$inline_style  = '';
if ($portio_bg_overlay_color) {
	$inline_style .= '.page-title-' . $e_uniqid . '.page-title {';
	$inline_style .= ($portio_bg_overlay_color) ? 'background-color:' . $portio_bg_overlay_color . ';' : '';
	$inline_style .= '}';
}
if ($title_color) {
	$inline_style .= '.page-title-' . $e_uniqid . '.page-title h2, .page-title-' . $e_uniqid . '.page-title .breadcrumb li, .page-title-' . $e_uniqid . '.page-title .breadcrumbs ul li a {';
	$inline_style .= ($title_color) ? 'color:' . $title_color . ';' : '';
	$inline_style .= '}';
}
// add inline style
add_inline_style($inline_style);
$styled_class  = ' page-title-' . $e_uniqid;
// Background - Type
if ($portio_meta) {
	$title_bar_bg = $portio_meta['title_area_bg'];
} else {
	$title_bar_bg = '';
}
$portio_custom_header = get_custom_header();
$header_text_color = get_theme_mod('header_textcolor');
$background_color = get_theme_mod('background_color');
if (isset($title_bar_bg['image']) && ($title_bar_bg['image'] ||  $title_bar_bg['color'])) {
	extract($title_bar_bg);
	$portio_background_image       = (!empty($image)) ? 'background-image: url(' . esc_url($image) . ');' : '';
	$portio_background_repeat      = (!empty($image) && !empty($repeat)) ? ' background-repeat: ' . esc_attr($repeat) . ';' : '';
	$portio_background_position    = (!empty($image) && !empty($position)) ? ' background-position: ' . esc_attr($position) . ';' : '';
	$portio_background_size    = (!empty($image) && !empty($size)) ? ' background-size: ' . esc_attr($size) . ';' : '';
	$portio_background_attachment    = (!empty($image) && !empty($size)) ? ' background-attachment: ' . esc_attr($attachment) . ';' : '';
	$portio_background_color       = (!empty($color)) ? ' background-color: ' . esc_attr($color) . ';' : '';
	$portio_background_style       = (!empty($image)) ? $portio_background_image . $portio_background_repeat . $portio_background_position . $portio_background_size . $portio_background_attachment : '';
	$portio_title_bg = (!empty($portio_background_style) || !empty($portio_background_color)) ? $portio_background_style . $portio_background_color : '';
} elseif ($portio_custom_header->url) {
	$portio_title_bg = 'background-image:  url(' . esc_url($portio_custom_header->url) . ');';
} else {
	$portio_title_bg = '';
}
if ($portio_banner_type === 'hide-title-area') { // Hide Title Area
} elseif ($portio_meta && $portio_banner_type === 'revolution-slider') { // Hide Title Area
	echo do_shortcode($portio_meta['page_revslider']);
} else {
?>
	<!-- start page-title -->
	<section class="wpo-page-title <?php echo esc_attr($overly_class . $styled_class . ' ' . $portio_banner_type); ?>" style="<?php echo esc_attr($portio_title_bg . ' ' . $portio_custom_padding); ?>">
		<div class="container">
			<div class="row">
				<div class="col col-xs-12">
					<div class="wpo-breadcumb-wrap">
						<h2><?php echo portio_title_area(); ?></h2>
						<?php if (!$portio_hide_breadcrumbs && function_exists('breadcrumb_trail')) {
							breadcrumb_trail();
						} ?>
					</div>
				</div>
			</div> <!-- end row -->
		</div> <!-- end container -->
		<div class="shape">
			<svg width="478" height="478" viewBox="0 0 478 478" fill="none">
				<circle cx="239" cy="239" r="239" fill="url(#paint0_radial_56_1806)" fill-opacity="0.6"></circle>
				<defs>
					<radialGradient id="paint0_radial_56_1806" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(239 239) rotate(90) scale(239)">
						<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8"></stop>
						<stop offset="1" stop-color="#1B1C1E" stop-opacity="0"></stop>
					</radialGradient>
				</defs>
			</svg>
		</div>
		<div class="shape-2">
			<svg width="478" height="478" viewBox="0 0 478 478" fill="none">
				<circle cx="239" cy="239" r="239" fill="url(#paint0_radial_56_1806)" fill-opacity="0.6"></circle>
				<defs>
					<radialGradient id="paint0_radial_56_1806" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(239 239) rotate(90) scale(239)">
						<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8"></stop>
						<stop offset="1" stop-color="#1B1C1E" stop-opacity="0"></stop>
					</radialGradient>
				</defs>
			</svg>
		</div>
	</section>
	<!-- end page-title -->
<?php } ?>