<?php
/*
 * Elementor Portio Service Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Grafco_Service extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_service';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Service', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-kit-details';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Service widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_service'];
	}

	/**
	 * Register Portio Service widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function _register_controls()
	{


		$posts = get_posts('post_type="service"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'portio')] = 0;
		}


		$this->start_controls_section(
			'section_service_listing',
			[
				'label' => esc_html__('Listing Options', 'portio-core'),
			]
		);
		$this->add_control(
			'service_style',
			[
				'label' => esc_html__('Service Style', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'portio-core'),
					'style-two' => esc_html__('Style two', 'portio-core'),
					'style-three' => esc_html__('Style three', 'portio-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your service style.', 'portio-core'),
			]
		);
		$this->add_control(
			'service_limit',
			[
				'label' => esc_html__('Service Limit', 'portio-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'portio-core'),
			]
		);
		$this->add_control(
			'service_order',
			[
				'label' => __('Order', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__('Asending', 'portio-core'),
					'DESC' => esc_html__('Desending', 'portio-core'),
				],
				'default' => 'DESC',
			]
		);
		$this->add_control(
			'service_orderby',
			[
				'label' => __('Order By', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'portio-core'),
					'ID' => esc_html__('ID', 'portio-core'),
					'author' => esc_html__('Author', 'portio-core'),
					'title' => esc_html__('Title', 'portio-core'),
					'date' => esc_html__('Date', 'portio-core'),
					'menu_order' => esc_html__('Menu Order', 'portio-core'),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'service_show_category',
			[
				'label' => __('Certain Categories?', 'portio-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('service_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'service_show_id',
			[
				'label' => __('Certain ID\'s?', 'portio-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->add_control(
			'short_content',
			[
				'label' => esc_html__('Excerpt Length', 'portio-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 16,
				'description' => esc_html__('How many words you want in short content paragraph.', 'portio-core'),
			]
		);
		$this->add_control(
			'read_more_txt',
			[
				'label' => esc_html__('Read More', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__('Type your Read More text here', 'portio-core'),
			]
		);
		$this->end_controls_section(); // end: Section



		// Service Item
		$this->start_controls_section(
			'section_service_item_style',
			[
				'label' => esc_html__('Service Box', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'service_box_style',
			[
				'label' => esc_html__('Box Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-service .service-card' => 'background-color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'service_box_border',
			[
				'label' => esc_html__('Box Border', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-service .service-card' => 'border-color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_section(); // end: Section


		// Service Icon
		$this->start_controls_section(
			'section_service_icon_style',
			[
				'label' => esc_html__('Icon Style', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'service_icon_style',
			[
				'label' => esc_html__('Icon Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-service .service-card .icon' => 'background-color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'service_icon_border',
			[
				'label' => esc_html__('Icon Border', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-service .service-card .icon' => 'border-color: {{VALUE}};',
				],
			]
		);	
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'service_section_title_style',
			[
				'label' => esc_html__('Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'service_portio_title_typography',
				'selector' => '{{WRAPPER}}  .portio-service .service-card .content h2 a',
			]
		);
		$this->add_control(
			'service_title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-service .service-card .content h2 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_title_hover_color',
			[
				'label' => esc_html__('Hover Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-service .service-card .content h2 a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_title_padding',
			[
				'label' => esc_html__('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-service .service-card .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'service_section_content_style',
			[
				'label' => esc_html__('Content', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'service_section_content_typography',
				'selector' => '{{WRAPPER}} .portio-service .service-card .content span',
			]
		);
		$this->add_control(
			'service_content_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-service .service-card .content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Service widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$service_style = !empty($settings['service_style']) ? $settings['service_style'] : '';
		$read_more_txt = !empty($settings['read_more_txt']) ? $settings['read_more_txt'] : '';
		$service_limit = !empty($settings['service_limit']) ? $settings['service_limit'] : '';
		$service_order = !empty($settings['service_order']) ? $settings['service_order'] : '';
		$service_orderby = !empty($settings['service_orderby']) ? $settings['service_orderby'] : '';
		$service_show_category = !empty($settings['service_show_category']) ? $settings['service_show_category'] : [];
		$service_show_id = !empty($settings['service_show_id']) ? $settings['service_show_id'] : [];
		$short_content = !empty($settings['short_content']) ? $settings['short_content'] : '';
		$excerpt_length = $short_content ? $short_content : '16';

		$read_more_txt = $read_more_txt ? $read_more_txt : esc_html__('Read More', 'portio-core');

		if ($service_style == 'style-one') {
			$service_wrapper = 'service-section-s3';
			$container = 'container';
			$col = 'col col-lg-4 col-md-6 col-12';
		} elseif( $service_style == 'style-two' ) {
			$service_wrapper = 'service-section-s2';
			$container = 'container';
			$col = 'col col-lg-4 col-md-6 col-12';
		} else {
			$service_wrapper = 'service-section-s4';
			$container = 'container-fluid';
			$col = 'col col-lg-3 col-md-6 col-12';
		}

		// Turn output buffer on
		ob_start();

		// Pagination
		global $paged;
		if (get_query_var('paged'))
			$my_page = get_query_var('paged');
		else {
			if (get_query_var('page'))
				$my_page = get_query_var('page');
			else
				$my_page = 1;
			set_query_var('paged', $my_page);
			$paged = $my_page;
		}

		if ($service_show_id) {
			$service_show_id = json_encode($service_show_id);
			$service_show_id = str_replace(array('[', ']'), '', $service_show_id);
			$service_show_id = str_replace(array('"', '"'), '', $service_show_id);
			$service_show_id = explode(',', $service_show_id);
		} else {
			$service_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'service',
			'posts_per_page' => (int)$service_limit,
			'service_category' => implode(',', $service_show_category),
			'orderby' => $service_orderby,
			'order' => $service_order,
			'post__in' => $service_show_id,
		);

		$portio_service = new \WP_Query($args);
		if ($portio_service->have_posts()) :
?>

			<div class="portio-service <?php echo esc_attr($service_wrapper); ?>" id="Services">
				<div class="<?php echo esc_attr($container); ?>">
					<div class="row">
						<?php
						$unique_id = 0;
						while ($portio_service->have_posts()) : $portio_service->the_post();
							$unique_id++;
							$service_options = get_post_meta(get_the_ID(), 'service_options', true);
							$service_icon = isset($service_options['service_icon']) ? $service_options['service_icon'] : '';
							$service_image = isset($service_options['service_image']) ? $service_options['service_image'] : '';

							$icon_url = wp_get_attachment_url($service_icon);
							$icon_alt = get_post_meta($service_icon, '_wp_attachment_image_alt', true);

							$image_url = wp_get_attachment_url($service_image);
							$image_alt = get_post_meta($service_image, '_wp_attachment_image_alt', true);
							global $post;

						?>
							<div class="<?php echo esc_attr($col); ?>">
								<div class="service-card scroll-text-animation" data-animation="fade_from_bottom">
									<?php if ($service_style == 'style-one') { ?>
										<div class="image">
											<?php if ($image_url) {
												echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '">';
											} ?>
										</div>
									<?php } ?>
									<div class="card-content">
										<div class="icon">
											<?php if ($icon_url) { ?>
												<img src="<?php echo esc_url($icon_url); ?>" alt="<?php echo esc_attr($icon_alt); ?>">
											<?php } ?>
										</div>
										<div class="content">
											<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h2>
											<span><?php echo wp_trim_words(get_the_excerpt(), $excerpt_length, ' '); ?></span>
										</div>
									</div>
								</div>
							</div>
						<?php
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</div>
				<?php if ($service_style == 'style-one') { ?>
					<div class="shape">
						<svg width="330" height="577" viewBox="0 0 330 577" fill="none">
							<circle cx="288.5" cy="288.5" r="288.5" fill="url(#paint0_radial_71_35)" fill-opacity="0.4" />
							<defs>
								<radialGradient id="paint0_radial_71_35" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(288.5 288.5) rotate(90) scale(288.5)">
									<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8" />
									<stop offset="1" stop-color="#1B1C1E" stop-opacity="0" />
								</radialGradient>
							</defs>
						</svg>
					</div>
				<?php } ?>
			</div>
<?php
		endif;
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Service widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Grafco_Service());
