<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta name="google-site-verification" content="GDEzCctuk1x8Go3Wj0k0LPg5foToYjFR1EppmEjmDXU" />
	<meta charset="<?php bloginfo('charset'); ?>">

	<?php favicon(); ?>

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>

	<!-- header -->
	<header class="header clear" role="banner">
		<nav role="navigation">
			<div class="nav-wrapper">
				<?php 
				if(function_exists('pll_home_url')){
					$homeurl = pll_home_url();
				} else {
					$homeurl = esc_url( home_url( '/' ) );
				} ?>
				<a href="<?php echo $homeurl ?>" id="logo-container" class="brand-logo">
					<?php 
					$custom_logo_id = get_theme_mod('custom_logo');
					if($custom_logo_id) {
						echo wp_get_attachment_image($custom_logo_id, 'full');
					} else {
						echo '<img src="'.get_template_directory_uri().'/images/logo.svg" alt="'.get_bloginfo('name').'">';
					} ?>
				</a>

					
				<ul class="right nav-buttons">
					<li class="hide-on-med-and-down"><a href="#" id="show-search" class="waves-effect waves-light"><span class="ficon-search"></span></a></li>
					<li><a href="#" data-activates="main-nav" class="waves-effect waves-light button-collapse"><i class="ficon-menu"></i></a></li>
				</ul>
				
				<div id="main-nav" class="side-nav right-aligned">
					<a href="#" id="close-menu" data-activates="main-nav" class="waves-effect waves-light hide-on-large-only"><i class="ficon-close"></i></a>
					<?php wp_nav_menu(array(
						'theme_location'  => 'header-menu',
						'container'       => null,
						'fallback_cb'	  => false
					)); ?>
					<!-- Categories -->
					<div class="cat-dropdown">
						<a class='dropdown-button' href='#' data-activates='cat-menu'><?php _e('Categories') ?> <span class="ficon-chevron-down"></span></a>
						<ul id='cat-menu' class='dropdown-content'>
							<?php 
							$args = array(
								'title_li'=>''
							);
							wp_list_categories($args) ?>
						</ul>
					</div>

					<div id="top-search">
						<span class="close-form ficon-close"></span>
						<?php get_search_form() ?>
					</div>

					<div class="hide-on-large-only">
						<?php wp_nav_menu(array(
							'theme_location'  => 'legal-menu',
							'container'       => null,
							'fallback_cb'	  => false
						)); ?>
					</div>
				</div>
				

			</div>
		</nav>

	</header>
	<!-- /header -->
