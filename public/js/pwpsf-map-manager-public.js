jQuery(
	function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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

	if($("#pwpsf_map_manager_public").length > 0){
		$(document).on('change', '.event-filter', function () {
			showAllLocations();	

	    });
	    
	    function showAllLocations() {
			var data = new FormData();
			data.append('action', 'get_project_locations');
			data.append('sector', $('#project-sector').val() );
			data.append('type', $('#project-type').val() ); 
			
			$.ajax({
				url: helper.ajax_url+'?action=get_project_locations',
				type: "post",
				dataType: "json",
				data: data,
				contentType: false,
				processData: false,
				cache:false,
				success : function( response ) {
					deleteMarkers();
					$.each(response.locations, function(i, item) {
					    var project_location = response.locations[i];
					    console.log(project_location);
					    var project_location_coord = new google.maps.LatLng(project_location.lat,project_location.lng);
					    
					    var info_window_description = '<div id="content" class="infowindow" style="color: #002b49 !important; ">'+
			            '<div id="siteNotice" style =""><b>'+ project_location.post_title +
			            '</b></div>'+
			            '<div id="bodyContent" style="padding-top:10px;">'+
			            '<b>Sector:</b> '+ project_location.sector+'<br/>'+
			            '<b>Type:</b> '+ project_location.type+
			            '</div>'+
			            '</div>';
	                    var limits = new google.maps.LatLngBounds();
					    placeMarker(project_location_coord, project_location.color_pin,info_window_description, limits);
					});
				}
			}); 
	    }   
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

		var hlat = 44.58;   
		var hlng = -103.46;
		var pin_color = helper.pin_color ||"#FFFFFF";
		var pin_location = helper.pin_location;
		console.log(pin_location);  

		//markers array
		var markers = new Array();
		//infowindows array
		var infowindows = new Array();  

		var myLatLng = new google.maps.LatLng(hlat,hlng);
		var mapOptions = {
		  center: myLatLng,
		  zoom: 4,
		  gestureHandling: 'greedy',
		  mapTypeControlOptions: {
	        mapTypeIds: ['roadmap', 'satellite', 'hybrid', 'terrain',
	                'styled_map']
	      }

		};
		var map = new google.maps.Map(document.getElementById('pwpsf_map_manager_public'), 
			mapOptions);
		
		map.mapTypes.set('styled_map', styledMapType);
	    map.setMapTypeId('styled_map');
	    
	    
		/**
		** Function to display the marker in the map
		** Display the marker and add it to an marker array to be able to manage it later
		*/
		function placeMarker(location, icon_color, infowindow_desc, limits) {
			var infowindow = new google.maps.InfoWindow({
          		content: infowindow_desc,
          		maxWidth: 200
	        });
		
			//var map_icon = {
				//path: 'M280.559,213.902c0-20.837-18.495-38.983-50.981-50.308L214.446,41.988c28.187-6.831,43.57-18.324,43.57-32.765V0H59.195   v9.223c0,14.441,15.394,25.935,43.574,32.765l-15.12,121.594c-32.498,11.337-50.993,29.483-50.993,50.32v9.224H149.39v84.865   c0,5.093,4.125,9.224,9.224,9.224c5.089,0,9.223-4.131,9.223-9.224v-84.865h112.723V213.902z',
				//path: 'M348.748,106.141C348.748,47.532,301.212,0,242.604,0c-58.609,0-106.139,47.532-106.139,106.141   c0,53.424,39.61,97.196,90.976,104.598v274.473h30.327V210.739C309.119,203.337,348.748,159.565,348.748,106.141z',
				//path: 'M0-163.2c27,0,49,21.7,49,48.5C49-87.9,0,0,0,0s-49-87.9-49-114.7S-27-163.2,0-163.2z M0.2-100.2 c8.4,0,15.1-6.7,15.1-15s-6.8-15-15.1-15c-8.4,0-15.1,6.7-15.1,15S-8.2-100.2,0.2-100.2z',
				//path: pin_location,
				//fillColor: icon_color,
				//fillOpacity: 1.0,
				//scale: 0.25,
  				//anchor: new google.maps.Point(243, 486),
				//strokeColor: icon_color,
				//strokeWeight: 1
			//};	
				
			var marker = new google.maps.Marker({
			    position: location,
			    map: map,
			    animation: google.maps.Animation.DROP,
			    icon: pin_location
			});
		   
		    marker.addListener('click', function() {
	          infowindow.open(map, marker);
	        });

	        marker.addListener('mouseover', function() {
	          infowindow.open(map, marker);
	        });
	        
	        marker.addListener('mouseout', function() {
	          infowindow.close();
	        });
	        
	        markers.push(marker);
	        //infowindows.push(infowindow);
	        
	        limits.extend(marker.position);
	        //map.fitBounds(limits); 
 			//Centrar el mapa de acuerdo a los límites
			//map.setCenter(limits.getCenter()); 
			map.setCenter(myLatLng);
		}
		
		function setMapOnAll(map) {
		    //hace ciclo sobre los marcadores que hemos guardado en la variable markers
		    for (var i = 0; i < markers.length; i++) {
		      markers[i].setMap(map);
		    }
		}

		function deleteMarkers() {
		    setMapOnAll(null);
		    markers = [];
		}
		
		showAllLocations();
	} else {
		console.log('There is no place to put the map');
	} 
});
