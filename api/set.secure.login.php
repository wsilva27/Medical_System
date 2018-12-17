<?php
    /* 
        API to get list. This is the part for the front-end and back-end interface. 
        From this point, each back-end library is imported and placed into the array to be delivered to the front-end. 
    */

    /* Start the session */
    session_start();

    /* Add back-end libraries here */
    require_once "../lib/secure.login.php";

    /* 
        request data object from the library and add it to the array 
        call function in a library: [namespace]\[function]
        get() function used to loads data
        set() function used to create sets
        post() function used to save new data
        put() function used to save modified data
    */
    $username_ = $_REQUEST['username'];
    $password_ = $_REQUEST['password'];
    $res = array(secure\login\set($username_, $password_));

    /* Returns the object array in json format. */
    echo json_encode($res);
?>