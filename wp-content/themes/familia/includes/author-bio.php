<?php
/**
 * Template for displaying author bio.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $post, $familia_option;;

if( $familia_option['display_author_'] ) :
?>
<div class="article-widget">
	<h4 class="widget-title"><span><?php _e( 'About the', 'familia' ); ?><b><?php _e( ' Author', 'familia' ); ?></b></span></h4>
	<div class="about-author-widget">
		<div class="thumbnail">
			<?php echo get_avatar( $post->post_author, '120' ); ?>
		</div>

		<div class="detail">
			<header class="author-widget-header">
				<h5><?php the_author(); ?></h5>
				<div class="author-summary">
					<span><?php _e( 'Author with', 'familia' ); ?></span> <span><?php the_author_posts(); ?> <?php _e( 'posts', 'familia' ); ?></span>
				</div>
				<?php if( !is_author() ) : ?>
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="author-button"><?php _e( 'More about ', 'familia' ); the_author(); ?></a>
				<?php endif; ?>
			</header>
			<div class="entry-content">
				<?php echo wpautop( esc_attr( get_the_author_meta( 'description', $post->post_author ) ) ); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>