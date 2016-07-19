<?php
/**
 * The view for the list wrap start used in the loop
 */

?>

<div class="eggz-reservations eggz-reservations-list-wrap<?php echo $class; ?>">

	<!-- Modal for delete Reservations -->
	<div id="deleteReservationModal" class="modal modal-eggz modal-outside-close-btn fade">
		<div class="modal-dialog modal-lg" role="document">
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

					<div class="delete-modal-wrap">

						<div class="delete-modal-image eggz-overlay eggz-overlay-opacity-60"></div>

						<div class="delete-modal-content">
							<input class="reservation-id" type="hidden" value=""/>
							<input class="delete-all-reservations" type="hidden" value="false"/>
							<h3 class="line-disabled"><?php _e( 'Please Confirm', 'eggz-reservations' ); ?></h3>
							<p class="delete-single-reservation-message"><?php _e( 'You want to delete this reservation?', 'eggz-reservations' ); ?></p>
							<p class="delete-all-reservations-message"><?php _e( 'You want to delete all reservations?', 'eggz-reservations' ); ?></p>
							<p><?php _e( 'You want to delete all reservations?', 'eggz-reservations' ); ?></p>
							<div class="eggz-btn-container align-center">
								<button type="button" class="eggz-btn eggz-btn-brand-outline yes"><?php _e( 'Yes', 'eggz-reservations' ); ?></button>
								<button type="button" class="eggz-btn eggz-btn-brand-outline no" data-dismiss="modal" data-target="#deleteReservationModal"><?php _e( 'No', 'eggz-reservations' ); ?></button>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>


	<!-- Modal for Edit Reservations -->
	<div id="editReservationModal" class="modal modal-eggz fade">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content edit-modal-image ">

				<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>

				<div class="eggz-abs-loader" style="display: none;">
					<div class="loading">
					    <span class="ball1"></span>
					    <span class="ball2"></span>
					</div>
				</div>

				<div class="modal-header">
					<h4 class="eggz-reservations-title line-disabled"><?php _e( 'Reservation Name', 'eggz-reservations' ); ?></h4>
					<p class="date"></p>
				</div>

				<div class="modal-body">

					<form class="modal-edit-reservation">
						<div class="edit-reservation-row">

							<div class="edit-reservation-cell">
								<input type="hidden" name="reservation-id" id="reservation-id"/>
								<p><?php _e( 'Date', 'eggz-reservations' ); ?></p>
							</div>

							<div class="edit-reservation-cell">

								<div class="input-group">

								    <input type="text" required name="date" id="date"/>

						            <span class="input-group-addon">
						                <span class="bs-caret">
						                	<span class="caret"></span>
						                </span>
						            </span>
						        </div>

							</div>
						</div>

						<div class="edit-reservation-row">
							<div class="edit-reservation-cell">
								<p><?php _e( 'Time', 'eggz-reservations' ); ?></p>
							</div>
							<div class="edit-reservation-cell">

								<div class="input-group">

								    <input type="text" required name="time" id="time"/>

						            <span class="input-group-addon">
						                <span class="bs-caret">
						                	<span class="caret"></span>
						                </span>
						            </span>
						        </div>

							</div>
						</div>

						<div class="edit-reservation-row">

							<div class="edit-reservation-cell">
								<p><?php _e( 'Persons', 'eggz-reservations' ); ?></p>
							</div>

							<div class="edit-reservation-cell">
								<div class="input-wrap">
								    <input type="text" required name="persons" id="persons"/>
						        </div>
							</div>

						</div>

						<div class="edit-reservation-row">

							<div class="edit-reservation-cell">
								<p><?php _e( 'Email', 'eggz-reservations' ); ?></p>
							</div>

							<div class="edit-reservation-cell">
								<div class="input-wrap">
									<input type="text" required name="email" id="email"/>
						        </div>
							</div>

						</div>

						<div class="edit-reservation-row">

							<div class="edit-reservation-cell">
								<p><?php _e( 'Phone', 'eggz-reservations' ); ?></p>
							</div>

							<div class="edit-reservation-cell">
								<div class="input-wrap">
									<input type="text" name="phone" id="phone"/>
						        </div>
							</div>

						</div>

						<div class="edit-reservation-row">

							<div class="edit-reservation-cell">
								<p><?php _e( 'Name', 'eggz-reservations' ); ?></p>
							</div>

							<div class="edit-reservation-cell">
								<div class="input-wrap">
									<input type="text" name="name" id="name"/>
						        </div>
							</div>

						</div>
					</form>

				</div>

				<div class="modal-footer">
					<button type="button" class="eggz-btn eggz-btn-brand-primary edit-reservation-modal-save text-uppercase"><?php _e( 'Save', 'eggz-reservations' ); ?></button>
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
				<select class="selectpicker show-menu-arrow">
				  	<option value="latest"><?php _e( 'Latest', 'eggz-reservations' ); ?></option>
				  	<option value="oldest"><?php _e( 'Oldest', 'eggz-reservations' ); ?></option>
				  	<option value="ufirst"><?php _e( 'Unassigned First', 'eggz-reservations' ); ?></option>
				  	<option value="ulast"><?php _e( 'Unassigned Last', 'eggz-reservations' ); ?></option>
				</select>
			</div>
		</div>

	</div>

	<div class="clearfix eggz-reservations-tools">
		<div class="tools">
			<button type="button" class="eggz-btn eggz-btn-icon" onclick="javascript:window.print()"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
			<button type="button" class="eggz-btn eggz-btn-icon delete-all-reservations" data-toggle="modal" data-target="#deleteReservationModal" data-delete-all="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
		</div>
	</div>

	<div class="eggz-reservations-list row">
