<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


function refix_theme_add_woocommerce_support()
{
    add_theme_support('woocommerce', array(
        'thumbnail_image_width' => 300,
        'single_image_width'    => 1200,
        'gallery_thumbnail_image_width' => 300,

        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 5,
            'min_columns'     => 2,
            'max_columns'     => 5,
        ),
    ));
}

add_action('after_setup_theme', 'refix_theme_add_woocommerce_support');

add_theme_support('wc-product-gallery-lightbox');
add_theme_support('wc-product-gallery-slider');


/**
 * Change number of related products output
 */ 
function woo_related_products_limit() {
    global $product;
      
      $args['posts_per_page'] = 5;
      return $args;
  }
  add_filter( 'woocommerce_output_related_products_args', 'jk_related_products_args', 20 );
    function jk_related_products_args( $args ) {
      $args['posts_per_page'] = 5; // 4 related products
      $args['columns'] = 5; // arranged in 2 columns
      return $args;
  }


//includes
include_once 'rfx-variation-select-radio.php';


/**
 * Filter to Change WooCommerce Page Title.
 */
add_filter('woocommerce_page_title', 'new_woocommerce_page_title');

function new_woocommerce_page_title($page_title)
{
    return false;
}


/**
 * Change number or products per row to 3
 */
// add_filter('loop_shop_columns', 'loop_columns', 999);
// if (!function_exists('loop_columns')) {
// 	function loop_columns() {
// 		return 3; // 3 products per row
// 	}
// }


remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

/**
 * @snippet       Hide Clear Link | WooCommerce Variable Products
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 6
 */

add_filter('woocommerce_reset_variations_link', '__return_empty_string', 9999);



// usuwa informacje dodatkowe z wariantów
add_filter('woocommerce_product_tabs', 'rfx_wywal_tab_dodatkowe_informacje', 9999);
function rfx_wywal_tab_dodatkowe_informacje($tabs)
{
    unset($tabs['additional_information']);
    return $tabs;
} //rfx_wywal_tab_dodatkowe_informacje()




/**
 * @snippet       Explode Tabs @ WooCommerce Single Product Page
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @testedwith    WooCommerce 5
 */

function woocommerce_output_product_data_tabs()
{
    $product_tabs = apply_filters('woocommerce_product_tabs', array());
    if (empty($product_tabs)) return;


    echo '<div class="woocommerce-tabs wc-tabs-wrapper">';
    $i = 0;
    foreach ($product_tabs as $key => $product_tab) {
        $i++;
        $aktiv = ($i == 1) ? 'aktiv' : '';
?>
        <div class="tab-kontener <?php echo $aktiv ?>" role="tab" aria-controls="tab-<?php echo esc_attr($key); ?>">
            <h2 id="<?php echo esc_attr($key); ?>" class="tab-tytul"><?php echo $product_tab['title']; ?> <span class="tab-strzalka"></span></h2>
            <div id="tab-<?php echo esc_attr($key); ?>" class="tab-kontent">
                <?php
                if (isset($product_tab['callback'])) {
                    call_user_func($product_tab['callback'], $key, $product_tab);
                }
                ?>
            </div>
        </div>
    <?php
    }
    echo '</div>';
} //woocommerce_output_product_data_tabs()




//delete tab title in tab
add_filter('woocommerce_product_description_heading', 'rfx_remove_single_product_tab_title');
function rfx_remove_single_product_tab_title($title)
{
    $title = false;
    return $title;
} //rfx_remove_single_product_tab_title()





add_action('woocommerce_before_add_to_cart_form', 'rfx_single_product_short_table');
function rfx_single_product_short_table()
{

    global $product;

    $attributes = $product->attributes;

    $marka = get_term($attributes['pa_marka']['options'][0])->name;
    $marka_meta = get_term_meta($attributes['pa_marka']['options'][0]);
    $marka_meta;
    if ($marka) {
    ?>
        <div class="rfx_single_short_table_item">
            <?php
            if ($marka_meta['tax_color'][0]) {
                $img = wp_get_attachment_url($marka_meta['tax_image'][0]);
                echo '<p><img src="' . $img . '"></p>';
            } else {
            ?>
                <div class="rfx_ssti_wrapper">
                    <div class="title">Marka</div>
                    <div class="value"><?php echo $marka ?></div>
                </div>
            <?php
            } //if
            ?>

        </div>
    <?php

    } //if marka


    //EANs

    if ($product->get_type() == 'variable') {

        $ean_html = '<div class="rfx_single_short_table_item">
        <div class="rfx_ssti_wrapper">
            <div class="title">EAN</div>';

        $ean_html .= '<div class="value">';
        $ean_status = false;
        foreach ($product->get_children() as $variation_id) :

            $ean = get_post_meta($variation_id, 'rfx_ean', true);
            if ($ean) :
                $ean_status = true;
                $ean_html .= '<span vid="' . $variation_id . '" style="display:none;">';
                $ean_html .= $ean;
                $ean_html .= '</span>';
            endif;

        endforeach;
        $ean_html .= '</div></div></div>';

        if ($ean_status) {
            echo $ean_html;
        } //if

        rfx_ssti_change_variation();
    } //if variable


    if ($product->get_type() == 'simple') {
        $ean = get_post_meta(get_the_ID(), 'ean', true);
    ?>
        <div class="rfx_single_short_table_item">
            <div class="rfx_ssti_wrapper">
                <div class="title">EAN</div>
                <div class="value"><?php echo $ean ?></div>
            </div>
        </div>
    <?php
    } //if simple

} //rfx_single_product_short_table()




function rfx_ssti_change_variation()
{
    wc_enqueue_js("
    $( 'input.variation_id' ).change( function(){
        $('span[vid]').hide();
       if( '' != $(this).val() ) {
          var var_id = $(this).val();
          $('span[vid='+var_id+']').show();
       }
    });
 ");
} //rfx_ssti_change_variation();



function rfx_quantity_button_before()
{
    ?>
    <div class="rfx_quantity_button number-input">
        <span input type="number" class="button__quantity__minus">-</span>
    </div>
<?php
}

function rfx_quantity_button_after()
{
?>
    <div class="rfx_quantity_button number-input">
        <span input type="number" class="button__quantity__plus">+</span>
    </div>
<?php
}


add_action('woocommerce_before_quantity_input_field', 'rfx_quantity_button_before', 50);
add_action('woocommerce_after_quantity_input_field', 'rfx_quantity_button_after', 50);
