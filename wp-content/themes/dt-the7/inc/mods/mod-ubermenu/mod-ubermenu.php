<?php
/**
 * Ubermenu related actions.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'presscore_ubermenu_body_class_filter' ) ) :

	function presscore_ubermenu_body_class_filter( $classes = array() ) {

		if ( has_nav_menu( 'primary' ) ) {
			$classes[] = 'dt-style-um';
		}

		return $classes;
	}

	add_filter( 'body_class', 'presscore_ubermenu_body_class_filter' );

endif;

/**
 * Add custom ubermenu skin.
 *
 */
function presscore_ubermenu_add_custom_skin() {
	$cache_name = 'wp_less_stylesheet_data_'.md5( PRESSCORE_THEME_DIR . '/css/the7-uber-menu.less' );
	$compiled_cache = get_option($cache_name);

	if ( !(is_admin() || dt_is_login_page()) ) {

		if ( ( defined('DT_ALWAYS_REGENERATE_DYNAMIC_CSS') && DT_ALWAYS_REGENERATE_DYNAMIC_CSS ) || ( $compiled_cache !== false && empty($compiled_cache['target_uri']) ) ) {

			presscore_generate_less_css_file( 'the7-ubermenu.less', PRESSCORE_THEME_URI . '/css/the7-uber-menu.less' );
			$compiled_cache = get_option($cache_name);
		}
	}

	$stylesheet_src = isset($compiled_cache['target_uri']) ? $compiled_cache['target_uri'] : false;

	// less stylesheet
	if ( get_option( 'presscore_less_css_is_writable' ) && $stylesheet_src ) {

	// print custom css inline
	} elseif ( !empty($compiled_cache['compiled']) ) {

		wp_add_inline_style( 'dt-main', $compiled_cache['compiled'] );
	}

	ubermenu_register_skin('the7-style', _x( 'The7 skin' , 'backend', LANGUAGE_ZONE ), $stylesheet_src);

}
// add_action( 'init', 'presscore_ubermenu_add_custom_skin', 16 );


if ( ! function_exists( 'presscore_ubermenu_generate_less_css_file_after_options_save' ) ) :

	function presscore_ubermenu_generate_less_css_file_after_options_save() {

		$set = get_settings_errors('options-framework');
		if ( !empty( $set ) ) {

			presscore_generate_less_css_file( 'the7-ubermenu.less', PRESSCORE_THEME_URI . '/css/the7-uber-menu.less' );
		}

	}

	// add_action( 'admin_init', 'presscore_ubermenu_generate_less_css_file_after_options_save', 11 );

endif;
