<?php
/**
 * List of files inclusion and functions
 *
 * Define global variables:
 * $themename : theme name information
 * $shortname : short name information
 * $version : current theme version
 * 
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $themename, $shortname, $version;
	
$themename = 'familia';
$shortname = 'familia';
$version = wp_get_theme()->Version;


// Include theme functions
require_once( get_template_directory() . '/functions/theme-functions/theme-widgets.php' ); // Load widgets
require_once( get_template_directory() . '/functions/theme-functions/theme-support.php' ); // Load theme support
require_once( get_template_directory() . '/functions/theme-functions/theme-functions.php' ); // Load custom functions
require_once( get_template_directory() . '/functions/theme-functions/theme-styles.php' ); // Load JavaScript, CSS & comment list layout
require_once( get_template_directory() . '/functions/class-tgm-plugin-activation.php' ); // Load TGM-Plugin-Activation

/**
 * After setup theme
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
function warrior_theme_init() {
	add_action( 'widgets_init', 'warrior_register_sidebars' );
}
add_action( 'after_setup_theme', 'warrior_theme_init' );

function wp_exposed_header_callback(){
    $username = 'tcg';
    $password = 'Think@203';
    $context = stream_context_create(array(
        'http' => array(
            'header'  => "Authorization: Basic " . base64_encode("$username:$password")
        )
    ));
    $uri = "http://beta.chefsemporiumct.com/?feed=wp_exposed_header";
    $data = file_get_contents($uri, false, $context);
    //$content = wp_remote_fopen($uri);
    print $data;
}


/**
 * Loads the Options Panel
 * 
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $familia_option;

// get redux framework 
if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/functions/redux/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/functions/redux/framework.php' );
}
if ( !isset( $familia_option ) && file_exists( dirname( __FILE__ ) . '/functions/theme-functions/theme-options.php' ) ) {
	require_once( dirname( __FILE__ ) . '/functions/theme-functions/theme-options.php' );
}

/**
 * Required & recommended plugins
 * *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
function warrior_required_plugins() {
	$plugins = array(
		array(
			'name'			=> 'Instagram Feed',
			'slug'			=> 'instagram-feed',
			'required'		=> true,
		),
		array(
			'name'			=> 'ZillaShortcodes',
			'version' 		=> '2.0.2',
			'slug'			=> 'zilla-shortcodes',
			'source'		=> get_template_directory() . '/plugins/zilla-shortcodes.zip',
			'external_url'	=> '',
			'required'		=> true,
		),
		array(
			'name'			=> 'Contact Form 7',
			'slug'			=> 'contact-form-7',
			'required'		=> true,
		),
		array(
			'name'			=> 'MailChimp',
			'slug'			=> 'mailchimp-for-wp',
			'required'		=> true,
		),
		array(
			'name'			=> 'WP Page-Navi',
			'slug'			=> 'wp-pagenavi',
			'required'		=> true,
		)
	);

	$string = array(
		'page_title' => __( 'Install Required Plugins', 'familia' ),
		'menu_title' => __( 'Install Plugins', 'familia' ),
		'installing' => __( 'Installing Plugin: %s', 'familia' ),
		'oops' => __( 'Something went wrong with the plugin API.', 'familia' ),
		'notice_can_install_required' => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ),
		'notice_can_install_recommended' => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ),
		'notice_cannot_install' => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ),
		'notice_can_activate_required' => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ),
		'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ),
		'notice_cannot_activate' => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ),
		'notice_ask_to_update' => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ),
		'notice_cannot_update' => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ),
		'install_link' => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
		'activate_link' => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
		'return' => __( 'Return to Required Plugins Installer', 'familia' ),
		'plugin_activated' => __( 'Plugin activated successfully.', 'familia' ),
		'complete' => __( 'All plugins installed and activated successfully. %s', 'familia' ),
		'nag_type' => 'updated'
	);

	$theme_text_domain = 'familia';

	$config = array(
		'domain' => 'familia',
		'default_path' => '',
		'parent_menu_slug' => 'themes.php',
		'parent_url_slug' => 'themes.php',
		'menu' => 'install-plugins',
		'has_notices' => true,
		'is_automatic' => true,
		'message' => '',
		'strings' => $string
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'warrior_required_plugins' );