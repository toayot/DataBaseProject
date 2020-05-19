-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 04:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cscoursenavigator`
--

-- --------------------------------------------------------

--
-- Table structure for table `curinclude`
--

CREATE TABLE `curinclude` (
  `curID` int(1) NOT NULL,
  `subID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `minimumCredit` int(3) NOT NULL,
  `curID` int(1) NOT NULL,
  `curName` varchar(100) NOT NULL,
  `curYear` int(4) NOT NULL,
  `curDuration` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `major`
--

CREATE TABLE `major` (
  `majorID` int(1) NOT NULL,
  `majorname` varchar(100) NOT NULL,
  `curID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `majorinclude`
--

CREATE TABLE `majorinclude` (
  `majorID` int(1) NOT NULL,
  `subID` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `registerdata`
--

CREATE TABLE `registerdata` (
  `title` varchar(6) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `studentID` varchar(10) NOT NULL,
  `currentYear` int(2) NOT NULL,
  `majorID` int(1) NOT NULL,
  `password` varchar(32) NOT NULL,
  `subStatus` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subID` varchar(5) NOT NULL,
  `subCredit` int(1) NOT NULL,
  `subName` varchar(60) NOT NULL,
  `semester` int(1) DEFAULT NULL,
  `year` int(1) DEFAULT NULL,
  `semesterrequired` int(1) DEFAULT NULL,
  `condition1` varchar(10) DEFAULT NULL,
  `condition2` varchar(10) DEFAULT NULL,
  `andOr` varchar(3) DEFAULT NULL,
  `passCondition` varchar(2) NOT NULL,
  `subjDescription` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subplantest`
--

CREATE TABLE `subplantest` (
  `studentID` varchar(10) NOT NULL,
  `subID` varchar(5) NOT NULL,
  `subCredit` int(1) NOT NULL,
  `subName` varchar(60) NOT NULL,
  `grade` varchar(2) NOT NULL,
  `gradersemester` int(1) NOT NULL,
  `subStatus` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `curinclude`
--
ALTER TABLE `curinclude`
  ADD KEY `curID` (`curID`),
  ADD KEY `subID` (`subID`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`curID`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`majorID`),
  ADD KEY `curID` (`curID`);

--
-- Indexes for table `majorinclude`
--
ALTER TABLE `majorinclude`
  ADD KEY `majorID` (`majorID`),
  ADD KEY `subID` (`subID`);

--
-- Indexes for table `registerdata`
--
ALTER TABLE `registerdata`
  ADD PRIMARY KEY (`studentID`),
  ADD KEY `majorID` (`majorID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subID`);

--
-- Indexes for table `subplantest`
--
ALTER TABLE `subplantest`
  ADD KEY `studentID` (`studentID`),
  ADD KEY `subID` (`subID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `curinclude`
--
ALTER TABLE `curinclude`
  ADD CONSTRAINT `curinclude_ibfk_1` FOREIGN KEY (`curID`) REFERENCES `curriculum` (`curID`),
  ADD CONSTRAINT `curinclude_ibfk_2` FOREIGN KEY (`subID`) REFERENCES `subject` (`subID`);

--
-- Constraints for table `major`
--
ALTER TABLE `major`
  ADD CONSTRAINT `major_ibfk_1` FOREIGN KEY (`curID`) REFERENCES `curriculum` (`curID`);

--
-- Constraints for table `majorinclude`
--
ALTER TABLE `majorinclude`
  ADD CONSTRAINT `majorinclude_ibfk_1` FOREIGN KEY (`majorID`) REFERENCES `major` (`majorID`),
  ADD CONSTRAINT `majorinclude_ibfk_2` FOREIGN KEY (`subID`) REFERENCES `subject` (`subID`);

--
-- Constraints for table `registerdata`
--
ALTER TABLE `registerdata`
  ADD CONSTRAINT `registerdata_ibfk_1` FOREIGN KEY (`majorID`) REFERENCES `major` (`majorID`);

--
-- Constraints for table `subplantest`
--
ALTER TABLE `subplantest`
  ADD CONSTRAINT `subplantest_ibfk_1` FOREIGN KEY (`studentID`) REFERENCES `registerdata` (`studentID`),
  ADD CONSTRAINT `subplantest_ibfk_2` FOREIGN KEY (`subID`) REFERENCES `subject` (`subID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
