<?php
/*
 * The template for displaying the footer.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

$portio_id    = (isset($post)) ? $post->ID : 0;
$portio_id    = (is_home()) ? get_option('page_for_posts') : $portio_id;
$portio_id    = (is_woocommerce_shop()) ? wc_get_page_id('shop') : $portio_id;
$portio_meta  = get_post_meta($portio_id, 'page_type_metabox', true);
$portio_ft_bg = cs_get_option('portio_ft_bg');
$portio_attachment = wp_get_attachment_image_src($portio_ft_bg, 'full');
$portio_attachment = $portio_attachment ? $portio_attachment[0] : '';
if ($portio_meta) {
	$portio_footer_design  = $portio_meta['select_footer_design'];
	if ($portio_footer_design != 'theme') {
		$portio_footer_design = $portio_footer_design;
	} else {
		$portio_footer_design = cs_get_option('select_footer_design');
	}
} else {
	$portio_footer_design  = cs_get_option('select_footer_design');
}

if (is_numeric($portio_footer_design)) {
	$footer_class = 'footer-builder';
} else {
	$footer_class = 'wpo-site-footer clearfix';
}

if ($portio_attachment && !is_numeric($portio_footer_design)) {
	$bg_url = ' style="';
	$bg_url .= ($portio_attachment) ? 'background-image: url( ' . esc_url($portio_attachment) . ' );' : '';
	$bg_url .= '"';
} else {
	$bg_url = '';
}

if ($portio_meta) {
	$portio_hide_footer  = $portio_meta['hide_footer'];
} else {
	$portio_hide_footer = '';
}
if (!$portio_hide_footer) { // Hide Footer Metabox
	$hide_copyright = cs_get_option('hide_copyright');

?>
	<!-- Footer -->
	<footer class="<?php echo esc_attr($footer_class); ?>" <?php echo wp_kses($bg_url, array('img' => array('src' => array(), 'alt' => array()),)); ?>>
		<?php if (is_numeric($portio_footer_design)) {
			$footer_builder = new WP_Query(
				array(
					'post_type' => 'footerbuilder',
					'posts_per_page' => 1,
					'p' => $portio_footer_design,
					'orderby' => 'none',
					'order' => 'DESC'
				)
			);

			if ($footer_builder->have_posts()) {
				while ($footer_builder->have_posts()) {
					$footer_builder->the_post();
					the_content();
				}
			}
			wp_reset_postdata();
		} else {
			$footer_widget_block = cs_get_option('footer_widget_block');
			if ($footer_widget_block) {
				get_template_part('theme-layouts/footer/footer', 'widgets');
			}
			if (!$hide_copyright) {
				get_template_part('theme-layouts/footer/footer', 'copyright');
			}
		} ?>

		<div class="shape">
			<svg width="471" height="540" viewBox="0 0 471 540" fill="none">
				<circle cx="201" cy="270" r="270" fill="url(#paint0_radial_56_1838)" fill-opacity="0.3" />
				<defs>
					<radialGradient id="paint0_radial_56_1838" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(201 270) rotate(90) scale(270)">
						<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8" />
						<stop offset="1" stop-color="#1B1C1E" stop-opacity="0" />
					</radialGradient>
				</defs>
			</svg>
		</div>
		<div class="shape-2">
			<svg width="319" height="416" viewBox="0 0 319 416" fill="none">
				<circle cx="208" cy="208" r="208" fill="url(#paint0_radial_56_1807)" fill-opacity="0.4"></circle>
				<defs>
					<radialGradient id="paint0_radial_56_1807" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(208 208) rotate(90) scale(208)">
						<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8"></stop>
						<stop offset="1" stop-color="#1B1C1E" stop-opacity="0"></stop>
					</radialGradient>
				</defs>
			</svg>
		</div>
	</footer>
	<!-- Footer -->
<?php } // Hide Footer Metabox 
?>
</div><!--portio-theme-wrapper -->
</div><!--portio-gsap-wrapper -->
</div><!--portio-gsap-end -->
<?php wp_footer(); ?>
</body>

</html>