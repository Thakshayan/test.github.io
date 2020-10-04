
function validate()
{
  clearInput();
  let cardnumber = document.forms["checkout"]["cardnumber"].value;
  let cvc = document.forms["checkout"]["cvc"].value;
  let contnumber = document.forms["checkout"]["contnumber"].value;
  let email = document.forms["checkout"]["email"].value; 
  let passengerName = document.forms["checkout"]["cusname"].value; 
  let CardholderName = document.forms["checkout"]["cname"].value;
  let day = document.forms["checkout"]["day"].value;
  let month = document.forms["checkout"]["month"].value;
  
  if(CardholderName==""){
    document.getElementById('errcname').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Please enter Cardholder name </small>";
    return false;
  }
  if (day.length==0){
    document.getElementById('errdate').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Please Fill this field </small>";
    return false;
  }
  if (day<=0 || day>12){
    document.getElementById('errdate').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Not valid Month. </small>";
    return false;
  }
  if (month.length==0){
    document.getElementById('errmonth').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Please Fill this field </small>";
    return false;
  }
  if(cvc.toString().length!=3){
    document.getElementById("errcvc").innerHTML ="<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Invalid CVC </small>";
    return false;
  }
  if (cardnumber.toString().split(" ").join("").length !=16){
    document.getElementById('errcnum').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Not Valid Card Number .</small>";
    return false;
  }
  
  if(contnumber.toString().length!=10){
    document.getElementById('errcontnum').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Please enter valid Contact Number </small>";
    return false;
  }
  if(email!=""){
    let email = document.forms["checkout"]["email"].value; 
    let atPosition=email.indexOf("@");  
    let dotPosition=email.lastIndexOf(".");  
    if (atPosition<1 || dotPosition<atPosition+2 || dotPosition+2>=email.length){  
      document.getElementById('erremail').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Please enter valid Email </small>";
      return false;  
  }if(email==""){
    document.getElementById('erremail').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Please enter Email </small>";
    return false;
  }
  if(passengerName==""){
    document.getElementById('errcusname').innerHTML = "<small> <i class='fa fa-info-circle' aria-hidden='true'> </i> Please enter customer name </small>";
    return false;
  }

  }
}
 
  

function clearInput() {
  document.getElementById('errcvc').innerHTML = "";
  document.getElementById('errcnum').innerHTML = "";
  document.getElementById('errcontnum').innerHTML = "";
  document.getElementById('erremail').innerHTML = "";
  document.getElementById('errcname').innerHTML = "";
  document.getElementById('errdate').innerHTML = "";
  document.getElementById('errmonth').innerHTML = "";
}
  