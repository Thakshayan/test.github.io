<?php
include_once 'dbh.inc.php';
    class Complain extends Connection
    {
        private $station, $titleC, $complain;

        public function __construct($station, $titleC, $complain){
            # build new complain with all details set ....
            parent::__construct();
            $this->station = $station;
            $this->titleC = $titleC;
            $this->complain = $complain;
        }

        public function makeComplain()
        {
            # enter complain record
            $sqls = "INSERT INTO `complains` (`ID`, `station`, `title`, `complain`, `markAsRead`, `seen`, `complainTime`) VALUES (NULL, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
            $stmts = $this->connect()->prepare($sqls);
            $stmts->execute([$this->station, $this->titleC, $this->complain, '0', '0']);
            return "success";
        }
    }
?>