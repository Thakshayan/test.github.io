<?php
    include_once 'dbh.inc.php';
class Station extends Connection
{
    private $stationId,$stationName;
    private $locationLat,$locationLng;
    private $statinHead;
    
    public static function returnStationAsOptions(){
        # return all station for select option element..
        $sql = "SELECT account FROM station";
        $stmt = (new parent)->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $result = "";
        foreach ($results as $row) {
            $result = $result."<option value='".$row['account']."'>".$row['account']."</option>";

        }
        return $result;
    }
}
?>