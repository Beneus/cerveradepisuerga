var map;
var geocoder;
var address;


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

function initialize2() {
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("mapa"));
        map.setMapType(G_HYBRID_MAP);
        map.setCenter(new GLatLng(Latitud, Longitud), 15);
        map.addControl(new GSmallMapControl());
				map.addControl(new GMapTypeControl());
				GEvent.addListener(map, "click", getAddress);
				geocoder = new GClientGeocoder();

      }
}

function initialize() {
      map = new GMap2(document.getElementById("mapa"));
	  map.setMapType(G_HYBRID_MAP);
      map.setCenter(new GLatLng(Latitud, Longitud), 15);
      map.addControl(new GSmallMapControl);
      GEvent.addListener(map, "click", getAddress);
      geocoder = new GClientGeocoder();
}

window.onload = function() {
  initialize();
};
window.onunload= function() {
  GUnload();
};