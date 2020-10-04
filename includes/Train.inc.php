<?php
include_once 'dbh.inc.php';
class Train extends Connection
{
    private $stationId,$stationName;
    private $locationLat,$locationLng;
    private $statinHead;

    public static function returnTrainAsOptions(){
        # return all Train as for selection option string
        $sql = "SELECT DISTINCT name from trains";
        $stmt =(new parent)->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $result = "";
        foreach ($results as $row) {
            $result = $result."<option value='".$row['name']."'>".$row['name']."</option>";
        }
        return $result;
    }

    public static function returnLocationOfTrains($trainName)
    {
        # return pariticular train location coordinates
        $sql = "SELECT * FROM station s, trains t WHERE t.name=? AND t.currPos = s.account";
        $stmt =(new parent)->connect()->prepare($sql);
        $stmt->execute([$trainName]);
        $results = $stmt->fetchAll();
        return $results;
    }
}
?>