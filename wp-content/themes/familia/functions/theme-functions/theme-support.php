<?php
/**
* List of theme support functions
*/


// Check if the function exist
if ( function_exists( 'add_theme_support' ) ){

	// Add post thumbnail feature
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'blog-image', 300, 220, true ); // blog image
	add_image_size( 'small-thumb-1', 80, 80, true ); // related posts image
	add_image_size( 'post-detail-image', 770, 400, true ); // post detail image
	add_image_size( 'featured-post-image', 546, 348, true ); // featured post large image
	add_image_size( 'featured-post-thumb-image', 275, 173, true ); // featured post thumbnail image
	
	// Add WordPress navigation menus
	add_theme_support( 'nav-menus' );
	register_nav_menus( array(
		'main-menu-left' => __( 'Main Menu Left', 'familia' ),
		'main-menu-right' => __( 'Main Menu Right', 'familia' ),
        'main-menu-top' => __( 'Main Menu Top', 'familia' ),
	) );

	// Add Title Tag Support
	add_theme_support( 'title-tag' );

	// Add WordPress post format
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'link', 'quote', 'video', 'audio' ) ); 

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Add custom background feature 
	add_theme_support( 'custom-background' );
}

// Theme Localization
load_theme_textdomain( 'familia', get_template_directory().'/lang' );

// Set maximum image width displayed in a single post or page
if ( ! isset( $content_width ) ) {
	$content_width = 780;
}
?>