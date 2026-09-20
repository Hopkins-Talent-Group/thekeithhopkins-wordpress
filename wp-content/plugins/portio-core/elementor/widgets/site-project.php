<?php
/*
 * Elementor Portio Project Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Project extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_project';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Project', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-folder-o';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Project widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_project'];
	}

	/**
	 * Register Portio Project widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{


		$posts = get_posts('post_type="project"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'portio')] = 0;
		}

		$this->start_controls_section(
			'section_project_listing',
			[
				'label' => esc_html__('Listing Options', 'portio-core'),
			]
		);
		$this->add_control(
			'project_style',
			[
				'label' => esc_html__('Project Style', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'portio-core'),
					'style-two' => esc_html__('Style two', 'portio-core'),
					'style-three' => esc_html__('Style three', 'portio-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your project style.', 'portio-core'),
			]
		);
		$this->add_control(
			'section_subtitle',
			[
				'label' => esc_html__('Sub Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Sub Title Text', 'portio-core'),
				'placeholder' => esc_html__('Type subtitle text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' => esc_html__('Title Text', 'portio-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'section_content',
			[
				'label' => esc_html__('description Text', 'portio-core'),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__('description Text', 'portio-core'),
				'placeholder' => esc_html__('Type title text here', 'portio-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'project_limit',
			[
				'label' => esc_html__('Project Limit', 'portio-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'portio-core'),
			]
		);
		$this->add_control(
			'project_order',
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
			'project_orderby',
			[
				'label' => __('Order By', 'portio-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__('None', 'portio-core'),
					'ID' => esc_html__('ID', 'portio-core'),
					'author' => esc_html__('Author', 'portio-core'),
					'title' => esc_html__('Title', 'portio-core'),
					'date' => esc_html__('Date', 'portio-core'),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'project_show_category',
			[
				'label' => __('Certain Categories?', 'portio-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('project_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'project_show_id',
			[
				'label' => __('Certain ID\'s?', 'portio-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->end_controls_section(); // end: Section

		// Sub Title
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__('Section Sub Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'portio_subtitle_typography',
				'selector' => '{{WRAPPER}} .section-top-content-s2 h2',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_border_color',
			[
				'label' => esc_html__('Border Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 h2' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => __('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Section Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'portio_title_typography',
				'selector' => '{{WRAPPER}} .section-top-content-s2 h3',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 h3' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .section-top-content-s2 h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__('Section Title Content', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'portio_content_typography',
				'selector' => '{{WRAPPER}} .section-top-content-s2 p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => __('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .section-top-content-s2 p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Project Body
		$this->start_controls_section(
			'section_project_body_style',
			[
				'label' => esc_html__('Project Card', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'project_content_bg',
			[
				'label' => esc_html__('Background Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-project .protfolio-card .text' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'project_content_padding',
			[
				'label' => esc_html__('Content Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-project .protfolio-card .text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section



		// Project Title
		$this->start_controls_section(
			'section_project_title_style',
			[
				'label' => esc_html__('Project Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_project_title_typography',
				'selector' => '{{WRAPPER}} .portio-project .protfolio-card .text h2 a',
			]
		);
		$this->add_control(
			'project_title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-project .protfolio-card .text h2 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'project_title_hover_color',
			[
				'label' => esc_html__('Hover Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-project .protfolio-card .text h2 a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'project_title_padding',
			[
				'label' => esc_html__('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-project .protfolio-card .text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// content
		$this->start_controls_section(
			'project_subtitle_style',
			[
				'label' => esc_html__('Project Subtitle', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'project_subtitle_typography',
				'selector' => '{{WRAPPER}} .portio-project .protfolio-card .text span',
			]
		);
		$this->add_control(
			'project_subtitle_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .portio-project .protfolio-card .text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'project_subtitle_padding',
			[
				'label' => __('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .portio-project .protfolio-card .text span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Project widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$project_style = !empty($settings['project_style']) ? $settings['project_style'] : '';
		$project_limit = !empty($settings['project_limit']) ? $settings['project_limit'] : '';
		$project_order = !empty($settings['project_order']) ? $settings['project_order'] : '';
		$project_orderby = !empty($settings['project_orderby']) ? $settings['project_orderby'] : '';
		$project_show_category = !empty($settings['project_show_category']) ? $settings['project_show_category'] : [];
		$project_show_id = !empty($settings['project_show_id']) ? $settings['project_show_id'] : [];
		$short_content = !empty($settings['short_content']) ? $settings['short_content'] : '';
		$excerpt_length = $short_content ? $short_content : '16';

		$section_subtitle = !empty($settings['section_subtitle']) ? $settings['section_subtitle'] : '';
		$section_title = !empty($settings['section_title']) ? $settings['section_title'] : '';
		$section_content = !empty($settings['section_content']) ? $settings['section_content'] : '';

		$section_title = preg_replace('~\s*<br ?/?>\s*~', " <br/>", $section_title);
		$section_title = nl2br($section_title);


		if ($project_style == 'style-one') {
			$project_wrapper = 'portfolio-section-s3';
			$container = 'container';
			$col = 'col col-md-6 col-12';
		} elseif ($project_style == 'style-two') {
			$project_wrapper = 'portfolio-section-s4';
			$container = 'container';
			$col = 'col col-md-6 col-12';
		} else {
			$project_wrapper = 'portfolio-section-s7';
			$container = 'container-fluid';
			$col = 'col-xl-3 col-lg-6 col-md-6 col-12';
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

		if ($project_show_id) {
			$project_show_id = json_encode($project_show_id);
			$project_show_id = str_replace(array('[', ']'), '', $project_show_id);
			$project_show_id = str_replace(array('"', '"'), '', $project_show_id);
			$project_show_id = explode(',', $project_show_id);
		} else {
			$project_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'project',
			'posts_per_page' => (int)$project_limit,
			'project_category' => implode(',', $project_show_category),
			'orderby' => $project_orderby,
			'order' => $project_order,
			'post__in' => $project_show_id,
		);

		$portio_project = new \WP_Query($args);

?>
		<div class="portio-project  <?php echo esc_attr($project_wrapper); ?>" id="Portfolio">
			<div class="<?php echo esc_attr($container); ?>">
				<?php if ($project_style == 'style-one' || $project_style == 'style-two') { ?>
					<div class="row">
						<div class="col-lg-6  col-12">
							<div class="section-top-content-s2">
								<?php
								if ($section_subtitle) {
									echo '<h2 class="poort-text poort-in-right">' . esc_html($section_subtitle) . '</h2>';
								}
								if ($section_title) {
									echo '<h3 class="poort-text poort-in-right">' . esc_html($section_title) . '</h3>';
								}
								if ($section_content) {
									echo '<p>' . esc_html($section_content) . '</p>';
								}
								?>
							</div>
						</div>
					</div>
				<?php } ?>
				<div class="gallery-filters">
					<div class="row gallery-container">
						<?php
						if ($portio_project->have_posts()) : while ($portio_project->have_posts()) : $portio_project->the_post();
								global $post;

								$project_options = get_post_meta(get_the_ID(), 'project_options', true);

								$large_image =  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '');

						?>
								<div class="<?php echo esc_attr($col); ?>">
									<div class="protfolio-card">
										<div class="image">
											<?php if ($large_image) {
												echo '<img class="thumbnail" src="' . esc_url($large_image['0']) . '" alt="dg">';
											} ?>
										</div>
										<div class="text">
											<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h2>
											<span><?php echo wp_trim_words(get_the_excerpt(), $excerpt_length, ' '); ?></span>
										</div>
									</div>
								</div>

						<?php
							endwhile;
						endif;
						wp_reset_postdata();
						?>

					</div>
				</div>
			</div>
			<div class="shape">
				<svg width="478" height="478" viewBox="0 0 478 478" fill="none">
					<circle cx="239" cy="239" r="239" fill="url(#paint0_radial_56_1806)" fill-opacity="0.6" />
					<defs>
						<radialGradient id="paint0_radial_56_1806" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(239 239) rotate(90) scale(239)">
							<stop offset="0" stop-color="#C4EF17" stop-opacity="0.8" />
							<stop offset="1" stop-color="#1B1C1E" stop-opacity="0" />
						</radialGradient>
					</defs>
				</svg>
			</div>
		</div>
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Project widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Project());
