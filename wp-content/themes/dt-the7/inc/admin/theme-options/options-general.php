<?php
/**
 * General.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Appearance', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Style.
	 */
	$options[] = array( "name" => _x("Style", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"		=> _x( "Style", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "general-style",
			"std"		=> "ios7",
			"type"		=> "radio",
			"options"	=> array(
				"ios7" => _x( "iOS 7  style", "theme-options", LANGUAGE_ZONE ),
				"minimalistic" => _x( "Minimalist style", "theme-options", LANGUAGE_ZONE )
			)
		);

	$options[] = array( "type" => "block_end" );

	/**
	 * Layout.
	 */
	$options[] = array(	"name" => _x('Layout', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// text
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x( 'Content width (in "px" or "%")', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> "general-content_width",
			"std"		=> '1200px', 
			"type"		=> "text",
			"sanitize"	=> 'css_width'
		);

		// radio
		$options[] = array(
			"name"		=> _x('Layout', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-layout',
			"std"		=> 'wide',
			"type"		=> 'radio',
			"options"	=> presscore_themeoptions_get_general_layout_options(),
			"show_hide"	=> array( "boxed" => true )
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin" );

			// text
			$options[] = array(
				"desc"		=> '',
				"name"		=> _x( 'Box width (in "px" or "%")', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> "general-box_width",
				"std"		=> '1320px', 
				"type"		=> "text",
				"sanitize"	=> 'css_width'
			);

		$options[] = array( "type" => "js_hide_end" );

		// title
		$options[] = array(
			"type" => 'title',
			"name" => _x('Background under the box', 'theme-options', LANGUAGE_ZONE)
		);

		// colorpicker
		$options[] = array(
			"name"	=> _x( 'Background color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "general-boxed_bg_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

		// background_img
		$options[] = array(
			'type' 			=> 'background_img',
			'id' 			=> 'general-boxed_bg_image',
			'name' 			=> _x( 'Add background image', 'theme-options', LANGUAGE_ZONE ),
			'preset_images' => $backgrounds_general_boxed_bg_image,
			'std' 			=> array(
				'image'			=> '',
				'repeat'		=> 'repeat',
				'position_x'	=> 'center',
				'position_y'	=> 'center'
			),
		);

		// checkbox
		$options[] = array(
			"name"      => _x( 'Fullscreen ', 'theme-options', LANGUAGE_ZONE ),
			"id"    	=> 'general-boxed_bg_fullscreen',
			"type"  	=> 'checkbox',
			'std'   	=> 0
		);

		// Fixed background
		$options[] = array(
			"name"      => _x( 'Fixed background ', 'theme-options', LANGUAGE_ZONE ),
			"id"    	=> 'general-boxed_bg_fixed',
			"type"  	=> 'checkbox',
			'std'   	=> 0
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Background.
	 */
	$options[] = array(	"name" => _x('Background', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// colorpicker
		$options[] = array(
			"name"	=> _x( 'Color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "general-bg_color",
			"std"	=> "#252525",
			"type"	=> "color"
		);

		// slider
		$options[] = array(
			"name"      => _x( 'Opacity', 'theme-options', LANGUAGE_ZONE ),
			"id"        => "general-bg_opacity",
			"std"       => 100, 
			"type"      => "slider"
		);

		// background_img
		$options[] = array(
			'name' 			=> _x( 'Add background image', 'theme-options', LANGUAGE_ZONE ),
			'id' 			=> 'general-bg_image',
			'preset_images' => $backgrounds_general_bg_image,
			'std' 			=> array(
				'image'			=> '',
				'repeat'		=> 'repeat',
				'position_x'	=> 'center',
				'position_y'	=> 'center'
			),
			'type'			=> 'background_img'
		);

		// checkbox
		$options[] = array(
			"name"      => _x( 'Fullscreen', 'theme-options', LANGUAGE_ZONE ),
			"id"    	=> 'general-bg_fullscreen',
			"type"  	=> 'checkbox',
			'std'   	=> 0
		);

		// Fixed background
		$options[] = array(
			"type"  	=> 'checkbox',
			"id"    	=> 'general-bg_fixed',
			"name"      => _x( 'Fixed background', 'theme-options', LANGUAGE_ZONE ),
			"desc"      => _x( '"Fixed" setting isn\'t compatible with "overlapping" title area style.', 'theme-options', LANGUAGE_ZONE ),
			'std'   	=> 0
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Text.
	 */
	$options[] = array(	"name" => _x('Text', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// colorpicker
		$options[] = array(
			"desc" => '',
			"name"	=> _x( 'Headers color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "content-headers_color",
			"std"	=> "#252525",
			"type"	=> "color"
		);

		// colorpicker
		$options[] = array(
			"desc" => '',
			"name"	=> _x( 'Text color', 'theme-options', LANGUAGE_ZONE ),
			"id"	=> "content-primary_text_color",
			"std"	=> "#686868",
			"type"	=> "color"
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Color Accent.
	 */
	$options[] = array(	"name" => _x('Color Accent', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options["general-accent_color_mode"] = array(
			"name"		=> _x( "Accent color", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "general-accent_color_mode",
			"std"		=> "color",
			"type"		=> "radio",
			"show_hide"	=> array(
				'color' 	=> "general-accent_color_mode-color",
				'gradient'	=> "general-accent_color_mode-gradient"
			),
			"options"	=> array(
				"color"		=> _x( 'Solid Color', 'theme-options', LANGUAGE_ZONE ),
				"gradient"	=> _x( 'Gradient', 'theme-options', LANGUAGE_ZONE )
			)
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "general-accent_color_mode general-accent_color_mode-color" );

			// colorpicker
			$options["general-accent_bg_color"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "general-accent_bg_color",
				"std"	=> "#D73B37",
				"type"	=> "color"
			);

		$options[] = array( "type" => "js_hide_end" );

		// hidden area
		$options[] = array( "type" => "js_hide_begin", "class" => "general-accent_color_mode general-accent_color_mode-gradient" );

			// colorpicker
			$options["general-accent_bg_color_gradient"] = array(
				"name"	=> "&nbsp;",
				"id"	=> "general-accent_bg_color_gradient",
				"std"	=> array( '#ffffff', '#000000' ),
				"type"	=> "gradient"
			);

		$options[] = array( "type" => "js_hide_end" );

	$options[] = array(	"type" => "block_end");

	/**
	 * Border radius.
	 */
	$options[] = array(	"name" => _x('Border radius', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// input
		$options[] = array(
			"name"		=> _x( 'Border Radius (px)', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'general-border_radius',
			"std"		=> '8',
			"type"		=> 'text',
			"sanitize"	=> 'dimensions'
		);

	$options[] = array(	"type" => "block_end");


/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Custom CSS", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Custom css
	 */
	$options[] = array(	"name" => _x('Custom CSS', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// textarea
		$options[] = array(
			"settings"	=> array( 'rows' => 16 ),
			"id"		=> "general-custom_css",
			"std"		=> false,
			"type"		=> 'textarea',
			"sanitize"	=> 'without_sanitize'
		);

	$options[] = array(	"type" => "block_end");


/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Advanced", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Responsive.
	 */
	$options[] = array(	"name" => _x('Responsiveness', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"		=> _x('Responsive layout', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-responsive',
			"std"		=> '1',
			"type"		=> 'radio',
			'show_hide'	=> array( '1' => true ),
			"options"	=> $en_dis_options
		);

		// hidden area
		$options[] = array( "type" => "js_hide_begin" );

			$options[] = array( "type" => "divider" );

			// input
			$options[] = array(
				"name"		=> _x( "Collapse content to one column after (px)", "theme-options", LANGUAGE_ZONE ),
				"desc"		=> _x( "does not affect VC columns", "theme-options", LANGUAGE_ZONE ),
				"id"		=> "general-responsiveness-treshold",
				"std"		=> 800,
				"type"		=> "text",
				"class"		=> "mini",
				"sanitize"	=> "dimensions"
			);

		$options[] = array( "type" => "js_hide_end" );


	$options[] = array(	"type" => "block_end");

	/**
	 * High-DPI (retina) images.
	 */
	$options[] = array(	"name" => _x('High-DPI (retina) images', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"		=> _x('High-DPI (retina) images', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-hd_images',
			"std"		=> 'srcset_based',
			"type"		=> 'radio',
			"options"	=> array(
				'disabled' => _x('Disabled', 'theme-options', LANGUAGE_ZONE),
				'logos_only' => _x('Site logos only', 'theme-options', LANGUAGE_ZONE),
				'srcset_based' => _x('Srcset (recommended; widely used, though [now] not W3C valid)', 'theme-options', LANGUAGE_ZONE),
				'cookie_based' => _x('Generate on server (not recommended; will not work with caching plugins)', 'theme-options', LANGUAGE_ZONE),
			)
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Smooth scroll.
	 */
	$options[] = array(	"name" => _x('Smooth scroll', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"		=> _x('Enable "scroll-behaviour: smooth" for next gen browsers', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-smooth_scroll',
			"std"		=> 'on',
			"type"		=> 'radio',
			"options"	=> array(
				'on'			=> _x( 'Yes', 'theme-options', LANGUAGE_ZONE ),
				'off'			=> _x( 'No', 'theme-options', LANGUAGE_ZONE ),
				'on_parallax'	=> _x( 'On only on pages with parallax', 'theme-options', LANGUAGE_ZONE )
			)
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Beautiful loading.
	 */
	$options[] = array( "name" => _x("Beautiful loading", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

		$options[] = array(
			"name"		=> _x( "Beautiful loading", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "general-beautiful_loading",
			"std"		=> "accent",
			"type"		=> "radio",
			"options"	=> array(
				"disabled" => _x( "Disabled", "theme-options", LANGUAGE_ZONE ),
				"light" => _x( "Light", "theme-options", LANGUAGE_ZONE ),
				"accent" => _x( "Accent", "theme-options", LANGUAGE_ZONE )
			)
		);

	$options[] = array( "type" => "block_end" );
	

	/**
	 * Slugs
	 */
	$options[] = array( "name" => _x("Slugs", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

		// input
		$options[] = array(
			"name"		=> _x("Portfolio slug", "theme-options", LANGUAGE_ZONE),
			"id"		=> "general-post_type_portfolio_slug",
			"std"		=> "project",
			"type"		=> "text",
			"class"		=> "mini"
		);

		// input
		$options[] = array(
			"name"		=> _x("Albums slug", "theme-options", LANGUAGE_ZONE),
			"id"		=> "general-post_type_gallery_slug",
			"std"		=> "dt_gallery",
			"type"		=> "text",
			"class"		=> "mini"
		);

		// input
		$options[] = array(
			"name"		=> _x("Team slug", "theme-options", LANGUAGE_ZONE),
			"id"		=> "general-post_type_team_slug",
			"std"		=> "dt_team",
			"type"		=> "text",
			"class"		=> "mini"
		);

	$options[] = array( "type" => "block_end" );

	/**
	 * Contact form sends emails to:.
	 */
	$options[] = array( "name" => _x("Contact form sends emails to:", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

		// input
		$options[] = array(
			"name"		=> '&nbsp;',
			"id"		=> "general-contact_form_send_mail_to",
			"std"		=> "",
			"type"		=> "text",
			"sanitize"	=> 'email'
			// "class"		=> "mini",
		);

	$options[] = array( "type" => "block_end" );

	/**
	 * Tracking code
	 */
	$options[] = array(	"name" => _x('Tracking code (e.g. Google analytics) or arbitrary JavaScript', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// textarea
		$options[] = array(
			"settings"	=> array( 'rows' => 16 ),
			"id"		=> "general-tracking_code",
			"std"		=> false,
			"type"		=> 'textarea',
			"sanitize"	=> 'without_sanitize'
		);

	$options[] = array(	"type" => "block_end");
