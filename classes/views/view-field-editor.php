<?php

/**
 * Provides the markup for any WP Editor field
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/classes/views
 */

// wp_editor( $content, $editor_id, $settings = array() );

wp_editor( $atts['value'], $atts['id'], $atts['settings'] );

?><span class="description"><?php esc_html_e( $atts['description'], 'plugin-name' ); ?></span>