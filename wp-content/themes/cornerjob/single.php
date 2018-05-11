<?php get_header(); ?>

	<main role="main">

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<!-- article -->
		<article <?php post_class(); ?>>
			<?php 
			if(has_post_thumbnail()): ?>
				<header class="post-head valign-wrapper" style="background-image:url(<?php the_post_thumbnail_url( 'full' ); ?>);">
					<div class="container">
						<h1><?php the_title(); ?></h1>
						<p class="hide-on-med-and-up">
							<?php echo __('Published','cornerjob').' '.get_the_date().' &middot; ';
							echo do_shortcode('[rt_reading_time postfix="'.__('min read','cornerjob').'" postfix_singular="'.__('min read','cornerjob').'"]');
							?>
						</p>
					</div>
					<div class="posts-nav">
						<span class="prev"><?php next_post_link('%link','<span class="ficon-angle-left-circle tooltipped" data-position="right" data-tooltip="%title"></span>'); ?></span>
						<span class="next"><?php previous_post_link('%link','<span class="ficon-angle-right-circle tooltipped" data-position="left" data-tooltip="%title"></span>'); ?></span>
					</div>
				</header>
			<?php else: ?>
				<div class="container">
					<h1><?php the_title(); ?></h1>
				</div>
			<?php endif; ?>
			
			<div class="container post-meta clearfix">
				<?php 
				$author_name = rwmb_meta( 'GC_name' );
				if($author_name){ ?>

					<div class="right hide-on-small-only">
						<?php echo __('Published','cornerjob').' '.get_the_date().'<br>';
						echo do_shortcode('[rt_reading_time postfix="'.__('min read','cornerjob').'" postfix_singular="'.__('min read','cornerjob').'"]'); ?>
					</div>

					<div class="author left">
						<?php
						$picture 	= rwmb_meta( 'GC_image','size=thumbnail' );
						$position 	= rwmb_meta( 'GC_position' );
						$twitter_id = rwmb_meta( 'GC_twitter' ); ?>

						<?php if( !empty($picture) ){
							$image = current($picture);
							echo '<img src="'.$image['url'].'" width="'.$image['width'].'" height="'.$image['height'].'" class="circle" />';
						} ?>
						<p><strong><?php echo $author_name ?></strong><br>
							<?php echo $position;
							if($twitter_id && $twitter_id != '@') echo ' <span class="primary-color">'.$twitter_id.'</span>'; ?>
						</p>
					</div>
				<?php }
				else { ?>
					<div class="hide-on-small-only">
						<div class="right"><?php echo do_shortcode('[rt_reading_time postfix="'.__('min read','cornerjob').'" postfix_singular="'.__('min read','cornerjob').'"]'); ?></div>
						<?php echo __('Published','cornerjob').' '.get_the_date(); ?>
					</div>
				<?php } ?>
			</div>

			<div class="post-content">
				<?php the_content(); ?>
			</div>


			<footer class="post-footer">
				<div class="container clearfix">
					<p class="categories"><?php the_category(', '); ?></p>
					
					<?php GC_addtoany_sharebuttons(__('Share this post via', 'cornerjob')) ?>
				</div>

				<div class="author">
					<div class="container">
						<?php 
						$author_name = rwmb_meta( 'GC_name' );
						if($author_name){
							$picture 	= rwmb_meta( 'GC_image','size=thumbnail' );
							$position 	= rwmb_meta( 'GC_position' );
							$twitter_id = rwmb_meta( 'GC_twitter' ); ?>

							<?php if( !empty($picture) ){
								$image = current($picture);
								echo '<img src="'.$image['url'].'" width="'.$image['width'].'" height="'.$image['height'].'" class="circle" />';
							} ?>
							<p><strong><?php echo $author_name ?></strong><br>
								<?php echo $position. ' <span class="primary-color">'.$twitter_id.'</span>'; ?>
							</p>
						<?php }


						// BANNER
						$banner_img = rwmb_meta('GC_banner-image');
						if(!empty($banner_img)){ ?>
							<div class="post-banner">
								<?php 
								$image = current($banner_img);
								$url   = rwmb_meta( 'GC_banner-url' );
								$title = htmlspecialchars( rwmb_meta('GC_banner-title') );
								$alt_attr = ($title ? ' alt="'.$title.'"' : '');
								if($url){
									$title_attr = ($title ? ' title="'.$title.'"' : '');
									echo '<a href="'.$url.'"'.$title_attr.' target="_blank">';
								}
								echo '<img src="'.$image['full_url'].'"'.$alt_attr.' />';
								if($url) echo '</a>';
								?>
							</div>
						<?php } ?>
					</div>
				</div>

			</footer>

		</article>
		<!-- /article -->

		<?php 
		$args = array(
			'posts_per_page' => 3,
			'post__not_in' => array($post->ID)
		);
		query_posts($args);
		if (have_posts()): ?>
			<!-- related -->
			<aside class="related">
				<div class="container">
					<h2 class="section-title"><?php _e('Other posts','cornerjob'); ?></h2>

					<div id="posts-list" class="row posts-list">
						<?php get_template_part('template-parts/content'); ?>
					</div>

				</div>
			</aside>
			<!-- /related -->
		<?php endif;
		wp_reset_query(); ?>
		


	<?php endwhile; ?>

	<?php else: ?>

		<?php get_template_part('template-parts/loop','noresults'); ?>

	<?php endif; ?>


	</main>

<?php get_footer(); ?>
