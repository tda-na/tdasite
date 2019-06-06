<?php
   function gva_give_setup_taxonomies(){
      if(give_get_option( 'categories', '' )){
         give_update_option('categories', 'enabled');
      }
   }
   add_action( 'init', 'gva_give_setup_taxonomies', 1 );

   // function gva_give_enable_category(){
   //    return 'enabled';
   // }
   // add_filter( 'give_get_option_categories', 'gva_give_enable_category');
