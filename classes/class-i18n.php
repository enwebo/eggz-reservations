<?php

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since 		1.0.0
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 * @author 		Enwebo <contact@enwebo.com>
 */
class Eggz_Reservations_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'eggz-reservations',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/assets/languages/'
		);

	} // load_plugin_textdomain()

} // class
