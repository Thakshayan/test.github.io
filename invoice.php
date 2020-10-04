<!DOCTYPE html>
<?php 
    ob_start();
    include_once 'autoloader.php';
    session_start();
    // check already sign 
    $passengerUser = @unserialize($_SESSION['passenger']);
    if (!($passengerUser instanceof Passenger)){
        header("location:404.php");
    }
    if(!($passengerUser->getState() instanceof booking\invoice)){
        header("location:500.php?msg=1128");
    }
    $state = $passengerUser->getState();
?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Invoice Receipt | Srilanka Railway</title>
  <link rel="stylesheet" href="css/styleInvoice.css">
   <script src="js/scriptInvoice.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <style type="text/css" media="print">
   .dontprint
   { display: none; }
   </style>
</head>
<body>

<div class="wrapper" id="invoice">
   <div class="container">
      <p class="thanks"> Thank you for your booking!</p>

      <button class="cta"> Print receipt</button>
      <div class="receipt" >
         <div class="receipt__message">
            <h2 class="receipt__title">Thank you for your booking!</h2>
            <p class="receipt__text">
               Your booking <strong># <?php echo $state->getB_ID();?></strong> has been successfully registered.
               Please check all the data so that everything is correct!
               <span id="reciept">
            </p>
            <a class="btn dontprint" href="profile/">view booking history</a>
         </div>

         <div class="product">
            <figure class="product__image">
               <img src="images/download.jpg" alt="Train Images">
            </figure>
            <div>
               <h3 class="product__name">Train - <?php echo $state->getTrainID();?></h3>
               <p class="product__quantity">From <?php echo $state->getD_station();?> To <?php echo $state->getE_station();?></p>
               <p class="product__quantity">Seat Numbers:-<?php echo $state->getSeats();?></p>
               <p class="product__quantity">
                  Date - <?php echo $state->getB_time();?>
               </p>
            </div>

         </div>

         <div class="price">

            <div class="price__pricing">
               <p class="price__princingTitle">
                  Subtotal
               </p>
               <p class="price__princingNumber">
                  <?php echo $state->getNoOFSeats();?> x <?php echo $state->getPayment()/$state->getNoOFSeats();?>
               </p>

            </div>
         

            <div class="price__total">
               <p class="price__totalTitle">
                  Total
               </p>
               <p class="price__totalNumber">
                  R.s <?php echo $state->getPayment();?>
               </p>
            </div>
         </div>

         <div class="info">
            <h4 class="info__infoTitle">Customer Data</h4>
            <div class="info__addressContent">
               <div class="info__address">
                  <h5 class="info__addressTitle">Customer details</h5>
                  <p class="info__addressText">
                     Account ID : <?php echo $passengerUser->getMail();?><br>
                     Name: <?php echo $state->getPersonName();?><br>
                     Email: <?php echo $state->getB_passengerID();?><br>
                     Contact Number: <?php echo $state->getContactNo();?>
                  </p>
               </div>
            </div>
            <p style="text-align:center">Thank you for booking</p><br>

            
               <div class="receipt__message">
                  <button class="btn dontprint" onclick="window.print()" id="ignorePDF">Print</button>
               </div>
         </div>
      </div>
   </div>
</div>
</body>
</html>
