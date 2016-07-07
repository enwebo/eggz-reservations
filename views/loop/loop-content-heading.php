<?php
/**
 * The view for the content wrap start used in the loop
 */

?>

<!-- Split button -->
<div class="reservation-heading-box">

	<div class="eggz-reservations-heading">

	  <button type="button" class="eggz-reservation-trigger">
	  	<h3 class="eggz-reservations-title line-disabled" itemprop="name"><?php echo $item->post_title; ?></h3>
			<?php
			if ( !empty( $meta['reservation_date'][0] ) ) { ?>
				<p class="eggz-reservations-date"><?php echo esc_html( $meta['reservation_date'][0] ); ?></p>
			<?php } ?>
		</button>
		
	</div>

	<div class="eggz-reservations-table">

	  	<?php

	  		$tax_terms = get_terms( array( 'taxonomy' => 'table', 'hide_empty' => false ) );
			$reservation_terms = get_the_terms( $item->ID , 'table' );
		
		?>

		<select class="selectpicker show-menu-arrow" data-postid="<?php echo $item->ID; ?>" data-table="<?php if( isset( $reservation_terms[0]->{'slug'} ) ) echo $reservation_terms[0]->{'slug'}; ?>">
			
			<option>XX</option>

	  		<?php

			foreach ($tax_terms as $term) {

				$selected = '';

				if ( isset( $reservation_terms[0]->{'slug'} ) &&  $reservation_terms[0]->{'slug'} == $term->slug ) {
					$selected = ' selected';
				}
				
				echo '<option class="' . $term->slug . '"' . $selected . '>' . $term->name . '</option>';
			
			} ?>

		</select>

	</div>

</div>