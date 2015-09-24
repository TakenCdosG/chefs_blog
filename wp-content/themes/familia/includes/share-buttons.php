<?php
/**
 * Template to display sharing buttons
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $familia_option;

if( $familia_option['share_buttons'] ) : ?>
	<!-- Start: Share Buttons -->
	<div class="share-widget">
		<ul>
			<li>
				<a class="zocial facebook" title="<?php _e( 'Facebook Share', 'familia' ); ?>" target="_blank" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&amp;t=<?php echo str_replace( ' ', '%20', get_the_title() ); ?>"><?php _e('Facebook', 'familia'); ?></a>
			</li>

			<li>
				<a class="zocial twitter" title="<?php _e( 'Twitter Share', 'familia' ); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&amp;shortened_url=<?php echo get_home_url() .'/?p='. $post->ID; ?>&amp;text=<?php echo str_replace( ' ', '%20', get_the_title() ); ?>"><?php _e('Twitter', 'familia'); ?></a>
			</li>

			<li>
				<a class="zocial googleplus" title="<?php _e( 'Google+ Share', 'familia' ); ?>" target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><?php _e('Google+', 'familia'); ?></a>
			</li>

			<li>
				<a class="zocial pinterest" title="<?php _e( 'Pinterest Share', 'familia' ); ?>" target="_blank" href="http://pinterest.com/pin/create/button/?source_url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><?php _e('Pinterest', 'familia'); ?></a>
			</li>
		</ul>
	</div>
	<!-- End: Share Buttons -->
<?php endif; ?>