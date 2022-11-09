<?php


/**
 * @snippet       Display EAN/MSRP @ WooCommerce Single Product Page
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 5
 */
  
// -----------------------------------------
// 1. Add EAN field input @ product edit page
  
add_action( 'woocommerce_product_options_general_product_data', 'bbloomer_add_EAN_to_products' );      
  
function bbloomer_add_EAN_to_products() {          
    woocommerce_wp_text_input( array( 
        'id' => 'ean', 
        'class' => 'product-ean', 
      //   'wrapper_class' => 'form-row form-row-full',
        'label' => 'EAN',
    ));      
}
  
// -----------------------------------------
// 2. Save EAN field via custom field
  
add_action( 'save_post_product', 'bbloomer_save_EAN' );
  
function bbloomer_save_EAN( $product_id ) {
    global $typenow;
    if ( 'product' === $typenow ) {
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
        if ( isset( $_POST['ean'] ) ) {
            update_post_meta( $product_id, 'ean', $_POST['ean'] );
        }
    }
}
  
// -----------------------------------------

  



// -----------------------------------------
// 1. Add custom field input @ Product Data > Variations > Single Variation
 
add_action( 'woocommerce_variation_options_pricing', 'bbloomer_add_custom_field_to_variations', 10, 3 );
 
function bbloomer_add_custom_field_to_variations( $loop, $variation_data, $variation ) {
   woocommerce_wp_text_input( array(
'id' => 'rfx_ean[' . $loop . ']',
'class' => 'ean',
'label' => 'EAN',
'wrapper_class' => 'form-row form-row-full',
'value' => get_post_meta( $variation->ID, 'rfx_ean', true )
   ) );
}
 
// -----------------------------------------
// 2. Save custom field on product variation save
 
add_action( 'woocommerce_save_product_variation', 'bbloomer_save_rfx_ean_variations', 10, 2 );
 
function bbloomer_save_rfx_ean_variations( $variation_id, $i ) {
   $custom_field = $_POST['rfx_ean'][$i];
   if ( isset( $custom_field ) ) update_post_meta( $variation_id, 'rfx_ean', esc_attr( $custom_field ) );
}
 
// -----------------------------------------
// 3. Store custom field value into variation data
 
add_filter( 'woocommerce_available_variation', 'bbloomer_add_rfx_ean_variation_data' );
 
function bbloomer_add_rfx_ean_variation_data( $variations ) {
   $variations['rfx_ean'] = '<div class="woocommerce_rfx_ean">EAN: <span>' . get_post_meta( $variations[ 'variation_id' ], 'rfx_ean', true ) . '</span></div>';
   return $variations;
}


// Save product Barcode custom field
add_action( 'woocommerce_process_product_meta', 'save_barcode_custom_field', 10, 1 );
function save_barcode_custom_field( $post_id ){
    if( isset($_POST['_rfx_ean']) )
        update_post_meta( $post_id, '_rfx_ean', esc_attr( $_POST['_rfx_ean'] ) );
}


?>