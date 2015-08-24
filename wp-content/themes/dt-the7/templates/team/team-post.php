<?php
/**
 * Team post
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

do_action('presscore_before_post'); ?>

	<div <?php post_class( 'team-container' ); ?>>

		<?php dt_get_template_part( 'team/team-post-media' ); ?>

		<div class="team-desc">

			<?php dt_get_template_part( 'team/team-post-content' ); ?>

		</div>
	</div>

<?php do_action('presscore_after_post'); ?>