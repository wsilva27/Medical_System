<?php
$servername = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "MS_CIS";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to create table
    $sql = "CREATE TABLE Locations (
    LOC_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    CITY VARCHAR(30) NOT NULL,
    STATE CHAR(2) NOT NULL,
    ADDRESS VARCHAR(100),
    )";

    $sql = "CREATE TABLE Specialties (
    SPECIALTIES_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    SPECIALTIES_NAME VARCHAR(30) NOT NULL,
    )";

    $sql = "CREATE TABLE Doctors (
    DOC_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    DOC_NAME VARCHAR(30) NOT NULL,
    DOC_PHONE CHAR(11) NOT NULL,
    LOC_ID INT FOREIGN KEY REFERENCES Locations(LOC_ID),
    SPECIALTIES_ID INT FOREIGN KEY REFERENCES Specialties(SPECIALTIES_ID),
    )";

    $sql = "CREATE TABLE Rooms (
    ROOM_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    LOC_ID INT FOREIGN KEY REFERENCES Locations(LOC_ID),
    ROOM_NUMBER INT(6) NOT NULL,
    )";

    $sql = "CREATE TABLE Patients (
    PATIENT_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    PATIENT_NAME VARCHAR(30) NOT NULL,
    PATIENT_DATA_BIRTH DATE NOT NULL,
    PATIENT_BLOOD_TYPE CHAR(10), NOT NULL,
    DOC_ID INT FOREIGN KEY REFERENCES Doctors(DOC_ID),
    )";

    $sql = "CREATE TABLE Schedule (
    SCHEDULE_ID INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    SCHEDULE_DATE DATE NOT NULL,
    PATIENT_ID FOREIGN KEY REFERENCES Patients(PATIENT_ID),
    DOC_ID INT FOREIGN KEY REFERENCES Doctors(DOC_ID),
    ROOM_ID INT FOREIGN KEY REFERENCES Rooms(ROOM_ID),
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table MyGuests created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
