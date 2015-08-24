<?php
/**
 * Portfolio helpers
 *
 * @since 1.0.0
 * @package vogue
 */

if ( ! function_exists( 'presscore_display_related_projects' ) ) :

	/**
	 * Display related projects.
	 *
	 */
	function presscore_display_related_projects() {

		global $post;
		$html = '';

		$config = presscore_get_config();

		// if related projects turn on in theme options
		if ( $config->get( 'post.related_posts.enabled' ) ) {

			$terms = array();
			switch ( $config->get( 'post.related_posts.query.mode' ) ) {
				case 'custom': $terms = $config->get( 'post.related_posts.query.terms' ); break;
				default: $terms = wp_get_object_terms( $post->ID, 'dt_portfolio_category', array('fields' => 'ids') );
			}

			if ( $terms && !is_wp_error( $terms ) ) {

				$options = array(
					'cats' => $terms,
					'select' => 'only',
					'post_type' => 'dt_portfolio',
					'taxonomy' => 'dt_portfolio_category',
					'args' => array(
						'posts_per_page' => intval( $config->get( 'post.related_posts.query.posts_per_page' ) ),
						'post__not_in' => array( get_the_ID() )
					)
				);

				$posts = presscore_get_posts_in_categories( $options );

				$portfolio_scroller = new Presscore_Portfolio_Posts_Scroller();
				$portfolio_scroller->setup( $posts, array(
					'class' => 'related-projects slider-wrapper',
					'width' => $config->get( 'post.related_posts.width' ),
					'height' => $config->get( 'post.related_posts.height' ),
					'show_title' => $config->get( 'post.related_posts.show.title' ),
					'show_excerpt' => $config->get( 'post.related_posts.show.description' ),
					'appearance' => 'under_image',
					'padding' => 20,
					'bg_under_projects' => false,
					'content_aligment' => 'center',
					'hover_animation' => 'fade',
					'hover_bg_color' => 'accent',
					'hover_content_visibility' => 'on_hoover',
					'show_link' => $config->get( 'post.related_posts.show.link' ),
					'show_details' => $config->get( 'post.related_posts.show.details_link' ),
					'show_zoom' => $config->get( 'post.related_posts.show.zoom' ),
					'show_date' => $config->get( 'post.related_posts.meta.fields.date' ),
					'show_categories' => $config->get( 'post.related_posts.meta.fields.categories' ),
					'show_comments' => $config->get( 'post.related_posts.meta.fields.comments' ),
					'show_author' => $config->get( 'post.related_posts.meta.fields.author' ),
					'arrows' => 'accent'
				) );

				$html .= $portfolio_scroller->get_html();

				if ( $html ) {

					$html = '<div class="full-width-wrap">' . $html . '</div>';

					// fancy separator
					$html = presscore_fancy_separator( array( 'title' => $config->get( 'post.related_posts.title' ), 'class' => 'fancy-projects-title' ) ) . $html;

					if ( ! ( post_password_required() || ( !comments_open() && 0 == get_comments_number() ) ) ) {

						// add gap after projects
						$html .= do_shortcode( '[dt_gap height="40"]' );

					}
				}

			}
		}

		echo (string) apply_filters('presscore_display_related_projects', $html);
	}

endif;

if ( ! function_exists( 'presscore_get_project_link' ) ) :

	/**
	 * Get project link.
	 *
	 * return string HTML.
	 */
	function presscore_get_project_link( $class = 'link dt-btn' ) {
		if ( post_password_required() || !in_the_loop() ) {
			return '';
		}

		$config = presscore_get_config();

		// project link html
		$project_link = '';
		if ( $config->get( 'post.buttons.link.enabled' ) ) {

			$title = $config->get( 'post.buttons.link.title' );
			if ( ! $title ) {
				$class .= ' no-text';
			}

			$project_link = presscore_get_button_html( array(
				'title'		=> $title ? $title : __( 'Link', LANGUAGE_ZONE ),
				'href'		=> $config->get( 'post.buttons.link.url' ),
				'target'	=> $config->get( 'post.buttons.link.target_blank' ),
				'class'		=> $class,
			) );
		}

		return $project_link;
	}

endif; // presscore_get_project_link

if ( ! function_exists( 'presscore_get_project_media_slider' ) ) :

	/**
	 * Portfolio media slider.
	 *
	 * Based on royal slider. Properly works only in the loop.
	 *
	 * @return string HTML.
	 */
	function presscore_get_project_media_slider( $class = array() ) {
		global $post;

		// slideshow dimensions
		$slider_proportions = get_post_meta( $post->ID, '_dt_project_options_slider_proportions',  true );
		$slider_proportions = wp_parse_args( $slider_proportions, array( 'width' => '', 'height' => '' ) );

		$width = $slider_proportions['width'];
		$height = $slider_proportions['height'];

		// get slideshow
		$media_items = get_post_meta( $post->ID, '_dt_project_media_items', true );
		$slideshow = '';

		if ( !$media_items ) $media_items = array();

		// if we have post thumbnail and it's not hidden
		if ( has_post_thumbnail() ) {
			if ( is_single() ) {
				if ( !get_post_meta( $post->ID, '_dt_project_options_hide_thumbnail', true ) ) {
					array_unshift( $media_items, get_post_thumbnail_id() );
				}
			} else {
				array_unshift( $media_items, get_post_thumbnail_id() );
			}
		}

		$attachments_data = presscore_get_attachment_post_data( $media_items );

		// TODO: make it clean and simple
		if ( count( $attachments_data ) > 1 ) {

			$slideshow = presscore_get_royal_slider( $attachments_data, array(
				'width'		=> $width,
				'height'	=> $height,
				'class' 	=> $class,
				'style'		=> ' style="width: 100%"',
			) );
		} elseif ( !empty($attachments_data) ) {

			$image = current($attachments_data);

			$thumb_id = $image['ID'];
			$thumb_meta = array( $image['full'], $image['width'], $image['height'] );
			$video_url = esc_url( get_post_meta( $thumb_id, 'dt-video-url', true ) );

			$thumb_args = array(
				'img_meta' 	=> $thumb_meta,
				'img_id'	=> $thumb_id,
				'img_class' => 'preload-me',
				'class'		=> 'alignnone rollover',
				'href'		=> get_permalink( $post->ID ),
				'wrap'		=> '<a %CLASS% %HREF% %TITLE% %CUSTOM%><img %IMG_CLASS% %SRC% %ALT% %SIZE% /></a>',
				'echo'		=> false,
			);

			if ( $video_url ) {
				$thumb_args['class'] = 'alignnone rollover-video';
			}

			$thumb_args = apply_filters( 'dt_portfolio_thumbnail_args', $thumb_args );

			$slideshow = dt_get_thumb_img( $thumb_args );
		}

		return $slideshow;
	}

endif; // presscore_get_project_media_slider

if ( ! function_exists( 'presscore_get_project_rollover_link_icon' ) ) :

	function presscore_get_project_rollover_link_icon() {
		$config = presscore_get_config();
		$rollover_icon = '';

		if ( $config->get( 'show_links' ) ) {

			$project_link = presscore_get_project_link( 'project-link' );
			if ( $project_link ) {
				$rollover_icon = $project_link;
			}

		}

		return $rollover_icon;
	}

endif;

if ( ! function_exists( 'presscore_get_project_rollover_details_icon' ) ) :

	function presscore_get_project_rollover_details_icon() {
		$config = presscore_get_config();
		$rollover_icon = '';

		if ( $config->get( 'show_details' ) ) {
			$rollover_icon = '<a href="' . get_permalink() . '" class="project-details">' . __( 'Details', LANGUAGE_ZONE ) . '</a>';
		}

		return $rollover_icon;
	}

endif;

if ( ! function_exists( 'presscore_get_project_rollover_zoom_icon' ) ) :

	function presscore_get_project_rollover_zoom_icon( $args = array() ) {

		$default_args = array(

			// can be 'single', 'gallery' or 'first'
			'popup' => 'single',

			'class' => '',
			'attachment_id' => 0
		);
		$args = wp_parse_args( $args, $default_args );

		$config = presscore_get_config();
		$rollover_icon = '';

		if ( $config->get( 'show_zoom' ) && $args['attachment_id'] ) {

			$attachment_id = absint( $args['attachment_id'] );

			if ( !presscore_imagee_title_is_hidden( $attachment_id ) ) {
				$attachment_title = get_post_field( 'post_title', $attachment_id );

			} else {
				$attachment_title = '';

			}

			$link_class = array( 'project-zoom', 'dt-mfp-item' );

			if ( $args['class'] ) {
				$link_class[] = $args['class'];
			}

			switch( $args['popup'] ) {
				case 'single':
					$link_class[] = 'dt-single-mfp-popup';
					break;

				case 'gallery':
					$link_class[] = 'dt-gallery-mfp-popup';
					break;

				case 'first':
					$link_class[] = 'dt-first-mfp-popup';
					break;
			}

			$attachment_video_src = get_post_meta( $attachment_id, 'dt-video-url', true );
			if ( $attachment_video_src ) {
				$link_class[] = 'mfp-iframe';
				$link_src = $attachment_video_src;

			} else {
				$attachment_src = wp_get_attachment_image_src( $attachment_id, 'full' );

				$link_class[] = 'mfp-image';
				$link_src = $attachment_src[0];

			}

			$attachment_description = get_post_field( 'post_content', $attachment_id );

			$rollover_icon = sprintf(
				'<a href="%s" class="%s" title="%s" data-dt-img-description="%s">%s</a>',
				esc_url( $link_src ),
				esc_attr( implode( ' ', $link_class ) ),
				esc_attr( $attachment_title ),
				esc_attr( $attachment_description ),
				__('Zoom', LANGUAGE_ZONE)
			);

		}

		return $rollover_icon;
	}

endif;

if ( ! function_exists( 'presscore_project_preview_buttons_count' ) ) :

	/**
	 * Description here
	 *
	 * @since 1.0.0
	 * @return int Project rollover buttons count
	 */
	function presscore_project_preview_buttons_count() {

		$buttons_count = 0;

		if ( !post_password_required() ) {
			$config = presscore_get_config();

			// details button
			if ( $config->get( 'show_details' ) ) {
				$buttons_count++;
			}

			// zoom button
			if ( $config->get( 'show_zoom' ) ) {
				$buttons_count++;
			}

			// link button
			if ( $config->get( 'show_links' ) && $config->get( 'post.buttons.link.enabled' ) && in_the_loop() ) {
				$buttons_count++;
			}
		}

		return $buttons_count;
	}

endif;
