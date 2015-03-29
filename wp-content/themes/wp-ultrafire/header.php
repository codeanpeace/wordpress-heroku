<!DOCTYPE html>
<!-- UltraFire theme. A ZERGE design (http://www.color-theme.com - http://themeforest.net/user/ZERGE) - Proudly powered by WordPress (http://wordpress.org) -->

<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
<?php global $ct_options ?>

<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<!-- Mobile Specific Metas  ================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" /> 

<?php wp_head(); ?>	

</head>

<body <?php body_class('body-class'); ?>>

<?php
// Load custom background image from Theme Options
	global $wp_query;
		if( is_home() ) {
			$postid = get_option('page_for_posts');
		} elseif( is_search() || is_404() || is_category() || is_tag() || is_author() ) {
			$postid = 0;
		} else {
			$postid = $wp_query->post->ID;
		}

		// Get the unique background image for page
		$bg_img = get_post_meta($postid, 'ct_mb_background_image', true);
		$src = wp_get_attachment_image_src( $bg_img, 'full' );
		$bg_img = $src[0];

		if( empty($bg_img) ) { 
			// Background image not defined, fallback to default background
			$bg_pos = stripslashes ( $ct_options['ct_default_bg_position'] );
			$bg_type = stripslashes ( $ct_options['ct_default_bg_type'] );

			if ( $bg_pos == 'Full Screen' ) {
				$bg_pos = 'full';
			}

			// Get the fullscreen background image for page
			if( ( $bg_pos == 'full' ) && ( $bg_type != 'Color' ) ) {
				$bg_img = stripslashes ( $ct_options['ct_default_bg_image'] );
				if( !empty($bg_img) ) {
					$ct_page_title = $wp_query->post->post_title;

					echo '<img id="bg-stretch" src="' . $bg_img . '" alt="' . $ct_page_title . '" />';
				}
			}
		} else {
			// else get the unique background image for page
			$bg_pos = get_post_meta($postid, 'ct_mb_background_position', true);

			if( $bg_pos == 'full' ) {
				$ct_page_title = $wp_query->post->post_title;

				echo '<img id="bg-stretch" src="' . $bg_img . '" alt="' . $ct_page_title . '" />';
			}
		}
	?>

<?php 
	$logo_type = stripslashes( $ct_options['ct_type_logo'] );
	$show_search_block = stripslashes( $ct_options['ct_show_search_block'] );

	if ( $show_search_block ) $span_class = "span10"; else $span_class = "span12";
?>


	<!-- START HEADER -->
	<header id="header">
			<div class="container">
				<div class="row-fluid">
					<div class="<?php echo $span_class; ?>">
						<div id="logo">
			  			  <?php 
							if ( $logo_type == "image" ) { 
							?>
									<a href="<?php echo home_url(); ?>"><img src="<?php echo stripslashes( $ct_options['ct_logo_upload'] ) ?>" alt="" /></a>
							<?php }	?>
					
							<?php
							if ( $logo_type == "text" ) { ?>						
								<h1><a href="<?php echo home_url(); ?>"><?php echo stripslashes( $ct_options['ct_logo_text'] ); ?></a></h1>
								<span class="logo-slogan"><?php echo stripslashes( $ct_options['ct_logo_slogan'] ); ?></span>											
						  <?php } ?>
						</div>  					

						<div class="navigation" role="navigation">
							<div id="menu">
								<?php 
								if ( has_nav_menu('main_menu') ) wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'sf-menu'));
								?>
							</div> <!-- .menu -->
						</div>  <!-- .navigation -->

					</div>

					<?php 
					/*
					*	------------------------------------------------
					*	Show Search Block
					*	------------------------------------------------
					*/
					if ( $show_search_block ) : ?>
						<div class="span2">
							<div class="search-block">
								<i class="icon icon-search"></i>
							</div>
							<div id="search-form">
								<span class="close-search icon-remove"></span>
								<?php get_search_form(); ?>
							</div>
						</div> <!-- .span2 -->
					<?php endif; ?>

				</div><!-- .row-fluid -->
			</div><!-- .container -->
	</header> <!-- #header -->

	<!-- END HEADER -->