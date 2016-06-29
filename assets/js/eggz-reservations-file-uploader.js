(function( $ ) {

	'use strict';

	$(function() {

		//Opens the Media Library, assigns chosen file URL to input field, switches links
		$( '.upload-file' ).on( 'click', function( e ) {

			var	field =  $(this).siblings().first().next(),
					upload = $(this).parent().find( '.upload-file' ),
					remove = $(this).parent().find( '.remove-file' );

			// Stop the anchor's default behavior
			e.preventDefault();
			var file_frame, json;

			if ( undefined !== file_frame ) {
				file_frame.open();
				return;
			}

			file_frame = wp.media.frames.file_frame = wp.media({
				button: {
					text: 'Choose File',
				},
				frame: 'select',
				multiple: false,
				title: 'Choose File'
			});

			file_frame.on( 'select', function() {

				json = file_frame.state().get( 'selection' ).first().toJSON();

				if ( 0 > $.trim( json.url.length ) ) {
					return;
				}

				/*
				View all the properties in the console available from the returned JSON object

				for ( var property in json ) {

					console.log( property + ': ' + json[ property ] );

				}*/

				field.val( json.url );
				upload.toggleClass( 'hide' );
				remove.toggleClass( 'hide' );

			});

			file_frame.open();

		});

		//Remove value from input, switch links
		$( '.remove-file' ).on( 'click', function( e ) {

			// Stop the anchor's default behavior
			e.preventDefault();


			var	field =  $(this).siblings().first().next(),
					upload = $(this).parent().find( '.upload-file' ),
					remove = $(this).parent().find( '.remove-file' );

			// clear the value from the input
			field.val('');

			// change the link message
			upload.toggleClass( 'hide' );
			remove.toggleClass( 'hide' );

		});

	});

})( jQuery );