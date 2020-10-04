<?php
namespace booking;
include_once 'state.inc.php';
class lookupAvailable extends state
{
    /**
     * this is for get Booked seat and available seat 
     */
    public function getBookedSeats()
    {
        /**
         * get Booked Seats From compartment
         */
        return CompartmentMultiton::getInstanceCompartment($this);
        
    }
    public function nextState($passenger):void
    {
        #set next state to booking seats
        $passenger->setState(new payment($passenger->getState()->getStateDatas()));
    }
}

?>