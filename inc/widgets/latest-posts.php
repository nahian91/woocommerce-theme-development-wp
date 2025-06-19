<?php
class Ekomart_Post_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'ekomart_post_widget', // Widget ID
            esc_html__( 'Ekomart Latest Post', 'your-textdomain' ),
        );
    }

    // Output widget content on the front end
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        ?>

        <div class="latest-post-small-area-wrapper">
            <?php 
                $argm = array(
                    'post_type'      => 'post',
                    'posts_per_page' => 5,
                );

                $query = new WP_Query($argm);

                if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) { $query->the_post();
                    ?>
<!-- single latest post -->
                            <div class="single-latest-post-area">
                                <a href="<?php the_permalink();?>" class="thumbnail">
                                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                                </a>
                                <div class="inner-content-area">
                                    <div class="icon-top-area">
                                        <i class="fa-light fa-clock"></i>
                                        <span><?php echo get_the_date('d M, Y');?></span>
                                    </div>
                                    <a href="#">
                                        <h5 class="title-sm-blog">
                                            <?php the_title(); ?>
                                        </h5>
                                    </a>
                                </div>
                            </div>
                    <?php 
                    
                } }
            ?>
        </div>
           
        <?php 

        echo $args['after_widget'];
    }

    // Widget admin form
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'your-textdomain' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
                <?php esc_attr_e( 'Title:', 'your-textdomain' ); ?>
            </label> 
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
                   type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <?php
    }

    // Update widget settings
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
}

// Register the widget
function ekomart_post_custom_widget() {
    register_widget( 'Ekomart_Post_Widget' );
}
add_action( 'widgets_init', 'ekomart_post_custom_widget' );
?>
