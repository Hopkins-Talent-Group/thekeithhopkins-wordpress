<?php
/*
 * Elementor Portio CTA Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_CTA extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_cta';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('CTA', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-call-to-action';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio CTA widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
	public function get_script_depends() {
		return ['wpo-portio_cta'];
	}
	*/

	/**
	 * Register Portio CTA widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_CTA',
			[
				'label' => esc_html__('CTA Options', 'portio-core'),
			]
		);
		$this->add_control(
			'cta_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button/Link Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Button Text', 'portio-core'),
				'placeholder' => esc_html__('Type btn text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__('Button Link', 'portio-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'cta_image',
			[
				'label' => esc_html__('CTA Bg Image 1', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$this->add_control(
			'cta_image2',
			[
				'label' => esc_html__('CTA  Bg Image 2', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
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
				'name' => 'portio_title_typography',
				'selector' => '{{WRAPPER}}  .trail-section .content h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .trail-section .content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .trail-section .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Button
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' => __('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .trail-section .trail-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .trail-section .trail-btn a, 
						{{WRAPPER}} .trail-section .trail-btn a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => esc_html__('Background', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .trail-section .trail-btn a:after',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background Color', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_border',
				'label' => esc_html__('Border', 'portio-core'),
				'selector' => '{{WRAPPER}} .trail-section .trail-btn a',
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
					'{{WRAPPER}} .trail-section .trail-btn a:hover,
						{{WRAPPER}} .trail-section .trail-btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_hover_color',
				'label' => esc_html__('Hover Background', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .trail-section .trail-btn a:hover',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background Color', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'button_hover_border',
				'label' => esc_html__('Border', 'portio-core'),
				'selector' => '{{WRAPPER}} .trail-section .trail-btn a:hover ',
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render CTA widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$cta_title = !empty($settings['cta_title']) ? $settings['cta_title'] : '';

		$btn_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';

		$btn_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$btn_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty($btn_link) ?  $btn_external . ' ' . $btn_nofollow : '';

		$button = $btn_link ? '<a href="' . esc_url($btn_link) . '" ' . esc_attr($btn_link_attr) . ' >' . esc_html($btn_text) . '<i class="ti-arrow-right"></i> </a>' : '';

		$bg_image = !empty($settings['cta_image']['id']) ? $settings['cta_image']['id'] : '';
		$bg_image2 = !empty($settings['cta_image2']['id']) ? $settings['cta_image2']['id'] : '';

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

		// Turn output buffer on
		ob_start(); ?>
		<div class="trail-section">
			<div class="tril-bg-1" <?php echo $bg_url; ?>></div>
			<div class="tril-bg-2" <?php echo $bg_url2; ?>></div>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-lg-6 col-12">
						<div class="content">
							<?php
							if ($cta_title) {
								echo '<h2>' . esc_html($cta_title) . '</h2>';
							}
							?>
						</div>
					</div>
					<div class="col-lg-6 col-12">
						<div class="trail-btn">
							<?php
								echo $button;
							?>
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
	 * Render CTA widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_CTA());
