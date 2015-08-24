<?php
/**
 * Page title helpers
 * 
 * @package vogue
 * @since 1.0.0
 */

if ( ! function_exists( 'presscore_get_page_title' ) ) :

	function presscore_get_page_title() {
		$title = '';

		if ( is_page() || is_single() ) {
			$title = get_the_title();

		} else if ( is_search() ) {
			$title = sprintf( _x( 'Search Results for: %s', 'archive template title', LANGUAGE_ZONE ), '<span>' . get_search_query() . '</span>' );

		} else if ( is_archive() ) {

			if ( is_category() ) {
				$title = sprintf( _x( 'Category Archives: %s', 'archive template title', LANGUAGE_ZONE ), '<span>' . single_cat_title( '', false ) . '</span>' );

			} elseif ( is_tag() ) {
				$title = sprintf( _x( 'Tag Archives: %s', 'archive template title', LANGUAGE_ZONE ), '<span>' . single_tag_title( '', false ) . '</span>' );

			} elseif ( is_author() ) {
				the_post();
				$title = sprintf( _x( 'Author Archives: %s', 'archive template title', LANGUAGE_ZONE ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
				rewind_posts();

			} elseif ( is_day() ) {
				$title = sprintf( _x( 'Daily Archives: %s', 'archive template title', LANGUAGE_ZONE ), '<span>' . get_the_date() . '</span>' );

			} elseif ( is_month() ) {
				$title = sprintf( _x( 'Monthly Archives: %s', 'archive template title', LANGUAGE_ZONE ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

			} elseif ( is_year() ) {
				$title = sprintf( _x( 'Yearly Archives: %s', 'archive template title', LANGUAGE_ZONE ), '<span>' . get_the_date( 'Y' ) . '</span>' );

			} elseif ( is_tax('dt_portfolio_category') ) {
				$title = sprintf( _x( 'Portfolio Archives: %s', 'archive template title', LANGUAGE_ZONE ), '<span>' . single_term_title( '', false ) . '</span>' );

			} elseif ( is_tax('dt_gallery_category') ) {
				$title = sprintf( _x( 'Albums Archives: %s', 'archive template title', LANGUAGE_ZONE ), '<span>' . single_term_title( '', false ) . '</span>' );

			} else {
				$title = _x( 'Archives:', 'archive template title', LANGUAGE_ZONE );

			}

		} elseif ( is_404() ) {
			$title = _x( 'Page not found', 'index title', LANGUAGE_ZONE );

		} else {
			$title = _x( 'Blog', 'index title', LANGUAGE_ZONE );

		}

		return apply_filters( 'presscore_get_page_title', $title );
	}

endif;

if ( ! function_exists( 'presscore_get_page_title_html_class' ) ) :

	function presscore_get_page_title_html_class( $class = array() ) {
		$config = Presscore_Config::get_instance();
		$output = array( presscore_get_font_size_class( $config->get( 'page_title.font.size' ) ) );

		if ( is_single() ) {
			$output[] = 'entry-title';
		}

		//////////////
		// Output //
		//////////////

		if ( $class && ! is_array( $class ) ) {
			$class = explode( ' ', $class );
		}

		$output = apply_filters( 'presscore_get_page_title_html_class', array_merge( $class, $output ) );

		return $output ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $output ) ) ) : '';
	}

endif;

if ( ! function_exists( 'presscore_get_page_title_wrap_html_class' ) ) :

	function presscore_get_page_title_wrap_html_class( $class = array() ) {
		$config = Presscore_Config::get_instance();
		$output = array();

		switch( $config->get( 'page_title.align' ) ) {
			case 'right' :
				$output[] = 'title-right';
				break;
			case 'left' :
				$output[] = 'title-left';
				break;
			case 'all_right' :
				$output[] = 'content-right';
				break;
			case 'all_left' :
				$output[] = 'content-left';
				break;
			default:
				$output[] = 'title-center';
		}

		$title_bg_mode_class = presscore_get_page_title_bg_mode_html_class();
		if ( $title_bg_mode_class ) {
			$output[] = $title_bg_mode_class;
		}

		if ( ! $config->get( 'page_title.breadcrumbs.enabled' ) ) {
			$output[] = 'breadcrumbs-off';
		}

		if ( $config->get( 'page_title.background.parallax_speed' ) ) {
			$output[] = 'page-title-parallax-bg';
		}

		//////////////
		// Output //
		//////////////

		if ( $class && ! is_array( $class ) ) {
			$class = explode( ' ', $class );
		}

		$output = apply_filters( 'presscore_get_page_title_wrap_html_class', array_merge( $class, $output ) );

		return $output ? sprintf( 'class="%s"', presscore_esc_implode( ' ', array_unique( $output ) ) ) : '';
	}

endif;

if ( ! function_exists( 'presscore_get_page_title_breadcrumbs' ) ) :

	function presscore_get_page_title_breadcrumbs( $args = array() ) {
		$config = Presscore_Config::get_instance();
		$breadcrumbs_class = 'breadcrumbs text-normal';

		switch ( $config->get( 'page_title.breadcrumbs.background.mode' ) ) {
			case 'black':
				$breadcrumbs_class .= ' bg-dark breadcrumbs-bg';
				break;
			case 'white':
				$breadcrumbs_class .= ' bg-light breadcrumbs-bg';
				break;
		}

		$default_args = array(
			'beforeBreadcrumbs' => '<div class="wf-td">',
			'afterBreadcrumbs' => '</div>',
			'listAttr' => ' class="' . $breadcrumbs_class . '"'
		);

		$args = wp_parse_args( $args, $default_args );

		return presscore_get_breadcrumbs( $args );
	}

endif;

if ( ! function_exists( 'presscore_get_page_title_bg_mode_html_class' ) ) :

	/**
	 * Returns class based on title_bg_mode value
	 *
	 * @since 1.0.0
	 * @return string class
	 */
	function presscore_get_page_title_bg_mode_html_class() {
		$config = Presscore_Config::get_instance();

		switch ( $config->get( 'page_title.background.mode' ) ) {
			case 'background':
				$class = 'solid-bg';
				break;
			case 'fullwidth_line':
				$class = 'full-width-line';
				break;
			case 'transparent_bg':
				$class = 'transparent-bg';
				break;
			case 'disabled':
				$class = 'disabled-bg';
				break;
			default:
				$class = '';
		}

		return $class;
	}


endif;
