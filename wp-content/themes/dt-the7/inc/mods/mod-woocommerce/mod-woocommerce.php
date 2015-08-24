<?php
/**
 * WooCommerce module
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// add wooCommerce support
add_theme_support( 'woocommerce' );

// admin scripts
require_once dirname(__FILE__) . '/admin/mod-wc-admin-functions.php';

// frontend scripts
require_once dirname(__FILE__) . '/front/mod-wc-class-template-config.php';
require_once dirname(__FILE__) . '/front/mod-wc-template-functions.php';
require_once dirname(__FILE__) . '/front/mod-wc-template-config.php';
require_once dirname(__FILE__) . '/front/mod-wc-template-hooks.php';

if ( ! function_exists( 'dt_woocommerce_enqueue_scripts' ) ) :

	/**
	 * Enqueue stylesheets and scripts.
	 */
	function dt_woocommerce_enqueue_scripts() {

		// remove woocommerce styles
		add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

		$theme = wp_get_theme();
		$theme_version = $theme->get( 'Version' );

		// enqueue custom script
		wp_enqueue_script( 'dt-wc-custom', PRESSCORE_THEME_URI . '/inc/mods/mod-woocommerce/assets/js/mod-wc-scripts.js', array( 'jquery' ), $theme_version, true );
	}

	add_action( 'wp_enqueue_scripts', 'dt_woocommerce_enqueue_scripts', 9 );

endif;
