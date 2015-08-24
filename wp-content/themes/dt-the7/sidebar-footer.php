<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package vogue
 * @since 1.0.0
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$config = presscore_get_config();

$footer_sidebar = $config->get( 'footer_widgetarea_id' ); 

if ( ! $footer_sidebar) {
	$footer_sidebar = apply_filters( 'presscore_default_footer_sidebar', 'sidebar_2' );
}

$show_sidebar = $config->get( 'footer_show' ) && is_active_sidebar( $footer_sidebar );
$show_bottom_bar = apply_filters( 'presscore_show_bottom_bar', true );

if ( $show_sidebar || $show_bottom_bar ) : ?>

	<!-- !Footer -->
	<footer id="footer" <?php echo presscore_footer_html_class(); ?>>

		<?php

		if ( $show_sidebar ) :

			// footer layout
			$sidebar_layout = presscore_get_sidebar_layout_parser( $config->get( 'template.footer.layout' ) );
			$sidebar_layout->add_sidebar_columns();
		?>

			<div class="wf-wrap">
				<div class="wf-container-footer">
					<div class="wf-container">

						<?php
						do_action( 'presscore_before_footer_widgets' );

						dynamic_sidebar( $footer_sidebar );
						?>

					</div><!-- .wf-container -->
				</div><!-- .wf-container-footer -->
			</div><!-- .wf-wrap -->

		<?php
			$sidebar_layout->remove_sidebar_columns();

		endif;

		if ( $show_bottom_bar ) {
			dt_get_template_part( 'footer/bottom-bar' );
		}
		?>

	</footer><!-- #footer -->

<?php endif; ?>