<?php
/**
 * The view for the filters for the loop
 */


?>
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editReservationModal">Open Modal</button>

<!-- Modal -->
<div id="editReservationModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
			
			<!-- <button class="btn btn-default dropdown-toggle" type="button" id="reservationsOrder" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
			  Latest
			</button>
			<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="reservationsOrder">
				<li><a href="#"><?php _e( 'Oldest', 'eggz-reservations' ); ?></a></li>
				<li><a href="#"><?php _e( 'Unassigned First', 'eggz-reservations' ); ?></a></li>
				<li><a href="#"><?php _e( 'Unassigned Last', 'eggz-reservations' ); ?></a></li>
			</ul> -->
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
