var map;
var geocoder;
var address;
var galleta;
var html;

function getAddress(overlay, latlng) {
  if (latlng != null) {
    address = latlng;
    geocoder.getLocations(latlng, showAddress);
  }
}

function showAddress(response) {
  map.clearOverlays();
  if (!response || response.Status.code != 200) {
    alert("Status Code:" + response.Status.code);
  } else {
    place = response.Placemark[0];
	Latitud = place.Point.coordinates[1];
	Longitud = place.Point.coordinates[0];
	CambiarMapa('N');
	CambiarMapa('E');

    /*
	point = new GLatLng(place.Point.coordinates[1],place.Point.coordinates[0]);
    marker = new GMarker(point);
    map.addOverlay(marker);
	
    marker.openInfoWindowHtml(
        '<b>orig latlng:</b>' + response.name + '<br/>' + 
        '<b>latlng:</b>' + place.Point.coordinates[0] + "," + place.Point.coordinates[1] + '<br>' +
        '<b>Status Code:</b>' + response.Status.code + '<br>' +
        '<b>Status Request:</b>' + response.Status.request + '<br>' +
        '<b>Address:</b>' + place.address + '<br>' +
        '<b>Accuracy:</b>' + place.AddressDetails.Accuracy + '<br>' +
        '<b>Country code:</b> ' + place.AddressDetails.Country.CountryNameCode);
	*/
  }
}

/*
G_NORMAL_MAP
G_SATELLITE_MAP
G_HYBRID_MAP
*/

function initialize() {
      map = new GMap2(document.getElementById("mapa"));
	  	map.setMapType(G_HYBRID_MAP);
	  	point = new GLatLng(Latitud, Longitud);
      map.setCenter(new GLatLng(Latitud, Longitud), 16);
      GEvent.addListener(map, "click", getAddress);
      
      var mapControl = new GMapTypeControl();
      map.addControl(mapControl);
      map.addControl(new GSmallMapControl);
      marker = new GMarker(point);
    	map.addOverlay(marker);
      map.openInfoWindow(map.getCenter(),html);
      geocoder = new GClientGeocoder();
}

window.onload = function() {
  initialize();
};
window.onunload= function() {
  GUnload();
};

/*
if (GBrowserIsCompatible()) {
         var map = new GMap2(document.getElementById('map_canvas'));
         var marker = new GMarker(new GLatLng(37.4228, -122.085));
         var html = '<div style="width:210px; padding-right:10px;">'+
            '<a href="signup.html">Sign up</a> for a Google Maps API key'+
            ', or <a href="documentation/index.html">read more about the'+
            ' API</a>.</div>';
 
         map.setCenter(new GLatLng(37.4328, -122.077), 13);
         map.addControl(new GSmallMapControl());
         map.addOverlay(marker);
         marker.openInfoWindowHtml(html);
       }
       
       */