<?php
/*
 * Elementor Portio Team Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Grafco_Teams extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_teams';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Team Single', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-person';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Team widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_teams'];
	}

	/**
	 * Register Portio Team widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{


		$posts = get_posts('post_type="team"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'portio')] = 0;
		}

		$this->start_controls_section(
			'section_team_listing',
			[
				'label' => esc_html__('Team Options', 'portio-core'),
			]
		);
		$this->add_control(
			'team_limit',
			[
				'label' => esc_html__('Team Limit', 'portio-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'portio-core'),
			]
		);
		$this->add_control(
			'team_order',
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
			'team_orderby',
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
			'team_show_category',
			[
				'label' => __('Certain Categories?', 'portio-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('team_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'team_show_id',
			[
				'label' => __('Certain ID\'s?', 'portio-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->end_controls_section(); // end: Section



		// Image Border
		$this->start_controls_section(
			'team_section_image_style',
			[
				'label' => esc_html__('Image Border Color All', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_image_border_color',
				'label' => esc_html__('Border', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .speaker-single .image',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Border Color All', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Image Border 1
		$this->start_controls_section(
			'team_section_image_style1',
			[
				'label' => esc_html__('Image Border Color 1', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_image_border_color1',
				'label' => esc_html__('Border', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(1) .speaker-single .image',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Border Color 1', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Image Border 2
		$this->start_controls_section(
			'team_section_image_style2',
			[
				'label' => esc_html__('Image Border Color 2', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_image_border_color2',
				'label' => esc_html__('Border', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(2) .speaker-single .image',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Border Color 2', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Image Border 3
		$this->start_controls_section(
			'team_section_image_style3',
			[
				'label' => esc_html__('Image Border Color 3', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_image_border_color3',
				'label' => esc_html__('Border', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(3) .speaker-single .image',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Border Color 3', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Image Border 4
		$this->start_controls_section(
			'team_section_image_style4',
			[
				'label' => esc_html__('Image Border Color 4', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_image_border_color4',
				'label' => esc_html__('Border', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(4) .speaker-single .image',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Border Color 4', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Image Border 5
		$this->start_controls_section(
			'team_section_image_style5',
			[
				'label' => esc_html__('Image Border Color 5', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_image_border_color5',
				'label' => esc_html__('Border', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(5) .speaker-single .image',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Border Color 5', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section



		// Title
		$this->start_controls_section(
			'team_section_title_style',
			[
				'label' => esc_html__('Title', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'team_portio_title_typography',
				'selector' => '{{WRAPPER}} .speaker-single .content h2 a',
			]
		);
		$this->add_control(
			'team_title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .speaker-single .content h2 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_title_padding',
			[
				'label' => esc_html__('Title Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .speaker-single .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Subtitle
		$this->start_controls_section(
			'team_section_subtitle_style',
			[
				'label' => esc_html__('Subtitle', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'team_subtitle_typography',
				'selector' => '{{WRAPPER}} .speaker-single .content span',
			]
		);
		$this->add_control(
			'team_subtitle_color',
			[
				'label' => esc_html__('Color All', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .speaker-single .content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_subtitle_color1',
			[
				'label' => esc_html__('Color 1', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .speaker-section .col:nth-child(1) .speaker-single .content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_subtitle_color2',
			[
				'label' => esc_html__('Color 2', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .speaker-section .col:nth-child(2) .speaker-single .content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_subtitle_color3',
			[
				'label' => esc_html__('Color 3', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .speaker-section .col:nth-child(3) .speaker-single .content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_subtitle_color4',
			[
				'label' => esc_html__('Color 4', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .speaker-section .col:nth-child(4) .speaker-single .content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_subtitle_color5',
			[
				'label' => esc_html__('Color 5', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .speaker-section .col:nth-child(5) .speaker-single .content span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'team_subtitle_padding',
			[
				'label' => esc_html__('Subtitle Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .speaker-single .content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content Bg All
		$this->start_controls_section(
			'team_section_box_bg',
			[
				'label' => esc_html__('Content Box Bg', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_section_box_color',
				'label' => esc_html__('Border', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .speaker-single .content',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Bg Color All', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content Bg1 All
		$this->start_controls_section(
			'team_section_box_bg1',
			[
				'label' => esc_html__('Content Box Bg 1', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_section_box_color1',
				'label' => esc_html__('BG', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(1) .speaker-single .content',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Bg Color 1', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section
		
		// Content Bg2 All
		$this->start_controls_section(
			'team_section_box_bg2',
			[
				'label' => esc_html__('Content Box Bg 2', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_section_box_color2',
				'label' => esc_html__('BG', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(2) .speaker-single .content',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Bg Color 2', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content Bg3 All
		$this->start_controls_section(
			'team_section_box_bg3',
			[
				'label' => esc_html__('Content Box Bg 3', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_section_box_color3',
				'label' => esc_html__('BG', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(3) .speaker-single .content',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Bg Color 3', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content Bg4 All
		$this->start_controls_section(
			'team_section_box_bg4',
			[
				'label' => esc_html__('Content Box Bg 4', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_section_box_color4',
				'label' => esc_html__('BG', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(4) .speaker-single .content',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Bg Color 4', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content Bg5 All
		$this->start_controls_section(
			'team_section_box_bg5',
			[
				'label' => esc_html__('Content Box Bg 5', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'team_section_box_color5',
				'label' => esc_html__('BG', 'portio-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .speaker-section .col:nth-child(5) .speaker-single .content',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Bg Color 5', 'portio-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Team widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$team_limit = !empty($settings['team_limit']) ? $settings['team_limit'] : '';
		$team_order = !empty($settings['team_order']) ? $settings['team_order'] : '';
		$team_orderby = !empty($settings['team_orderby']) ? $settings['team_orderby'] : '';
		$team_show_category = !empty($settings['team_show_category']) ? $settings['team_show_category'] : [];
		$team_show_id = !empty($settings['team_show_id']) ? $settings['team_show_id'] : [];


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

		if ($team_show_id) {
			$team_show_id = json_encode($team_show_id);
			$team_show_id = str_replace(array('[', ']'), '', $team_show_id);
			$team_show_id = str_replace(array('"', '"'), '', $team_show_id);
			$team_show_id = explode(',', $team_show_id);
		} else {
			$team_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'team',
			'posts_per_page' => (int)$team_limit,
			'team_category' => implode(',', $team_show_category),
			'orderby' => $team_orderby,
			'order' => $team_order,
			'post__in' => $team_show_id,
		);

		$portio_team = new \WP_Query($args);

?>

		<div class="speaker-section">
			<div class="container">
				<div class="row justify-content-center">
					<?php
					if ($portio_team->have_posts()) : while ($portio_team->have_posts()) : $portio_team->the_post();

							$team_options = get_post_meta(get_the_ID(), 'team_options', true);
							$team_subtitle = isset($team_options['team_subtitle']) ? $team_options['team_subtitle'] : '';
							global $post;

							$portio_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
							$portio_alt = get_post_meta( get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);

					?>

							<div class="col col-lg-4 col-md-6 col-12">
								<div class="speaker-single">
									<div class="image">
										<?php if ($portio_large_image) {
											echo '<img src="' . esc_url($portio_large_image['0']) . '" alt="' . esc_attr($portio_alt) . '">';
										} ?>
									</div>
									<div class="content">
										<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_title(); ?></a></h2>
										<?php if ($team_subtitle) {
											echo '<span>' . esc_html($team_subtitle) . '</span>';
										} ?>
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
<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Team widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Grafco_Teams());
