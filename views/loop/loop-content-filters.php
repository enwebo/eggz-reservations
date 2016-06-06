<?php
/**
 * The view for the filters for the loop
 */


?>
<div class="clearfix eggz-reservations-filters">
	
	<div class="col-xs-6 eggz-reservations-reservation-filter">
		
		<ul class="reservations-filters">
			<li data-type="all"><?php _e( 'All', 'eggz-reservations' ); ?></li>
			<li data-type="unassigned"><?php _e( 'Unassigned', 'eggz-reservations' ); ?></li>
		</ul>

	</div>

	<div class="col-xs-6 eggz-reservations-reservation-order">

		<div class="dropdown pull-right">
			<span><?php _e( 'Sort by', 'eggz_reservations' ); ?></span>
			<button class="btn btn-default dropdown-toggle" type="button" id="reservationsOrder" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
			  Latest
			</button>
			<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="reservationsOrder">
				<li><a href="#"><?php _e( 'Oldest', 'eggz-reservations' ); ?></a></li>
				<li><a href="#"><?php _e( 'Unassigned First', 'eggz-reservations' ); ?></a></li>
				<li><a href="#"><?php _e( 'Unassigned Last', 'eggz-reservations' ); ?></a></li>
			</ul>
		</div>

	</div>

</div>
