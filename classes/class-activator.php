<?php

/**
 * Fired during plugin activation
 *
 * @link 		http://example.com
 * @since 		1.0.0
 *
 * @package 	Plugin_Name
 * @subpackage 	Plugin_Name/classes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since 		1.0.0
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 * @author 		Your Name <email@example.com>
 */
class Eggz_Reservations_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-cpt-reservation.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-tax-table.php';

		Eggz_Reservations_CPT_Reservation::new_cpt_reservation();
		Eggz_Reservations_Tax_Table::new_taxonomy_table();

		flush_rewrite_rules();

		$opts 		= array();
		$options 	= Eggz_Reservations_Admin::get_options_list();

		foreach ( $options as $option ) {

			$opts[ $option[0] ] = $option[2];

		}

		update_option( 'eggz-reservations-options', $opts );

	} // activate()

} // class
