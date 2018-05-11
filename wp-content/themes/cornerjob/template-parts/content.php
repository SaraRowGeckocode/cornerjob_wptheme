		<?php while (have_posts()) : the_post(); ?>
			<article class="col m6 l4 z-depth-0">
				<div class="card">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<div class="card-image">
							<?php 
							// responsive images
							$thumb = get_the_post_thumbnail_url(null,'grid-thumb');
							$thumb2x = get_the_post_thumbnail_url(null,'grid-thumb-2x');
							
							if($thumb2x){
								$srcset = array(
									$thumb . ' 370w',
									$thumb2x . ' 740w'
								);
								$sizes = array(
									'(min-width: 1260px) 370px', 
									'(min-width: 992px) 29vw',
									'(min-width: 600px) 44vw',
									'90vw'
								);
								$srcset_attr = 'sizes="'. implode (", ", $sizes) .'" '.
									'srcset="'. implode (", ", $srcset) .'"';
							}

							echo '<img '.
								'src="'. $thumb .'" '.
								'width="370" '.
								'height="180" '.
								$srcset_attr .'>'; ?>
						</div>
						<h2 class="card-title"><?php the_title(); ?></h2>
					</a>
					<div class="card-content">
						<?php GC_excerpt(); ?>
					</div>
					<div class="card-action clearfix">
						<?php GC_addtoany_sharebuttons() ?>
						<p class="categories"><?php the_category(', '); ?></p>
					</div>
				</div>

			</article>
			<!-- /article -->
		<?php endwhile; ?>