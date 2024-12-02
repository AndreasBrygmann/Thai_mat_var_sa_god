<?php

$servername = "127.0.0.1:3306";
$username= "249964";
$password = "gOALipMB";

$db_name = "249964";

$conn = mysqli_connect($servername, $username, $password, $db_name);

if(!$conn){
    echo "Connection failed!";
}

?>