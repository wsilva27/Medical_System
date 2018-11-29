<?php
    session_start();
    require_once "../lib/patient.php";
    $res = array("data" => patient\get());
    echo json_encode($res);
?>