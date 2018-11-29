<?php
    session_start();
    require_once "../lib/room.profile.php";
    require_once "../lib/location.php";
    $res = array("data" => room\profile\get($_SESSION['idx']),
                 "locations" => location\get());
    echo json_encode($res);
?>
