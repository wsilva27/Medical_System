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
                           'location' => utf8_encode($LOC_NAME),
                           'address' => utf8_encode($ADDRESS),
                           'roomno' => $ROOMNO);
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}

function getRoomsByLocId($id){
    require '../conf/database.php';
    $sql = 'CALL GetRoomsByLocID(:id)';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount() > 0 ){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array('id' => $ROOM_ID,
                           'roomnumber' => utf8_encode($ROOM_NUMBER));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}
?>