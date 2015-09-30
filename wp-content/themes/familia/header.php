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
					<div id="logo" class="site-title">
						<?php if( $familia_option['logo_type'] == '1' ) : ?>
							<div class="box-site-title">
								<h2 class="site-title"><a href="<?php echo esc_url( get_home_url() ); ?>"><?php echo esc_attr( bloginfo('name') ); ?></a></h2>
							</div>
							<h4 class="site-desc"><?php echo esc_attr( bloginfo( 'description' ) ); ?></h4>
						<?php else: ?>
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
								<img src="<?php echo ( esc_url( $familia_option['logo_image']['url'] ) ? esc_url( $familia_option['logo_image']['url'] ) : get_template_directory_uri().'/images/logo.png' ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" />
							</a>
						<?php endif; ?>
					</div>

                    <nav id="main-menu-right" class="site-navigation top-menu-navigation menu-right">
                        <?php
                        // Display Main menu top
                        if ( has_nav_menu( 'main-menu-right' ) ) {
                            wp_nav_menu( array ( 'theme_location' => 'main-menu-right', 'container' => null, 'menu_class' => 'main-menu', 'depth' => 2 ) );
                        }
                        ?>
                    </nav>

                    <nav id="main-menu-left" class="site-navigation top-menu-navigation">
                        <?php
                        // Display Main menu top
                        if ( has_nav_menu( 'main-menu-left' ) ) {
                            wp_nav_menu( array ( 'theme_location' => 'main-menu-left', 'container' => null, 'menu_class' => 'main-menu', 'depth' => 2 ) );
                        }
                        ?>
                    </nav>
					<div class="mobile-menu"></div>
				</div>
			</div>
		</header>

		<!-- Start: Primary -->
		<div id="primary" class="content-area site-main" role="main">
			<!-- Start: Container -->
			<div class="container clearfix">