<?php
    session_start();
    require_once "../lib/doctor.profile.php";
    require_once "../lib/doctorlocation.php";
    require_once "../lib/doctorspecialty.php";

    $id = $_SESSION['idx'];
    $doctorname = $_REQUEST['doctorname'];
    $suffix = $_REQUEST['suffix'];
    $phoneno = $_REQUEST['phoneno'];

    //save doctor's basic information
    if($id == '0'){
        $resDoc = doctor\profile\post($doctorname, $suffix, $phoneno);
    }else{
        $resDoc = doctor\profile\put($id, $doctorname, $suffix, $phoneno);
    }

    //save doctor location
    $doctorlocation = $_REQUEST['doctorlocation'];
    $locationid = array();
    foreach($doctorlocation as $location){
        array_push($locationid, $location['id']);
    };
    $resLoc = doctorlocation\post($id, implode(',', $locationid));

    //save doctor specialty
    $doctorspecialty = $_REQUEST['doctorspecialty'];
    $specialtyid = array();
    foreach($doctorspecialty as $specialty){
        array_push($specialtyid, $specialty['id']);
    };
    $resSpec = doctorspecialty\post($id, implode(',', $specialtyid));
    
    
    $res = array('id' => $resDoc,
                 'locations' => $resLoc,
                 'specialty' => $resSpec);
    echo json_encode($res);
?>


	
