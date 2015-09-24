<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
?>

<?php get_header(); ?>

<?php
// display featured posts
if ( is_home() || is_front_page() ) {
	get_template_part('includes/featured-posts');
}
?>

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
		get_template_part( 'includes/pagination' );

	} else {
		get_template_part( 'content', 'none' );
	}
	?>
</div>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>