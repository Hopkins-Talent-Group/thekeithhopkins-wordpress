<?php
/*
 * Elementor Portio Testimonial Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Grafco_Testimonial extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_testimonial';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Testimonial', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-testimonial';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Testimonial widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_testimonial'];
	}

	/**
	 * Register Portio Testimonial widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => esc_html__('Testimonial Options', 'portio-core'),
			]
		);

		$this->add_control(
			'testimonial_style',
			[
				'label' => esc_html__('Testimonial Style', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'portio-core'),
					'style-two' => esc_html__('Style two', 'portio-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your Testimonial style.', 'portio-core'),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'bg_image',
			[
				'label' => esc_html__('Testimonial Image', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);
		$repeater->add_control(
			'testimonial_title',
			[
				'label' => esc_html__('Testimonial Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_subtitle',
			[
				'label' => esc_html__('Testimonial Sub Title', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Testimonial Sub Title', 'portio-core'),
				'placeholder' => esc_html__('Type testimonial Sub title here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_content',
			[
				'label' => esc_html__('Testimonial Content', 'portio-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Testimonial Content', 'portio-core'),
				'placeholder' => esc_html__('Type testimonial Content here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_icon',
			[
				'label' => __('Icon', 'portio-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'eicon-blockquote',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'testimonialItems_groups',
			[
				'label' => esc_html__('Testimonial Items', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'testimonial_title' => esc_html__('Testimonial', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ testimonial_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section

		
		// Testimonial Name Style 
		$this->start_controls_section(
			'testimonials_item_style',
			[
				'label' => esc_html__('Testimonial Item Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'testimonials_item_bg_color',
			[
				'label' => esc_html__('Item BG Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_item_border_color',
			[
				'label' => esc_html__('Item Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_quote_bg_color',
			[
				'label' => esc_html__('Quote BG Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card .icon' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_quote_border_color',
			[
				'label' => esc_html__('Quote Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card .icon' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_item_padding',
			[
				'label' => __('Item Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Testimonial Name Style 
		$this->start_controls_section(
			'testimonials_section_name_style',
			[
				'label' => esc_html__('Testimonial Name', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'testimonials_portio_name_typography',
				'selector' => '{{WRAPPER}}  .portio-testimonial .testimonial-card .top-content .text h3',
			]
		);
		$this->add_control(
			'testimonials_name_color',
			[
				'label' => esc_html__('Name Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card .top-content .text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_name_padding',
			[
				'label' => __('Name Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card .top-content .text h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Testimonial Title 
		$this->start_controls_section(
			'testimonials_title_style',
			[
				'label' => esc_html__('Testimonial Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'testimonials_title_typography',
				'selector' => '{{WRAPPER}}  .portio-testimonial .testimonial-card .top-content .text span',
			]
		);
		$this->add_control(
			'testimonials_title_color',
			[
				'label' => esc_html__('Name Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card .top-content .text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_title_padding',
			[
				'label' => __('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card .top-content .text span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Testimonial Title 
		$this->start_controls_section(
			'testimonials_content_style',
			[
				'label' => esc_html__('Testimonial Content', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'testimonials_content_typography',
				'selector' => '{{WRAPPER}}  .portio-testimonial .testimonial-card p',
			]
		);
		$this->add_control(
			'testimonials_content_color',
			[
				'label' => esc_html__('Content Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_content_padding',
			[
				'label' => __('Content Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .testimonial-card p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Testimonial Arrow 
		$this->start_controls_section(
			'testimonials_arrow_style',
			[
				'label' => esc_html__('Testimonial Arrow', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'testimonials_arrow-bg_color',
			[
				'label' => esc_html__('Arrow Bg Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .slick-prev, .portio-testimonial .slick-next' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_arrow_color',
			[
				'label' => esc_html__('Arrow Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .slick-prev:before, .portio-testimonial .slick-next:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_bg_hover_color',
			[
				'label' => esc_html__('Arrow Hover Bg Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .slick-prev:hover, .portio-testimonial .slick-next:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'testimonials_arrow_hover_color',
			[
				'label' => esc_html__('Arrow Hover Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-testimonial .slick-prev:hover:before, .portio-testimonial .slick-next:hover:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Testimonial widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$testimonialItems_groups = !empty($settings['testimonialItems_groups']) ? $settings['testimonialItems_groups'] : [];
		$testimonial_style = !empty($settings['testimonial_style']) ? $settings['testimonial_style'] : '';

		if ($testimonial_style == 'style-one') {
			$testimonial_wrapper = 'testimonial-section-s3';
			$slideActive = 'testimonial-slider';
			$container = 'container';
		} else {
			$testimonial_wrapper = 'testimonial-section-s2';
			$slideActive = 'testimonial-slider-s2';
			$container = 'container-fluid';
		}

		// Turn output buffer on
		ob_start(); ?>
		<div class="portio-testimonial <?php echo esc_attr($testimonial_wrapper); ?>" id="testimonial">
			<div class="<?php echo esc_attr($container); ?>">
				<div class="<?php echo esc_attr($slideActive); ?>">
					<?php 	// Group Param Output
					if (is_array($testimonialItems_groups) && !empty($testimonialItems_groups)) {
						foreach ($testimonialItems_groups as $each_items) {

							$testimonial_title = !empty($each_items['testimonial_title']) ? $each_items['testimonial_title'] : '';
							$testimonial_subtitle = !empty($each_items['testimonial_subtitle']) ? $each_items['testimonial_subtitle'] : '';
							$testimonial_content = !empty($each_items['testimonial_content']) ? $each_items['testimonial_content'] : '';
							$testimonial_icon = !empty($each_items['testimonial_icon']['value']) ? $each_items['testimonial_icon']['value'] : '';
							$testimonial_svg_url = !empty($each_items['testimonial_icon']['value']['url']) ? $each_items['testimonial_icon']['value']['url'] : '';
							$svg_alt = get_post_meta($testimonial_svg_url, '_wp_attachment_image_alt', true);

							$image_url = wp_get_attachment_url($each_items['bg_image']['id']);
							$image_alt = get_post_meta($each_items['bg_image']['id'], '_wp_attachment_image_alt', true);

					?>
							<div class="testimonial-card">
								<div class="top-content">
									<div class="image">
										<?php if ($image_url) {
											echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
										} ?>
									</div>
									<div class="text">
										<?php
										if ($testimonial_title) {
											echo '<h3>' . esc_html($testimonial_title) . '</h3>';
										}
										if ($testimonial_subtitle) {
											echo '<span>' . esc_html($testimonial_subtitle) . '</span>';
										}
										?>
									</div>
								</div>
								<?php if ($testimonial_content) {
									echo '<p>' . esc_html($testimonial_content) . '</p>';
								} ?>

								<div class="icon">
									<?php
									if ($testimonial_svg_url) {
										echo '<img class="default-icon"  src="' . esc_url($testimonial_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
									} else {
										echo '<i class="' . esc_attr($testimonial_icon) . '"></i>';
									}
									?>
								</div>
							</div>
					<?php }
					} ?>
				</div>
			</div>
			<div class="shape">
				<svg width="319" height="416" viewBox="0 0 319 416" fill="none">
					<circle cx="208" cy="208" r="208" fill="url(#paint0_radial_56_1807)" fill-opacity="0.4" />
					<defs>
						<radialGradient id="paint0_radial_56_1807" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(208 208) rotate(90) scale(208)">
							<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8" />
							<stop offset="1" stop-color="#1B1C1E" stop-opacity="0" />
						</radialGradient>
					</defs>
				</svg>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Testimonial widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Grafco_Testimonial());
