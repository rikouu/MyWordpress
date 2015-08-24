<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$hide_top_bar = '';
if ( 	!(
			presscore_get_header_elements_list('top') 
			|| presscore_get_header_elements_list('top_bar_left') 
			|| presscore_get_header_elements_list('top_bar_right')
		)
	)
{
	$hide_top_bar = 'top-bar-empty';
}
?>
		<!-- !Top-bar -->
		<div id="top-bar" role="complementary" <?php presscore_top_bar_class($hide_top_bar); ?>>
			<div class="wf-wrap">
				<div class="wf-container-top">
					<div class="wf-table wf-mobile-collapsed">

						<?php presscore_render_header_elements('top'); ?>

						<?php presscore_render_header_elements('top_bar_left'); ?>

						<?php presscore_render_header_elements('top_bar_right'); ?>

					</div><!-- .wf-table -->
				</div><!-- .wf-container-top -->
			</div><!-- .wf-wrap -->
		</div><!-- #top-bar -->