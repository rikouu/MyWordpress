<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
	<!-- !Header -->
	<header id="header" <?php presscore_header_class('logo-left'); presscore_header_style(); ?> role="banner"><!-- class="overlap"; class="logo-left", class="logo-center", class="logo-classic" -->

		<?php dt_get_template_part( 'header/top-bar' ); ?>

		<div class="wf-wrap <?php echo presscore_get_color_mode_class( of_get_option('menu-hover_font_color_mode') ); ?>">

			<div class="wf-table"<?php presscore_header_table_style(); ?>>

				<?php dt_get_template_part( 'header/branding' ); ?>

				<?php do_action( 'presscore_primary_navigation' ); ?>

			</div><!-- .wf-table -->
		</div><!-- .wf-wrap -->

	</header><!-- #masthead -->