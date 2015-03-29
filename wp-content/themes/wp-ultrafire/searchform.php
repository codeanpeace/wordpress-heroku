<?php
/**
 * The template for displaying search forms in Theme
 *
 * @package WordPress
 * @subpackage UltraFire
 * @since UltraFire 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search this site', 'color-theme-framework' ); ?>" />		
	</form>
