<?php
/**
 * The view for the content wrap start used in the loop
 */

$terms = wp_get_post_terms( $item->ID, 'table' );

$class = '';

if ( !$terms ) {
	$class .= ' ' . 'unassigned';
	$table = 'xx';

} elseif ( is_array( $terms ) ) {

	foreach ($terms as $term) {

		$class .=  ' ' . $term->slug;
		$table = $term->slug;

	}

} else {

	$class .= ' ' . $terms;

}

?>

<div class="reservation-box col-xs-12 col-sm-6 all<?php echo $class; ?> " data-postid="<?php echo $item->ID; ?>" data-table="<?php echo $table; ?>">

	<div class="reservation-content">
