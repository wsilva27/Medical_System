<?php

//used to connect to the database
$host = "127.0.0.1:3306";
$db_name = "medical4u";
$username = "root";
$password = "";

try{
    $con = new \PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}catch(PDOException $exception){
    echo "Connection error: $exception->getMessage()";
}
?>