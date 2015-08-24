<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'dt_woocommerce_add_config_actions' ) ) :

	function dt_woocommerce_add_config_actions() {
		$config = presscore_get_config();
		$mod_wc_config = dt_woocommerce_template_config( $config );

		add_action( 'dt_wc_loop_start', array( $mod_wc_config, 'setup' ) );
		add_action( 'dt_wc_loop_end', array( $mod_wc_config, 'cleanup' ) );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_init_template_config' ) ) :

	/**
	 * Init theme config for shop.
	 *
	 */
	function dt_woocommerce_init_template_config( $name = '' ) {

		dt_woocommerce_add_config_actions();

		if ( 'shop' != $name ) {
			return;
		}

		$config = presscore_get_config();
		$post_id = null;

		if ( is_shop() ) {
			$post_id =  woocommerce_get_page_id( 'shop' );

		} else if ( is_cart() ) {
			$post_id =  woocommerce_get_page_id( 'cart' );

		} else if ( is_checkout() ) {
			$post_id =  woocommerce_get_page_id( 'checkout' );

		}

		presscore_config_base_init( $post_id );

		if ( is_product_category() || is_product_tag() ) {

			$post_id =  woocommerce_get_page_id( 'shop' );
			if ( $post_id ) {

				$config->set( 'post_id', $post_id );
				presscore_config_populate_sidebar_and_footer_options();
				$config->set( 'post_id', null );

			}

		}

		if ( ! is_product() ) {
			add_filter( 'presscore_get_page_title', 'dt_woocommerce_get_page_title', 20 );
		}

		// replace theme breadcrumbs
		add_filter( 'presscore_get_breadcrumbs-html', 'dt_woocommerce_replace_theme_breadcrumbs', 20, 2 );
	}

	add_action( 'get_header', 'dt_woocommerce_init_template_config', 10 );

endif;
