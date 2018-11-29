<?php
    session_start();
    require_once "../lib/room.php";
    $res = array("data" => room\get());
    echo json_encode($res);
?>