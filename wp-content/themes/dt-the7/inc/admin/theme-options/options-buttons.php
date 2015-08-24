<?php
/**
 * Buttons.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title"	=> _x( "Buttons", 'theme-options', LANGUAGE_ZONE ),
	"menu_title"	=> _x( "Buttons", 'theme-options', LANGUAGE_ZONE ),
	"menu_slug"		=> "of-buttons-menu",
	"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Buttons', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * Buttons style.
 */
$options[] = array( "name" => _x("Buttons style", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

	$options["buttons-style"] = array(
		"name"		=> "&nbsp;",
		"id"		=> "buttons-style",
		"std"		=> "ios7",
		"type"		=> "radio",
		"options"	=> array(
			"ios7"	=> _x( "iOS 7", "theme-options", LANGUAGE_ZONE ),
			"flat"	=> _x( "Flat", "theme-options", LANGUAGE_ZONE ),
			"3d"	=> _x( "3D", "theme-options", LANGUAGE_ZONE )
		)
	);

$options[] = array( "type" => "block_end" );


/**
 * Buttons color.
 */
$options[] = array( "name" => _x("Buttons color", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

	////////////////////
	// Buttons color //
	////////////////////

	// radio
	$options["buttons-color_mode"] = array(
		"name"		=> _x( "Buttons color", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "buttons-color_mode",
		"std"		=> "accent",
		"type"		=> "radio",
		"show_hide"	=> array(
			'color' 	=> "buttons-mode-color",
			'gradient'	=> "buttons-mode-gradient"
		),
		"options"	=> $background_acc_col_grad_mode
	);

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "buttons-color_mode buttons-mode-color" );

			//////////////
			// Color //
			//////////////

			// colorpicker
			$options["buttons-color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "buttons-color",
				"std"	=> "#ffffff",
				"type"	=> "color"
			);

		$options[] = array( "type" => "js_hide_end" );

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "buttons-color_mode buttons-mode-gradient" );

			/////////////////
			// Gradient //
			/////////////////

			// colorpicker
			$options["buttons-color_gradient"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "buttons-color_gradient",
				"std"	=> array( '#ffffff', '#000000' ),
				"type"	=> "gradient"
			);

		$options[] = array( "type" => "js_hide_end" );

$options[] = array( "type" => "block_end" );


/**
 * Small, Medium, Big Buttons.
 */

$buttons = presscore_themeoptions_get_buttons_defaults();

foreach ( $buttons as $id=>$opts ) {

	$options[] = array(	"name" => _x($opts['desc'], 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		///////////////////
		// Font family //
		///////////////////

		// select
		$options[] = array(
			"name"      => _x( 'Font-family', 'theme-options', LANGUAGE_ZONE ),
			"id"        => "buttons-{$id}_font_family",
			"std"       => (!empty($opts['ff']) ? $opts['ff'] : "Open Sans"),
			"type"      => "web_fonts",
			"options"   => $merged_fonts,
		);

		/////////////////
		// Font size //
		/////////////////

		// slider
		$options[] = array(
			"name"      => _x( 'Font-size', 'theme-options', LANGUAGE_ZONE ),
			"id"        => "buttons-{$id}_font_size",
			"std"       => $opts['fs'], 
			"type"      => "slider",
			"options"   => array( 'min' => 9, 'max' => 120 ),
			"sanitize"  => 'font_size'
		);

		/////////////////
		// Uppercase //
		/////////////////

		// checkbox
		$options[] = array(
			"name"      => _x( 'Uppercase', 'theme-options', LANGUAGE_ZONE ),
			"id"        => "buttons-{$id}_uppercase",
			"type"      => 'checkbox',
			'std'       => $opts['uc']
		);

		///////////////////
		// Line height //
		///////////////////

		// slider
		$options[] = array(
			"name"        => _x( 'Line-height', 'theme-options', LANGUAGE_ZONE ),
			"id"        => "buttons-{$id}_line_height",
			"std"        => $opts['lh'], 
			"type"        => "slider",
		);

		/////////////////////
		// Border radius //
		/////////////////////

		// input
		$options[] = array(
			"name"		=> _x( "Border Radius (px)", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "buttons-{$id}_border_radius",
			"class"		=> "mini",
			"std"		=> $opts['border_radius'],
			"type"		=> "text",
			"sanitize"	=> "dimensions"
		);

	$options[] = array(	"type" => "block_end");
}
