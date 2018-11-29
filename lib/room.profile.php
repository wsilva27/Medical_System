<?php
namespace room\profile;
use PDO;
function get($idx){
    if($idx != '0'){
        require '../conf/database.php';
        $sql = 'CALL GetRoom(:idx);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
        $res= [
            'id' => $idx,
            'location' => $LOCID,
            'roomno' => $ROOMNO
        ];
        $con = null;
    }else{
        $res= [
            'id' => $idx,
            'location' => null,
            'roomno' => null
        ];
    }
    return $res;
}

function post($location, $roomno){
    require '../conf/database.php';
    $sql = 'CALL PostRoom(:location, :roomno, @idx);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':location', $location, PDO::PARAM_INT);
    $stmt->bindParam(':roomno', $roomno, PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    extract($row = $con->query('SELECT @idx AS idx')->fetch(PDO::FETCH_ASSOC));
    $res= [ 'id' => $idx ];
    $con = null;
    return $res;
}

function put($idx, $location, $roomno){
    require '../conf/database.php';
    $sql = 'CALL PutRoom(:idx, :location, :roomno);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
    $stmt->bindParam(':location', $location, PDO::PARAM_INT);
    $stmt->bindParam(':roomno', $roomno, PDO::PARAM_STR);
    $stmt->execute();
    $res = [ 'id' => $idx];
    $con = null;
    return $res;
}
?>