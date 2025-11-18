-- phpMyAdmin SQL Dump
-- version 5.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `lms_db`;
USE `lms_db`;

-- --------------------------------------------------------
-- Table structure for table `admin`
-- --------------------------------------------------------

CREATE TABLE `Admin` (
  `AdminId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(127) NOT NULL,
  PRIMARY KEY (`AdminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Admin` VALUES
(1, 'Admin', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq', 'LMS', 'Admin'),
(2, 'Test', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq', 'Test', 'Admin');

-- --------------------------------------------------------
-- Table structure for `class`
-- --------------------------------------------------------



-- --------------------------------------------------------
-- Table structure for `message`
-- --------------------------------------------------------

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender_full_name` varchar(100) NOT NULL,
  `sender_email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `message` VALUES
(1, 'Som Ganguly', 'somganguly99@gmail.com', 'Hello, world', '2025-11-17 23:39:15'),
(2, 'Raj Majumdar', 'rajskider@gmail.com', 'Hi', '2025-11-18 01:00:12'),
(3, 'Pradip Adhikary', 'adhikarypradip@gmail.com', 'Hey, ', '2025-11-18 02:05:36');

-- --------------------------------------------------------
-- Table structure for `registrar_office`
-- --------------------------------------------------------



-- --------------------------------------------------------
-- Table structure for `section`
-- --------------------------------------------------------


-- --------------------------------------------------------
-- Table structure for `setting`
-- --------------------------------------------------------

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `current_year` int(11) NOT NULL,
  `current_semester` varchar(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `slogan` varchar(300) NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `setting` VALUES
(1, 2023, 'II', 'Y School', 'Lux et Veritas Light and Truth', 'This is a wider card with supporting text below.');

-- --------------------------------------------------------
-- Table structure for `students`
-- --------------------------------------------------------

CREATE TABLE `students` (
  `StudentId` INT AUTO_INCREMENT PRIMARY KEY,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(31) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `SMail` VARCHAR(100) UNIQUE NOT NULL,
  `SContact` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `students` VALUES
(1, 'Som', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq','Som', 'Ganguly', 'Kolkata,West Bengal', 'Male','somganguly99@gmail.com','8017443971'),
(3, 'Pradip', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq','Pradip', 'Adhikary', 'Hoogly,West Bengal', 'Male','adhikarypradip@ap.com', '9051465292'),
(4, 'Raj', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq','Raj', 'Majumdar', 'Bhopal, Madhya Pradesh', 'Male','rajmaj@mail.com', '9876543210'),
(5, 'Nimit', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq','Nimit', 'Sodhani', 'Newtown, West Bengal', 'Male','nimitsodhani@mail.com', '9123456780');
-- --------------------------------------------------------
-- Table structure for `student_score`
-- --------------------------------------------------------


-- --------------------------------------------------------
-- Table structure for `Instructor` (create first)
-- --------------------------------------------------------
CREATE TABLE `Instructor` (
  `InstructorId` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(127) NOT NULL,
  `address` varchar(255) NOT NULL,
  `IContact` varchar(31) NOT NULL,
  `qualification` varchar(127) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `IMail` varchar(255) NOT NULL,
  PRIMARY KEY (`InstructorId`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `Instructor` (`InstructorId`, `username`, `password`, `fname`, `lname`, `address`, `IContact`, `qualification`, `gender`, `IMail`) VALUES
(1, 'Koustav', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq', 'Koustav', 'Singh', 'Garia , Kolkata', '8809224567', 'BSc', 'Male', 'koudtav@gmail.com'),
(2, 'Rajesh', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq', 'Rajesh', 'Kumar', 'Patna, Bihar', '8809224561', 'MSc', 'Male', 'rajesh@mail.com'),
(5, 'Anirban', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq', 'Anirban', 'Bandopadhyay', 'Dhanbad, Jharkhand', '8809224568', 'BTech', 'Male', 'anirban@ab.com'),
(6, 'test_teacher', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq', 'A', 'Test', 'Teacher', '00000000', 'MSc', 'Male', 't@test.com');

-- --------------------------------------------------------
-- Table structure for `COURSE` (create after Instructor & Admin exist)
-- --------------------------------------------------------
CREATE TABLE `COURSE` (
  `CourseID` int(11) NOT NULL AUTO_INCREMENT,
  `CName` varchar(127) NOT NULL,
  `Credits` int(11) NOT NULL,
  `CDuration` varchar(31) NOT NULL,
  `InstructorId` int(11) DEFAULT NULL,
  `AdminId` int(11) DEFAULT NULL,
  PRIMARY KEY (`CourseID`),
  FOREIGN KEY (InstructorId) REFERENCES Instructor(InstructorId) ON DELETE SET NULL ON UPDATE CASCADE,
  FOREIGN KEY (AdminId) REFERENCES Admin(AdminId) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert courses (omit CourseID because it's AUTO_INCREMENT)
INSERT INTO `COURSE` (`CName`, `Credits`, `CDuration`, `InstructorId`, `AdminId`) VALUES
('Introduction to Programming (C)', 4, '1 Semester', 1, 1),
('Data Structures & Algorithms', 4, '1 Semester', 2, 1),
('Database Management Systems', 4, '1 Semester', 5, 1),
('Operating Systems', 4, '1 Semester', 2, 1),
('Computer Networks', 4, '1 Semester', 2, 1),
('Software Engineering', 3, '1 Semester', 5, 1),
('Algorithms Design & Analysis', 4, '1 Semester', 1, 1),
('Object Oriented Programming (Java)', 4, '1 Semester', 1, 1),
('Web Technologies (HTML/CSS/JS/PHP)', 3, '1 Semester', 2, 1),
('Machine Learning Basics', 3, '1 Semester', 5, 1),
('Artificial Intelligence', 3, '1 Semester', 5, 1);


CREATE TABLE Enrolls_In (
  StudentId INT,
  CourseId INT,
  PRIMARY KEY (StudentId, CourseId),
  FOREIGN KEY (StudentId) REFERENCES students(StudentId)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (CourseId) REFERENCES course(CourseId)
    ON DELETE CASCADE
    ON UPDATE CASCADE
);

INSERT INTO Enrolls_In (StudentId, CourseId) VALUES
(1, 1),  -- Som enrolled in PHP
(1, 2),  -- Som enrolled in Python
(3, 3),  -- Pradip enrolled in DBMS
(4, 1),  -- Raj enrolled in PHP
(4, 3),  -- Raj enrolled in DBMS
(5, 2),  -- Nimit enrolled in Python
(5, 4);  -- Nimit enrolled in Data Structures


CREATE TABLE Quiz (
    QuizId INT AUTO_INCREMENT PRIMARY KEY,

    StudentId INT NOT NULL,
    InstructorId INT NOT NULL,
    CourseId INT NOT NULL,

    Results TEXT NOT NULL,   
    Semester VARCHAR(20) NOT NULL,
    Year VARCHAR(10) NOT NULL,

    FOREIGN KEY (StudentId) REFERENCES Students(StudentId)
        ON DELETE CASCADE ON UPDATE CASCADE,

    FOREIGN KEY (InstructorId) REFERENCES Instructor(InstructorId)
        ON DELETE CASCADE ON UPDATE CASCADE,

    FOREIGN KEY (CourseId) REFERENCES COURSE(CourseId)
        ON DELETE CASCADE ON UPDATE CASCADE
);

INSERT INTO Quiz (StudentId, InstructorId, CourseId, Results, Semester, Year) VALUES
-- Som (ID 1) → Course 1 (Instructor 1)
(1, 1, 1, '88 100, 92 100, 76 80, 90 100', '1', '2025'),

-- Som (ID 1) → Course 2 (Instructor 2)
(1, 2, 2, '75 100, 82 100, 70 80, 88 100, 90 100', '1', '2025'),

-- Pradip (ID 3) → Course 3 (Instructor 5)
(3, 5, 3, '80 100, 78 100, 85 100', '1', '2025'),

-- Raj (ID 4) → Course 1 (Instructor 1)
(4, 1, 1, '90 100, 86 100, 70 80, 88 100', '1', '2025'),

-- Raj (ID 4) → Course 3 (Instructor 5)
(4, 5, 3, '76 100, 84 100, 79 80, 81 100', '1', '2025'),

-- Nimit (ID 5) → Course 2 (Instructor 2)
(5, 2, 2, '92 100, 89 100, 80 80', '1', '2025'),

-- Nimit (ID 5) → Course 4 (Instructor 2)
(5, 2, 4, '70 100, 78 100, 88 100, 82 80', '1', '2025');


ALTER TABLE `message` ADD PRIMARY KEY (`message_id`);

ALTER TABLE `setting` ADD PRIMARY KEY (`id`);
ALTER TABLE `students`  ADD UNIQUE KEY `username` (`username`);




-- Auto increment
ALTER TABLE Admin AUTO_INCREMENT = 1;
ALTER TABLE Instructor AUTO_INCREMENT = 1;
ALTER TABLE COURSE AUTO_INCREMENT = 1;
ALTER TABLE students AUTO_INCREMENT = 1;

ALTER TABLE `message` MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `setting` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;



COMMIT;