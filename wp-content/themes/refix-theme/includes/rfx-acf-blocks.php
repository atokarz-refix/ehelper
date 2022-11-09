<?php


add_filter( 'block_categories', 'acf_category', 10, 2 );
function acf_category( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'acf-custom-blocks',
                'title' => __( 'ACF Custom Blocks', 'text-domain'),
                'icon' => 'welcome-widgets-menus'
            ),
        )
    );
}


function acf_block_render_callback( $block ) {

    $slug = str_replace('acf/', '', $block['name']);
    
    if( file_exists( get_theme_file_path("/includes/acf-blocks/{$slug}.php") ) ) {
        include( get_theme_file_path("/includes/acf-blocks/{$slug}.php") );
    }

}//acf_block_render_callback()


add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {

        // register a testimonial block.
        acf_register_block_type(array(
            'name'              => 'testimonial',
            'title'             => __('Testimonial'),
            'description'       => __('A custom testimonial block.'),
            'render_callback'   => 'acf_block_render_callback',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'testimonial', 'quote' ),
        ));


        // register a obrazek block.
        acf_register_block_type(array(
            'name'              => 'obrazek',
            'title'             => __('ACF Obrazek'),
            'description'       => __('Zwykły obrazek'),
            'render_template'   => get_theme_file_path().'/includes/acf-blocks/obrazek.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'format-image',
            'keywords'          => array( 'obrazek', 'quote' ),
        ));


         // register a text block.
         acf_register_block_type(array(
            'name'              => 'text_block',
            'title'             => __('ACF Text Block'),
            'description'       => __('WYSYWIG'),
            'render_template'   => get_theme_file_path().'/includes/acf-blocks/text_block.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'editor-textcolor',
            'keywords'          => array( 'text_block', 'quote' ),
        ));


         // register a media grid.
         acf_register_block_type(array(
            'name'              => 'mediagrid',
            'title'             => __('ACF Media Grid'),
            'description'       => __('Media Grid'),
            'render_template'   => get_theme_file_path().'/includes/acf-blocks/mediagrid.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'images-alt2',
            'keywords'          => array( 'media_grid', 'quote' ),
        ));


        // register a media grid.
         acf_register_block_type(array(
            'name'              => 'postgrid',
            'title'             => __('ACF Post Grid'),
            'description'       => __('Post Grid'),
            'render_template'   => get_theme_file_path().'/includes/acf-blocks/postgrid.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'images-alt2',
            'keywords'          => array( 'post_grid', 'quote' ),
        ));    


        // register a media grid.
         acf_register_block_type(array(
            'name'              => 'slider',
            'title'             => __('ACF Slider'),
            'description'       => __('Slider'),
            'render_template'   => get_theme_file_path().'/includes/acf-blocks/slider.php',
            'category'          => 'acf-custom-blocks',
            'icon'              => 'format-video',
            'keywords'          => array( 'slider', 'quote' ),
        ));    

    }//if

    
}//my_acf_init_block_types()


// echo '<pre>'; var_dump(get_field('obrazek','options')); echo '</pre>';
