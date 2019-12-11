
<?php
// include "dbconfig.php";
define("IN_CODE", 1);
include "dbconfig.php";



if (isset($_COOKIE['username'])) {
   unset($_COOKIE['username']);
     setcookie('username', '', time() - 366600, '/'); // empty value and old timestamp

}

?>

<p> <a href="http://eve.kean.edu/~niedzwid/CPS3740/project2.html"> Please log in </a> </p>
