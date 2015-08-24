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

if ( has_post_thumbnail() ) {
	$thumb_id = get_post_thumbnail_id();
	$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );
	$video_url = get_post_meta( $thumb_id, 'dt-video-url', true );

} else {
	$thumb_id = 0;
	$thumb_meta = presscore_get_default_image();
	$video_url = false;

}

if ( $config->get( 'post.preview.content.visible' ) ) {
	$link_classes = '';

} else {

	$link_classes = 'rollover';

	if ( $video_url ) {
		$link_classes = 'rollover-video';
	}
}

$thumb_args = array(
	'img_meta' 	=> $thumb_meta,
	'img_id'	=> $thumb_id,
	'img_class' => 'preload-me',
	'class'		=> $link_classes,
	'href'		=> get_permalink(),
	'options'	=> presscore_set_image_dimesions(),
	'wrap'		=> '<a %HREF% %CLASS% %TITLE% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %SIZE% /></a>'
);

$thumb_args = apply_filters( 'dt_portfolio_thumbnail_args', $thumb_args );

dt_get_thumb_img( $thumb_args );
