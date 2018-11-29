<?php
    session_start();
    require_once "../lib/user.php";
    $res = array("data" => user\get());
    echo json_encode($res);
?>