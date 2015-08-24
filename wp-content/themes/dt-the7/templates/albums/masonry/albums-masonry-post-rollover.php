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

<div class="rollover-project links-hovers-disabled">

	<?php dt_get_template_part( 'albums/masonry/albums-masonry-post-rollover-media' ); ?>

	<?php if ( $config->get( 'post.preview.content.visible' ) ) : ?>

		<div class="rollover-content">

			<?php
			if ( 'on_hoover_centered' == $config->get( 'post.preview.description.style' ) ) {
				dt_get_template_part( 'albums/masonry/albums-masonry-post-rollover-content-centered' );

			} else {
				dt_get_template_part( 'albums/masonry/albums-masonry-post-rollover-content' );

			}
			?>

		</div>

	<?php endif; ?>

</div>