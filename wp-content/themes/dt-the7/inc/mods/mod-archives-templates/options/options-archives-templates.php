<?php
/**
 * Archives settings
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Archives", "theme-options", LANGUAGE_ZONE ),
		"menu_title"	=> _x( "Archives", "theme-options", LANGUAGE_ZONE ),
		"menu_slug"		=> "of-archives-templates-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Archives", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Author.
	 */
	$options[] = array( "name" => _x("Author", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

		// select
		$options[] = array(
			"name"		=> _x( 'Author archive template', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'template_page_id_author',
			"type"		=> 'pages_list'
		);

	$options[] = array( "type" => "block_end" );

	/**
	 * Date.
	 */
	$options[] = array( "name" => _x("Date", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

		// select
		$options[] = array(
			"name"		=> _x( 'Date archive template', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'template_page_id_date',
			"type"		=> 'pages_list'
		);

	$options[] = array( "type" => "block_end" );

	/**
	 * Blog archives.
	 */
	$options[] = array(	"name" => _x('Blog archives', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// select
		$options[] = array(
			"name"		=> _x( 'Blog category template', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'template_page_id_blog_category',
			"type"		=> 'pages_list'
		);

		$options[] = array(
			"name"		=> _x( 'Blog tags template', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'template_page_id_blog_tags',
			"type"		=> 'pages_list'
		);

	$options[] = array(	"type" => "block_end");

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Search", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Search.
	 */
	$options[] = array( "name" => _x("Search", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

		// select
		$options[] = array(
			"name"		=> _x( 'Search page', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'template_page_id_search',
			"type"		=> 'pages_list'
		);

	$options[] = array( "type" => "block_end" );

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Portfolio", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Portfolio.
	 */
	$options[] = array( "name" => _x("Portfolio archives", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

		// select
		$options[] = array(
			"name"		=> _x( 'Portfolio category template', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'template_page_id_portfolio_category',
			"type"		=> 'pages_list'
		);

	$options[] = array( "type" => "block_end" );

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Albums", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Albums.
	 */
	$options[] = array( "name" => _x("Albums archives", "theme-options", LANGUAGE_ZONE), "type" => "block_begin" );

		// select
		$options[] = array(
			"name"		=> _x( 'Albums category template', 'theme-options', LANGUAGE_ZONE ),
			"id"		=> 'template_page_id_gallery_category',
			"type"		=> 'pages_list'
		);

	$options[] = array( "type" => "block_end" );
