<?php
/**
 * Template for displaying author.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
?>

<?php get_header(); ?>

<div id="maincontent">
	<?php
	get_template_part( 'includes/author-bio' ); // display author description
	// The loop
	if ( have_posts() ) {
		get_template_part( 'includes/breadcrumb' ); // display breadcrumb
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() ); // get content template
		}
		get_template_part( 'includes/pagination' ); // display pagination
	}
	?>
</div> <!-- END: id maincontent  -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>