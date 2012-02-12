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
  <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
  <style>
  
  /* use a semi-transparent image for the overlay */
  #overlay {
          background-image:url(http://static.flowplayer.org/img/overlay/transparent.png);
          color:#efefef;
          height:600px;
          width:600px;
          padding:50px;
  }
  
  /* container for external content. uses vertical scrollbar, if needed */
  div.contentWrap {
          height:441px;
            
          overflow-y:auto;
  }
  </style>
  <script>
  var geocoder;
  var url;

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
        url = "http://maps.googleapis.com/maps/api/streetview?size=650x320&location=" + JSON.stringify(results[0].geometry.location.Pa)+","+
        JSON.stringify(results[0].geometry.location.Qa)+ "&sensor=false&pitch=-45&fov=120";
        $("#map").replaceWith('<img class="columns" id="map" src=' + url + " />");
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
  <div id="logodiv">  
    <img src="images/header.png" id="logo" />
  </div>
  <div id="navbarlinks">
  <ul>
  <li> <a href="about.php" rel="#overlay"> About </a> </li>
  <li> <a href="feedback.php" rel="#overlay"> Feedback </a> </li>
  <li> <a href="admin.php"> Admin </a> </li>
  </ul>
  </div>
  </div>
  
  <div id="form">
    <input placeholder="Enter your address here (e.g. 545 Forest Ave, Palo Alto, CA)" id="address" type="text" name="address"/>
    <input id="submit" type="image" onclick="codeAddress()" src="images/button_locate.png"/>
  </div>

  <div id="centerpiece">
  <div class="columns" id="report">
    <div id="report_header">
      <div id="details">ROAD REPORT FOR: <br/></div>
      <div id="scorebox">
      <div id="score">71 </div>
        ROAD SCORE
      </div>
      <div id="streetaddr"><strong>545 Forest Avenue</strong></br>
      Palo Alto, CA 94305
      </div>
    </div> 
    <div id="content"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
    Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </div>
  </div>
  
  <div class="columns" id="map">
    <img src="http://maps.googleapis.com/maps/api/streetview?size=650x320&location=37.444572,-122.16030599999999&sensor=false&pitch=-45&fov=120"/>
  </div>
  </div>
  
  <div class="columns" id="scale">
  </div>
  
  <div class="simple_overlay" id="overlay">

  <!-- the external content is loaded inside this tag -->
  <div class="contentWrap"></div>

  </div>

  <div id="footer">
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
<div class="apple_overlay" id="overlay">

	<!-- the external content is loaded inside this tag -->
	<div class="contentWrap"></div>

</div>
</body>

</html>
