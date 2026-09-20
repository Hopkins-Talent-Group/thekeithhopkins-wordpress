<?php
/*
 * Elementor Portio Hero Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Hero extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_hero';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Hero', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'ti-panel';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Hero widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_hero'];
	}

	/**
	 * Register Portio Hero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_hero',
			[
				'label' => esc_html__('Hero Options', 'portio-core'),
			]
		);
		$this->add_control(
			'hero_style',
			[
				'label' => esc_html__('Hero Style', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'portio-core'),
					'style-two' => esc_html__('Style two', 'portio-core'),
					'style-three' => esc_html__('Style three', 'portio-core'),
					'style-four' => esc_html__('Style four', 'portio-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your hero style.', 'portio-core'),
			]
		);
		$this->add_control(
			'hero_top_title',
			[
				'label' => esc_html__('Top Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Hi, I’m', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__('Darlene Rbertson', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_gallery',
			[
				'label' => esc_html__('Add Images', 'portio-core'),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'condition' => [
					'hero_style' => array('style-one'),
				],
				'default' => [],
			]
		);
		$this->add_control(
			'hero_content',
			[
				'label' => esc_html__('Content', 'portio-core'),
				'default' => esc_html__('your content text', 'portio-core'),
				'placeholder' => esc_html__('Type your content here', 'portio-core'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);
		$this->add_control(
			'round_content',
			[
				'label' => esc_html__('Round Text', 'portio-core'),
				'default' => esc_html__('your content text', 'portio-core'),
				'placeholder' => esc_html__('hire me your dream project.', 'portio-core'),
				'type' => Controls_Manager::TEXTAREA,
				'condition' => [
					'hero_style' => array('style-one'),
				],
				'label_block' => true,
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'social_title',
			[
				'label' => esc_html__('Title Text', 'grafco-core'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'hero_style' => array('style-two'),
				],
				'default' => esc_html__('Social item', 'grafco-core'),
				'placeholder' => esc_html__('Type title text here', 'grafco-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'social_link',
			[
				'label' => esc_html__('Link Url', 'grafco-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'grafco-core'),
				'placeholder' => esc_html__('Type link url here', 'grafco-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'social_icon',
			[
				'label' => __('Icon', 'grafco-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fi flaticon-phone-call',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'socialItems_groups',
			[
				'label' => esc_html__('Social item', 'grafco-core'),
				'type' => Controls_Manager::REPEATER,
				'condition' => [
					'hero_style' => array('style-two'),
				],
				'default' => [
					[
						'social_title' => esc_html__('Social', 'grafco-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ social_title }}}',
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'portio-core'),
				'default' => esc_html__('button text', 'portio-core'),
				'placeholder' => esc_html__('Type button Text here', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'condition' => [
					'hero_style' => array('style-two'),
				],
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__('Button Link', 'portio-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'condition' => [
					'hero_style' => array('style-two'),
				],
				'default' => [
					'url' => '',
				],
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
					'hero_style' => array('style-two'),
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
			'btn2_text',
			[
				'label' => esc_html__('Button 2 Text', 'portio-core'),
				'default' => esc_html__('button text', 'portio-core'),
				'placeholder' => esc_html__('Type button Text here', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'hero_style' => array('style-three', 'style-four'),
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn2_link',
			[
				'label' => esc_html__('Button 2 Link', 'portio-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'condition' => [
					'hero_style' => array('style-three', 'style-four'),
				],
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'video_link',
			[
				'label' => esc_html__('Video Link', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('#', 'portio-core'),
				'placeholder' => esc_html__('Type video link here', 'portio-core'),
				'label_block' => true,
				'condition' => [
					'hero_style' => array('style-three'),
				],
			]
		);

		$this->add_control(
			'video_icon',
			[
				'label' => __('Icon', 'portio-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'condition' => [
					'hero_style' => array('style-three'),
				],
				'default' => [
					'value' => 'fi flaticon-place',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'hero_image',
			[
				'label' => esc_html__('Hero Image', 'portio-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'frontend_available' => true,
				'condition' => [
					'hero_style' => array('style-one', 'style-three'),
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$this->add_control(
			'hero_shape',
			[
				'label' => esc_html__('Right Shape Image', 'portio-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'frontend_available' => true,
				'condition' => [
					'hero_style' => array('style-one', 'style-three'),
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$this->add_control(
			'hero_shape2',
			[
				'label' => esc_html__('Left Shape Image', 'portio-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'frontend_available' => true,
				'condition' => [
					'hero_style' => array('style-one'),
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'portio-core'),
			]
		);
		$this->end_controls_section(); // end: Section

		// Body Style
		$this->start_controls_section(
			'section_body_style',
			[
				'label' => esc_html__('Body Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'section_body_bg_color',
			[
				'label' => esc_html__('Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Text box
		$this->start_controls_section(
			'text_box_style',
			[
				'label' => esc_html__('Text Box Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hero_style' => array('style-two'),
				],
			]
		);
		$this->add_control(
			'text_box_bg_color',
			[
				'label' => esc_html__('Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-section-s2 .profile-content' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Top Title
		$this->start_controls_section(
			'section_top_title_style',
			[
				'label' => esc_html__('Top Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hero_style' => array('style-two', 'style-three'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_top_title_typography',
				'selector' => '{{WRAPPER}} .portio-hero .wraper .content h2',
			]
		);
		$this->add_control(
			'top_title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .wraper .content h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'top_title_padding',
			[
				'label' => esc_html__('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-hero .wraper .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .portio-hero .wraper .content h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .wraper .content h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-hero .wraper .content h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .portio-hero .content p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__('Content Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-hero .content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Round
		$this->start_controls_section(
			'round_content_style',
			[
				'label' => esc_html__('Round Shape', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hero_style' => array('style-one'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'round_content_typography',
				'selector' => '{{WRAPPER}} .portio-hero .circle-content svg text',
			]
		);
		$this->add_control(
			'round_content_content_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .circle-content svg text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'round_content_content_bg_color',
			[
				'label' => esc_html__('Background Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-section-s3 .circle-content svg' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'round_content_content_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-section-s3 .circle-content svg' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // end: Section

		// Social
		$this->start_controls_section(
			'social_style',
			[
				'label' => esc_html__('Social Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hero_style' => array('style-two'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'social_typography',
				'selector' => '{{WRAPPER}} .portio-hero .socal-icon li a',
			]
		);
		$this->add_control(
			'social_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .socal-icon li a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'social_bg_color',
			[
				'label' => esc_html__('Background Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .socal-icon li a' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'social_hover_color',
			[
				'label' => esc_html__('Hover Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .socal-icon li a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'social_hover_bg_color',
			[
				'label' => esc_html__('Hover Background Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .socal-icon li a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Funfact Number
		$this->start_controls_section(
			'funfact_number_style',
			[
				'label' => esc_html__('Number', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hero_style' => array('style-two'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_number_typography',
				'selector' => '{{WRAPPER}} .portio-hero .count_wrap .item h3',
			]
		);
		$this->add_control(
			'funfact_item_number_color',
			[
				'label' => esc_html__('Number Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .count_wrap .item h3' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .portio-hero .count_wrap .item h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'hero_style' => array('style-two'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Title Typography', 'portio-core'),
				'name' => 'portio_text_typography',
				'selector' => '{{WRAPPER}} .portio-hero .count_wrap .item h5',
			]
		);
		$this->add_control(
			'funfact_item_text_color',
			[
				'label' => esc_html__('Title Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .count_wrap .item h5' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .portio-hero .count_wrap .item h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'condition' => [
					'hero_style' => array('style-one'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_one_typography',
				'label' => esc_html__('Typography', 'portio-core'),
				'selector' => '{{WRAPPER}} .portio-hero .profile-content .hire-btn',
			]
		);
		$this->start_controls_tabs('button_one_style');
		$this->start_controls_tab(
			'button_one_normal',
			[
				'label' => esc_html__('Normal', 'portio-core'),
			]
		);
		$this->add_control(
			'button_one_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .profile-content .hire-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_one_bg_color',
			[
				'label' => esc_html__('Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .profile-content .hire-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_one_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .profile-content .hire-btn' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-hero .profile-content .hire-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();  // end:Normal tab

		$this->start_controls_tab(
			'button_one_hover',
			[
				'label' => esc_html__('Hover', 'portio-core'),
			]
		);
		$this->add_control(
			'button_one_hover_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .profile-content .hire-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_one_bg_hover_color',
			[
				'label' => esc_html__('Background Hover', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .profile-content .hire-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_one_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .profile-content .hire-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section(); // end: Section


		// Button
		$this->start_controls_section(
			'section_button_style2',
			[
				'label' => esc_html__('Button2 Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hero_style' => array('style-three'),
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_one_typography2',
				'label' => esc_html__('Typography', 'portio-core'),
				'selector' => '{{WRAPPER}} .portio-hero .btn-wraper .theme-btn',
			]
		);
		$this->start_controls_tabs('button_one_style2');
		$this->start_controls_tab(
			'button_one_normal2',
			[
				'label' => esc_html__('Normal', 'portio-core'),
			]
		);
		$this->add_control(
			'button_one_color2',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .btn-wraper .theme-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_one_bg_color2',
			[
				'label' => esc_html__('Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .btn-wraper .theme-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_padding2',
			[
				'label' => esc_html__('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-hero .btn-wraper .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();  // end:Normal tab

		$this->start_controls_tab(
			'button_one_hover2',
			[
				'label' => esc_html__('Hover', 'portio-core'),
			]
		);
		$this->add_control(
			'button_one_hover_color2',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .btn-wraper .theme-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_one_bg_hover_color2',
			[
				'label' => esc_html__('Background Hover', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-hero .btn-wraper .theme-btn:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs


		$this->end_controls_section(); // end: Section

		// background shape
		$this->start_controls_section(
			'back_shape_style',
			[
				'label' => esc_html__('Shape Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'hero_style' => array('style-three'),
				],
			]
		);
		$this->add_control(
			'back_shape_style_bg',
			[
				'label' => esc_html__('Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-section-s5 .hero-image .bg-border' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'back_shape_style_border',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-section-s5 .hero-image .bg-border, .hero-section-s5 .hero-image .bg-shape' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section
	}

	/**
	 * Render Hero widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$hero_style = !empty($settings['hero_style']) ? $settings['hero_style'] : '';
		$hero_gallery = !empty($settings['hero_gallery']) ? $settings['hero_gallery'] : '';

		$hero_top_title = !empty($settings['hero_top_title']) ? $settings['hero_top_title'] : '';
		$hero_title = !empty($settings['hero_title']) ? $settings['hero_title'] : '';
		$hero_content = !empty($settings['hero_content']) ? $settings['hero_content'] : '';
		$round_content = !empty($settings['round_content']) ? $settings['round_content'] : '';

		$hero_image = !empty($settings['hero_image']['id']) ? $settings['hero_image']['id'] : '';
		$hero_mask = !empty($settings['hero_mask']['id']) ? $settings['hero_mask']['id'] : '';
		$hero_shape = !empty($settings['hero_shape']['id']) ? $settings['hero_shape']['id'] : '';
		$hero_shape2 = !empty($settings['hero_shape2']['id']) ? $settings['hero_shape2']['id'] : '';

		$button_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';
		$button_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$button_link_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$button_link_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$button_link_attr = !empty($button_link) ?  $button_link_external . ' ' . $button_link_nofollow : '';

		$button2_text = !empty($settings['btn2_text']) ? $settings['btn2_text'] : '';
		$button2_link = !empty($settings['btn2_link']['url']) ? $settings['btn2_link']['url'] : '';
		$button_link_external = !empty($settings['btn2_link']['is_external']) ? 'target="_blank"' : '';
		$button2_link_nofollow = !empty($settings['btn2_link']['nofollow']) ? 'rel="nofollow"' : '';
		$button2_link_attr = !empty($butto2n_link) ?  $button2_link_external . ' ' . $button2_link_nofollow : '';

		$hero_image_url = wp_get_attachment_url($hero_image);
		$hero_image_alt = get_post_meta($hero_image, '_wp_attachment_image_alt', true);

		$shape_url = wp_get_attachment_url($hero_shape);
		$shape_alt = get_post_meta($hero_shape, '_wp_attachment_image_alt', true);
		$shape2_url = wp_get_attachment_url($hero_shape2);
		$shape2_alt = get_post_meta($hero_shape2, '_wp_attachment_image_alt', true);

		$portio_button = $button_link ? '<a href="' . esc_url($button_link) . '" ' . $button_link_attr . ' class="hire-btn">' . esc_html($button_text) . '</a>' : '';

		$portio_button2 = $button2_link ? '<a href="' . esc_url($button2_link) . '" ' . $button2_link_attr . ' class="theme-btn">' . esc_html($button2_text) . '</a>' : '';

		$socialItems_groups = !empty($settings['socialItems_groups']) ? $settings['socialItems_groups'] : [];

		$funfactItems_groups = !empty($settings['funfactItems_groups']) ? $settings['funfactItems_groups'] : [];

		$video_link = !empty($settings['video_link']) ? $settings['video_link'] : '';


		$video_icon = !empty($settings['video_icon']['value']) ? $settings['video_icon']['value'] : '';
		$videoIcon_svg_url = !empty($settings['video_icon']['value']['url']) ? $settings['video_icon']['value']['url'] : '';
		$svg_alt = get_post_meta($videoIcon_svg_url, '_wp_attachment_image_alt', true);


		// Turn output buffer on
		ob_start(); ?>

		<?php if ($hero_style == 'style-one') { ?>
			<div class="portio-hero hero-section-s3" id="top">
				<div class="wraper">
					<div class="content">
						<?php if ($hero_title) {
							echo '<h3>' . wp_kses_post($hero_title) . '</h3>';
						} ?>
						<?php
						if ($hero_content) {
							echo '<p>' . wp_kses_post($hero_content) . '</p>';
						} ?>
						<div class="hero-image-slider">
							<?php
							$id = 0;
							if (is_array($hero_gallery) && !empty($hero_gallery)) {
								foreach ($hero_gallery as $each_item) {
									$id++;
									$image_url = !empty($each_item['url']) ? $each_item['url'] : '';
									$image_alt = get_post_meta($each_item['url'], '_wp_attachment_image_alt', true);
							?>

									<div class="item">
										<?php if ($image_url) {
											echo '<img src="' . esc_attr($image_url) . '" alt="' . esc_url($image_alt) . '">';
										}  ?>
									</div>

							<?php
								}
							}
							?>
						</div>
					</div>
				</div>
				<div class="left-image">
					<?php if ($hero_image_url) {
						echo '<img src="' . esc_attr($hero_image_url) . '" alt="' . esc_url($hero_image_alt) . '">';
					}  ?>
				</div>
				<div class="shape-1">
					<svg width="97" height="97" viewBox="0 0 97 97" fill="none">
						<path d="M48.5 97L52.1141 66.6694L67.0602 93.3082L58.7921 63.9033L82.7947 82.7947L63.9033 58.7921L93.3082 67.0601L66.6694 52.1141L97 48.5L66.6694 44.8859L93.3082 29.9398L63.9033 38.2079L82.7947 14.2053L58.7921 33.0967L67.0602 3.69184L52.1141 30.3306L48.5 0L44.8859 30.3306L29.9399 3.69184L38.2079 33.0967L14.2053 14.2053L33.0967 38.2079L3.69184 29.9398L30.3306 44.8859L0 48.5L30.3306 52.1141L3.69184 67.0601L33.0967 58.7921L14.2053 82.7947L38.2079 63.9033L29.9399 93.3082L44.8859 66.6694L48.5 97Z" fill="#C4EF17" />
					</svg>
				</div>
				<div class="shape-2">
					<?php if ($shape2_url) {
						echo '<img src="' . esc_attr($shape2_url) . '" alt="' . esc_url($shape2_alt) . '">';
					}  ?>
				</div>
				<div class="shape-3">
					<?php if ($shape_url) {
						echo '<img src="' . esc_attr($shape_url) . '" alt="' . esc_url($shape_alt) . '">';
					}  ?>
				</div>
				<div class="circle-content">
					<div>
						<svg viewBox="0 0 100 100">
							<defs>
								<path id="circle" d="
										M 50, 50
										m -37, 0
										a 37,37 0 1,1 74,0
										a 37,37 0 1,1 -74,0" />
							</defs>
							<text>
								<textPath xlink:href="#circle">
									<?php
									if ($round_content) {
										echo wp_kses_post($round_content);
									} ?>
								</textPath>
							</text>
						</svg>
					</div>
					<div class="arrows">
						<svg viewBox="0 0 37 37" fill="none">
							<path d="M12.6789 7.51532V10.182H21.4655L6.01221 25.6353L7.89221 27.5153L23.3455 12.062V20.8487H26.0122V7.51532H12.6789Z" fill="black" />
						</svg>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if ($hero_style == 'style-two') { ?>
			<div class="portio-hero hero-section-s2" id="top">
				<div class="wraper hero-wraper">
					<div class="content profile-content">
						<?php if ($hero_top_title) {
							echo '<h2  class="poort-text poort-in-right">' . esc_html__($hero_top_title) . '</h2>';
						} ?>
						<?php if ($hero_title) {
							echo '<h3  class="poort-text poort-in-right">' . wp_kses_post($hero_title) . '</h3>';
						} ?>
						<?php
						if ($hero_content) {
							echo '<p>' . wp_kses_post($hero_content) . '</p>';
						} ?>
						<ul class="socal-icon">
							<?php

							// Group Param Output
							if (is_array($socialItems_groups) && !empty($socialItems_groups)) {
								foreach ($socialItems_groups as $each_item) {

									$social_icon = !empty($each_item['social_icon']['value']) ? $each_item['social_icon']['value'] : '';
									$social_link = !empty($each_item['social_link']) ? $each_item['social_link'] : '';
									if ($social_link) {
										$link_o = '<a href="' . $social_link . '" class="social-link">';
										$link_c = '</a>';
									} else {
										$link_o = '';
										$link_c = '';
									}

							?>
									<?php if ($social_icon) {
										echo '<li>' . $link_o . '<i class="' . esc_attr($social_icon) . '"></i>' . $link_c . '</li>';
									} ?>
							<?php }
							} ?>
						</ul>

						<?php echo $portio_button ?>

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
				</div>
				<div class="shape scroll-text-animation" data-animation="fade_from_right">
					<svg width="690" height="631" viewBox="0 0 690 631" fill="none">
						<path d="M694 631H0L694 0V631Z" fill="#2B3500" fill-opacity="0.5" />
					</svg>
				</div>
			</div>
		<?php } ?>

		<?php if ($hero_style == 'style-three') { ?>
			<div class="portio-hero hero-section-s5" id="top">
				<div class="wraper">
					<div class="content">
						<?php if ($hero_top_title) {
							echo '<h2  class="poort-text poort-in-right">' . esc_html__($hero_top_title) . '</h2>';
						} ?>
						<?php if ($hero_title) {
							echo '<h3  class="poort-text poort-in-right">' . wp_kses_post($hero_title) . '</h3>';
						} ?>
						<?php
						if ($hero_content) {
							echo '<p>' . wp_kses_post($hero_content) . '</p>';
						} ?>
						<div class="btn-wraper">
							<?php echo $portio_button2 ?>
							<div class="popup-video">
								<a href="<?php echo esc_url($video_link); ?>" class="popup-youtube video-btn" data-type="iframe">
									<?php
									if ($videoIcon_svg_url) {
										echo '<img  src="' . esc_url($videoIcon_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
									} else {
										echo '<i class="' . esc_attr($video_icon) . '"></i>';
									}
									?>
								</a>
								<span>Watch Videos</span>
							</div>
						</div>
					</div>
				</div>
				<div class="hero-image">
					<div class="image ">
						<?php if ($hero_image_url) {
							echo '<img src="' . esc_attr($hero_image_url) . '" alt="' . esc_url($hero_image_alt) . '">';
						}  ?>
					</div>
					<div class="bg-border"></div>
					<div class="bg-shape">
						<div class="shape-1">
							<?php if ($shape_url) {
								echo '<img src="' . esc_attr($shape_url) . '" alt="' . esc_url($shape_alt) . '">';
							}  ?>
						</div>
						<div class="shape-2">
							<?php if ($shape_url) {
								echo '<img src="' . esc_attr($shape_url) . '" alt="' . esc_url($shape_alt) . '">';
							}  ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
		<?php if ($hero_style == 'style-four') { ?>
			<div class="hero-section-s7" id="top">
				<div class="wraper">
					<div class="content">
						<?php if ($hero_top_title) {
							echo '<h2  class="poort-text poort-in-right">' . esc_html__($hero_top_title) . '</h2>';
						} ?>
						<?php if ($hero_title) {
							echo '<h3  class="poort-text poort-in-right">' . wp_kses_post($hero_title) . '</h3>';
						} ?>
						<?php
						if ($hero_content) {
							echo '<p>' . wp_kses_post($hero_content) . '</p>';
						} ?>
						<div class="hero-btn">
							<?php echo $portio_button2 ?>
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
	 * Render Hero widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Hero());
