<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
	<!-- !Header -->
	<header id="header" <?php presscore_header_class('logo-center'); presscore_header_style(); ?> role="banner"><!-- class="overlap"; class="logo-left", class="logo-center", class="logo-classic" -->

		<?php dt_get_template_part( 'header/top-bar' ); ?>

		<div class="wf-wrap">
			<div class="wf-table"<?php presscore_header_table_style(); ?>>
				<div class="wf-td">

					<?php dt_get_template_part( 'header/branding' ); ?>

				</div><!-- .wf-td -->
			</div><!-- .wf-table -->
		</div><!-- .wf-wrap -->
		<div class="navigation-holder">
			<div class="wf-wrap <?php echo presscore_get_color_mode_class( of_get_option('menu-hover_font_color_mode') ); ?>">

				<?php do_action( 'presscore_primary_navigation' ); ?>

			</div><!-- .wf-wrap -->
		</div><!-- .navigation-holder -->

	</header><!-- #masthead -->