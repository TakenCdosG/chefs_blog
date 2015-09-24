<?php
/**
 * The template for displaying posts in the search results.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
?>

<?php get_header(); ?>

<div id="maincontent">
	<?php if( is_archive() || is_search() ) : ?>
		<header class="archive-header article-widget">
			<h2 class="archive-title"><?php echo warrior_archive_title(); ?></h2>
		</header>
	<?php endif; ?>
	
	<?php
	// The loop
	if ( have_posts() ) {

		while ( have_posts() ) {

			the_post();

			get_template_part( 'content', get_post_format() ); // get content template
		}
		get_template_part( 'includes/pagination' ); // display pagination

	} else { ?>

		<p><?php _e( 'Sorry, no result found.', 'familia' ); ?></p>

	<?php } ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>