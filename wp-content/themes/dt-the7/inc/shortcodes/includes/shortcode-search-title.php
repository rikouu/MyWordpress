<?php
/**
 * Search title shortcode
 */

if ( ! function_exists( 'presscore_search_title_shortcode' ) ) :

	function presscore_search_title_shortcode() {

		$title = '';
		$wrap_class = '';

		if ( is_search() ) {
			$title = get_search_query();

		} else if ( is_archive() ) {

			if ( is_category() ) {
				$title = single_cat_title( '', false );

			} elseif ( is_tag() ) {
				$title = single_tag_title( '', false );

			} elseif ( is_author() ) {
				the_post();
				$title = '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>';
				$wrap_class .= ' vcard';
				rewind_posts();

			} elseif ( is_day() ) {
				$title = '<span>' . get_the_date() . '</span>';

			} elseif ( is_month() ) {
				$title = '<span>' . get_the_date( 'F Y' );

			} elseif ( is_year() ) {
				$title = '<span>' . get_the_date( 'Y' );

			} elseif ( is_tax('dt_portfolio_category') ) {
				$title = single_term_title( '', false );

			} elseif ( is_tax('dt_gallery_category') ) {
				$title = single_term_title( '', false );

			}

		}

		if ( $title ) {
			$title = '<span' . ( $wrap_class ? ' class="' . esc_attr( $wrap_class ) . '"' : '' ) . '>' . $title . '</span>';
		}

		return $title;
	}
	add_shortcode( 'dt_archive_title', 'presscore_search_title_shortcode' );

endif;
