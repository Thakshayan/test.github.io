<!DOCTYPE html>
<?php 
  ob_start();
  $trainIdBox = $_POST["trainIdBox"];
  $bookDate = $_POST["bookingDate"];
  $DstationBox = $_POST["DstationBox"];
  $EstationBox = $_POST["EstationBox"];
  $amountBox = $_POST["amountBox"];

  if (!$trainIdBox && !$bookDate && !$DstationBox && !$EstationBox && !$amountBox) {
	  header("location:500.php?msg=1127");
  }
  include_once 'autoloader.php';
  session_start();
  // check already sign 
  $passengerUser = @unserialize($_SESSION['passenger']);
   if (!($passengerUser instanceof Passenger)){
 	$passengerUser = new Passenger(NULL, NULL, NULL, NULL, NULL, NULL, new booking\lookupAvailable);
   }
  if(!($passengerUser->getState() instanceof booking\lookupAvailable)){
	$passengerUser->setState(new booking\lookupAvailable);
  }
  $passengerUser->getState()->setStateDatas($DstationBox, $EstationBox, $amountBox, $trainIdBox, $bookDate);
  if ((@unserialize($_SESSION['passenger'])) instanceof Passenger) {
	$_SESSION['passenger'] = serialize($passengerUser);
  }

?>
<html>
<head>
<title>Seat Selection | Srilanka Railway </title>
<link rel="icon" href="images/logo_title.png">
<!-- for-mobile-apps -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Bus Ticket Reservation Widget Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<!-- //for-mobile-apps -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/jquery.seat-charts.css">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/jquery.seat-charts.js"></script>
</head>
<body>

<div class="content">
	<h1>Ticket Reservation for <?php echo $trainIdBox?> </h1>
	<center><p style='color:white'>On <?php echo $bookDate?></p></center>
	<div class="main">
		<h2>Book Your Seat Now?</h2>
		<div class="seatSelect">
			<label for="seat_count"> No of Seats </label>
			<input type="number" min="0" max="60" class="seat_num"  id="seat_num" oninput="validity.valid||(value='');">
			<div id='response'></div>
			<button class="checkout-button continueButton" onclick="disableTest();"> Continue </button>
		</div>
		<hr>

		<div class="div">

		</div>

		<div class="wrapper" id="seatSelectMenu" >
			<div id="seat-map">
				<div class="front-indicator"><h3>Front</h3></div>
			</div>
			<div class="booking-details">
						<div id="legend"></div>
						<h3> Selected Seats (<span id="counter">0</span>):</h3>
						<ul id="selected-seats" class="scrollbar scrollbar1"></ul>
						
						Total: <b>R.s&nbsp;<span id="total">0</span></b>
						
						<button class="checkout-button" onclick = "goPayment()">Pay Now</button>
			</div>
			<div class="clear"></div>
		</div>

		<script>

			window.onload = function () {
				document.getElementById("seat_num").value="0";
				document.getElementById("seatSelectMenu").style.opacity="0.3";
				document.getElementById("seatSelectMenu").style.pointerEvents= "none";
			}

			function disableTest(){
				var seatCount = document.getElementById("seat_num").value; 
				
				if (seatCount==null || seatCount=="0" || seatCount=='') {
					document.getElementById("seatSelectMenu").style.pointerEvents= "none";
					document.getElementById("seatSelectMenu").style.opacity="0.3";
					alert("Enter the number of seats!");
				} else{
					document.getElementById("seatSelectMenu").style.pointerEvents="auto";
					document.getElementById("seatSelectMenu").style.opacity="1";
				}
			}
		</script>

		<script>
				var firstSeatLabel = 1;
				var count =0;
				var scd;
				$(document).ready(function() {
					    var $cart = $('#selected-seats'),
						$counter = $('#counter'),
						$total = $('#total'),
						sc = $('#seat-map').seatCharts({
						map: [
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
							'ee_ee',
						],
						seats: {
							e: {
								price   : <?php echo $passengerUser->getState()->getStateDatas()->getAmount();?>,
								classes : 'economy-class', //your custom CSS class
								category: 'Economy Class'
							}					
						
						},
						naming : {
							top : false,
							getLabel : function (character, row, column) {
								return firstSeatLabel++;
							},
						},
						legend : {
							node : $('#legend'),
							items : [
								[ 'f', 'available',   'Selected' ],
								[ 'e', 'available',   'Available Seat'],
								[ 'f', 'unavailable', 'Already Booked']
							]					
						},
						click: function () {
							var seatCount = document.getElementById("seat_num").value;
							if (this.status() == 'available') {
								
								count++;
								//let's create a new <li> which we'll add to the cart items
								$('<li>'+this.data().category+' : Seat no '+this.settings.label+': <b>R.s '+this.data().price+'</b> <a href="#" class="cancel-cart-item">[cancel]</a></li>')
									.attr('id', 'cart-item-'+this.settings.id)
									.data('seatId', this.settings.id)
									.appendTo($cart);
								
								/*
								 * Lets update the counter and total
								 *
								 * .find function will not find the current seat, because it will change its stauts only after return
								 * 'selected'. This is why we have to add 1 to the length and the current seat price to the total.
								 */
								$counter.text(sc.find('selected').length+1);
								$total.text(recalculateTotal(sc)+this.data().price);

								if (seatCount== count) {
									document.getElementById("seat-map").style.opacity="0.4";
									document.getElementById("seat-map").style.pointerEvents= "none";
								}
								return 'selected';
							} else if (this.status() == 'selected') {
								count--;
								//update the counter
								$counter.text(sc.find('selected').length-1);
								//and total
								$total.text(recalculateTotal(sc)-this.data().price);
							
								//remove the item from our cart
								$('#cart-item-'+this.settings.id).remove();
							
								//seat has been vacated
								return 'available';
							} else if (this.status() == 'unavailable') {
								//seat has been already booked
								return 'unavailable';
							} else {
								return this.style();
							}
							scd = sc;
						}
					});

					//this will handle "[cancel]" link clicks
					$('#selected-seats').on('click', '.cancel-cart-item', function () {
						//let's just trigger Click event on the appropriate seat, so we don't have to repeat the logic here
						sc.get($(this).parents('li:first').data('seatId')).click();
						document.getElementById("seat-map").style.opacity="1";
						document.getElementById("seat-map").style.pointerEvents= "auto";
						
					});

					//let's pretend some seats have already been booked
					sc.get(<?php echo json_encode($passengerUser->getState()->getBookedSeats()->getAllSeatsNameJS()); ?>).status('unavailable');
					scd = sc;
			
			});

			function recalculateTotal(sc) {
				var total = 0;
			
				//basically find every selected seat and sum its price
				sc.find('selected').each(function () {
					total += this.data().price;
				});
				return total;
			}

			function goPayment() {
				if(scd.find('selected').length > 0){
					let bookedSeats = [];
					scd.find('selected').each(function () {
						bookedSeats.push(this.settings.label);
					});
					$.ajax({
						url: "setSelected.php",
						type: "post",
						data: {id:bookedSeats},
						success:function(response){  
							if(response == "  TRUE"){
								location.replace("checkout.php");
							}
							else if(response == " FALSE"){
								alert("You Must login First.");
								location.replace("signup/");
							}
						}
					});
				}
				else{
					alert("Select Seat First");
					return false;
				}
				return false;
			}
		</script>
	</div>
	<p class="copy_rights">&copy; <script>document.write(new Date().getFullYear());</script> Srilanka Railway. All Rights Reserved </p>
</div>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
