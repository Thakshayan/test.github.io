<?php
    include_once 'includes/dbh.inc.php';
    abstract class User extends Connection{
        public static function logout()
        {
            session_start();
            $endad = $_SESSION['passenger'];
            unset($endad);
            session_destroy();
            header("location:index.php");
        }

        public function changePass($userName, $oldpass, $pass)
        {
            $sql = "SELECT * FROM usersaccess WHERE user_name= ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$userName]);
            $result = $stmt->fetchAll();

            if($result[0]['password'] == $oldpass){
                $updateSql = "UPDATE usersaccess set password=? WHERE user_name=?";
                $stmt1 = $this->connect()->prepare($updateSql);
                $stmt1->execute([$pass, $userName]);
                return "Successfully Updated";
            }
            else{
                return "Old Password is wrong.";
            }
        }
    }
?>