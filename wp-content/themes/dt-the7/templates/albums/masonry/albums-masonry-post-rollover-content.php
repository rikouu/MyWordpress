<?php
/**
 * Portfolio post content part with rollover
 *
 * @since 1.0.0
 * @package vogue
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php
$config = Presscore_Config::get_instance();

if ( $config->get( 'post.preview.mini_images.enabled' ) ) {
	dt_get_template_part( 'albums/masonry/albums-masonry-post-rollover-mini-images' );
}
?>

<div class="rollover-content-container">

	<?php
	if ( 'from_bottom' == $config->get( 'post.preview.description.style' ) ) {
		dt_get_template_part( 'albums/masonry/albums-masonry-post-rollover-content-part-description-from-bottom' );

	} else {
		dt_get_template_part( 'albums/masonry/albums-masonry-post-rollover-content-part-description' );

	}
	?>

</div>