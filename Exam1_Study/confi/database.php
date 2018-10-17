<?php

//used to connect to the database
$host = "localhost:3306";
$db_name = "CIS485";
$username = "root";
$password = "";

try{
    $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}catch(PDOException $exception){
    echo "Connection error: $exception->getMessage()";
}
?>