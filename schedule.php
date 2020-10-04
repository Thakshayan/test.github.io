<!DOCTYPE html>
<?php 
  ob_start();
  include_once 'autoloader.php';
?>
<html lang="en">
<head>
<title>Schedule| Srilanka Railway </title>
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
<link rel="stylesheet" type="text/css" href="styles/schedule.css">
<link rel="stylesheet" type="text/css" href="styles/footer.css">


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<?php
  	if(!$_GET["dStation"] || !$_GET["eStation"]){
		header("location:500.php?msg=1123");
	}
	elseif ($_GET["dStation"] == $_GET["eStation"]) {
		header("location:500.php?msg=1124");
	}
	else {
		$getDStation = $_GET["dStation"];
		$getEStation = $_GET["eStation"];
		$getDTime = $_GET["dTime"];
		$getETime = $_GET["eTime"];
		
		if($getDTime && $getETime){
			include_once 'includes/schedule/CocncreteTmeSchBuilderWithRestricTime.inc.php';
			Passenger::setBuilder(new CocncreteTmeSchBuilderWithRestricTime());
			$timeSchdule = Passenger::getTrainSchdule($getDStation, $getEStation, $getDTime, $getETime);
		}
		else{
			include_once 'includes/schedule/CocncreteTmeSchBuilder.inc.php';
			Passenger::setBuilder(new CocncreteTmeSchBuilder());
			$timeSchdule = Passenger::getTrainSchdule($getDStation, $getEStation, NULL, NULL);		
		}
	}
?>
<body>
<div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
	<div class="modal-header">
	<h4>Pick Date </h4>
	<span class="close">&times;</span>
	</div>
	<div class="modal-body">
	<center>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<form onsubmit='return checkDate()' method='POST' action='seatSelection.php'>
						<div class="input-group">
							<input type='text' name="trainIdBox" id="trainIdBox" class="form-control" readonly style='color:black'>
							<input type='text' name="DstationBox" id="DstationBox" class="form-control" readonly style='color:black' value=<?php echo $getDStation?>>
							<input type='text' name="EstationBox" id="EstationBox" class="form-control" readonly style='color:black' value=<?php echo $getEStation?>>
							<input type='text' name="amountBox" id="amountBox" class="form-control" readonly style='color:black'>
						</div>
						<br>
						<div class="input-group">
							<div class="input-group-addon" id="calendar1">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" name="bookingDate" id="bookingDate" class="col-11 start_date datepicker" data-inputmask="'alias':'dd/mm/yyyy'" placeholder='Pick date for booking'>						
							<p id='dateEmsg'></p>
						</div><br>
						<button type="submit" class="btn btn-primary" style="float:right" name="goToBook"> Next -> </button>
					</form>
				</div>
			</div>
		</div>
	</center>
	</div>
	<div class="modal-footer">
	</div>
</div>

</div>
	<div class="super_container">
		
	<!----------------------------------------------------------------------------- Header ---------------------------------------------->

	<?php
		include "Header.php";
	?>

	<!------------------------------------------------------------------------------- Table ---------------------------------------------->
	<div class= "schedule">
		<div class="container-lg">
		<div class="schedule_title"> <h3><i>	Schedule Table </i></h3></div>
		<div class="" style="background:black;">
			<div class="table_display_content container" >
				<?php echo $timeSchdule->getNumberOfTrains()." Trains available from ".$timeSchdule->getStartStation()." to ".$timeSchdule->getEndStation(); ;?>
			</div>
		</div>
		<div class="schedule_search d-flex justify-content-end">

			<input type="text" title="search" name="" id="myInput" onmouseover="hoverOver(this)" onmouseout="hoverLeave(this)" class="search_panel" placeholder="Type Train Name To Search Here ..." autocomplete="off" onkeyup="searchFun()">
	
			<button class="search_button" type="submit" onclick="activeSearch()"> 
				<i class="fa fa-search" style="font-size:25px;" aria-hidden="true"></i>
			</button>

		</div>
		<div>		
		<table class="table table-striped  table_text schedule_table" cellspacing="0" width="100%" id='myTable'>
			<thead class="table_head">
				<tr>
				<th>No</th>
				<th>Train ID</th>
				<th>Train Name</th>
				<th>Departure Time</th>
				<th>Arrival Time </th>
				<th>Ticket </th>
                <th>Booking</td>
				</tr>
			</thead>
			<tbody>
				<?php
					echo $timeSchdule->showTrains();
				?>
			</tbody>
			<tfoot class="table_head">
				<tr>
				<th>No</th>
				<th>Train ID</th>
				<th>Train Name</th>
				<th>Departure Time</th>
				<th>Arrival Time </th>
				<th>Ticket </th>
				<th>Booking </th>		
				</tr>
			</tfoot>
			</table>

			<div class="table_footer d-flex justify-content-between" >
				<span class="table_info"> 
					<span class="result_footer" id="result_footer"></span> matches
				</span>
			</div>

			
			
			</div>
		</div>

		</div>
		</div>


		<!------------------------------------------------------------------------------- footer ---------------------------------------------->
	<?php
		include 'footer.php';
	?>

</div>
<script>
	$(document).ready(function () {
		var tomorrow = new Date();
		tomorrow.setDate(tomorrow.getDate() + 1);
		$('.datepicker').datepicker({
			format: 'dd-mm-yyyy',
			autoclose:true,
			startDate: "tomorrow",
			minDate: tomorrow
		}).on('changeDate', function (ev) {
				$(this).datepicker('hide');
			});


		$('.datepicker').keyup(function () {
			if (this.value.match(/[^0-9]/g)) {
				this.value = this.value.replace(/[^0-9^-]/g, '');
			}
		});
	});

	function checkDate() {
		let ele = document.getElementById('bookingDate').value;
		let isValidDate = Date.parse(ele);

		if (isNaN(isValidDate)) {
			document.getElementById('dateEmsg').innerHTML = "  Oops... Not a valid Date.";
		// when is not valid date logic
			return false;
		}
		else{
			return true;
		}
		return false;
	}
	var active = false;
	const searchFun =() =>{
		let filter = document.getElementById('myInput').value.toUpperCase();
		let myTable = document.getElementById('myTable');
		let tr = myTable.getElementsByTagName('tr');
		let count = 0;

		for (var i = 0; i < tr.length; i++) {
  	
		td = tr[i].getElementsByTagName("td");
			for (var j = 1; j < td.length-1; j++) {
			if (td[j]) {
			txtValue = td[j].textContent || td.innerText;
			if (txtValue.toUpperCase().indexOf(filter) > -1) {
				tr[i].style.display = "";
				count++;
				break;
			} else {
				tr[i].style.display = "none";
			}
		  }
		 }
		}
		document.getElementById('result_footer').innerHTML = count;
	}

	function activeSearch(){
		
		let styler = document.getElementById('myInput');
		if (!(active)){
			styler.style["border-bottom"] = "2px solid blue";
			document.getElementById('myInput').focus();
			active=true;
		}else{
			styler.style["border-bottom"] = "2px solid white";
			active=false;
		}
	}

	function hoverOver(x){
		x.style["border-bottom"] = "2px solid blue";
	}

	function hoverLeave(x) {
		x.style["border-bottom"] = "2px solid white";
	}

		// Get the modal
	var modal = document.getElementById("myModal");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks the button, open the modal 
	function getDateModel(train,amount) {
		modal.style.display = "block";
		document.getElementById("trainIdBox").value = train;
		document.getElementById("amountBox").value = amount;
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
	}

</script>
<script type="text/javscript" src="script.js"></script>

<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="plugins/easing/easing.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>



<script src="js/common.js"></script>
<script src="js/schedule.js"></script>
</body>
</html>