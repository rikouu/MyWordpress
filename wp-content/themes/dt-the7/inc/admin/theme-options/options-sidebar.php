<?php
/**
 * Sidebar.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Sidebar", 'theme-options', LANGUAGE_ZONE ),
		"menu_title"	=> _x( "Sidebar", 'theme-options', LANGUAGE_ZONE ),
		"menu_slug"		=> "of-sidebar-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x( 'Sidebar', 'theme-options', LANGUAGE_ZONE ), "type" => "heading" );

// block begin
$options[] = array( "name" => _x( "Sidebar settings", "theme-options", LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"		=> _x( "Sidebar width (%)", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "sidebar-width",
		"std"		=> "30",
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name"		=> _x( "Vertical distance between widgets (px)", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "sidebar-vertical_distance",
		"std"		=> "60",
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name"		=> _x( "Sidebar", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "sidebar-visual_style",
		"std"		=> "with_dividers",
		"type"		=> "radio",
		"options"	=> array(
			'with_dividers' => _x( "Dividers", "theme-options", LANGUAGE_ZONE ),
			'with_bg' => _x( "Background behind whole sidebar", "theme-options", LANGUAGE_ZONE ),
			'with_widgets_bg' => _x( "Background behind each widget", "theme-options", LANGUAGE_ZONE ),
		),
		"show_hide"	=> array(
			'with_dividers' => array( "sidebar-dividers-vertical", "sidebar-dividers-horizontal" ),
			'with_bg' => array( "sidebar-bg-settings", "sidebar-dividers-horizontal" ),
			'with_widgets_bg' => "sidebar-bg-settings",
		)
	);

	$options[] = array( "type" => "js_hide_begin", "class" => "sidebar-visual_style sidebar-dividers-vertical" );
		$options[] = array(
			"name"		=> _x( "Vertical divider", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "sidebar-divider-vertical",
			"std"		=> "1",
			"type"		=> "radio",
			"options"	=> $en_dis_options
		);
	$options[] = array( "type" => "js_hide_end" );

	$options[] = array( "type" => "js_hide_begin", "class" => "sidebar-visual_style sidebar-dividers-horizontal" );
		$options[] = array(
			"name"		=> _x( "Dividers between widgets", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "sidebar-divider-horizontal",
			"std"		=> "1",
			"type"		=> "radio",
			"options"	=> $en_dis_options
		);
	$options[] = array( "type" => "js_hide_end" );

	$options[] = array( "type" => "js_hide_begin", "class" => "sidebar-visual_style sidebar-bg-settings" );
		$options[] = array(
			"desc"	=> '',
			"name"	=> _x( 'Background color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "sidebar-bg_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

		$options[] = array(
			'type' 			=> 'background_img',
			'id' 			=> 'sidebar-bg_image',
			"name" 			=> _x( 'Add background image', 'theme-options', LANGUAGE_ZONE ),
			'preset_images' => $backgrounds_sidebar_bg_image,
			'std' 			=> array(
				'image'			=> '',
				'repeat'		=> 'repeat',
				'position_x'	=> 'center',
				'position_y'	=> 'center',
			),
		);
	$options[] = array( "type" => "js_hide_end" );

// block end
$options[] = array( "type" => "block_end" );

// block begin
$options[] = array(	"name" => _x('Text', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	$options[] = array(
		"desc"	=> '',
		"name"	=> _x( 'Headers color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "sidebar-headers_color",
		"std"	=> "#000000",
		"type"	=> "color"
	);

	$options[] = array(
		"desc"	=> '',
		"name"	=> _x( 'Text color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "sidebar-primary_text_color",
		"std"	=> "#686868",
		"type"	=> "color"
	);

// block end
$options[] = array(	"type" => "block_end");
