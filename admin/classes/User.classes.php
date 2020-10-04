<?php
    include_once 'includes/dbh.inc.php';
    abstract class User extends Connection{
        // login
        public static function login($userName, $password)
        {
            if ($userName && $password){
                $sql = "SELECT * FROM usersaccess WHERE user_name= ?";
                $stmt = (new parent)->connect()->prepare($sql);
                $stmt->execute([$userName]);
                $pass = $stmt->fetchAll();

                if(!$pass){
                    return "User name is wrong please check";
                }
                else{
                    if($password == $pass[0]['password']){
                        $_SESSION['userRail'] = $userName;
                        $_SESSION['userRailname'] = $pass[0]['name'];
                        $_SESSION['usertype'] = $pass[0]['type'];
                        header("location:home.php");
                        return ;
                    }
                    else{
                        return "Your password or user name is wrong";
                    }
                }
            }
        }
        //end

        public static function logout()
        {
            session_start();
            $endad = $_SESSION['userRail'];
            $endad1 = $_SESSION['userRailname'];
            unset($_SESSION['ntfyPlayed']);
            unset($_SESSION['usertype']);
            unset($endad);
            unset($endad1);
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