<?php
    session_start();
    require_once "../lib/specialty.profile.php";
    $res = array("data" => specialty\profile\get($_SESSION['idx']));
    echo json_encode($res);
?>