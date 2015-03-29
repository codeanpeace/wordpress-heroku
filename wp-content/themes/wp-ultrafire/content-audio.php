<?php
/**
 * The template for displaying posts in the Audio Post Format
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
	
		<?php
		// Get Soundcloud code from Post Metabox
		$soundcloud = get_post_meta( $post->ID, 'ct_mb_post_soundcloud', true );
		$audio_thumb_type = get_post_meta( $post->ID, 'ct_mb_post_audio_thumb', true );
		?>

		<?php if ( $soundcloud != '' && $audio_thumb_type == 'player' ) : ?>
			<div class="entry-thumb audio-post-block">
				<?php echo $soundcloud; ?>
					<?php 
						$show_content = $ct_options['ct_show_content'];
						if ( $show_content == 0 ) $padding = 'style="padding-bottom: 20px"';
					?>
					<header class="entry-header entry-media-title" <?php if ( $show_content == 0 ) echo $padding; ?>>
						<meta itemprop="datePublished" content="<?php the_time('F j, Y'); ?>">
						<span class="meta-time"><?php the_time('F j, Y'); ?></span>
						<div class="clear"></div>				
						<h1 class="entry-title">
							<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
						</h1>
					</header>
				
			</div> <!-- .entry-thumb -->
		<?php elseif (has_post_thumbnail() && $audio_thumb_type == 'featured' ) : ?>
			<div class="entry-thumb audio-post-block">
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
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumb_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>

					<?php ct_get_date_title(); ?>				
			</div><!-- .entry-thumb -->

		<?php endif; ?>

		<?php ct_show_content_excerpt(); ?>

		</div> <!-- /post-block -->  
</article><!-- post-ID ?> -->