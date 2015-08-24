<?php
/**
 * Portfolio post content part with rollover
 *
 * @since 1.0.0
 * @package vogue
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<?php dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-rollover-content-part-links' ); ?>

<div class="rollover-content-container">

	<?php
	$config = Presscore_Config::get_instance();

	if ( 'from_bottom' == $config->get( 'post.preview.description.style' ) ) {

		echo '<div class="rollover-content-wrap">';

			dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-rollover-content-part-description' );

		echo '</div>';

	} else {
		dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-rollover-content-part-description' );

	}
	?>

</div>