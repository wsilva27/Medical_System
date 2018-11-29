<?php
    session_start();
    require_once "../lib/location.profile.php";
    require_once "../lib/state.php";
    $res = array("data" => location\profile\get($_SESSION['idx']),
                 "states" => state\get());
    echo json_encode($res);
?>
