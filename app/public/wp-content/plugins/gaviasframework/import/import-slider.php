<?php
// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

function gaviasframework_import_slider() {
     gaviasframework_import_slider_process();
}

add_action('wp_ajax_gva_import_slider',  'gaviasframework_import_slider');
add_action( 'wp_ajax_nopriv_gva_import_slider', 'gaviasframework_import_slider');

function gaviasframework_download_packet(){
   $folder = get_template_directory() . '/includes/sample/revs/';
   $link = apply_filters( 'gaviasframework_slide_link_packet', array() );
 
   $tmp = $folder . 'tmp.zip';   
   $data = file_get_contents( $link );
   $file = fopen($tmp, "w+");
   fputs($file, $data);
   fclose($file);

   if( file_exists($tmp) ){
      WP_Filesystem();
      unzip_file( $tmp , $folder );  
   }
   @unlink( $tmp );
}

function gaviasframework_download_slider($theme){
   $folder = get_template_directory() . '/includes/sample/demo-data/main/';
   $link = 'http://gaviasthemes.com/sample/'.$theme.'/revs.zip';
   $tmp = $folder . 'tmp.zip';   
   $data = file_get_contents( $link );
   $file = fopen($tmp, "w+");
   fputs($file, $data);
   fclose($file);
   if( file_exists($tmp) ){
      WP_Filesystem();
      unzip_file( $tmp , $folder );  
   }
   @unlink( $tmp );
}

function gaviasframework_import_slider_process() {

   if(!function_exists('unzip_file')){
      $result = array(
         'data' => 'Please enable extension Zip for your server'
      );
      print json_encode($result);
      exit(0);
   }

   if ( ! class_exists( 'RevSliderAdmin' ) ) {
      require( RS_PLUGIN_PATH . '/admin/revslider-admin.class.php' );         
   }
   
   $sliders = glob( get_template_directory() . '/includes/sample/revs/*.zip' );
 
   if (is_array($sliders) && count($sliders) < 1) {
      gaviasframework_download_packet();
   }

   $sliders = glob( get_template_directory() . '/includes/sample/revs/*.zip' );
   if (!empty($sliders)) {
      foreach ($sliders as $slider) {
         $_FILES['import_file']['error'] = UPLOAD_ERR_OK;
         $_FILES['import_file']['tmp_name']= $slider;

         $xslider = new RevSlider();
         $xslider->importSliderFromPost( true, 'none' );
      }
   }else{
      $result = array(
         'data' => 'No have packet'
      );
      print json_encode($result);
      exit(0);
   }

   $result = array(
      'data' => 'Import success'
   );
   print json_encode($result);
   exit(0);
}
