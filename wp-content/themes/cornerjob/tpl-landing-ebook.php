<?php // Template name: Landing Ebook Download ?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta name="google-site-verification" content="GDEzCctuk1x8Go3Wj0k0LPg5foToYjFR1EppmEjmDXU" />
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<?php favicon(); ?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="robots" content="noindex,nofollow"/>
	<?php wp_head(); ?>

</head>
<body <?php body_class('landing-ebook'); ?>>
	
	<?php while ( have_posts() ) : the_post();  ?>
		
		<article <?php post_class(); ?>>
			<div class="container">
				<div class="row">
					<div class="col m6">
						<h1><?php the_title(); ?></h1>
						<?php the_content() ?>
					</div>

					<div class="col m6 form-column">
						<?php echo apply_filters('the_content',rwmb_meta('GC_form-column')); ?>
					</div>
				</div>
			
			</div>
		</article>

	<?php endwhile; ?>
	
	<?php wp_footer(); ?>

</body>
</html>