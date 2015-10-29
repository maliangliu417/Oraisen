<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body, #map-canvas {
      	width: 80%;
        height: 80%;
        margin: 0px auto;
        padding: 0px
      }
      .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

    </style>
    <title>Places search box</title>
    
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script>
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

function initialize() {

  var markers = [];
  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);

  // Create the search box and link it to the UI element.
  var input = /** @type {HTMLInputElement} */(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox(
    /** @type {HTMLInputElement} */(input));

  // [START region_getplaces]
  // Listen for the event fired when the user selects an item from the
  // pick list. Retrieve the matching places for that item.
  google.maps.event.addListener(searchBox, 'places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

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

      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        title: place.name,
        position: place.geometry.location
      });

      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
    <style>
      #target {
        width: 345px;
      }
      .zipcode-send{
      	width: 200px;
		margin: 50px auto;
		background-color: rgb(195, 227, 247);
		padding: 30px;
      }
      .zipcode-input{
      	width: 100%;
		display: block;
      }
      .zipcode-input input{
      	margin: 0px auto;
		width: 80%;
		display: block;
      }
      .zipcode-btn{
      	margin-top: 30px;
		display: block;
      }
      .zipcode-btn input{
      	display: block;
      	margin: 0 auto;
      	background-color: #fd9ee3;
      	width: 50%;
      	border-radius: 3px;
		border: 1px solid #fd9ee3;
      }
      .zipcode-btn input:hover{
      	background-color: #f3fd9e;
      }
      .page-move{
			margin: 100px;
			font-size: 30px;
			font-style: italic;
		}
		.page-move a{
			color: #b958f0;
			text-decoration: none;
		}
		.page-move a:hover{
			color: #f655c3;
		}
		.send-btn:hover{
			background-color: #f655c3;
		}
		h3,h4{
			text-align: center;
			color: rgb(68, 68, 68);
		}
    </style>
  </head>
  <body>
  	<div class="page-move">
		<a href="{!! url('profile/'.$usrName) !!}"><span>Go to Oraisen</span></a>
	</div>
    <input id="pac-input" class="controls" type="text" placeholder="Search Box(zipcode, locations...)">
    <div id="map-canvas"></div>
    <div class="zipcode-send">
    	{!! Form::open(array('url' => 'send/zipcode/'.$usrName, 'method' => 'post', 'class' =>'zipcode-form', 'id' => 'zipcodeForm')) !!}
	   		<h3>Save Zipcode</h3>
	   		<h4>{!! Session::get('success') !!}</h4>
	   		<div class="zipcode-input zipcode">
	   			<input type="text" placeholder="Zipcode" name="zipcode" id="msg-to" class="message-input">
	   		</div>
	   		
	   		<div class="zipcode-btn zipcode"><input type="submit" value="SEND"></div>

	   	{!! Form::close() !!}
    </div>
  </body>

  {!! Html::script( 'js/jquery.js' ) !!}

  {!! Html::script( 'js/jquery.validate.js' ) !!}

  <script type="text/javascript">
        $.validator.setDefaults({
                submitHandler: function(form) {
                    form.submit();
                }
        });
         $("#zipcodeForm").validate({
                rules: {
                    zipcode: {
	                            required: true,
	                            zipcode: true,
                            }
                },
                messages: {
                        zipcode: {
                                	required: "zipcode field is required.",
                                    zipcode: "please invalid zipcode."
                                }
                }
         });
         jQuery.validator.addMethod("zipcode", function(value, element) {
          return this.optional(element) || /^\d{5}(?:-\d{4})?$/.test(value);
        }, "Please provide a valid zipcode.");
    </script>
</html>