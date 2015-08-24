<?php
/**
 * Portfolio post content part with rollover
 *
 * @since 1.0.0
 * @package vogue
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = Presscore_Config::get_instance();

// get image rollover icons
$rollover_icons = '';
$rollover_icons .= presscore_get_project_rollover_link_icon();
$rollover_icons .= presscore_get_project_rollover_zoom_icon( array( 'popup' => 'single', 'class' => '', 'attachment_id' => get_post_thumbnail_id() ) );
$rollover_icons .= presscore_get_project_rollover_details_icon();

if ( $rollover_icons ) :

	if ( 1 == presscore_project_preview_buttons_count() ) {
		$rollover_icons = str_replace('class="', 'class="big-link ', $rollover_icons);
	}
	?>

	<div class="links-container">

		<?php echo $rollover_icons; ?>

	</div>

<?php endif; ?>