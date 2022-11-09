<?php

/* 
Działa z wtyszką " Variation Swatches for WooCommerce " (https://wordpress.org/plugins/woo-variation-swatches/)

Przykład szorta    
[rfx_color_filter_s attribute="kolor"]

*/


function czy_selected($item, $attribute)
{

    $aktiv = '';
    $attribute_w_get = $_GET['filter_' . $attribute];

    $eksplodowane = explode(',', $attribute_w_get);

    if (in_array($item, $eksplodowane)) {
        $aktiv = 'aktiv';
    }

    return $aktiv;
} //koniec czy_selected()


function rfx_attribute_filter_image_li_html($aktiv, $nowy_link, $term_img_url, $term_name)
{
    $filter_data = array(
        'aktiv' => $aktiv,
        'link'  => $nowy_link,
        'img_url'   => $term_img_url,
        'name'  => $term_name,
    );
    $html = ' <li class="rfx_filter_image_type ' . $aktiv . '"><a href="' . $nowy_link . '"><img src="' . $term_img_url . '"><span class="tultip">' . $term_name . '</span></a></li>';
    return apply_filters('rfx_attribute_filter_image_test', $html, $filter_data);
} //rfx_attribute_filter_image_li_html()


function rfx_attribute_filter_color_li_html($aktiv, $nowy_link, $term_color, $term_name)
{
    $filter_data = array(
        'aktiv' => $aktiv,
        'link'  => $nowy_link,
        'color'   => $term_color,
        'name'  => $term_name,
    );
    $html = ' <li class="rfx_filter_color_type ' . $aktiv . '"><a href="' . $nowy_link . '"><span class="color-box" style="background-color:' . $term_color . ';"></span><span class="tultip">' . $term_name . '</span></a></li>';
    return apply_filters('rfx_attribute_filter_color_test', $html, $filter_data);
} //rfx_attribute_filter_color_li_html()


add_action('woocommerce_before_shop_loop_item', 'rfx_shop_loop_ids');
function rfx_shop_loop_ids()
{
    global $rfx_global;

    $id = get_the_id();

    $rfx_global['shop_loop_ids'][] = $id;
} //rfx_shop_loop_ids()



add_shortcode('rfx_color_filter_s', 'rfx_color_filter');
function rfx_color_filter($atts)
{
    ob_start();

    

    $domena = get_site_url();
    $sciezka = $_SERVER['REQUEST_URI'];
    $current_url = $domena . $sciezka;


    extract(shortcode_atts(array(
        'attribute' => '',
        'title'     => 'Kolor',
    ), $atts));

    echo '<h3>'.$title.'</h3>';


    $url_components = parse_url($sciezka);
    parse_str($url_components['query'], $params);





    global $rfx_global;
    $shop_loop_ids = $rfx_global['shop_loop_ids'];

    $used_attributes = [];
    
    if (!$params['filter_kolor'] || ($params['filter_kolor'] && count($params) > 2)) {

        foreach ($shop_loop_ids as $prod_id) {
            $product = wc_get_product($prod_id);
            $exploded = explode(',', $product->get_attribute($attribute));
            foreach ($exploded as $single_attribute) {
                $used_attributes[] = trim($single_attribute);
            } //foreach
        } //foreach
    } //if


    if ($attribute) {
        $pa_attribute = 'pa_' . $attribute;


        $terms = get_terms($pa_attribute);

        echo '<div class="rfx_filter_box"> <ul class="rfx-filter-list">';
        foreach ($terms as $term) {


            // if(!empty($used_attributes) && !in_array($term->name,$used_attributes)) continue;

            $nowy_get = $_GET;
            $get_attribute_string = $nowy_get['filter_' . $attribute];
            $get_attribute_array = explode(',', $get_attribute_string);

            $query_type = 'query_type_' . $attribute;
            $nowy_get[$query_type] = 'or';

            $term_id = $term->term_id;

            $term_meta = get_term_meta($term_id);
            $term_color = $term_meta['tax_color'][0];
            $term_img_url = wp_get_attachment_url($term_meta['tax_image'][0]);
            if ($term_color) {
                $term_type = 'color';
            } else if ($term_img_url) {
                $term_type = 'image';
            } //koniec ifa

            $term_name = $term->name;
            $term_slug = $term->slug;



            $aktiv = czy_selected($term_slug, $attribute);

            if ($aktiv) {

                foreach ($get_attribute_array as $key => $value) {
                    if ($value == $term_slug) {
                        unset($get_attribute_array[$key]);
                    } //koniec ifa
                } //koniec foreach
                $implodowane = implode(',', array_filter($get_attribute_array));
                $nowy_get['filter_' . $attribute] = $implodowane;
                /* if(!$implodowane){
                   unset( $nowy_get['filter_' . $attribute] );
                }//koniec ifa*/


                $nowy_link = add_query_arg($nowy_get, $current_url);
                //echo '<pre>'; var_dump($nowy_link); echo '</pre>';

            } else {

                $get_attribute_array[] = $term_slug;
                $implodowane = implode(',', array_filter($get_attribute_array));
                $nowy_get['filter_' . $attribute] = $implodowane;

                $nowy_link = add_query_arg($nowy_get, $current_url);
                //echo '<pre>'; var_dump($nowy_link); echo '</pre>';

            } //koniec ifa

            if ($term_type == 'image') {

                // echo ' <li class="'.$aktiv.'"><a href="'.$nowy_link.'"><img src="' . $term_img_url . '"><span class="tultip">'.$term_name.'</span></a></li>';
                echo rfx_attribute_filter_image_li_html($aktiv, $nowy_link, $term_img_url, $term_name);
            } elseif ($term_type == 'color') {
                echo rfx_attribute_filter_color_li_html($aktiv, $nowy_link, $term_color, $term_name);
            } //if


        } //koniec foreach
        echo '</ul> </div>';
    } else {
        echo '<p>brak taxonomi atrybutu ' . $attribute . '</p>';
    } //koniec ifa


    $output = ob_get_clean();
    return $output;
}//koniec rfx_color_filter()
