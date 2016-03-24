<?php
/**
 * The view for the meta data field used in the loop
 */

if ( empty( $meta['meta-field'][0] ) ) { return; }

?><p class="plugin-name-meta-field"><?php echo esc_html( $meta['meta-field'][0] ); ?></p>