<?php
ob_start();
session_start();
if (@$_SESSION['userRail']){
    header('location:home.php');
}
include_once 'autoloader.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="description" content="Srilanka Railway Station">
    <meta name="keywords" content="">
    <meta name="author" content="University Of Moratuwa CSE Students">
    <title>Sign In</title>
    <link rel="icon" href="images/logo_title.png">
    <style>
      #loader {
        transition: all 0.3s ease-in-out;
        opacity: 1;
        visibility: visible;
        position: fixed;
        height: 100vh;
        width: 100%;
        background: #fff;
        z-index: 90000;
      }

      #loader.fadeOut {
        opacity: 0;
        visibility: hidden;
      }

      .spinner {
        width: 40px;
        height: 40px;
        position: absolute;
        top: calc(50% - 20px);
        left: calc(50% - 20px);
        background-color: #333;
        border-radius: 100%;
        -webkit-animation: sk-scaleout 1.0s infinite ease-in-out;
        animation: sk-scaleout 1.0s infinite ease-in-out;
      }

      @-webkit-keyframes sk-scaleout {
        0% { -webkit-transform: scale(0) }
        100% {
          -webkit-transform: scale(1.0);
          opacity: 0;
        }
      }

      @keyframes sk-scaleout {
        0% {
          -webkit-transform: scale(0);
          transform: scale(0);
        } 100% {
          -webkit-transform: scale(1.0);
          transform: scale(1.0);
          opacity: 0;
        }
      }
    </style>
      <link href="css/style.css" rel="stylesheet" type="text/css">
      <link href="css/main.css" rel="stylesheet" type="text/css">
      <link href="css/err.css" rel="stylesheet" type="text/css">
  </head>
  <body class="app">
    <div id='loader'>
      <div class="spinner"></div>
    </div>

    <script>
      window.addEventListener('load', function load() {
        const loader = document.getElementById('loader');
        setTimeout(function() {
          loader.classList.add('fadeOut');
        }, 300);
      });
        
        function clearfun(){
            document.getElementById('usernameerr').style = "visibility:hidden;";
            document.getElementById('usernameerr').innerText = "";
            document.getElementById('passerr').style = "visibility:hidden;";
            document.getElementById('passerr').innerText = "";
        }
        function valid(){
            var user = document.getElementById('username').value;
            var pass = document.getElementById('password').value;
            if(user == ""){
                document.getElementById('usernameerr').style = "visibility:visible;";
                document.getElementById('usernameerr').innerText = "Please Type User Name";
                return false;
            }
            if(pass == ""){
                document.getElementById('passerr').style = "visibility:visible;";
                document.getElementById('passerr').innerText = "Please Enter the password";
                return false;
            }
        }
    </script>
    <?php
        if (isset($_POST['oklogin'])){
            $user = $_POST['username'];
            $pass = $_POST['pass'];
            $passenc = md5($pass);
 
            $errmsg = User::login($user, $passenc);
        }
    ?>
      
    <div class="peers ai-s fxw-nw h-100vh">
      <div class="d-n@sm- peer peer-greed h-100 pos-r bgr-n bgpX-c bgpY-c bgsz-cv" style='background-image: url("assets/static/images/bg.jpg")'>
        <div class="pos-a centerXY">
          <div class="bgc-white bdrs-50p pos-r" style='width: 80px; height: 80px;'>
            <img class="pos-a centerXY" src="images/logo.png" alt="There is an logo">
          </div>
        </div>
      </div>
      <div class="col-12 col-md-4 peer pX-40 pY-80 h-100 bgc-white scrollable pos-r" style='min-width: 320px;'>
        <h4 class="fw-300 c-grey-900 mB-40">Login</h4>
        <form method="post" action="#" onsubmit="return valid()">
          <div class="form-group errrr">
            <label class="text-normal text-dark">Username</label>
            <input type="text" class="form-control" placeholder="Type your email.." name="username" id="username" oninput="clearfun()">
              <span class="errorr" id="usernameerr"></span>
          </div>
          <div class="form-group errrr">
            <label class="text-normal text-dark">Password</label>
            <input type="password" class="form-control" placeholder="Password" name="pass" id="password" oninput="clearfun()">
              <span class="errorr" id="passerr"></span>
          </div>
          <div class="form-group" style="float: right">
            <div class="peers ai-c jc-sb fxw-nw">
              <div class="peer">
                  <button class="btn btn-primary" name="oklogin" >Login</button>
              </div>
            </div>
          </div>
            <center><span class="txt1 p-b-17" style="color:red;"><?php echo @$errmsg?></span></center>
        </form>
      </div>
    </div>
 <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="0302f9e5c864f5de1eb577a7-text/javascript"></script>

<script type="0302f9e5c864f5de1eb577a7-text/javascript" src="js/vendor.js"></script><script type="0302f9e5c864f5de1eb577a7-text/javascript" src="js/bundle.js"></script><script src="https://ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="0302f9e5c864f5de1eb577a7-|49" defer=""></script></body></html>


