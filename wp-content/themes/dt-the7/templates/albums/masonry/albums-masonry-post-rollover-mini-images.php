<?php
/**
 * Portfolio post content part with rollover
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
	$thumbnail_id = get_post_thumbnail_id();

	if ( !in_array( $thumbnail_id, $media_items ) && $config->get( 'post.media.featured_image.enabled' ) ) {
		array_unshift( $media_items, $thumbnail_id );
	}
}

array_shift( $media_items );

$mini_count = 3;
$image_hover = '';

foreach ( $media_items as $key=>$attachment_id ) {

	$mini_image_args = array(
		'img_meta' 	=> wp_get_attachment_image_src( $attachment_id, 'thumbnail' ),
		'img_id'	=> $attachment_id,
		'img_class' => 'preload-me',
		'alt'		=> get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ),
		'wrap'		=> '<img %IMG_CLASS% %SRC% %ALT% width="90" />',
		'echo'		=> false
	);

	if ( $mini_count ) {
		$image_hover = '<span class="r-thumbn-' . $mini_count . '">' . dt_get_thumb_img( $mini_image_args ) . '<i></i></span>' . $image_hover;
		$mini_count--;

	} else {
		break;

	}
}

if ( $image_hover ) {
	echo '<span class="rollover-thumbnails">' . $image_hover . '</span>';
}
