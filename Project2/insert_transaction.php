<!-- //http://eve.kean.edu/~niedzwid/CPS3740/ -->

  <a href="logout.php"> User logout</a>
  <br>

<?php

define("IN_CODE", 1);
include "dbconfig.php";

// include "dbconfig.php";


if(isset($_COOKIE[ 'username' ])){

$con=mysqli_connect($server, $login, $password, $dbname);
  //COOKIE IS SET, CONTINUE UPDATING

  echo "<br>";

$cid = $_COOKIE['username']; //now we have the id, which we can use to query table and update


  $code=$_POST['code']; //code
  $type=$_POST['type']; //type`
  $amount=$_POST['amount']; //amount

  if($amount <=0){
    echo "Amount can't be negative";
    break;
    //if amount is negative or 0 nothing else part this will run
  }

  //DETERMINES IF ITS NEGATIVE OR POSITIVE
      if ($type === W){
        ($amount = ($amount - 2*$amount));
      }
      else if($type === D){
          $amount=$_POST['amount'];
        }

  $source=$_POST['source_id']; //source (Atm,online,..)

  $note=$_POST['note']; //note

  $total=$_POST['totalBal'];


  $newAmount = $total+$amount ; //THIS WILL BE THE NEW AMOUNT THAT SHOWS UP INSERT PAGE
    if($newAmount <0){
      echo "Error, Customer has $total in the bank, and tried to Withdraw
          $amount. Unable to complete transaction  ";
      break;
    }

// //what gets rendered
// //transaction id
// // code
// //amount
// // type
// // source sid
// //date
// //note
//
// //set query and update

////CHECKERS


///
$check= "SELECT * FROM CPS3740_2019S.Money_niedzwid WHERE code = '$code'  ";
$rs = mysqli_query($con,$check);
$data = mysqli_fetch_array($rs);
if($data) {
    echo "Error adding to database, transaction code already exists <br/>";
} //THIS CHECKS IF CODE ALREADY EXISTS IN DATABASE , IF IT DOES IT DOESNT ADD TO DATABASE


else{
    $sql= "INSERT INTO  CPS3740_2019S.Money_niedzwid (cid,  sid ,code,   type , amount ,mydatetime , note )
    values($cid, $source ,'$code' , '$type' , $amount, CURRENT_TIMESTAMP(), '$note')";
    //inserts after verifying

    $updateresult = mysqli_query($con,$sql);
//check if update is successful or not

    echo "Succesfully completed the transaction";
    echo "<BR>";
    echo " Total is  : $newAmount";
}//end of else clause


/////////////end of success call
} else{
  //IF COOKIE IS NOT SET, HAVE USER RELOG IN
  echo "cookie not set";
}


?>
