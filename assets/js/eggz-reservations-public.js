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
            useCurrent: false, //Important! See issue #1075
            stepping: 15,
            format: 'MM/DD/YYYY',
            minDate: moment({hour: 10, minute: 0, seconds: 0}),
        	maxDate: moment().add(dateDaysToShow, 'days').hour(24)
        });

    	$('#timepicker').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            stepping: 15,
            format: 'hh:mm a'
        });

    	// Make DateTimePicker to open on input field click
        $("#datepicker input").on("click tap", function(e){
	        $( '#datepicker' ).data( "DateTimePicker" ).show();
	    });
        $("#timepicker input").on("click", function(e){ 
	        $( '#timepicker' ).data( "DateTimePicker" ).show();
	    });

        $("#datepicker")
        	.on("dp.show", function (e) {
	        	
	        	// reinitialize timepicker
	        	$( '#timepicker' ).data( "DateTimePicker" ).destroy();
	        	$('#timepicker').datetimepicker({
		            useCurrent: false, //Important! See issue #1075
		            stepping: 15,
		            format: 'hh:mm a'
		        });
	        	$( '#timepicker' ).data( "DateTimePicker" ).hide();

        	})
        	.on("dp.hide", function (e) {
	        	$( '#timepicker' ).data( "DateTimePicker" ).show();
        	})
        	.on("dp.change", function (e) {
        		
        		// get openenig/closing hours for selected day.
				var openingHour = openHours[ ( moment( e.date ).day() ) ].open;
		       	var closingHour = openHours[ ( moment( e.date ).day() ) ].close;

		       	// set default openenig/closing hours for selected day in case they are not set on admin options
		       	if( openingHour == undefined ){ openingHour = 10; }
		       	if( closingHour == undefined ){ closingHour = 22; }

	        	// check if current day is selected.
	        	if( moment( e.date ).date() == moment( new Date() ).date() ){

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

	    $( '.add-reservation-form' ).on( 'click', '#book-a-table-trigger', function(e) {

	        	e.preventDefault();

	        if( $( '.add-reservation-form' ).valid() ){
		        var name = $( '.add-reservation-name' ).val();
		        var date = $( '#datepicker input' ).val();
		        var time = $( '#timepicker input' ).val();
		        var persons = $( '.personspicker' ).val();
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
		                console.log( response );
		                $( '.add-reservation-form' ).append( response );
		            },
		            fail : function( response ) {
		                console.log( response );
		            }

		        });

		    } else {
		    	alert('Please fill all required items');
		    }

		});

	    // Add reservation on database
	    $( '.add-reservation-form' ).on( 'click', '.add-reservation', function(e) {
	        e.preventDefault();

	        // check for valid fields
	        if( $( '.add-reservation-form' ).valid() ){
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
		                $( '.add-reservation-form' ).append( response );
		            },
		            fail : function( response ) {
		                console.log( response );
		            }

		        });

		    } else {
		    	alert('Please fill all required items');
		    }

		});


	    // add expand details list for reservation box
		$( '.reservation-box' ).on( 'click', function(e) {
	        e.preventDefault();
	        $( '.reservation-details' ).hide();
	        $( this ).find( '.reservation-details' ).show();
		});


		// filter reservations
		$(".reservations-filters li").on("click tap", function(e) {
	        e.preventDefault();
	        $( '.reservation-box' ).hide();
			$( '.' + $(this).data("type") ).show();
			$(this).data("type");

		});

		// sort reservations

	});



})( jQuery );
