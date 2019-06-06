<?php

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 *
 * Also enqueue Stylesheet for this page only.
 *
 */
function gaviasframwork_import_export_page() {

   // Add page
   $page_hook = add_submenu_page(
      'themes.php',
      __( 'Gavias Importer', 'gavias-importer' ), 
      __( 'Gavias Importer', 'gavias-importer' ), 
      'manage_options', // capability
      'gavias-importer', // menu slug
      'gaviasframwork_import_export_page_content' // callback for displaying page content
   );
   return $page_hook;
}

add_action( 'admin_menu', 'gaviasframwork_import_export_page' ); // register post type

/**
 * Import page content
 *
 */
function gaviasframwork_import_export_page_content() {
   ?>

   <div class="wrap">

      <?php screen_icon(); ?>

      <h2><?php _e( 'Gavias Importer', 'gavias-importer' ); ?></h2>

      <h3 class="title"><?php _ex( 'Import Widgets', 'heading', 'gavias-importer' ); ?></h3>

      <p>
         <?php _e( 'Import widget sidebar and Slider Revolution sample for Theme', 'gavias-importer' ); ?>
      </p>
      
      <p>
         <input type="button" value="Import Widget Sidebar" class="button button-primary" id="gavias-import-widget"/>
         <span id="gav-mess-import-widget"></span>
      </p>

   </div>


   <script>

      jQuery(document).ready(function($) {
         $(document).on('click','#gavias-import-widget', function(){
            $('#gav-mess-import-widget').html('Waiting.....');
            $.ajax({
               type: 'POST',
               url: ajaxurl,
               data: {
                  action: 'gva_import_widget',
               },
               success: function (data, textStatus, XMLHttpRequest){
                  $('#gav-mess-import-widget').html('Import success');
               },
               error: function (MLHttpRequest, textStatus, errorThrown){
                  $('#gav-mess-import-widget').html('Import error');
               }  
            });
         })

      });
         
   </script>

   <?php

}
