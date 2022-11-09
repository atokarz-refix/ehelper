<?php
/*
 * Template Name: A Static Page
 */
get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php


	$sidebar = false;
	$sidebar_options = get_field('woocommerce_sidebar', 'options');

	if (is_shop() && in_array('shop', $sidebar_options)) $sidebar = true;
	if (is_product_category() && in_array('shop', $sidebar_options)) $sidebar = true;


	?>

	<div class="entry-content" style="max-width:<?php the_field('szerokosc_kontenera', 'options'); ?>px;">

		<?php
		if (!$sidebar) {
			woocommerce_content();
		} else {
		?>
			<div class="rfx_sidebar_wrapper">
				<div class="rfx_next_sidebar">
					<?php woocommerce_content(); ?>
				</div>
				<div class="rfx_sidebar">
					<?php
					dynamic_sidebar('woocommerce-sidebar');
					?>
				</div>
			</div>
		<?php
		} //if

		?>
	</div><!-- .entry-content -->

</article>

<?php get_footer(); ?>