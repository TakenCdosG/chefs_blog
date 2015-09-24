<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
?>

<!-- Start: Sidebar -->
<div id="secondary-content">
	<?php
	// Load sidebar widgets
	if ( is_active_sidebar('warrior-sidebar') ) {
		dynamic_sidebar( 'warrior-sidebar' );
	} else {
		echo '<div class="container"><p class="no-widget">';
		_e( 'There\'s no widget assigned. You can start assigning widgets to "Sidebar" widget area from the <a href="'. admin_url('/widgets.php') .'">Widgets</a> page.', 'familia' );
		echo '</p></div>';
	}
	?>
</div>
<!-- End: Sidebar -->