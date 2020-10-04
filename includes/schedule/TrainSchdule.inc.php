<?php

namespace schedule;
class TrainSchdule
{
    private $trainID, $trainName, $amount, $departureTime, $arriveTime;

    public function __construct($trainID, $trainName, $amount, $departureTime, $arriveTime){
        $this->trainID = $trainID;
        $this->trainName = $trainName;
        $this->amount = $amount;
        $this->departureTime = $departureTime;
        $this->arriveTime = $arriveTime;
    }       
    
    /**
     * Get the value of arriveTime
     */ 
    public function getArriveTime()
    {
        return $this->arriveTime;
    }

    /**
     * Get the value of trainID
     */ 
    public function getTrainID()
    {
        return $this->trainID;
    }

    /**
     * Get the value of TrainName
     */ 
    public function getTrainName()
    {
        return $this->trainName;
    }

    /**
     * Get the value of DepartureTime
     */ 
    public function getDepatureTime()
    {
        return $this->departureTime;
    }

    /**
     * Get the value of Amount
     */ 
    public function getAmount()
    {
        return $this->amount;
    }
}
?>