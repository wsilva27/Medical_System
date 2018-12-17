<?php
namespace schedule\profile;
use PDO;
function get($idx){
    if($idx != '0'){
        require '../conf/database.php';
        $sql = 'CALL GetSchedule(:idx);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
        $res= [
            'id' => $SCHEDULE_ID,
            'scheduledate' => $SCHEDULE_DATE,
            'scheduletime' => $SCHEDULE_TIME,
            'patientid' => $PATIENT_ID,
            'patientname' => $PATIENT_NAME,
            'patientdob' => $PATIENT_DOB,
            'patientphone' => preg_replace('/(\d{3})(\d{3})(\d{4})$/i', '$1) $2-$3', $PHONE),
            'doctorid' => $DOC_ID,
            'doctorname' => $DOC_NAME,
            'location' => $LOC_ID,
            'room' => $ROOM_ID,
            'schedulenotes' => utf8_encode($SCHEDULE_NOTES)
        ];
        $con = null;
    }else{
        $res= [
            'id' => $_SESSION['idx'],
            'scheduledate' => null,
            'scheduletime' => null,
            'patientid' => null,
            'patientname' => null,
            'patientdob' => null,
            'patientphone' => null,
            'doctorid' => null,
            'doctorname' => null,
            'location' => null,
            'room' => null,
            'schedulenotes' => null
        ];
    }
    return $res;
}

function post($patientid, $doctorid, $scheduledate, $scheduletime, $locid, $roomid, $note){
    require "../conf/database.php";
    $sql = 'CALL PostSchedule(:patientid, :doctorid, :scheduledate, :scheduletime, :locid, :roomid, :note, @idx);';
    $stmt = $con->prepare($sql);
//    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':patientid', $patientid, PDO::PARAM_INT);
    $stmt->bindParam(':doctorid', $doctorid, PDO::PARAM_INT);
    $stmt->bindParam(':scheduledate', $scheduledate, PDO::PARAM_STR);
    $stmt->bindParam(':scheduletime', $scheduletime, PDO::PARAM_STR);
    $stmt->bindParam(':roomid', $roomid, PDO::PARAM_INT);
    $stmt->bindParam(':locid', $locid, PDO::PARAM_INT);
    $stmt->bindParam(':note', $note, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    extract($row = $con->query("SELECT @idx AS idx")->fetch(PDO::FETCH_ASSOC));
    $res= ["id" => $idx, 'module' => 'post'];
    $con = null;
    return $res;
}


function put($id, $patientid, $doctorid, $scheduledate, $scheduletime, $locid, $roomid, $note){
    require "../conf/database.php";
    $sql = 'CALL PutSchedule(:id, :patientid, :doctorid, :scheduledate, :scheduletime, :locid, :roomid, :note);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':patientid', $patientid, PDO::PARAM_INT);
    $stmt->bindParam(':doctorid', $doctorid, PDO::PARAM_INT);
    $stmt->bindParam(':scheduledate', $scheduledate, PDO::PARAM_STR);
    $stmt->bindParam(':scheduletime', $scheduletime, PDO::PARAM_STR);
    $stmt->bindParam(':locid', $locid, PDO::PARAM_INT);
    $stmt->bindParam(':roomid', $roomid, PDO::PARAM_INT);
    $stmt->bindParam(':note', $note, PDO::PARAM_STR);
    $stmt->execute();
    $res= ['id' => $id, 'module' => 'put'];
    $con = null;
    return $res;
}
?>