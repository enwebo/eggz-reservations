<?php
/**
 * The view for the meta data field used in the loop
 */

if ( empty( $meta['reservation_name'][0] ) ) { return; }

?><p class="eggz-reservations-name"><?php echo esc_html( $meta['reservation_name'][0] ); ?></p>