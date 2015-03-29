<?php
/*
-----------------------------------------------------------------------------------

	Plugin Name: CT Carousel Widget
	Plugin URI: http://www.color-theme.com
	Description: A widget that show carousel with latest posts.
	Version: 1.0
	Author: ZERGE
	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init','CT_carousel_load_widgets');

function CT_carousel_load_widgets(){
		register_widget("CT_carousel_Widget");
}

/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_carousel_Widget extends WP_widget{

	/**
	 * Widget setup.
	 */	
	function CT_carousel_Widget(){
		
		/* Widget settings. */	
		$widget_ops = array( 'classname' => 'ct_carousel_widget', 'description' => __( 'Carousel widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_carousel_widget' );
		
		/* Create the widget. */
		$this->WP_Widget( 'ct_carousel_widget', __( 'CT: Carousel Widget' , 'color-theme-framework' ) ,  $widget_ops, $control_ops );
		
	}
	
	function widget($args,$instance){
		extract($args);
		
		/*$title = $instance['title'];*/
		$categories = $instance['categories'];
		$posts = $instance['posts'];
		$show_category = isset($instance['show_category']) ? 'true' : 'false';
		$slideshow = isset($instance['slideshow']) ? 'true' : 'false';
		$show_related = isset($instance['show_related']) ? 'true' : 'false';
		$show_random = isset($instance['show_random']) ? 'true' : 'false';				
		$widget_width = $instance['widget_width'];
		?>

		<?php
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
/*		if ( $title ){
			echo "\n<!-- START CAROUSEL WIDGET -->\n";
			echo $before_title.$title.$after_title;
		} else {
			echo "\n<!-- START CAROUSEL WIDGET -->\n";
		}
*/		?>
		
<?php
	global  $ct_options, $post;
	$time_id = rand();
	$orderby = 'date';
	$extra_class = '';
	
	if ( $show_random == 'true' ) { $orderby = 'rand'; }

	if ( $show_related == 'true' and !is_author() ) :
	  $related_category = get_the_category($post->ID);
	  $related_category_id = get_cat_ID( $related_category[0]->cat_name );			
	  $recent_posts = new WP_Query(array(	'orderby'			=> $orderby,
	  										'showposts'			=> $posts,
	  										'post_type'			=> 'post',
	  										'cat'				=> $related_category_id,
	  										'post__not_in'		=> array( $post->ID ),
	  										'ignore_sticky_posts' => 1
	  									)
	  								);
	else :
	  $recent_posts = new WP_Query(array(	'orderby'			=> $orderby,
	  										'showposts'			=> $posts,
	  										'post_type'			=> 'post',
	  										'cat'				=> $categories,
	  										'ignore_sticky_posts' => 1
	  									)
									);
	endif; 

	if (!$recent_posts->have_posts()) : // not related post were found, display recent posts
		$recent_posts = new WP_Query(array(	'orderby'			=> $orderby,
	  										'showposts'			=> $posts,
	  										'post_type'			=> 'post',
	  										'cat'				=> $categories,
	  										'ignore_sticky_posts' => 1
	  									)
									);
		$extra_class = 'ct-no-related-posts';
	endif;


	if ( !is_admin() ) {
		/* Flex Slider */
		wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
		wp_enqueue_script('flex-min-jquery',array('jquery'));
	}

	$maxitems = 8;
	if ( $widget_width == 'Full' ) $maxitems = 8; else $maxitems = 4;
?>


<?php if ($recent_posts->have_posts()) : ?>
<script type="text/javascript">
/* <![CDATA[ */
jQuery.noConflict()(function($){
	$(document).ready(function() {
		
		$('#carousel-<?php echo $time_id; ?>').flexslider({
			animation: "slide",
			animationLoop: true,
			itemWidth: 285,
			itemMargin: 0,
			minItems: 2,
			maxItems: <?php echo $maxitems; ?>,
			slideshow: <?php echo $slideshow; ?>,
			controlNav: false
  		});

	});
});
/* ]]> */
</script>
<?php if ( $widget_width == 'Boxed') echo '<div class="container">'; ?>
<div id="carousel-<?php echo $time_id; ?>" class="flexslider flex-carousel <?php echo $extra_class?>">
	<ul class="slides">
		<?php
		global $post;		
		while($recent_posts->have_posts()): $recent_posts->the_post(); 
		?>

		<?php if( has_post_thumbnail() ): ?>

		<li>
			<div class="carousel-thumb">
			<div class="bg-mask"></div>
			<?php 
				$category = get_the_category(); 
				$category_id = get_cat_ID( $category[0]->cat_name ); 
				$category_link = get_category_link( $category_id ); 

				if ( $show_category == 'true' ) {
			?>
			  <span class="category-item">
			  	<?php if ( is_rtl() ) : ?>
					<a href="<?php echo esc_url( $category_link ); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo __('View All Posts', 'color-theme-framework'); ?>"><?php echo $category[0]->cat_name; ?></a>
				<?php else : ?>
					<a href="<?php echo esc_url( $category_link ); ?>" data-toggle="tooltip" data-placement="right" title="<?php echo __('View All Posts', 'color-theme-framework'); ?>"><?php echo $category[0]->cat_name; ?></a>
				<?php endif; ?>
			  </span>
			<?php } ?>  


			<?php ct_get_rating_type_stars(); ?>
				
			<?php $carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'carousel-thumb'); 
			
			if ( $carousel_image_url[1] == 285 && $carousel_image_url[2] == 190 ) { ?>	      
				<a href="<?php the_permalink(); ?>"><img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
			<?php } else { 
				$carousel_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');?>
				<a href="<?php the_permalink(); ?>"><img src="<?php echo $carousel_image_url[0]; ?>" alt="<?php the_title(); ?>" /></a>
			<?php } ?>

			<?php if ( has_post_format ( 'video' ) ) {
				$video_type = get_post_meta( $post->ID, 'ct_mb_post_video_type', true );
				$perma_link = get_permalink($post->ID);

				if ( $video_type == 'youtube' ) {
					echo '<div class="video icon-video youtube"><a href="' . $perma_link . '" data-toggle="tooltip" data-placement="top" title="'. __('Watch Youtube Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
				}
				else if ( $video_type == 'vimeo' ) {
					echo '<div class="video icon-video vimeo"><a href="' . $perma_link . '" data-toggle="tooltip" data-placement="top" title="'. __('Watch Vimeo Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
				}
				  elseif ( $video_type == 'dailymotion' ) {
					echo '<div class="video icon-video dailymotion"><a href="' . $perma_link . '" data-toggle="tooltip" data-placement="top" title="'. __('Watch DailyMotion Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
				  } 
				?>
			<?php } // has_post_format ?>
		
			<?php ct_get_date_title(); ?>		
		  </div><!-- /carousel-thumb -->
		  
		</li>
<?php endif; ?>
	<?php endwhile; ?>

	  </ul>
	</div> <!-- /flexslider -->
	<?php else : echo __('No posts were found for display','color-theme-framework');
	endif; ?>
<?php if ( $widget_width == 'Boxed') echo '</div>'; ?>
		<?php
		
		// Restor original Query & Post Data
		wp_reset_query();
		wp_reset_postdata();
		

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */		
	function update($new_instance, $old_instance){
		$instance = $old_instance;

		/*$instance['title'] = $new_instance['title'];*/
		$instance['categories'] = $new_instance['categories'];
		$instance['posts'] = $new_instance['posts'];
		$instance['slideshow'] = $new_instance['slideshow'];
		$instance['show_category'] = $new_instance['show_category'];
		$instance['show_related'] = $new_instance['show_related'];
		$instance['show_random'] = $new_instance['show_random'];
		$instance['widget_width'] = $new_instance['widget_width'];

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
				/*'title' => __( '', 'color-theme-framework' ), */
				'slideshow' => 'off', 
				'categories' => 'all', 
				'show_category' => 'on', 
				'posts' => '10', 
				'show_related' => 'off', 
				'show_random' => 'off',
				'widget_width' => 'Full'
			);
				
			$instance = wp_parse_args((array) $instance, $defaults); ?>

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

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_category'], 'on'); ?> id="<?php echo $this->get_field_id('show_category'); ?>" name="<?php echo $this->get_field_name('show_category'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_category'); ?>"><?php _e( 'Show Post Category' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_related'], 'on'); ?> id="<?php echo $this->get_field_id('show_related'); ?>" name="<?php echo $this->get_field_name('show_related'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_related'); ?>"><?php _e( 'Show related category posts' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_random'], 'on'); ?> id="<?php echo $this->get_field_id('show_random'); ?>" name="<?php echo $this->get_field_name('show_random'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_random'); ?>"><?php _e( 'Random order' , 'color-theme-framework' ); ?></label>
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['slideshow'], 'on'); ?> id="<?php echo $this->get_field_id('slideshow'); ?>" name="<?php echo $this->get_field_name('slideshow'); ?>" /> 
			<label for="<?php echo $this->get_field_id('slideshow'); ?>"><?php _e( 'Animate carousel automatically' , 'color-theme-framework' ); ?></label>
		</p>
				
		<p>
			<label for="<?php echo $this->get_field_id('posts'); ?>"><?php _e( 'Number of posts:' , 'color-theme-framework' ); ?></label>
			<input type="number" min="1" max="100" class="widefat" id="<?php echo $this->get_field_id('posts'); ?>" name="<?php echo $this->get_field_name('posts'); ?>" value="<?php echo $instance['posts']; ?>" />
			
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'widget_width' ); ?>"><?php _e('Widget Width:', 'color-theme-framework'); ?></label> 
			<select id="<?php echo $this->get_field_id( 'widget_width' ); ?>" name="<?php echo $this->get_field_name( 'widget_width' ); ?>" class="widefat" style="width:100%;">
				<option <?php if ( 'Full' == $instance['widget_width'] ) echo 'selected="selected"'; ?>>Full</option>
				<option <?php if ( 'Boxed' == $instance['widget_width'] ) echo 'selected="selected"'; ?>>Boxed</option>				
			</select>
		</p>		

		<?php

	}
}
?>