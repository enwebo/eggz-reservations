<?php
/**
 * The view for the list wrap start used in the loop
 */

?>

<div class="eggz-reservations eggz-reservations-list-wrap<?php echo $class; ?>">

	<!-- Modal for delete Reservations -->	
	<div id="deleteReservationModal" class="modal modal-eggz fade modal-outside-close-btn">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>

					<div class="video-caption">

						<div class="eggz-abs-loader" style="display: none;">
							<div class="loading">
							    <span class="ball1"></span>
							    <span class="ball2"></span>
							</div>
						</div>

					</div>

					<div class="delete-modal-image with-overlay"></div>

					<div class="delete-modal-content">
						<input class="reservation-id" type="hidden" value=""/>
						<input class="delete-all-reservations" type="hidden" value="false"/>
						<h3><?php _e( 'Please Confirm', 'eggz-reservations' ); ?></h3>
						<p class="delete-single-reservation-message"><?php _e( 'You want to delete this reservation?', 'eggz-reservations' ); ?></p>
						<p class="delete-all-reservations-message"><?php _e( 'You want to delete all reservations?', 'eggz-reservations' ); ?></p>
						<p><?php _e( 'You want to delete all reservations?', 'eggz-reservations' ); ?></p>
						<div class="btn yes"><?php _e( 'Yes', 'eggz-reservations' ); ?></div>
						<a class="btn no" data-dismiss="modal" data-target="#deleteReservationModal" href="#"><?php _e( 'No', 'eggz-reservations' ); ?></a>
					</div>
				
					<div class="clearfix"></div>

				</div>
			</div>
		</div>
	</div>


	<!-- Modal for Edit Reservations -->
	<div id="editReservationModal" class="modal modal-eggz fade">
		<div class="modal-dialog" role="document">
			<div class="modal-content edit-modal-image ">
				<div class="modal-body">

					<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>

					<div class="eggz-abs-loader" style="display: none;">
						<div class="loading">
						    <span class="ball1"></span>
						    <span class="ball2"></span>
						</div>
					</div>


					<div class="modal-header">
						<h4><?php _e( 'Please Confirm', 'eggz-reservations' ); ?></h4>
						<p class="date"></p>
					</div>

					<form class="modal-edit-reservation">
						<input type="hidden" name="reservation-id" id="reservation-id"/>
						<label for="date"><?php _e( 'Date', 'eggz-reservations' ); ?>: </label>
						<input type="text" required name="date" id="date"/>

						<label for="time"><?php _e( 'Time', 'eggz-reservations' ); ?>: </label>
						<input type="text" required name="time" id="time"/>

						<label for="persons"><?php _e( 'Persons', 'eggz-reservations' ); ?>: </label>
						<input type="text" required name="persons" id="persons"/>

						<label for="email"><?php _e( 'Email', 'eggz-reservations' ); ?>: </label>
						<input type="text" required name="email" id="email"/>

						<label for="phone"><?php _e( 'Phone', 'eggz-reservations' ); ?>: </label>
						<input type="text" name="phone" id="phone"/>

						<label for="name"><?php _e( 'Name', 'eggz-reservations' ); ?>: </label>
						<input type="text" name="name" id="name"/>

						<label for="specialrequest"><?php _e( 'Special Requests', 'eggz-reservations' ); ?>: </label>
						<textarea name="specialrequest" id="specialrequest"></textarea> 
					</form>
					
					<div class="modal-footer">
						<a class="btn edit-reservation-modal-save" href="#"><?php _e( 'Save', 'eggz-reservations' ); ?></a>
					</div>

					<div class="clearfix"></div>
					
				</div>
			</div>
		</div>
	</div>

	<div class="clearfix eggz-reservations-filters">
			
		<ul class="reservations-filters">
			<li data-type="all"><button type="button" class="reservations-filter"><?php _e( 'All', 'eggz-reservations' ); ?></button></li>
			<li data-type="unassigned"><button type="button" class="reservations-filter"><?php _e( 'Unassigned', 'eggz-reservations' ); ?></button></li>
		</ul>

		<div class="eggz-reservations-sort-order">
			<div class="name-field-sort"><?php _e( 'Sort by', 'eggz_reservations' ); ?></div>
			<div class="select-sort">
				<select class="selectpicker">
			  	<option><?php _e( 'Latest', 'eggz-reservations' ); ?></option>
			  	<option><?php _e( 'Oldest', 'eggz-reservations' ); ?></option>
			  	<option><?php _e( 'Unassigned First', 'eggz-reservations' ); ?></option>
			  	<option><?php _e( 'Unassigned Last', 'eggz-reservations' ); ?></option>
				</select>
			</div>
		</div>

	</div>

	<div class="clearfix eggz-reservations-tools">
		<div class="tools">
			<button type="button" onclick="javascript:window.print()"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
			<button type="button" class="delete-all-reservations" data-toggle="modal" data-target="#deleteReservationModal" data-delete-all="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
		</div>
	</div>

	<div class="eggz-reservations-list row">
