<?php
/**
 * Load Theme Options
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

///////////////////////////////////
// Theme Options Shared Settings //
///////////////////////////////////

require_once locate_template( 'inc/admin/theme-options/options.php' );

////////////////////////
// Load Theme Options //
////////////////////////

$theme_options_files = array(
	// always stay ontop
	'general' => 'inc/admin/theme-options/options-general.php',

	// submenu section
	'skin' => 'inc/admin/theme-options/options-skins.php',
	'header' => 'inc/admin/theme-options/options-header.php',
	'branding' => 'inc/admin/theme-options/options-branding.php',
	'stripes' => 'inc/admin/theme-options/options-stripes.php',
	'sidebar' => 'inc/admin/theme-options/options-sidebar.php',
	'footer' => 'inc/admin/theme-options/options-footer.php',
	'blog_and_portfolio' => 'inc/admin/theme-options/options-blog-and-portfolio.php',
	'page_titles' => 'inc/admin/theme-options/options-page-titles.php',
	'fonts' => 'inc/admin/theme-options/options-fonts.php',
	'buttons' => 'inc/admin/theme-options/options-buttons.php',
	'image_hoovers' => 'inc/admin/theme-options/options-imagehoovers.php',
	'like_buttons' => 'inc/admin/theme-options/options-likebuttons.php',
	'widget_areas' => 'inc/admin/theme-options/options-widgetareas.php',
	'import_export' => 'inc/admin/theme-options/options-importexport.php'
);

$theme_options_files = apply_filters( 'presscore_options_list', $theme_options_files );
foreach ( $theme_options_files as $filepath ) {
	include_once locate_template( $filepath );
}
