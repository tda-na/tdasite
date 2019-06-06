<?php
/**
 * @author     Gaviasthemes Team     
 * @copyright  Copyright (C) 2018 Gaviasthemess. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * 
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Gaviasthemer_Recent_Give_Widget extends WP_Widget{
     public function __construct(){
        $widget_ops = array('classname' => 'gva_widget_recent_give', 'description' => __('Displays Recent Give on the page','gaviasthemer') );
        parent::__construct('recent_give', __('Give - Recent Give','gaviasthemer'), $widget_ops);
    }

    /**
     * The main widget output function.
     * @param array $args
     * @param array $instance
     * @return string The widget output (html).
     */
    public function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        extract( $instance, EXTR_SKIP );

        $title = apply_filters( 'widget_title', $title );

        echo $before_widget;

            // Recent Posts
            $args = array(
                'posts_per_page'   => $number,
                'offset'           => 0,
                'category'         => 0,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'give_forms',
                'post_status'      => 'draft, publish, future, pending, private',
                'suppress_filters' => true
            );
         
            $query = new WP_Query( $args );
            ?>
            <h3 class="widget-title"><span><?php echo trim( $title ); ?></span></h3>
            <div class="give-list">
                <?php if( $query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <div class="item"><?php require( 'give/content-widget.php' );  ?></div>
                    <?php endwhile; ?> 
                <?php endif; ?>
            </div>
            <?php
            wp_reset_postdata();
        echo $after_widget;
    }

    /**
     * The function for saving widget updates in the admin section.
     * @param array $new_instance
     * @param array $old_instance
     * @return array The new widget settings.
     */
     
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $new_instance = $this->default_instance_args( $new_instance );

        /* Strip tags (if needed) and update the widget settings. */
        $instance['title']   = strip_tags( $new_instance['title'] );
        $instance['number'] = $new_instance['number'];

        return $instance;
    }

    /**
     * Output the admin form for the widget.
     * @param array $instance
     * @return string The output for the admin widget form.
     */
    public function form( $instance ) {
        $instance  = $this->default_instance_args( $instance );
        
    ?>
    <div class="gva-recent-give">
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'gaviasthemer' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'gaviasthemer' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
        </p>
    </div>
<?php
    }

    /**
     * Accepts and returns the widget's instance array - ensuring any missing
     * elements are generated and set to their default value.
     * @param array $instance
     * @return array
     */
    protected function default_instance_args( array $instance ) {
        return wp_parse_args( $instance, array(
            'title'   => esc_html__( 'Recent Gives', 'gaviasthemer' ),
            'number'  => '5',
        ) );
    }
}

add_action('widgets_init', create_function('', 'return register_widget("Gaviasthemer_Recent_Give_Widget");'));
