<?php
namespace department\profile;
use PDO;

function get($idx){
    if($idx != '0'){
        require '../conf/database.php';
        $sql = 'CALL GetDepartment(:idx)';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
        $res= [
            'id' => $idx,
            'name' => utf8_encode($NAME),
            'desc' => utf8_encode($DESC)
        ];
        $con = null;
    }else{
        $res= [
            'id' => '0',
            'name' => null,
            'desc' => null
        ];
    }
    return $res;
}

function post($name, $desc){
    require '../conf/database.php';
    $sql = 'CALL PostDepartment(:name, :desc, @idx);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    extract($row = $con->query('SELECT @idx AS idx')->fetch(PDO::FETCH_ASSOC));
    $res= [ 'id' => $idx ];
    $con = null;
    return $res;
}

function put($idx, $name, $desc){
    require '../conf/database.php';
    $sql = 'CALL PutDepartment(:idx, :name, :desc);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':desc', $desc, PDO::PARAM_STR);
    $stmt->execute();
    $res = [ 'id' => $idx];
    $con = null;
    return $res;
}
?>
