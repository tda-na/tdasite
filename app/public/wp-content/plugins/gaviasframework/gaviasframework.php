<?php 
/**
 * Plugin Name: GaviasFramework
 * Description: Open Setting, Post Type, Shortcode ... for theme 
 * Version: 1.0.0
 * Author: Gaviasthemes Team
 */

define( 'GAVIAS_THEMER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'GAVIAS_THEMER_PLUGIN_DIR', plugin_dir_path( __FILE__ )  );

class Gavias_Themer{

	function __construct(){
		$this->load_language_file();
		$this->include_files();
		add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
      add_action('wp_head', array($this, 'gaviasframework_ajax_url'));
		$this->load_posttypes(); 
	}
	
	function gaviasframework_ajax_url(){
	    echo '<script> var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';
	}
	function load_language_file(){
		load_plugin_textdomain('gaviasframework', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}
	
	function include_files(){
		require_once('posttypes/brand.php');
		require_once('posttypes/testimonials.php');
		require_once('posttypes/footer.php');
      require_once('posttypes/megamenu.php');
		require_once('posttypes/lesson.php');
      require_once('redux/admin-init.php');
		require_once('shortcodes.php');

		require_once('import/import-widget.php');
		require_once('import/import-slider.php');
      require_once('import/import.php');

      require_once('includes/function.php');
	}


	function load_posttypes(){
		$opts = apply_filters( 'gaviasthemer_load_post_types', get_option( 'gaviasthemer_active_post_types' ) );
      if( !empty($opts) ){
         foreach( $opts as $opt => $key ){
            $file = str_replace( 'actived_', '', $opt );
            $filepath = GAVIAS_THEMER_PLUGIN_DIR.'posttypes/'.$file.'.php'; 
            if( file_exists($filepath) ){
               require_once( $filepath );
            }
         }  
      }
	} 

	function register_scripts(){
		$js_dir = plugin_dir_url( __FILE__ ).'js';
		wp_register_script('gavias.themer', $js_dir.'/gavias.themer.js', array('jquery'), null, true);
		wp_enqueue_script('gavias.themer');
	}
}

new Gavias_Themer();