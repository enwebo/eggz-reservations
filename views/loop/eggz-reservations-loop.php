<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://enwebo.com
 * @since      1.0.0
 *
 * @package    Eggz_Reservations
 * @subpackage Eggz_Reservations/classes/loop-views
 */
if ( !is_user_logged_in() ) {
	echo __('<div class="eggz-notice notice-info with-icon"><div class="notice-text">You need to be logged in to view staff area.</div><a href="/my-account/" class="eggz-btn eggz-btn-primary-outline eggz-btn-sm text-uppercase">Login</a></div>', 'eggz-reservations');
	return;
}
/**
 * eggz-reservations-before-loop hook
 *
 * @hooked 		loop_wrap_start 		15
 */
do_action( 'eggz-reservations-before-loop', $args );

foreach ( $items as $item ) {

	$meta = get_post_custom( $item->ID );

	/**
	 * eggz-reservations-before-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		loop_content_wrap_begin 		10
	 * @hooked 		loop_content_link_begin 		15
	 */
	do_action( 'eggz-reservations-before-loop-content', $item, $meta );

		/**
		 * lazy-load-videos-loop-content hook
		 *
		 * @param 		object  	$item 		The post object
		 *
		 * @hooked		loop_content_image 			10
		 * @hooked		loop_content_title 			15
		 * @hooked		loop_content_subtitle 		20
		 */
		do_action( 'eggz-reservations-loop-content', $item, $meta );

	/**
	 * eggz-reservations-after-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		loop_content_link_end 		10
	 * @hooked 		loop_content_wrap_end 		90
	 */
	do_action( 'eggz-reservations-after-loop-content', $item, $meta );

} // foreach

/**
 * eggz-reservations-after-loop hook
 *
 * @hooked 		loop_wrap_end 			10
 */
do_action( 'eggz-reservations-after-loop', $args );
