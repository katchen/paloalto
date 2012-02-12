<html>

<head>
  <!-- include the Tools -->
  <script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <?php
  $key = 'AIzaSyA9ja49OotC-4jZzkDuBGVj-OQ5AtFGYbw';
  $sensor = "false";
  echo '<script type="text/javascript" '.
    'src="http://maps.googleapis.com/maps/api/js?key='.$key.'&sensor='.
    $sensor.'"> </script>';
  ?>
  <!-- standalone page styling (can be removed) -->
  <!-- <link rel="stylesheet" type="text/css" href="http://static.flowplayer.org/tools/css/standalone.css"/>  -->
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

</head>
<body>



    <!-- external page is given in the href attribute (as it should be) -->
    <a href="about.php" rel="#overlay" style="text-decoration:none"> About </a>
    <a href="admin.php" rel="#overlay" style="text-decoration:none"> Admin </a>
    <a href="feedback.php" rel="#overlay" style="text-decoration:none"> Feedback </a>

  <div id="infobox">
    Text here  
  </div>
  <form id="form" action = "">
    Enter an address: <input id="address" type="text" name="address" /><br />
    <input id="submit" type="button" value="Submit" />
  </form> 
  <div id="map_canvas" style="width:100%; height:100%"></div>

<!-- overlayed element -->
<div class="simple_overlay" id="overlay">

  <!-- the external content is loaded inside this tag -->
  <div class="contentWrap"></div>

</div>

<!-- make all links with the 'rel' attribute open overlays -->
<script>



  // if the function argument is given to overlay,
  // it is assumed to be the onBeforeLoad event listener
  $(document).ready(function(){
  //$("a[rel]").overlay();
  });
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
  $('#form').submit(function() {
    var address = $("#address").val();
    $("#infobox").html(address);
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
  });

</script>
</html>
