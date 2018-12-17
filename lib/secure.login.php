<?php
namespace secure\login;
use PDO;

function set($username_, $password_){
    require '../conf/database.php';
    $sql = 'CALL SetUserLogin(:username, :password);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username_, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password_, PDO::PARAM_STR);
    $stmt->execute();
    if($stmt -> rowCount() > 0){
        extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
        $res = 'success';
        $_SESSION['userid'] = $USER_ID;
        $_SESSION['username'] = $USER_NAME;
        $_SESSION['groupname'] = $GROUP_NAME;
        $_SESSION['firstname'] = $FIRST_NAME;
        $_SESSION['lastname'] = $LAST_NAME;
        $_SESSION['deptname'] = $DEPT_NAME;
    }else{
        $res = 'failure';
        $_SESSION['userid'] = null;
        $_SESSION['username'] = null;
        $_SESSION['groupname'] = null;
        $_SESSION['firstname'] = null;
        $_SESSION['lastname'] = null;
        $_SESSION['deptname'] = null;
    }
    $con = null;
//    return array('username' => $username_, 'password' => $password_);
    return $res;
}

//function post($location, $roomno){
//    require '../conf/database.php';
//    $sql = 'CALL PostRoom(:location, :roomno, @idx);';
//    $stmt = $con->prepare($sql);
//    $stmt->bindParam(':location', $location, PDO::PARAM_INT);
//    $stmt->bindParam(':roomno', $roomno, PDO::PARAM_STR);
//    $stmt->execute();
//    $stmt->closeCursor();
//    extract($row = $con->query('SELECT @idx AS idx')->fetch(PDO::FETCH_ASSOC));
//    $res= [ 'id' => $idx ];
//    $con = null;
//    return $res;
//}
//
//function put($idx, $location, $roomno){
//    require '../conf/database.php';
//    $sql = 'CALL PutRoom(:idx, :location, :roomno);';
//    $stmt = $con->prepare($sql);
//    $stmt->bindParam(':idx', $idx, PDO::PARAM_INT);
//    $stmt->bindParam(':location', $location, PDO::PARAM_INT);
//    $stmt->bindParam(':roomno', $roomno, PDO::PARAM_STR);
//    $stmt->execute();
//    $res = [ 'id' => $idx];
//    $con = null;
//    return $res;
//}
?>