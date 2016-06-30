<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link 		http://enwebo.com
 * @since 		1.0.0
 *
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 * @author 		Enwebo <contact@enwebo.com>
 */
class Eggz_Reservations_Admin {

	/**
	 * The plugin options.
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$options 		The plugin options.
	 */
	private $options;

	/**
	 * The ID of this plugin.
	 *
	 * @since    	1.0.0
	 * @access   	private
	 * @var      	string    		$plugin_name 		The ID of this plugin.
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
	 * @param 		string 		$plugin_name 		The name of this plugin.
	 * @param 		string 		$version 			The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

		$this->set_options();

	} // __construct()


	/**
     * Adds notices for the admin to display.
     * Saves them in a temporary plugin option.
     * This method is called on plugin activation, so its needs to be static.
     */
    public static function add_admin_notices() {

    	$notices 	= get_option( 'eggz_reservations_deferred_admin_notices', array() );

  		$notices[] 	= array( 'class' => 'updated', 'notice' => esc_html__( 'Eggz Reservations: Custom Activation Message', 'eggz-reservations' ) );
  		$notices[] 	= array( 'class' => 'error', 'notice' => esc_html__( 'Eggz Reservations: Problem Activation Message', 'eggz-reservations' ) );

  		apply_filters( 'eggz_reservations_admin_notices', $notices );
  		update_option( 'eggz_reservations_deferred_admin_notices', $notices );

    } // add_admin_notices


	/**
	 * Adds a settings page link to a menu
	 *
	 * @link 		https://codex.wordpress.org/classesistration_Menus
	 * @since 		1.0.0
	 */
	public function add_menu() {

		// Top-level page
		// add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );

		// Submenu Page
		// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);

		add_submenu_page(
			'edit.php?post_type=reservation',
			apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'Reservations Settings', 'plugin-name' ) ),
			apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Settings', 'plugin-name' ) ),
			'manage_options',
			$this->plugin_name . '-settings',
			array( $this, 'page_options' )
		);

		add_submenu_page(
			'edit.php?post_type=reservation',
			apply_filters( $this->plugin_name . '-settings-page-title', esc_html__( 'Reservations Help', 'plugin-name' ) ),
			apply_filters( $this->plugin_name . '-settings-menu-title', esc_html__( 'Help', 'plugin-name' ) ),
			'manage_options',
			$this->plugin_name . '-help',
			array( $this, 'page_help' )
		);

	} // add_menu()


	/**
     * Manages any updates or upgrades needed before displaying notices.
     * Checks plugin version against version required for displaying
     * notices.
     */
	public function admin_notices_init() {

		$current_version = '1.0.0';

		if ( $this->version !== $current_version ) {

			// Do whatever upgrades needed here.
			update_option('my_plugin_version', $current_version);

			$this->add_notice();

		}

	} // admin_notices_init()

	/**
	 * Displays admin notices
	 *
	 * @return 	string 			Admin notices
	 */
	public function display_admin_notices() {

		$notices = get_option( 'eggz_reservations_deferred_admin_notices' );

		if ( empty( $notices ) ) { return; }

		foreach ( $notices as $notice ) {

			echo '<div class="' . esc_attr( $notice['class'] ) . '"><p>' . $notice['notice'] . '</p></div>';

		}

		delete_option( 'eggz_reservations_deferred_admin_notices' );

    } // display_admin_notices()

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name . '-bootstrap', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/bootstrap.css' );
		wp_enqueue_style( $this->plugin_name . '-timepicker', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/bootstrap-datetimepicker.min.css' );
		wp_enqueue_style( $this->plugin_name . '-select', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/bootstrap-select.min.css' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/eggz-reservations-admin.css', array(), $this->version, 'all' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/eggz-reservations-admin.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name .'-file-uploader', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/eggz-reservations-file-uploader.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( $this->plugin_name .'-repeater', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/eggz-reservations-repeater.min.js', array( 'jquery' ), $this->version, true );

		$localize['repeatertitle'] = __( 'File Name', 'eggz-reservations' );

		wp_localize_script( 'eggz-reservations', 'erdata', $localize );


		wp_enqueue_script( $this->plugin_name . '-select', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/bootstrap-select.min.js', array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name . '-tether', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/tether.min.js', array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name . '-bootstrap', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/bootstrap.min.js', array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name . '-moment', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/moment.js', array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name . '-timepicker', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/bootstrap-datetimepicker.min.js', array( 'jquery' ) );



	} // enqueue_scripts()

	/**
	 * Creates a checkbox field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_checkbox( $args ) {

		$defaults['class'] 			= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['value'] 			= 0;

		/**
		 * plugin-name-field-checkbox-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( $this->plugin_name . '-field-checkbox-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/field-checkbox.php' );

	} // field_checkbox()

	/**
	 * Creates an editor field
	 *
	 * NOTE: ID must only be lowercase letter, no spaces, dashes, or underscores.
	 *
	 * @param 	array 		$args 			The arguments for the field
	 * @return 	string 						The HTML field
	 */
	public function field_editor( $args ) {

		$defaults['description'] 	= '';
		$defaults['settings'] 		= array( 'textarea_name' => $this->plugin_name . '-options[' . $args['id'] . ']' );
		$defaults['value'] 			= '';

		$defaults = apply_filters( $this->plugin_name . '-field-editor-options-defaults', $defaults );
		$atts = wp_parse_args( $args, $defaults );
		if ( ! empty( $this->options[$atts['id']] ) ) {
			$atts['value'] = $this->options[$atts['id']];
		}
		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/field-editor.php' );
	} // field_editor()


	/**
	 * Creates a set of radios field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_radios( $args ) {

		$defaults['class'] 			= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['value'] 			= 0;

		/**
		 * plugin-name-field-radios-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( $this->plugin_name . '-field-radios-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/field-radios.php' );

	} // field_radios()


	/**
	 * Creates a repeater field
	 *
	 * Note: label is blank since its created in the Settings API
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_repeater( $args ) {

		$defaults['class'] 			= 'repeater';
		$defaults['fields'] 		= array();
		$defaults['id'] 			= '';
		$defaults['label-add'] 		= esc_html__( 'Add Item', 'eggz-reservations' );
		$defaults['label-edit'] 	= esc_html__( 'Edit Item', 'eggz-reservations' );
		$defaults['label-header'] 	= esc_html__( 'Item Name', 'eggz-reservations' );
		$defaults['label-remove'] 	= esc_html__( 'Remove Item', 'eggz-reservations' );
		$defaults['title-field'] 	= '';
/*
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
*/
		$defaults 	= apply_filters( $this->plugin_name . '-field-repeater-options-defaults', $defaults );
		$setatts 	= wp_parse_args( $args, $defaults );
		$count 		= 1;
		$repeater 	= array();

		if ( ! empty( $this->options[$setatts['id']] ) ) {

			$repeater = maybe_unserialize( $this->options[$setatts['id']] );

		}

		if ( ! empty( $repeater ) ) {

			$count = count( $repeater );

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/field-repeater.php' );
	} // field_repeater()


	/**
	 * Creates a select field
	 *
	 * Note: label is blank since its created in the Settings API
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_select( $args ) {

		$defaults['aria'] 			= '';
		$defaults['blank'] 			= '';
		$defaults['class'] 			= '';
		$defaults['context'] 		= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['selections'] 	= array();
		$defaults['value'] 			= '';

		/**
		 * plugin-name-field-select-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( $this->plugin_name . '-field-select-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		if ( empty( $atts['aria'] ) && ! empty( $atts['description'] ) ) {

			$atts['aria'] = $atts['description'];

		} elseif ( empty( $atts['aria'] ) && ! empty( $atts['label'] ) ) {

			$atts['aria'] = $atts['label'];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/field-select.php' );

	} // field_select()

	/**
	 * Creates a text field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_text( $args ) {

		$defaults['class'] 			= 'text widefat';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['type'] 			= 'text';
		$defaults['value'] 			= '';

		/**
		 * plugin-name-field-text-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( $this->plugin_name . '-field-text-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/field-text.php' );

	} // field_text()



	/**
	 * Creates a file upload field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_file_upload( $args ) {

		$defaults['class'] 			= 'widefat url-file';
		$defaults['description'] 	= '';
		$defaults['id'] 			= 'url-file';
		$defaults['label'] 			= 'File';
		$defaults['label-remove'] 	= 'Remove File';
		$defaults['label-upload'] 	= 'Choose/Upload File';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['placeholder'] 	= '';
		$defaults['type'] 			= 'url';
		$defaults['value'] 			= '';


		/**
		 * eggz-reservations-field-file-upload-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( $this->plugin_name . '-field-file-upload-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/field-file-upload.php' );

	} // field_file_upload()




	/**
	 * Creates a textarea field
	 *
	 * @param 	array 		$args 			The arguments for the field
	 *
	 * @return 	string 						The HTML field
	 */
	public function field_textarea( $args ) {

		$defaults['class'] 			= 'large-text';
		$defaults['cols'] 			= 50;
		$defaults['context'] 		= '';
		$defaults['description'] 	= '';
		$defaults['label'] 			= '';
		$defaults['name'] 			= $this->plugin_name . '-options[' . $args['id'] . ']';
		$defaults['rows'] 			= 10;
		$defaults['value'] 			= '';

		/**
		 * plugin-name-field-textarea-options-defaults filter
		 *
		 * @param 	array 	$defaults 		The default settings for the field
		 */
		$defaults 	= apply_filters( $this->plugin_name . '-field-textarea-options-defaults', $defaults );
		$atts 		= wp_parse_args( $args, $defaults );

		if ( ! empty( $this->options[$atts['id']] ) ) {

			$atts['value'] = $this->options[$atts['id']];

		}

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/fields/field-textarea.php' );

	} // field_textarea()

	/**
	 * Returns an array of options names, fields types, and default values
	 *
	 * @return 		array 			An array of options
	 */
	public static function get_options_list() {

		$options = array();

		$options[] = array( 'days-for-reservations', 'text', '' );
		$options[] = array( 'persons-for-reservations', 'text', '' );
		$options[] = array( 'reservation-details-background', 'text', '' );
		$options[] = array( 'reservation-successful-background', 'text', '' );
		$options[] = array( 'select-field', 'select', '' );
		$options[] = array( 'open-hours', 'repeater', array( array( 'day', 'text', 'Monday' ), array( 'open_hours', 'text', '12:00 AM' ), array( 'close_hours', 'text', '12:00 PM' ) ) );
		$options[] = array( 'howtoapply', 'editor', '' );


		return $options;

	} // get_options_list()

	/**
	 * Adds a link to the plugin settings page
	 *
	 * @since 		1.0.0
	 *
	 * @param 		array 		$links 		The current array of links
	 *
	 * @return 		array 					The modified array of links
	 */
	public function link_settings( $links ) {

		$links[] = sprintf( '<a href="%s">%s</a>', admin_url( 'edit.php?post_type=reservation&page=eggz-reservations-settings' ), esc_html__( 'Settings', 'plugin-name' ) );

		return $links;

	} // link_settings()

	/**
	 * Adds links to the plugin links row
	 *
	 * @since 		1.0.0
	 *
	 * @param 		array 		$links 		The current array of row links
	 * @param 		string 		$file 		The name of the file
	 *
	 * @return 		array 					The modified array of row links
	 */
	public function link_row_meta( $links, $file ) {

		if ( $file == EGGZ_RESERVATIONS_FILE ) {

			$links[] = '<a href="http://twitter.com/enwebo">Enwebo</a>';

		}

		return $links;

	} // link_row_meta()

	/**
	 * Includes the help page view
	 *
	 * @since 		1.0.0
	 *
	 * @return 		void
	 */
	public function page_help() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/pages/page-help.php' );

	} // page_help()

	/**
	 * Includes the options page view
	 *
	 * @since 		1.0.0
	 *
	 * @return 		void
	 */
	public function page_options() {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/pages/page-settings.php' );

	} // page_options()

	/**
	 * Registers settings fields with WordPress
	 */
	public function register_fields() {

		// add_settings_field( $id, $title, $callback, $menu_slug, $section, $args );

		add_settings_field(
			'days-for-reservations',
			apply_filters( $this->plugin_name . '-label-text-field', esc_html__( 'Number of days for reservations', 'eggz-reservations' ) ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-settingssection',
			array(
				'description' 	=> __( 'Number of days for upcoming reservations.', 'eggz-reservations' ),
				'id' 			=> 'days-for-reservations',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'persons-for-reservations',
			apply_filters( $this->plugin_name . '-label-text-field', esc_html__( 'Number of max persons per reservation', 'eggz-reservations' ) ),
			array( $this, 'field_text' ),
			$this->plugin_name,
			$this->plugin_name . '-settingssection',
			array(
				'description' 	=> __( 'Number of days for upcoming reservations.', 'eggz-reservations' ),
				'id' 			=> 'persons-for-reservations',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'reservation-details-background',
			apply_filters( $this->plugin_name . '-label-file-upload-field', esc_html__( 'Reservation details background image', 'eggz-reservations' ) ),
			array( $this, 'field_file_upload' ),
			$this->plugin_name,
			$this->plugin_name . '-settingssection',
			array(
				'description' 	=> __( 'Background image for reservation details section.', 'eggz-reservations' ),
				'id' 			=> 'reservation-details-background',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'reservation-successful-background',
			apply_filters( $this->plugin_name . '-label-file-upload-field', esc_html__( 'Reservation successful background image', 'eggz-reservations' ) ),
			array( $this, 'field_file_upload' ),
			$this->plugin_name,
			$this->plugin_name . '-settingssection',
			array(
				'description' 	=> __( 'Background image for reservation successful section.', 'eggz-reservations' ),
				'id' 			=> 'reservation-successful-background',
				'value' 		=> '',
			)
		);

		add_settings_field(
			'select-field',
			apply_filters( $this->plugin_name . '-label-select-field', esc_html__( 'Select Field', 'eggz-reservations' ) ),
			array( $this, 'field_select' ),
			$this->plugin_name,
			$this->plugin_name . '-settingssection',
			array(
				'description' 	=> __( 'Select description.', 'eggz-reservations' ),
				'id' 			=> 'select-field',
				'selections'	=> array(
					array( 'label' => esc_html__( 'Label', 'eggz-reservations' ), 'value' => '1' ),
					array( 'label' => esc_html__( 'Label 2', 'eggz-reservations' ), 'value' => '2' ),
				),
				'value' 		=> ''
			)
		);

		add_settings_field(
			'open-hours',
			apply_filters( $this->plugin_name . 'label-open-hours', esc_html__( 'Open Hours', 'eggz-reservations' ) ),
			array( $this, 'field_repeater' ),
			$this->plugin_name,
			$this->plugin_name . '-settingssection',
			array(
				'description' 	=> 'Instructions for applying (contact email, phone, fax, address, etc).',
				'fields' 		=> array(
					array(
						'text' => array(
							'class' 		=> '',
							'description' 	=> '',
							'id' 			=> 'day',
							'label' 		=> '',
							'name' 			=> $this->plugin_name . '-options[day]',
							'placeholder' 	=> 'Monday',
							'type' 			=> 'text',
							'value' 		=> ''
						),
					),
					array(
						'text' => array(
							'class' 		=> 'timepicker',
							'description' 	=> '',
							'id' 			=> 'open_hours',
							'label' 		=> '',
							'name' 			=> $this->plugin_name . '-options[open_hours]',
							'placeholder' 	=> '10: 00 AM',
							'type' 			=> 'text',
							'value' 		=> ''
						),
					),
					array(
						'text' => array(
							'class' 		=> 'timepicker',
							'description' 	=> '',
							'id' 			=> 'close_hours',
							'label' 		=> '',
							'name' 			=> $this->plugin_name . '-options[close_hours]',
							'placeholder' 	=> '12: 00 PM',
							'type' 			=> 'text',
							'value' 		=> ''
						),
					),
				),
				'id' 			=> 'open-hours',
				'label-add' 	=> 'Add Hours',
				'label-edit' 	=> 'Edit Hours',
				'label-header' 	=> 'Day',
				'label-remove' 	=> 'Remove Hours',
				'title-field' 	=> 'day'
			)
		);

		add_settings_field(
			'how-to-apply',
			apply_filters( $this->plugin_name . 'label-editor-field', esc_html__( 'Editor Field', 'eggz-reservations' ) ),
			array( $this, 'field_editor' ),
			$this->plugin_name,
			$this->plugin_name . '-settingssection',
			array(
				'description' 	=> __( 'Editor field description.', 'eggz-reservations' ),
				'id' 			=> 'howtoapply'
			)
		);

	} // register_fields()

	/**
	 * Registers settings sections with WordPress
	 */
	public function register_sections() {

		// add_settings_section( $id, $title, $callback, $menu_slug );

		add_settings_section(
			$this->plugin_name . '-settingssection',
			apply_filters( $this->plugin_name . '-section-settingssection-title', esc_html__( '', 'eggz-reservations' ) ),
			array( $this, 'section_settingssection' ),
			$this->plugin_name
		);

	} // register_sections()

	/**
	 * Registers plugin settings
	 *
	 * @since 		1.0.0
	 */
	public function register_settings() {

		// register_setting( $option_group, $option_name, $sanitize_callback );

		register_setting(
			$this->plugin_name . '-options',
			$this->plugin_name . '-options',
			array( $this, 'validate_options' )
		);

	} // register_settings()


	private function sanitizer( $type, $data ) {

		if ( empty( $type ) ) { return; }
		if ( empty( $data ) ) { return; }

		$return 	= '';
		$sanitizer 	= new Eggz_Reservations_Sanitize();

		$return = $sanitizer->clean( $data , $type );

		unset( $sanitizer );

		return $return;

	} // sanitizer()

	/**
	 * Displays a settings section
	 *
	 * @since 		1.0.0
	 *
	 * @param 		array 		$params 		Array of parameters for the section
	 *
	 * @return 		mixed 						The settings section
	 */
	public function section_settingssection( $params ) {

		include( plugin_dir_path( dirname( __FILE__ ) ) . 'views/sections/section-settingssection.php' );

	} // section_settingssection()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	} // set_options()

	/**
	 * Validates saved options
	 *
	 * @since 		1.0.0
	 *
	 * @param 		array 		$input 			array of submitted plugin options
	 *
	 * @return 		array 						array of validated plugin options
	 */
	public function validate_options( $input ) {

		// wp_die( print_r( $input ) );
		//
		$valid 		= array();
		$options 	= $this->get_options_list();

		foreach ( $options as $option ) {

			$name = $option[0];
			$type = $option[1];

			if ( 'repeater' === $type && is_array( $option[2] ) ) {

				$clean = array();

				foreach ( $option[2] as $field ) {

					foreach ( $input[$field[0]] as $data ) {

						if ( empty( $data ) ) { continue; }

						$clean[$field[0]][] = $this->sanitizer( $field[1], $data );

					} // foreach

				} // foreach

				$count = eggz_reservations_get_max( $clean );

				for ( $i = 0; $i < $count; $i++ ) {

					foreach ( $clean as $field_name => $field ) {

						$valid[$option[0]][$i][$field_name] = $field[$i];

					} // foreach $clean

				} // for

			} else {

				$valid[$option[0]] = $this->sanitizer( $type, $input[$name] );

			}

			/* if ( ! isset( $input[$option[0]] ) ) { continue; }

			$sanitizer = new Eggz_Reservations_Sanitize();

			$valid[$option[0]] = $sanitizer->clean( $input[$option[0]], $option[1] );

			if ( $valid[$option[0]] != $input[$option[0]] ) {

				add_settings_error( $option[0], $option[0] . '_error', esc_html__( $option[0] . ' error.', 'eggz-reservations' ), 'error' );

			}

			unset( $sanitizer ); */


		}

		return $valid;

	} // validate_options()

} // class
