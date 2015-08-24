<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
	"page_title" => _x( "WooCommerce", 'theme-options', LANGUAGE_ZONE ),
	"menu_title" => _x( "WooCommerce", 'theme-options', LANGUAGE_ZONE ),
	"menu_slug" => "of-woocommerce-menu",
	"type" => "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Item settings', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * Item settings.
 */
$options[] = array( "name" => _x("Item settings", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

	$options[] = array(
		"name" => _x( "Show product information", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_display_product_info",
		"std" => "under_image",
		"type" => "radio",
		"options" => array(
			'under_image' => _x( "Under image", "theme-options", LANGUAGE_ZONE ),
			'on_hoover_centered' => _x( "On image hover", "theme-options", LANGUAGE_ZONE )
		)
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product titles", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_show_product_titles",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product price", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_show_product_price",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Product rating", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_show_product_rating",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Details icon", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_show_details_icon",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Cart icon", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_show_cart_icon",
		"std" => 1,
		"type" => "radio",
		"options" => $en_dis_options
	);

$options[] = array( "type" => "block_end" );

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('List settings', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

/**
 * List settings.
 */
$options[] = array( "name" => _x("List settings", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

	$options[] = array(
		"name" => _x( "Layout", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_shop_template_layout",
		"std" => "masonry",
		"type" => "radio",
		"options" => array(
			'masonry' => _x( "Masonry", "theme-options", LANGUAGE_ZONE ),
			'grid' => _x( "Grid", "theme-options", LANGUAGE_ZONE )
		)
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Image paddings (px)", "theme-options", LANGUAGE_ZONE ),
		"desc" => _x( "(e.g. 5 pixel padding will give you 10 pixel gaps between images)", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_shop_template_gap",
		"class" => "mini",
		"std" => 20,
		"type" => "text",
		"sanitize" => "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Column minimum width (px)", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_shop_template_column_min_width",
		"class" => "mini",
		"std" => 370,
		"type" => "text",
		"sanitize" => "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Desired columns number", "theme-options", LANGUAGE_ZONE ),
		"desc" => _x( "(used for defult shop page, archives, search results etc.)", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_shop_template_columns",
		"class" => "mini",
		"std" => 3,
		"type" => "text",
		"sanitize" => "dimensions"
	);

	$options[] = array( "type" => "divider" );

	$options[] = array(
		"name" => _x( "Loading effect", "theme-options", LANGUAGE_ZONE ),
		"id" => "woocommerce_shop_template_loading_effect",
		"std" => "fade_in",
		"type" => "radio",
		"options" => array(
			'none'				=> _x( 'None', 'backend metabox', LANGUAGE_ZONE ),
			'fade_in'			=> _x( 'Fade in', 'backend metabox', LANGUAGE_ZONE ),
			'move_up'			=> _x( 'Move up', 'backend metabox', LANGUAGE_ZONE ),
			'scale_up'			=> _x( 'Scale up', 'backend metabox', LANGUAGE_ZONE ),
			'fall_perspective'	=> _x( 'Fall perspective', 'backend metabox', LANGUAGE_ZONE ),
			'fly'				=> _x( 'Fly', 'backend metabox', LANGUAGE_ZONE ),
			'flip'				=> _x( 'Flip', 'backend metabox', LANGUAGE_ZONE ),
			'helix'				=> _x( 'Helix', 'backend metabox', LANGUAGE_ZONE ),
			'scale'				=> _x( 'Scale', 'backend metabox', LANGUAGE_ZONE )
		)
	);

$options[] = array( "type" => "block_end" );

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Product", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

/**
 * Related products.
 */
$options[] = array( "name" => _x("Related products", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

	// input
	$options[] = array(
		"name"		=> _x( "Maximum number of products", "theme-options", LANGUAGE_ZONE ),
		"id"		=> "woocommerce_rel_products_max",
		"std"		=> "5",
		"type"		=> "text",
		"class"		=> "mini",
		"sanitize"	=> "slider"
	);

$options[] = array( "type" => "block_end" );
