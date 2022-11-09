<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}




add_filter('woocommerce_dropdown_variation_attribute_options_html', 'rfx_variation_radio_buttons', 20, 2);
function rfx_variation_radio_buttons($html, $args)
{
    ob_start();
    $args;

    $select_style = 'classic';
    global $product;

    echo '<div class="rfx_clone_select" select="' . $args['attribute'] . '">';
echo '<p class="rfx_chosen_title"></p>';
echo '<div class="rfx_select_radio_labels_wrapper">';
    foreach ($product->get_attributes()[$args['attribute']]['options'] as $option) :



        $term = get_term($option);
        $term_meta = get_term_meta($option);
        $term_color = $term_meta['tax_color'][0];
        $term_img = wp_get_attachment_image_src($term_meta['tax_color'][0]);
        if ($term_img) {
            $select_style = 'image';
        } elseif ($term_color) {
            $select_style = 'color';
        } else {
            continue;
        } //if

        if($select_style == 'image'){
            echo '<label class="rfx_select_radio_label rfx-select-style-image"><input type="radio" name="clone_' . $args['attribute'] . '" value="' . $term->slug . '"><img src="' . $term_img[0] . '" title="'.$term->name.'"><span class="podpis">' . $term->name . '</span></label>';
        } else if($select_style == 'color'){
            echo '<label class="rfx_select_radio_label rfx-select-style-color"><input type="radio" name="clone_' . $args['attribute'] . '" value="' . $term->slug . '"><span class="color-box" style="background-color:'.$term_color.';"></span><span class="podpis">' . $term->name . '</span></label>';
        }//if


    endforeach;

    echo '</div></div>';

    if ($select_style != 'classic') {
?>
        <div class="hide_old_select" style="display:none;">
            <?php echo $html ?>
        </div>
<?php
    } else {
        echo $html;
    } //if


    $new_html = ob_get_clean();
    return $new_html;
}//rfx_variation_radio_buttons()
