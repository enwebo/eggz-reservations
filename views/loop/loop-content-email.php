<?php
/**
 * The view for the meta data field used in the loop
 */

if ( empty( $meta['reservation_email'][0] ) ) { return; }

?><div class="eggz-reservations-email"><?php echo esc_html( $meta['reservation_email'][0] ); ?></div>