<?php
ob_start();
session_start();
if (!$_SESSION['userRail']){
    header('location:404.php');
}
include_once 'autoloader.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Change Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/logo_title.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main1.css">
<!--===============================================================================================-->
</head>
<body>
	<?php
     
        if(isset($_POST['ok'])){

            $user = $_SESSION['userRail'];
            $oldpass = $_POST['oldpass'];
            $pass = $_POST['pass'];
            $cpass = $_POST['cpass'];
            $passenc = md5($pass);
            $oldpassenc = md5($oldpass);
            
            if($cpass && $pass && $cpass == $pass && $oldpass){
                $userObj = new Admin();
                $result = $userObj->changePass($user, $oldpassenc, $passenc);
            }
        }
    
    ?>
    <script type="text/javascript">
        function validateform(){
            pass = document.getElementById('pass').value;
            oldpass = document.getElementById('oldpass').value;
            cpass = document.getElementById('cpass').value;
            if(pass == '' || cpass =='' || oldpass ==''){
                return false;
            }
            if (pass.length < 8){
                document.getElementById('passerr').innerText = "Atleast password has 8 letters ";
                return false;
            }
            if (pass != cpass){
                document.getElementById('passerr').innerText = "Passwords not matched";
                return false;
            }
        }
        function validpass(){
             pass = document.getElementById('pass').value;
            if (pass.length <=5){
                document.getElementById('passerr').style = "color:red";
                msg = "weak";
                }
            else if(pass.length <=8){
                document.getElementById('passerr').style = "color:blue";
                msg = "good";
            }
            else{
                document.getElementById('passerr').style = "color:green";
                msg = "better";
            }
            document.getElementById('passerr').innerText = msg;
        }
        function equalpassandcpass(){
            txtpass = document.getElementById('pass').value;
            txtcpass = document.getElementById('cpass').value;
            if (txtpass == txtcpass){
                document.getElementById('cpass').style = "color:green";
                document.getElementById('passmatch').innerText = "Password match";
                document.getElementById('passmatch').style = "color:green";
            }
            else{
                document.getElementById('cpass').style = "color:red";
                document.getElementById('passmatch').innerText = "";
            }
        }
        
    </script>
	<div class="limiter">
		<div class="container-login100" style="background-image:url('assets/static/images/bg.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" method="post" action="#" onsubmit="return validateform()">
					<span class="login100-form-title p-b-49">
						Change Password
					</span>
                    
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">OLD Password</span>
						<input class="input100" type="password" name="oldpass" placeholder="Type your old password" id="oldpass">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<br>
                    
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">NEW Password</span>
						<input class="input100" type="password" name="pass" placeholder="Type your new password" id="pass" onkeyup="validpass()">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div><center><span class="txt1 p-b-17" style="color:red;" id="passerr"></span></center>
					<br>
					    
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Confirm Password</span>
						<input class="input100" type="password" name="cpass" placeholder="Confirm password" id="cpass" oninput="equalpassandcpass()">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
                     <center><span class="txt1 p-b-17" style="color:red;" id="passmatch"></span></center>
					
					<br><br>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" name="ok">
								OK
							</button>
						</div>
					</div><br>
                    <center><span class="txt1 p-b-17">
							<?php echo @$result;?>
                        </span>
                    </center>
                </form>
                <a href="home.php" > <?php echo "<-- Go Back"?></a>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
    
    

</body>
</html>