<?php
/*
 * Template Name: Full width
 */
get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<div class="entry-content rfx-fullwidth" style="max-width:100%;">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

</article>

<?php get_footer(); ?>