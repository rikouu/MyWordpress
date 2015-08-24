<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

$rollover_class = '';
$buttonts_count = dt_woocommerce_get_product_icons_count();

if ( 0 == $buttonts_count ) {
	$rollover_class .= ' forward-post';

} else if ( $buttonts_count < 2 ) {
	$rollover_class .= ' rollover-active';

}

$category = presscore_get_config()->get( 'subcategory' );
?>

<div class="rollover-project<?php echo $rollover_class; ?>">

	<?php dt_woocommerce_subcategory_thumbnail( $category ); ?>

	<?php if ( dt_woocommerce_product_show_content() ) : ?>

		<div class="rollover-content">
			<div class="wf-table">
				<div class="wf-td">
					<div class="rollover-content-container">

						<?php dt_woocommerce_template_subcategory_description(); ?>

					</div>
				</div>
			</div>
		</div>

	<?php endif; ?>

</div>