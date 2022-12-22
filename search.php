<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 * 
 * @link                https://www.lyratec.com.br
 * @since               1.0.2
 * @package             Hulled
 * 
 * 
 * @wordpress-plugin
 * Plugin Name:         Search 
 * Description:         Bapenas um teste de busca com ajax
 * Version:             1.0.0
 * Author:              hulled
 * Author URI:          https://hulled.com.br
 * License:             GPL-2.0+
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:         Hulled-plugins-search
 * Domain Path:         /languages
 * Requires PHP:        7.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
define( 'SEARCHPHPVERSION', '7.0.0' );
define( 'VERSIONPLUGINSEARCH', '1.0.0' );
define( 'FILESEARCHPLUGIN', dirname( __FILE__ ));

require_once plugin_dir_path( __FILE__ ) . 'function_search.php';


add_action( 'plugins_loaded', 'hulled_init_plugin_search', 'get_instance');

