<?php
include 'User.classes.php';
include 'autoloader.inc.php';
class stationHead extends User{
    private $accountName,$stationName;
    
    public function __construct($accountName, $stationName) {
        $this->accountName = $accountName;
        $this->stationName = $stationName;
    }

    public function updateTrainLocation($trainID, $mood)
    {
        $trainObj = new Train;
        return $trainObj->updateTrainLocation($this, $trainID, $mood);
    }

    public function getAllTrains()
    {
        # get all Staion as Option object
        $trainObj = new Train;
        return $trainObj->getAllTrainAsOption();
    }
    /**
     * Get the value of accountName
     */ 
    public function getAccountName()
    {
        return $this->accountName;
    }
}