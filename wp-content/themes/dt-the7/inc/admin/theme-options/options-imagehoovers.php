<?php
/**
 * Image Hovers.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Images Styling &amp; Hovers", 'theme-options', LANGUAGE_ZONE ),
		"menu_title"	=> _x( "Images Styling &amp; Hovers", 'theme-options', LANGUAGE_ZONE ),
		"menu_slug"		=> "of-imghoovers-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Images Styling &amp; Hovers', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * Styling.
 */
$options[] = array(	"name" => _x('Styling', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// radio
	$options['image_hover-style'] = array(
		"name"		=> _x('Image &amp; hover decoration', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'image_hover-style',
		"std"		=> 'none',
		"type"		=> 'radio',
		"options"	=> presscore_themeoptions_get_hoover_options()
	);

	// radio
	$options["image_hover-default_icon"] = array(
		"name"		=> _x( "Default hover icon", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "image_hover-default_icon",
		"std"		=> "white_icon",
		"type"		=> "radio",
		"options"	=> array(
			"none"			=> _x( 'No icon', 'theme-options', LANGUAGE_ZONE ),
			"white_icon"	=> _x( 'White icon', 'theme-options', LANGUAGE_ZONE )
		)
	);

$options[] = array(	"type" => "block_end");

/**
 * Hover color.
 */
$options[] = array(	"name" => _x('Hover color overlay', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	// radio
	$options["image_hover-color_mode"] = array(
		"name"		=> _x( "Hovers background color", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "image_hover-color_mode",
		"std"		=> "accent",
		"type"		=> "radio",
		"show_hide"	=> array(
			'color' 	=> "image-hover-color-mode-color",
			'gradient'	=> "image-hover-color-mode-gradient"
		),
		"options"	=> array(
			"accent"	=> _x( 'Accent', 'theme-options', LANGUAGE_ZONE ),
			"color"		=> _x( 'Custom color', 'theme-options', LANGUAGE_ZONE ),
			"gradient"	=> _x( 'Custom gradient', 'theme-options', LANGUAGE_ZONE )
		)
	);

	// hidden area
	$options[] = array( "type" => "js_hide_begin", "class" => "image_hover-color_mode image-hover-color-mode-color" );

		// colorpicker
		$options["image_hover-color"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "image_hover-color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

	$options[] = array( "type" => "js_hide_end" );

	// hidden area
	$options[] = array( "type" => "js_hide_begin", "class" => "image_hover-color_mode image-hover-color-mode-gradient" );

		// colorpicker
		$options["image_hover-color_gradient"] = array(
			"name"	=> "&nbsp;",
			"id"	=> "image_hover-color_gradient",
			"std"	=> array( '#ffffff', '#000000' ),
			"type"	=> "gradient"
		);

	$options[] = array( "type" => "js_hide_end" );

$options[] = array(	"type" => "block_end");

/**
 * Hover opacity.
 */
$options[] = array(	"name" => _x('Hover opacity', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

	//////////////////////////////////
	// Opacity for default hovers //
	//////////////////////////////////

	$options['image_hover-opacity'] = array(
		"desc"		=> '',
		"name"		=> _x( 'Background opacity for default hovers', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "image_hover-opacity",
		"std"		=> 100, 
		"type"		=> "slider",
	);

	/////////////////////////////////////////////
	// Opacity for hovers with text and icons //
	/////////////////////////////////////////////

	$options['image_hover-with_icons_opacity'] = array(
		"desc"		=> '',
		"name"		=> _x( 'Background opacity for hovers with text and icons', 'theme-options', LANGUAGE_ZONE ),
		"id"		=> "image_hover-with_icons_opacity",
		"std"		=> 100, 
		"type"		=> "slider",
	);

$options[] = array(	"type" => "block_end");
