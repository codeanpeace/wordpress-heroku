<?php
/*
-----------------------------------------------------------------------------------

	Plugin Name: CT Popular Posts Widget
	Plugin URI: http://www.color-theme.com
	Description: A widget that show popular posts( Specified by cat-id ).
	Version: 1.0
	Author: ZERGE
	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/



/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'ct_popular_post_widget' );

function ct_popular_post_widget() {
	register_widget( 'CT_Popular_Post' );
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_Popular_Post extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function  CT_Popular_Post() {
		/* Widget settings. */
		$widget_ops = array(	'classname'		=> 'ct-popularpost-widget',
								'description' => __( 'A widget that show popular posts' , 'color-theme-framework' )
					);

		/* Widget control settings. */
		$control_ops = array(	'width' => 200,
								'height' => 350,
								'id_base' => 'ct-popularpost-widget'
						);

		/* Create the widget. */
		$this->WP_Widget( 'ct-popularpost-widget', __('CT: Popular Posts', 'color-theme-framework'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		
		global $wpdb;
		$time_id = rand();

		/* Our variables from the widget settings. */
		$title = $instance['title'];
		$show_content = isset($instance['show_content']) ? 'true' : 'false';
		$excerpt_length = $instance['excerpt_length'];
		$num_posts = $instance['num_posts'];
		$categories = $instance['categories'];
		$show_image = isset($instance['show_image']) ? 'true' : 'false';
		$show_related = isset($instance['show_related']) ? 'true' : 'false';
		$theme_orderby = $instance['theme_orderby'];
		$show_date = isset($instance['show_date']) ? 'true' : 'false';
		$show_rating = isset($instance['show_rating']) ? 'true' : 'false';

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ){
			echo "\n<!-- START POPULAR POSTS WIDGET -->\n";
			echo $before_title.$title.$after_title;
		} else {
			echo "\n<!-- START POPULAR POSTS WIDGET -->\n";
		}
		?>

		<?php 
		global $post, $ct_data;

		if ( $show_related == 'true' ) { //show related category
			$related_category = get_the_category($post->ID);
			$related_category_id = get_cat_ID( $related_category[0]->cat_name );

			if ($theme_orderby == 'comments') {
				$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'orderby'		=> 'comment_count',
						'cat'			=> $related_category_id, 
						'post__not_in'	=> array( $post->ID ),
						'ignore_sticky_posts'	=> 1
					));
			}
			else if ($theme_orderby == 'likes') {
				$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'orderby'		=> 'meta_value_num',
						'meta_key'		=> 'votes_count',
						'cat'			=> $related_category_id, 
						'post__not_in'	=> array( $post->ID ),
						'ignore_sticky_posts'	=> 1
					));
			}
			else if ($theme_orderby == 'views') {
				$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'orderby'		=> 'meta_value_num',
						'meta_key'		=> 'post_views_count',
						'cat'			=> $related_category_id, 
						'post__not_in'	=> array( $post->ID ),
						'ignore_sticky_posts'	=> 1
					));
				}}
		else {

			if ($theme_orderby == 'comments') {
				$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'cat'			=> $categories,
						'orderby'		=> 'comment_count',
						'ignore_sticky_posts'	=> 1
					));
				}
				else if ($theme_orderby == 'likes') {
					$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'cat'			=> $categories,
						'orderby'		=> 'meta_value_num',
						'meta_key'		=> 'votes_count',
						'ignore_sticky_posts'	=> 1
					));
				}
				else if ($theme_orderby == 'views') {
					$popular_posts = new WP_Query(array(
						'showposts'		=> $num_posts,
						'cat'			=> $categories,
						'orderby'		=> 'meta_value_num',
						'meta_key'		=> 'post_views_count',
						'ignore_sticky_posts'	=> 1
					));
				}
			}
		?>

		<ul class="popular-posts-widget popular-widget-<?php echo $time_id; ?>">
			<?php while($popular_posts->have_posts()): $popular_posts->the_post(); ?>
				<li class="clearfix">
					<?php
					if( $show_image == 'true' ):
						if(has_post_thumbnail()):
							$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-thumb'); 
							if ( $image[1] == 75 && $image[2] == 75 ) : //if has generated thumb ?>
								<div class="widget-post-small-thumb">
									<a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
								</div><!-- widget-post-small-thumb -->
							<?php 
							else : // else use standard 150x150 thumb
								$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail'); ?>
								<div class="widget-post-small-thumb">
									<a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /></a>
								</div><!-- widget-post-small-thumb -->
							<?php
							endif;
						endif; //has_post_thumbnail
					endif; //show_image ?>

					<?php 
						if ( ($show_date == 'true') || ($show_rating == 'true') ) :
					?>
						<div class="meta-widget">
						<?php
							if ( $show_date == 'true' ) {
						?>		
							<!-- <meta itemprop="datePublished" content="<?php //the_time('F j, Y'); ?>"> -->
							<span class="date-widget"><i class="icon-time"></i><?php the_time('F j, Y'); ?></span>					
						<?php } ?>	
						<?php
						if ( $show_rating == 'true' ) {
							$post_type = get_post_meta( $post->ID, 'ct_mb_post_type', true );
							
							if ( $post_type == 'admin_review_post' ) {
								
								if ( $post_type == 'admin_review_post' ) $star = __( 'Rating: ' , 'color-theme-framework' ) . get_post_meta( $post->ID, 'ct_mb_over_score', true );

								$output = '<div class="icon-rating widget-post">';
									$output .= '<span class="icon-star-empty"></span><span class="rating-text">' . $star . '</span>';
								$output .= '</div>';

								if ( $show_date == 'true' ) echo ' / ' . $output; else echo $output;
							} 
						} ?>						
					</div><!-- .meta -->
					<?php endif; ?>

					<div class="post-title">
						<h5><a href='<?php the_permalink(); ?>' title='<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>'><?php the_title(); ?></a></h5>
					</div><!-- post-title -->

					<?php 									
						if ( $show_content == 'true' ) ct_excerpt_max_charlength( $excerpt_length ); 
					?>

				</li>	
			<?php endwhile; ?>
		</ul>

		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
		echo "\n<!-- END POPULAR POSTS WIDGET -->\n";

		// Restor original Query & Post Data
		wp_reset_query();
		wp_reset_postdata();
		}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['show_content'] = $new_instance['show_content'];
		$instance['excerpt_length'] = $new_instance['excerpt_length'];
		$instance['num_posts'] = $new_instance['num_posts'];
		$instance['categories'] = $new_instance['categories'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_related'] = $new_instance['show_related'];
		$instance['theme_orderby'] = $new_instance['theme_orderby'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_rating'] = $new_instance['show_rating'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form($instance)
	{
		/* Set up some default widget settings. */
		$defaults = array(	'title'			=> __( 'Most Popular' , 'color-theme-framework' ),
							'show_content'	=> 'on',
							'excerpt_length' => 120,
							'num_posts'		=> 4,
							'categories'	=> 'all',
							'show_related'	=> 'off',
							'show_image'	=> 'on',
							'show_date'		=> 'on',
							'show_rating'		=> 'on',
							'theme_orderby'	=> 'comments'
					);

		$instance = wp_parse_args((array) $instance, $defaults); ?>
	
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_content'], 'on'); ?> id="<?php echo $this->get_field_id('show_content'); ?>" name="<?php echo $this->get_field_name('show_content'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e( 'Show content' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e( 'Excerpt length:' , 'color-theme-framework' ) ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" value="<?php echo $instance['excerpt_length']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('num_posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('num_posts'); ?>" name="<?php echo $this->get_field_name('num_posts'); ?>" value="<?php echo $instance['num_posts']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo $this->get_field_id('show_related'); ?>" name="<?php echo $this->get_field_name('show_related'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_related'); ?>"><?php _e( 'Show related category posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_image'], 'on'); ?> id="<?php echo $this->get_field_id('show_image'); ?>" name="<?php echo $this->get_field_name('show_image'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e( 'Show thumbnail image' , 'color-theme-framework' ); ?></label>
		</p>

		<p style="margin-top: 20px;">
			<label style="font-weight: bold;"><?php _e( 'Post meta info' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_date'], 'on'); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_date'); ?>"><?php _e( 'Show date' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_rating'], 'on'); ?> id="<?php echo $this->get_field_id('show_rating'); ?>" name="<?php echo $this->get_field_name('show_rating'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_rating'); ?>"><?php _e( 'Show rating' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'theme_orderby' ); ?>"><?php _e('Order by:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'theme_orderby' ); ?>" name="<?php echo $this->get_field_name( 'theme_orderby' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'comments' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>comments</option>
				<option <?php if ( 'likes' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>likes</option>
				<option <?php if ( 'views' == $instance['theme_orderby'] ) echo 'selected="selected"'; ?>>views</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat categories" style="width:100%;">
				<option value='all' <?php if ( 'all' == $instance['categories'] ) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories( 'hide_empty=0&depth=1&type=post' ); ?>
				<?php foreach( $categories as $category ) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
	<?php 
	}
}

?>