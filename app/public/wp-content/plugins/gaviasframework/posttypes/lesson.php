<?php
if(!function_exists('gavias_lesson_register_taxonomy')){
  function gavias_lesson_register_taxonomy(){
    $args = array(
         'labels' => array(
           'name'                => esc_html_x( 'Categories', 'taxonomy general name', 'gaviasframework' ),
           'singular_name'       => esc_html_x( 'Category', 'taxonomy singular name', 'gaviasframework' ),
           'search_items'        => esc_html__( 'Search Categories', 'gaviasframework' ),
           'all_items'           => esc_html__( 'All Group', 'gaviasframework' ),
           'parent_item'         => esc_html__( 'Parent Category', 'gaviasframework' ),
           'parent_item_colon'   => esc_html__( 'Parent Category:', 'gaviasframework' ),
           'edit_item'           => esc_html__( 'Edit Category', 'gaviasframework' ),
           'update_item'         => esc_html__( 'Update Category', 'gaviasframework' ),
           'add_new_item'        => esc_html__( 'Add New Category', 'gaviasframework' ),
           'new_item_name'       => esc_html__( 'New Category Name', 'gaviasframework' ),
           'menu_name'           => esc_html__( 'Lesson Group', 'gaviasframework' ),
         ),
        'public'              => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'show_admin_column'   => true,
        'query_var'           => true,
        'show_in_nav_menus'   => false,
        'show_tagcloud'       => false
      );
    register_taxonomy('gva_lesson_cat', 'ib_educator_lesson', $args);
  }
  add_action( 'init','gavias_lesson_register_taxonomy' );
}