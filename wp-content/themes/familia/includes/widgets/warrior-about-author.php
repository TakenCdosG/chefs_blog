<?php
/**
 * About Author Widget
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

// Widgets
add_action( 'widgets_init', 'warrior_about_author_widget' );

// Register our widget
function warrior_about_author_widget() {
	register_widget( 'warrior_about_author' );
}

// Warrior Abou the Couple Widget
class warrior_about_author extends WP_Widget {

	//  Setting up the widget
	function warrior_about_author() {
		$widget_ops  = array( 'classname' => 'about_author', 'description' => __('Display a author description, avatar and social network icons.', 'familia') );
		$control_ops = array( 'id_base' => 'warrior_about_author' );

		$this->WP_Widget( 'warrior_about_author', __('Warrior About Author', 'familia'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $familia_option;

		extract( $args );

		$warrior_about_author_title	= apply_filters( 'widget_title', empty( $instance['warrior_about_author_title'] ) ?  __( 'About Me', 'familia' ) : $instance['warrior_about_author_title'], $instance, $this->id_base );
		
		echo $before_widget;
?>
        <?php echo $before_title . $warrior_about_author_title . $after_title; ?>
        
		<div class="blocks site-info">
			<?php if ( $familia_option['author_description'] || $familia_option['author_photo'] ) : ?>
				<div class="info">
					<?php if( $familia_option['author_avatar'] ) : ?>
						<p><img src="<?php echo esc_url( $familia_option['author_avatar']['url'] ); ?>" alt="" /></p>
					<?php endif; ?>

					<?php echo wpautop( esc_attr( $familia_option['author_description'] ) ); ?>
				</div>
			<?php endif; ?>
		</div>
<?php
	echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		global $shortname;

		$instance = $old_instance;

		$instance['warrior_about_author_title']	= apply_filters( 'widget_title', empty( $new_instance['warrior_about_author_title'] ) ? __( 'About Author', 'familia' ) : $new_instance['warrior_about_author_title'],  $instance, $this->id_base );

		return $instance;
	}

	function form( $instance ) {
		global $shortname;

		$instance = wp_parse_args( (array) $instance, array('warrior_about_author_title' => __('About Me', 'familia') ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_about_author_title' ); ?>"><?php _e('Widget Title:', 'familia'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_about_author_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_about_author_title' ); ?>" value="<?php echo esc_attr( $instance['warrior_about_author_title'] ); ?>" />
        </p>
		<p><?php printf( __('The data taken from <a href="%s" target="_blank">Theme Options</a>.', 'familia'), admin_url('admin.php?page=warriorpanel&tab=4') ); ?></p>
	<?php
	}
}
?>