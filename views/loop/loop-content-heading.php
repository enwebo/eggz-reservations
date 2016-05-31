<?php
/**
 * The view for the content wrap start used in the loop
 */


		$all_terms = get_terms( array( 'taxonomy' => 'table', 'hide_empty' => false ) );
		$terms = get_the_terms( $item->ID , 'table' );

		if ( $terms ) {
			$current_table = $terms[0]->{'slug'};
			$current_table_name = $terms[0]->{'name'};
		} ?>

<div class="reservation-heading-wrap">

	<div class="eggz-reservations-heading">
		<h3 class="eggz-reservations-title" itemprop="name"><?php echo $item->post_title; ?></h3>
		<?php
		if ( !empty( $meta['reservation_date'][0] ) ) { 
			?><p class="eggz-reservations-date"><?php echo esc_html( $meta['reservation_date'][0] ); ?></p><?php
		} ?>

	</div>

	<div class="eggz-reservations-table">

		<div class="dropdown">
			<button class="btn btn-default dropdown-toggle" type="button" id="reservationsOrder" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
				<?php 
				if( isset( $current_table_name ) ) {
					echo $current_table_name;
				}else{
					_e( 'XX', 'eggz-reservations' );
				}
				?>
			</button>
			<ul class="dropdown-menu" aria-labelledby="reservationsOrder">

				<?php
				$class = '';

				foreach ($all_terms as $term) {
					if ( $current_table == $term->slug ) $class = ' current';
					echo '<li class="' . $term->slug . $class . '" href="#">' . $term->name . '</li>';
				} ?>
				
			</ul>
		</div>

	</div>

</div>