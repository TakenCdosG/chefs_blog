<?php 
/**
 * The template for displaying comments
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
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();
			get_template_part( 'content-page' ); // get content template
		}
	} else {
		get_template_part( 'content', 'none' );
	}
	?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>