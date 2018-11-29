<?php
    session_start();
    require_once "../lib/doctor.php";
    $res = array("data" => doctor\get());
    echo json_encode($res);
?>