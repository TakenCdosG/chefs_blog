<?php
/**
 * The template for displaying posts in the Status post format.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $familia_option;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'status blog-post hentry reglar-post' ); ?>>
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

		<div class="<?php if ( has_post_thumbnail() ) { echo 'detail';} else { echo 'detail no-thumbnail';}?>">
			<header class="entry-header">
				<div class="post-category"><?php the_category(', ') ?></div>
				<?php if( ! is_single() ): ?>
					<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php else: ?>
					<h1 class="post-title"><?php the_title(); ?></h1>
				<?php endif; ?>

				<div class="entry-meta">
					<?php warrior_post_meta(); // display post meta ?>
				</div>
			</header>
		
			<div class="entry-content">
				<?php
				if ( is_single() ) {
					the_content();

					// Display post pagination
					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'familia' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					) );
				} else {
					the_excerpt();
				}
				?>
			</div>
		</div>

		<?php if ( is_single() ): ?>
			<footer class="post-footer">
				<div class="entry-meta tags">
					<?php the_tags( '<span><i class="icon icon-tags"></i><b>'. __( 'Tags:', 'familia' ) .'</b></span>', ',&nbsp;', '' ); ?>
				</div>
					
				<?php get_template_part( 'includes/share-buttons' ); // display share buttons ?>
			</footer>
		<?php endif; ?>

	</div>
</article>