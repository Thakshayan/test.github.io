<?php
    include_once 'dbh.inc.php';
class station extends Connection
{
    private $stationId,$stationName;
    private $locationLat,$locationLng;
    private $statinHead;
    public function addNewStation($acc,  $name, $pass, $lat, $lng){
        if ($acc && $name && $pass && $lat && $lng){
            $sql = "SELECT account FROM station WHERE account= ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$acc]);
            $result = $stmt->fetchAll();
            if($result){
                return "! Already station registerd.";
            }
            else{
                $sql = "INSERT INTO station() VALUES(?, ?, ?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$acc, $lat, $lng]);

                $sql = "INSERT INTO usersaccess (user_name,password,name) VALUES(?, ?, ?)";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$acc, $pass, $name]);
                return "success";
            }
        }
    }
    public function viewStations()
        {
            /*send all datas of station from database base*/
            $sql = "SELECT * FROM usersaccess ua, station s WHERE s.account = ua.user_name ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $tabQuery = "";
            foreach ($results as $result) {
                $tabQuery = $tabQuery."<tr>
                <td>".$result['account']."</td>
                <td>".$result['name']."</td>
                <td>".$result['lat']."</td>
                <td>".$result['lng']."</td>
                <td><a href='editStation.php?id=".$result['account']."' class='btn cur-p btn-outline-primary'><i class='mR-10 ti-pencil'></i>Edit</a></td>
                <td><button type='button' class='btn cur-p btn-outline-danger' onclick='deleteStation(\"".$result['account']."\")'><i class='ti-trash'></i></button></td>
                </tr>";
            }
            return $tabQuery;
        }

        public function deleteStation($acc)
        {
            /*delete station from trains' database*/
            $sql = "DELETE usersaccess,station FROM usersaccess INNER JOIN station ON station.account = usersaccess.user_name WHERE usersaccess.user_name = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$acc]);
        }

        public function getStationDetails($acc)
        {
            /*fetch all station details from database*/
            $sql = "SELECT * FROM usersaccess ua, station s WHERE s.account = ua.user_name AND s.account=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$acc]);
            $results = $stmt->fetchAll();
            if($results){
                return $results[0];
            }
        }

        public function returnStationAsOptions(){
            # return all station for select option element..
            $sql = "SELECT account FROM station";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $result = "";
            foreach ($results as $row) {
                $result = $result."<option value='".$row['account']."'>".$row['account']."</option>";
            }
            return $result;
        }

        public function updateStationDetails($acc,  $name, $pass, $lat, $lng)
        {
            # update station details from train schdule
            if($pass == null){
            $query = "UPDATE usersaccess ua 
                    JOIN station s ON (ua.user_name = s.account) 
                    SET ua.name = ?, 
                        s.lat = ?, 
                        s.lng = ? 
                    WHERE ua.user_name = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$name ,$lat ,$lng ,$acc]);
            }
            else{
            $query = "UPDATE usersaccess ua 
                    JOIN station s ON (ua.user_name = s.account) 
                    SET ua.password = ?, 
                        ua.name = ?, 
                        s.lat = ?, 
                        s.lng = ? 
                    WHERE ua.user_name = ?";
            $stmt = $this->connect()->prepare($query);
            $stmt->execute([$pass, $name ,$lat ,$lng ,$acc]);
            }
            return "Successfully Updated";
        }

        public function getNoOFStation()
        {
            # code...
            $stmt = $this->connect()->prepare(" SELECT account FROM station");
            $stmt->execute();

            /* Return number of rows that were deleted */
            return $stmt->rowCount();
        }
}

?>