<?php

if ( ! function_exists( 'eggz_reservations_templates' ) ) {

	/**
	 * Public API for adding and removing temmplates.
	 *
	 * @return 		object 			Instance of the templates class
	 */
	function eggz_reservations_templates() {

		return Eggz_Reservations_Templates::this();

	} // eggz_reservations_templates()

} // check

/**
 * The public-facing functionality of the plugin.
 *
 * @link 		http://enwebo.com
 * @since 		1.0.0
 *
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the methods for creating the templates.
 *
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 *
 */
class Eggz_Reservations_Templates {

	/**
	 * Private static reference to this class
	 * Useful for removing actions declared here.
	 *
	 * @var 	object 		$_this
 	 */
	private static $_this;

	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options    The plugin options.
	 */
	private $options;
	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options    The plugin options.
	 */
	private $plugin_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct() {

		self::$_this = $this;

		$this->set_options();

	} // __construct()

	/**
	 * Returns an array of the featured image details
	 *
	 * @param 	int 	$postID 		Post ID
	 * @return 	array 					Array of info about the featured image
	 */
	public function get_featured_images( $postID ) {

		if ( empty( $postID ) ) { return FALSE; }

		$imageID = get_post_thumbnail_id( $postID );

		if ( empty( $imageID ) ) { return FALSE; }

		return wp_prepare_attachment_for_js( $imageID );

	} // get_featured_images()

	/**
	 * Includes the link start template file
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_link_begin( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-link-begin', 'loop' );

	} // loop_content_link_begin()

	/**
	 * Includes the link end template file
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_link_end( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-link-end', 'loop' );

	} // loop_content_link_end()

	/**
	 * Includes the featured image template
	 *
	 * @hooked 		plugin-name-loop-content 		10
	 *
	 * @param 		object 		$item 		A post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_image( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-image', 'loop' );

	} // loop_content_image()

	/**
	 * Includes the meta field template file
	 */
	public function loop_content_meta_field( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-meta-field', 'loop' );

	} // loop_content_meta_field()

	/**
	 * Includes the plugin-name-subtitle template
	 *
	 * @hooked 		plugin-name-loop-content 		30
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_subtitle( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-subtitle', 'loop' );

	} // loop_content_subtitle()

	/**
	 * Includes the plugin-name-title template
	 *
	 * @hooked 		plugin-name-loop-content 		20
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_title( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-title', 'loop' );

	} // loop_content_title()

	/**
	 * Includes the content wrap start template file
	 *
	 * @hooked 		plugin-name-before-loop-content 		10
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_wrap_begin( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-wrap-begin', 'loop' );

	} // loop_content_wrap_begin()

	/**
	 * Includes the content wrap end template file
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_wrap_end( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-wrap-end', 'loop' );

	} // loop_content_wrap_end()

	/**
	 * Includes the list wrap start template file and sets the value of $class.
	 *
	 * If the taxonomyname shortcode attribute is used, it sets $class as the
	 * taxonomyname or taxonomynames. Otherwise, $class is blank.
	 *
	 * @param 		array 		$args 		The shortcode attributes
	 */
	public function loop_wrap_begin( $args ) {

		if ( empty( $args['taxonomyname'] ) ) {

			$class = '';

		} elseif ( is_array( $args['taxonomyname'] ) ) {

			$class = str_replace( ',', ' ', $args['taxonomyname'] );

		} else {

			$class = $args['taxonomyname'];

		}

		include eggz_reservations_get_template( 'loop-wrap-begin', 'loop' );

	} // list_wrap_begin()

	/**
	 * Includes the list wrap end template file
	 *
	 * @param 		array 		$args 		The shortcode attributes
	 */
	public function loop_wrap_end( $args ) {

		include eggz_reservations_get_template( 'loop-wrap-end', 'loop' );

	} // list_wrap_end()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	} // set_options()

	/**
	 * Includes the single reservation meta field
	 *
	 * @param 		array 		$meta 		The post metadata
	 */
	public function single_reservation_meta_field( $meta ) {

		include eggz_reservations_get_template( 'single-reservation-metafield', 'single' );

	} // single_posttypename_meta_field()

	/**
	 * Includes the single reservation content
	 */
	public function single_reservation_content() {

		include eggz_reservations_get_template( 'single-reservation-content', 'single' );

	} // single_posttypename_content()

	/**
	 * Includes the single reservation post title
	 */
	public function single_reservation_posttitle() {

		include eggz_reservations_get_template( 'single-reservation-posttitle', 'single' );

	} // single_reservation_posttitle()

	/**
	 * Includes the single reservation post title
	 */
	public function single_reservation_subtitle( $meta ) {

		include eggz_reservations_get_template( 'single-reservation-subtitle', 'single' );

	} // single_reservation_subtitle()

	/**
	 * Include the single posttypename thumbnail
	 */
	public function single_reservation_thumbnail() {

		include eggz_reservations_get_template( 'single-reservation-thumbnail', 'single' );

	} // single_reservation_thumbnail()

	/**
	 * Returns a reference to this class. Used for removing
	 * actions and/or filters declared here.
	 *
	 * @see  	http://hardcorewp.com/2012/enabling-action-and-filter-hook-removal-from-class-based-wordpress-plugins/
	 * @return 	object 		This class
	 */
	static function this() {

		return self::$_this;

	} // this()

} // class
