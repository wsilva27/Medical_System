<?php
namespace address;
use PDO;
function get($idx){
    require '../conf/database.php';
    $sql = 'CALL GetAddresses(:idx)';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array('id' => $LOC_ID,
                           'address' => utf8_encode($FULL_ADDRESS));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}
?>