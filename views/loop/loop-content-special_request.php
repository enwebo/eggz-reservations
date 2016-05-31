<?php
/**
 * The view for the meta data field used in the loop
 */

if ( empty( $meta['special_request'][0] ) ) { return; }

?><p class="eggz-reservations-special-requests"><?php echo esc_html( $meta['special_request'][0] ); ?></p>