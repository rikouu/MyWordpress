<?php

if ( ! function_exists( 'presscore_list_container_html_class' ) ) :

	/**
	 * @since 1.0.0
	 * 
	 * @param  array  $class
	 * @return string
	 */
	function presscore_list_container_html_class( $custom_class = array() ) {
		$config = presscore_get_config();

		$html_class = array();

		if ( 'dark' == $config->get( 'post.preview.hover.color' ) ) {
			$html_class[] = 'hover-color-static';
		}

		$html_class[] = presscore_template_loading_effect_html_class( $config->get( 'post.preview.load.effect' ) );

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