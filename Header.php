	<!---------------------------------------------- Header -------------------------------------->
	<?php
	  ob_start();
	  session_start();
	  include_once 'autoloader.php';
	?>
	<header class="header">
		<div style="display:flex">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="header_content d-flex flex-row align-items-center justify-content-start">
							<div class="header_content_inner d-flex flex-row align-items-end justify-content-start">
								<div class="logo"><a href="index.php">Srilanka Railway</a></div>
								<nav class="main_nav">
									<ul class="d-flex flex-row align-items-start justify-content-start">
										<li id="index">		<a href="index.php" >Home</a></li>
										<li id="about" > 	<a href="about.php" >About us</a></li>
										<li id="services">	<a href="services.php" >Location</a></li>
										<li id="news">		<a href="news.php" >News</a></li>
										<li id="complain">	<a href="complains.php">Complains</a></li>
									</ul>
								</nav>
								<div class="header_phone ml-auto">Call us:  11 4 600 111</div>

								<!-- Hamburger -->

								<div class="hamburger ml-auto">
									<i class="fa fa-bars" aria-hidden="true"></i>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
				// check already sign 
				$passengerUser = @unserialize($_SESSION['passenger']);
				if ($passengerUser instanceof Passenger) {
					# code...
					echo "<div style='margin:auto;'>
							<div class='button'><a href='profile/'>Hi! &nbsp;&nbsp;".$passengerUser->getName()."</a></div>
				  		</div>";
				} else {
					echo "<div style='margin:auto;'>
							<div class='button button_2'><a href='signup/'> Sign in</a></div>
						  </div>";
				}
				
			?>		
		
		</div>
	</header>

	<!------------------------------------------------------------------- Menu ----------------------------------------------------------------->

	<div class="menu">
		<div class="menu_header d-flex flex-row align-items-center justify-content-start">
			<div class="menu_logo"><a href="index.php">Srilanka Railway</a></div>
			<div class="menu_close_container ml-auto"><div class="menu_close"><div></div><div></div></div></div>
		</div>
		<div class="menu_content">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="about.php">About us</a></li>
				<li><a href="services.php">Location</a></li>
				<li><a href="news.php">News</a></li>
				<li><a href="complains.php">Complain</a></li>
			</ul>
		</div>
		<div class="menu_social">
			<div class="menu_phone ml-auto">Contact us : 11 4 600 111</div>
			<?php
				// check already sign 
				$passengerUser = @unserialize($_SESSION['passenger']);
				if ($passengerUser instanceof Passenger) {
					# code...
					echo "<div class='button'><a href='profile/'>Hi! &nbsp;&nbsp;".$passengerUser->getName()."</a></div>";
				} else {
					echo "<div class='button button_2'><a href='signup/'> Sign in</a></div>";
				}
				
			?>	
		</div>	
	</div>
	
	<!---------------------------------------------- Home ----------------------------------------------------------------->

	<div class="home" id="header_background">
		
	</div>


	<!-----------------------------------------------search ---------------------------------------------------------------->

	<div class="home_search">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_search_container">
							<div class="home_search_title">Find your Schedule</div>
							<div class="home_search_content">
							<form action="schedule.php" class="home_search_form" id="home_search_form" method="GET">
									
									<div class="d-flex flex-lg-row flex-column align-items-start justify-content-lg-between justify-content-start">
										

										<select class="search_input search_input_1" id="dStation" name="dStation">		
											<option class=" " value="" id="sample_station"> City … </option>
													<?php
													echo Passenger::getAllStationAsOptions();
													?>	
										</select>
										
										<select class="search_input search_input_1" id="dStation" name="eStation">		
											<option class="search_input" value="" id="sample_station"> Destination … </option>
													<?php
													echo Passenger::getAllStationAsOptions();
													?>	
										</select>
										<div class="search_input_4">
											<label for="dTime"> Start Time :</label>
											<input class="search_input" type="time" class="search_input" id="dTime" name="dTime">
										</div>
										<div class="search_input_4"> 
											<label  for="eTime"> End Time :</label>
											<input  class="search_input" type="time" class="search_input" id="eTime" name="eTime">
										</div>
										
										<button class="home_search_button" type="submit">search</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>