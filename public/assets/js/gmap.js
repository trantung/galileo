// configuration
var myZoom = 15;
var myMarkerIsDraggable = true;
var myCoordsLenght = 6;
//bang kok


// creates the map
// zooms
// centers the map
// sets the map’s type
var map = new google.maps.Map(document.getElementById('mapview'), {
	zoom: myZoom,
	center: new google.maps.LatLng(defaultLat, defaultLng),
	mapTypeId: google.maps.MapTypeId.ROADMAP
});
var contentString = "";

var inforwindow = new google.maps.InfoWindow({
    content: contentString
});
// creates a draggable marker to the given coords
var myMarker = new google.maps.Marker({
	position: new google.maps.LatLng(defaultLat, defaultLng),
	draggable: myMarkerIsDraggable,
    title:"Drag me!sdfasdfasdfasdfasdfafa"
});

inforwindow.open(map,myMarker);
// adds a listener to the marker
// gets the coords when drag event ends
// then updates the input with the new coords
google.maps.event.addListener(myMarker, 'dragstart', function(evt){
    inforwindow.setContent("<div>Release to update</div>");
});
google.maps.event.addListener(myMarker, 'dragend', function(evt){
    inforwindow.setContent(contentString);
	document.getElementById('latitude').value = evt.latLng.lat().toFixed(myCoordsLenght);
	document.getElementById('longitude').value = evt.latLng.lng().toFixed(myCoordsLenght);
	map.setCenter(new google.maps.LatLng(evt.latLng.lat(), evt.latLng.lng()));
});

$( "#viewmap" ).click(function() {
var latitude = document.getElementById('latitude').value;
var longitude = document.getElementById('longitude').value;

if(latitude!=""&&longitude!=""){
	var newLatLng = new google.maps.LatLng(latitude, longitude);
	myMarker.setPosition(newLatLng);

	map.setCenter(new google.maps.LatLng(latitude, longitude));
}
});

// centers the map on markers coords
//map.setCenter(new google.maps.LatLng(myMarker.position.latitude, myMarker.position.longitude));

// adds the marker on the map
myMarker.setMap(map);

var input = /** @type {HTMLInputElement} */(
    document.getElementById('pac-input'));
map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

// Listen for the event fired when the user selects an item from the
// pick list. Retrieve the matching places for that item.
google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();
    console.log(places);

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
        var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
        };
        var locate = place.geometry.location;
        console.log(locate);
        myMarker.setPosition(place.geometry.location);
        document.getElementById('latitude').value = locate.d;
        document.getElementById('longitude').value = locate.e;

        bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
    map.setZoom(15);
});

// Bias the SearchBox results towards places that are within the bounds of the
// current map's viewport.
google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
});
