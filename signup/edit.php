<!DOCTYPE html>
<?php
  include 'autoloader.php';
  ob_start();
  session_start();
	// check already sign 
  $passengerUser = @unserialize($_SESSION['passenger']);
  if (!($passengerUser instanceof Passenger)) {
    # code...
    header("location:../404.php");
  }
  
?>
<html lang="es" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Edit Profile | Sri Lanka Railway</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="css/error.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css"type="text/css">
    <link rel="stylesheet" href="css/main1.css"type="text/css">
    <link rel="stylesheet" href="css/util.css"type="text/css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <?php

    if (isset($_POST['updateDetails'])){
      $user = $_POST['UName'];
      $teleNo = $_POST['tnum'];
      $address = $_POST['address'];
      $NIC = $_POST['Nnum'];
      $errmsg1 = $passengerUser->updateDeatails($user, $teleNo, $address, $NIC);
      if($errmsg1 == "Sucessfully Updated."){
        $errColor1 = "green";
      }
      else {
        $errColor1 = "red";
      }
    }
  ?>
  </head>
  <body>
    <div class="main">
      <div class="container a-container" id="a-container">
        <form class="form" id="a-form" method="POST" action="#" onsubmit="return valid1()">
          <h2 class="title">Your Details</h2>
          <span class="errorr" id="UNameerr"></span>         
          <input class="form__input input fa" type="text" placeholder="&#xf2bd; UserName" id="UName" name="UName" oninput="clearfun()" value="<?php echo $passengerUser->getName();?>">
          <span class="errorr" id="tnumerr"></span>
          <input class="form__input input fa" type="number" placeholder="&#9742; Telephone Number" id="tnum" name="tnum" oninput="clearfun()" value="<?php echo $passengerUser->getTeleNo();?>">
          <span class="errorr" id="addresserr"></span>
          <input class="form__input input fa" type="text" placeholder="&#xf2bb; Your Address" id="address" name="address" oninput="clearfun()" value="<?php echo $passengerUser->getAddress();?>">
          <span class="errorr" id="Nnumerr"></span>
          <input class="form__input input fa" type="text" placeholder="&#xf2c1; NIC Number" id="Nnum" name="Nnum" oninput="clearfun()" value="<?php echo $passengerUser->getNIC();?>">
            <center>                                           
              <span class="txt1 p-b-17" style="display:block;color:<?php echo @$errColor1;?>;font-weight:bold;line-height:5;"> <?php echo @$errmsg1?></span>
            </center>
          <button type="submit" class="button submit__button" name="updateDetails">Save</button>
        </form>
      </div>
      <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
          <h2 class="switch__title title">Update profile!</h2>
          <p class="switch__description description">Here you can update your details.</p>
          <a href="../profile"><button class="switch__button button switch-btn" ><-- Go Back </button></a>
        </div>
      </div>
    </div>
  <script  src="js/script.js"></script>

  <script>
    function clearfun(){
            document.getElementById('UNameerr').style = "visibility:hidden";
            document.getElementById('UNameerr').innerText = "";
            document.getElementById('tnumerr').style = "visibility:hidden";
            document.getElementById('tnumerr').innerText = "";
            document.getElementById('addresserr').style = "visibility:hidden";
            document.getElementById('addresserr').innerText = "";
            document.getElementById('Nnumerr').style = "visibility:hidden";
            document.getElementById('Nnumerr').innerText = "";
        }

        function valid1(){
            var user1 = document.getElementById('UName').value;
            var tele = document.getElementById('tnum').value;
            var address = document.getElementById('address').value;
            var NIC = document.getElementById('Nnum').value;

            if(user1 == ""){
                document.getElementById('UNameerr').style = "visibility:visible;";
                document.getElementById('UNameerr').innerText = "Please Type User Name";
                return false;
            }
            if(tele == ""){
                document.getElementById('tnumerr').style = "visibility:visible;";
                document.getElementById('tnumerr').innerText = "Please Enter the Phone number";
                return false;
            }

            if(!validatetele(tele)){
                document.getElementById('tnumerr').style = "visibility:visible;";
                document.getElementById('tnumerr').innerText = "Please Enter valid Phone number";
                return false;
            }

            if(address == ""){
                document.getElementById('addresserr').style = "visibility:visible;";
                document.getElementById('addresserr').innerText = "Please Enter the address";
                return false;
            }
            if(NIC == ""){
                document.getElementById('Nnumerr').style = "visibility:visible;";
                document.getElementById('Nnumerr').innerText = "Please Enter the NIC number";
                return false;
            }
        }
        function validateEmail(email) {
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }

        function validatetele(tele){
          var isnum = /^\d+$/.test(tele);
          if(tele.length == 10 &&  isnum){
            return true;
          }
        }
  </script>
  
  </body>
</html>