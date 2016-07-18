(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 */
	$(function() {

		var args = {
			useCurrent: false, //Important! See issue #1075
			stepping: 15,
			format: 'hh:mm a',
			keepOpen: true,
			debug:true
		};

		$('.timepicker').datetimepicker(args);


		$('#add-repeater').on('click tap', function(e){
			setTimeout( function(){
				$('.repeater').last().prev().find('input.timepicker').each( function () {
					console.log( $(this).datetimepicker(args) );
					$(this).datetimepicker(args);
				}, 1000);
			});
		});

	});


})( jQuery );
