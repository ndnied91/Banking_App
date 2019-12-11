<?php
// include "dbconfig.php";
define("IN_CODE", 1);
include "dbconfig.php";

if(isset($_COOKIE[ 'username' ])){
  //EVERYTHING SHOULD HAPPEN IN HERE IF COOKIE IS SET PROPERLY
    // echo "cookie value: ";

    $cid = $_COOKIE['username'];
    // $name1 = $_GET['customer_name1'];
    // echo "customer name is $name1";

    $total=0;

    $connect=mysqli_connect($server, $login, $password, $dbname);

    if (!$connect) {
        die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }

    $keyword = $_GET['keywords'];

    //to get the name of the person
    $nameQuery = "SELECT name from CPS3740.Customers where id = $cid";
    $res=mysqli_query($connect, $nameQuery); //makes inital query
    $row = mysqli_fetch_array($res);
    $namename = $row['name'];




    if( $keyword == '*'){ //* checker
      $searchQuery= "SELECT * from CPS3740_2019S.Money_niedzwid where cid = $cid ";  //makes inital query
    }else{
      $searchQuery= "SELECT * from CPS3740_2019S.Money_niedzwid where cid = $cid and note like '%$keyword%' ";
    }


    $searchResult=mysqli_query($connect, $searchQuery);

    $rowcount=mysqli_num_rows($searchResult);

if ($rowcount == 0 ){
  echo "There is no transcations matching the keyword:   <strong>$keyword </strong> " ;
  ///THIS CHECKS IF THERE ARE ANY QUERIES RETURNED
}
 else if ($rowcount >0){
   //IF 1 OR MORE TRANSACTIONS FOUND, THIS WILL RUN

   echo "The transaction in the customer $namename  , ";
   echo "the search result for keywords :  <strong>$keyword </strong> ";
   echo "<br>";
   echo "<br>";

      //TR GOES here
      echo "<TABLE border=1>\n";
      echo "<TR>
      <TD> ID
      <TD> Code
      <TD> Type
      <TD> Amount
      <TD>Source
      <TD>Date Time
      <TD> Note\n" ;
      while ($row = mysqli_fetch_array($searchResult)){ //converts to array

          $transaction_id = $row['mid'];
          $code = $row['code'];

          if($type = $row['type']=== 'W'){
            $type = "Withdrawl";
          } else{
            $type = "Deposit";
          }
/////////////////////////////////////////////

if ($amount = $row['amount'] <= 0 ){
       $color= $row['amount']; //sets variable to what color it should be
        $total += $color ;
           $amount = " <font color ='red'>  $color </font>"; //this works and prints the 5 in red
}

else{
       $color= $row['amount'];
       $total += $color ;
           $amount = " <font color ='blue'>  $color </font>"; //this works and prints the 5 in red

} /////////////////////////////////////////////

          $source = $row['sid'];
              if($source == 1){
                $source = "ATM";
              }
              else if($source == 2){
                $source = "Online";
              }
              else if($source == 3){
                $source = "Branch";
              }
              else{
                $source = "Wired";
              }



          $date = $row['mydatetime'];
          $note = $row['note'];

          echo "<TR> <TD> $transaction_id <TD> $code <TD> $type
              <TD> $amount <TD> $source <TD> $date <TD> $note
                    \n";
      }
 echo "</TABLE>\n";

 echo "Total Balance : $total "; //moved this above curly brace

} /////row count curly brace

} //DONT MESS WITH THIS CURLY BRACE


else { //end of cookie
 echo "Please log in first";
     echo " <BR><button> <a href='http://eve.kean.edu/~niedzwid/CPS3740/project2.html'> Home Page </a> </button> ";
}
?>
