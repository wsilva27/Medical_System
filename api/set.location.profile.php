<?php
    session_start();
    require_once "../lib/location.profile.php";

    $id = $_REQUEST['id'];
    $address = $_REQUEST['address'];
    $city = $_REQUEST['city'];
    $state = $_REQUEST['state'];
    $zip = $_REQUEST['zip'];

    if($id == '0'){
        $res = location\profile\post($address, $city, $state, $zip);
    }else{
        $res = location\profile\put($id, $address, $city, $state, $zip);
    }
    echo json_encode($res);
?>