<?php
/**
 * Portfolio media content
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

	<div class="project-list-media" <?php echo presscore_get_post_content_style_for_blog_list( 'media' ); ?>>

		<?php
		$thumb_id = get_post_thumbnail_id();

		$thumb_args = array(
			'img_meta' 	=> wp_get_attachment_image_src( $thumb_id, 'full' ),
			'img_id'	=> $thumb_id,
			'img_class' => 'preload-me',
			'class'		=> '',
			'href'		=> get_permalink(),
			'wrap'		=> '<a %CLASS% %HREF% %TITLE% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %SIZE% /></a>'
		);

		if ( get_post_meta( $thumb_id, 'dt-video-url', true ) ) {
			$thumb_args['class'] .= ' rollover-video';

		} else {
			$thumb_args['class'] .= ' rollover';

		}

		$config = Presscore_Config::get_instance();
		if ( 'normal' == $config->get( 'post.preview.width' ) ) {
			$thumb_args['class'] .= ' alignleft';

		} else {
			$thumb_args['class'] .= ' alignnone';

		}

		$thumb_args = apply_filters( 'dt_portfolio_thumbnail_args', $thumb_args );

		echo '<div class="buttons-on-img">';

		// output media
		dt_get_thumb_img( $thumb_args );

		// get image rollover icons
		$rollover_icons = '';
		$rollover_icons .= presscore_get_project_rollover_link_icon();
		$rollover_icons .= presscore_get_project_rollover_zoom_icon( array( 'popup' => 'single', 'class' => '', 'attachment_id' => $thumb_id ) );
		$rollover_icons .= presscore_get_project_rollover_details_icon();

		// output rollover
		if ( $rollover_icons ) {

			echo '<div class="rollover-content"><div class="wf-table"><div class="links-container wf-td ">';

			echo $rollover_icons;

			echo '</div></div></div>';

		}

		echo '</div>';
		?>

	</div>
