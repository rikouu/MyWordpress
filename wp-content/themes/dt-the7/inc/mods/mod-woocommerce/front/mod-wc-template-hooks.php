<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Main content.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_action( 'woocommerce_before_main_content', 'dt_woocommerce_before_main_content', 10 );
add_action( 'woocommerce_after_main_content', 'dt_woocommerce_after_main_content', 10 );

/**
 * Loop.
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

add_action( 'woocommerce_before_shop_loop', 'dt_woocommerce_before_shop_loop', 40 );
add_action( 'woocommerce_after_shop_loop', 'dt_woocommerce_after_shoop_loop', 5 );

add_action( 'dt_wc_loop_start', 'dt_woocommerce_product_info_controller', 20 );

/**
 * Related products.
 */
add_filter( 'woocommerce_output_related_products_args', 'dt_woocommerce_related_products_args' );

/**
 * Subcategory shortcode.
 */
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );

/**
 * Single product.
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

/**
 * Search.
 */
add_action( 'presscore_before_search_loop', 'dt_woocommerce_add_product_template_to_search', 10 );
