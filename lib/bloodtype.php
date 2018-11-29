<?php
namespace bloodtype;
use PDO;
function get(){
    require "../conf/database.php";
    $sql = 'CALL GetBloodTypes()';
    $stmt = $con->query($sql);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $res[] = array("id" => $BLOODTYPE_ID,
                       "bloodtype" => utf8_encode($BLOODTYPE_NAME));
    }
    $con = null;
    return $res;
}
?>