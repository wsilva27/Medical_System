<?php
    session_start();
    require_once "../lib/location.php";
    $res = array("data" => location\get());
    echo json_encode($res);
?>