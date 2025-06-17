<?php 
    global $redux_demo; 
    $logo = $redux_demo['logo'];
?>

<div class="search-header-area-main bg_primary">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logo-search-category-wrapper">
                    <?php 
                        if(!empty($logo)) {
                            ?>
                            <a href="<?php echo site_url();?>" class="logo-area">
                                <img src="<?php echo $logo['url'];?>" alt="logo-main" class="logo">
                            </a>
                            <?php
                        }
                    ?>
                    <div class="category-search-wrapper">
                        <form role="search" method="get" action="<?php echo esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ); ?>" class="search-header">
                            <input type="search" placeholder="Search for products, categories" value="<?php echo get_search_query(); ?>" name="s" required="">
                            <button class="main-btn btn-primary radious-sm with-icon">
                                <div class="btn-text">
                                    Search
                                </div>
                                <div class="arrow-icon">
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                                <div class="arrow-icon">
                                    <i class="fa-light fa-magnifying-glass"></i>
                                </div>
                            </button>
                        </form>
                    </div>
                    <div class="accont-wishlist-cart-area-header">

                        <?php if(is_user_logged_in()) {
                            $current_user = wp_get_current_user();
                            $username = $current_user->display_name;
                            $avatar = get_avatar( $current_user->ID, 64 );
                            ?>
                            <div class="user-info">
                                <?php echo $avatar;?>
                                <div class="user-content">
                                    <h4><a href="<?php echo wc_get_page_permalink( 'myaccount' );?>">Hi, <?php echo $username;?></a></h4>
                                    <a href="<?php echo wp_logout_url( home_url() );?>">Logout</a>
                                </div>
                            </div>
                            <?php 
                        } else { ?>
                                <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>" class="btn-border-only account">
                            <i class="fa-light fa-user"></i>
                            Account
                            </a>
                       <?php  } ?>
                        
                        <a href="wishlist.html" class="btn-border-only wishlist">
                                <i class="fa-regular fa-heart"></i>
                                Wishlist
                                <span class="number">2</span>
                            </a>


<div class="btn-border-only cart category-hover-header">
    <i class="fa-sharp fa-regular fa-cart-shopping"></i>
    <span class="text">My Cart</span>
    <span class="number"><?php echo count( WC()->cart->get_cart() ); ?>

</span>
    <div class="category-sub-menu card-number-show">
        <h5 class="shopping-cart-number">Shopping Cart (<?php echo count( WC()->cart->get_cart() ); ?>)</h5>

        <?php 
            $cart_items = WC()->cart->get_cart();
            if(!empty($cart_items)) {
                foreach ( $cart_items as $cart_item_key => $cart_item ) {
                    $_product   = $cart_item['data'];
                    $product_id = $cart_item['product_id'];
                    ?>
                        <div class="cart-item-1 border-top">
                            <div class="img-name">
                                <div class="thumbanil">
                                    <img src="<?php echo $_product->get_image(); ?>" alt="<?php echo $_product->get_name(); ?>">
                                </div>
                                <div class="details">
                                    <a href="<?php the_permalink();?>">
                                        <h5 class="title"><?php echo $_product->get_name(); ?></h5>
                                    </a>
                                    <div class="number">
                                        <?php echo $cart_item['quantity']; ?> <i class="fa-regular fa-x"></i>
                                        <span><?php echo wc_price( $_product->get_price() ); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="close-c1">
                                <a href="<?php echo wc_get_cart_remove_url( $cart_item_key );?>"><i class="fa-regular fa-x"></i></a>
                                
                            </div>
                        </div>
                    <?php
                }
            }
        ?>

        <div class="sub-total-cart-balance">
            <div class="bottom-content-deals mt--10">
                <div class="top">
                    <span>Sub Total:</span>
                    <span class="number-c"><?php echo WC()->cart->get_cart_subtotal(); ?>
</span>
                </div>
            </div>
            <div class="button-wrapper d-flex align-items-center justify-content-between">
                <a href="<?php echo wc_get_cart_url();?>" class="main-btn btn-primary ">View Cart</a>
                <a href="<?php echo wc_get_checkout_url();?>" class="main-btn btn-primary border-only">CheckOut</a>
            </div>
        </div>
    </div>
    <a href="<?php echo wc_get_cart_url();?> class="over_link"></a>
</div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>