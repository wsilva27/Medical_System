<?php
    /* 
        API to get list. This is the part for the front-end and back-end interface. 
        From this point, each back-end library is imported and placed into the array to be delivered to the front-end. 
    */

    /* Start the session */
    session_start();
    $_SESSION['username'] = null;
    $_SESSION['groupname'] = null;
    $_SESSION['firstname'] = null;
    $_SESSION['lastname'] = null;
    $_SESSION['deptname'] = null;
    /* Returns the object array in json format. */
    echo json_encode('removed');
?>