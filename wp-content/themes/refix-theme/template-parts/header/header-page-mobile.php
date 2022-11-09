<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

$header_left_width = 'width:' . get_field('header_szerokosc_left', 'options') . '%;';
$header_right_width = 'width:' . get_field('header_szerokosc_right', 'options') . '%;';

?>
<div class="header-left mobile-logo" style="width:80%;">
    <?php the_custom_logo(); ?>
</div>
<div class="header-right mobile-menu-wrapper" style="width:20%;">
<?php  echo '<span id="menu-opener"></span>'; ?>
    <?php


    wp_nav_menu(
        array(
            'theme_location'  => 'mobile-menu',
            'menu_class'      => 'menu-wrapper',
            'container_class' => 'primary-menu-container bv_mobile-menu',
            'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
            'fallback_cb'     => true,
        )
    );


    ?>
</div>