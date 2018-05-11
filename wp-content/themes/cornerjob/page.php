<?php get_header(); ?>

	<main role="main">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article <?php post_class(); ?>>
			<div class="container">
				<h1><?php the_title(); ?></h1>
				<?php the_content() ?>
			
			</div>
		</article>
		<!-- /article -->

		
	<?php endwhile; ?>

	<?php else: ?>

		<?php get_template_part('template-parts/loop','noresults'); ?>

	<?php endif; ?>


	</main>

<?php get_footer(); ?>
