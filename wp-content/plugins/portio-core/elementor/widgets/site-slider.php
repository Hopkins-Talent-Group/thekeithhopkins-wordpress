<?php
/*
 * Elementor Portio Slider Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Slider extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_slider';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Slider', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-post-slider';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Slider widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */

	public function get_script_depends()
	{
		return ['wpo-portio_slider'];
	}


	/**
	 * Register Portio Slider widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_slider',
			[
				'label' => __('Slider Options', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'slider_title',
			[
				'label' => esc_html__('Slider title', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => 'Marinaa Street Art Festival',
				'placeholder' => esc_html__('Type slide title here', 'portio-core'),
			]
		);
		$repeater->add_control(
			'slider_content',
			[
				'label' => esc_html__('Slider content', 'portio-core'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default' => 'Slider Details content',
				'placeholder' => esc_html__('Type slide content here', 'portio-core'),
			]
		);
		$repeater->add_control(
			'slider_image',
			[
				'label' => esc_html__('Slider Image', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$repeater->add_control(
			'slider_shape',
			[
				'label' => esc_html__('Slider Shape', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'mainSliders_groups',
			[
				'label' => esc_html__('Slider Items', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'slider_title' => esc_html__('Item #1', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ slider_title }}}',
			]
		);
		$this->add_control(
			'hero_gallery',
			[
				'label' => esc_html__('Add Images', 'portio-core'),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

		$this->add_control(
			'funfact_title',
			[
				'label' => esc_html__('Funfact Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'funfact_number',
			[
				'label' => esc_html__('Funfact Number', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('250', 'portio-core'),
				'placeholder' => esc_html__('Type funfact Number here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'funfact_plus',
			[
				'label' => esc_html__('Funfact Plus/Percentage', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('+', 'portio-core'),
				'placeholder' => esc_html__('Type funfact Plus/Percentage here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->end_controls_section(); // end: Section

		// Slide
		$this->start_controls_section(
			'section_slide_option_style',
			[
				'label' => esc_html__('Slide', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'slide_margin',
			[
				'label' => __('Margin', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .hero-section-s6 .hero-slider, .hero-section-s6 .slide-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'slide_height',
			[
				'label' => esc_html__('height', 'consoel-core'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => 500,
						'max' => 1000,
						'step' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 900,
				],
				'selectors' => [
					'{{WRAPPER}} .hero-section-s6 .hero-slider, .hero-section-s6 .slide-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// sub
		$this->start_controls_section(
			'section_sub_style',
			[
				'label' => esc_html__('sub', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'slider_sub_typography',
				'selector' => '{{WRAPPER}} .hero-section-s6 .slide-item .slide-content h2',
			]
		);
		$this->add_control(
			'slider_sub_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-section-s6 .slide-item .slide-content h2' => 'color: {{VALUE}};',
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
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .hero-section-s6 .slide-item .slide-content h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hero-section-s6 .slide-item .slide-content h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Funfact Number Style
		$this->start_controls_section(
			'funfact_style',
			[
				'label' => esc_html__('Funfact Number Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'funfact_number_typography',
				'selector' => '{{WRAPPER}} .volunteer .content h2, .volunteer .content span',
			]
		);
		$this->add_control(
			'funfact_number_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .volunteer .content h2, .volunteer .content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Funfact subtitle Style
		$this->start_controls_section(
			'funfact_subtitle_style',
			[
				'label' => esc_html__('Funfact Subtitle Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'funfact_subtitle_typography',
				'selector' => '{{WRAPPER}} .volunteer .content p',
			]
		);
		$this->add_control(
			'funfact_subtitle_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .volunteer .content p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Blog widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		// Carousel Options
		$mainSliders_groups = !empty($settings['mainSliders_groups']) ? $settings['mainSliders_groups'] : [];
		$hero_gallery = !empty($settings['hero_gallery']) ? $settings['hero_gallery'] : '';
		$funfact_title = !empty($settings['funfact_title']) ? $settings['funfact_title'] : '';
		$funfact_number = !empty($settings['funfact_number']) ? $settings['funfact_number'] : '';
		$funfact_plus = !empty($settings['funfact_plus']) ? $settings['funfact_plus'] : '';


		// Turn output buffer on
		ob_start();

?>

		<div class="hero-section-s6" id="top">
			<div class="hero-slider">
				<?php
				if (is_array($mainSliders_groups) && !empty($mainSliders_groups)) {
					foreach ($mainSliders_groups as $each_item) {

						$image_url = wp_get_attachment_url($each_item['slider_image']['id']);
						$image_alt = get_post_meta($each_item['slider_image']['id'], '_wp_attachment_image_alt', true);

						$shape_url = wp_get_attachment_url($each_item['slider_shape']['id']);
						$shape_alt = get_post_meta($each_item['slider_shape']['id'], '_wp_attachment_image_alt', true);

						$slider_title = !empty($each_item['slider_title']) ? $each_item['slider_title'] : '';
						$slider_content = !empty($each_item['slider_content']) ? $each_item['slider_content'] : '';

				?>

						<div class="slide-item">
							<div class="slide-img">
								<?php if ($image_url) {
									echo '<img class="full-image animated" data-animation-in="zoomInImage" src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
								} ?>
							</div>
							<div class="slide-content">
								<?php if ($slider_title) { ?>
									<h2 class="animated" data-animation-in="fadeInUp"><?php echo esc_html($slider_title); ?></h2>
								<?php }
								if ($slider_content) { ?>
									<h3 class="animated" data-animation-in="fadeInUp" data-delay-in="0.3"><?php echo wp_kses_post($slider_content); ?></h3>
								<?php } ?>

								<div class="shape">
									<?php if ($shape_url) {
										echo '<img src="' . esc_url($shape_url) . '" alt="' . esc_attr($shape_alt) . '">';
									} ?>
								</div>
							</div>
						</div>

						<!-- end swiper-slide -->
				<?php }
				} ?>
			</div>
			<div class="volunteer">
				<div class="volunteer-slider">
					<div class="swiper-container">
						<div class="swiper-wrapper">
							<?php
							$id = 0;
							if (is_array($hero_gallery) && !empty($hero_gallery)) {
								foreach ($hero_gallery as $each_item) {
									$id++;
									$image_url = !empty($each_item['url']) ? $each_item['url'] : '';
									$image_alt = get_post_meta($each_item['url'], '_wp_attachment_image_alt', true);
							?>

									<div class="item swiper-slide">
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
				<div class="content">
					<?php
					if ($funfact_number) {
						echo '<h3><span class="odometer" data-count="' . esc_attr($funfact_number) . '">' . esc_html__('00', 'portio-core') . '</span>' . esc_html($funfact_plus) . '</h3>';
					}
					if ($funfact_title) {
						echo '<p>' . esc_html__($funfact_title) . '</p>';
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
	 * Render Blog widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Slider());
