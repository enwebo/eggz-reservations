<?php
/**
 * The view for the content wrap start used in the loop
 */


?><div class="eggz-reservation-details">
	<table><?php
		if ( !empty( $meta['reservation_date'][0] ) ) { ?>
			<tr>
				<td class="eggz-reservations-reservation-date field-name"><?php _e( 'Date', 'eggz-reservations' ); ?>:</td>
				<td class="eggz-reservations-reservation-date field-value"><?php echo esc_html( $meta['reservation_date'][0] ); ?></td>
			</tr>
		<?php }

		if ( !empty( $meta['reservation_time'][0] ) ) { ?>
			<tr>
				<td class="eggz-reservations-reservation-time field-name"><?php _e( 'Time', 'eggz-reservations' ); ?>: </td>
				<td class="eggz-reservations-reservation-time field-value"><?php echo esc_html( $meta['reservation_time'][0] ); ?></td>
			</tr>
		<?php }

		if ( !empty( $meta['reservation_persons'][0] ) ) { ?>
			<tr>
				<td class="eggz-reservations-reservation-persons field-name"><?php _e( 'Persons', 'eggz-reservations' ); ?>: </td>
				<td class="eggz-reservations-reservation-persons field-value"><?php echo esc_html( $meta['reservation_persons'][0] ); ?></td>
			</tr>
		<?php }

		if ( !empty( $meta['reservation_email'][0] ) ) { ?>
			<tr>
				<td class="eggz-reservations-reservation-email field-name"><?php _e( 'Email', 'eggz-reservations' ); ?>: </td>
				<td class="eggz-reservations-reservation-email field-value"><?php echo esc_html( $meta['reservation_email'][0] ); ?></td>
			</tr>
		<?php }

		if ( !empty( $meta['reservation_phone'][0] ) ) { ?>
			<tr>
				<td class="eggz-reservations-reservation-phone field-name"><?php _e( 'Phone', 'eggz-reservations' ); ?>: </td>
				<td class="eggz-reservations-reservation-phone field-value"><?php echo esc_html( $meta['reservation_phone'][0] ); ?></td>
			</tr>
		<?php }

		if ( !empty( $meta['reservation_name'][0] ) ) { ?>
			<tr>
				<td class="eggz-reservations-reservation-name field-name"><?php _e( 'Name', 'eggz-reservations' ); ?>: </td>
				<td class="eggz-reservations-reservation-name field-value"><?php echo esc_html( $meta['reservation_name'][0] ); ?></td>
			</tr>
		<?php }

		if ( !empty( $meta['reservation_special_request'][0] ) ) { ?>
			<tr class="eggz-reservations-reservation-special-request-row">
				<td colspan="2">
					<div class="eggz-reservations-reservation-special-request field-name"><?php _e( 'Special Request', 'eggz-reservations' ); ?>: </div>
					<div class="eggz-reservations-reservation-special-request field-value"><?php echo esc_html( $meta['reservation_special_request'][0] ); ?></div>
				</td>
			</tr>
		<?php } ?>
	</table>
	<table>
		<tr class="btn-eggz-reservations-controls-row">
			<td>
				<button 
					type="button" 
					class="eggz-btn eggz-btn-brand-primary text-uppercase btn-eggz-reservations-control edit-reservation" 
					data-toggle="modal" 
					data-target="#editReservationModal" 
					data-id="<?php echo $item->ID; ?>" 
					data-date="<?php if ( !empty( $meta['reservation_date'][0] ) ) echo esc_html( $meta['reservation_date'][0] ); ?>" 
					data-time="<?php if ( !empty( $meta['reservation_time'][0] ) ) echo esc_html( $meta['reservation_time'][0] ); ?>" 
					data-persons="<?php if ( !empty( $meta['reservation_persons'][0] ) ) echo esc_html( $meta['reservation_persons'][0] ); ?>" 
					data-email="<?php if ( !empty( $meta['reservation_email'][0] ) ) echo esc_html( $meta['reservation_email'][0] ); ?>" 
					data-phone="<?php if ( !empty( $meta['reservation_phone'][0] ) ) echo esc_html( $meta['reservation_phone'][0] ); ?>" 
					data-name="<?php if ( !empty( $meta['reservation_name'][0] ) ) echo esc_html( $meta['reservation_name'][0] ); ?>" 
					data-specialrequest="<?php if ( !empty( $meta['reservation_special_request'][0] ) ) echo esc_html( $meta['reservation_special_request'][0] ); ?>" >
					<?php _e( 'Edit', 'eggz-reservations' ); ?>
				</button>
			</td>
			<td>
				<button type="button" class="eggz-btn eggz-btn-brand-primary text-uppercase btn-eggz-reservations-control delete-reservation" data-toggle="modal" data-target="#deleteReservationModal" data-id="<?php echo $item->ID; ?>">
					<?php _e( 'Delete', 'eggz-reservations' ); ?>
				</button>
			</td>
		</tr>
	</table>
</div>
