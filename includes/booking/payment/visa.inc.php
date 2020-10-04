<?php

namespace booking\payment;

class visa implements payable{
    public function pay():void{
        #make visa payment
        echo "<script>console.log('visa')</script>";
    }
}
?>