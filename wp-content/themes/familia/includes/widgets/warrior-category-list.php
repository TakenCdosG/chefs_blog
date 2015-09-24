<?php
/**
 * Widgets list category
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
 
// Widgets
add_action( 'widgets_init', 'warrior_category_widget' );

// Register our widget
function warrior_category_widget() {
	register_widget( 'Warrior_Category_List' );
}

// Warrior Latest Video Widget
class Warrior_Category_List extends WP_Widget {

	//  Setting up the widget
	function Warrior_Category_List() {
		$widget_ops  = array( 'classname' => 'warrior_category_list', 'description' => __( 'Display custom category list', 'familia' ) );
		$control_ops = array( 'id_base' => 'warrior_category_list' );

		$this->WP_Widget( 'warrior_category_list', __( 'Warrior Category List', 'familia' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $familia_option;
		
		extract( $args );

		$warrior_category_list_title = apply_filters( 'widget_title', empty( $instance['warrior_category_list_title'] ) ? __( 'Category', 'familia' ) : $instance['warrior_category_list_title'], $instance, $this->id_base );

		echo $before_widget;
			
			echo $before_title . $warrior_category_list_title . $after_title;
			echo '<div class="inner-widget">';

				$taxonomy = 'category';
				// $tax_terms = get_terms( $taxonomy );
				echo '<ul>';
					$a = 1;
					$tax_terms = get_categories();
					foreach ( $tax_terms as $tax_term ) {
						echo '<li class="category-list"><div class="number">'. $a++ .'.</div>' . '<a class="detail" href="' . esc_url( get_term_link( $tax_term, $taxonomy ) ) . '" title="' . sprintf( __( 'View all posts in %s', 'familia' ), $tax_term->name ) . '" ' . '><h3 class="category-name">' . $tax_term->name.'</h3><div class="entry-meta">'.$tax_term->category_count . __( ' Articles', 'familia' ) .'</div></a></li>';
					}

				echo '</ul>';
			echo '</div>';

		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['warrior_category_list_title'] 	= strip_tags( $new_instance['warrior_category_list_title'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'warrior_category_list_title' => __( 'Category List', 'familia' ) ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_category_list_title' ); ?>"><?php _e('Widget Title:', 'familia'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_category_list_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_category_list_title' ); ?>" value="<?php echo esc_attr( $instance['warrior_category_list_title'] ); ?>" />
        </p>
	<?php
	}
}
?>