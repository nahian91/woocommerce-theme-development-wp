<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>
<!-- Breadcumb -->
    <div class="breadcumb-area bg-image text-center" style="background-image: url('<?php echo get_template_directory_uri();?>/assets/images/breadcumb/breadcumb.jpg');">
        <div class="container">
            <div class="row">
                <div class="co-lg-12">
                    <div class="banner-content">
                        <h1 class="title"><?php the_title();?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcumb -->

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php //wc_get_template_part( 'content', 'single-product' ); ?>

            <div class="chop-details-area section-gap bg-light-1">
        <div class="container">
            <div class="shopdetails-style-1-wrapper">
                <div class="row g-5">
                    <div class="col-xl-8 col-lg-8 col-md-12">
                        <div class="product-details-popup-wrapper in-shopdetails">
                            <div class="product-details-section product-details-section2 product-details-popup-section">
                                <div class="product-details-popup">
                                    <div class="details-product-area">
                                        <?php 
                                        global $product;
if ( ! $product ) return;

// Collect images: main image + gallery images
$images = [];

$main_image_id = $product->get_image_id();
if ( $main_image_id ) {
    $images[] = wp_get_attachment_url( $main_image_id );
}

$gallery_image_ids = $product->get_gallery_image_ids();
foreach ( $gallery_image_ids as $img_id ) {
    $images[] = wp_get_attachment_url( $img_id );
}

// Class suffixes for wrappers
$suffixes = ['one', 'two', 'three', 'four', 'five']; // can add more if needed

?>

<div class="product-thumb-area">
    <div class="cursor"></div>

    <?php foreach ( $images as $index => $img_url ): 
        $wrapper_class = $suffixes[$index] ?? 'more-' . ($index + 1); // fallback class
        $hide_class = $index === 0 ? '' : 'hide'; // first visible, others hidden
    ?>
        <div class="thumb-wrapper <?php echo esc_attr($wrapper_class); ?> filterd-items <?php echo esc_attr($hide_class); ?>">
            <div 
                class="product-thumb zoom" 
                onmousemove="zoom(event)" 
                style="background-image: url('<?php echo esc_url($img_url); ?>')"
            >
                <img src="<?php echo esc_url($img_url); ?>" alt="product-thumb" />
            </div>
        </div>
    <?php endforeach; ?>

    <div class="product-thumb-filter-group">
        <?php foreach ( $images as $index => $img_url ): 
            $filter_class = $suffixes[$index] ?? 'more-' . ($index + 1);
            $active_class = $index === 0 ? 'active' : '';
        ?>
            <div class="thumb-filter filter-btn <?php echo esc_attr($active_class); ?>" data-show=".<?php echo esc_attr($filter_class); ?>">
                <img src="<?php echo esc_url($img_url); ?>" alt="product-thumb-filter" />
            </div>
        <?php endforeach; ?>
    </div>
</div>

                                        <div class="contents">
                                            <div class="product-status">
                                                <span class="product-catagory"> <?php $terms = get_the_terms( $product->get_id(), 'product_cat' );

                                                if ( $terms && ! is_wp_error( $terms ) ) {
                                                    foreach ( $terms as $term ) {
                                                        echo esc_html( $term->name );
                                                    }
                                                }
                                                ?></span>
                                                <div class="rating-stars-group">
                                                    <div class="rating-star"><i class="fas fa-star"></i></div>
                                                    <div class="rating-star"><i class="fas fa-star"></i></div>
                                                    <div class="rating-star"><i class="fas fa-star-half-alt"></i></div>
                                                    <span><?php if ( $product ) {
                                                        $review_count = $product->get_review_count();
                                                        echo intval( $review_count ) . ' Reviews';
                                                    }?></span>
                                                </div>
                                            </div>
                                            <h2 class="product-title"><?php the_title();?></h2>
                                            <p class="mt--20 mb--20">
                                            <?php
                                                global $post;

                                                $short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

                                                if ( ! $short_description ) {
                                                    return;
                                                }
                                                    echo $short_description;
                                                ?>
                                            </p>

<span class="product-price mb--15 d-block" style="color: #DC2626; font-weight: 600;"><?php echo wc_price( $product->get_sale_price() ); ?>
<?php 
    if($product->get_sale_price()) {
        ?>
            <span class="old-price ml--15"><?php echo wc_price( $product->get_regular_price() ); ?></span>
        <?php
    }
?>
</span>
                                            
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
                                            <div class="product-uniques">
                                                <span class="sku product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">SKU: </span> <?php echo $product->get_sku();?></span>
                                                <span class="catagorys product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">Categories: </span> T-Shirts, Tops, Mens</span>

<span class="tags product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">Tags: </span>
<?php 
$product_id = $product->get_id();

$product_tags = get_the_terms( $product_id, 'product_tag' );
if ( $product_tags && ! is_wp_error( $product_tags ) ) {
    foreach ( $product_tags as $tag ) {
       echo esc_html( $tag->name ) . ', ';
    }
}
?>
 </span>



                                                <span class="tags product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">STOCK:: </span> <?php echo $product->get_stock_quantity();?></span>
                                                <span class="tags product-unipue mb--10"><span style="font-weight: 400; margin-right: 10px;">Category: </span> <?php $terms = get_the_terms( $product->get_id(), 'product_cat' );

                                                if ( $terms && ! is_wp_error( $terms ) ) {
                                                    foreach ( $terms as $term ) {
                                                        echo esc_html( $term->name );
                                                    }
                                                }
                                                ?></span>
                                            </div>
                                            <div class="share-option-shop-details">
                                                <div class="single-share-option">
                                                    <div class="icon">
                                                        <i class="fa-regular fa-heart"></i>
                                                    </div>
                                                    <span>Add To Wishlist</span>
                                                </div>
                                                <div class="single-share-option">
                                                    <div class="icon">
                                                        <i class="fa-solid fa-share"></i>
                                                    </div>
                                                    <span>Share On social</span>
                                                </div>
                                                <div class="single-share-option">
                                                    <div class="icon">
                                                        <i class="fa-light fa-code-compare"></i>
                                                    </div>
                                                    <span>Compare</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-discription-tab-shop mt--50">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Product Details</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Additional Information</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tabt" data-bs-toggle="tab" data-bs-target="#profile-tab-panes" type="button" role="tab" aria-controls="profile-tab-panes" aria-selected="false">Customer Reviews (<?php if ( $product ) {
                                        $review_count = $product->get_review_count();
                                        echo intval( $review_count );
                                    }?>)</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active show" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <div class="single-tab-content-shop-details">
                                       <?php echo wpautop( $product->get_description() );?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                    <div class="single-tab-content-shop-details">
                                        <div class="table-responsive table-shop-details-pd">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>SKU</th>
                                                        <th><?php echo $product->get_sku();?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Weight</td>
                                                        <td><?php echo $product->get_weight();?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Category</td>
                                                        <td><?php $terms = get_the_terms( $product->get_id(), 'product_cat' );

                                                if ( $terms && ! is_wp_error( $terms ) ) {
                                                    foreach ( $terms as $term ) {
                                                        echo esc_html( $term->name );
                                                    }
                                                }
                                                ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Stock Quantity</td>
                                                        <td><?php echo $product->get_stock_quantity();?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Stock Status</td>
                                                        <td><?php echo $product->get_stock_status();?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Average Rating</td>
                                                        <td><?php echo $product->get_average_rating();?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Reviews</td>
                                                        <td><?php echo $product->get_review_count();?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile-tab-panes" role="tabpanel" aria-labelledby="profile-tabt" tabindex="0">
                                    <div class="single-tab-content-shop-details">
                                        <div class="product-details-review-product-style">
                                            <div class="average-stars-area-left">
                                                <div class="top-stars-wrapper">
                                                    <h4 class="review">
                                                        <?php echo number_format($product->get_average_rating(), 1);?>
                                                    </h4>
                                                    <div class="rating-disc">
                                                        <span>Average Rating</span>
                                                        <div class="stars">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <span>(1 Reviews &amp; 0 Ratings)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="average-stars-area">
                                                        <?php if ( $product ) {
    $average_rating = $product->get_average_rating();

    // Calculate recommended percentage
    $recommended_percentage = ( $average_rating / 5 ) * 100;
    $recommended_percentage = number_format( $recommended_percentage, 0 ); // no decimals

    
}?>
<h4 class="average"><?php echo $recommended_percentage . '%';?></h4>
<span>Recommended
                                                        (2 of 3)</span>
                                                </div>
                                                <div class="review-charts-details">
                                                    <div class="single-review">
                                                        <div class="stars">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                        </div>
                                                        <div class="single-progress-area-incard">
                                                            <div class="progress">
                                                                <div class="progress-bar wow fadeInLeft" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <span class="pac">100%</span>
                                                    </div>
                                                    <div class="single-review">
                                                        <div class="stars">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                        </div>
                                                        <div class="single-progress-area-incard">
                                                            <div class="progress">
                                                                <div class="progress-bar wow fadeInLeft" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <span class="pac">80%</span>
                                                    </div>
                                                    <div class="single-review">
                                                        <div class="stars">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                        </div>
                                                        <div class="single-progress-area-incard">
                                                            <div class="progress">
                                                                <div class="progress-bar wow fadeInLeft" role="progressbar" style="width: 60%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <span class="pac">60%</span>
                                                    </div>
                                                    <div class="single-review">
                                                        <div class="stars">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                        </div>
                                                        <div class="single-progress-area-incard">
                                                            <div class="progress">
                                                                <div class="progress-bar wow fadeInLeft" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <span class="pac">40%</span>
                                                    </div>
                                                    <div class="single-review">
                                                        <div class="stars">
                                                            <i class="fa-solid fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                            <i class="fa-regular fa-star"></i>
                                                        </div>
                                                        <div class="single-progress-area-incard">
                                                            <div class="progress">
                                                                <div class="progress-bar wow fadeInLeft" role="progressbar" style="width: 80%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <span class="pac">30%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="submit-review-area">
    <?php 
    // Customize WooCommerce review form labels and fields
    add_filter( 'woocommerce_product_review_comment_form_args', function( $comment_form ) {
        $comment_form['title_reply'] = __( 'Write a Review', 'your-textdomain' );
        $comment_form['label_submit'] = __( 'Submit Review', 'your-textdomain' );
        unset( $comment_form['fields']['url'] ); // Remove website field
        return $comment_form;
    });

    // Display the WooCommerce review form
    comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', array() ) );
    ?>
</div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-12 offset-xl-1  sticky-column-item">
                        <div class="theiaStickySidebar">
                            <div class="shop-sight-sticky-sidevbar  mb--20">
                                <h6 class="title">Available offers</h6>
                                <div class="single-offer-area">
                                    <div class="icon">
                                        <img src="assets/images/shop/01.svg" alt="icon">
                                    </div>
                                    <div class="details">
                                        <p>Get %5 instant discount for the 1st Flipkart Order using Ekomart UPI T&amp;C</p>
                                    </div>
                                </div>
                                <div class="single-offer-area">
                                    <div class="icon">
                                        <img src="assets/images/shop/02.svg" alt="icon">
                                    </div>
                                    <div class="details">
                                        <p>Flat $250 off on Citi-branded Credit Card EMI Transactions on orders of $30 and above T&amp;C</p>
                                    </div>
                                </div>
                                <div class="single-offer-area">
                                    <div class="icon">
                                        <img src="assets/images/shop/03.svg" alt="icon">
                                    </div>
                                    <div class="details">
                                        <p>Free Worldwide Shipping on all
                                            orders over $100</p>
                                    </div>
                                </div>
                            </div>
                            <div class="our-payment-method">
                                <h5 class="title">Guaranteed Safe Checkout</h5>
                                <img src="assets/images/shop/03.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>

<?php
get_footer( 'shop' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
