<?php
/**
 * Microsite template helpers.
 */

if ( ! function_exists( 'presscore_microsite_setup' ) ) :

	function presscore_microsite_setup() {
		global $post;
		$config = presscore_get_config();
		$config->set( 'template.beautiful_loading', get_post_meta( $post->ID, '_dt_microsite_page_loading', true ) );
		$config->set( 'template.layout', get_post_meta( $post->ID, '_dt_microsite_page_layout', true ) );

		// hide template parts
		$hidden_parts = get_post_meta( $post->ID, "_dt_microsite_hidden_parts", false );

		// hide header
		$hide_header = in_array( 'header', $hidden_parts );
		$hide_floating_menu = in_array( 'floating_menu', $hidden_parts );

		if ( $hide_header ) {

			if ( $hide_floating_menu ) {
				add_filter( 'presscore_show_header', '__return_false' );
			} else {
				// see template-hooks.php
				add_filter( 'presscore_header_classes', 'presscore_microsite_header_classes' );
			}

			$config->set( 'header.layout', 'left' );
		}

		// hide bottom bar
		if ( in_array( 'bottom_bar', $hidden_parts ) ) {
			add_filter( 'presscore_show_bottom_bar', '__return_false' );
		}

		// hide content
		if ( in_array( 'content', $hidden_parts ) ) {
			add_filter( 'presscore_is_content_visible', '__return_false' );
		}
	}

endif;
