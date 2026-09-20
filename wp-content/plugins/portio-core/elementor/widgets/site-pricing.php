<?php
/*
 * Elementor Portio Pricing Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Grafco_Pricing extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_pricing';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Pricing', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-price-table';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Pricing widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_pricing'];
	}

	/**
	 * Register Portio Pricing widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_pricing',
			[
				'label' => esc_html__('Pricing Options', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'pricing_title',
			[
				'label' => esc_html__('Price Title', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Single Licence', 'portio-core'),
				'placeholder' => esc_html__('Type Price title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_amount',
			[
				'label' => esc_html__('Price Amount', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('33', 'portio-core'),
				'placeholder' => esc_html__('Type Price Amount here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'price_curency',
			[
				'label' => esc_html__('Price Curency', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('$', 'portio-core'),
				'placeholder' => esc_html__('Type Price Curency here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_plan',
			[
				'label' => esc_html__('Price Plan', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('/Per Month', 'portio-core'),
				'placeholder' => esc_html__('Type Price Plan here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'pricing_items',
			[
				'label' => esc_html__('Price Items', 'portio-core'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__('Price Items', 'portio-core'),
				'placeholder' => esc_html__('Type Price Items here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'portio-core'),
				'default' => esc_html__('button text', 'portio-core'),
				'placeholder' => esc_html__('Type button Text here', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$repeater->add_control(
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
			'pricingItems_groups',
			[
				'label' => esc_html__('Pricing Items', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'pricing_title' => esc_html__('Pricing', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ pricing_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'pricing-box_style',
			[
				'label' => esc_html__('Pricing Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'pricing-box_bg',
			[
				'label' => esc_html__('Box Bg', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pricing-box_border',
			[
				'label' => esc_html__('Box Border', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card, .pricing-card .top-content' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'pricing-box_padding',
			[
				'label' => __('Box Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .pricing-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .pricing-card .top-content> span',
			]
		);
		$this->add_control(
			'title_color_all',
			[
				'label' => esc_html__('Color All', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card .top-content> span' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .pricing-card .top-content> span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Price
		$this->start_controls_section(
			'section_price_style',
			[
				'label' => esc_html__('Price', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_price_typography',
				'selector' => '{{WRAPPER}} .pricing-card .top-content h2',
			]
		);
		$this->add_control(
			'price_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card .top-content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_padding',
			[
				'label' => __('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .pricing-card .top-content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Price item
		$this->start_controls_section(
			'section_price_item_style',
			[
				'label' => esc_html__('Price List Item', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_price_item_typography',
				'selector' => '{{WRAPPER}} .pricing-card .buttom-content ul li',
			]
		);
		$this->add_control(
			'price_item_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card .buttom-content ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_item_padding',
			[
				'label' => __('List Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .pricing-card .buttom-content ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Price Button
		$this->start_controls_section(
			'section_price_btn_style',
			[
				'label' => esc_html__('Price Button', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_price_btn_typography',
				'selector' => '{{WRAPPER}} .pricing-card .buttom-content a',
			]
		);
		$this->add_control(
			'price_btn_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card .buttom-content a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_btn_bg_color',
			[
				'label' => esc_html__('Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card .buttom-content a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_btn_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card .buttom-content a' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Price Button Hover
		$this->start_controls_section(
			'section_price_btn_hover_style',
			[
				'label' => esc_html__('Price Button Hover', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'price_btn_hover_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card .buttom-content a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'price_btn_bg_hover_color',
			[
				'label' => esc_html__('Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-card .buttom-content a::before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section
	}

	/**
	 * Render Pricing widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$pricingItems_groups = !empty($settings['pricingItems_groups']) ? $settings['pricingItems_groups'] : [];

		// Turn output buffer on
		ob_start();
?>


		<div class="pricing-section-s2">
			<div class="container">
				<div class="row">
					<?php 	// Group Param Output
					if (is_array($pricingItems_groups) && !empty($pricingItems_groups)) {
						foreach ($pricingItems_groups as $each_items) {

							$bg_image = !empty($each_items['bg_image']['id']) ? $each_items['bg_image']['id'] : '';
							$pricing_title = !empty($each_items['pricing_title']) ? $each_items['pricing_title'] : '';
							$pricing_amount = !empty($each_items['pricing_amount']) ? $each_items['pricing_amount'] : '';
							$pricing_plan = !empty($each_items['pricing_plan']) ? $each_items['pricing_plan'] : '';
							$price_curency = !empty($each_items['price_curency']) ? $each_items['price_curency'] : '';
							$pricing_items = !empty($each_items['pricing_items']) ? $each_items['pricing_items'] : '';

							$button_text = !empty($each_items['btn_text']) ? $each_items['btn_text'] : '';
							$button_link = !empty($each_items['btn_link']['url']) ? $each_items['btn_link']['url'] : '';
							$button_link_external = !empty($each_items['btn_link']['is_external']) ? 'target="_blank"' : '';
							$button_link_nofollow = !empty($each_items['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
							$button_link_attr = !empty($button_link) ?  $button_link_external . ' ' . $button_link_nofollow : '';

							$pricing_button = $button_link ? '<a class="theme-btn" href="' . esc_url($button_link) . '" ' . $button_link_attr . ' class="theme-btn-s4" >' . esc_html($button_text) . '</a>' : '';

					?>
							<div class="col-lg-4 col-md-6 scroll-text-animation" data-animation="fade_from_bottom">
								<div class="pricing-card">
									<div class="top-content">
										<?php
										if ($pricing_title) {
											echo '<span>' . esc_html($pricing_title) . '</span>';
										}
										?>
										<?php
										if ($pricing_amount) {
											echo '<h2>' . esc_html($price_curency) . esc_html($pricing_amount) . '<span>' . esc_html($pricing_plan) .'</h2>';
										}
										?>
									</div>
									<div class="buttom-content">
										<?php
										if ($pricing_items) {
											echo wp_kses_post($pricing_items);
										}
										?>
										<?php echo $pricing_button;  ?>
									</div>
								</div>
							</div>
					<?php }
					} ?>
				</div>
			</div>
			<div class="shape">
				<svg width="352" height="352" viewBox="0 0 352 352" fill="none">
					<circle cx="176" cy="176" r="176" fill="url(#paint0_radial_56_1808)" fill-opacity="0.4" />
					<defs>
						<radialGradient id="paint0_radial_56_1808" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(176 176) rotate(90) scale(176)">
							<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8" />
							<stop offset="1" stop-color="#1B1C1E" stop-opacity="0" />
						</radialGradient>
					</defs>
				</svg>
			</div>
		</div>

		<div class="price-section">
			<div class="container">
				<div class="price-wrap">
					<div class="row">

					</div>
				</div>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Pricing widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Grafco_Pricing());
