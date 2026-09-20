<?php

/**
 * Initialize Custom Post Type - Portio Theme
 */

function portio_custom_post_type() {


  $service_cpt = (portio_framework_active()) ? cs_get_option('theme_service_name') : '';
  $service_slug = (portio_framework_active()) ? cs_get_option('theme_service_slug') : '';
  $service_cpt_slug = (portio_framework_active()) ? cs_get_option('theme_service_cat_slug') : '';

  $base = (isset($service_cpt_slug) && $service_cpt_slug !== '') ? sanitize_title_with_dashes($service_cpt_slug) : ((isset($service_cpt) && $service_cpt !== '') ? strtolower($service_cpt) : 'service');
  $base_slug = (isset($service_slug) && $service_slug !== '') ? sanitize_title_with_dashes($service_slug) : ((isset($service_cpt) && $service_cpt !== '') ? strtolower($service_cpt) : 'service');
  $label = ucfirst((isset($service_cpt) && $service_cpt !== '') ? strtolower($service_cpt) : 'service');

  // Register custom post type - Service
  register_post_type(
    'service',
    array(
      'labels' => array(
        'name' => $label,
        'singular_name' => sprintf(esc_html__('%s Post', 'portio-core'), $label),
        'all_items' => sprintf(esc_html__('All %s', 'portio-core'), $label),
        'add_new' => esc_html__('Add New', 'portio-core'),
        'add_new_item' => sprintf(esc_html__('Add New %s', 'portio-core'), $label),
        'edit' => esc_html__('Edit', 'portio-core'),
        'edit_item' => sprintf(esc_html__('Edit %s', 'portio-core'), $label),
        'new_item' => sprintf(esc_html__('New %s', 'portio-core'), $label),
        'view_item' => sprintf(esc_html__('View %s', 'portio-core'), $label),
        'search_items' => sprintf(esc_html__('Search %s', 'portio-core'), $label),
        'not_found' => esc_html__('Nothing found in the Database.', 'portio-core'),
        'not_found_in_trash' => esc_html__('Nothing found in Trash', 'portio-core'),
        'parent_item_colon' => ''
      ),
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 10,
      'menu_icon' => 'dashicons-edit-page',
      'rewrite' => array(
        'slug' => $base_slug,
        'with_front' => false
      ),
      'has_archive' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'sticky',
        'elementor',
        'page-attributes'
      )
    )
  );
  // Registered

  // Add Category Taxonomy for our Custom Post Type - Service
  register_taxonomy(
    'service_category',
    'service',
    array(
      'hierarchical' => true,
      'public' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'show_in_nav_menus' => true,
      'labels' => array(
        'name' => sprintf(esc_html__('%s Categories', 'portio-core'), $label),
        'singular_name' => sprintf(esc_html__('%s Category', 'portio-core'), $label),
        'search_items' =>  sprintf(esc_html__('Search %s Categories', 'portio-core'), $label),
        'all_items' => sprintf(esc_html__('All %s Categories', 'portio-core'), $label),
        'parent_item' => sprintf(esc_html__('Parent %s Category', 'portio-core'), $label),
        'parent_item_colon' => sprintf(esc_html__('Parent %s Category:', 'portio-core'), $label),
        'edit_item' => sprintf(esc_html__('Edit %s Category', 'portio-core'), $label),
        'update_item' => sprintf(esc_html__('Update %s Category', 'portio-core'), $label),
        'add_new_item' => sprintf(esc_html__('Add New %s Category', 'portio-core'), $label),
        'new_item_name' => sprintf(esc_html__('New %s Category Name', 'portio-core'), $label)
      ),
      'rewrite' => array('slug' => $base . '_cat'),
    )
  );

  $service_custom_taxonomies = (portio_framework_active()) ? cs_get_option('service_custom_taxonomies') : '';
  $counter = 0;
  if ($service_custom_taxonomies) {
    foreach ($service_custom_taxonomies as $key => $custom_taxonomy) {
      $counter++;
      $heading = $custom_taxonomy['taxonomy_name'];
      $own_id = preg_replace('/[^a-z]/', "_", strtolower($heading));

      register_taxonomy(
        'service_' . $own_id,
        'service',
        array(
          'hierarchical' => true,
          'public' => true,
          'show_ui' => true,
          'show_admin_column' => true,
          'show_in_nav_menus' => true,
          'labels' => array(
            'name' => sprintf(esc_html__('%s ' . $heading, 'portio-core'), $label),
            'singular_name' => sprintf(esc_html__('%s ' . $heading, 'portio-core'), $label),
            'search_items' =>  sprintf(esc_html__('Search %s ' . $heading, 'portio-core'), $label),
            'all_items' => sprintf(esc_html__('All %s ' . $heading, 'portio-core'), $label),
            'parent_item' => sprintf(esc_html__('Parent %s ' . $heading, 'portio-core'), $label),
            'parent_item_colon' => sprintf(esc_html__('Parent %s :.$heading', 'portio-core'), $label),
            'edit_item' => sprintf(esc_html__('Edit %s ' . $heading, 'portio-core'), $label),
            'update_item' => sprintf(esc_html__('Update %s ' . $heading, 'portio-core'), $label),
            'add_new_item' => sprintf(esc_html__('Add New %s ' . $heading, 'portio-core'), $label),
            'new_item_name' => sprintf(esc_html__('New %s ' . $heading . ' Name', 'portio-core'), $label)
          ),
          'rewrite' => array('slug' => 'service_' . $own_id),
        )
      );
    }
  }


  $project_cpt = (portio_framework_active()) ? cs_get_option('theme_project_name') : '';
  $project_slug = (portio_framework_active()) ? cs_get_option('theme_project_slug') : '';
  $project_cpt_slug = (portio_framework_active()) ? cs_get_option('theme_project_cat_slug') : '';

  $base = (isset($project_cpt_slug) && $project_cpt_slug !== '') ? sanitize_title_with_dashes($project_cpt_slug) : ((isset($project_cpt) && $project_cpt !== '') ? strtolower($project_cpt) : 'project');
  $base_slug = (isset($project_slug) && $project_slug !== '') ? sanitize_title_with_dashes($project_slug) : ((isset($project_cpt) && $project_cpt !== '') ? strtolower($project_cpt) : 'project');
  $label = ucfirst((isset($project_cpt) && $project_cpt !== '') ? strtolower($project_cpt) : 'project');

  // Register custom post type - Service
  register_post_type('project',
    array(
      'labels' => array(
        'name' => $label,
        'singular_name' => sprintf(esc_html__('%s Post', 'portio-core' ), $label),
        'all_items' => sprintf(esc_html__('All %s', 'portio-core' ), $label),
        'add_new' => esc_html__('Add New', 'portio-core') ,
        'add_new_item' => sprintf(esc_html__('Add New %s', 'portio-core' ), $label),
        'edit' => esc_html__('Edit', 'portio-core') ,
        'edit_item' => sprintf(esc_html__('Edit %s', 'portio-core' ), $label),
        'new_item' => sprintf(esc_html__('New %s', 'portio-core' ), $label),
        'view_item' => sprintf(esc_html__('View %s', 'portio-core' ), $label),
        'search_items' => sprintf(esc_html__('Search %s', 'portio-core' ), $label),
        'not_found' => esc_html__('Nothing found in the Database.', 'portio-core') ,
        'not_found_in_trash' => esc_html__('Nothing found in Trash', 'portio-core') ,
        'parent_item_colon' => ''
      ) ,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 10,
      'menu_icon' => 'dashicons-portfolio',
      'rewrite' => array(
        'slug' => $base_slug,
        'with_front' => false
      ),
      'has_archive' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'sticky',
        'elementor',
        'page-attributes'
      )
    )
  );
  // Registered

  // Add Category Taxonomy for our Custom Post Type - Service
  register_taxonomy(
    'project_category',
    'project',
    array(
      'hierarchical' => true,
      'public' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'show_in_nav_menus' => true,
      'labels' => array(
        'name' => sprintf(esc_html__( '%s Categories', 'portio-core' ), $label),
        'singular_name' => sprintf(esc_html__('%s Category', 'portio-core'), $label),
        'search_items' =>  sprintf(esc_html__( 'Search %s Categories', 'portio-core'), $label),
        'all_items' => sprintf(esc_html__( 'All %s Categories', 'portio-core'), $label),
        'parent_item' => sprintf(esc_html__( 'Parent %s Category', 'portio-core'), $label),
        'parent_item_colon' => sprintf(esc_html__( 'Parent %s Category:', 'portio-core'), $label),
        'edit_item' => sprintf(esc_html__( 'Edit %s Category', 'portio-core'), $label),
        'update_item' => sprintf(esc_html__( 'Update %s Category', 'portio-core'), $label),
        'add_new_item' => sprintf(esc_html__( 'Add New %s Category', 'portio-core'), $label),
        'new_item_name' => sprintf(esc_html__( 'New %s Category Name', 'portio-core'), $label)
      ),
      'rewrite' => array( 'slug' => $base . '_cat' ),
    )
  );

  $project_custom_taxonomies = (portio_framework_active()) ? cs_get_option('project_custom_taxonomies') : '';
  $counter = 0;
  if ($project_custom_taxonomies) {
    foreach ($project_custom_taxonomies as $key => $custom_taxonomy) {
      $counter++;
      $heading = $custom_taxonomy['taxonomy_name'];
      $own_id = preg_replace('/[^a-z]/', "_", strtolower($heading));

      register_taxonomy(
        'project_'.$own_id,
        'project',
        array(
          'hierarchical' => true,
          'public' => true,
          'show_ui' => true,
          'show_admin_column' => true,
          'show_in_nav_menus' => true,
          'labels' => array(
            'name' => sprintf(esc_html__( '%s '.$heading, 'portio-core' ), $label),
            'singular_name' => sprintf(esc_html__('%s '.$heading, 'portio-core'), $label),
            'search_items' =>  sprintf(esc_html__( 'Search %s '.$heading, 'portio-core'), $label),
            'all_items' => sprintf(esc_html__( 'All %s '.$heading, 'portio-core'), $label),
            'parent_item' => sprintf(esc_html__( 'Parent %s '.$heading, 'portio-core'), $label),
            'parent_item_colon' => sprintf(esc_html__( 'Parent %s :.$heading', 'portio-core'), $label),
            'edit_item' => sprintf(esc_html__( 'Edit %s '.$heading, 'portio-core'), $label),
            'update_item' => sprintf(esc_html__( 'Update %s '.$heading, 'portio-core'), $label),
            'add_new_item' => sprintf(esc_html__( 'Add New %s '.$heading, 'portio-core'), $label),
            'new_item_name' => sprintf(esc_html__( 'New %s '.$heading.' Name', 'portio-core'), $label)
          ),
          'rewrite' => array( 'slug' => 'project_'.$own_id),
        )
      );
    }
  }


  // Register custom post type - Project
  register_post_type('headerbuilder',
    array(
      'labels' => array(
        'name' => esc_html__('Header Builder', 'portio-core' ),
        'singular_name' => esc_html__('Header', 'portio-core' ),
        'all_items' => esc_html__('All Header', 'portio-core' ),
        'add_new' => esc_html__('Add New', 'portio-core') ,
        'add_new_item' => esc_html__('Add New Header', 'portio-core' ),
        'edit' => esc_html__('Edit', 'portio-core') ,
        'edit_item' => esc_html__('Edit Header', 'portio-core' ),
        'new_item' => esc_html__('New Header', 'portio-core' ),
        'view_item' => esc_html__('View Header', 'portio-core' ),
        'search_items' => esc_html__('Search Header', 'portio-core' ),
        'not_found' => esc_html__('Nothing found in the Database.', 'portio-core') ,
        'not_found_in_trash' => esc_html__('Nothing found in Trash', 'portio-core') ,
        'parent_item_colon' => ''
      ) ,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => true,
      'menu_icon' => 'dashicons-heading',
      'has_archive' => true,
      'hierarchical' => true,
      'supports' => array(
        'title',
        'elementor',
      )
    )
  );
  // Registered

  // Register custom post type - Project
  register_post_type('footerbuilder',
    array(
      'labels' => array(
        'name' => esc_html__('Footer Builder', 'portio-core' ),
        'singular_name' => esc_html__('Footer', 'portio-core' ),
        'all_items' => esc_html__('All Footer', 'portio-core' ),
        'add_new' => esc_html__('Add New', 'portio-core') ,
        'add_new_item' => esc_html__('Add New Footer', 'portio-core' ),
        'edit' => esc_html__('Edit', 'portio-core') ,
        'edit_item' => esc_html__('Edit Footer', 'portio-core' ),
        'new_item' => esc_html__('New Footer', 'portio-core' ),
        'view_item' => esc_html__('View Footer', 'portio-core' ),
        'search_items' => esc_html__('Search Footer', 'portio-core' ),
        'not_found' => esc_html__('Nothing found in the Database.', 'portio-core') ,
        'not_found_in_trash' => esc_html__('Nothing found in Trash', 'portio-core') ,
        'parent_item_colon' => ''
      ) ,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => true,
      'menu_icon' => 'dashicons-align-center',
      'has_archive' => true,
      'hierarchical' => true,
      'supports' => array(
        'title',
        'elementor',
      )
    )
  );
  // Registered


  // Team Start

  $team_cpt = (portio_framework_active()) ? cs_get_option('theme_team_name') : '';
  $team_slug = (portio_framework_active()) ? cs_get_option('theme_team_slug') : '';
  $team_cpt_slug = (portio_framework_active()) ? cs_get_option('theme_team_cat_slug') : '';

  $base = (isset($team_cpt_slug) && $team_cpt_slug !== '') ? sanitize_title_with_dashes($team_cpt_slug) : ((isset($team_cpt) && $team_cpt !== '') ? strtolower($team_cpt) : 'team');
  $base_slug = (isset($team_slug) && $team_slug !== '') ? sanitize_title_with_dashes($team_slug) : ((isset($team_cpt) && $team_cpt !== '') ? strtolower($team_cpt) : 'team');
  $label = ucfirst((isset($team_cpt) && $team_cpt !== '') ? strtolower($team_cpt) : 'team');

  // Register custom post type - Team
  register_post_type('team',
    array(
      'labels' => array(
        'name' => $label,
        'singular_name' => sprintf(esc_html__('%s Post', 'portio-core' ), $label),
        'all_items' => sprintf(esc_html__('All %s', 'portio-core' ), $label),
        'add_new' => esc_html__('Add New', 'portio-core') ,
        'add_new_item' => sprintf(esc_html__('Add New %s', 'portio-core' ), $label),
        'edit' => esc_html__('Edit', 'portio-core') ,
        'edit_item' => sprintf(esc_html__('Edit %s', 'portio-core' ), $label),
        'new_item' => sprintf(esc_html__('New %s', 'portio-core' ), $label),
        'view_item' => sprintf(esc_html__('View %s', 'portio-core' ), $label),
        'search_items' => sprintf(esc_html__('Search %s', 'portio-core' ), $label),
        'not_found' => esc_html__('Nothing found in the Database.', 'portio-core') ,
        'not_found_in_trash' => esc_html__('Nothing found in Trash', 'portio-core') ,
        'parent_item_colon' => ''
      ) ,
      'public' => true,
      'publicly_queryable' => true,
      'exclude_from_search' => false,
      'show_ui' => true,
      'query_var' => true,
      'menu_position' => 10,
      'menu_icon' => 'dashicons-businessperson',
      'rewrite' => array(
        'slug' => $base_slug,
        'with_front' => false
      ),
      'has_archive' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'supports' => array(
        'title',
        'editor',
        'author',
        'thumbnail',
        'excerpt',
        'trackbacks',
        'custom-fields',
        'comments',
        'revisions',
        'sticky',
        'page-attributes'
      )
    )
  );
  // Registered

  // Add Category Taxonomy for our Custom Post Type - Team
  register_taxonomy(
    'team_category',
    'team',
    array(
      'hierarchical' => true,
      'public' => true,
      'show_ui' => true,
      'show_admin_column' => true,
      'show_in_nav_menus' => true,
      'labels' => array(
        'name' => sprintf(esc_html__( '%s Categories', 'portio-core' ), $label),
        'singular_name' => sprintf(esc_html__('%s Category', 'portio-core'), $label),
        'search_items' =>  sprintf(esc_html__( 'Search %s Categories', 'portio-core'), $label),
        'all_items' => sprintf(esc_html__( 'All %s Categories', 'portio-core'), $label),
        'parent_item' => sprintf(esc_html__( 'Parent %s Category', 'portio-core'), $label),
        'parent_item_colon' => sprintf(esc_html__( 'Parent %s Category:', 'portio-core'), $label),
        'edit_item' => sprintf(esc_html__( 'Edit %s Category', 'portio-core'), $label),
        'update_item' => sprintf(esc_html__( 'Update %s Category', 'portio-core'), $label),
        'add_new_item' => sprintf(esc_html__( 'Add New %s Category', 'portio-core'), $label),
        'new_item_name' => sprintf(esc_html__( 'New %s Category Name', 'portio-core'), $label)
      ),
      'rewrite' => array( 'slug' => $base . '_cat' ),
    )
  );

  $team_custom_taxonomies = (portio_framework_active()) ? cs_get_option('team_custom_taxonomies') : '';
  $counter = 0;
  if ($team_custom_taxonomies) {
    foreach ($team_custom_taxonomies as $key => $custom_taxonomy) {
      $counter++;
      $heading = $custom_taxonomy['taxonomy_name'];
      $own_id = preg_replace('/[^a-z]/', "_", strtolower($heading));

      register_taxonomy(
        'team_'.$own_id,
        'team',
        array(
          'hierarchical' => true,
          'public' => true,
          'show_ui' => true,
          'show_admin_column' => true,
          'show_in_nav_menus' => true,
          'labels' => array(
            'name' => sprintf(esc_html__( '%s '.$heading, 'portio-core' ), $label),
            'singular_name' => sprintf(esc_html__('%s '.$heading, 'portio-core'), $label),
            'search_items' =>  sprintf(esc_html__( 'Search %s '.$heading, 'portio-core'), $label),
            'all_items' => sprintf(esc_html__( 'All %s '.$heading, 'portio-core'), $label),
            'parent_item' => sprintf(esc_html__( 'Parent %s '.$heading, 'portio-core'), $label),
            'parent_item_colon' => sprintf(esc_html__( 'Parent %s :.$heading', 'portio-core'), $label),
            'edit_item' => sprintf(esc_html__( 'Edit %s '.$heading, 'portio-core'), $label),
            'update_item' => sprintf(esc_html__( 'Update %s '.$heading, 'portio-core'), $label),
            'add_new_item' => sprintf(esc_html__( 'Add New %s '.$heading, 'portio-core'), $label),
            'new_item_name' => sprintf(esc_html__( 'New %s '.$heading.' Name', 'portio-core'), $label)
          ),
          'rewrite' => array( 'slug' => 'team_'.$own_id),
        )
      );
    }
  }

  
    

}




// After Theme Setup
function portio_custom_flush_rules() {
	// Enter post type function, so rewrite work within this function
	portio_custom_post_type();
	// Flush it
	flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'portio_custom_flush_rules');
add_action('init', 'portio_custom_post_type');


/* ---------------------------------------------------------------------------
 * Custom columns - Service
 * --------------------------------------------------------------------------- */
add_filter("manage_edit-project_columns", "portio_project_edit_columns");
function portio_project_edit_columns($columns) {
  $new_columns['cb'] = '<input type="checkbox" />';
  $new_columns['title'] = esc_html__('Title', 'portio-core' );
  $new_columns['thumbnail'] = esc_html__('Image', 'portio-core' );
  $new_columns['date'] = esc_html__('Date', 'portio-core' );

  return $new_columns;
}

add_action('manage_project_posts_custom_column', 'portio_manage_project_columns', 10, 2);
function portio_manage_project_columns( $column_name ) {
  global $post;

  switch ($column_name) {

    /* If displaying the 'Image' column. */
    case 'thumbnail':
      echo get_the_post_thumbnail( $post->ID, array( 100, 100) );
    break;

    /* Just break out of the switch statement for everything else. */
    default :
      break;
    break;

  }
}



