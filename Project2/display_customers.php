<?php

// include "dbconfig.php";
define("IN_CODE", 1);
include "dbconfig.php";

 $con=mysqli_connect($server, $login, $password, $dbname);

 if (!$con) {
     die('Connect Error (' . mysqli_connect_errno() . ') '
             . mysqli_connect_error());
 }
     $query = "SELECT Name, id , password, login, gender , DOB, street,city, state, zipcode
                            FROM Customers";
     $result = mysqli_query($con,$query);

     if($result){

       echo "<BR>The following customers are in the database:";
       echo "<TABLE border=1>\n";

             echo "<TR>
             <TD> <strong>ID </strong>
             <TD> <strong> login </strong>
             <TD> <strong> password </strong>
             <TD> <strong> Name </strong>
             <TD> <strong> Gender </strong>
             <TD> <strong> DOB </strong>
             <TD> <strong> Street </strong>
             <TD> <strong> City </strong>
             <TD> <strong> State </strong>
             <TD> <strong> Zipcode </strong>
              \n";

           while($row = mysqli_fetch_array($result)){
             $id = $row['id'];
             $login = $row['login'];
             $password = $row['password'];
             $Name = $row['Name'];
             $gender = $row['gender'];
             $DOB = $row['DOB'];
             $street = $row['street'];
             $city = $row['city'];
             $state = $row['state'];
             $zipcode = $row['zipcode'];

          echo "<TR><TD>$id<TD>$login<TD> $password<TD>$Name<TD>$gender
                      <TD>$DOB<TD>$street<TD>$city<TD>$state<TD>$zipcode
                        \n";



 //end of while loop
 }

 echo "</TABLE>\n";


 /////////end of result success call
     }




?>
