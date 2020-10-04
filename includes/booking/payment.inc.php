<?php
namespace booking;

class payment extends state
{
    /**
     * @var ticketID
     */
    private $t_ID, $Passenger_email, $Passenger_name, $Contact_number, $visa_paypal, $selectedSeats;

    public function __construct($stateDatas)
    {
        $this->setStateData($stateDatas);
    }

    /**
     * set state and make new invoice
     * save new invoice into booking history
     */
    public function nextState($passenger):void
    {
        $stateDatas = $this->getStateDatas();
        $invoiceNew = new invoice($this->t_ID,$stateDatas->getTrain(), $stateDatas->getAmount() * $stateDatas->getNoOfSelectedSeats(), 
        $this->visa_paypal, $stateDatas->getNoOfSelectedSeats(), date("Y-m-d H:i:s"), $stateDatas->getBDate(), $stateDatas->getDstation(), $stateDatas->getEstation(), $this->Contact_number, $this->Passenger_name , $this->selectedSeats);
        $invoiceNew->setPassengerID($this->Passenger_email);
        $passenger->setState($invoiceNew);
        $_SESSION['passenger'] = serialize($passenger);
    }

    public function pay($Passenger_email, $Passenger_name, $Contact_number, $visa_paypal, $passenger)
    {
        # make a payment Visa or Paypal
        if ($visa_paypal == "1") {
            // if it visa make visa payment
            ((new payment\visa)->pay());
        }
        else if($visa_paypal == "0"){
            // if it paypal make visa payment
            ((new payment\paypal)->pay());
        }
        $stateDatas = $this->getStateDatas();
        $x = (new childConnection)->getConnect();
        $sql = "INSERT INTO `booking` (`B_ID`, `B_PassengerId`, `trainId`, `whom`, `contact_no`, `d_station`, `e_station`, `b_date`, `NoOfSeats`, `seats`, `paymentMethod`, `amount`, `b_customerMail`, `bookedTime`) VALUES (NULL, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)";
        $con = $x->prepare($sql);
        if($con->execute([$passenger->getMail(), $stateDatas->getTrain(), $Passenger_name, $Contact_number, $stateDatas->getDstation(), $stateDatas->getEstation(), $stateDatas->getBDate(),  $stateDatas->getNoOfSelectedSeats(), $stateDatas->getSelectedSeat(), $visa_paypal, $stateDatas->getAmount() * $stateDatas->getNoOfSelectedSeats(), $Passenger_email])){
            $this->setOtherDetails($x->lastInsertId(), $Passenger_email, $Passenger_name, $Contact_number, $visa_paypal,  $stateDatas->getSelectedSeat());
            $this->nextState($passenger);
            return TRUE;
        }else {
            return FALSE;
        }
    }

    /**
     * set other details to payment invoice
     */
    private function setOtherDetails(int $t_id, $Passenger_email, $Passenger_name, $Contact_number, $visa_paypal, $selectedSeats):void
    {
        $this->t_ID = $t_id;
        $this->Passenger_email = $Passenger_email;
        $this->Passenger_name = $Passenger_name;
        $this->Contact_number = $Contact_number;
        $this->visa_paypal = $visa_paypal;
        $this->selectedSeats = $selectedSeats;
    }
}

?>