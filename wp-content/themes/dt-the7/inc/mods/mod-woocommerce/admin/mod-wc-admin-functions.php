<?php
/**
 * Admint functions for WC module.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'dt_woocommerce_add_theme_options' ) ) :

	/**
	 * Add WooCommerce theme options page.
	 * 
	 * @param  array  $options
	 * @return array
	 */
	function dt_woocommerce_add_theme_options( $options = array() ) {
		$options['woocommerce'] = 'inc/mods/mod-woocommerce/admin/mod-wc-options.php';

		return $options;
	}

	add_filter( 'presscore_options_list', 'dt_woocommerce_add_theme_options', 20 );

endif;

if ( ! function_exists( 'dt_woocommerce_add_product_metaboxes' ) ) :

	/**
	 * Add common meta boxes to product post type.
	 */
	function dt_woocommerce_add_product_metaboxes() {

		global $DT_META_BOXES;

		if ( $DT_META_BOXES ) {

			foreach ( array( 'dt_page_box-sidebar', 'dt_page_box-footer', 'dt_page_box-header_options', 'dt_page_box-slideshow_options', 'dt_page_box-fancy_header_options' ) as $mb_id ) {
				if ( isset($DT_META_BOXES[ $mb_id ], $DT_META_BOXES[ $mb_id ]['pages']) ) {
					$DT_META_BOXES[ $mb_id ]['pages'][] = 'product';
				}
			}
		}
	}

	add_action( 'admin_init', 'dt_woocommerce_add_product_metaboxes', 30 );

endif;
