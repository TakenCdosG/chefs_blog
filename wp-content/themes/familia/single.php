<?php
/**
 * The template for displaying single posts
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
?>

<?php get_header(); ?>

<div id="maincontent">
	<?php
	// The loop
	if ( have_posts() ) { //check if there is a post
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() );// get content template
			get_template_part( 'includes/author-bio' ); // display author description
			get_template_part( 'includes/related-posts' ); // display related posts
			comments_template( '', true ); // display comments
			warrior_set_post_views( get_the_ID() ); //get post view count
		}
	} else {
		get_template_part( 'content', 'none' ); // display 404 pages
	}
	?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>