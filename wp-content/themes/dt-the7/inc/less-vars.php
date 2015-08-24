<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Themeoptions data.
 *
 */
function presscore_new_themeoptions_to_less( $options_inteface = array() ) {

	$image_defaults = array(
		'image'			=> '',
		'repeat'		=> 'repeat',
		'position_x'	=> 'center',
		'position_y'	=> 'center'
	);

	$font_family_falloff = ', Helvetica, Arial, Verdana, sans-serif';
	$font_family_defaults = array('family' => 'Open Sans');

	$logo_align = of_get_option( 'header-layout', 'left' );

	// $options_inteface[] = array_merge($options_inteface, array(

	/* Bootom Bar */
	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array('bottom-color'),
		'php_vars'	=> array( 'color' => array('bottom_bar-color', '#757575') )
	);

	$options_inteface[] = array(
		'type'		=> 'rgba_color',
		'less_vars'	=> array( 'bottom-bg-color' ),
		'php_vars'	=> array(
			'color' 	=> array( 'bottom_bar-bg_color', '#ffffff' ),
			'opacity'	=> array( '', 100 )
		),
	);

	$options_inteface[] = array(
		'type'		=> 'image',
		'less_vars'	=> array('bottom-bg-image', 'bottom-bg-repeat', 'bottom-bg-position-x', 'bottom-bg-position-y'),
		'php_vars'	=> array( 'image' => array('bottom_bar-bg_image', $image_defaults) ),
	);

	/* Fonts */
	$options_inteface[] = array(
		'type'		=> 'font',
		'wrap'		=> array('"', '"' . $font_family_falloff),
		'less_vars'	=> array('base-font-family', 'base-font-weight', 'base-font-style'),
		'php_vars'	=> array( 'font' => array('fonts-font_family', $font_family_defaults) ),
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array('', 'px'),
		'less_vars'	=> array('base-line-height'),
		'php_vars'	=> array( 'number' => array('fonts-line_height', 20) ),
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array('', 'px'),
		'less_vars'	=> array('base-font-size'),
		'php_vars'	=> array( 'number' => array('fonts-normal_size', 13) ),
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array('', 'px'),
		'less_vars'	=> array('text-small'),
		'php_vars'	=> array( 'number' => array('fonts-small_size', 11) ),
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array('', 'px'),
		'less_vars'	=> array('text-big'),
		'php_vars'	=> array( 'number' => array('fonts-big_size', 15) ),
	);

	/* Content Area */

	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'base-color' ),
		'php_vars'	=> array( 'color' => array('content-primary_text_color', '#686868') )
	);

	//////////////
	// Sidebar //
	//////////////

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array('', '%'),
		'less_vars'	=> array( 'sidebar-width' ),
		'php_vars'	=> array( 'number' => array( 'sidebar-width', 30 ) )
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array('', 'px'),
		'less_vars'	=> array( 'widget-sidebar-distace' ),
		'php_vars'	=> array( 'number' => array( 'sidebar-vertical_distance', 60 ) )
	);

	$options_inteface[] = array(
		'type' 		=> 'hex_color',
		'less_vars' => array( 'widget-sidebar-bg-color' ),
		'php_vars'	=> array( 'color' 	=> array('sidebar-bg_color', '#ffffff') )
	);

	$options_inteface[] = array(
		'type'		=> 'image',
		'less_vars'	=> array( 'widget-sidebar-bg-image', 'widget-sidebar-bg-repeat', 'widget-sidebar-bg-position-x', 'widget-sidebar-bg-position-y' ),
		'php_vars'	=> array( 'image' => array('sidebar-bg_image', $image_defaults) ),
	);

	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'widget-sidebar-color' ),
		'php_vars'	=> array( 'color' => array('sidebar-primary_text_color', '#686868') )
	);

	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'widget-sidebar-header-color' ),
		'php_vars'	=> array( 'color' => array('sidebar-headers_color', '#000000') )
	);

	/////////////
	// Footer //
	/////////////

	$options_inteface[] = array(
		'type' 		=> 'rgba_color',
		'less_vars' => array( 'footer-bg-color' ),
		'php_vars'	=> array(
			'color' 	=> array( 'footer-bg_color', '#1b1b1b' ),
			'opacity'	=> array( '', 100 )
		),
	);

	$options_inteface[] = array(
		'type'		=> 'image',
		'less_vars'	=> array( 'footer-bg-image', 'footer-bg-repeat', 'footer-bg-position-x', 'footer-bg-position-y' ),
		'php_vars'	=> array( 'image' => array('footer-bg_image', $image_defaults) ),
	);

	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'widget-footer-color' ),
		'php_vars'	=> array( 'color' => array('footer-primary_text_color', '#828282') )
	);

	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'widget-footer-header-color' ),
		'php_vars'	=> array( 'color' => array('footer-headers_color', '#ffffff') )
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'footer-paddings' ),
		'php_vars'	=> array( 'number' => array( 'footer-paddings-top-bottom', 44 ) )
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'widget-footer-padding' ),
		'php_vars'	=> array( 'number' => array( 'footer-paddings-columns', 44 ) )
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'footer-switch' ),
		'php_vars'	=> array( 'number' => array( 'footer-collapse_after', 760 ) )
	);

	/* Header */

	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'header-decoration' ),
		'php_vars'	=> array( 'color' => array('header-decoration_color', '#ffffff') )
	);

	// transparent header
	$options_inteface[] = array(
		'type' 		=> 'rgba_color',
		'less_vars' => array( 'header-transparent-bg-color' ),
		'php_vars'	=> array(
			'color' 	=> array( 'header-transparent_bg_color', '#000000' ),
			'opacity'	=> array( 'header-transparent_bg_opacity', 50 ),
		),
	);

	$options_inteface[] = array(
		'type'		=> 'image',
		'less_vars'	=> array( 'header-transparent-bg-image', 'header-transparent-bg-repeat', 'header-transparent-bg-position-x', 'header-transparent-bg-position-y' ),
		'php_vars'	=> array( 'image' => array('header-transparent_bg_image', $image_defaults) ),
	);

	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'navigation-info-color' ),
		'php_vars'	=> array( 'color' => array('header-contentarea_color', '#ffffff') )
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array('', 'px'),
		'less_vars'	=> array('header-height'),
		'php_vars'	=> array( 'number' => array('header-bg_height', 90) ),
	);

	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'submenu-color' ),
		'php_vars'	=> array( 'color' => array('header-submenu_color', '#3e3e3e') )
	);

	$options_inteface[] = array(
		'type'		=> 'font',
		'wrap'		=> array( '"', '"' . $font_family_falloff ),
		'less_vars'	=> array( 'menu-font-family', 'menu-font-weight', 'menu-font-style' ),
		'php_vars'	=> array( 'font' => array('header-font_family', $font_family_defaults) ),
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'menu-font-size' ),
		'php_vars'	=> array( 'number' => array('header-font_size', 16) ),
	);

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'menu-line-height' ),
		'php_vars'	=> array( 'number' => array('header-font_line_height', 30) ),
	);

	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'menu-color' ),
		'php_vars'	=> array( 'color' => array('header-font_color', '#ffffff') )
	);

	$options_inteface[] = array(
		'type' 		=> 'rgba_color',
		'less_vars' => array( 'navigation-bg-color', 'navigation-bg-color-ie' ),
		'php_vars'	=> array(
			'color' 	=> array('header-menu_bg_color', '#000000'),
			'opacity'	=> array('header-menu_bg_opacity', 1),
			'ie_color'	=> array('header-menu_bg_ie_color', '#000000'),
		),
	);

	$options_inteface[] = array(
		'type'		=> 'keyword',
		'interface'	=> array( '' => 'none', '1' => 'uppercase' ),
		'less_vars'	=> array( 'menu-text-transform' ),
		'php_vars'	=> array( 'keyword' => array('header-font_uppercase', '') ),
	);

	/* General */

	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'content-switch' ),
		'php_vars'	=> array( 'number' => array( 'general-responsiveness-treshold', 800 ) )
	);

	// #page bg
	$options_inteface[] = array(
		'type' 		=> 'rgba_color',
		'less_vars' => array( 'page-bg-color' ),
		'php_vars'	=> array(
			'color' 	=> array('general-bg_color', '#252525'),
			'opacity'	=> array('general-bg_opacity', 1)
		),
	);

	$options_inteface[] = array(
		'type'		=> 'image',
		'less_vars'	=> array( 'page-bg-image', 'page-bg-repeat', 'page-bg-position-x', 'page-bg-position-y' ),
		'php_vars'	=> array( 'image' => array('general-bg_image', $image_defaults) ),
	);

	$options_inteface[] = array(
		'type'		=> 'keyword',
		'interface'	=> array( '' => 'auto', '1' => 'cover' ),
		'less_vars'	=> array( 'page-bg-size' ),
		'php_vars'	=> array( 'keyword' => array('general-bg_fullscreen', '') ),
	);

	$options_inteface[] = array(
		'type'		=> 'keyword',
		'interface'	=> array( '' => '~""', '1' => 'fixed' ),
		'less_vars'	=> array( 'page-bg-attachment' ),
		'php_vars'	=> array( 'keyword' => array( 'general-bg_fixed', '' ) ),
	);

	// body bg
	$options_inteface[] = array(
		'type' 		=> 'hex_color',
		'less_vars' => array( 'body-bg-color' ),
		'php_vars'	=> array(
			'color' 	=> array('general-boxed_bg_color', '#252525'),
		),
	);

	$options_inteface[] = array(
		'type'		=> 'image',
		'less_vars'	=> array( 'body-bg-image', 'body-bg-repeat', 'body-bg-position-x', 'body-bg-position-y' ),
		'php_vars'	=> array( 'image' => array('general-boxed_bg_image', $image_defaults) ),
	);

	$options_inteface[] = array(
		'type'		=> 'keyword',
		'interface'	=> array( '' => 'auto', '1' => 'cover' ),
		'less_vars'	=> array( 'body-bg-size' ),
		'php_vars'	=> array( 'keyword' => array('general-boxed_bg_fullscreen', '') ),
	);

	$options_inteface[] = array(
		'type'		=> 'keyword',
		'interface'	=> array( '' => '~""', '1' => 'fixed' ),
		'less_vars'	=> array( 'body-bg-attachment' ),
		'php_vars'	=> array( 'keyword' => array('general-boxed_bg_fixed', '') ),
	);

	// boreder radius
	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array('', 'px'),
		'less_vars'	=> array( 'border-radius-size' ),
		'php_vars'	=> array( 'number' => array('general-border_radius', '8') )
	);

	// dividers
	// rest of declaration search at end of file
	$options_inteface[] = array(
		'type'		=> 'keyword',
		'less_vars'	=> array( 'divider-thick-switch' ),
		'php_vars'	=> array( 'keyword' => array('general-thick_divider_style', 'style-1') ),
	);

	///////////////////
	// Image hovers //
	///////////////////

	// plain bg opacity
	$options_inteface[] = array(
		'type' 		=> 'number',
		'wrap'		=> array('', '%'),
		'less_vars' => array( 'plain-hover-opacity' ),
		'php_vars'	=> array(
			'number' => array('image_hover-opacity', '100')
		),
	);

	// bg with text and icons opacity
	$options_inteface[] = array(
		'type' 		=> 'number',
		'wrap'		=> array('', '%'),
		'less_vars' => array( 'bg-hover-opacity' ),
		'php_vars'	=> array(
			'number' => array('image_hover-with_icons_opacity', '100')
		),
	);

	/* Slideshow */
	$options_inteface[] = array(
		'type' 		=> 'rgba_color',
		'less_vars' => array( 'main-slideshow-bg-color', 'main-slideshow-bg-color-ie' ),
		'php_vars'	=> array(
			'color' 	=> array('slideshow-bg_color', '#d74340'),
			'opacity'	=> array('slideshow-bg_opacity', 1),
			'ie_color'	=> array('slideshow-bg_ie_color', '#d74340'),
		),
	);
	
	$options_inteface[] = array(
		'type'		=> 'image',
		'less_vars'	=> array( 'main-slideshow-bg-image', 'main-slideshow-bg-repeat', 'main-slideshow-bg-position-x', 'main-slideshow-bg-position-y' ),
		'php_vars'	=> array( 'image' => array('slideshow-bg_image', $image_defaults) ),
	);

	$options_inteface[] = array(
		'type'		=> 'keyword',
		'interface'	=> array( '' => 'auto', '1' => 'cover' ),
		'less_vars'	=> array( 'main-slideshow-bg-size' ),
		'php_vars'	=> array( 'keyword' => array('slideshow-bg_fullscreen', '') ),
	);

	// ));

	/* Headers */
	if ( function_exists('presscore_themeoptions_get_headers_defaults') ) {

		foreach ( presscore_themeoptions_get_headers_defaults() as $id=>$opts ) {

			/* Fonts headers */

			$options_inteface[] = array(
				'type'		=> 'font',
				'wrap'		=> array('"', '"' . $font_family_falloff),
				'less_vars'	=> array( $id . '-font-family', $id . '-font-weight', $id . '-font-style' ),
				'php_vars'	=> array( 'font' => array('fonts-' . $id . '_font_family', $font_family_defaults) ),
			);

			$options_inteface[] = array(
				'type'		=> 'number',
				'wrap'		=> array('', 'px'),
				'less_vars'	=> array( $id . '-font-size' ),
				'php_vars'	=> array( 'number' => array('fonts-' . $id . '_font_size', $opts['fs']) ),
			);

			$options_inteface[] = array(
				'type'		=> 'number',
				'wrap'		=> array('', 'px'),
				'less_vars'	=> array( $id . '-line-height' ),
				'php_vars'	=> array( 'number' => array('fonts-' . $id . '_line_height', $opts['lh']) ),
			);

			$options_inteface[] = array(
				'type'		=> 'keyword',
				'interface'	=> array( '' => 'none', '1' => 'uppercase' ),
				'less_vars'	=> array( $id . '-text-transform' ),
				'php_vars'	=> array( 'keyword' => array('fonts-' . $id . '_uppercase', $opts['uc']) ),
			);

			/* Content Area */

			$options_inteface[] = array(
				'type'		=> 'hex_color',
				'less_vars'	=> array( $id . '-color' ),
				'php_vars'	=> array( 'color' => array('content-headers_color', '#252525') )
			);
		}

	}

	/* Buttons */
	if ( function_exists('presscore_themeoptions_get_buttons_defaults') ) {

		foreach ( presscore_themeoptions_get_buttons_defaults() as $id=>$opts ) {
			$options_inteface[] = array(
				'type'		=> 'font',
				'wrap'		=> array( '"', '"' . $font_family_falloff ),
				'less_vars'	=> array( 'dt-btn-' . $id . '-font-family', 'dt-btn-' . $id . '-font-weight', 'dt-btn-' . $id . '-font-style' ),
				'php_vars'	=> array( 'font' => array('buttons-' . $id . '_font_family', $font_family_defaults) ),
			);

			$options_inteface[] = array(
				'type'		=> 'number',
				'wrap'		=> array( '', 'px' ),
				'less_vars'	=> array( 'dt-btn-' . $id . '-font-size' ),
				'php_vars'	=> array( 'number' => array('buttons-' . $id . '_font_size', $opts['fs']) ),
			);

			$options_inteface[] = array(
				'type'		=> 'number',
				'wrap'		=> array( '', 'px' ),
				'less_vars'	=> array( 'dt-btn-' . $id . '-line-height' ),
				'php_vars'	=> array( 'number' => array('buttons-' . $id . '_line_height', $opts['lh']) ),
			);

			$options_inteface[] = array(
				'type'		=> 'keyword',
				'interface'	=> array( '' => 'none', '1' => 'uppercase' ),
				'less_vars'	=> array( 'dt-btn-' . $id . '-text-transform' ),
				'php_vars'	=> array( 'keyword' => array('buttons-' . $id . '_uppercase', $opts['uc']) ),
			);

			$options_inteface[] = array(
				'type'		=> 'number',
				'wrap'		=> array( '', 'px' ),
				'less_vars'	=> array( 'dt-btn-' . $id . '-border-radius' ),
				'php_vars'	=> array( 'number' => array('buttons-' . $id . '_border_radius', $opts['border_radius']) ),
			);
		}

	}

	/* Stripes */
	if ( function_exists('presscore_themeoptions_get_stripes_list') ) {

		foreach ( presscore_themeoptions_get_stripes_list() as $id=>$opts ) {

			// bg color
			$options_inteface[] = array(
				'type' 		=> 'rgba_color',
				'less_vars' => array( 'strype-' . $id . '-bg-color', 'strype-' . $id . '-bg-color-ie' ),
				'php_vars'	=> array(
					'color' 	=> array('stripes-stripe_' . $id . '_color', $opts['bg_color']),
					'opacity'	=> array('stripes-stripe_' . $id . '_opacity', $opts['bg_opacity']),
					'ie_color'	=> array('stripes-stripe_' . $id . '_ie_color', $opts['bg_color_ie']),
				),
			);

			// bg image
			$options_inteface[] = array(
				'type'		=> 'image',
				'less_vars'	=> array(
					'strype-' . $id . '-bg-image',
					'strype-' . $id . '-bg-repeat',
					'',
					'strype-' . $id . '-bg-position-y'
					),
				'php_vars'	=> array( 'image' => array('stripes-stripe_' . $id . '_bg_image', $opts['bg_img']) ),
				'wrap'		=> array(
					'image' 		=> array( '~"', '"' ),
					'repeat' 		=> array( '~"', '"' ),
					'position_y'	=> array( '~"', '"' ),
				),
			);

			// fullscreen bg see in special cases
			$options_inteface[] = array(
				'type'		=> 'keyword',
				'interface'	=> array( '' => 'auto', '1' => 'cover' ),
				'less_vars'	=> array( 'strype-' . $id . '-bg-size' ),
				'php_vars'	=> array( 'keyword' => array('stripes-stripe_' . $id . '_bg_fullscreen', $opts['bg_fullscreen']) ),
			);

			// headers color
			$options_inteface[] = array(
				'type'		=> 'hex_color',
				'less_vars'	=> array( 'strype-' . $id . '-header-color' ),
				'php_vars'	=> array( 'color' => array('stripes-stripe_' . $id . '_headers_color', $opts['text_header_color']) ),
				'wrap'		=> array( '~"', '"' ),
			);

			// text color
			$options_inteface[] = array(
				'type'		=> 'hex_color',
				'less_vars'	=> array( 'strype-' . $id . '-color' ),
				'php_vars'	=> array( 'color' => array('stripes-stripe_' . $id . '_text_color', $opts['text_color']) ),
				'wrap'		=> array( '~"', '"' ),
			);

		}

	}

	// ***********************************************************************************
	// Header & top bar colors
	// ***********************************************************************************

		// Header

		$options_inteface[] = array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'header-bg-color' ),
			'php_vars'	=> array(
				'color' 	=> array( 'header-bg_color', '#40FF40' ),
				'opacity'	=> array( 'header-bg_opacity', 100 )
			),
		);

		$options_inteface[] = array(
			'type'		=> 'image',
			'less_vars'	=> array( 'header-bg-image', 'header-bg-repeat', 'header-bg-position-x', 'header-bg-position-y' ),
			'php_vars'	=> array( 'image' => array( 'header-bg_image', $image_defaults ) ),
		);

		$options_inteface[] = array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'auto', '1' => 'cover' ),
			'less_vars'	=> array( 'header-bg-size' ),
			'php_vars'	=> array( 'keyword' => array( 'header-bg_fullscreen', '' ) ),
		);

		$options_inteface[] = array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => '~""', '1' => 'fixed' ),
			'less_vars'	=> array( 'header-bg-attachment' ),
			'php_vars'	=> array( 'keyword' => array( 'header-bg_fixed', '' ) ),
		);

		// Top bar

		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'top-color' ),
			'php_vars'	=> array( 'color' => array('top_bar-text_color', '#686868') ),
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'top-paddings'),
			'php_vars'	=> array( 'number' => array('top_bar-paddings', 10) )
		);

		$options_inteface[] = array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'top-bg-color' ),
			'php_vars'	=> array(
				'color' 	=> array( 'top_bar-bg_color', '#ffffff' ),
				'opacity'	=> array( 'top_bar-bg_opacity', 100 )
			)
		);

		$options_inteface[] = array(
			'type'		=> 'image',
			'less_vars'	=> array('top-bg-image', 'top-bg-repeat', 'top-bg-position-x', 'top-bg-position-y'),
			'php_vars'	=> array( 'image' => array('top_bar-bg_image', $image_defaults) ),
		);

		// Menu (first level navigation)

		$options_inteface[] = array(
			'type'		=> 'font',
			'wrap'		=> array( '"', '"' . $font_family_falloff ),
			'less_vars'	=> array( 'menu-font-family', 'menu-font-weight', 'menu-font-style' ),
			'php_vars'	=> array( 'font' => array('menu-font_family', $font_family_defaults) )
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'menu-font-size' ),
			'php_vars'	=> array( 'number' => array('menu-font_size', 16) )
		);

		$options_inteface[] = array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'none', '1' => 'uppercase' ),
			'less_vars'	=> array( 'menu-text-transform' ),
			'php_vars'	=> array( 'keyword' => array('menu-font_uppercase', '') )
		);

		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'menu-color' ),
			'php_vars'	=> array( 'color' => array('menu-font_color', '#ffffff') )
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'main-menu-icon-size' ),
			'php_vars'	=> array( 'number' => array('menu-iconfont_size', 14) )
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'menu-item-distance' ),
			'php_vars'	=> array( 'number' => array('menu-items_distance', 10) )
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'menu-paddings' ),
			'php_vars'	=> array( 'number' => array('menu-top_bottom_paddings', 10) )
		);

		// Floating menu

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'float-menu-height' ),
			'php_vars'	=> array( 'number' => array('float_menu-height', 100) )
		);

		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'float-menu-bg' ),
			'php_vars'	=> array( 'color' => array(
				( 'header_color' == of_get_option( 'float_menu-bg_color_mode', 'header_color' ) ? 'header-bg_color' : 'float_menu-bg_color' ),
				'#ffffff'
			) )
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', '%' ),
			'less_vars'	=> array( 'bg-opacity' ),
			'php_vars'	=> array( 'number' => array('float_menu-transparency', 100) )
		);

		// Drop down menu

		$options_inteface[] = array(
			'type'		=> 'font',
			'wrap'		=> array( '"', '"' . $font_family_falloff ),
			'less_vars'	=> array( 'submenu-font-family', 'submenu-font-weight', 'submenu-font-style' ),
			'php_vars'	=> array( 'font' => array('submenu-font_family', $font_family_defaults) )
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'submenu-font-size' ),
			'php_vars'	=> array( 'number' => array('submenu-font_size', 16) ),
		);

		$options_inteface[] = array(
			'type'		=> 'keyword',
			'interface'	=> array( '' => 'none', '1' => 'uppercase' ),
			'less_vars'	=> array( 'submenu-text-transform' ),
			'php_vars'	=> array( 'keyword' => array('submenu-font_uppercase', '') )
		);

		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array( 'submenu-color' ),
			'php_vars'	=> array( 'color' => array('submenu-font_color', '#ffffff') )
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'sub-menu-icon-size' ),
			'php_vars'	=> array( 'number' => array('submenu-iconfont_size', 14) )
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'submenu-item-distance' ),
			'php_vars'	=> array( 'number' => array('submenu-items_distance', 10) )
		);

		$options_inteface[] = array(
			'type' 		=> 'rgba_color',
			'less_vars' => array( 'submenu-bg-color' ),
			'php_vars'	=> array(
				'color' 	=> array('submenu-bg_color', '#ffffff'),
				'opacity'	=> array('submenu-bg_opacity', 100)
			),
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'submenu-width' ),
			'php_vars'	=> array( 'number' => array('submenu-bg_width', 10) )
		);

	// ***********************************************************************************
	// Logo
	// ***********************************************************************************

		// top logo
		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'logo-padding-top' ),
			'php_vars'	=> array( 'number' => array('header-logo_padding_top', '') )
		);

		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'logo-padding-bottom' ),
			'php_vars'	=> array( 'number' => array('header-logo_padding_bottom', '') )
		);

	// ***********************************************************************************
	// Header layout
	// ***********************************************************************************

		// default menu bg color
		$options_inteface[] = array(
			'type' 		=> 'rgb_color',
			'less_vars' => array( 'navigation-bg-color' ),
			'php_vars'	=> array(
				'color' => array( '', '#ffffff' )
			)
		);

		// Side

		// lines bentween menu color
		$options_inteface[] = array(
			'type'		=> 'rgba_color',
			'less_vars'	=> array( 'menu-divider-bg' ),
			'php_vars'	=> array(
				'color' => array( 'header-side_menu_lines_color', '#ffffff' ),
				'opacity' => array( 'header-side_menu_lines_opacity', 100 )
			),
		);

		// side paddings
		$options_inteface[] = array(
			'type'		=> 'number',
			'wrap'		=> array( '', 'px' ),
			'less_vars'	=> array( 'padding-side' ),
			'php_vars'	=> array( 'number' => array('header-side_paddings', '') )
		);

		// Classic

		if ( 'classic' == $logo_align ) {

			// menu bg color
			$options_inteface[] = array(
				'type' 		=> 'rgba_color',
				'less_vars' => array( 'navigation-bg-color' ),
				'php_vars'	=> array(
					'color' => array( 'header-classic_menu_bg_color', '#ffffff' ),
					'opacity' => array( 'header-classic_menu_bg_opacity', 100 )
				)
			);

		}

		// Center

		if ( 'center' == $logo_align ) {

			// menu bg color
			$options_inteface[] = array(
				'type' 		=> 'rgba_color',
				'less_vars' => array( 'navigation-bg-color' ),
				'php_vars'	=> array(
					'color' => array( 'header-center_menu_bg_color', '#ffffff' ),
					'opacity' => array( 'header-center_menu_bg_opacity', 100 )
				)
			);

		}

		// Elements

		// soc icons color
		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('top-icons-color'),
			'php_vars'	=> array( 'color' => array('header-soc_icon_color', '#686868') ),
		);

		// soc icons hover 
		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('soc-ico-hover-color'),
			'php_vars'	=> array( 'color' => array('header-soc_icon_hover_color', '#686868') ),
		);

		// field near logo color
		$options_inteface[] = array(
			'type'		=> 'hex_color',
			'less_vars'	=> array('text-near-logo-color'),
			'php_vars'	=> array( 'color' => array('header-near_logo_bg_color', '#ffffff') ),
		);

	//////////////////
	// Mobile logo //
	//////////////////

	// top padding
	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'mobile-logo-padding-top' ),
		'php_vars'	=> array( 'number' => array( 'general-mobile_logo-padding_top', '' ) )
	);

	// bottom padding
	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'mobile-logo-padding-bottom' ),
		'php_vars'	=> array( 'number' => array( 'general-mobile_logo-padding_bottom', '' ) )
	);

	// background color
	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'mobile-menu-bg-color' ),
		'php_vars'	=> array( 'color' => array( 'header-mobile-menu_color-background', '#ffffff' ) ),
	);

	// text color
	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array( 'mobile-menu-color' ),
		'php_vars'	=> array( 'color' => array( 'header-mobile-menu_color-text', '#ffffff' ) ),
	);

	// first swith
	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'first-switch' ),
		'php_vars'	=> array( 'number' => array( 'header-mobile-first_switch-after', 1024 ) )
	);

	// first swith
	$options_inteface[] = array(
		'type'		=> 'number',
		'wrap'		=> array( '', 'px' ),
		'less_vars'	=> array( 'second-switch' ),
		'php_vars'	=> array( 'number' => array( 'header-mobile-second_switch-after', 760 ) )
	);

	//////////////////
	// Page titles //
	//////////////////

	// title color
	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array('page-title-color'),
		'php_vars'	=> array( 'color' => array('general-title_color', '#ffffff') ),
	);

	// breadcrumbs color
	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array('page-title-breadcrumbs-color'),
		'php_vars'	=> array( 'color' => array('general-breadcrumbs_color', '#ffffff') ),
	);

	// background color
	$options_inteface[] = array(
		'type'		=> 'hex_color',
		'less_vars'	=> array('page-title-bg-color'),
		'php_vars'	=> array( 'color' => array('general-title_bg_color', '#ffffff') ),
	);

	// bg image
	$options_inteface[] = array(
		'type'		=> 'image',
		'less_vars'	=> array( 'page-title-bg-image', 'page-title-bg-repeat', 'page-title-bg-position-x', 'page-title-bg-position-y' ),
		'php_vars'	=> array( 'image' => array('general-title_bg_image', $image_defaults) ),
	);

	// fixed
	$options_inteface[] = array(
		'type'		=> 'keyword',
		'interface'	=> array( '' => '~""', '1' => 'fixed' ),
		'less_vars'	=> array( 'page-title-bg-attachment' ),
		'php_vars'	=> array( 'keyword' => array('general-title_bg_fixed', '') ),
	);

	return $options_inteface;
}
add_filter( 'presscore_less_options_interface', 'presscore_new_themeoptions_to_less', 16 );


/**
 * Compilled less special cases.
 *
 */
function presscore_new_compilled_less_special_cases( $options = array() ) {

	// General -> Background -> Fullscreen
	if ( 'cover' == $options['page-bg-size'] ) {
		$options['page-bg-repeat'] = 'no-repeat';
	}

	// General -> Layout -> Fullscreen
	if ( 'cover' == $options['body-bg-size'] ) {
		$options['body-bg-repeat'] = 'no-repeat';
	}

	// Header & top bar -> Header -> Header
	if ( 'cover' == $options['header-bg-size'] ) {
		$options['header-bg-repeat'] = 'no-repeat';
	}

	/* General -> Dividers */

	// thick divider with breadcrumbs
	$thick_div_style = $options['divider-thick-switch'];
	$options['divider-thick-bread-switch'] = implode('-', current(array_chunk(explode('-',$thick_div_style ), 2)) );

	// thin divider
	switch ( of_get_option('general-thin_divider_style', 'style-1') ) {
		case 'style-1':
			$options['divider-thin-height'] = '1px';
			$options['divider-thin-style'] = 'solid';
			break;
		case 'style-2':
			$options['divider-thin-height'] = '2px';
			$options['divider-thin-style'] = 'solid';
			break;
		case 'style-3':
			$options['divider-thin-height'] = '1px';
			$options['divider-thin-style'] = 'dotted';
			break;
	}

	/* Stripes */

	// fullscreen
	if ( function_exists('presscore_themeoptions_get_stripes_list') ) {

		foreach ( presscore_themeoptions_get_stripes_list() as $id=>$opts ) {

			$options['strype-' . $id . '-bg-attachment'] = '~""';

			if ( 'cover' == $options['strype-' . $id . '-bg-size'] ) {
				$options['strype-' . $id . '-bg-repeat'] = 'no-repeat';
				$options['strype-' . $id . '-bg-attachment'] = 'fixed';
			}
		}

	}

	$top_level_img_sizes = of_get_option( 'header-icons_size', array('width' => 20, 'height' => 20) );
	$sub_level_img_sizes = of_get_option( 'header-submenu_icons_size', array('width' => 16, 'height' => 16) );

	// menu image sizes
	$options['main-menu-icon-width'] = $top_level_img_sizes['width'] . 'px';
	$options['main-menu-icon-height'] = $top_level_img_sizes['height'] . 'px';

	// sub menu image sizes
	$options['sub-menu-icon-width'] = $sub_level_img_sizes['width'] . 'px';
	$options['sub-menu-icon-height'] = $sub_level_img_sizes['height'] . 'px';

	// ******************************************************************************
	// new settings
	// ******************************************************************************

	$content_width = of_get_option( 'general-content_width', '1200px' );
	$box_width = of_get_option( 'general-box_width', '1320px' );
	$side_menu_width = of_get_option( 'header-side_menu_width', '300px' );

	// TODO: add proper vars declaration
	$normal_lh = of_get_option( 'fonts-normal_size_line_height', 20 );
	$small_lh = of_get_option( 'fonts-small_size_line_height', 20 );
	$big_lh = of_get_option( 'fonts-big_size_line_height', 20 );

	$options['content-width'] = $content_width ? $content_width : '1200px';
	$options['box-width'] = $box_width ? $box_width : '1320px';
	$options['header-side-width'] = $side_menu_width ? $side_menu_width : '300px';

	$options['base-line-height'] = intval($normal_lh) . 'px';
	$options['text-small-line-height'] = intval($small_lh) . 'px';
	$options['text-big-line-height'] = intval($big_lh) . 'px';

	//////////////////////
	// gradient colors //
	//////////////////////

	$styled_colors = array(

		// Accent color
		array(
			'mode' => of_get_option('general-accent_color_mode'),
			'gradient' => of_get_option('general-accent_bg_color_gradient', array( '#ffffff', '#000000' )),
			'color' => of_get_option('general-accent_bg_color', '#D73B37'),
			'less_vars' => array('accent-bg-color', 'accent-bg-color-2')
		)

		// Menu (first level) -> hover font color
		,array(
			'mode' => of_get_option('menu-hover_font_color_mode'),
			'gradient' => of_get_option('menu-hover_font_color_gradient', array( '#ffffff', '#000000' )),
			'color' => of_get_option('menu-hover_font_color', '#ffffff'),
			'less_vars' => array('menu-hover-color', 'menu-hover-color-2')
		)

		// Menu (first bg_level) -> hover decoration color
		,array(
			'mode' => of_get_option('menu-hover_decoration_color_mode'),
			'gradient' => of_get_option('menu-hover_decoration_color_gradient', array( '#ffffff', '#000000' )),
			'color' => of_get_option('menu-hover_decoration_color', '#ffffff'),
			'less_vars' => array('menu-hover-decor-color', 'menu-hover-decor-color-2')
		)

		// Submenu hover color
		,array(
			'mode' => of_get_option('submenu-hover_font_color_mode'),
			'gradient' => of_get_option('submenu-hover_font_color_gradient', array( '#ffffff', '#000000' )),
			'color' => of_get_option('submenu-hover_font_color', '#ffffff'),
			'less_vars' => array('submenu-hover-color', 'submenu-hover-color-2')
		)

		// Woocommerce cart couner color
		,array(
			'mode' => of_get_option('header-woocommerce_counter_bg_mode'),
			'gradient' => of_get_option('header-woocommerce_counter_bg_color_gradient', array( '#ffffff', '#000000' )),
			'color' => of_get_option('header-woocommerce_counter_bg_color', '#ffffff'),
			'less_vars' => array('product-counter-bg', 'product-counter-bg-2')
		)

		// Social icons bg color
		,array(
			'mode' => of_get_option('header-soc_icon_bg_color_mode'),
			'gradient' => of_get_option('header-soc_icon_bg_color_gradient', array( '#ffffff', '#000000' )),
			'color' => of_get_option('header-soc_icon_bg_color', '#ffffff'),
			'less_vars' => array('top-icons-bg-color', 'top-icons-bg-color-2')
		)

		// Social icons hover bg color
		,array(
			'mode' => of_get_option('header-soc_icon_hover_bg_color_mode'),
			'gradient' => of_get_option('header-soc_icon_hover_bg_color_gradient', array( '#ffffff', '#000000' )),
			'color' => of_get_option('header-soc_icon_hover_bg_color', '#ffffff'),
			'less_vars' => array('top-icons-bg-color-hover', 'top-icons-bg-color-hover-2')
		)

		// Buttons color
		,array(
			'mode' => of_get_option('buttons-color_mode'),
			'gradient' => of_get_option('buttons-color_gradient', array( '#ffffff', '#000000' )),
			'color' => of_get_option('buttons-color', '#ffffff'),
			'less_vars' => array('dt-btn-bg-color', 'dt-btn-bg-color-2')
		)

		// Image hovers color
		,array(
			'mode' => of_get_option('image_hover-color_mode'),
			'gradient' => of_get_option('image_hover-color_gradient', array( '#ffffff', '#000000' )),
			'color' => of_get_option('image_hover-color', '#ffffff'),
			'less_vars' => array('rollover-bg-color', 'rollover-bg-color-2')
		)
	);

	foreach ( $styled_colors as $color ) {
		$options[ $color['less_vars'][0] ] = $color['gradient'][0];
		$options[ $color['less_vars'][1] ] = $color['gradient'][1];

		switch( $color['mode'] ) {
			case 'color':
			case 'outline':
				$options[ $color['less_vars'][0] ] = $color['color'];
				$options[ $color['less_vars'][1] ] = '""';

				break;
			case 'accent':
				$options[ $color['less_vars'][0] ] = $options['accent-bg-color'];
				$options[ $color['less_vars'][1] ] = $options['accent-bg-color-2'];
		}
	}

	$top_level_img_sizes = of_get_option( 'menu-images_size', array('width' => 20, 'height' => 20) );

	// menu image sizes
	$options['main-menu-icon-width'] = $top_level_img_sizes['width'] . 'px';
	$options['main-menu-icon-height'] = $top_level_img_sizes['height'] . 'px';

	// page title
	if ( of_get_option( 'general-title_bg_fullscreen' ) ) {
		$options['page-title-bg-size'] = '~"cover"';
	} else {
		$options['page-title-bg-size'] = '~"auto auto"';
	}

	// sub menu image sizes
	// @todo remove this!
	$options['sub-menu-icon-width'] = '10px';
	$options['sub-menu-icon-height'] = '10px';
	$options['bottom-divider-bg-color'] = 'rgba(56, 57, 58, 1)';
	$options['bottom-divider-bg-color-ie'] = 'rgb(56, 57, 58)';

	return $options;
}
add_filter( 'presscore_compiled_less_vars', 'presscore_new_compilled_less_special_cases', 16 );
