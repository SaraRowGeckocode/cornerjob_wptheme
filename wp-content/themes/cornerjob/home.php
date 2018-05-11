<?php get_header(); ?>

	<main role="main">
		<?php 
		
		// FEATURED POSTS 
		$args = array(
			'posts_per_page' => 6,
			//'orderby' => 'rand'
			'meta_key' => 'GC_post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		);
		$featured = new WP_Query( $args );
		if ($featured->have_posts()): ?>

			<!-- featured posts -->
			<div id="featured-posts" class="row">
				<?php while ($featured->have_posts()) : $featured->the_post();
					get_template_part('template-parts/content','featured');
				endwhile; ?>
			</div>
			<!-- /featured posts -->

		<?php endif;
		wp_reset_query(); ?>

		
		<?php 

		// LATEST POSTS ?>
		<div class="container">
			<?php get_template_part('template-parts/loop'); ?>
		</div>


	</main>

<?php get_footer(); ?>