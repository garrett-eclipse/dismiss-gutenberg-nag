<?php 
/*
 Plugin Name:       Dismiss Gutenberg Nag
 Plugin URI:        https://github.com/luciano-croce/dismiss-gutenberg-nag/
 Description:       Auto Dismiss "<strong>try Gutenberg</strong>" nag, dashboard widget, when is activated, or automatically, when put on mu-plugins directory.
 Version:           1.0.1
 Requires at least: 4.8
 Tested up to:      4.9
 Requires PHP:      5.4
 Author:            Luciano Croce
 Author URI:        https://github.com/luciano-croce/
 License:           GPLv2 or later
 License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 Text Domain:       dismiss-gutenberg-nag
 Network:           true
 *
 *    Copyright 2017 Luciano Croce (luciano.croce@gmail.com)
 *
 * Tips: a neat trick is to put this single file dismiss-gutenberg-nag.php (not its parent directory)
 * in the wp-content/mu-plugins directory (create it if not exists) so you won't even have to enable it,
 * and will be loaded by default, also, since first step of installation!
 */

	/**
	 * @link              https://github.com/luciano-croce/dismiss-gutenberg-nag/
	 * @package           Dismiss Gutenberg Nag
	 * @subpackage        Gutenberg
	 * @wordpress-plugin  WordPress Plugin
	 * @author            Luciano Croce <luciano.croce@gmail.com>
	 * @version           1.0.1
	 * @build             2017-11-04
	 * @since             1.0.0
	 * @released          2017-10-30
	 * @license           GPLv2 or later
	 */

if ( !defined( 'ABSPATH' ) ) exit;

if ( !defined( 'WPINC' ) ) exit;

if ( !function_exists( 'add_action' ) )	{
	header( 'HTTP/0.9 403 Forbidden' );
	header( 'HTTP/1.0 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	header( 'HTTP/1.2 403 Forbidden' );
	header( 'HTTP/1.3 403 Forbidden' );
	header( 'Status: 403 Forbidden'  );
	echo "Hi there! I\'m just a plugin, not much I can do when called directly.";
	exit;
}

if ( version_compare( PHP_VERSION, '5.4.0', '<' ) ) {
//	wp_die( __( 'This plugin requires PHP 5.4+ or later: Activation Stopped! Please note that the best choice is PHP 5.6+ ~ 7.0+ (old stable branche) or 7.1+ (current stable branche)' ) ); # uncomment it if you prefer die notification

			function dismiss_gutenberg_nag_psd_php_version_init()
				{
					deactivate_plugins( plugin_basename( __FILE__ ) );
				}
			add_action( 'admin_init', 'dismiss_gutenberg_nag_psd_php_version_init', 0 );

			function dismiss_gutenberg_nag_ant_php_version_init()
				{
?>
<div class="notice notice-error is-dismissible">
<p>This plugin requires PHP 5.4+ or later: please note that the best choice is PHP 5.6+ ~ 7.0+ (old stable branche) or 7.1+ (current stable branche)</p>
</div>
<div class="notice notice-warning is-dismissible">
<p>Plugin Dismiss Gutenberg Nag <strong>deactivated</strong>.</p>
</div>
<?php 
				}
			add_action( 'admin_notices', 'dismiss_gutenberg_nag_ant_php_version_init' );
}
else {
global $wp_version;

if ( version_compare( $wp_version, '4.8.0', '<' ) ) {
//	wp_die( __( 'This plugin requires WordPress 4.8+ or later: Activation Stopped!' ) );                                                                                                     # uncomment it if you prefer die notification

			function dismiss_gutenberg_nag_psd_wp_version_init()
				{
					deactivate_plugins( plugin_basename( __FILE__ ) );
				}
			add_action( 'admin_init', 'dismiss_gutenberg_nag_psd_wp_version_init', 0 );

			function dismiss_gutenberg_nag_ant_wp_version_init()
				{
?>
<div class="notice notice-error is-dismissible">
<p>This plugin requires WordPress 4.8+ or later: please note that the Gutenberg Dashboard Widget Nag was introduced since WordPress 4.9-beta3</p>
</div>
<div class="notice notice-warning is-dismissible">
<p>Plugin Dismiss Gutenberg Nag <strong>deactivated</strong>.</p>
</div>
<?php 
				}
			add_action( 'admin_notices', 'dismiss_gutenberg_nag_ant_wp_version_init' );
}
else {

/**
 * Dismiss Dashboard Widget "try Gutenberg" Nag
 *
 * @author   Luciano Croce
 * @version  1.0.1
 * @build    2017-11-04
 * @since    1.0.0
 * @released 2017-10-30
 */
function dismiss_dashboard_widget_try_gutenberg_nag() {
	remove_action( 'try_gutenberg_panel', 'wp_try_gutenberg_panel' );
}
add_action( 'admin_init', 'dismiss_dashboard_widget_try_gutenberg_nag' );

}
}