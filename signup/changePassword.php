<!DOCTYPE html>
<?php
    include 'autoloader.php';
    ob_start(); 
    session_start();
    if(!($_SESSION["changePass"] && $_COOKIE["changPassMail"])){
        header("location:../404.php");
    } 
?>
<html lang="es" dir="ltr">
  <head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Forgot Password  | Sri Lanka Railway</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="css/error.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css"type="text/css">
    <link rel="stylesheet" href="css/main1.css"type="text/css">
    <link rel="stylesheet" href="css/util.css"type="text/css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <?php

    if (isset($_POST['checkEmail'])){
        $pass = $_POST["newpass"];
        $cpass = $_POST["newpass"];
        if ($pass && $cpass && $pass == $cpass) {
            if(Passenger::updatePassword($_COOKIE["changPassMail"], md5($pass))){
              unset($_SESSION["changePass"]);
              session_destroy();
              $errmsg = "Password changed successfully. Click here to <a href = '../signup'><u>Login</u></a>";
              $errclr = "green";
            } else{
              $errmsg = "Fail to change Password.";
              $errclr = "red";
            }
        }
    }
  ?>
  </head>
  <body>
    <div class="main">
      <div class="container a-container" id="a-container">
        <form class="form" id="a-form" method="POST" action="" onsubmit="return valid1()">
          <h2 class="title">New Password</h2>
          <span class="errorr" id="passerr"></span>         
          <input class="form__input input fa" type="password" placeholder="&#xf084; New Password." id="newpass" name="newpass" oninput="clearfun()">
          <span class="errorr" id="cpasserr"></span>         
          <input class="form__input input fa" type="password" placeholder="&#xf084; Confirm Password." id="cpass" name="cpass" oninput="clearfun()">
            <center>
              <span class="txt1 p-b-17" style="display:block;color:<?php echo @$errclr;?>;font-weight:bold;line-height:5;" id="tpasserr"> <?php echo @$errmsg?></span>
            </center>
          <button type="submit" class="button submit__button" name="checkEmail">Next >></button>
        </form>
      </div>
      
      <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
          <h2 class="switch__title title">Change Password </h2>
          <p class="switch__description description">Fill required field.</p>
          <a href="forgotPassword.php"><button class="switch__button button switch-btn" ><< Go Back </button></a>
        </div>
      </div>
    </div>
  <script  src="js/script.js"></script>

  <script>
        function clearfun(){
            document.getElementById('passerr').style = "visibility:hidden";
            document.getElementById('passerr').innerText = "";
            document.getElementById('cpasserr').style = "visibility:hidden";
            document.getElementById('cpasserr').innerText = "";
            document.getElementById('tpasserr').innerText = "";
        }

        function valid1(){
            var pass = document.getElementById('newpass').value;
            var cpass = document.getElementById('cpass').value;
            if(pass == ""){
                document.getElementById('passerr').style = "visibility:visible;";
                document.getElementById('passerr').innerText = "Please fill this field.";
                return false;
            }
    
            if(cpass == ""){
                document.getElementById('cpasserr').style = "visibility:visible;";
                document.getElementById('cpasserr').innerText = "Please fill this field.";
                return false;
            }

            if(pass != cpass){
                document.getElementById('tpasserr').innerText = "Password is not match.";
                return false;
            }
        }

  </script>
  
  </body>
</html>