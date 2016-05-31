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
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options    The plugin options.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options    The plugin options.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 */
	public function __construct( $plugin_name, $version ) {

		
		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;
		self::$_this 		= $this;

		$this->set_options();

	} // __construct()


	/**
	 * Includes filters template file
	 *
	 * @hooked 		eggz-reservations-before-loop 				20
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_filters( $item ) {

		include eggz_reservations_get_template( 'loop-content-filters', 'loop' );

	} // loop_content_filters()


	/**
	 * Includes the list wrap start template file and sets the value of $class.
	 *
	 * If the taxonomyname shortcode attribute is used, it sets $class as the
	 * table or tables. Otherwise, $class is blank.
	 *
	 * @hooked 		eggz-reservations-before-loop 				10
	 *
	 * @param 		array 		$args 		The shortcode attributes
	 */
	public function loop_wrap_begin( $args ) {

		if ( empty( $args['persons'] ) ) {

			$class = '';

		} elseif ( is_array( $args['persons'] ) ) {

			$class = str_replace( ',', ' ', $args['persons'] );

		} else {

			$class = $args['persons'];

		}

		include eggz_reservations_get_template( 'loop-wrap-begin', 'loop' );

	} // loop_wrap_begin()


	/**
	 * Includes the content wrap begin template file
	 *
	 * @hooked 		eggz-reservations-before-loop-content 		10
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_wrap_begin( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-wrap-begin', 'loop' );

	} // loop_content_wrap_begin()


	/**
	 *  Includes the reservation heading end template file
	 *
	 * @hooked 		eggz-reservations-loop-content 				30
	 *
	 * @param 		object 		$item 		Post object
	 */
	public function loop_content_filters( $item ) {

		include eggz_reservations_get_template( 'loop-content-filters', 'loop' );

	} // loop_content_filters()


	/**
	 *  Includes the reservation heading end template file
	 *
	 * @hooked 		eggz-reservations-loop-content 				30
	 *
	 * @param 		object 		$item 		Post object
	 */
	public function loop_content_tools( $item ) {

		include eggz_reservations_get_template( 'loop-content-tools', 'loop' );

	} // loop_content_tools()


	/**
	 *  Includes the reservation heading end template file
	 *
	 * @hooked 		eggz-reservations-loop-content 				30
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 * 
	 */
	public function loop_content_heading( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-heading', 'loop' );

	} // loop_content_heading_end()


	/**
	 * Includes details wrap begin template file
	 *
	 * @hooked 		eggz-reservations-loop-content 				40
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_details( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-details', 'loop' );

	} // loop_content_details_begin()


	/**
	 * Includes the content wrap end template file
	 *
	 * @hooked 		eggz-reservations-after-loop-content		10
	 *
	 * @param 		object 		$item 		Post object
	 * @param 		array 		$meta 		The post metadata
	 */
	public function loop_content_wrap_end( $item, $meta = array() ) {

		include eggz_reservations_get_template( 'loop-content-wrap-end', 'loop' );

	} // loop_content_wrap_end()

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

	} // single_reservation_metafield()

	/**
	 * Includes the single reservation date
	 *
	 * @param 		array 		$meta 		The post metadata
	 */
	public function single_reservation_date( $meta ) {

		include eggz_reservations_get_template( 'single-reservation-date', 'single' );

	} // single_reservation_date()

	/**
	 * Includes the single reservation time
	 *
	 * @param 		array 		$meta 		The post metadata
	 */
	public function single_reservation_time( $meta ) {

		include eggz_reservations_get_template( 'single-reservation-time', 'single' );

	} // single_reservation_time()

	/**
	 * Includes the single reservation time
	 *
	 * @param 		array 		$meta 		The post metadata
	 */
	public function single_reservation_persons( $meta ) {

		include eggz_reservations_get_template( 'single-reservation-persons', 'single' );

	} // single_reservation_persons()

	/**
	 * Includes the single reservation content
	 */
	public function single_reservation_content() {

		include eggz_reservations_get_template( 'single-reservation-content', 'single' );

	} // single_reservation_content()

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
	 * Include the single reservation thumbnail
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
