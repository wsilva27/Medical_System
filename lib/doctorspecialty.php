<?php
namespace doctorspecialty;
use PDO;
function get($idx){
    require "../conf/database.php";
    $sql = 'CALL GetDoctorSpecialties(:idx)';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array("id" => $ID,
                           "name" => utf8_encode($NAME));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}
?>
