<?php
	/* Theme Color */
	if ( isset( $ct_options['ct_theme_color'] ) ) $theme_color = stripslashes ( $ct_options['ct_theme_color'] );

	/* Body background Color */
	if ( isset( $ct_options['ct_body_background'] ) ) $body_background = stripslashes ( $ct_options['ct_body_background'] );	

	/* Menu Position */
	if ( isset( $ct_options['ct_menu_position'] ) ) $menu_position = stripslashes ( $ct_options['ct_menu_position'] );	

	/* Menu Background Color */
	if ( isset( $ct_options['ct_menu_background'] ) ) $menu_background = stripslashes ( $ct_options['ct_menu_background'] );	

	/* Menu Item Shadow */
	if ( isset( $ct_options['ct_menu_item_shadow'] ) ) $menu_item_shadow = stripslashes ( $ct_options['ct_menu_item_shadow'] );	

	/* DropDown Menu Background Color */
	if ( isset( $ct_options['ct_dd_menu_background'] ) ) $dd_menu_background = stripslashes ( $ct_options['ct_dd_menu_background'] );	

	/* DropDown Menu Hover Background Color */
	if ( isset( $ct_options['ct_dd_menu_hover_background'] ) ) $dd_menu_hover_background = stripslashes ( $ct_options['ct_dd_menu_hover_background'] );	

	/* DropDown Menu Text Color */
	if ( isset( $ct_options['ct_dd_menu_text_color'] ) ) $dd_menu_text_color = stripslashes ( $ct_options['ct_dd_menu_text_color'] );	

	/* DropDown Menu Items Bottom Border */
	if ( isset( $ct_options['ct_menu_border'] ) ) $menu_border = $ct_options['ct_menu_border'];	

	/* Top Level Menu Font */
	if ( isset( $ct_options['ct_menu_font'] ) ) $menu_font = $ct_options['ct_menu_font'];	
	
	/* Top-level Menu Text-Transform */
	if ( isset( $ct_options['ct_menu_transform'] ) ) $menu_transform = $ct_options['ct_menu_transform'];	

	/* Links Color */
	if ( isset( $ct_options['ct_links_color'] ) ) $links_color = stripslashes ( $ct_options['ct_links_color'] );	
	if ( isset( $ct_options['ct_links_hover_color'] ) ) $links_hover_color = stripslashes ( $ct_options['ct_links_hover_color'] );	

	/* Homepage Columns */
	if ( isset( $ct_options['ct_homepage_columns'] ) ) $homepage_columns = stripslashes( $ct_options['ct_homepage_columns'] );

	/* Category page Columns */
	if ( isset( $ct_options['ct_categorypage_columns'] ) ) $categorypage_columns = stripslashes( $ct_options['ct_categorypage_columns'] );

	if ( isset( $ct_options['ct_pagination_type'] ) ) $pagination_type = stripslashes( $ct_options['ct_pagination_type'] );

	/* Get Pagination Type */
	$pagination_type = stripslashes( $ct_options['ct_pagination_type'] );

	/* Pagination Top Line Color */
	if ( isset( $ct_options['ct_pag_top_color'] ) ) $pag_top_color = stripslashes ( $ct_options['ct_pag_top_color'] );	

	/* Page Title Bar */
	if ( isset( $ct_options['ct_pagebar_bg_color'] ) ) $pagebar_bg_color = stripslashes ( $ct_options['ct_pagebar_bg_color'] );	
	if ( isset( $ct_options['ct_pagebar_bg_type'] ) ) $pagebar_bg_type = stripslashes ( $ct_options['ct_pagebar_bg_type'] );
	if ( isset( $ct_options['ct_pagebar_bg_repeat'] ) ) $pagebar_bg_repeat = stripslashes ( $ct_options['ct_pagebar_bg_repeat'] );	
	if ( isset( $ct_options['ct_pagebar_bg_position'] ) ) $pagebar_bg_position = stripslashes ( $ct_options['ct_pagebar_bg_position'] );	
	if ( isset( $ct_options['ct_pagebar_bg_upload'] ) ) $pagebar_bg_upload = stripslashes ( $ct_options['ct_pagebar_bg_upload'] );
	if ( isset( $ct_options['ct_pagebar_bg_predefined'] ) ) $pagebar_bg_predefined = stripslashes ( $ct_options['ct_pagebar_bg_predefined'] );

	/* Theme Predefined Colors */
	if ( isset( $ct_options['ct_predefined_theme_color'] ) ) $predefined_theme_color = strtolower( stripslashes ( $ct_options['ct_predefined_theme_color'] ) );	

	/* Headings Options: Size, Style, Color */
	if ( isset( $ct_options['ct_h_one'] ) ) $h_one = $ct_options['ct_h_one'];
	if ( isset( $ct_options['ct_h_two'] ) ) $h_two = $ct_options['ct_h_two'];
	if ( isset( $ct_options['ct_h_three'] ) ) $h_three = $ct_options['ct_h_three'];
	if ( isset( $ct_options['ct_h_four'] ) ) $h_four = $ct_options['ct_h_four'];
	if ( isset( $ct_options['ct_h_five'] ) ) $h_five = $ct_options['ct_h_five'];
	if ( isset( $ct_options['ct_h_six'] ) ) $h_six = $ct_options['ct_h_six'];

	/* Footer Background Color */
	if ( isset( $ct_options['ct_footer_background'] ) ) $footer_background = stripslashes ( $ct_options['ct_footer_background'] );	
	if ( isset( $ct_options['ct_footer_font'] ) ) $footer_font = $ct_options['ct_footer_font'];

	/* Single Post Meta Background */


	if ( isset( $ct_options['ct_single_meta_background'] ) ) $single_meta_background = stripslashes ( $ct_options['ct_single_meta_background'] );	
	

?>

<?php if ( $predefined_theme_color == 'custom' ) : ?>
/* Theme Color */
#logo { background-color: <?php echo $theme_color; ?>; }
.flex-carousel { border-top: 8px solid <?php echo $theme_color; ?>; border-bottom: 8px solid <?php echo $theme_color; ?>; }

.widget:hover .widget-title { border-bottom: 1px solid <?php echo $theme_color; ?>; }
.widget:hover .after-widget-title { background-color: <?php echo $theme_color; ?>; }

.pagination .current { background-color: <?php echo $theme_color; ?>; }
.pagination a:hover { background-color: <?php echo $theme_color; ?>; }

.to-top:hover { background-color: <?php echo $theme_color; ?>; }

.flex-direction-nav a:hover { background-color: <?php echo $theme_color; ?>; }

.input-append .add-on, .input-prepend .add-on {
	background-color: <?php echo $theme_color; ?>;
	border: 1px solid <?php echo $theme_color; ?>;
}

.recent-posts-widget .post-title a:hover,
.popular-posts-widget .post-title a:hover,
.small-slider .entry-title a:hover {
	color: <?php echo $theme_color; ?>;
}

.entry-single-meta { background-color: <?php echo $theme_color; ?>; }

.accordion-heading { background-color: <?php echo $theme_color; ?>; }

#wp-calendar td#today { background-color: <?php echo $theme_color; ?>; }

.overall_score, .overall_score .left_over_score { background-color: <?php echo $theme_color; ?>; }
<?php endif; // end Theme Custom Colors ?>

/* Body background Color */
body, .body_class { background-color: <?php echo $body_background; ?>; }

/* Menu Position */
<?php if ( $menu_position == 'Right') { ?>
	.navigation { float: right }
<?php } else { ?>
	.navigation { float: left }
<?php } ?>	

/* Menu Background Color */
.sf-menu li { background-color: <?php echo $menu_background; ?>; }

/* Menu Item Shadow */
<?php if ( $menu_item_shadow == 1 ) { ?>
	.sf-menu li {
		box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.3);
		-moz-box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.3);
		-webkit-box-shadow: 1px 2px 5px rgba(0, 0, 0, 0.3);
	}
<?php } else { ?>
	.sf-menu li {
		box-shadow: none;
		-moz-box-shadow: none;
		-webkit-box-shadow: none;
	}
<?php } ?>

/* DropDown Menu Background Color */
.sf-menu li ul li { background-color: <?php echo $dd_menu_background; ?>; }

/* DropDown Menu Hover Background Color */
.sf-menu ul > li:hover { background-color: <?php echo $dd_menu_hover_background; ?>; }

/* DropDown Menu Text Color */
.sf-menu .sub-menu li a { color: <?php echo $dd_menu_text_color; ?> !important; }

/* DropDown Menu Items Bottom Border */
.sf-menu ul li {
	border-bottom: <?php echo $menu_border['width']; ?>px <?php echo $menu_border['style']; ?> <?php echo $menu_border['color']; ?>; 
}

/* Top Level Menu Font And text-Transform */
.sf-menu a {
	text-transform: <?php echo $menu_transform; ?>;
	font-size: <?php echo $menu_font['size']; ?>;
	color: <?php echo $menu_font['color']; ?> !important;
	<?php if( $menu_font['style'] == 'normal' || $menu_font['style'] == 'italic') { ?>font-style: <?php echo $menu_font['style']; ?>;<?php } ?>	
	<?php if( $menu_font['style'] == 'bold' || $menu_font['style'] == 'bold italic') { ?>font-weight: <?php echo $menu_font['style']; ?>;<?php } ?>	
}

a, a:link, a:visited { color: <?php echo $links_color; ?>; }
a:hover { color: <?php echo $links_hover_color; ?>; }

/* Homepage Columns */
.post-block {
	<?php if ($homepage_columns == '3 Columns') echo 'width: 370px'; ?>
	<?php if ($homepage_columns == '4 Columns') echo 'width: 277px; margin-right: 20px; margin-bottom: 20px;'; ?>	
	<?php if ($homepage_columns == '5 Columns') echo 'width: 218px; margin-right: 20px; margin-bottom: 20px;'; ?>	
	
	<?php if ($homepage_columns == '1 Column + Sidebar') echo 'width: 770px; margin-right: 0; margin-bottom: 30px;'; ?>	
	<?php if ($homepage_columns == '2 Columns + Sidebar') echo 'width: 370px'; ?>		
	<?php if ($homepage_columns == '3 Columns + Sidebar') echo 'width: 243px; margin-right: 20px; margin-bottom: 20px;'; ?>			
}


/* Category page Columns */
.archive .post-block {
	<?php if ($categorypage_columns == '3 Columns') echo 'width: 370px;'; ?>
	<?php if ($categorypage_columns == '4 Columns') echo 'width: 277px; margin-right: 20px; margin-bottom: 20px;'; ?>	
	<?php if ($categorypage_columns == '5 Columns') echo 'width: 218px; margin-right: 20px; margin-bottom: 20px;'; ?>	

	<?php if ($categorypage_columns == '1 Column + Sidebar') echo 'width: 770px; margin-right: 0; margin-bottom: 20px;'; ?>
	<?php if ($categorypage_columns == '2 Columns + Sidebar') echo 'width: 366px;margin-right: 35px; margin-bottom: 35px;'; ?>		
	<?php if ($categorypage_columns == '3 Columns + Sidebar') echo 'width: 243px; margin-right: 20px; margin-bottom: 20px;'; ?>			
}

.search-results .post-block {
	<?php if ($categorypage_columns == '3 Columns') echo 'width: 370px;'; ?>
	<?php if ($categorypage_columns == '4 Columns') echo 'width: 277px; margin-right: 20px; margin-bottom: 20px;'; ?>	
	<?php if ($categorypage_columns == '5 Columns') echo 'width: 218px; margin-right: 20px; margin-bottom: 20px;'; ?>	

	<?php if ($categorypage_columns == '1 Column + Sidebar') echo 'width: 770px; margin-right: 0; margin-bottom: 20px;'; ?>
	<?php if ($categorypage_columns == '2 Columns + Sidebar') echo 'width: 366px;margin-right: 35px; margin-bottom: 35px;'; ?>		
	<?php if ($categorypage_columns == '3 Columns + Sidebar') echo 'width: 243px; margin-right: 20px; margin-bottom: 20px;'; ?>			
}

<?php 
	if ( $pagination_type != 'Infinite Scroll') {
?>
.pagination { display: inline-block; }		
.pagination-top-line, .pagination-top-line .center-line { display: block; }
.home .container-pagination { margin-top: 15px; }
.container-pagination { margin-bottom: 30px; }
<?php } ?>

.pagination-top-line , .pagination-top-line .center-line { background-color: <?php echo $pag_top_color; ?>; }

/* 
*	=================================================================================================================================================
*	Page Bar Title 
*	=================================================================================================================================================
*/

.page-title-bar {
	background-color: <?php echo $pagebar_bg_color; ?>;
}

<?php 
	if ( ( $pagebar_bg_type == 'Uploaded' ) ) $pagebar_image = $pagebar_bg_upload;
	if ( ( $pagebar_bg_type == 'Predefined' ) ) $pagebar_image = $pagebar_bg_predefined;
?>

.page-title-bar {
	<?php if( $pagebar_bg_type != 'None' ) { ?>
	background-image: url(<?php echo $pagebar_image; ?>);
	background-repeat: <?php echo $pagebar_bg_repeat; ?>;
	background-position: <?php echo $pagebar_bg_position; ?>
	<?php } ?>
}

/* Heading Styles */
h1 {
	color: <?php echo $h_one['color']; ?>;
	<?php if( $h_one['style'] == 'normal' || $h_one['style'] == 'italic') { ?>font-style: <?php echo $h_one['style']; ?>;<?php } ?>	
	<?php if( $h_one['style'] == 'bold' || $h_one['style'] == 'bold italic') { ?>font-weight: <?php echo $h_one['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_one['size']; ?>; 
	line-height: <?php echo $h_one['height']; ?>; 
}

h2 {
	color: <?php echo $h_two['color']; ?>;
	<?php if( $h_two['style'] == 'normal' || $h_two['style'] == 'italic') { ?>font-style: <?php echo $h_two['style']; ?>;<?php } ?>	
	<?php if( $h_two['style'] == 'bold' || $h_two['style'] == 'bold italic') { ?>font-weight: <?php echo $h_two['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_two['size']; ?>; 
	line-height: <?php echo $h_two['height']; ?>; 
}

h3 {
	color: <?php echo $h_three['color']; ?>;
	<?php if( $h_three['style'] == 'normal' || $h_three['style'] == 'italic') { ?>font-style: <?php echo $h_three['style']; ?>;<?php } ?>	
	<?php if( $h_three['style'] == 'bold' || $h_three['style'] == 'bold italic') { ?>font-weight: <?php echo $h_three['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_three['size']; ?>; 
	line-height: <?php echo $h_three['height']; ?>; 
}

h4 {
	color: <?php echo $h_four['color']; ?>;
	<?php if( $h_four['style'] == 'normal' || $h_four['style'] == 'italic') { ?>font-style: <?php echo $h_four['style']; ?>;<?php } ?>	
	<?php if( $h_four['style'] == 'bold' || $h_four['style'] == 'bold italic') { ?>font-weight: <?php echo $h_four['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_four['size']; ?>; 
	line-height: <?php echo $h_four['height']; ?>; 
}

h5 {
	color: <?php echo $h_five['color']; ?>;
	<?php if( $h_five['style'] == 'normal' || $h_five['style'] == 'italic') { ?>font-style: <?php echo $h_five['style']; ?>;<?php } ?>	
	<?php if( $h_five['style'] == 'bold' || $h_five['style'] == 'bold italic') { ?>font-weight: <?php echo $h_five['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_five['size']; ?>; 
	line-height: <?php echo $h_five['height']; ?>; 
}

h6 {
	color: <?php echo $h_six['color']; ?>;
	<?php if( $h_six['style'] == 'normal' || $h_six['style'] == 'italic') { ?>font-style: <?php echo $h_six['style']; ?>;<?php } ?>	
	<?php if( $h_six['style'] == 'bold' || $h_six['style'] == 'bold italic') { ?>font-weight: <?php echo $h_six['style']; ?>;<?php } ?>	
	font-size: <?php echo $h_six['size']; ?>; 
	line-height: <?php echo $h_six['height']; ?>; 
}

/* 
*	=================================================================================================================================================
*	Footer 
*	=================================================================================================================================================
*/

#footer { background-color: <?php echo $footer_background; ?>; } 

.copyright-info {
	color: <?php echo $footer_font['color']; ?>;
	font-size: <?php echo $footer_font['size']; ?>;	
}

/* 
*	=================================================================================================================================================
*	Single Post
*	=================================================================================================================================================
*/

.entry-single-meta {
	background-color: <?php echo $single_meta_background; ?>;
}