<?php
namespace booking;

class stateDatas{

    private $dstation, $estation, $amount, $train, $bDate;
    /**
     * @var Seat
     */
    private $selectedSeat;

    public function __construct($dstation, $estation, $amount, $train, $bDate)
    {
        /**
         * set Departure Station, Destination, Price and Amount
         */
        $b_date = explode("/",$bDate);
        $this->dstation = $dstation;
        $this->estation = $estation;
        $this->amount = $amount;
        $this->train = $train;
        $this->bDate = $b_date[2]."-".$b_date[0]."-".$b_date[1];
    }

    /**
     * Get the value of dstation
     */ 
    public function getDstation()
    {
        return $this->dstation;
    }

    /**
     * Get the value of estation
     */ 
    public function getEstation()
    {
        return $this->estation;
    }

    /**
     * Get the value of amount
     */ 
    public function getAmount():int
    {
        return $this->amount;
    }

    /**
     * Get the value of train
     */ 
    public function getTrain()
    {
        return $this->train;
    }

    /**
     * Get the value of bDate
     */ 
    public function getBDate()
    {
        return $this->bDate;
    }

    

    /**
     * Set the value of selectedSeat
     *
     */ 
    public function setSelectedSeat($selectedSeat):void
    {
        $this->selectedSeat = $selectedSeat;
    }

    /**
     * Get the value of selectedSeat
     *
     */ 
    public function getSelectedSeat()
    {
        return implode(",",$this->selectedSeat);
    }

    /**
     * return no of seats in selected seats
     */
    public function getNoOfSelectedSeats():int
    {
        return count($this->selectedSeat);
    }
}
?>