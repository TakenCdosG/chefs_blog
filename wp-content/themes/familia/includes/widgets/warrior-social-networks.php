<?php
/**
 * Widgets social networks
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
 
// Widgets
add_action( 'widgets_init', 'warrior_social_networks' );

// Register our widget
function warrior_social_networks() {
	register_widget( 'Warior_Social_Networks' );
}

// Warrior Latest Video Widget
class Warior_Social_Networks extends WP_Widget {

	// Setting up the widget
	function Warior_Social_Networks() {
		$widget_ops  = array( 'classname' => 'warrior_social_button', 'description' => __( 'Display social button', 'familia' ) );
		$control_ops = array( 'id_base' => 'warrior_social_button' );

		$this->WP_Widget( 'warrior_social_button', __( 'Warrior Social Networks', 'familia' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $familia_option;
		
		extract( $args );

		$warrior_social_button_title = apply_filters('widget_title', empty( $instance['warrior_social_button_title'] ) ? __( 'Social Network', 'familia' ) : $instance['warrior_social_button_title'], $instance, $this->id_base );

		echo $before_widget;
		echo $before_title . $warrior_social_button_title . $after_title;
?>
		<div class="inner-widget">
			<?php get_template_part( 'includes/social-button' ); // display social button ?>
		</div>

		<?php echo $after_widget;

		wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['warrior_social_button_title'] = strip_tags( $new_instance['warrior_social_button_title'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array('warrior_social_button_title' => __('Get in Touch', 'familia') ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_social_button_title' ); ?>"><?php _e('Widget Title:', 'familia'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_social_button_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_social_button_title' ); ?>" value="<?php echo esc_attr( $instance['warrior_social_button_title'] ); ?>" />
        </p>
	<?php
	}
}
?>