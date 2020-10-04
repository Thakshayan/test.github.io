<?php

namespace booking;

abstract class state{
    /**
     * @var stateDatas
     */
    private $stateDatas;

    /**
     * set all datas about booking
     */
    public function setStateDatas($dstation, $estation, $amount, $train, $bDate)
    {
        $this->stateDatas = new stateDatas($dstation, $estation, $amount, $train, $bDate);
    }

    
    // abstract function for change state during the booking section
    public abstract function nextState($passenger):void;

    /**
     * Get the value of stateDatas
     *
     * @return  stateDatas
     */ 
    public function getStateDatas():stateDatas
    {
        return $this->stateDatas;
    }

    /**
     * Set the value of stateDatas
     *
     * @param  stateDatas  $stateDatas
     */ 
    public function setStateData(stateDatas $stateDatas):void
    {
        $this->stateDatas = $stateDatas;
    }
}
?>