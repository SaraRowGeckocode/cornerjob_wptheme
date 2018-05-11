		
		<div class="container">
			<div class="no-results center">
				<?php if (is_404()) { ?>
					<h1 class="search-title"><?php _e( 'Page not found', 'cornerjob' ); ?></h1>
				<?php } ?>
				
				<img src="<?php echo get_template_directory_uri(); ?>/images/no-results.png" 
					srcset="<?php echo get_template_directory_uri(); ?>/images/no-results@2x.png 2x, 
							<?php echo get_template_directory_uri(); ?>/images/no-results@3x.png 3x">
				<p class><?php _e( 'Sorry, no post were found, check out our categories.', 'cornerjob' ); ?></p>
				
				<ul class="list-inline">
					<?php 
					$args = array(
						'title_li'=>''
					);
					wp_list_categories($args) ?>
				</ul>
			</div>
		</div>