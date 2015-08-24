jQuery(function($) {
	$('body').bind('added_to_cart', dt_update_cart_dropdown);
});

function dt_update_cart_dropdown(event, parts, hash) {

	if ( parts['div.widget_shopping_cart_content'] ) {

		var $miniCart = jQuery('.shopping-cart');
		var $cartContent = jQuery(parts['div.widget_shopping_cart_content']);
		var $itemsList = $cartContent.find('.cart_list');
		var $total = $cartContent.find('.total');
		var quantity = dt_get_shopping_cart_items_quantity( $cartContent );

		$miniCart.each( function() {
			var $self = jQuery(this);
			var $buttons = $self.find('.buttons');
			$self.find('.shopping-cart-inner').html('').append($itemsList, $total, $buttons);
			$self.find('.wc-ico-cart span').html( quantity );
		} );
	}

}

function dt_get_shopping_cart_items_quantity( $content ) {
	var quantity = 0;

	$content.find('li .quantity').each(function() {
		var text = jQuery(this).text();
		var q = parseInt( text.split(' ')[0] );

		if ( q ) {
			quantity += q;
		}
	});

	return quantity;
}