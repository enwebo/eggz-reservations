<?php
/**
 * The template for displaying single post meta field data.
 *
 * @package Eggz_Reservations
 */

if ( empty( $meta['meta-field'][0] ) ) { return; }

?><p class="<?php echo esc_attr( 'meta-field' ); ?>"><?php

	esc_html_e( $meta['meta-field'][0] );

?></p>