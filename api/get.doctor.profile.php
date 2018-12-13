<?php
    /* 
        API to get list. This is the part for the front-end and back-end interface. 
        From this point, each back-end library is imported and placed into the array to be delivered to the front-end. 
    */

    /* Start the session */
    session_start();

    /* Add back-end libraries here */
    require_once "../lib/doctor.profile.php";
    require_once "../lib/doctorlocation.php";
    require_once "../lib/address.php";
    require_once "../lib/doctorspecialty.php";
    require_once "../lib/specialtybydocid.php";

    /* 
        request data object from the library and add it to the array 
        call function in a library: [namespace]\[function]
        get() function used to loads data
        set() function used to create sets
        post() function used to save new data
        put() function used to save modified data
    */
    $res = array("data" => doctor\profile\get($_SESSION['idx']),
                 "doctorlocations" => doctorlocation\get($_SESSION['idx']),
                 "locations" => address\get($_SESSION['idx']),
                 "doctorspecialties" => doctorspecialty\get($_SESSION['idx']),
                 "specialties" => specialtybydocid\get($_SESSION['idx']));

    /* Returns the object array in json format. */
    echo json_encode($res);
?>
