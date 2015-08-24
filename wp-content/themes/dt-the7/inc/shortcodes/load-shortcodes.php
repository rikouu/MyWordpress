<?php
/**
 * Shortcodes setup.
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$current_dir = dirname( __FILE__ );

require_once trailingslashit( $current_dir ) . 'includes/class-register-button-wp-3.9.php';
require_once trailingslashit( PRESSCORE_SHORTCODES_INCLUDES_DIR ) . 'class-shortcode.php';
require_once trailingslashit( $current_dir ) . 'includes/puny-shortcodes-functions.php';
require_once trailingslashit( $current_dir ) . 'includes/shortcodes-animation-functions.php';

$tinymce_button = new DT_ADD_MCE_BUTTON('', '');

// List of shortcodes folders to include
// All folders located in /include
$presscore_shortcodes = array(
	'before-after',
	'columns',
	'box',
	'gap',
	'divider',
	'stripes',
	'fancy-image',
	'list',
	'button',
	'tooltips',
	'highlight',
	'code',
	'tabs',
	'accordion',
	'toggles',
	'quote',
	'call-to-action',
	'shortcode-teasers',
	'banner',
	'benefits',
	'progress-bars',
	'contact-form',
	'social-icons',
	'map',
	'blog-posts-small',
	'blog-posts',
	'blog-slider',
	'albums',
	'albums-jgrid',
	'albums-slider',
	'portfolio',
	'portfolio-jgrid',
	'portfolio-slider',
	// 'small-photos',
	'photos-masonry',
	'photos-jgrid',
	'photos-slider',
	'slideshow',
	'team',
	'testimonials',
	'logos',
	'gallery',
	'animated-text',
	'list-vc',
	'benefits-vc',
	'fancy-video-vc',
	'fancy-titles-vc',
	'fancy-separators-vc',
	'simple-login'
);
$presscore_shortcodes = apply_filters( 'presscore_shortcodes', $presscore_shortcodes );

foreach ( $presscore_shortcodes as $shortcode_dirname ) {
	include_once locate_template( 'inc/shortcodes/includes/' . $shortcode_dirname . '/' . $shortcode_dirname . '.php' );
}
