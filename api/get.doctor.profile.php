<?php
    session_start();
    require_once "../lib/doctor.profile.php";
    require_once "../lib/doctorlocation.php";
    require_once "../lib/address.php";
    require_once "../lib/doctorspecialty.php";
    require_once "../lib/specialtybydocid.php";
    $res = array("data" => doctor\profile\get($_SESSION['idx']),
                 "doctorlocations" => doctorlocation\get($_SESSION['idx']),
                 "locations" => address\get($_SESSION['idx']),
                 "doctorspecialties" => doctorspecialty\get($_SESSION['idx']),
                 "specialties" => specialtybydocid\get($_SESSION['idx']));
    echo json_encode($res);
?>
