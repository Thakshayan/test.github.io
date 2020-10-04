<?php
include 'User.classes.php';
include 'autoloader.inc.php';

class Passenger extends User
{
    private $name, $accName, $telNo, $address, $dp , $NIC;
    /**
     * @var bookingHistory
     */
    private $bookingHistory;
    /**
     * @var TimeScheduleBuilder
     */
    private static $builder;

    /**
     * @var state for booking part
     */
    private $state;

    public function __construct($name, $accName, $telNo, $address, $dp , $NIC, booking\lookupAvailable $lookupavailable)
    {
        $this->name = $name;
        $this->accName = $accName;
        $this->telNo = $telNo;
        $this->address = $address;
        $this->dp = $dp;
        $this->NIC = $NIC;
        $this->state = $lookupavailable;
    }



    public static function setBuilder(TimeScheduleBuilder $builder): void
    {
        self::$builder = $builder;
    }

    public static function makeComplain($station, $title, $cmp)
    {
        # code.. file a complain 
        $cmp = new Complain($station, $title, $cmp);
        return $cmp->makeComplain();
    }

    public static function getAllTrainAsOptions()
    {
        #fetch all station details from database
        return Train::returnTrainAsOptions();
    }

    public static function getAllStationAsOptions()
    {
        #fetch all station details from database
        return Station::returnStationAsOptions();
    }

    public static function makeSuggestion($title, $suggestion)
    {
        #code.. give suggestion
        $suggestObj = new Suggestion($title, $suggestion);
        return $suggestObj->makeSuggestion();
    }

    public static function getTrainLocation($trainName)
    {
        # return pariticular train location coordinates
        return Train::returnLocationOfTrains($trainName);
    }

    public static function getTrainSchdule($departureStation, $endStation, $departureTime, $endTime)
    {
        # code...
        return self::$builder->produceTimeSchdule($departureStation, $endStation,$departureTime, $endTime); // return collection of tranins with TimeSchdue class
    }

    /**
     * Get the value of builder
     *
     * @return  TimeScheduleBuilder
     */ 
    public static function getBuilder():TimeScheduleBuilder
    {
        return self::$builder;
    }

    /**
     * Sign up new Passenger
     */
    public static function signup($name, $Email, $teleNo, $address, $NIC, $password)
    {
        if ($name && $Email && $teleNo && $address && $NIC && $password){
            $sql = "SELECT accName FROM Passenger WHERE accName= ?";
            $stmt = (new Connection)->connect()->prepare($sql);
            $stmt->execute([$Email]);
            $result = $stmt->fetchAll();
            if($result){
                return "This Email Account is already Exist.";
            }
            else{
                $sql = "INSERT INTO Passenger(accName,name,tel,address,password,dp,NIC) VALUES(?, ?, ?, ?, ?, ?, ?)";
                $stmt = (new Connection)->connect()->prepare($sql);
                if($stmt->execute([$Email, $name, $teleNo, $address, $password, null, $NIC])){
                    return "Sucessfully Registered. \n Goto login";
                }
                else{
                    return "failed to register";
                }
            }
        }
    }

    // Sign in new passenger
    public static function Sigin($userName, $password)
    {
        if ($userName && $password){
            $sql = "SELECT * FROM Passenger WHERE accName= ?";
            $stmt = (new Connection)->connect()->prepare($sql);
            $stmt->execute([$userName]);
            $pass = $stmt->fetchAll();

            if(!$pass){
                return "User name is wrong please check";
            }
            else{
                if($password == $pass[0]['password']){
                    require_once '../includes/booking/state.inc.php';
                    require_once '../includes/booking/lookupAvailable.inc.php';
                    $_SESSION['passenger'] = serialize(new Passenger($pass[0]['name'], $pass[0]['accName'], $pass[0]['tel'], $pass[0]['address'], $pass[0]['dp'], $pass[0]['NIC'], new booking\lookupAvailable));
                    header("location:../");
                    return ;
                }
                else{
                    return "Your password or user name is wrong";
                }
            }
        }
    }
    //end

    /**
     * @return Name
     */
    public function getName():String
    {
        return $this->name;
    }

    /**
     * @return Email Id
     */
    public function getMail():String
    {
        return $this->accName;
    }

    /**
     * @return TelephoneNo
     */
    public function getTeleNo():int
    {
        return $this->telNo;
    }

    /**
     * @return NIC
     */
    public function getNIC():String
    {
        return $this->NIC;
    }

    /**
     * @return Address
     */
    public function getAddress():String
    {
        return $this->address;
    }

    /**
     * @return Profile Path
     */
    public function getDp():String
    {
        return (($this->dp === NULL) ? "dps/avatar.jpg" : $this->dp) ;
    }

    public function getNoOFBH():int
    {
        # return no of Booking for array
        return $this->bookingHistory->getNoOfInvoices();
    }

    public function setBookingHistory():void
    {
        # set His/Her booking History
        $this->bookingHistory = new bookingHistory($this);
        $_SESSION['passenger'] = serialize($this);
    }

    public function haveBookingHistory()
    {
        # return booking history
        return (($this->bookingHistory instanceof bookingHistory) ? true : false );
    }

    public function displayBookingHistory():void
    {
        # print all booking history invoices
        $this->bookingHistory->getInvoiceCards();
    }

    public function setState(booking\state $state):void
    {
        # set State for passenger class Crete state as Object
        $this->state = $state;
    }

    public function getState():booking\state
    {
        return $this->state;
    }

    /**
     * Get the value of bookingHistory
     *
     * @return  bookingHistory
     */ 
    public function getBookingHistory()
    {
        return $this->bookingHistory;
    }

    /**
     * return selected invoice from booking history and set new State
     */
    public function setInvoice($idx):void
    {
        $this->setState($this->bookingHistory->getParticularInvoice($idx));
    }

    /**
     * update details of Passenger
     */
    public function updateDeatails($user, $teleNo, $address, $NIC):String
    {
        $query = "UPDATE passenger   
                  SET  name = ?, tel = ?, address = ?, NIC = ?
                  WHERE accName = ?";
        $stmt = (new Connection)->connect()->prepare($query);
        if($stmt->execute([$user, $teleNo, $address, $NIC, $this->getMail()])){
            $this->setUpdateDetails($user, $teleNo, $address, $NIC);
            $_SESSION['passenger'] = serialize($this);
            return "Sucessfully Updated.";
        }
        else{
            return "Failed to Update details";
        }
    }

    /**
     * Set the value of Other Details
     */ 
    private function setUpdateDetails($user, $teleNo, $address, $NIC):void
    {
        $this->name = $user;
        $this->telNo = $teleNo;
        $this->address = $address;
        $this->NIC = $NIC;
    }

    /**
     * check if email is already exist
     */
    public static function alreadyIdExist($Email):String
    {
        $sql = "SELECT accName FROM Passenger WHERE accName= ?";
        $stmt = (new Connection)->connect()->prepare($sql);
        $stmt->execute([$Email]);
        $result = $stmt->fetchAll();
        if($result){
            return "exist";
        }
        else{
            return "This email is still not registerd.";
        }
    }

    public static function sendCode($user):void
    {
        $to = $user;
        $subject = "Srilanka Railway Password Verification";
        $pin = rand(00000000,99999999);
        $message = '<html><body>';
        $message .= "<h3>Hi $user</h3>
        <h2>Pin Code : ".$pin.".</h2>";
        $message .= '</body></html>';
        $headers = "From: sarves021999@gmail.com";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        mail($to,$subject,$message,$headers);

        $sql = "UPDATE `passenger` 
                SET `pin_code` = ? 
                WHERE `passenger`.`accName` = ?";
        $stmt = (new Connection)->connect()->prepare($sql);
        $stmt->execute([$pin, $user]);
    }

    /**
     * verify forgot password pin code..
     */
    public static function verify(int $pin, $user)
    {
        $sql = "SELECT pin_code FROM passenger WHERE accName= ?";
        $stmt = (new Connection)->connect()->prepare($sql);
        $stmt->execute([$user]);
        $pass = $stmt->fetchAll();
        return (($pass[0]["pin_code"] == $pin) ? TRUE : FALSE );
    }

    /**
     * update password for user
     */
    public static function updatePassword($userId, $password)
    {
        $sql = "UPDATE `passenger` 
        SET `password` = ? 
        WHERE `passenger`.`accName` = ?";
        $stmt = (new Connection)->connect()->prepare($sql);
        if($stmt->execute([$password, $userId])){
            return true;
        }
        else{
            return false;
        }
    }
}
