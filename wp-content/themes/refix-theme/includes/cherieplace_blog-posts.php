<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_shortcode('rfx_blog_posts', 'rfx_blog_posts');
function rfx_blog_posts($atts)
{
    ob_start();

    global $post;

    extract(shortcode_atts(array(
        'offset' => '1',
        'numberposts' => '1'
    ), $atts));


    $args = array(
        'offset' => $offset,
        'numberposts' => $numberposts
    );

    $output = '';

    $posts = get_posts($args);

    foreach ($posts as $post) {
        $post_date = get_the_date();
        $post_title = '<p><a class="start__blog-posts__tytul" href="' . get_the_permalink() . '">' . get_the_title() . '</a></p>';
        $post_img = '<img src="' . get_the_post_thumbnail_url() . '">';
        $post_desc = get_the_excerpt();
        $post_desc = substr($post_desc, 0, 100);
        $post_desc_result = substr($post_desc, 0, strrpos($post_desc, ' '));
        $post_link = '<a class="start__blog-posts__link" href="' . get_the_permalink() . '">WIĘCEJ ⟶</a>';
        $output .= '<div class="start__blog-post__box_kol1">' . $post_img . '</div>' . '<div class="start__blog-post__box_kol2">' . '<p class="start__blog-posts__data">' . $post_date . '</p>' . $post_title . '<p>' . $post_desc_result . ' [...]</p>'. $post_link  . '</div>';

    }

    wp_reset_postdata();

    return '<div class="start__blog-post__box">' . $output . '</div>';

    $output2 = ob_get_clean();
    return $output2;
}
