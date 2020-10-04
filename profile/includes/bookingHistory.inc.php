<?php
include_once 'dbh.inc.php';
include '../includes/booking/invoice.inc.php';
class bookingHistory extends Connection
{
    private $invoices = array();

    public function __construct(Passenger $passenger)
    {
        #fetch all booiking cardsand push into one array;
        parent::__construct();
        $sql = "SELECT * FROM booking WHERE B_PassengerId=? ORDER BY b_date DESC ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$passenger->getMail()]);
        $results = $stmt->fetchAll();
        
        foreach ($results as $key => $value) {
            # create new invoices for past booking ...
            array_push($this->invoices, (new booking\invoice($value["B_ID"], $value["trainId"], $value["amount"], $value["paymentMethod"], $value["NoOfSeats"], $value["bookedTime"], $value["b_date"], $value["d_station"], $value["e_station"], $value["contact_no"], $value["whom"], $value["seats"] )));
        }
    }
    
    public function getNoOfInvoices():int
    {
        # return no of invoices 
        return count($this->invoices);
    }

    public function getInvoiceCards()
    {
        # print all invoices as cards
        foreach ($this->invoices as $key => $value) {
            # get all invoices one by one
            echo "<div class='card' onclick='passKeyValue($key)'>
                <div class='face face1'>
                    <div class='content' style='color:white'>
                        <img class='icon' src='images.jpg' width='100px'>
                        <h5>".$value->getB_time()."</h5>
                        <h6>from ".$value->getD_station()." to ".$value->getE_station()."</h6>
                    </div>
                </div>
                <div class='face face2'>
                    <div class='content'>
                        <p>
                            <b>Invoice ID: </b>".$value->getB_ID()."<br>
                            <b>Train: </b>".$value->getTrainID()."<br>
                            <b>No of seats: </b>".$value->getNoOFSeats()."<br>
                            <b>Amount: Rs </b>".$value->getPayment()."<br>
                            <b>Booked On: </b><small>".$value->getReg_time()."</small><br>
                        </p>
                    </div>
                </div>
            </div>";
        }

    }

    public function addNewInvoice(invoice $newInvoice):void
    {
        # add new Invoice into invoice array ...
        array_push($this->invoices, $newInvoice);
    }

    /**
     * return Selected invoice
     */
    public function getParticularInvoice($idx)
    {
        return ($this->invoices[$idx]);
    }

}
?>