<?php
/**
 * The view for the content wrap start used in the loop
 */


?><div class="reservation-details"><?php

	if ( !empty( $meta['reservation_date'][0] ) ) { ?>
		<div class="eggz-reservations-reservation-date field-name"><?php _e( 'Date', 'eggz-reservations' ); ?>:</div>
		<div class="eggz-reservations-reservation-date field-value"><?php echo esc_html( $meta['reservation_date'][0] ); ?></div>
	<?php }

	if ( !empty( $meta['reservation_time'][0] ) ) { ?>
		<div class="eggz-reservations-reservation-time field-name"><?php _e( 'Time', 'eggz-reservations' ); ?>: </div>
		<div class="eggz-reservations-reservation-time field-value"><?php echo esc_html( $meta['reservation_time'][0] ); ?></div>
	<?php }

	if ( !empty( $meta['reservation_persons'][0] ) ) { ?>
		<div class="eggz-reservations-reservation-persons field-name"><?php _e( 'Persons', 'eggz-reservations' ); ?>: </div>
		<div class="eggz-reservations-reservation-persons field-value"><?php echo esc_html( $meta['reservation_persons'][0] ); ?></div>
	<?php }

	if ( !empty( $meta['reservation_email'][0] ) ) { ?>
		<div class="eggz-reservations-reservation-email field-name"><?php _e( 'Email', 'eggz-reservations' ); ?>: </div>
		<div class="eggz-reservations-reservation-email field-value"><?php echo esc_html( $meta['reservation_email'][0] ); ?></div>
	<?php }

	if ( !empty( $meta['reservation_phone'][0] ) ) { ?>
		<div class="eggz-reservations-reservation-phone field-name"><?php _e( 'Phone', 'eggz-reservations' ); ?>: </div>
		<div class="eggz-reservations-reservation-phone field-value"><?php echo esc_html( $meta['reservation_phone'][0] ); ?></div>
	<?php }

	if ( !empty( $meta['reservation_name'][0] ) ) { ?>
		<div class="eggz-reservations-reservation-name field-name"><?php _e( 'Name', 'eggz-reservations' ); ?>: </div>
		<div class="eggz-reservations-reservation-name field-value"><?php echo esc_html( $meta['reservation_name'][0] ); ?></div>
	<?php }

	if ( !empty( $meta['reservation_special_request'][0] ) ) { ?>
		<div class="eggz-reservations-reservation-special-request field-name"><?php _e( 'Special Request', 'eggz-reservations' ); ?>: </div>
		<div class="eggz-reservations-reservation-special-request field-value"><?php echo esc_html( $meta['reservation_special_request'][0] ); ?></div>
	<?php } ?>

	<div class="edit-reservation"><?php _e( 'Edit', 'eggz-reservations' ); ?></div>
	<div class="delete-reservation"><?php _e( 'Delete', 'eggz-reservations' ); ?></div>

</div>
