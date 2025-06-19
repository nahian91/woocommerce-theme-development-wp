<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */

?>

<!-- Breadcumb -->
    <div class="breadcumb-area bg-image text-center" style="background-image: url('<?php echo get_template_directory_uri();?>/assets/images/breadcumb/breadcumb.jpg');">
        <div class="container">
            <div class="row">
                <div class="co-lg-12">
                    <div class="banner-content">
                        <h1 class="title">My Account</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcumb -->

    <div class="account-tab-area-start section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="nav accout-dashborard-nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa-regular fa-chart-line"></i>Dashboard</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa-regular fa-bag-shopping"></i>Order</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false"><i class="fa-sharp fa-regular fa-tractor"></i> Track Your Order</button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa-sharp fa-regular fa-location-dot"></i>My Address</button>
                        <button class="nav-link" id="v-pills-settingsa-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settingsa" type="button" role="tab" aria-controls="v-pills-settingsa" aria-selected="false"><i class="fa-light fa-user"></i>Account Details</button>
                    </div>
                </div>
                <div class="col-lg-9 pl--50 pl_md--10 pl_sm--10 pt_md--30 pt_sm--30">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab" tabindex="0">
                            <div class="dashboard-account-area">
                                <?php 
                                    $current_user = wp_get_current_user();
                                ?>
                                <h2 class="title">Hello <?php echo $current_user->user_login;?>! (Not <?php echo $current_user->user_login;?>?) <a href="<?php echo wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) );?>">Log Out.</a></h2>
                                <p class="disc">
                                    From your account dashboard you can view your recent orders, manage your shipping and billing addresses, and edit your password and account details.
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                            <div class="order-table-account">
                                <div class="h2 title">Your Orders</div>
                                <div class="table-responsive">

                                <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Order</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                <?php 
                                if ( is_user_logged_in() ) {
                                    $current_user_id = get_current_user_id();

                                    $customer_orders = wc_get_orders( array(
                                        'customer_id' => $current_user_id,
                                        'orderby'     => 'date',
                                        'order'       => 'DESC',
                                        'limit'       => -1, // Get all orders
                                    ) );

                                    if ( ! empty( $customer_orders ) ) {
                                        foreach ( $customer_orders as $order ) {
// Get order ID
                                            $order_id = $order->get_id();

                                            // Get order date
                                            $order_date = $order->get_date_created()->date( 'F j, Y' );

                                            // Get order total
                                            $order_total = $order->get_formatted_order_total();

                                            // Get order status
                                            $order_status = wc_get_order_status_name( $order->get_status() );
                                            $order_view_url = $order->get_view_order_url();
                                            $order_items = $total_quantity = $order->get_item_count( 'line_item', true );                                            
                                        ?>
                                            <tr>
                                                <td><?php echo $order_id;?></td>
                                                <td><?php echo $order_date;?></td>
                                                <td><?php echo $order_status;?></td>
                                                <td><?php echo $order_total;?> for <?php echo intval( $total_quantity );?> Items</td>
                                                <td><a href="<?php echo $order_view_url;?>" class="btn-small d-block">View</a></td>
                                            </tr>   
                                        <?php
                                        }
                                    } else {
                                        echo '<p>No orders found.</p>';
                                    }
                                }

                                ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab" tabindex="0">
                            <div class="tracing-order-account">
                                <h2 class="title">Orders tracking</h2>
                                <p>
                                    To keep up with the status of your order, kindly input your OrderID in the designated box below and click the "Track" button. This unique identifier can be found on your receipt as well as in the confirmation email that was sent to you.
                                </p>
                                <form action="#" class="order-tracking">
                                    <div class="single-input">
                                        <label for="order-id">Order Id</label>
                                        <input type="text" placeholder="Found in your order confirmation email" required="">
                                    </div>
                                    <div class="single-input">
                                        <label for="order-id">Billing email</label>
                                        <input type="text" placeholder="Email You use during checkout">
                                    </div>
                                    <button class="main-btn btn-primary">Track</button>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab" tabindex="0">
                            <div class="shipping-address-billing-address-account">
                                <div class="half">
                                    <h2 class="title">Billing Address</h2>
                                    <?php $billing_address  = $order->get_formatted_billing_address();
                                    echo wp_kses_post( $billing_address );

                                    $edit_billing_url = wc_get_endpoint_url( 'edit-address', 'billing', wc_get_page_permalink( 'myaccount' ) );

                                    ?>
                                    
                                    <a href="<?php echo $edit_billing_url; ?>">Edit</a>
                                </div>
                                <div class="half">
                                    <h2 class="title">Shipping Address</h2>
                                    <?php 
                                        $shipping_address = $order->get_formatted_shipping_address();
                                        echo wp_kses_post( $shipping_address );

                                        $edit_shipping_url = wc_get_endpoint_url( 'edit-address', 'shipping', wc_get_page_permalink( 'myaccount' ) );
                                    ?>
                                    <a href="<?php echo $edit_shipping_url;?>">Edit</a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settingsa" role="tabpanel" aria-labelledby="v-pills-settingsa-tab" tabindex="0">
                            <form action="#" class="account-details-area">
                                <h2 class="title">Account Details</h2>
                                <div class="input-half-area">
                                    <div class="single-input">
                                        <input type="text" placeholder="First Name">
                                    </div>
                                    <div class="single-input">
                                        <input type="text" placeholder="Last Name">
                                    </div>
                                </div>

                                <input type="text" placeholder="Display Name" required="">
                                <input type="email" placeholder="Email Address *" required="">
                                <input type="email" placeholder="Email Address *">
                                <input type="password" placeholder="Current Password *" required="">
                                <input type="password" placeholder="New Password *">
                                <input type="password" placeholder="Confirm Password *">
                                <button class="main-btn btn-primary">Save Change</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 



//do_action( 'woocommerce_account_navigation' ); ?>

<div class="woocommerce-MyAccount-content">
	<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		//do_action( 'woocommerce_account_content' );
	?>
</div>
