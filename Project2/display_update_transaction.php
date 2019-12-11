<!-- //http://eve.kean.edu/~niedzwid/CPS3740/ -->






<?php
// include "dbconfig.php";
define("IN_CODE", 1);
include "dbconfig.php";

if(isset($_COOKIE[ 'username' ])){
    $id = $_COOKIE[ 'username' ];
    echo '  <a href="logout.php"> User logout</a>';
  // echo "COOKIE : $id<BR>";

echo " You can only update <strong> Note </strong> column. ";

$connect=mysqli_connect($server, $login, $password, $dbname);

$updateQuery= "SELECT * from CPS3740_2019S.Money_niedzwid where cid = $id ";
$searchResult=mysqli_query($connect, $updateQuery);


if($searchResult){
      $total = 0;
  // echo "Successful query";
  echo "<TABLE border=1>\n";

  echo "<TR>
  <TD> <strong>ID </strong>
  <TD> <strong> Code </strong>
  <TD> <strong> Amount </strong>
   <TD> <strong> Type </strong>
   <TD> <strong> Source </strong>
  <TD> <strong> Date Time </strong>
  <TD> <strong> Note </strong>
    <TD> <strong> Delete </strong>
   \n";


echo "<form name='form_update' method='post' action='update_transaction.php'>\n";  //everything is done is one form so when you submit everything is done
    $i=0;     //initialies to zero to get index                                        //at one time
  while($row = mysqli_fetch_array($searchResult)){

         $id = "{$row['mid']}<input type='hidden' name='mid[$i]' value={$row['mid']} />"; //shows up perfectly

         $code = $row ['code'];
         // $amount = $row['amount'];
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
            } //end of amount statement

         if($type = $row['type']=== 'W'){
           $type = "Withdrawl";
         } else{
           $type = "Deposit";
         }//end of else statement

         $time = $row['mydatetime'];
         $update = $row['note'];


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



        $note ="<input type='text' size='40' name='note[$i]' value= '$update' style='background-color:yellow' />"; //this can be updated

        $delete = "<input type='checkbox' name='delete[$i]' value='delete'>"; //this can be updated

echo "<TR>
  <TD>$id
    <TD>$code
    <TD>$amount
      <TD>$type
      <TD> $source
         <TD>$time
          <TD>$note
           <TD> $delete
                \n";

$i++; //inceases i
  }//end of while loop
    echo "</TABLE>\n";

    echo "Total balance: $total";
    echo "<BR>";
    echo "<td><input type='submit' value='Update Transaction ' /></td>";
    echo "</form>";



}else{
  echo "Issue with query";
}//end of udpateRow


}
 else{
echo'   <p> <a href="http://eve.kean.edu/~niedzwid/CPS3740/project2.html"> Please log in </a> </p>';

   echo "Please log in first to access this page";
 }





  ?>
