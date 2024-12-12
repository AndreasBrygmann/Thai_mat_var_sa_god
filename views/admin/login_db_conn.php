<?php

$servername = "";
$username= "";
$password = "";

$db_name = "249964";

$conn = mysqli_connect($servername, $username, $password, $db_name);

if(!$conn){
    echo "Connection failed!";
}

?>