<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package WordPress
 * @subpackage UltraFire
 * @since UltraFire 1.0
 */
?>

<?php
	global $ct_options;
	$copyright_info = stripslashes( $ct_options['ct_copyright_info'] );
	$social_icons = stripslashes( $ct_options['ct_social_icons'] );	
	$service_facebook = stripslashes( $ct_options['ct_service_facebook'] );
	$service_twitter = stripslashes( $ct_options['ct_service_twitter'] );
	$service_github = stripslashes( $ct_options['ct_service_github'] );
	$service_linkedin = stripslashes( $ct_options['ct_service_linkedin'] );
	$service_pinterest = stripslashes( $ct_options['ct_service_pinterest'] );
	$service_googleplus = stripslashes( $ct_options['ct_service_googleplus'] );
?>

<div id="footer" role="contentinfo">
	<div class="container">
		<div class="row-fluid">
			<div class="span6">
				<div class="copyright-info">
					<?php echo $copyright_info; ?>
				</div><!-- .copyright-info -->
			</div> <!-- .span6 -->

			<?php if ( $social_icons == 1 ) : ?>
			<div class="span6">
				<div class="social-block">
					<ul class="social-icons">
						<?php 
							if ( !empty( $service_facebook ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Facebook' , 'color-theme-framework' ) .'" href="' . $service_facebook . '"><i class="icon-facebook"></i></a></li>';
							if ( !empty( $service_twitter ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Twitter' , 'color-theme-framework' ) .'" href="' . $service_twitter . '"><i class="icon-twitter"></i></a></li>';
							if ( !empty( $service_github ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Github' , 'color-theme-framework' ) .'" href="' . $service_github . '"><i class="icon-github"></i></a></li>';
							if ( !empty( $service_linkedin ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Linkedin' , 'color-theme-framework' ) .'" href="' . $service_linkedin . '"><i class="icon-linkedin"></i></a></li>';
							if ( !empty( $service_pinterest ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Pinterest' , 'color-theme-framework' ) .'" href="' . $service_pinterest . '"><i class="icon-pinterest"></i></a></li>';
							if ( !empty( $service_googleplus ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Google Plus' , 'color-theme-framework' ) .'" href="' . $service_googleplus . '"><i class="icon-google-plus"></i></a></li>';
						?>
					</ul> <!-- social-icons -->
				</div><!-- social-block -->
			</div> <!-- .span6 -->
			<?php endif; ?>
		</div> <!-- .row-fluid -->
	</div><!-- .container -->
</div><!-- #footer -->

<?php wp_footer(); ?>

</body>
</html>