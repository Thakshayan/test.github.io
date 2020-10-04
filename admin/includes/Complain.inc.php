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

        public function viewComplains()
        {
             # send all datas of station from database base ..
            $sql = "SELECT * FROM `complains`";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll();
            $tabQuery = "";
            foreach ($results as $result) {
                $tabQuery = $tabQuery."<tr>
                <td>".$result['ID']."</td>
                <td>".$result['station']."</td>
                <td>".$result['title']."</td>
                <td>".$result['complain']."</td>
                <td>".$result['complainTime']."</td>";
                if ($result['markAsRead']) {
                    $tabQuery = $tabQuery."<td><div class='checkbox checkbox-circle checkbox-info peers ai-c mB-15'><input type='checkbox' class='peer'' checked disabled>
                    <label  class=' peers peer-greed js-sb ai-c'>
                      <span class='peer peer-greed'>Archieved</span>
                    </label>
                  </div></td>";
                }
                else {
                    $tabQuery = $tabQuery."<td><div class='checkbox checkbox-circle checkbox-info peers ai-c mB-15'><input type='checkbox' class='peer'' onclick='markAsRead(\"".$result['ID']."\",\""."complain"."\")'>
                    <label  class=' peers peer-greed js-sb ai-c'>
                      <span class='peer peer-greed'>Archieve this item</span>
                    </label>
                  </div></td>";
                }
                $tabQuery = $tabQuery."<td><button type='button' class='btn cur-p btn-outline-danger' onclick='deleteDetail(\"".$result['ID']."\",\""."complain"."\")'><i class='ti-trash'></i></button></td>
                </tr>";
            }
            return $tabQuery;
        }

        public function deleteComplain($acc)
        {
            /*delete complain from trains' database*/
            $sql = "DELETE FROM complains WHERE ID = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$acc]);
        }

        public function updateMarkAsRead($complainId)
        {
            # update particular complain mark as read or archieved
            $sql = " UPDATE `complains` SET `markAsRead` = '1' WHERE ID = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$complainId]);
        }

        public function getLast3complainAdmin()
        {
          # return last 3 complain from data database to display in header
          $sql = " SELECT * FROM complains
          WHERE seen = '0'  
          ORDER BY id DESC 
          LIMIT 3";
          $stmt = $this->connect()->prepare($sql);
          if($stmt->execute()){
            return $stmt->fetchAll();
          }
        }

        public function countUnseenComplains()
        {
          # return total number of unseen complains yet...
          $stmt = $this->connect()->prepare(" SELECT seen FROM complains WHERE seen = '0'");
          $stmt->execute();

          /* Return number of rows that were deleted */
           return $stmt->rowCount();
        }

        public function updateMarkAsSeen()
        {
          #  update seen status of complains ...
          $sql = " UPDATE `complains` SET `seen` = '1' WHERE seen = ?";
          $stmt = $this->connect()->prepare($sql);
          $stmt->execute(['0']);
        }

        public function getNoCmp()
        {
          # code...
          $stmt = $this->connect()->prepare(" SELECT ID FROM complains");
          $stmt->execute();
          return $stmt->rowCount();
        }
    }
?>