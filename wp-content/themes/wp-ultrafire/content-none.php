<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage UltraFire
 * @since UltraFire 1.0
 */
?>

<article id="post-0" class="post no-results not-found box-shadow-2px">
	<header class="entry-header">
		<h1 class="entry-title"><?php _e( 'Nothing Found', 'color-theme-framework' ); ?></h1>
	</header>

	<div class="entry-content clearfix">
		<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'color-theme-framework' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 -->
