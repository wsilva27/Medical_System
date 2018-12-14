CREATE DATABASE MEDICAL4U;
USE MEDICAL4U;

DROP TABLE IF EXISTS Schedules;
DROP TABLE IF EXISTS DoctorLocations;
DROP TABLE IF EXISTS Rooms;
DROP TABLE IF EXISTS Locations;
DROP TABLE IF EXISTS Patients;
DROP TABLE IF EXISTS States;
DROP TABLE IF EXISTS DoctorSpecialties;
DROP TABLE IF EXISTS Doctors;
DROP TABLE IF EXISTS Specialties;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS UserGroups;
DROP TABLE IF EXISTS Departments;
DROP TABLE IF EXISTS BloodTypes;
DROP TABLE IF EXISTS Providers;

CREATE TABLE BloodTypes(
	BLOOD_TYPE_ID	INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	BLOOD_TYPE_NAME VARCHAR(15)
)ENGINE=InnoDB;
    
  
    
CREATE TABLE States (
	STATE_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`CODE` VARCHAR(2) NOT NULL,
    `NAME` VARCHAR(30) NOT NULL
)ENGINE=InnoDB;


CREATE TABLE Locations (
    LOC_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    LOC_NAME VARCHAR(50) NULL,
    CITY VARCHAR(20) NOT NULL,
    STATE_ID INT NOT NULL,
    ADDRESS VARCHAR(30) NOT NULL,
    ZIP VARCHAR(10) NOT NULL,
    FOREIGN KEY FK_LOCATIONS_STATES(STATE_ID) REFERENCES States(STATE_ID)
)ENGINE=InnoDB;


CREATE TABLE Specialties (
    SPECIALTIES_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    SPECIALTIES_NAME VARCHAR(50) NOT NULL
)ENGINE=InnoDB;


CREATE TABLE Doctors (
    DOC_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DOC_NAME VARCHAR(30) NOT NULL,
    SUFFIX VARCHAR(20) NULL,
    DOC_PHONE VARCHAR(15) NOT NULL
)ENGINE=InnoDB;


CREATE TABLE DoctorSpecialties (
	DOC_SPEC_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DOC_ID INT NOT NULL,
    SPECIALTIES_ID INT NOT NULL,
	FOREIGN KEY FK_DOCTORSPECIALTIES_DOCTORS(DOC_ID) REFERENCES Doctors(DOC_ID),
	FOREIGN KEY FK_DOCTORSPECIALTIES_SPECIALTIES(SPECIALTIES_ID) REFERENCES Specialties(SPECIALTIES_ID)
)ENGINE=InnoDB;


CREATE TABLE DoctorLocations (
	DOC_LOC_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DOC_ID INT NOT NULL,
    LOC_ID INT NOT NULL,
	FOREIGN KEY FK_DOCTORLOCATIONS_DOCTORS(DOC_ID) REFERENCES Doctors(DOC_ID),
	FOREIGN KEY FK_DOCTORLOCATIONS_LOCATIONS(LOC_ID) REFERENCES Locations(LOC_ID)
)ENGINE=InnoDB;


CREATE TABLE Rooms (
    ROOM_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    LOC_ID INT NOT NULL,
    ROOM_NUMBER VARCHAR(10) NOT NULL,
	FOREIGN KEY FK_ROOM_LOCATION(LOC_ID) REFERENCES Locations(LOC_ID)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
)ENGINE=InnoDB;


CREATE TABLE Providers (
	PROVIDER_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    PROVIDER  VARCHAR(100) NOT NULL
)ENGINE=InnoDB;


-- DROP TABLE Patients
CREATE TABLE Patients (
    PATIENT_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    PATIENT_NAME VARCHAR(30) NOT NULL,
    PATIENT_DOB DATE NOT NULL,
    PATIENT_BLOOD_TYPE_ID INT NOT NULL,
    ADDRESS VARCHAR(30) NOT NULL,
    CITY VARCHAR(20) NOT NULL,
    STATE_ID	INT NOT NULL,
    ZIP	VARCHAR(10) NOT NULL,
    PHONE VARCHAR(15) NULL,
    EMAIL VARCHAR(255) NULL,
    PROVIDER_ID INT NULL,
    INSURANCE_ID VARCHAR(20) NULL,
    FOREIGN KEY FK_PATIENT_BLOOD_TYPE(PATIENT_BLOOD_TYPE_ID) REFERENCES BloodTypes (BLOOD_TYPE_ID),
    FOREIGN KEY FK_PATIENT_STATE(STATE_ID) REFERENCES States (STATE_ID),
    FOREIGN KEY FK_PATIENT_INSURANCE(PROVIDER_ID) REFERENCES Providers (PROVIDER_ID)
)ENGINE=InnoDB;


CREATE TABLE UserGroups (
	GROUP_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    GROUP_NAME VARCHAR(20) NOT NULL,
    DESCRIPTION VARCHAR(100) NULL
)ENGINE=InnoDB;


CREATE TABLE Departments (
	DEPT_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    DEPT_NAME VARCHAR(50) NOT NULL,
    DESCRIPTION VARCHAR(200) NULL
)ENGINE=InnoDB;


CREATE TABLE Users (
    USER_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    FIRST_NAME VARCHAR(50) NOT NULL,
    LAST_NAME VARCHAR(50) NOT NULL,
    DEPT_ID INT NOT NULL,
    USER_NAME VARCHAR(40) NOT NULL,
    USER_PASSWORD VARCHAR(255) NOT NULL,
    USER_GROUP INT NOT NULL,
	FOREIGN KEY FK_Users_Departments(DEPT_ID) REFERENCES Departments(DEPT_ID),
	FOREIGN KEY FK_Users_UserGroups(USER_GROUP) REFERENCES UserGroups(GROUP_ID)
	ON UPDATE CASCADE
	ON DELETE RESTRICT    
)ENGINE=InnoDB;

-- DROP TABLE Schedules;
CREATE TABLE Schedules (
    SCHEDULE_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	SCHEDULE_DATE DATE NOT NULL,
	SCHEDULE_TIME TIME NOT NULL,    
    PATIENT_ID INT NOT NULL,
    DOC_ID INT NOT NULL,
    ROOM_ID INT NOT NULL,
    SCHEDULE_NOTES VARCHAR(50),
	FOREIGN KEY FK_SCHEDULE_PATIENT(PATIENT_ID) REFERENCES Patients(PATIENT_ID),
	FOREIGN KEY FK_SCHEDULE_DOCTOR(DOC_ID) REFERENCES Doctors(DOC_ID),
	FOREIGN KEY FK_SCHEDULE_ROOM(ROOM_ID) REFERENCES Rooms(ROOM_ID)
    ON UPDATE CASCADE
    ON DELETE RESTRICT
)ENGINE=InnoDB;
