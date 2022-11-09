<?php

/**
 * Załączenie stylów i skryptów do motywu
 */

add_action('wp_head', 'css_variables');
function css_variables()
{
?>
    <style>
        :root {
            --contener-width: <?php echo get_field('szerokosc_kontenera','options').'px' ?>;
            --font-family-heading: "Inter";
            --font-family-content: "Open Sans";
            --kolor-01: #000000;
            --kolor-02: #6C6C6C;
        }
    </style>
<?php
} //css_variables

function refix_theme_files()
{

    wp_enqueue_style('refix_theme_styles', get_stylesheet_uri());
    wp_enqueue_style('cherieplace_style', get_template_directory_uri() . '/css/ehelper_style.css');
    wp_enqueue_style('cherieplace_wc_styles', get_template_directory_uri() . '/css/cherieplace_wc_styles.css');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', array(), null, true);
    wp_enqueue_script('refix_theme_scripts_scripts', get_template_directory_uri() . '/js/refix_theme_scripts.js', '', '', true);
    wp_enqueue_script('rfx_variation_select_radio_scripts', get_template_directory_uri() . '/js/rfx_variation_select_radio_scripts.js', '', '', true);
}
add_action('wp_enqueue_scripts', 'refix_theme_files');

function refix_theme_setup()
{
    register_nav_menus(array(
        'main-menu' => 'Main menu',
        'mobile-menu' => 'Mobile menu'
    ));

    add_theme_support('custom-logo', array(
        'height'      => 70, // wysokość logo
        'width'       => 230, // szerokość logo
        'flex-height' => false, // czy wysokość ma być elastyczna
        'flex-width'  => true, // czy szerokość ma być elastyczna
    ));
}
add_action('after_setup_theme', 'refix_theme_setup');

add_theme_support( 'title-tag' );
add_theme_support('align-wide');


add_action('wp_head','rfx_meta_description');
function rfx_meta_description(){
    if ( is_plugin_active( 'wordpress-seo/wp-seo.php' ) || is_plugin_active( 'wordpress-seo-premium/wp-seo-premium.php' ) ) return;

    $description = get_bloginfo();

    ?>
    <meta name="description" content="<?php echo $description ?>" />
    <?php

}//rfx_meta_description()



add_action('widgets_init', 'refix_theme_footer_widget_01');
function refix_theme_footer_widget_01()
{

    register_sidebar(
        array(
            'name'          => esc_html__('Footer', 'refix'),
            'id'            => 'footer-1',
            'description'   => esc_html__('Add widgets here to appear in your footer.', 'refix'),
            'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="refix_theme_footer_wrapper">',
            'after_widget'  => '</div></section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => 'Woocommerce sidebar',
            'id'            => 'wc-sidebar-01',
            'description'   => esc_html__('Add widgets here to appear in your footer.', 'refix'),
            'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="refix_wc_sidebar_wrapper">',
            'after_widget'  => '</div></section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => 'Header Right',
            'id'            => 'header-right-sidebar-01',
            'description'   => esc_html__('Add widgets here to appear in header right part.', 'refix'),
            'before_widget' => '<div class="header-right-sidebar-wrapper">',
            'after_widget'  => '</div>',
            // 'before_title'  => '',
            // 'after_title'   => '',
        )
    );

    register_sidebar(
        array(
            'name'          => 'Sidebar Blog',
            'id'            => 'blog-sidebar-01',
            'description'   => esc_html__('Add widgets here to appear in header right part.', 'refix'),
            'before_widget' => '<div class="blog-sidebar-wrapper">',
            'after_widget'  => '</div>',
            // 'before_title'  => '',
            // 'after_title'   => '',
        )
    );

}//refix_theme_footer_widget_01()




function mobile_check()
{
    $status = false;
    $mobile = strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile');
    if ($mobile) $status = true;
    return $status;
} //mobile_check()


//sprawdza czy zadana klasa jest dopisana do body
function if_klasa_body($klasa){
	$klasy_body = get_body_class();
	if (in_array($klasa,$klasy_body)) {
		return true;
	}//koniec ifa
} // koniec if_klasa_body()



function rfx_get_cat_data($cat_id){

    $term = get_term($cat_id);

	if(!$term) return false;
    $term_meta = get_term_meta($cat_id);
    
    $data = [];
    $data['name'] = $term->name;
    $data['slug'] = $term->slug;
    $data['img_id'] = $term_meta['thumbnail_id'][0];
    $data['link'] = get_category_link($cat_id);
    $data['description'] = $term->description;

    return $data;
}//rfx_get_cat_image()


function rfx_global_variable(){
    global $rfx_global;
    $rfx_global = array();
}//rfx_global_variable()
add_action( 'after_setup_theme', 'rfx_global_variable' );


//includes
include_once 'includes/rfx-acf-options-page.php';
include_once 'includes/rfx-acf-blocks.php';
include_once 'includes/rfx-woocommerce-rules.php';
include_once 'includes/cherieplace_blog-posts.php';
include_once 'includes/rfx-ean-field.php';
// include_once 'includes/rfx_yith_wishlist.php';
include_once 'includes/rfx-woocommerce-attribute-filter-image.php';


// add_filter('rfx_attribute_filter_image_test','rfx_cherieplace_rfx_attribute_filter_image_li_html',1,10);
function rfx_cherieplace_rfx_attribute_filter_image_li_html($html,$filter_data){
    return  '<pre>'.var_dump($filter_data).'</pre>'; 
    
}//rfx_cherieplace_rfx_attribute_filter_image_li_html()