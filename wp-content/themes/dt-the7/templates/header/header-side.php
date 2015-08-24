<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
	<!-- !Header -->
	<header id="header" <?php presscore_header_class('logo-side'); presscore_header_style(); ?> role="banner"><!-- class="overlap"; class="logo-left", class="logo-center", class="logo-classic" -->

		<div class="header-side-content">

			<?php dt_get_template_part( 'header/top-bar' ); ?>

			<div class="wf-wrap <?php echo presscore_get_color_mode_class( of_get_option('menu-hover_font_color_mode') ); ?>">

				<div class="wf-table">

					<?php dt_get_template_part( 'header/branding' ); ?>

					<?php do_action( 'presscore_primary_navigation' ); ?>

				</div><!-- .wf-table -->

			</div><!-- .wf-wrap -->

			<?php if ( presscore_get_header_elements_list('bottom') ) :

				dt_get_template_part( 'header/bottom-bar' );

			endif; // bottom bar ?>

		</div>

	</header><!-- #masthead -->