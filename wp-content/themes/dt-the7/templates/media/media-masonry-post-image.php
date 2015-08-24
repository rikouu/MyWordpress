<?php
/**
 * Media post media content part for image
 *
 * @since 1.0.0
 * @package vogue
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<div class="project-list-media">

	<div class="buttons-on-img">

		<?php
		$thumb_id = get_the_ID();
		$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );
		$video_url = esc_url( get_post_meta( $thumb_id, 'dt-video-url', true ) );
		$thumb_title = presscore_image_title_enabled( $thumb_id ) ? get_the_title() : '';

		$thumb_args = array(
			'img_meta' 			=> $thumb_meta,
			'img_id'			=> $thumb_id,
			'img_class' 		=> 'preload-me',
			'class'				=> 'alignnone dt-mfp-item',
			'options'			=> presscore_set_image_dimesions(),
			'img_description'	=> get_the_content(),
			'title'				=> $thumb_title,
			'wrap'				=> '<a %HREF% %CLASS% %TITLE% data-dt-img-description="%RAW_IMG_DESCRIPTION%" %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %SIZE% /></a>'
		);

		if ( $video_url ) {
			$thumb_args['class'] .= ' rollover rollover-video mfp-iframe';
			$thumb_args['href'] = $video_url;

		} else {
			$thumb_args['class'] .= ' rollover rollover-zoom mfp-image';

		}

		// set proportion
		$thumb_args = presscore_add_thumbnail_class_for_masonry( $thumb_args );

		dt_get_thumb_img( $thumb_args );
		?>

	</div>

</div>