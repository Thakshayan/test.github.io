<!DOCTYPE html>
<?php
    include 'autoloader.php';
    ob_start(); 
    session_start();
    $user = $_GET['eMail'];
    $errmsg1 = Passenger::alreadyIdExist($user);
    if(!($errmsg1 == "exist")){
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

    if (isset($_POST['checkPin'])){
      if(Passenger::verify($_POST['pincode'], $user)){
        setcookie("changPassMail", $user, time() + (86400 * 30), "/"); // 86400 = 1 day
        $_SESSION["changePass"] = TRUE;
        header("location:changePassword.php");
      }
      else {
        $errmsg = "Pin Code verification failed";
      }
    }
  ?>
  </head>
  <body>
    <div class="main">
      <div class="container a-container" id="a-container">
        <form class="form" id="a-form" method="POST" action="" onsubmit="return valid1()">
          <h2 class="title">Pin Code</h2>
          <span class="errorr" id="UNameerr"></span>         
          <input class="form__input input fa" type="number" placeholder="&#xf2bd; Type Your Pin code." id="pincode" name="pincode" oninput="clearfun()">
            <center>
              <span class="txt1 p-b-17" style="display:block;color:red;font-weight:bold;line-height:5;"> <?php echo @$errmsg?></span>
            </center>
          <button type="submit" class="button submit__button" name="checkPin">Next >></button>
        </form>
      </div>
      
      <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
          <h2 class="switch__title title">Verify </h2>
          <p class="switch__description description">Type your verfication code. You get that via from E-Mail.</p>
          <a href="forgotPassword.php"><button class="switch__button button switch-btn" ><< Go Back </button></a>
        </div>
      </div>
    </div>
  <script  src="js/script.js"></script>

  <script>
        function clearfun(){
            document.getElementById('UNameerr').style = "visibility:hidden";
            document.getElementById('UNameerr').innerText = "";
        }

        function valid1(){
            var user1 = document.getElementById('pincode').value;
            if(user1 == ""){
                document.getElementById('UNameerr').style = "visibility:visible;";
                document.getElementById('UNameerr').innerText = "Pin Code required.";
                return false;
            }
        }
  </script>
  
  </body>
</html>