<?php

/*-----------------------------------------------------------------------------------*/
/* Slightly Modified Options Framework
/*-----------------------------------------------------------------------------------*/
require_once ('admin/index.php');


/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers the various WordPress features that
 * Theme supports.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_theme_setup' ) ) {	
	function ct_theme_setup(){

		// Makes theme available for translation.
		load_theme_textdomain( 'color-theme-framework', get_template_directory() . '/languages' );

		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );

		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions

		register_nav_menus(
			array(
				'main_menu' => __( 'main navigation' , 'color-theme-framework' )
				//'bottom_menu' => __( 'bottom navigation' , 'color-theme-framework' )
			)
		);

		// This automatically adds the relevant feed links everywhere on the whole site.
		add_theme_support( 'automatic-feed-links' );

		// Registers a new image sizes.
		add_image_size( 'blog-thumb', 370, 9999 ); //303 pixels wide (and unlimited height)
		add_image_size( 'blog-thumb-crop', 370, 208, true ); //303 pixels crop
		add_image_size( 'single-post-thumb', 770, 9999 ); //653 pixels wide (and unlimited height)
		add_image_size( 'single-post-thumb-crop', 770, 514, true ); //cropped single
		add_image_size( 'carousel-thumb', 285, 190, true ); // carousel thumbnail
		add_image_size( 'small-thumb', 50, 50, true ); // small thumbnail
		
	}
}
add_action('after_setup_theme', 'ct_theme_setup');



/**
*	-------------------------------------------------------------------------------------------------------
*	TGM Plugin Activation
*	-------------------------------------------------------------------------------------------------------
*/
require_once('includes/class-tgm-plugin-activation.php');
add_action('tgmpa_register', 'ct_register_required_plugins');

function ct_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'Ajax Thumbnail Rebuild', // The plugin name
			'slug'     				=> 'ajax-thumbnail-rebuild', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/includes/plugins/ajax-thumbnail-rebuild.1.08.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/includes/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)	
	);

	// Change this to your theme text domain, used for internationalising strings
	//$theme_text_domain = 'color-theme-framework';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> 'color-theme-framework',         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', 'color-theme-framework' ),
			'menu_title'                       			=> __( 'Install Plugins', 'color-theme-framework' ),
			'installing'                       			=> __( 'Installing Plugin: %s', 'color-theme-framework' ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'color-theme-framework' ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', 'color-theme-framework' ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'color-theme-framework' ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'color-theme-framework' ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa($plugins, $config);
}



/*-----------------------------------------------------------------------------------*/
/* Show Post Content in Box
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_show_content_excerpt' ) ) {
	function ct_show_content_excerpt() {
		global $post, $ct_options;

		$mb_excerpt_lenght = get_post_meta( $post->ID, 'ct_mb_excerpt_lenght', true);
		$admin_excerpt = stripslashes( $ct_options['ct_excerpt_lenght'] );

		// if not set, set variables to their defaults
		if ( $mb_excerpt_lenght == '' ) $mb_excerpt_lenght = '0';

			$show_content = stripslashes( $ct_options['ct_show_content'] );
			$content_type = stripslashes( $ct_options['ct_excerpt_function'] );
		
			if ( $show_content == 1 ) :
				?>
					<div class="entry-content" itemprop="articleBody">				
						<?php 
							if ( $content_type == 'Excerpt' ) {
								if ( $mb_excerpt_lenght != '0' )
									ct_excerpt_max_charlength($mb_excerpt_lenght); 
								else
									ct_excerpt_max_charlength($admin_excerpt); 
							} else {
								$readmore = stripslashes( $ct_options['ct_readmore_text'] );
								if ( $readmore == '' ) $readmore = 'Continue reading &rarr;';
								the_content( $readmore, false, '');

							}		
						?>
					</div> <!-- /entry-content -->		
			<?php	
			endif;	
	}
}

/*-----------------------------------------------------------------------------------*/
/* Show Post Content in Box Without Featured Image
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_show_content_excerpt_featured' ) ) {
	function ct_show_content_excerpt_featured() {
		global $post, $ct_options;

		$mb_excerpt_lenght = get_post_meta( $post->ID, 'ct_mb_excerpt_lenght', true);
		$admin_excerpt = stripslashes( $ct_options['ct_excerpt_lenght'] );

		// if not set, set variables to their defaults
		if ( $mb_excerpt_lenght == '' ) $mb_excerpt_lenght = '0';

			$show_content = stripslashes( $ct_options['ct_show_content'] );
			$content_type = stripslashes( $ct_options['ct_excerpt_function'] );
		
			if ( $show_content == 1 ) :
							if ( $content_type == 'Excerpt' ) {
								if ( $mb_excerpt_lenght != '0' )
									ct_excerpt_max_charlength($mb_excerpt_lenght); 
								else
									ct_excerpt_max_charlength($admin_excerpt); 
							} else {
								$readmore = stripslashes( $ct_options['ct_readmore_text'] );
								if ( $readmore == '' ) $readmore = 'Continue reading &rarr;';
								the_content( $readmore, false, '');

							}		
			endif;	
	}
}


/*-----------------------------------------------------------------------------------*/
/* Convert Hex Color to RGB
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_hex2rgb' ) ) {
	function ct_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}
}


/*
*	-------------------------------------------------------------------------------------------------------
*	Exclude pages from search, if value set in theme options
*	-------------------------------------------------------------------------------------------------------
*/


if ( !function_exists( 'ct_search_filter_page' ) ) {
	function ct_search_filter_page( $query ) {
			global $ct_options;
		
		$exclude_page = stripslashes( $ct_options['ct_exclude_search_page'] );
		
		if ( $exclude_page == 1 ) {
			if ($query->is_search) {
				$query->set('post_type',  array( 'post' ));
			}
		}	
		return $query;
	}
}	
add_filter('pre_get_posts','ct_search_filter_page'); 


/*-----------------------------------------------------------------------------------*/
/* Sticky Menu
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_sticky_menu' ) ) {
	function ct_sticky_menu() {
		global $ct_options;
		$sticky_menu = stripslashes( $ct_options['ct_sticky_menu'] );
		$header_background = stripslashes( $ct_options['ct_header_background'] );

		$rgb = ct_hex2rgb($header_background);
		$rgba = "rgba(" . $rgb[0] . "," . $rgb[1] . "," . $rgb[2] . "," . "0.9)";

		if ( $sticky_menu ) { ?>
			<script type="text/javascript">
			/* <![CDATA[ */
				jQuery.noConflict()(function($){
					$(document).ready(function(){
						var sticky_navigation_offset_top = $('#header').offset().top;
						var sticky_navigation = function(){
							var scroll_top = $(window).scrollTop(); // our current vertical position from the top
							var menuheight = $('#header').height();

							if (scroll_top > sticky_navigation_offset_top) { 
								<?php if ( !is_admin_bar_showing() ) : ?>
									$('#header').css({ 'background': '<?php echo $rgba; ?>',  'position': 'fixed', 'top':0, 'left':0, 'width':'100%', 'z-index':9999, 'box-shadow':'1px 2px 3px rgba(0,0,0,.3)' });
									$('body').css({ 'padding-top': menuheight });
								<?php else : ?>
									$('#header').css({ 'background': '<?php echo $rgba; ?>',  'position': 'fixed', 'top':28, 'left':0, 'width':'100%', 'z-index':9999, 'box-shadow':'1px 2px 3px rgba(0,0,0,.3)' });
									$('body').css({ 'padding-top': menuheight });
								<?php endif; ?>
							} else {
								$('#header').css({ 'top':0, 'position': 'relative','padding-top':0, 'box-shadow':'none', 'box-shadow':'1px 2px 3px rgba(0,0,0,.3)', 'background': '<?php echo $header_background; ?>'}); 
								$('body').css({ 'padding-top': 0 });
							}
						};

						// run our function on load
						sticky_navigation();

						// and run it again every time you scroll
						$(window).scroll(function() {
							sticky_navigation();
						});
					});
				});
			/* ]]> */   
			</script>
		<?php
		}
	}
	add_action('wp_footer', 'ct_sticky_menu');
}


/*
*	-------------------------------------------------------------------------------------------------------
*	Add Google Analytics
*	-------------------------------------------------------------------------------------------------------
*/

if ( ! function_exists ( 'ct_func_google' ) ) {
	function ct_func_google() {
		global $ct_options;
		echo stripslashes ( $ct_options['ct_google_analytics'] );
	}
}

add_action('wp_footer', 'ct_func_google');



/*-----------------------------------------------------------------------------------*/
/* Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_wp_title' ) ) {
	function ct_wp_title( $title, $sep ) {
		global $paged, $page;

		if ( is_feed() )
			return $title;

		// Add the site name.
		$title .= get_bloginfo( 'name' );

		// Add the site description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			$title = "$title $sep $site_description";

		// Add a page number if necessary.
		if ( $paged >= 2 || $page >= 2 )
			$title = "$title $sep " . sprintf( __( 'Page %s', 'color-theme-framework' ), max( $paged, $page ) );

		return $title;
	}
	add_filter( 'wp_title', 'ct_wp_title', 10, 2 );
}


/*-----------------------------------------------------------------------------------*/
/* Registers our theme widget areas and sidebars
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_widgets_init' ) ) {
function ct_widgets_init() {
	register_sidebar(array(
		'name' => 'Homepage Top',
		'id' => 'ct_home_top',
		'description' => __( 'Appears on the top of Homepage', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Homepage Sidebar',
		'id' => 'ct_home_sidebar',
		'description' => __( 'Appears on the Homepage', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="after-widget-title"></div>',
	));

	register_sidebar(array(
		'name' => 'Single Post Sidebar',
		'id' => 'ct_single_sidebar',
		'description' => __( 'Appears on the Single post page', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="after-widget-title"></div>',
	));

	register_sidebar(array(
		'name' => 'Single Post Top',
		'id' => 'ct_single_top',
		'description' => __( 'Appears on the Single post page (very top)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Category Page Top',
		'id' => 'ct_category_top',
		'description' => __( 'Appears on the Category page (very top)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'Category Page Sidebar',
		'id' => 'ct_category_sidebar',
		'description' => __( 'Appears on the Category page', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="after-widget-title"></div>',
	));

	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id' => 'ct_page_sidebar',
		'description' => __( 'Appears on the Pages', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="after-widget-title"></div>',
	));

}
add_action( 'widgets_init', 'ct_widgets_init' );
}



if ( !isset( $content_width ) ) 
	$content_width = 980;


/*-----------------------------------------------------------------------------------*/
/*  Adding the Farbtastic Color Picker
/*  register message box widget
/*-----------------------------------------------------------------------------------*/
if ( is_admin() ) {
	if ( !function_exists( 'ct_load_color_picker_script' ) ) {
		function ct_load_color_picker_script() {
		   wp_enqueue_script('farbtastic');
		}

		add_action('admin_print_scripts-widgets.php', 'ct_load_color_picker_script');
	}

	if ( !function_exists( 'ct_load_color_picker_style' ) ) {
		function ct_load_color_picker_style() {
		   wp_enqueue_style('farbtastic');	
		}

		add_action('admin_print_styles-widgets.php', 'ct_load_color_picker_style');
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Add Thumbnails in Manage Posts/Pages List
/*-----------------------------------------------------------------------------------*/
// Add the posts and pages columns filter. They can both use the same function.
add_filter('manage_posts_columns', 'ct_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'ct_add_post_thumbnail_column', 5);

// Add the column
function ct_add_post_thumbnail_column($cols){
  $cols['tcb_post_thumb'] = __('Featured', 'color-theme-framework');
  return $cols;
}

// Hook into the posts an pages column managing. Sharing function callback again.
add_action('manage_posts_custom_column', 'ct_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'ct_display_post_thumbnail_column', 5, 2);

// Grab featured-thumbnail size post thumbnail and display it.
function ct_display_post_thumbnail_column($col, $id){
  switch($col){
	case 'tcb_post_thumb':
	  if( function_exists('the_post_thumbnail') )
		echo the_post_thumbnail( 'small-thumb' );
	  else
		echo 'Not supported in theme';
	  break;
  }
}



/*-----------------------------------------------------------------------------------*/
/*  Change excerpt length
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_new_excerpt_length' ) ) {
	function ct_new_excerpt_length($length) {
		return 999;
	}
}
add_filter('excerpt_length', 'ct_new_excerpt_length');


/*-----------------------------------------------------------------------------------*/
/*  Change excerpt more string
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_new_excerpt_more' ) ) {
	function ct_new_excerpt_more($more) {
		return '...';
	}
}
add_filter('excerpt_more', 'ct_new_excerpt_more');



/*-----------------------------------------------------------------------------------*/
/*  Add Admin Bar only for Editors
/*-----------------------------------------------------------------------------------*/
if (!current_user_can('manage_options')) {
	add_filter('show_admin_bar', '__return_false');
}



/*-----------------------------------------------------------------------------------*/
/*  Show Featured Images in RSS Feed
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_featuredtorss' ) ) {
	function ct_featuredtorss($content) {
		global $post;
		if ( has_post_thumbnail( $post->ID ) ){
			$content = '<div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
		}
		return $content;
	}
}
add_filter('the_excerpt_rss', 'ct_featuredtorss');
add_filter('the_content_feed', 'ct_featuredtorss');



/*-----------------------------------------------------------------------------------*/
/*  Enable Shortcodes In Sidebar Widgets
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'do_shortcode');



/*-----------------------------------------------------------------------------------*/
/*  Enqueues scripts for front-end
/*-----------------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'ct_scripts_method');

if ( !function_exists( 'ct_scripts_method' ) ) {
function ct_scripts_method() {

	//enqueue jquery
	wp_enqueue_script('jquery');

	if( !is_admin() ) {
	
		global $ct_options;

		$pagination_type = stripslashes( $ct_options['ct_pagination_type'] );

		/* Super Fish JS */
		wp_register_script('ct-super-fish',get_template_directory_uri().'/js/superfish.min.js',false, null , true);
		wp_enqueue_script('ct-super-fish',array('jquery'));	

		/* hoverIntent JS */
		wp_register_script('ct-hoverintent',get_template_directory_uri().'/js/hoverIntent.js',false, null , true);
		wp_enqueue_script('ct-hoverintent',array('jquery'));	

		/* Google Prettify */
		//wp_register_script('ct-google-prettify',get_template_directory_uri().'/js/prettify.js',false, null , true);
		//wp_enqueue_script('ct-google-prettify',array('jquery'));

		/* Retina */
		wp_register_script('ct-retina-js',get_template_directory_uri().'/js/retina.js',false, null , true);
		wp_enqueue_script('ct-retina-js',array('jquery'));

		/* To Top */
		wp_register_script('ct-scrolltopcontrol-js',get_template_directory_uri().'/js/scrolltopcontrol.js',false, null , true);
		wp_enqueue_script('ct-scrolltopcontrol-js',array('jquery'));

		/* Prettyphoto */
		wp_register_script('ct-prettyphoto-js',get_template_directory_uri().'/js/jquery.prettyphoto.js',false, null , true);
		wp_enqueue_script('ct-prettyphoto-js',array('jquery'));

		if ( is_home() or is_front_page() or is_archive() or is_page_template('template-blog.php') or is_search() ) :

			/* Masonry */
			wp_register_script('ct-masonry-js',get_template_directory_uri().'/js/masonry.pkgd.min.js',false, null , true);
			wp_enqueue_script('ct-masonry-js',array('jquery'));

			/* Images Load */
			wp_register_script('ct-imagesloaded-js',get_template_directory_uri().'/js/imagesloaded.pkgd.min.js',false, null , true);
			wp_enqueue_script('ct-imagesloaded-js',array('jquery'));

			if( $pagination_type == 'Infinite Scroll' ) :
				/* Infinite */
				wp_register_script('ct-infinitescroll-js',get_template_directory_uri().'/js/jquery.infinitescroll.min.js',false, null , true);
				wp_enqueue_script('ct-infinitescroll-js',array('jquery'));
			endif;
		endif;

		/* Bootstrap */
		wp_register_script('ct-jquery-bootstrap',get_template_directory_uri().'/js/bootstrap.js',false, null , true);
		wp_enqueue_script('ct-jquery-bootstrap',array('jquery'));

		/* Custom JS */
		wp_register_script('ct-custom-js',get_template_directory_uri().'/js/custom.js',false, null , true);
		wp_enqueue_script('ct-custom-js',array('jquery'));

		$subsets = 'latin,latin-ext';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Open+Sans:400italic,700italic,400,700',
			'subset' => $subsets,
		);
		wp_enqueue_style( 'ct-opensans-fonts', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );		


		/*
		* Adds JavaScript to pages with the comment form to support
		* sites with threaded comments (when in use).
		*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

	} /* End Include jQuery Libraries */
  }
}


/*-----------------------------------------------------------------------------------*/
/*  Enqueues styles for front-end
/*-----------------------------------------------------------------------------------*/
if ( !function_exists ('ct_header_styles' ) ) {
	function ct_header_styles() {

		global $wp_styles, $ct_options;
		$responsive_layout = $ct_options['ct_responsive_layout'];

		wp_enqueue_style( 'bootstrap-main-style',get_template_directory_uri().'/css/bootstrap.css','','','all');	
		wp_enqueue_style( 'font-awesome-style',get_template_directory_uri().'/css/font-awesome.min.css','','','all');
		if ( $responsive_layout ) {
			wp_enqueue_style( 'bootstrap-responsive',get_template_directory_uri().'/css/bootstrap-responsive.css','','','all');
		}
		wp_enqueue_style( 'ct-flexslider',get_template_directory_uri().'/css/flexslider.css','','','all');	

		wp_enqueue_style( 'ct-shortcodes', get_template_directory_uri(). '/ct-shortcodes/shortcodes.css', '', '', 'all' );		

		wp_enqueue_style( 'ct-style',get_stylesheet_directory_uri().'/style.css','','','all');
		
		if ( $responsive_layout ) {			
			wp_enqueue_style( 'ct-rwd-style',get_template_directory_uri().'/css/rwd-styles.css','','','all');
		}
		wp_enqueue_style( 'prettyphoto-style',get_template_directory_uri().'/css/prettyphoto.css','','','all');

		$theme_colors = strtolower( stripslashes( $ct_options['ct_predefined_theme_color'] ) );

		$theme_colors = str_replace( ' ' , '_' , $theme_colors );

		if ( $theme_colors == 'custom' ) {
			wp_enqueue_style( 'options-css-style',get_template_directory_uri().'/css/options.css','','','all');
		} else { 
			wp_enqueue_style( 'options-css-style',get_template_directory_uri().'/css/options.css','','','all');
			wp_enqueue_style( 'options-css-style-' . $theme_colors ,get_template_directory_uri().'/css/theme_colors/' . $theme_colors . '.css','','','all');
		}
	}
}

add_action('wp_enqueue_scripts', 'ct_header_styles'); 


if ( ! function_exists( 'ct_get_info' ) ) {
	function ct_get_info() {
		?>
		<div class="bg-mask"></div>
		
		<?php ct_get_rating_type_stars();
							
		ct_get_views_likes();

		ct_get_date_title();
	}
}

/*-----------------------------------------------------------------------------------*/
/* Add Google Fonts for Headings 
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_custom_fonts' ) ) {
		function ct_custom_fonts() {
			global $ct_options;
		
			$google_fonts = stripslashes( $ct_options['ct_google_fonts']['face'] );

			if ( !empty( $google_fonts ) ) {
				echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=' . str_replace(" ", "%20", $google_fonts) . ':300,400,400italic,700,700italic" type="text/css" />';								
				echo '<style type="text/css">h1,h2,h3,h4,h5,h6 { ';
				echo 'font-family: "' . $google_fonts .'", Arial, sans-serif';
				echo '}</style>';
			}
	}
}
add_action('wp_head','ct_custom_fonts');

if ( !function_exists( 'ct_google_fonts' ) ) {
	function ct_google_fonts() {
		if ( !is_admin() ) { 
			// register Google Fonts stylesheet
			wp_enqueue_style( 'carroisgothic-google-fonts', 'http://fonts.googleapis.com/css?family=Carrois+Gothic:400,400italic,700,700italic', '', '', 'all' );
		}
	}

add_action( 'wp_enqueue_scripts', 'ct_google_fonts' );
}

/*-----------------------------------------------------------------------------------*/
/*  Fav and touch icons
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_fav_icons' ) ) {
	function ct_fav_icons() {
		global $ct_options;
			
		echo "<!-- Fav and touch icons -->\n";
		echo "<link rel=\"shortcut icon\" href=\"" . stripslashes( $ct_options['ct_custom_favicon'] ) . "\">\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"" . get_template_directory_uri() . "/img/icons/apple-touch-icon-144-precomposed.png\">\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"" . get_template_directory_uri() ."/img/icons/apple-touch-icon-114-precomposed.png\">\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"" . get_template_directory_uri() ."/img/icons/apple-touch-icon-72-precomposed.png\">\n";
		echo "<link rel=\"apple-touch-icon-precomposed\" href=\"" . get_template_directory_uri() . "/img/icons/apple-touch-icon-57-precomposed.png\">\n";

		echo "<!--[if IE 7]>\n";
		echo "<link rel=\"stylesheet\" href=\"" . get_template_directory_uri() . "/css/font-awesome-ie7.min.css\">\n";
		echo "<![endif]-->\n";
	}
}
add_action('wp_enqueue_scripts','ct_fav_icons');


/*-----------------------------------------------------------------------------------*/
/* Add IE conditional fix to header 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_ie_fix' ) ) {
	function ct_ie_fix () {
		echo "<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->\n";
		echo "<!--[if lt IE 9]>\n";
		echo "<script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>\n";
		echo "<script src=\"" . get_template_directory_uri() . "/js/respond.min.js\"></script>\n";
		echo "<![endif]-->\n";
	}
}
add_action('wp_enqueue_scripts', 'ct_ie_fix');



/*-----------------------------------------------------------------------------------*/
/* Get Related Post function 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_related_posts' ) ) {
	function ct_get_related_posts($post_id, $tags = array(), $posts_number_display, $order_by) {
		$query = new WP_Query();

		$post_types = get_post_types();
		unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);

		if($tags) {
			foreach($tags as $tag) {
				$tagsA[] = $tag->term_id;
			}
		}
	   $query = new WP_Query( array('orderby'				=> $order_by,
									'showposts'				=> $posts_number_display,
									'post_type'				=> $post_types,
									'post__not_in'			=> array($post_id),
									'tag__in'				=> $tagsA,
									'ignore_sticky_posts'	=> 1 
									)
							);
		return $query;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Custom Styles for Backend Options
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'ct_upload_styles_post' ) ) {
	function ct_upload_styles_post() {
		wp_enqueue_style( 'style-metabox-admin',get_template_directory_uri().'/admin/assets/css/metabox-options.css','','','all');
	}

	add_action('admin_print_styles', 'ct_upload_styles_post'); 
}



/*-----------------------------------------------------------------------------------*/
/* Get DailyMotion Thumbnail
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'getDailyMotionThumb' ) ) {
	function getDailyMotionThumb( $id ) {
		if ( ! function_exists( 'curl_init' ) ) {
			return null;
		}
		else {
		  $ch = curl_init();
		  $videoinfo_url = "https://api.dailymotion.com/video/$id?fields=thumbnail_url";
		  curl_setopt( $ch, CURLOPT_URL, $videoinfo_url );
		  curl_setopt( $ch, CURLOPT_HEADER, 0 );
		  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		  curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		  curl_setopt( $ch, CURLOPT_FAILONERROR, true ); // Return an error for curl_error() processing if HTTP response code >= 400
		  $output = curl_exec( $ch );
		  $output = json_decode( $output );
		  $output = $output->thumbnail_url;
		  if ( curl_error( $ch ) != null ) {
			$output = new WP_Error( 'dailymotion_info_retrieval', __( 'Error retrieving video information from the URL','color-theme-framework') . '<a href="' . $videoinfo_url . '">' . $videoinfo_url . '</a>.<br /><a href="http://curl.haxx.se/libcurl/c/libcurl-errors.html">Libcurl error</a> ' . curl_errno( $ch ) . ': <code>' . curl_error( $ch ) . '</code>. If opening that URL in your web browser returns anything else than an error page, the problem may be related to your web server and might be something your host administrator can solve.' );
		  }
		  curl_close( $ch ); // Moved here to allow curl_error() operation above. Was previously below curl_exec() call.
		  return $output;
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get Post Count
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_post_count' ) ) {
	function ct_get_post_count() {
	   $res_search = new WP_Query("showposts=-1");
	   $count = $res_search->post_count;

	   return $count; 
		 
	   wp_reset_query();
	   unset($res_search, $count);
	}
}



/*-----------------------------------------------------------------------------------*/
/* Set an option for a cURL transfer
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_curl_subscribers_text_counter' ) ) {
	function ct_curl_subscribers_text_counter( $xml_url ) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $xml_url);
		$ct_options = curl_exec($ch);
		curl_close($ch);
		return $ct_options;
	}
}


/*-----------------------------------------------------------------------------------*/
/* This is function gets the post views and display it in admin panel.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'getPostViews' ) ) {
	function getPostViews( $postID ){
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 Views";
		}
		return ' '. $count . ' ' . __('Views','color-theme-framework');
	}
}

if ( !function_exists( 'setPostViews' ) ) {
	function setPostViews($postID) {
	if (!current_user_can('administrator') ) :
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	endif;
	}
}

if ( !function_exists( 'posts_column_views' ) ) {
	function posts_column_views($defaults){
		$defaults['post_views'] = __( 'Views' , 'color-theme-framework' );
		return $defaults;
	}
}

if ( !function_exists( 'posts_custom_column_views' ) ) {
	function posts_custom_column_views($column_name, $id){
		if( $column_name === 'post_views' ) {
			echo getPostViews( get_the_ID() );
		}
	}
}

add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);



/*-----------------------------------------------------------------------------------*/
/* Remove rel attribute from the category list
/*-----------------------------------------------------------------------------------*/
function ct_remove_category_list_rel($output)
{
	$output = str_replace(' rel="category"', '', $output);
	return $output;
}

add_filter('wp_list_categories', 'ct_remove_category_list_rel');
add_filter('the_category', 'ct_remove_category_list_rel');

add_filter( 'the_category', 'ct_replace_cat_tag' );

function ct_replace_cat_tag ( $text ) {
	$text = str_replace('rel="category tag"', "", $text); return $text;
}




/*-----------------------------------------------------------------------------------*/
/* Add Theme Widgets
/*-----------------------------------------------------------------------------------*/
include("functions/ct-carousel-widget.php");
include("functions/ct-flickr-widget.php");
include("functions/ct-instagram-widget.php");
/*include("functions/ct-categories-widget.php");*/
include("functions/ct-text-widget.php");
include("functions/ct-twitter-widget.php");
include("functions/ct-popular-posts-widget.php");
include("functions/ct-recent-posts-widget.php");
include("functions/ct-small-slider-widget.php");
include("functions/ct-related-posts-thumbs-widget.php");

include("functions/ct-custom-menu.php");


/* Add Color Picker field for Categories */
//require_once("includes/categories-color.php");

/* Post Like */
require_once("post-like.php");

/* Metabox components */
require_once("meta-box/meta-box.php");

/* Theme Metaboxes */
require_once("includes/theme-metaboxes.php");

/* Sidebar Generator */
//require_once ('includes/sidebar-generator.php');

require_once('ct-shortcodes/ct-shortcodes.php');

/* Update notifier */
//require_once ("includes/update-notifier.php");

/* Get Shortcodes */
//require_once ("includes/shortcodes.php");


/*-----------------------------------------------------------------------------------*/
/* Get Post Meta
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_post_meta' ) ) {
	function ct_get_post_meta($ct_postid, $ct_category, $ct_date_alt) { ?>

		<?php
		global $post;
		$post_type = get_post_meta( $post->ID, 'ct_mb_post_type', true);
		?>

		<?php if ( $post_type == 'review_post' ) {
			ct_get_rating_stars();
		} ?>

		<?php if ( $ct_category == 'true' ) { ?>
		<span class="meta-category" title="<?php _e('Category','color-theme-framework'); ?>">
			<i class="icon-tag"></i>
			<?php echo get_the_category_list(', '); ?>
		</span><!-- .meta-category -->
		<?php } ?>

		<?php if ( $ct_date_alt == 'true' ) { ?>
		<span class="meta-date-alt" title="<?php _e('Date','color-theme-framework'); ?>">
			<i class="icon-calendar"></i>
			<?php echo esc_attr( get_the_date( 'M j, Y' ) ); ?>
		</span><!-- .meta-author -->
		<?php } ?>

<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get author for comment
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_get_author' ) ) :
function ct_get_author($comment) {
	$author = "";
	if ( empty($comment->comment_author) )
		$author = __('Anonymous', 'color-theme-framework');
	else
		$author = $comment->comment_author;
	return $author;
}
endif;



/*-----------------------------------------------------------------------------------*/
/*  This will add rel=lightbox[postid] to the href of the image link
/*-----------------------------------------------------------------------------------*/
$add_prettyphoto = stripslashes( $ct_options['ct_add_prettyphoto'] );

if ( $add_prettyphoto ) :
	if ( !function_exists( 'ct_add_prettyphoto_rel' ) ) {
		function ct_add_prettyphoto_rel ($content)
		{   
			global $post;
			$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
			$replacement = '<a$1href=$2$3.$4$5 rel="prettyphoto['.$post->ID.']"$6>$7</a>';
			$content = preg_replace($pattern, $replacement, $content);
			return $content;
		}
		add_filter('the_content', 'ct_add_prettyphoto_rel', 12);
	}
endif;


/*-----------------------------------------------------------------------------------*/
/*  Custom Background and Custom CSS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_custom_head_css' ) ) {
	function ct_custom_head_css() {

		$output = '';

		global $wp_query, $ct_options;

		if( is_home() ) {
			$postid = get_option('page_for_posts');
		} elseif( is_search() || is_404() || is_category() || is_tag() || is_author() ) {
			$postid = 0;
		} else {
			$postid = $wp_query->post->ID;
		}

		/* -- Get the unique custom background image for page --------------------*/
		$bg_img = get_post_meta($postid, 'ct_mb_background_image', true);
		$src = wp_get_attachment_image_src( $bg_img, 'full' );
		$bg_img = $src[0];

		if( empty($bg_img) ) {
			/* -- Background image not defined, fallback to default background -- */
			$bg_pos = strtolower ( stripslashes ( $ct_options['ct_default_bg_position'] ) );
			
			if ( $bg_pos == 'full screen' ) {
				$bg_pos = 'full';
			}
			$bg_type = stripslashes ( $ct_options['ct_default_bg_type'] );

			if( $bg_pos != 'full' ) {
				/* -- Setup body backgroung image, if not fullscreen -- */
				if ( $bg_type == 'Uploaded' ) {
					$bg_img = stripslashes ( $ct_options['ct_default_bg_image'] );
				} else if ( $bg_type == 'Predefined' ) {
					$bg_img = stripslashes ( $ct_options['ct_default_predefined_bg'] );
				}

				if( !empty($bg_img) ) {
					$bg_img = " url($bg_img)";
				} else {
					$bg_img = " none";
				}

				$bg_repeat = strtolower ( stripslashes ( $ct_options['ct_default_bg_repeat'] ) );
				$bg_attachment = strtolower ( stripslashes ( $ct_options['ct_default_bg_attachment'] ) );
				$bg_color = get_post_meta($postid, 'ct_mb_background_color', true);

				if( empty($bg_color) ) { 
					$bg_color = stripslashes ( $ct_options['ct_body_background'] );
				}

				$output .= "body { \n\tbackground-color: $bg_color;\n\tbackground-image: $bg_img;\n\tbackground-attachment: $bg_attachment;\n\tbackground-repeat: $bg_repeat;\n\tbackground-position: top $bg_pos; \n}\n";
			}    
		} else {
			/* -- Custom image defined, check default position -------------------- */
			$bg_pos = get_post_meta($postid, 'ct_mb_background_position', true);

			if( $bg_pos != 'full' ) {
				/* -- Setup body backgroung image, if not fullscreen -- */
				$bg_img = " url($bg_img)";

				/* -- Get the repeat and backgroung color options -- */
				$bg_repeat = get_post_meta($postid, 'ct_mb_background_repeat', true);
				$bg_attachment = get_post_meta($postid, 'ct_mb_background_attachment', true);
				$bg_color = get_post_meta($postid, 'ct_mb_background_color', true);

				if( empty($bg_color) ) {
					$bg_color = stripslashes ( $ct_options['ct_body_background'] );
				}

				$output .= "body { \n\tbackground-color: $bg_color;\n\tbackground-image: $bg_img;\n\tbackground-attachment: $bg_attachment;\n\tbackground-repeat: $bg_repeat;\n\tbackground-position: top $bg_pos; \n}\n";
			}
		}
		
		/* -- Custom CSS from Theme Options --------------------*/
		$custom_css = stripslashes ( $ct_options['ct_custom_css'] );
	
		if ( !empty($custom_css) ) {
			$output .= $custom_css . "\n";
		}
		
		/* -- Output our custom styles --------------------------*/
		if ($output <> '') {
			$output = "<!-- Custom Styles -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo stripslashes($output);
		}
	
	}

	add_action('wp_head', 'ct_custom_head_css');
}

add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3><?php _e( 'Author Social icons' , 'color-theme-framework' ); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="facebook"><?php _e( 'Facebook' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Facebook URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="twitter"><?php _e( 'Twitter' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Twitter URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="github"><?php _e( 'Github' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="github" id="github" value="<?php echo esc_attr( get_the_author_meta( 'github', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Github URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="linkedin"><?php _e( 'Linkedin' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Linkedin URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="pinterest"><?php _e( 'Pinterest' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Pinterest URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>	

		<tr>
			<th><label for="google_plus"><?php _e( 'Google Plus' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="google_plus" id="google_plus" value="<?php echo esc_attr( get_the_author_meta( 'google_plus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Google Plus URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>			
	</table>
<?php }

add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. Make sure to change 'twitter' to the field ID. */
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'github', $_POST['github'] );
	update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
	update_user_meta( $user_id, 'google_plus', $_POST['google_plus'] );
}

/*-----------------------------------------------------------------------------------*/
/* Load JS
/*-----------------------------------------------------------------------------------*/
function load_js() {
	global $ct_options, $wp_query;
	$pagination_type = stripslashes( $ct_options['ct_pagination_type'] );
	?>

	<script type="text/javascript">
	/* <![CDATA[ */

	// Masonry
	jQuery.noConflict()(function($){
		$(document).ready(function() {
	
			var $container = $('#blog-entry');

			$container.imagesLoaded(function(){
				$container.masonry({
					itemSelector: '.masonry-box',
					<?php if (is_rtl()) : ?>
					isOriginLeft: false,
					<?php endif; ?>					
					isAnimated: true
				});
			});


<?php 

if( $pagination_type == 'Infinite Scroll' ) : ?>
	// Infinite Scroll

	$container.infinitescroll({
		navSelector  : '.pagination',    // selector for the paged navigation 
		nextSelector : '.pagination a',  // selector for the NEXT link (to page 2)
		itemSelector : '.masonry-box',     // selector for all items you'll retrieve
		<?php $ct_pages = $wp_query->max_num_pages; ?>
		maxPage: <?php echo $ct_pages; ?>,		
		loading: {
			finishedMsg: 'No more posts to load.',
			img: '<?php echo get_template_directory_uri(); ?>/img/ajax-loader.gif'
		}
	},

	// trigger Masonry as a callback
	function( newElements ) {
		var $newElems = $( newElements ).css({ opacity: 0 });

		$newElems.imagesLoaded(function()   {
			$newElems.animate({ opacity: 1 });
			$container.masonry( 'appended', $newElems, true ); 
			
			$('.icon-star-empty, .icon-eye-open, .icon-heart, .icon-heart-empty, .icon-video a, .category-item a, .video a, .nav-previous-top a .icon-chevron-left, .nav-next-top a .icon-chevron-right').tooltip('hide');
			
			// post like system
			$(".post-like a").click(function() {

				heart = $(this);
				post_id = heart.data("post_id");

				$.ajax({
						type: "post",
						url: ajax_var.url,
						data: "action=post-like&nonce="+ajax_var.nonce+"&post_like=&post_id="+post_id,
						success: function(count){
							if(count != "already") {
								heart.addClass("voted");
								heart.siblings(".count").text(count);
							}
						}

				});
				return false;
			}) // end post like system

		});
	});
 
 <?php endif; ?>
 
	});
});
/* ]]> */   
	</script>
<?php
}

add_action('wp_footer', 'load_js');




/*-----------------------------------------------------------------------------------*/
/* If we go beyond the last page and request a page that doesn't exist,
 * force WordPress to return a 404.
 * See http://core.trac.wordpress.org/ticket/15770
/*-----------------------------------------------------------------------------------*/
function ct_custom_paged_404_fix( ) {
	global $wp_query;
	if ( is_404() || !is_paged() || 0 != count( $wp_query->posts ) )
		return;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
}
add_action( 'wp', 'ct_custom_paged_404_fix' );


/*-----------------------------------------------------------------------------------*/
/* Displays page links for paginated posts/pages
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_wp_link_pages' ) ) {
	function ct_wp_link_pages( $args = '' ) {
		$defaults = array(
			'before' => '<p class="pagination clearfix"><span>' . __( 'Pages:', 'color-theme-framework' ) . '</span>', 
			'after' => '</p>',
			'text_before' => '',
			'text_after' => '',
			'next_or_number' => 'number', 
			'nextpagelink' => __( 'Next page', 'color-theme-framework' ),
			'previouspagelink' => __( 'Previous page', 'color-theme-framework' ),
			'pagelink' => '%',
			'echo' => 1
		);

		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );

		global $page, $numpages, $multipage, $more, $pagenow;

		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $pagelink );
					$output .= ' ';
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= _wp_link_page( $i );
					else
						$output .= '<span class="current">';

					$output .= $text_before . $j . $text_after;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= '</a>';
					else
						$output .= '</span>';
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $previouspagelink . $text_after . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $nextpagelink . $text_after . '</a>';
					}
					$output .= $after;
				}
			}
		}

		if ( $echo )
			echo $output;

		return $output;
	}
}

/*-----------------------------------------------------------------------------------*/
/* Get Date And Title
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_date_title' ) ) {
	function ct_get_date_title() {
		global $post, $ct_options;
		?>

			<div class="title-mask">
				<?php 
					$show_date = stripslashes( $ct_options['ct_date_meta'] ); 

					if ( $show_date == 1 ) {
				?>
					<!-- <meta itemprop="datePublished" content="<?php //the_time('F j, Y'); ?>"> -->
					<span class="meta-time updated"><?php the_time('F j, Y'); ?></span>
					<div class="clear"></div>
				<?php } ?>

				<header class="entry-header">
					<h1 class="entry-title">
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h1>
				</header>

			<?php 
				$author = sprintf( '<span class="author vcard">%4$s<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
								esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
								esc_attr( sprintf( __( 'View all posts by %s', 'color-theme-framework' ), get_the_author() ) ),
								get_the_author(),
								''
							);
			?>
			<span class="hidden-meta-author" ><?php printf( $author ); ?></span><!-- .meta-author -->

			</div><!-- title-mask -->
<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/* Get Views and Likes
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_views_likes' ) ) {
	function ct_get_views_likes() {
		global $post, $ct_options;
		?>

			<?php 
				$show_views = stripslashes( $ct_options['ct_views_icon'] ); 
				$show_likes = stripslashes( $ct_options['ct_likes_icon'] ); 

				if ( $show_views == 1 ) {
			?>
			<div class="icon-views">
			  	<?php if ( is_rtl() ) : ?>
					<span class="icon-eye-open" data-toggle="tooltip" data-placement="left" title="<?php echo getPostViews( get_the_ID() ); ?>"></span>
				<?php else : ?>
					<span class="icon-eye-open" data-toggle="tooltip" data-placement="right" title="<?php echo getPostViews( get_the_ID() ); ?>"></span>
				<?php endif; ?>			
			</div>
			<?php } ?>

			<?php 				
				if ( ( $show_likes == 1 ) ) {
					if ( $show_views == 0 )
						echo '<div class="icon-likes likes-padding">';
					else 	
						echo '<div class="icon-likes">';
			?>			
				<?php getPostLikeLink_echo( get_the_ID() ); ?>
			</div>
			<?php } ?>			
<?php	}
}
/*-----------------------------------------------------------------------------------*/
/* Get rating stars (admin or user and echo Rating as Title)
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_rating_type_stars' ) ) {
	function ct_get_rating_type_stars() {
			global $post, $ct_options;
			$output = '';

			$show_stars = stripslashes( $ct_options['ct_rating_icon'] );

			if ( $show_stars == 1 ) {
				$post_type = get_post_meta( $post->ID, 'ct_mb_post_type', true );
				if ( $post_type == 'admin_review_post' ) {
					
					if ( $post_type == 'admin_review_post' ) $star = __( 'Rating: ' , 'color-theme-framework' ) . get_post_meta( $post->ID, 'ct_mb_over_score', true );

			 
			$output = '<div class="icon-rating">';
				if ( is_rtl() ) :
					$output .= '<span class="icon-star-empty" data-toggle="tooltip" data-placement="right" title="' . $star .'"></span>';
				else :
					$output .= '<span class="icon-star-empty" data-toggle="tooltip" data-placement="left" title="' . $star .'"></span>';
				endif;
			$output .= '</div>';

			echo $output;
			}
		}
	}
}			

/*-----------------------------------------------------------------------------------*/
/* Get rating stars (big)
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_rating_stars' ) ) {
	function ct_get_rating_stars() {

		global $post;
		$output = '';

		$stars_color = get_post_meta( $post->ID, 'ct_mb_stars_color', true);
		if ( $stars_color == '' ) $stars_color = '#DD0C0C';

		$overall_score = get_post_meta($post->ID, 'ct_mb_over_score', true);

		if ( $overall_score == '' ) $score = 'zero';

		switch( $overall_score ) {
			case 0:
				$score = 'zero';
				$output .= '';
				break;
			case 0.5:
				$score = 'zero_half';
				$output .= '<i class="icon-star-half"></i>';
				break;
			case 1:
				$score = 'one';
				$output .= '<i class="icon-star"></i>';
				break;
			case 1.5:
				$score = 'one_half';
				$output .= '<i class="icon-star"></i><i class="icon-star-half"></i>';
				break;
			case 2:
				$score = 'two';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i>';
				break;
			case 2.5:
				$score = 'two_half';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half"></i>';
				break;
			case 3:
				$score = 'three';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>';
				break;
			case 3.5:
				$score = 'three_half';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half"></i>';
				break;
			case 4:
				$score = 'four';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>';
				break;
			case 4.5:
				$score = 'four_half';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half"></i>';
				break;
			case 5:
				$score = 'five';
				$output .= '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>';
				break;
		}
		echo '<span class="meta-stars ' . $score . '" title="'.__('Review Score: ','color-theme-framework'). $overall_score . '" style="color:'. $stars_color . '">'.$output.'</span>';
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get Single Star Rating (for criteria)
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_single_rating' ) ) {
	function ct_get_single_rating( $score_value, $local_ID ) {

//echo $score_value;
//		$score_value = 4.5;
		$output_stars = '';
		$stars_color = get_post_meta( $local_ID , 'ct_mb_stars_color', true);          
		if ( $stars_color == '' ) $stars_color = '#DD0C0C';

		if ( $score_value == '' ) $score = 'zero';

		switch( $score_value ) {
			case 0:
				$score = 'zero';
				$output_stars = '';
				break;
			case 0.5:
				$score = 'zero_half';
				$output_stars = '<i class="icon-star-half"></i>';
				break;
			case 1:
				$score = 'one';
				$output_stars = '<i class="icon-star"></i>';
				break;
			case 1.5:
				$score = 'one_half';
				$output_stars = '<i class="icon-star"></i><i class="icon-star-half"></i>';
				break;
			case 2:
				$score = 'two';
				$output_stars = '<i class="icon-star" style="color:#f4f4f4;"></i><i class="icon-star" style="color:#f4f4f4;"></i><i class="icon-star" style="color:#f4f4f4;"></i><i class="icon-star"></i><i class="icon-star"></i>';
				break;
			case 2.5:
				$score = 'two_half';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half"></i>';
				break;
			case 3:
				$score = 'three';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>';
				break;
			case 3.5:
				$score = 'three_half';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half"></i>';
				break;
			case 4:
				$score = 'four';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>';
				break;
			case 4.5:
				$score = 'four_half';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-half"></i>';
				break;
			case 5:
				$score = 'five';
				$output_stars = '<i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i>';
				break;
		}
		return '<span class="meta-stars ' . $score . '" title="'.__('Criteria Score: ','color-theme-framework'). $score_value . '" style="color:'. $stars_color . '">' . $output_stars . '</span>';
	}
}


/*-----------------------------------------------------------------------------------*/
/* Displays Read more link
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_get_readmore' ) ) {
	function ct_get_readmore() {
		echo "<a class=\"read-more\" href=\"" . get_permalink() . "\" title=\"" . __('Permalink to ','color-theme-framework') . the_title('','',false) . "\">" . __('more','color-theme-framework') ."</a>";
	}
}


/*-----------------------------------------------------------------------------------*/
/* Pagination function 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_pagination' ) ) {
	function ct_pagination($pages = '', $range = 4)
	{  
		$showitems = ($range * 2)+1;  
 
		global $paged;
		if(empty($paged)) $paged = 1;
 
		if($pages == '')
		{
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages)
			{
				$pages = 1;
			}
		}   
 
		if(1 != $pages)
		{
			echo '<div class="pagination-top-line"><div class="center-line"></div></div>';
			echo "<div class=\"pagination\" role=\"navigation\">";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
			if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
 
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}
			}
 
			if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
			echo "</div>\n";
		}
	}
}




/*-----------------------------------------------------------------------------------*/
/* Print an excerpt by specifying a maximium number of characters.
/*-----------------------------------------------------------------------------------*/
function ct_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '...';
	} else {
		echo $excerpt;
	}
}



/*-----------------------------------------------------------------------------------*/
/* Template for comments and pingbacks.
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_comment' ) ) :
function ct_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'color-theme-framework' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'color-theme-framework' ), '<i class="icon-pencil"></i><span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment clearfix">
			<header class="comment-meta comment-author vcard">
				<?php
					echo '<div class="comment-avatar">' . get_avatar( $comment, 50 );
					// If current post author is also comment author, make it known visually.
					if ( $comment->user_id == $post->post_author ) {
						echo '<br/><span class="muted-small"> ' . __( 'Author', 'color-theme-framework' ) . '</span>';
					} else echo '';
					echo '</div>';

					printf( '<cite class="fn">%1$s</cite>',
						get_comment_author_link()
					);
					printf( '<a class="comment-meta-time muted-small" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'color-theme-framework' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'color-theme-framework' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'color-theme-framework' ), '<p class="edit-link"><i class="icon-pencil"></i>', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply clearfix">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => '', 'after' => ' <i class="icon-reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;