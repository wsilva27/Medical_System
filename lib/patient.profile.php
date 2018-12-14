<?php
namespace patient\profile;
use PDO;
function get($idx){
    if($idx != '0'){
        require '../conf/database.php';
        $sql = 'CALL GetPatient(:idx);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
        $res= [
            'id' => $_SESSION['idx'],
            'name' => utf8_encode($PATIENT_NAME),
            'dob' => $PATIENT_DOB,
            'bloodtype' => $PATIENT_BLOOD_TYPE_ID,
            'address' => utf8_encode($ADDRESS),
            'city' => utf8_encode($CITY),
            'state' => utf8_encode($STATE_ID),
            'zip' => utf8_encode($ZIP),
            'phone' => preg_replace('/(\d{3})(\d{3})(\d{4})$/i', '$1) $2-$3', $PHONE),
            'email' => utf8_encode($EMAIL),
            'provider' => utf8_encode($PROVIDER_ID),            
            'insurance' => utf8_encode($INSURANCE_ID)
        ];
        $con = null;
    }else{
        $res= [
            'id' => $_SESSION['idx'],
            'name' => null,
            'dob' => null,
            'bloodtype' => null,
            'address' => null,
            'city' => null,
            'state' => null,
            'zip' => null,
            'phone' => null,
            'email' => null,
            'provider' => null,
            'insurance' => null
        ];
    }
    return $res;
}

function getPatientByName($name){
    require '../conf/database.php';
    $sql = 'CALL GetPatientByName(:name);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array('id' => $PATIENT_ID,
                           'name' => utf8_encode($PATIENT_NAME),
                           'dob' => $PATIENT_DOB,
                           'phone' => preg_replace('/(\d{3})(\d{3})(\d{4})$/i', '$1) $2-$3', $PHONE),
                           'label' => utf8_encode($LABEL));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}


function getPatientByPhone($phone){
    require '../conf/database.php';
    $sql = 'CALL GetPatientByPhone(:phone);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array('id' => $PATIENT_ID,
                           'name' => utf8_encode($PATIENT_NAME),
                           'dob' => $PATIENT_DOB,
                           'phone' => preg_replace('/(\d{3})(\d{3})(\d{4})$/i', '$1) $2-$3', $PHONE),
                           'label' => utf8_encode($LABEL));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}

function post($name, $dob, $bloodtype, $address, $city, $state, $zip, $phone, $email, $provider, $insurance){
    require "../conf/database.php";
    $sql = 'CALL PostPatient(:name, :dob, :bloodtype, :address, :city, :state, :zip, :phone, :email, :provider, :insurance, @idx);';
    $stmt = $con->prepare($sql);
//    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
    $stmt->bindParam(':bloodtype', $bloodtype, PDO::PARAM_INT);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':state', $state, PDO::PARAM_INT);
    $stmt->bindParam(':zip', $zip, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':provider', $provider, PDO::PARAM_INT);
    $stmt->bindParam(':insurance', $insurance, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    extract($row = $con->query("SELECT @idx AS idx")->fetch(PDO::FETCH_ASSOC));
    $res= ["id" => $idx, 'module' => 'post'];
    $con = null;
    return $res;
}


function put($id, $name, $dob, $bloodtype, $address, $city, $state, $zip, $phone, $email, $provider, $insurance){
    require "../conf/database.php";
    $sql = 'CALL PutPatient(:id, :name, :dob, :bloodtype, :address, :city, :state, :zip, :phone, :email, :provider, :insurance);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
    $stmt->bindParam(':bloodtype', $bloodtype, PDO::PARAM_INT);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':state', $state, PDO::PARAM_INT);
    $stmt->bindParam(':zip', $zip, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':provider', $provider, PDO::PARAM_INT);
    $stmt->bindParam(':insurance', $insurance, PDO::PARAM_STR);
    $stmt->execute();
    $res= ['id' => $id, 'module' => 'put'];
    $con = null;
    return $res;
}
?>