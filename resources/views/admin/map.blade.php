<!DOCTYPE html>
<html>
<head>
<title>Place Autocomplete</title>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<style>
#right-panel {
font-family: 'Roboto','sans-serif';
line-height: 30px;
padding-left: 10px;
}

#right-panel select, #right-panel input {
font-size: 15px;
}

#right-panel select {
width: 100%;
}

#right-panel i {
font-size: 12px;
}
html, body {
height: 100%;
margin: 0;
padding: 0;
}
#map {
height: 100%;
float: left;
width: 70%;
height: 100%;
}
#right-panel {
margin: 20px;
border-width: 2px;
width: 20%;
float: left;
text-align: left;
padding-top: 20px;
}
#directions-panel {
margin-top: 20px;
background-color: #FFEE77;
padding: 10px;
}
</style>
</head>
<body>

<div id="map"></div>
<div id="right-panel">
<div>
<b>Start:</b>
<input id="start" class="controls" type="text"
placeholder="Enter a location">

<br>

<b>End:</b>
<input id="end" class="controls" type="text"
placeholder="Enter a location">

<br>

<div class="input_fields_wrap">
<b>Via:</b>
<input id="waypoints_1" name="waypoints[]" class="waypoints" type="text"
placeholder="Enter a location">

</div>
<input type="submit" id="submit">&nbsp;<button class="add_field_button">Add More</button>
</div>
<div id="directions-panel"></div>
</div>

<script>

function initMap() {
var directionsService = new google.maps.DirectionsService;
var directionsDisplay = new google.maps.DirectionsRenderer;

var map = new google.maps.Map(document.getElementById('map'), {
center: {lat: -33.8688, lng: 151.2195},
zoom: 13
});
var input =(document.getElementById('start'));
var autocomplete = new google.maps.places.Autocomplete(input);

var end =(document.getElementById('end'));
var autocomplete = new google.maps.places.Autocomplete(end);

var mid =(document.getElementById('waypoints_1'));
var autocomplete = new google.maps.places.Autocomplete(mid);

autocomplete.bindTo('bounds', map);

directionsDisplay.setMap(map);

document.getElementById('submit').addEventListener('click', function() {
calculateAndDisplayRoute(directionsService, directionsDisplay);
});

}
function calculateAndDisplayRoute(directionsService, directionsDisplay) {
var waypts = [];
$('.input_fields_wrap').find('input[id^="waypoints_"]').each(function(){

var checkboxArray = document.getElementById($(this).attr('id'));

if(checkboxArray.value!=''){
waypts.push({
location: checkboxArray.value,
stopover: true
})
}
});
/*for (var i = 0; i < checkboxArray.length; i++) {
if (checkboxArray.options[i].selected) {
waypts.push({
location: checkboxArray[i].value,
stopover: true
});
}
}*/

directionsService.route({
origin: document.getElementById('start').value,
destination: document.getElementById('end').value,
waypoints: waypts,
optimizeWaypoints: true,
travelMode: google.maps.TravelMode.DRIVING
}, function(response, status) {
if (status === google.maps.DirectionsStatus.OK) {
directionsDisplay.setDirections(response);
var route = response.routes[0];
var summaryPanel = document.getElementById('directions-panel');
summaryPanel.innerHTML = '';
// For each route, display summary information.

var dset=0;
for (var i = 0; i < route.legs.length; i++) {
var routeSegment = i + 1;
summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
'</b><br>';
summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
summaryPanel.innerHTML += route.legs[i].distance.text + '<br>';
summaryPanel.innerHTML += 'Lat : ' +route.legs[i].start_location.lat() +'<br>';
summaryPanel.innerHTML += 'Long : ' +route.legs[i].start_location.lng() +'<br><br>';
}
summaryPanel.innerHTML += 'Lat : ' +route.legs[dset].end_location.lat() +'<br>';
summaryPanel.innerHTML += 'Long : ' +route.legs[dset].end_location.lng() +'<br><br>';
} else {
window.alert('Directions request failed due to ' + status);
}
});
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4yR0QYbk-PSt19ImAdnw3nKHWfTvhXRo&libraries=places&callback=initMap"
async defer></script>
<script type="text/javascript" src='http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>

<script>
$(document).ready(function() {
var max_fields = 10; //maximum input boxes allowed
var wrapper = $(".input_fields_wrap"); //Fields wrapper
var add_button = $(".add_field_button"); //Add button ID

var x = 1; //initlal text box count
$(add_button).click(function(e){ //on add input button click
e.preventDefault();
if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<div><input type="text" id="waypoints_'+ x +'" onclick="call(this.id)" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
}
});

$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
e.preventDefault(); $(this).parent('div').remove(); x--;
})
});
function call(id){
var mid =(document.getElementById(id));
var autocomplete = new google.maps.places.Autocomplete(mid);
}
</script>
</body>
</html>