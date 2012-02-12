<html>

<head>
  <!-- include the Tools -->
  <script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
  <?php
  $key = 'AIzaSyA9ja49OotC-4jZzkDuBGVj-OQ5AtFGYbw';
  $sensor = "false";
  echo '<script type="text/javascript" '.
    'src="http://maps.googleapis.com/maps/api/js?key='.$key.'&sensor='.
    $sensor.'"> </script>';
  ?>
  <link rel="stylesheet" type="text/css" href="http://static.flowplayer.org/tools/css/overlay-apple.css"/>
  <link rel="stylesheet" type="text/css" href="style.css"/>
  
  <script>
  var geocoder;
  var map;
  var url;
  var location;
  function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(37.44345,-122.164106);
    var myOptions = {
      zoom: 8,
      center: latlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
  }

  function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        url = "http://maps.googleapis.com/maps/api/streetview?size=600x300&location=" + JSON.stringify(results[0].geometry.location.Pa)+","+
        JSON.stringify(results[0].geometry.location.Qa)+ "&sensor=false&pitch=-45&fov=120";
        $("#map").replaceWith('<img src=' + url + " />");
      } else {
        alert("Geocode was not successful for the following reason: " + status);
      }
    });
  }
  </script>
</head>

<body onload="initialize()">


  <!-- external page is given in the href attribute (as it should be) -->
  <div id="navbar">
  <img src="images/header.gif" id="logo"/>
  <ul id="navbarlinks">
  <li> <a href="about.php" rel="#overlay"> About </a> </li>
  <li> <a href="feedback.php" rel="#overlay"> Feedback </a> </li>
  <li> <a href="admin.php"> Admin </a> </li>
  </ul>
  </div>
  
  <div id="form">
    <input placeholder="Enter your address here" id="address" type="text" name="address"/>
    <input id="submit" type="image" onclick="codeAddress()" src="images/button_locate.png"/>
  </div>

  <div class="columns" id="report">
  </div>
  
  <div class="columns" id="map">
  </div>
  
  <div class="columns" id="scale">
  </div>
  
  <div class="simple_overlay" id="overlay">

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

</body>

</html>
