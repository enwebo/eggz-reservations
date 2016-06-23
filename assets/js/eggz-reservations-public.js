(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * 
	 */

	$(function() {

		var dateDaysToShow = parseInt( POST_SUBMITTER.date_picker_days );
		var	openHours = POST_SUBMITTER.open_hours;
	
		// Render datepicker and timepicker
 		$('#datepicker').datetimepicker({
            useCurrent: true, //Important! See issue #1075
            stepping: 15,
            format: 'MM/DD/YYYY',
		    allowInputToggle: true,
            minDate: moment({ hour: 10, minute: 0, seconds: 0 }),
        	maxDate: moment().add( dateDaysToShow, 'days' ).hour( 24 )
        });

    	$('#timepicker').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            stepping: 15,
            format: 'hh:mm a',
		    allowInputToggle: true
        });


        $("#datepicker")
        	.on("dp.show", function (e) {
	        	
	        	// reinitialize timepicker
	        	$( '#timepicker' ).data( "DateTimePicker" ).destroy();
	        	$( '#timepicker' ).datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            stepping: 15,
		            allowInputToggle: true,
		            format: 'hh:mm a'
		        });
	        	$( '#timepicker' ).data( "DateTimePicker" ).hide();

        	})
        	.on("dp.hide", function (e) {
	        	$( '#timepicker' ).data( "DateTimePicker" ).show();
        	})
        	.on("dp.change", function (e) {
        		console.log( moment( e.date ).day() );
        		// get openenig/closing hours for selected day.
				var openingHour = openHours[ ( moment( e.date ).day() ) ].open;
		       	var closingHour = openHours[ ( moment( e.date ).day() ) ].close;

		       	// set default openenig/closing hours for selected day in case they are not set on admin options,
		       	// also format them if they are set on admin panel
		       	
		       	if( openingHour == undefined ){ openingHour = 10; }else{ openingHour = moment( openingHour, ["h:mm A"] ).format("H"); }
		       	if( closingHour == undefined ){ closingHour = 22; }else{ closingHour = moment( closingHour, ["h:mm A"] ).format("H"); }

	        	// check if current day is selected.
	        	if( moment( e.date ).date() == moment( new Date() ).date() ){
console.log('da');
	        		// check if current hour is over working hours.
	        		if( moment( new Date() ).hour() >= closingHour ) {

		        		alert('We are goin\' to close for today. Please make the reservation for another day.');

		        	} else {

	            		$( '#timepicker' ).data( "DateTimePicker" ).defaultDate( moment( e.date ).format( "hh:mm A" ) );
	            		$( '#timepicker' ).data( "DateTimePicker" ).date( moment( e.date ) );
		           		$( '#timepicker' ).data( "DateTimePicker" ).minDate( moment( e.date ) );
		           		$( '#timepicker' ).data( "DateTimePicker" ).maxDate( moment( e.date ).hour( closingHour ).minute(0).second(0) );

		       		}

		       	} else {

	            	$( '#timepicker' ).data( "DateTimePicker" ).date( moment( e.date ).hour( openingHour ).minute(0).second(0) );
	            	$( '#timepicker' ).data( "DateTimePicker" ).maxDate( moment( e.date ).hour( closingHour ).minute(0).second(0) );
	            	$( '#timepicker' ).data( "DateTimePicker" ).minDate( moment( e.date ).hour( openingHour ).minute(0).second(0) );
	        	}

        	});

		// Book table form send

	    $( '.reservations-form' ).on( 'click', '#book-a-table-trigger', function(e) {

	        e.preventDefault();

	        if( $( '.add-reservation-form' ).valid() ){
		        var name = $( '.add-reservation-name' ).val();
		        var date = $( '#datepicker input' ).val();
		        var time = $( '#timepicker input' ).val();
		        var persons = $( '.personspicker button' ).attr('title');
		        var special_requests = $( '.add-reservation-special-requests' ).val();

		        $.ajax({
		            method: "POST",
		            url: POST_SUBMITTER.ajax_url,
					type : "post",
		            data: {
		            	action: 'eggz_reservation_details',
		           		title: name,
		           		date: date,
		           		time: time,
		           		persons: persons,
			            special_requests: special_requests,
			            nonce: POST_SUBMITTER.nonce
			        },
		            success : function( response ) {
		                $( '.reservations-form' ).append( response );
		                $( '.add-reservation-form' ).remove();
		            },
		            fail : function( response ) {
		                // console.log( response );
		            }

		        });

		    } else {
		    	alert('Please fill all required items');
		    }

		});

	    // Add reservation on database
	    $( '.reservations-form' ).on( 'click', '#add-a-reservation-trigger', function(e) {

	    	e.preventDefault();

	        // check for valid fields
	        if( $( '.eggz-reservations-details' ).valid() ){
		        var date 		= $( '.send-reservation-date' ).val();
		        var time 		= $( '.send-reservation-time' ).val();
		        var persons 	= $( '.send-reservation-persons' ).val();
		        var phone 		= $( '.send-reservation-phone' ).val();
		        var name 		= $( '.send-reservation-full-name' ).val();
		        var email 		= $( '.send-reservation-email' ).val();
		        var request 	= $( '.send-reservation-special-request' ).val();

		        $.ajax({
		            method: "POST",
		            url: POST_SUBMITTER.ajax_url,
					type : "post",
		            data: {
		            	action: 'eggz_add_reservation',
		           		title: name,
		           		name: name,
		           		date: date,
		           		time: time,
		           		persons: persons,
		           		phone: phone,
		           		email: email,
			            request: request,
			            nonce: POST_SUBMITTER.nonce
			        },
		            success : function( response ) {
		                console.log( response );
		                $( '.reservations-form' ).append( response );
		                $( '.eggz-reservations-details' ).remove();
		            },
		            fail : function( response ) {
		                console.log( response );
		            }

		        });

		    } else {

		    	alert('Please fill all required items');

		    }

		});


		var $reservation_box = $(".reservation-content");

		$( '.eggz-reservation-trigger' ).on( 'click', function(e) {

			e.preventDefault();
			$( '.eggz-reservation-details' ).slideUp('fast');
			$( '.reservation-content' ).removeClass('open');

			$( this ).parents( '.reservation-content' ).find( '.eggz-reservation-details' ).slideToggle('fast');
			$( this ).parents( '.reservation-content' ).addClass('open');
		
		});
		
		$(window).on("click.Bst", function(event){		

			if ( $reservation_box.has(event.target).length == 0 && !$reservation_box.is(event.target) ){

				$( '.eggz-reservation-details' ).fadeOut('fast');
				$( '.reservation-content' ).removeClass('open');

			} else {

				return false;

			}

		});

		// SelectPicker
		$('.selectpicker').selectpicker();

		// filter reservations
		$( ".reservations-filters li" ).on( "click tap", function(e) {
	        e.preventDefault();
	        $( '.reservation-box' ).hide();
			$( '.' + $(this).data("type") ).show();
			$(this).data("type");

		});

		// sort reservations


		
		// set table for reservation
		$( '.eggz-reservations' ).on( 'change', 'select', function() {

			var id = $(this).data( 'postid' ),
				currentTable = $(this).data( 'table' ),
				table = $(this).find( 'option:selected' ).val();

	    	$.ajax({
	            method: "POST",
	            url: POST_SUBMITTER.ajax_url,
	            data: {
	            	action: 'eggz_set_reservation_table',
	           		id: id,
	           		table: table
		        },
	            success : function( response ) {
	                $( '.eggz-reservations-list' ).find( '[data-postid="' + id + '"]' ).removeClass( 'unassigned' ).removeClass( currentTable ).addClass( table ).data( 'table', table );
	            }

	        });

		});

		
		// edit reservation
		$('#editReservationModal').on('show.bs.modal', function (e) {

			var button = $( e.relatedTarget ); // Button that triggered the modal
			var modal = $( this );

			// Set modal form values
			modal.find( '.date' ).text( button.data( 'date' ) );
			modal.find( '.modal-body input#reservation-id' ).val( button.data( 'id' ) );
			modal.find( '.modal-body input#date' ).val( button.data( 'date' ) );
			modal.find( '.modal-body input#time' ).val( button.data( 'time' ) );
			modal.find( '.modal-body input#persons' ).val( button.data( 'persons' ) );
			modal.find( '.modal-body input#email' ).val( button.data( 'email' ) );
			modal.find( '.modal-body input#phone' ).val( button.data( 'phone' ) );
			modal.find( '.modal-body input#name' ).val( button.data( 'name' ) );
			modal.find( '.modal-body textarea#specialrequest' ).val( button.data( 'specialrequests' ) );

			// Initialize Date Picker
			modal.find( '.modal-body input#date' ).datetimepicker({
	            useCurrent: true, //Important! See issue #1075
	            stepping: 15,
	            format: 'MM/DD/YYYY',
			    allowInputToggle: true,
	            // minDate: moment({ hour: 10, minute: 0, seconds: 0 }),
	        	// maxDate: moment().add( dateDaysToShow, 'days' ).hour( 24 )
	        });

			// Initialize Time Picker
	        modal.find( '.modal-body input#time' ).datetimepicker({
	            useCurrent: false, //Important! See issue #1075
	            stepping: 15,
	            format: 'hh:mm a',
			    allowInputToggle: true
	        });

			// Update Reservation
	    	modal.find( '.edit-reservation-modal-save' ).on( 'click tap', function(e) {

	        	e.preventDefault();

	        	if ( modal.find( 'form' ).valid() ){
					
					modal.find( '.eggz-abs-loader' ).show();
					modal.find( 'form' ).css('opacity', ".5");

					$.ajax({
					    url: POST_SUBMITTER.ajax_url,
						method : "POST",
					    data: {
					    	action: 'eggz_update_reservation',
					   		id: modal.find( '.modal-body input#reservation-id' ).val(),
					   		date: modal.find( '.modal-body input#date' ).val(),
					   		time: modal.find( '.modal-body input#time' ).val(),
					   		persons: modal.find( '.modal-body input#persons' ).val(),
					   		email: modal.find( '.modal-body input#email' ).val(),
					   		phone: modal.find( '.modal-body input#phone' ).val(),
					   		name: modal.find( '.modal-body input#name' ).val(),
					   		request: modal.find( '.modal-body input#specialrequests' ).val()
					    },
					    success : function( response ) {
					    	modal.find( '.eggz-abs-loader' ).hide();
					    	modal.find( 'form' ).css('opacity', "1");
					        console.log( response + ' - ok' );



					        // $( '#editReservationModal' ).
					    },
					    fail : function( response ) {
					    	modal.find( '.eggz-abs-loader' ).hide();
					    	modal.find( 'form' ).css('opacity', "1");
					        console.log( response );
					    }
					});

	        	}

	        });

	        // modal.find( '.modal-body input#persons' ).selectpicker();

		});

		
		// delete reservation
		
		
		var deleteAll = false;
		$('#deleteReservationModal')
			.on('show.bs.modal', function (e) {

				var button = $( e.relatedTarget ); // Button that triggered the modal
				var modal = $( this );
				modal.find( '.reservation-id' ).val( button.data( 'id' ) );
				modal.find( '.delete-all-reservations' ).val( button.data( 'delete-all' ) );

				// set messageto be shown om modal
				if ( button.data( 'delete-all' ) ) {
					deleteAll = true;
					modal.find( 'p' ).hide();
					modal.find( 'p.delete-all-reservations-message' ).show();
				} else {
					modal.find( 'p' ).hide();
					modal.find( 'p.delete-single-reservation-message' ).show();
				}

			})
			.on( 'click tap', '.yes', function(e) {
				
				e.preventDefault();
				console.log(deleteAll);
				var id = $(this).parent().find( '.reservation-id' ).val();

				$.ajax({
				    url: POST_SUBMITTER.ajax_url,
					method : "POST",
				    data: {
				    	action: 'eggz_delete_reservation',
				    	deleteall: deleteAll,
				    	id: id
				    },
				    success : function( response ) {
				        console.log( response );
				        if ( deleteAll ) {
				        	$( '.eggz-reservations-list' ).empty();
				        }else{
		                	$( '.eggz-reservations-list' ).find( '[data-postid="' + id + '"]' ).remove();
				        }
						$( '#deleteReservationModal' ).modal('hide');
				    },
				    fail : function( response ) {
				        console.log( response );
				    }
				});

			});

	});

})( jQuery );
