<?php
class Ekomart_Search_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'ekomart_search_widget', // Widget ID
            esc_html__( 'Ekomart Search', 'your-textdomain' ),
        );
    }

    // Output widget content on the front end
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        ?>
           <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <input type="search" name="s" placeholder="Search Here" required value="<?php echo get_search_query(); ?>">
            <button type="submit">
                <i class="fa-regular fa-magnifying-glass"></i>
            </button>
        </form>

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
function my_register_search_widget() {
    register_widget( 'Ekomart_Search_Widget' );
}
add_action( 'widgets_init', 'my_register_search_widget' );
?>
