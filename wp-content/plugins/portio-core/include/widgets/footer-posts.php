<?php
/*
 * Footer Post Widget
 * Author & Copyright: designakb
 * URL: http://themeforest.net/user/designakb
 */
class portio_footer_posts extends WP_Widget {

  /**
   * Specifies the widget name, description, class name and instatiates it
   */
  public function __construct() {
    parent::__construct(
      '-footer-blog',
      GRAFCO_THEME_NAME_PLUGIN . esc_html__( ': Footer Posts', 'portio' ),
      array(
        'classname'   => 'footer-post-widget',
        'description' => GRAFCO_THEME_NAME_PLUGIN . esc_html__( ' widget that displays footer posts.', 'portio' )
      )
    );
  }

  /**
   * Generates the back-end layout for the widget
   */
  public function form( $instance ) {
    // Default Values
    $instance   = wp_parse_args( $instance, array(
      'title'    => esc_html__( 'Footer Posts', 'portio' ),
      'ptypes'   => 'post',
      'limit'    => '3',
      'date'     => true,
      'category' => '',
      'order' => '',
      'orderby' => '',
    ));

    // Title
    $title_value = esc_attr( $instance['title'] );
    $title_field = array(
      'id'    => $this->get_field_name('title'),
      'name'  => $this->get_field_name('title'),
      'type'  => 'text',
      'title' => esc_html__( 'Title :', 'portio' ),
      'wrap_class' => 'cs-widget-fields',
    );
    echo cs_add_element( $title_field, $title_value );

    // Post Type
    $ptypes_value = esc_attr( $instance['ptypes'] );
    $ptypes_field = array(
      'id'    => $this->get_field_name('ptypes'),
      'name'  => $this->get_field_name('ptypes'),
      'type' => 'select',
      'options' => 'post_types',
      'default_option' => esc_html__( 'Select Post Type', 'portio' ),
      'title' => esc_html__( 'Post Type :', 'portio' ),
    );
    echo cs_add_element( $ptypes_field, $ptypes_value );

    // Limit
    $limit_value = esc_attr( $instance['limit'] );
    $limit_field = array(
      'id'    => $this->get_field_name('limit'),
      'name'  => $this->get_field_name('limit'),
      'type'  => 'text',
      'title' => esc_html__( 'Limit :', 'portio' ),
      'help' => esc_html__( 'How many posts want to show?', 'portio' ),
    );
    echo cs_add_element( $limit_field, $limit_value );

    // Date
    $date_value = esc_attr( $instance['date'] );
    $date_field = array(
      'id'    => $this->get_field_name('date'),
      'name'  => $this->get_field_name('date'),
      'type'  => 'switcher',
      'on_text'  => esc_html__( 'Yes', 'portio' ),
      'off_text'  => esc_html__( 'No', 'portio' ),
      'title' => esc_html__( 'Display Date :', 'portio' ),
    );
    echo cs_add_element( $date_field, $date_value );

    // Category
    $category_value = esc_attr( $instance['category'] );
    $category_field = array(
      'id'    => $this->get_field_name('category'),
      'name'  => $this->get_field_name('category'),
      'type'  => 'text',
      'title' => esc_html__( 'Category :', 'portio' ),
      'help' => esc_html__( 'Enter category slugs with comma(,) for multiple items', 'portio' ),
    );
    echo cs_add_element( $category_field, $category_value );

    // Order
    $order_value = esc_attr( $instance['order'] );
    $order_field = array(
      'id'    => $this->get_field_name('order'),
      'name'  => $this->get_field_name('order'),
      'type' => 'select',
      'options'   => array(
        'ASC' => 'Ascending',
        'DESC' => 'Descending',
      ),
      'default_option' => esc_html__( 'Select Order', 'portio' ),
      'title' => esc_html__( 'Order :', 'portio' ),
    );
    echo cs_add_element( $order_field, $order_value );

    // Orderby
    $orderby_value = esc_attr( $instance['orderby'] );
    $orderby_field = array(
      'id'    => $this->get_field_name('orderby'),
      'name'  => $this->get_field_name('orderby'),
      'type' => 'select',
      'options'   => array(
        'none' => esc_html__('None', 'portio'),
        'ID' => esc_html__('ID', 'portio'),
        'author' => esc_html__('Author', 'portio'),
        'title' => esc_html__('Title', 'portio'),
        'name' => esc_html__('Name', 'portio'),
        'type' => esc_html__('Type', 'portio'),
        'date' => esc_html__('Date', 'portio'),
        'modified' => esc_html__('Modified', 'portio'),
        'rand' => esc_html__('Random', 'portio'),
      ),
      'default_option' => esc_html__( 'Select OrderBy', 'portio' ),
      'title' => esc_html__( 'OrderBy :', 'portio' ),
    );
    echo cs_add_element( $orderby_field, $orderby_value );

  }

  /**
   * Processes the widget's values
   */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;

    // Update values
    $instance['title']        = strip_tags( stripslashes( $new_instance['title'] ) );
    $instance['ptypes']       = strip_tags( stripslashes( $new_instance['ptypes'] ) );
    $instance['limit']        = strip_tags( stripslashes( $new_instance['limit'] ) );
    $instance['date']         = strip_tags( stripslashes( $new_instance['date'] ) );
    $instance['category']     = strip_tags( stripslashes( $new_instance['category'] ) );
    $instance['order']        = strip_tags( stripslashes( $new_instance['order'] ) );
    $instance['orderby']      = strip_tags( stripslashes( $new_instance['orderby'] ) );

    return $instance;
  }

  /**
   * Output the contents of the widget
   */
  public function widget( $args, $instance ) {
    // Extract the arguments
    extract( $args );

    $title          = apply_filters( 'widget_title', $instance['title'] );
    $ptypes         = $instance['ptypes'];
    $limit          = $instance['limit'];
    $display_date   = $instance['date'];
    $category       = $instance['category'];
    $order          = $instance['order'];
    $orderby        = $instance['orderby'];

    $args = array(
      // other query params here,
      'post_type' => esc_attr($ptypes),
      'posts_per_page' => (int)$limit,
      'orderby' => esc_attr($orderby),
      'order' => esc_attr($order),
      'category_name' => esc_attr($category),
      'ignore_sticky_posts' => 1,
     );

     $portio_rpw = new WP_Query( $args );
     global $post;

    // Display the markup before the widget
    echo $before_widget;

    if ( $title ) {
      echo $before_title . $title . $after_title;
    }
    echo '<div class="posts"><ul class="d-flex">';
    if ($portio_rpw->have_posts()) : while ($portio_rpw->have_posts()) : $portio_rpw->the_post();
      $post_options = get_post_meta( get_the_ID(), 'post_options', true );
      $project_options = get_post_meta( get_the_ID(), 'project_options', true );

      $project_image = isset( $project_options['project_image']) ? $project_options['project_image'] : '';
      $image_url = wp_get_attachment_url( $project_image );
      $image_alt = get_post_meta( $project_image , '_wp_attachment_image_alt', true);

      if(class_exists('Aq_Resize')) {
        $post_img = aq_resize( $image_url, '85', '85', true );
      } else {
         $post_img = $image_url;
      }
      if (!empty( $post_img )) {
        $post_img = $post_img;
      } else {
        $post_img = GRAFCO_PLUGIN_IMGS.'/70X80.jpg';
      } ?>

    <li>
      <a href="<?php echo esc_url( get_permalink() ); ?>">
       <img src="<?php echo esc_url(  $post_img ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
      </a>
    </li>
  <?php
    endwhile; endif;
    echo '</ul></div>';
    wp_reset_postdata();
    // Display the markup after the widget
    echo $after_widget;
  }
}

// Register the widget using an annonymous function
add_action( 'widgets_init', function() { register_widget( "portio_footer_posts" ); } );