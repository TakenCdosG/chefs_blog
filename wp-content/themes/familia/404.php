<?php
/**
 * Template for displaying Page post type.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
?>

<?php get_header(); ?>

<div id="maincontent">

	<article class="blog-post hentry reglar-post">
		<div class="inner">
			<header class="entry-header not-found">
				<h1 class="post-title"><?php _e( 'Page Not Found !', 'familia' ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php _e( 'The page you are looking for is not available. The page may have been deleted or unpublished', 'familia' ); ?></p>
			</div>
		</div>
	</article>
</div> <!-- END: id maincontent  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>