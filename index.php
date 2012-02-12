<!DOCTYPE html>
<html>
<head>
<script type="text/javascript"
  src="http://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&sensor=SET_TO_TRUE_OR_FALSE">
</script>
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
  <form>
    Enter an address: <input type="text" name="address" /><br />
    <input type="submit" value="Submit" onclick="getMap(this.form)" />
  </form> 
  <div id="map_canvas" style="width:100%; height:100%"></div>
  <?php
  ?>
</body>
</html>
