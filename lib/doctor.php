<?php
namespace doctor;
use PDO;
function get(){
    require "../conf/database.php";
    $sql = 'CALL GetDoctors();';
    $stmt = $con->query($sql);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $res[] = array("id" => $DOC_ID,
                       "name" => utf8_encode($DOC_NAME),
                       "phone" => utf8_encode($DOC_PHONE),
                       "addresses" => utf8_encode($ADDRESSES),
                       "specialties" => utf8_encode($SPECIALTIES));
    }
    $con = null;
    return $res;
}
?>