<?php
/*
 * Elementor Portio Video Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Video extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-portio_video';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Video', 'portio-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-video-camera';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Portio Video widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-portio_video'];
	}

	/**
	 * Register Portio Video widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_video',
			[
				'label' => esc_html__('Video Options', 'portio-core'),
			]
		);

		$this->add_control(
			'video_image',
			[
				'label' => esc_html__('Video Image', 'portio-core'),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

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
			]
		);
		$this->end_controls_section(); // end: Section


		// Title
		$this->start_controls_section(
			'section_video_style',
			[
				'label' => esc_html__('Video', 'portio-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bg_border_color',
			[
				'label' => esc_html__('Image Border', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-section .video-wrap' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_bg_color',
			[
				'label' => esc_html__('Background', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-section .video-wrap .popup-video .popup-youtube' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_border_color',
			[
				'label' => esc_html__('Border', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-section .video-wrap .popup-video .popup-youtube' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'video_btn_icon_color',
			[
				'label' => esc_html__('Color', 'portio-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-section .video-wrap .popup-video .popup-youtube span' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section	

	}

	/**
	 * Render Video widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$bg_image = !empty( $settings['video_image']['id'] ) ? $settings['video_image']['id'] : '';

		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $bg_image , '_wp_attachment_image_alt', true);

		if ( $image_url ) {
			$bg_url = ' style="';
			$bg_url .= ( $image_url ) ? 'background-image: url( '. esc_url( $image_url ) .' );' : '';
			$bg_url .= '"';
		} else {
			$bg_url = '';
		}

		$video_link = !empty($settings['video_link']) ? $settings['video_link'] : '';
		// Turn output buffer on

		ob_start(); ?>

		<div class="video-section">
			<div class="video-wrap" <?php echo $bg_url; ?>>
				<div class="popup-video">
					<div class="ball">
						<a href="<?php echo esc_url($video_link); ?>" class="video-btn popup-youtube" data-type="iframe"><span></span></a>
					</div>
				</div>
			</div>
		</div>

<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Video widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register_widget_type(new Site_Video());
