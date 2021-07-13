@extends('admin.master')

@section('content')
<style>
	.alert {
		font-size:25px;
	}

</style>
<div class="content">

	<div class="row">
		<div class="btn btn-success d-none yenile"  onclick="initMap()"><i class="fa fa-sync"></i></div> 
	<div id="directions" class="d-none"></div>
		<div id="map"></div>

		<!-- Async script executes immediately and must be after any DOM elements used in callback. -->
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBnVAmvkojn4AE-eUtmS9_rFmumbGvQN74&callback=initMap&libraries=&v=weekly"
			async></script>
			<style>
				#page-container {
					background:#000;
				}
				#map {
					height: 100vh;
					width:100%;
				}
				.yenile {
					position:fixed;
					top:80px;
					right:10px;
					z-index:100;
				}
				#directions {
					position: fixed;
					top: 150px;
					right: 10px;
					z-index: 100;
					background: white;
					width: 300px;
					padding: 10px;
				}
			</style>
<script>
var start,end,map,directionsDisplay;
function initMap() {
	$("#directions").html("").addClass("d-none");
	 directionsDisplay = new google.maps.DirectionsRenderer({ draggable: true });
	 directionsDisplay.addListener('directions_changed', function() {
    createPolyline(directionsDisplay.getDirections());
  });
  var clat = 37.066666;
  var clng = 37.383331;
  var r1 = clat  + Math.random()/10;
  var r2 = clng - Math.random()/10;
  var r3 = r1 + 0.05; //Math.random();
  var r4 = r2 + 0.05; //Math.random();

	 start = new google.maps.LatLng(r1, r2);
	 //37.029681, 37.377844
	 end = new google.maps.LatLng(r3, r4);
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer();
   map = new google.maps.Map(document.getElementById("map"), {
    zoom: 13,
	styles: [
      { elementType: "geometry", stylers: [{ color: "#242f3e" }] },
      { elementType: "labels.text.stroke", stylers: [{ color: "#242f3e" }] },
      { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
      {
        featureType: "administrative.locality",
        elementType: "labels.text.fill",
        stylers: [{ color: "#d59563" }],
      },
	  {
    "featureType": "road.arterial",
    "elementType": "geometry",
    "stylers": [
      { "color": "#fff" }
    ]
  },
      {
        featureType: "poi",
        elementType: "labels.text.fill",
        stylers: [{ color: "#d59563" }],
      },
      {
        featureType: "poi.park",
        elementType: "geometry",
        stylers: [{ color: "#263c3f" }],
      },
      {
        featureType: "poi.park",
        elementType: "labels.text.fill",
        stylers: [{ color: "#6b9a76" }],
      },
      {
        featureType: "road",
        elementType: "geometry",
        stylers: [{ color: "#38414e" }],
      },
      {
        featureType: "road",
        elementType: "geometry.stroke",
        stylers: [{ color: "#212a37" }],
      },
      {
        featureType: "road",
        elementType: "labels.text.fill",
        stylers: [{ color: "#9ca5b3" }],
      },
      {
        featureType: "road.highway",
        elementType: "geometry",
        stylers: [{ color: "#746855" }],
      },
      {
        featureType: "road.highway",
        elementType: "geometry.stroke",
        stylers: [{ color: "#1f2835" }],
      },
      {
        featureType: "road.highway",
        elementType: "labels.text.fill",
        stylers: [{ color: "#f3d19c" }],
      },
      {
        featureType: "transit",
        elementType: "geometry",
        stylers: [{ color: "#2f3948" }],
      },
      {
        featureType: "transit.station",
        elementType: "labels.text.fill",
        stylers: [{ color: "#d59563" }],
      },
      {
        featureType: "water",
        elementType: "geometry",
        stylers: [{ color: "#17263c" }],
      },
      {
        featureType: "water",
        elementType: "labels.text.fill",
        stylers: [{ color: "#515c6d" }],
      },
      {
        featureType: "water",
        elementType: "labels.text.stroke",
        stylers: [{ color: "#17263c" }],
      },
    ],
    center: { lat: 37.066666, lng: 37.383331 }
  });
  directionsRenderer.setMap(map);
  google.maps.event.addListener(directionsDisplay, 'directions_changed', function () {
    map.setZoom(10);
});
 

  const onChangeHandler = function () {
    calculateAndDisplayRoute(directionsService, directionsRenderer);
  };

  window.setTimeout(function(){
	  //37.015224, 37.355025


	
    notify("Yeni bir acil yardım ihbarı alındı","danger");
	
    map.setCenter(end);
	map.setZoom(15);
	const marker = new google.maps.Marker({
          position: end,
          map: map,
        });
  },1000);
  
  window.setTimeout(function(){
	notify("En hızlı ulaşacak ambulans birimi belirlendi.","warning");
	
    map.setCenter(start);
	map.setZoom(15);
	const marker = new google.maps.Marker({
          position: start,
		  icon: 'cache/original/2021/07/69516305-062841.png',
          map: map,
        });
  
  },3000);
  window.setTimeout(function(){
	  notify("Trafik yoğunluğuna göre en uygun rota belirlenecek...","success");
	const trafficLayer = new google.maps.TrafficLayer();
  trafficLayer.setMap(map);
  },6000);
  window.setTimeout(function(){
	  
		calculateAndDisplayRoute(directionsService, directionsRenderer);
		$("#directions").removeClass("d-none");
		window.setTimeout(function(){
			notify("Ambulans olay yerine doğru yola çıkıyor. Tahmini ulaşım " +$('[jstcache="50"]').text());
		},500);
	},9000);
	window.setTimeout(function(){
		notify("Güzergah üzerindeki trafik ışıkları yeşil dalgaya döndürülüyor...","success");
		directionsDisplay.setOptions({
		polylineOptions: {
			strokeColor: 'green'
			}
		});
		directionsDisplay.setMap(map);
		$(".yenile").removeClass("d-none");
	},12000);
}
function notify(text,type='info') {
	Codebase.helpers('notify', {
		align: 'center',             // 'right', 'left', 'center'
		from: 'bottom',                // 'top', 'bottom'
		type: type,               // 'info', 'success', 'warning', 'danger'
		icon: 'fa fa-info mr-5',    // Icon class
		message: text
	});
}
function calculateAndDisplayRoute(directionsService, directionsRenderer) {
	
  directionsService
    .route({
      origin: start,
      destination: end,
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);
	 // directionsDisplay.setMap(map);
	 map.setZoom(9);
	map.setCenter(start);
  		directionsDisplay.setPanel(document.getElementById("directions"));
		  new google.maps.DirectionsRenderer({
			map: map,
			panel: document.getElementById('directions'),
			directions: response
			});
    })
    .catch((e) => window.alert("Rota belirleme hatası " + status));
	
  
}

</script>
	</div>

</div>

@endsection
