<?php
/*
==============================================================================================
						Columns (Bootstrap Styles)
==============================================================================================
*/

// Row - Container For The Columns
if ( !function_exists('colortheme_row')) {
function colortheme_row( $atts, $content = null ) {
	extract( shortcode_atts( array(), $atts ) );
	
		$code = '<div class="row-fluid clearfix">' . do_shortcode( $content ) . '</div>';
		
		return $code;
	}
	add_shortcode('row', 'colortheme_row');
}

// span1 - 1 Column
if (!function_exists('colortheme_span1')) {
	function colortheme_span1( $atts, $content = null ) {
	   return '<div class="span1">' . do_shortcode($content) . '</div> <!-- /span1 -->';
	}
	add_shortcode('span1', 'colortheme_span1');
}

// span2 - 2 Columns
if (!function_exists('colortheme_span2')) {
	function colortheme_span2( $atts, $content = null ) {
	   return '<div class="span2">' . do_shortcode($content) . '</div> <!-- /span2 -->';
	}
	add_shortcode('span2', 'colortheme_span2');
}

// span3 - 3 Columns
if (!function_exists('colortheme_span3')) {
	function colortheme_span3( $atts, $content = null ) {
	   return '<div class="span3">' . do_shortcode($content) . '</div> <!-- /span3 -->';
	}
	add_shortcode('span3', 'colortheme_span3');
}

// span4 - 4 Columns
if (!function_exists('colortheme_span4')) {
	function colortheme_span4( $atts, $content = null ) {
	   return '<div class="span4">' . do_shortcode($content) . '</div> <!-- /span4 -->';
	}
	add_shortcode('span4', 'colortheme_span4');
}

// span5 - 5 Columns
if (!function_exists('colortheme_span5')) {
	function colortheme_span5( $atts, $content = null ) {
	   return '<div class="span5">' . do_shortcode($content) . '</div> <!-- /span5 -->';
	}
	add_shortcode('span5', 'colortheme_span5');
}

// span6 - 6 Columns
if (!function_exists('colortheme_span6')) {
	function colortheme_span6( $atts, $content = null ) {
	   return '<div class="span6">' . do_shortcode($content) . '</div> <!-- /span6 -->';
	}
	add_shortcode('span6', 'colortheme_span6');
}

// span7 - 7 Columns
if (!function_exists('colortheme_span7')) {
	function colortheme_span7( $atts, $content = null ) {
	   return '<div class="span7">' . do_shortcode($content) . '</div> <!-- /span7 -->';
	}
	add_shortcode('span7', 'colortheme_span7');
}

// span8 - 8 Columns
if (!function_exists('colortheme_span8')) {
	function colortheme_span8( $atts, $content = null ) {
	   return '<div class="span8">' . do_shortcode($content) . '</div> <!-- /span8 -->';
	}
	add_shortcode('span8', 'colortheme_span8');
}

// span9 - 9 Columns
if (!function_exists('colortheme_span9')) {
	function colortheme_span9( $atts, $content = null ) {
	   return '<div class="span9">' . do_shortcode($content) . '</div> <!-- /span9 -->';
	}
	add_shortcode('span9', 'colortheme_span9');
}

// span10 - 10 Columns
if (!function_exists('colortheme_span10')) {
	function colortheme_span10( $atts, $content = null ) {
	   return '<div class="span10">' . do_shortcode($content) . '</div> <!-- /span10 -->';
	}
	add_shortcode('span10', 'colortheme_span10');
}

// span11 - 11 Columns
if (!function_exists('colortheme_span11')) {
	function colortheme_span11( $atts, $content = null ) {
	   return '<div class="span11">' . do_shortcode($content) . '</div> <!-- /span11 -->';
	}
	add_shortcode('span11', 'colortheme_span11');
}

// span12 - 12 Columns
if (!function_exists('colortheme_span12')) {
	function colortheme_span12( $atts, $content = null ) {
	   return '<div class="span12">' . do_shortcode($content) . '</div> <!-- /span12 -->';
	}
	add_shortcode('span12', 'colortheme_span12');
}


/*
==============================================================================================
						Headings Shortcode
==============================================================================================
*/
if (!function_exists('colortheme_headings')) {
	function colortheme_headings( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'level' => 'h1'
	    ), $atts));
				

			$code = '';

			switch($level) {
				case 'h1':
					$code .= '<h1>' . do_shortcode($content) . '</h1>';
					break;
				case 'h2':
					$code .= '<h2>' . do_shortcode($content) . '</h2>';
					break;
				case 'h3':
					$code .= '<h3>' . do_shortcode($content) . '</h3>';
					break;
				case 'h4':
					$code .= '<h4>' . do_shortcode($content) . '</h4>';
					break;
				case 'h5':
					$code .= '<h5>' . do_shortcode($content) . '</h5>';
					break;
				case 'h6':
					$code .= '<h6>' . do_shortcode($content) . '</h6>';
					break;
			}
			
    	return $code;

	}
	
	add_shortcode('ct_headings', 'colortheme_headings');
}


/*
==============================================================================================
						Clear Float Blocks
==============================================================================================
*/

if (!function_exists('colortheme_clear')) {
	function colortheme_clear($atts, $content = null) {
		return '<div class="clear"></div>';
	}
	add_shortcode('clear', 'colortheme_clear');
}

/*
==============================================================================================
						Divider Plus
==============================================================================================
*/

if (!function_exists('colortheme_divider')) {
	function colortheme_divider() {
		return '<div class="divider-block"><div class="inner-divider"></div></div>';
	}
	add_shortcode('ct_divider', 'colortheme_divider');
}


/*
==============================================================================================
						Top Margins
==============================================================================================
*/


if (!function_exists('colortheme_margin')) {
	function colortheme_margin( $atts, $content = null ) {
		extract(shortcode_atts(array(			
			'style' => 't',
			'margin' => '5',			
	    ), $atts));

		switch ($style) {
			case 'top':
				$type_margin = 't';
				break;

			case 'bottom':
				$type_margin = 'b';
				break;

			case 'no-top':
				$type_margin = 't-n';
				break;

			case 'no-bottom':
				$type_margin = 'b-n';
				break;
			
			default:
				$type_margin = 't';
				break;
		}

		$code = '';
		if ( $style == 'no-top' || $style == 'no-bottom') {
			$code = '<div class="clear"></div><div class="margin-'. $type_margin .'"></div>';			
		} else $code = '<div class="clear"></div><div class="margin-'. $margin . $type_margin .'"></div>';

		return $code;
	}
	
	add_shortcode('ct_margin', 'colortheme_margin');
}



/*
==============================================================================================
						Highlights
==============================================================================================
*/
if (!function_exists('colortheme_highlight')) {
	function colortheme_highlight( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'text' => '',
			'color' => 'green',
			'type' => 'round'
	    ), $atts));

		return '<span class="highlight '. $type .' '. $color .'">' . do_shortcode ($content) . '</span>';		
	}
	
	add_shortcode('ct_highlight', 'colortheme_highlight');
}

/*
==============================================================================================
						Dropcaps
==============================================================================================
*/
if (!function_exists('colortheme_dropcap')) {
	function colortheme_dropcap( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'text' => '',
			'color' => 'green',
			'size' => 'medium'
	    ), $atts));

		return '<span class="dropcap '. $color . ' ' . $size . '">' . do_shortcode ($content) . '</span>';		
	}
	
	add_shortcode('ct_dropcap', 'colortheme_dropcap');
}


/*
==============================================================================================
						labels
==============================================================================================
*/
if (!function_exists('colortheme_labels')) {
	function colortheme_labels( $atts, $content = null ) {
		extract(shortcode_atts(array(			
			'type' => 'default'			
	    ), $atts));

		if ( $type == 'default' ) $code = '<span class="label">' . do_shortcode ($content) . '</span>';
		else {
			$code = '<span class="label label-'. $type . '">' . do_shortcode ($content) . '</span>';
		}
		return $code;
	}
	
	add_shortcode('ct_label', 'colortheme_labels');
}

/*
==============================================================================================
						Badges
==============================================================================================
*/
if (!function_exists('colortheme_badges')) {
	function colortheme_badges( $atts, $content = null ) {
		extract(shortcode_atts(array(			
			'type' => 'default'			
	    ), $atts));

		if ( $type == 'default' ) $code = '<span class="badge">' . do_shortcode ($content) . '</span>';
		else {
			$code = '<span class="badge badge-'. $type . '">' . do_shortcode ($content) . '</span>';
		}
		return $code;
	}
	
	add_shortcode('ct_badge', 'colortheme_badges');
}

/*
==============================================================================================
						Buttons
==============================================================================================
*/
if (!function_exists('colortheme_button')) {
	function colortheme_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'url' => '',						
			'style' => 'blue',
			'size' => 'medium',
			'type' => 'square',
			'target' => '_self'

	    ), $atts));

		
		$output = '';

		$output .= '<a class="color-button '. $style . ' ' . $size . ' ' . $type . '" target="' . $target . '" href="' . $url . '">' . do_shortcode( $content ) . '</a>';

		return $output;

	}
	
	add_shortcode('ct_button', 'colortheme_button');
}

/*
==============================================================================================
						Alerts
==============================================================================================
*/
if (!function_exists('colortheme_alerts')) {
	function colortheme_alerts( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => '',						
			'type' => 'success'			
	    ), $atts));

		if ( $title == '' ) $code = '<button type="button" class="close" data-dismiss="alert">&times;</button>';
		else $code = '<button type="button" class="close" data-dismiss="alert">&times;</button><h4>' . $title. '</h4>';

		return '<div class="alert alert-'. $type . '">' . $code . '' . do_shortcode ($content) . '</div>';

	}
	
	add_shortcode('ct_alert', 'colortheme_alerts');
}

/*
==============================================================================================
						Progress Bars
==============================================================================================
*/
if (!function_exists('colortheme_progress_bars')) {
	function colortheme_progress_bars( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'type' => 'success',
			'striped' => 'yes',
			'animation' => 'yes',
			'value' => '50',
			'title' => ''

	    ), $atts));

		if ( $striped == 'yes' ) $striped = 'progress-striped'; else $striped = '';
		if ( $animation == 'yes' ) $active = 'active'; else $active = '';
		return '<div class="progress '. $striped . ' ' . $active . '"><div class="bar bar-' . $type . '" style="width: '. $value .'%">'. $title .' (' . $value . '%)</div></div>';

	}
	
	add_shortcode('ct_progress', 'colortheme_progress_bars');
}

/*
==============================================================================================
						Font Awesome Icons
==============================================================================================
*/
if (!function_exists('colortheme_icons')) {
	function colortheme_icons( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => 'Icon Title',
			'icon' => 'icon-home',
			'size' => '',
			'color' => '',
			'position' => 'left'
	    ), $atts));

		$code .= '<i class="icon icon-' . $icon . ' pull-' . $position . '" style="font-size: ' . $size . 'px; color: ' . $color . ';"></i>'. do_shortcode($title);

    	return $code;

	}
	
	add_shortcode('ct_icon', 'colortheme_icons');
}

/*
==============================================================================================
						Soundcloud Shortcode
==============================================================================================
*/
if (!function_exists('colortheme_soundcloud')) {
	function colortheme_soundcloud( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => 'Title',
			'url' => '',
			'height' => '200',
			'auto_play' => 'no'
	
	    ), $atts));

		$code = '';
		if ( $auto_play == 'yes' ) $auto_play = 'true'; else $auto_play = 'false';

		$code .= '<div class="soundcloud-shortcode clearfix">';
			
			if ( $title != '' ) {
				$code .='<h3 class="short_title">' . $title . '</h3>';
			}	
				$code .= '<div class="soundcloud-iframe">';	
					$code .= '<iframe height="'.$atts['height'].'" src="https://w.soundcloud.com/player/?url=' . urlencode($url) . '&amp;auto_play=' . $auto_play .'"></iframe>';		
				$code .= '</div> <!-- /soundcloud-iframe -->';

			$code .= do_shortcode($content);

		$code .= '</div> <!-- /soundcloud-shortcode -->';

    	return $code;

	}
	
	add_shortcode('ct_soundcloud', 'colortheme_soundcloud');
}


/*
==============================================================================================
						Video Shortcode
==============================================================================================
*/
if (!function_exists('colortheme_video')) {
	function colortheme_video( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title' => 'Title',
			'type' => 'vimeo',
			'id' => '7449107'	
	    ), $atts));

		$code = '';
		
		$code .= '<div class="video-shortcode clearfix">';
			
			if ( $title != '' ) {
				$code .='<h3 class="short_title">' . $title . '</h3>';
			}	
					$code .= '<div class="video-post-widget">';
						if ( $type == 'vimeo' ) {
							$code .= '<iframe src="http://player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0&amp;"></iframe>';
						}
						if ( $type == 'youtube' ) {
							$code .= '<iframe src="http://www.youtube.com/embed/' . $id . '?autohide=1&amp;showinfo=0"></iframe>';
						}
						if ( $type == 'dailymotion' ) {
							$code .= '<iframe src="http://www.dailymotion.com/embed/video/' . $id . '?logo=0"></iframe>';
						}
					$code .= '</div> <!-- /video-post-widget -->';
						
				$code .= do_shortcode($content);
						
		$code .= '</div> <!-- /video-shortcode -->';

    	return $code;

	}
	
	add_shortcode('ct_video', 'colortheme_video');
}

/*-----------------------------------------------------------------------------------*/
/*	Infobox Shortcodes
/*-----------------------------------------------------------------------------------*/


/*if (!function_exists('colortheme_infobox')) {
	function colortheme_infobox( $atts, $content = null ) {
		$defaults = array();
		extract(shortcode_atts(array(
			'title'   => 'Title',
			'url' => '',
			'more' => 'Read More',
			'icon' => 'icon-home'

	    ), $atts));	

	
			$output = '';
		    $output .= '<div class="infobox clearfix">';
			    if ( $title != '' ) {
					$output .='<h3 class="short_title">' . $title . '</h3>';
				}	
		    	$output .= '<div class="icon-info-circle"><i class="icon icon-' . $icon . '"></i></div>';		    	
				$output .= '<p>' . do_shortcode ($content) . '</p>';	
				$output .= '<div class="clear"></div>';
				$output .= '<a href="' . $url . '">' . $more . '</a><div class="infobox-right-arrow"></div>';
		    $output .= '</div>';

		return $output;
	}
	add_shortcode( 'ct_infobox', 'colortheme_infobox' );
}*/

/*-----------------------------------------------------------------------------------*/
/*	Infoblock Shortcodes
/*-----------------------------------------------------------------------------------*/


if (!function_exists('colortheme_infoblock')) {
	function colortheme_infoblock( $atts, $content = null ) {
		$defaults = array();
		extract(shortcode_atts(array(
			'title'   => 'Title',
			'url' => '',
			'icon' => 'icon-home'

	    ), $atts));	

	
			$output = '';			

		    $output .= '<div class="infoblock clearfix">';
		    	$output .= '<div class="icon-infoblock"><i class="icon icon-' . $icon . '"></i></div>';

				$output .= '<div class="infoblock-info">';

				    if ( $title != '' ) {
						$output .='<h3 class="short_title">' . $title . '</h3>';
					}	
			    	
					$output .= '<p>' . do_shortcode ($content) . '</p>';	

				$output .= '</div>';

		    $output .= '</div>';

		return $output;
	}
	add_shortcode( 'ct_infoblock', 'colortheme_infoblock' );
}



/*-----------------------------------------------------------------------------------*/
/*	Tabs Shortcodes
/*-----------------------------------------------------------------------------------*/

if (!function_exists('ct_tabs')) {
	function ct_tabs( $atts, $content = null ) {
		$defaults = array();
		extract(shortcode_atts(array(
			'title'   => 'Tabs Shortcode Title'
	    ), $atts));		
		
		// Extract the tab titles for use in the tab widget.
		preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
		
		$tab_titles = array();
		if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
		
		$output = '';
		
		$i = 0;

		$time_id_collapse = rand();

		if ( $title != '' ) {
			$output .='<h3>' . $title . '</h3>';
		}	

		if( count($tab_titles) ){
		    $output .= '<div id="ct-tabs-'. $time_id_collapse .'" class="ct-tabs">';
			$output .= '<ul class="nav nav-tabs">';
			
			foreach( $tab_titles as $tab ){
				if ($i == 0) {
					$act = 'class="active"';					
					$i++;
				} else $act = '';

				$output .= '<li ' . $act .'><a href="#ct-tab-'. sanitize_title( $tab[0] ) .'" data-toggle="tab">' . $tab[0] . '</a></li>';

			}		    
		    
		    $output .= '</ul><div class="tab-content">';
		    $output .= do_shortcode( $content );
		    $output .= '</div></div>';		    
		} else {
			$output .= do_shortcode( $content );
		}
		
		return $output;
	}
	add_shortcode( 'ct_tabs', 'ct_tabs' );
}

if (!function_exists('ct_tab')) {
	function ct_tab( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );		

		$output = '';
		$output .= '<div id="ct-tab-'. sanitize_title( $title ) .'" class="tab-pane">'. do_shortcode( $content ) .'</div>';

		return $output;

	}
	add_shortcode( 'ct_tab', 'ct_tab' );
}

/*
==============================================================================================
						Toggle
==============================================================================================
*/
if (!function_exists('colortheme_toggle')) {
function colortheme_toggle( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'title' => 'Toggle Title',
	), $atts ) );
	
	$toggle_id = rand();

	$output =  '<div id="ct-accord-'. $toggle_id .'" class="accordion">';
			$output .= '<div class="accordion-group">';
					$output .= '<div class="accordion-heading">';
						$output .= '<a class="accordion-toggle" data-toggle="collapse" href="#' . $toggle_id . '">' . $title . '</a>';
					$output .= '</div>';

				$output .= '<div id="' . $toggle_id .'" class="accordion-body collapse">';
					$output .= '<div class="accordion-inner">';
						$output .= do_shortcode( $content );
					$output .= '</div>';
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		
	return $output;
}
	add_shortcode('ct_toggle', 'colortheme_toggle');
}

/*-----------------------------------------------------------------------------------*/
/*	Collapses Shortcodes
/*-----------------------------------------------------------------------------------*/
if (!function_exists('ct_collapses')) {
	function ct_collapses( $atts, $content = null ) {
		$defaults = array();
		extract(shortcode_atts(array(
			'title'   => 'Collapse Shortcode Title'
	    ), $atts));	

		
			$output = '';
		
			global $time_id_collapse;
			$time_id_collapse = rand();

			if ( $title != '' ) {
				$output .='<h3 class="short_title">' . $title . '</h3>';
			}	

		    $output .= '<div id="ct-accord-'. $time_id_collapse .'" class="accordion">';
				$output .= do_shortcode ($content);	
		    $output .= '</div>';

		return $output;
	}
	add_shortcode( 'ct_collapses', 'ct_collapses' );
}

if (!function_exists('ct_collapse')) {
	function ct_collapse( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		STATIC $i = 0;
		$i++;
		
		global $time_id_collapse;

		$output = '';
			$time_id = rand();
				$output .= '<div class="accordion-group">';
					$output .= '<div class="accordion-heading">';

					// Note!
					// You can use this code ( data-parent="#ct-accord-' . $time_id_collapse . '" ) for multiple toggles. 
					// Add this after data-toggle="collapse" 

						$output .= '<a class="accordion-toggle collapsed" href="#collapse-' . $i . '" data-toggle="collapse">' . $title . '</a>';

					$output .= '</div>';

					$output .= '<div id="collapse-'. $i .'" class="accordion-body collapse"><div class="accordion-inner">'. do_shortcode( $content ) .'</div></div>';

				$output .= '</div>';


		return $output;

	}
	add_shortcode( 'ct_collapse', 'ct_collapse' );
}



/*-----------------------------------------------------------------------------------*/
/*	Slider Shortcodes
/*-----------------------------------------------------------------------------------*/
if (!function_exists('ct_slider')) {
	function ct_slider( $atts, $content = null ) {
		$defaults = array();
		extract(shortcode_atts(array(
			'title'   => 'Slider Shortcode Title'
	    ), $atts));	

			$output = '';
			?>

	<?php		
			global $time_id_slider, $count_item;
			$time_id_slider = rand();

			if ( $title != '' ) {
				$output .='<h3 class="short_title">' . $title . '</h3>';
			}	

		    $output .= '<div id="ct-slider-'. $time_id_slider .'" class="carousel slide">';
		    	$output .= '<div class="carousel-inner">';
					$output .= do_shortcode ($content);	
				$output .= '</div> <!-- /carousel-inner -->';	
	
				$output .= '<a class="carousel-control left" href="#ct-slider-'. $time_id_slider .'" data-slide="prev">&lsaquo;</a>';
				$output .= '<a class="carousel-control right" href="#ct-slider-'. $time_id_slider .'" data-slide="next">&rsaquo;</a>';
		
		    $output .= '</div> <!-- /slider -->';
			 

		return $output;
	}
	add_shortcode( 'ct_slider', 'ct_slider' );
}

if (!function_exists('ct_slider_item')) {
	function ct_slider_item( $atts, $content = null ) {
		$defaults = array( 
			'title' => 'Item Title',
			'url'	=> '',
			'image' => ''
		 );
		extract( shortcode_atts( $defaults, $atts ) );
		
		STATIC $i = 0;
		$i++;
		
		global $count_item;

		$output = '';
		
	

			if ( $count_item == 0 ) {
				$output .= '<div class="item active">';
			} else {
				$output .= '<div class="item">';
			}	
				$output .= '<img src="'.$image.'" alt="" />';

					$output .= '<div class="carousel-caption">';
						$output .= '<h4><a href="' . $url . '">' . $title . '</a></h4>';
						$output .= '<p>' . do_shortcode( $content ) . '</p>';
					$output .= '</div> <!-- /carousel-caption -->';

			$output .= '</div> <!-- /item -->';

			$count_item++; 

		return $output;

	}
	add_shortcode( 'ct_slider_item', 'ct_slider_item' );
}




/*-----------------------------------------------------------------------------------*/
/*	Lists Shortcodes
/*-----------------------------------------------------------------------------------*/
if (!function_exists('colortheme_lists')) {
	function colortheme_lists( $atts, $content = null ) {
		$defaults = array();
		extract(shortcode_atts(array(
			'underline'  => ''
	    ), $atts));	

			$output = '';
		
			if ( $underline == 'yes' ) $under = ' underline'; else $under = '';

		    $output .= '<ul class="lists' . $under . '">';
				$output .= do_shortcode ($content);	
		    $output .= '</ul>';

		return $output;
	}
	add_shortcode( 'ct_ul', 'colortheme_lists' );
}

if (!function_exists('colortheme_lists_item')) {
	function colortheme_lists_item( $atts, $content = null ) {
		$defaults = array( 'title' => 'Tab' );
		extract( shortcode_atts( $defaults, $atts ) );
		
		$output = '';

			$output .= '<li>'. do_shortcode( $content ) .'</li>';

		return $output;

	}
	add_shortcode( 'ct_li', 'colortheme_lists_item' );
}

?>