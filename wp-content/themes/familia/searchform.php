<?php
/**
 * The template for displaying search form.
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */
?>

<!-- Start : Search Form Widgets -->
<div class="inner-widget">
	<form class="block-form float-label search-form" method="get" action="<?php echo esc_url( home_url('/') ); ?>">
		<div class="input-wrapper">
			<input type="text" class="input" name="s" value="<?php esc_attr( the_search_query() ); ?>" placeholder="<?php _e('Type and hit enter', 'familia'); ?>"/>
		</div>
		<button type="submit" class="button search-button" onclick="jQuery('#search-form').submit();"></button>
	</form>
</div>
<!-- End : Search Form Widgets -->