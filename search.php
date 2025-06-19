<?php get_header(); ?>

<div class="container my-5">
    <h1 class="search-title">
        <?php printf( esc_html__( 'Search Results for: %s', 'your-textdomain' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?>
    </h1>

    <?php if ( have_posts() ) : ?>
        <div class="row g-4">
            <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-lg-4 col-md-6">
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result-card' ); ?>>
                        <a href="<?php the_permalink(); ?>" class="thumbnail">
                            <?php 
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'medium' );
                            } else {
                                echo '<img src="' . esc_url( get_template_directory_uri() ) . '/assets/images/default-thumb.jpg" alt="' . esc_attr( get_the_title() ) . '">';
                            }
                            ?>
                        </a>
                        <h2 class="search-post-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                        <div class="entry-meta">
                            <span><i class="fa-light fa-clock"></i> <?php echo esc_html( get_the_date() ); ?></span>
                            <span><i class="fa-light fa-folder"></i> <?php the_category( ', ' ); ?></span>
                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="pagination mt-4">
            <?php
            the_posts_pagination( array(
                'mid_size'  => 2,
                'prev_text' => __( '<i class="fa-regular fa-chevron-left"></i> Previous', 'your-textdomain' ),
                'next_text' => __( 'Next <i class="fa-regular fa-chevron-right"></i>', 'your-textdomain' ),
            ) );
            ?>
        </div>

    <?php else : ?>
        <div class="no-results">
            <p><?php esc_html_e( 'Sorry, no results matched your search.', 'your-textdomain' ); ?></p>
            <?php get_search_form(); ?>
        </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
