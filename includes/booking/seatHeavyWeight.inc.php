<?php

namespace booking;
/**
 * getFlyweight seat
 */
class SeatFlyweight{

    /**
     * get Seat Number
     */
    public function getSeatNumberChar(int $seatNumber):String
    {
        # eg 28 as 7_0
        $rowVal = intdiv($seatNumber, 4);
        $colVal = ($seatNumber % 4);
        $rowVal = ($colVal == 0) ? $rowVal : ($rowVal + 1) ;
        if ($colVal == 3) {
            $colVal = 4;
        } elseif ($colVal == 0) {
            $colVal = 5;
        }
        
        return "$rowVal"."_"."$colVal";
    }

    /**
     * get Seat Number
     */
    public function getSeatNumberInt():int
    {
        # code...
    }
    
}

class seatHeavyWeight{
    private $seatFlyweight;
    private $seatNumber;
    
    public function __construct($seatNumber)
    {
        $this->seatFlyweight = SeatFactory::getSeat();
        $this->seatNumber = $seatNumber;
    }

    /**
     * get Seat Number
     */
    public function getSeatNumberChar():String
    {
        return $this->seatFlyweight->getSeatNumberChar($this->seatNumber);
    }

    /**
     * get Seat Number
     */
    public function getSeatNumberInt():int
    {
        # code...
    }
}

// Factoru of seat
 class SeatFactory 
 {
     /**
      * @var SeatFlyweight
      */
    private static $seat;

    public static function getSeat()
    {
        // similar to singleton
        if (!self::$seat) {
            self::$seat = new SeatFlyweight;
        }
        return self::$seat;
    }
 }
 