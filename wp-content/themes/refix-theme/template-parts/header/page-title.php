<?php

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}


function rfx_page_title()
{
	
	if (!get_field('page_title', 'options')) return; // ustawienie w Refix settings
	if (get_field('page_title') == 'nie') return; // ustawienie w edycji strony
	// if(is_product()) return; // chowa page titile na produktach
	
	if (get_field('header_style', 'options') == 'full-width') {
		$wrapper_classes  = 'page-title full-width-page-title';
		$container_width = 'max-width: 100%;';
	} else {
		$wrapper_classes  = 'page-title boxed-page-title';
		$container_width = 'max-width: ' . get_field('szerokosc_kontenera', 'options') . 'px; margin:0 auto;';
	}
	
	
	?>
	<!-- START #rfx_page_title -->
	<div id="rfx_page_title">
		<div class="rfx_page_title_wrapper <?php echo $wrapper_classes ?>" style="<?php echo $container_width ?>">
			<?php do_action('rfx_page_title_action') ?>
		</div>
	</div>
	<!-- KONIEC #rfx_page_title -->
	<?php
} //rfx_page_title();


rfx_page_title();
?>