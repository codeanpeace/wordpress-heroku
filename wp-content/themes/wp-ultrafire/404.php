<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage UltraFire
 * @since UltraFire 1.0
 */

get_header(); ?>

<?php
	global $ct_options;
	$page_comments = get_post_meta($post->ID,'ct_mb_page_comments', true);
	$mb_sidebar_position = get_post_meta( $post->ID, 'ct_mb_sidebar_position', true);
	
	if ( $mb_sidebar_position == '' ) $mb_sidebar_position = 'right';
?>

	<!-- START Page Title Bar -->
	<div class="row-fluid">
		<div class="page-title-bar">
			<div class="container">
				<div class="span12">
					<h1 class="archive-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'color-theme-framework' ); ?></h1>
				</div> <!-- /span6 -->
				
			</div> <!-- /container -->
		</div> <!-- /page-title-bar -->
	</div> <!-- /row-fluid -->

<div class="container">
	<div class="row-fluid">
		<?php if ( $mb_sidebar_position == 'right') :?>
		<div id="primary" class="site-content span8">
		<?php else : ?>
		<div id="primary" class="site-content span8 pull-right">
		<?php endif; ?>
			<div id="content" role="main">
				<div class="entry-page">

	<article id="post-0" class="post error404 no-results not-found box-shadow-2px">
		<div class="entry-content">
			<h3><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'color-theme-framework' ); ?></h3>
			<?php get_search_form(); ?>
			<div class="divider-block"><div class="inner-divider"></div></div>

  <div class="row-fluid entry-archives">
				    <div class="span4">
					  <h5><?php _e('Last 30 Posts', 'color-theme-framework') ?></h5>
					  <ul class="archives">
					    <?php $archive_30 = get_posts('numberposts=30');
					    foreach($archive_30 as $post) : ?>
						  <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
					  	<?php endforeach; ?>
					  </ul>
					</div><!-- /span4 -->
						
					<div class="span4">
					  <h5><?php _e('Archives by Month:', 'color-theme-framework') ?></h5>
					  <ul class="archives">
					    <?php wp_get_archives('type=monthly'); ?>
					  </ul>
					</div><!-- /span4 -->

				    <div class="span4">
					  <h5><?php _e('Archives by Subject:', 'color-theme-framework') ?></h5>
					  <ul class="archives">
					    <?php wp_list_categories( 'title_li=' ); ?>
					  </ul>
					</div><!-- /span4 -->					
				  <!-- /archive-lists -->
				  </div><!-- row-fluid -->


		</div><!-- .entry-content -->
	</article><!-- #post-0 -->

				</div><!-- .entry-page -->
			</div><!-- #content -->
		</div><!-- .span8 #primary -->


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
	</div><!-- .row-fluid -->
</div><!-- .container -->

<?php get_footer(); ?>