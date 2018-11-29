<?php
    session_start();
    require_once "../lib/user.profile.php";
    require_once "../lib/department.php";
    require_once "../lib/usergroup.php";
    $res = array("data" => user\profile\get($_SESSION['idx']),
                    "departments" => department\get(),
                    "usergroups" => usergroup\get());
    echo json_encode($res);
?>