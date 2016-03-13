<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link 				http://example.com
 * @since 				1.0.0
 * @package 			Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name: 		WordPress Plugin Boilerplate
 * Plugin URI: 			http://example.com/plugin-name-uri/
 * Description: 		This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version: 			1.0.0
 * Author: 				Your Name or Your Company
 * Author URI: 			http://example.com/
 * License: 			GPL-2.0+
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: 		plugin-name
 * Domain Path: 		/assets/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

// Used for referring to the plugin file or basename
if ( ! defined( 'PLUGIN_NAME_FILE' ) ) {
	define( 'PLUGIN_NAME_FILE', plugin_basename( __FILE__ ) );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in classes/class-activator.php
 */
function activate_plugin_name() {

	require_once plugin_dir_path( __FILE__ ) . 'classes/class-activator.php';

	Plugin_Name_Activator::activate();

} // activate_plugin_name()

/**
 * The code that runs during plugin deactivation.
 * This action is documented in classes/class-deactivator.php
 */
function deactivate_plugin_name() {

	require_once plugin_dir_path( __FILE__ ) . 'classes/class-deactivator.php';

	Plugin_Name_Deactivator::deactivate();

} // deactivate_plugin_name()

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'classes/class-plugin-name.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Plugin_Name();
	$plugin->run();

} // run_plugin_name()

run_plugin_name();
