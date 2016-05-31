<?php
/**
 * The view for the meta data field used in the loop
 */


if ( empty( $meta['reservation_time'][0] ) ) { return; }

?><p class="eggz-reservations-time"><?php echo esc_html( $meta['reservation_time'][0] ); ?></p>