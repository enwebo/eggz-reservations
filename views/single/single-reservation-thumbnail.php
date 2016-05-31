<?php
/**
 * The view for the featured image used in the single-postttypename template
 */

if ( ! has_post_thumbnail() ) { return; }

$thumb_atts['class'] 	= 'alignleft img-reservation photo';
$thumb_atts['itemtype'] = 'image';

$thumb_atts = apply_filters( 'eggz-reservations-single-post-featured-image-attributes', $thumb_atts );

the_post_thumbnail( 'medium', $thumb_atts );
