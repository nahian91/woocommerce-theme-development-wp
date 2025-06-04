<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if ( ! is_a( $product, WC_Product::class ) || ! $product->is_visible() ) {
	return;
}
?>

<div class="col-lg-20 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
    <div class="single-shopping-card-one">
        <!-- iamge and sction area start -->
        <div class="image-and-action-area-wrapper">
            <a href="<?php the_permalink();?>" class="thumbnail-preview">
                <?php if ( $product->is_on_sale() ) : 
    $regular_price = (float) $product->get_regular_price();
    $sale_price = (float) $product->get_sale_price();
    if ( $regular_price > 0 ) {
        $percentage = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
    ?>
	<div class="badge">
	<span><?php echo esc_html( $percentage ); ?>% <br> 
		Off
	</span>
	<i class="fa-solid fa-bookmark"></i>
</div>
    <?php } ?>
<?php endif; ?>
                <?php the_post_thumbnail();?>
            </a>
        </div>
        <!-- iamge and sction area start -->

        <div class="body-content">

            <a href="<?php the_permalink();?>">
                <h4 class="title"><?php the_title();?></h4>
            </a>
            <?php 
											$weight = $product->get_weight();
											if($weight) {
												?>
													<span class="availability"><?php
											
											echo $product->get_weight();?> KG</span>
												<?php
											}
                                            ?>
            <div class="price-area">
                                                <span class="current"><?php echo wc_price( $product->get_regular_price() ); ?></span>
												<?php 
													if(!empty($product->get_sale_price())) {
													?>
														<div class="previous"><?php echo wc_price( $product->get_sale_price() ); ?></div>
													<?php 
													}
												?>
                                                
                                            </div>
            <div class="cart-counter-action">
	<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<div class="quantity-edit">
				<input type="number" class="input" name="quantity" value="1" min="1">
				<div class="button-wrapper-action">
					<button type="button" class="button decrement"><i class="fa-regular fa-chevron-down"></i></button>
                	<button type="button" class="button increment">+<i class="fa-regular fa-chevron-up"></i></button>
				</div>
			</div>

			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>">

			<button type="submit" class="main-btn btn-primary radious-sm with-icon">
				<div class="btn-text">
					Add To Cart
				</div>
				<div class="arrow-icon">
					<i class="fa-regular fa-cart-shopping"></i>
				</div>
				<div class="arrow-icon">
					<i class="fa-regular fa-cart-shopping"></i>
				</div>
			</button>
	</form>
</div>
        </div>
    </div>
</div>
