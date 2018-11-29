<?php
    session_start();
    require_once "../lib/specialty.php";
    $res = array("data" => specialty\get());
    echo json_encode($res);
?>