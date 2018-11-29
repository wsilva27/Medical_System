<?php
    session_start();
    require_once '../lib/department.php';
    $res = array('data' => department\get());
    echo json_encode($res);
?>
