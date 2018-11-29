<?php
namespace department;
use PDO;
function get(){
    require '../conf/database.php';
    $sql = 'CALL GetDepartments()';
    $stmt = $con->query($sql);
    if($stmt->rowCount() > 0){
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $res[] = array('id' => $ID,
                           'name' => utf8_encode($NAME),
                           'desc' => utf8_encode($DESC));
        }
    }else{
        $res = null;
    }
    $con = null;
    return $res;
}
?>
