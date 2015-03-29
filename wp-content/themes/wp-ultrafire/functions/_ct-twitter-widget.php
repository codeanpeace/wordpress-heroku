<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Twitter Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget that displays messages from twitter.com
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


// Add function to widgets_init that'll load our widget
add_action( 'widgets_init', 'CT_twitter_load_widgets' );

// Register widget
function CT_twitter_load_widgets() {
	register_widget( 'CT_Twitter_Widget' );
}

// Widget class
class CT_Twitter_Widget extends WP_Widget {


/*-----------------------------------------------------------------------------------*/
/*	Widget Setup
/*-----------------------------------------------------------------------------------*/
	
function CT_Twitter_Widget() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'ct_twitter_widget' , 'description' => __( 'Twitter Widget' , 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_twitter_widget' );
		
		/* Create the widget. */
		$this->WP_Widget('ct_twitter_widget', __( 'CT: Twitter Widget' , 'color-theme-framework' ) , $widget_ops, $control_ops );
	
}


/*-----------------------------------------------------------------------------------*/
/*	Display Widget
/*-----------------------------------------------------------------------------------*/
	
function widget( $args, $instance ) {
	extract( $args );

	if ( !is_admin() ) {
		/* Twitter */
		wp_register_script('jquery-tweet',get_template_directory_uri().'/js/jquery.tweet.js',false, null , true);
		wp_enqueue_script('jquery-tweet',array('jquery'));
	}

	// Our variables from the widget settings
	$title = apply_filters('widget_title', $instance['title'] );
	$user_name = $instance['user_name'];
	$show_avatar = isset($instance['show_avatar']) ? 'true' : 'false';
	$count_message = $instance['count_message'];	

	/* Before widget (defined by themes). */
	echo $before_widget;

	/* Display the widget title if one was input (before and after defined by themes). */
	if ( $title ){
		echo "\n<!-- START TWITTER WIDGET -->\n";
		echo $before_title.$title.$after_title;
	} else {
		echo "\n<!-- START TWITTER WIDGET -->\n";
	}


	// Display widget
	$time_id = rand();	
	?>

	<script type="text/javascript">
	/* <![CDATA[ */
	jQuery.noConflict()(function($){
		$(document).ready(function() {

			$(".tweet-<?php echo $time_id; ?>").tweet({
				count: <?php echo $count_message; ?>,
				username: "<?php echo $instance['user_name']; ?>",
				loading_text: "     loading feed..."
				<?php if ( $show_avatar == 'true' ) echo ',avatar_size: 32'; ?>
			});
		});
	});
	/* ]]> */
	</script>		

	<div class="tweet tweet-<?php echo $time_id; ?>"></div>
	
	<?php

	// After widget (defined by theme functions file)
	echo $after_widget;
	echo "\n<!-- END TWITTER WIDGET -->\n";
}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance = $old_instance;

	// Strip tags to remove HTML (important for text inputs)
	$instance['title'] = strip_tags( $new_instance['title'] );
	
	// Stripslashes for html inputs
	$instance['user_name'] = stripslashes( $new_instance['user_name']);
	$instance['count_message'] = stripslashes( $new_instance['count_message']);	
	$instance['show_avatar'] = $new_instance['show_avatar'];
	$instance['show_meta'] = $new_instance['show_meta'];

	return $instance;
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {

	// Set up some default widget settings
	$defaults = array( 
		'title' => __( 'Latest Tweets' , 'color-theme-framework' ), 
		'user_name' => 'envato', 
		'count_message' => '3',
		'show_avatar'=>'off'
	);
	
	$instance = wp_parse_args((array) $instance, $defaults); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'color-theme-framework' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
	</p>

	<p>
		<input class="checkbox" type="checkbox" <?php checked($instance['show_avatar'], 'on'); ?> id="<?php echo $this->get_field_id('show_avatar'); ?>" name="<?php echo $this->get_field_name('show_avatar'); ?>" /> 
		<label for="<?php echo $this->get_field_id('show_avatar'); ?>"><?php _e( 'Show avatar' , 'color-theme-framework' ); ?></label>
	</p>

	<!-- User Name For Twitter Service Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'user_name' ); ?>"><?php _e( 'User Name:' , 'color-theme-framework'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'user_name' ); ?>" name="<?php echo $this->get_field_name( 'user_name' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['user_name'] ), ENT_QUOTES)); ?>" />
	</p>

	<!-- Count Messages: Text Input -->
	<p>
		<label for="<?php echo $this->get_field_id( 'count_message' ); ?>"><?php _e( 'Number of Tweets:' , 'color-theme-framework' ); ?></label>
		<input type="number" min="1" max="30" class="widefat" id="<?php echo $this->get_field_id( 'count_message' ); ?>" name="<?php echo $this->get_field_name( 'count_message' ); ?>" value="<?php echo stripslashes(htmlspecialchars(( $instance['count_message'] ), ENT_QUOTES)); ?>" />
	</p>
	<?php
	}
}
?>