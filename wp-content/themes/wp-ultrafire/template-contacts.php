<?php
/* 
 * Template Name: Contact
 *	
 * @package WordPress
 * @subpackage UltraFire
 * @since UltraFire 1.0
 *
 */

get_header(); ?>

<?php
	$ct_options;
	$mb_sidebar_position = get_post_meta( $post->ID, 'ct_mb_sidebar_position', true);

	if ( ($mb_sidebar_position == '') and is_rtl() ) $mb_sidebar_position = 'left';
	else if ( $mb_sidebar_position == '' ) $mb_sidebar_position = 'right';
?>

	<!-- START Page Title Bar -->
	<div class="row-fluid">
		<div class="page-title-bar">
			<div class="container">
				<div class="span6">
					<h1 class="archive-title"><?php the_title(); ?></h1>
				</div>
				
				<div class="span6">	
					<?php $text = get_post_meta($post->ID,'ct_mb_page_desc', true); ?>
					<?php if ( !empty($text) ) : ?>
						<div class="clear"></div>
						<div class="page-desc"><?php echo $text; ?></div>
					<?php endif; ?>				
				</div>
			</div> <!-- /container -->
		</div> <!-- /page-title-bar -->
	</div> <!-- /row-fluid -->


<!-- START CONTACTS CONTENT ENTRY -->
<div class="container">
	<div class="row-fluid">
		<?php if ( $mb_sidebar_position == 'right') :?>
		<div id="primary" class="span8">
		<?php else : ?>
		<div id="primary" class="span8 pull-right">
		<?php endif; ?>
			<div id="content" role="main">
				<div class="entry-page">					

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<div class="entry-page-content">
							<?php the_content(); ?>
						</div>
					<?php endwhile; endif; ?>

				<script  type="text/javascript">
					jQuery.noConflict()(function($){
					$(document).ready(function ()
						{ 
					$("#ajax-contact-form").submit(function ()
					{
						var str = $(this).serialize();
						$.ajax(
						{
							type: "POST",
							url: "<?php echo get_template_directory_uri(); ?>/contact.php",
							data: str,
							success: function (msg)
							{
								$("#note").ajaxComplete(function (event, request, settings)
								{
									if (msg == 'OK') 
									{
										result = '<div class="alert alert-success fade in"><button type="button" class="close" data-dismiss="alert">&times;</button><?php _e('Message was sent to website administrator. Thank you!','color-theme-framework');?></div>';
										$("#fields").hide();
									}
									else
									{
										result = msg;
									}
									$(this).html(result);
								});
							}
						});
						return false;
					});
				});
				});		
				</script>
			
				<fieldset class="info_fieldset">
					<div id="note"></div>

					<div id="contacts-form">		
						<form id="ajax-contact-form" action="javascript:alert('Was send!');" class="clearfix">
							<div class="row-fluid">
						  		<div class="span5">
									<div class="input-prepend">
										<span class="add-on"><i class="icon-user"></i></span><input id="contact-name" type="text" title="<?php _e('Your Name','color-theme-framework'); ?>" name="name" required="" placeholder="<?php _e('Your Name','color-theme-framework'); ?>">
									</div><!-- .input-prepend -->
					  				<div class="input-prepend">
										<span class="add-on"><i class="icon-envelope"></i></span><input id="contact-email" type="email" title="<?php _e('Your Email Address','color-theme-framework'); ?>" name="email" required="" placeholder="<?php _e('Your Email Address','color-theme-framework'); ?>">
					  				</div><!-- .input-prepend -->
					  				<div class="input-prepend">
										<span class="add-on"><i class="icon-share"></i></span><input id="contact-url" type="url" title="<?php _e('Your URL','color-theme-framework'); ?>" name="url" placeholder="<?php _e('Your URL','color-theme-framework'); ?>">
					  				</div><!-- .input-prepend -->
					  				<div class="input-prepend">
										<span class="add-on"><i class="icon-flag"></i></span><input id="contact-subject" type="text" title="<?php _e('Subject','color-theme-framework'); ?>" name="subject" required="" placeholder="<?php _e('Subject','color-theme-framework'); ?>">
					  				</div><!-- .input-prepend -->
					  			</div><!-- .span5 -->
					  		</div><!-- row-fluid -->

					   		<div class="row-fluid">
								<div class="span12">
						  			<textarea id="textarea" name="message" required placeholder="<?php _e('Type your questions here...','color-theme-framework'); ?>" rows="10" class="span12"></textarea>
					  				<button type="submit" class="btn"><?php _e('Send Message','color-theme-framework'); ?></button>
								</div><!-- span12 -->
				   			</div><!-- row-fluid -->
							<span></span>
				  		</form>
					</div> <!-- end #contact-form -->
			 	</fieldset>

			<?php 
			// Displays a link to edit the current post, if a user is logged in and allowed to edit the post
			edit_post_link( __( 'Edit', 'color-theme-framework' ), '<span class="edit-link"><i class="icon-pencil"></i>', '</span>' );
			?>
  			</div> <!-- #content -->
  		</div> <!-- #primary -->
		</div><!-- span8 -->

		<?php if ( $mb_sidebar_position == 'right') :?>
		<div id="secondary" class="widget-area span4" role="complementary">
		<?php else : ?>
		<div id="secondary" class="widget-area span4 pull-left" role="complementary">
		<?php endif; ?>
			<?php
			global $wp_query; 
			$postid = $wp_query->post->ID; 
			$cus = get_post_meta($postid, 'sbg_selected_sidebar_replacement', true);

			if ($cus != '') {
			  if ($cus[0] != '0') { if  (function_exists('dynamic_sidebar') && dynamic_sidebar($cus[0])) : endif; }
			  else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('ct_page_sidebar')) : endif; }
			}
			else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('ct_page_sidebar')) : endif; }
			?>
		</div><!-- .span4 -->
  </div><!-- row-fluid -->
</div><!-- .container -->
<!-- END CONTACTS CONTENT ENTRY -->

<?php get_footer(); ?>