<?php
class Ekomart_Tags_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'ekomart_tags_widget', // Widget ID
            esc_html__( 'Ekomart Tags', 'your-textdomain' ),
        );
    }

    // Output widget content on the front end
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        ?>
           <div class="tags-area-blog-short-main">
            <?php 
                $tags = get_tags();
                foreach($tags as $tag) {
                    ?>
                        <button class="single-category"><a href="<?php echo get_tag_link( $tag->term_id );?>"><?php echo $tag->name;?></a></button>
                    <?php
                }
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
function my_register_tags_widget() {
    register_widget( 'Ekomart_Tags_Widget' );
}
add_action( 'widgets_init', 'my_register_tags_widget' );
?>
