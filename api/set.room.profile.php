<?php
    /* 
        API to set data. This is the part for the front-end and back-end interface. 
        Objects passed from the front-end are stored in variables and thrown into the back-end library by Argument.
    */

    /* Start the session */
    session_start();

    /* Add back-end libraries below */
    require_once "../lib/room.profile.php";

    /* 
        transit data objects from front-end(.js) to the library
        call function in a library: [namespace]\[function]
        get() function used to loads data
        set() function used to create sets
        post() function used to save new data
        put() function used to save modified data
    */
    $id = $_REQUEST['id'];
    $location = $_REQUEST['location'];
    $roomno = $_REQUEST['roomno'];

    /* 
        Check whether adding new or modifying existing data to call each function 
        if id is 0, add a new one -> call post() function in lib folder
        if id is not 0, modify a exist one -> call put() function in lib folder
    */
    if($id == '0'){
        $res = room\profile\post($location, $roomno);
    }else{
        $res = room\profile\put($id, $location, $roomno);
    }

    /* Returns the object array in json format. */
    echo json_encode($res);
?>