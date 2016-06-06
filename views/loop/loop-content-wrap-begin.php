<?php
/**
 * The view for the content wrap start used in the loop
 */

$terms = wp_get_post_terms( $item->ID, 'table' ); 

$class = '';

if ( !$terms ) {
	$class .= ' ' . 'unassigned';

} elseif ( is_array( $terms ) ) {

	foreach ($terms as $term) {

		$class .=  ' ' . $term->slug;

	}

} else {

	$class .= ' ' . $terms;

}

?>
<li class="hentry reservation-box col-xs-6 all<?php echo $class; ?>">
	<div class="reservation-content">
