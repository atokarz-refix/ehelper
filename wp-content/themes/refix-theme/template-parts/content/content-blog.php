<article id="archive-<?php the_ID(); ?> archive-posty">
	<div class="archive--content">

			<?php if (have_posts()) : ?>
				<?php

				function blog_post_html($post_id)
				{
					$post_date = get_the_date('', $post_id);
					$post_title = '<p class="postgrid__tytul"><a href="' . get_the_permalink($post_id) . '">' . get_the_title($post_id) . '</a></p>';
					$post_img = '<div class="postgrid__img" style="background-image: url(' . get_the_post_thumbnail_url($post_id) . '); min-height: 300px; background-repeat: no-repeat"><a style="display: block; height: 100%; width: 100%;"href="' . get_the_permalink($post_id) . '"></a></div>';
					$post_desc = get_the_excerpt($post_id);
					$post_desc = substr($post_desc, 0, 100);
					$post_desc_result = substr($post_desc, 0, strrpos($post_desc, ' '));
					$post_link = '<a class="postgrid__link" href="' . get_the_permalink($post_id) . '">WIĘCEJ ⟶</a>';
					$output .= '<div class="postgrid__box">' . $post_img . '<p class="postgrid__data">' . $post_date . '</p>' . $post_title . '<p class="postgrid__exc">' . $post_desc_result . ' [...]</p>' . $post_link . '</div>';
					return $output;
				}

				?>
				<div class="postgrid__container">
					<?php
					while (have_posts()) :
						the_post();
						echo blog_post_html($post);
					// get_template_part('template-parts/content/content', get_theme_mod('display_excerpt_or_full_post', 'excerpt'));
					endwhile;
					?>
				</div>

			<?php else : ?>
				<?php get_template_part('template-parts/content/content-none'); ?>
			<?php endif; ?>
		</div>
	</div>
</article>