<?php
/**
 * The template for displaying posts in the Standard Post Format
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

					<?php ct_get_date_title(); ?>
								
				</div> <!-- .entry-thumb -->

				<?php ct_show_content_excerpt(); ?>	
			
		<?php endif; ?>

		<?php if ( !has_post_thumbnail() ) : ?>
			<?php 
				$bg_color = get_post_meta( $post->ID, 'ct_mb_post_bg_color', true);
				$text_color = get_post_meta( $post->ID, 'ct_mb_post_font_color', true);

				$show_views = stripslashes( $ct_options['ct_views_icon'] ); 
				$show_likes = stripslashes( $ct_options['ct_likes_icon'] );				

				if ( $bg_color == '' ) $bg_color = '#FFF';
				if ( $text_color == '' ) $text_color = '#313131';
			?>
			<div class="entry-content without-feature" itemprop="articleBody" style="background-color: <?php echo $bg_color; ?>; color: <?php echo $text_color; ?>">	

				<?php
					if ( ( $show_views == 0 ) || ( $show_likes == 0 ) )
						echo '<div class="meta-info meta-info-padding clearfix">';
					else
						echo '<div class="meta-info clearfix">';
				?>
				
					<?php if ( $show_views == 1 ) { ?>
						<div class="icon-views">
							<span class="icon-eye-open" data-toggle="tooltip" data-placement="right" title="<?php echo getPostViews( get_the_ID() ); ?>"></span>
						</div>
					<?php } ?>

						<?php if ( $show_likes == 1 ) { ?>
							<?php 
								if ( $show_views == 0 ) 
									echo '<div class="icon-likes likes-padding">';
								else 		
								  	echo '<div class="icon-likes">';
							?>	  
								<?php getPostLikeLink_echo( get_the_ID() ); ?>
						</div>
						<?php } ?>

					<?php ct_get_rating_type_stars(); ?>					
				</div> <!-- /meta-info -->

				<?php 
					$show_date = stripslashes( $ct_options['ct_date_meta'] ); 

					if ( $show_date == 1 ) {
				?>				
					<meta itemprop="datePublished" content="<?php the_time('F j, Y'); ?>">
					<span class="meta-time updated" style="color: <?php echo $text_color; ?>"><?php the_time('F j, Y'); ?></span>
					<div class="clear"></div>
				<?php } ?>

				<header class="entry-header">
					<h1 class="entry-title"><a style="color: <?php echo $text_color; ?>" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
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


			<?php ct_show_content_excerpt_featured(); ?>
			
			</div> <!-- /entry-content -->
		<?php endif; ?>		

	</div> <!-- /post-block -->  
</article><!-- post-ID ?> -->