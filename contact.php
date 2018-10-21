<?php include('connector.php');
      include('check_login.php');
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include('head.php'); ?> 
		<style>
			#map {
			height: 560px;
			width: 1150px;
		  }
		</style>
  </head>
<body>
<!-- Header Begin==================================================================== -->

<?php include('header.php'); ?>

<!-- Header End====================================================================== -->
<div id="mainBody">
	<div class="container">
		<hr class="soften">
		<h1>Visit us</h1>
		<hr class="soften"/>	
		<div class="row">
			<div class="span4">
                </br></br></br>
                <img src="themes/images/logo.png" />
            </div>
				
			<div class="span4">
			<h4>Opening Hours</h4>
				<h5> Monday - Friday</h5>
				<p>09:00am - 09:00pm<br/><br/></p>
				<h5>Saturday</h5>
				<p>09:00am - 07:00pm<br/><br/></p>
				<h5>Sunday</h5>
				<p>12:30pm - 06:00pm<br/><br/></p>
			</div>
            
            <div class="span4">
			<h4>Contact Details</h4>
			<p>	
                Via S. Sofia, 64 <br/> 
                95123 Catania 
				<br/><br/>
				alex.magaddino@gmail.com<br/>
				﻿Tel 123-456-6780<br/>
				Fax 123-456-5679<br/>
				web:WebProject.com
			</p>		
			</div>
		</div>
		<div class="row">
			<div id="map" class="span12"> </div>
			<script type="text/javascript" src="../js/jquery/jquery-1.7.2.min.js"></script>
			<script>
			  // This example displays a marker at the center of Australia.
			  // When the user clicks the marker, an info window opens.
			 function initMap() {
				var WebProject = {lat: 37.526848, lng: 15.072965};
				var map = new google.maps.Map(document.getElementById('map'), {
				  zoom: 16,
				  center: WebProject
				});

				var contentString = "WebProject";

				var infowindow = new google.maps.InfoWindow({
				  content: contentString
				});

				var marker = new google.maps.Marker({
				  position: WebProject,
				  map: map,
				  title: 'WebProject'
				});
				marker.addListener('click', function() {
				  infowindow.open(map, marker);
				});
			  }
			</script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAsHAH5gRT_W4HqBaU1N4vieSDY-vYm-0&libraries=places&callback=initMap"
				async defer>
			</script>
		</div>
	</div>
</div>
<!-- MainBody End ============================= -->
<!-- Footer ================================================================== -->
	<?php include('footer.php'); ?>
</body>
</html>