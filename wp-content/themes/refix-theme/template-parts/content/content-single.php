<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="archive--content">

		<div class="entry-content text-fff" style="max-width:<?php the_field('szerokosc_kontenera', 'options'); ?>px;">
			<?php
			$post_thumbnail_id = get_post_thumbnail_id();
			$post_img = wp_get_attachment_image_src($post_thumbnail_id, 'full');
			$post_img_mobile = wp_get_attachment_image_src($post_thumbnail_id, 'medium_large');
			$post_id = get_the_ID();
			$post_tags = get_the_tags($post_id);
			$post_date = get_the_date();
			$post_category = get_the_category();
			?>

			<p style="text-align: right" ;>Kategoria: <?php echo $post_category[0]->name; ?></p>
			<div class="single-post--data">
				<?php echo $post_date; ?>
			</div>
			<img class="single-post--img" src="<?php echo $post_img[0] ?>" srcset="<?php echo $post_img_mobile[0] ?> 800w, <?php echo $post_img[0] ?>" sizes="(max-width: 800px) 800px, 1200px">

			<?php
			// echo '<pre> '; var_dump($post_category[0]->name); echo '</pre>';
			the_content();
			echo $post_tags[0]->name;
			?>
		</div><!-- .entry-content -->

</article>