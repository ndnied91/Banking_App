<!-- //http://eve.kean.edu/~niedzwid/CPS3740/ -->
  <a href="logout.php"> User logout</a>
  <title> Project 2</title>

<?php



define("IN_CODE", 1);
include "dbconfig.php";


// $a=5;

$connect=mysqli_connect($server, $login, $password, $dbname);

// $user=$_POST['userName'];
$user = mysqli_real_escape_string($connect, $_POST['userName']);
//added security feature for login

// $pass=$_POST['password'];
$pass = mysqli_real_escape_string($connect, $_POST['password']);
//added security feature for login

$total=0;



////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  //this only runs when cookie is set
  if(isset($_COOKIE[ 'username' ])){
    $id = $_COOKIE[ 'username' ];

$connect=mysqli_connect($server, $login, $password, $dbname);
$searchQuery= "SELECT * from Customers where id = $id ";
$searchResult=mysqli_query($connect, $searchQuery); //makes inital query
$row = mysqli_fetch_array($searchResult);
//
if($searchResult){
    $QRdate = date($row['DOB']); // Bday from database
    $age = date_diff(date_create($QRdate), date_create('now'))->y; //calc for age

    $n = $row['name'];
    $street = $row['street'];
    $city = $row['city'];
    $state = $row['state'];
    $zipcode = $row['zipcode'];

       $ip = $_SERVER['REMOTE_ADDR'];
        $ipARR= explode(".",$ip);

              echo "<br>Your IP: $ip";

              if($ipARR[0] == "10" OR $ipARR[0] == "131.125"){
                  echo "<br>You are from Kean Unversity.<br>";
              }
              else {
               echo "<br>You are NOT from Kean Unversity.<br>";
               echo "<br>";
              }
              echo "Welcome Customer $n";
              echo " <BR> Age is $age ";
              echo "<BR>Address: $street $city $state,  $zipcode ";

              ////need to query now

  $cookieQuery= "SELECT mid, code, type, amount , mydatetime , note from CPS3740_2019S.Money_niedzwid where cid =
                (select id from CPS3740.Customers where name = '$n')";
                //This queries depending on whos signed in
                  $cookieResult = mysqli_query($connect,$cookieQuery);

                  if($cookieResult){
                    echo "<TABLE border=1>\n";

                    echo "<TR>
                    <TD> <strong>ID </strong>
                    <TD> <strong> Code </strong>
                    <TD> <strong> Operation </strong>
                    <TD> <strong> Amount </strong>
                    <TD> <strong> Date Time </strong>
                    <TD> <strong> Note </strong>
                     \n";

                  while($row = mysqli_fetch_array($cookieResult)){
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
                   //end of success query
                  else {
                    echo "error with query";
                  }
     }

     echo"Total balance: $total";
     echo "<BR>";

     $name = $n;
?>
        <form action="add_transaction.php" method="POST" >

            <input type="hidden" name="customer_name"  value='<?php echo "$name";?>'   />
              <input type="hidden" name="customer_balance"  value='<?php echo "$total";?>' />

          <input type="submit" value= "Add Transaction" />

          <a href=" display_update_transaction.php "> Display and Update </a>
        </form>


        <!-- SEARCH FIELD -->
        <form action="search.php" method="GET" >

          <p> Keyword:
              <input type="text" name="keywords" required="required">
              <input type="submit" value= "Search Transaction" />  </p>
        </form>
<?php

     break;
        //nothing else runs after this
  }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//if cookie is not set, this will run and cookie will be set after successful login
$con=mysqli_connect($server, $login, $password, $dbname);

$validator=mysqli_query( $con, "SELECT * FROM Customers WHERE login='$user' AND password='$pass' ")
 or die("Could not execute query: " .mysqli_error($conn));

$row = mysqli_fetch_assoc($validator); //returns an array of strings with fetched credentials
    if($row<1) {
  //VALIDATION FAILED

     $Failvalidator=mysqli_query( $con, "SELECT login FROM Customers WHERE login= '$user' ");
          $Failrow = mysqli_fetch_assoc($Failvalidator);

        if($Failrow['login'] == $user){
          //FOUND USER IN DATABASE

          echo  "Found user $user but password is incorrect";
         echo " <BR><button> <a href='http://eve.kean.edu/~niedzwid/CPS3740/project2.html'> please try again </a> </button> ";
         break;
       } else if ($num==0){
          //UNABLE TO FIND USER IN DATABASE
         echo "No such user $user";
          echo " <BR><button> <a href='http://eve.kean.edu/~niedzwid/CPS3740/project2.html'> please try again </a> </button> ";
          break;
        }
}


else  if ($row['password']==$pass){ //avoiding sql injection

//VALIDATION PASSED

$specificQuery = "SELECT id, name, DOB ,street,city,zipcode from Customers where name like '%$user%' ";
$result = mysqli_query($con,$specificQuery);


//cookies will be set here
$id = $row['id'];
$cookie_name = "username";
$cookie_value = $id;
echo "Cookie value is  $cookie_value";


setcookie($cookie_name, $cookie_value, time() + (3600), "/"); //sets cookie after validation

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

  echo "<BR>Address: $street $city $state,  $zipcode ";

$createdQuery=
"SELECT mid, code, type, amount , mydatetime , note from CPS3740_2019S.Money_niedzwid where cid =
  (select id from CPS3740.Customers where name = '$n')";
  //This queries depending on whos signed in

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


    else {
      echo "<BR>issues with query";
    }
}

echo"Total balance: $total";
echo "<BR>";
// end of successful validation

}

$name = $n; //sets name to be passed into form
?>

<form action="add_transaction.php" method="POST" >

    <input type="hidden" name="customer_name"  value='<?php echo "$name";?>'   />
      <input type="hidden" name="customer_balance"  value='<?php echo "$total";?>' />

  <input type="submit" value= "Add Transaction" />

  <a href=" display_update_transaction.php "> Display and Update </a>
</form>

<!-- SEARCH FIELD -->
<form action="search.php" method="GET" >


  <p> Keyword:
      <input type="text" name="keywords" required="required">
      <input type="submit" value= "Search Transaction" />  </p>
</form>
