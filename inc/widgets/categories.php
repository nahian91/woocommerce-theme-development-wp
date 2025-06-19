<?php
class Ekomart_Categories_Widget extends WP_Widget {

    // Constructor
    public function __construct() {
        parent::__construct(
            'ekomart_categories_widget', // Widget ID
            esc_html__( 'Ekomart Categories', 'your-textdomain' ),
        );
    }

    // Output widget content on the front end
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        ?>
            <div class="category-main-wrapper">
                <?php 
                    $categories = get_categories();
        foreach($categories as $cat) {
            ?>
                <div class="single-category-area">
                    <p><a href="<?php echo get_category_link( $cat->term_id );?>"><?php echo $cat->name;?></a></p>
                </div>
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
function my_register_custom_widget() {
    register_widget( 'Ekomart_Categories_Widget' );
}
add_action( 'widgets_init', 'my_register_custom_widget' );
?>
