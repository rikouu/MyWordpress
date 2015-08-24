<?php
/**
 * Templates settings
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Blog, Portfolio, Gallery", "theme-options", LANGUAGE_ZONE ),
		"menu_title"	=> _x( "Blog, Portfolio, Gallery", "theme-options", LANGUAGE_ZONE ),
		"menu_slug"		=> "of-blog-and-portfolio-menu",
		"type"			=> "page"
);

//////////
// Blog //
//////////

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Blog post", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Author info in posts
	 */
	$options[] = array(	"name" => _x('Author info in posts', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// checkbox
		$options[] = array(
			"name"      => _x( 'Show author info in blog posts', 'theme-options', LANGUAGE_ZONE ),
			"id"    	=> 'general-show_author_in_blog',
			"type"  	=> 'radio',
			'std'   	=> 1,
			"options"	=> $yes_no_options
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Previous &amp; next buttons
	 */
	$options[] = array(	"name" => _x('Previous &amp; next buttons', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// checkbox
		$options[] = array(
			"name"      => _x( 'Show in blog posts', 'theme-options', LANGUAGE_ZONE ),
			"id"    	=> 'general-next_prev_in_blog',
			"type"  	=> 'radio',
			'std'   	=> 1,
			"options"	=> $yes_no_options
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Back button.
	 */
	$options[] = array(	"name" => _x('Back button', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Back button', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-show_back_button_in_post',
			"std"		=> '0',
			"type"		=> 'radio',
			"options"	=> $en_dis_options,
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// select
			$options[] = array(
				"name"		=> _x( 'Choose page', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-post_back_button_target_page_id',
				"type"		=> 'pages_list'
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

	/**
	 * Meta information.
	 */
	$options[] = array(	"name" => _x('Meta information', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Meta information', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-blog_meta_on',
			"std"		=> '1',
			"type"		=> 'radio',
			"options"	=> $en_dis_options,
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Date', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-blog_meta_date',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Author', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-blog_meta_author',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Categories', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-blog_meta_categories',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Comments', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-blog_meta_comments',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Tags', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-blog_meta_tags',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

	/**
	 * Related posts.
	 */
	$options[] = array(	"name" => _x('Related posts', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Related posts', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-show_rel_posts',
			"std"		=> '0',
			"type"		=> 'radio',
			"options"	=> $en_dis_options,
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// input
			$options[] = array(
				"name"		=> _x( 'Title', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-rel_posts_head_title',
				"std"		=> __('Related posts', LANGUAGE_ZONE),
				"type"		=> 'text',
			);

			// input
			$options[] = array(
				"name"		=> _x( 'Maximum number of related posts', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-rel_posts_max',
				"std"		=> 6,
				"type"		=> 'text',
				// number
				"sanitize"	=> 'ppp'
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");


///////////////
// Portfolio //
///////////////

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Portfolio post", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Prev / Next buttons.
	 */
	$options[] = array(	"name" => _x('Previous &amp; next buttons', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"name"      => _x( 'Show in portfolio posts', 'theme-options', LANGUAGE_ZONE ),
			"id"    	=> 'general-next_prev_in_portfolio',
			"type"  	=> 'radio',
			'std'   	=> 1,
			"options"	=> $yes_no_options,
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Back button.
	 */
	$options[] = array(	"name" => _x('Back button', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Back button', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-show_back_button_in_project',
			"std"		=> '0',
			"type"		=> 'radio',
			"options"	=> $en_dis_options,
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// select
			$options[] = array(
				"name"		=> _x( 'Choose page', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-project_back_button_target_page_id',
				"type"		=> 'pages_list'
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

	/**
	 * Meta information.
	 */
	$options[] = array(	"name" => _x('Meta information', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Meta information', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-portfolio_meta_on',
			"std"		=> '1',
			"type"		=> 'radio',
			"options"	=> $en_dis_options,
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Date', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-portfolio_meta_date',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Author', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-portfolio_meta_author',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Categories', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-portfolio_meta_categories',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Number of comments', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-portfolio_meta_comments',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

	/**
	 * Related projects.
	 */
	$options[] = array(	"name" => _x('Related projects', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Related projects', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-show_rel_projects',
			"std"		=> '0',
			"type"		=> 'radio',
			"options"	=> $en_dis_options,
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// title
			$options[] = array(
				"name"		=> _x( 'Title', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-rel_projects_head_title',
				"std"		=> __('Related projects', LANGUAGE_ZONE),
				"type"		=> 'text',
			);

			// show title
			$options[] = array(
				"name"		=> _x('Show titles', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_title',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show excerpt
			$options[] = array(
				"name"		=> _x('Show excerpts', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_excerpt',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show date
			$options[] = array(
				"name"		=> _x('Show date', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_info_date',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show author
			$options[] = array(
				"name"		=> _x('Show author', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_info_author',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show comments
			$options[] = array(
				"name"		=> _x('Show number of comments', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_info_comments',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show categories
			$options[] = array(
				"name"		=> _x('Show categories', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_info_categories',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show link
			$options[] = array(
				"name"		=> _x('Show links', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_link',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show zoom
			$options[] = array(
				"name"		=> _x('Show zoom', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_zoom',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// show details
			$options[] = array(
				"name"		=> _x('Show "Details" button', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_details',
				"std"		=> '1',
				"type"		=> 'checkbox'
			);

			// posts per page
			$options[] = array(
				"name"		=> _x( 'Maximum number of projects posts', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-rel_projects_max',
				"std"		=> 12,
				"type"		=> 'text',
				// number
				"sanitize"	=> 'ppp'
			);

			////////////////////////////////////
			// Related projects dimensions //
			////////////////////////////////////

			// input
			$options[] = array(
				"name"		=> _x( 'Related posts height for fullwidth posts (px)', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-rel_projects_fullwidth_height',
				"std"		=> 210,
				"type"		=> 'text',
				// number
				"sanitize"	=> 'ppp'
			);

			// radio
			$options[] = array(
				"name"		=> _x('Related posts width for fullwidth posts', 'theme-options', LANGUAGE_ZONE),
				"id"		=> 'general-rel_projects_fullwidth_width_style',
				"std"		=> 'prop',
				"type"		=> 'radio',
				"options"	=> $prop_fixed_options,
				"show_hide"	=> array( 'fixed' => true ),
			);

			// hidden area
			$options[] = array( 'type' => 'js_hide_begin' );

				// input
				$options[] = array(
					"name"		=> _x( 'Width (px)', 'theme-options', LANGUAGE_ZONE ),
					"id"		=> 'general-rel_projects_fullwidth_width',
					"std"		=> '210',
					"type"		=> 'text',
					// number
					"sanitize"	=> 'ppp'
				);

			$options[] = array( 'type' => 'js_hide_end' );

			// input
			$options[] = array(
				"name"		=> _x( 'Related posts height for posts with sidebar (px)', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-rel_projects_height',
				"std"		=> 180,
				"type"		=> 'text',
				// number
				"sanitize"	=> 'ppp'
			);

			// radio
			$options[] = array(
				"name"		=> _x( 'Related posts width for posts with sidebar', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-rel_projects_width_style',
				"std"		=> 'prop',
				"type"		=> 'radio',
				"options"	=> $prop_fixed_options,
				"show_hide"	=> array( 'fixed' => true ),
			);

			// hidden area
			$options[] = array( 'type' => 'js_hide_begin' );

				// input
				$options[] = array(
					"name"		=> _x( 'Width (px)', 'theme-options', LANGUAGE_ZONE ),
					"id"		=> 'general-rel_projects_width',
					"std"		=> '180',
					"type"		=> 'text',
					// number
					"sanitize"	=> 'ppp'
				);

			$options[] = array( 'type' => 'js_hide_end' );

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

////////////
// Albums //
////////////

/**
 * Heading definition.
 */
$options[] = array( "name" => _x("Gallery post", "theme-options", LANGUAGE_ZONE), "type" => "heading" );

	/**
	 * Previous &amp; next buttons
	 */
	$options[] = array(	"name" => _x('Previous &amp; next buttons', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// checkbox
		$options[] = array(
			"name"      => _x( 'Show in gallery albums', 'theme-options', LANGUAGE_ZONE ),
			"id"    	=> 'general-next_prev_in_album',
			"type"  	=> 'radio',
			'std'   	=> 1,
			"options"	=> $yes_no_options
		);

	$options[] = array(	"type" => "block_end");

	/**
	 * Back button.
	 */
	$options[] = array(	"name" => _x('Back button', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Back button', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-show_back_button_in_album',
			"std"		=> '0',
			"type"		=> 'radio',
			"options"	=> $en_dis_options,
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// select
			$options[] = array(
				"name"		=> _x( 'Choose page', 'theme-options', LANGUAGE_ZONE ),
				"id"		=> 'general-album_back_button_target_page_id',
				"type"		=> 'pages_list'
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");

	/**
	 * Meta information.
	 */
	$options[] = array(	"name" => _x('Meta information', 'theme-options', LANGUAGE_ZONE), "type" => "block_begin" );

		// radio
		$options[] = array(
			"desc"		=> '',
			"name"		=> _x('Meta information', 'theme-options', LANGUAGE_ZONE),
			"id"		=> 'general-album_meta_on',
			"std"		=> '1',
			"type"		=> 'radio',
			"options"	=> $en_dis_options,
			"show_hide"	=> array( '1' => true ),
		);

		// hidden area
		$options[] = array( 'type' => 'js_hide_begin' );

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Date', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-album_meta_date',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Author', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-album_meta_author',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Categories', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-album_meta_categories',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

			// checkbox
			$options[] = array(
				"desc"  	=> '',
				"name"      => _x( 'Comments', 'theme-options', LANGUAGE_ZONE ),
				"id"    	=> 'general-album_meta_comments',
				"type"  	=> 'checkbox',
				'std'   	=> 1
			);

		$options[] = array( 'type' => 'js_hide_end' );

	$options[] = array(	"type" => "block_end");
