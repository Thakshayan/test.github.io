<?php
include 'User.classes.php';
include 'observer.classes.php';
include 'autoloader.inc.php';
    class Admin extends User implements observer{

        public function addNewStation($acc,  $name, $pass, $lat, $lng)
        {
            /*add new station to database if already exists return false*/
            $stationObj = new station();
            return $stationObj->addNewStation($acc,  $name, $pass, $lat, $lng);
        }

        public function viewStations()
        {
            /*send all datas of station from database base*/
            $stationObj = new station();
            return $stationObj->viewStations();
        }

        public function viewComplains()
        {
            # retry all complains detailas to show in table
            $complainObj = new Complain(null,null,null);
            return $complainObj->viewComplains();
        }

        public function deleteComplain($id)
        {
            #.. delete particular complain 
            $complainObj = new Complain(null,null,null);
            $complainObj->deleteComplain($id);
        }

        public function deleteStation($acc)
        {
            /*delete station from trains' database*/
            $stationObj = new station();
            $stationObj->deleteStation($acc);
        }

        public function deleteTrain($acc)
        {
            /*delete station from trains' database*/
            $trainObj = new Train();
            $trainObj->deleteTrain($acc);
        }

        public function deleteSuggestion($deleteid)
        {
            #delete particulare Suggestion in Database
            (new Suggestion)->deleteSuggestion($deleteid);
        }

        public function getStationDetails($acc)
        {
            /*fetch all station details from database*/
            $stationObj = new station();
            return $stationObj->getStationDetails($acc);
        }

        public function getParticularTrainDetails($acc)
        {
            /*fetch all station details from database*/
            $trainObj = new Train();
            return $trainObj->getParticularTrainDetails($acc);
        }

        public function getAllStationAsOptions()
        {
            /*fetch all station details from database*/
            $stationObj = new station();
            return $stationObj->returnStationAsOptions();
        }

        public function updateStationDetails($acc,  $name, $pass, $lat, $lng)
        {
            # change old to new updated details to station return success or failiure
            $stationObj = new station();
            return $stationObj->updateStationDetails($acc,  $name, $pass, $lat, $lng);
        }

        public function addNewTrain($trainID, $trainName, $goStations, $goStationTimes, $returnStations, $returnStationTimes, $gostationpricesarr, $returnstationpricesarr)
        {
            # add new train to database
            $trainObj = new Train();
            return $trainObj->addNewTrain($trainID, $trainName, $goStations, $goStationTimes, $returnStations, $returnStationTimes , $gostationpricesarr, $returnstationpricesarr);
        }

        public function viewTrains()
        {
            # return all trains details to display in table
            $trainObj = new Train();
            return $trainObj->viewTrain();
        }

        public function updateMarkAsRead($updateID)
        {
            # update a complain mark as read
            $complainObj = new Complain(null,null,null);
            $complainObj->updateMarkAsRead($updateID);
        }
        
        public function updateMarkAsSeen()
        {
            # update seen status of complains ...
            $complainObj = new Complain(null,null,null);
            $complainObj->updateMarkAsSeen();
        }

        public static function noOFStations(): int
        {
            # to get total no of Station in Srilanka Railway network
            $stationObj = new station;
            return $stationObj->getNoOFStation();
        }

        public static function noOFTrains(): int
        {
            # to get total no of Trains in Srilanka Railway network
            $TrainObj = new Train;
            return $TrainObj->getNoOFTrains();
        }

        public static function noOFComplains(): int
        {
            # to get total no of Complains in Srilanka Railway network
            $cmpObj = new Complain(NULL,Null,Null);
            return $cmpObj->getNoCmp();
        }

        public static function noOFSuggestions(): int
        {
            # to get total no of Suggestion in Srilanka Railway network
            return Suggestion::getNoSuggestion();
        }

        public function viewSuggestion()
        {
            # return all Details about suggestion as Table Queries
            return (new Suggestion)->viewSuggestionAsTbl();
        }

        // update complain when new complain arrive
        public function update(){
            #....
        }
    }
?>