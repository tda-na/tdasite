<?php

if(!function_exists('gavias_post_type_testimonial')   ){
    function gavias_post_type_testimonial(){
      $labels = array(
        'name' => __( 'Testimonial', 'gaviasframework' ),
        'singular_name' => __( 'Testimonial', 'gaviasframework' ),
        'add_new' => __( 'Add New Testimonial', 'gaviasframework' ),
        'add_new_item' => __( 'Add New Testimonial', 'gaviasframework' ),
        'edit_item' => __( 'Edit Testimonial', 'gaviasframework' ),
        'new_item' => __( 'New Testimonial', 'gaviasframework' ),
        'view_item' => __( 'View Testimonial', 'gaviasframework' ),
        'search_items' => __( 'Search Testimonials', 'gaviasframework' ),
        'not_found' => __( 'No Testimonials found', 'gaviasframework' ),
        'not_found_in_trash' => __( 'No Testimonials found in Trash', 'gaviasframework' ),
        'parent_item_colon' => __( 'Parent Testimonial:', 'gaviasframework' ),
        'menu_name' => __( 'Testimonials', 'gaviasframework' ),
      );

      $args = array(
          'labels' => $labels,
          'hierarchical' => true,
          'description' => 'List Testimonial',
          'supports' => array( 'title', 'editor', 'thumbnail','excerpt'),
          'public' => true,
          'show_ui' => true,
          'show_in_menu' => true,
          'menu_position' => 5,
          'show_in_nav_menus' => false,
          'publicly_queryable' => true,
          'exclude_from_search' => false,
          'has_archive' => true,
          'query_var' => true,
          'can_export' => true,
          'rewrite' => true,
          'capability_type' => 'post'
      );
      register_post_type( 'testimonials', $args );
    }
   add_action( 'init','gavias_post_type_testimonial' ); 
}

if(!function_exists('gavias_testimonial_register_taxonomy')){
function gavias_testimonial_register_taxonomy(){
  $args = array(
      'labels' => array(
            'name'                => esc_html_x( 'Categories', 'taxonomy general name', 'gaviasframework' ),
            'singular_name'       => esc_html_x( 'Category', 'taxonomy singular name', 'gaviasframework' ),
            'search_items'        => esc_html__( 'Search Categories', 'gaviasframework' ),
            'all_items'           => esc_html__( 'All Categories', 'gaviasframework' ),
            'parent_item'         => esc_html__( 'Parent Category', 'gaviasframework' ),
            'parent_item_colon'   => esc_html__( 'Parent Category:', 'gaviasframework' ),
            'edit_item'           => esc_html__( 'Edit Category', 'gaviasframework' ),
            'update_item'         => esc_html__( 'Update Category', 'gaviasframework' ),
            'add_new_item'        => esc_html__( 'Add New Category', 'gaviasframework' ),
            'new_item_name'       => esc_html__( 'New Category Name', 'gaviasframework' ),
            'menu_name'           => esc_html__( 'Categories', 'gaviasframework' ),
        ),
      'public'         => true,
      'hierarchical'     => true,
      'show_ui'        => true,
      'show_admin_column'  => true,
      'query_var'      => true,
      'show_in_nav_menus'  => false,
      'show_tagcloud'    => false
    );
  register_taxonomy('testimonial_cat', 'testimonials', $args);
}

add_action( 'init','gavias_testimonial_register_taxonomy' );

}