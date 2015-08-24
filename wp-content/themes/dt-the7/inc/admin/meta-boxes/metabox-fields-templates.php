<?php
/**
 * Meta box templates
 *
 * @package the7
 * @since 4.2.1
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Load meta box fields template class
if ( !class_exists( 'Presscore_Meta_Box_Field_Template', false ) ) {
	require_once PRESSCORE_CLASSES_DIR . '/presscore-meta-box-field-template.class.php';
}

////////////////////
// Base templates //
////////////////////

// yes no field values
Presscore_Meta_Box_Field_Template::add( 'yes no values', array(
	'1'	=> _x( 'Yes', 'backend metabox', LANGUAGE_ZONE ),
	'0' => _x( 'No', 'backend metabox', LANGUAGE_ZONE )
) );

// enabled disabled field values
Presscore_Meta_Box_Field_Template::add( 'enabled disabled values', array(
	'1'	=> _x( 'Enabled', 'backend metabox', LANGUAGE_ZONE ),
	'0' => _x( 'Disabled', 'backend metabox', LANGUAGE_ZONE )
) );

// image sizing
Presscore_Meta_Box_Field_Template::add( 'image sizing values', array(
	'original'	=> _x( 'preserve images proportions', 'backend metabox', LANGUAGE_ZONE ),
	'resize'	=> _x( 'resize images', 'backend metabox', LANGUAGE_ZONE ),
	'round'		=> _x( 'make images round', 'backend metabox', LANGUAGE_ZONE )
) );

// description style field values
Presscore_Meta_Box_Field_Template::add( 'description style values', array(
	'under_image'			=> array( _x( 'Under images', 'backend metabox', LANGUAGE_ZONE ), array( 'rollover-under.gif', 60, 40 ) ),
	'on_hoover_centered'	=> array( _x( 'On colored background', 'backend metabox', LANGUAGE_ZONE ), array( 'rollover-on-bg.gif', 60, 40 ) ),
	'on_dark_gradient'		=> array( _x( 'On dark gradient', 'backend metabox', LANGUAGE_ZONE ), array( 'rollover-on-grad.gif', 60, 40 ) ),
	'from_bottom'			=> array( _x( 'In the bottom', 'backend metabox', LANGUAGE_ZONE ), array( 'rollover-bottom.gif', 60, 40 ) ),
	'disabled'				=> array( _x( 'Disabled', 'backend metabox', LANGUAGE_ZONE ), array( 'admin-text-hover-disabled.png', 75, 50 ) )
) );

// list layout values
Presscore_Meta_Box_Field_Template::add( 'list layout values', array(
	'list'			=> array( _x( 'Left-aligned image', 'backend metabox', LANGUAGE_ZONE ), array( 'list-left.gif', 60, 69 ) ),
	'right_list'	=> array( _x( 'Right-aligned image', 'backend metabox', LANGUAGE_ZONE ), array( 'list-right.gif', 60, 69 ) ),
	'checkerboard'	=> array( _x( 'Checkerboard order', 'backend metabox', LANGUAGE_ZONE ), array( 'list-checker.gif', 60, 69 ) )
) );

// loading effect values
Presscore_Meta_Box_Field_Template::add( 'loading effect values', array(
	'none'				=> _x( 'None', 'backend metabox', LANGUAGE_ZONE ),
	'fade_in'			=> _x( 'Fade in', 'backend metabox', LANGUAGE_ZONE ),
	'move_up'			=> _x( 'Move up', 'backend metabox', LANGUAGE_ZONE ),
	'scale_up'			=> _x( 'Scale up', 'backend metabox', LANGUAGE_ZONE ),
	'fall_perspective'	=> _x( 'Fall perspective', 'backend metabox', LANGUAGE_ZONE ),
	'fly'				=> _x( 'Fly', 'backend metabox', LANGUAGE_ZONE ),
	'flip'				=> _x( 'Flip', 'backend metabox', LANGUAGE_ZONE ),
	'helix'				=> _x( 'Helix', 'backend metabox', LANGUAGE_ZONE ),
	'scale'				=> _x( 'Scale', 'backend metabox', LANGUAGE_ZONE )
) );

///////////////////////
// Complex templates //
///////////////////////

// add list layout
Presscore_Meta_Box_Field_Template::add( 'list layout', array(
	'name'		=> _x( 'Layout:', 'backend metabox', LANGUAGE_ZONE ),
	'type'		=> 'radio',
	'std'		=> 'list',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'list layout values' )
) );

// add masonty layout
Presscore_Meta_Box_Field_Template::add( 'masonry layout', array(
	'name'    	=> _x( 'Layout:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> 'masonry',
	'divider'	=> 'bottom',
	'options'	=> array(
		'masonry'	=> array( _x( 'Masonry', 'backend metabox', LANGUAGE_ZONE ), array( 'masonry-layout.gif', 60, 58 ) ),
		'grid'		=> array( _x( 'Grid', 'backend metabox', LANGUAGE_ZONE ), array( 'grid-layout.gif', 60, 58 ) )
	)
) );

// add gap between images
Presscore_Meta_Box_Field_Template::add( 'gap between images', array(
	'name'		=> _x( 'Gap between images (px):', 'backend metabox', LANGUAGE_ZONE ),
	'type'  	=> 'text',
	'std'   	=> '20',
	'desc' 		=> _x( 'Image paddings (e.g. 5 pixel padding will give you 10 pixel gaps between images)', 'backend metabox', LANGUAGE_ZONE )
) );

// add row target height
Presscore_Meta_Box_Field_Template::add( 'row target height', array(
	'name'		=> _x( 'Row target height (px):', 'backend metabox', LANGUAGE_ZONE ),
	'type'  	=> 'text',
	'std'   	=> '250',
	'divider'	=> 'top'
) );

// column target width
Presscore_Meta_Box_Field_Template::add( 'column target width', array(
	'name'		=> _x( 'Column minimum width (px):', 'backend metabox', LANGUAGE_ZONE ),
	'desc'		=> _x( 'Real column width will slightly vary depending on site visitor screen width', 'backend metabox', LANGUAGE_ZONE ),
	'type'  	=> 'text',
	'std'   	=> '370',
	'divider'	=> 'top'
) );

// columns number
Presscore_Meta_Box_Field_Template::add( 'columns number', array(
	'name'		=> _x( 'Desired columns number:', 'backend metabox', LANGUAGE_ZONE ),
	'type'  	=> 'text',
	'std'   	=> '3',
	'divider'	=> 'top'
) );

// 100 percent width
Presscore_Meta_Box_Field_Template::add( '100 percent width', array(
	'name'    	=> _x( '100% width:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'checkbox',
	'std'		=> 0,
	'divider'	=> 'top'
) );

// show image miniatures
Presscore_Meta_Box_Field_Template::add( 'image miniatures', array(
	'name'    	=> _x( 'Show image miniatures:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> 1,
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// opacity slider
Presscore_Meta_Box_Field_Template::add( 'opacity slider', array(
	'type'			=> 'slider',
	'std'			=> '100',
	'js_options'	=> array(
		'min'	=> 0,
		'max'	=> 100,
		'step'	=> 1,
	)
) );

// description style
Presscore_Meta_Box_Field_Template::add( 'description style', array(
	'type'    	=> 'radio',
	'std'		=> 'under_image',
	// all except 'disabled'
	'options'	=> array_diff_key( Presscore_Meta_Box_Field_Template::get( 'description style values' ), array( 'disabled' => '' ) ),
	'divider'	=> 'top'
) );

// photo description style
Presscore_Meta_Box_Field_Template::add( 'photo description style', array(
	'type'    	=> 'radio',
	'std'		=> 'under_image',
	// all
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'description style values' ),
	'divider'	=> 'top'
) );

// jgrid description style
Presscore_Meta_Box_Field_Template::add( 'jgrid description style', array(
	'type'    	=> 'radio',
	'std'		=> 'on_hoover_centered',
	// all except 'under_image' and 'disabled'
	'options'	=> array_diff_key( Presscore_Meta_Box_Field_Template::get( 'description style values' ), array( 'under_image' => '', 'disabled' => '' ) ),
	'divider'	=> 'top'
) );

// photo jgrid description style
Presscore_Meta_Box_Field_Template::add( 'photo jgrid description style', array(
	'type'    	=> 'radio',
	'std'		=> 'on_hoover_centered',
	// all except 'under_image'
	'options'	=> array_diff_key( Presscore_Meta_Box_Field_Template::get( 'description style values' ), array( 'under_image' => '' ) ),
	'divider'	=> 'top'
) );

// hover animation
Presscore_Meta_Box_Field_Template::add( 'hover animation', array(
	'name'    	=> _x( 'Animation:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> 'fade',
	'divider'	=> 'top',
	'options'	=> array(
		'fade'				=> _x( 'Fade', 'backend metabox', LANGUAGE_ZONE ),
		'move_to'			=> _x( 'Side move', 'backend metabox', LANGUAGE_ZONE ),
		'direction_aware'	=> _x( 'Direction aware', 'backend metabox', LANGUAGE_ZONE ),
		'move_from_bottom'	=> _x( 'Move from bottom', 'backend metabox', LANGUAGE_ZONE )
	)
) );

// hover background color
Presscore_Meta_Box_Field_Template::add( 'hover background color', array(
	'name'    	=> _x( 'Background color:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> 'accent',
	'divider'	=> 'top',
	'options'	=> array(
		'dark'		=> _x( 'Dark', 'backend metabox', LANGUAGE_ZONE ),
		'accent'	=> _x( 'Color (from Theme Options)', 'backend metabox', LANGUAGE_ZONE )
	)
) );

// background under post preview
Presscore_Meta_Box_Field_Template::add( 'background under post', array(
	'type'		=> 'radio',
	'std'		=> 1,
	'divider'	=> 'top',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'enabled disabled values' )
) );

// background under masonry post preview
Presscore_Meta_Box_Field_Template::add( 'background under masonry post', array(
	'type'		=> 'radio',
	'std'		=> 'disabled',
	'divider'	=> 'top',
	'options'	=> array(
		'with_paddings' => _x( 'Enabled (image with paddings)', 'backend metabox', LANGUAGE_ZONE ),
		'fullwidth'		=> _x( 'Enabled (image without paddings)', 'backend metabox', LANGUAGE_ZONE ),
		'disabled'		=> _x( 'Disabled', 'backend metabox', LANGUAGE_ZONE )
	)
) );

// style for background under post preview
Presscore_Meta_Box_Field_Template::add( 'background under post style', array(
	'type'			=> 'info',
	'value'			=> 'Deprecated "background under post style"'
) );

// content alignment
Presscore_Meta_Box_Field_Template::add( 'content alignment', array(
	'name'		=> _x( 'Content alignment:', 'backend metabox', LANGUAGE_ZONE ),
	'type'		=> 'radio',
	'std'		=> 'left',
	'divider'	=> 'top',
	'options'	=> array(
		'left'		=> _x( 'Left', 'backend metabox', LANGUAGE_ZONE ),
		'center'	=> _x( 'Centre', 'backend metabox', LANGUAGE_ZONE )
	)
) );

// hover content
Presscore_Meta_Box_Field_Template::add( 'hover content visibility', array(
	'name'    	=> _x( 'Content:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> 'on_hoover',
	'divider'	=> 'top',
	'options'	=> array(
		'always'	=> _x( 'Always visible', 'backend metabox', LANGUAGE_ZONE ),
		'on_hoover'	=> _x( 'On hover', 'backend metabox', LANGUAGE_ZONE )
	)
) );

// hide last row
Presscore_Meta_Box_Field_Template::add( 'hide last row', array(
	'name'   	=> _x( "Hide last row if there's not enough images to fill it:", 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'checkbox',
	'std'		=> 0,
	'divider'	=> 'top'
) );

// image sizing
Presscore_Meta_Box_Field_Template::add( 'image sizing', array(
	'name'		=> _x( 'Images sizing:', 'backend metabox', LANGUAGE_ZONE ),
	'type'		=> 'radio',
	'std'		=> 'original',
	'options'	=> array_diff_key( Presscore_Meta_Box_Field_Template::get( 'image sizing values' ), array( 'round' => '' ) ),
	'divider'	=> 'top'
) );

// team image sizing 
Presscore_Meta_Box_Field_Template::add( 'team image sizing', Presscore_Meta_Box_Field_Template::get_as_array( 'image sizing', array(
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'image sizing values' ),
) ) );

// image proportions
Presscore_Meta_Box_Field_Template::add( 'image proportions', array(
	'name'			=> _x( 'Images proportions:', 'backend metabox', LANGUAGE_ZONE ),
	'type'  		=> 'simple_proportions',
	'std'   		=> array( 'width' => 1, 'height' => 1 )
) );

// loading mode
Presscore_Meta_Box_Field_Template::add( 'loading mode', array(
	'name'    	=> _x( 'Loading mode:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> 'ajax_pagination',
	'options'	=> array(
		'ajax_pagination'	=> _x( 'AJAX Pagination', 'backend metabox', LANGUAGE_ZONE ),
		'ajax_more'			=> _x( '"Load more" button', 'backend metabox', LANGUAGE_ZONE ),
		'lazy_loading'		=> _x( 'Lazy loading', 'backend metabox', LANGUAGE_ZONE ),
		'default'			=> _x( 'Standard (no AJAX)', 'backend metabox', LANGUAGE_ZONE )
	)
) );

// loading effect
Presscore_Meta_Box_Field_Template::add( 'loading effect', array(
	'name'    	=> _x( 'Loading effect:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> 'fade_in',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'loading effect values' )
) );

// radio yes(default) no 
Presscore_Meta_Box_Field_Template::add( 'radio yes no', array(
	'type'    	=> 'radio',
	'std'		=> '1',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// show name/date ordering (radio)
Presscore_Meta_Box_Field_Template::add( 'show name/date ordering', array(
	'name'    	=> _x( 'Show name / date ordering:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> '1',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// show asc/desc ordering (radio)
Presscore_Meta_Box_Field_Template::add( 'show asc/desc ordering', array(
	'name'    	=> _x( 'Show asc. / desc. ordering:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> '1',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// show all pages in paginator (radio)
Presscore_Meta_Box_Field_Template::add( 'show all pages paginator', array(
	'name'    	=> _x( 'Show all pages in paginator:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> '0',
	'options'	=> Presscore_Meta_Box_Field_Template::get( 'yes no values' )
) );

// order
Presscore_Meta_Box_Field_Template::add( 'order', array(
	'name'    	=> _x( 'Order:', 'backend metabox', LANGUAGE_ZONE ),
	'type'    	=> 'radio',
	'std'		=> 'DESC',
	'options'	=> array(
		'ASC'	=> _x( 'ascending', 'backend', LANGUAGE_ZONE ),
		'DESC'	=> _x( 'descending', 'backend', LANGUAGE_ZONE ),
	)
) );

// orderby
Presscore_Meta_Box_Field_Template::add( 'orderby', array(
	'name'     	=> _x( 'Order by:', 'backend metabox', LANGUAGE_ZONE ),
	'type'     	=> 'select',
	'std'		=> 'date',
	'options'  	=> array(
		'date' => _x( 'date', 'backend', LANGUAGE_ZONE ),
		'name' => _x( 'name', 'backend', LANGUAGE_ZONE )
	)
) );

// preview width
Presscore_Meta_Box_Field_Template::add( 'preview width', array(
	'type'    	=> 'radio',
	'std'		=> 'normal',
	'options'	=> array(
		'normal'	=> _x( 'normal', 'backend metabox', LANGUAGE_ZONE ),
		'wide'		=> _x( 'wide', 'backend metabox', LANGUAGE_ZONE ),
	),
	'divider'	=> 'top'
) );

// media content width
Presscore_Meta_Box_Field_Template::add( 'media content width', array(
	'name'				=> _x( 'Thumbnail width (in %):', 'backend metabox', LANGUAGE_ZONE ),
	'type'				=> 'text',
	'std'				=> '',
	'divider'			=> 'top'
) );

Presscore_Meta_Box_Field_Template::add( 'transparent header color mode', array(
	'std'		=> 'light',
	'type'		=> 'radio',
	'options'	=> array(
		'light' => _x( 'Light', 'theme-options', LANGUAGE_ZONE ),
		'dark' => _x( 'Dark', 'theme-options', LANGUAGE_ZONE ),
		'theme' => _x( 'From Theme Options', 'theme-options', LANGUAGE_ZONE )
	)
) );

////////////////////
// Photo Scroller //
////////////////////

// max width
Presscore_Meta_Box_Field_Template::add( 'photoscroller max width', array(
	'name' => _x( 'Max width (%):', 'backend metabox', LANGUAGE_ZONE ),
	'type' => 'text',
	'std' => '100'
) );

// min width
Presscore_Meta_Box_Field_Template::add( 'photoscroller min width', array(
	'name' => _x( 'Min width (%):', 'backend metabox', LANGUAGE_ZONE ),
	'type' => 'text',
	'std' => '0'
) );

// filling mode desktop
Presscore_Meta_Box_Field_Template::add( 'photoscroller filling mode desktop', array(
	'name' => _x( 'Filling mode (desktop):', 'backend metabox', LANGUAGE_ZONE ),
	'type' => 'radio',
	'std' => 'fit',
	'options' => array(
		'fit' => _x( 'fit (preserve proportions)', 'theme-options', LANGUAGE_ZONE ),
		'fill' => _x( 'fill the viewport (crop)', 'theme-options', LANGUAGE_ZONE )
	)
) );

// filling mode mobile
Presscore_Meta_Box_Field_Template::add( 'photoscroller filling mode mobile', array(
	'name' => _x( 'Filling mode (mobile):', 'backend metabox', LANGUAGE_ZONE ),
	'type' => 'radio',
	'std' => 'fit',
	'options' => array(
		'fit' => _x( 'fit (preserve proportions)', 'theme-options', LANGUAGE_ZONE ),
		'fill' => _x( 'fill the viewport (crop)', 'theme-options', LANGUAGE_ZONE )
	)
) );
