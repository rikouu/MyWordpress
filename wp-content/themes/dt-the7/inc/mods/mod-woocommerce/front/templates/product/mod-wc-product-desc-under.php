<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<div class="project-list-media">
	<div class="buttons-on-img">

		<?php
		presscore_wc_template_loop_product_thumbnail( 'alignnone' );

		$rollover_icons = dt_woocommerce_get_product_preview_icons();

		// output rollover
		if ( $rollover_icons ) : ?>

			<div class="rollover-content">
				<div class="wf-table">
					<div class="links-container wf-td ">

						<?php echo $rollover_icons; ?>

					</div>
				</div>
			</div>

		<?php endif; ?>

	</div>
</div>
<div class="project-list-content">

	<?php dt_woocommerce_template_product_description(); ?>

</div>