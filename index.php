<html>

<head>
	<!-- include the Tools -->
	<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&sensor=SET_TO_TRUE_OR_FALSE"> </script>

	<!-- standalone page styling (can be removed) -->
	<!-- <link rel="stylesheet" type="text/css" href="http://static.flowplayer.org/tools/css/standalone.css"/>	-->
	<link rel="stylesheet" type="text/css" href="http://static.flowplayer.org/tools/css/overlay-apple.css"/>
	<style>
	
	/* use a semi-transparent image for the overlay */
	#overlay {
		background-image:url(http://static.flowplayer.org/img/overlay/transparent.png);
		color:#efefef;
		height:450px;
	}
	
	/* container for external content. uses vertical scrollbar, if needed */
	div.contentWrap {
		height:441px;
		overflow-y:auto;
	}
	</style>
        <script type="text/javascript">
  function showAddress(address) {
    var latlng = null;
    var geocoder = new GClientGeocoder();
    geocoder.getLatLng(
      address,
      function(point) {
        if (!point) {
          alert(address + " not found");
        } else {
          latlng = point;
          //map.setCenter(point, 13);
          //var marker = new GMarker(point);
          //map.addOverlay(marker);

          // As this is user-generated content, we display it as
          // text rather than HTML to reduce XSS vulnerabilities.
          //marker.openInfoWindow(document.createTextNode(address));
        }
      }
    );
    return latlng;
  }
  function getMap(addressForm) {
    var address = addressForm.address;
    var latlng_obj = showAddress( address);
    if(!latlng_obj){
      return;
    }
    var options = {
      //center: new google.maps.LatLng(-34.397, 150.644),
      center: latlng_obj,
      zoom: 14, // zoom way in for streetview
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = 
      new google.maps.Map(document.getElementById("map_canvas"), options);
  }
</script>
</head>
<body>



    <!-- external page is given in the href attribute (as it should be) -->
    <a href="about.php" rel="#overlay" style="text-decoration:none"> About </a>
    <a href="admin.php" rel="#overlay" style="text-decoration:none"> Admin </a>
    <a href="feedback.php" rel="#overlay" style="text-decoration:none"> Feedback </a>


  <form>
    Enter an address: <input type="text" name="address" /><br />
    <input type="submit" value="Submit" onclick="getMap(this.form)" />
  </form> 
  <div id="map_canvas" style="width:100%; height:100%"></div>

<!-- overlayed element -->
<div class="apple_overlay" id="overlay">

	<!-- the external content is loaded inside this tag -->
	<div class="contentWrap"></div>

</div>

<!-- make all links with the 'rel' attribute open overlays -->
<script>

$(function() {

	// if the function argument is given to overlay,
	// it is assumed to be the onBeforeLoad event listener
	$("a[rel]").overlay({

		mask: 'white',
		effect: 'apple',

		onBeforeLoad: function() {

			// grab wrapper element inside content
			var wrap = this.getOverlay().find(".contentWrap");

			// load the page specified in the trigger
			wrap.load(this.getTrigger().attr("href"));
		}

	});
});
</script>
</html>
