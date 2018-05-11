<?php get_header(); ?>

	<main role="main">
		<?php 
		$default_img = get_template_directory_uri().'/images/head-bg.jpg';

		if(is_category()){ 
			$category = get_category( get_query_var( 'cat' ) ); 
			$img = GC_category_image($category->cat_ID);
			if(!$img) $img = $default_img; ?>
			<div class="page-head valign-wrapper" style="background-image:url(<?php echo $img; ?>)">
				<div class="valign container">
					<h1><?php echo $category->name; ?></h1>
				</div>
			</div>
		<?php } ?>

		<div class="container">
			<?php if (is_search()) { ?>
				<h1 class="search-title"><?php _e( 'Search Results for', 'cornerjob' ); echo ' "'. get_search_query().'"'; ?></h1>
			<?php } ?>

			<?php get_template_part('template-parts/loop'); ?>
		</div>


	</main>

<?php get_footer(); ?>