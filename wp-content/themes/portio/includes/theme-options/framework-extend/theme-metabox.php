<?php
/*
 * All Metabox related options for Portio theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function portio_metabox_options($options)
{


  $header = get_posts('post_type="headerbuilder"&numberposts=-1');
  $headers = array('theme' => esc_html__('Default', 'portio'));
  if ($header) {
    foreach ($header as $head) {
      $headers[$head->ID] = $head->post_title;
    }
  }
  $footer = get_posts('post_type="footerbuilder"&numberposts=-1');
  $footers = array('theme' => esc_html__('Default', 'portio'));
  if ($footer) {
    foreach ($footer as $foot) {
      $footers[$foot->ID] = $foot->post_title;
    }
  }


  $options      = array();

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_type_metabox',
    'title'     => esc_html__('Post Options', 'portio'),
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_post_formats',
        'fields' => array(

          // Standard, Image
          array(
            'title' => 'Standard Image',
            'type'  => 'subheading',
            'content' => esc_html__('There is no Extra Option for this Post Format!', 'portio'),
            'wrap_class' => 'portio-minimal-heading hide-title',
          ),
          // Standard, Image

          // Gallery
          array(
            'type'    => 'notice',
            'title'   => 'Gallery Format',
            'wrap_class' => 'hide-title',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Gallery Format', 'portio')
          ),
          array(
            'id'          => 'gallery_post_format',
            'type'        => 'gallery',
            'title'       => esc_html__('Add Gallery', 'portio'),
            'add_title'   => esc_html__('Add Image(s)', 'portio'),
            'edit_title'  => esc_html__('Edit Image(s)', 'portio'),
            'clear_title' => esc_html__('Clear Image(s)', 'portio'),
          ),
          array(
            'type'    => 'text',
            'title'   => esc_html__('Add Video URL', 'portio'),
            'id'   => 'video_post_format',
            'desc' => esc_html__('Add youtube or vimeo video link', 'portio'),
            'wrap_class' => 'video_post_format',
          ),
          array(
            'type'    => 'icon',
            'title'   => esc_html__('Add Quote Icon', 'portio'),
            'id'   => 'quote_post_format',
            'desc' => esc_html__('Add Quote Icon here', 'portio'),
            'wrap_class' => 'quote_post_format',
          ),
          // Gallery

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Page Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_type_metabox',
    'title'     => esc_html__('Page Custom Options', 'portio'),
    'post_type' => array('post', 'page'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Title Section
      array(
        'name'  => 'page_topbar_section',
        'title' => esc_html__('Top Bar', 'portio'),
        'icon'  => 'fa fa-minus',

        // Fields Start
        'fields' => array(

          array(
            'id'           => 'topbar_options',
            'type'         => 'image_select',
            'title'        => esc_html__('Topbar', 'portio'),
            'options'      => array(
              'default'     => PORTIO_CS_IMAGES . '/topbar-default.png',
              'custom'      => PORTIO_CS_IMAGES . '/topbar-custom.png',
              'hide_topbar' => PORTIO_CS_IMAGES . '/topbar-hide.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'hide_topbar_select',
            ),
            'radio'     => true,
            'default'   => 'default',
          ),
          array(
            'id'          => 'top_left',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Left', 'portio'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'          => 'top_right',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Right', 'portio'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'    => 'topbar_bg',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Background Color', 'portio'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),
          array(
            'id'    => 'topbar_border',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Border Color', 'portio'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),

        ), // End : Fields

      ), // Title Section

      // Header
      array(
        'name'  => 'header_section',
        'title' => esc_html__('Header & Footer', 'portio'),
        'icon'  => 'fa fa-bars',
        'fields' => array(
          array(
            'id'           => 'select_header_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Header Design', 'portio'),
            'options'      => $headers,
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'     => true,
            'default'   => 'default',
            'info'      => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'portio'),
          ),
          array(
            'id'           => 'select_footer_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Footer Design', 'portio'),
            'options'      => $footers,
            'attributes' => array(
              'data-depend-id' => 'footer_design',
            ),
            'radio'     => true,
            'default'   => 'default',
            'info'      => esc_html__('Select your footer design, following options will may differ based on your selection of footer design.', 'portio'),
          ),
        ),
      ),
      // Header

      // Banner & Title Area
      array(
        'name'  => 'banner_title_section',
        'title' => esc_html__('Banner & Title Area', 'portio'),
        'icon'  => 'fa fa-bullhorn',
        'fields' => array(

          array(
            'id'        => 'banner_type',
            'type'      => 'select',
            'title'     => esc_html__('Choose Banner Type', 'portio'),
            'options'   => array(
              'default-title'    => 'Default Title',
              'revolution-slider' => 'Shortcode [Rev Slider]',
              'hide-title-area'   => 'Hide Title/Banner Area',
            ),
          ),
          array(
            'id'    => 'page_revslider',
            'type'  => 'textarea',
            'title' => esc_html__('Revolution Slider or Any Shortcodes', 'portio'),
            'desc' => __('Enter any shortcodes that you want to show in this page title area. <br />Eg : Revolution Slider shortcode.', 'portio'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your shortcode...', 'portio'),
            ),
            'dependency'   => array('banner_type', '==', 'revolution-slider'),
          ),
          array(
            'id'    => 'page_custom_title',
            'type'  => 'text',
            'title' => esc_html__('Custom Title', 'portio'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your custom title...', 'portio'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'        => 'title_area_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Title Area Spacings', 'portio'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'portio'),
              'padding-custom' => esc_html__('Custom Padding', 'portio'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'portio'),
            'attributes'  => array('placeholder' => '100px'),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'portio'),
            'attributes'  => array('placeholder' => '100px'),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_area_bg',
            'type'  => 'background',
            'title' => esc_html__('Background', 'portio'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'titlebar_bg_overlay_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Overlay Color', 'portio'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'portio'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

        ),
      ),
      // Banner & Title Area

      // Content Section
      array(
        'name'  => 'page_content_options',
        'title' => esc_html__('Content Options', 'portio'),
        'icon'  => 'fa fa-file',

        'fields' => array(

          array(
            'id'        => 'content_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Content Spacings', 'portio'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'portio'),
              'padding-custom' => esc_html__('Custom Padding', 'portio'),
            ),
            'desc' => esc_html__('Content area top and bottom spacings.', 'portio'),
          ),
          array(
            'id'    => 'content_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'portio'),
            'attributes'  => array('placeholder' => '100px'),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'content_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'portio'),
            'attributes'  => array('placeholder' => '100px'),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
        ), // End Fields
      ), // Content Section

      // Enable & Disable
      array(
        'name'  => 'hide_show_section',
        'title' => esc_html__('Enable & Disable', 'portio'),
        'icon'  => 'fa fa-toggle-on',
        'fields' => array(

          array(
            'id'    => 'hide_header',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Header', 'portio'),
            'label' => esc_html__('Yes, Please do it.', 'portio'),
          ),
          array(
            'id'    => 'hide_breadcrumbs',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Breadcrumbs', 'portio'),
            'label' => esc_html__('Yes, Please do it.', 'portio'),
          ),
          array(
            'id'    => 'hide_footer',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Footer', 'portio'),
            'label' => esc_html__('Yes, Please do it.', 'portio'),
          ),

        ),
      ),
      // Enable & Disable

    ),
  );

  // -----------------------------------------
  // Page Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_layout_options',
    'title'     => esc_html__('Page Layout', 'portio'),
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'page_layout_section',
        'fields' => array(

          array(
            'id'        => 'page_layout',
            'type'      => 'image_select',
            'options'   => array(
              'full-width'    => PORTIO_CS_IMAGES . '/page-1.png',
              'extra-width'   => PORTIO_CS_IMAGES . '/page-2.png',
              'left-sidebar'  => PORTIO_CS_IMAGES . '/page-3.png',
              'right-sidebar' => PORTIO_CS_IMAGES . '/page-4.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'page_layout',
            ),
            'default'    => 'full-width',
            'radio'      => true,
            'wrap_class' => 'text-center',
          ),
          array(
            'id'            => 'page_sidebar_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'portio'),
            'options'        => portio_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'portio'),
            'dependency'   => array('page_layout', 'any', 'left-sidebar,right-sidebar'),
          ),

        ),
      ),

    ),
  );





  // -----------------------------------------
  // Service
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'service_options',
    'title'     => esc_html__('Service Meta', 'portio'),
    'post_type' => 'service',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'service_infos',
        'fields' => array(
          array(
            'id'           => 'service_icon',
            'type'         => 'image',
            'title'        => esc_html__('Service Icon', 'portio'),
            'add_title' => esc_html__('Service Icon', 'portio'),
            'info'    => esc_html__('Attached Icon.', 'portio'),
          ),
          array(
            'id'           => 'service_image',
            'type'         => 'image',
            'title'        => esc_html__('Service Image', 'portio'),
            'add_title' => esc_html__('Service Image', 'portio'),
            'info'    => esc_html__('Attached Image.', 'portio'),
          ),

        ),
      ),
    ),
  );

  if (class_exists('WooCommerce')) {
    // -----------------------------------------
    // Product
    // -----------------------------------------
    $options[]    = array(
      'id'        => 'portio_woocommerce_section',
      'title'     => esc_html__('Product Title', 'portio'),
      'post_type' => 'product',
      'context'   => 'normal',
      'priority'  => 'high',
      'sections'  => array(

        // All Post Formats
        array(
          'name'   => 'portio_single_title',
          'fields' => array(
            array(
              'id'          => 'portio_product_title',
              'type'        => 'text',
              'title'       => esc_html__('Single Title', 'portio'),
              'attributes' => array(
                'placeholder' => 'The Title Gose Here'
              ),
            ),

          ),
        ),

      ),
    );
  }
  // -----------------------------------------
  // Donation Forms
  // -----------------------------------------
  $options[]    = array(
    'id'        => '_donation_form_metabox',
    'title'     => esc_html__('Donation Deadline', 'portio'),
    'post_type' => 'give_forms',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_deadline',
        'fields' => array(
          array(
            'id'          => 'donation_deadline',
            'type'        => 'text',
            'title'       => esc_html__('Deadline Date', 'portio'),
            'attributes' => array(
              'placeholder' => 'DD/MM/YYYY'
            ),
          ),
          // Gallery

        ),
      ),

    ),
  );


  // -----------------------------------------
  // Team
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'team_options',
    'title'     => esc_html__('Team Meta', 'portio'),
    'post_type' => 'team',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'team_infos',
        'fields' => array(
          array(
            'title'   => esc_html__('Team Sub Title', 'portio'),
            'id'      => 'team_subtitle',
            'type'    => 'text',
            'attributes' => array(
              'placeholder' => esc_html__('product designer', 'portio'),
            ),
            'info'    => esc_html__('Write Team Subtitle.', 'portio'),
          ),

        ),
      ),
    ),
  );


  // -----------------------------------------
  // Causes
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'causes_options',
    'title'     => esc_html__('Causes Extra Options', 'portio'),
    'post_type' => 'give_forms',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'causes_option_section',
        'fields' => array(
          array(
            'id'           => 'causes_image',
            'type'         => 'image',
            'title'        => esc_html__('Causes Image', 'portio'),
            'add_title' => esc_html__('Add Causes Image', 'portio'),
          ),
          array(
            'id'           => 'causes_slide_image',
            'type'         => 'image',
            'title'        => esc_html__('Grid Image', 'portio'),
            'add_title' => esc_html__('Add Carousel Image', 'portio'),
          ),
        ),
      ),

    ),
  );

  return $options;
}
add_filter('cs_metabox_options', 'portio_metabox_options');
