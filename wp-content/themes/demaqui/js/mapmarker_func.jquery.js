		//set up markers
	//	var templateUrl = "<?php  bloginfo('template_directory');?>";
	//	var rutaIcono = ('#imagenIcono').value;
		var myMarkers = {"markers": [
				{"latitude": "37.1613725", "longitude":"-3.5936471", "icon": "/wp-content/themes/demaqui/img/map-marker2.png"}
			]
		};
		
		//set up map options
		$("#map").mapmarker({
			zoom	: 16,
			center	: 'Instituto de Educación Secundaria Zaidín Vergeles',
			markers	: myMarkers
		});

