<?php
/**
 * The metabox-specific functionality of the plugin.
 *
 * @link 		http://enwebo.com
 * @since 		1.0.0
 *
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 */

/**
 * The metabox-specific functionality of the plugin.
 *
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 * @author 		Slushman <contact@enwebo.com>
 */
class Eggz_Reservations_Admin_Metaboxes {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

	/**
	 * The ID of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$plugin_name 		The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$version 			The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 		1.0.0
	 * @param 		string 			$plugin_name 		The name of this plugin.
	 * @param 		string 			$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

	} // __construct()

	/**
	 * Registers metaboxes with WordPress
	 *
	 * @since 	1.0.0
	 * @access 	public
	 */
	public function add_metaboxes() {

		//remove_meta_box( 'postimagediv', 'employee', 'side' );

		// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args );

		add_meta_box(
			'eggz_reservations_table',
			apply_filters( $this->plugin_name . '-metabox-name-title', esc_html__( 'Reservation Details', 'eggz-reservations' ) ),
			array( $this, 'metabox' ),
			'reservation',
			'normal',
			'default',
			array(
				'file' => 'details'
			)
		);

	} // add_metaboxes()

	/**
	 * Changes strings referencing Featured Images
	 *
	 * @see 		https://developer.wordpress.org/reference/hooks/post_type_labels_post_type/
	 *
	 * @param 		object 		$labels 		Current post type labels
	 * @return 		object 						Modified post type labels
	 */
	public function change_featured_image_labels( $labels ) {

		$labels->featured_image 		= esc_html__( 'Featured Image', 'eggz-reservations' );
		$labels->set_featured_image 	= esc_html__( 'Set featured image', 'eggz-reservations' );
		$labels->remove_featured_image 	= esc_html__( 'Remove featured image', 'eggz-reservations' );
		$labels->use_featured_image 	= esc_html__( 'Use as featured image', 'eggz-reservations' );

		return $labels;

	} // change_featured_image_labels()

	/**
	 * Check each nonce. If any don't verify, $nonce_check is increased.
	 * If all nonces verify, returns 0.
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		int 		The value of $nonce_check
	 */
	private function check_nonces( $posted ) {

		$nonces 		= array();
		$nonce_check 	= 0;

		$nonces[] 	= 'nonce_eggz_reservations_table';

		foreach ( $nonces as $nonce ) {

			if ( ! isset( $posted[$nonce] ) ) { $nonce_check++; }
			if ( isset( $posted[$nonce] ) && ! wp_verify_nonce( $posted[$nonce], $this->plugin_name ) ) { $nonce_check++; }

		}

		return $nonce_check;

	} // check_nonces()

	/**
	 * Returns an array of the all the metabox fields and their respective types
	 *
	 * $fields[] 	= array( 'field-name', 'field-type', 'Field Label' );
	 *
	 * @since 		1.0.0
	 * @access 		public
	 * @return 		array 		Metabox fields and types
	 */
	private function get_metabox_fields() {

		$fields = array();

		$fields[] 	= array( 'field-name', 'field-type', 'Field Label' );
		$fields[] = array( 'repeat-test', 'repeater', array( array( 'test1', 'text' ), array( 'test2', 'text' ), array( 'test3', 'text' ) ) );

		return $fields;

	} // get_metabox_fields()

	/**
	 * Calls a metabox file specified in the add_meta_box args.
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @return 	void
	 */
	public function metabox( $post, $params ) {

		if ( ! is_admin() ) { return; }
		if ( 'reservation' != $post->post_type ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/metaboxes/metabox-' . $params['args']['file'] . '.php' );

	} // metabox()

	/**
	 * Add subtitle field to post editor
	 */
	public function metabox_subtitle( $post ) {

		if ( ! is_admin() ) { return; }
		if ( 'reservation' !== $post->post_type ) { return; }

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/metaboxes/metabox-subtitle.php' );

	} // metabox_subtitle()

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {

		global $post;

		if ( empty( $post ) ) { return; }
		if ( 'reservation' != $post->post_type ) { return; }

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()


	/**
	 * Saves metabox data
	 *
	 * Repeater section works like this:
	 *  	Loops through meta fields
	 *  		Loops through submitted data
	 *  		Sanitizes each field into $clean array
	 *   	Gets max of $clean to use in FOR loop
	 *   	FOR loops through $clean, adding each value to $new_value as an array
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @param 	int 		$post_id 		The post ID
	 * @param 	object 		$object 		The post object
	 * @return 	void
	 */
	public function validate_meta( $post_id, $object ) {

		//wp_die( '<pre>' . print_r( $_POST ) . '</pre>' );
		//
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }
		if ( ! current_user_can( 'edit_post', $post_id ) ) { return $post_id; }
		if ( 'job' !== $object->post_type ) { return $post_id; }

		$nonce_check = $this->check_nonces( $_POST );

		if ( 0 < $nonce_check ) { return $post_id; }

		$metas = $this->get_metabox_fields();

		foreach ( $metas as $meta ) {

			$name = $meta[0];
			$type = $meta[1];

			if ( 'repeater' === $type && is_array( $meta[2] ) ) {

				$clean = array();

				foreach ( $meta[2] as $field ) {

					foreach ( $_POST[$field[0]] as $data ) {

						if ( empty( $data ) ) { continue; }

						$clean[$field[0]][] = $this->sanitizer( $field[1], $data );

					} // foreach

				} // foreach

				$count 		= eggz_reservations_get_max( $clean );
				$new_value 	= array();

				for ( $i = 0; $i < $count; $i++ ) {

					foreach ( $clean as $field_name => $field ) {

						$new_value[$i][$field_name] = $field[$i];

					} // foreach $clean

				} // for

			} else {

				$new_value = $this->sanitizer( $type, $_POST[$name] );

			}

			update_post_meta( $post_id, $name, $new_value );

		} // foreach

	} // validate_meta()

} // class
