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


<!-- Split button -->
<table class="reservation-heading-box">

	<td class="eggz-reservations-heading">
	  <button type="button" class="btn btn-default eggz-reservation-trigger">
	  	<h3 class="eggz-reservations-title" itemprop="name"><?php echo $item->post_title; ?></h3>
			<?php
			if ( !empty( $meta['reservation_date'][0] ) ) { ?>
				<p class="eggz-reservations-date"><?php echo esc_html( $meta['reservation_date'][0] ); ?></p>
			<?php } ?>
		</button>
	</td>

	<td class="eggz-reservations-table">

	  <select class="selectpicker" data-postid="<?php echo $item->ID; ?>">
	  	<option>XX</option>
  		<?php

			foreach ($all_terms as $term) {
				$selected = "";
				if ( isset( $current_table ) && !empty( $current_table ) && ( $current_table === $term->slug ) ) {
					$selected = ' selected';
				}
				echo '<option class="' . $current_table . $term->slug . $class . '"' . $selected . '>' . $term->name . '</option>';
			} ?>
		</select>

	</td>

</table>