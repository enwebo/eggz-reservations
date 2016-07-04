<?php

/**
 * The view for the help page
 *
 * @link       http://enwebo.com
 * @since      1.0.0
 *
 * @package    Eggz_Reservations
 * @subpackage Eggz_Reservations/classes/views
 */

?><h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
<h2>Shortcodes</h2>
<p>To display a list of Eggz_Reservations on a page, use the following shortcode.</p>
<pre><code>[eggz-reservations-list]</code></pre>
<p>To display a form for Eggz_Reservations on a page, use the following shortcode.</p>
<pre><code>[eggz-reservations-form]</code></pre>
<p>To display working hours for Eggz_Reservations on a page, use the following shortcode.</p>
<pre><code>[eggz-reservations-hours]</code></pre>

<p>Enter that shortcodes in the Editor on any page or post to display desired data of Eggz_Reservations.</p>
<p>Here are the custom attributes accepted by the shortcode:</p>

<h3>Settings</h3>
<p>Here are details for the plugin settings:</p>
<dl>
	<dt><dfn>Number of days for reservations</dfn></dt>
	<dd>Days on upfront for creating reservations.</dd>
	<dt><dfn>Number of max persons per reservation</dfn></dt>
	<dd>Limit reservation for specific number of persons.</dd>
	<dt><dfn>Reservation details background image</dfn></dt>
	<dd>Reservation details step background image</dd>
	<dt><dfn>Reservation successful background image</dfn></dt>
	<dd>Upload an image for the successful reservation message.</dd>
	<dt><dfn>Closed</dfn></dt>
	<dd>Mark as closed when chefs goes on holiday :)</dd>
	<dt><dfn>Open Hours</dfn></dt>
	<dd>Daily open hours of restaurant.</dd>
	<dt><dfn>Description</dfn></dt>
	<dd>Description for plugin resservation form.</dd>
</dl>
