<?php
/*
 * Elementor Portio Blog Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Blog extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_blog';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Blog', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-post-list';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Blog widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_blog'];
	}

	/**
	 * Register Portio Blog widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$posts = get_posts('post_type="post"&numberposts=-1');
		$PostID = array();
		if ($posts) {
			foreach ($posts as $post) {
				$PostID[$post->ID] = $post->ID;
			}
		} else {
			$PostID[__('No ID\'s found', 'portio')] = 0;
		}


		$this->start_controls_section(
			'section_blog_metas',
			[
				'label' => esc_html__('Meta\'s Options', 'portio-core'),
			]
		);
		$this->add_control(
			'blog_image',
			[
				'label' => esc_html__('Image', 'portio-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'portio-core'),
				'label_off' => esc_html__('Hide', 'portio-core'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->add_control(
			'blog_date',
			[
				'label' => esc_html__('Date', 'portio-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'portio-core'),
				'label_off' => esc_html__('Hide', 'portio-core'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->add_control(
			'blog_author',
			[
				'label' => esc_html__('Author', 'portio-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'portio-core'),
				'label_off' => esc_html__('Hide', 'portio-core'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->add_control(
			'meta_icon1',
			[
				'label' => __('Date Icon', 'portio-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'ti-calendar',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'meta_icon2',
			[
				'label' => __('Comment Icon', 'portio-core'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'ti-comment-alt',
					'library' => 'solid',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		$this->start_controls_section(
			'section_blog_listing',
			[
				'label' => esc_html__('Listing Options', 'portio-core'),
			]
		);
		$this->add_control(
			'blog_limit',
			[
				'label' => esc_html__('Blog Limit', 'portio-core'),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__('Enter the number of items to show.', 'portio-core'),
			]
		);
		$this->add_control(
			'blog_order',
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
			'blog_orderby',
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
			'blog_show_category',
			[
				'label' => __('Certain Categories?', 'portio-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names('category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'blog_show_id',
			[
				'label' => __('Certain ID\'s?', 'portio-core'),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->add_control(
			'blog_pagination',
			[
				'label' => esc_html__('Pagination', 'portio-core'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'portio-core'),
				'label_off' => esc_html__('Hide', 'portio-core'),
				'return_value' => 'true',
				'default' => 'true',
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
				'default' => 'Read More',
				'placeholder' => esc_html__('Type your Read More text here', 'portio-core'),
			]
		);
		$this->end_controls_section(); // end: Section


		// Item Box
		$this->start_controls_section(
			'blog_section_box_style',
			[
				'label' => esc_html__('Blog Card Design', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'blog_section_box_bg_color',
			[
				'label' => esc_html__('Bg Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .content' => 'background-color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'blog_section_box_padding',
			[
				'label' => esc_html__('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Date
		$this->start_controls_section(
			'blog_section_date_style',
			[
				'label' => esc_html__('Meta', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'portio-core'),
				'name' => 'portio_date_typography',
				'selector' => '{{WRAPPER}} .blog-section .blog-card .content ul li',
			]
		);
		$this->add_control(
			'date_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .content ul li, .blog-section .blog-card .content ul li a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'date_padding',
			[
				'label' => esc_html__('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .content ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .blog-section .blog-card .content h2 a',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .content h2 a' => 'color: {{VALUE}};'
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__('Padding', 'portio-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .blog-section .blog-card .content h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$blog_limit = !empty($settings['blog_limit']) ? $settings['blog_limit'] : '';
		$blog_image  = (isset($settings['blog_image']) && ('true' == $settings['blog_image'])) ? true : false;
		$blog_date  = (isset($settings['blog_date']) && ('true' == $settings['blog_date'])) ? true : false;
		$blog_tags  = (isset($settings['blog_tags']) && ('true' == $settings['blog_tags'])) ? true : false;

		$blog_author  = (isset($settings['blog_author']) && ('true' == $settings['blog_author'])) ? true : false;

		$blog_order = !empty($settings['blog_order']) ? $settings['blog_order'] : '';
		$blog_orderby = !empty($settings['blog_orderby']) ? $settings['blog_orderby'] : '';
		$blog_show_category = !empty($settings['blog_show_category']) ? $settings['blog_show_category'] : [];
		$blog_show_id = !empty($settings['blog_show_id']) ? $settings['blog_show_id'] : [];
		$blog_pagination  = (isset($settings['blog_pagination']) && ('true' == $settings['blog_pagination'])) ? true : false;

		$short_content = !empty($settings['short_content']) ? $settings['short_content'] : '';
		$excerpt_length = $short_content ? $short_content : '16';

		$read_more_txt = !empty($settings['read_more_txt']) ? $settings['read_more_txt'] : '';


		$meta_icon1 = !empty($settings['meta_icon1']['value']) ? $settings['meta_icon1']['value'] : '';
		$meta_icon1_svg_url = !empty($settings['meta_icon1']['value']['url']) ? $settings['meta_icon1']['value']['url'] : '';
		$svg_alt = get_post_meta($meta_icon1_svg_url, '_wp_attachment_image_alt', true);

		$meta_icon2 = !empty($settings['meta_icon2']['value']) ? $settings['meta_icon2']['value'] : '';
		$meta_icon2_svg_url = !empty($settings['meta_icon2']['value']['url']) ? $settings['meta_icon2']['value']['url'] : '';
		$svg_alt = get_post_meta($meta_icon2_svg_url, '_wp_attachment_image_alt', true);



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

		if ($blog_show_id) {
			$blog_show_id = json_encode($blog_show_id);
			$blog_show_id = str_replace(array('[', ']'), '', $blog_show_id);
			$blog_show_id = str_replace(array('"', '"'), '', $blog_show_id);
			$blog_show_id = explode(',', $blog_show_id);
		} else {
			$blog_show_id = '';
		}

		$args = array(
			// other query params here,
			'paged' => $my_page,
			'post_type' => 'post',
			'posts_per_page' => (int)$blog_limit,
			'category_name' => implode(',', $blog_show_category),
			'orderby' => $blog_orderby,
			'order' => $blog_order,
			'post__in' => $blog_show_id,
		);

		$portio_post = new \WP_Query($args); ?>

		<div class="blog-section">
			<div class="container">
				<div class="row">
					<?php
					if ($portio_post->have_posts()) : while ($portio_post->have_posts()) : $portio_post->the_post();

							$portio_post_image =  wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'portio-post-image-one', false, '');
							$portio_post_alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
					?>

							<div class="col-md-6 col-12 scroll-text-animation" data-animation="fade_from_bottom">
								<div class="blog-card">
									<div class="image">
										<?php if ($portio_post_image) { ?>
											<img src="<?php echo esc_url($portio_post_image['0']); ?>" alt="<?php echo esc_attr($portio_post_alt); ?>">
										<?php } ?>
									</div>
									<div class="content">
										<ul>
											<?php if ($blog_date) { ?>
												<li>
													<?php
													if ($meta_icon1_svg_url) {
														echo '<img class="default-icon"  src="' . esc_url($meta_icon1_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
													} else {
														echo '<i class="' . esc_attr($meta_icon1) . '"></i>';
													}
													?>
													<?php the_time('d M Y'); ?></li>
											<?php } ?>
											<?php if ($blog_author) { ?>
												<li>
													<a class="portio-comment" href="<?php echo esc_url(get_comments_link()); ?>">
														<?php
														if ($meta_icon2_svg_url) {
															echo '<img class="default-icon"  src="' . esc_url($meta_icon2_svg_url) . '" alt="' . esc_url($svg_alt) . '">';
														} else {
															echo '<i class="' . esc_attr($meta_icon2) . '"></i>';
														}
														?>
														<?php printf(esc_html(_nx('Comment (%1$s)', 'Comments (%1$s)', get_comments_number(), 'comments title', 'hostar')), '<span class="comment">' . number_format_i18n(get_comments_number()) . '</span>', '<span>' . get_the_title() . '</span>'); ?>
													</a>
												</li>
											<?php } ?>
										</ul>
										<h2>
											<a href="<?php echo esc_url(get_permalink()); ?>">
												<?php echo esc_html(get_the_title()); ?>
											</a>
										</h2>
									</div>
								</div>
							</div>
						<?php
						endwhile;
					endif;
					wp_reset_postdata();
					if ($blog_pagination) { ?>
						<div class="page-pagination-wrap">
							<?php echo '<div class="paginations">';
							$big = 999999999;
							echo paginate_links(array(
								'base'      => str_replace($big, '%#%', get_pagenum_link($big)),
								'format'    => '?paged=%#%',
								'total'     => $portio_post->max_num_pages,
								'show_all'  => false,
								'current'   => max(1, $my_page),
								'prev_text'    => '<div class="fi flaticon-back"></div>',
								'next_text'    => '<div class="fi flaticon-next"></div>',
								'mid_size'  => 1,
								'type'      => 'list'
							));
							echo '</div>'; ?>
						</div>
					<?php } ?>
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
Plugin::instance()->widgets_manager->register(new Site_Blog());
