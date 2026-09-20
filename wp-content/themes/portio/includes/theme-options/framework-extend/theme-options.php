<?php
/*
 * All Theme Options for Portio theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function portio_settings( $settings ) {

  $settings           = array(
    'menu_title'      => PORTIO_NAME . esc_html__(' Options', 'portio'),
    'menu_slug'       => sanitize_title(PORTIO_NAME) . '_options',
    'menu_type'       => 'theme',
    'menu_icon'       => 'dashicons-awards',
    'menu_position'   => '4',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => PORTIO_NAME .' <small>V-'. PORTIO_VERSION .' by <a href="'. PORTIO_BRAND_URL .'" target="_blank">'. PORTIO_BRAND_NAME .'</a></small>',
  );

  return $settings;

}
add_filter( 'cs_framework_settings', 'portio_settings' );

// Theme Framework Options
function portio_options( $options ) {

  $header = get_posts( 'post_type="headerbuilder"&numberposts=-1' );
  $headers = array( 'default' => esc_html__( 'Default', 'portio' ) );
  if ( $header ) {
    foreach ( $header as $head ) {
      $headers[ $head->ID ] = $head->post_title;
    }
  }
  $footer = get_posts( 'post_type="footerbuilder"&numberposts=-1' );
  $footers = array( 'default' => esc_html__( 'Default', 'portio' ));
  if ( $footer ) {
    foreach ( $footer as $foot ) {
      $footers[ $foot->ID ] = $foot->post_title;
    }
  }

  $options      = array(); // remove old options

  // ------------------------------
  // Branding
  // ------------------------------
  $options[]   = array(
    'name'     => 'portio_theme_branding',
    'title'    => esc_html__('Site Brand', 'portio'),
    'icon'     => 'fa fa-address-book-o',
    'sections' => array(

      // brand logo tab
      array(
        'name'     => 'brand_logo',
        'title'    => esc_html__('Logo', 'portio'),
        'icon'     => 'fa fa-picture-o',
        'fields'   => array(

          // Site Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Site Logo', 'portio')
          ),
          array(
            'id'    => 'portio_logo',
            'type'  => 'image',
            'title' => esc_html__('Default Logo', 'portio'),
            'info'  => esc_html__('Upload your default logo here. If you not upload, then site title will load in this logo location.', 'portio'),
            'add_title' => esc_html__('Add Logo', 'portio'),
          ),
          array(
            'id'          => 'portio_logo_top',
            'type'        => 'number',
            'title'       => esc_html__('Logo Top Space', 'portio'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'portio_logo_bottom',
            'type'        => 'number',
            'title'       => esc_html__('Logo Bottom Space', 'portio'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          // WordPress Admin Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('WordPress Admin Logo', 'portio')
          ),
          array(
            'id'    => 'brand_logo_wp',
            'type'  => 'image',
            'title' => esc_html__('Login logo', 'portio'),
            'info'  => esc_html__('Upload your WordPress login page logo here.', 'portio'),
            'add_title' => esc_html__('Add Login Logo', 'portio'),
          ),
        ) // end: fields
      ), // end: section
    ),
  );

  // ------------------------------
  // Layout
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_layout',
    'title'  => esc_html__('Theme Layout', 'portio'),
    'icon'   => 'fa fa-th-large'
  );

  $options[]      = array(
    'name'        => 'theme_general',
    'title'       => esc_html__('General Settings', 'portio'),
    'icon'        => 'fa fa-cog',

    // begin: fields
    'fields'      => array(

      // -----------------------------
      // Begin: Responsive
      // -----------------------------
       array(
        'id'    => 'theme_responsive',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Responsive', 'portio'),
        'info' => esc_html__('Turn on if you don\'t want your site to be responsive.', 'portio'),
        'default' => false,
      ),
      array(
        'id'    => 'theme_preloder',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Preloder', 'portio'),
        'info' => esc_html__('Turn off if you don\'t want your site to be Preloder.', 'portio'),
        'default' => true,
      ),
       array(
        'id'    => 'preloader_image',
        'type'  => 'image',
        'title' => esc_html__('Preloader Logo', 'portio'),
        'info'  => esc_html__('Upload your preoader logo here. If you not upload, then site preoader will load in this preloader location.', 'portio'),
        'add_title' => esc_html__('Add Logo', 'portio'),
        'dependency' => array( 'theme_preloder', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_width',
        'type'  => 'image_select',
        'title' => esc_html__('Full Width & Extra Width', 'portio'),
        'info' => esc_html__('Boxed or Fullwidth? Choose your site layout width. Default : Full Width', 'portio'),
        'options'      => array(
          'container'    => PORTIO_CS_IMAGES .'/boxed-width.jpg',
          'container-fluid'    => PORTIO_CS_IMAGES .'/full-width.jpg',
        ),
        'default'      => 'container-fluid',
        'radio'      => true,
      ),
       array(
        'id'    => 'theme_page_comments',
        'type'  => 'switcher',
        'title' => esc_html__('Hide Page Comments?', 'portio'),
        'label' => esc_html__('Yes! Hide Page Comments.', 'portio'),
        'on_text' => esc_html__('Yes', 'portio'),
        'off_text' => esc_html__('No', 'portio'),
        'default' => false,
      ),
      array(
        'type'    => 'notice',
        'class'   => 'info cs-portio-heading',
        'content' => esc_html__('Background Options', 'portio'),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'             => 'theme_layout_bg_type',
        'type'           => 'select',
        'title'          => esc_html__('Background Type', 'portio'),
        'options'        => array(
          'bg-image' => esc_html__('Image', 'portio'),
          'bg-pattern' => esc_html__('Pattern', 'portio'),
        ),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_bg_pattern',
        'type'  => 'image_select',
        'title' => esc_html__('Background Pattern', 'portio'),
        'info' => esc_html__('Select background pattern', 'portio'),
        'options'      => array(
          'pattern-1'    => PORTIO_CS_IMAGES . '/pattern-1.png',
          'pattern-2'    => PORTIO_CS_IMAGES . '/pattern-2.png',
          'pattern-3'    => PORTIO_CS_IMAGES . '/pattern-3.png',
          'pattern-4'    => PORTIO_CS_IMAGES . '/pattern-4.png',
          'custom-pattern'  => PORTIO_CS_IMAGES . '/pattern-5.png',
        ),
        'default'      => 'pattern-1',
        'radio'      => true,
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-pattern' ),
      ),
      array(
        'id'      => 'custom_bg_pattern',
        'type'    => 'upload',
        'title'   => esc_html__('Custom Pattern', 'portio'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type|theme_layout_bg_pattern_custom-pattern', '==|==|==', 'true|bg-pattern|true' ),
        'info' => __('Select your custom background pattern. <br />Note, background pattern image will be repeat in all x and y axis. So, please consider all repeatable area will perfectly fit your custom patterns.', 'portio'),
      ),
      array(
        'id'      => 'theme_layout_bg',
        'type'    => 'background',
        'title'   => esc_html__('Background', 'portio'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-image' ),
      ),

    ), // end: fields

  );

  // ------------------------------
  // Header Sections
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_header_tab',
    'title'    => esc_html__('Header Settings', 'portio'),
    'icon'     => 'fa fa-header',
    'sections' => array(

      // header design tab
      array(
        'name'     => 'header_design_tab',
        'title'    => esc_html__('Design', 'portio'),
        'icon'     => 'fa fa-magic',
        'fields'   => array(

          // Header Select
          array(
            'id'           => 'select_header_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Header Design', 'portio'),
            'options'      => $headers,
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'        => true,
            'default'   => 'default',
            'info' => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'portio'),
          ),
          // Header Select

          // Extra's
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Extra\'s', 'portio'),
          ),
          array(
            'id'    => 'sticky_header',
            'type'  => 'switcher',
            'title' => esc_html__('Sticky Header', 'portio'),
            'info' => esc_html__('Turn On if you want your naviagtion bar on sticky.', 'portio'),
            'default' => true,
          ),
          array(
            'id'    => 'portio_cart_widget',
            'type'  => 'switcher',
            'title' => esc_html__('Header Cart', 'portio'),
            'info' => esc_html__('Turn On if you want to Show Header Cart .', 'portio'),
            'default' => false,
          ),
          array(
            'id'    => 'portio_header_search',
            'type'  => 'switcher',
            'title' => esc_html__('Header Search', 'portio'),
            'info' => esc_html__('Turn On if you want to Hide Header Search .', 'portio'),
            'default' => false,
          ),
          array(
            'id'    => 'portio_menu_cta',
            'type'  => 'switcher',
            'title' => esc_html__('Header CTA', 'portio'),
            'info' => esc_html__('Turn On if you want to Show Header CTA .', 'portio'),
            'default' => false,
          ),
          array(
            'id'    => 'header_cta_text',
            'type'  => 'text',
            'title' => esc_html__('Header CTA Text', 'portio'),
            'info' => esc_html__('Write Header CTA Text here.', 'portio'),
            'type'        => 'text',
            'default' => 'Free Consulting',
            'dependency'  => array('portio_menu_cta', '==', true),
          ),
          array(
            'id'    => 'header_cta_link',
            'type'  => 'text',
            'title' => esc_html__('Header CTA Link', 'portio'),
            'info' => esc_html__('Write Header CTA Link here.', 'portio'),
            'type'        => 'text',
            'default' => '#',
            'dependency'  => array('portio_menu_cta', '==', true),
          ),
        )
      ),

      // header top bar
      array(
        'name'     => 'header_top_bar_tab',
        'title'    => esc_html__('Top Bar', 'portio'),
        'icon'     => 'fa fa-minus',
        'fields'   => array(

          array(
            'id'          => 'top_bar',
            'type'        => 'switcher',
            'title'       => esc_html__('Hide Top Bar', 'portio'),
            'on_text'     => esc_html__('Yes', 'portio'),
            'off_text'    => esc_html__('No', 'portio'),
            'default'     => true,
          ),
          array(
            'id'          => 'top_left',
            'title'       => esc_html__('Top left Block', 'portio'),
            'desc'        => esc_html__('Top bar left block.', 'portio'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
          array(
            'id'          => 'top_right',
            'title'       => esc_html__('Top Right Block', 'portio'),
            'desc'        => esc_html__('Top bar right block.', 'portio'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
        )
      ),

      // header banner
      array(
        'name'     => 'header_banner_tab',
        'title'    => esc_html__('Title Bar (or) Banner', 'portio'),
        'icon'     => 'fa fa-bullhorn',
        'fields'   => array(

          // Title Area
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Title Area', 'portio')
          ),
          array(
            'id'      => 'need_title_bar',
            'type'    => 'switcher',
            'title'   => esc_html__('Title Bar ?', 'portio'),
            'label'   => esc_html__('If you want to Hide title bar in your sub-pages, please turn this ON.', 'portio'),
            'default'    => false,
          ),
          array(
            'id'             => 'title_bar_padding',
            'type'           => 'select',
            'title'          => esc_html__('Padding Spaces Top & Bottom', 'portio'),
            'options'        => array(
              'padding-default' => esc_html__('Default Spacing', 'portio'),
              'padding-custom' => esc_html__('Custom Padding', 'portio'),
            ),
            'dependency'   => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'             => 'titlebar_top_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Top', 'portio'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),
          array(
            'id'             => 'titlebar_bottom_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Bottom', 'portio'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Background Options', 'portio'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'      => 'titlebar_bg_overlay_color',
            'type'    => 'color_picker',
            'title'   => esc_html__('Overlay Color', 'portio'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'portio'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Breadcrumbs', 'portio'),
          ),
         array(
            'id'      => 'need_breadcrumbs',
            'type'    => 'switcher',
            'title'   => esc_html__('Hide Breadcrumbs', 'portio'),
            'label'   => esc_html__('If you want to hide breadcrumbs in your banner, please turn this ON.', 'portio'),
            'default'    => false,
          ),
        )
      ),

    ),
  );

  // ------------------------------
  // Footer Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'footer_section',
    'title'    => esc_html__('Footer Settings', 'portio'),
    'icon'     => 'fa fa-tasks',
    'sections' => array(

      // footer widgets
      array(
        'name'     => 'footer_widgets_tab',
        'title'    => esc_html__('Widget Area', 'portio'),
        'icon'     => 'fa fa-th',
        'fields'   => array(
          array(
            'id'           => 'select_footer_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Footer Design', 'portio'),
            'options'      => $footers,
            'attributes' => array(
              'data-depend-id' => 'footer_design',
            ),
            'radio'        => true,
            'default'   => 'default',
            'info' => esc_html__('Select your footer design, following options will may differ based on your selection of footer design.', 'portio'),
          ),
          // Footer Widget Block
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Footer Widget Block', 'portio')
          ),
          array(
            'id'    => 'footer_widget_block',
            'type'  => 'switcher',
            'title' => esc_html__('Enable Widget Block', 'portio'),
            'info' => __('If you turn this ON, then Goto : Appearance > Widgets. There you can see <strong>Footer Widget 1,2,3 or 4</strong> Widget Area, add your widgets there.', 'portio'),
            'default' => true,
          ),
          array(
            'id'    => 'footer_widget_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Widget Layouts', 'portio'),
            'info' => esc_html__('Choose your footer widget theme-layouts.', 'portio'),
            'default' => 4,
            'options' => array(
              1   => PORTIO_CS_IMAGES . '/footer/footer-1.png',
              2   => PORTIO_CS_IMAGES . '/footer/footer-2.png',
              3   => PORTIO_CS_IMAGES . '/footer/footer-3.png',
              4   => PORTIO_CS_IMAGES . '/footer/footer-4.png',
              5   => PORTIO_CS_IMAGES . '/footer/footer-5.png',
              6   => PORTIO_CS_IMAGES . '/footer/footer-6.png',
              7   => PORTIO_CS_IMAGES . '/footer/footer-7.png',
              8   => PORTIO_CS_IMAGES . '/footer/footer-8.png',
              9   => PORTIO_CS_IMAGES . '/footer/footer-9.png',
            ),
            'radio'       => true,
            'dependency'  => array('footer_widget_block', '==', true),
          ),
           array(
            'id'    => 'portio_ft_bg',
            'type'  => 'image',
            'title' => esc_html__('Footer Background', 'portio'),
            'info'  => esc_html__('Upload your footer background.', 'portio'),
            'add_title' => esc_html__('footer background', 'portio'),
            'dependency'  => array('footer_widget_block', '==', true),
          ),

        )
      ),

      // footer copyright
      array(
        'name'     => 'footer_copyright_tab',
        'title'    => esc_html__('Copyright Bar', 'portio'),
        'icon'     => 'fa fa-copyright',
        'fields'   => array(

          // Copyright
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Copyright Layout', 'portio'),
          ),
         array(
            'id'    => 'hide_copyright',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Copyright?', 'portio'),
            'default' => false,
            'on_text' => esc_html__('Yes', 'portio'),
            'off_text' => esc_html__('No', 'portio'),
            'label' => esc_html__('Yes, do it!', 'portio'),
          ),
          array(
            'id'    => 'footer_copyright_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Select Copyright Layout', 'portio'),
            'info' => esc_html__('In above image, blue box is copyright text and yellow box is secondary text.', 'portio'),
            'default'      => 'copyright-3',
            'options'      => array(
              'copyright-1'    => PORTIO_CS_IMAGES .'/footer/copyright-1.png',
              ),
            'radio'        => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'copyright_text',
            'type'  => 'textarea',
            'title' => esc_html__('Copyright Text', 'portio'),
            'shortcode' => true,
            'dependency' => array('hide_copyright', '!=', true),
            'after'       => 'Helpful shortcodes: [current_year] [home_url] or any shortcode.',
          ),

          // Copyright Another Text
          array(
            'type'    => 'notice',
            'class'   => 'warning cs-portio-heading',
            'content' => esc_html__('Copyright Secondary Text', 'portio'),
             'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'secondary_text',
            'type'  => 'textarea',
            'title' => esc_html__('Secondary Text', 'portio'),
            'shortcode' => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),

        )
      ),

    ),
  );

  // ------------------------------
  // Design
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_design',
    'title'  => esc_html__('Theme Design', 'portio'),
    'icon'   => 'fa fa-sliders'
  );

  // ------------------------------
  // color section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_color_section',
    'title'    => esc_html__('Colors', 'portio'),
    'icon'     => 'fa fa-eyedropper',
    'fields' => array(

      array(
        'type'    => 'heading',
        'content' => esc_html__('Color Options', 'portio'),
      ),
      array(
        'type'    => 'subheading',
        'wrap_class' => 'color-tab-content',
        'content' => esc_html__('All color options are available in our theme customizer. The reason of we used customizer options for color section is because, you can choose each part of color from there and see the changes instantly using customizer. Highly customizable colors are in Appearance > Customize', 'portio'),
      ),

    ),
  );

  // ------------------------------
  // Typography section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_typo_section',
    'title'    => esc_html__('Typography', 'portio'),
    'icon'     => 'fa fa-header',
    'fields' => array(

      // Start fields
      array(
        'id'                  => 'typography',
        'type'                => 'group',
        'fields'              => array(
          array(
            'id'              => 'title',
            'type'            => 'text',
            'title'           => esc_html__('Title', 'portio'),
          ),
          array(
            'id'              => 'selector',
            'type'            => 'textarea',
            'title'           => esc_html__('Selector', 'portio'),
            'info'           => wp_kses( __('Enter css selectors like : <strong>body, .custom-class</strong>', 'portio'), array( 'strong' => array() ) ),
          ),
          array(
            'id'              => 'font',
            'type'            => 'typography',
            'title'           => esc_html__('Font Family', 'portio'),
          ),
          array(
            'id'              => 'size',
            'type'            => 'text',
            'title'           => esc_html__('Font Size', 'portio'),
          ),
          array(
            'id'              => 'line_height',
            'type'            => 'text',
            'title'           => esc_html__('Line-Height', 'portio'),
          ),
          array(
            'id'              => 'css',
            'type'            => 'textarea',
            'title'           => esc_html__('Custom CSS', 'portio'),
          ),
        ),
        'button_title'        => esc_html__('Add New Typography', 'portio'),
        'accordion_title'     => esc_html__('New Typography', 'portio'),
      ),

      // Subset
      array(
        'id'                  => 'subsets',
        'type'                => 'select',
        'title'               => esc_html__('Subsets', 'portio'),
        'class'               => 'chosen',
        'options'             => array(
          'latin'             => 'latin',
          'latin-ext'         => 'latin-ext',
          'cyrillic'          => 'cyrillic',
          'cyrillic-ext'      => 'cyrillic-ext',
          'greek'             => 'greek',
          'greek-ext'         => 'greek-ext',
          'vietnamese'        => 'vietnamese',
          'devanagari'        => 'devanagari',
          'khmer'             => 'khmer',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Subsets',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( 'latin' ),
      ),

      array(
        'id'                  => 'font_weight',
        'type'                => 'select',
        'title'               => esc_html__('Font Weights', 'portio'),
        'class'               => 'chosen',
        'options'             => array(
          '100'   => esc_html__('Thin 100', 'portio'),
          '100i'  => esc_html__('Thin 100 Italic', 'portio'),
          '200'   => esc_html__('Extra Light 200', 'portio'),
          '200i'  => esc_html__('Extra Light 200 Italic', 'portio'),
          '300'   => esc_html__('Light 300', 'portio'),
          '300i'  => esc_html__('Light 300 Italic', 'portio'),
          '400'   => esc_html__('Regular 400', 'portio'),
          '400i'  => esc_html__('Regular 400 Italic', 'portio'),
          '500'   => esc_html__('Medium 500', 'portio'),
          '500i'  => esc_html__('Medium 500 Italic', 'portio'),
          '600'   => esc_html__('Semi Bold 600', 'portio'),
          '600i'  => esc_html__('Semi Bold 600 Italic', 'portio'),
          '700'   => esc_html__('Bold 700', 'portio'),
          '700i'  => esc_html__('Bold 700 Italic', 'portio'),
          '800'   => esc_html__('Extra Bold 800', 'portio'),
          '800i'  => esc_html__('Extra Bold 800 Italic', 'portio'),
          '900'   => esc_html__('Black 900', 'portio'),
          '900i'  => esc_html__('Black 900 Italic', 'portio'),
        ),
        'attributes'         => array(
          'data-placeholder' => esc_html__('Font Weight', 'portio'),
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( '400' ),
      ),

      // Custom Fonts Upload
      array(
        'id'                 => 'font_family',
        'type'               => 'group',
        'title'              => esc_html__('Upload Custom Fonts', 'portio'),
        'button_title'       => esc_html__('Add New Custom Font', 'portio'),
        'accordion_title'    => esc_html__('Adding New Font', 'portio'),
        'accordion'          => true,
        'desc'               => esc_html__('It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!', 'portio'),
        'fields'             => array(

          array(
            'id'             => 'name',
            'type'           => 'text',
            'title'          => esc_html__('Font-Family Name', 'portio'),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. Arial', 'portio')
            ),
          ),

          array(
            'id'             => 'ttf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .ttf <small><i>(optional)</i></small>', 'portio'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'portio'),
              'button_title' => wp_kses(__('Upload <i>.ttf</i>', 'portio'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'eot',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .eot <small><i>(optional)</i></small>', 'portio'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'portio'),
              'button_title' => wp_kses(__('Upload <i>.eot</i>', 'portio'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'otf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .otf <small><i>(optional)</i></small>', 'portio'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'portio'),
              'button_title' => wp_kses(__('Upload <i>.otf</i>', 'portio'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'woff',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .woff <small><i>(optional)</i></small>', 'portio'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'portio'),
              'button_title' =>wp_kses(__('Upload <i>.woff</i>', 'portio'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'css',
            'type'           => 'textarea',
            'title'          => wp_kses(__('Extra CSS Style <small><i>(optional)</i></small>', 'portio'), array( 'small' => array(), 'i' => array() )),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. font-weight: normal;', 'portio'),
            ),
          ),

        ),
      ),
      // End All field

    ),
  );

  // ------------------------------
  // Pages
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_pages',
    'title'  => esc_html__('Custom Pages', 'portio'),
    'icon'   => 'fa fa-folder-open-o'
  );


  // ------------------------------
  // Service Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'service_section',
    'title'    => esc_html__('Service Settings', 'portio'),
    'icon'     => 'fa fa-server',
    'fields' => array(

      // service name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'portio')
      ),
      array(
        'id'      => 'theme_service_name',
        'type'    => 'text',
        'title'   => esc_html__('Service Name', 'portio'),
        'attributes'     => array(
          'placeholder'  => 'Service'
        ),
      ),
      array(
        'id'      => 'theme_service_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Slug', 'portio'),
        'attributes'     => array(
          'placeholder'  => 'service-item'
        ),
      ),
      array(
        'id'      => 'theme_service_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Category Slug', 'portio'),
        'attributes'     => array(
          'placeholder'  => 'service-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set service slug and page slug as same. It\'ll not work.', 'portio')
      ),
      // Service Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-portio-heading',
        'content' => esc_html__('Service Single', 'portio')
      ),
      array(
          'id'             => 'service_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'portio'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'portio'),
            'sidebar-left' => esc_html__('Left', 'portio'),
            'sidebar-hide' => esc_html__('Hide', 'portio'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'portio'),
        ),
        array(
          'id'             => 'single_service_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'portio'),
          'options'        => portio_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'portio'),
          'dependency'     => array('service_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'portio'),
        ),
        array(
          'id'    => 'service_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'portio'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'portio'),
          'default' => true,
        ),
    ),
  );

  
  // ------------------------------
  // Project Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'project_section',
    'title'    => esc_html__('Project Settings', 'portio'),
    'icon'     => 'fa fa-medkit',
    'fields' => array(

      // project name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'portio')
      ),
      array(
        'id'      => 'theme_project_name',
        'type'    => 'text',
        'title'   => esc_html__('Project Name', 'portio'),
        'attributes'     => array(
          'placeholder'  => 'Project'
        ),
      ),
      array(
        'id'      => 'theme_project_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Slug', 'portio'),
        'attributes'     => array(
          'placeholder'  => 'project-item'
        ),
      ),
      array(
        'id'      => 'theme_project_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Category Slug', 'portio'),
        'attributes'     => array(
          'placeholder'  => 'project-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set project slug and page slug as same. It\'ll not work.', 'portio')
      ),

      // Project Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-portio-heading',
        'content' => esc_html__('Project Single', 'portio')
      ),
      array(
          'id'             => 'project_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'portio'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'portio'),
            'sidebar-left' => esc_html__('Left', 'portio'),
            'sidebar-hide' => esc_html__('Hide', 'portio'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'portio'),
        ),
        array(
          'id'             => 'single_project_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'portio'),
          'options'        => portio_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'portio'),
          'dependency'     => array('project_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'portio'),
        ),
        array(
          'id'    => 'project_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'portio'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'portio'),
          'default' => true,
        ),
    ),
  );

  // ------------------------------
  // Blog Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'blog_section',
    'title'    => esc_html__('Blog Settings', 'portio'),
    'icon'     => 'fa fa-newspaper-o',
    'sections' => array(

      // blog general section
      array(
        'name'     => 'blog_general_tab',
        'title'    => esc_html__('General', 'portio'),
        'icon'     => 'fa fa-cog',
        'fields'   => array(

          // Layout
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Layout', 'portio')
          ),
          array(
            'id'             => 'blog_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'portio'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'portio'),
              'sidebar-left' => esc_html__('Left', 'portio'),
              'sidebar-hide' => esc_html__('Hide', 'portio'),
            ),
            'default_option' => 'Select sidebar position',
            'help'          => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'portio'),
            'info'          => esc_html__('Default option : Right', 'portio'),
          ),
          array(
            'id'             => 'blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'portio'),
            'options'        => portio_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'portio'),
            'dependency'     => array('blog_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'portio'),
          ),
          // Layout
          // Global Options
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Global Options', 'portio')
          ),
          array(
            'id'         => 'theme_exclude_categories',
            'type'       => 'checkbox',
            'title'      => esc_html__('Exclude Categories', 'portio'),
            'info'      => esc_html__('Select categories you want to exclude from blog page.', 'portio'),
            'options'    => 'categories',
          ),
          array(
            'id'      => 'theme_blog_excerpt',
            'type'    => 'text',
            'title'   => esc_html__('Excerpt Length', 'portio'),
            'info'   => esc_html__('Blog short content length, in blog listing pages.', 'portio'),
            'default' => '55',
          ),
          array(
            'id'      => 'theme_metas_hide',
            'type'    => 'checkbox',
            'title'   => esc_html__('Meta\'s to hide', 'portio'),
            'info'    => esc_html__('Check items you want to hide from blog/post meta field.', 'portio'),
            'class'      => 'horizontal',
            'options'    => array(
              'category'   => esc_html__('Category', 'portio'),
              'date'    => esc_html__('Date', 'portio'),
              'author'     => esc_html__('Author', 'portio'),
              'comments'      => esc_html__('Comments', 'portio'),
              'Tag'      => esc_html__('Tag', 'portio'),
            ),
            // 'default' => '30',
          ),
          // End fields

        )
      ),

      // blog single section
      array(
        'name'     => 'blog_single_tab',
        'title'    => esc_html__('Single', 'portio'),
        'icon'     => 'fa fa-sticky-note',
        'fields'   => array(

          // Start fields
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Enable / Disable', 'portio')
          ),
          array(
            'id'    => 'single_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Featured Image', 'portio'),
            'info' => esc_html__('If need to hide featured image from single blog post page, please turn this OFF.', 'portio'),
            'default' => true,
          ),
           array(
            'id'    => 'single_author_info',
            'type'  => 'switcher',
            'title' => esc_html__('Author Info', 'portio'),
            'info' => esc_html__('If need to hide author info on single blog page, please turn this On.', 'portio'),
            'default' => false,
          ),
          array(
            'id'    => 'single_share_option',
            'type'  => 'switcher',
            'title' => esc_html__('Share Option', 'portio'),
            'info' => esc_html__('If need to hide share option on single blog page, please turn this OFF.', 'portio'),
            'default' => true,
          ),
          array(
            'id'    => 'single_comment_form',
            'type'  => 'switcher',
            'title' => esc_html__('Comment Area/Form ?', 'portio'),
            'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this On.', 'portio'),
            'default' => false,
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Sidebar', 'portio')
          ),
          array(
            'id'             => 'single_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'portio'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'portio'),
              'sidebar-left' => esc_html__('Left', 'portio'),
              'sidebar-hide' => esc_html__('Hide', 'portio'),
            ),
            'default_option' => 'Select sidebar position',
            'info'          => esc_html__('Default option : Right', 'portio'),
          ),
          array(
            'id'             => 'single_blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'portio'),
            'options'        => portio_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'portio'),
            'dependency'     => array('single_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'portio'),
          ),
          // End fields

        )
      ),

    ),
  );

if (class_exists( 'WooCommerce' )){
  // ------------------------------
  // WooCommerce Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'woocommerce_section',
    'title'    => esc_html__('WooCommerce', 'portio'),
    'icon'     => 'fa fa-shopping-basket',
    'fields' => array(

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-portio-heading',
        'content' => esc_html__('Layout', 'portio')
      ),
     array(
        'id'             => 'woo_product_columns',
        'type'           => 'select',
        'title'          => esc_html__('Product Column', 'portio'),
        'options'        => array(
          2 => esc_html__('Two Column', 'portio'),
          3 => esc_html__('Three Column', 'portio'),
          4 => esc_html__('Four Column', 'portio'),
        ),
        'default_option' => esc_html__('Select Product Columns', 'portio'),
        'help'          => esc_html__('This style will apply, default woocommerce shop and archive pages.', 'portio'),
      ),
      array(
        'id'             => 'woo_sidebar_position',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Position', 'portio'),
        'options'        => array(
          'right-sidebar' => esc_html__('Right', 'portio'),
          'left-sidebar' => esc_html__('Left', 'portio'),
          'sidebar-hide' => esc_html__('Hide', 'portio'),
        ),
        'default_option' => esc_html__('Select sidebar position', 'portio'),
        'info'          => esc_html__('Default option : Right', 'portio'),
      ),
      array(
        'id'             => 'woo_widget',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Widget', 'portio'),
        'options'        => portio_registered_sidebars(),
        'default_option' => esc_html__('Select Widget', 'portio'),
        'dependency'     => array('woo_sidebar_position', '!=', 'sidebar-hide'),
        'info'          => esc_html__('Default option : Shop Page', 'portio'),
      ),

      array(
        'type'    => 'notice',
        'class'   => 'info cs-portio-heading',
        'content' => esc_html__('Listing', 'portio')
      ),
      array(
        'id'      => 'theme_woo_limit',
        'type'    => 'text',
        'title'   => esc_html__('Product Limit', 'portio'),
        'info'   => esc_html__('Enter the number value for per page products limit.', 'portio'),
      ),
      // End fields

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-portio-heading',
        'content' => esc_html__('Single Product', 'portio')
      ),
      array(
        'id'             => 'woo_related_limit',
        'type'           => 'text',
        'title'          => esc_html__('Related Products Limit', 'portio'),
      ),
      array(
        'id'    => 'woo_single_upsell',
        'type'  => 'switcher',
        'title' => esc_html__('You May Also Like', 'portio'),
        'info' => esc_html__('If you don\'t want \'You May Also Like\' products in single product page, please turn this ON.', 'portio'),
        'default' => false,
      ),
      array(
        'id'    => 'woo_single_related',
        'type'  => 'switcher',
        'title' => esc_html__('Related Products', 'portio'),
        'info' => esc_html__('If you don\'t want \'Related Products\' in single product page, please turn this ON.', 'portio'),
        'default' => false,
      ),
      // End fields

    ),
  );
}

  // ------------------------------
  // Extra Pages
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_extra_pages',
    'title'    => esc_html__('404 & Maintenance', 'portio'),
    'icon'     => 'fa fa-cogs',
    'sections' => array(

      // error 404 page
      array(
        'name'     => 'error_page_section',
        'title'    => esc_html__('404 Page', 'portio'),
        'icon'     => 'fa fa-exclamation-triangle',
        'fields'   => array(

          // Start 404 Page
          array(
            'id'    => 'error_heading',
            'type'  => 'text',
            'title' => esc_html__('404 Page Heading', 'portio'),
            'info'  => esc_html__('Enter 404 page heading.', 'portio'),
          ),
          array(
            'id'    => 'error_subheading',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Sub Heading', 'portio'),
            'info'  => esc_html__('Enter 404 page Sub heading.', 'portio'),
          ),
          array(
            'id'    => 'error_page_content',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Content', 'portio'),
            'info'  => esc_html__('Enter 404 page content.', 'portio'),
            'shortcode' => true,
          ),
          array(
            'id'    => 'error_btn_text',
            'type'  => 'text',
            'title' => esc_html__('Button Text', 'portio'),
            'info'  => esc_html__('Enter BACK TO HOME button text. If you want to change it.', 'portio'),
          ),
          // End 404 Page

        ) // end: fields
      ), // end: fields section

      // maintenance mode page
      array(
        'name'     => 'maintenance_mode_section',
        'title'    => esc_html__('Maintenance Mode', 'portio'),
        'icon'     => 'fa fa-hourglass-half',
        'fields'   => array(

          // Start Maintenance Mode
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('If you turn this ON : Only Logged in users will see your pages. All other visiters will see, selected page of : <strong>Maintenance Mode Page</strong>', 'portio')
          ),
          array(
            'id'             => 'enable_maintenance_mode',
            'type'           => 'switcher',
            'title'          => esc_html__('Maintenance Mode', 'portio'),
            'default'        => false,
          ),
          array(
            'id'             => 'maintenance_mode_page',
            'type'           => 'select',
            'title'          => esc_html__('Maintenance Mode Page', 'portio'),
            'options'        => 'pages',
            'default_option' => esc_html__('Select a page', 'portio'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_title',
            'type'           => 'text',
            'title'          => esc_html__('Maintenance Mode Text', 'portio'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_text',
            'type'           => 'textarea',
            'title'          => esc_html__('Maintenance Mode Text', 'portio'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_bg',
            'type'           => 'background',
            'title'          => esc_html__('Page Background', 'portio'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          // End Maintenance Mode

        ) // end: fields
      ), // end: fields section

    )
  );

  // ------------------------------
  // Advanced
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_advanced',
    'title'  => esc_html__('Advanced Settings', 'portio'),
    'icon'   => 'fa fa-cog'
  );

  // ------------------------------
  // Misc Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'misc_section',
    'title'    => esc_html__('Extra Settings', 'portio'),
    'icon'     => 'fa fa-reorder',
    'sections' => array(

      // custom sidebar section
      array(
        'name'     => 'custom_sidebar_section',
        'title'    => esc_html__('Custom Sidebar', 'portio'),
        'icon'     => 'fa fa-reorder',
        'fields'   => array(

          // start fields
          array(
            'id'              => 'custom_sidebar',
            'title'           => esc_html__('Sidebars', 'portio'),
            'desc'            => esc_html__('Go to Appearance -> Widgets after create sidebars', 'portio'),
            'type'            => 'group',
            'fields'          => array(
              array(
                'id'          => 'sidebar_name',
                'type'        => 'text',
                'title'       => esc_html__('Sidebar Name', 'portio'),
              ),
              array(
                'id'          => 'sidebar_desc',
                'type'        => 'text',
                'title'       => esc_html__('Custom Description', 'portio'),
              )
            ),
            'accordion'       => true,
            'button_title'    => esc_html__('Add New Sidebar', 'portio'),
            'accordion_title' => esc_html__('New Sidebar', 'portio'),
          ),
          // end fields

        )
      ),
      // custom sidebar section

      // Custom CSS/JS
      array(
        'name'        => 'custom_css_js_section',
        'title'       => esc_html__('Custom Codes', 'portio'),
        'icon'        => 'fa fa-code',

        // begin: fields
        'fields'      => array(
          // Start Custom CSS/JS
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Custom JS', 'portio')
          ),
          array(
            'id'             => 'theme_custom_js',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'     => 10,
              'placeholder'     => esc_html__('Enter your JS code here...', 'portio'),
            ),
          ),
          // End Custom CSS/JS

        ) // end: fields
      ),

      // Translation
      array(
        'name'        => 'theme_translation_section',
        'title'       => esc_html__('Translation', 'portio'),
        'icon'        => 'fa fa-language',

        // begin: fields
        'fields'      => array(

          // Start Translation
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Common Texts', 'portio')
          ),
          array(
            'id'          => 'read_more_text',
            'type'        => 'text',
            'title'       => esc_html__('Read More Text', 'portio'),
          ),
          array(
            'id'          => 'view_more_text',
            'type'        => 'text',
            'title'       => esc_html__('View More Text', 'portio'),
          ),
          array(
            'id'          => 'share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'portio'),
          ),
          array(
            'id'          => 'share_on_text',
            'type'        => 'text',
            'title'       => esc_html__('Share On Tooltip Text', 'portio'),
          ),
          array(
            'id'          => 'author_text',
            'type'        => 'text',
            'title'       => esc_html__('Author Text', 'portio'),
          ),
          array(
            'id'          => 'post_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Post Comment Text [Submit Button]', 'portio'),
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('WooCommerce', 'portio')
          ),
          array(
            'id'          => 'add_to_cart_text',
            'type'        => 'text',
            'title'       => esc_html__('Add to Cart Text', 'portio'),
          ),
          array(
            'id'          => 'details_text',
            'type'        => 'text',
            'title'       => esc_html__('Details Text', 'portio'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Pagination', 'portio')
          ),
          array(
            'id'          => 'older_post',
            'type'        => 'text',
            'title'       => esc_html__('Older Posts Text', 'portio'),
          ),
          array(
            'id'          => 'newer_post',
            'type'        => 'text',
            'title'       => esc_html__('Newer Posts Text', 'portio'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-portio-heading',
            'content' => esc_html__('Single Portfolio Pagination', 'portio')
          ),
          array(
            'id'          => 'prev_port',
            'type'        => 'text',
            'title'       => esc_html__('Prev Case Text', 'portio'),
          ),
          array(
            'id'          => 'next_port',
            'type'        => 'text',
            'title'       => esc_html__('Next Case Text', 'portio'),
          ),
          // End Translation

        ) // end: fields
      ),

    ),
  );

  
  // ------------------------------
  // backup                       -
  // ------------------------------
  $options[]   = array(
    'name'     => 'backup_section',
    'title'    => 'Backup',
    'icon'     => 'fa fa-shield',
    'fields'   => array(

      array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'portio'),
      ),

      array(
        'type'    => 'backup',
      ),

    )
  );

  return $options;

}
add_filter( 'cs_framework_options', 'portio_options' );