<?php
/**
 * The template for displaying posts in the Quote post format.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post hentry quote-post' ); ?>>
	<div class="inner">
		<div class="entry-content">
			<blockquote>
				<?php the_content(); ?>	
				<cite><a href="<?php the_permalink(); ?>"><?php echo the_title(); ?></a></cite>
			</blockquote>
		</div>
	</div>
</article>