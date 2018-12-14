<?php
namespace insurance;
use PDO;
function get(){
    require "../conf/database.php";
    $sql = 'CALL GetProviders()';
    $stmt = $con->query($sql);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $res[] = array("id" => $PROVIDER_ID,
                       "provider" => utf8_encode($PROVIDER));
    }
    $con = null;
    return $res;
}
?>