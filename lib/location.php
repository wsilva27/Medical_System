<?php
namespace location;
use PDO;
function get(){
    require '../conf/database.php';
    $sql = 'CALL GetLocations()';
    $stmt = $con->query($sql);
    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array("id" => $ID,
                           "address" => utf8_encode($ADDRESS),
                           "city" => utf8_encode($CITY),
                           "state" => utf8_encode($STATE),
                           "zip" => utf8_encode($ZIP));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}
?>