<?php
/*
 * Template Name: A Static Page
 */
get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<div class="entry-content" style="max-width:<?php the_field('szerokosc_kontenera','options');?>px;">
		<?php
		the_content();
		?>
	</div><!-- .entry-content -->

</article>

<?php get_footer(); ?>