<?php

/**
 * Provides the markup for an upload field
 *
 * @link       http://enwebo.com
 * @since      1.0.0
 *
 * @package    Eggz_Reservations
 * @subpackage Eggz_Reservations/classes/views
 */

if ( ! empty( $atts['label'] ) ) {

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php echo wp_kses( $atts['label'], array( 'code' => array() ) ); ?>: </label><?php

}

?><input
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	data-id="url-file"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	type="<?php echo esc_attr( $atts['type'] ); ?>"
	value="<?php echo esc_attr( $atts['value'] ); ?>" />
<a href="#" class="upload-file" id=""><?php echo wp_kses( $atts['label-upload'], array( 'code' => array() ) ); ?></a>
<a href="#" class="remove-file hide" id=""><?php echo wp_kses( $atts['label-remove'], array( 'code' => array() ) ); ?></a>
