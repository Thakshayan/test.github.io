<!DOCTYPE html>
<?php
  include 'autoloader.php';
  ob_start();
  session_start();
	// check already sign 
  $passengerUser = @unserialize($_SESSION['passenger']);
  if ($passengerUser instanceof Passenger) {
    # code...
    header("location:../profile");
  }
  
?>
<html lang="es" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Profile | Sri Lanka Railway</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="css/error.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css"type="text/css">
    <link rel="stylesheet" href="css/main1.css"type="text/css">
    <link rel="stylesheet" href="css/util.css"type="text/css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <?php

    if (isset($_POST['oklogin1'])){
      $user = $_POST['UName'];
      $Email = $_POST['mail1'];
      $teleNo = $_POST['tnum'];
      $address = $_POST['address'];
      $NIC = $_POST['Nnum'];
      $password = $_POST['pass1'];
      
      $enpass1 = md5($password);

      $errmsg1 = Passenger::signup($user, $Email, $teleNo, $address, $NIC, $enpass1);
      if($errmsg1 == "Sucessfully Registered.")
      { 
        $errColor1 = "green";
      }
      else 
      {
        $errColor1 = "red";
      }
    }

    if (isset($_POST['oklogin2'])){
      $email = $_POST['mail2'];
      $pass = $_POST['pass2'];
      
      $enpass2 = md5($pass);

      $errmsg2 = Passenger::Sigin($email, $enpass2);
    }
  ?>
  </head>
  <body>
    <div class="main">
      <div class="container b-container" id="b-container">
        <form class="form" id="b-form" method="POST" action="" onsubmit="return valid1()">
          <h2 class="title">Create Account</h2>
          <span class="errorr" id="UNameerr"></span>         
          <input class="form__input input fa" type="text" placeholder="&#xf2bd; UserName" id="UName" name="UName" oninput="clearfun()">
          <span class="errorr" id="mail1err"></span>
          <input class="form__input input fa" type="email" placeholder="&#xf0e0; Email" id="mail1" name="mail1" oninput="clearfun()">
          <span class="errorr" id="tnumerr"></span>
          <input class="form__input input fa" type="number" placeholder="&#9742; Telephone Number" id="tnum" name="tnum" oninput="clearfun()">
          <span class="errorr" id="addresserr"></span>
          <input class="form__input input fa" type="text" placeholder="&#xf2bb; Your Address" id="address" name="address" oninput="clearfun()">
          <span class="errorr" id="Nnumerr"></span>
          <input class="form__input input fa" type="text" placeholder="&#xf2c1; NIC Number" id="Nnum" name="Nnum" oninput="clearfun()">
          <span class="errorr" id="pass1err"></span>
          <input class="form__input input fa" type="password" placeholder="&#xf084; Password" id="pass1" name="pass1" oninput="clearfun()">
          <span class="errorr" id="conpasserr"></span>
          <input class="form__input input fa" type="password" placeholder="&#xf084; Confirm Password" id="conpass" name="conpass" oninput="clearfun()">
            <center>                                           
              <span class="txt1 p-b-17" style="display:block;color:<?php echo @$errColor1;?>;font-weight:bold;line-height:5;"> <?php echo @$errmsg1?></span>
            </center>
          <button type="submit" class="button submit__button" name="oklogin1">SIGN UP</button>
        </form>
      </div>
      <div class="container a-container" id="a-container">
        <form class="form" id="a-form" method="POST" action="" onsubmit="return valid2()">
          <h2 class="title">Sign in to Website</h2>
          <span class="errorr" id="mail2err"></span>
          <input class="form__input input fa" type="email" placeholder="&#xf0e0; Email" id="mail2" name="mail2" oninput="clearfun()">
          <span class="errorr" id="pass2err"></span>
          <input class="form__input input fa" type="password" placeholder="&#xf084; Password" id="pass2" name="pass2" oninput="clearfun()">
          <a class="form__link" href="forgotPassword.php">Forgot your password?</a>
            <center>
              <span class="txt1 p-b-17" style="color:red;font-weight: bold;line-height: 5;"><?php echo @$errmsg2?></span>
            </center>
          <button type="submit" class="button submit__button" style="line-height:-5;" name="oklogin2">SIGN IN</button>
        </form>
      </div>
      <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
          <h2 class="switch__title title">Hello Travellers !</h2>
          <p class="switch__description description">Enter your personal details and start journey with us</p>
          <button class="switch__button button switch-btn" >SIGN UP</button>
        </div>
        <div class="switch__container is-hidden" id="switch-c2">
          <h2 class="switch__title title">Welcome Back !</h2>
          <p class="switch__description description">To keep connected with us please login with your personal info</p>
          <button class="switch__button button switch-btn" >SIGN IN</button>
        </div>
      </div>
    </div>
  <script  src="js/script.js"></script>

  <script>
    function clearfun(){
            document.getElementById('UNameerr').style = "visibility:hidden;";
            document.getElementById('UNameerr').innerText = "";
            document.getElementById('mail1err').style = "visibility:hidden;";
            document.getElementById('mail1err').innerText = "";
            document.getElementById('tnumerr').style = "visibility:hidden;";
            document.getElementById('tnumerr').innerText = "";
            document.getElementById('addresserr').style = "visibility:hidden;";
            document.getElementById('addresserr').innerText = "";
            document.getElementById('Nnumerr').style = "visibility:hidden;";
            document.getElementById('Nnumerr').innerText = "";
            document.getElementById('pass1err').style = "visibility:hidden;";
            document.getElementById('pass1err').innerText = "";
            document.getElementById('conpasserr').style = "visibility:hidden;";
            document.getElementById('conpasserr').innerText = "";
            document.getElementById('mail2err').style = "visibility:hidden;";
            document.getElementById('mail2err').innerText = "";
            document.getElementById('pass2err').style = "visibility:hidden;";
            document.getElementById('pass2err').innerText = "";

        }

        function valid1(){
            var user1 = document.getElementById('UName').value;
            var mail1 = document.getElementById('mail1').value;
            var tele = document.getElementById('tnum').value;
            var address = document.getElementById('address').value;
            var NIC = document.getElementById('Nnum').value;
            var pass1 = document.getElementById('pass1').value;
            var conpass = document.getElementById('conpass').value;

            if(user1 == ""){
                document.getElementById('UNameerr').style = "visibility:visible;";
                document.getElementById('UNameerr').innerText = "Please Type User Name";
                return false;
            }
            if (!validateEmail(mail1) || mail1 == "") {
              document.getElementById('mail1err').style = "visibility:visible;";
              document.getElementById('mail1err').innerText = "Please Enter the mail address";
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
            if(pass1 == ""){
                document.getElementById('pass1err').style = "visibility:visible;";
                document.getElementById('pass1err').innerText = "Please Enter the password";
                return false;
            }
            if(conpass == ""){
                document.getElementById('conpasserr').style = "visibility:visible;";
                document.getElementById('conpasserr').innerText = "Retype the password";
                return false;
            }
            if(conpass != pass1){
                document.getElementById('conpasserr').style = "visibility:visible;";
                document.getElementById('conpasserr').innerText = "Typed Pasword is not match.";
                return false;
            }
        }
        function valid2(){
            var mail2 = document.getElementById('mail2').value;
            var pass2 = document.getElementById('pass2').value;

            if(!validateEmail(mail2) && mail2 == ""){
                document.getElementById('mail2err').style = "visibility:visible;";
                document.getElementById('mail2err').innerText = "Please Enter the email";
                return false;
            }
            if(pass2 == ""){
                document.getElementById('pass2err').style = "visibility:visible;";
                document.getElementById('pass2err').innerText = "Please Enter the password";
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