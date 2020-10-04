<?php
/**
 * It makes sense to use the Builder pattern only when your products are quite
 * complex and require extensive configuration.
 *
 * Unlike in other creational patterns, different concrete builders can produce
 * unrelated products. In other words, results of various builders may not
 * always follow the same interface.
 */

namespace schedule;
class TimeSchedule
{
    private $startStation, $endStation, $startTime, $endTime;
    private $trains = array();

    public function __construct($startStation, $endStation, $startTime, $endTime)
    {
        $this->startStation = $startStation;
        $this->endStation = $endStation;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function addTrain(TrainSchdule $trainObj): void
    {
        array_push($this->trains, $trainObj);
    }

    public function getNumberOfTrains(): int
    {
        # number of trains which is available for schdule accrding to the Request
        return count($this->trains);
    }

    public function showTrains():String
    {
        # return ad a table to show available trains
        $schduleQry = "";
        foreach ($this->trains as $key => $value) {
            $schduleQry = $schduleQry."
            <tr>
                <td><div><img src='images/trSch.png' class='icon_image' style='margin-right:10px;'>".($key+1)." </div></td>
                <td class='table_head'>".$value->getTrainID()."</td>
                <td class='table_head'>".$value->getTrainName()."</td>
                <td class='table_head'>".$value->getDepatureTime()."</td>
                <td class='table_head'>".$value->getArriveTime()."</td>
                <td class='table_head'>R.s ".$value->getAmount()."</td>
                <td> <button class='button book_button' onclick=getDateModel('".$value->getTrainID()."','".$value->getAmount()."')> Book Now </button> </td>
            </tr>";
        }
        return $schduleQry;
    }

    /**
     * Get the value of startStation
     */ 
    public function getStartStation()
    {
        return $this->startStation;
    }

    /**
     * Get the value of endStation
     */ 
    public function getEndStation()
    {
        return $this->endStation;
    }
}
?>