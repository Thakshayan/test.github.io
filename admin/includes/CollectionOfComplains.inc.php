<?php
include_once 'dbh.inc.php';
include_once 'observable.inc.php';
class CollectionOfComplains extends Connection implements observable
{
    public function notify(Admin $admin){
        $admin->update();
    }
}
?>