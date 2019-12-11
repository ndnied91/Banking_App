<!-- //http://eve.kean.edu/~niedzwid/CPS3740/ -->

<?php
// include "dbconfig.php";
define("IN_CODE", 1);
include "dbconfig.php";

$a=5;
$user=$_POST['userName'];
$pass=$_POST['password'];
$total=0;


$con=mysqli_connect($server, $login, $password, $dbname);


$validator=mysqli_query( $con, "SELECT * FROM Customers WHERE login='$user' AND password='$pass' ")
 or die("Could not execute query: " .mysqli_error($conn));

$row = mysqli_fetch_assoc($validator); //returns an array of strings with fetched credentials
    if(!$row) {
  //VALIDATION FAILED

     $Failvalidator=mysqli_query( $con, "SELECT login FROM Customers WHERE login= '$user' ");
          $Failrow = mysqli_fetch_assoc($Failvalidator);

        if($Failrow['login'] == $user){
          //FOUND USER IN DATABASE
          echo  "Found user $user but password is incorrect";
         echo " <BR><button> <a href='http://eve.kean.edu/~niedzwid/CPS3740/project1.html'> please try again </a> </button> ";
        } else{
          //UNABLE TO FIND USER IN DATABASE
          echo "Unable to find the user $user in database";
          echo " <BR><button> <a href='http://eve.kean.edu/~niedzwid/CPS3740/project1.html'> please try again </a> </button> ";
        }
}

else {
//VALIDATION PASSED


$specificQuery = "SELECT name, DOB ,street,city,zipcode from Customers where name like '%$user%' ";
$result = mysqli_query($con,$specificQuery);


//cookies will be set here
//
echo "<BR> Succesfully queried data";

if($result){

    $QRdate = date($row['DOB']); // Bday from database
    $age = date_diff(date_create($QRdate), date_create('now'))->y; //calc for age

   $n = $row['name'];
   $street = $row['street'];
   $city = $row['city'];
   $state = $row['state'];
   $zipcode = $row['zipcode'];

//IP CHECKER
          $ip = $_SERVER['REMOTE_ADDR'];
                     $ipARR= explode(".",$ip);

  echo "<br>Your IP: $ip\n";

  if($ipARR[0] == "10" OR $ipARR[0] == "131.125"){
      echo "<br>You are from Kean Unversity.<br>";
  }
  else {
   echo "<br>You are NOT from Kean Unversity.<br>";
  }

  echo "<BR> Welcome Customer $n";
   echo " <BR> Age is $age ";
  //TODO need just the year
  echo "<BR>Address: $street $city $state,  $zipcode ";



    $createdQuery = "SELECT mid, code, type, amount , mydatetime , note from CPS3740_2019S.Money_niedzwid";
    $createdResult = mysqli_query($con,$createdQuery);

    if($createdResult){
      //SUCCESSUL QUERY

      echo "<TABLE border=1>\n";

      echo "<TR>
      <TD> <strong>ID </strong>
      <TD> <strong> Code </strong>
      <TD> <strong> Operation </strong>
      <TD> <strong> Amount </strong>
      <TD> <strong> Date Time </strong>
      <TD> <strong> Note </strong>
       \n";


       while($row = mysqli_fetch_array($createdResult)){
         $id = $row['mid'];
         $code = $row['code'];

         if($op = $row['type']=== 'W'){
           $op = "Withdrawl";
         } else{
           $op = "Deposit";
         }




         if ($amount = $row['amount'] <= 0 ){
                $color= $row['amount']; //sets variable to what color it should be
                $total += $color ;
                    $amount = " <font color ='red'>  $color </font>"; //this works and prints the 5 in red
         }

         else{
            // $amount = $row['amount'];
                $color= $row['amount'];
                $total += $color ;
                    $amount = " <font color ='blue'>  $color </font>"; //this works and prints the 5 in red

         }
         $time = $row['mydatetime'];
         $note = $row['note'];

      echo "<TR>
      <TD>$id
        <TD>$code
          <TD>$op
            <TD>$amount
              <TD>$time
                 <TD>$note
      \n";



   }


echo "</TABLE>\n";
    }
    else{
      echo "<BR>issues with query";
      //ISSUES WITH QUERY
    }
}

echo"Total balance: $total";
//end of successful validation
}

//TODO
//cookies DB05 30

//EXTRA // TODO
// add current date


?>
