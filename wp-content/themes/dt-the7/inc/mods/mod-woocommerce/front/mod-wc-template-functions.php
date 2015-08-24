<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! function_exists( 'woocommerce_pagination' ) ) {

	/**
	 * Output the pagination.
	 * (override)
	 *
	 * @access public
	 * @subpackage	Loop
	 * @return void
	 */
	function woocommerce_pagination() {
		global $wp_query;

		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		dt_paginator( $wp_query, array( 'class' => 'woocommerce-pagination paginator' ) );
	}
}

if ( ! function_exists( 'woocommerce_upsell_display' ) ) {

	/**
	 * Output product up sells.
	 * (override)
	 * 
	 * @access public
	 * @param int $posts_per_page (default: -1)
	 * @param int $columns (default: 5)
	 * @param string $orderby (default: 'rand')
	 * @return void
	 */
	function woocommerce_upsell_display( $posts_per_page = '-1', $columns = 5, $orderby = 'rand' ) {
		wc_get_template( 'single-product/up-sells.php', array(
				'posts_per_page'	=> $posts_per_page,
				'orderby'			=> apply_filters( 'woocommerce_upsells_orderby', $orderby ),
				'columns'			=> $columns
			) );
	}
}

if ( ! function_exists( 'woocommerce_cross_sell_display' ) ) {

	/**
	 * Output the cart cross-sells.
	 * (override)
	 *
	 * @param  integer $posts_per_page
	 * @param  integer $columns
	 * @param  string $orderby
	 */
	function woocommerce_cross_sell_display( $posts_per_page = 5, $columns = 5, $orderby = 'rand' ) {
		wc_get_template( 'cart/cross-sells.php', array(
				'posts_per_page' => $posts_per_page,
				'orderby'        => $orderby,
				'columns'        => $columns
			) );
	}
}

if ( ! function_exists( 'dt_woocommerce_related_products_args' ) ) :

	/**
	 * Change related products args to array( 'posts_per_page' => 5, 'columns' => 5, 'orderby' => 'date' ).
	 * 
	 * @param  array $args
	 * @return array
	 */
	function dt_woocommerce_related_products_args( $args ) {
		$posts_per_page = of_get_option( 'woocommerce_rel_products_max', 5 );
		return array_merge( $args, array( 'posts_per_page' => $posts_per_page, 'columns' => 5, 'orderby' => 'date' ) );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_before_main_content' ) ) :

	/**
	 * Display main content open tags and fire hooks.
	 */
	function dt_woocommerce_before_main_content () {

		// remove woocommerce breadcrumbs
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

		// only for shop
		if ( is_shop() || is_product_category() || is_product_tag() ) {

			// remove woocommerce title
			add_filter( 'woocommerce_show_page_title', '__return_false');
		} else if ( is_product() ) {

			$config = presscore_get_config();

			if ( 'disabled' != $config->get( 'header_title' ) ) {

				// remove product title
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

			}
		}
	?>
		<!-- Content -->
		<div id="content" class="content" role="main">
	<?php
	}

endif;

if ( ! function_exists( 'dt_woocommerce_after_main_content' ) ) :

	/**
	 * Display main content end tags.
	 */
	function dt_woocommerce_after_main_content () {
	?>
		</div>
	<?php
	}

endif;

if ( ! function_exists( 'dt_woocommerce_mini_cart' ) ) :

	/**
	 * Display customized shop mini cart.
	 */
	function dt_woocommerce_mini_cart() {
		get_template_part('inc/mods/mod-woocommerce/front/templates/cart/mod-wc-mini-cart');
	}

endif;

if ( ! function_exists( 'dt_woocommerce_replace_theme_breadcrumbs' ) ) :

	/**
	 * Breadcrumbs filter
	 * 
	 * @param  string $html
	 * @param  array  $args
	 * @return string
	 */
	function dt_woocommerce_replace_theme_breadcrumbs( $html = '', $args = array() ) {

		if ( ! $html ) {

			ob_start();
			woocommerce_breadcrumb( array(
				'delimiter' => '',
				'wrap_before' => '<div class="assistive-text"></div><ol' . $args['listAttr'] . '>',
				'wrap_after' => '</ol>',
				'before' => '<li>',
				'after' => '</li>',
				'home' => _x( 'Home', 'breadcrumb', LANGUAGE_ZONE ),
			) );
			$html = ob_get_clean();

			$html = apply_filters( 'presscore_get_breadcrumbs', $args['beforeBreadcrumbs'] . $html . $args['afterBreadcrumbs'] );

		}

		return $html;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_page_title' ) ) :

	/**
	 * Wrap for woocommerce_page_title( false ).
	 * 
	 * @param  string $title
	 * @return string
	 */
	function dt_woocommerce_get_page_title( $title = '' ) {
		return woocommerce_page_title( false );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_product_desc_under' ) ) :

	/**
	 * Display product description under image template.
	 */
	function dt_woocommerce_template_product_desc_under() {
		get_template_part( 'inc/mods/mod-woocommerce/front/templates/product/mod-wc-product-desc-under' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_product_desc_rollover' ) ) :

	/**
	 * Display product description on image template.
	 */
	function dt_woocommerce_template_product_desc_rollover() {
		get_template_part( 'inc/mods/mod-woocommerce/front/templates/product/mod-wc-product-desc-rollover' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_product_description' ) ) :

	/**
	 * Display product description template.
	 */
	function dt_woocommerce_template_product_description() {
		get_template_part( 'inc/mods/mod-woocommerce/front/templates/product/mod-wc-product-description' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_subcategory_desc_under' ) ) :

	/**
	 * Display subcategory description under image template.
	 */
	function dt_woocommerce_template_subcategory_desc_under() {
		get_template_part( 'inc/mods/mod-woocommerce/front/templates/subcategory/mod-wc-subcategory-desc-under' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_subcategory_desc_rollover' ) ) :

	/**
	 * Display subcategory description on image template.
	 */
	function dt_woocommerce_template_subcategory_desc_rollover() {
		get_template_part( 'inc/mods/mod-woocommerce/front/templates/subcategory/mod-wc-subcategory-desc-rollover' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_subcategory_description' ) ) :

	/**
	 * Display subcategory description template.
	 */
	function dt_woocommerce_template_subcategory_description() {
		get_template_part( 'inc/mods/mod-woocommerce/front/templates/subcategory/mod-wc-subcategory-description' );
	}

endif;

if ( ! function_exists( 'presscore_wc_template_loop_product_thumbnail' ) ) :

	/**
	 * Display woocommerce_template_loop_product_thumbnail() wrapped with 'a' tag.
	 * 
	 * @param  string $class
	 */
	function presscore_wc_template_loop_product_thumbnail( $class = '' ) {
		ob_start();
		woocommerce_template_loop_product_thumbnail();
		$img = ob_get_contents();
		ob_end_clean();

		$img = str_replace( 'wp-post-image', 'wp-post-image preload-me', $img );

		echo '<a href="' . get_permalink() . '" class="' . esc_attr( $class ) . '">' . $img . '</a>';
	}

endif;

if ( ! function_exists( 'dt_woocommerce_subcategory_thumbnail' ) ) :

	/**
	 * Display woocommerce_subcategory_thumbnail() wrapped with 'a' targ.
	 * 
	 * @param  mixed $category
	 * @param  string $class
	 */
	function dt_woocommerce_subcategory_thumbnail( $category, $class = '' ) {
		ob_start();
		woocommerce_subcategory_thumbnail( $category );
		$img = ob_get_contents();
		ob_end_clean();

		$img = str_replace( '<img', '<img class="preload-me"', $img );

		echo '<a href="' . get_term_link( $category->slug, 'product_cat' ) . '" class="' . esc_attr( $class ) . '">' . $img . '</a>';
	}

endif;

if ( ! function_exists( 'dt_woocommerce_product_info_controller' ) ) :

	/**
	 * Controls product price and rating visibility.
	 */
	function dt_woocommerce_product_info_controller() {
		$config = presscore_get_config();

		if ( $config->get( 'product.preview.show_price' ) ) {
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );
		}

		if ( $config->get( 'product.preview.show_rating' ) ) {
			add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
		}
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_product_icons_count' ) ) :

	/**
	 * Counts product icons for shop pages.
	 * 
	 * @return integer
	 */
	function dt_woocommerce_get_product_icons_count() {
		$config = presscore_get_config();

		$count = 0;
		if ( $config->get( 'show_details' ) ) {
			$count++;
		}

		if ( $config->get( 'product.preview.icons.show_cart' ) ) {
			$count++;
		}

		return apply_filters( 'dt_woocommerce_get_product_icons_count', $count );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_product_show_content' ) ) :

	/**
	 * Controls content visibility.
	 * 
	 * @return bool
	 */
	function dt_woocommerce_product_show_content() {
		return apply_filters( 'dt_woocommerce_product_show_content', presscore_get_config()->get( 'post.preview.content.visible' ) );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_product_add_to_cart_icon' ) ) :

	/**
	 * Return product add to cart icon html.
	 * 
	 * @return setring
	 */
	function dt_woocommerce_get_product_add_to_cart_icon() {
		if ( ! presscore_get_config()->get( 'product.preview.icons.show_cart' ) ) {
			return '';
		}

		global $product;

		return apply_filters( 'woocommerce_loop_add_to_cart_link',
			sprintf( '<a href="%s" data-product_id="%s" data-product_sku="%s" class="product-add-to-cart %s product_type_%s">%s</a>',
				esc_url( $product->add_to_cart_url() ),
				esc_attr( $product->id ),
				esc_attr( $product->get_sku() ),
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				esc_attr( $product->product_type ),
				esc_html( $product->add_to_cart_text() )
			),
		$product );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_product_details_icon' ) ) :

	/**
	 * Return product details icon html.
	 * 
	 * @param int
	 * @param mixed
	 *
	 * @return string
	 */
	function dt_woocommerce_get_product_details_icon( $post_id = null, $class = 'project-details' ) {
		if ( ! presscore_get_config()->get( 'show_details' ) ) {
			return '';
		}

		if ( ! $post_id ) {
			global $product;
			$post_id = $product->id;
		}

		if ( is_array( $class ) ) {
			$class = implode( ' ', $class );
		}

		$output = '<a href="' . get_permalink( $post_id ) . '" class="' . esc_attr( $class ) . '" rel="nofollow">' . __( 'Product details', LANGUAGE_ZONE ) . '</a>';

		return apply_filters( 'dt_woocommerce_get_product_details_icon', $output, $post_id, $class );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_get_product_preview_icons' ) ) :

	/**
	 * Returns product icons for shop pages.
	 * 
	 * @return string
	 */
	function dt_woocommerce_get_product_preview_icons() {
		$rollover_icons = '';
		$rollover_icons .= dt_woocommerce_get_product_add_to_cart_icon();
		$rollover_icons .= dt_woocommerce_get_product_details_icon();

		return $rollover_icons;
	}

endif;

if ( ! function_exists( 'dt_woocommerce_before_shop_loop' ) ) :

	/**
	 * Display main container open tags and fire hooks
	 */
	function dt_woocommerce_before_shop_loop() {
		// do_action( 'presscore_before_loop' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_after_shoop_loop' ) ) :

	/**
	 * Display main container close tags and fire hooks
	 */
	function dt_woocommerce_after_shoop_loop() {
		// do_action( 'presscore_after_loop' );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_template_config' ) ) :

	/**
	 * Return new instance of DT_WC_Template_Config
	 *
	 * @param  object $config
	 * @return object
	 */
	function dt_woocommerce_template_config( $config ) {
		return new DT_WC_Template_Config( $config );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_search_loop_post_content' ) ) :

	function dt_woocommerce_search_loop_post_content() {
		static $products_config = array();

		$config = presscore_get_config();
		$config_back = $config->get();

		if ( empty( $products_config ) ) {

			$config->set( 'post.preview.description.style', 'under_image' );
			$config->set( 'post.preview.description.alignment', 'center' );
			$config->set( 'show_titles', true );
			$config->set( 'show_details', true );
			$config->set( 'product.preview.show_price', true );
			$config->set( 'product.preview.show_rating', false );
			$config->set( 'product.preview.icons.show_cart', true );

			$products_config = $config->get();

			dt_woocommerce_product_info_controller();
		} else {
			$config->reset( $products_config );
		}

		get_template_part( 'woocommerce/content-product' );

		$config->reset( $config_back );
	}

endif;

if ( ! function_exists( 'dt_woocommerce_add_product_template_to_search' ) ) :

	function dt_woocommerce_add_product_template_to_search() {
		if ( function_exists( 'presscore_search_content_templates' ) ) {
			presscore_search_content_templates()->add_action( 'product', 'dt_woocommerce_search_loop_post_content' );
		}
	}

endif;
