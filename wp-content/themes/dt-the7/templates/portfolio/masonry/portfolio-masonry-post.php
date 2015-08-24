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
	$config = Presscore_Config::get_instance();

	if ( 'under_image' == $config->get( 'post.preview.description.style' ) ) {

		// media
		switch ( $config->get( 'post.preview.media.style' ) ) {
			case 'featured_image':
				dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-media-content-image' );
				break;

			case 'slideshow':
				dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-media-content-slider' );
				break;
		}

		// content
		dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-content' );

	} else {

		// project with rollover
		dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-rollover' );

	}
	?>

</article>

<?php do_action('presscore_after_post'); ?>