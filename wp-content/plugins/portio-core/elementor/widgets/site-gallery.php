<?php
/*
 * Elementor Portio Gallery Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Gallery extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_gallery';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Gallery', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-gallery-justified';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Gallery widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_gallery'];
	}

	/**
	 * Register Portio Gallery widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_gallery',
			[
				'label' => esc_html__('Gallery Options', 'portio-core'),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'gallery_image',
			[
				'label' => esc_html__('Gallery Image', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);
		$repeater->add_control(
			'gallery_title',
			[
				'label' => esc_html__('Title', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title', 'portio-core'),
				'placeholder' => esc_html__('Type Title here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'galleryItems_groups',
			[
				'label' => esc_html__('Gallery Items', 'portio-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'gallery_title' => esc_html__('Gallery', 'portio-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ gallery_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section

		// Overly
		$this->start_controls_section(
			'section_project_overly_style',
			[
				'label' => esc_html__('Overly', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'overly_color',
			[
				'label' => esc_html__('Overly Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pillars-card .image::before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		//Icon
		$this->start_controls_section(
			'gallery_icon_style',
			[
				'label' => esc_html__('Icon', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pillars-card:hover .image .popup-icon' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pillars-card:hover .image .popup-icon i:before' => 'color: {{VALUE}};',
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
				'name' => 'portio_title_typography',
				'selector' => '{{WRAPPER}} .pillars-card h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pillars-card h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => __('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .pillars-card h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


	}

	/**
	 * Render Gallery widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$galleryItems_groups = !empty($settings['galleryItems_groups']) ? $settings['galleryItems_groups'] : [];

		// Turn output buffer on
		ob_start();
?>
		<div class="gallery-section section-padding" id="gallery">
			<div class="container">
				<div class="sortable-gallery">
					<div class="gallery-filters"></div>
					<div class="row">
						<div class="col-lg-12">
							<div class="gallery-grids gallery-container clearfix">
								<?php 	// Group Param Output
								if (is_array($galleryItems_groups) && !empty($galleryItems_groups)) {
									foreach ($galleryItems_groups as $each_item) {

										$gallery_image_url = !empty($each_item['gallery_image']['id']) ? $each_item['gallery_image']['id'] : '';
										$image_url = wp_get_attachment_url($gallery_image_url);
										$image_alt = get_post_meta($each_item['gallery_image']['id'], '_wp_attachment_image_alt', true);

								?>

										<div class="grid">
											<div class="img-holder">
												<a href="<?php echo esc_url($image_url); ?>" class="fancybox" data-fancybox-group="gall-1">
													<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_url($image_alt); ?>" class="img img-responsive">
													<div class="hover-content">
														<i class="ti-plus"></i>
													</div>
												</a>
											</div>
										</div>

								<?php
									}
								}
								?>

							</div>
						</div>
					</div>
				</div>
			</div> <!-- end container -->
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Gallery widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Site_Gallery());
