<?php
/**
 * Portfolio post content
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div class="project-list-content">

<?php
dt_get_template_part( 'albums/masonry/albums-masonry-post-rollover-content-part-description' );

echo presscore_post_edit_link();
?>

</div>