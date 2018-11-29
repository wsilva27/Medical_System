<?php
    session_start();
    require_once '../lib/department.profile.php';
    $res = array('data' => department\profile\get($_SESSION['idx']));
    echo json_encode($res);
?>