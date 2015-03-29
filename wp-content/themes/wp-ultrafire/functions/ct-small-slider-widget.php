<?php
/*
-----------------------------------------------------------------------------------

	Plugin Name: CT Small Flex Slider Widget
	Plugin URI: http://www.color-theme.com
	Description: A widget that show slider with latest posts.
	Version: 1.0
	Author: ZERGE
	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */

add_action('widgets_init','CT_small_slider_load_widgets');

function CT_small_slider_load_widgets(){
		register_widget("CT_small_slider_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_small_slider_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_small_slider_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array(	'classname'		=> 'ct_small_slider_widget',
								'description'	=> __( 'Small Flex Slider widget' , 'color-theme-framework' )
					);

		/* Widget control settings. */
		$control_ops = array(	'width'		=> 200,
								'height'	=> 350,
								'id_base'	=> 'ct_small_slider_widget'
					);
		
		/* Create the widget. */
		$this->WP_Widget( 'ct_small_slider_widget', __( 'CT: Small Slider Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
	}
	
	function widget($args,$instance){
		extract($args);

		global $ct_data, $post;

		$title = $instance['title'];
		$show_content = isset($instance['show_content']) ? 'true' : 'false';
		$excerpt_length = $instance['excerpt_length'];
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$show_date = isset($instance['show_date']) ? 'true' : 'false';
		$show_rating = isset($instance['show_rating']) ? 'true' : 'false';
		$show_related = isset($instance['show_related']) ? 'true' : 'false';
		$show_random = isset($instance['show_random']) ? 'true' : 'false';
		$animation_speed = $instance['animation_speed'];
		$slideshow_speed = $instance['slideshow_speed'];
		$slideshow = isset($instance['slideshow']) ? 'true' : 'false';
		$animation_type = $instance['animation_type'];
		?>

		<?php

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ){
			echo "\n<!-- START SMALL SLIDER WIDGET -->\n";
			echo $before_title.$title.$after_title;
		} else {
			echo "\n<!-- START SMALL SLIDER WIDGET -->\n";
		}
		?>
		
		<?php
		$time_id = rand();
		$orderby = 'date';
		if ( $show_random == 'true' ) { $orderby = 'rand'; }

		if ( $show_related == 'true' ) { //show related category
			$related_category = get_the_category($post->ID);
			$related_category_id = get_cat_ID( $related_category[0]->cat_name );
			$slider_posts = new WP_Query(array(
				'orderby'		=> $orderby,
				'showposts'		=> $posts,
				'post_type'		=> 'post',
				'cat'			=> $related_category_id,
				'post__not_in'	=> array( $post->ID ),
				'ignore_sticky_posts'	=> 1
			));
		}

		else {	
			$slider_posts = new WP_Query(array(
				'orderby'		=> $orderby,
				'showposts'		=> $posts,
				'post_type'		=> 'post',
				'cat'			=> $categories,
				'ignore_sticky_posts'	=> 1
			));
		}


	if ( !is_admin() ) {
		/* Flex Slider */
		wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
		wp_enqueue_script('flex-min-jquery',array('jquery'));
	}

		if ( $slider_posts->have_posts() ) : ?>

		<script type="text/javascript">
		/* <![CDATA[ */
		jQuery.noConflict()(function($){
			$(window).load(function() {

				$(".slider-preloader").css("display","none");

				$('#slider-<?php echo $time_id; ?>').flexslider({
					animation: "<?php echo $animation_type; ?>",
					controlNav: false,
					animationLoop: true,
					slideshow: <?php echo $slideshow; ?>,
					smoothHeight: true,
					slideshowSpeed: <?php echo $slideshow_speed; ?>,
					animationSpeed: <?php echo $animation_speed; ?>,
				});
			});
		});
		/* ]]> */
		</script>

		<div id="slider-<?php echo $time_id; ?>" class="small-slider flex-main flexslider">
			<ul class="slides">

			<?php while($slider_posts->have_posts()): $slider_posts->the_post(); ?>
				<?php if( has_post_thumbnail() ): 
					$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog-thumb-crop'); ?>
					<li>					
						<a href="<?php the_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="" /></a>
						<!-- title -->

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

						<h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to ','color-theme-framework'); the_title(); ?>"><?php the_title(); ?></a></h5>


						
					<?php 	
						if ( $show_content == 'true' ) ct_excerpt_max_charlength( $excerpt_length ); 
					?>
						
					</li>
				<?php endif; ?>
			<?php endwhile; ?>

			</ul><!-- slides -->
		</div><!-- slider -->
		
		<?php
		else :
			echo __( 'No related posts were found','color-theme-framework' );
		endif;

		// Restor original Query & Post Data
		wp_reset_query();
		wp_reset_postdata();


		/* After widget (defined by themes). */
		echo $after_widget;
		echo "\n<!-- END SMALL SLIDER WIDGET -->\n";
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['show_content'] = $new_instance['show_content'];
		$instance['excerpt_length'] = $new_instance['excerpt_length'];
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['show_date'] = $new_instance['show_date'];
		$instance['show_rating'] = $new_instance['show_rating'];
		$instance['show_related'] = $new_instance['show_related'];
		$instance['show_random'] = $new_instance['show_random'];
		$instance['animation_speed'] = $new_instance['animation_speed'];
		$instance['slideshow_speed'] = $new_instance['slideshow_speed'];
		$instance['slideshow'] = $new_instance['slideshow'];
		$instance['animation_type'] = $new_instance['animation_type'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */	
	function form($instance){
		?>
		<?php
			$defaults = array( 
				'title'				=> __( 'Featured Slider', 'color-theme-framework' ), 
				'show_content'		=> 'on',
				'excerpt_length'	=> 120,
				'slideshow'			=> 'off', 
				'categories'		=> 'all', 
				'posts'				=> '5',
				'show_date'			=> 'off',
				'show_rating'			=> 'off',
				'show_related'		=> 'off',
				'show_random'		=> 'off',
				'animation_speed'	=> '600',
				'slideshow_speed'	=> '7000',
				'animation_type'	=> 'slide'
			);
				
			$instance = wp_parse_args((array) $instance, $defaults); ?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_content'], 'on'); ?> id="<?php echo $this->get_field_id('show_content'); ?>" name="<?php echo $this->get_field_name('show_content'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e( 'Show content' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('excerpt_length'); ?>"><?php _e( 'Excerpt length:' , 'color-theme-framework' ); ?></label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('excerpt_length'); ?>" name="<?php echo $this->get_field_name('excerpt_length'); ?>" value="<?php echo $instance['excerpt_length']; ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['slideshow'], 'on'); ?> id="<?php echo $this->get_field_id('slideshow'); ?>" name="<?php echo $this->get_field_name('slideshow'); ?>" /> 
			<label for="<?php echo $this->get_field_id('slideshow'); ?>"><?php _e( 'Animate slider automatically' , 'color-theme-framework' ); ?></label>
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
			<input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo $this->get_field_id('show_related'); ?>" name="<?php echo $this->get_field_name('show_related'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_related'); ?>"><?php _e( 'Show related category posts (for posts, category pages, etc.)' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_random'], 'on'); ?> id="<?php echo $this->get_field_id('show_random'); ?>" name="<?php echo $this->get_field_name('show_random'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_random'); ?>"><?php _e( 'Random order' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('slideshow_speed'); ?>"><?php _e( 'Slideshow speed, in millisec:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100000" class="widefat" id="<?php echo $this->get_field_id('slideshow_speed'); ?>" name="<?php echo $this->get_field_name('slideshow_speed'); ?>" value="<?php echo $instance['slideshow_speed']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('animation_speed'); ?>"><?php _e( 'Animation speed, in millisec:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100000"class="widefat" id="<?php echo $this->get_field_id('animation_speed'); ?>" name="<?php echo $this->get_field_name('animation_speed'); ?>" value="<?php echo $instance['animation_speed']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'animation_type' ); ?>"><?php _e('Animation type:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'animation_type' ); ?>" name="<?php echo $this->get_field_name( 'animation_type' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'fade' == $instance['animation_type'] ) echo 'selected="selected"'; ?>>fade</option>
				<option <?php if ( 'slide' == $instance['animation_type'] ) echo 'selected="selected"'; ?>>slide</option>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e( 'Filter by Category:' , 'color-theme-framework' ); ?></label> 
			<select id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>" class="widefat" style="width:100%;">
				<option value='all' <?php if ('all' == $instance['categories']) echo 'selected="selected"'; ?>>all categories</option>
				<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
				<?php foreach($categories as $category) { ?>
				<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['categories']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<?php

	}
}
?>