<?php
/**
 * Theme init.
 *
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// load constants.
require_once trailingslashit( get_template_directory() ) . 'inc/constants.php';

// Load extensions
require_once PRESSCORE_EXTENSIONS_DIR . '/aq_resizer.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/wpml-integration.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/core-functions.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/stylesheet-functions.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/dt-pagination.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/core-menu.php';
require_once PRESSCORE_EXTENSIONS_DIR . '/presscore-web-fonts-compressor.php';

if ( ! class_exists( 'Color', false ) ) {
	require_once PRESSCORE_EXTENSIONS_DIR . '/color.php';
}

if ( ! class_exists( 'Mobile_Detect', false ) ) {
	require_once PRESSCORE_EXTENSIONS_DIR . '/mobile-detect.php';
}

if ( ! defined( 'OPTIONS_FRAMEWORK_VERSION' ) ) {
	require_once PRESSCORE_EXTENSIONS_DIR . '/options-framework/options-framework.php';

	add_filter( 'options_framework_location', 'presscore_add_theme_options' );
}

/**
 * Include utility classes.
 */
require_once PRESSCORE_CLASSES_DIR . '/template-config/presscore-config.class.php';

require_once PRESSCORE_CLASSES_DIR . '/menu/menu.class.php';
require_once PRESSCORE_CLASSES_DIR . '/menu/custom-menu.class.php';

require_once PRESSCORE_CLASSES_DIR . '/sliders/presscore-slider.class.php';
require_once PRESSCORE_CLASSES_DIR . '/sliders/presscore-photoscroller.class.php';
require_once PRESSCORE_CLASSES_DIR . '/sliders/slider-swapper.class.php';
require_once PRESSCORE_CLASSES_DIR . '/sliders/presscore-posts-slider-scroller.class.php';
require_once PRESSCORE_CLASSES_DIR . '/sliders/presscore-portfolio-posts-scroller.class.php';

require_once PRESSCORE_CLASSES_DIR . '/layout/columns-layout-parser.class.php';
require_once PRESSCORE_CLASSES_DIR . '/layout/sidebar-layout-parser.class.php';

require_once PRESSCORE_CLASSES_DIR . '/presscore-actions-manager.class.php';

require_once PRESSCORE_CLASSES_DIR . '/tags.class.php';

// Load custom post types.
include_once PRESSCORE_DIR . '/post-types.php';

require_once PRESSCORE_DIR . '/helpers.php';
require_once PRESSCORE_DIR . '/template-hooks.php';

require_once locate_template( 'inc/theme-config.php' );
include_once locate_template( 'inc/widgets/load-widgets.php' );
include_once locate_template( 'inc/shortcodes/load-shortcodes.php' );
include_once locate_template( 'inc/mods/load-mods.php' );

// Setup theme.
require_once PRESSCORE_DIR . '/theme-setup.php';

// Dynamic stylesheets.
require_once PRESSCORE_DIR . '/dynamic-stylesheets-functions.php';

// Frontend functions.
require_once PRESSCORE_DIR . '/static.php';

// Theme settings.
require_once PRESSCORE_DIR . '/theme-settings.php';

// Ajax functions.
require_once PRESSCORE_DIR . '/ajax-functions.php';

if ( is_admin() ) {

	require_once PRESSCORE_ADMIN_DIR . '/admin-functions.php';

	include_once locate_template( 'inc/admin/load-meta-boxes.php' );

}
