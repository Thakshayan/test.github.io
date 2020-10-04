<?php

namespace booking;
include_once 'state.inc.php';
class invoice extends state
{
    /**
     * @all attributes of invoice
     */
    private $b_ID, $b_passengerID, $trainID, $payment, $p_method, $noOFSeats, 
    $reg_time, $b_time, $d_station, $e_station, $contactNo, $personName, $seats;

    # create Invoice 
    public function __construct($b_ID, $trainID, $payment, $p_method, $noOFSeats, $reg_time, $b_time, $d_station, $e_station, $contactNo, $personName, $seats)
    {
        $this->b_ID = $b_ID;
        $this->trainID = $trainID;
        $this->payment = $payment;
        $this->p_method = $p_method;
        $this->noOFSeats = $noOFSeats;
        $this->reg_time = $reg_time;
        $this->b_time = $b_time;
        $this->d_station = $d_station;
        $this->e_station = $e_station;
        $this->contactNo = $contactNo;
        $this->personName = $personName;
        $this->seats = $seats;
    }

    # set Passenger ID if want
    public function setPassengerID(String $passengerId){
        $this->b_passengerID = $passengerId;
    }

    public function nextState($passenger):void
    {
        $passenger->setState(new lookupAvailable);
    } 

    
    

    /**
     * Get the value of b_ID
     */ 
    public function getB_ID()
    {
        return $this->b_ID;
    }

    /**
     * Get the value of b_passengerID
     */ 
    public function getB_passengerID()
    {
        return $this->b_passengerID;
    }

    /**
     * Get the value of trainID
     */ 
    public function getTrainID()
    {
        return $this->trainID;
    }

    /**
     * Get the value of payment
     */ 
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Get the value of p_method
     */ 
    public function getP_method()
    {
        return $this->p_method;
    }

    /**
     * Get the value of noOFSeats
     */ 
    public function getNoOFSeats()
    {
        return $this->noOFSeats;
    }

    /**
     * Get the value of reg_time
     */ 
    public function getReg_time()
    {
        return $this->reg_time;
    }

    /**
     * Get the value of b_time
     */ 
    public function getB_time()
    {
        return $this->b_time;
    }

    /**
     * Get the value of d_station
     */ 
    public function getD_station()
    {
        return $this->d_station;
    }

    /**
     * Get the value of e_station
     */ 
    public function getE_station()
    {
        return $this->e_station;
    }

    /**
     * Get the value of contactNo
     */ 
    public function getContactNo()
    {
        return $this->contactNo;
    }

    /**
     * Get the value of personName
     */ 
    public function getPersonName()
    {
        return $this->personName;
    }

    /**
     * Get the value of seats
     */ 
    public function getSeats()
    {
        return $this->seats;
    }
}

?>