<?php
/**
 * Template for displaying featured posts.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $familia_option;

if( $familia_option['display_featured_post'] ):

if( ! isset( $familia_option['featured_post_cat'] ) ) {
	$cat_list = '';
} else {
	$cat_list = implode( ',', (array)$familia_option['featured_post_cat'] );
}

// Get the items
$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'cat' => $cat_list ,
	'ignore_sticky_posts' => 1,
	'showposts' => 5
);

$featured_posts = new WP_Query();
$featured_posts->query( $args );

    $top_image = get_field("top_image", 714);

if ( $featured_posts->have_posts() ) :
?>

    <?php if (!empty($top_image)): ?>
<div id="top-image">
    <img width="" height="" src="<?php echo $top_image; ?>" class="img-responsive" alt="" title="">
</div>
<?php endif; ?>

<div id="featured-posts" class="clearfix">
<div class="preload"></div>	
	<?php $i = 1; while( $featured_posts->have_posts() ) : $featured_posts->the_post(); ?>
	<?php if ($i == 1) : ?>
		<div class="featured-left">
			<article id="featured-post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="thumbnail">
					<div class="overlay"></div>
					<?php
					// Featured image
					if ( has_post_thumbnail() ) {
						echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'">';
						the_post_thumbnail('featured-post-image');
						echo '</a>';
					} else {
						echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'">';
						echo '<img src="http://placehold.it/420x250&text=&nbsp;" />';
						echo '</a>';
					}
					?>

					<div class="detail">
						<div class="category"><span><?php the_category(', '); ?></span></div>
						<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo wp_trim_words( get_the_title(), 12, '...' ); ?></a></h2>
					</div>
					<div class="bg-opacity"></div>
				</div>
			</article>
		</div>

	<?php else : ?>
		
		<?php if ( $featured_posts->post_count > 1 && $i == 2 ) : ?>
			<div class="featured-right">
		<?php endif; ?>
		
			<article id="featured-post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="thumbnail">
					<div class="overlay"></div>
					<?php
					// Featured image
					if ( has_post_thumbnail() ) {
						echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'">';
						the_post_thumbnail('featured-post-thumb-image');
						echo '</a>';
					} else {
						echo '<a href="'. get_permalink() .'" title="'. get_the_title() .'">';
						echo '<img src="http://placehold.it/420x250&text=&nbsp;" />';
						echo '</a>';
					}
					?>

					<div class="detail">
                        <?php $category_list = get_the_category_list( $separator = ', '); ?>
                        <?php $category_list = explode(', ', $category_list); ?>
						<div class="category"><span><?php echo $category_list[0]; ?></span></div>
						<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo wp_trim_words( get_the_title(), $familia_option['featured_post_word_count'], '...' ); ?></a></h2>
					</div>
					<div class="bg-opacity"></div>
				</div>
			</article>
		<?php if ( $featured_posts->post_count > 1 && $i == $featured_posts->post_count ) : ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php $i = $i + 1; endwhile; ?>
	<?php wp_reset_postdata(); ?>
</div>
<?php endif; endif; ?>