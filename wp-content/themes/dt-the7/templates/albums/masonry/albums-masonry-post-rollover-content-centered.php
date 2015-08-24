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
?>

<div class="wf-table">
	<div class="wf-td">

		<?php dt_get_template_part( 'albums/masonry/albums-masonry-post-rollover-content' ); ?>

	</div>
</div>