	<?php if (have_posts()): ?>

		<div id="posts-list" class="row posts-list">
			<?php //while (have_posts()) : the_post();
				get_template_part('template-parts/content');
			//endwhile; ?>
		</div>

	<?php else: ?>
		
		<?php get_template_part('template-parts/loop','noresults'); ?>


	<?php endif; ?>