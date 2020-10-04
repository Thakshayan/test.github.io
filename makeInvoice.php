<?php
// Handle AJAX request (start)
if( isset($_POST['idxVal']) ){
    include_once 'autoloader.php';
    ob_start();
    session_start();
    // check already sign 
    $passengerUser = @unserialize($_SESSION['passenger']);
    if (($passengerUser instanceof Passenger)){
        $passengerUser->setInvoice($_POST['idxVal']);
        $_SESSION['passenger'] = serialize($passengerUser);
        echo"TRUE";
    }
    else {
        echo"FALSE";
    }
    exit;
}
// Handle AJAX request (end)
?>