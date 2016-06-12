<?php

/**
 * Displays a metabox
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Eggz_Reservations
 * @subpackage Eggz_Reservations/classes/views
 */

wp_nonce_field( $this->plugin_name, 'reservation_details_nonce' );

$atts 					= array();
$atts['class'] 			= 'widefat datepicker';
$atts['description'] 	= '';
$atts['id'] 			= 'reservation_date';
$atts['label'] 			= 'Date';
$atts['name'] 			= 'reservation-date';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/field-text.php' );

?></p><?php



$atts 					= array();
$atts['class'] 			= 'widefat timepicker';
$atts['description'] 	= '';
$atts['id'] 			= 'reservation_time';
$atts['label'] 			= 'Time';
$atts['name'] 			= 'reservation-time';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';


if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/field-text.php' );

?></p><?php




$atts 					= array();
$atts['class'] 			= 'widefat selector';
$atts['description'] 	= '';
$atts['id'] 			= 'reservation_persons';
$atts['label'] 			= 'Persons';
$atts['name'] 			= 'reservation-persons';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/field-text.php' );

?></p><?php



$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'reservation_email';
$atts['label'] 			= 'Email';
$atts['name'] 			= 'reservation-email';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/field-text.php' );

?></p><?php



$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'reservation_phone';
$atts['label'] 			= 'Phone';
$atts['name'] 			= 'reservation-phone';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/field-text.php' );

?></p><?php



$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'reservation_name';
$atts['label'] 			= 'Name';
$atts['name'] 			= 'reservation-name';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/field-text.php' );

?></p><?php


$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['placeholder'] 	= '';
$atts['description'] 	= '';
$atts['id'] 			= 'reservation_special_requests';
$atts['label'] 			= 'Special Requests';
$atts['settings']['textarea_name'] = 'reservation-persons';
$atts['value'] 			= '';
$atts['name'] 			= 'reservation-special-requests';
$atts['cols'] 			= '';
$atts['rows'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/field-textarea.php' );

?></p><?php


$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['placeholder'] 	= '';
$atts['description'] 	= '';
$atts['id'] 			= 'reservation-table';
$atts['label'] 			= 'Table';
$atts['value'] 			= '';
$atts['name'] 			= 'reservation-table';
$atts['cols'] 			= '';
$atts['rows'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( dirname( __FILE__ ) ) . 'fields/field-select.php' );

?></p><?php
