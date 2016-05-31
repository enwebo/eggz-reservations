<?php
/**
 * The view for the meta data field used in the loop
 */

if ( empty( $meta['reservation_phone'][0] ) ) { return; }

?><p class="eggz-reservations-phone"><?php echo esc_html( $meta['reservation_phone'][0] ); ?></p>