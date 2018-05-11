<?php 
$body_width = 600;
$title_font_size = '28px';
$post_title_font_size = '22px';


// colors:
$body_background    = '#e6e6e6';
$body_color         = '#7d7d7d';
$title_background   = ($theme_options['theme_title_background'] ? 
						$theme_options['theme_title_background']    : '#01526d');
$title_color        = ($theme_options['theme_title_color'] ? 
						$theme_options['theme_title_color']         : '#ffffff');
$post_title_color   = ($theme_options['theme_post_title_color'] ? 
						$theme_options['theme_post_title_color']    : '#000000');
$read_more_color    = ($theme_options['theme_read_more_color'] ? 
						$theme_options['theme_read_more_color']    : '#009ac8');


// font-family:
$font_family        = 'Arial,Helvetica,sans-serif';
$title_font_family  = ($theme_options['theme_titles_font_family'] ? 
					   $theme_options['theme_titles_font_family']   : $font_family);


$read_more_label = ($theme_options['theme_read_more_label'] ? $theme_options['theme_read_more_label'] : 'Read more...');


// ***********************************************
//		Filter posts by language
// ***********************************************

$lang = '';
if (!empty($options['list'])) {
    $list_id = $options['list'];
    switch ($list_id) {
        case 2:
            $lang = 'es';
            break;
        case 3:
            $lang = 'fr';
            break;
        case 4:
            $lang = 'it';
            break;
        case 5:
            $lang = 'mx';
            break;
        default:
            $lang = 'en';
            break;
    }
    //$filters['lang'] = $lang;
}


if(function_exists('pll_get_post_language')){
	
	foreach ($new_posts as $i => $post){
		if(pll_get_post_language($post->ID, 'slug') != $filters['lang'])
			unset($new_posts[$i]);
	}

}



?><!DOCTYPE html>
<html>
<head>
<title>CornerJob</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<?php if($title_font_family == 'Montserrat, sans-serif'){ ?>
<!--[if !mso]><!--><style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Montserrat:500,700);
</style><link href='https://fonts.googleapis.com/css?family=Montserrat:500,700' rel='stylesheet' type='text/css'/><!--<![endif]-->
<?php } ?>

<style type="text/css">
	/* CLIENT-SPECIFIC STYLES */
	body, table, td, a{-webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;} /* Prevent WebKit and Windows mobile changing default text sizes */
	table, td{mso-table-lspace: 0pt; mso-table-rspace: 0pt;} /* Remove spacing between tables in Outlook 2007 and up */
	img{-ms-interpolation-mode: bicubic;} /* Allow smoother rendering of resized image in Internet Explorer */

	/* RESET STYLES */
	img{border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none;}
	table{border-collapse: collapse !important;}
	body{height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important;}
	figure {display: inline-block; vertical-align: top; margin:0 5px; padding:0;}

	/* iOS BLUE LINKS */
	a[x-apple-data-detectors] {
		color: inherit !important;
		text-decoration: none !important;
		font-size: inherit !important;
		font-family: inherit !important;
		font-weight: inherit !important;
		line-height: inherit !important;
	}

	/* MOBILE STYLES */
	@media screen and (max-width: <?php echo $body_width; ?>px) {

		/* ALLOWS FOR FLUID TABLES */
		[class*="wrapper"] {
			width: 100% !important;
			max-width:  !important;
		}

		/* USE THESE CLASSES TO HIDE CONTENT ON MOBILE */
		[class*="mobile-hide"] {
		  display: none !important;
		}

		[class*="img-max"] {
		  max-width: 100% !important;
		  width: 100% !important;
		  height: auto !important;
		}

		/* FULL-WIDTH TABLES */
		[class*="responsive-table"] {
		  width: 100% !important;
		}


		/* ADJUST BUTTONS ON MOBILE */
		[class*="mobile-button-container"] {
			margin: 0 auto;
			width: 100% !important;
		}
		[class*="mobile-button-container"] td {
			background-color:#ffffff!important;
			padding: 0 !important;
		}
		[class*="mobile-button-container"] td a {
			display:inline-block;
			background-color:<?php echo $read_more_color ?>!important;
		}

	}
	@media screen and (max-width: 479px){
		.footer-padding {padding:20px 30px!important;}
		.footer-column {width:100%!important; text-align: center; margin-bottom: 10px!important;}
		.footer-column table {
			margin: 0 auto;
			display: inline-table;
			float: none;
		}
		.footer-column img {
			display: inline-block!important;
		}
	}

	/* ANDROID CENTER FIX */
	div[style*="margin: 16px 0;"] { margin: 0 !important; }
</style>
</head>
<body bgcolor="<?php echo $body_background; ?>" style="margin: 0 !important; padding: 0 !important; -webkit-text-size-adjust:100%;">


<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td bgcolor="<?php echo $body_background; ?>" align="center">
			<!--[if (gte mso 9)|(IE)]>
			<table align="center" border="0" cellspacing="0" cellpadding="0" width="<?php echo $body_width; ?>">
			<tr>
			<td align="center" valign="top" width="<?php echo $body_width; ?>">
			<![endif]-->
			<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff" style="max-width: <?php echo $body_width; ?>px; font-family: <?php echo $font_family; ?>; font-size: 14px; color:<?php echo $body_color; ?>; width:100%;" class="wrapper">


				<!-- View online -->
				<tr>
					<td align="center" bgcolor="<?php echo $body_background; ?>" style="padding:10px">
						<a href="{email_url}" style="color:#808080; text-decoration:none; font-size:10px;"><?php echo $theme_options['theme_view_online_label']; ?></a>
					</td>
				</tr>

				<!-- HEADER -->
				<tr>
					<td bgcolor="<?php echo $title_background; ?>" style="padding:30px 35px;">
						<?php if (!empty($theme_options['theme_logo']['url'])) { ?>
							<img src="<?php echo $theme_options['theme_logo']['url'] ?>" style="max-width: 100%; display:block; border:0" class="img-max">
						<?php } 
						if($theme_options['theme_title']) echo '<h1 style="color: '. $title_color .'; font-family: '. $title_font_family .'; font-size: '. $title_font_size .'; margin:0; font-weight:500; text-transform:uppercase">'. $theme_options['theme_title'] .'</h1>'; ?>
					</td>
				</tr>

				<?php // intro text
				if (!empty($theme_options['theme_header'])) { ?>
				<tr>
					<td style="padding:15px 35px 0; line-height: 1.5em; font-size: 16px;">
						<?php echo $theme_options['theme_header']; ?>
					</td>
				</tr>
				<?php } ?>



				<?php // posts
				foreach ($new_posts as $post) { ?>
					<tr>
						<td style="padding:25px 35px 0;">
							<!--[if (gte mso 9)|(IE)]>
							<table align="center" border="0" cellspacing="0" cellpadding="0" width="<?php echo $body_width - 70; ?>">
							<tr>
							<td align="center" valign="top" width="<?php echo $body_width - 70; ?>">
							<![endif]-->
							<table border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#ffffff" style="max-width: <?php echo $body_width - 70; ?>px; font-family: <?php echo $font_family; ?>; font-size: 14px; color:<?php echo $body_color; ?>; line-height:1.3; width:100%; border:1px solid #dcd6d6;" class=" post">
								<tr>
									<td><a href="<?php echo $post->link ?>" style="text-decoration:none" target="_blank"><img src="<?php echo $post->images['large'] ?>" style="border:0; display:inline-block; width:100%" class="img-max"></a></td>
								</tr>
								<tr>
									<td style="padding:8px 35px 12px; ">
										<h2 style="color: <?php echo $post_title_color ?>; font-family: <?php echo $title_font_family ?>; font-size: <?php echo $post_title_font_size ?>; margin:0 0 10px; font-weight:bold; text-align:center"><a style="text-decoration: none; color: <?php echo $post_title_color ?>" href="<?php echo $post->link ?>" target="_blank"><?php echo $post->title ?></a></h2>

										<p style="margin:0"><?php echo $post->excerpt ?></p>
									</td>
								</tr>
								<!-- button -->
								<tr>
									<td align="center" style="padding: 0 35px 20px"><table border="0" cellspacing="0" cellpadding="0" class="mobile-button-container" style="min-width:130px">
										<tbody><tr>
											<td align="center" style="border-radius:6px;" bgcolor="<?php echo $read_more_color ?>">
												<a href="<?php echo $post->link ?>" target="_blank" style="font-size: 13px; font-family: <?php echo $title_font_family ?>; color: #ffffff; text-decoration: none; display: inline-block; padding:8px 20px; border: 1px solid <?php echo $read_more_color ?>; border-radius:6px; font-weight: 500;" class="mobile-button">
													<?php echo $read_more_label ?>
												</a>
											</td>
										</tr>
									</tbody></table></td>
								</tr>
							</table>
							<!--[if (gte mso 9)|(IE)]>
							</td>
							</tr>
							</table>
							<![endif]-->
						</td>
					</tr>
				<?php } ?>

				<tr>
					<td style="height:40px">&nbsp;</td>
				</tr>
				<!-- footer -->
				<tr>
					<td bgcolor="<?php echo $title_background; ?>" align="center" style="padding:20px 35px"><table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: <?php echo $body_width - 70; ?>px; font-family: <?php echo $title_font_family; ?>; font-weight:500; font-size: 14px; color: #ffffff; width:100%;">
						<tr>
							<td width="50%" align="center" style="vertical-align:top">
								<?php echo $theme_options['theme_footer_left']; ?>
								<br><br>
								<a href="https://app.adjust.com/pxwc2w" style="text-decoration:none; margin:0 5px" target="_blank"><img src="<?php echo $theme_url; ?>/images/play-store.png" style="border:0; display:inline-block!important;" alt="Google Play" width="64" height="19"></a>
								<a href="https://app.adjust.com/1bjwmo" style="text-decoration:none; margin:0 5px" target="_blank"><img src="<?php echo $theme_url; ?>/images/app-store.png" style="border:0; display:inline-block!important;" alt="App Store" width="64" height="19"></a>
							</td>
							<td width="50%" align="center" style="vertical-align:top"><?php echo $theme_options['theme_footer_right']; ?>
								<br><br>
								<a href="https://webmanager.cornerjob.com/?utm_source=newsletterblog#/signup" style="text-decoration:none" target="_blank"><img src="<?php echo $theme_url; ?>/images/computer.png" style="border:0; display:inline-block!important;" alt=""  width="37" height="24"></a>
							</td>
						</tr>
					</table></td>
				</tr>
				<tr>
					<td bgcolor="<?php echo $body_background; ?>" align="center" style="padding:2px 35px 5px; color:#808080; font-size:9px;">
						<?php echo $theme_options['theme_footer']; ?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


		

</body>
</html>