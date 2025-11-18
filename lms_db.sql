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
(1, 'John doe', 'es@gmail.com', 'Hello, world', '2023-02-17 23:39:15'),
(2, 'John doe', 'es@gmail.com', 'Hi', '2023-02-17 23:49:19'),
(3, 'John doe', 'es@gmail.com', 'Hey, ', '2023-02-17 23:49:36');

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
  `student_id` int(11) NOT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(127) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `grade` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `address` varchar(31) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_joined` timestamp NULL DEFAULT current_timestamp(),
  `parent_fname` varchar(127) NOT NULL,
  `parent_lname` varchar(127) NOT NULL,
  `parent_phone_number` varchar(31) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `students` VALUES
(1, 'Som', '$2a$12$NXDNYHSVg8lml.gdQl4yGe9bJzXbq3xb2YPCPofGhmKDgNYLcwppy', 'John', 'Doe', 1, 1, 'California, Los angeles', 'Male', 'abas55@ab.com', '2012-09-12', '2019-12-11 14:16:44', 'Doe', 'Mark', '09393'),
(3, 'Pradip', '$2a$12$NXDNYHSVg8lml.gdQl4yGe9bJzXbq3xb2YPCPofGhmKDgNYLcwppy', 'Abas', 'A.', 2, 1, 'Berlin', 'Male', 'abas@ab.com', '2002-12-03', '2021-12-01 14:16:51', 'dsf', 'dfds', '7979'),
(4, 'jo', '$2a$12$NXDNYHSVg8lml.gdQl4yGe9bJzXbq3xb2YPCPofGhmKDgNYLcwppy', 'John3', 'Doe', 1, 1, 'California, Los angeles', 'Female', 'jo@jo.com', '2013-06-13', '2022-09-10 13:48:49', 'Doe', 'Mark', '074932040'),
(5, 'jo2', '$2a$12$NXDNYHSVg8lml.gdQl4yGe9bJzXbq3xb2YPCPofGhmKDgNYLcwppy', 'Jhon', 'Doe', 1, 1, 'UK', 'Male', 'jo@jo.com', '1990-02-15', '2023-02-12 18:11:26', 'Doe', 'Do', '0943568654');

-- --------------------------------------------------------
-- Table structure for `student_score`
-- --------------------------------------------------------

CREATE TABLE `student_score` (
  `id` int(11) NOT NULL,
  `semester` varchar(100) NOT NULL,
  `year` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `results` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `student_score` VALUES
(1, 'II', 2021, 1, 1, 1, '10 15,15 20,10 10,10 20,30 35'),
(2, 'II', 2023, 1, 1, 4, '15 20,4 5'),
(3, 'I', 2022, 1, 1, 5, '10 20,50 50');

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
(1, 'Koustav', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq.', 'Koustav', 'Singh', 'Garia , Kolkata', '8809224567', 'BSc', 'Male', 'koudtav@gmail.com'),
(2, 'Rajesh', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq', 'Rajesh', 'Kumar', 'Patna, Bihar', '8809224561', 'MSc', 'Male', 'rajesh@mail.com'),
(5, 'Anirban', '$2y$10$yMjnmAzIkNrRzg78cTps3euVLdrEjQ0jN23/RFDT3qlpVrDF/Ivbq.', 'Anirban', 'Bandopadhyay', 'Dhanbad, Jharkhand', '8809224568', 'BTech', 'Male', 'anirban@ab.com'),
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




ALTER TABLE `message` ADD PRIMARY KEY (`message_id`);

ALTER TABLE `setting` ADD PRIMARY KEY (`id`);
ALTER TABLE `students` ADD PRIMARY KEY (`student_id`), ADD UNIQUE KEY `username` (`username`);
ALTER TABLE `student_score` ADD PRIMARY KEY (`id`);



-- Auto increment
ALTER TABLE Admin AUTO_INCREMENT = 1;
ALTER TABLE Instructor AUTO_INCREMENT = 1;
ALTER TABLE COURSE AUTO_INCREMENT = 1;

ALTER TABLE `message` MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `setting` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `students` MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
ALTER TABLE `student_score` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

COMMIT;