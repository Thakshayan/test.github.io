<?php
include 'header.php';
if($_SESSION['usertype'] != "admin"){
  header("location:404.php");
}
$Admin = new Admin();
$stations = $Admin->getAllStationAsOptions();

if (isset($_POST['addDetail'])){
  $trainID = $_POST['acc'];
  $trainName = $_POST['train'];
  $goStationTimes = @$_POST['gostationtimesarr'];
  $returnStationTimes = @$_POST['returnstationsimesarr'];
  $returnStations = @$_POST['returnstationsarr'];
  $goStations = @$_POST['gostationsarr'];
  $gostationpricesarr = @$_POST['gostationpricesarr'];
  $returnstationpricesarr = @$_POST['returnstationpricesarr'];

  $errmsg = $Admin->addNewTrain($trainID, $trainName, $goStations, $goStationTimes, $returnStations, $returnStationTimes , $gostationpricesarr, $returnstationpricesarr);
  if($errmsg == "success"){ 
    $errColor = "green";
    $errmsg="Successfully Registerd";
  }
  else {$errColor = "red";}
}
?>


<!-- ### $App Screen Content ### -->
<main class='main-content bgc-grey-100'>
  <div id='mainContent'>
    <div class="row gap-20  pos-r">
      <div class="masonry-sizer col-md-12"></div>
      <div class="masonry-item col-md-12">
        <div class="bgc-white p-20 bd">
          <h6 class="c-grey-900">Enter Train All Details</h6>
          <div class="mT-30">
            <form class="container" id="needs-validation" novalidate method="post" action="#"> 
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="validationCustom01">Train ID </label>
                  <input type="text" class="form-control" id="validationCustom01" name="acc" placeholder="Train ID Eg:- 1N40001 " required>
                  <div class="invalid-feedback">
                    Please provide Train ID
                  </div>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="validationCustom02">Train Name</label>
                  <input type="text" class="form-control" id="validationCustom02" name="train" placeholder="Eg: - Yaldevi Long Express" required>
                  <div class="invalid-feedback">
                    Please provide Train name.
                  </div>
                </div>
                  
                <div class="col-md-12 mb-6">
                    <h6 class="c-grey-900">Train Time Table Insert</h6>
                </div>
                  
                <div class="goStations col-md-6 mb-3">
                    <a href="javascript:void(0);" class="add_button btn btn-dark" title="Add Station">Add Stations</a><br><br>
                </div>
                  
                <div class="col-md-12 mb-6">
                    <h6 class="c-grey-900">Add Return Stations Time Table</h6>
                </div>
                  
                 <div class="returnStations col-md-6 mb-3">
                    <a href="javascript:void(0);" class="add_return_button btn btn-dark" title="Add Station">Add Return Stations</a><br><br>
                </div>
                
              </div>
              <button class="btn btn-primary" type="submit" name="addDetail">Save New Train</button>
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
            
            $(document).ready(function(){
                var addButton = $('.add_button'); //Add button selector
                var addreturnButton = $('.add_return_button'); //Add button selector
                var wrapper = $('.goStations'); //Input field wrapper               
                var wrapperReturn = $('.returnStations'); //Input field wrapper               

                //Once add button is clicked
                $(addButton).click(function(){
                        var fieldHTML = '<div class="form-row"><div class="form-group col-md-3"><label for="inputState">Station</label><select class="form-control" required name="gostationsarr[]"><option value="" selected>Choose...</option>'+"<?php echo $stations; ?>"+' </select></div><div class="form-group col-md-3"><label >Time</label><input type="time" class="form-control" name="gostationtimesarr[]" required title="Arrival Time"></div><div class="form-group col-md-4"><label >Ticket Price</label><input type="text" class="form-control" name="gostationpricesarr[]" placeholder="Enter R.s serperate by ," title="Insert amount serperate by comma"></div><a href="javascript:void(0);" class="remove_button col-md-2" style=float:right >&nbsp; X </a></div>'; //New input field html 
                        $(wrapper).append(fieldHTML); //Add field html
                });

                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    //x--; //Decrement field counter
                });
                
                $(addreturnButton).click(function(){
                        var fieldHTML = '<div class="form-row"><div class="form-group col-md-3"><label for="inputState">Station</label><select class="form-control" required name="returnstationsarr[]"><option value="" selected>Choose...</option>'+"<?php echo $stations; ?>"+' </select></div><div class="form-group col-md-3"><label >Time</label><input type="time" class="form-control" name="returnstationsimesarr[]" required title="Arrival Time"></div><div class="form-group col-md-4"><label >Ticket Price</label><input type="text" class="form-control" name="returnstationpricesarr[]" placeholder="Enter R.s serperate by ," title="Insert amount serperate by comma"></div><a href="javascript:void(0);" class="remove_button col-md-2" style=float:right >&nbsp; X </a></div>'; //New input field html 
                        $(wrapperReturn).append(fieldHTML); //Add field html
                });

                //Once remove button is clicked
                $(wrapperReturn).on('click', '.remove_button', function(e){
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                });
            });
            </script>
          </div>
        </div>
    </div>                
  </div>
 </div>
</main>

<?php
include 'footer.php';
?>