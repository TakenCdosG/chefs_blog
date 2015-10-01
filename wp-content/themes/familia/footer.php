<?php
/**
 * The template for displaying footer section.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $familia_option;

?>

		</div>
		<!-- End: Container -->
	</div>
	<!-- End: Primary -->

	<!-- Start: Footer -->
	<footer id="colophone">
		<?php if ( function_exists( 'display_instagram' ) ) : ?>
			<div id="instagram-feed-widget" class="clearfix">
				<div class="heading">
					<div class="container">
						<h4 class="widget-title"><span><?php _e( 'Instagram', 'familia' ) ?> <b><?php _e( 'Feeds', 'familia' ) ?></b></span></h4>
					</div>
				</div>

				<div class="instagram-feeds">
					<?php
					// Instagram Feed
					if ( shortcode_exists( 'instagram-feed' ) ) {
					    echo do_shortcode( '[instagram-feed]' ); // load instagram feed shortcode
					}
					?>
				</div>
			</div>
		<?php endif; ?>

		<div id="footer-widgets" class="clearfix">
			<div class="container">
				<div class="footer-widgets">
					<?php
					// Load footer widgets
					if ( is_active_sidebar('warrior-footer') ) {
						dynamic_sidebar( 'warrior-footer' );
					} else {
						echo '<div class="container"><p class="no-widget">';
						_e( 'There\'s no widget assigned. You can start assigning widgets to "Footer" widget area from the <a href="'. admin_url('/widgets.php') .'">Widgets</a> page.', 'familia' );
						echo '</p></div>';
					}
					?>
				</div>
			</div>
		</div>

		<?php echo get_template_part( 'includes/social-profiles' ); // load social media icons ?>

		<div id="footer-bottom">
			<div class="container">
				<span><?php printf( __('&copy; Copyright %1$s %2$s.', 'familia' ), date_i18n('Y', strtotime( get_the_date() ) ), get_bloginfo('name') ); ?></span>
				<span class="author">Theme by <a href="http://thinkcreativegroup.com/" target="_blank" title="ThinkCreativeGroup"><span>ThinkCreativeGroup</span></a> Powered by WordPress</span>
			</div>
		</div>
	</footer>
	<!-- End: Footer -->
</div>

<?php
// Load custom CSS from theme options
if( isset( $familia_option['custom_css'] ) ) {
    echo '<style type="text/css">';
    echo esc_attr($familia_option['custom_css']);
    echo '</style>';
}
?>

<?php wp_footer(); ?>

</body>
</html>