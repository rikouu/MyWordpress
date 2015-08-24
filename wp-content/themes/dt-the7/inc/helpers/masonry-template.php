<?php
/**
 * Masonry templates helpers
 *
 * @package vogue
 * @since 1.0.0
 */

if ( ! function_exists( 'presscore_masonry_container_data_atts' ) ) :

	/**
	 * [presscore_masonry_container_data_atts description]
	 *
	 * @since 1.0.0
	 * 
	 * @return satring [description]
	 */
	function presscore_masonry_container_data_atts() {

		$config = Presscore_Config::get_instance();

		$data_atts = array(
			'data-padding="' . intval( $config->get( 'item_padding' ) ) . 'px"',
			'data-cur-page="' . dt_get_paged_var() . '"'
		);

		if ( $config->get( 'hide_last_row' ) ) {
			$data_atts[] = 'data-part-row="false"';
		}

		$target_height = $config->get( 'target_height' );
		if ( null !== $target_height ) {
			$data_atts[] = 'data-target-height="' . absint( $target_height ) . 'px"';
		}

		$target_width = $config->get( 'post.preview.width.min' );
		if ( null !== $target_width ) {
			$data_atts[] = 'data-width="' . absint( $target_width ) . 'px"';
		}

		$columns = $config->get( 'template.columns.number' );
		if ( null !== $columns ) {
			$data_atts[] = 'data-columns="' . absint( $columns ) . '"';
		}

		return ' ' . implode( ' ', $data_atts );
	}

endif;

if ( ! function_exists( 'presscore_masonry_container_class' ) ) :

	/**
	 * @since 1.0.0
	 * 
	 * @param  array  $class
	 * @return string
	 */
	function presscore_masonry_container_class( $custom_class = array() ) {

		$config = Presscore_Config::get_instance();

		$html_class = array();

		//////////////////////
		// Common classes //
		//////////////////////

		// ajax class
		if ( !in_array( $config->get( 'load_style' ), array( 'default', false ) ) ) {
			$html_class[] = 'with-ajax';
		}

		// loading effect
		$html_class[] = presscore_template_loading_effect_html_class( $config->get( 'post.preview.load.effect' ) );

		// lazy loading
		if ( 'lazy_loading' == $config->get( 'load_style' ) ) {
			$html_class[] = 'lazy-loading-mode';
		}

		// description style
		$description_style = $config->get( 'post.preview.description.style' );
		if ( 'under_image' == $description_style ) {
			$html_class[] = 'description-under-image';
		} else if ( 'disabled' != $description_style ) {
			$html_class[] = 'description-on-hover';
		}

		// layout
		switch ( $config->get( 'layout' ) ) {
			case 'grid': $html_class[] = 'iso-grid'; break;
			case 'masonry': $html_class[] = 'iso-container'; break;
		}

		if ( $config->get( 'justified_grid' ) ) {
			$html_class[] = 'jg-container';
		}

		// post preview background
		if ( $config->get( 'post.preview.background.enabled' ) ) {
			$html_class[] = 'bg-under-post';
		}

		// hover classes
		switch ( $config->get( 'post.preview.description.style' ) ) {

			case 'on_hoover_centered':
				$html_class[] = 'hover-style-two';
				$html_class[] = presscore_hover_animation_class();

				if ( 'dark' == $config->get( 'post.preview.hover.color' ) ) {
					$html_class[] = 'hover-color-static';
				}
				break;

			case 'under_image':

				if ( 'dark' == $config->get( 'post.preview.hover.color' ) ) {
					$html_class[] = 'hover-color-static';
				}
				break;

			case 'on_dark_gradient':
				$html_class[] = 'hover-style-one';

				if ( 'always' == $config->get( 'post.preview.hover.content.visibility' ) ) {
					$html_class[] = 'always-show-info';
				}
				break;

			case 'from_bottom':
				$html_class[] = 'hover-style-three';
				$html_class[] = 'cs-style-3';

				if ( 'always' == $config->get( 'post.preview.hover.content.visibility' ) ) {
					$html_class[] = 'always-show-info';
				}
				break;
		}

		// round images
		if ( 'round' == $config->get( 'image_layout' ) ) {
			$html_class[] = 'round-images';
		}

		//////////////
		// Output //
		//////////////

		if ( $custom_class && ! is_array( $custom_class ) ) {
			$custom_class = explode( ' ', $custom_class );
		}

		$html_class = apply_filters( 'presscore_masonry_container_class', array_merge( $custom_class, $html_class ) );

		return $html_class ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $html_class ) ) ) : '';
	}

endif;

if ( ! function_exists( 'presscore_hover_animation_class' ) ) :

	/**
	 * [presscore_hover_animation_class description]
	 *
	 * @since 1.0.0
	 * 
	 * @return string [description]
	 */
	function presscore_hover_animation_class() {

		$config = Presscore_Config::get_instance();

		switch ( $config->get( 'post.preview.hover.animation' ) ) {

			case 'fade': $class = 'hover-fade'; break;

			case 'move_to': $class = 'cs-style-1'; break;

			case 'direction_aware': $class = 'hover-grid'; break;

			case 'move_from_bottom': $class = 'hover-grid-3D'; break;

			default: $class = 'hover-fade';

		}

		return $class;
	}

endif;

if ( ! function_exists( 'presscore_template_loading_effect_html_class' ) ) :

	/**
	 * Returns sanitized loading effect class based on value of 'post.preview.load.effect' setting
	 *
	 * @since 1.0.0
	 * @return string Sanitized html class
	 */
	function presscore_template_loading_effect_html_class( $loading_effect ) {
		return 'loading-effect-' . sanitize_html_class( str_replace( '_', '-', $loading_effect ), 'fade-in' );
	}

endif;
