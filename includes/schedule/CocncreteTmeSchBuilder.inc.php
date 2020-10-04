<?php
include 'includes/schedule/TimeScheduleBuilder.inc.php';
include 'includes/dbh.inc.php';

/**
 * The Concrete Builder classes follow the Builder interface and provide
 * specific implementations of the building steps. Your program may have several
 * variations of Builders, implemented differently.
 */
class CocncreteTmeSchBuilder extends Connection implements TimeScheduleBuilder
{
    /**
     * @var TimeSchedule
     */
    private $timeSchdule;
    /**
     * All production steps work with the same product instance.
     */
    public function produceTimeSchdule($departureStation, $endStation, $departureTime, $endTime): schedule\TimeSchedule
    {
        # produce time schdule without Time restriction..
        $this->timeSchdule = new schedule\TimeSchedule($departureStation, $endStation, NULL, NULL);
        $sql = "SELECT ID, name from trains";
        $stmt =$this->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        foreach ($results as  $value) {
            $trainID = strtolower($value["ID"]);
            $sqlQ ="SELECT *
            FROM $trainID
            WHERE station IN ('$departureStation','$endStation')
            ORDER BY orderStation";
            $stmtQ =$this->connect()->prepare($sqlQ);
            $stmtQ->execute();
            $trainDetails = $stmtQ->fetchAll();
            if($trainDetails && $stmtQ->rowCount() == 2){
                if ($trainDetails[0]["station"] == $departureStation && $trainDetails[1]["station"] == $endStation) {
                    $amount = explode(",",$trainDetails[1]["ticketPrice"])[$trainDetails[0]["orderStation"] - 1];
                    $this->timeSchdule->addTrain(new schedule\TrainSchdule($trainID, $value["name"],$amount, $trainDetails[0]["arrivalTime"], $trainDetails[1]["arrivalTime"]));
                }
            }
            $trainIDReturn = strtolower($value["ID"])."returns";
            $sqlQ ="SELECT *
            FROM $trainIDReturn
            WHERE station IN ('$departureStation','$endStation')
            ORDER BY orderStation";
            $stmtQ =$this->connect()->prepare($sqlQ);
            $stmtQ->execute();
            $trainDetails = $stmtQ->fetchAll();
            if($trainDetails && $stmtQ->rowCount() == 2){
                if ($trainDetails[0]["station"] == $departureStation && $trainDetails[1]["station"] == $endStation) {
                    $amount = explode(",",$trainDetails[1]["ticketPrice"])[$trainDetails[0]["orderStation"] - 1];
                    $this->timeSchdule->addTrain(new schedule\TrainSchdule($trainID, $value["name"],$amount, $trainDetails[0]["arrivalTime"], $trainDetails[1]["arrivalTime"]));
                }
            }
        }
        return $this->timeSchdule;
    }

}
?>