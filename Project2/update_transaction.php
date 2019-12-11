
<?php
if(!isset($_COOKIE[ 'username' ])){
  echo "<a href='project2.html'> please Log in first</a>";
 //if cookie is not set, a message will show up to sign in first
}


// include "dbconfig.php";
define("IN_CODE", 1);
include "dbconfig.php";

if(isset($_COOKIE[ 'username' ])){ //checks if c
  echo "<a href='logout.php'> User logout</a>";
// echo 'cookie is set';
  echo "<BR>";

$rowsDeleted = 0;
$rowsUpdated = 0;

$dbnamee = "CPS3740_2019S";
    $connect=mysqli_connect($server, $login, $password,  $dbnamee);

    if (!$connect) {
        die('Connect Error (' . mysqli_connect_errno() . ') '
                . mysqli_connect_error());
    }



$size = count($_POST['note']);
$i = 0;
while ($i < $size) {
	$note= $_POST['note'][$i];
	$id = $_POST['mid'][$i];
  $delete = $_POST['delete'][$i];


   if($delete == "delete"){   //if checkbox is checked
    $del = "DELETE from Money_niedzwid where mid = $id";

    if ($connect->query($del) === TRUE) {

      if(mysqli_affected_rows($connect) ){
        echo "<BR>  Deleted Rows -> : $del";
        $rowsDeleted++;
     }


    } else {
        echo "Error deleting record: " . $connect->error; //error deleting message 14e
    }

  } //end of delete call



$sql = "UPDATE Money_niedzwid SET note ='$note' WHERE mid = $id and note !='$note' ";
//now it needs to update the actual note in the database
$sql11 = "UPDATE Money_niedzwid SET note ='$note' WHERE mid = $id and
          note != '(SELECT note from Money_niedzwid where mid = $id )' ";



if ($connect->query($sql) === TRUE ) {

   if(mysqli_affected_rows($connect) ){  //THIS LINE SHOWS ONLY UPDATED ROWS
     echo "<BR>  Updated Rows -> : $sql";  //THIS LINE SHOWS ONLY UPDATED ROWS
     $rowsUpdated++;  //THIS LINE SHOWS ONLY UPDATED ROWS
  }


}//end of $connect->query($sql) === TRUE
 else {
    echo "Error updating record: " . $connect->error; //error deleting message 14e
} //end of commented out

	++$i; //updates counter

} //end of while loops

echo "<br>";
echo "<BR>Updated Rows : $rowsUpdated";
echo "<BR>Deleted Rows : $rowsDeleted";

}//of of cookie checker



  ?>
