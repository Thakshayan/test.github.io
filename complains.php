<!DOCTYPE html>
<?php 
  ob_start();
  include_once 'autoloader.php';
?>
<html lang="en">
<head>
<title>Complain</title>
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
<link rel="stylesheet" type="text/css" href="styles/complain.css">
<link rel="stylesheet" type="text/css" href="styles/complain_responsive.css">
<link rel="stylesheet" type="text/css" href="styles/footer.css">

</head>
<body>
	<div class="super_container">
	<!--------------------------------------------------------------------------- Header ---------------------------------------------->

	<?php
		include "Header.php";
	?>

	<!---------------------------------------------------------------------------- Contact --------------------------------------------->

	<div class="contact">
		<div class="container">
			<div class="row">

				<!--  -->
				<div class="col-lg-6">
					<div class="contact_content">
						<div class="contact_title">
							Head office contact details
						</div>
						<div class="contact_text">
							<p>Head of the Organization<br/>
									Mr. M.J.D Fernando<br/>
									General Manager of Railways
							</p>
						</div>
					
						<div class="contact_list">
							<ul>
								<li>
									<div>Fax Nos:</div>
									<div><b>11 2 446490</b></div>
								</li>
								<li>
									<div>Contacts:</div>
									<div>
										<table >
											<tr >
												<td>Railway Head Office Exchange Number : </td>
												<td> <b>11 4 600 111</b></td>
											</tr>
											<tr >
												<td>Fort Railway Station Inquiries : </td>
												<td> <b>11 2 434215</b></td>
											</tr>
											<tr >
												<td>Deputy Operating Superintendent : </td>
												<td> <b>11 2 687099</b></td>
											</tr>
											<tr >
												<td>Assistant Transportation Superintendent (Operation) :  </td>
												<td> <b>11 2 692286</b></td>
											</tr>
										</table>
									</div>
								</li>
								<li>
									<div>Email:</div>
									<div> <b>gmr@railway.gov.lk</b></div>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Complain Form -->
				<?php
					if (isset($_POST['cmpBtn'])){
						$station = $_POST['station'];
						$title = $_POST['Title'];
						$cmp = $_POST['Message'];

						$errmsg = Passenger::makeComplain($station, $title, $cmp);
						if($errmsg == "success"){ 
						header("location:success.php?msg=complain");
						}
					}
				?>




				<div class="col-lg-6">
					
					<div class="contact_form_container">
						<div><h3>Complain Box</h3><br/></div>
						<div>
							<form action="#" id="Complain_Box" onsubmit="return isEmpty()" name="Complain_Box" class="contact_form" method="POST" >
								<label for="name" style="text-align: left;">Name</label>
								<div style="margin-bottom: 18px"><input type="text" class="contact_input contact_input_name inpt" id="name" placeholder="Your Name(Optional)" ><div class="input_border"></div></div>
								<div class="row">
									<div class="col-lg-6" style="margin-bottom: 18px">
										<label for="station" style="text-align: left;">Station</label>
										<div>
												<select class="contact_drop contact_input inpt" id="station" name="station" oninput="clearCmp()">
												
												<option class="" value="" id="sample_station"> Choose… </option>
												<?php
												  echo Passenger::getAllStationAsOptions();
												?>	
											  </select>
											  <span id="station_id" style="color:red;"></span>
				

										</div>
									</div>

									<div class="col-lg-6" style="margin-bottom: 18px">
										<label for="Title" style="text-align: left;">Title</label>
										<div><input type="text" class="contact_input contact_input_subject inpt" oninput="clearCmp()" id="Title" name="Title" placeholder="Title" ><div class="input_border"></div>		
										</div>
										<span id="title_id" style="color:red;"></span>
									</div>
								</div>
								<label for="Message" style="text-align: left;">Complain Message</label>
								<div><textarea class="contact_textarea contact_input inpt" id="Message" placeholder="Message" oninput="clearCmp()"  name="Message"></textarea><div class="input_border" style="bottom:3px"></div>
								</div>
								<span id="cmperr" style="color:red;"></span>
								<button class="contact_button" id='cmpBtn' type="submit" name="cmpBtn">send</button>
							</form>
						</div>
					</div>
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
              function isEmpty(){
                  var Station = document.forms["Complain_Box"]["station"].value;
                  var title = document.forms["Complain_Box"]["Title"].value;
                  var Complain = document.forms["Complain_Box"]["Message"].value;             
                  
                    if (Station==""){
                      document.getElementById('station_id').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> please select the station </small>";
                      return false;
                    }
                    
                    if (title==""){
                      document.getElementById('title_id').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> please write a title </small>";
                      return false;
                    }

                    if (Complain ==""){
                      document.getElementById('cmperr').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> please write the complain </small>";
                      return false;
                    }
              }

              function clearCmp(){
                document.getElementById('station_id').innerHTML ="";
                document.getElementById('title_id').innerHTML ="";
                document.getElementById('cmperr').innerHTML ="";
              }
 </script>


<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>

<script src="js/common.js"></script>
<script src="js/complain.js"></script>
</body>
</html>