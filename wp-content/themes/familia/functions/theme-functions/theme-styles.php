<?php
/**
 * Function to load JS & CSS files
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

if ( ! function_exists( 'warrior_enqueue_scripts' ) ) {
	function warrior_enqueue_scripts() {
		global $pagenow;
		
		// Only load these scripts on frontend
		if( !is_admin() && $pagenow != 'wp-login.php' ) {

			// Load all Javascript files
			wp_enqueue_script('jquery');

			if ( is_singular() ) {
				wp_enqueue_script( 'comment-reply' );
			}

			wp_enqueue_script( 'jquery-floating-placeholder', get_template_directory_uri() .'/js/jquery-floating-placeholder.min.js', '', null, true );
			wp_enqueue_script( 'justifiedGallery', get_template_directory_uri() .'/js/jquery.justifiedGallery.min.js', '', '3.5.1', true );
			wp_enqueue_script('backstretch', get_template_directory_uri() .'/js/jquery.backstretch.min.js', '', null, true);
			wp_enqueue_script( 'owlcarousel', get_template_directory_uri() .'/js/owl.carousel.min.js', '', '1.1', true );
			wp_enqueue_script( 'fitvids', get_template_directory_uri() .'/js/jquery.fitvids.js', '', '1.1', true );
			wp_enqueue_script( 'slicknav', get_template_directory_uri() .'/js/jquery.slicknav.min.js', '', '1.0.3', true );
			wp_enqueue_script( 'mobilemenu', get_template_directory_uri() .'/js/jquery.mobilemenu.js', '', '1.1', true );
			wp_enqueue_script( 'functions', get_template_directory_uri() .'/js/functions.js', '', null, true );
				
			// Localize script
			wp_localize_script('functions', '_warrior', array(
				'bg_header' => esc_url( get_header_image() ),
			));

			// Load all CSS files
			wp_enqueue_style( 'reset', get_template_directory_uri() .'/css/reset.css', array(), false, 'all' );
			wp_enqueue_style( 'justifiedGallery', get_template_directory_uri() .'/css/justifiedGallery.min.css', array(), false, 'all' );
			wp_enqueue_style( 'linecons', get_template_directory_uri() .'/css/linecons.css', array(), false, 'all' );
			wp_enqueue_style( 'zocial', get_template_directory_uri() .'/css/zocial.css', array(), false, 'all' );
			wp_enqueue_style( 'owlcarousel', get_template_directory_uri() .'/css/owl.carousel.css', array(), false, 'all' );
			wp_enqueue_style( 'slicknav', get_template_directory_uri() .'/css/slicknav.min.css', array(), false, 'all' );
			wp_enqueue_style( 'style', get_template_directory_uri() .'/style.css', array(), false, 'all' );

			wp_enqueue_style( 'responsive', get_template_directory_uri() .'/css/responsive.css', array(), false, 'all' );

			// Load custom CSS file
			wp_enqueue_style( 'custom', get_template_directory_uri() .'/custom.css', array(), false, 'screen' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'warrior_enqueue_scripts' );


/**
 * Function to load JS & CSS files on init
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
if ( ! function_exists( 'warrior_init_styles' ) ) {
	function warrior_init_styles () {
		
	}
}
add_action( 'admin_enqueue_scripts', 'warrior_init_styles' );
?>