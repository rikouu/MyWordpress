<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'Presscore_BBPress_Compatibility_Module', false ) ) :

	class Presscore_BBPress_Compatibility_Module {

		public static function init() {

			/**
			 * Enqueue dynamic stylesheets.
			 */
			add_action( 'presscore_enqueue_dynamic_stylesheets', array( __CLASS__, 'enqueue_dynamic_stylesheets' ) );

		}

		public static function enqueue_dynamic_stylesheets() {
			$template_uri = PRESSCORE_THEME_URI;
			$template_directory = PRESSCORE_THEME_DIR;
			$theme_version = wp_get_theme()->get( 'Version' );

			$dynamic_stylesheets = array(
				'bb-press.less' => array(
					'path' => $template_directory . '/css/bb-press.less',
					'src' => $template_uri . '/css/bb-press.less',
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

endif;

Presscore_BBPress_Compatibility_Module::init();
