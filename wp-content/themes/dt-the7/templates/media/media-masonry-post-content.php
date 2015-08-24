<?php
/**
 * Media post content
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>

<div class="project-list-content">

<?php
dt_get_template_part( 'media/media-masonry-post-rollover-content-part-description' );

echo presscore_post_edit_link();
?>

</div>