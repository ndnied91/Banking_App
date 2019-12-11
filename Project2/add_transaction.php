<!-- //http://eve.kean.edu/~niedzwid/CPS3740/ -->


<?php
// include "dbconfig.php";
define("IN_CODE", 1);
include "dbconfig.php";


$name=$_POST['customer_name']; //saves post request
$total=$_POST['customer_balance']; //saves post request

if(isset($_COOKIE[ 'username' ])){
  session_start(); //session starting for post request variables

  echo '  <a href="logout.php"> User logout</a>';

  if (isset($_POST['customer_name'])) {
   $_SESSION['customer_name'] = $_POST['customer_name']; //this ensures you can refresh the page and post request sticks
   $_SESSION['customer_balance'] = $_POST['customer_balance'];
}
$seshName = isset($_SESSION['customer_name']) ? $_SESSION['customer_name'] : "error ";  ///using sessions saves the post request after refresh
$seshBal = isset($_SESSION['customer_balance']) ? $_SESSION['customer_balance'] : "error";    ///using sessions saves the post request after refresh

  //EVERYTHING SHOULD HAPPEN IN HERE IF COOKIE IS SET PROPERLY

    // echo "cookie value: ";
    // echo $_COOKIE['username'];

  echo "<br><strong> Add Transaction </strong> <br>";
      $seshName;
  echo "<strong> $seshName </strong>";
    $seshBal;
  echo "Current balance is  <strong> $seshBal </strong> <br>";
  //balance is calculated on browser side
?>

<div>
     <form action="insert_transaction.php" method="POST" >
  <input type="hidden" name="customer_name"  value='<?php echo "$name";?>' />


  <p> Transaction Code :  <input type="text" name="code" required="required"> </p>
  <span> Deposit  <input type="radio"        name="type" value="D" required="required"> </span>
  <span> Withdrawl  <input type="radio"      name="type" value="W" required="required"> </span>
  <p> Amount  <input type="text"             name="amount" required="required">  </p>



<!-- SOURCE DECLARATION -->

  <p> Select a Source:
  <select name="source_id" required="required">
    <option> </option>
    <option value="1" required="required">ATM</option>
    <option value="2" required="required">ONLINE</option>
    <option value="3" required="required">Branch</option>
    <option value="4" required="required">Wired</option>
   </select>
  </p>

<p> Note: <input type="text" name="note"> </p>

    <input type="hidden" name="totalBal"  value='<?php echo "$seshBal";?>'  />

    <input type="submit" value= "Submit" />
  </form>

</div>
<!-- WILL TAKE EVERYTHING IN INSERT.PHP AND UPDATE THE DATABASE -->
<?php

}
else{
   echo "Cookie is not set / Please log in first";
   echo'   <p> <a href="http://eve.kean.edu/~niedzwid/CPS3740/project2.html"> Please log in </a> </p>';
   //reject and have user sign in
}



?>
