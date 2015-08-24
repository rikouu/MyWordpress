<?php
/**
 * Portfolio post media content part for image
 *
 * @since 1.0.0
 * @package vogue
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// $config = Presscore_Config::get_instance();

?>

<div class="project-list-media">

	<div class="buttons-on-img">

		<?php
		if ( has_post_thumbnail() ) {
			$thumb_id = get_post_thumbnail_id();
			$thumb_meta = wp_get_attachment_image_src( $thumb_id, 'full' );
			$video_url = esc_url( get_post_meta( $thumb_id, 'dt-video-url', true ) );

		} else {
			$thumb_id = 0;
			$thumb_meta = presscore_get_default_image();
			$video_url = false;

		}

		if ( !$video_url ) {
			$link_classes = ' rollover';

		} else {
			$link_classes = ' rollover-video';

		}

		$thumb_args = array(
			'img_meta' 	=> $thumb_meta,
			'img_id'	=> $thumb_id,
			'img_class' => 'preload-me',
			'class'		=> 'alignnone' . $link_classes,
			'href'		=> get_permalink(),
			'options'	=> presscore_set_image_dimesions(),
			'wrap'		=> '<a %HREF% %CLASS% %TITLE% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %SIZE% /></a>'
		);

		$thumb_args = apply_filters( 'dt_portfolio_thumbnail_args', $thumb_args );

		dt_get_thumb_img( $thumb_args );

		// get image rollover icons
		$rollover_icons = '';
		$rollover_icons .= presscore_get_project_rollover_link_icon();
		$rollover_icons .= presscore_get_project_rollover_zoom_icon( array( 'popup' => 'single', 'class' => '', 'attachment_id' => $thumb_id ) );
		$rollover_icons .= presscore_get_project_rollover_details_icon();

		// output rollover
		if ( $rollover_icons ) : ?>

			<div class="rollover-content">
				<div class="wf-table">
					<div class="links-container wf-td ">

						<?php echo $rollover_icons; ?>

					</div>
				</div>
			</div>

		<?php endif; ?>

	</div>

</div>