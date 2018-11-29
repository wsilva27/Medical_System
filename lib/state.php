<?php
namespace state;
use PDO;
function get(){
    require "../conf/database.php";
    $sql = 'CALL GetStates()';
    $stmt = $con->query($sql);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $res[] = [
            "id" => $STATE_ID,
            "code" => utf8_encode($CODE),
            "name" => utf8_encode($NAME)
        ];
    }
    $con=null;
    return $res;
}
?>