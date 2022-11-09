<?php
if (get_field('header_style', 'options') == 'full-width') {
	$wrapper_classes  = 'site-header full-width-header';
	$container_width = 'max-width: 100%;';
} else {
	$wrapper_classes  = 'site-header boxed-header';
	$container_width = 'max-width: ' . get_field('szerokosc_kontenera', 'options') . 'px;';
}

$container_height = 'height:' . get_field('header_wysokosc', 'options') . 'px;';


if (get_field('sticky_header', 'options') == 'Tak') {
	$wrapper_classes .= ' sticky-header';
	$sticky_wrapper = '<div class="sticky-empty" style="' . $container_height . '"></div><div class="sticky-wrapper">';
	$sticky_wrapper_end = '</div>';
} else {
	$sticky_wrapper = '';
	$sticky_wrapper_end = '';
}

$mobile = (!mobile_check()) ? '' : 'bv_mobile_header';
$header_columns = get_field('header_columns', 'options');
$wrapper_classes .= ' ' . $header_columns;

?>

<header id="masthead">
	<?php echo $sticky_wrapper ?>
	<div id="header-wrapper" class="<?php echo esc_attr($wrapper_classes); ?>" style="<?php echo $container_width . $container_height ?>">
		<nav id="site-navigation" class="primary-navigation <?php echo $mobile ?>" aria-label="<?php esc_attr_e('Primary menu', 'bevise'); ?>">
			<?php
			if (wp_is_mobile()) {
				get_template_part('template-parts/header/header-page-mobile');
			} elseif ($header_columns == 'left') {
				get_template_part('template-parts/header/header-page-left');
			} elseif ($header_columns == 'left-right') {
				get_template_part('template-parts/header/header-page-left-right');
			} elseif ($header_columns == 'left-center-right') {
				get_template_part('template-parts/header/header-page-left-center-right');
			} else {
				get_template_part('template-parts/header/header-page-left-right');
			} //if

			?>
		</nav>
	</div>
	<?php echo $sticky_wrapper_end ?>
</header><!-- #masthead -->