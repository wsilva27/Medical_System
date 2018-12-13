<?php
    /* 
        API to get list. This is the part for the front-end and back-end interface. 
        From this point, each back-end library is imported and placed into the array to be delivered to the front-end. 
    */

    /* Start the session */
    session_start();

    /* Add back-end libraries below */
    require_once '../lib/department.profile.php';

    /* 
        transit data objects from front-end(.js) to the library
        call function in a library: [namespace]\[function]
        get() function used to loads data
        set() function used to create sets
        post() function used to save new data
        put() function used to save modified data
    */
    $id = $_REQUEST['id'];
    $name = $_REQUEST['name'];
    $desc = $_REQUEST['desc'];

    /* 
        Check whether adding new or modifying existing data to call each function 
        if id is 0, add a new one -> call post() function in lib folder
        if id is not 0, modify a exist one -> call put() function in lib folder
    */
    if($id == '0'){
        $res = department\profile\post($name, $desc);
    }else{
        $res = department\profile\put($id, $name, $desc);
    }

    /* Returns the object array in json format. */
    echo json_encode($res);
?>