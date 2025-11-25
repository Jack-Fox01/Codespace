-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 25, 2025 at 05:13 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `College`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentID` varchar(20) NOT NULL,
  `departmentName` varchar(100) NOT NULL,
  `departmentPhone` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentID`, `departmentName`, `departmentPhone`) VALUES
('COMP01', 'Computing', 123456789);

-- --------------------------------------------------------

--
-- Table structure for table `Enrolement`
--

CREATE TABLE `Enrolement` (
  `enrolementID` varchar(40) NOT NULL,
  `studentID` varchar(20) NOT NULL,
  `moduleID` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturerID` varchar(20) NOT NULL,
  `lecturerFullname` varchar(100) NOT NULL,
  `lecturerEmail` varchar(100) NOT NULL,
  `departmentID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer`
--

INSERT INTO `lecturer` (`lecturerID`, `lecturerFullname`, `lecturerEmail`, `departmentID`) VALUES
('DOE123', 'John Doe', 'JDOE@gmail.com', 'COMP01');

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_module`
--

CREATE TABLE `lecturer_module` (
  `lecturer_module_ID` varchar(20) NOT NULL,
  `moduleID` varchar(20) NOT NULL,
  `lecturerID` varchar(20) NOT NULL,
  `year_of_delivery` int(11) NOT NULL,
  `semester` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lecturer_module`
--

INSERT INTO `lecturer_module` (`lecturer_module_ID`, `moduleID`, `lecturerID`, `year_of_delivery`, `semester`) VALUES
('COMPUTING', 'RD101', 'DOE123', 2024, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Module`
--

CREATE TABLE `Module` (
  `moduleID` varchar(20) NOT NULL,
  `moduleName` varchar(40) NOT NULL,
  `moduleDescription` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Module`
--

INSERT INTO `Module` (`moduleID`, `moduleName`, `moduleDescription`) VALUES
('M0567', 'Relational Databases', 'Course about databases');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentID` varchar(20) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `studentEmail` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentID`, `surname`, `firstname`, `studentEmail`) VALUES
('EC1234', 'Panagiotis', 'Marios', 'mp@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentID`);

--
-- Indexes for table `Enrolement`
--
ALTER TABLE `Enrolement`
  ADD PRIMARY KEY (`enrolementID`),
  ADD KEY `studentID` (`studentID`),
  ADD KEY `moduleID` (`moduleID`);

--
-- Indexes for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturerID`),
  ADD KEY `departmentID` (`departmentID`);

--
-- Indexes for table `lecturer_module`
--
ALTER TABLE `lecturer_module`
  ADD PRIMARY KEY (`lecturer_module_ID`);

--
-- Indexes for table `Module`
--
ALTER TABLE `Module`
  ADD PRIMARY KEY (`moduleID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Enrolement`
--
ALTER TABLE `Enrolement`
  ADD CONSTRAINT `enrolement_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `student` (`studentID`),
  ADD CONSTRAINT `enrolement_ibfk_2` FOREIGN KEY (`moduleID`) REFERENCES `Module` (`moduleID`);

--
-- Constraints for table `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_ibfk_1` FOREIGN KEY (`departmentID`) REFERENCES `department` (`departmentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
