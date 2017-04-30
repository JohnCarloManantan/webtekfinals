-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2017 at 01:20 PM
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
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `postid` int(5) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `feedback` varchar(60) NOT NULL,
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
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `invoiceid` int(11) NOT NULL,
  `amount` decimal(8,3) NOT NULL,
  `timestamp` date NOT NULL,
  `transactid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`invoiceid`, `amount`, `timestamp`, `transactid`) VALUES
(1, '250.000', '2017-04-24', 1),
(2, '125.000', '2017-04-24', 2);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `programid` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `desc` varchar(30) NOT NULL,
  `minsession` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`programid`, `name`, `desc`, `minsession`) VALUES
(1, 'piano', 'beuatiful piano', 4),
(2, 'violin', 'nice violin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `transactid` int(5) NOT NULL,
  `sessionNum` int(3) NOT NULL,
  `maxSession` int(3) NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transactid` int(5) NOT NULL,
  `status` enum('pending','on going','done') NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `custid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `tutorid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactid`, `status`, `timestamp`, `custid`, `programid`, `tutorid`) VALUES
(1, 'pending', '2017-04-21 16:00:00', 1, 1, 1),
(2, 'pending', '2017-04-21 16:00:00', 1, 2, 1);

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
-- Table structure for table `tutorprogram`
--

CREATE TABLE `tutorprogram` (
  `tutorid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `tutorrate` decimal(8,3) NOT NULL,
  `companyrate` decimal(8,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tutorprogram`
--

INSERT INTO `tutorprogram` (`tutorid`, `programid`, `tutorrate`, `companyrate`) VALUES
(1, 1, '250.000', '100.000'),
(1, 2, '125.000', '50.000'),
(2, 1, '175.000', '100.000'),
(2, 2, '95.000', '50.000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_2` (`email`),
  ADD KEY `email_3` (`email`);

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
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`invoiceid`),
  ADD KEY `transactid` (`transactid`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`programid`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD KEY `transactid` (`transactid`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transactid`),
  ADD KEY `custid` (`custid`),
  ADD KEY `programid` (`programid`),
  ADD KEY `tutorid` (`tutorid`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tutorid`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `tutorprogram`
--
ALTER TABLE `tutorprogram`
  ADD PRIMARY KEY (`tutorid`,`programid`),
  ADD KEY `fk_program` (`programid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int(5) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `programid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transactid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `tutorid` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `fk_cust_f` FOREIGN KEY (`custid`) REFERENCES `customer` (`custid`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tutor_f` FOREIGN KEY (`tutorid`) REFERENCES `tutor` (`tutorid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message_tutor`
--
ALTER TABLE `message_tutor`
  ADD CONSTRAINT `fk_cust_receive` FOREIGN KEY (`custid_receiver`) REFERENCES `customer` (`custid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tut_sender` FOREIGN KEY (`tutorid_sender`) REFERENCES `tutor` (`tutorid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_trans` FOREIGN KEY (`transactid`) REFERENCES `transaction` (`transactid`) ON DELETE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `fk_transid` FOREIGN KEY (`transactid`) REFERENCES `transaction` (`transactid`) ON DELETE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_cust` FOREIGN KEY (`custid`) REFERENCES `customer` (`custid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prog` FOREIGN KEY (`programid`) REFERENCES `program` (`programid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tutor` FOREIGN KEY (`tutorid`) REFERENCES `tutor` (`tutorid`) ON UPDATE CASCADE;

--
-- Constraints for table `tutorprogram`
--
ALTER TABLE `tutorprogram`
  ADD CONSTRAINT `fk_program` FOREIGN KEY (`programid`) REFERENCES `program` (`programid`),
  ADD CONSTRAINT `fk_tut` FOREIGN KEY (`tutorid`) REFERENCES `tutor` (`tutorid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
