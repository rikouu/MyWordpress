<?php
/**
 * Portfolio post content part with rollover
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();

///////////
// Title //
///////////

if ( $config->get( 'show_titles' ) && get_the_title() ) {

	echo '<h3 class="entry-title">';

	if ( 'lightbox' == $config->get( 'post.open_as' ) ) {
		echo '<a href="' . get_permalink() . '" class="dt-trigger-first-mfp">';

	} else {
		echo '<a href="' . get_permalink() . '">';

	}
			the_title();
		echo '</a>';
	echo '</h3>';

}

/////////////
// Content //
/////////////

if ( $config->get( 'show_excerpts' ) ) {
	the_excerpt();
}

//////////////////////
// Meta information //
//////////////////////

echo presscore_new_posted_on( 'dt_gallery' );
