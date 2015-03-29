<?php
/**
 * Template Name: Full Width Page
 *
 *
 * @package WordPress
 * @subpackage UltraFire
 * @since UltraFire 1.0
 */

get_header(); ?>

<?php
	global $ct_options;

	$page_comments = get_post_meta($post->ID,'ct_mb_page_comments', true);

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


<div class="container">
	<div class="row-fluid">
		<div id="primary" class="site-content span12">
			<div id="content" role="main">
				<div class="entry-page">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'content', 'page' ); ?>

						<?php if ( $page_comments == '1') : ?>
							<?php comments_template( '', true ); ?>
						<?php endif; ?>
					<?php endwhile; // end of the loop. ?>
				</div><!-- .entry-page -->
			</div><!-- #content -->
		</div><!-- .span12 #primary -->
	</div><!-- .row-fluid -->
</div><!-- .container -->

<?php get_footer(); ?>