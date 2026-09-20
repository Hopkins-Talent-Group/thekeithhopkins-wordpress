<?php
/*
 * Elementor Portio About Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_About extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_about';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('About', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-site-identity';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio About widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_about'];
	}

	/**
	 * Register Portio About widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_about',
			[
				'label' => esc_html__('About Options', 'portio-core'),
			]
		);
		$this->add_control(
			'about_style',
			[
				'label' => esc_html__('About Style', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'portio-core'),
					'style-two' => esc_html__('Style two', 'portio-core'),
					'style-three' => esc_html__('Style Three', 'portio-core'),
					'style-four' => esc_html__('Style Four', 'portio-core'),
					'style-five' => esc_html__('Style Five', 'portio-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your about style.', 'portio-core'),
			]
		);
		$this->add_control(
			'about_subtitle',
			[
				'label' => esc_html__('Sub Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('About Us', 'portio-core'),
				'placeholder' => esc_html__('Sub Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('We Can Work Together For Create a Better Future..', 'portio-core'),
				'placeholder' => esc_html__('Sub Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_content',
			[
				'label' => esc_html__('Content', 'portio-core'),
				'default' => esc_html__('your content text', 'portio-core'),
				'placeholder' => esc_html__('Type your content here', 'portio-core'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_description',
			[
				'label' => esc_html__('Content', 'portio-core'),
				'default' => esc_html__('your content text', 'portio-core'),
				'placeholder' => esc_html__('Type your content here', 'portio-core'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		$repeater = new Repeater();
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
				'condition' => [
					'about_style' => array('style-one'),
				],
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
			'about_image',
			[
				'label' => esc_html__('About Image', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$this->add_control(
			'about_icon',
			[
				'label' => __('Icon', 'portio-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'about_style' => array('style-two'),
				],
				'default' => [
					'value' => 'fi flaticon-phone-call',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'exprience_number',
			[
				'label' => esc_html__('Exprience Number', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'about_style' => array('style-two'),
				],
				'default' => esc_html__('10', 'portio-core'),
				'placeholder' => esc_html__('Sub Type Exprience Number text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'exprience_title',
			[
				'label' => esc_html__('Exprience Title', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'about_style' => array('style-two'),
				],
				'default' => esc_html__('Years Of Experience', 'portio-core'),
				'placeholder' => esc_html__('Sub Type Exprience Number title here', 'portio-core'),
				'label_block' => true,
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'feature_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('Description', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'featureItems_groups',
			[
				'label' => esc_html__('Feature', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'about_style' => array('style-two'),
				],
				'default' => [
					[
						'feature_title' => esc_html__('Feature', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ feature_title }}}',
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'progress_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Description', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'progress_percentage',
			[
				'label' => esc_html__('Percentage', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('90', 'portio-core'),
				'placeholder' => esc_html__('Type Percentage here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'progressItems_groups',
			[
				'label' => esc_html__('Progress', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'about_style' => array('style-five'),
				],
				'default' => [
					[
						'progress_title' => esc_html__('Progress', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ progress_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		// Sub Title
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__('SubTitle', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about_style' => array('style-one'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'portio_subtitle_typography',
				'selector' => '{{WRAPPER}} .portio-about .about-left h6',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left h6' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left h6::before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => esc_html__('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left h6' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'condition' => [
					'about_style' => array('style-one'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'portio_title_typography',
				'selector' => '{{WRAPPER}} .portio-about .about-left h5',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_highlight_color',
			[
				'label' => esc_html__('Highlight Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left h5 span' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .portio-about .about-left h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Funfact Number
		$this->start_controls_section(
			'funfact_number_style',
			[
				'label' => esc_html__('Funfact Number', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about_style' => array('style-one'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_number_typography',
				'selector' => '{{WRAPPER}} .count_wrap .item h3',
			]
		);
		$this->add_control(
			'funfact_item_number_color',
			[
				'label' => esc_html__('Number Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .count_wrap .item h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_number_padding',
			[
				'label' => __('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .count_wrap .item h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Funfact Funfact Title
		$this->start_controls_section(
			'funfact_text_style',
			[
				'label' => esc_html__('Funfact Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about_style' => array('style-one'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Title Typography', 'portio-core'),
				'name' => 'portio_text_typography',
				'selector' => '{{WRAPPER}} .about-section-s3 .about-left .count_wrap .item h5',
			]
		);
		$this->add_control(
			'funfact_item_text_color',
			[
				'label' => esc_html__('Title Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-section-s3 .about-left .count_wrap .item h5' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_padding',
			[
				'label' => __('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .about-section-s3 .about-left .count_wrap .item h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Image Style
		$this->start_controls_section(
			'image_style',
			[
				'label' => esc_html__('About Image', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'about_image_border_color',
			[
				'label' => esc_html__('Image Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-right .image' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'about_image_big_border_color',
			[
				'label' => esc_html__('Image Big Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-section-s6 .about-right .image .shape-1 svg path, .about-section-s6 .about-right .image .shape-2 svg path' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'about_image_border_radius',
			[
				'label' => __( 'Image Border Radius', 'portio-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-right .image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Exprience Box
		$this->start_controls_section(
			'exprience_style',
			[
				'label' => esc_html__('Exprience Box', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about_style' => array('style-two'),
				],
			]
		);
		$this->add_control(
			'exprience_box_bg',
			[
				'label' => esc_html__('Box Bg Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-right .about-experianc' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'exprience_box_border',
			[
				'label' => esc_html__('Box Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-right .about-experianc' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Years Typography', 'portio-core'),
				'name' => 'exprience_typography',
				'selector' => '{{WRAPPER}} .portio-about .about-right .about-experianc .nunber h3',
			]
		);
		$this->add_control(
			'exprience_years_text_color',
			[
				'label' => esc_html__('Years Text Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-right .about-experianc .nunber h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'exprience_years_bg',
			[
				'label' => esc_html__('Year Bg Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-right .about-experianc .nunber' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Exprience Typography', 'portio-core'),
				'name' => 'years_typography',
				'selector' => '{{WRAPPER}} .portio-about .about-right .about-experianc .text h4',
			]
		);
		$this->add_control(
			'exprience_color',
			[
				'label' => esc_html__('Text Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-right .about-experianc .text h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// About Sub Title
		$this->start_controls_section(
			'about_subtitle_style',
			[
				'label' => esc_html__('SubTitle', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about_style' => array('style-two', 'style-three', 'style-four', 'style-five'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'about_subtitle_typography',
				'selector' => '{{WRAPPER}} .portio-about .section-top-content h2, .portio-about .section-top-content-s2 h2',
			]
		);
		$this->add_control(
			'about_subtitle_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .section-top-content h2, .portio-about .section-top-content-s2 h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'about_subtitle_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .section-top-content h2, .portio-about .section-top-content-s2 h2' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'about_subtitle_padding',
			[
				'label' => esc_html__('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-about .section-top-content h2, .portio-about .section-top-content-s2 h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// About Title
		$this->start_controls_section(
			'about_title_style',
			[
				'label' => esc_html__('Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about_style' => array('style-two', 'style-three', 'style-four', 'style-five'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'about_title_typography',
				'selector' => '{{WRAPPER}} .portio-about .about-left .section-top-content h3',
			]
		);
		$this->add_control(
			'about_title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left .section-top-content h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'about_title_padding',
			[
				'label' => esc_html__('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left .section-top-content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Small Title
		$this->start_controls_section(
			'small_title_style',
			[
				'label' => esc_html__('Small Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about_style' => array('style-two', 'style-three', 'style-four', 'style-five'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'small_title_typography',
				'selector' => '{{WRAPPER}} .portio-about .about-left .section-top-content h4',
			]
		);
		$this->add_control(
			'small_title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left .section-top-content h4' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'small_title_hightlight_color',
			[
				'label' => esc_html__('Hightlight Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left .section-top-content h4 span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'small_title_padding',
			[
				'label' => __('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left .section-top-content h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'condition' => [
					'about_style' => array('style-two', 'style-three', 'style-four', 'style-five'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .portio-about .about-left .section-top-content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left .section-top-content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => __('Content Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left .section-top-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// About List
		$this->start_controls_section(
			'about_list_style',
			[
				'label' => esc_html__('About List', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'about_style' => array('style-two'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'about_list_typography',
				'selector' => '{{WRAPPER}} .portio-about .about-left ul li',
			]
		);
		$this->add_control(
			'list_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'list_dot_color',
			[
				'label' => esc_html__('Dot Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left ul li:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'list_padding',
			[
				'label' => __('Content Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-about .about-left ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section
	}

	/**
	 * Render About widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$about_style = !empty($settings['about_style']) ? $settings['about_style'] : '';
		$about_subtitle = !empty($settings['about_subtitle']) ? $settings['about_subtitle'] : '';
		$about_title = !empty($settings['about_title']) ? $settings['about_title'] : '';
		$about_content = !empty($settings['about_content']) ? $settings['about_content'] : '';
		$about_description = !empty($settings['about_description']) ? $settings['about_description'] : '';
		$funfactItems_groups = !empty($settings['funfactItems_groups']) ? $settings['funfactItems_groups'] : [];
		$featureItems_groups = !empty($settings['featureItems_groups']) ? $settings['featureItems_groups'] : [];
		$progressItems_groups = !empty($settings['progressItems_groups']) ? $settings['progressItems_groups'] : [];

		$exprience_number = !empty($settings['exprience_number']) ? $settings['exprience_number'] : '';
		$exprience_title = !empty($settings['exprience_title']) ? $settings['exprience_title'] : '';

		$bg_image = !empty($settings['about_image']['id']) ? $settings['about_image']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		$about_icon = !empty($settings['about_icon']['value']) ? $settings['about_icon']['value'] : '';
		$about_svg_url = !empty($settings['about_icon']['value']['url']) ? $settings['about_icon']['value']['url'] : '';
		$svg_alt = get_post_meta($about_svg_url, '_wp_attachment_image_alt', true);

		// Turn output buffer on
		ob_start(); ?>

		<?php if ($about_style == 'style-one') { ?>
			<div class="portio-about about-section-s3" id="about">
				<div class="about-wrap">
					<div class="about-left">
						<?php
						if ($about_subtitle) {
							echo '<h6>' . esc_html($about_subtitle) . '</h6>';
						}
						if ($about_content) {
							echo '<h5>' . wp_kses_post($about_content) . '</h5>';
						}
						?>
						<div class="count_wrap">
							<?php 	// Group Param Output
							if (is_array($funfactItems_groups) && !empty($funfactItems_groups)) {
								foreach ($funfactItems_groups as $each_item) {
									$funfact_title = !empty($each_item['funfact_title']) ? $each_item['funfact_title'] : '';
									$funfact_number = !empty($each_item['funfact_number']) ? $each_item['funfact_number'] : '';
									$funfact_plus = !empty($each_item['funfact_plus']) ? $each_item['funfact_plus'] : '';
							?>

									<div class="item">
										<?php
										if ($funfact_number) {
											echo '<h3><span class="odometer" data-count="' . esc_attr($funfact_number) . '">' . esc_html__('00', 'portio-core') . '</span>' . esc_html($funfact_plus) . '</h3>';
										}
										if ($funfact_title) {
											echo '<h5>' . esc_html__($funfact_title) . '</h5>';
										}
										?>
									</div>

							<?php
								}
							}
							?>
						</div>
					</div>
					<div class="about-right scroll-text-animation" data-animation="fade_from_right">
						<div class="image">
							<?php if ($image_url) {
								echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
							}  ?>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ($about_style == 'style-two') { ?>
			<div class="portio-about about-section-s2" id="about">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-12">
							<div class="about-right scroll-text-animation" data-animation="fade_from_left">
								<div class="image">
									<?php if ($image_url) {
										echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
									}  ?>
								</div>
								<div class="shape">
									<?php
									if ($about_svg_url) {
										echo '<img src="' . esc_url($about_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
									} else {
										echo '<i class="' . esc_attr($about_icon) . '"></i>';
									}
									?>
								</div>
								<div class="about-experianc">
									<div class="nunber">
										<?php
										if ($exprience_number) {
											echo '<h3><span class="odometer" data-count="' . esc_attr($exprience_number) . '">' . esc_html__('00', 'portio-core') . '</span>' . '</h3>';
										}
										?>
									</div>
									<div class="text">
										<?php
										if ($exprience_title) {
											echo '<h4>' . esc_html__($exprience_title) . '</h4>';
										}
										?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="about-left">
								<div class="section-top-content">
									<?php
									if ($about_subtitle) {
										echo '<h2 class="poort-text poort-in-right">' . esc_html($about_subtitle) . '</h2>';
									}
									if ($about_title) {
										echo '<h3 class="poort-text poort-in-right">' . wp_kses_post($about_title) . '</h3>';
									}
									if ($about_content) {
										echo '<h4 class="scroll-text-animation" data-animation="fade_from_bottom">' . wp_kses_post($about_content) . '</h4>';
									}
									if ($about_description) {
										echo '<p class="scroll-text-animation" data-animation="fade_from_bottom">' . esc_html($about_description) . '</p>';
									}
									?>
								</div>
								<ul class="scroll-text-animation" data-animation="fade_from_bottom">
									<?php
									if (is_array($featureItems_groups) && !empty($featureItems_groups)) {
										foreach ($featureItems_groups as $each_item) {

											$feature_title = !empty($each_item['feature_title']) ? $each_item['feature_title'] : '';

									?>
											<?php
											if ($feature_title) {
												echo '<li>' . wp_kses_post($feature_title) . '</li>';
											}
											?>
									<?php
										}
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

		<?php } elseif ($about_style == 'style-three') { ?>
			<div class="portio-about about-section-s5 pb-0" id="about">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 col-12">
							<div class="about-right">
								<div class="image new_img-animet">
									<?php if ($image_url) {
										echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '" data-speed="0.8">';
									}  ?>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="about-left">
								<div class="section-top-content">
									<?php
									if ($about_subtitle) {
										echo '<h2 class="poort-text poort-in-right">' . esc_html($about_subtitle) . '</h2>';
									}
									if ($about_title) {
										echo '<h3 class="poort-text poort-in-right">' . wp_kses_post($about_title) . '</h3>';
									}
									if ($about_content) {
										echo '<h4 class="scroll-text-animation" data-animation="fade_from_bottom">' . wp_kses_post($about_content) . '</h4>';
									}
									if ($about_description) {
										echo '<p class="scroll-text-animation" data-animation="fade_from_bottom">' . esc_html($about_description) . '</p>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ($about_style == 'style-four') { ?>
			<div class="portio-about about-section-s6 " id="about">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-6 col-12">
							<div class="about-right scroll-text-animation" data-animation="fade_from_left">
								<div class="image">
									<?php if ($image_url) {
										echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
									}  ?>
									<div class="shape-1">
										<svg viewBox="0 0 634 634" fill="none">
											<path d="M634 317C634 492.074 492.074 634 317 634C141.926 634 0 492.074 0 317C0 141.926 141.926 0 317 0C492.074 0 634 141.926 634 317ZM27.6015 317C27.6015 476.83 157.17 606.398 317 606.398C476.83 606.398 606.398 476.83 606.398 317C606.398 157.17 476.83 27.6015 317 27.6015C157.17 27.6015 27.6015 157.17 27.6015 317Z" fill="#C4EF17" />
										</svg>
									</div>
									<div class="shape-2">
										<svg viewBox="0 0 634 634" fill="none">
											<path d="M634 317C634 244.898 609.42 174.95 564.316 118.698C519.212 62.4453 456.279 23.2498 385.9 7.57836C315.522 -8.0931 241.904 0.695928 177.193 32.4953C112.482 64.2946 60.5447 117.204 29.9511 182.494C-0.642521 247.783 -8.06459 321.552 8.90953 391.627C25.8836 461.703 66.2397 523.898 123.319 567.951C180.398 612.004 250.79 635.283 322.88 633.945C394.969 632.608 464.449 606.735 519.855 560.595L502.192 539.385C451.611 581.508 388.18 605.128 322.368 606.349C256.555 607.57 192.292 586.318 140.183 546.101C88.0737 505.884 51.2315 449.104 35.7353 385.13C20.2391 321.156 27.015 253.81 54.9448 194.205C82.8746 134.601 130.289 86.2979 189.366 57.2674C248.442 28.2369 315.651 20.2131 379.901 34.52C444.152 48.827 501.605 84.6097 542.782 135.964C583.959 187.318 606.398 251.176 606.398 317H634Z" fill="#C4EF17" />
										</svg>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-12">
							<div class="about-left">
								<div class="section-top-content">
									<?php
									if ($about_subtitle) {
										echo '<h2 class="poort-text poort-in-right">' . esc_html($about_subtitle) . '</h2>';
									}
									if ($about_title) {
										echo '<h3 class="poort-text poort-in-right">' . wp_kses_post($about_title) . '</h3>';
									}
									if ($about_content) {
										echo '<h4 class="scroll-text-animation" data-animation="fade_from_bottom">' . wp_kses_post($about_content) . '</h4>';
									}
									if ($about_description) {
										echo '<p class="scroll-text-animation" data-animation="fade_from_bottom">' . esc_html($about_description) . '</p>';
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } elseif ($about_style == 'style-five') { ?>
			<div class="portio-about about-section-s7" id="about">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-7 col-12 order-lg-1 order-2">
							<div class="about-left">
								<div class="section-top-content">
									<?php
									if ($about_subtitle) {
										echo '<h2 class="poort-text poort-in-right">' . esc_html($about_subtitle) . '</h2>';
									}
									if ($about_title) {
										echo '<h3 class="poort-text poort-in-right">' . wp_kses_post($about_title) . '</h3>';
									}
									if ($about_content) {
										echo '<h4 class="scroll-text-animation" data-animation="fade_from_bottom">' . wp_kses_post($about_content) . '</h4>';
									}
									if ($about_description) {
										echo '<p class="scroll-text-animation" data-animation="fade_from_bottom">' . esc_html($about_description) . '</p>';
									}
									?>
								</div>
								<div class="about-progres">
									<?php
									if (is_array($progressItems_groups) && !empty($progressItems_groups)) {
										foreach ($progressItems_groups as $each_item) {

											$progress_title = !empty($each_item['progress_title']) ? $each_item['progress_title'] : '';
											$progress_percentage = !empty($each_item['progress_percentage']) ? $each_item['progress_percentage'] : '';

									?>
											<div class="progres-card">
												<div class="block">
													<div class="box"></div>
													<p class="number">
														<?php
														if ($progress_percentage) {
															echo '<span class="num">' . esc_html($progress_percentage) . '</span>';
														}
														?>
														<span class="sub">%</span>
													</p>
													<svg class="svg">
														<defs>
															<linearGradient id="gradientStyle">
																<stop offset="0%" stop-color="#C4EF17" />
																<stop offset="100%" stop-color="#C4EF17" />
															</linearGradient>
														</defs>
														<circle class="circle" cx="85" cy="85" r="75" />
													</svg>
												</div>
												<?php
												if ($progress_title) {
													echo '<h3 class="title">' . esc_html($progress_title) . '</h3>';
												}
												?>
											</div>
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
						<div class="col-lg-5 col-12 order-lg-2 order-1">
							<div class="about-right scroll-text-animation" data-animation="fade_from_right">
								<div class="image">
									<?php if ($image_url) {
										echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
									}  ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php }
		echo ob_get_clean();
	}
	/**
	 * Render About widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_About());
