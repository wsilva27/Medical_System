<?php
namespace usergroup;
use PDO;
function get(){
    require "../conf/database.php";
    $sql = 'CALL GetUserGroups();';
    $stmt = $con->query($sql);
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $result[] = [
            "id" => $GROUP_ID,
            "name" => utf8_encode($GROUP_NAME)
        ];
    }
    $con = null;
    return $result;
}
?>