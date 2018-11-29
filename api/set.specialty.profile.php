<?php
    session_start();
    require_once '../lib/specialty.profile.php';

    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];

    if($id == '0'){
        $res = specialty\profile\post($name);
    }else{
        $res = specialty\profile\put($id, $name);
    }
    echo json_encode($res);
?>