<?php
namespace user;
use PDO;
function get(){
    require "../conf/database.php";
    $sql = 'CALL GetUsers();';
    $stmt = $con->query($sql);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $res[] = array("USER_ID" => $USER_ID,
                                "FIRST_NAME" => $FIRST_NAME,
                                "LAST_NAME" => utf8_encode($LAST_NAME),
                                "DEPT_NAME" => utf8_encode($DEPT_NAME),
                                "USER_NAME" => utf8_encode($USER_NAME),
                                "GROUP_NAME" => utf8_encode($GROUP_NAME));
    }
    $con = null;
    return $res;
}
?>

