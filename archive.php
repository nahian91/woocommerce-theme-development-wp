<?php get_header(); ?>

<!-- Breadcrumb -->
<div class="breadcumb-area bg-image text-center" style="background-image: url('<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/breadcumb/breadcumb.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner-content">
                    <h1 class="title">
                        <?php
                        if ( is_category() ) {
                            single_cat_title();
                        } elseif ( is_tag() ) {
                            single_tag_title();
                        } elseif ( is_author() ) {
                            the_post();
                            echo 'Author: ' . esc_html( get_the_author() );
                            rewind_posts();
                        } elseif ( is_day() ) {
                            echo 'Day: ' . esc_html( get_the_date() );
                        } elseif ( is_month() ) {
                            echo 'Month: ' . esc_html( get_the_date( 'F Y' ) );
                        } elseif ( is_year() ) {
                            echo 'Year: ' . esc_html( get_the_date( 'Y' ) );
                        } else {
                            echo 'Archives';
                        }
                        ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<div class="section-seperator">
    <div class="container">
        <hr class="section-seperator">
    </div>
</div>

<div class="blog-area section-gap bg-white bg-gradient-tranding-items">
    <div class="container">
        <div class="row g-5">
            <?php

            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                        <div class="single-blog-style-card-border">
                            <a href="<?php the_permalink(); ?>" class="thumbnail">
                                <?php the_post_thumbnail( 'medium_large' ); ?>
                            </a>
                            <div class="inner-content-body">
                                <div class="tag-area">
                                    <div class="single">
                                        <i class="fa-light fa-clock"></i>
                                        <span><?php echo esc_html( get_the_date( 'd M, Y' ) ); ?></span>
                                    </div>
                                    <div class="single">
                                        <i class="fa-light fa-folder"></i>
                                        <span><?php the_category( ', ' ); ?></span>
                                    </div>
                                </div>
                                <a class="title-main" href="<?php the_permalink(); ?>">
                                    <h3 class="title"><?php the_title(); ?></h3>
                                </a>
                                <div class="button-area">
                                    <a href="<?php the_permalink(); ?>" class="main-btn btn-primary radious-sm with-icon">
                                        <div class="btn-text">Read Details</div>
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
                    </div>
                    <?php
                endwhile;

                // Pagination
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '<i class="fa-regular fa-chevrons-left"></i>', 'your-textdomain' ),
                    'next_text' => __( '<i class="fa-regular fa-chevrons-right"></i>', 'your-textdomain' ),
                ) );

                wp_reset_postdata();
            else :
                echo '<p>No posts found.</p>';
            endif;
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
