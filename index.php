<html>

<head>
	<!-- include the Tools -->
	<script src="http://cdn.jquerytools.org/1.2.6/full/jquery.tools.min.js"></script>
	 

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
</head>
<body>



<!-- external page is given in the href attribute (as it should be) -->
<a href="about.php" rel="#overlay" style="text-decoration:none"> About </a>
<a href="admin.php" rel="#overlay" style="text-decoration:none"> Admin </a>
<a href="feedback.php" rel="#overlay" style="text-decoration:none"> Feedback </a>

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
</body>
</html>
