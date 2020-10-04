	<!--------------------------------------------------------------------search ---------------------------------------------------------------->

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