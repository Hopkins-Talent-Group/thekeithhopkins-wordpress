<?php
/*
 * Elementor Portio Funfact Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Grafco_Funfact extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_funfact';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Funfact', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-counter';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Funfact widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_funfact'];
	}

	/**
	 * Register Portio Funfact widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'section_funfact',
			[
				'label' => esc_html__('Funfact Options', 'portio-core'),
			]
		);
		$this->add_control(
			'funfact_style',
			[
				'label' => esc_html__('Funfact Style', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'portio-core'),
					'style-two' => esc_html__('Style two', 'portio-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your Funfact style.', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'feature_icon',
			[
				'label' => __('Icon', 'portio-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'eicon-counter',
					'library' => 'solid',
				],
			]
		);
		$repeater->add_control(
			'funfact_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'funfact_number',
			[
				'label' => esc_html__('Funfact Number', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('250', 'portio-core'),
				'placeholder' => esc_html__('Type funfact Number here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'funfact_plus',
			[
				'label' => esc_html__('Funfact Plus/Percentage', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('+', 'portio-core'),
				'placeholder' => esc_html__('Type funfact Plus/Percentage here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'funfactItems_groups',
			[
				'label' => esc_html__('Funfact Items', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'funfact_title' => esc_html__('Funfact', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ funfact_title }}}',
			]
		);
		$this->add_control(
			'funfact_image',
			[
				'label' => esc_html__('Funfact Bg Image 1', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'condition' => [
					'funfact_style' => array('style-two'),
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$this->add_control(
			'funfact_image2',
			[
				'label' => esc_html__('Funfact  Bg Image 2', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'condition' => [
					'funfact_style' => array('style-two'),
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$this->end_controls_section(); // end: Section


		// Funfact Number
		$this->start_controls_section(
			'funfact_number_style',
			[
				'label' => esc_html__('Number', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_number_typography',
				'selector' => '{{WRAPPER}} .portio-funfact .feature-item .content h2',
			]
		);
		$this->add_control(
			'funfact_item_number_color',
			[
				'label' => esc_html__('Number Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-funfact .feature-item .content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'number_padding',
			[
				'label' => __('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-funfact .feature-item .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Funfact Title
		$this->start_controls_section(
			'funfact_title_style',
			[
				'label' => esc_html__('Funfact Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_funfact_title_typography',
				'selector' => '{{WRAPPER}} .portio-funfact .feature-item .content h5',
			]
		);
		$this->add_control(
			'funfact_title',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-funfact .feature-item .content h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_title_padding',
			[
				'label' => __('Number Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-funfact .feature-item .content h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section
	}

	/**
	 * Render Funfact widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$funfact_style = !empty($settings['funfact_style']) ? $settings['funfact_style'] : [];
		$funfactItems_groups = !empty($settings['funfactItems_groups']) ? $settings['funfactItems_groups'] : [];
		$bg_image = !empty($settings['funfact_image']['id']) ? $settings['funfact_image']['id'] : '';
		$bg_image2 = !empty($settings['funfact_image2']['id']) ? $settings['funfact_image2']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);
		// Image
		$image2_url = wp_get_attachment_url($bg_image2);
		$image2_alt = get_post_meta($bg_image2, '_wp_attachment_image_alt', true);

		if ($image_url) {
			$bg_url = ' style="';
			$bg_url .= ($image_url) ? 'background-image: url( ' . esc_url($image_url) . ' );' : '';
			$bg_url .= '"';
		} else {
			$bg_url = '';
		}
		if ($image2_url) {
			$bg_url2 = ' style="';
			$bg_url2 .= ($image2_url) ? 'background-image: url( ' . esc_url($image2_url) . ' );' : '';
			$bg_url2 .= '"';
		} else {
			$bg_url2 = '';
		}

		if ($funfact_style == 'style-one') {
			$funfact_wrapper = 'feature-section';
		} else {
			$funfact_wrapper = 'feature-section-s2';
		}


		// Turn output buffer on
		ob_start(); ?>
		<div class="portio-funfact <?php echo esc_attr($funfact_wrapper); ?>">
			<?php if ($funfact_style == 'style-two') { ?>
				<div class="tril-bg-1" <?php echo $bg_url; ?>></div>
				<div class="tril-bg-2" <?php echo $bg_url2; ?>></div>
			<?php } ?>
			<div class="container">
				<div class="row">
					<?php 	// Group Param Output
					if (is_array($funfactItems_groups) && !empty($funfactItems_groups)) {
						foreach ($funfactItems_groups as $each_item) {
							$funfact_title = !empty($each_item['funfact_title']) ? $each_item['funfact_title'] : '';
							$funfact_number = !empty($each_item['funfact_number']) ? $each_item['funfact_number'] : '';
							$funfact_plus = !empty($each_item['funfact_plus']) ? $each_item['funfact_plus'] : '';
							$feature_icon = !empty($each_item['feature_icon']['value']) ? $each_item['feature_icon']['value'] : '';
							$feature_svg_url = !empty($each_item['feature_icon']['value']['url']) ? $each_item['feature_icon']['value']['url'] : '';
							$svg_alt = get_post_meta($feature_svg_url, '_wp_attachment_image_alt', true);
					?>
							<div class="col-lg-4 col-md-6 col-12">
								<div class="feature-item scroll-text-animation" data-animation="fade_from_bottom">
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
										if ($funfact_number) {
											echo '<h2><span class="odometer" data-count="' . esc_attr($funfact_number) . '">' . esc_html__('00', 'portio-core') . '</span>' . esc_html($funfact_plus) . '</h2>';
										}
										if ($funfact_title) {
											echo '<h5>' . esc_html__($funfact_title) . '</h5>';
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
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Funfact widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Grafco_Funfact());
