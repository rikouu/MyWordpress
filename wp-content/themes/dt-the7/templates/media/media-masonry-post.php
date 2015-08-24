<?php
/**
 * Media post content part
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

do_action('presscore_before_post'); ?>

<article <?php post_class( 'post' ); ?>>

	<?php
	$config = Presscore_Config::get_instance();

	// description under post
	if ( 'under_image' == $config->get( 'post.preview.description.style' ) ) {

		// media
		dt_get_template_part( 'media/media-masonry-post-image' );

		// content
		dt_get_template_part( 'media/media-masonry-post-content' );

	// rollover
	} else {
		dt_get_template_part( 'media/media-masonry-post-rollover' );

	}
	?>

</article>

<?php do_action('presscore_after_post'); ?>