<?php
namespace user\profile;
use PDO;
function get($idx){
    if($idx != '0'){
        require "../conf/database.php";
        $sql = 'CALL GetUser(:idx);';
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
        $stmt->execute();
        extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
        $res= [
            "userid" => $_SESSION['idx'],
            "firstname" => utf8_encode($FIRST_NAME),
            "lastname" => utf8_encode($LAST_NAME),
            "department" => utf8_encode($DEPT_ID),
            "username" => utf8_encode($USER_NAME),
            "usergroup" => utf8_encode($USER_GROUP)
        ];
        $con = null;
    }else{
        $res= [
            "userid" => $_SESSION['idx'],
            "firstname" => null,
            "lastname" => null,
            "department" => null,
            "username" => null,
            "usergroup" => null
        ];
    }
    return $res;
}
?>

