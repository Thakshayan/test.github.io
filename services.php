<!DOCTYPE html>
<?php 
  ob_start();
  include_once 'autoloader.php';
?>
<html lang="en">
<head>
<title>Location | Srilanka Railway </title>
<link link="icon" href="images/logo_title.png" type="image/png">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Travello template project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="images/logo_title.png">

<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">

<link rel="stylesheet" type="text/css" href="styles/Header.css">
<link rel="stylesheet" type="text/css" href="styles/Header_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/services.css">
<link rel="stylesheet" type="text/css" href="styles/services_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/footer.css">


</head>
<body>
	<div class="super_container">
	<!--------------------------------------------------------- Header ---------------------------------------------------------------->

	<?php
		include "Header.php"
	?>

	<!---------------------------------------------------------- Map ------------------------------------------------------------------->
	<div class="Map_session" >
		<div class="container-xl">
			<div class="search_input Map_title"> <h3> <i> Track Your Train Now... </i> <h3> </div>
			
			<div class="row">
				<div class="column Map_text">

					<div class="Map_text_title "> Select the train</div>
					<form action="#" class="map_form" id="home_search_form" method="get" onsubmit="return validTrainSelection()">
							
							<div >
								<select class="search_input map_select_train" id="sample_train" name="trainName" >		
									<option class=" " value=""> Select train … </option>
										<?php
											echo Passenger::getAllTrainAsOptions();
										?>	
								</select>
							</div>

							<div>
								<button class="home_search_button map_search_button" type="submit" name="searchTrain" > search</button>
							</div>

						</form>
					<div style="background-color:white; padding-left:10px;">
						<span id="trainLocationMSG" class="map_message"></span>
					</div>
				</div>
				<div class="column Map_image">
					<div id="map" style="height:600px;" class="centerMarker"></div>
				</div>
			</div>
		</div>
	</div>


	<!----------------------------------------------------footer ------------------------------------------------------------>
	<?php
		include 'footer.php';
	?>

</div>

<script>
    var markers = [];
    var map;

	function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: {lat:8.3027011,lng:80.6361}
        });
      }

      function drop(locations) {
		locations.unshift("");
        clearMarkers();
        var msgList = document.getElementById("trainLocationMSG");
        msgList.innerHTML = "<button class='button home_search_button map_refresh_button' onclick='location.reload()'> <i class='fa fa-refresh' aria-hidden='true'></i>&nbsp Refresh</button><br>";
        for (var i = 0; i < locations.length; i++) {
          addMarkerWithTimeout(parseFloat(locations[i]["lat"]), parseFloat(locations[i]["lng"]), i * 200, locations[i]["ID"] + " in " +locations[i]["currPos"]);
          if(i>0){
              if(locations[i]["travel"] == 0){
                  msgList.innerHTML = msgList.innerHTML + "Now " + locations[i]["ID"] + " has not started journey yet. It is in "+ locations[i]["currPos"] +
				   ".&nbsp <button class='location_button' onclick='setMapZoom("+locations[i]["lat"]+","+locations[i]["lng"]+")'><img class='location_img' src='images/map_marker_2.png'></i></button><br>";
              }
              else{
                  msgList.innerHTML = msgList.innerHTML + "Now " +locations[i]["ID"] + " was in " + locations[i]["currPos"] + " arrival at " + locations[i]["arrivalTime"] + 
				  ".&nbsp <button class='location_button' onclick='setMapZoom("+locations[i]["lat"]+","+locations[i]["lng"]+")'> <img class='location_img' src='images/map_marker_2.png'></i></button><br>";

              }
          }
        }
		
      }

      function addMarkerWithTimeout(latP, lngP, timeout, idxTitle) {
        window.setTimeout(function() {
          markers.push(new google.maps.Marker({
            position: {lat:latP, lng:lngP},
            map: map,
            title:idxTitle,
           animation: google.maps.Animation.BOUNCE,
           icon : "images/TraIcn.png"
          }));
        }, timeout);
      }

      function clearMarkers() {
        document.getElementById("trainLocationMSG").innerHTML ="";
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(null);
        }
        markers = [];
      }

	  function setMapZoom(latN, lngN) {
		  map.setZoom(12);
		  map.setCenter({lat: latN, lng: lngN});
	  }
    
</script>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCR5PFyvraK8Cqbu-vQu7UAR-NkcABHNuw&callback=initMap">
        </script>
<script src="js/services.js"></script>
<script src="js/common.js"></script>

<script>    
    function validTrainSelection(){
        let trainSelect = document.getElementById("sample_train").value;
		if(trainSelect == ""){
			return false;
		}
    }
</script>

<?php
if (isset($_GET["searchTrain"])) {
	# code...
	$trainName = $_GET["trainName"];
	$locationDetails = Passenger::getTrainLocation($trainName);
	if ($locationDetails) {
		# code...
	?>
		<script>drop(<?php echo json_encode($locationDetails)?>)</script>
<?php
	}
}
?>
</body>
</html>