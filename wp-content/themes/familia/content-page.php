<?php
/**
 * The template for displaying posts in Page.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $familia_option;
?>

<article id="post-<?php the_ID(); ?>" class="blog-post hentry reglar-post">
	<div class="inner">

		<?php if ( ! is_single() && has_post_thumbnail() ) : ?>
			<div class="thumbnail">
				<span class="format-icon"></span>
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'blog-image' ); ?>
				</a>
			</div>
		<?php endif; ?>

		<?php if ( is_single() && $familia_option['display_featured_image'] ) : ?>
			<div class="thumbnail">
				<span class="format-icon"></span>
				<?php the_post_thumbnail( 'post-detail-image' ); ?>
			</div>
		<?php endif; ?>

		<header class="entry-header">
			<div class="page-title">					
				<h1><?php the_title(); ?></h1>
			</div>
		</header>
	</div>

	<div class="inner">
		<div class="entry-content">
			<?php 
			the_content();
			
			// Display post pagination
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'familia' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
			?>
		</div>
	</div>
</article>

<?php comments_template( '', true ); // display comments ?>