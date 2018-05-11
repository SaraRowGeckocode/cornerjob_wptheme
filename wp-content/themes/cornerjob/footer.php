<!-- footer -->
	<?php /* if(is_single()){ ?>
		<footer class="page-footer">
			<?php 
			if(function_exists('pll_current_language')) 
				$lang = pll_current_language();
			$url = 'https://webmanager.cornerjob.com/#/signup/'. $lang .'?utm_source=blog&utm_campaign=B2B&utm_medium=WEB'; ?>

			<a href="<?php echo $url; ?>" class="btn orange" target="_blank"><?php _e('Try it for free','cornerjob') ?></a>
			
			<div class="hide-on-small-only">
				<img src="<?php echo get_template_directory_uri(); ?>/images/logo-footer.svg" alt="">
				<div class="hide-on-madium-and-down">
					<?php echo apply_filters('the_content', get_theme_mod( 'GC_footer-txt_'.$lang, '' )); ?>
				</div>
			</div>
			
		</footer>
	<?php  }

	else { */ ?>
	<footer class="page-footer footer-actions <?php if(isset($_GET['nk'])) echo 'visible' ?>">
		
		<div class="hide-on-small-only">
			<?php 
			$title = false;
			$url = false;
			if(!is_single()){
				$title = is_category() ? 
					single_cat_title('', false) .' - '. get_bloginfo('name') : 
					get_bloginfo('name') .' - '. get_bloginfo('description');
				
				global $wp;
				$url = home_url( $wp->request );
			}
			GC_addtoany_sharebuttons(false, $title, $url) ?>
		</div>

		<div class="subscription-form">
			<?php 
			if(isset($_GET['nk'])) {
				echo '<p class="success green-text"><strong>'.
					__("Congratulations! You have successfully subscribed to CornerJob's newsletter.",'cornerjob').
					'</strong><br>'.
					__("You'll receive a confirmation email in a few minutes. Please follow the link to confirm your subscription. If the email takes more than 15 minutes to appear in your mailbox, please check your spam folder.",'cornerjob').
					'</p>';
			} else {
				$listID = 0;
				if(function_exists('pll_current_language')) {
					$lang = pll_current_language();
					switch($lang){
						case 'en':
							$listID = 1;
							break;
						case 'es':
							$listID = 2;
							break;
						case 'fr':
							$listID = 3;
							break;
						case 'it':
							$listID = 4;
							break;
						case 'mx':
							$listID = 5;
							break;
						default:
							$listID = 3;
							break;
					} 
				} ?>
				<?php 
				$url = '#';
				echo do_shortcode(
					'[newsletter_form button_label="'.__('Subscribe','cornerjob').'" confirmation_url="'.get_the_permalink().'"]'.
					'[newsletter_field name="email" label="'.__('Subscribe to the blog','cornerjob').'" placeholder="'.__('Your mail','cornerjob').'"]'.
					'[newsletter_field name="preference" number="'.$listID.'" hidden="true"]'.
					'[newsletter_field name="privacy" url="" label="'. __('I accept that CornerJob sends me news and promotions of its own or related entities, and surveys.','cornerjob'). ' <a href=\''. $url .'\' target=\'_blank\'>'. __('More info','cornerjob'). '</a>."]'.
					'[/newsletter_form]'
				);
			}
			?>
		</div>

	</footer>

	<?php /*}*/ ?>
	<!-- /footer -->


	<?php wp_footer(); ?>

</body>
</html>