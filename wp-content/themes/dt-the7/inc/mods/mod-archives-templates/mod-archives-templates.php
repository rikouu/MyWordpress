<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

require_once trailingslashit( dirname( __FILE__ ) ) . 'classes/class-mod-archives-templates.php';

if ( class_exists( 'Presscore_Mod_Archives_Templates', false ) ) {
	Presscore_Mod_Archives_Templates::get_instance()->setup();
}

if ( ! function_exists( 'pesscore_config_get_utility_page_id' ) ) :

	function pesscore_config_get_utility_page_id() {
		$page_id = null;

		if ( is_search() ) {
			$page_id = of_get_option( 'template_page_id_search', null );
		} else if ( is_category() ) {
			$page_id = of_get_option( 'template_page_id_blog_category', null );
		} else if ( is_tag() ) {
			$page_id = of_get_option( 'template_page_id_blog_tags', null );
		} else if ( is_author() ) {
			$page_id = of_get_option( 'template_page_id_author', null );
		} else if ( is_date() || is_day() || is_month() || is_year() ) {
			$page_id = of_get_option( 'template_page_id_date', null );
		} else if ( is_tax( 'dt_portfolio_category' ) ) {
			$page_id = of_get_option( 'template_page_id_portfolio_category', null );
		} else if ( is_tax( 'dt_gallery_category' ) ) {
			$page_id = of_get_option( 'template_page_id_gallery_category', null );
		}

		return apply_filters( 'pesscore_config_get_utility_page_id', $page_id );
	}

	add_filter( 'presscore_archive_page_id', 'pesscore_config_get_utility_page_id' );

endif;
