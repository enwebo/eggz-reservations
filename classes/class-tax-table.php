<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines a taxonomy and other related functionality.
 *
 * @link 		http://enwebo.com
 * @since 		1.0.0
 *
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 * @author		Enwebo <contact@enwebo.com>
 */
class Eggz_Reservations_Tax_Table { 

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Constructor
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

	} // __construct()

	/**
	 * Creates a new taxonomy for a reservation
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_taxonomy()
	 */
	public static function new_taxonomy_table() {

		$plural 	= 'Tables';
		$single 	= 'Table';
		$tax_name 	= 'table';
		$cpt_name 	= 'reservation';

		$opts['hierarchical']							= TRUE;
		//$opts['meta_box_cb'] 							= '';
		$opts['public']									= TRUE;
		$opts['query_var']								= $tax_name;
		$opts['show_admin_column'] 						= TRUE;
		$opts['show_in_nav_menus']						= TRUE;
		$opts['show_tag_cloud'] 						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['sort'] 									= '';
		//$opts['update_count_callback'] 					= '';

		$opts['capabilities']['assign_terms'] 			= 'edit_posts';
		$opts['capabilities']['delete_terms'] 			= 'manage_categories';
		$opts['capabilities']['edit_terms'] 			= 'manage_categories';
		$opts['capabilities']['manage_terms'] 			= 'manage_categories';

		$opts['labels']['add_new_item'] 				= esc_html__( "Add New {$single}", 'eggz-reservations' );
		$opts['labels']['add_or_remove_items'] 			= esc_html__( "Add or remove {$plural}", 'eggz-reservations' );
		$opts['labels']['all_items'] 					= esc_html__( $plural, 'eggz-reservations' );
		$opts['labels']['choose_from_most_used'] 		= esc_html__( "Choose from most used {$plural}", 'eggz-reservations' );
		$opts['labels']['edit_item'] 					= esc_html__( "Edit {$single}" , 'eggz-reservations');
		$opts['labels']['menu_name'] 					= esc_html__( $plural, 'eggz-reservations' );
		$opts['labels']['name'] 						= esc_html__( $plural, 'eggz-reservations' );
		$opts['labels']['new_item_name'] 				= esc_html__( "New {$single} Name", 'eggz-reservations' );
		$opts['labels']['not_found'] 					= esc_html__( "No {$plural} Found", 'eggz-reservations' );
		$opts['labels']['parent_item'] 					= esc_html__( "Parent {$single}", 'eggz-reservations' );
		$opts['labels']['parent_item_colon'] 			= esc_html__( "Parent {$single}:", 'eggz-reservations' );
		$opts['labels']['popular_items'] 				= esc_html__( "Popular {$plural}", 'eggz-reservations' );
		$opts['labels']['search_items'] 				= esc_html__( "Search {$plural}", 'eggz-reservations' );
		$opts['labels']['separate_items_with_commas'] 	= esc_html__( "Separate {$plural} with commas", 'eggz-reservations' );
		$opts['labels']['singular_name'] 				= esc_html__( $single, 'eggz-reservations' );
		$opts['labels']['update_item'] 					= esc_html__( "Update {$single}", 'eggz-reservations' );
		$opts['labels']['view_item'] 					= esc_html__( "View {$single}", 'eggz-reservations' );

		$opts['rewrite']['ep_mask']						= EP_NONE;
		$opts['rewrite']['hierarchical']				= FALSE;
		$opts['rewrite']['slug']						= esc_html__( $tax_name, 'eggz-reservations' );
		$opts['rewrite']['with_front']					= FALSE;

		$opts = apply_filters( 'eggz-reservations-taxonomy-table-options', $opts );

		register_taxonomy( $tax_name, $cpt_name, $opts );

	} // new_taxonomy_table()

} // class
