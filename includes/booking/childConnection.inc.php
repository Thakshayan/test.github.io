<?php
namespace booking;
include_once 'includes/dbh.inc.php';
use Connection;
/**
 * this is for seats by concept if seat flyweight method
 * This is the heavy weight seat object
 */

class childConnection extends Connection{
    public function getConnect()
    {
        return (new parent)->connect();
    }
}
?>