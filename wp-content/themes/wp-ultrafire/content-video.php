<?php
/**
 * The template for displaying posts in the Video Post Format
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package WordPress
 * @subpackage UltraFire
 * @since UltraFire 1.0
 */
?>

<?php 
	global $ct_options, $post, $ct_post_class;

	$post_type = get_post_meta($post->ID, 'ct_mb_post_type', true);
	if( $post_type == '' ) $post_type = 'standard_post';		
?>

<?php if ($post_type == 'standard_post') : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-box clearfix' ); ?> itemscope itemtype="http://schema.org/BlogPosting">
<?php else : // review ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'masonry-box clearfix' ); ?> itemscope itemtype="http://data-vocabulary.org/Review">
<?php endif; ?>

	<?php
		$post_type = get_post_meta( $post->ID, 'ct_mb_post_type', true);
		$mb_excerpt_lenght = get_post_meta( $post->ID, 'ct_mb_excerpt_lenght', true);
		$admin_excerpt = stripslashes( $ct_options['ct_excerpt_lenght'] );

		// if not set, set variables to their defaults
		if ( $mb_excerpt_lenght == '' ) $mb_excerpt_lenght = '0';
	?>

		<div class="post-block <?php echo $ct_post_class; ?>">
		<?php
		$video_type = get_post_meta( $post->ID, 'ct_mb_post_video_type', true );
		$thumb_type = get_post_meta( $post->ID, 'ct_mb_post_video_thumb', true );
		$videoid = get_post_meta( $post->ID, 'ct_mb_post_video_file', true );
		$perma_link = get_permalink($post->ID);

		if ( empty($thumb_type) ) { $thumb_type = 'player'; }
		?>

		<?php if( $videoid != '' ) : ?>
			<div class="entry-thumb">
				<?php
						/*
						*	------------------------------------------------------------
						*	FOR YOUTUBE
						*	------------------------------------------------------------
						*/

				if ( $video_type == 'youtube' ) {
					if ( $thumb_type == 'auto' ) { ?>
											
					<?php					
						
						ct_get_info();

						echo '<a href="' . $perma_link . '"><img src="http://img.youtube.com/vi/' . $videoid . '/0.jpg" alt="'. the_title('','',false) . '" /></a>';
			  		}
			  		else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
			  		?>	
					<div class="bg-mask"></div>

					<?php ct_get_rating_type_stars(); ?>
					
					<?php ct_get_views_likes(); ?>
				

					<?php
						if ( $ct_post_class == 'one_columns_sidebar' ) $thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb-crop');
						else { 
							$not_crop = stripslashes( $ct_options['ct_featured_type_blog'] );

							if ( $not_crop == 'Original ratio' )
								$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-thumb');
							else	
								$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-thumb-crop');
							}	
					
						echo '<a href="' . $perma_link . '"><img src="' . $thumb_image_url[0] . '" alt="'. the_title('','',false) . '" /></a>';
	
						ct_get_date_title(); 
			  		}
			  		else if ( $thumb_type == 'player' or $thumb_type == '' ) {
						echo '<iframe src="https://www.youtube.com/embed/' . $videoid .'"></iframe>';
			  		}
			  		else { echo '<img src="http://img.youtube.com/vi/' . $videoid . '/0.jpg" alt="'. the_title('','',false) . '" />'; }
 				  
					if ( $thumb_type != 'player' && $thumb_type != '' ) {
						echo '<div class="video youtube"><a href="' . $perma_link . '" data-toggle="tooltip" data-placement="top" title="'. __('Watch Youtube Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
			  		}
			  	  
				} // endif youtube

						/*
						*	------------------------------------------------------------
						*	FOR VIMEO
						*	------------------------------------------------------------
						*/

				else if ( $video_type == 'vimeo' ) {
					if ( $thumb_type == 'auto' ) {
						
						ct_get_info();

						$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoid.php"));
						echo '<img src="' . $hash[0]['thumbnail_large'] . '" alt="'. the_title('','',false) . '" />';
			  		} 
			  		else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
			  			?>
					<div class="bg-mask"></div>

					<?php ct_get_rating_type_stars(); ?>
					
					<?php ct_get_views_likes(); ?>
				

					<?php
						if ( $ct_post_class == 'one_columns_sidebar' ) $thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb-crop');
						else { 
							$not_crop = stripslashes( $ct_options['ct_featured_type_blog'] );

							if ( $not_crop == 'Original ratio' )
								$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-thumb');
							else	
								$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-thumb-crop');
						}	
					
						echo '<a href="' . $perma_link . '"><img src="' . $thumb_image_url[0] . '" alt="'. the_title('','',false) . '" /></a>';
						/*
						*	------------------------------------------------------------
						*	SHOW DATE AND TITLE FUNCTION
						*	------------------------------------------------------------
						*/

						ct_get_date_title(); 

			  		}
			  		else if ( $thumb_type == 'player' or $thumb_type == '' ) {
						echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '"></iframe>';
			  		}
			  		else {
						$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$videoid.php"));
						echo '<img src="' . $hash[0]['thumbnail_large'] . '" alt="'. the_title('','',false) . '" />';

			  		}

					if ( $thumb_type != 'player' && $thumb_type != '' ) {
						echo '<div class="video vimeo"><a href="' . $perma_link . '" data-toggle="tooltip" data-placement="top" title="'. __('Watch Vimeo Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
					}
				} //endif Vimeo

						/*
						*	------------------------------------------------------------
						*	FOR DAILY MOTION
						*	------------------------------------------------------------
						*/

				elseif ( $video_type == 'dailymotion' ) {
					if ( $thumb_type == 'auto' ) {						
						
						ct_get_info();

						echo '<img src="' . getDailyMotionThumb($videoid) . '" alt="'. the_title('','',false) . '" />';
			  		} 
			  		else if ( $thumb_type == 'featured' && has_post_thumbnail() ) {
			  		?>
					<div class="bg-mask"></div>

					<?php ct_get_rating_type_stars(); ?>
					
					<?php ct_get_views_likes(); ?>
				

					<?php
						if ( $ct_post_class == 'one_columns_sidebar' ) $thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-post-thumb-crop');
						else { 
							$not_crop = stripslashes( $ct_options['ct_featured_type_blog'] );

							if ( $not_crop == 'Original ratio' )
								$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-thumb');
							else	
								$thumb_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'blog-thumb-crop');
						}	
					
						echo '<a href="' . $perma_link . '"><img src="' . $thumb_image_url[0] . '" alt="'. the_title('','',false) . '" /></a>';
						/*
						*	------------------------------------------------------------
						*	SHOW DATE AND TITLE FUNCTION
						*	------------------------------------------------------------
						*/

						ct_get_date_title(); 

			  		}
			  		else if ( $thumb_type == 'player' or $thumb_type == '' ) {
						echo '<iframe src="http://www.dailymotion.com/embed/video/' . $videoid . '"></iframe>';
			  		}
			  		else {
						echo '<img src="' . getDailyMotionThumb($videoid) . '" alt="'. the_title('','',false) . '" />';
			  		}										

					if ( $thumb_type != 'player' && $thumb_type != '' ) {
						echo '<div class="video dailymotion"><a href="' . $perma_link . '" data-toggle="tooltip" data-placement="top" title="'. __('Watch DailyMotion Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
			  		}
				} //endif Dailymotion
		  		?>
			</div> <!-- .entry-thumb -->

					<?php 
						$show_content = $ct_options['ct_show_content'];
						if ( $show_content == 0 ) $padding = 'style="padding-bottom: 20px"';

						if ( $thumb_type == 'player' ) :
					?>
					<header class="entry-header entry-media-title" <?php if ( $show_content == 0 ) echo $padding; ?>>
						<meta itemprop="datePublished" content="<?php the_time('F j, Y'); ?>">
						<span class="meta-time updated"><?php the_time('F j, Y'); ?></span>
						<div class="clear"></div>
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1>
					</header>

					<?php 
						$author = sprintf( '<span class="author vcard">%4$s<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
								esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
								esc_attr( sprintf( __( 'View all posts by %s', 'color-theme-framework' ), get_the_author() ) ),
								get_the_author(),
								''
							);
					?>
					<span class="meta-author" style="display:none;"><?php printf( $author ); ?></span><!-- .meta-author -->					
					<?php endif; ?>

			<?php ct_show_content_excerpt(); ?>	
							
		<?php endif; ?>

	
	</div> <!-- /post-block -->  
</article><!-- post-ID ?> -->