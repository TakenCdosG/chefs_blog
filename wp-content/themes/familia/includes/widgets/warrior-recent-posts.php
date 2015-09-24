<?php
/**
 * Recent Posts Widgets
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
 
// Widgets
add_action( 'widgets_init', 'warrior_recent_posts_widget' );

// Register our widget
function warrior_recent_posts_widget() {
	register_widget( 'Warrior_Recent_Posts' );
}

// Warrior Latest Video Widget
class Warrior_Recent_Posts extends WP_Widget {

	//  Setting up the widget
	function Warrior_Recent_Posts() {
		$widget_ops  = array( 'classname' => 'warrior_recent_posts', 'description' => __( 'Display recent posts with thumbnails.', 'familia' ) );
		$control_ops = array( 'id_base' => 'warrior_recent_posts' );

		$this->WP_Widget( 'warrior_recent_posts', __( 'Warrior Recent Posts', 'familia' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $familia_option;
		
		extract( $args );

		$warrior_recent_posts_title = apply_filters( 'widget_title', empty( $instance['warrior_recent_posts_title'] ) ?  __( 'Recent Posts', 'familia' ) : $instance['warrior_recent_posts_title'], $instance, $this->id_base );
		$warrior_recent_posts_count = !empty( $instance['warrior_recent_posts_count'] ) ? absint( $instance['warrior_recent_posts_count'] ) : 4;
		$warrior_recent_title_limiter = !empty( $instance['warrior_recent_title_limiter'] ) ? absint( $instance['warrior_recent_title_limiter'] ) : 10;


		if ( !$warrior_recent_posts_count )
 			$warrior_recent_posts_count = 4;

		$args_recent_posts = array(
			'post_type' => 'post',
			'post_status' => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page' => $warrior_recent_posts_count
		);

		$warrior_recent_posts = new WP_Query();
		$warrior_recent_posts->query( $args_recent_posts );

		if ( $warrior_recent_posts->have_posts() ) :

		echo $before_widget; ?>

			<?php echo $before_title . $warrior_recent_posts_title . $after_title; ?>
			<div class="inner-widget">
				<ul>
					<?php while( $warrior_recent_posts->have_posts() ) : $warrior_recent_posts->the_post(); ?>
					<li>
						<article class="popular-post clearfix">
							<?php if ( has_post_thumbnail() ): ?>
								<div class="thumbnail">
									<?php the_post_thumbnail('thumbnail'); ?>
								</div>
							<?php endif; ?>
							<div class="detail">
								<h3 class="post-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo wp_trim_words( get_the_title(), $warrior_recent_title_limiter .' ...' ); ?></a>
								</h3>
								<span class="entry-meta"><?php echo date_i18n( 'F d, Y', strtotime( get_the_date('Y-m-d'), false ) ); ?></span>
							</div>
						</article>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>

		<?php echo $after_widget; 

		endif;
		wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['warrior_recent_posts_title'] 	= strip_tags( $new_instance['warrior_recent_posts_title'] );
		$instance['warrior_recent_posts_count']  	= (int) $new_instance['warrior_recent_posts_count'];
		$instance['warrior_recent_title_limiter']  	= (int) $new_instance['warrior_recent_title_limiter'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'warrior_recent_posts_title' => __( 'Recent Posts', 'familia' ), 'warrior_recent_posts_count' => '5', 'warrior_recent_title_limiter' => '10' ) );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_recent_posts_title' ); ?>"><?php _e( 'Widget Title:', 'familia' ); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_recent_posts_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_recent_posts_title' ); ?>" value="<?php echo esc_attr( $instance['warrior_recent_posts_title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_recent_posts_count' ); ?>"><?php _e( 'Number of posts to show:', 'familia' ); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_recent_posts_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_recent_posts_count' ); ?>" value="<?php echo esc_attr( $instance['warrior_recent_posts_count'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_recent_title_limiter' ); ?>"><?php _e( 'Post Title Limiter', 'familia' ); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_recent_title_limiter' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_recent_title_limiter' ); ?>" value="<?php echo esc_attr( $instance['warrior_recent_title_limiter'] ); ?>" />
            <p><small><?php _e( 'The post title will be trim after reaching the number of characters defined.', 'familia' ); ?></small></p>
        </p>
	<?php
	}
}
?>