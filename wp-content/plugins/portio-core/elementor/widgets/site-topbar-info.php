<?php
/*
 * Elementor Portio Topbar Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Grafco_Topbar extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_topbar';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Topbar', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-preferences';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Topbar widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_topbar'];
	}

	/**
	 * Register Portio Topbar widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_topbar',
			[
				'label' => esc_html__('Topbar Options', 'portio-core'),
			]
		);
		$this->add_control(
			'topbar_style',
			[
				'label' => esc_html__('Topbar Style', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'portio-core'),
					'style-two' => esc_html__('Style Two', 'portio-core'),
					'style-three' => esc_html__('Style Three', 'portio-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your topbar style.', 'portio-core'),
			]
		);
		$this->add_control(
			'topbar_toptitle',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'topbar_style' => array('style-three'),
				],
				'default' => esc_html__(' Welcome to transportation solutions comapny ', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'topbar_image',
			[
				'label' => esc_html__('Topbar Image', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'topbar_style' => array('style-one', 'style-three'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$this->add_control(
			'topbar_image2',
			[
				'label' => esc_html__('Topbar Image', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'topbar_style' => array('style-three'),
				],
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'topbar_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Call Us:', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'topbar_subtitle',
			[
				'label' => esc_html__('SubTitle Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('00-56745879647', 'portio-core'),
				'placeholder' => esc_html__('Type subtitle text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'topbar_link',
			[
				'label' => esc_html__('Link Url', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'portio-core'),
				'placeholder' => esc_html__('Type link url here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'topbar_icon',
			[
				'label' => __('Icon', 'portio-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fi flaticon-phone-call',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'topbarItems_groups',
			[
				'label' => esc_html__('Topbar item', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'topbar_style' => array('style-one', 'style-two'),
				],
				'default' => [
					[
						'topbar_title' => esc_html__('Topbar', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ topbar_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		$this->start_controls_section(
			'section_topbar_section_style',
			[
				'label' => esc_html__('Topbar', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'topbar_item_bg_color',
			[
				'label' => esc_html__('Background Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'topbar_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar.s2 ' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .topbar.s2 .contyact-info-wrap .contact-info+.contact-info:before ' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Info Icons
		$this->start_controls_section(
			'topbar_icon_style',
			[
				'label' => esc_html__('Icon', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'topbar_icon_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar .contyact-info-wrap .contact-info .icon .fi:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_title_typography',
				'selector' => '{{WRAPPER}} .topbar .contyact-info-wrap .contact-info .info-text span, .topbar.s3 .topbar-welcome p',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar .contyact-info-wrap .contact-info .info-text span, .topbar.s3 .topbar-welcome p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => __('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topbar .contyact-info-wrap .contact-info .info-text span, .topbar.s3 .topbar-welcome p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		//Sub Title
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__('Sub Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_subtitle_typography',
				'selector' => '{{WRAPPER}} .topbar .contyact-info-wrap .contact-info .info-text p',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar .contyact-info-wrap .contact-info .info-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => esc_html__('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .topbar .contyact-info-wrap .contact-info .info-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Topbar widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$topbar_style = !empty($settings['topbar_style']) ? $settings['topbar_style'] : '';
		$topbar_toptitle = !empty($settings['topbar_toptitle']) ? $settings['topbar_toptitle'] : '';
		$topbarItems_groups = !empty($settings['topbarItems_groups']) ? $settings['topbarItems_groups'] : [];

		$bg_image = !empty($settings['topbar_image']['id']) ? $settings['topbar_image']['id'] : '';
		$bg_image2 = !empty($settings['topbar_image2']['id']) ? $settings['topbar_image2']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		// Image
		$image2_url = wp_get_attachment_url($bg_image2);
		$image2_alt = get_post_meta($bg_image2, '_wp_attachment_image_alt', true);

		if ($topbar_style == 'style-one') {
			$topbar_wrapper = '';
			$topbar_col = 'col-lg-8 col-12';
		} elseif ($topbar_style == 'style-two') {
			$topbar_wrapper = 's2';
			$topbar_col = 'col-lg-12 col-12';
		} else {
			$topbar_wrapper = 's3';
			$topbar_col = 'col-lg-12 col-12';
		}

		// Turn output buffer on

		ob_start(); ?>

		<div class="topbar <?php echo esc_attr($topbar_wrapper); ?>">
			<div class="container">
				<div class="row align-items-center">
					<?php
					if ($topbar_style == 'style-three') { ?>
						<div class="col-lg-12 col-12">
							<div class="topbar-welcome">
								<p>
									<i>
										<?php if ($image_url) {
											echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
										}  ?>
									</i>
									<?php if ($topbar_toptitle) {
										echo '<span>' . esc_html($topbar_toptitle) . '</span>';
									} ?>
									<i>
										<?php if ($image2_url) {
											echo '<img src="' . esc_url($image2_url) . '" alt="' . esc_url($image2_alt) . '">';
										}  ?>
									</i>
								</p>
							</div>
						</div>
					<?php }
					if ($topbar_style == 'style-one') { ?>
						<div class="col-lg-4 col-12 d-lg-block d-none">
							<a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
								<?php if ($image_url) {
									echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
								}  ?>
							</a>
						</div>
					<?php }
					if ($topbar_style == 'style-one' || $topbar_style == 'style-two') { ?>
						<div class="<?php echo esc_attr($topbar_col); ?>">
							<div class="contyact-info-wrap">
								<?php
								// Group Param Output
								if (is_array($topbarItems_groups) && !empty($topbarItems_groups)) {
									foreach ($topbarItems_groups as $each_item) {

										$topbar_title = !empty($each_item['topbar_title']) ? $each_item['topbar_title'] : '';
										$topbar_subtitle = !empty($each_item['topbar_subtitle']) ? $each_item['topbar_subtitle'] : '';

										$topbar_icon = !empty($each_item['topbar_icon']['value']) ? $each_item['topbar_icon']['value'] : '';
										$topbar_svg_url = !empty($each_item['topbar_icon']['value']['url']) ? $each_item['topbar_icon']['value']['url'] : '';
										$svg_alt = get_post_meta($topbar_svg_url, '_wp_attachment_image_alt', true);

										$topbar_link = !empty($each_item['topbar_link']) ? $each_item['topbar_link'] : '';

										if ($topbar_link) {
											$link_o = '<a href="' . $topbar_link . '" class="info-link">';
											$link_c = '</a>';
										} else {
											$link_o = '';
											$link_c = '';
										}

								?>
										<div class="contact-info">
											<div class="icon">
												<?php
												if ($topbar_svg_url) {
													echo '<img class="img-responsive default-icon"  src="' . esc_url($topbar_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
												} else {
													echo '<i class="' . esc_attr($topbar_icon) . '"></i>';
												}
												?>
											</div>
											<div class="info-text">
												<?php
												if ($topbar_title) {
													echo '<span>' . esc_html($topbar_title) . '</span>';
												}
												if ($topbar_subtitle) {
													echo '<p>' . $link_o . '' . esc_html($topbar_subtitle) . '' . $link_c . '</p>';
												}
												?>
											</div>
										</div>
								<?php }
								} ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Topbar widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Grafco_Topbar());
