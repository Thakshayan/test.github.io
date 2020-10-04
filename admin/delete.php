<?php
include_once 'autoloader.php';
$deleteid = @$_POST['identity'];
$category = @$_POST['category'];
if($deleteid && $category){
    $adminObj = new Admin();
    switch ($category) {
        case 'station':
            $adminObj->deleteStation($deleteid);
            break;
        case 'train':
            $adminObj->deleteTrain($deleteid);
            break;
        case 'complain':
            $adminObj->deleteComplain($deleteid);
            break;
        case 'suggestion':
            $adminObj->deleteSuggestion($deleteid);
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