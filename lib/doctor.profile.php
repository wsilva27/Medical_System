<?php
namespace doctor\profile;
use PDO;
function get($idx){
    if($idx != '0'){
        require "../conf/database.php";
        $sql = 'CALL GetDoctor(:idx);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $res= [
            "id" => $idx,
            "name" => utf8_encode($DOC_NAME),
            "suffix" => utf8_encode($SUFFIX),
            "phone" => utf8_encode($DOC_PHONE)
        ];
        $con = null;}
    else{
        $res= [
            "id" => $idx,
            "name" => null,
            "suffix" => null,
            "phone" => null
        ];            
    }
    return $res;
}

function getDoctorByName($name){
    require '../conf/database.php';
    $sql = 'CALL GetDoctorByName(:name);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->rowCount();
    if($count > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array('id' => $DOC_ID,
                           'name' => utf8_encode($DOC_NAME),
                           'label' => utf8_encode($LABEL));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}

function post($id, $doctorname, $suffix, $phoneno, $locations, $specialties){
    require "../conf/database.php";
    $sql = 'CALL PostDoctor(:doctorname, :suffix, :phoneno, :locations, :specialties, @idx);';
    $stmt = $con->prepare($sql);
//    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':doctorname', $doctorname, PDO::PARAM_STR);
    $stmt->bindParam(':suffix', $suffix, PDO::PARAM_STR);
    $stmt->bindParam(':phoneno', $phoneno, PDO::PARAM_STR);
    $stmt->bindParam(':locations', $locations, PDO::PARAM_STR);
    $stmt->bindParam(':specialties', $specialties, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    extract($row = $con->query("SELECT @idx AS idx")->fetch(PDO::FETCH_ASSOC));
    $res= ["id" => $idx, 'module' => 'post'];
    $con = null;
    return $res;
}


function put($id, $doctorname, $suffix, $phoneno, $locations, $specialties){
    require "../conf/database.php";
    $sql = 'CALL PutDoctor(:id, :doctorname, :phoneno, :suffix, :locations, :specialties);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':doctorname', $doctorname, PDO::PARAM_STR);
    $stmt->bindParam(':phoneno', $phoneno, PDO::PARAM_STR);
    $stmt->bindParam(':suffix', $suffix, PDO::PARAM_STR);
    $stmt->bindParam(':locations', $locations, PDO::PARAM_STR);
    $stmt->bindParam(':specialties', $specialties, PDO::PARAM_STR);
    $stmt->execute();
    $res= ['id' => $id, 'module' => 'put'];
    $con = null;
    return $res;
}

?>
