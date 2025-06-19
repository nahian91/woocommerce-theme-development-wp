<?php get_header(); ?>

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

    <div class="section-seperator">
        <div class="container">
            <hr class="section-seperator">
        </div>
    </div>

    <!-- blog sidebar area start -->
    <div class="blog-sidebar-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 order-lg-1 order-md-2 order-sm-2 order-2">
                    <div class="blog-details-area-1">
                        <div class="thumbnail">
                            <?php the_post_thumbnail();?>
                        </div>
                        <div class="body-content-blog-details">
                            <div class="top-tag-time">
                                <div class="single">
                                    <i class="fa-solid fa-clock"></i>
                                    <span><?php echo get_the_date('d M, Y');?></span>
                                </div>
                                <div class="single">
                                    <i class="fa-solid fa-folder"></i>
                                    <span><?php the_category(', '); ?></span>
                                </div>
                            </div>
                            <h1 class="title"><?php the_title();?></h1>
                            <?php the_content();?>
                            <div class="tag-social-share-wrapper-area-wrapper">
                                <div class="tags-area">
                                    <span>Tags</span>
                                    <?php 
                                        $tags = get_the_tags();
                                        foreach($tags as $tag) {
                                            ?>
                                                <button><?php echo $tag->name;?></button>
                                            <?php 
                                        }
                                    ?>
                                </div>
                                <div class="social-icons">
                                    <span>Social Icon</span>

<?php
// Get current post data
$post_url   = urlencode( get_permalink() );
$post_title = urlencode( get_the_title() );

// Example share URLs
$facebook_url  = "https://www.facebook.com/sharer/sharer.php?u={$post_url}";
$twitter_url   = "https://twitter.com/intent/tweet?text={$post_title}&url={$post_url}";
$linkedin_url  = "https://www.linkedin.com/shareArticle?mini=true&url={$post_url}&title={$post_title}";
$whatsapp_url  = "https://api.whatsapp.com/send?text={$post_title}%20{$post_url}";
$pinterest_url = "https://pinterest.com/pin/create/button/?url={$post_url}&description={$post_title}";
?>
                                    <ul>
                                        <li><a href="<?php echo $facebook_url;?>"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="<?php echo $twitter_url;?>"><i class="fa-brands fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>

                            <?php
                                        global $post;
                                            $author_id = $post->post_author;

                                            $author_name = get_the_author_meta( 'display_name', $author_id );
                                            $author_bio  = get_the_author_meta( 'description', $author_id );
                                            $author_avatar = get_avatar( $author_id, 96 ); // 96 is the avatar size (px)
                                        ?>
                            <div class="blog-details-author">
                                <div class="thumbnail">
                                    <?php echo $author_avatar;?>
                                </div>
                                <div class="author-information">
                                    <span>
                                        Author
                                    </span>
                                    

                                        <h5 class="title"><?php echo $author_name;?></h5>
                                        <p>
                                            <?php echo $author_bio;?>
                                        </p>
                                    <div class="social">
                                        <ul>
                                            <li><a href="#"><i class="fa-brands fa-dribbble"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-replay-area-start">
                                <h3 class="title"><?php echo get_comments_number();?> Comments</h3>

<?php

if ( $post ) {
    $comments = get_comments( array(
        'post_id' => $post->ID,
        'status'  => 'approve', // Only approved comments
    ) );

    if ( $comments ) {
        foreach($comments as $comment) {
            ?>
<div class="single-comment-area mb--50">
        <div class="thumbanil">
            <?php echo get_avatar( $comment->user_id, 96 );?>
        </div>
        <div class="comment-information">
            <div class="top-area">
                <div class="left">
                    <span><?php echo get_comment_date( '', $comment ) ;?></span>
                    <h5 class="title"><?php echo $comment->comment_author;?></h5>
                </div>
            </div>
            <p class="disc">
                <?php echo $comment->comment_content;?>
            </p>
        </div>
    </div>
            <?php
        }

    ?>
    <?php 
    }
}
?>


                                <div class="contact-form-wrapper-1 mt--50">
                                    <h3 class="title mb--20">Add a Review</h3>
                                    <p>Your email address will not be published. Required fields are marked*</p>
                                    <form action="#" class="contact-form-1">
                                        <div class="contact-form-wrapper--half-area">
                                            <div class="single">
                                                <input type="text" placeholder="name*">
                                            </div>
                                            <div class="single">
                                                <input type="text" placeholder="Email*">
                                            </div>
                                        </div>
                                        <textarea name="message" placeholder="Write Message Here"></textarea>
                                        <button class="main-btn btn-primary mt--20">Submit Now</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 pl--60 order-lg-2 order-md-1 order-sm-1 order-1 pl_md--10 pl_sm--10 sticky-column-item">
                    <?php
                    if ( is_active_sidebar( 'main-sidebar' ) ) {
                        dynamic_sidebar( 'main-sidebar' );
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- blog sidebar area ends -->

    <?php include ('footer.php'); ?>