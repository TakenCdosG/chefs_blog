<?php
/**
 * Social button
 *
 * @package WordPress
 * @subpackage Familia
 * @since Familia 1.0.0
 */

global $familia_option;
?>

<!-- Start : Social buttons -->
<div id="social-profiles">
    <ul>
		<?php if ( $familia_option['url_facebook'] ) : ?>
			<li><a class="zocial icon facebook" href="<?php echo esc_url( $familia_option['url_facebook'] ); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if ( $familia_option['url_twitter'] ) : ?>
			<li><a class="zocial icon twitter" href="<?php echo esc_url( $familia_option['url_twitter'] ); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if ( $familia_option['url_gplus'] ) : ?>
			<li><a class="zocial icon googleplus" href="<?php echo esc_url( $familia_option['url_gplus'] ); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if ( $familia_option['url_instagram'] ) : ?>
			<li><a class="zocial icon instagram" href="<?php echo esc_url( $familia_option['url_instagram'] ); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if ( $familia_option['url_linkedin'] ) : ?>
			<li><a class="zocial icon linkedin" href="<?php echo esc_url( $familia_option['url_linkedin'] ); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if ( $familia_option['url_pinterest'] ) : ?>
			<li><a class="zocial icon pinterest" href="<?php echo esc_url( $familia_option['url_pinterest'] ); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if ( $familia_option['url_youtube'] ) : ?>
			<li><a class="zocial icon youtube" href="<?php echo esc_url( $familia_option['url_youtube'] ); ?>" target="_blank"></a></li>
		<?php endif; ?>
		<?php if ( $familia_option['url_vimeo'] ) : ?>
			<li><a class="zocial icon vimeo" href="<?php echo esc_url( $familia_option['url_vimeo'] ); ?>" target="_blank"></a></li>
		<?php endif; ?>
    </ul>
</div>
<!-- End : Social buttons -->