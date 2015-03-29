<?php
/*
-----------------------------------------------------------------------------------

 	Plugin Name: CT Custom Menu Widget
 	Plugin URI: http://www.color-theme.com
 	Description: A widget thats displays your custom menu
 	Version: 1.0
 	Author: ZERGE
 	Author URI:  http://www.color-theme.com
 
-----------------------------------------------------------------------------------
*/


/**
 * Add function to widgets_init that'll load our widget.
 */
add_action('widgets_init', 'CT_load_custom_menu_widgets');

function CT_load_custom_menu_widgets()
{
	register_widget('CT_CustomMenu_Widget');
}


/**
 * Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update. 
 *
 */
class CT_CustomMenu_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */		
	function CT_CustomMenu_Widget() {
		
		/* Widget settings. */
		$widget_ops = array('classname' => 'ct_custommenu_widget', 'description' => __( 'CT: Custom Menu Widget', 'color-theme-framework' ) );

		/* Widget control settings. */
		$control_ops = array( 'width' => 200, 'height' => 350, 'id_base' => 'ct_custommenu_widget' );

		/* Create the widget. */		
		$this->WP_Widget( 'ct_custommenu_widget', 'CT: Custom Menu Widget ', $widget_ops);
	}

	/*-----------------------------------------------------------------------------------*/
	/*	Display Widget
	/*-----------------------------------------------------------------------------------*/
	
	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
		return;

		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
		echo $args['before_title'] . $instance['title'] . $args['after_title'];
		?>
		
		<div class="row-fluid">
			<div class="container">
				<?php wp_nav_menu( array('theme_location' => 'main_menu', 'menu_class' => 'sf-menu add-nav', 'menu' => $nav_menu) ); ?>
			</div> <!-- /container -->	
		</div> <!-- /row-fluid -->

		<?php
		echo $args['after_widget'];
		// After widget (defined by theme functions file)
		
		echo "\n<!-- END FLICKR WIDGET -->\n";
	}


/*-----------------------------------------------------------------------------------*/
/*	Update Widget
/*-----------------------------------------------------------------------------------*/
	
function update( $new_instance, $old_instance ) {
	$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
	$instance['nav_menu'] = (int) $new_instance['nav_menu'];
	return $instance;
}

/*-----------------------------------------------------------------------------------*/
/*	Widget Settings (Displays the widget settings controls on the widget panel)
/*-----------------------------------------------------------------------------------*/
	 
function form( $instance ) {
	$title = isset( $instance['title'] ) ? $instance['title'] : '';
	$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

	// Get menus
	$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

	// If no menus exists, direct the user to go and create some.
	if ( !$menus ) {
	echo '<p>'. sprintf( __('No menus have been created yet. Create some.' , 'color-theme-framework' ), admin_url('nav-menus.php') ) .'</p>';
	return;
	}
	?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' , 'color-theme-framework' ) ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
	</p>
	<p>
	<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e( 'Select Menu:' , 'color-theme-framework' ); ?></label>
	<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
		foreach ( $menus as $menu ) {
			$selected = $nav_menu == $menu->term_id ? ' selected="selected"' : '';
			echo '<option'. $selected .' value="'. $menu->term_id .'">'. $menu->name .'</option>';
		}
		?>
	</select>
	</p>
<?php } }

?>