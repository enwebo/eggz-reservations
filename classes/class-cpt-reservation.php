<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines a custom post type and other related functionality.
 *
 * @link 		http://example.com
 * @since 		1.0.0
 *
 * @package 	Plugin_Name
 * @subpackage 	Plugin_Name/classes
 * @author 		Slushman <chris@slushman.com>
 */
class Eggz_Reservations_CPT_Reservation {

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

	}

	/**
	 * Registers additional image sizes
	 */
	public function add_image_sizes() {

		add_image_size( 'col-thumb', 75, 75, true );

	} // add_image_sizes()

	/**
	 * Populates the custom columns with content.
	 *
	 * @param 		string 		$column_name 		The name of the column
	 * @param 		int 		$post_id 			The post ID
	 *
	 * @return 		string 							The column content
	 */
	public function reservation_column_content( $column_name, $post_id  ) {

		if ( empty( $post_id ) ) { return; }

		if ( 'col-thumb' === $column_name ) {

			$thumb = get_the_post_thumbnail( $post_id, 'col-thumb' );

			echo $thumb;

		}

		if ( 'sortable-column' === $column_name ) {

			$col = get_post_meta( $post_id, 'sortable-column', true );

			echo '<a href="' . esc_url( get_edit_post_link( $post_id ) ) .  '">';
			echo $col;
			echo '</a>';

		}
		if ( 'table' === $column_name ) {
			// $args = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
			$terms = wp_get_post_terms ( $post_id, 'table', array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all') );

			foreach ( $terms as $term ) {
				echo '<a href="' . esc_url( get_edit_term_link( $term, 'table', 'reservation' ) ) .  '">';
				echo $term->name;
				echo '</a>';

			}
			
		}

	} // posttypename_column_content()

	/**
	 * Sorts the posttypename admin list by the display order
	 *
	 * @param 		array 		$vars 			The current query vars array
	 *
	 * @return 		array 						The modified query vars array
	 */
	public function reservation_order_sorting( $vars ) {

		if ( empty( $vars ) ) { return $vars; }
		if ( ! is_admin() ) { return $vars; }
		if ( ! isset( $vars['post_type'] ) || 'reservation' !== $vars['post_type'] ) { return $vars; }

		if ( isset( $vars['orderby'] ) && 'sortable-column' === $vars['orderby'] ) {

			$vars = array_merge( $vars, array(
				'meta_key' => 'sortable-column',
				'orderby' => 'meta_value'
			) );

		}

		return $vars;

	} // posttypename_order_sorting()
	

	/**
	 * Registers additional columns for the Eggz_Reservations admin listing
	 * and reorders the columns.
	 *
	 * @param 		array 		$columns 		The current columns
	 *
	 * @return 		array 						The modified columns
	 */
	public function reservation_register_columns( $columns ) {

		$new['cb'] 				= '<input type="checkbox" />';
		$new['title'] 		= __( 'Title', 'eggz-reservations' );
		$new['table'] 		= __( 'Table', 'eggz-reservations' );
		$new['thumbnail'] 		= __( 'Thumbnail', 'eggz-reservations' );
		$new['date'] 			= __( 'Date' );

		return $new;

	} // reservation_register_columns()

	/**
	 * Registers sortable columns
	 *
	 * @param 		array 		$sortables 			The current sortable columns
	 *
	 * @return 		array 							The modified sortable columns
	 */
	public function reservation_sortable_columns( $sortables ) {

		$sortables['table'] = 'table-order';

		return $sortables;

	} // reservation_sortable_columns()

	/**
	 * Creates a new custom post type
	 */
	public static function new_cpt_reservation() {

		$cap_type 	= 'post';
		$plural 	= 'Reservations';
		$single 	= 'Reservation';
		$cpt_name 	= 'reservation';

		$opts['can_export']								= TRUE;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= FALSE;
		$opts['has_archive']							= FALSE;
		$opts['hierarchical']							= FALSE;
		$opts['map_meta_cap']							= TRUE;
		$opts['menu_icon']								= 'dashicons-store';
		$opts['menu_position']							= 25;
		$opts['public']									= TRUE;
		$opts['publicly_querable']						= TRUE;
		$opts['query_var']								= TRUE;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= FALSE;
		$opts['show_in_admin_bar']						= TRUE;
		$opts['show_in_menu']							= TRUE;
		$opts['show_in_nav_menu']						= TRUE;
		$opts['show_ui']								= TRUE;
		$opts['supports']								= array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' );
		$opts['taxonomies']								= array();

		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";

		$opts['labels']['add_new']						= esc_html__( "Add New {$single}", 'eggz-reservations' );
		$opts['labels']['add_new_item']					= esc_html__( "Add New {$single}", 'eggz-reservations' );
		$opts['labels']['all_items']					= esc_html__( $plural, 'eggz-reservations' );
		$opts['labels']['edit_item']					= esc_html__( "Edit {$single}" , 'eggz-reservations');
		$opts['labels']['menu_name']					= esc_html__( $plural, 'eggz-reservations' );
		$opts['labels']['name']							= esc_html__( $plural, 'eggz-reservations' );
		$opts['labels']['name_admin_bar']				= esc_html__( $single, 'eggz-reservations' );
		$opts['labels']['new_item']						= esc_html__( "New {$single}", 'eggz-reservations' );
		$opts['labels']['not_found']					= esc_html__( "No {$plural} Found", 'eggz-reservations' );
		$opts['labels']['not_found_in_trash']			= esc_html__( "No {$plural} Found in Trash", 'eggz-reservations' );
		$opts['labels']['parent_item_colon']			= esc_html__( "Parent {$plural} :", 'eggz-reservations' );
		$opts['labels']['search_items']					= esc_html__( "Search {$plural}", 'eggz-reservations' );
		$opts['labels']['singular_name']				= esc_html__( $single, 'eggz-reservations' );
		$opts['labels']['view_item']					= esc_html__( "View {$single}", 'eggz-reservations' );

		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= FALSE;
		$opts['rewrite']['pages']						= TRUE;
		$opts['rewrite']['slug']						= esc_html__( $cpt_name, 'eggz-reservations' );
		$opts['rewrite']['with_front']					= TRUE;

		$opts = apply_filters( 'eggz-reservations-cpt-reservation-options', $opts );

		register_post_type( $cpt_name, $opts );

	} // new_cpt_reservation()

} // class
