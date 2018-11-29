<?php
namespace doctor\profile;
use PDO;
function get($idx){
    if($idx != '0'){
        require "../conf/database.php";
        $sql = 'CALL GetDoctor(:idx);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $res= [
            "id" => $idx,
            "name" => utf8_encode($DOC_NAME),
            "suffix" => utf8_encode($SUFFIX),
            "phone" => utf8_encode($DOC_PHONE)
        ];
        $con = null;}
    else{
        $res= [
            "id" => $idx,
            "name" => null,
            "suffix" => null,
            "phone" => null
        ];            
    }
    return $res;
}

    function post($doctorname, $suffix, $phoneno){
        require "../conf/database.php";
        $sql = 'CALL PostDoctor(:doctorname, :phoneno, :suffix, @idx);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':doctorname', $doctorname, PDO::PARAM_STR);
        $stmt->bindParam(':phoneno', $phoneno, PDO::PARAM_STR);
        $stmt->bindParam(':suffix', $suffix, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        $row = $con->query("SELECT @idx AS idx")->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $res= $idx;
        $con = null;
        return $res;
    }

    function put($idx, $doctorname, $suffix, $phoneno){
        require "../conf/database.php";
        $sql = 'CALL PutDoctor(:idx, :doctorname, :phoneno, :suffix);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->bindParam(':doctorname', $doctorname, PDO::PARAM_STR);
        $stmt->bindParam(':phoneno', $phoneno, PDO::PARAM_STR);
        $stmt->bindParam(':suffix', $suffix, PDO::PARAM_STR);
        $stmt->execute();
        $res = $idx;
        $con = null;
        return $res;
    }
?>