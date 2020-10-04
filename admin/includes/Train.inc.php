<?php
    include_once 'dbh.inc.php';
class Train extends Connection
{
    private $trainId;
    private $trainName;
    private $goSchedule = array();
    private $returnsSchedule = array();
    

    private function isAlreadyExist($trainID){
        /*Check if already registerd 
        train or not */
        $sql = "SELECT ID FROM trains WHERE ID= ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$trainID]);
        $result = $stmt->fetchAll();
        if($result){
            return TRUE;
        }
        else{
            return false;
        }
    }
    public function addNewTrain($trainID, $trainName, $goStations, $goStationTimes, $returnStations, $returnStationTimes, $gostationpricesarr, $returnstationpricesarr){
        /* add new 
            train to database
        */
        if($this->isAlreadyExist($trainID)){
            return "! Already station registerd.";
        }
        else{
            # INSERT INTO THE TRAINS table
            $sql = "INSERT INTO `trains` (`ID`, `name`, `travel`) VALUES (?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$trainID , $trainName, "0"]);

            #create time table for particular train
            $sql1 = "CREATE TABLE $trainID ( 
                `orderStation` INT NOT NULL AUTO_INCREMENT , 
                `station` VARCHAR(100) NOT NULL , 
                `ticketPrice` VARCHAR(300) NULL , 
                `arrivalTime` TIME NOT NULL , PRIMARY KEY (`orderStation`)) ENGINE = MyISAM;";
            $stmt1 = $this->connect()->prepare($sql1);
            $stmt1->execute();

            #create returntime table for particular train
            $trainIDReturns = $trainID."returns";
            $sql2 = "CREATE TABLE $trainIDReturns ( 
                `orderStation` INT NOT NULL AUTO_INCREMENT , 
                `station` VARCHAR(100) NOT NULL , 
                `ticketPrice` VARCHAR(300) NULL , 
                `arrivalTime` TIME NOT NULL , PRIMARY KEY (`orderStation`)) ENGINE = MyISAM;";
            $stmt2 = $this->connect()->prepare($sql2);
            $stmt2->execute();

           foreach ($goStations as $idx => $val) {
            $sqls = "INSERT INTO `$trainID` (`station`, `arrivalTime`, `ticketPrice`) VALUES (?, ?, ?)";
            $stmts = $this->connect()->prepare($sqls);
            $stmts->execute([$val , $goStationTimes[$idx], $gostationpricesarr[$idx] ]);
           }

           foreach ($returnStations as $idx => $val) {
            $sqls = "INSERT INTO `$trainIDReturns` (`station`, `arrivalTime`, `ticketPrice`) VALUES (?, ?, ?)";
            $stmts = $this->connect()->prepare($sqls);
            $stmts->execute([$val , $returnStationTimes[$idx], $returnstationpricesarr[$idx] ]);
           }

            return "success";
        }
       
    }

    public function viewTrain()
    {
        /* return all train deltails to show in table*/
        $sql = "SELECT * FROM trains ";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $tabQuery = "";
            foreach ($results as $result) {
                $tabQuery = $tabQuery."<tr>
                <td>".$result['ID']."</td>
                <td>".$result['name']."</td>
                <td><a href='editTrain.php?id=".$result['ID']."' class='btn cur-p btn-outline-primary'><i class='mR-10 ti-pencil'></i>Edit</a></td>
                <td><button type='button' class='btn cur-p btn-outline-danger' onclick='deleteStation(\"".$result['ID']."\")'><i class='ti-trash'></i></button></td>
                </tr>";
            }
            return $tabQuery;
    }


    public function deleteTrain($deleteid)
    {
         /*delete trains from trains' database*/
         $deleteidReturns = $deleteid."returns";
         $sql = "DROP TABLE `$deleteid`, `$deleteidReturns`;";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute();

         $sql2 = "DELETE FROM `trains` WHERE ID = ?";
         $stmt2 = $this->connect()->prepare($sql2);
         $stmt2->execute([$deleteid]);
    }

    public function getParticularTrainDetails($trainID)
    {
        # Get all datas from  database 
        $sql = "SELECT * FROM `trains` WHERE ID =?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$trainID]);
        $results = $stmt->fetchAll();
        
        if ($results) {
            $this->trainId = $results[0]['ID'];
            $this->trainName = $results[0]['name'];
            $returnName = $trainID."returns";
            $sql2 = "SELECT * FROM `$trainID` ORDER BY orderStation";
            $stmt2 = $this->connect()->prepare($sql2);
            $stmt2->execute();
            $goSchs = $stmt2->fetchAll();
            foreach ($goSchs as $goSch) {
                $stationAndTime = array($goSch['station'], $goSch['arrivalTime'], $goSch['ticketPrice']);
                array_push($this->goSchedule, $stationAndTime);
            }

            $sql3 = "SELECT * FROM `$returnName` ORDER BY orderStation";
            $stmt3 = $this->connect()->prepare($sql3);
            $stmt3->execute();
            $returSchs = $stmt3->fetchAll();
            foreach ($returSchs as $returSch) {
                $stationAndTime = array($returSch['station'], $returSch['arrivalTime'], $returSch['ticketPrice']);
                array_push($this->returnsSchedule, $stationAndTime);
            }
            return $this;
        } else {
            return false;
        }
    }

    public function updateTrain($acc, $trainName, $goStations, $goStationTimes, $returnStations, $returnStationTimes,  $gostationpricesarr, $returnstationpricesarr)
    {
        # update particular train in database like schdule and name
        $query = "UPDATE trains   
                  SET  name = ?
                  WHERE ID = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$trainName, $acc]);

        # empty all table from database
        $trainIDReturns = $acc."returns";
        $sqlTruncate = "TRUNCATE `$acc`";
        $sqlTruncate2 = "TRUNCATE `$trainIDReturns`";
        $stmtT = $this->connect()->prepare($sqlTruncate);
        $stmtT2 = $this->connect()->prepare($sqlTruncate2);
        $stmtT->execute();
        $stmtT2->execute();

        # re insert all data to database
        foreach ($goStations as $idx => $val) {
            $sqls = "INSERT INTO `$acc` (`station`, `arrivalTime`, `ticketPrice`) VALUES (?, ?, ?)";
            $stmts = $this->connect()->prepare($sqls);
            $stmts->execute([$val , $goStationTimes[$idx], $gostationpricesarr[$idx] ]);
           }

        foreach ($returnStations as $idx => $val) {
            $sqls = "INSERT INTO `$trainIDReturns` (`station`, `arrivalTime`, `ticketPrice`) VALUES (?, ?, ?)";
            $stmts = $this->connect()->prepare($sqls);
            $stmts->execute([$val , $returnStationTimes[$idx], $returnstationpricesarr[$idx] ]);
        }
        return "Updated";
    }
    
    public function updateTrainLocation(stationHead $staionhead , $trainID, $mood)
    {
        
        # update current position of the train
        date_default_timezone_set("Asia/Colombo");
        $query = "UPDATE trains   
                  SET  currPos = ?, travel = ?, arrivalTime = ?
                  WHERE ID = ?";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute([$staionhead->getAccountName(), $mood, date('Y-m-d H:i:s'), $trainID]);
        return "success";
    }

    public function getAllTrainAsOption()
    {
        # return all Train as for selection option string
        $sql = "SELECT ID FROM trains";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $result = "";
        foreach ($results as $row) {
            $result = $result."<option value='".$row['ID']."'>".$row['ID']."</option>";
        }
        return $result;
    }

    /**
     * Get the value of trainId
     */ 
    public function getTrainId()
    {
        return $this->trainId;
    }

    /**
     * Set the value of trainId
     *
     * @return  self
     */ 

    /**
     * Get the value of trainName
     */ 
    public function getTrainName()
    {
        return $this->trainName;
    }

    /**
     * Set the value of trainName
     *
     * @return  self
     */ 

    /**
     * Get the value of goSchedule
     */ 
    public function getGoSchedule()
    {
        return $this->goSchedule;
    }

    /**
     * Get the value of returnsSchedule
     */ 
    public function getReturnsSchedule()
    {
        return $this->returnsSchedule;
    }

    public function getNoOFTrains()
    {
        # code...
        $stmt = $this->connect()->prepare(" SELECT ID FROM trains");
        $stmt->execute();

        /* Return number of rows that were deleted */
        return $stmt->rowCount();
    }
}

?>