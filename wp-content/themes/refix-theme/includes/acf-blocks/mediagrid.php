<?php

/**
 * media_grid Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'media_grid-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}//if

// Create class attribute allowing for custom "className" and "align" values.
$className = 'acf-media_grid';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}//if


// // Load values and assign defaults.
// $text = get_field('testimonial') ?: 'Your testimonial here...';
// $author = get_field('author') ?: 'Author name';
// $role = get_field('role') ?: 'Author role';
// $image = get_field('image') ?: 295;
// $background_color = get_field('background_color');
// $text_color = get_field('text_color');

$media_grid_obj = get_field('media_grid');

if(!$media_grid_obj) {
    echo '<p>Brak wybranych obrazów do ACF Media Grid</p>';
    return;
}//if

?>


<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
<?php
    foreach ($media_grid_obj as $obj){
        ?>
            <img src="<?php echo $obj ?>">
        <?php
    }//foreach
    ?>
</div>