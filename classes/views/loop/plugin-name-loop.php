<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://slushman.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/classes/loop-views
 */

/**
 * plugin-name-before-loop hook
 *
 * @hooked 		loop_wrap_start 		15
 */
do_action( 'plugin-name-before-loop', $args );

foreach ( $items as $item ) {

	$meta = get_post_custom( $item->ID );

	/**
	 * plugin-name-before-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		loop_content_wrap_begin 		10
	 * @hooked 		loop_content_link_begin 		15
	 */
	do_action( 'plugin-name-before-loop-content', $item, $meta );

		/**
		 * lazy-load-videos-loop-content hook
		 *
		 * @param 		object  	$item 		The post object
		 *
		 * @hooked		loop_content_image 			10
		 * @hooked		loop_content_title 			15
		 * @hooked		loop_content_subtitle 		20
		 */
		do_action( 'plugin-name-loop-content', $item, $meta );

	/**
	 * plugin-name-after-loop-content hook
	 *
	 * @param 		object  	$item 		The post object
	 *
	 * @hooked 		loop_content_link_end 		10
	 * @hooked 		loop_content_wrap_end 		90
	 */
	do_action( 'plugin-name-after-loop-content', $item, $meta );

} // foreach

/**
 * plugin-name-after-loop hook
 *
 * @hooked 		loop_wrap_end 			10
 */
do_action( 'plugin-name-after-loop', $args );
