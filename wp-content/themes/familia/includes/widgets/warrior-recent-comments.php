<?php
/**
 * Recent Comments Widgets
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
 
// Widgets
add_action( 'widgets_init', 'warrior_recent_comments_widget' );

// Register our widget
function warrior_recent_comments_widget() {
	register_widget( 'Warrior_Recent_Comments' );
}

// Warrior Recent Comments Widget
class Warrior_Recent_Comments extends WP_Widget {

	//  Setting up the widget
	function Warrior_Recent_Comments() {
		$widget_ops  = array( 'classname' => 'warrior_recent_comments', 'description' => __('Display recent comments with avatar.', 'familia') );
		$control_ops = array( 'id_base' => 'warrior_recent_comments' );

		$this->WP_Widget( 'warrior_recent_comments', __('Warrior Recent Comments', 'familia'), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $familia_option;
		
		extract( $args );

		$warrior_recent_comments_title = apply_filters( 'widget_title',empty( $instance['warrior_recent_comments_title'] ) ? __( 'Recent Comments', 'familia' ) : $instance['warrior_recent_comments_title'], $instance, $this->id_base );
		$warrior_recent_comments_count = !empty( $instance['warrior_recent_comments_count'] ) ? absint( $instance['warrior_recent_comments_count'] ) : 4;
		$warrior_recent_excerpt_count = !empty( $instance['warrior_recent_excerpt_count'] ) ? absint( $instance['warrior_recent_excerpt_count'] ) : 90;


		if ( !$warrior_recent_comments_count )
 			$warrior_recent_comments_count = 4;
?>
        <?php echo $before_widget; ?>
        <?php echo $before_title . $warrior_recent_comments_title . $after_title; ?>

		<?php 
			$args = array(
				'status' => 'approve',
				'number' => $warrior_recent_comments_count
			);
			$comments = get_comments($args);
		?>
		<ul class="recent-comments-widget">
		<?php foreach ($comments as $comment) { ?>
		    <li class="recent-comments-wrapper">
		    	<div class="comments-avatar">
		    		<?php echo get_avatar( $comment, '50' ); ?>
		    	</div>
		    	<div class="detail">
			    	<a href="<?php echo get_permalink($comment->comment_post_ID); ?>#comment-<?php echo $comment->comment_ID; ?>" rel="external nofollow">
				    	<?php echo '<span class="recommauth">' . ($comment->comment_author) . '</span>'; ?> 
				    </a>	
			        <p><?php echo wp_html_excerpt( $comment->comment_content, $warrior_recent_excerpt_count, '...' ); ?></p>
		        </div>
		    </li>
		<?php } ?>
		</ul>

		<?php echo $after_widget; ?>
<?php

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['warrior_recent_comments_title'] 	= strip_tags( $new_instance['warrior_recent_comments_title'] );
		$instance['warrior_recent_comments_count']  = (int) $new_instance['warrior_recent_comments_count'];
		$instance['warrior_recent_excerpt_count']  	= (int) $new_instance['warrior_recent_excerpt_count'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array('warrior_recent_comments_title' => __('Recent Comments', 'familia'), 'warrior_recent_comments_count' => '5', 'warrior_recent_excerpt_count' => '90') );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_recent_comments_title' ); ?>"><?php _e('Widget Title:', 'familia'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_recent_comments_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_recent_comments_title' ); ?>" value="<?php echo esc_attr( $instance['warrior_recent_comments_title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_recent_comments_count' ); ?>"><?php _e('Number of comments to show:', 'familia'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_recent_comments_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_recent_comments_count' ); ?>" value="<?php echo esc_attr( $instance['warrior_recent_comments_count'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_recent_excerpt_count' ); ?>"><?php _e('Comments Excerpt Limiter', 'familia'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_recent_excerpt_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_recent_excerpt_count' ); ?>" value="<?php echo esc_attr( $instance['warrior_recent_excerpt_count'] ); ?>" />
            <p><small><?php _e('The comment excerpt in the first comment will be trim after reaching the number of characters defined.', 'familia'); ?></small></p>
        </p>
	<?php
	}
}
?>