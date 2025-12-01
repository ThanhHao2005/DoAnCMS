<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="cart-totals-content">
	<?php
	do_action( 'woocommerce_review_order_before_cart_contents' );

	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			?>
			<p class="d-flex">
				<span>
					<?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?>
					<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' <strong class="product-quantity">' . sprintf( '&times;&nbsp;%d', $cart_item['quantity'] ) . '</strong>', $cart_item, $cart_item_key ); ?>
				</span>
				<span><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></span>
			</p>
			<?php
		}
	}

	do_action( 'woocommerce_review_order_after_cart_contents' );
	?>

	<hr>

	<!-- Subtotal -->
	<p class="d-flex">
		<span><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></span>
		<span><?php wc_cart_totals_subtotal_html(); ?></span>
	</p>

	<!-- Coupons -->
	<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
		<p class="d-flex">
			<span><?php esc_html_e( 'Discount', 'woocommerce' ); ?></span>
			<span class="discount-amount">-<?php wc_cart_totals_coupon_html( $coupon ); ?></span>
		</p>
	<?php endforeach; ?>

	<!-- Shipping -->
	<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
		<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
		<p class="d-flex">
			<span><?php esc_html_e( 'Delivery', 'woocommerce' ); ?></span>
			<span><?php wc_cart_totals_shipping_html(); ?></span>
		</p>
		<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
	<?php endif; ?>

	<!-- Fees -->
	<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
		<p class="d-flex">
			<span><?php echo esc_html( $fee->name ); ?></span>
			<span><?php wc_cart_totals_fee_html( $fee ); ?></span>
		</p>
	<?php endforeach; ?>

	<!-- Tax -->
	<?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
		<?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
			<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
				<p class="d-flex">
					<span><?php echo esc_html( $tax->label ); ?></span>
					<span><?php echo wp_kses_post( $tax->formatted_amount ); ?></span>
				</p>
			<?php endforeach; ?>
		<?php else : ?>
			<p class="d-flex">
				<span><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span>
				<span><?php wc_cart_totals_taxes_total_html(); ?></span>
			</p>
		<?php endif; ?>
	<?php endif; ?>

	<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

	<hr>
	
	<!-- Total -->
	<p class="d-flex total-price">
		<span><?php esc_html_e( 'Total', 'woocommerce' ); ?></span>
		<span><?php wc_cart_totals_order_total_html(); ?></span>
	</p>

	<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
</div>