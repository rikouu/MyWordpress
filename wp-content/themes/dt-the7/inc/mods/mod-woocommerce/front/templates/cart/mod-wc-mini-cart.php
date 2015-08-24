<?php
/**
 * Description here.
 *
 */

// File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

// cart icon and title settings

$dt_cart_class = '';
$dt_cart_caption = _x('Your cart', 'woocommerce mini cart', LANGUAGE_ZONE);
$dt_cart_counter_bg_class = '';

if ( function_exists('of_get_option') ) {

	$show_icon = of_get_option('header-woocommerce_cart_icon', true);

	// show or not cart icon
	if ( !$show_icon ) {
		$dt_cart_class .= ' icon-off';
	}

	// counter gradient bg
	switch ( of_get_option('header-woocommerce_counter_bg_mode') ) {
		case 'gradient':
			$dt_cart_counter_bg_class = ' class="gradient-bg"';
			break;

		case 'color':
			$dt_cart_counter_bg_class = ' class="custom-bg"';
			break;
	}

	// change cart caption
	$dt_cart_caption = of_get_option('header-woocommerce_cart_caption', $dt_cart_caption);

	if ( !$dt_cart_caption ) {
		$dt_cart_caption = '&nbsp;';

		if ( $show_icon ) {
			$dt_cart_class .= ' text-disable';
		}
	}
}

$dt_products_count = esc_html(WC()->cart->cart_contents_count);
?>

<div class="shopping-cart">

	<a class="wc-ico-cart<?php echo $dt_cart_class; ?>" href="<?php echo WC()->cart->get_cart_url(); ?>"><?php echo $dt_cart_caption; ?><span<?php echo $dt_cart_counter_bg_class; ?>><?php echo $dt_products_count; ?></span></a>

	<div class="shopping-cart-wrap">
		<div class="shopping-cart-inner">

			<?php
			$cart_is_empty = count(WC()->cart->get_cart()) <= 0;
			$list_class = array( 'cart_list', 'product_list_widget' );

			if ( $cart_is_empty ) {
				$list_class[] = 'empty';
			}
			?>

			<ul class="<?php echo implode(' ', $list_class); ?>">

				<?php if ( !$cart_is_empty ) : ?>

					<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :

						$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

							$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
							<li>
								<?php echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key ); ?>
								<?php if ( ! $_product->is_visible() ) : ?>
									<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name; ?>
								<?php else : ?>
									<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>">
										<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name; ?>
									</a>
								<?php endif; ?>
								<?php echo WC()->cart->get_item_data( $cart_item ); ?>

								<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
							</li>
							<?php
						}

					endforeach; ?>

				<?php else : ?>

					<li><?php _e( 'No products in the cart.', LANGUAGE_ZONE ); ?></li>

				<?php endif; ?>

			</ul><!-- end product list -->

			<?php if ( sizeof( WC()->cart->get_cart() ) <= 0 ) : ?>
				<div style="display: none;">
			<?php endif; ?>

				<p class="total"><strong><?php _e( 'Subtotal', LANGUAGE_ZONE ); ?>:</strong> <?php echo WC()->cart->get_cart_subtotal(); ?></p>

				<p class="buttons">
					<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button view-cart"><?php _e( 'View Cart', LANGUAGE_ZONE ); ?></a>
					<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button checkout"><?php _e( 'Checkout', LANGUAGE_ZONE ); ?></a>
				</p>

			<?php if ( sizeof( WC()->cart->get_cart() ) <= 0 ) : ?>
				</div>
			<?php endif; ?>
		</div>
	</div>

</div>