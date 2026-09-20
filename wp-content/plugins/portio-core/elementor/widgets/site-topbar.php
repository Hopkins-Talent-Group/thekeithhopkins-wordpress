<?php
/*
 * Elementor Portio Address Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Topbar_Address extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_address';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Address', 'portio-core');
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
	 * Retrieve the list of scripts the Portio Address widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_address'];
	}

	/**
	 * Register Portio Address widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_address',
			[
				'label' => esc_html__('Address Options', 'portio-core'),
			]
		);
		$this->add_control(
			'social_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Visit our social pages', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'address_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Call Us:', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'address_link',
			[
				'label' => esc_html__('Link Url', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'portio-core'),
				'placeholder' => esc_html__('Type link url here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'address_icon',
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
			'addressItems_groups',
			[
				'label' => esc_html__('Address item', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'address_title' => esc_html__('Address', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ address_title }}}',
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'social_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Social item', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'social_link',
			[
				'label' => esc_html__('Link Url', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'portio-core'),
				'placeholder' => esc_html__('Type link url here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'social_icon',
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
			'socialItems_groups',
			[
				'label' => esc_html__('Social item', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'social_title' => esc_html__('Social', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ social_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		$this->start_controls_section(
			'section_address_section_style',
			[
				'label' => esc_html__('Address', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'address_item_bg_color',
			[
				'label' => esc_html__('Background Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-s3-top .topbar:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .header-s3-top .topbar:before' => 'border-left: 45px solid {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'address_item_border_color',
			[
				'label' => esc_html__('Shape Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-s3-top .topbar:before' => 'border-bottom: 45px solid {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'address_bg_right_color',
			[
				'label' => esc_html__('Background Right', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-s3-top .topbar' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Info Icons
		$this->start_controls_section(
			'address_icon_style',
			[
				'label' => esc_html__('Icon', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'address_icon_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-s3-top .topbar ul ll i a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'address_icon_bg_color',
			[
				'label' => esc_html__('BG Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-s3-top .topbar ul li i' => 'background-color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}} .header-s3-top .topbar ul li, .header-s3-top .topbar ul li',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-s3-top .topbar ul li a, .header-s3-top .topbar ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_line_color',
			[
				'label' => esc_html__('Line Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .header-s3-top .topbar ul li+li::after' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .header-s3-top .topbar ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Address widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$social_title = !empty($settings['social_title']) ? $settings['social_title'] : '';
		$addressItems_groups = !empty($settings['addressItems_groups']) ? $settings['addressItems_groups'] : [];
		$socialItems_groups = !empty($settings['socialItems_groups']) ? $settings['socialItems_groups'] : [];

		// Turn output buffer on

		ob_start(); ?>
		<div class="topbar">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col col-lg-8 col-sm-12 col-12">
						<div class="contact-intro">
							<ul>
								<?php
								// Group Param Output
								if (is_array($addressItems_groups) && !empty($addressItems_groups)) {
									foreach ($addressItems_groups as $each_item) {

										$address_title = !empty($each_item['address_title']) ? $each_item['address_title'] : '';

										$address_icon = !empty($each_item['address_icon']['value']) ? $each_item['address_icon']['value'] : '';
										$address_svg_url = !empty($each_item['address_icon']['value']['url']) ? $each_item['address_icon']['value']['url'] : '';
										$svg_alt = get_post_meta($address_svg_url, '_wp_attachment_image_alt', true);

										$address_link = !empty($each_item['address_link']) ? $each_item['address_link'] : '';

										if ($address_link) {
											$link_o = '<a href="' . $address_link . '" class="info-link">';
											$link_c = '</a>';
										} else {
											$link_o = '';
											$link_c = '';
										}

								?>
										<li>
											<?php
											if ($address_svg_url) {
												echo '<img class="default-icon"  src="' . esc_url($address_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
											} else {
												echo '<i class="' . esc_attr($address_icon) . '"></i><span></span>';
											}

											if ($address_title) {
												echo  $link_o . '' . esc_html($address_title) . '' . $link_c;
											}
											?>
										</li>
								<?php }
								} ?>
							</ul>
						</div>
					</div>
					<div class="col col-lg-4 col-sm-12 col-12">
						<div class="contact-info">
							<ul class="social clearfix">
								<?php

								// Group Param Output
								if (is_array($socialItems_groups) && !empty($socialItems_groups)) {
									foreach ($socialItems_groups as $each_item) {

										$social_icon = !empty($each_item['social_icon']['value']) ? $each_item['social_icon']['value'] : '';
										$social_link = !empty($each_item['social_link']) ? $each_item['social_link'] : '';
										if ($social_link) {
											$link_o = '<a href="' . $social_link . '" class="social-link">';
											$link_c = '</a>';
										} else {
											$link_o = '';
											$link_c = '';
										}

								?>
										<?php if ($social_icon) {
											echo '<li>' . $link_o . '<i class="' . esc_attr($social_icon) . '"></i>' . $link_c . '</li>';
										} ?>
								<?php }
								} ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Address widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Topbar_Address());
