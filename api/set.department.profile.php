<?php
    session_start();
    require_once '../lib/department.profile.php';

    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $desc = $_REQUEST['desc'];

    if($id == '0'){
        $res = department\profile\post($name, $desc);
    }else{
        $res = department\profile\put($id, $name, $desc);
    }
    echo json_encode($res);
?>