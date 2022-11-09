<?php
get_header(); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content rfx-fullwidth" style="max-width:100%;">
		<?php
		$description = get_the_archive_description();
		?>
		<div class="entry-content" style="max-width:<?php the_field('szerokosc_kontenera', 'options'); ?>px;">
			<div class="archive__container">

				<?php
				dynamic_sidebar('blog-sidebar-01');
				get_template_part('template-parts/content/content-blog');
				?>
			</div>
			<div>
</article>

<?php get_footer(); ?>