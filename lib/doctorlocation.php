<?php
namespace doctorlocation;
use PDO;
function get($idx){
    require "../conf/database.php";
    $sql = 'CALL GetDoctorLocations(:idx)';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array("id" => $LOC_ID,
                           "address" => utf8_encode($ADDRESS));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}

function post($idx, $locationid){
    require "../conf/database.php";
    $sql = 'CALL PostLocationData(:idx, :locationid)';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
    $stmt->bindParam(':locationid', $locationid, PDO::PARAM_STR);
    $stmt->execute();
    $con = null;
    return 'success';  
}
?>