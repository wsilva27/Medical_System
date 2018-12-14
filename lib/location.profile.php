<?php
namespace location\profile;
use PDO;
function get($idx){
    if($idx != '0'){
        require '../conf/database.php';
        $sql = 'CALL GetLocation(:idx)';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
        $res= [
            'id' => $idx,
            'name' => utf8_encode($LOC_NAME),
            'address' => utf8_encode($ADDRESS),
            'city' => utf8_encode($CITY),
            'state' => $STATE,
            'zip' => $ZIP
        ];
        $con = null;
    }else{
        $res= [
            'id' => $idx,
            'name' => null,
            'address' => null,
            'city' => null,
            'state' => null,
            'zip' => null
        ];
    }
    return $res;
}

function post($name, $address, $city, $state, $zip){
    require '../conf/database.php';
    $sql = 'CALL PostLocation(:name, :city, :state, :address, :zip, @idx);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':state', $state, PDO::PARAM_INT);
    $stmt->bindParam(':zip', $zip, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    extract($row = $con->query('SELECT @idx AS idx')->fetch(PDO::FETCH_ASSOC));
    $res= [ 'id' => $idx];
    $con = null;
    return $res;
}

function put($idx, $name, $address, $city, $state, $zip){
    require '../conf/database.php';
    $sql = 'CALL PutLocation(:idx, :name, :city, :state, :address, :zip);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':state', $state, PDO::PARAM_INT);
    $stmt->bindParam(':address', $address, PDO::PARAM_STR);
    $stmt->bindParam(':zip', $zip, PDO::PARAM_STR);
    $stmt->execute();
    $res = [ 'id' => $idx];
    $con = null;
    return $res;
}
?>