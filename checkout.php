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
    if(!($passengerUser->getState() instanceof booking\payment)){
        header("location:500.php?msg=1128");
    }
?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Checkout | Srilanka Railway</title>
  <link rel="stylesheet" href="css/stylesCheckOut.css">
  <script src="js/scriptCheckOut.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<Form action="#" method="post" onsubmit="return validate()" name="checkout">
<!-- partial:index.partial.html -->
  <div class="checkout-panel">
    <div class="panel-body">
      <h2 class="title">Checkout</h2>

      <div class="progress-bar">
        <div class="step active"></div>
        <div class="step active"></div>
        <div class="step"></div>
        <div class="step"></div>
      </div>

      <div class="payment-method">
        <label for="card" class="method card">
          <div class="card-logos">
            <img src="https://designmodo.com/demo/checkout-panel/img/visa_logo.png"/>
            <img src="https://designmodo.com/demo/checkout-panel/img/mastercard_logo.png"/>
          </div>

          <div class="radio-input">
            <input id="card" type="radio" name="payment" checked value=1>
            Pay with credit card
          </div>
        </label>

        <label for="paypal" class="method paypal">
          <img src="https://designmodo.com/demo/checkout-panel/img/paypal_logo.png"/>
          <div class="radio-input">
            <input id="paypal" type="radio" name="payment" disabled value=0>
            Pay with PayPal
          </div>
        </label>
      </div>

      <div class="input-fields">
        
        <div class="column-1">
        <p class="carddetails">Card Details</p>
          <label for="cardholder">Cardholder's Name</label>
          <input type="text" id="cardholder" name="cname" oninput="clearInput()" placeholder="Eg:- John">
          <span id="errcname" style="color:red;"></span>

          <div class="small-inputs">
            <div class="date">
              <label for="date">Month</label>
              <input type="text" id="date" name="day" oninput="clearInput()" placeholder="mm" min=1 max=12>
              <span id="errdate" style="color:red;"></span>
            </div>
            <div class="month">
              <label for="month">Year</label>
              <input type="text" id="month" name="month" placeholder="yy" oninput="clearInput()">
              <span id="errmonth" style="color:red;" ></span>
            </div>

            <div class="cvc">
              <label for="verification">CVV / CVC *</label>
              <input type="number" name="cvc" min=0 oninput="clearInput()" placeholder="000">
              <span id="errcvc" style="color:red;"></span>
            </div>
          </div>
          <label for="cardnumber">Card Number</label>
          <input type="text" name="cardnumber" id="creditCardText" oninput="clearInput()" placeholder="xxxx xxxx xxxx xxxx">
          <span id="errcnum" style="color:red;"></span>
        </div>
        <div class="column-2">
        <p class="carddetails">Customer Details</p>
            <label for="cusname">Customer Name</label>
            <input type="text" name="cusname" placeholder="You can change." value="<?php echo $passengerUser->getName();?>">
            <span id="errcusname" style="color:red;"></span>
          <div class="cusinfo">
            <div>
              <label for="contnumber">Contact Number</label>
              <input type="number" name="contnumber" oninput="clearInput()" placeholder="xxxxxxxxxx">
              <span id="errcontnum" style="color:red;"></span>
            </div>
          </div>
            <label for="email">Customer Email</label>
            <input type="text" name="email" placeholder="You can change if you wish"  value="<?php echo $passengerUser->getMail();?>"> 
            <span id="erremail" style="color:red;"></span>
        </div>
      </div>
    </div>

    <div class="panel-footer">
      <button type="reset" class="btn back-btn">Clear</a>
      <button type="submit" class="btn next-btn" name="ok">Next Step</button>
    </div>
  </div>
</form>
 <script>
  $('#creditCardText').keyup(function() {
  var foo = $(this).val().split(" ").join(""); // remove hyphens
  if (foo.length > 0) {
    foo = foo.match(new RegExp('.{1,4}', 'g')).join(" ");
  }
  $(this).val(foo);
});
 </script>
 <?php
    if(isset($_POST["ok"])){
      $Passenger_email = $_POST["email"];
      $Passenger_name = $_POST["cusname"];
      $Contact_number = $_POST["contnumber"];
      $visa_paypal = $_POST["payment"];
      if($passengerUser->getState()->pay($Passenger_email, $Passenger_name, $Contact_number, $visa_paypal, $passengerUser)){
        header("location:invoice.php");
      }else {
        echo "Failed to transfer Cash";
      }
  
    }
 ?>
</body>
</html>
