<?php
namespace specialty\profile;
use PDO;
function get($idx){
    if($idx != '0'){
        require '../conf/database.php';
        $sql = 'CALL GetSpecialty(:idx);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
        $res= [
            'id' => $idx,
            'name' => utf8_encode($NAME)
        ];
        $con = null;
    }else{
        $res= [
            'id' => $idx,
            'name' => null
        ];
    }
    return $res;
}

function post($name){
    require '../conf/database.php';
    $sql = 'CALL PostSpecialty(:name, @idx);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    extract($row = $con->query('SELECT @idx AS idx')->fetch(PDO::FETCH_ASSOC));
    $res= [ 'id' => $idx ];
    $con = null;
    return $res;
}

function put($idx, $name){
    require '../conf/database.php';
    $sql = 'CALL PutSpecialty(:idx, :name);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->execute();
    $res = [ 'id' => $idx];
    $con = null;
    return $res;
}
?>
