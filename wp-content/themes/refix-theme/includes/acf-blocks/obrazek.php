<?php

/**
 * Obrazek Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'obrazek-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}//if

// Create class attribute allowing for custom "className" and "align" values.
$className = 'acf-obrazek';
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

$obrazek_obj = get_field('obrazek');
if($obrazek_obj){
    
    $obrazek = $obrazek_obj['url'];
    $obrazek_mobile = ($obrazek_obj['sizes']['medium_large']) ?: $obrazek;
    
    if(wp_is_mobile()){
        $img_width = $obrazek_obj['sizes']['medium_large-width']*0.625;
        $img_height = $obrazek_obj['sizes']['medium_large-height']*0.625;
    } else {
        $img_width = $obrazek_obj['width'];
        $img_height = $obrazek_obj['height'];
    }//if
    $obrazek_sizes = 'width ="'.$img_width.'rem" height="'.$img_height.'rem"';
    
} else {
    $obrazek = 'Brak obrazka';
    $obrazek_mobile = 'Brak obrazka';
}//if



?>
<p id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>" style="text-align:<?php the_field('text_align') ?>;">
<img src="<?php echo $obrazek ?>" srcset="<?php echo $obrazek_mobile ?> 800w, <?php echo $obrazek ?>" sizes="(max-width: 800px) 800px, 1200px" <?php echo $obrazek_sizes ?>>
</p>