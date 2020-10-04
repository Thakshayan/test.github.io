<?php
include 'header.php';
$stationHead = new stationHead($_SESSION['userRail'] , $_SESSION['userRailname']);
$trains = $stationHead->getAllTrains();

if (isset($_POST['updateTrain'])){
  $trainID = $_POST['trainName'];
  $mood = $_POST['mood'];

  $errmsg =$stationHead->updateTrainLocation($trainID, $mood);
  if($errmsg == "success"){ 
    $errColor = "green";
    $errmsg="Successfully Updated";
  }
  else {$errColor = "red";$errmsg="Fail to update";}
}
?>
<!-- ### $App Screen Content ### -->
<main class='main-content bgc-grey-100'>
  <div id='mainContent'>
    <div class="row gap-20  pos-r">
      <div class="masonry-sizer col-md-12"></div>
      <div class="masonry-item col-md-12">
        <div class="bgc-white p-20 bd">
          <h6 class="c-grey-900">Update Train Current Location</h6>
          <div class="mT-30">
            <form class="container" id="needs-validation" novalidate method="post" action="#"> 
              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="validationCustom01">Train ID </label>
                  <select class="form-control" required name="trainName"><option value="" selected>Choose...</option><?php echo $trains; ?></select>
                  <div class="invalid-feedback">
                    Please select Train..
                  </div>
                </div>
                <div class="col-md-2 mb-2">
                  <label for="validationCustom01">Select Travelling Mood </label>
                  <select class="form-control" required name="mood">
                    <option value="1" selected>1 - if travelling</option>
                    <option value="0">0 - if finished</option>
                  </select>
                  <div class="invalid-feedback">
                    Please select Travel or Not travel
                  </div>
                </div>
                <div class="col-md-4 mb-3">
                  <label for="validationCustom02">Click here.</label><br>
                  <button class="btn btn-primary" type="submit" name="updateTrain" id="validationCustom02">Update Train</button>
                  <div class="invalid-feedback">
                    Please provide Train name.
                  </div>
                </div>                
              </div>
              
              <center><div class="invalid-feedback" style="display:block;color:<?php echo @$errColor;?>">
                    <?php echo @$errmsg; ?>
              </div></center>

            </form>
            <script>
              // Example starter JavaScript for disabling form submissions if there are invalid fields
              (function() {
                'use strict';

                window.addEventListener('load', function() {
                  var form = document.getElementById('needs-validation');
                  form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                      event.preventDefault();
                      event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                  }, false);
                }, false);
              })();
            </script>
          </div>
        </div>
    </div>                
  </div>
 </div>
</main>
<?php include 'footer.php';?>