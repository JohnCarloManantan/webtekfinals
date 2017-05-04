-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 01:57 PM
-- Server version: 5.7.11
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `virtuoso`
--
CREATE DATABASE IF NOT EXISTS `virtuoso` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `virtuoso`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int(5) NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birthday` date NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_register` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `photo` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bookid` int(5) NOT NULL,
  `status` enum('pending','accepted','rejected','done') NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `schedule` datetime NOT NULL,
  `order_messsage` varchar(100) DEFAULT NULL,
  `custid` int(11) NOT NULL,
  `tutorid` int(11) NOT NULL,
  `serviceid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custid` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `cnumber` varchar(10) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birthday` date NOT NULL,
  `status` enum('registered','pending') NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(50) NOT NULL,
  `photo` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custid`, `email`, `name`, `address`, `cnumber`, `gender`, `birthday`, `status`, `timestamp`, `password`, `photo`) VALUES
(1, '2151828@slu.edu.ph', 'Erico Erese', 'New Lucban, Baguio City', '912345678', 'M', '1997-10-04', 'registered', '2017-04-21 16:00:00', 'erico', NULL),
(2, '2156068@slu.edu.ph', 'Patricia Canaria', 'T. Alonzo, Baguio City', '912345678', 'F', '1997-08-30', 'registered', '2017-04-21 16:00:00', 'patricia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cust_complaint`
--

CREATE TABLE `cust_complaint` (
  `report_num` int(5) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `details` varchar(100) NOT NULL,
  `tutorid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `postid` int(5) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `feedback` varchar(60) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `custid` int(5) NOT NULL,
  `tutorid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message_cust`
--

CREATE TABLE `message_cust` (
  `mesageid` int(11) NOT NULL,
  `text` varchar(60) NOT NULL,
  `custid_sender` int(5) NOT NULL,
  `tutorid_receive` int(5) NOT NULL,
  `timestampe` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message_tutor`
--

CREATE TABLE `message_tutor` (
  `messageid` int(11) NOT NULL,
  `text` varchar(60) NOT NULL,
  `tutorid_sender` int(5) NOT NULL,
  `custid_receiver` int(5) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `tutorid` int(5) NOT NULL,
  `day` enum('mon','tues','wed','thu','fri','sat') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `serviceid` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `desc` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`serviceid`, `name`, `desc`) VALUES
(1, 'piano', 'beuatiful piano'),
(2, 'violin', 'nice violin');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactid` int(5) NOT NULL,
  `amount` decimal(8,3) NOT NULL,
  `timestamp` date NOT NULL,
  `bookid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tutorid` int(5) NOT NULL,
  `email` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birthday` date NOT NULL,
  `status` enum('registered','pending') NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(50) NOT NULL,
  `photo` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutorid`, `email`, `name`, `address`, `gender`, `birthday`, `status`, `timestamp`, `password`, `photo`) VALUES
(1, '2151372@slu.edu.ph', 'Jules Eguilos', 'T. Alonzo, Baguio City', 'M', '1998-06-20', 'registered', '2017-04-21 16:00:00', 'jules', NULL),
(2, '2152165@slu.edu.ph', 'Alissa Castro', 'T. Alonzo, Baguio CIty', 'F', '1997-09-24', 'registered', '2017-04-21 16:00:00', 'alissa', NULL),
(4, '2157345@slu.edu.ph', 'Shary Chakas', 'Spring Hills, Baguio City', 'F', '1997-08-20', 'pending', '2017-04-30 06:33:39', 'shary', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tutorservice`
--

CREATE TABLE `tutorservice` (
  `tutorid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `tutorrate` decimal(8,3) NOT NULL,
  `companyrate` decimal(8,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutorservice`
--

INSERT INTO `tutorservice` (`tutorid`, `programid`, `tutorrate`, `companyrate`) VALUES
(1, 1, '250.000', '100.000'),
(1, 2, '125.000', '50.000'),
(2, 1, '175.000', '100.000'),
(2, 2, '95.000', '50.000');

-- --------------------------------------------------------

--
-- Table structure for table `tut_complaint`
--

CREATE TABLE `tut_complaint` (
  `report_num` int(5) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `details` varchar(100) NOT NULL,
  `custid` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bookid`),
  ADD KEY `custid` (`custid`),
  ADD KEY `tutorid` (`tutorid`),
  ADD KEY `serviceid` (`serviceid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`),
  ADD KEY `email_3` (`email`);

--
-- Indexes for table `cust_complaint`
--
ALTER TABLE `cust_complaint`
  ADD PRIMARY KEY (`report_num`),
  ADD KEY `tutorid` (`tutorid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `custid` (`custid`),
  ADD KEY `tutorid` (`tutorid`);

--
-- Indexes for table `message_cust`
--
ALTER TABLE `message_cust`
  ADD PRIMARY KEY (`mesageid`),
  ADD KEY `custid_sender` (`custid_sender`),
  ADD KEY `tutorid_receive` (`tutorid_receive`);

--
-- Indexes for table `message_tutor`
--
ALTER TABLE `message_tutor`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `tutorid` (`tutorid_sender`),
  ADD KEY `custid` (`custid_receiver`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD KEY `tutorid` (`tutorid`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`serviceid`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactid`),
  ADD KEY `bookid` (`bookid`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tutorid`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `tutorservice`
--
ALTER TABLE `tutorservice`
  ADD PRIMARY KEY (`tutorid`,`programid`),
  ADD KEY `fk_program` (`programid`);

--
-- Indexes for table `tut_complaint`
--
ALTER TABLE `tut_complaint`
  ADD PRIMARY KEY (`report_num`),
  ADD KEY `custid` (`custid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bookid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `postid` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `serviceid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `tutorid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_cust` FOREIGN KEY (`custid`) REFERENCES `customer` (`custid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_servid` FOREIGN KEY (`serviceid`) REFERENCES `service` (`serviceid`),
  ADD CONSTRAINT `fk_tutor` FOREIGN KEY (`tutorid`) REFERENCES `tutor` (`tutorid`) ON UPDATE CASCADE;

--
-- Constraints for table `cust_complaint`
--
ALTER TABLE `cust_complaint`
  ADD CONSTRAINT `tutor-fk` FOREIGN KEY (`tutorid`) REFERENCES `tutor` (`tutorid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_cust_f` FOREIGN KEY (`custid`) REFERENCES `customer` (`custid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tutor_f` FOREIGN KEY (`tutorid`) REFERENCES `tutor` (`tutorid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message_cust`
--
ALTER TABLE `message_cust`
  ADD CONSTRAINT `fk_cust1` FOREIGN KEY (`custid_sender`) REFERENCES `customer` (`custid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tut2` FOREIGN KEY (`tutorid_receive`) REFERENCES `tutor` (`tutorid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message_tutor`
--
ALTER TABLE `message_tutor`
  ADD CONSTRAINT `fk_cust_receive` FOREIGN KEY (`custid_receiver`) REFERENCES `customer` (`custid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tut_sender` FOREIGN KEY (`tutorid_sender`) REFERENCES `tutor` (`tutorid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `fk-tuto` FOREIGN KEY (`tutorid`) REFERENCES `tutor` (`tutorid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_bukid` FOREIGN KEY (`bookid`) REFERENCES `booking` (`bookid`) ON DELETE CASCADE;

--
-- Constraints for table `tutorservice`
--
ALTER TABLE `tutorservice`
  ADD CONSTRAINT `fk_program` FOREIGN KEY (`programid`) REFERENCES `service` (`serviceid`),
  ADD CONSTRAINT `fk_tut` FOREIGN KEY (`tutorid`) REFERENCES `tutor` (`tutorid`);

--
-- Constraints for table `tut_complaint`
--
ALTER TABLE `tut_complaint`
  ADD CONSTRAINT `fk-cust` FOREIGN KEY (`custid`) REFERENCES `customer` (`custid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
