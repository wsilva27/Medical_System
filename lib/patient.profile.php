<?php
namespace patient\profile;
use PDO;
function get($idx){
    if($idx != '0'){
        require "../conf/database.php";
        $sql = 'CALL GetPatient(:idx);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
        $res= [
            "id" => $_SESSION['idx'],
            "name" => utf8_encode($PATIENT_NAME),
            "dob" => $PATIENT_DOB,
            "bloodtype" => $PATIENT_BLOODTYPE_TYPE,
            "address" => utf8_encode($ADDRESS),
            "city" => utf8_encode($CITY),
            "state" => utf8_encode($STATE),
            "zip" => utf8_encode($ZIP),
            "phone" => utf8_encode($PHONE),
            "email" => utf8_encode($EMAIL),
            "pcp" => utf8_encode($PCP),
            "provider" => utf8_encode($INSURANCE)            
        ];
        $con = null;
    }else{
        $res= [
            "userid" => $_SESSION['idx'],
            "name" => null,
            "dob" => null,
            "bloodtype" => null,
            "address" => null,
            "city" => null,
            "state" => null,
            "zip" => null,
            "phone" => null,
            "email" => null,
            "pcp" => null,
            "provider" => null
        ];
    }
    return $res;
}
?>
