<?php
/**
 * Portfolio post media content part for image
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();

$thumb_id = get_the_ID();
$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );
$thumb_title = presscore_image_title_enabled( $thumb_id ) ? get_the_title() : '';

$thumb_args = array(
	'img_meta' 			=> $thumb_meta,
	'img_id'			=> $thumb_id,
	'img_class' 		=> 'preload-me',
	'class'				=> 'dt-mfp-item',
	'img_description'	=> get_the_content(),
	'img_title'			=> $thumb_title,
	'options'			=> array( 'h' => round( $config->get('target_height') * 1.3 ), 'z' => 0 ),
	'wrap'				=> '<a %HREF% %CLASS% %IMG_TITLE% data-dt-img-description="%RAW_IMG_DESCRIPTION%" %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %SIZE% /></a>'
);

$video_url = get_post_meta( $thumb_id, 'dt-video-url', true );

if ( $video_url ) {
	$thumb_args['class'] .= ' mfp-iframe';
	$thumb_args['href'] = $video_url;

} else {
	$thumb_args['class'] .= ' mfp-image';

}

if ( !$config->get( 'post.preview.content.visible' ) ) {
	$thumb_args['class'] .= ' rollover' . ( $video_url ? ' rollover-video' : ' rollover-zoom' );
}

// set proportion
$thumb_args = presscore_add_thumbnail_class_for_masonry( $thumb_args );

dt_get_thumb_img( $thumb_args );
