<?php
/**
 * The view for the meta data field used in the loop
 */

if ( empty( $meta['reservation_date'][0] ) ) { return; }

?><p class="eggz-reservations-date"><?php echo esc_html( $meta['reservation_date'][0] ); ?></p>