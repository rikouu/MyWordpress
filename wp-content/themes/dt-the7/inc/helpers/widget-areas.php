<?php
/**
 * Widgetareas helpers
 *
 * @package vogue
 * @since 1.0.0
 */

if ( ! function_exists( 'presscore_sidebar_html_class' ) ) :

	/**
	 * Sidebar html classes
	 * 
	 * @param  array  $class Custom html class
	 * @return string        Html class attribute
	 */
	function presscore_sidebar_html_class( $class = array() ) {

		$output = array( 'sidebar' );

		$config = presscore_get_config();
		switch ( $config->get( 'sidebar.style' ) ) {
			case 'with_bg':
				$output[] = 'solid-bg';
				break;
			case 'with_widgets_bg':
				$output[] = 'bg-under-widget';
				break;
		}

		//////////////
		// Output //
		//////////////

		if ( $class && ! is_array( $class ) ) {
			$class = explode( ' ', $class );
		}

		$output = apply_filters( 'presscore_sidebar_html_class', array_merge( $class, $output ) );

		return $output ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $output ) ) ) : '';
	}

endif;

if ( ! function_exists( 'presscore_footer_html_class' ) ) :

	function presscore_footer_html_class( $class = array() ) {

		$output = array( 'footer' );

		$config = Presscore_Config::get_instance();

		switch( $config->get( 'template.footer.style' ) ) {
			case 'full_width_line' :
				$output[] = 'full-width-line';
				break;
			case 'solid_background' :
				$output[] = 'solid-bg';
				break;
			case 'transparent_bg_line':
				$output[] = 'transparent-bg';
				break;
			// default - content_width_line
		}

		//////////////
		// Output //
		//////////////

		if ( $class && ! is_array( $class ) ) {
			$class = explode( ' ', $class );
		}

		$output = apply_filters( 'presscore_footer_html_class', array_merge( $class, $output ) );

		return $output ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $output ) ) ) : '';

	}

endif;

if ( ! function_exists( 'presscore_get_sidebar_layout_parser' ) ) :

	function presscore_get_sidebar_layout_parser( $sidebar_layout ) {
		return new Presscore_Sidebar_Layout_Parser( $sidebar_layout );
	}

endif;
