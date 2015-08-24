<?php
/**
 * Portfolio post content part with rollover
 *
 * @since 1.0.0
 * @package vogue
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$rollover_class = '';
$buttonts_count = presscore_project_preview_buttons_count();

if ( 0 == $buttonts_count ) {
	$rollover_class .= ' forward-post';

} else if ( $buttonts_count < 2 ) {
	$rollover_class .= ' rollover-active';

}

$config = Presscore_Config::get_instance();
?>

<div class="rollover-project<?php echo $rollover_class; ?>">

	<?php dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-rollover-media' ); ?>

	<?php if ( $config->get( 'post.preview.content.visible' ) ) : ?>

		<div class="rollover-content">

			<?php
			if ( 'on_hoover_centered' == $config->get( 'post.preview.description.style' ) ) {

				echo '<div class="wf-table"><div class="wf-td">';

					dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-rollover-content' );

				echo '</div></div>';

			} else {
				dt_get_template_part( 'portfolio/masonry/portfolio-masonry-post-rollover-content' );

			}
			?>

		</div>

	<?php endif; ?>

</div>