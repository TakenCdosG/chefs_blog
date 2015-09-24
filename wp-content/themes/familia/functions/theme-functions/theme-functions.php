<?php
/**
 * Function to collect the title of the current page
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
if ( ! function_exists( 'warrior_archive_title' ) ) {
	function warrior_archive_title() {
		global $wp_query;

		$title = '';
		if ( is_category() ) :
			$title = sprintf( __( '%s <span>Category Archives</span>', 'familia' ), single_cat_title( '', false ) );
		elseif ( is_tag() ) :
			$title = sprintf( __( '%s <span>Tag Archives</span>', 'familia' ), single_tag_title( '', false ) );
		elseif ( get_post_format() ) :
			$title = sprintf( __( 'Post Format: %s', 'familia' ), get_post_format_string( get_post_format() ) );
		elseif ( is_day() ) :
			$title = sprintf( __( '%s <span>Daily Archives</span>', 'familia' ), date_i18n( 'd', strtotime( get_the_date('Y-m-d'), false ) ) );
		elseif ( is_month() ) :
			$title = sprintf( __( '%s <span>Monthly Archives</span>', 'familia' ), date_i18n( 'F', strtotime( get_the_date('Y-m-d'), false ) ) );
		elseif ( is_year() ) :
			$title = sprintf( __( '%s <span>Yearly Archives</span>', 'familia' ), date_i18n( 'F', strtotime( get_the_date('Y-m-d'), false ) ) );
		elseif ( is_author() ) :
			$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
			$title = sprintf( __( '%s <span>Author Archives</span>', 'familia' ), get_the_author_meta( 'display_name', $author->ID ) );
		elseif ( is_search() ) :
			if ( $wp_query->found_posts ) {
				$title = sprintf( __( 'Search Results for: "%s"', 'familia' ), esc_attr( get_search_query() ) );
			} else {
				$title = sprintf( __( 'No Results for: "%s"', 'familia' ), esc_attr( get_search_query() ) );
			}
		elseif ( is_404() ) :
			$title = __( 'Not Found', 'familia' );
		elseif ( is_home() || is_front_page() || is_single() ) :
			$title = '';
		else :
			$title = __( 'Blog', 'familia' );
		endif;
		
		return $title;
	}
}


/**
 * Function to load comment list
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
if ( ! function_exists( 'warrior_comment_list' ) ) {
	function warrior_comment_list( $comment, $args, $depth ) {
		global $post;
		$author_post_id = $post->post_author;
		$GLOBALS['comment'] = $comment;

		// Allowed html tags will be display
		$allowed_html = array(
			'a' => array( 'href' => array(), 'title' => array() ),
			'abbr' => array( 'title' => array() ),
			'acronym' => array( 'title' => array() ),
			'strong' => array(),
			'b' => array(),
			'blockquote' => array( 'cite' => array() ),
			'cite' => array(),
			'code' => array(),
			'del' => array( 'datetime' => array() ),
			'em' => array(),
			'i' => array(),
			'q' => array( 'cite' => array() ),
			'strike' => array(),
			'ul' => array(),
			'ol' => array(),
			'li' => array()
		);
		
		switch ( $comment->comment_type ) :
			case '' :
	?>
		
			<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
			<div class="main-comment">
				<div class="thumbnail">
					<?php echo get_avatar( $comment, 60 ); ?>
				</div>

				<div class="comment-meta">
					<span class="author"><?php comment_author(); ?></span>
					<span class="date"><?php echo get_comment_date( 'F d, Y h.i a' ); ?></span>
				</div>

				<div class="clearfix"></div>
				
				<div class="detail">
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<p class="moderate"><?php _e( 'Your comment is now awaiting moderation before it will appear on this post.', 'familia' );?></p>
					<?php endif; ?>
					<?php echo apply_filters( 'comment_text', wp_kses( get_comment_text(), $allowed_html ) );  ?>

					<div class="reply">
					<?php echo comment_reply_link( array( 'reply_text' => __( 'Reply', 'familia' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) );  ?>&nbsp;	
					<span class="edit-link"><?php edit_comment_link( __( 'Edit', 'familia' ), '', '' ); ?></span>
					</div><!-- .reply -->
				</div>
			</li><!-- -->

	<?php
			break;
			case 'pingback'  :
			case 'trackback' :
	?>
				<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
					<div class="comment-box clearfix">
						<div class="author">
							<a href="<?php comment_author_url()?>"><?php _e('Pingback', 'familia'); ?></a>
						</div>
						<div class="comment-body">
							<?php comment_author(); ?>
						</div>
						<div class="meta">
							<?php comment_date(); echo ' - '; comment_time(); ?>
							<span class="edit-link"><?php edit_comment_link(__('<i class="fa fa-edit"></i> Edit Comment', 'familia'), '', ''); ?></span>
						</div>
						<hr class="comment-line"/>
					</div>
				</li>	
	<?php
			break;
		endswitch;
	}
}


if ( ! function_exists( 'warrior_comment_form_top' ) ) {
	function warrior_comment_form_top() {
}
	add_action( 'comment_form_top', 'warrior_comment_form_top' );

	function warrior_comment_form_bottom() {

	}
}
add_action( 'comment_form', 'warrior_comment_form_bottom', 1 );

/**
 * Function to get the first link from a post. Based on the codes from WP Recipes 
 * http://www.wprecipes.com/wordpress-tip-how-to-get-the-first-link-in-post
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
if ( ! function_exists( 'get_link_url' ) ) {
	function get_link_url() {
	    $content = get_the_content();
	    $has_url = get_url_in_content( $content );

	    return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
	}
}


/**
 * Function to get post views
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
if ( ! function_exists( 'warrior_get_post_views' ) ) {
	function warrior_get_post_views($postID){
		$warrior_count_key = 'post_views_count';
	    $warrior_get_count = get_post_meta( $postID, $warrior_count_key, true );
	    $text_views = __( ' Views', 'familia' );
	    $text_view 	= __( ' View', 'familia' );
	    if( $warrior_get_count == '' ){
	        delete_post_meta( $postID, $warrior_count_key );
	        add_post_meta( $postID, $warrior_count_key, '0' );
	        return "0".$text_view;
	    }
	    return $warrior_get_count.$text_views;
	}
}

if ( ! function_exists( 'warrior_set_post_views' ) ) {
	function warrior_set_post_views( $postID ) {
	    $warrior_count_key = 'post_views_count';
	    $warrior_get_count = get_post_meta($postID, $warrior_count_key, true);
	    if($warrior_get_count == '' ){
	        $warrior_get_count = 0;
	        delete_post_meta( $postID, $warrior_count_key );
	        add_post_meta( $postID, $warrior_count_key, '0' );
	    }else{
	        $warrior_get_count++;
	        update_post_meta( $postID, $warrior_count_key, $warrior_get_count );
	    }
	}
}


/**
 * Warrior gallery function
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

if ( ! function_exists( 'warrior_gallery' ) ) {
	function warrior_gallery( $content, $attr ) {
		// Call WordPress thickbox library
		add_thickbox();

		if ( get_post_format() == 'gallery' ) {
			$post = get_post();
			static $instance = 0;
			$instance++;
			
			if ( isset( $attr['orderby'] ) ) :
				$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
				if ( !$attr['orderby'] )
					unset( $attr['orderby'] );
			endif;

			extract( shortcode_atts( array(
				'order'      => 'ASC',
				'orderby'    => 'menu_order ID',
				'id'         => $post ? $post->ID : 0,
				'size'       => 'small-thumb-1',
				'include'    => '',
				'exclude'    => ''
			), $attr ) );

			$id = intval( $id );
			if ( 'RAND' == $order )
				$orderby = 'none';

			if ( !empty( $include ) ) {
				$_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

				$attachments = array();
				foreach ( $_attachments as $key => $val ) {
					$attachments[ $val->ID ] = $_attachments[ $key ];
				}
			} elseif ( !empty( $exclude ) ) {
				$attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
			} else {
				$attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
			}

			$size = 'thumbnail';

			if ( empty( $attachments ) )
				return '';

			if ( is_feed() ) {
				$output = "\n";
				foreach ( $attachments as $att_id => $attachment )
					$output .= wp_get_attachment_image( $att_id, $size ) . "\n";
				return $output;
			}

			$output = "<div id='gallery-{$instance}' class='gallery galleryid-{$id}'>";

			$i = 0;
			foreach ( $attachments as $id => $attachment ) {
				if ( ! empty( $attr['link'] ) && 'file' === $attr['link'] )
					$image_output = wp_get_attachment_link( $id, $size );
				elseif ( ! empty( $attr['link'] ) && 'none' === $attr['link'] )
					$image_output = wp_get_attachment_link( $id, $size );
				else
					$image_output = wp_get_attachment_link( $id, $size );

				$image_meta  = wp_get_attachment_metadata( $id );

				$output .= "\n";
				$output .= "$image_output";
				$output .= "\n";
			}
			$output .= "</div>";

			return $output;
		}
	}
}
add_filter( 'post_gallery', 'warrior_gallery', 10, 2 );


/**
 * Function to display post meta
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
if ( ! function_exists( 'warrior_post_meta' ) ) {
	function warrior_post_meta() {
		global $post;
		$author = '<a href="' . get_author_posts_url( $post->post_author ) . '">' . get_the_author() . '</a>';		
?>
		<span class="author"><?php echo $author; ?></span>
		<span class="date"><?php echo date_i18n( 'M j, Y', strtotime( get_the_date('Y-m-d'), false ) ); ?></span>
		<span class="comments"><?php comments_number( '0', '1', '%' ); _e( ' Comments', 'familia' ); ?></span>

<?php
	}
}


/**
 * Change default excerpt more text
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
if( !function_exists( 'warrior_excerpt_more ') ) {
	function warrior_excerpt_more() {
		return ' ...';
	}
}
add_filter( 'excerpt_more', 'warrior_excerpt_more', 999 );


/**
 * Change default excerpt length
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
if( !function_exists( 'warrior_excerpt_length ') ) {
	function warrior_excerpt_length( $length ) {
		global $familia_option;
		return $familia_option['post_excerpt_length'];
	}
}
add_filter( 'excerpt_length', 'warrior_excerpt_length', 999 );