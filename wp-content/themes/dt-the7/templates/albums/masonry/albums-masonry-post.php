<?php
/**
 * Portfolio post content part with rollover
 *
 * @since 1.0.0
 * @package vogue
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php do_action('presscore_before_post'); ?>

<article <?php post_class('post'); ?>>

	<?php
	if ( 'under_image' == presscore_get_config()->get( 'post.preview.description.style' ) ) {

		// media
		dt_get_template_part( 'albums/masonry/albums-masonry-post-media-content-image' );

		// content
		dt_get_template_part( 'albums/masonry/albums-masonry-post-content' );

	} else {

		// project with rollover
		dt_get_template_part( 'albums/masonry/albums-masonry-post-rollover' );

	}
	?>

</article>

<?php do_action('presscore_after_post'); ?>