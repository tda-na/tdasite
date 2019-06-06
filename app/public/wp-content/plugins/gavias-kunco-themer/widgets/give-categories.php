<?php
/**
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2018 Gaviasthemess. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Gaviasthemer_Give_Categories_Widget extends WP_Widget {
   /**
    * Register widget with WordPress.
    */
   function __construct() {
      parent::__construct(
         'gva_give_categories_widget', // Base ID
         __( 'Give - Categories list', 'gaviasthemer' ), // Name
         array( 'description' => esc_html__( 'Display categories list of all taxonomy post type', 'gaviasthemer' ), ) // Args
      );
   }

   /**
    * Front-end display of widget.
    *
    * @see WP_Widget::widget()
    *
    * @param array $args     Widget arguments.
    * @param array $instance Saved values from database.
    */
   public function widget( $args, $instance ) {
      echo $args['before_widget'];
      $output ='<div class="gva-wiget-give-categories">';
      if ( ! empty( $instance['title'] ) && !$instance['hide_title']) {
         echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
      }
      $instance['taxonomy_type'] = 'give_forms_category';

      if($instance['taxonomy_type']){
         $output .='<ul class="categories-listing">';
            $args_val = array( 'hide_empty=0' );            
            $terms = get_terms( $instance['taxonomy_type'], $args_val );
            if ( $terms ) {   

               foreach ( $terms as $term ) {
                  
                  $term_link = get_term_link( $term );
                  
                  if ( is_wp_error( $term_link ) ) {
                  continue;
                  }
                  
               $carrentActiveClass=''; 
               
               if($term->taxonomy=='category' && is_category())
               {
                 $thisCat = get_category(get_query_var('cat'),false);
                 if($thisCat->term_id == $term->term_id)
                  $carrentActiveClass='class="active-cat"';
                }
                
               if(is_tax())
               {
                   $currentTermType = get_query_var( 'taxonomy' );
                   $termId= get_queried_object()->term_id;
                   if(is_tax($currentTermType) && $termId==$term->term_id)
                    $carrentActiveClass='class="active-cat"';
               }
                  
                  $output .='<li '.$carrentActiveClass.'><a href="' . esc_url( $term_link ) . '">' . $term->name . '</a>';
                  if (empty( $instance['hide_count'] )) {
                     $output .='<span class="post-count">'.$term->count.'</span>';
                  }
                  $output .='</li>';
               }
            }
         $output .='</ul>';
         echo $output;
      }  
      $output .='</div>';
      echo $args['after_widget'];
   }

   /**
    * Back-end widget form.
    *
    * @see WP_Widget::form()
    *
    * @param array $instance Previously saved values from database.
   */
   public function form( $instance ) {
      $title              = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'WP Categories', 'gaviasthemer' );
      $hide_title         = ! empty( $instance['hide_title'] ) ? $instance['hide_title'] : esc_html__( '', 'gaviasthemer' );
      $hide_count         = ! empty( $instance['hide_count'] ) ? $instance['hide_count'] : esc_html__( '', 'gaviasthemer' );
      ?>
      <p>
      <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( esc_attr( 'Title:' ) ); ?></label> 
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
      </p>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hide_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_title' ) ); ?>" type="checkbox" value="1" <?php checked( $hide_title, 1 ); ?>>
      <label for="<?php echo esc_attr( $this->get_field_id( 'hide_title' ) ); ?>"><?php _e( esc_attr( 'Hide Title' ) ); ?> </label> 
      </p>
      <p>
      <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'hide_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'hide_count' ) ); ?>" type="checkbox" value="1" <?php checked( $hide_count, 1 ); ?>>
      <label for="<?php echo esc_attr( $this->get_field_id( 'hide_count' ) ); ?>"><?php _e( esc_attr( 'Hide Count' ) ); ?> </label> 
      </p>
     
      <?php 
   }

   /**
    * Sanitize widget form values as they are saved.
    *
    * @see WP_Widget::update()
    *
    * @param array $new_instance Values just sent to be saved.
    * @param array $old_instance Previously saved values from database.
    *
    * @return array Updated safe values to be saved.
    */
   public function update( $new_instance, $old_instance ) {
      $instance = array();
      $instance['title']              = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
      $instance['hide_title']         = ( ! empty( $new_instance['hide_title'] ) ) ? strip_tags( $new_instance['hide_title'] ) : '';
      $instance['hide_count']         = ( ! empty( $new_instance['hide_count'] ) ) ? strip_tags( $new_instance['hide_count'] ) : '';
      return $instance;
   }
}// class Gaviasthemer_Give_Categories_Widget

// register Gaviasthemer_Give_Categories_Widget widget
function register_gva_give_categories_widget() {
    register_widget( 'Gaviasthemer_Give_Categories_Widget' );
}
add_action( 'widgets_init', 'register_gva_give_categories_widget'); 
