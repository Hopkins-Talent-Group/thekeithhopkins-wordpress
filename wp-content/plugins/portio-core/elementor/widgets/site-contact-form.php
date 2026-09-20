<?php
/*
 * Elementor Portio Contact Form 7 Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Contact_Form extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_contact_form';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Contact Form', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-form-horizontal';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Contact Form widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
	public function get_script_depends() {
		return ['wpo-portio_contact_form'];
	}
	 */

	/**
	 * Register Portio Contact Form widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'section_contact_form',
			[
				'label' => esc_html__('Form Options', 'portio-core'),
			]
		);

		$this->add_control(
			'contact_style',
			[
				'label' => esc_html__('Contact Form Style', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'portio-core'),
					'style-two' => esc_html__('Style two', 'portio-core'),
					'style-three' => esc_html__('Style three', 'portio-core'),
					'style-four' => esc_html__('Style four', 'portio-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your Contact Form style.', 'portio-core'),
			]
		);

		$this->add_control(
			'contact_title',
			[
				'label' => esc_html__('Contact Title', 'portio-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'portio-core'),
				'label_off' => esc_html__('Hide', 'portio-core'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->add_control(
			'form_title',
			[
				'label' => esc_html__('Title', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Default title', 'portio-core'),
				'placeholder' => esc_html__('Type your title here', 'portio-core'),
			]
		);
		$this->add_control(
			'form_content',
			[
				'label' => esc_html__('Content', 'portio-core'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('Default content', 'portio-core'),
				'placeholder' => esc_html__('Type your content here', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'contactinfo_icon',
			[
				'label' => __('Icon', 'portio-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'eicon-envelope',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'contactinfo_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('24/7 customer support.', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'contactinfo_content',
			[
				'label' => esc_html__('Content', 'portio-core'),
				'default' => esc_html__('your content text', 'portio-core'),
				'placeholder' => esc_html__('Type your content here', 'portio-core'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$this->add_control(
			'contactinfoItems_groups',
			[
				'label' => esc_html__('Contactinfo Icons', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'contactinfo_title' => esc_html__('Contactinfo', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ contactinfo_title }}}',
			]
		);
		$this->add_control(
			'form_id',
			[
				'label' => esc_html__('Select contact form', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => Controls_Helper_Output::get_posts('wpcf7_contact_form'),
			]
		);
		$this->end_controls_section(); // end: Section

		// Sub Title
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__('Section Sub Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'portio_subtitle_typography',
				'selector' => '{{WRAPPER}} .section-top-content-s2 h2',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 h2' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => __('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Section Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'portio_title_typography',
				'selector' => '{{WRAPPER}} .section-top-content-s2 h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => __('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Info Style

		$this->start_controls_section(
			'info_icon_style',
			[
				'label' => esc_html__('Info Icon Box', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'info_icon_bg',
			[
				'label' => esc_html__('Bg Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-info .icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'info_icon_border',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-info .icon' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// info Title Style

		$this->start_controls_section(
			'info_title_style',
			[
				'label' => esc_html__('Info Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'info_title_typography',
				'selector' => '{{WRAPPER}} .contact-pg-section .contact-info .text h3',
			]
		);
		$this->add_control(
			'info_title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-info .text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'info_title_pad',
			[
				'label' => __('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-info .text h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content Style

		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__('Info Content', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'portio_content_typography',
				'selector' => '{{WRAPPER}} .contact-pg-section .contact-info .text p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-info .text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_pad',
			[
				'label' => __('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .contact-info .text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_form_style',
			[
				'label' => esc_html__('Form Styles', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'section_form_bg',
			[
				'label' => esc_html__('Form Box Bg Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'section_form_border',
			[
				'label' => esc_html__('Form Box Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'selector' => '{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="text"], 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="email"], 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="date"], 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="time"], 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="number"], 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form textarea, 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form select, 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form .form-control, 
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'label' => esc_html__('Border', 'portio-core'),
				'selector' => '{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="text"], 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="email"], 
				{{WRAPPER}} .contact-pg-section .contact-frominput[type="date"], 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="time"], 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="number"], 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form textarea, 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form select, 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form .form-control, 
				{{WRAPPER}} .contact-pg-section .wpo-contact-form .nice-select,
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',

			]
		);
		$this->add_control(
			'placeholder_text_color',
			[
				'label' => __('Placeholder Text Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form input:not([type="submit"])::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form input:not([type="submit"])::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form input:not([type="submit"])::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form input:not([type="submit"])::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form textarea::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form textarea::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form textarea::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form textarea::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace input::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace select::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'label_color',
			[
				'label' => __('Label Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form label' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="text"], 
					{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="email"], 
					{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="date"], 
					{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="time"], 
					{{WRAPPER}} .contact-pg-section .wpo-contact-form input[type="number"], 
					{{WRAPPER}} .contact-pg-section .wpo-contact-form textarea, 
					{{WRAPPER}} .contact-pg-section .wpo-contact-form select, 
					{{WRAPPER}} .contact-pg-section .wpo-contact-form .form-control, 
					{{WRAPPER}} .track-contact .track-trace input, 
					{{WRAPPER}} .contact-pg-section .wpo-contact-form .nice-select' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit',
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__('Width', 'portio-core'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'btn_margin',
			[
				'label' => __('Margin', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => __('Border Radius', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs('button_style');
		$this->start_controls_tab(
			'button_normal',
			[
				'label' => esc_html__('Normal', 'portio-core'),
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__('Background Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__('Border', 'portio-core'),
				'selector' => '{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit',
			]
		);
		$this->end_controls_tab();  // end:Normal tab

		$this->start_controls_tab(
			'button_hover',
			[
				'label' => esc_html__('Hover', 'portio-core'),
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_hover_color',
			[
				'label' => esc_html__('Background Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'label' => esc_html__('Border', 'portio-core'),
				'selector' => '{{WRAPPER}} .contact-pg-section .wpo-contact-form .wpcf7-form-control.wpcf7-submit:hover',
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Contact Form widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$contact_style = !empty($settings['contact_style']) ? $settings['contact_style'] : '';
		$form_id = !empty($settings['form_id']) ? $settings['form_id'] : '';
		$form_title = !empty($settings['form_title']) ? $settings['form_title'] : '';
		$form_content = !empty($settings['form_content']) ? $settings['form_content'] : '';
		$contact_title  = (isset($settings['contact_title']) && ('true' == $settings['contact_title'])) ? true : false;
		$contactinfoItems_groups = !empty($settings['contactinfoItems_groups']) ? $settings['contactinfoItems_groups'] : [];

		// Turn output buffer on
		ob_start(); ?>
		<?php if ($contact_style == 'style-one') { ?>
			<div class="contact-pg-section contact-section-s2" id="Contact">
				<div class="container">
					<div class="section-top-content-s2">
						<?php if ($contact_title) { ?>
							<?php
							if ($form_title) {
								echo '<h2 class="poort-text poort-in-right">' . esc_html($form_title) . '</h2>';
							}
							if ($form_content) {
								echo '<h3 class="poort-text poort-in-right">' . esc_html($form_content) . '</h3>';
							}
							?>
						<?php } ?>
					</div>
					<div class="row justify-content-center">
						<div class="col-lg-9 col-12">
							<div class="row">
								<?php
								$id = 0;
								// Group Param Output
								if (is_array($contactinfoItems_groups) && !empty($contactinfoItems_groups)) {
									foreach ($contactinfoItems_groups as $each_item) {
										$contactinfo_title = !empty($each_item['contactinfo_title']) ? $each_item['contactinfo_title'] : '';
										$contactinfo_content = !empty($each_item['contactinfo_content']) ? $each_item['contactinfo_content'] : '';
										$contactinfo_icon = !empty($each_item['contactinfo_icon']['value']) ? $each_item['contactinfo_icon']['value'] : '';
										$contactinfo_svg_url = !empty($each_item['contactinfo_icon']['value']['url']) ? $each_item['contactinfo_icon']['value']['url'] : '';
										$svg_alt = get_post_meta($contactinfo_svg_url, '_wp_attachment_image_alt', true);

								?>
										<div class="col-lg-4 col-md-6 col-12">
											<div class="contact-info">
												<div class="icon">
													<?php
													if ($contactinfo_svg_url) {
														echo '<img class="default-icon"  src="' . esc_url($contactinfo_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
													} else {
														echo '<i class="' . esc_attr($contactinfo_icon) . '"></i>';
													}
													?>
												</div>
												<div class="text">
													<?php
													if ($contactinfo_title) {
														echo '<h3>' . esc_html($contactinfo_title) . '</h3>';
													}
													if ($contactinfo_content) {
														echo wp_kses_post($contactinfo_content);
													}
													?>
												</div>
											</div>
										</div>
								<?php }
								} ?>
							</div>
							<div class="wpo-contact-form">
								<?php echo do_shortcode('[contact-form-7 id="' . $form_id . '"]'); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="shape">
					<svg width="471" height="540" viewBox="0 0 471 540" fill="none">
						<circle cx="201" cy="270" r="270" fill="url(#paint0_radial_56_18381)" fill-opacity="0.3" />
						<defs>
							<radialGradient id="paint0_radial_56_18381" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(201 270) rotate(90) scale(270)">
								<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8" />
								<stop offset="1" stop-color="#1B1C1E" stop-opacity="0" />
							</radialGradient>
						</defs>
					</svg>
				</div>
				<div class="shape-start">
					<svg width="136" height="136" viewBox="0 0 136 136" fill="none">
						<path d="M68 0L73.0672 42.5254L94.0225 5.17619L82.4302 46.4037L116.083 19.9167L89.5963 53.5698L130.824 41.9775L93.4746 62.9328L136 68L93.4746 73.0672L130.824 94.0225L89.5963 82.4302L116.083 116.083L82.4302 89.5963L94.0225 130.824L73.0672 93.4746L68 136L62.9328 93.4746L41.9775 130.824L53.5698 89.5963L19.9167 116.083L46.4037 82.4302L5.17619 94.0225L42.5254 73.0672L0 68L42.5254 62.9328L5.17619 41.9775L46.4037 53.5698L19.9167 19.9167L53.5698 46.4037L41.9775 5.17619L62.9328 42.5254L68 0Z" fill="#344400" />
					</svg>
				</div>
				<div class="shape-2">
					<svg width="471" height="540" viewBox="0 0 471 540" fill="none">
						<circle cx="201" cy="270" r="270" fill="url(#paint0_radial_56_18382)" fill-opacity="0.3" />
						<defs>
							<radialGradient id="paint0_radial_56_18382" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(201 270) rotate(90) scale(270)">
								<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8" />
								<stop offset="1" stop-color="#1B1C1E" stop-opacity="0" />
							</radialGradient>
						</defs>
					</svg>
				</div>
				<div class="shape-start-2">
					<svg width="136" height="136" viewBox="0 0 136 136" fill="none">
						<path d="M68 0L73.0672 42.5254L94.0225 5.17619L82.4302 46.4037L116.083 19.9167L89.5963 53.5698L130.824 41.9775L93.4746 62.9328L136 68L93.4746 73.0672L130.824 94.0225L89.5963 82.4302L116.083 116.083L82.4302 89.5963L94.0225 130.824L73.0672 93.4746L68 136L62.9328 93.4746L41.9775 130.824L53.5698 89.5963L19.9167 116.083L46.4037 82.4302L5.17619 94.0225L42.5254 73.0672L0 68L42.5254 62.9328L5.17619 41.9775L46.4037 53.5698L19.9167 19.9167L53.5698 46.4037L41.9775 5.17619L62.9328 42.5254L68 0Z" fill="#344400" />
					</svg>
				</div>
			</div>
		<?php } ?>
		<?php if ($contact_style == 'style-two') { ?>
			<div class="contact-pg-section">
				<?php if ($contact_title) { ?>
					<div class="wpo-contact-title">
						<?php
						if ($form_title) {
							echo '<h2>' . esc_html($form_title) . '</h2>';
						}
						if ($form_content) {
							echo '<p>' . esc_html($form_content) . '</p>';
						}
						?>
					</div>
				<?php } ?>
				<div class="wpo-contact-form">
					<?php echo do_shortcode('[contact-form-7 id="' . $form_id . '"]'); ?>
				</div>
			</div>
		<?php } ?>
		<?php if ($contact_style == 'style-three') { ?>
			<div class="contact-pg-section discuss-form">
				<?php if ($contact_title) { ?>
					<div class="wpo-contact-title">
						<?php
						if ($form_title) {
							echo '<h2>' . esc_html($form_title) . '</h2>';
						}
						if ($form_content) {
							echo '<p>' . esc_html($form_content) . '</p>';
						}
						?>
					</div>
				<?php } ?>
				<div class="wpo-contact-form">
					<?php echo do_shortcode('[contact-form-7 id="' . $form_id . '"]'); ?>
				</div>
			</div>
		<?php } ?>
		<?php if ($contact_style == 'style-four') { ?>
			<div class="contact-page-section">
				<!--   contacts-section -->
				<div class="contacts-section">
					<div class="container">
						<div class="row">
							<div class="col-lg-8 col-12">
								<div class="wpo-contact-form">
									<div class="title">
										<?php if ($contact_title) { ?>
											<?php
											if ($form_title) {
												echo '<h2>' . esc_html($form_title) . '</h2>';
											}
											if ($form_content) {
												echo '<span>' . esc_html($form_content) . '</span>';
											}
											?>
										<?php } ?>
									</div>
									<?php echo do_shortcode('[contact-form-7 id="' . $form_id . '"]'); ?>
								</div>
							</div>
							<div class="col-lg-4 col-12">
								<div class="contact-info-wrap">
									<ul>
										<?php
										// Group Param Output
										if (is_array($contactinfoItems_groups) && !empty($contactinfoItems_groups)) {
											foreach ($contactinfoItems_groups as $each_item) {
												$contactinfo_title = !empty($each_item['contactinfo_title']) ? $each_item['contactinfo_title'] : '';
												$contactinfo_content = !empty($each_item['contactinfo_content']) ? $each_item['contactinfo_content'] : '';
												$contactinfo_icon = !empty($each_item['contactinfo_icon']['value']) ? $each_item['contactinfo_icon']['value'] : '';
												$contactinfo_svg_url = !empty($each_item['contactinfo_icon']['value']['url']) ? $each_item['contactinfo_icon']['value']['url'] : '';
												$svg_alt = get_post_meta($contactinfo_svg_url, '_wp_attachment_image_alt', true);

										?>
												<li class="contact-info">
													<div class="icon">
														<?php
														if ($contactinfo_svg_url) {
															echo '<img class="default-icon"  src="' . esc_url($contactinfo_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
														} else {
															echo '<i class="' . esc_attr($contactinfo_icon) . '"></i>';
														}
														?>
													</div>
													<div class="content">
														<?php
														if ($contactinfo_title) {
															echo '<h3>' . esc_html($contactinfo_title) . '</h3>';
														}
														if ($contactinfo_content) {
															echo wp_kses_post($contactinfo_content);
														}
														?>
													</div>
												</li>
										<?php }
										} ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

<?php
		// Return outbut buffer
		echo ob_get_clean();
	}



	/**
	 * Render Contact Form widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Contact_Form());
