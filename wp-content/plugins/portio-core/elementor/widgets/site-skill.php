<?php
/*
 * Elementor Portio Skill Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Portio_Skill extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_skill';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Skill', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-skill-bar';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio skill widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_skill'];
	}

	/**
	 * Register Portio skill widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls()
	{

		$this->start_controls_section(
			'section_skill',
			[
				'label' => esc_html__('Skill Options', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'skill_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'skill_number',
			[
				'label' => esc_html__('skill Number', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('250', 'portio-core'),
				'placeholder' => esc_html__('Type skill Number here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'skill_symbol',
			[
				'label' => esc_html__('skill Plus/Percentage', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('+', 'portio-core'),
				'placeholder' => esc_html__('Type skill Plus/Percentage here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'skillItems_groups',
			[
				'label' => esc_html__('skill Items', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'skill_title' => esc_html__('skill', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ skill_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		// skill Stroke Color
		$this->start_controls_section(
			'skill_stroke_style',
			[
				'label' => esc_html__('Stroke Color', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'skill_item_stroke_color',
			[
				'label' => esc_html__('Stroke Color Upper', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill-section .progras-card svg circle:last-of-type' => 'stroke: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'skill_item_stroke_color2',
			[
				'label' => esc_html__('Stroke Color Lower', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill-section .progras-card svg circle' => 'stroke: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// skill Number
		$this->start_controls_section(
			'skill_number_style',
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
				'selector' => '{{WRAPPER}} .skill-section .progras-card .number h3',
			]
		);
		$this->add_control(
			'skill_item_number_color',
			[
				'label' => esc_html__('Number Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill-section .progras-card .number h3' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .skill-section .progras-card .number h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// skill Title
		$this->start_controls_section(
			'skill_title_style',
			[
				'label' => esc_html__('skill Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_skill_title_typography',
				'selector' => '{{WRAPPER}} .skill-section .progras-card .title h2',
			]
		);
		$this->add_control(
			'skill_title',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill-section .progras-card .title h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'skill_title_padding',
			[
				'label' => __('Number Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .skill-section .progras-card .title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render skill widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$skillItems_groups = !empty($settings['skillItems_groups']) ? $settings['skillItems_groups'] : [];

		// Turn output buffer on
		ob_start(); ?>
		<div class="skill-section">
			<div class="container">
				<div class="row">
					<?php 	// Group Param Output
					if (is_array($skillItems_groups) && !empty($skillItems_groups)) {
						foreach ($skillItems_groups as $each_item) {
							$skill_title = !empty($each_item['skill_title']) ? $each_item['skill_title'] : '';
							$skill_number = !empty($each_item['skill_number']) ? $each_item['skill_number'] : '';
							$skill_symbol = !empty($each_item['skill_symbol']) ? $each_item['skill_symbol'] : '';
					?>


							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12 scroll-text-animation" data-animation="fade_from_bottom">
								<div class="progras-card">
									<div class="percent">
										<svg>
											<circle cx="150" cy="75" r="93"></circle>
											<circle cx="150" cy="75" r="93" style="--percent: <?php if ($skill_number) { echo esc_html__($skill_number);} ?>"></circle>
										</svg>
										<div class="number">
											<h3><?php if ($skill_number) { echo esc_html__($skill_number);} ?><span><?php if ($skill_symbol) { echo esc_html__($skill_symbol);} ?></span></h3>
										</div>
									</div>
									<div class="title">
										<?php if ($skill_title) { echo '<h2>' . esc_html__($skill_title) . '</h2>';} ?>
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
	 * Render skill widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Portio_Skill());
