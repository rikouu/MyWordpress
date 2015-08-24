<?php
/**
 * Portfolio media content
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// check show or not media content
if ( !post_password_required() ) {

	$config = Presscore_Config::get_instance();

	switch ( $config->get( 'post.preview.media.style' ) ) {
		case 'featured_image':
			dt_get_template_part( 'portfolio/list/portfolio-list-post-media-content-image' );
			break;

		case 'slideshow':
			dt_get_template_part( 'portfolio/list/portfolio-list-post-media-content-slider' );
			break;
	}

}
