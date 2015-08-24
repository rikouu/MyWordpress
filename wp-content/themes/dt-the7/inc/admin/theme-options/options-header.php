<?php
/**
 * Header.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$options[] = array(
	"type"			=> "page",
	"menu_slug"		=> "of-header-menu",
	"menu_title"	=> _x( "Header &amp; Top Bar", 'theme-options', LANGUAGE_ZONE ),
	"page_title"	=> _x( "Header &amp; Top Bar", 'theme-options', LANGUAGE_ZONE )
);


$options[] = array( "type" => "heading", "name" => _x( 'Top Bar', 'theme-options', LANGUAGE_ZONE ) );


$options[] = array(	"type" => "block_begin", "name" => _x( 'Top Bar', 'theme-options', LANGUAGE_ZONE ) );

	$options[] = array(
		"name"  => _x( 'Top bar font size', 'theme-options', LANGUAGE_ZONE ),
		"id"    => "top_bar-font_size",
		"std"   => "small",
		"type"  => "select",
		"options" => $font_sizes
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"desc"  => '',
		"name"  => _x( 'Top bar font color', 'theme-options', LANGUAGE_ZONE ),
		"id"    => "top_bar-text_color",
		"std"   => "#686868",
		"type"  => "color"
	);

	$options[] = array( "type" => "divider" );

	$options["top_bar-paddings"] = array(
		"name"		=> _x( "Top &amp; bottom paddings", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "top_bar-paddings",
		"std"		=> "",
		"type"		=> "text",
		"sanitize"	=> "slider"
	);

	$options[] = array( "type" => "divider" );

	$options["top_bar-bg_mode"] = array(
		"name"		=> _x( "Top bar background &amp; lines", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "top_bar-bg_mode",
		"std"		=> "content_line",
		"type"		=> "radio",
		"options"	=> array(
			"disabled" => _x( 'Disabled on desktop / Full-width line on mobile', 'theme-options', LANGUAGE_ZONE ),
			"content_line" => _x( 'Content-width line', 'theme-options', LANGUAGE_ZONE ),
			"fullwidth_line" => _x( 'Full-width line', 'theme-options', LANGUAGE_ZONE ),
			"solid" => _x( 'Solid background', 'theme-options', LANGUAGE_ZONE ),
		)
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name"	=> _x( 'Background (line) color', 'theme-options', LANGUAGE_ZONE ),
		"id"    => "top_bar-bg_color",
		"std"   => "#ffffff",
		"type"  => "color"
	);

	$options[] = array(
		"name"		=> _x( 'Background (line) opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "top_bar-bg_opacity",
		"std"		=> 100, 
		"type"		=> "slider"
	);

	$options[] = array(
		'name'			=> _x( 'Add background image', 'theme-options', LANGUAGE_ZONE ),
		'id' 			=> 'top_bar-bg_image',
		'preset_images' => $backgrounds_top_bar_bg_image,
		'std' 			=> array(
			'image'			=> '',
			'repeat'		=> 'repeat',
			'position_x'	=> 'center',
			'position_y'	=> 'center'
		),
		'type'			=> 'background_img'
	);

$options[] = array(	"type" => "block_end");


$options[] = array( "type" => "heading", "name" => _x( 'Header', 'theme-options', LANGUAGE_ZONE ) );


$options[] = array(	"type" => "block_begin", "name" => _x( 'Header', 'theme-options', LANGUAGE_ZONE ) );

	// radio
	$options[] = array(
		"name"		=> _x( "Header decoration", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-decoration",
		"std"		=> "shadow",
		"type"		=> "radio",
		"options"	=> array(
			'disabled' => _x( "Disabled", "theme-options", LANGUAGE_ZONE ),
			'shadow' => _x( "Shadow", "theme-options", LANGUAGE_ZONE ),
			'line' => _x( "Line", "theme-options", LANGUAGE_ZONE ),
		),
		"show_hide"	=> array( 'line' => true )
	);

	// hidden area
	$options[] = array( "type" => "js_hide_begin" );

		// colorpicker
		$options[] = array(
			"name"	=> _x( "Color", "theme-options", LANGUAGE_ZONE ),
			"id"	=> "header-decoration_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

	$options[] = array( "type" => "js_hide_end" );

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"type"	=> "color",
		"id"	=> "header-bg_color",
		"name"	=> _x( 'Background color', 'theme-options', LANGUAGE_ZONE ),
		"std"	=> "#40FF40"
	);

	$options[] = array(
		"type" => "slider",
		"id" => "header-bg_opacity",
		"name" => _x( 'Background opacity', 'theme-options', LANGUAGE_ZONE ),
		"std" => 100
	);

	$options[] = array(
		'type' 			=> 'background_img',
		'id' 			=> 'header-bg_image',
		"name" 			=> _x( 'Add background image', 'theme-options', LANGUAGE_ZONE ),
		'preset_images' => $backgrounds_header_bg_image,
		'std' 			=> array(
			'image'			=> '',
			'repeat'		=> 'repeat',
			'position_x'	=> 'center',
			'position_y'	=> 'center',
		),
	);

	$options[] = array(
		"type"  	=> 'checkbox',
		"id"    	=> 'header-bg_fullscreen',
		"name"      => _x( 'Fullscreen ', 'theme-options', LANGUAGE_ZONE ),
		'std'   	=> 0
	);

	$options[] = array(
		"type"  	=> 'checkbox',
		"id"    	=> 'header-bg_fixed',
		"name"      => _x( 'Fixed background ', 'theme-options', LANGUAGE_ZONE ),
		'std'   	=> 0
	);

$options[] = array(	"type" => "block_end");


$options[] = array( "type" => "heading", "name" => _x( 'Main menu', 'theme-options', LANGUAGE_ZONE ) );


$options[] = array( 'type' => 'block_begin', "name" => _x( 'Menu (first level navigation)', 'theme-options', LANGUAGE_ZONE ) );

	// select
	$options[] = array(
		"name"      => _x( 'Font', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "menu-font_family", // header-font_family
		"std"       => "Open Sans",
		"type"      => "web_fonts",
		"options"   => $merged_fonts,
	);

	// divider
	$options[] = array( "type" => "divider" );

	// slider
	$options[] = array(
		"name"      => _x( 'Font size', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "menu-font_size", // header-font_size
		"std"       => 16, 
		"type"      => "slider",
		"options"   => array( 'min' => 9, 'max' => 120 ),
		"sanitize"  => 'font_size'
	);

	// divider
	$options[] = array( "type" => "divider" );

	// checkbox
	$options[] = array(
		"name"      => _x( 'Uppercase ', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "menu-font_uppercase", // header-font_uppercase
		"type"  	=> 'checkbox',
		'std'   	=> 0
	);

	// divider
	$options[] = array( "type" => "divider" );

	// checkbox
	$options[] = array(
		"name"      => _x( 'Show next level indicator arrows', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "menu-next_level_indicator", // header-next_level_indicator
		"type"  	=> 'checkbox',
		'std'   	=> 1
	);

	// divider
	$options[] = array( "type" => "divider" );

	// colorpicker
	$options[] = array(
		"desc"	=> '',
		"name"	=> _x( 'Font color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "menu-font_color", // header-font_color
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

	// divider
	$options[] = array( "type" => "divider" );

	// radio
	$options["menu-hover_font_color_mode"] = array(
		"name"		=> _x( "Hover font color", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "menu-hover_font_color_mode",
		"std"		=> "accent",
		"type"		=> "radio",
		"show_hide"	=> array(
			'color' 	=> "menu-hover-font-color-mode-color",
			'gradient'	=> "menu-hover-font-color-mode-gradient"
		),
		"options"	=> array(
			"accent"	=> _x( 'Accent', 'theme-options', LANGUAGE_ZONE ),
			"color"		=> _x( 'Custom color', 'theme-options', LANGUAGE_ZONE ),
			"gradient"	=> _x( 'Custom gradient', 'theme-options', LANGUAGE_ZONE )
		)
	);

	// hidden area
	$options[] = array( "type" => "js_hide_begin", "class" => "menu-hover_font_color_mode menu-hover-font-color-mode-color" );

		// colorpicker
		$options["menu-hover_font_color"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "menu-hover_font_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

	$options[] = array( "type" => "js_hide_end" );

	// hidden area
	$options[] = array( "type" => "js_hide_begin", "class" => "menu-hover_font_color_mode menu-hover-font-color-mode-gradient" );

		// colorpicker
		$options["menu-hover_font_color_gradient"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "menu-hover_font_color_gradient",
			"std"	=> array( '#ffffff', '#000000' ),
			"type"	=> "gradient"
		);

	$options[] = array( "type" => "js_hide_end" );

	// divider
	$options[] = array( "type" => "divider" );

	// radio
	$options["menu-decoration_style"] = array(
		"name"		=> _x( "Hover Decoration style", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "menu-decoration_style",
		"std"		=> "brackets",
		"type"		=> "radio",
		"options"	=> array(
			"disabled" => _x( 'Disabled', 'theme-options', LANGUAGE_ZONE ),
			"background" => _x( 'Background', 'theme-options', LANGUAGE_ZONE ),
			"underline" => _x( 'Left to right', 'theme-options', LANGUAGE_ZONE ),
			"brackets" => _x( 'From centre', 'theme-options', LANGUAGE_ZONE ),
			"upwards" => _x( 'Upwards', 'theme-options', LANGUAGE_ZONE ),
			"downwards" => _x( 'Downwards', 'theme-options', LANGUAGE_ZONE )
		)
	);

	// divider
	$options[] = array( "type" => "divider" );

	// radio
	$options["menu-hover_decoration_color_mode"] = array(
		"name"		=> _x( "Hover decoration color", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "menu-hover_decoration_color_mode",
		"std"		=> "accent",
		"type"		=> "radio",
		"show_hide"	=> array(
			'color' 	=> "menu-hover-decoration-color-mode-color",
			'gradient'	=> "menu-hover-decoration-color-mode-gradient"
		),
		"options"	=> array(
			"accent"	=> _x( 'Accent', 'theme-options', LANGUAGE_ZONE ),
			"color"		=> _x( 'Custom color', 'theme-options', LANGUAGE_ZONE ),
			"gradient"	=> _x( 'Custom gradient', 'theme-options', LANGUAGE_ZONE )
		)
	);

	// hidden area
	$options[] = array( "type" => "js_hide_begin", "class" => "menu-hover_decoration_color_mode menu-hover-decoration-color-mode-color" );

		// colorpicker
		$options["menu-hover_decoration_color"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "menu-hover_decoration_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

	$options[] = array( "type" => "js_hide_end" );

	// hidden area
	$options[] = array( "type" => "js_hide_begin", "class" => "menu-hover_decoration_color_mode menu-hover-decoration-color-mode-gradient" );

		// colorpicker
		$options["menu-hover_decoration_color_gradient"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "menu-hover_decoration_color_gradient",
			"std"	=> array( '#ffffff', '#000000' ),
			"type"	=> "gradient"
		);

	$options[] = array( "type" => "js_hide_end" );

	// divider
	$options[] = array( "type" => "divider" );

	// slider
	$options["menu-iconfont_size"] = array(
		// "desc"		=> _x( 'Icons can be set up only for custom menus in Appearance / Menus', 'theme-options', LANGUAGE_ZONE ),
		"name"		=> _x( 'Menu icon size', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "menu-iconfont_size",
		"std"		=> 14, 
		"type"		=> "slider",
		"options"	=> array( "min" => 8, "max" => 50 )
	);

	// divider
	$options[] = array( "type" => "divider" );

	// text
	$options["menu-items_distance"] = array(
		"desc"		=> _x( 'Vertical or horizontal, depending on header layout.', 'theme-options', LANGUAGE_ZONE ),
		"name"		=> _x( 'Distance between menu items', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "menu-items_distance",
		"std"		=> '10', 
		"type"		=> "text",
		"sanitize"	=> 'dimensions'
	);

	// divider
	$options[] = array( "type" => "divider" );

	// input
	$options["header-bg_height"] = array(
		"desc"		=> _x( "Doesn't work for side header.", 'theme-options', LANGUAGE_ZONE ),
		"name"		=> _x( 'Menu height', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> 'header-bg_height',
		"std"		=> 90,
		"type"		=> 'text',
		"style"		=> 'mini',
		"sanitize"	=> 'dimensions'// abs value
	);

$options[] = array( "type" => "block_end" );


$options[] = array( "type" => "heading", "name" => _x( 'Floating menu', 'theme-options', LANGUAGE_ZONE ) );


$options[] = array(	"type" => "block_begin", "name" => _x( 'Floating menu', 'theme-options', LANGUAGE_ZONE ) );

	// radio
	$options[] = array(
		"name"		=> _x('Floating menu visibility', 'theme-options', LANGUAGE_ZONE),
		"dwsc"		=> _x('Only for some header layouts', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'header-show_floating_menu',
		"std"		=> '1',
		"type"		=> 'radio',
		"show_hide"	=> array( '1' => true ),
		"options"	=> array(
			'0' => _x('Hide', 'theme-options', LANGUAGE_ZONE),
			'1' => _x('Show', 'theme-options', LANGUAGE_ZONE)
		)
	);

	// hidden area
	$options[] = array( "type" => "js_hide_begin" );

		// divider
		$options[] = array( "type" => "divider" );

		// input
		$options["float_menu-height"] = array(
			"name"		=> _x( "Floating menu height (px)", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "float_menu-height",
			"std"		=> "100",
			"type"		=> "text",
			"sanitize"	=> "slider"
		);

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options[] = array(
			"name"		=> _x( "Floating menu background color", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "float_menu-bg_color_mode",
			"std"		=> "header_color",
			"type"		=> "radio",
			"show_hide"	=> array( "custom" => true ),
			"options"	=> array(
				"header_color" => _x('Header color', 'theme-options', LANGUAGE_ZONE),
				"custom" => _x('Custom color', 'theme-options', LANGUAGE_ZONE)
			)
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin" );

			// colorpicker
			$options[] = array(
				"name"	=> _x( "Floating menu custom background color", "theme-options", LANGUAGE_ZONE ),
				"id"	=> "float_menu-bg_color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);

		$options[] = array( "type" => "js_hide_end" );

		// divider
		$options[] = array( "type" => "divider" );

		// slider
		$options["float_menu-transparency"] = array(
			"name"		=> _x( "Floating menu transparency", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "float_menu-transparency",
			"std"		=> 100, 
			"type"		=> "slider",
		);

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options[] = array(
			"name"		=> _x( "Animation", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-floating_menu_animation",
			"std"		=> "fade",
			"type"		=> "radio",
			"options"	=> array(
				"fade" => _x('Fade', 'theme-options', LANGUAGE_ZONE),
				"slide" => _x('Slide', 'theme-options', LANGUAGE_ZONE)
			)
		);

	$options[] = array( "type" => "js_hide_end" );

$options[] = array(	"type" => "block_end");


$options[] = array( "type" => "heading", "name" => _x( 'Drop down menu', 'theme-options', LANGUAGE_ZONE ) );


$options[] = array( "type" => "block_begin", "name" => _x( "Drop down menu", "theme-options", LANGUAGE_ZONE ) );

	// select
	$options[] = array(
		"name"      => _x( 'Font', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "submenu-font_family", // header-font_family
		"std"       => "Open Sans",
		"type"      => "web_fonts",
		"options"   => $merged_fonts,
	);

	// divider
	$options[] = array( "type" => "divider" );

	// slider
	$options[] = array(
		"name"      => _x( 'Font size', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "submenu-font_size", // header-font_size
		"std"       => 16, 
		"type"      => "slider",
		"options"   => array( 'min' => 9, 'max' => 120 ),
		"sanitize"  => 'font_size'
	);

	// divider
	$options[] = array( "type" => "divider" );

	// checkbox
	$options[] = array(
		"name"      => _x( 'Uppercase ', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "submenu-font_uppercase", // header-font_uppercase
		"type"  	=> 'checkbox',
		'std'   	=> 0
	);

	// divider
	$options[] = array( "type" => "divider" );

	// checkbox
	$options[] = array(
		"name"      => _x( 'Show next level indicator arrows', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> "submenu-next_level_indicator", // header-next_level_indicator
		"type"  	=> 'checkbox',
		'std'   	=> 1
	);

	// divider
	$options[] = array( "type" => "divider" );

	// colorpicker
	$options[] = array(
		"desc"	=> '',
		"name"	=> _x( 'Font color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "submenu-font_color", // header-font_color
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

	// divider
	$options[] = array( "type" => "divider" );

	// radio
	$options["submenu-hover_font_color_mode"] = array(
		"name"		=> _x( "Hover font color", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "submenu-hover_font_color_mode",
		"std"		=> "accent",
		"type"		=> "radio",
		"show_hide"	=> array(
			'color' 	=> "submenu-hover-font-color-mode-color",
			'gradient'	=> "submenu-hover-font-color-mode-gradient"
		),
		"options"	=> array(
			"accent"	=> _x( 'Accent', 'theme-options', LANGUAGE_ZONE ),
			"color"		=> _x( 'Custom color', 'theme-options', LANGUAGE_ZONE ),
			"gradient"	=> _x( 'Custom gradient', 'theme-options', LANGUAGE_ZONE )
		)
	);

	// hidden area
	$options[] = array( "type" => "js_hide_begin", "class" => "submenu-hover_font_color_mode submenu-hover-font-color-mode-color" );

		// colorpicker
		$options["submenu-hover_font_color"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "submenu-hover_font_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

	$options[] = array( "type" => "js_hide_end" );

	// hidden area
	$options[] = array( "type" => "js_hide_begin", "class" => "submenu-hover_font_color_mode submenu-hover-font-color-mode-gradient" );

		// colorpicker
		$options["submenu-hover_font_color_gradient"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "submenu-hover_font_color_gradient",
			"std"	=> array( '#ffffff', '#000000' ),
			"type"	=> "gradient"
		);

	$options[] = array( "type" => "js_hide_end" );

	// divider
	$options[] = array( "type" => "divider" );

	// slider
	$options["submenu-iconfont_size"] = array(
		"name"		=> _x( 'Menu icon size', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "submenu-iconfont_size",
		"std"		=> 14, 
		"type"		=> "slider",
		"options"	=> array( "min" => 8, "max" => 50 )
	);

	// divider
	$options[] = array( "type" => "divider" );
	
	// text
	$options["submenu-items_distance"] = array(
		"desc"		=> '',
		"name"		=> _x( 'Distance between menu items', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "submenu-items_distance",
		"std"		=> '10', 
		"type"		=> "text",
		"sanitize"	=> 'dimensions'
	);

	// divider
	$options[] = array( "type" => "divider" );

	// colorpicker
	$options["submenu-bg_color"] = array(
		"name"	=> _x( 'Menu background color', 'theme-options', LANGUAGE_ZONE ),
		"id"    => "submenu-bg_color",
		"std"   => "#ffffff",
		"type"  => "color"
	);

	// divider
	$options[] = array( "type" => "divider" );

	// slider
	$options["submenu-bg_opacity"] = array(
		"desc"		=> '',
		"name"		=> _x( 'Menu background opacity', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "submenu-bg_opacity",
		"std"		=> 30, 
		"type"		=> "slider"
	);

	// divider
	$options[] = array( "type" => "divider" );

	// text
	$options["submenu-bg_width"] = array(
		"desc"		=> '',
		"name"		=> _x( 'Menu background width', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "submenu-bg_width",
		"std"		=> '10', 
		"type"		=> "text",
		"sanitize"	=> 'dimensions'
	);	

	// divider
	$options[] = array( "type" => "divider" );

	// checkbox
	$options["submenu-parent_clickable"] = array(
		"name"      => _x( 'Make parent menu items clickable', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> 'submenu-parent_clickable', // header-submenu_parent_clickable
		"type"  	=> 'checkbox',
		'std'   	=> 1
	);

$options[] = array( "type" => "block_end" );


$options[] = array( "type" => "heading", "name" => _x( 'Layout', 'theme-options', LANGUAGE_ZONE ) );


$options[] = array(	"type" => "block_begin", "name" => _x( 'Header layout', 'theme-options', LANGUAGE_ZONE ) );

	// images
	$options["header-layout"] = array(
		"desc"      => '',
		"name"      => _x('Choose layout', 'theme-options', LANGUAGE_ZONE),
		"id"        => "header-layout",
		"std"       => 'left',
		"type"      => "images",
		"show_hide"	=> array(
			'left' 				=> "header-layout-left",
			'center'			=> "header-layout-center",
			'classic'			=> "header-layout-classic",
			'side'				=> "header-layout-side"
		),
		"options"   => array(
			'side'				=> '/inc/admin/assets/images/small-side.gif',
			'left'				=> '/inc/admin/assets/images/small-right.gif',
			'classic'			=> '/inc/admin/assets/images/small-bottom.gif',
			'center'			=> '/inc/admin/assets/images/small-centre.gif'
			// /inc/admin/assets/images
		)
	);

	/**
	 * Left layout.
	 *
	 */

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-left' );

		// divider
		$options[] = array( "type" => "divider" );

		// checkbox
		$options[] = array(
			"name"	=> _x( "100% width", "theme-options", LANGUAGE_ZONE ),
			"id"	=> "header-left_layout_fullwidth",
			"type"	=> "checkbox",
			"std"	=> 0
		);

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-left_layout_elements_visibility"] = array(
			"name"		=> _x( "Additional header elements", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-left_layout_elements_visibility",
			"std"		=> "show",
			"type"		=> "radio",
			"show_hide"	=> array( "show" => true ),
			"options"	=> $show_hide_options
		);

		$options[] = array( 'type' => 'js_hide_begin' );

			// divider
			$options[] = array( "type" => "divider" );

			// sortables
			$options[] = array(
				"id"			=> "header-left_layout_elements",
				"std"			=> array(),
				"type"			=> 'sortable',
				"palette_title" => $header_layout_palette_title,
				"fields"		=> array_intersect_key( $header_layout_fields, array('top_bar_left' => '', 'top_bar_right' => '', 'nav_area' => '') ),
				"items"			=> $header_layout_elements
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'type' => 'js_hide_end' );

	/**
	 * Center layout.
	 *
	 */

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-center' );

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-center_menu_bg_mode"] = array(
			"name"		=> _x( "Menu background &amp; lines", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-center_menu_bg_mode",
			"std"		=> "content_line",
			"type"		=> "radio",
			"show_hide"	=> $background_dis_line_solid_mode_dependency,
			"options"	=> $background_dis_line_solid_mode
		);

		$options[] = array( "type" => "js_hide_begin" );

			$options[] = array(
				"name"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
				"id"    => "header-center_menu_bg_color",
				"std"   => "#ffffff",
				"type"  => "color"
			);

			$options[] = array(
				"name"		=> _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> "header-center_menu_bg_opacity",
				"std"		=> 100, 
				"type"		=> "slider"
			);

		$options[] = array( "type" => "js_hide_end" );

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-center_layout_elements_visibility"] = array(
			"name"		=> _x( "Additional header elements", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-center_layout_elements_visibility",
			"std"		=> "show",
			"type"		=> "radio",
			"show_hide"	=> array( "show" => true ),
			"options"	=> $show_hide_options
		);

		$options[] = array( 'type' => 'js_hide_begin' );

			// divider
			$options[] = array( "type" => "divider" );

			// sortables
			$options["header-center_layout_elements"] = array(
				"id"			=> "header-center_layout_elements",
				"std"			=> array(),
				"type"			=> 'sortable',
				"palette_title" => $header_layout_palette_title,
				"fields"		=> array_intersect_key( $header_layout_fields, array('top_bar_left' => '', 'nav_area' => '') ),
				"items"			=> $header_layout_elements
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'type' => 'js_hide_end' );

	/**
	 * Classic layout.
	 */

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-classic' );

		// divider
		$options[] = array( "type" => "divider" );

		// select
		$options["header-font_size_near_logo"] = array(
			"name"  => _x( 'Font size of elements near logo', 'theme-options', LANGUAGE_ZONE ),
			"id"    => "header-near_logo_font_size",
			"std"   => "small",
			"type"  => "select",
			"options" => $font_sizes
		);

		// divider
		$options[] = array( "type" => "divider" );

		// colorpicker
		$options["header-near_logo_bg_color"] = array(
			"name"	=> _x( 'Font color of elements near logo', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "header-near_logo_bg_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-classic_menu_bg_mode"] = array(
			"name"		=> _x( "Menu background &amp; lines", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-classic_menu_bg_mode",
			"std"		=> "content_line",
			"type"		=> "radio",
			"show_hide"	=> $background_dis_line_solid_mode_dependency,
			"options"	=> $background_dis_line_solid_mode
		);

		$options[] = array( "type" => "js_hide_begin" );

			$options[] = array(
				"name"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
				"id"    => "header-classic_menu_bg_color",
				"std"   => "#ffffff",
				"type"  => "color"
			);

			$options[] = array(
				"name"		=> _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> "header-classic_menu_bg_opacity",
				"std"		=> 100, 
				"type"		=> "slider"
			);

		$options[] = array( "type" => "js_hide_end" );

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-classic_layout_elements_visibility"] = array(
			"name"		=> _x( "Additional header elements", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-classic_layout_elements_visibility",
			"std"		=> "show",
			"type"		=> "radio",
			"show_hide"	=> array( "show" => true ),
			"options"	=> $show_hide_options
		);

		$options[] = array( 'type' => 'js_hide_begin' );

			// divider
			$options[] = array( "type" => "divider" );

			// sortables
			$options["header-classic_layout_elements"] = array(
				"id"			=> "header-classic_layout_elements",
				"std"			=> array(),
				"type"			=> 'sortable',
				"palette_title" => $header_layout_palette_title,
				"fields"		=> array_intersect_key( $header_layout_fields, array('top_bar_left' => '', 'top_bar_right' => '', 'nav_area' => '', 'logo_area' => '') ),
				"items"			=> $header_layout_elements
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'type' => 'js_hide_end' );

	/**
	 * Side layout.
	 *
	 */

	// hidden area
	$options[] = array( 'type' => 'js_hide_begin', 'class' => 'header-layout header-layout-side' );

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options[] = array(
			"name"		=> _x( "Menu visibility", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-side_menu_visibility",
			"std"		=> "always_visible",
			"type"		=> "radio",
			"options"	=> array(
				"always_visible" => _x( "Always visible", "theme-options", LANGUAGE_ZONE ),
				"sticky" => _x( "Show / hide on click", "theme-options", LANGUAGE_ZONE )
			)
		);

		// divider
		$options[] = array( "type" => "divider" );

		// text
		$options[] = array(
			"name"		=> _x( 'Menu width ("px" or "%")', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> "header-side_menu_width",
			"std"		=> '300px',
			"type"		=> "text",
			"sanitize"	=> 'css_width'
		);

		// divider
		$options[] = array( "type" => "divider" );

		// input
		$options["header-side_paddings"] = array(
			"name"		=> _x( "Side paddings", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-side_paddings",
			"std"		=> "",
			"type"		=> "text",
			"sanitize"	=> "slider"
		);

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-side_position"] = array(
			"name"		=> _x( "Header position", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-side_position",
			"std"		=> "left",
			"type"		=> "radio",
			"options"	=> array(
				"left" 	=> _x( "Left", "theme-options", LANGUAGE_ZONE ),
				"right" => _x( "Right", "theme-options", LANGUAGE_ZONE )
			)
		);

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-side_menu_align"] = array(
			"name"		=> _x( "Menu items align", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-side_menu_align",
			"std"		=> "left",
			"type"		=> "radio",
			"options"	=> array(
				"left" 		=> _x( "Left", "theme-options", LANGUAGE_ZONE ),
				"right" 	=> _x( "Right", "theme-options", LANGUAGE_ZONE ),
				"center" 	=> _x( "Centre", "theme-options", LANGUAGE_ZONE )
			)
		);

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-side_menu_lines"] = array(
			"name"		=> _x( "Lines between menu items", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-side_menu_lines",
			"std"		=> "1",
			"type"		=> "radio",
			"show_hide"	=> array( "1" => true ),
			"options"	=> $en_dis_options
		);

		$options[] = array( "type" => "js_hide_begin" );

			// slider
			$options[] = array(
				"name"	=> _x( "Lines color", "theme-options", LANGUAGE_ZONE ),
				"id"	=> "header-side_menu_lines_color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);

			// slider
			$options[] = array(
				"name"		=> _x( 'Lines opacity', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> "header-side_menu_lines_opacity",
				"std"		=> 100, 
				"type"		=> "slider"
			);

		$options[] = array( "type" => "js_hide_end" );

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options[] = array(
			"name"		=> _x( "Show drop down menu", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-side_menu_dropdown_style",
			"std"		=> "side",
			"type"		=> "radio",
			"options"	=> array(
				"side" => _x( "Sideways", "theme-options", LANGUAGE_ZONE ),
				"down" => _x( "Downwards", "theme-options", LANGUAGE_ZONE )
			)
		);

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-side_layout_elements_visibility"] = array(
			"name"		=> _x( "Additional header elements", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-side_layout_elements_visibility",
			"std"		=> "show",
			"type"		=> "radio",
			"show_hide"	=> array( "show" => true ),
			"options"	=> $show_hide_options
		);

		$options[] = array( 'type' => 'js_hide_begin' );

			// divider
			$options[] = array( "type" => "divider" );

			// sortables
			$options["header-side_layout_elements"] = array(
				"id"			=> "header-side_layout_elements",
				"std"			=> array(),
				"type"			=> 'sortable',
				"palette_title" => $header_layout_palette_title,
				"fields"		=> array_intersect_key( $header_layout_fields, array('top' => '', 'bottom' => '') ),
				"items"			=> $header_layout_elements
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array(	"type" => "block_end");


if ( class_exists( 'Woocommerce' ) ) {

	/**
	 * Woocommerce.
	 */
	$options[] = array(	"name" => _x('WooCommerce shopping cart', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// checkbox
		$options["header-woocommerce_cart_icon"] = array(
			"name"		=> _x('Show graphic icon', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'header-woocommerce_cart_icon',
			"std"		=> '1',
			"type"  	=> 'checkbox'
		);

		// divider
		$options[] = array( "type" => "divider" );

		// input
		$options["header-woocommerce_cart_caption"] = array(
			"name"		=> _x( "Caption", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-woocommerce_cart_caption",
			"std"		=> "Your cart",
			"type"		=> "text",
		);

		// divider
		$options[] = array( "type" => "divider" );

		// radio
		$options["header-woocommerce_counter_bg_mode"] = array(
			"name"		=> _x( "Products counter background", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "header-woocommerce_counter_bg_mode",
			"std"		=> "accent",
			"type"		=> "radio",
			"show_hide"	=> array(
				'color' 	=> "header-woocommerce-content-bg-mode-color",
				'gradient'	=> "header-woocommerce-content-bg-mode-gradient"
			),
			"options"	=> array(
				"accent"	=> _x( 'Accent', 'theme-options', LANGUAGE_ZONE ),
				"color"		=> _x( 'Custom color', 'theme-options', LANGUAGE_ZONE ),
				"gradient"	=> _x( 'Custom gradient', 'theme-options', LANGUAGE_ZONE )
			)
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "header-woocommerce_counter_bg_mode header-woocommerce-content-bg-mode-color" );

			// colorpicker
			$options["header-woocommerce_counter_bg_color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "header-woocommerce_counter_bg_color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);

		$options[] = array( "type" => "js_hide_end" );

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "header-woocommerce_counter_bg_mode header-woocommerce-content-bg-mode-gradient" );

			// colorpicker
			$options["header-woocommerce_counter_bg_color_gradient"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "header-woocommerce_counter_bg_color_gradient",
				"std"	=> array( '#ffffff', '#000000' ),
				"type"	=> "gradient"
			);

		$options[] = array( "type" => "js_hide_end" );

	$options[] = array(	"type" => "block_end");

}


$options[] = array(	"type" => "block_begin", "name" => _x('Search', 'theme-options', LANGUAGE_ZONE) );

	// checkbox
	$options["header-search_icon"] = array(
		"name"      => _x( 'Show graphic icon', 'theme-options', LANGUAGE_ZONE ),
		"id"    	=> 'header-search_icon',
		"std"		=> '1',
		"type"		=> 'checkbox',
	);

	// divider
	$options[] = array( "type" => "divider" );

	// input
	$options["header-search_caption"] = array(
		"name"		=> _x( "Caption", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-search_caption",
		"std"		=> _x( "Search", "theme-options", LANGUAGE_ZONE ),
		"type"		=> "text"
	);

$options[] = array(	"type" => "block_end");


$options[] = array(	"type" => "block_begin", "name" => _x('Contact information', 'theme-options', LANGUAGE_ZONE) );

	$contact_fields_count = count($contact_fields);
	$contact_fields_counter = 0;

	// contact fields
	foreach( $contact_fields as $field ) {
		$contact_fields_counter++;

		$options[] = array(
			"name"      => $field['desc'],
			"id"        => 'header-contact_' . $field['prefix'],
			"std"       => '',
			"type"      => 'text',
			"sanitize"	=> 'textarea'
		);

		// checkbox
		$options[] = array(
			"name" 	=> _x( 'Show graphic icon', 'theme-options', LANGUAGE_ZONE ),
			"id"    => 'header-contact_' . $field['prefix'] . '_icon',
			"type"  => 'checkbox',
			'std'   => 1
		);

		if ( $contact_fields_count > $contact_fields_counter ) {

			// divider
			$options[] = array( "type" => "divider" );

		}

	} // end contact fields

	unset( $contact_fields_count );
	unset( $contact_fields_counter );

$options[] = array(	"type" => "block_end");


$options[] = array(	"type" => "block_begin", "name" => _x('Login', 'theme-options', LANGUAGE_ZONE) );

	$options["header-login_icon"] = array(
		"name"		=> _x( 'Show graphic icon', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> 'header-login_icon',
		"std"		=> '1',
		"type"		=> 'checkbox',
	);

	$options[] = array( "type" => "divider" );

	$options["header-login_caption"] = array(
		"name"		=> _x( "Login caption", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-login_caption",
		"std"		=> _x( "Login", "theme-options", LANGUAGE_ZONE ),
		"type"		=> "text"
	);

	$options[] = array( "type" => "divider" );

	$options["header-logout_caption"] = array(
		"name"		=> _x( "Logout caption", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-logout_caption",
		"std"		=> _x( "Logout", "theme-options", LANGUAGE_ZONE ),
		"type"		=> "text"
	);

	$options[] = array( "type" => "divider" );

	$options["header-login_url"] = array(
		"name"		=> _x( "Link", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-login_url",
		"std"		=> "",
		"type"		=> "text"
	);

$options[] = array(	"type" => "block_end");


$options[] = array(	"type" => "block_begin", "name" => _x('Text', 'theme-options', LANGUAGE_ZONE) );

	// textarea
	$options[] = array(
		"id"		=> "header-text",
		"std"		=> false,
		"type"		=> 'textarea'
	);

$options[] = array(	"type" => "block_end");


$options[] = array(	"type" => "block_begin", "name" => _x('Social icons', 'theme-options', LANGUAGE_ZONE) );

	// colorpicker
	$options["header-soc_icon_color"] = array(
		"name"	=> _x( 'Icons color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "header-soc_icon_color",
		"std"	=> "#828282",
		"type"	=> "color"
	);

	// divider
	$options[] = array( "type" => "divider" );

	// radio
	$options["header-soc_icon_bg_color_mode"] = array(
		"name"		=> _x( "Icons background color", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-soc_icon_bg_color_mode",
		"std"		=> "accent",
		"type"		=> "radio",
		"show_hide"	=> array(
			'color'		=> "header-soc-icon-bg-mode-color",
			'gradient'	=> "header-soc-icon-bg-mode-gradient",
			'outline'	=> "header-soc-icon-bg-mode-color",
		),
		"options"	=> $background_dis_acc_col_grad_mode
	);

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "header-soc_icon_bg_color_mode header-soc-icon-bg-mode-color" );

			// colorpicker
			$options["header-soc_icon_bg_color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "header-soc_icon_bg_color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);

		$options[] = array( "type" => "js_hide_end" );

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "header-soc_icon_bg_color_mode header-soc-icon-bg-mode-gradient" );

			// colorpicker
			$options["header-soc_icon_bg_color_gradient"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "header-soc_icon_bg_color_gradient",
				"std"	=> array( '#ffffff', '#000000' ),
				"type"	=> "gradient"
			);

		$options[] = array( "type" => "js_hide_end" );

	// divider
	$options[] = array( "type" => "divider" );

	// colorpicker
	$options["header-soc_icon_hover_color"] = array(
		"name"	=> _x( 'Icons hover', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "header-soc_icon_hover_color",
		"std"	=> "#828282",
		"type"	=> "color"
	);

	// divider
	$options[] = array( "type" => "divider" );

	// radio
	$options["header-soc_icon_hover_bg_color_mode"] = array(
		"name"		=> _x( "Icons hover background color", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-soc_icon_hover_bg_color_mode",
		"std"		=> "accent",
		"type"		=> "radio",
		"show_hide"	=> array(
			'color'		=> "header-soc-icon-hover-bg-mode-color",
			'gradient'	=> "header-soc-icon-hover-bg-mode-gradient",
			'outline'	=> "header-soc-icon-hover-bg-mode-color",
		),
		"options"	=> $background_dis_acc_col_grad_mode
	);

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "header-soc_icon_hover_bg_color_mode header-soc-icon-hover-bg-mode-color" );

			// colorpicker
			$options["header-soc_icon_hover_bg_color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "header-soc_icon_hover_bg_color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);

		$options[] = array( "type" => "js_hide_end" );

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "header-soc_icon_hover_bg_color_mode header-soc-icon-hover-bg-mode-gradient" );

			// colorpicker
			$options["header-soc_icon_hover_bg_color_gradient"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "header-soc_icon_hover_bg_color_gradient",
				"std"	=> array( '#ffffff', '#000000' ),
				"type"	=> "gradient"
			);

		$options[] = array( "type" => "js_hide_end" );

	// divider
	$options[] = array( "type" => "divider" );

	// fields_generator
	$options[] = array(
		'id'        => 'header-soc_icons',
		'type'      => 'fields_generator',
		'std'       => array(
			array('icon' => '', 'url' => '')
		),
		'options'   => array(
			'fields' => array(
				'icon'   => array(
					'type'          => 'select',
					'class'         => 'of_fields_gen_title',
					'description'   => _x( 'Icon', 'theme-options', LANGUAGE_ZONE ),
					'wrap'          => '<label>%2$s%1$s</label>',
					'desc_wrap'     => '%2$s',
					'options'		=> presscore_get_social_icons_data()
				),
				'url'   => array(
					'type'          => 'text',
					'description'   => _x( 'Url', 'theme-options', LANGUAGE_ZONE ),
					'wrap'          => '<label>%2$s%1$s</label>',
					'desc_wrap'     => '%2$s'
				)
			)
		)
	);

$options[] = array(	"type" => "block_end");


$options[] = array( "type" => "heading", "name" => _x( "Mobile header", "theme-options", LANGUAGE_ZONE ) );


$options[] = array( "type" => "block_begin", "name" => _x( "First responsive switch point (tablet)", "theme-options", LANGUAGE_ZONE ) );

	$options[] = array(
		"name"		=> _x( "Switch after (px)", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-mobile-first_switch-after",
		"std"		=> "1024",
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "dimensions"
	);

	// divider
	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name"		=> _x( "Logo", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-mobile-first_switch-logo",
		"std"		=> "mobile",
		"type"		=> "radio",
		"options"	=> array(
			'desktop'	=> _x( "Desktop", "theme-options", LANGUAGE_ZONE ),
			'mobile'	=> _x( "Mobile", "theme-options", LANGUAGE_ZONE )
		)
	);

$options[] = array( "type" => "block_end" );

$options[] = array( "type" => "block_begin", "name" => _x( "Second responsive switch point (phone)", "theme-options", LANGUAGE_ZONE ) );

	$options[] = array(
		"name"		=> _x( "Switch after (px)", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-mobile-second_switch-after",
		"std"		=> "760",
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "dimensions"
	);

	// divider
	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name"		=> _x( "Logo", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-mobile-second_switch-logo",
		"std"		=> "mobile",
		"type"		=> "radio",
		"options"	=> array(
			'desktop'	=> _x( "Desktop", "theme-options", LANGUAGE_ZONE ),
			'mobile'	=> _x( "Mobile", "theme-options", LANGUAGE_ZONE )
		)
	);

$options[] = array( "type" => "block_end" );


$options[] = array( "type" => "block_begin", "name" => _x( "Menu colors", "theme-options", LANGUAGE_ZONE ) );

	$options[] = array(
		"name"		=> _x( "Menu colors", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-mobile-menu_color",
		"std"		=> "accent",
		"type"		=> "radio",
		"options"	=> array(
			'accent'	=> _x( "Accent", "theme-options", LANGUAGE_ZONE ),
			'custom'	=> _x( "Custom", "theme-options", LANGUAGE_ZONE )
		),
		"show_hide"	=> array(
			'custom'	=> 'header-mobile-menu-color-custom'
		)
	);

	// hidden area
	$options[] = array( "type" => "js_hide_begin", "class" => 'header-mobile-menu-color-custom' );

		// divider
		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name"	=> _x( "Background", "theme-options", LANGUAGE_ZONE ),
			"id"	=> "header-mobile-menu_color-background",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

		$options[] = array(
			"name"	=> _x( "Text", "theme-options", LANGUAGE_ZONE ),
			"id"	=> "header-mobile-menu_color-text",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

	$options[] = array( "type" => "js_hide_end" );

$options[] = array( "type" => "block_end" );

$options[] = array( "type" => "block_begin", "name" => _x( "Top bar", "theme-options", LANGUAGE_ZONE ) );

	$options[] = array(
		"name"		=> _x( "Top bar on mobile devices", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "header-mobile-top_bar_position",
		"std"		=> "closed",
		"type"		=> "radio",
		"options"	=> array(
			'closed'	=> _x( "Closed", "theme-options", LANGUAGE_ZONE ),
			'opened'	=> _x( "Opened", "theme-options", LANGUAGE_ZONE ),
			'disabled'	=> _x( "Disabled", "theme-options", LANGUAGE_ZONE )
		)
	);

$options[] = array( "type" => "block_end" );
