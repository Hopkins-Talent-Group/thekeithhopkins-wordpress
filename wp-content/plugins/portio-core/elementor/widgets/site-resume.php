<?php
/*
 * Elementor Portio Resume Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Resume extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_resume';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Resume', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-person';
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
		return ['wpo-portio_resume'];
	}

	/**
	 * Register Portio Feature widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_resume',
			[
				'label' => esc_html__('Resume Options', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'resume_icon',
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
			'resume_top_title',
			[
				'label' => esc_html__('Top Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('2020 - Present', 'portio-core'),
				'placeholder' => esc_html__('Type Top title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'resume_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Business Strategy', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'resume_content',
			[
				'label' => esc_html__('Content Text', 'portio-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('ABC Design Agency, London', 'portio-core'),
				'placeholder' => esc_html__('Type Content text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'resume_link',
			[
				'label' => esc_html__('link', 'portio-core'),
				'default' => esc_html__('#', 'portio-core'),
				'placeholder' => esc_html__('Type your link here', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'resumeItems_groups',
			[
				'label' => esc_html__('Feature', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'resume_title' => esc_html__('Feature', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ resume_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		// Top Title
		$this->start_controls_section(
			'top_title_style',
			[
				'label' => esc_html__('Top Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'top_title_typography',
				'selector' => '{{WRAPPER}} .resume-content .item span',
			]
		);
		$this->add_control(
			'top_title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .resume-content .item span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'top_title_padding',
			[
				'label' => __('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .resume-content .item span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .resume-content .item h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .resume-content .item h2' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .resume-content .item h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .resume-content .item p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .resume-content .item p' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .resume-content .item p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Resume widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$resumeItems_groups = !empty($settings['resumeItems_groups']) ? $settings['resumeItems_groups'] : [];


		ob_start(); ?>


		<?php { ?>
			<div class="resume-section-s2" id="Resume">
				<div class="resume-content">
					<?php

					// Group Param Output
					if (is_array($resumeItems_groups) && !empty($resumeItems_groups)) {
						foreach ($resumeItems_groups as $each_item) {

							$resume_top_title = !empty($each_item['resume_top_title']) ? $each_item['resume_top_title'] : '';
							$resume_title = !empty($each_item['resume_title']) ? $each_item['resume_title'] : '';
							$resume_content = !empty($each_item['resume_content']) ? $each_item['resume_content'] : '';
							$resume_icon = !empty($each_item['resume_icon']['value']) ? $each_item['resume_icon']['value'] : '';
							$resume_svg_url = !empty($each_item['resume_icon']['value']['url']) ? $each_item['resume_icon']['value']['url'] : '';
							$svg_alt = get_post_meta($resume_svg_url, '_wp_attachment_image_alt', true);


					?>
							<div class="item scroll-text-animation" data-animation="fade_from_right">
								<div class="line-border"></div>
								<div class="top-arrow">
									<?php
									if ($resume_svg_url) {
										echo '<img src="' . esc_url($resume_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
									} else {
										echo '<i class="' . esc_attr($resume_icon) . '"></i>';
									}
									?>
								</div>
								<?php
								if ($resume_top_title) {
									echo '<span>' . esc_html($resume_top_title) . '</span>';
								}
								if ($resume_title) {
									echo '<h2>' . esc_html($resume_title) . '</h2>';
								}
								if ($resume_content) {
									echo '<p>' . esc_html($resume_content) . '</p>';
								}
								?>
							</div>
					<?php
						}
					}
					?>
				</div>
				<div class="shape">
					<svg width="406" height="750" viewBox="0 0 406 750" fill="none">
						<circle cx="375" cy="375" r="375" fill="url(#paint0_radial_56_1804)" fill-opacity="0.4" />
						<defs>
							<radialGradient id="paint0_radial_56_1804" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(375 375) rotate(90) scale(375)">
								<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8" />
								<stop offset="1" stop-color="#1B1C1E" stop-opacity="0" />
							</radialGradient>
						</defs>
					</svg>
				</div>
			</div>
<?php }
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Resume widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Resume());
