<?php
namespace room;
use PDO;
function get(){
    require '../conf/database.php';
    $sql = 'CALL GetRooms()';
    $stmt = $con->query($sql);
    if($stmt->rowCount() > 0 ){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array('id' => $ID,
                           'location' => utf8_encode($LOCATION),
                           'roomno' => $ROOMNO);
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}
?>