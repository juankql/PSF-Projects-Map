jQuery(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	 function initialize() {
		var hlat = parseFloat(helper.lat)||37.09024;   
		var hlng = parseFloat(helper.lng)||-95.712891;
		var pin_color = helper.pin_color ||"#FFFFFF"; 
		var pin_location = helper.pin_location;  
		console.log(pin_location);   

		var styledMapType = new google.maps.StyledMapType(
			[
			    {
			        "featureType": "all",
			        "elementType": "labels.text.fill",
			        "stylers": [
			            {
			                "color": "#ffffff"
			            }
			        ]
			    },
			    {
			        "featureType": "all",
			        "elementType": "labels.text.stroke",
			        "stylers": [
			            {
			                "color": "#000000"
			            },
			            {
			                "lightness": 13
			            }
			        ]
			    },
			    {
			        "featureType": "administrative",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "color": "#000000"
			            }
			        ]
			    },
			    {
			        "featureType": "administrative",
			        "elementType": "geometry.stroke",
			        "stylers": [
			            {
			                "color": "#144b53"
			            },
			            {
			                "lightness": 14
			            },
			            {
			                "weight": 1.4
			            }
			        ]
			    },
			    {
			        "featureType": "landscape",
			        "elementType": "all",
			        "stylers": [
			            {
			                "color": "#08304b"
			            }
			        ]
			    },
			    {
			        "featureType": "poi",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#0c4152"
			            },
			            {
			                "lightness": 5
			            }
			        ]
			    },
			    {
			        "featureType": "road.highway",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "color": "#000000"
			            }
			        ]
			    },
			    {
			        "featureType": "road.highway",
			        "elementType": "geometry.stroke",
			        "stylers": [
			            {
			                "color": "#0b434f"
			            },
			            {
			                "lightness": 25
			            }
			        ]
			    },
			    {
			        "featureType": "road.arterial",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "color": "#000000"
			            }
			        ]
			    },
			    {
			        "featureType": "road.arterial",
			        "elementType": "geometry.stroke",
			        "stylers": [
			            {
			                "color": "#0b3d51"
			            },
			            {
			                "lightness": 16
			            }
			        ]
			    },
			    {
			        "featureType": "road.local",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#000000"
			            }
			        ]
			    },
			    {
			        "featureType": "transit",
			        "elementType": "all",
			        "stylers": [
			            {
			                "color": "#146474"
			            }
			        ]
			    },
			    {
			        "featureType": "water",
			        "elementType": "all",
			        "stylers": [
			            {
			                "color": "#021019"
			            }
			        ]
			    }
			],
			{name: 'Styled Map'});


		var myLatLng = new google.maps.LatLng(hlat,hlng);
		var mapOptions = {
		  center: myLatLng,
		  zoom: 5,
		  gestureHandling: 'greedy',
		  mapTypeControlOptions: {
            mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
                    'styled_map']
          }

		};
		var map = new google.maps.Map(document.getElementById('map-canvas'),
		    mapOptions);
		
		map.mapTypes.set('styled_map', styledMapType);
        map.setMapTypeId('styled_map');

	//var map_icon = {
		    //path: 'M348.748,106.141C348.748,47.532,301.212,0,242.604,0c-58.609,0-106.139,47.532-106.139,106.141   c0,53.424,39.61,97.196,90.976,104.598v274.473h30.327V210.739C309.119,203.337,348.748,159.565,348.748,106.141z',
		    //path: 'M280.559,213.902c0-20.837-18.495-38.983-50.981-50.308L214.446,41.988c28.187-6.831,43.57-18.324,43.57-32.765V0H59.195   v9.223c0,14.441,15.394,25.935,43.574,32.765l-15.12,121.594c-32.498,11.337-50.993,29.483-50.993,50.32v9.224H149.39v84.865   c0,5.093,4.125,9.224,9.224,9.224c5.089,0,9.223-4.131,9.223-9.224v-84.865h112.723V213.902z',
		    //path: 'M0-163.2c27,0,49,21.7,49,48.5C49-87.9,0,0,0,0s-49-87.9-49-114.7S-27-163.2,0-163.2z M0.2-100.2 c8.4,0,15.1-6.7,15.1-15s-6.8-15-15.1-15c-8.4,0-15.1,6.7-15.1,15S-8.2-100.2,0.2-100.2z',
		    //path: pin_location,    
		    //fillColor: pin_color,
			//fillOpacity: 1.0,
			//scale: 0.25,
  			//anchor: new google.maps.Point(243, 486),
			//strokeColor: pin_color,
			//strokeWeight: 1
		//};

		var marker = new google.maps.Marker({position: myLatLng, map: map, draggable: true, icon: pin_location });
		marker.setMap(map);

	    google.maps.event.addListener(map, 'click', function(event) {
	        placeMarker(event.latLng);
	    });

	    google.maps.event.addListener(marker, 'dragend', function(event) {
	        placeMarker(event.latLng);
	    });

		function placeMarker(location) {			
		    if (marker == undefined){
		        marker = new google.maps.Marker({
		            position: location,
		            map: map,
		            animation: google.maps.Animation.DROP,
		            icon: map_icon
		        });
		    }
		    else {
		        marker.setPosition(location);
		    }
		    map.setCenter(location);
		    console.log(location.lat()+" "+location.lng());		// click debug
		    document.getElementById("latitude").value = location.lat();
		    document.getElementById("longitude").value = location.lng();
		}
		
		$('#geocoder').on('click', function() {
			var map_icon = {
			    path: 'M280.559,213.902c0-20.837-18.495-38.983-50.981-50.308L214.446,41.988c28.187-6.831,43.57-18.324,43.57-32.765V0H59.195   v9.223c0,14.441,15.394,25.935,43.574,32.765l-15.12,121.594c-32.498,11.337-50.993,29.483-50.993,50.32v9.224H149.39v84.865   c0,5.093,4.125,9.224,9.224,9.224c5.089,0,9.223-4.131,9.223-9.224v-84.865h112.723V213.902z',
			    fillColor: pin_color,
			    fillOpacity: 0.8,
			    scale: 0.1,
  				anchor: new google.maps.Point(256, 512),
			    strokeColor: pin_color,
			    strokeWeight: 1
			};
			
	        var address = $('#address').val();
	        console.log('Address:'+address);
	        var geocoder = new google.maps.Geocoder();
	        geocoder.geocode({'address': address}, function(results, status) {
          		if (status === 'OK') {
          			placeMarker(results[0].geometry.location);  
			        
          		} else {
            		alert('Geocode was not successful for the following reason: ' + status);
          		}
	        });
    	});
		
	}
	
	initialize();
    
});
