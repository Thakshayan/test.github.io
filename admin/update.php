<?php
include_once 'autoloader.php';
$updateID = @$_POST['identity'];
$category = @$_POST['category'];
if($updateID && $category){
    $adminObj = new Admin();
    switch ($category) {
        case 'complain':
            # update mark as Read
            $adminObj->updateMarkAsRead($updateID);
            break;
        case 'updateCmplinSeen':
            # update seen status of complains ...
            $adminObj->updateMarkAsSeen();
            break;
        default:
            header("location:500.html");
            break;
    }
}
else {
    header("location:404.php");
}
?>