<?php
/**
 * WPML mod.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_WPML_Compatibility_Module', false ) ) {

	class Presscore_WPML_Compatibility_Module {

		public static function init() {

			/**
			 * Do not load wpml language switcher css.
			 */
			define( 'ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true );

			/**
			 * Dirty hack that fixes front page pagination with custom query.
			 */
			remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
			add_action( 'template_redirect', 'wp_shortlink_header',  11, 0 );

			/**
			 * Filter theme localized script.
			 */
			add_filter( 'presscore_localized_script', array( __CLASS__, 'localized_script_filter' ) );

			/**
			 * Enqueue dynamic stylesheets.
			 */
			add_action( 'presscore_enqueue_dynamic_stylesheets', array( __CLASS__, 'enqueue_dynamic_stylesheets' ) );

			/**
			 * Add editor.
			 */
			add_action( 'init', array( __CLASS__, 'enable_editor_for_post_types' ), 16 );

			/**
			 * Hide editor.
			 */
			add_action( 'admin_print_styles-post.php', array( __CLASS__, 'hide_editor_for_post_types' ) );
			add_action( 'admin_print_styles-post-new.php', array( __CLASS__, 'hide_editor_for_post_types' ) );

			/**
			 * Render language switcher.
			 */
			add_action( 'presscore_render_header_element-language', array( __CLASS__, 'render_header_language_switcher' ) );

			/**
			 * Add header layout elements.
			 */
			add_filter( 'header_layout_elements', array( __CLASS__, 'add_header_layout_elements' ) );
		}

		public static function localized_script_filter( $args = array() ) {
			global $sitepress;
			if ( array_key_exists( 'ajaxurl', $args ) && is_object( $sitepress ) && method_exists( $sitepress, 'get_current_language' ) ) {
				$args['ajaxurl'] = add_query_arg( array( 'lang' => $sitepress->get_current_language() ), $args['ajaxurl'] );
			}
			return $args;
		}

		public static function enable_editor_for_post_types() {
			add_post_type_support( 'dt_slideshow', 'editor' );
			add_post_type_support( 'dt_gallery', 'editor' );
			add_post_type_support( 'dt_logos', 'editor' );
		}

		public static function hide_editor_for_post_types() {
			if ( in_array( get_post_type(), array( 'dt_slideshow', 'dt_gallery', 'dt_logos' ) ) ) {
				wp_add_inline_style( 'dt-mb-magick', '#postdivrich { display: none; }' );
			}
		}

		public static function render_header_language_switcher() {
			do_action('icl_language_selector');
		}

		public static function add_header_layout_elements( $elements = array() ) {
			$elements['language'] = array( 'title' => _x( 'WPML language', 'theme-options', LANGUAGE_ZONE ), 'class' => '' );
			return $elements;
		}

		public static function enqueue_dynamic_stylesheets() {
			$template_uri = PRESSCORE_THEME_URI;
			$template_directory = PRESSCORE_THEME_DIR;
			$theme_version = wp_get_theme()->get( 'Version' );

			$dynamic_stylesheets = array(
				'wpml.less' => array(
					'path' => $template_directory . '/css/wpml.less',
					'src' => $template_uri . '/css/wpml.less',
					'fallback_src' => '',
					'deps' => array(),
					'ver' => $theme_version,
					'media' => 'all'
				)
			);

			foreach( $dynamic_stylesheets as $stylesheet_handle=>$stylesheet ) {
				$stylesheet_cache = presscore_get_dynamic_stylesheet_cache( $stylesheet_handle, $stylesheet['path'], $stylesheet['src'], $stylesheet['fallback_src'] );

				// enqueue stylesheets
				presscore_enqueue_dynamic_style( array( 'handle' => $stylesheet_handle, 'cache' => $stylesheet_cache, 'stylesheet' => $stylesheet ) );
			}
		}
	}

}

Presscore_WPML_Compatibility_Module::init();
