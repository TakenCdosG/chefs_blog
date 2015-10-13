<?php
/**
 * The template for displaying header part.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $familia_option;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="shortcut icon" href="<?php echo ( esc_url( $familia_option['favicon']['url'] ) ? esc_url( $familia_option['favicon']['url'] ) : get_template_directory_uri().'/images/favicon.png' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class( 'homepage' ); ?>>
	<div class="page">
		<header id="masthead" class="site-header">
			<div id="main-header">
				<div class="container clearfix">
                    <?php wp_exposed_header_callback(); ?>
				</div>
			</div>
		</header>

		<!-- Start: Primary -->
		<div id="primary" class="content-area site-main" role="main">
			<!-- Start: Container -->
			<div class="container clearfix">