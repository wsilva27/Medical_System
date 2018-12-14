<?php
namespace schedule;
use PDO;
function getSchedules(){
    require '../conf/database.php';
    $sql = 'CALL getSchedules();';
    $stmt = $con->query($sql);
    $count = $stmt->rowCount();
    if($count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array('id' => $SCHEDULE_ID,
                           'patientname' => utf8_encode($PATIENT_NAME),
                           'scheduledate' => $SCHEDULE_DATE,
                           'scheduletime' => $SCHEDULE_TIME,
                           'patientdob' => $PATIENT_DOB,
                           'phone' => preg_replace('/(\d{3})(\d{3})(\d{4})$/i', '$1) $2-$3', $PHONE),
                           'doctorname' => utf8_encode($DOC_NAME),
                           'location' => utf8_encode($LOC_NAME),
                           'roomnumber' => utf8_encode($ROOM_NUMBER));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}
?>