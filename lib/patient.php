<?php
namespace patient;
use PDO;
function get(){
    require "../conf/database.php";
    $sql = 'CALL GetPatients();';
    $stmt = $con->query($sql);
    $count = $stmt->rowCount();
    if($count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array("patientid" => $PATIENT_ID,
                           "name" => utf8_encode($PATIENT_NAME),
                           "dob" => utf8_encode($PATIENT_DOB),
                           "address" => utf8_encode($ADDRESS),
                           "phone" => utf8_encode($PHONE),
                           "insurance" => utf8_encode($PROVIDER));
        }
    }else{
        $res[] = null;
    }
    $con = null;
    return $res;
}
?>

