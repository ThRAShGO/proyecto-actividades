		//set up markers
	//	var templateUrl = "<?php  bloginfo('template_directory');?>";
	//	var rutaIcono = ('#imagenIcono').value;
		var myMarkers = {"markers": [
				{"latitude": "51.511732", "longitude":"-0.123270", "icon": "/wp-content/themes/demaqui/img/map-marker2.png"}
			]
		};
		
		//set up map options
		$("#map").mapmarker({
			zoom	: 14,
			center	: 'Covent Garden London',
			markers	: myMarkers
		});

