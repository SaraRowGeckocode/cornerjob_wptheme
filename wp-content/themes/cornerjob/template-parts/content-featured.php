				<article class="col m6 l4 bg-cover" style="background-image:url(<?php echo get_the_post_thumbnail_url(null,'featured-thumb'); ?>)">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute() ?>">
						<h2><?php the_title() ?></h2>
						<p><?php echo get_the_date() ?> &middot; 
							<?php echo do_shortcode('[rt_reading_time postfix="'.__('min read','cornerjob').'" postfix_singular="'.__('min read','cornerjob').'"]'); ?>
						</p>

						<?php 
						$author_name = rwmb_meta( 'GC_name' );
						if($author_name){ ?>
							<div class="author">
								<?php $picture 	= rwmb_meta( 'GC_image','size=thumbnail' );
								$position 	= rwmb_meta( 'GC_position' ); ?>

								<?php if( !empty($picture) ){
									$image = current($picture);
									echo '<img src="'.$image['url'].'" width="'.$image['width'].'" height="'.$image['height'].'" class="circle" />';
								} ?>
								<p><strong><?php echo $author_name ?></strong><br>
									<?php echo $position; ?>
								</p>
							</div>
						<?php } ?>
					</a>
				</article>