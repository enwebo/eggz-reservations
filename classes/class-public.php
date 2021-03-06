<?php

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
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package 	Eggz_Reservations
 * @subpackage 	Eggz_Reservations/classes
 * @author 		Enwebo <contact@enwebo.com>
 */
class Eggz_Reservations_Public {

	/**
	 * The post meta data
	 *
	 * @since 		1.0.0
	 * @access 		private
	 * @var 		string 			$meta    			The post meta data.
	 */
	private $meta;

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

	public $fields;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name 	= $plugin_name;
		$this->version 		= $version;

		$this->set_options();
		$this->set_meta();
		$this->set_fields();

	} // __construct()

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/eggz-reservations-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');

		/*wp_enqueue_style( $this->plugin_name . '-bootstrap', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/bootstrap.css' );*/
		wp_dequeue_script( 'font-awesome' );
		wp_enqueue_style( 'font-awesome', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/fonts/font-awesome-4.6.3/css/font-awesome.min.css' );
		wp_enqueue_style( $this->plugin_name . '-tether', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/tether.min.css' );
		wp_enqueue_style( $this->plugin_name . '-timepicker', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/bootstrap-datetimepicker.min.css' );
		wp_dequeue_script( 'bootstrap-select' );
		wp_enqueue_style( 'bootstrap-select', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/css/bootstrap-select.min.css' );
		wp_dequeue_style( 'style' );
		wp_enqueue_style( 'style' );

	} // enqueue_styles()

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'validation', '//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js', array( 'jquery' ) );

		wp_dequeue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-core');

		wp_dequeue_script( 'bootstrap' );
		wp_enqueue_script( 'bootstrap', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/bootstrap.min.js', array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name . '-tether', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/tether.min.js', array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name . '-moment', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/moment.js', array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name . '-timepicker', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/bootstrap-datetimepicker.min.js', array( 'jquery' ) );
		wp_enqueue_script( $this->plugin_name . '-select', plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/bootstrap-select.min.js', array( 'jquery' ) );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( dirname( __FILE__ ) ) . 'assets/js/eggz-reservations-public.js', array( 'jquery' ), $this->version, true );



		//localize data for script
		wp_localize_script( $this->plugin_name, 'POST_SUBMITTER', array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'open_hours' => $this->get_open_hours(),
				'date_picker_days' => $this->get_reservations_days( 14 ),
				'root' => esc_url_raw( rest_url() ),
				'nonce' => wp_create_nonce( 'eggz_reservations' ),
				'success' => __( 'Thanks for your submission!', 'your-text-domain' ),
				'failure' => __( 'Your submission could not be processed.', 'your-text-domain' ),
				'current_user_id' => get_current_user_id()
			)
		);

	} // enqueue_scripts()


	/**
	 * Get numper of days for reservation.
	 *
	 * @param   $daysno 	set default number of days
	 * @return  int 		number of days for booking,
	 *                      $daysno if plugin option is not set.
	 */

	public function set_fields() {

		$this->fields = array(
			'date' => array(
				'meta-field' => 'reservation_date',
				'name' => __( "Date", "eggz-reservations" ),
				'value' => ''
			),
			'time' => array(
				'meta-field' => 'reservation_time',
				'name' => __( "Time", "eggz-reservations" ),
				'value' => ''
			),
			'persons' => array(
				'meta-field' => 'reservation_persons',
				'name' => __( "Persons", "eggz-reservations" ),
				'value' => ''
			),
			'email' => array(
				'meta-field' => 'reservation_email',
				'name' => __( "Email", "eggz-reservations" ),
				'value' => ''
			),
			'phone' => array(
				'meta-field' => 'reservation_phone',
				'name' => __( "Phone", "eggz-reservations" ),
				'value' => ''
			),
			'name' => array(
				'meta-field' => 'reservation_name',
				'name' => __( "Name", "eggz-reservations" ),
				'value' => ''
			),
			'request' => array(
				'meta-field' => 'reservation_special_request',
				'name' => __( "Special Request", "eggz-reservations" ),
				'value' => '<a class="empty-field">-</a>'
			)
		);

	}

	/**
	 * Get numper of days for reservation.
	 *
	 * @param   $daysno 	set default number of days
	 * @return  int 		number of days for booking,
	 *                      $daysno if plugin option is not set.
	 */

	public function get_reservations_days( $daysno ) {

		if ( isset( $this->options['days-for-reservations'] ) && $this->options['days-for-reservations'] != '' ) {

			$daysno = $this->options['days-for-reservations'];

		}

		return $daysno;

	}

	/**
	 * Get numper of persons for reservation.
	 *
	 * @param   $personsno 	set default number of persons
	 * @return  int 		number of persons for booking,
	 *                      $personsno if plugin option is not set.
	 */

	public function get_reservation_persons_limit( $personsno ) {

		if ( isset( $this->options['persons-for-reservations'] ) && $this->options['persons-for-reservations'] != '' ) {

			$personsno = $this->options['persons-for-reservations'];

		}

		return $personsno;

	}

	/**
	 * Get reservation details background.
	 * @return  string 		image url for reservation details
	 */

	public function get_reservation_details_background( $details_background = '' ) {

		if ( isset( $this->options['reservation-details-background'] ) && $this->options['reservation-details-background'] != '' ) {

			$details_background = $this->options['reservation-details-background'];

		}

		return $details_background;

	}

	/**
	 * Get reservation successful background.
	 * @return  string 		image url for reservation successful
	 */

	public function get_reservation_successful_background( $successful_background = '' ) {

		if ( isset( $this->options['reservation-successful-background'] ) && $this->options['reservation-successful-background'] != '' ) {

			$successful_background = $this->options['reservation-successful-background'];

		}

		return $successful_background;

	}

	/**
	 * Get opening/closing hours for reservations.
	 *
	 * @return 	array 	returns an array with opening and closing hours foreach day of reservations.
	 */

	public function get_open_hours() {

		if ( !isset( $this->options['open-hours'] ) ) { return false; }

		$days_number = $this->get_reservations_days(14);
		$open_hours = $this->options['open-hours'];

		for ( $i = 0; $i < $days_number; $i++ ) {

			$day_of_week = $i % 7;

			if ( isset ( $open_hours[$day_of_week] ) ) {

				$all[$i]['open'] 	= isset( $open_hours[$day_of_week]['open_hours'] ) ? $open_hours[$day_of_week]['open_hours'] : '';
				$all[$i]['close'] 	= isset( $open_hours[$day_of_week]['close_hours'] ) ? $open_hours[$day_of_week]['close_hours'] : '';

			}

			$all[$i]['day'] 	= date( "l", time() + 86400 * $i );
			$all[$i]['dayno'] 	= date( "d", time() + 86400 * $i );
			$all[$i]['wday'] 	= $day_of_week;

		}

		unset($open_hours);

		return $all;

	}

	public function get_hours_by_day($day) {
		if ( $day )

		$data = array(
		    'ceva' => 'ceva2'
		);
		$optionss = $this->options['open-hours'];
		foreach ($optionss as $key => $value) {
			$all[ $value['day'] ] = $value;
		}
		$reshuffled_data = json_encode( $all );
		return $all;
	}

	/**
	 * Sets the class variable $options
	 */
	public function set_meta() {

		global $post;

		if ( empty( $post ) ) { return; }
		if ( 'reservation' !== $post->post_type ) { return; }

		$this->meta = get_post_custom( $post->ID );

	} // set_meta()

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	} // set_options()

	/**
	 * Adds a default single view template for a job opening
	 *
	 * @param 	string 		$template 		The name of the template
	 * @return 	mixed 						The single template
	 */
	public function single_cpt_template( $template ) {

		global $post;

		$return = $template;

	    if ( $post->post_type == 'reservation' ) {

			$return = eggz_reservations_get_template( 'single-reservation' );

		}

		return $return;

	} // single_cpt_template()


	/**
	 * Processes shortcode shortcodename
	 *
	 * @param 	array 	$atts 		Shortcode attributes
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function eggzreservations( $atts = array() ) {

		ob_start();

		$defaults['taxonomyname'] 	= '';
		$defaults['loop-template'] 	= $this->plugin_name . '-loop';
		$defaults['order'] 			= 'ASC';
		$defaults['quantity'] 		= 100;
		$defaults['show'] 			= '';
		$args						= shortcode_atts( $defaults, $atts, 'eggz-reservations-LIST' );
		$shared 					= new Eggz_Reservations_Shared( $this->plugin_name, $this->version );
		$items 						= $shared->query( $args );

		if ( is_array( $items ) || is_object( $items ) ) {

			include eggz_reservations_get_template( $args['loop-template'], 'loop' );

		} else {

			echo $items;

		}

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode_shortcodename()



	/**
	 * Processes shortcode shortcodename
	 *
	 * @param 	array 	$atts 		Shortcode attributes
	 *
	 * @return	mixed	$output		Output of the buffer
	 */
	public function eggz_reservations_hours_widget( $atts = array() ) {

		ob_start();

		if ( !isset( $this->options['open-hours'] ) ) { ?>

			<div class="eggz-box-text-container-wrapper">
				<p><?php _e( 'Please add opening hours in plugin settings.', 'eggz-reservations' ); ?></p>
			</div>

		<?php } else {

			$defaults['title'] 	= '';
			$args				= shortcode_atts( $defaults, $atts, 'eggz-reservations-hours' );

			if( $args['title'] != '' ) { ?>
				<div class="eggz-box-text-container-wrapper">

					<h3><?php echo $args['title']; ?></h3>
			<?php } ?>
					<div class="working-hours-table-container">
						<div class="working-hours-table">

						<?php
						$items = $this->options['open-hours'];

						if ( empty($items[0]['day']) ){

							_e( 'Please add opening hours in Eggz Reservations Plugin.', 'eggz-reservations' );

						} elseif ( is_array( $items ) || is_object( $items ) ) {

							foreach ( $items as $item ) { ?>

								<div class="working-hours-table-row">
									<div class="working-hours-table-cell">
										<?php echo $item['day']; ?>
									</div>
									<div class="working-hours-table-cell">
										<?php echo $item['open_hours']; ?>
									</div>
									<div class="working-hours-table-cell">
										<span class="line-separator"></span>
									</div>
									<div class="working-hours-table-cell">
										<?php echo $item['close_hours']; ?>
									</div>
								</div>

							<?php }

						} else {

							echo $items;

						} ?>

						</div>
					</div>
			<?php

			if( $args['title'] != '' ) { ?> </div> <?php }

			unset($items);
			unset($args);

		}

		$output = ob_get_contents();

		ob_end_clean();

		return $output;

	} // shortcode_shortcodename()


	/**
	 * Register reservations hours with Visual Composer.
	 */
	function open_hours_integrateWithVC() {
		vc_map(
			array(
				"name" => __( "Open Hours", "eggz-reservations" ),
				"base" => "eggz-reservations-hours",
				"class" => "",
				"category" => __( "Content", "eggz-reservations"),
				// 'admin_enqueue_js' => array( get_template_directory_uri() . '/vc_extend/bartag.js' ),
				// 'admin_enqueue_css' => array( get_template_directory_uri() . '/vc_extend/bartag.css' ),
				"params" => array(
					array(
						"type" => "textfield",
						"holder" => "div",
						"class" => "",
						"heading" => __( "Text", "eggz-reservations" ),
						"param_name" => "title",
						"value" => __( "Default param value", "eggz-reservations" ),
						"description" => __( "Description for foo param.", "eggz-reservations" )
					)
				)
			)
		);
	}


	/**
	 * Get reservation form.
	 *
	 * @returns 		Reservation form
	 */
	// eggz_reservations_get_template()
	function eggz_reservations_form_book_a_table() {

		ob_start(); ?>

			<div class="container-fluid eggz-reservations reservations-form">
				<form class="add-reservation-form">
					<?php wp_nonce_field( 'eggz_reservations' ); ?>
					<!-- Fullwidth Banner -->
					<div class="book-a-table-container">
						<div class="book-a-table-wrapper">
						  	<div class="row selects-container">

								<div class='col-sm-4'>
								    <div class="form-group">
								        <div class='input-group date' id='datepicker'>
								            <input type='text' class="form-control" name="datepicker" placeholder="MM/DD/YYYY" />
								            <span class="input-group-addon">
							                <span class="bs-caret">
							                	<span class="caret"></span>
							                </span>
								            </span>

								        </div>
								    </div>
								</div>

								<div class='col-sm-4'>
								    <div class="form-group">
								        <div class='input-group date' id='timepicker'>
								            <input type='text' class="form-control" name="timepicker" placeholder="HH:MM" />
								            <span class="input-group-addon">
							                <span class="bs-caret">
							                	<span class="caret"></span>
							                </span>
								            </span>
								        </div>
								    </div>
								</div>

							  	<div class="col-sm-4">
							  		<!-- Person Select -->

							  		<select required class="personspicker required selectpicker show-menu-arrow" name="personspicker">

							  		<?php
							  		$personsno = $this->get_reservation_persons_limit(12);

							  		for ($i=0; $i < $personsno; $i++) {

							  			if( $i == 0 ){

							  				echo '<option selected value="' . ( $i+1 ) . '">' . ( $i+1 ) . ' ' . __("Person", "eggz-reservations") . '</option>';

							  			}else{

							  				echo '<option value="' . ( $i+1 ) . '">' . ( $i+1 ) . ' ' . __("Persons", "eggz-reservations") . '</option>';

							  			}

							  		}

									?>
									</select>
									<!-- End Person Select -->
							  	</div>

						  	</div>

						  	<div class="bottom-btn-container align-center">

								<button type="button" class="eggz-btn-line" id="book-a-table-trigger">Book a table</button>

							</div>

					  	</div>
					</div>
				</form>
			</div>

			<?php
			$content = ob_get_clean();

		return $content;
	}

	/**
	 * Prepare to add a reservation.
	 *
	 * @returns 		Reservation details
	 */
	function eggz_reservation_details() {

			ob_start(); ?>
			<div class="container-fluid eggz-reservation-details-wrap eggz-reservation-row">
				<div class="eggz-reservation-form-poster eggz-overlay eggz-overlay-opacity-60 parallax" style="background-image: url('<?php echo $this->get_reservation_details_background(); ?>');">
					<div class="eggz-reservation-form-poster-container">
						<div class="eggz-reservation-form-poster-wrapper">
							<h1 class="special-heading vertical-lines"><?php _e( 'Details', 'eggz-reservations' ); ?></h1>
						</div>
					</div>
				</div>
				<div class="eggz-reservation-box-text-container">
					<div class="eggz-reservation-box-text-wrapper">
						<form class="eggz-reservations-details">
							<?php wp_nonce_field( 'eggz_reservations' ); ?>
							<input type="hidden" id="date" name="send_reservation_date" class="send-reservation-date" value="<?php echo $_POST['date']; ?>">
							<input type="hidden" id="time" name="send_reservation_time" class="send-reservation-time" value="<?php echo $_POST['time']; ?>">
							<input type="hidden" id="persons" name="send_reservation_persons" class="send-reservation-persons" value="<?php echo $_POST['persons']; ?>">

							<h2 class="reservation-details"><?php _e( "Reservation details", "eggz-reservations" ); ?></h2>
							<p>
								<span class="reservation-date"><?php _e('Date', 'eggz-reservations' ); echo ': '; echo $_POST['date']; ?></span> -
								<span class="reservation-time"><?php _e('Time', 'eggz-reservations' ); echo ': '; echo $_POST['time']; ?></span> -
								<span class="reservation-persons"><?php _e('Persons', 'eggz-reservations' ); echo ': '; echo $_POST['persons']; ?></span>
							</p>


							<div class="row row-no-gutters eggz-form-sm">

								<div class="col-sm-6">
									<input type="email" name="send_reservation_email" class="send-reservation-email datepicker" aria-required="true" placeholder="<?php _e( 'Email', 'eggz-reservations' ); ?>">
								</div>

								<div class="col-sm-6">
									<input type="text" name="send_reservation_phone" class="send-reservation-phone timepicker" aria-required="true" placeholder="<?php _e( 'Phone', 'eggz-reservations' ); ?>">
								</div>

								<div class="col-sm-12">
									<input type="text" name="send_reservation_name" class="send-reservation-full-name" placeholder="<?php _e( 'Full Name', 'eggz-reservations' ); ?>">
								</div>

								<div class="col-sm-12">

									<textarea name="send-reservation-special-request" class="send-reservation-special-request" placeholder="<?php _e( 'Any Special Requests?', 'eggz-reservations' ); ?>"></textarea>

								</div>

							</div>

							<div class="bottom-btn-container align-center">
								<button type="submit" class="eggz-btn-line add-reservation" id="add-a-reservation-trigger"><?php esc_attr_e( 'Send', 'eggz-reservations'); ?></button>
							</div>

						</form>
					</div>
				</div>
			</div>

			<?php
			$content = ob_get_clean();

		echo $content;
		exit;
	}



	/**
	 * Add reservation.
	 *
	 * @returns 		Reservation details
	 */

	public function eggz_show_reservation_details( $fields ) {

		ob_start(); ?>
		<div class="eggz-show-reservation-details-wrap eggz-reservation-row reverse-order">
			<div class="eggz-reservation-form-poster eggz-overlay eggz-overlay-opacity-60 parallax" style="background-image: url('<?php echo $this->get_reservation_successful_background(); ?>');">
				<div class="eggz-reservation-form-poster-container">
					<div class="eggz-reservation-form-poster-wrapper">
						<h1 class="special-heading vertical-lines"><?php _e( 'Thank You', 'eggz-reservations' ); ?></h1>
					</div>
				</div>
			</div>
			<div class="eggz-reservation-box-text-container">
				<div class="eggz-reservation-box-text-wrapper">
					<h2 class="reservation-details"><?php _e( "Reservation was successful :)", "eggz-reservations" ); ?></h2>

					<table class="details">
						<?php
						foreach ( $fields as $field ) { ?>
							<tr class="detail-row">
								<td class="detail-label"><?php echo $field['name']; ?>:</td>
								<td class="detail-value"><?php echo $field['value']; ?></td>
							</tr>
						<?php } ?>
					</table>

					<div class="bottom-btn-container align-right">
						<a class="eggz-btn-line line-right" href="<?php echo get_bloginfo('url'); ?>">Back</a>
					</div>
				</div>
			</div>
		</div>

		<?php
		$content = ob_get_clean();

		return $content;

	}

	/**
	 * Update reservation custom fielfd.
	 *
	 */

	public function eggz_update_reservation_meta( $post_id, $data ) {

		foreach ($this->fields as $key => $field) {

			if ( isset( $data[$key] ) && $data[$key] != '' ) {

				update_post_meta( $post_id, $field['meta-field'], $data[$key] );
				$this->fields[$key]['value'] = $data[$key];

			}

		}

	}

	/**
	 * Add reservation.
	 *
	 */

	public function eggz_add_reservation() {

		// Initialize the page ID to -1. This indicates no action has been taken.
		$post_id = -1;

		// Setup the author, slug, and title for the post
		$author_id = 1;

		if ( isset($_POST['title']) && $_POST['title'] != '' ) {
			$title = $_POST['title'];
			$slug = sanitize_title( $_POST['title'] );
		}

		// If the page doesn't already exist, then create it
		if( check_ajax_referer( 'eggz_reservations', 'nonce' ) ) {

			// Set the post ID so that we know the post was created successfully
			$post_id = wp_insert_post(
				array(
					'comment_status'	=>	'closed',
					'ping_status'		=>	'closed',
					'post_author'		=>	$author_id,
					'post_name'			=>	$slug,
					'post_title'		=>	$title,
					'post_status'		=>	'publish',
					'post_type'			=>	'reservation'
				)
			);

			$this->eggz_update_reservation_meta( $post_id, $_POST );

		} else {
	    		// Arbitrarily use -2 to indicate that the page with the title already exists
	    		$post_id = -2;

		} // end if
		// var_dump($_POST);
		echo $this->eggz_show_reservation_details( $this->fields );
		exit;

	} // end eggz_add_reservation


	/**
	 * Set table for reservation.
	 *
	 * @returns 		1 if the post was never created.
	 */

	public function eggz_set_reservation_table() {

		// Check if user logged in and has staff area permisions to edit.
		if ( is_user_logged_in () && is_admin() ) {

			if ( !isset( $_POST['id'] ) && empty( $_POST['id'] ) ) { echo '-1'; die(); }
			if ( !isset( $_POST['table'] ) && empty( $_POST['table'] ) ) { echo '-2'; die(); }

			$taxonomy = 'table';
			$post_id = $_POST['id'];

			$term = strtolower( $_POST['table'] );
			$term_id = term_exists( $term, $taxonomy );

			wp_set_post_terms( $post_id, $term_id['term_id'], $taxonomy, false );

		}

		die();

	} // end eggz_set_reservation_table


	/**
	 * Delete a reservation.
	 *
	 * @returns 		1 if the post was never created.
	 */

	public function eggz_delete_reservation() {

		// Check if user logged in and has staff area permisions to edit.
		if ( is_user_logged_in() && is_admin() ) {

			if ( isset( $_POST['deleteall'] ) && !empty( $_POST['deleteall'] ) && $_POST['deleteall'] == 'true' ) {

				$args = array(
					'numberposts' => -1,
					'post_type' =>'reservation'
				);

				$posts = get_posts( $args );

				if ( is_array($posts) ) {

				   foreach ( $posts as $post ) {

				       wp_trash_post( $post->ID );

				   }

				}

			} elseif ( isset( $_POST['id'] ) && !empty( $_POST['id'] ) ) {

				$post_id = $_POST['id'];
				wp_trash_post( $post_id );

			} else {
				echo 'Nothing deleted';
			}

		}

		die();

	} // end eggz_delete_reservation


	/**
	 * Update a reservation.
	 *
	 * @returns 		1 if the post was never created.
	 */

	public function eggz_update_reservation() {

		if ( !isset( $_POST['id'] ) && empty( $_POST['id'] ) ) { echo '-1'; die(); }

		// Check if user logged in and has staff area permisions to edit.
		if ( is_user_logged_in () && is_admin() ) {

			$this->eggz_update_reservation_meta( $_POST['id'], $_POST );

		}

		die();

	} // end eggz_delete_reservation




} // class
