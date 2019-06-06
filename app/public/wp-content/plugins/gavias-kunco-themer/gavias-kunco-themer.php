<?php 
/**
 * Plugin Name: Gavias Kunco Themer
 * Description: Open Setting, Post Type, Shortcode ... for theme 
 * Version: 1.0.0
 * Author: Gavias Team
 */


class Gavias_Kunco_Themer{

	function __construct(){
		$this->load_language_file();
		$this->include_files();
	}

	function load_language_file(){
		load_plugin_textdomain('gavias-kunco-themer', false, basename( dirname( __FILE__ ) ) . '/languages' );
	}
	
	function include_files(){
		require_once('posttypes/gallery.php');
		require_once('posttypes/event.php');
		require_once('posttypes/portfolio.php');
      require_once('posttypes/team.php');
      if( in_array( 'give/give.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ){
         require_once('includes/give.php');
      	require_once('widgets/give-recent.php');
      	require_once('widgets/give-categories.php');
      }
	}  
}

new Gavias_Kunco_Themer();
