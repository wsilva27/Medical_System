<?php
    session_start();
    require_once "../lib/room.profile.php";

    $id = $_REQUEST['id'];
    $location = $_REQUEST['location'];
    $roomno = $_REQUEST['roomno'];

    if($id == '0'){
        $res = room\profile\post($location, $roomno);
    }else{
        $res = room\profile\put($id, $location, $roomno);
    }
    echo json_encode($res);
?>