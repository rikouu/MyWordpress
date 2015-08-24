<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$rollover_class = '';
$buttonts_count = dt_woocommerce_get_product_icons_count();

if ( 0 == $buttonts_count ) {
	$rollover_class .= ' forward-post';
}
?>

<div class="rollover-project<?php echo $rollover_class; ?>">

	<?php presscore_wc_template_loop_product_thumbnail(); ?>

	<?php if ( dt_woocommerce_product_show_content() ) : ?>

		<div class="rollover-content">
			<div class="wf-table">
				<div class="wf-td">

					<?php
					// get rollover icons
					$rollover_icons = dt_woocommerce_get_product_preview_icons();

					if ( $rollover_icons ) :

						if ( 1 == $buttonts_count ) {
							$rollover_icons = str_replace('class="', 'class="big-link ', $rollover_icons);
						}
						?>

						<div class="links-container">

							<?php echo $rollover_icons; ?>

						</div>

					<?php endif; ?>

					<div class="rollover-content-container">

						<?php dt_woocommerce_template_product_description(); ?>

					</div>
				</div>
			</div>
		</div>

	<?php endif; ?>

</div>