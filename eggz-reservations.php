<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link 				http://enwebo.com
 * @since 				1.0.0
 * @package 			Eggz_Reservations
 *
 * @wordpress-plugin
 * Plugin Name: 		Eggz Reservations
 * Plugin URI: 			http://enwebo.com/plugins/eggz-reservations/
 * Description: 		Reservation Plugin for Eggz theme.
 * Version: 			1.0.1
 * Author: 				Enwebo
 * Author URI: 			http://enwebo.com/
 * License: 			GPL-2.0+
 * License URI: 		http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: 		eggz-reservations
 * Domain Path: 		/assets/languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

// Used for referring to the plugin file or basename.
if ( ! defined( 'EGGZ_RESERVATIONS_FILE' ) ) {
	define( 'EGGZ_RESERVATIONS_FILE', plugin_basename( __FILE__ ) );
}

/**
 * Runs during plugin activation.
 * This action is documented in classes/class-activator.php
 */
require_once plugin_dir_path( __FILE__ ) . 'classes/class-activator.php';
register_activation_hook( __FILE__, array( 'Eggz_Reservations_Activator', 'activate' ) );

/**
 * Code that runs during plugin deactivation.
 * This action is documented in classes/class-deactivator.php
 */
require_once plugin_dir_path( __FILE__ ) . 'classes/class-deactivator.php';
register_deactivation_hook( __FILE__, array( 'Eggz_Reservations_Deactivator', 'deactivate' ) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'classes/class-eggz-reservations.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
call_user_func( array( new Eggz_Reservations(), 'run' ) );
