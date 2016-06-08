<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link 		http://enwebo.com
 * @since 		1.0.0
 *
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since 		1.0.0
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 * @author 		Your Name <contact@enwebo.com>
 */
class Eggz_Reservations {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name 	= 'eggz-reservations';
		$this->version 		= '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_template_hooks();
		$this->define_metabox_hooks();
		$this->define_cpt_and_tax_hooks();

	} // __construct()

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Eggz_Reservations_Loader. Orchestrates the hooks of the plugin.
	 * - Eggz_Reservations_i18n. Defines internationalization functionality.
	 * - Eggz_Reservations_Admin. Defines all hooks for the admin area.
	 * - Eggz_Reservations_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-i18n.php';

		/**
		 * The class responsible for sanitizing user input
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-sanitizer.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-public.php';

		/**
		 * The class responsible for defining all actions relating to metaboxes.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-metaboxes.php';

		/**
		 * The class responsible for defining all actions relating to the reservation custom post type.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-cpt-reservation.php';

		/**
		 * The class responsible for defining all actions relating to the Table taxonomy.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-tax-table.php';

		/**
		 * The class responsible for defining all actions creating the templates.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-templates.php';

		/**
		 * The class responsible for all global functions.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/global-functions.php';

		/**
		 * The class with methods shared by admin and public
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'classes/class-shared.php';

		$this->loader 		= new Eggz_Reservations_Loader();
		$this->sanitizer 	= new Eggz_Reservations_Sanitize();

	} // load_dependencies()

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Eggz_Reservations_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Eggz_Reservations_i18n();

		$this->loader->action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	} // set_locale()

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Eggz_Reservations_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->action( 'admin_init', $plugin_admin, 'register_fields' );
		$this->loader->action( 'admin_init', $plugin_admin, 'register_sections' );
		$this->loader->action( 'admin_init', $plugin_admin, 'register_settings' );
		$this->loader->action( 'admin_menu', $plugin_admin, 'add_menu' );
		$this->loader->action( 'plugin_action_links_' . EGGZ_RESERVATIONS_FILE, $plugin_admin, 'link_settings' );
		$this->loader->action( 'plugin_row_meta', $plugin_admin, 'link_row_meta', 10, 2 );

	} // define_admin_hooks()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_cpt_and_tax_hooks() {

		$plugin_cpt_reservation = new Eggz_Reservations_CPT_Reservation( $this->get_plugin_name(), $this->get_version() );
		$this->loader->action( 'init', $plugin_cpt_reservation, 'new_cpt_reservation' );
		$this->loader->filter( 'manage_reservation_posts_columns', $plugin_cpt_reservation, 'reservation_register_columns' );
		$this->loader->action( 'manage_reservation_posts_custom_column', $plugin_cpt_reservation, 'reservation_column_content', 10, 2 );
		$this->loader->filter( 'manage_edit-reservation_sortable_columns', $plugin_cpt_reservation, 'reservation_sortable_columns', 10, 1 );
		$this->loader->action( 'request', $plugin_cpt_reservation, 'reservation_order_sorting', 10, 2 );
		$this->loader->action( 'init', $plugin_cpt_reservation, 'add_image_sizes' );


		$plugin_tax_table =new Eggz_Reservations_Tax_Table( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'init', $plugin_tax_table, 'new_taxonomy_table' );

	} // define_cpt_and_tax_hooks()

	/**
	 * Register all of the hooks related to metaboxes
	 *
	 * @since 		1.0.0
	 * @access 		private
	 */
	private function define_metabox_hooks() {

		$plugin_metaboxes = new Eggz_Reservations_Admin_Metaboxes( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'add_meta_boxes_reservation', $plugin_metaboxes, 'add_metaboxes' );
		$this->loader->action( 'save_post_reservation', $plugin_metaboxes, 'validate_meta', 10, 2 );
		//$this->loader->action( 'edit_form_after_title', $plugin_metaboxes, 'metabox_subtitle', 10, 2 );
		$this->loader->action( 'add_meta_boxes_reservation', $plugin_metaboxes, 'set_meta' );
		$this->loader->filter( 'post_type_labels_reservation', $plugin_metaboxes, 'change_featured_image_labels', 10, 1 );

	} // define_metabox_hooks()

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Eggz_Reservations_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		
		$this->loader->action( 'wp_ajax_nopriv_eggz_add_reservation', $plugin_public, 'eggz_add_reservation' );
		$this->loader->action( 'wp_ajax_eggz_add_reservation', $plugin_public, 'eggz_add_reservation' );

		$this->loader->action( 'wp_ajax_nopriv_eggz_delete_reservation', $plugin_public, 'eggz_add_reservation' );
		$this->loader->action( 'wp_ajax_eggz_delete_reservation', $plugin_public, 'eggz_add_reservation' );

		$this->loader->action( 'wp_ajax_nopriv_eggz_reservation_details', $plugin_public, 'eggz_reservation_details' );
		$this->loader->action( 'wp_ajax_eggz_reservation_details', $plugin_public, 'eggz_reservation_details' );

		$this->loader->filter( 'single_template', $plugin_public, 'single_cpt_template', 11 );

		$this->loader->shortcode( 'eggz-reservations-form', $plugin_public, 'eggz_reservations_form_book_a_table' );
		$this->loader->shortcode( 'eggz-reservations-list', $plugin_public, 'eggzreservations' );
		$this->loader->shortcode( 'eggz-reservations-hours', $plugin_public, 'eggz_reservations_hours_widget' );

		$this->loader->action( 'vc_before_init', $plugin_public, 'open_hours_integrateWithVC' );


		/**
		 * Action instead of template tag.
		 *
		 * do_action( 'actionname' );
		 * 		or
		 * echo apply_filters( 'actionname' );
		 *
		 * @link 	http://nacin.com/2010/05/18/rethinking-template-tags-in-plugins/
		 */
		$this->loader->action( 'actionname', $plugin_public, 'eggzreservations' );

		
		// $this->loader->action( 'eggz-reservations-before-loop', $plugin_public, 'eggz_reservations_form_book_a_table' );
		// $this->loader->action( 'eggz-reservations-before-loop', $plugin_public, 'eggz_reservations_form_reservation_details', 10, 3 );

	} // define_public_hooks()

	/**
	 * Register all of the hooks related to the templates.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_template_hooks() {

		$plugin_templates = new Eggz_Reservations_Templates( $this->get_plugin_name(), $this->get_version() );

		// Loop
		$this->loader->action( 'eggz-reservations-before-loop', 			$plugin_templates, 'loop_wrap_begin', 10, 1 );
		$this->loader->action( 'eggz-reservations-before-loop-content', 	$plugin_templates, 'loop_content_wrap_begin', 10, 2 );

		$this->loader->action( 'eggz-reservations-loop-content', 			$plugin_templates, 'loop_content_heading', 10, 2 );
		$this->loader->action( 'eggz-reservations-loop-content', 			$plugin_templates, 'loop_content_details', 20, 2 );

		$this->loader->action( 'eggz-reservations-after-loop-content', 		$plugin_templates, 'loop_content_wrap_end', 10, 2 );
		$this->loader->action( 'eggz-reservations-after-loop', 				$plugin_templates, 'loop_wrap_end', 10, 1 );


		// Single
		// $this->loader->action( 'eggz-reservations-single-content', 			$plugin_templates, 'single_reservation_thumbnail', 10 );
		$this->loader->action( 'eggz-reservations-single-content', 			$plugin_templates, 'single_reservation_posttitle', 10 );
		// $this->loader->action( 'eggz-reservations-single-content', 			$plugin_templates, 'single_reservation_subtitle', 20, 1 );
		$this->loader->action( 'eggz-reservations-single-content', 			$plugin_templates, 'single_reservation_content', 20 );
		$this->loader->action( 'eggz-reservations-single-content', 			$plugin_templates, 'single_reservation_date', 30 );
		$this->loader->action( 'eggz-reservations-single-content', 			$plugin_templates, 'single_reservation_time', 40 );
		$this->loader->action( 'eggz-reservations-single-content', 			$plugin_templates, 'single_reservation_persons', 50 );
		$this->loader->action( 'eggz-reservations-single-content', 			$plugin_templates, 'single_reservation_special_requests', 60 );
		$this->loader->action( 'eggz-reservations-single-content', 			$plugin_templates, 'single_reservation_meta_field', 70, 1 );

	} // define_template_hooks()

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		$this->loader->run();

	} // run()

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {

		return $this->plugin_name;

	} // get_plugin_name()

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 *
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {

		return $this->loader;

	} // get_loader()

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 *
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {

		return $this->version;

	} // get_version()

} // class
