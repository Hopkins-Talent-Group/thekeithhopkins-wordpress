<?php
/*
 * Elementor Portio marquee Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Portio_Marquee extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_marquee';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Marquee', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-marquee-bar';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Marqee widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_marquee'];
	}

	/**
	 * Register Portio Marqee widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'section_marquee',
			[
				'label' => esc_html__('marquee Options', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'marquee_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'marquee_image',
			[
				'label' => esc_html__('Marquee Image', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$this->add_control(
			'marqueeItems_groups',
			[
				'label' => esc_html__('marquee Items', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'marquee_title' => esc_html__('Marquee', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ marquee_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		// marquee Stroke Color
		$this->start_controls_section(
			'marquee_stroke_style',
			[
				'label' => esc_html__('Marquee Box Color', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'marquee_item_bg_color',
			[
				'label' => esc_html__('Marquee BG Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-text-slider-s2' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'marquee_item_border_color',
			[
				'label' => esc_html__('Marquee Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-text-slider-s2' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// marquee Title
		$this->start_controls_section(
			'marquee_title_style',
			[
				'label' => esc_html__('marquee Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_marquee_title_typography',
				'selector' => '{{WRAPPER}} .hero-text-slider-s2 .item span',
			]
		);
		$this->add_control(
			'marquee_title',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-text-slider-s2 .item span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'marquee_title_padding',
			[
				'label' => __('Number Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .hero-text-slider-s2 .item span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render marquee widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$marqueeItems_groups = !empty($settings['marqueeItems_groups']) ? $settings['marqueeItems_groups'] : [];

		// Turn output buffer on
		ob_start(); ?>
		<div class="hero-text-slider-s2">
			<?php 	// Group Param Output
			if (is_array($marqueeItems_groups) && !empty($marqueeItems_groups)) {
				foreach ($marqueeItems_groups as $each_item) {
					$marquee_title = !empty($each_item['marquee_title']) ? $each_item['marquee_title'] : '';
					$marquee_image = !empty($each_item['marquee_image']['id']) ? $each_item['marquee_image']['id'] : '';
					// Image
					$image_url = wp_get_attachment_url($marquee_image);
					$image_alt = get_post_meta($marquee_image, '_wp_attachment_image_alt', true);
			?>

					<div class="item">
						<span><?php if ($marquee_title) {
									echo esc_html__($marquee_title);
								} ?> <?php if ($image_url) {
											echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
										}  ?></span>
					</div>

			<?php
				}
			}
			?>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render marquee widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Portio_Marquee());
