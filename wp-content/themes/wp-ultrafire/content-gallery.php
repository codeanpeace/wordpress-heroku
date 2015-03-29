<?php
/**
 * The template for displaying posts in the Gallery Post Format
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
	?>

	
		<div class="post-block <?php echo $ct_post_class; ?>">
	
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="entry-thumb">

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
					?>
					<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $thumb_image_url[0]; ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" /></a>

					<?php 
						/*
						*	------------------------------------------------------------
						*	SHOW DATE AND TITLE FUNCTION
						*	------------------------------------------------------------
						*/

						ct_get_date_title(); 
					?>

				</div> <!-- .entry-thumb -->
			
			<?php endif; ?>

			<?php if ( !has_post_thumbnail() ) : ?>
					<?php
					$meta = get_post_meta(get_the_ID(), 'ct_mb_gallery', false);

					if (!is_array($meta)) $meta = (array) $meta;
										
					if (!empty($meta)) {
						$meta = implode(',', $meta);

						$images = $wpdb->get_col("
							SELECT ID FROM $wpdb->posts
							WHERE post_type = 'attachment'
							AND ID in ($meta)
							ORDER BY menu_order ASC
						");

						$src = wp_get_attachment_image_src($images[0], 'single-post-thumb-crop');		    
					?>

					<div class="entry-thumb">
						<div class="bg-mask"></div>

						<?php ct_get_rating_type_stars(); ?>
						
						<?php ct_get_views_likes(); ?>

						<a href="<?php echo the_permalink(); ?>"><img src="<?php echo $src[0]; ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" /></a>

						<?php ct_get_date_title(); ?>

					</div> <!-- .entry-thumb -->
				   <?php
					} 

			endif; ?>

			<?php ct_show_content_excerpt(); ?>	

	</div> <!-- /post-block -->  
</article><!-- post-ID ?> -->