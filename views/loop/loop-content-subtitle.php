<?php
/**
 * The view for the subtitle used in the loop
 */

if ( empty( $meta['reservation_date'][0] ) ) { return; }

?><p class="plugin-name-reservation-date"><?php echo esc_html( $meta['reservation_date'][0] ); ?></p>