<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage UltraFire
 * @since UltraFire 1.0
 */

get_header(); ?>

<?php
	global $ct_options, $post, $wpdb;;

	$mb_sidebar_position = get_post_meta( $post->ID, 'ct_mb_sidebar_position', true);
	$featured_image_post = stripslashes( $ct_options['ct_featured_image_post'] );
	$about_author = stripslashes( $ct_options['ct_single_author_meta'] );

	$show_comments = stripslashes( $ct_options['ct_single_comments_meta'] );
	$show_date = stripslashes( $ct_options['ct_single_date_meta'] );
	$show_author = stripslashes( $ct_options['ct_single_author_meta'] );
	$show_categories = stripslashes( $ct_options['ct_single_categories_meta'] );
	$show_likes = stripslashes( $ct_options['ct_single_likes_meta'] );
	$show_views = stripslashes( $ct_options['ct_single_views_meta'] );
	$show_tags = stripslashes( $ct_options['ct_single_tags_meta'] );

	$review_position = get_post_meta( $post->ID, 'ct_mb_review_position', true);

	if ( $review_position == '' ) $review_position = 'before_content';

	if ( ($mb_sidebar_position == '') and is_rtl() ) $mb_sidebar_position = 'left';
	else if ( $mb_sidebar_position == '' ) $mb_sidebar_position = 'right';
?>

		<div class="row-fluid">
			<div class="page-title-bar">
				<div class="container">
					<div class="span9">
						<h1 class="entry-title"><?php the_title(); ?></h2>
					</div>
					
					<div class="span3">
						<nav class="nav-single-top">	
							<h3 class="assistive-text"><?php _e( 'Post navigation', 'color-theme-framework' ); ?></h3>
								<?php if ( is_rtl() ) : ?>
									<span class="nav-next-top"><?php next_post_link( '%link', '<span class="icon-chevron-left" data-toggle="tooltip" data-placement="top" title="'. __ ('Next Post', 'color-theme-framework') .'">' . _x( '', 'Next post link', 'color-theme-framework' ) . '</span>' ); ?></span>
									<span class="nav-previous-top"><?php previous_post_link( '%link', '<span class="icon-chevron-right" data-toggle="tooltip" data-placement="top" title="'. __ ('Previous Post', 'color-theme-framework') .'">' . _x( '', 'Previous post link', 'color-theme-framework' ) . '</span>' ); ?></span>
								<?php else : ?>
									<span class="nav-next-top"><?php next_post_link( '%link', '<span class="icon-chevron-right" data-toggle="tooltip" data-placement="top" title="'. __ ('Next Post', 'color-theme-framework') .'">' . _x( '', 'Next post link', 'color-theme-framework' ) . '</span>' ); ?></span>
									<span class="nav-previous-top"><?php previous_post_link( '%link', '<span class="icon-chevron-left" data-toggle="tooltip" data-placement="top" title="'. __ ('Previous Post', 'color-theme-framework') .'">' . _x( '', 'Previous post link', 'color-theme-framework' ) . '</span>' ); ?></span>
								<?php endif; ?>
						</nav><!-- .nav-single -->
					</div>
				</div> <!-- /container -->
			</div> <!-- /page-title-bar -->
		</div> <!-- /row-fluid -->

	<?php if ( is_active_sidebar('ct_single_top') ): ?>
		<!-- START TOP SINGLE WIDGETS AREA -->
		<div class="row-fluid top-widgets-area">
			<div class="span12">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Single Post Top") ) : ?>
				<?php endif; ?>
			</div> <!-- .span12 -->	
		</div> <!-- .row-fluid -->
		<!-- END TOP SINGLE WIDGETS AREA -->
	<?php endif; ?>	

<div class="container">
	
	<div class="row-fluid">
		<?php if ( $mb_sidebar_position == 'right') :?>
		<div id="primary" class="span8">
		<?php else : ?>
		<div id="primary" class="span8 pull-right">
		<?php endif; ?>
			<div id="content" role="main">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php setPostViews(get_the_ID()); ?>

					<?php $format = get_post_format(); ?>

					<?php 
						$show_meta = stripslashes( $ct_options['ct_single_entire_meta'] );

						if ( $show_meta == 1 ) :
					?>
					<div class="entry-single-meta clearfix">
						<ul class="single-meta clearfix">
							<?php if ( $show_date == 1 ) : ?>
							<li>
								<i class="icon-calendar"></i>
								<span class="meta-time updated"><?php the_time('F j, Y'); ?></span>
								&nbsp;/
							</li>
							<?php endif; ?>

							<?php if( $show_author == 1 ) : ?>		
							<li>
								<i class="icon-user"></i><?php echo the_author_posts_link(); ?>
								&nbsp;/
							</li>	
							<?php endif; ?>							

							<?php if ( $show_categories == 1 ) : ?>
							<li>
								<span class="meta-category" title="<?php _e('Category','color-theme-framework'); ?>">
									<i class="icon-tag"></i>
									<?php echo get_the_category_list(', '); ?>
								</span><!-- .meta-category -->
								&nbsp;/
							</li>
							<?php endif; ?>

							<?php if ( $show_views == 1 ) : ?>
							<li>
								<span class="icon-eye-open"></span><?php echo getPostViews( get_the_ID() ); ?>
								&nbsp;/
							</li>	
							<?php endif;?>

							<?php if ( $show_likes == 1 ) : ?>
							<li>
								<?php getPostLikeLink( get_the_ID() ); ?>
								&nbsp;/									
							</li>
							<?php endif; ?>

							<?php if( $show_comments == 1 ) : ?>
			 					<?php if ( comments_open() ) : ?>
			 					<li>
			 						<i class="icon-comment"></i><span><?php comments_popup_link( '<span class="leave-reply">' . __( 'No Comments', 'color-theme-framework' ) . '</span>', __( '<b>1</b> Reply', 'color-theme-framework' ), __( '<b>%</b> Replies', 'color-theme-framework' ) ); ?></span>
			 					</li>	
								<?php endif; ?>
							<?php endif; ?>

						</ul> <!-- /single-meta -->

					</div> <!-- /entry-single-meta -->
					<?php endif; ?>

					<?php 
						if ( $review_position == 'before_media' ) { ?>
							<?php get_template_part( 'includes/single' , 'rating' );  //Show Single Rating	?>
							<div class="clear"></div>
					<?php		
						}
					?>
						<?php 
							/*
							*	----------------------------------------------------------------------------------------------------
							*	POST FORMAT: Image and Standard
							*	----------------------------------------------------------------------------------------------------
							*/
							if ( has_post_format('image') || !get_post_format() ) : ?>	

								<?php
									if ( has_post_thumbnail() && ( $featured_image_post == 1 ) ) {
										$not_crop = stripslashes( $ct_options['ct_featured_type'] );										
									    
									    if ( $not_crop == 'Original ratio' )
									    	$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb'); 
									    else
									    	$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb-crop'); 

										$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); 
									
								?>
									<div class="media-thumb img-format">								
										<a href="<?php echo $large_image_url[0]; ?>" data-rel="prettyPhoto"><img src="<?php echo $image[0] ?>" alt="<?php the_title() ?>" /></a>
									</div> <!-- /media-thumb -->
								<?php } ?>

						<?php endif; // image and standard post formats ?>


						<?php if ( has_post_format('audio') ) : ?>
						<?php
							// Get Soundcloud code from Post Metabox
							$soundcloud = get_post_meta( $post->ID, 'ct_mb_post_soundcloud', true );							
						?>

							<?php if ( !empty( $soundcloud ) ) { ?>
								<div class="media-thumb audio-format">
									<?php echo $soundcloud; ?>	
								</div> <!-- /media-thumb -->
							<?php } ?>
						<?php endif; ?>

						<?php if( has_post_format('gallery') ) : ?>

							<?php
							$time_id = rand();
							$meta_gallery = get_post_meta(get_the_ID(), 'ct_mb_gallery', false);

							if (!is_array($meta_gallery)) $meta_gallery = (array) $meta_gallery; ?>

							<?php
							if (!empty($meta_gallery)) {

								if ( !is_admin() ) {
									/* Flex Slider */
									wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
									wp_enqueue_script('flex-min-jquery',array('jquery'));
								} ?>

								<script type="text/javascript">
								/* <![CDATA[ */
									jQuery.noConflict()(function($){
										$(window).load(function () {

											$('#slider-<?php echo $post->ID . '-' . $time_id; ?>').flexslider({
													animation: "fade",
													directionNav: true,
													controlNav: false,
													slideshow: false,
													smoothHeight: true
											});
										});
									});
								/* ]]> */
								</script>

								<!-- Start FlexSlider -->
							<div class="entry-thumb">
								<div id="slider-<?php echo $post->ID . '-' . $time_id; ?>" class="flexslider clearfix">
									<ul class="slides clearfix">

										<?php
										$meta_gallery = implode(',', $meta_gallery);

										$images = $wpdb->get_col("
												SELECT ID FROM $wpdb->posts
												WHERE post_type = 'attachment'
												AND ID in ($meta_gallery)
												ORDER BY menu_order ASC
										");

										foreach ($images as $att) {
											$src = wp_get_attachment_image_src($att, 'single-post-thumb-crop');
											$src_full = wp_get_attachment_image_src($att, 'full');
											$src = $src[0];
											$src_full = $src_full[0]; ?>

											<?php
											echo '<li><a href="' . $src_full . '" data-rel="prettyPhoto[gal]">';
											echo '<img src="' . $src . '" alt="' . the_title('','',false) . '">';
											echo '</a></li>';
										} // end foreach ?>
									</ul><!-- .slides -->
								</div><!-- .flexSlider -->
							</div> <!-- .entry-thumb -->
							<?php } ?>

						<?php endif; ?>

						<?php if( has_post_format('video') ) : ?>

							<?php 
								$video_type = get_post_meta( $post->ID, 'ct_mb_post_video_type', true );
								$thumb_type = get_post_meta( $post->ID, 'ct_mb_post_video_thumb', true );
								$videoid = get_post_meta( $post->ID, 'ct_mb_post_video_file', true );
							?>
							
							<div class="media-thumb video-post-widget">
							<?php	
								if ( $video_type == 'youtube' ) echo '<iframe src="http://www.youtube.com/embed/' . $videoid .'?wmode=opaque"></iframe>';
								if ( $video_type == 'vimeo' ) echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '"></iframe>';
								if ( $video_type == 'dailymotion' ) echo '<iframe src="http://www.dailymotion.com/embed/video/' . $videoid . '"></iframe>';
							?>
							</div>
						<?php endif; ?>
							
					<?php 
						if ( $review_position == 'before_content' ) { ?>
							<?php get_template_part( 'includes/single' , 'rating' );  //Show Single Rating	?>
							<div class="clear"></div>
					<?php		
						}
					?>
						
						<div class="entry-content">



							<?php 
								/*
								*	------------------------------
								* Show Content
								*	------------------------------
								*/ 
								the_content(); 
							?>


						<?php if ( $show_tags == 1 ) : ?>		
							<span class="entry-tags meta-tags" title="<?php _e('Tags','color-theme-framework'); ?>">
								<i class="icon-tags"></i>
								<?php echo the_tags('',', ',''); ?>
							</span><!-- .meta-tags -->
						<?php endif; ?>	


					<?php if ( $about_author ) : ?>
						<!-- about the author -->
						<div class="divider-block"><div class="inner-divider"></div></div>

						<div id="author-block" class="clearfix">
							<h2 class="author-title"><?php _e('About the author', 'color-theme-framework');  echo ' : '; the_author_meta('display_name'); ?></h2>
							<div class="margin-10b"></div>
							<div id="author-avatar">
								<?php 
								$user_email = get_the_author_meta( 'user_email' );
    							$hash = md5( strtolower( trim ( $user_email ) ) );
    							//echo '<img itemprop="image" style="display:none;" src="http://gravatar.com/avatar/' . $hash .'" alt="" />';
								?>
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 75 ) ); ?>
							</div><!-- #author-avatar -->


							<div id="author-description">
								<?php 
									global $user_id;

									$facebook = get_the_author_meta( 'facebook', $user_id );
									$twitter = get_the_author_meta( 'twitter', $user_id );
									$github = get_the_author_meta( 'github', $user_id );
									$linkedin = get_the_author_meta( 'linkedin', $user_id );
									$pinterest = get_the_author_meta( 'pinterest', $user_id );
									$google_plus = get_the_author_meta( 'google_plus', $user_id );
								
								?>

									<ul class="social-icons single-social-icons clearfix">
										<?php 
											if ( !empty( $facebook ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Facebook' , 'color-theme-framework' ) .'" href="' . $facebook . '"><i class="icon-facebook"></i></a></li>';
											if ( !empty( $twitter ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Twitter' , 'color-theme-framework' ) .'" href="' . $twitter . '"><i class="icon-twitter"></i></a></li>';
											if ( !empty( $github ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Github' , 'color-theme-framework' ) .'" href="' . $github . '"><i class="icon-github"></i></a></li>';
											if ( !empty( $linkedin ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Linkedin' , 'color-theme-framework' ) .'" href="' . $linkedin . '"><i class="icon-linkedin"></i></a></li>';
											if ( !empty( $pinterest ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Pinterest' , 'color-theme-framework' ) .'" href="' . $pinterest . '"><i class="icon-pinterest"></i></a></li>';
											if ( !empty( $google_plus ) ) echo '<li><a data-toggle="tooltip" data-placement="top" title="'. __( 'Go to Google Plus' , 'color-theme-framework' ) .'" href="' . $google_plus . '"><i class="icon-google-plus"></i></a></li>';
										?>
									</ul> <!-- social-icons -->							
								<p><?php the_author_meta( 'description' ); ?></p>
								<div class="clear"></div>
								<a class="ct-button" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php _e('View all articles', 'color-theme-framework'); ?></a>
							</div><!-- #author-description	-->
						</div><!-- #author-info -->

	  				<?php endif; ?>


							<?php 
								$share_code = stripslashes( $ct_options['ct_code_blog_sharing'] );

								if ( !empty( $share_code ) ) {

									echo '<div class="divider-block"><div class="inner-divider"></div></div>';
									echo '<div class="share-block">';
										echo $share_code;	
									echo '</div> <!-- /share-block -->';

								}
							?>
							<div class="divider-block"><div class="inner-divider"></div></div>

							<?php comments_template( '', true ); ?>

							<?php //echo $post->rating; ?>
						</div>	


					<div class="nav-block padding-20 clearfix">
						<nav class="nav-single">
							<h3 class="assistive-text"><?php _e( 'Post navigation', 'color-theme-framework' ); ?></h3>
							<?php if ( is_rtl() ) : ?>
								<span class="nav-previous"><?php previous_post_link( '%link', _x( '', 'Previous post link', 'color-theme-framework' ) . '%title <span class="icon-chevron-right"></span>' ); ?></span>
								<span class="nav-next"><?php next_post_link( '%link', '<span class="icon-chevron-left"></span> %title' . _x( '', 'Next post link', 'color-theme-framework' ) ); ?></span>
							<?php else : ?>
								<span class="nav-previous"><?php previous_post_link( '%link', '<span class="icon-chevron-left">' . _x( '', 'Previous post link', 'color-theme-framework' ) . '</span> %title' ); ?></span>
								<span class="nav-next"><?php next_post_link( '%link', '%title <span class="icon-chevron-right">' . _x( '', 'Next post link', 'color-theme-framework' ) . '</span>' ); ?></span>
							<?php endif; ?>
						</nav><!-- .nav-single -->

						<nav class="nav-single-hidden">
							<?php if( get_previous_post() ) : ?>				
								<span class="nav-previous"><?php previous_posts_link(); ?></span>
							<?php endif; ?>
							<?php if( get_next_post() ) : ?>
		                        <!-- next_posts_link -->
								<span class="nav-next"><?php next_posts_link(); ?></span>
							<?php endif; ?>	
							<div class="clear"></div>
						</nav><!-- .nav-single-hidden -->
					</div><!-- .nav-block -->

					<!-- <div class="comments-block box-shadow-2px clearfix"> -->
						<?php // comments_template( '', true ); ?>
					<!-- </div> --><!-- .comments-block -->
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- .span8 #content -->

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
			  else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Post Sidebar')) : endif; }
			}
			else { if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Single Post Sidebar')) : endif; }
			?>
		</div><!-- .span4 -->
	</div><!-- .row-fluid -->
</div> <!-- .container -->

<?php get_footer(); ?>