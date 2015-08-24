<?php
/**
 * Footer.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// page
$options[] = array(
	"page_title"	=> _x( "Footer &amp; Bottom bar", 'theme-options', LANGUAGE_ZONE ),
	"menu_title"	=> _x( "Footer &amp; Bottom bar", 'theme-options', LANGUAGE_ZONE ),
	"menu_slug"		=> "of-footer-menu",
	"type"			=> "page"
);

// header
$options[] = array( "name" => _x( 'Footer', 'theme-options', LANGUAGE_ZONE ), "type" => "heading" );

//////////////////
// Footer style //
//////////////////

$options[] = array( "name" => _x( "Footer style", "theme-options", LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"		=> _x( "Footer background &amp; lines", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "footer-style",
		"std"		=> "content_width_line",
		"type"		=> "radio",
		"style"		=> "vertical",
		"options"	=> array(
			'content_width_line'	=> _x( "Content-width line", "theme-options", LANGUAGE_ZONE ),
			'full_width_line'		=> _x( "Full-width line", "theme-options", LANGUAGE_ZONE ),
			'transparent_bg_line'	=> _x( "Transparent background", "theme-options", LANGUAGE_ZONE ),
			'solid_background'		=> _x( "Solid background", "theme-options", LANGUAGE_ZONE )
		),
		'show_hide'	=> array(
			'solid_background'	=> "footer-solid-background-block"
		)
	);

	$options[] = array( "type" => "js_hide_begin", "class" => "footer-solid-background-block" );

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "footer-bg_color",
			"std"	=> "#1B1B1B",
			"type"	=> "color"
		);

		$options[] = array(
			'type' 			=> 'background_img',
			'name'			=> _x( 'Add background image', 'theme-options', LANGUAGE_ZONE ),
			'id'			=> 'footer-bg_image',
			'preset_images' => $backgrounds_footer_bg_image,
			'std' 			=> array(
				'image'			=> '',
				'repeat'		=> 'repeat',
				'position_x'	=> 'center',
				'position_y'	=> 'center',
			),
		);

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name"		=> _x( "Slide-out mode", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "footer-slide-out-mode",
			"std"		=> "0",
			"type"		=> "radio",
			"options"	=> $en_dis_options
		);

	$options[] = array( "type" => "js_hide_end" );

$options[] = array( "type" => "block_end" );

///////////////////////
// Footer font color //
///////////////////////

$options[] = array(	"name" => _x( 'Footer font color', 'theme-options', LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"	=> _x( 'Headers color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "footer-headers_color",
		"std"	=> "#ffffff",
		"type"	=> "color"
	);

	$options[] = array(
		"name"	=> _x( 'Content color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "footer-primary_text_color",
		"std"	=> "#828282",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

///////////////////
// Footer layout //
///////////////////

$options[] = array( "name" => _x( "Footer layout", "theme-options", LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"		=> _x( "Footer top &amp; bottom paddings (px)", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "footer-paddings-top-bottom",
		"std"		=> 44,
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"desc"		=> _x( "E.g. 20 pixel padding will give you 40 pixel gap between columns.", "theme-options", LANGUAGE_ZONE ),
		"name"		=> _x( "Paddings between footer columns (px)", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "footer-paddings-columns",
		"std"		=> 44,
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name"		=> _x( "Layout", "theme-options", LANGUAGE_ZONE ),
		"desc"		=> _x( 'E.g. "1/4+1/4+1/2"', "theme-options", LANGUAGE_ZONE ),
		"id"		=> "footer-layout",
		"std"		=> "1/4+1/4+1/4+1/4",
		"type"		=> "text",
		// "class"		=> "mini"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name"		=> _x( "Collapse to one column after (px)", "theme-options", LANGUAGE_ZONE ),
		"desc"		=> _x( "Won't have any effect if responsiveness is disabled.", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "footer-collapse_after",
		"std"		=> 760,
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "dimensions"
	);

$options[] = array( "type" => "block_end" );

////////////////
// Bootom bar //
////////////////

$options[] = array( "name" => _x( "Bottom bar", "theme-options", LANGUAGE_ZONE ), "type" => "heading" );

//////////////////////
// Bottom bar style //
//////////////////////

$options[] = array( "name" => _x( "Bottom bar style", "theme-options", LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"		=> _x( "Bottom bar background &amp; lines", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "bottom_bar-style",
		"std"		=> "content_width_line",
		"type"		=> "radio",
		"options"	=> array(
			'content_width_line'	=> _x( "Content-width line", "theme-options", LANGUAGE_ZONE ),
			'full_width_line'		=> _x( "Full-width line", "theme-options", LANGUAGE_ZONE ),
			'solid_background'		=> _x( "Solid background", "theme-options", LANGUAGE_ZONE )
		),
		'show_hide'	=> array(
			'solid_background'	=> "bottom-bar-solid-background-block"
		)
	);

	$options[] = array( "type" => "js_hide_begin", "class" => "bottom-bar-solid-background-block" );

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "bottom_bar-bg_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

		$options[] = array(
			'type' 			=> 'background_img',
			'id'			=> 'bottom_bar-bg_image',
			'name' 			=> _x( 'Add background image', 'theme-options', LANGUAGE_ZONE ),
			'preset_images' => $backgrounds_bottom_bar_bg_image,
			'std' 			=> $background_defaults,
		);

	$options[] = array( "type" => "js_hide_end" );

$options[] = array( "type" => "block_end" );

///////////////////////////
// Bottom bar font color //
///////////////////////////

$options[] = array(	"name" => _x( 'Bottom bar font color', 'theme-options', LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"	=> _x( 'Font color', 'theme-options', LANGUAGE_ZONE ),
		"id"	=> "bottom_bar-color",
		"std"	=> "#757575",
		"type"	=> "color"
	);

$options[] = array(	"type" => "block_end");

///////////////
// Text area //
///////////////

$options[] = array(	"name" => _x( 'Text area', 'theme-options', LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"		=> _x( 'Text area', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "bottom_bar-text",
		"std"		=> false,
		"type"		=> 'textarea'
	);

$options[] = array(	"type" => "block_end");
