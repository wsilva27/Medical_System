CREATE DATABASE MEDICAL4U;
USE MEDICAL4U;

INSERT INTO UserGroups (GROUP_NAME, DESCRIPTION)VALUES 
('SysAdmin', 'System Administrator'),
('Admin', 'Administrator'),
('User', 'Employee');


INSERT INTO Departments (DEPT_NAME, DESCRIPTION) VALUES 
('Advanced Practice', 'Take your skills to the next level. Enjoy greater autonomy and opportunity.'),
('Allied Health', 'Make a difference in delivering positive patient outcomes in a variety of clinical disciplines – from rehab and imaging to laboratories and pharmacy and everything in between.'),
('Home Health Aides', 'Help bring our exceptional, compassionate care right to the patient’s home.'),
('Information Technology', 'Drive exciting innovations in advanced clinical and IT systems.'),
('Laboratory', 'Bring your precision, accuracy and skill to the largest lab in metro New York.'),
('Professional / Technical / Support', 'You can provide key support in a wide range of clinical and non-clinical areas like, accounting, HR and marketing to nursing support, housekeeping and maintenance.'),
('Nursing', 'As a cornerstone of the health care team, you’ll offer the very best care to your patients in award winning hospitals and facilities.'),
('Physicians', 'Elevate your practice with some of the world’s most respected and renowned doctors.'),
('Research', 'Discover tomorrow’s medical breakthroughs working at the Feinstein Institute for Medical Research.');


INSERT INTO Users (FIRST_NAME, LAST_NAME, DEPT_ID, USER_NAME, USER_PASSWORD, USER_GROUP) VALUES
('Ted', 'Kim', 4, 'blacksmilez', SHA('1234'), 1),
('Bruce', 'Frederick', 8, 'b.frederick', SHA('1234'), 3),
('Kathleen', 'Gallo', 7, 'k.gallo', SHA('1234'), 3),
('Iris', 'Berman', 6, 'i.berman', SHA('1234'), 2);   


 INSERT INTO STATES (`CODE`, `NAME`) VALUES
('AL', 'Alabama'),
('AK', 'Alaska'),
('AS', 'American Samoa'),
('AZ', 'Arizona'),
('AR', 'Arkansas'),
('CA', 'California'),
('CO', 'Colorado'),
('CT', 'Connecticut'),
('DE', 'Delaware'),
('DC', 'District Of Columbia'),
('FM', 'Federated States Of Micronesia'),
('FL', 'Florida'),
('GA', 'Georgia'),
('GU', 'Guam'),
('HI', 'Hawaii'),
('ID', 'Idaho'),
('IL', 'Illinois'),
('IN', 'Indiana'),
('IA', 'Iowa'),
('KS', 'Kansas'),
('KY', 'Kentucky'),
('LA', 'Louisiana'),
('ME', 'Maine'),
('MH', 'Marshall Islands'),
('MD', 'Maryland'),
('MA', 'Massachusetts'),
('MI', 'Michigan'),
('MN', 'Minnesota'),
('MS', 'Mississippi'),
('MO', 'Missouri'),
('MT', 'Montana'),
('NE', 'Nebraska'),
('NV', 'Nevada'),
('NH', 'New Hampshire'),
('NJ', 'New Jersey'),
('NM', 'New Mexico'),
('NY', 'New York'),
('NC', 'North Carolina'),
('ND', 'North Dakota'),
('MP', 'Northern Mariana Islands'),
('OH', 'Ohio'),
('OK', 'Oklahoma'),
('OR', 'Oregon'),
('PW', 'Palau'),
('PA', 'Pennsylvania'),
('PR', 'Puerto Rico'),
('RI', 'Rhode Island'),
('SC', 'South Carolina'),
('SD', 'South Dakota'),
('TN', 'Tennessee'),
('TX', 'Texas'),
('UT', 'Utah'),
('VT', 'Vermont'),
('VI', 'Virgin Islands'),
('VA', 'Virginia'),
('WA', 'Washington'),
('WV', 'West Virginia'),
('WI', 'Wisconsin'),
('WY', 'Wyoming');


INSERT INTO SPECIALTIES (SPECIALTIES_NAME) VALUES
('Anesthesiology'),
('Cardiothoracic Surgery'),
('Colorectal Surgery'),
('Cosmetic and Reconstructive Surgery'),
('Dermatology'),
('ENT'),
('Emergency Medicine'),
('Family Practice'),
('General Surgery'),
('Gynecologic Oncology'),
('Hand Surgeons'),
('Hip Surgeons'),
('Knee Surgeons'),
('Maternal-Fetal Medicine (MFM)'),
('Neurology'),
('Neurosurgery'),
('Obstetrics & Gynecology (Ob/Gyn)'),
('Ophthalmology'),
('Optometrists'),
('Orthopedic Oncology'),
('Orthopedic Surgery'),
('Pathology'),
('Pediatrics'),
('Physical Medicine and Rehab (PM & R)'),
('Podiatrists'),
('Psychiatry'),
('Psychologists/Counselors'),
('Radiation Oncology'),
('Radiology'),
('Reproductive Endocrinology'),
('Shoulder Surgeons'),
('Spine Surgeons'),
('Sports Medicine'),
('Surgical Endocrinology'),
('Surgical Oncology'),
('Transplant Surgery'),
('Trauma Surgery'),
('Urogynecology'),
('Urology'),
('Vascular Surgery');


INSERT INTO Locations (CITY, STATE_ID, ADDRESS, ZIP) VALUES
('GLEN HEAD', 37, '30 POST STREET', '11545');


INSERT INTO Rooms (LOC_ID, ROOM_NUMBER) VALUES
(1, 1);


INSERT INTO Doctors (DOC_NAME, DOC_PHONE, SUFFIX) VALUES ('Michael Overby', '(516) 569-4709', 'MD');


INSERT INTO DoctorLocations (DOC_ID, LOC_ID) VALUES
(1, 1);


INSERT INTO DoctorSpecialties (DOC_ID, SPECIALTIES_ID) VALUES
(1, 1), (1, 3), (1, 5);

