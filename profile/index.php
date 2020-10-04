<!DOCTYPE html>
<?php
  // check already sign 
  include 'autoloader.php';
  session_start();
				// check already sign 
  $passengerUser = @unserialize($_SESSION['passenger']);
  if (!($passengerUser instanceof Passenger)) {
    # code...
    header("location:../signup");
  }
  if(!$passengerUser->haveBookingHistory()){
    echo "ajhfaebghwenjkawnshrkdj";
    $passengerUser->setBookingHistory();
  }  
?>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Profile | Sri Lanka Railway</title>
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.2/css/all.css'><link rel="stylesheet" href="./style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="wrapper d-flex h-100">
  <aside class="sidebar h-100">
    <div class="sidebar-section sidebar-header">
      <div class="sidebar-logo text-center">
        <a class="text-light">Profile</a>
      </div>
    </div>
    <div class="sidebar-section sidebar-profile pt-4 pb-4">
      <div class="profile-picture">
        <div class="picture-wrapper rounded-circle ml-auto mr-auto">
          <img src='<?php echo $passengerUser->getDp(); ?>' class="img-fluid" alt="">
        </div>
        <span class="profile-alert"></span>
        <div class="profile-details text-center mt-2">
          <div class="name"><?php echo $passengerUser->getName(); ?></div>
          <small class="role"><?php echo $passengerUser->getMail(); ?></small>
        </div>
      </div>
    </div>
    <div class="sidebar-section sidebar-menu p-0">
      <ul class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <li class="nav-item" >
          <a class="nav-link rounded-0" id="notifications-tab" data-toggle="tab" href="#notifications" role="tab" aria-controls="notifications" aria-selected="false">
            <i class="far fa-comment"></i>
            <span class="nav-alert bg-success"></span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link rounded-0" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">
            <i class="fas fa-cogs"></i>
          </a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade pt-3 pb-2" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">
          <div class="tab-header text-uppercase p-2">
            About
          </div>
           <ul>
            <li>
              <a class="p-2 d-flex align-items-center text-decoration-none" href="#">
                <div class="icon">
                   <i class="fa fa-phone text-center text-success border"></i>
                </div>
                <div class="notification-content flex-fill overflow-hidden">
                  <div class="notification-detail text-nowrap text-truncate"><?php echo $passengerUser->getTeleNo();?>.</div>
                  <div class="notification-time">Your phone Number</div>
                </div>
              </a>
            </li>
              <li>
              <a class="p-2 d-flex align-items-center text-decoration-none" href="#">
                <div class="icon">
                   <i class="fa fa-address-card text-center border"></i>
                </div>
                <div class="notification-content flex-fill overflow-hidden">
                  <div class="notification-detail text-nowrap text-truncate"><?php echo $passengerUser->getAddress();?>.</div>
                  <div class="notification-time">Home Address</div>
                </div>
              </a>
            </li>
              <li>
              <a class="p-2 d-flex align-items-center text-decoration-none" href="#">
                <div class="icon">
                   <i class="fa fa-id-badge text-center text-info border"></i>
                </div>
                <div class="notification-content flex-fill overflow-hidden">
                  <div class="notification-detail text-nowrap text-truncate"><?php echo $passengerUser->getNIC();?>.</div>
                  <div class="notification-time">NIC No.</div>
                </div>
              </a>
            </li>
              <li>
              <a class="p-2 d-flex align-items-center text-decoration-none" href="#">
                <div class="icon">
                   <i class="fa fa-check text-center text-white border border-success"></i>
                </div>
                <div class="notification-content flex-fill overflow-hidden">
                  <div class="notification-detail text-nowrap text-truncate"><?php echo $passengerUser->getNoOFBH();?>.</div>
                  <div class="notification-time">No Of Booking</div>
                </div>
              </a>
            </li>
           </ul>
        </div>
        
        <div class="tab-pane fade pt-3 pb-2" id="settings" role="tabpanel" aria-labelledby="settings-tab">
           <div class="tab-header text-uppercase p-2">
            Settings
          </div>
          <ul>
            <li>
              <a href="#" class="d-flex align-items-center">
                <i class="far fa-user"></i>
                <span class="flex-fill">Profile</span>
              </a>
            </li>
            <li>
              <a href="../signup/edit.php" class="d-flex align-items-center">
                <i class="fas fa-cog"></i>
                <span class="flex-fill">Settings</span>
              </a>
            </li>
            <li>
              <a href="../logout.php" class="d-flex align-items-center">
                <i class="fas fa-power-off"></i>
                <span class="flex-fill">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </aside>
  <main class="page-content">
    <div class="container">
      <?php
      $passengerUser->displayBookingHistory();?>   
    </div>
    
  </main>
</div>
<!-- partial -->
  <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script><script  src="./script.js"></script>
<script>
(function() {
   document.getElementById("notifications-tab").click();
})();
</script>
<script src="../js/jquery-1.11.0.min.js"></script>
<script>
function passKeyValue(indexVal) {
  $.ajax({
    url: "../makeInvoice.php",
    type: "post",
    data: {idxVal:indexVal},
    success:function(response){  
      if(response == "  TRUE"){
        window.location=("../invoice.php");
      }
      else if(response == " FALSE"){
        alert("Error Occured.");
      }
      else{
        console.log(response);
      }
    }
  });
}
</script>
</body>
</html>
