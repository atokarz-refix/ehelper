<?php

/**
 * Text Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'text_block-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}//if

// Create class attribute allowing for custom "className" and "align" values.
$className = 'acf-text_block';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}//if



$text_block_obj = get_field('text_block');

if($text_block_obj) {
    $tekst = $text_block_obj;
} else {
   $tekst = '<p>Brak treści w ACF Text Block</p>';
}//if
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
<?php echo $tekst ?>
</div>

