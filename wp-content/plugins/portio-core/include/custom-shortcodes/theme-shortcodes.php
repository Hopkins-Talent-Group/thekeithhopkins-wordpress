<?php
/*
 * All Custom Shortcode for [theme_name] theme.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

if( ! function_exists( 'portio_shortcodes' ) ) {
  function portio_shortcodes( $options ) {

    $options       = array();

    /* Topbar Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Topbar Shortcodes', 'portio'),
      'shortcodes' => array(

        // Topbar item
        array(
          'name'          => 'portio_widget_topbars',
          'title'         => esc_html__('Topbar info', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_widget_topbar',
          'clone_title'   => esc_html__('Add New', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),
            
          ),
          'clone_fields'  => array(

            array(
              'id'        => 'info_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Icon', 'portio'),
            ),
            array(
              'id'        => 'subtitle',
              'type'      => 'text',
              'title'     => esc_html__('Sub Title', 'portio'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'portio'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'portio'),
            ),
            array(
              'id'        => 'open_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'portio'),
              'yes'     => esc_html__('Yes', 'portio'),
              'no'     => esc_html__('No', 'portio'),
            ),

          ),

        ),
       

      ),
    );

    /* Header Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Header Shortcodes', 'portio'),
      'shortcodes' => array(

        // header Social
        array(
          'name'          => 'portio_header_socials',
          'title'         => esc_html__('Header Social', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_header_social',
          'clone_title'   => esc_html__('Add New Social', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),
            array(
              'id'        => 'custom_text',
              'type'      => 'text',
              'title'     => esc_html__('Custom Title', 'portio'),
            ),

          ),
          'clone_fields'  => array(
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'portio')
            ),
            array(
              'id'        => 'social_icon_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Color', 'portio'),
            ),
            array(
              'id'        => 'social_link',
              'type'      => 'text',
              'title'     => esc_html__('Social Link', 'portio')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'portio'),
              'yes'     => esc_html__('Yes', 'portio'),
              'no'     => esc_html__('No', 'portio'),
            ),

          ),

        ),
        // header Social End

        // header Middle Infos
        array(
          'name'          => 'portio_header_middle_infos',
          'title'         => esc_html__('Header Middle Info', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_header_middle_info',
          'clone_title'   => esc_html__('Add New Info', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),

          ),
          'clone_fields'  => array(
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'portio')
            ),
            array(
              'id'        => 'social_icon_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Color', 'portio'),
            ),
            array(
              'id'        => 'address_text',
              'type'      => 'text',
              'title'     => esc_html__('Address Text', 'portio')
            ),
            array(
              'id'        => 'address_desc',
              'type'      => 'text',
              'title'     => esc_html__('Address Details', 'portio')
            ),
          ),

        ),
        // header Middle Infos End



      ),
    );

    /* Content Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Content Shortcodes', 'portio'),
      'shortcodes' => array(

        // Spacer
        array(
          'name'          => 'vc_empty_space',
          'title'         => esc_html__('Spacer', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'height',
              'type'      => 'text',
              'title'     => esc_html__('Height', 'portio'),
              'attributes' => array(
                'placeholder'     => '20px',
              ),
            ),

          ),
        ),
        // Spacer

        // Social Icons
        array(
          'name'          => 'portio_socials',
          'title'         => esc_html__('Social Icons', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_social',
          'clone_title'   => esc_html__('Add New', 'portio'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),  
            array(
              'id'        => 'section_title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'portio'),
            ),

            // Colors
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Colors', 'portio')
            ),
            array(
              'id'        => 'icon_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Color', 'portio'),
              'wrap_class' => 'column_third',
            ),
            array(
              'id'        => 'icon_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Hover Color', 'portio'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '!=', 'style-three'),
            ),
            array(
              'id'        => 'bg_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Backrgound Color', 'portio'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '!=', 'style-one'),
            ),
            array(
              'id'        => 'bg_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Backrgound Hover Color', 'portio'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '==', 'style-two'),
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Color', 'portio'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '==', 'style-three'),
            ),

            // Icon Size
            array(
              'id'        => 'icon_size',
              'type'      => 'text',
              'title'     => esc_html__('Icon Size', 'portio'),
              'wrap_class' => 'column_full',
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'social_link',
              'type'      => 'text',
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
              'title'     => esc_html__('Link', 'portio')
            ),
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'portio')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'portio'),
              'on_text'     => esc_html__('Yes', 'portio'),
              'off_text'     => esc_html__('No', 'portio'),
            ),

          ),

        ),
        // Social Icons

        // Useful Links
        array(
          'name'          => 'portio_useful_links',
          'title'         => esc_html__('Useful Links', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_useful_link',
          'clone_title'   => esc_html__('Add New', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'column_width',
              'type'      => 'select',
              'title'     => esc_html__('Column Width', 'portio'),
              'options'        => array(
                'full-width' => esc_html__('One Column', 'portio'),
                'half-width' => esc_html__('Two Column', 'portio'),
                'third-width' => esc_html__('Three Column', 'portio'),
              ),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'title_link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'portio')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'portio'),
              'on_text'     => esc_html__('Yes', 'portio'),
              'off_text'     => esc_html__('No', 'portio'),
            ),
            array(
              'id'        => 'link_title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'portio')
            ),

          ),

        ),
        // Useful Links

        // Simple Image List
        array(
          'name'          => 'portio_image_lists',
          'title'         => esc_html__('Simple Image List', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_image_list',
          'clone_title'   => esc_html__('Add New', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'get_image',
              'type'      => 'upload',
              'title'     => esc_html__('Image', 'portio')
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
              'title'     => esc_html__('Link', 'portio')
            ),
            array(
              'id'    => 'open_tab',
              'type'  => 'switcher',
              'std'   => false,
              'title' => esc_html__('Open link to new tab?', 'portio')
            ),

          ),

        ),
        // Simple Image List

        // Simple Link
        array(
          'name'          => 'portio_simple_link',
          'title'         => esc_html__('Simple Link', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'link_style',
              'type'      => 'select',
              'title'     => esc_html__('Link Style', 'portio'),
              'options'        => array(
                'link-underline' => esc_html__('Link Underline', 'portio'),
                'link-arrow-right' => esc_html__('Link Arrow (Right)', 'portio'),
                'link-arrow-left' => esc_html__('Link Arrow (Left)', 'portio'),
              ),
            ),
            array(
              'id'        => 'link_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Icon', 'portio'),
              'value'      => 'fa fa-caret-right',
              'dependency'  => array('link_style', '!=', 'link-underline'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => esc_html__('Link Text', 'portio'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'portio'),
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'portio'),
              'on_text'     => esc_html__('Yes', 'portio'),
              'off_text'     => esc_html__('No', 'portio'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),

            // Normal Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Normal Mode', 'portio')
            ),
            array(
              'id'        => 'text_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Text Color', 'portio'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Color', 'portio'),
              'wrap_class' => 'column_half el-hav-border',
              'dependency'  => array('link_style', '==', 'link-underline'),
            ),
            // Hover Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Hover Mode', 'portio')
            ),
            array(
              'id'        => 'text_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Text Hover Color', 'portio'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Hover Color', 'portio'),
              'wrap_class' => 'column_half el-hav-border',
              'dependency'  => array('link_style', '==', 'link-underline'),
            ),

            // Size
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Font Sizes', 'portio')
            ),
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => esc_html__('Text Size', 'portio'),
              'attributes' => array(
                'placeholder'     => 'Eg: 14px',
              ),
            ),

          ),
        ),
        // Simple Link

        // Blockquotes
        array(
          'name'          => 'portio_blockquote',
          'title'         => esc_html__('Blockquote', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'blockquote_style',
              'type'      => 'select',
              'title'     => esc_html__('Blockquote Style', 'portio'),
              'options'        => array(
                '' => esc_html__('Select Blockquote Style', 'portio'),
                'style-one' => esc_html__('Style One', 'portio'),
                'style-two' => esc_html__('Style Two', 'portio'),
              ),
            ),
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => esc_html__('Text Size', 'portio'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),
            array(
              'id'        => 'content_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Content Color', 'portio'),
            ),
            array(
              'id'        => 'left_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Left Border Color', 'portio'),
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Color', 'portio'),
            ),
            array(
              'id'        => 'bg_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Background Color', 'portio'),
            ),
            // Content
            array(
              'id'        => 'content',
              'type'      => 'textarea',
              'title'     => esc_html__('Content', 'portio'),
            ),

          ),

        ),
        // Blockquotes

      ),
    );

    /* Widget Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Widget Shortcodes', 'portio'),
      'shortcodes' => array(

        // widget Contact info
        array(
          'name'          => 'portio_widget_contact_info',
          'title'         => esc_html__('Service CTA', 'portio'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),
             array(
              'id'        => 'image_url',
              'type'      => 'image',
              'title'     => esc_html__('Image background', 'portio'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'portio'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'text',
              'title'     => esc_html__('SubTitle', 'portio'),
            ),
            array(
              'id'        => 'number',
              'type'      => 'text',
              'title'     => esc_html__('Number', 'portio'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => esc_html__('Link text', 'portio'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'portio'),
            ),

          ),
        ),

        // widget Testimonials
        array(
          'name'          => 'portio_widget_testimonial',
          'title'         => esc_html__('Testimonial', 'portio'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),
             array(
              'id'        => 'image_url',
              'type'      => 'image',
              'title'     => esc_html__('Image background', 'portio'),
            ),
            array(
              'id'        => 'subtitle',
              'type'      => 'text',
              'title'     => esc_html__('Sub Title', 'portio'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'portio'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'portio'),
            ),

          ),
        ),

       // About widget Block
        array(
          'name'          => 'portio_about_widget',
          'title'         => esc_html__('About Widget Block', 'portio'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'portio'),
            ),
            array(
              'id'        => 'image_url',
              'type'      => 'image',
              'title'     => esc_html__('About Block Image', 'portio'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'portio'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => esc_html__('Link text', 'portio'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'portio'),
            ),

          ),
        ),


      // Service Contact Widget
        array(
          'name'          => 'portio_service_widget_contacts',
          'title'         => esc_html__('Service Feature Widget', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_service_widget_contact',
          'clone_title'   => esc_html__('Add New', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),
            array(
              'id'        => 'contact_title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'portio')
            ),
          ),
          'clone_fields'  => array(
           
             array(
              'id'        => 'info',
              'type'      => 'text',
              'title'     => esc_html__('Contact Info', 'portio')
            ),

          ),

        ),
      // Service Contact Widget End
        // widget download-widget
        array(
          'name'          => 'portio_download_widgets',
          'title'         => esc_html__('Download Widget', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_download_widget',
          'clone_title'   => esc_html__('Add New', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),
          ),
          'clone_fields'  => array(

            array(
              'id'        => 'download_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Download Icon', 'portio')
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Download Title', 'portio')
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Download Link', 'portio')
            ),

          ),

        ),

      ),
    );

    /* Footer Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Footer Shortcodes', 'portio'),
      'shortcodes' => array(

        // Footer Menus
        array(
          'name'          => 'portio_footer_menus',
          'title'         => esc_html__('Footer Menu Links', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_footer_menu',
          'clone_title'   => esc_html__('Add New', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'menu_title',
              'type'      => 'text',
              'title'     => esc_html__('Menu Title', 'portio')
            ),
            array(
              'id'        => 'menu_link',
              'type'      => 'text',
              'title'     => esc_html__('Menu Link', 'portio')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'portio'),
              'on_text'     => esc_html__('Yes', 'portio'),
              'off_text'     => esc_html__('No', 'portio'),
            ),

          ),

        ),
        // Footer Menus
        array(
          'name'          => 'footer_infos',
          'title'         => esc_html__('footer logo and Text', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'footer_info',
          'clone_title'   => esc_html__('Add New', 'portio'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),
            array(
              'id'        => 'footer_logo',
              'type'      => 'image',
              'title'     => esc_html__('Footer logo', 'portio'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'portio'),
            ),
            
          ),
          'clone_fields'  => array(
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'portio')
            ),
            array(
              'id'        => 'social_link',
              'type'      => 'text',
              'title'     => esc_html__('Social Link', 'portio')
            ),
          ),

        ),

      // footer contact info
      array(
        'name'          => 'portio_footer_contact_infos',
        'title'         => esc_html__('Contact info', 'portio'),
        'view'          => 'clone',
        'clone_id'      => 'portio_footer_contact_info',
        'clone_title'   => esc_html__('Add New', 'portio'),
        'fields'        => array(

          array(
            'id'        => 'custom_class',
            'type'      => 'text',
            'title'     => esc_html__('Custom Class', 'portio'),
          ),
          array(
            'id'        => 'contact_title',
            'type'      => 'textarea',
            'title'     => esc_html__('Contact info title', 'portio')
          ),
        ),
        'clone_fields'  => array(

          array(
            'id'        => 'Icon',
            'type'      => 'icon',
            'title'     => esc_html__('Contact info icon', 'portio')
          ),
          array(
            'id'        => 'item_title',
            'type'      => 'text',
            'title'     => esc_html__('Contact info title', 'portio')
          ),
        ),

      ),

      // footer Address
       array(
          'name'          => 'portio_footer_address_item',
          'title'         => esc_html__('Address', 'portio'),
          'view'          => 'clone',
          'clone_id'      => 'portio_footer_address_items',
          'clone_title'   => esc_html__('Add New', 'portio'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'portio'),
            ),

          ),
          'clone_fields'  => array(
            array(
              'id'        => 'item',
              'type'      => 'text',
              'title'     => esc_html__('Address item', 'portio')
            ),
          ),
        ),

      ),
    );

  return $options;

  }
  add_filter( 'cs_shortcode_options', 'portio_shortcodes' );
}