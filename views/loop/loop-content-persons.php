<?php
/**
 * The view for the meta data field used in the loop
 */

if ( empty( $meta['reservation_persons'][0] ) ) { return; }

?><p class="eggz-reservations-persons"><?php echo esc_html( $meta['reservation_persons'][0] ); ?></p>