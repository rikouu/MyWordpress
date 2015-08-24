<?php
/**
 * Portfolio post media content part for image
 *
 * @since 1.0.0
 * @package vogue
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();

$media_items = $config->get( 'post.media.library' );

if ( !$media_items ) {
	$media_items = array();
}

// add thumbnail to attachments list
if ( has_post_thumbnail() ) {
	array_unshift( $media_items, get_post_thumbnail_id() );
}

// if pass protected - show only cover image
if ( $media_items && post_password_required() ) {
	$media_items = array( $media_items[0] );
}

$exclude_cover = !$config->get( 'post.media.featured_image.enabled' ) && has_post_thumbnail();

// get attachments data
$attachments_data = presscore_get_attachment_post_data( $media_items );

// if there are one image in gallery
if ( count( $attachments_data ) == 1 ) {
	$exclude_cover = false;
}

$class = array( 'rollover-click-target' );

if ( !$config->get( 'show_excerpts' ) && !$config->get( 'show_titles' ) && !$config->get( 'post.preview.mini_images.enabled' ) ) {
	$class[] = 'rollover';

	if ( 'lightbox' == $config->get( 'post.open_as' ) ) {
		$class[] = 'rollover-zoom';
	}
}

$gallery_args = array(
	'class'					=> $class,
	'exclude_cover'			=> $exclude_cover,
	'show_preview_on_hover' => $config->get( 'post.preview.mini_images.enabled' ),
	'share_buttons'			=> true,
	'attachments_count'		=> false,
	'video_icon'			=> false,
	'show_preview_on_hover'	=> false,
	'title_img_options'		=> presscore_set_image_dimesions()
);

// open album post instead lightbox gallery
if ( 'post' == $config->get( 'post.open_as' ) ) {
	$gallery_args['title_image_args'] = array( 'href' => get_permalink(), 'class' => implode( ' ', $class ) . ' go-to' );
} 

echo presscore_get_images_gallery_hoovered( $attachments_data, $gallery_args );
