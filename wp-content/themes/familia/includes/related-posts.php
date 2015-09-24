<?php
/**
 * Template for displaying related posts.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
global $familia_option;

if( $familia_option['related_posts'] ) :

// get the categories
$categories = get_the_category();
$cat_ids = array();
foreach( $categories as $category ) $cat_ids[] = $category->term_id;

$args = array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'orderby' => 'rand',
	'category__in' => $cat_ids,
	'post__not_in' => array( get_the_ID() ),
	'posts_per_page' => 3
);

$posts_related = new WP_Query();
$posts_related->query( $args );

if ( $posts_related->have_posts() ) : ?>

	<div class="article-widget">
		<h4 class="widget-title"><span><?php _e( 'Related', 'familia' ); ?> <b><?php _e( 'Articles', 'familia' ); ?></b></span></h4>
		<div class="related-article-widget">
		<ul>
		<?php while( $posts_related->have_posts() ) : $posts_related->the_post(); ?>
			<li>
    			<?php if ( has_post_thumbnail() ): ?>
					<div class="thumbnail">
						<?php the_post_thumbnail( 'small-thumb-1' ); ?>
					</div>
				<?php else: ?>
					<div class="thumbnail">
						<img src="http://placehold.it/242x172/333333/ffffff&amp;text=&nbsp;" />
					</div>
				<?php endif; ?>
                <div class="detail">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>
			</li>
		<?php endwhile; wp_reset_postdata(); ?>
		</ul>
		<div class="clearfix"></div>
		</div>
	</div>
		
<?php 
	endif; 
endif; 
?>