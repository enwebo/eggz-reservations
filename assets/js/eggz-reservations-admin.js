(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 */
	$(function() {

    	$('.datepicker').datetimepicker({
            useCurrent: false, //Important! See issue #1075
	        stepping: 15,
	        format: 'MM/DD/YYYY',
			allowInputToggle: true,
        });

    	$('.timepicker').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            stepping: 15,
            format: 'hh:mm a'
        });

	});
	

})( jQuery );
