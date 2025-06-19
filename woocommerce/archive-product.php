<?php
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<div class="breadcumb-area bg-image text-center" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/images/breadcumb/breadcumb.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1 class="title">
                        <?php
                        if (is_category()) {
                            echo single_cat_title('', false);
                        } elseif (is_tag()) {
                            echo single_tag_title('', false);
                        } elseif (is_post_type_archive()) {
                            post_type_archive_title();
                        } else {
                            the_archive_title(); // fallback
                        }
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container section-gap">
  <div class="row align-items-center justify-content-between mb-4">
    <div class="col-md-9">
      <?php woocommerce_result_count(); ?>
    </div>
    <div class="col-md-3 text-md-end">
      <?php woocommerce_catalog_ordering(); ?>
    </div>
  </div>
</div>


<?php

if ( woocommerce_product_loop() ) {

    do_action( 'woocommerce_before_shop_loop' );

    ?>
    <div class="container">
        <div class="row">
            <?php
            //woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();

                    do_action( 'woocommerce_shop_loop' );
                    wc_get_template_part( 'content', 'product' );
                }
            }

            //woocommerce_product_loop_end();
            ?>
        </div>
    </div>
    <?php

    do_action( 'woocommerce_after_shop_loop' );

} else {
    do_action( 'woocommerce_no_products_found' );
}

do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
?>
