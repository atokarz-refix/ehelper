<?php

/**
 * post_grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'post_grid-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
} //if

// Create class attribute allowing for custom "className" and "align" values.
$className = 'acf-post_grid';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
} //if


$postgrid_obj = get_field('post_grid');


$output = '';

$post_per_page = 4;
$paged = (isset($_GET['strona'])) ? intval($_GET['strona']) : 1;
$offset = ($paged - 1) * $post_per_page;


$args = array(
    'post_type'     => 'post',
    'numberposts'   => $post_per_page,
    'offset'        => $offset,
    'post_status'   => 'publish',
);

$blog_posts = get_posts($args);


function navigation_pagination($post_per_page)
{

    $posty = get_posts(array('post_type' => 'post,', 'number_posts' => -1, 'post_status'   => 'publish'));
    $max = count($posty);
    if($post_per_page >= $max) return;

    $pages = ceil($max/$post_per_page);
    $path = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    
    ?>
    <div class="postrid-paginacja-box">
        <?php
    for($i=1; $i<=$pages; $i++){
        ?>
            <a href="<?php echo $path.'?strona='.$i ?>"><?php echo $i ?></a>
        <?php
    }//for
        ?>
    </div>

<?php
    
    
} //navigation_pagination()



foreach ($blog_posts as $single_post) {

    $single_post_id = $single_post->ID;
    $post_date = get_the_date('', $single_post_id);
    $post_title = '<p class="postgrid__tytul"><a href="' . get_the_permalink($single_post_id) . '">' . get_the_title($single_post_id) . '</a></p>';
    $post_img = '<div class="postgrid__img" style="background-image: url(' . get_the_post_thumbnail_url($single_post_id) . '); min-height: 300px; background-repeat: no-repeat"><a style="display: block; height: 100%; width: 100%;"href="' . get_the_permalink($single_post_id) . '"></a></div>';
    $post_desc = get_the_excerpt($single_post_id);
    $post_desc = substr($post_desc, 0, 100);
    $post_desc_result = substr($post_desc, 0, strrpos($post_desc, ' '));
    $post_link = '<a class="postgrid__link" href="' . get_the_permalink($single_post_id) . '">WIĘCEJ ⟶</a>';
    $output .= '<div class="postgrid__box">' . $post_img . '<p class="postgrid__data">' . $post_date . '</p>' . $post_title . '<p class="postgrid__exc">' . $post_desc_result . ' [...]</p>' . $post_link . '</div>';
}

echo '<div class="postgrid__container">' . $output . '</div>';
echo navigation_pagination($post_per_page);
