<?php
/**
 * Share buttons.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Page definition.
 */
$options[] = array(
		"page_title"	=> _x( "Share Buttons", 'theme-options', LANGUAGE_ZONE ),
		"menu_title"	=> _x( "Share Buttons", 'theme-options', LANGUAGE_ZONE ),
		"menu_slug"		=> "of-likebuttons-menu",
		"type"			=> "page"
);

/**
 * Heading definition.
 */
$options[] = array( "name" => _x('Share Buttons', 'theme-options', LANGUAGE_ZONE), "type" => "heading" );

$share_buttons_titles = array(
	'post' => _x( 'Share this post', 'theme options', LANGUAGE_ZONE ),
	'portfolio_post' => _x( 'Share this post', 'theme options', LANGUAGE_ZONE ),
	'photo' => _x( 'Share this image', 'theme options', LANGUAGE_ZONE ),
	'page' => _x( 'Share this page', 'theme options', LANGUAGE_ZONE ),
);

foreach ( presscore_themeoptions_get_template_list() as $id=>$desc ) {

	/**
	 * Share buttons.
	 */
	$options[] = array(	"name" => $desc, "type" => "block_begin" );

		// input
		$options[] = array(
			"name"		=> _x( 'Button title', 'theme options', LANGUAGE_ZONE ),
			"id"		=> "social_buttons-{$id}-button_title",
			"std"		=> ( isset( $share_buttons_titles[ $id ] ) ? $share_buttons_titles[ $id ] : '' ),
			"type"		=> "text"
		);

		$options[] = array( "type" => "divider" );

		// social_buttons
		$options[] = array(
			"id"		=> 'social_buttons-' . $id,
			"std"		=> array(),
			"type"		=> 'social_buttons',
		);

	$options[] = array(	"type" => "block_end");

}
