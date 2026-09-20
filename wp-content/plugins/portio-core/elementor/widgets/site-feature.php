<?php
/*
 * Elementor Portio Feature Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Feature extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_feature';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Feature', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-icon-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Feature widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_feature'];
	}

	/**
	 * Register Portio Feature widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_feature',
			[
				'label' => esc_html__('Feature Options', 'portio-core'),
			]
		);
		$this->add_control(
			'feature_style',
			[
				'label' => esc_html__('Feature Style', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'portio-core'),
					'style-two' => esc_html__('Style two', 'portio-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your hero style.', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'feature_icon',
			[
				'label' => __('Icon', 'portio-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fi flaticon-charity',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'feature_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Business Strategy', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'feature_content',
			[
				'label' => esc_html__('Content Text', 'portio-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Nam ornare ultricies scelerisque habitant. Netus volutpat faucibus pharetra dui blandit.', 'portio-core'),
				'placeholder' => esc_html__('Type Content text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'feature_link',
			[
				'label' => esc_html__('link', 'portio-core'),
				'default' => esc_html__('#', 'portio-core'),
				'placeholder' => esc_html__('Type your link here', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'featureItems_groups',
			[
				'label' => esc_html__('Feature', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'feature_title' => esc_html__('Feature', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ feature_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		$this->start_controls_section(
			'section_feature_section_style',
			[
				'label' => esc_html__('Body Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'feature_item_bg_color',
			[
				'label' => esc_html__('Background Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-feature-section' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Box
		$this->start_controls_section(
			'feature_box_style',
			[
				'label' => esc_html__('box Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'feature_box_border_radius',
			[
				'label' => __('Border Radius', 'manit-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-feature-section .feature-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'box_bg_color',
			[
				'label' => esc_html__('Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-feature-section .feature-card' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-feature-section .feature-card' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'box_bg__padding',
			[
				'label' => __('box Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-feature-section .feature-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .portio-feature-section .feature-card .content h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-feature-section .feature-card .content h3' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .portio-feature-section .feature-card .content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__('Content', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .portio-feature-section .feature-card .content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-feature-section .feature-card .content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => __('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-feature-section .feature-card .content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Feature widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$featureItems_groups = !empty($settings['featureItems_groups']) ? $settings['featureItems_groups'] : [];


		ob_start(); ?>


		<?php { ?>
			<div class="portio-feature-section feature-section-s3">
				<div class="container-fluid">
					<div class="row">
						<?php

						// Group Param Output
						if (is_array($featureItems_groups) && !empty($featureItems_groups)) {
							foreach ($featureItems_groups as $each_item) {

								$feature_title = !empty($each_item['feature_title']) ? $each_item['feature_title'] : '';
								$feature_content = !empty($each_item['feature_content']) ? $each_item['feature_content'] : '';

								$feature_icon = !empty($each_item['feature_icon']['value']) ? $each_item['feature_icon']['value'] : '';
								$feature_svg_url = !empty($each_item['feature_icon']['value']['url']) ? $each_item['feature_icon']['value']['url'] : '';
								$svg_alt = get_post_meta($feature_svg_url, '_wp_attachment_image_alt', true);


						?>
								<div class="col-xl-3 col-md-6 col-12 scroll-text-animation" data-animation="fade_from_bottom">
									<div class="feature-card">
										<div class="icon">
											<?php
											if ($feature_svg_url) {
												echo '<img class="default-icon"  src="' . esc_url($feature_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
											} else {
												echo '<i class="' . esc_attr($feature_icon) . '"></i>';
											}
											?>
										</div>
										<div class="content">
											<?php
											if ($feature_title) {
												echo '<h3>' . esc_html($feature_title) . '</h3>';
											}
											if ($feature_content) {
												echo '<p>' . esc_html($feature_content) . '</p>';
											}
											?>
										</div>
									</div>
								</div>
						<?php
							}
						}
						?>

					</div>
				</div>
			</div>
<?php }
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Feature widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Feature());
