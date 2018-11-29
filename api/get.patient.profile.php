<?php
    session_start();
    require_once "../lib/patient.profile.php";
    require_once "../lib/bloodtype.php";
    require_once "../lib/state.php";
    require_once "../lib/insurance.php";
    $res = array("data" => patient\profile\get($_SESSION['idx']),
                 "bloodtypes" => bloodtype\get(),
                 "states" => state\get(),
                 "insurances" => insurance\get());
    echo json_encode($res);
?>