<?php
/**
 * Popular Posts Widgets
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
 
// Widgets
add_action( 'widgets_init', 'warrior_popular_posts_widget' );

// Register our widget
function warrior_popular_posts_widget() {
	register_widget( 'Warrior_popular_Posts' );
}

// Warrior Latest Video Widget
class Warrior_popular_Posts extends WP_Widget {

	//  Setting up the widget
	function Warrior_popular_Posts() {
		$widget_ops  = array( 'classname' => 'warrior_popular_posts', 'description' => __( 'Display popular articles post type.', 'familia' ) );
		$control_ops = array( 'id_base' => 'warrior_popular_posts' );

		$this->WP_Widget( 'warrior_popular_posts', __( 'Warrior Popular Posts', 'familia' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $familia_option;
		
		extract( $args );

		$warrior_popular_posts_title = apply_filters('widget_title', empty( $instance['warrior_popular_posts_title'] ) ? __( 'Popular Posts', 'familia' ) : $instance['warrior_popular_posts_title'], $instance, $this->id_base );
		$warrior_popular_posts_count = !empty( $instance['warrior_popular_posts_count'] ) ? absint( $instance['warrior_popular_posts_count'] ) : 5;
		$warrior_popular_title_limiter = !empty( $instance['warrior_popular_title_limiter'] ) ? absint( $instance['warrior_popular_title_limiter'] ) : 10;

		if ( !$warrior_popular_posts_count )
 			$warrior_popular_posts_count = 5;

		echo $before_widget; ?>
        	<?php echo $before_title . $warrior_popular_posts_title . $after_title; ?>
		 	<div class="inner-widget">
				<ul>
					<?php
						global $post;
						// Get the posts from database
						$args = array(
							'post_type' 			=> 'post',
							'post_status' 			=> 'publish',
							'ignore_sticky_posts' 	=> 1,
							'meta_key' 				=> 'post_views_count',
							'orderby' 				=> 'meta_value_num',
							'meta_query' => array(
								array(
									'key'  => 'post_views_count'
								),
							),	
							'order'					=> 'desc',
							'posts_per_page' 		=> $warrior_popular_posts_count
						);

						$wp_query = new WP_Query();
						$wp_query->query( $args );
					       
					    if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();  
				    ?>
							<li>
				    			<article class="popular-post clearfix">
									<?php if ( has_post_thumbnail() ): ?>
										<div class="thumbnail">
											<?php the_post_thumbnail('thumbnail'); ?>
										</div>
									<?php endif; ?>

									<div class="detail">
										<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $warrior_popular_title_limiter .' ...' ); ?></a></h3>
										<div class="entry-meta">
											<span><?php echo date_i18n( 'F d, Y', strtotime( get_the_date('Y-m-d'), false ) ); ?></span>
										</div>
									</div>
								</article>
							</li>
					<?php endwhile; else: _e( 'Not have popular posts !', 'familia' ); endif; ?>
				</ul>
			</div>
		<?php echo $after_widget;

		wp_reset_postdata();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['warrior_popular_posts_title'] 	= strip_tags( $new_instance['warrior_popular_posts_title'] );
		$instance['warrior_popular_posts_count']  	= (int) $new_instance['warrior_popular_posts_count'];
		$instance['warrior_popular_title_limiter']  = (int) $new_instance['warrior_popular_title_limiter'];

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'warrior_popular_posts_title' => __( 'Popular Articles', 'familia' ), 'warrior_popular_posts_count' => '5', 'warrior_popular_title_limiter' => '10') );
	?>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_popular_posts_title' ); ?>"><?php _e( 'Widget Title:', 'familia' ); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_popular_posts_title' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_popular_posts_title' ); ?>" value="<?php echo esc_attr( $instance['warrior_popular_posts_title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_popular_posts_count' ); ?>"><?php _e('Number of posts to show:', 'familia'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_popular_posts_count' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_popular_posts_count' ); ?>" value="<?php echo esc_attr( $instance['warrior_popular_posts_count'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'warrior_popular_title_limiter' ); ?>"><?php _e('Post Title Limiter', 'familia'); ?></label>
            <input type="text" id="<?php echo $this->get_field_id( 'warrior_popular_title_limiter' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'warrior_popular_title_limiter' ); ?>" value="<?php echo esc_attr( $instance['warrior_popular_title_limiter'] ); ?>" />
            <p><small><?php _e( 'The post title will be trim after reaching the number of characters defined.', 'familia' ); ?></small></p>
        </p>
	<?php
	}
}
?>