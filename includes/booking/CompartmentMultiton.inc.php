<?php
namespace booking;

class CompartmentMultiton
{
    /**
     * @var SeatFlyweight
     */

    private static $instance = null;
    private $seatHeavyWeightInstance = array();

    /**
     * set All booked seats as objects and return it self
     */
    public static function getInstanceCompartment(lookupAvailable $LA)
    {
        if (self::$instance) {
            return self::$instance;
        } else {
            $cmp = new CompartmentMultiton();
            $la = $LA->getStateDatas();
            $sql = "SELECT seats FROM booking WHERE trainId=? AND d_station=? AND e_station=? AND b_date=?";
            $stmt = (new childConnection)->getConnect()->prepare($sql);
            $stmt->execute([$la->getTrain(), $la->getDstation(), $la->getEstation(), $la->getBDate()]);
            $results = $stmt->fetchAll();
            foreach ($results as $row) {                
                // seperate booked seat from one invoice
                $seatsFromDB = explode(",",$row["seats"]);
                foreach ($seatsFromDB as $seatFromDB) {
                    $seatHeavyWeight = new seatHeavyWeight($seatFromDB);
                    $cmp->pushSeat($seatHeavyWeight);
                }
            }
            self::$instance = $cmp;
            return self::$instance;  
        }
        
    }
    // prevent creating multiple instances due to "private" constructor
    private function __construct(){}

    public function pushSeat(seatHeavyWeight $seatHeavyWeight)
    {
        array_push($this->seatHeavyWeightInstance, $seatHeavyWeight);
    }

    public function getAllSeatsNameJS()
    {
        $jsSeatArray = array();
        foreach ($this->seatHeavyWeightInstance as $seat) {
            array_push($jsSeatArray,$seat->getSeatNumberChar());
        }
        return $jsSeatArray;
    }
}


?>