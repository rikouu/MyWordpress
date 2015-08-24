<?php
/**
 * Blog post content media template
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// check show or not media content
if ( presscore_show_post_media() ) {

	echo '<div class="blog-media wf-td">';

	/////////////////
	// fancy date //
	/////////////////

	echo presscore_get_blog_post_fancy_date();

	/////////////////////
	// media template //
	/////////////////////

	dt_get_template_part( "blog/masonry/blog-masonry-post-media-content", get_post_format() );

	echo '</div>';
}
