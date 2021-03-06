<?php

/**
 * Displays a metabox
 *
 * @link       http://enwebo.com
 * @since      1.0.0
 *
 * @package    Eggz_Reservations
 * @subpackage Eggz_Reservations/classes/views
 */

wp_nonce_field( $this->plugin_name, 'nonce_plugin_name_metabox_name' );

/*

$atts 					= array();
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'phone-office';
$atts['label'] 			= 'Office Phone';
$atts['name'] 			= 'phone-office';
$atts['placeholder'] 	= '';
$atts['type'] 			= 'text';
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . 'view-field-text.php' );

?></p><?php


$atts 					= array();
$atts['aria'] 			= esc_html__( 'Select a State', 'plugin-name' );
$atts['blank'] 			= esc_html__( 'Select a State', 'plugin-name' );
$atts['class'] 			= 'widefat';
$atts['description'] 	= '';
$atts['id'] 			= 'state';
$atts['label'] 			= 'State';
$atts['name'] 			= 'state';
$atts['selections'][] 	= array( 'value' => 'example', 'label' => esc_html__( 'Example', 'plugin-name' ) );
$atts['value'] 			= '';

if ( ! empty( $this->meta[$atts['id']][0] ) ) {

	$atts['value'] = $this->meta[$atts['id']][0];

}

$atts = apply_filters( $this->plugin_name . '-field-' . $atts['id'], $atts );

?><p><?php

include( plugin_dir_path( __FILE__ ) . 'view-field-select.php' );

?></p><?php

*/