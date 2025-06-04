<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<!-- Breadcumb -->
    <div class="breadcumb-area bg-image text-center" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/breadcumb/breadcumb.jpg');">
        <div class="container">
            <div class="row">
                <div class="co-lg-12">
                    <div class="banner-content">
                        <h1 class="title">Cart</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcumb -->

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

    <!-- cart area start -->
    <div class="cart-area section-gap bg-light-1">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-9 col-lg-12 col-md-12 col-12 order-2 order-xl-1 order-lg-2 order-md-2 order-sm-2">
                    <div class="cart-list-area">
                        <div class="single-cart-area-list head">
                            <div class="product-main">
                                <P>Products</P>
                            </div>
                            <div class="price">
                                <p>Price</p>
                            </div>
                            <div class="quantity">
                                <p>Quantity</p>
                            </div>
                            <div class="subtotal">
                                <p>SubTotal</p>
                            </div>
                        </div>
                        <?php
                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                            $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                            $product_id = $cart_item['product_id'];

                            if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
                            $prodcut_sku = $_product->get_sku();
                            $product_name     = $_product->get_name();
                            $product_permalink = $_product->is_visible() ? $_product->get_permalink() : '';
                            $thumbnail         = $_product->get_image();
                            $product_price     = WC()->cart->get_product_price( $_product );
                            $product_subtotal  = WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );
                        ?>
                        <div class="single-cart-area-list main  item-parent">
                            <div class="product-main-cart">
                                <div class="close section-activation">
                                    <?php
                                        echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            'woocommerce_cart_item_remove_link',
                                            sprintf(
                                                '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="fa-regular fa-x"></i></a>',
                                                esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                /* translators: %s is the product name */
                                                esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
                                                esc_attr( $product_id ),
                                                esc_attr( $_product->get_sku() )
                                            ),
                                            $cart_item_key
                                        );
                                    ?>
                                </div>
                                <div class="thumbnail">
                                    <?php echo $thumbnail;?>
                                </div>
                                <div class="information">
                                    <h6 class="title"><?php echo $product_name;?></h6>
                                    <span>SKU:<?php echo $prodcut_sku;?></span>
                                </div>
                            </div>
                            <div class="price">
                                <p><?php echo $product_price;?></p>
                            </div>
                            <div class="quantity">
                                <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<div class="quantity-edit">
				<input type="number" class="input" name="quantity" value="1" min="1">
				<div class="button-wrapper-action">
					<button type="button" class="button decrement"><i class="fa-regular fa-chevron-down"></i></button>
                	<button type="button" class="button increment">+<i class="fa-regular fa-chevron-up"></i></button>
				</div>
			</div>
	</form>
                            </div>
                            <div class="subtotal">
                                <p><?php echo $product_subtotal;?></p>
                            </div>
                        </div>
                        <?php } } ?>
                        <div class="bottom-cupon-code-cart-area">
                            <form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <input type="text" name="coupon_code" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" />
    <button type="submit" class="main-btn btn-primary" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>">
        <?php esc_html_e( 'Apply Coupon', 'woocommerce' ); ?>
    </button>
    <?php do_action( 'woocommerce_cart_coupon' ); ?>
</form>

                            <a href="#" class="main-btn btn-primary mr--50">Clear All</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-12 col-md-12 col-12 order-1 order-xl-2 order-lg-1 order-md-1 order-sm-1">
                    <div class="cart-total-area-start-right">
                        <h5 class="title">Cart Totals</h5>
                        <div class="subtotal">
                            <span>Subtotal</span>
                            <h6 class="price"><?php echo WC()->cart->get_cart_subtotal(); ?></h6>
                        </div>
                        <div class="shipping">
                            <span>Shipping</span>
                            <ul>
                                <li>
                                    <input type="radio" id="f-option" name="selector">
                                    <label for="f-option">Free Shipping</label>

                                    <div class="check"></div>
                                </li>

                                <li>
                                    <input type="radio" id="s-option" name="selector">
                                    <label for="s-option">Flat Rate</label>

                                    <div class="check">
                                        <div class="inside"></div>
                                    </div>
                                </li>

                                <li>
                                    <input type="radio" id="t-option" name="selector">
                                    <label for="t-option">Local Pickup</label>

                                    <div class="check">
                                        <div class="inside"></div>
                                    </div>
                                </li>

                                <li>
                                    <p>Shipping options will be updated
                                        during checkout</p>
                                    <p class="bold">Calculate Shipping</p>
                                </li>
                            </ul>
                        </div>
                        <div class="bottom">
                            <div class="wrapper">
                                <span>Subtotal</span>
                                <?php
                                    $total_subtotal = 0;

                                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                        $_product = $cart_item['data'];

                                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
                                            $line_subtotal = WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] );

                                            // Convert HTML price to float (remove currency symbols)
                                            $line_subtotal_raw = wc_get_price_to_display( $_product ) * $cart_item['quantity'];

                                            $total_subtotal += $line_subtotal_raw;
                                        }
                                    }
                                    ?>
                                    <?php
                                        $cart_total = WC()->cart->get_cart_total();
                                        $applied_coupons = WC()->cart->get_applied_coupons();
                                        ?>

                                        <h6 class="price">
                                            <?php echo $cart_total; ?>
                                            <?php if ( ! empty( $applied_coupons ) ) : ?>
                                                <span style="color: green; font-size: 14px;">(Coupon Applied)</span>
                                            <?php endif; ?>
                                        </h6>



                            </div>
                            <div class="button-area">
                                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="main-btn btn-primary">Proceed To Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart area end -->
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<?php do_action( 'woocommerce_after_cart' ); ?>

    