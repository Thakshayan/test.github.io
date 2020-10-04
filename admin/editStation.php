<?php
    include 'header.php';
    if($_SESSION['usertype'] != "admin"){
      header("location:404.php");
    }
    $acc = @$_GET['id'];
    if (isset($_POST['addDetail'])){
        $station = $_POST['station'];
        $pass = $_POST['password'];
        if($pass){
          $passenc = md5($pass);
        }
        else{
          $passenc = null;
        }
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        
        
        $addStation = new Admin();
        $errmsg = $addStation->updateStationDetails($acc, $station, $passenc, $lat, $lng);
    }
    if(!$acc){
        echo "<main class='main-content bgc-grey-100'><div class='alert alert-danger' role='alert' style='vertical-align:middle'>
        Error Occured. Must specify Station id, short or name Correctly!. 
        </div><main>";
    }
    else {
        $stationObj = new Admin;
        $result = $stationObj->getStationDetails($acc);
        if(!$result){
            echo "<main class='main-content bgc-grey-100'><div class='alert alert-danger' role='alert' style='vertical-align:middle'>
            Error Occured. Must specify Station id, short or name Correctly!. 
            </div><main>";
        }
        else{
?>
    <style>
        #maps .centerMarker {
          position: absolute;
          /*url of the marker*/
          background: url(images/gmappin.png) no-repeat;
          /*center the marker*/
          top: 50%;
          left: 50%;
          z-index: 1;
          /*fix offset when needed*/
          margin-left: -10px;
          margin-top: -34px;
          /*size of the image*/
          height: 34px;
          width: 20px;
          cursor: pointer;
        }
    </style>
        <!-- ### $App Screen Content ### -->
        <main class='main-content bgc-grey-100'>
          <div id='mainContent'>
            <div class="row gap-20 masonry pos-r">
              <div class="masonry-sizer col-md-12"></div>
                
              <div class="masonry-item col-md-6">
                <div class="bgc-white p-20 bd">
                  <h6 class="c-grey-900">Edit Station Details</h6>
                  <div class="mT-30">
                    <form class="container" id="needs-validation" novalidate method="post" action="#"> 
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom01">Station Account name</label>
                          <input type="text" class="form-control" id="validationCustom01" name="acc" placeholder="Station Account Name" value="<?php echo $acc;?>" required disabled>
                          <div class="invalid-feedback">
                            Please provide account name.
                          </div>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom02">Station Name</label>
                          <input type="text" class="form-control" id="validationCustom02" name="station" placeholder="Station Name" value="<?php echo $result['name'];?>" required>
                          <div class="invalid-feedback">
                            Please provide a station name.
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6 mb-3">
                          <label for="validationCustom03">Password</label>
                          <input type="password" class="form-control" id="validationCustom03" name="password" placeholder="optional">
                          <div class="invalid-feedback">
                            Please provide a password.
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationCustom04">Lattitude</label>
                          <input type="text" class="form-control" id="validationCustom04" name="lat" placeholder="lattitude" value="<?php echo $result['lat'];?>" required min="0">
                          <div class="invalid-feedback">
                            Please provide a valid lattitude.
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationCustom05">Longitude</label>
                          <input type="text" class="form-control" id="validationCustom05" name="lng" placeholder="longitude" value="<?php echo $result['lng'];?>" required min="0">
                          <div class="invalid-feedback">
                            Please provide a valid longitude.
                          </div>
                        </div>
                      </div>
                      <button class="btn btn-primary" type="submit" name="addDetail">Update Station</button>
                      <center><div class="invalid-feedback" style="display:block;color:green">
                            <?php echo @$errmsg; ?>
                      </div></center>
                      
                      <br><br><br><br>
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
              
             <div class="container-fluid" style="float:right">
              <h4 class="c-grey-900 mT-10 mB-30">Get coordinates here</h4> 
            </div>
              <h6 class="c-grey-900 mB-20">Map</h6>
            <div id="maps" style="height:400px;" class="centerMarker"></div>
          </div>
        </main>
        <script>
          function initMap() {           
            var map = new google.maps.Map(document.getElementById('maps'), {
              zoom: 8,
              center: {lat:<?php echo $result['lat'];?>,lng:<?php echo $result['lng'];?>}
            });
            var marker = new google.maps.Marker({
                draggable: false,
                animation: google.maps.Animation.DROP,
                position: {lat:<?php echo $result['lat'];?>,lng:<?php echo $result['lng'];?>},
                title:"Old Station",
                map : map,
                icon : "images/gmappin.png"
            });
            $('<div/>').addClass('centerMarker').appendTo(map.getDiv());
              
            google.maps.event.addListener(map, 'center_changed', function() {
                document.getElementById('validationCustom04').value = map.getCenter().lat();
                document.getElementById('validationCustom05').value = map.getCenter().lng();
              });
           
            }
        </script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCR5PFyvraK8Cqbu-vQu7UAR-NkcABHNuw&libraries=places&callback=initMap">
        </script>
<?php
        }
    }
    include 'footer.php';
?>