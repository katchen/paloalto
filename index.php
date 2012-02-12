<?php
    include('sqlitedb.php');
?>

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
          display:none;
          background-image:url(http://static.flowplayer.org/img/overlay/transparent.png);
          color:#efefef;
          height:300px;
          width:500px;
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
        var num = JSON.stringify(results[0].address_components[0].short_name);
        var street = JSON.stringify(results[0].address_components[1].short_name);
        var long = JSON.stringify(results[0].geometry.location.Pa);
        var lat = JSON.stringify(results[0].geometry.location.Qa);
        url = "http://maps.googleapis.com/maps/api/streetview?size=650x320&location=" + long +","+ lat
        + "&sensor=false&pitch=-45&fov=120";
        $("#map").replaceWith('<img class="columns" id="map" src=' + url + " />");
        var address = JSON.stringify(results[0].formatted_address);
        var secondpartofaddress = JSON.stringify(results[0].address_components[3].short_name)+', '+JSON.stringify(results[0].address_components[5].short_name);
        var i = 0;
        for (;i<4;i++){
          secondpartofaddress = secondpartofaddress.replace('"','');
        }
        $("#streetaddr").replaceWith('<div id="streetaddr"><strong>'+ address.substring(1,address.indexOf(','))+'</strong></br>'+ secondpartofaddress+'</div>');
        window.location.href = "index.php?num=" + num + "&street=" + street;
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
	<div id="topcenter">
		
    <div class="columns" id="report">
      <div id="report_header">
          <div id="details">ROAD REPORT FOR: <br/></div>
          <div id="scorebox">
            <div id="score">
            <?php
                if ($_GET['num'] == null){
                    echo "71";
                }
                else{
                  $street = $_GET['street'];
                  $pos = strpos($street," ");
                  $length = strlen($street);
                  $final_street = substr($street,0,$length-$pos+2);
                  $query ="select Score from PCI where LOCATION like '".str_replace('"',"",$_GET['num'])." ".str_replace('"',"",$final_street)."%';";
                  $result = $db->query($query);
                  $score = $result->fetch();
                  echo $score[0];
                }
            ?>
            </div>
            ROAD SCORE
          </div>
          <div id="streetaddr"><strong>250 Hamilton Avenue</strong></br>
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
  <div id="bottomcenter">
    <div class="columns" id="gradingscale">
	  <table>
		<tr>
			<th>GRADING SCALE
			</th>
			<th>
			</th>
		</tr>
		<tr>
			<td>
				<span>0 - 30</span>
				<p>High priority to fix in the next two years.</p>
			</td>
			<td>
				<img src="images/quality_bad.png">
			</td>
		</tr>
		<tr>
			<td>
				<span>31 - 60</span>
				<p>Medium priority, will be fixed within 3-5 years.</p>
			</td>
			<td>
				<img src="images/quality_medium.png">
			</td>
		</tr>
		<tr>
			<td>
				<span>61 - 100</span>
				<p>Satisfactory to good condition</p>
			</td>
			<td>
				<img src="images/quality_good.png">
			</td>
		</tr>
	  </table>
    </div>

    <div id="album">
	  <div id="gallery">
		<img src="images/gallery_leftarrow.png" id="leftarrow">
		<img src="images/gallery_rightarrow.png" id="rightarrow">
		
	  </div>
	  <div id="upload">
	    <form action="upload.php"id="photo_upload" method="post" enctype="multipart/form-data" >
	    <p>Submit a photo for this location</p>
	    <input id="uploader" type="file" name="file"/><br />
	    <textarea id="comment" placeholder="Caption(optional)" rows="2">
		</textarea>
	    <input type="submit"/>
	    </form>
	  </div>
	  </div>
	</div>
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

$("#address").keydown(function(event){
    if(event.which == 13){
        codeAddress();
    }
  });
</script>
<div class="apple_overlay" id="overlay">

	<!-- the external content is loaded inside this tag -->
	<div class="contentWrap"></div>

</div>
</body>

</html>
