<?php
if(!function_exists('gavias_post_type_teacher')){
    function gavias_post_type_teacher(){
      $labels = array(
        'name' => __( 'Teacher', 'gaviasframework' ),
        'singular_name' => __( 'Teacher', 'gaviasframework' ),
        'add_new' => __( 'Add New Teacher', 'gaviasframework' ),
        'add_new_item' => __( 'Add New Teacher', 'gaviasframework' ),
        'edit_item' => __( 'Edit Teacher', 'gaviasframework' ),
        'new_item' => __( 'New Teacher', 'gaviasframework' ),
        'view_item' => __( 'View Teacher', 'gaviasframework' ),
        'search_items' => __( 'Search Teachers', 'gaviasframework' ),
        'not_found' => __( 'No Teachers found', 'gaviasframework' ),
        'not_found_in_trash' => __( 'No Teachers found in Trash', 'gaviasframework' ),
        'parent_item_colon' => __( 'Parent Teacher:', 'gaviasframework' ),
        'menu_name' => __( 'Teachers', 'gaviasframework' ),
      );

      $args = array(
          'labels' => $labels,
          'hierarchical' => false,
          'description' => 'List Teacher',
          'supports' => array( 'title', 'editor', 'thumbnail','excerpt','comment'),
          'public' => true,
          'show_ui' => true,
          'show_in_menu' => true,
          'menu_position' => 5,
          'taxonomies' => array(   'category_teachers'),
          'show_in_nav_menus' => false,
          'publicly_queryable' => true,
          'exclude_from_search' => false,
          'has_archive'         => true,
          'query_var'           => true,
          'can_export'          => true,
          'rewrite'             => array('slug'=>'teacher'),
          'capability_type' => 'post'
      );
      register_post_type( 'teacher', $args );
    }

  add_action( 'init','gavias_post_type_teacher' );

  function gaviasthemer_get_teachers(){
    $args = array(
      'post_type'     => 'teacher',
      'posts_per_page'   => -1,
      'post_status'    => 'publish',
    );
    $posts = new WP_Query($args);
    $teachers = array();
    if( $posts->have_posts() ){
      while( $posts->have_posts() ){
        $posts->the_post();
        $teachers[get_the_ID()] = get_the_title();
      }
    }
    wp_reset_postdata();
    return apply_filters('gaviasthemes_list_teacher', $teachers );
  }

  function gaviasthemer_get_teacher($id){
    $teacher = get_post($id);
    return $teacher;
  }

  // -- Dynamic Social Teacher Metabox -- 
  add_action( 'add_meta_boxes', 'gaviasthemer_teacher_socials' );
  add_action( 'save_post', 'teacher_socials_save_postdata' );
  function gaviasthemer_teacher_socials() {
      add_meta_box(
          'gaviasthemer_teacher_socials',
          __( 'Socials', 'gaviasframework' ),
          'teacher_socials_inner_custom_box',
          'teacher');
  }
  function teacher_socials_inner_custom_box() {
      global $post;
      wp_nonce_field( plugin_basename( __FILE__ ), 'dynamic_socials_noncename' );
      ?>
      <div id="meta_inner">
      <?php

      $teacher_socials = get_post_meta($post->ID, 'teacher_socials', true);

      $c = 0;
      if ( ($teacher_socials) && count( $teacher_socials ) > 0 ) {
          foreach( $teacher_socials as $social ) {
              if ( isset( $social['icon'] ) || isset( $social['link'] ) ) {
                  printf( '<p><input size="20" type="text" placeholder="Class Icon" name="teacher_socials[%1$s][icon]" value="%2$s" /><input size="100" type="text" placeholder="Link" name="teacher_socials[%1$s][link]" value="%3$s" /><a class="button remove">%4$s</a></p>', $c, $social['icon'], $social['link'], __( 'Remove' ) );
                  $c = $c +1;
              }
          }
      }

      ?>
  <span id="teacher-social-list"></span>
  <a class="add-social-item"><?php _e('Add Social'); ?></a>
  <script>
      var $ =jQuery.noConflict();
      $(document).ready(function() {
          var count = <?php echo $c; ?>;
          $(".add-social-item").click(function() {
              count = count + 1;
              $('#teacher-social-list').append('<p> <input size="20" type="text" placeholder="Class Icon" name="teacher_socials['+count+'][icon]" value="" /><input size="100" type="text" placeholder="Link" name="teacher_socials['+count+'][link]" value="" /> <a class="remove button">Remove</a></p>' );
              return false;
          });
          $(".remove").live('click', function() {
              $(this).parent().remove();
          });
      });
      </script>
  </div><?php
  }

  function teacher_socials_save_postdata( $post_id ) {
     if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
          return;
     if ( !isset( $_POST['dynamic_socials_noncename'] ) )
          return;

     if ( !wp_verify_nonce( $_POST['dynamic_socials_noncename'], plugin_basename( __FILE__ ) ) )
          return;
     $teacher_socials = $_POST['teacher_socials'];
     update_post_meta($post_id,'teacher_socials', $teacher_socials);
  }

  // -- Dynamic Education Teacher Metabox -- 
  add_action( 'add_meta_boxes', 'gaviasthemer_teacher_education' );
  add_action( 'save_post', 'teacher_educations_save_postdata' );
  function gaviasthemer_teacher_education() {
    add_meta_box(
        'gaviasthemer_teacher_education',
        __( 'Education', 'gaviasframework' ),
        'teacher_education_inner_custom_box',
        'teacher');
  }

  function teacher_education_inner_custom_box() {
      global $post;
      wp_nonce_field( plugin_basename( __FILE__ ), 'dynamic_educations_noncename' );
      ?>
      <div id="meta_inner">
      <?php

      $teacher_educations = get_post_meta($post->ID, 'teacher_educations', true);

      $c = 0;
      if ( ($teacher_educations) && count( $teacher_educations ) > 0 ) {
          foreach( $teacher_educations as $education ) {
              if ( isset( $education['title'] ) ) {
                  printf( '<p><input size="120" type="text" placeholder="Title: MBA, Rotterdam School of Management, Erasmus University" name="teacher_educations[%1$s][title]" value="%2$s" /><a class="button remove">%3$s</a></p>', $c, $education['title'], __( 'Remove' ) );
                  $c = $c +1;
              }
          }
      }

      ?>
  <span id="teacher-education-list"></span>
  <a class="add-education-item"><?php _e('Add Education'); ?></a>
  <script>
      var $ =jQuery.noConflict();
      $(document).ready(function() {
          var count = <?php echo $c; ?>;
          $(".add-education-item").click(function() {
              count = count + 1;
              $('#teacher-education-list').append('<p><input size="120" type="text" placeholder="Title: MBA, Rotterdam School of Management, Erasmus University" name="teacher_educations['+count+'][title]" value="" /> <a class="remove button">Remove</a></p>' );
              return false;
          });
          $(".remove").live('click', function() {
              $(this).parent().remove();
          });
      });
      </script>
  </div><?php
  }

  function teacher_educations_save_postdata( $post_id ) {
     if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
          return;
     if ( !isset( $_POST['dynamic_educations_noncename'] ) )
          return;

     if ( !wp_verify_nonce( $_POST['dynamic_educations_noncename'], plugin_basename( __FILE__ ) ) )
          return;
     $teacher_educations = $_POST['teacher_educations'];
     update_post_meta($post_id,'teacher_educations', $teacher_educations);
  }

  // -- Dynamic Skills Teacher Metabox -- 
  add_action( 'add_meta_boxes', 'gaviasthemer_teacher_skills' );
  add_action( 'save_post', 'teacher_skills_save_postdata' );
  function gaviasthemer_teacher_skills() {
    add_meta_box(
        'gaviasthemer_teacher_skills',
        __( 'Skills', 'gaviasframework' ),
        'teacher_skills_inner_custom_box',
        'teacher');
  }

  function teacher_skills_inner_custom_box() {
      global $post;
      wp_nonce_field( plugin_basename( __FILE__ ), 'dynamic_skills_noncename' );
      ?>
      <div id="meta_inner">
      <?php

      $teacher_skills = get_post_meta($post->ID, 'teacher_skills', true);

      $c = 0;
      if ( ($teacher_skills) && count( $teacher_skills ) > 0 ) {
          foreach( $teacher_skills as $skill ) {
              if ( isset( $skill['label'] ) || isset( $skill['volume'] ) ) {
                  printf( '<p><input size="80" type="text" placeholder="Label" name="teacher_skills[%1$s][label]" value="%2$s" /><input size="20" type="text" placeholder=" Volume (max 100)" name="teacher_skills[%1$s][volume]" value="%3$s" /><a class="button remove">%4$s</a></p>', $c, $skill['label'], $skill['volume'], __( 'Remove' ) );
                  $c = $c +1;
              }
          }
      }

      ?>
  <span id="teacher-skills-list"></span>
  <a class="add-skills-item"><?php _e('Add Skills'); ?></a>
  <script>
      var $ =jQuery.noConflict();
      $(document).ready(function() {
          var count = <?php echo $c; ?>;
          $(".add-skills-item").click(function() {
              count = count + 1;
              $('#teacher-skills-list').append('<p><input size="80" type="text" placeholder="Label" name="teacher_skills['+count+'][label]" value="" /> <input size="20" type="text" placeholder="Volume (max 100)" name="teacher_skills['+count+'][volume]" value="" /><a class="remove button">Remove</a></p>' );
              return false;
          });
          $(".remove").live('click', function() {
              $(this).parent().remove();
          });
      });
      </script>
  </div><?php
  }

  function teacher_skills_save_postdata( $post_id ) {
     if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
          return;
     if ( !isset( $_POST['dynamic_skills_noncename'] ) )
          return;

     if ( !wp_verify_nonce( $_POST['dynamic_skills_noncename'], plugin_basename( __FILE__ ) ) )
          return;
     $teacher_skills = $_POST['teacher_skills'];
     update_post_meta($post_id,'teacher_skills', $teacher_skills);
  }

}
