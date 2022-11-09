<?php

/**
 * slider Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'slider-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
} //if

// Create class attribute allowing for custom "className" and "align" values.
$className = 'acf-slider';
if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
} //if


// // Load values and assign defaults.
// $text = get_field('testimonial') ?: 'Your testimonial here...';
// $author = get_field('author') ?: 'Author name';
// $role = get_field('role') ?: 'Author role';
// $image = get_field('image') ?: 295;
// $background_color = get_field('background_color');
// $text_color = get_field('text_color');

$slider_repeater = get_field('slide');

if (!$slider_repeater) {
    echo '<p>Brak wybranych obrazów do ACF Slider</p>';
    return;
} //if



function rfx_acf_slide_html($index, $slide)
{
    ob_start();
    $wrapper_styles = 'height:100%;';
    $wrapper_styles .= 'background-image:url(' . $slide['slide_background'] . ');';
?>
    <div class="rfx_acf_slide_item" slide="<?php echo $index ?>" style="<?php echo $wrapper_styles ?>">
        <div class="rfx_acf_slide_wrapper" style="max-width:<?php echo get_field('szerokosc_kontenera', 'options') ?>px; margin:0 auto;">
            <div class="rfx_acf_slide_content">
                <?php echo $slide['slide_content'] ?>
            </div>
        </div>
    </div>
<?php
    $output = ob_get_clean();
    $output = str_replace("\n", "", $output);
    $output = str_replace("\r", "", $output);
    return $output;
} //rfx_acf_slide_html



function rfx_acf_slider_buttons($slider_repeater)
{
?>
    <div class="rfx_acf_slider_buttons">
        <span class="prev"> &#8249; </span>
        <span class="next"> &#8250; </span>
    </div>
<?php
} //rfx_acf_slider_buttons()





?>

<div class="rfx_acf_slider_contener" style="height:<?php echo get_field('slider_height') ?>px;">
    <div class="rfx_acf_slider_items" max="<?php echo count($slider_repeater) ?>" style="height:100%;">
        <?php echo rfx_acf_slide_html(1, $slider_repeater[0], false);  ?>
    </div>
    <div class="rfx_acf_slider_navigation">
        <?php rfx_acf_slider_buttons($slider_repeater); ?>
    </div>
</div>

<style>
    .rfx_acf_slider_contener {
        position: relative;
    }

    .rfx_acf_slider_items {
        transition: 0.3s;
        opacity: 1;
    }

    .rfx_acf_slide_item {
        background-size: cover;
        background-position: center;
    }

    .rfx_acf_slide_wrapper {
        display: flex;
        height: 100%;
        align-items: center;
    }

    .rfx_acf_slider_navigation {
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .rfx_acf_slider_buttons {
        display: flex;
        justify-content: center;
        gap: 25px;
    }

    .rfx_acf_slider_buttons span {
        font-size: 30px;
        cursor: pointer;
        background: rgba(0, 0, 0, 0.2);
        color: #fff;
        border-radius: 50%;
        width: 39px;
        text-align: center;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }
</style>

<script>
    jQuery(document).ready(function($) {


        function rfx_acf_slide_1() {
            var html = '<?php echo rfx_acf_slide_html(1, $slider_repeater[0]) ?>';
            return html;
        } //rfx_acf_slide_1()

        function rfx_acf_slide_2() {
            var html = '<?php echo rfx_acf_slide_html(2, $slider_repeater[1]) ?>';
            return html;
        } //rfx_acf_slide_1()


        function rfx_acf_slide_3() {
            var html = '<?php echo rfx_acf_slide_html(3, $slider_repeater[2]) ?>';
            return html;
        } //rfx_acf_slide_1()



        function rfx_acf_slide_putter(index) {
            var html;
            if (index == 1) {
                html = rfx_acf_slide_1();
            } else if (index == 2) {
                html = rfx_acf_slide_2();
            } else if (index == 3) {
                html = rfx_acf_slide_3();
            } //if
            var $miejsce = $('.rfx_acf_slider_items');
            $miejsce.html(html);

        } //rfx_acf_slide_putter()


        $('.rfx_acf_slider_buttons span').click(function() {
            var index = $('.rfx_acf_slide_item').attr('slide');
            var max = $('.rfx_acf_slider_items').attr('max');

            if ($(this).hasClass('next')) {
                var new_index = parseInt(index) + 1;
                if (new_index > max) {
                    new_index = 1;
                }
            } else if ($(this).hasClass('prev')) {
                var new_index = parseInt(index) - 1;
                if (new_index == 0) {
                    new_index = max;
                }
            } //if

            $('.rfx_acf_slider_items').css('opacity', '0');
            setTimeout(function() {
                rfx_acf_slide_putter(new_index);
                $('.rfx_acf_slider_items').css('opacity', '1');
            }, 400);
        }); //click




    });
</script>