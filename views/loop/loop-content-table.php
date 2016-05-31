<?php
/**
 * The view for the meta data field used in the loop
 */

$all_terms = get_terms( array(
    'taxonomy' => 'table',
    'hide_empty' => false,
) );

$terms = get_the_terms( $item->ID , 'table' );
if ( $terms ) {
	$current_table = $terms[0]->{'term_id'};
	$current_table_name = $terms[0]->{'name'};
}

?><div class="eggz-reservations-table">

	<div class="dropdown">
		<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
			<?php 
			if( isset( $current_table_name ) ) {
				echo $current_table_name;
			}
			?>
		</button>
		<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">

			<?php
			$class = '';

			foreach ($all_terms as $term) {
				if ( $current_table == $term->slug ) $class = ' current';
				echo '<li class="' . $term->slug . $class . '" href="#">' . $term->name . '</li>';
			} ?>
			
		</ul>
	</div>

</div>