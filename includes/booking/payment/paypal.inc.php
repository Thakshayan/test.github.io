<?php

namespace booking\payment;

class paypal implements payable{
    public function pay():void{
        #make visa payment
        $this->login();
        echo "<script>console.log('paypal')</script>";
    }

    private function login(){
        #login required for the paypal account login
        echo "<script>console.log('paypal login')</script>";
    }
}
?>