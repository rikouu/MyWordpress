<?php
/**
 * Load Meta boxes
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

////////////////////
// Meta-Box class //
////////////////////

require_once PRESSCORE_EXTENSIONS_DIR . '/meta-box.php';

//////////////////////
// Theme Meta Boxes //
//////////////////////

function presscore_load_meta_boxes() {

	$metaboxes = array(
		'metaboxes',
		'metaboxes-blog',
		'metaboxes-portfolio',
		'metaboxes-testimonials',
		'metaboxes-team',
		'metaboxes-logos',
		'metaboxes-albums',
		'metaboxes-slideshow',
		'metaboxes-benefits',
		'metaboxes-microsite'
	);

	foreach ( $metaboxes as $metabox ) {
		include_once locate_template( "inc/admin/meta-boxes/{$metabox}.php" );
	}

}
add_action( 'admin_init', 'presscore_load_meta_boxes', 20 );
