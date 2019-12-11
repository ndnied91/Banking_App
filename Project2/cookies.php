<?php


$cookie_name = "username";
$cookie_value = 'danny';




setcookie($cookie_name, $cookie_value, time() + (10), "/");

if(isset($_COOKIE[ 'username' ])){
    echo "cookie is set";
}
else{
   echo "Cookie is not set";




}

?>
