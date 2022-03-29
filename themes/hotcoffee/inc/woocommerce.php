<?php
/**
 * Functions which enhance the theme by hooking into woocommerce
 *
 * @package Fresh_Coffee
 */


function hotcoffee_use_block_editor_for_post_type ($use_block_editor, $post_type){
    if('product'===$post_type){
        $use_block_editor = true;
    }
    return $use_block_editor;
}
 add_filter('use_block_editor_for_post_type', 'hotcoffee_use_block_editor_for_post_type', 10, 2);

 /**
  * remove default woocommerce style
  */

  // add_filter( 'woocommerce_enqueue_styles', '__return_false' );

   /**
  * re-add the product title
  */

  add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 4);
