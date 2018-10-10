<?php // Template name: Unsubscribe 
// Description: Unsubscribe page for emails sended from ninjaforms

$email = false;
if (isset($_GET['email'])) {
    $email = true;

    $to = rwmb_meta('GC_emails');
    if(!empty($to)){

		$subject = 'CornerJob - Unsubscription Request';
		$body = 'El siguiente usuario ha solicitado la baja de las comunicaciones de CornerJob:<br><br>'.
			$_GET['email'].'<br><br>';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		 
		wp_mail( $to, $subject, $body, $headers );
    }
}
?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<?php favicon(); ?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="robots" content="noindex,nofollow"/>
	<?php wp_head(); ?>

</head>
<body <?php body_class('unsubscribe'); ?>>
	
	<?php while ( have_posts() ) : the_post();  ?>
		
		<div class="container">
			
			<?php if($email):
				the_content();
			else: ?>
				<h1><?php _e('Ooops, there was an error.','cornerjob') ?></h1>
				<p><?php _e('Email address is missing.','cornerjob') ?></p>
			<?php endif; ?>
			
		</div>

	<?php endwhile; ?>

	<div class="footer">
		<?php echo '<img src="'.get_template_directory_uri().'/images/CJ.svg" alt="">'; ?>
		Cornerjob &copy;Copyright <?php echo date('Y'); ?>
	</div>
	
	<?php wp_footer(); ?>

</body>
</html>