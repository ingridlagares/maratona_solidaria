<?php
/**
 * Admin View: Notice - License Unvalidated
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div id="message" class="updated">
	<p class="ur-updater-dismiss" style="float:right;"><a href="<?php echo esc_url( add_query_arg( 'dismiss-' . sanitize_title( $this->plugin_slug ), '1' ) ); ?>"><?php _e( 'Hide notice', 'user-registration' ); ?></a></p>
	<p><?php printf( __( '%1$sPlease enter your license key%2$s in the plugin list below to get updates for <strong>%3$s</strong> Add-Ons.', 'user-registration' ), '<a href="' . esc_url( admin_url( 'plugins.php#' . sanitize_title( $this->plugin_slug ) ) ) . '">', '</a>', esc_html( $this->plugin_data['Name'] ) ); ?></p>
</div>
