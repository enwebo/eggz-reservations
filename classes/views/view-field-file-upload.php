<?php

/**
 * Provides the markup for an upload field
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/classes/views
 */

if ( ! empty( $atts['label'] ) ) {

	?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'plugin-name' ); ?>: </label><?php

}

?><input
	class="<?php echo esc_attr( $atts['class'] ); ?>"
	data-id="url-file"
	id="<?php echo esc_attr( $atts['id'] ); ?>"
	name="<?php echo esc_attr( $atts['name'] ); ?>"
	type="<?php echo esc_attr( $atts['type'] ); ?>"
	value="<?php echo esc_attr( $atts['value'] ); ?>" />
<a href="#" class="" id="upload-file"><?php esc_html_e( $atts['label-upload'], 'plugin-name' ); ?></a>
<a href="#" class="hide" id="remove-file"><?php esc_html_e( $atts['label-remove'], 'plugin-name' ); ?></a>