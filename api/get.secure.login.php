<?php
    /* 
        API to get list. This is the part for the front-end and back-end interface. 
        From this point, each back-end library is imported and placed into the array to be delivered to the front-end. 
    */

    /* Start the session */
    session_start();
    /* Returns the object array in json format. */
    echo json_encode(array('userid' => $_SESSION['userid'],
                           'username' => $_SESSION['username'],
                           'groupname' => $_SESSION['groupname'],
                           'firstname' => $_SESSION['firstname'],
                           'lastname' => $_SESSION['lastname'],
                           'deptname' => $_SESSION['deptname']));
?>