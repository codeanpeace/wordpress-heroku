<?php
/**
 * Template Name: Blog
 *
 *
 * @package WordPress
 * @subpackage UltraFire
 * @since UltraFire 1.0
 */

get_header(); ?>

<?php 
	global $ct_options, $post_class;

	/* Get Pagination Type */
	$pagination_type = stripslashes( $ct_options['ct_pagination_type'] );

	/* Get Columns For Homepage */
	$home_columns = stripslashes( $ct_options['ct_homepage_columns'] );

	/* Get Homepage Sidebar Position */
	$home_sidebar = stripslashes( $ct_options['ct_homepage_sidebar'] );

	if( $home_columns == '3 Columns' ) $ct_post_class = 'three_columns'; else
	if( $home_columns == '4 Columns' ) $ct_post_class = 'four_columns'; else
	if( $home_columns == '5 Columns' ) $ct_post_class = 'five_columns'; else
	if( $home_columns == '1 Column + Sidebar' ) $ct_post_class = 'one_columns_sidebar'; else
	if( $home_columns == '2 Columns + Sidebar' ) $ct_post_class = 'two_columns_sidebar'; else
	if( $home_columns == '3 Columns + Sidebar' ) $ct_post_class = 'three_columns_sidebar'; else $ct_post_class = 'four_columns';

?>


<!-- START CONTENT -->

	<div class="row-fluid">
<?php if ( is_active_sidebar('ct_home_top') ): ?>
	<!-- START HOMEPAGE TOP WIDGETS AREA -->
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_home_top') ) : ?>
				<?php endif; ?>
	<!-- END HOMEPAGE TOP WIDGETS AREA -->
<?php endif; ?>	
</div>



<div id="content" class="container" role="main">
	<div class="row-fluid">
		<?php if( ($home_columns == '2 Columns + Sidebar') or ($home_columns == '3 Columns + Sidebar') or ($home_columns == '1 Column + Sidebar') ) : ?>
				<?php if ( $home_sidebar == 'Right' ) : ?>
			<div class="span8">
				<?php else : ?>
			<div class="span8 pull-right">
				<?php endif; // $home_sidebar ?>
			<?php else : ?>
			<div class="span12">
			<?php endif; // $home_columns ?>

				<?php
				global $query_string;

				$homepage_category = stripslashes( $ct_options['ct_homepage_category'] );
				$homepage_orderby = stripslashes( $ct_options['ct_homepage_orderby'] );

				

				switch ( $homepage_orderby ) {
					case 'Date';
						$orderby_query = 'date';
						$order_query = 'DESC';
						break;

					case 'Date ASC';
						$orderby_query = 'date';
						$order_query = 'ASC';
						break;

					case 'Title';
						$orderby_query = 'title';
						$order_query = 'DESC';
						break;

					case 'Title ASC';
						$orderby_query = 'date';
						$order_query = 'ASC';
						break;

					case 'Random';
						$orderby_query = 'rand';
						$order_query = 'DESC';
						break;

				}				

				$idObj = get_category_by_slug( $homepage_category ); 

				if( !empty($idObj->term_id) ) $id = $idObj->term_id;
				else $id = '';


					if ( get_query_var('paged') ) {
				    	$paged = get_query_var('paged');
					} elseif ( get_query_var('page') ) {
					  $paged = get_query_var('page');
					} else {
				    $paged = 1;
					}

				query_posts( $query_string . '&cat=' . $id . '&orderby=' . $orderby_query . '&order=' . $order_query . '&paged=' . $paged );

				?>

				<?php /* Start the Loop */ ?>
				<div id="blog-entry">

					<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
						<?php
						$format = get_post_format();

						if ( false === $format ) {
							get_template_part( 'content', 'standard' ); 
						} else {	
							get_template_part( 'content', get_post_format() ); 
						}
						?>

						
						<?php endwhile; ?>
					<?php endif; ?>
				</div> <!-- .blog-entry -->
			<div class="clear"></div>

		</div> <!-- .span12 -->

		<?php if( ($home_columns == '2 Columns + Sidebar') or ($home_columns == '3 Columns + Sidebar') or ($home_columns == '1 Column + Sidebar') ) : ?>
			<!-- START SIDEBAR -->
			<?php if ( is_active_sidebar( 'ct_home_sidebar' ) ) : ?>
				<?php if ( $home_sidebar == 'Right' ) : ?>
				<div id="secondary" class="widget-area span4" role="complementary">
				<?php else : ?>
				<div id="secondary" class="widget-area span4 pull-left" role="complementary">
				<?php endif; // $home_sidebar ?>
					<?php dynamic_sidebar( 'ct_home_sidebar' ); ?>
				</div> <!-- .span4 -->
			<?php endif; ?>
			<!-- END SIDEBAR -->
		<?php endif; ?>

	</div> <!-- .row-fluid -->
</div> <!-- .content -->

<!-- START PAGINATION -->
		<div class="container-pagination clearfix">
			<div class="container">
					<div class="row-fluid">
						
							<!-- Begin Navigation -->
							<?php if (function_exists("ct_pagination")) {
								ct_pagination();
							} ?>
							<!-- End Navigation -->
						
					</div> <!-- .row-fluid -->
			</div> <!-- .container -->
		</div> <!-- .container-pagination -->

<?php
// Restor original Query & Post Data
wp_reset_query();
wp_reset_postdata();
?>

<?php get_footer(); ?>