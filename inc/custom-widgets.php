<?php
/**
 * Sample implementation of the Custom Widgets
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Default Theme
 */

// Register the custom widget
function custom_author_books_widget_register() {
    register_widget( 'Custom_Author_Books_Widget' );
}
add_action( 'widgets_init', 'custom_author_books_widget_register' );

// Create the custom widget class
class Custom_Author_Books_Widget extends WP_Widget {

    // Widget constructor
    function __construct() {
        parent::__construct(
            'custom_author_books_widget',
            __( 'Custom Author Books Widget', 'text_domain' ),
            array( 'description' => __( 'Displays books from a chosen author', 'text_domain' ), )
        );
    }

    // Widget frontend
    public function widget( $args, $instance ) {
        $author_id = isset( $instance['author'] ) ? $instance['author'] : '';
        $num_books = isset( $instance['num_books'] ) ? $instance['num_books'] : 5;
        
        echo $args['before_widget'];
        
        if ( ! empty( $author_id ) ) {
            $author = get_term( $author_id, 'author' );
            
            $author_books = new WP_Query( array(
                'post_type' => 'book',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'author',
                        'field'    => 'id',
                        'terms'    => $author_id,
                    ),
                ),
                'posts_per_page' => $num_books,
            ) );

            if ( $author_books->have_posts() ) {
                echo $args['before_title']. 'Books of ' . $author->name . $args['after_title'];
                echo '<ul>';
                while ( $author_books->have_posts() ) {
                    $author_books->the_post();
                    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                }
                echo '</ul>';
                wp_reset_postdata();
            } else {
                echo '<p>No books found for this author.</p>';
            }
        } else {
            echo '<p>Please select an author.</p>';
        }

        echo $args['after_widget'];
    }

    // Widget backend
    public function form( $instance ) {
        $author_id = ! empty( $instance['author'] ) ? $instance['author'] : '';
        $num_books = ! empty( $instance['num_books'] ) ? $instance['num_books'] : 5;
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'author' ); ?>">Select Author:</label>
            <select class="widefat" id="<?php echo $this->get_field_id( 'author' ); ?>" name="<?php echo $this->get_field_name( 'author' ); ?>">
                <?php
                // Get authors
                $authors = get_terms( array(
                    'taxonomy' => 'author',
                    'hide_empty' => false,
                ) );
                foreach ( $authors as $author ) {
                    printf( '<option value="%s" %s>%s</option>', $author->term_id, selected( $author_id, $author->term_id, false ), $author->name );
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'num_books' ); ?>">Number of Books to Display:</label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'num_books' ); ?>" name="<?php echo $this->get_field_name( 'num_books' ); ?>" type="number" value="<?php echo esc_attr( $num_books ); ?>" />
        </p>
        <?php
    }

    // Widget update
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['author'] = ( ! empty( $new_instance['author'] ) ) ? sanitize_text_field( $new_instance['author'] ) : '';
        $instance['num_books'] = ( ! empty( $new_instance['num_books'] ) ) ? absint( $new_instance['num_books'] ) : 5;

        return $instance;
    }
}