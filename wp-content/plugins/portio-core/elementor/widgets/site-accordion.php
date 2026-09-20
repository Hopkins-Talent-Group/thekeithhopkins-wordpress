<?php
/*
 * Elementor Portio Accordion  Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Grafco_Accordion  extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_accordion';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Accordion ', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-accordion';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Accordion  widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_accordion'];
	}

	/**
	 * Register Portio Accordion  widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_accordion',
			[
				'label' => esc_html__('Accordion  Options', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'active_tabs',
			[
				'label' => __('Active Accordion', 'portio-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'portio-core'),
				'label_off' => __('Hide', 'portio-core'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$repeater->add_control(
			'accordion_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'accordion_content',
			[
				'label' => esc_html__('Content Text', 'portio-core'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__('Content Text', 'portio-core'),
				'placeholder' => esc_html__('Type content text here', 'portio-core'),
				'label_block' => true,
			]
		);

		$this->add_control(
			'accordionItems_groups',
			[
				'label' => esc_html__('Accordion  Items', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'accordion_title' => esc_html__('Accordion ', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ accordion_title }}}',
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
				'selector' => '{{WRAPPER}} .theme-accordion .accordion .accordion-item h2 button',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-accordion .accordion .accordion-item h2 button' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__('BG Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-accordion .accordion .accordion-item h2 button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_br_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-accordion .accordion .accordion-item' => 'border-left-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .theme-accordion .accordion .accordion-item h2 button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Accordion Content
		$this->start_controls_section(
			'section_accordion_content_style',
			[
				'label' => esc_html__('Accordion Content', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_accordion_content_typography',
				'selector' => '{{WRAPPER}} .theme-accordion .accordion .accordion-body p',
			]
		);
		$this->add_control(
			'accordion_content_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-accordion .accordion .accordion-body p' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'accordion_content_bg_color',
			[
				'label' => esc_html__('BG Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-accordion .accordion .accordion-body' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'accordion_br_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .theme-accordion .accordion .accordion-body' => 'border-top-color: {{VALUE}};'
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Button
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'portio-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .theme-btn-s2, 
				{{WRAPPER}} .theme-btn-s2',
			]
		);
		$this->add_responsive_control(
			'button_min_width',
			[
				'label' => esc_html__( 'Width', 'portio-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 700,
						'step' => 1,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .theme-btn-s2' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'portio-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'btn_style' => array('style-one'),
				],
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .theme-btn-s2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'portio-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'btn_style' => array('style-one'),
				],
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .theme-btn-s2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'button_style' );
			$this->start_controls_tab(
				'button_normal',
				[
					'label' => esc_html__( 'Normal', 'portio-core' ),
				]
			);
			$this->add_control(
				'button_color',
				[
					'label' => esc_html__( 'Color', 'portio-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .theme-btn-s2' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'portio-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .theme-btn-s2' => 'background-color: {{VALUE}};'
					],
				]
			);
			$this->add_control(
				'link_border_color',
				[
					'label' => esc_html__( 'Link Border Color', 'portio-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .theme-btn-s2' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'portio-core' ),
					'selector' => '{{WRAPPER}} .theme-btn-s2',
				]
			);
			$this->end_controls_tab();  // end:Normal tab
			
			$this->start_controls_tab(
				'button_hover',
				[
					'label' => esc_html__( 'Hover', 'portio-core' ),
				]
			);
			$this->add_control(
				'button_hover_color',
				[
					'label' => esc_html__( 'Color', 'portio-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .theme-btn-s2:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_hover_color',
				[
					'label' => esc_html__( 'Background Color', 'portio-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .theme-btn-s2:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'link_border_hover_color',
				[
					'label' => esc_html__( 'Link Border Color', 'portio-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .theme-btn-s2:hover' => 'border-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_hover_border',
					'label' => esc_html__( 'Border', 'portio-core' ),
					'selector' => '{{WRAPPER}} .theme-btn-s2:hover ',
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs


	}

	/**
	 * Render Accordion  widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$accordionItems_groups = !empty($settings['accordionItems_groups']) ? $settings['accordionItems_groups'] : [];

		$btn_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';

		$btn_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$btn_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty($btn_link) ?  $btn_external . ' ' . $btn_nofollow : '';

		$button = $btn_link ? '<a href="' . esc_url($btn_link) . '" ' . esc_attr($btn_link_attr) . ' class="theme-btn-s2" >' . esc_html($btn_text) . '</a>' : '';

		// Turn output buffer on
		ob_start();
?>
		<div class="faq-section">
			<div class="container">
				<div class="faq-wrap">
					<div class="row g-0 justify-content-center">
						<div class="col-lg-8 col-12">
							<div class="accordion" id="accordionExample">
								<?php 	// Group Param Output
								if (is_array($accordionItems_groups) && !empty($accordionItems_groups)) {
									$id = 1;
									foreach ($accordionItems_groups as $each_items) {
										$id++;
										$accordion_title = !empty($each_items['accordion_title']) ? $each_items['accordion_title'] : '';
										$accordion_content = !empty($each_items['accordion_content']) ? $each_items['accordion_content'] : '';
										$active_tabs = !empty($each_items['active_tabs']) ? $each_items['active_tabs'] : '';

										if ($active_tabs == 'yes') {
											$active_class = 'show';
											$heade_class = '';
										} else {
											$active_class = '';
											$heade_class = 'collapsed';
										}

								?>
										<div class="accordion-item">
											<?php if ($accordion_title) {
												echo '<h2 class="accordion-header" id="heading' . esc_attr($id) . '">
													<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . esc_attr($id) . '" aria-expanded="true" aria-controls="collapse' . esc_attr($id) . '">
													' . esc_html($accordion_title) . '
													</button>
													</h2>';
											}
											if ($accordion_content) { ?>
												<div id="collapse<?php echo esc_attr($id); ?>" class="accordion-collapse collapse <?php echo esc_attr($active_class); ?>" aria-labelledby="heading<?php echo esc_attr($id); ?>" data-bs-parent="#accordionExample">
													<div class="accordion-body">
														<?php echo wp_kses_post($accordion_content); ?>
													</div>
												</div>
											<?php } ?>
										</div>
								<?php }
								} ?>
							</div>
							<div class="faq-btn">
								<?php
									echo $button;
								?>
							</div>
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
	 * Render Accordion  widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Grafco_Accordion());
