<?php
/**
 * Page titles settings
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$page_title = _x( "Page titles", "theme-options", LANGUAGE_ZONE );

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> $page_title,
		"menu_title"	=> $page_title,
		"menu_slug"		=> "of-contentarea-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => $page_title, "type" => "heading" );

////////////////
// Title area //
////////////////

$options[] = array( "name" => _x( "Title area layout", "theme-options", LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"      => _x( 'Title area layout', 'theme-options', LANGUAGE_ZONE ),
		"id"        => "general-title_align",
		"std"       => 'left',
		"type"      => "images",
		"options"   => array(
			'left'		=> '/inc/admin/assets/images/l-r.gif',
			'right'		=> '/inc/admin/assets/images/r-l.gif',
			'all_left'	=> '/inc/admin/assets/images/l-l.gif',
			'all_right'	=> '/inc/admin/assets/images/r-r.gif',
			'center'	=> '/inc/admin/assets/images/centre.gif'
		)
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name"		=> _x( "Title area height (px)", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "general-title_height",
		"std"		=> "170",
		"class"		=> "mini",
		"type"		=> "text",
		"sanitize"	=> "slider"
	);

$options[] = array( "type" => "block_end" );

////////////////
// Page title //
////////////////

$options[] = array(	"name" => _x( "Page title", "theme-options", LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"		=> _x( "Page title", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "general-show_titles",
		"std"		=> "1",
		"type"		=> "radio",
		"show_hide"	=> array( "1" => true ),
		"options"	=> $en_dis_options
	);

	$options[] = array( 'type' => 'js_hide_begin' );

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name"		=> _x( "Title size", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "general-title_size",
			"std"		=> "normal",
			"class"		=> "mini",
			"type"		=> "select",
			"options"	=> array(
				'h1'		=> _x('h1', 'backend metabox', LANGUAGE_ZONE),
				'h2'		=> _x('h2', 'backend metabox', LANGUAGE_ZONE),
				'h3'		=> _x('h3', 'backend metabox', LANGUAGE_ZONE),
				'h4'		=> _x('h4', 'backend metabox', LANGUAGE_ZONE),
				'h5'		=> _x('h5', 'backend metabox', LANGUAGE_ZONE),
				'h6'		=> _x('h6', 'backend metabox', LANGUAGE_ZONE),
				'small'		=> _x('small', 'backend metabox', LANGUAGE_ZONE),
				'normal'	=> _x('medium', 'backend metabox', LANGUAGE_ZONE),
				'big'		=> _x('large', 'backend metabox', LANGUAGE_ZONE)
			)
		);

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name"	=> _x( "Title color", "theme-options", LANGUAGE_ZONE ),
			"id"	=> "general-title_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array(	"type" => "block_end");

/////////////////
// Breadcrumbs //
/////////////////

$options[] = array( "name" => _x( "Breadcrumbs", "theme-options", LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"		=> _x('Breadcrumbs', 'theme-options', LANGUAGE_ZONE),
		"id"		=> 'general-show_breadcrumbs',
		"std"		=> '1',
		"type"		=> 'radio',
		"show_hide"	=> array( "1" => true ),
		"options"	=> $en_dis_options
	);

	$options[] = array( 'type' => 'js_hide_begin' );

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name"	=> _x( "Breadcrumbs color", "theme-options", LANGUAGE_ZONE ),
			"id"	=> "general-breadcrumbs_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name"		=> _x( "Breadcrumbs background color", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "general-breadcrumbs_bg_color",
			"std"		=> "disabled",
			"type"		=> "radio",
			"options"	=> array(
				'disabled'	=> _x('Disabled', 'backend metabox', LANGUAGE_ZONE),
				'black'		=> _x('Black', 'backend metabox', LANGUAGE_ZONE),
				'white'		=> _x('White', 'backend metabox', LANGUAGE_ZONE)
			)
		);

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array( "type" => "block_end" );

///////////////////////
// Title area style //
///////////////////////
$options[] = array( "name" => _x( "Title area style", "theme-options", LANGUAGE_ZONE ), "type" => "block_begin" );

	$options[] = array(
		"name"		=> _x( "Title background &amp; lines", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "general-title_bg_mode",
		"std"		=> "content_line",
		"type"		=> "radio",
		// "style"		=> "vertical",
		"options"	=> array(
			"disabled"			=> _x( 'Disabled', 'theme-options', LANGUAGE_ZONE ),
			"content_line"		=> _x( 'Content-width line', 'theme-options', LANGUAGE_ZONE ),
			"fullwidth_line"	=> _x( 'Full-width line', 'theme-options', LANGUAGE_ZONE ),
			"transparent_bg"	=> _x( 'Transparent background', 'theme-options', LANGUAGE_ZONE ),
			"background"		=> _x( 'Solid background', 'theme-options', LANGUAGE_ZONE )
		),
		"show_hide"	=> array(
			"background" => true
		),
	);

	$options[] = array( 'type' => 'js_hide_begin' );

		$options[] = array( "type" => "divider" );

		$options[] = array(
			'name'    		=> _x( "Title background style", "theme-options", LANGUAGE_ZONE ),
			'id'      		=> "header-background",
			'type'    		=> 'images',
			'std'			=> 'normal',
			'options'		=> array(
				'normal'		=> array(
					'src' => '/inc/admin/assets/images/regular.gif',
					'title' => _x( 'Normal', 'theme-options', LANGUAGE_ZONE ),
					'title_width' => 100
				),
				'overlap'		=> array(
					'src' => '/inc/admin/assets/images/overl.gif',
					'title' => _x( "Overlapping (doesn't work with side header &amp; Photo scroller)", 'theme-options', LANGUAGE_ZONE ),
					'title_width' => 100
				),
				'transparent'	=> array(
					'src' => '/inc/admin/assets/images/transp.gif',
					'title' => _x( "Transparent (doesn't work with side header)", 'theme-options', LANGUAGE_ZONE ),
					'title_width' => 100
				),
			),
			'show_hide'	=> array(
				'transparent' => true
			)
		);

		// hidden open
		$options[] = array( "type" => "js_hide_begin" );

			$options[] = array( "type" => "divider" );

			$options[] = array(
				"type"		=> "radio",
				"id"		=> "header-style",
				"name"		=> _x( "Transparent  background", "theme-options", LANGUAGE_ZONE ),
				"std"		=> "solid_background",
				"options"	=> array(
					'solid_background' => _x( "Enabled", "theme-options", LANGUAGE_ZONE ),
					'disabled' => _x( "Disabled", "theme-options", LANGUAGE_ZONE )
				),
				'show_hide'	=> array(
					'solid_background' => true
				)
			);

			// hidden open
			$options[] = array( "type" => "js_hide_begin" );

				$options[] = array(
					'name'    		=> _x( 'Transparent background color', 'backend metabox', LANGUAGE_ZONE ),
					'id'      		=> "header-transparent_bg_color",
					'type'    		=> 'color',
					'std'			=> '#000000',
				);

				$options[] = array(
					'name'	=> _x( 'Transparent background opacity', 'backend metabox', LANGUAGE_ZONE ),
					'id'	=> "header-transparent_bg_opacity",
					'type'	=> 'slider',
					'std'	=> '50',
					'options' => array(
						'min' => 0,
						'max' => 100
					)
				);

			// hidden close
			$options[] = array( "type" => "js_hide_end" );

			$options[] = array(
				"name"		=> _x( 'Transparent header text color', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'header-menu_text_color_mode',
				"std"		=> 'light',
				"type"		=> 'radio',
				"options"	=> array(
					'light' => _x( 'Light', 'theme-options', LANGUAGE_ZONE ),
					'dark' => _x( 'Dark', 'theme-options', LANGUAGE_ZONE ),
					'theme' => _x( 'From Theme Options', 'theme-options', LANGUAGE_ZONE )
				)
			);

			$options[] = array(
				"name"		=> _x( 'Menu hover decoration color', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'header-menu_hover_color_mode',
				"std"		=> 'light',
				"type"		=> 'radio',
				"options"	=> array(
					'light' => _x( 'Light', 'theme-options', LANGUAGE_ZONE ),
					'dark' => _x( 'Dark', 'theme-options', LANGUAGE_ZONE ),
					'theme' => _x( 'From Theme Options', 'theme-options', LANGUAGE_ZONE )
				)
			);

			$options[] = array(
				"name"		=> _x( 'Transparent header layout elements color', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'header-menu_top_bar_color_mode',
				"std"		=> 'light',
				"type"		=> 'radio',
				"options"	=> array(
					'light' => _x( 'Light', 'theme-options', LANGUAGE_ZONE ),
					'dark' => _x( 'Dark', 'theme-options', LANGUAGE_ZONE ),
					'theme' => _x( 'From Theme Options', 'theme-options', LANGUAGE_ZONE )
				)
			);

		// hidden close
		$options[] = array( "type" => "js_hide_end" );

		$options[] = array( "type" => "divider" );

		$options[] = array(
			"name"	=> _x( "Background color", "theme-options", LANGUAGE_ZONE ),
			"id"	=> "general-title_bg_color",
			"std"	=> "#ffffff",
			"type"	=> "color"
		);

		$options[] = array(
			'type' 			=> 'background_img',
			'id' 			=> "general-title_bg_image",
			'name' 			=> _x( 'Add background image', 'theme-options', LANGUAGE_ZONE ),
			'preset_images' => $backgrounds_general_title_bg_image,
			'std' 			=> array(
				'image'			=> '',
				'repeat'		=> 'repeat',
				'position_x'	=> 'center',
				'position_y'	=> 'center'
			),
		);

		$options[] = array(
			"name"      => _x( 'Fullscreen ', 'theme-options', LANGUAGE_ZONE ),
			"id"    	=> "general-title_bg_fullscreen",
			"type"  	=> 'checkbox',
			'std'   	=> 0
		);

		$options[] = array(
			"name"      => _x( 'Fixed ', 'theme-options', LANGUAGE_ZONE ),
			"id"    	=> "general-title_bg_fixed",
			"type"  	=> 'checkbox',
			'std'   	=> 0
		);

		$options[] = array(
			"name"		=> _x( "Enable parallax &amp; Parallax speed", "theme-options", LANGUAGE_ZONE ),
			"id"		=> "general-title_bg_parallax",
			"std"		=> "0",
			"class"		=> "mini",
			"type"		=> "text"
		);

	$options[] = array( 'type' => 'js_hide_end' );

$options[] = array( "type" => "block_end" );
