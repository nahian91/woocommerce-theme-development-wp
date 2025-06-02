<?php get_header(); ?>
    
    <!-- Breadcumb -->
    <div class="breadcumb-area bg-image text-center" style="background-image: url('<?php echo get_template_directory_uri();?>/assets/images/breadcumb/breadcumb.jpg');">
        <div class="container">
            <div class="row">
                <div class="co-lg-12">
                    <div class="banner-content">
                        <h1 class="title">Blog</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Breadcumb -->

    <div class="section-seperator">
        <div class="container">
            <hr class="section-seperator">
        </div>
    </div>

    <div class="blog-area section-gap bg-white bg-gradient-tranding-items">
        <div class="container">
            <div class="row g-5">
                <?php
                    $posts_per_page = get_option( 'posts_per_page' );
                    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
                    $args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => $posts_per_page,
                        'paged'  => $paged,
                    );

                    $query = new WP_Query($args);

                    if ( $query->have_posts() ) :
                        while ( $query->have_posts() ) : $query->the_post();
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                <!-- single blog area start -->
                                <div class="single-blog-style-card-border">
                                    <a href="<?php the_permalink();?>" class="thumbnail">
                                        <?php the_post_thumbnail();?>
                                    </a>
                                    <div class="inner-content-body">
                                        <div class="tag-area">
                                            <div class="single">
                                                <i class="fa-light fa-clock"></i>
                                                <span><?php echo get_the_date('d M, Y');?></span>
                                            </div>
                                            <div class="single">
                                                <i class="fa-light fa-folder"></i>
                                                <span><?php the_category(', '); ?></span>
                                            </div>
                                        </div>
                                        <a class="title-main" href="<?php the_permalink();?>">
                                            <h3 class="title">
                                                <?php the_title();?>
                                            </h3>
                                        </a>
                                        <div class="button-area">
                                            <a href="<?php the_permalink();?>" class="main-btn btn-primary radious-sm with-icon">
                                                <div class="btn-text">
                                                    Read Details
                                                </div>
                                                <div class="arrow-icon">
                                                    <i class="fa-solid fa-circle-plus"></i>
                                                </div>
                                                <div class="arrow-icon">
                                                    <i class="fa-solid fa-circle-plus"></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <!-- single blog area end -->
                            </div>
                            <?php
                            endwhile;
                            the_posts_pagination( array(
                                'mid_size'  => 2,
                                'prev_text' => __( '<i class="fa-regular fa-chevrons-left"></i>'),
                                'next_text' => __( '<i class="fa-regular fa-chevrons-right"></i>'),
                            ) );

                        wp_reset_postdata();
                    else :
                        echo '<p>No posts found.</p>';
                    endif;
                    ?>
            </div>
        </div>
    </div>

<?php get_footer();?>