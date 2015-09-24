<?php
/**
 * The Template for displaying pagination
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
?>

<?php global $wp_query, $familia_option; if( $wp_query->max_num_pages > 1 ) : ?>
<!-- Start: Pagination -->
<div class="pagination older-newer" >
	<?php
	// Check if WP Page-Navi plugin is installed and activated
	if( function_exists( 'wp_pagenavi' ) ) {
		wp_pagenavi();
	} else {
		previous_posts_link( '&#8592;'. __( 'Newer post', 'familia' ) );
		next_posts_link( __( 'Older Posts', 'familia' ) .'&#8594;' );
	}
	?>
</div>
<!-- End: Pagination -->
<?php endif; ?>