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

function isAvailable($username_){
    require "../conf/database.php";
    $sql = 'CALL IsAvailableUserName(:username);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username_, PDO::PARAM_STR);
    $stmt->execute();
    extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
    $res= [
        "isavailable" => utf8_encode($IS_AVAILABLE)
    ];
    $con = null;
    return $res;
}

function matchPassword($username_, $pwd){
    require "../conf/database.php";
    $sql = 'CALL MatchPassword(:username, :pwd);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':username', $username_, PDO::PARAM_STR);
    $stmt->bindParam(':pwd', $pwd, PDO::PARAM_STR);
    $stmt->execute();
    extract($row = $stmt->fetch(PDO::FETCH_ASSOC));
    $res= [
        "matchpassword" => utf8_encode($IS_MATCH)
    ];
    $con = null;
    return $res;
}

function post($firstname, $lastname, $deptid, $username_, $usergroup){
    require '../conf/database.php';
    $sql = 'CALL PostUser(:firstname, :lastname, :deptid, :username, :usergroup, @idx);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':deptid', $deptid, PDO::PARAM_INT);
    $stmt->bindParam(':username', $username_, PDO::PARAM_STR);
    $stmt->bindParam(':usergroup', $usergroup, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
    extract($row = $con->query('SELECT @idx AS idx')->fetch(PDO::FETCH_ASSOC));
    $res= [ 'id' => $idx ];
    $con = null;
    return $res;
}

function put($id, $firstname, $lastname, $deptid, $username_, $usergroup){
    require '../conf/database.php';
    $sql = 'CALL PutUser(:id, :firstname, :lastname, :deptid, :username, :usergroup);';
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindParam(':deptid', $deptid, PDO::PARAM_INT);
    $stmt->bindParam(':username', $username_, PDO::PARAM_STR);
    $stmt->bindParam(':usergroup', $usergroup, PDO::PARAM_INT);
    $stmt->execute();
    $res = [ 'id' => $id];
    $con = null;
    return $res;
}
?>

