-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2017 at 05:12 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `virtuoso`
--
CREATE DATABASE IF NOT EXISTS `virtuoso` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `virtuoso`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `custid` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `cnumber` varchar(10) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birthday` date NOT NULL,
  `status` enum('registered','pending') NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(50) NOT NULL,
  `photo` blob,
  PRIMARY KEY (`custid`),
  UNIQUE KEY `email` (`email`),
  KEY `email_2` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custid`, `email`, `name`, `address`, `cnumber`, `gender`, `birthday`, `status`, `timestamp`, `password`, `photo`) VALUES
(1, '2151828@slu.edu.ph', 'Erico Erese', 'New Lucban, Baguio City', '912345678', 'M', '1997-10-04', 'registered', '2017-04-21 16:00:00', 'erico', NULL),
(2, '2156068@slu.edu.ph', 'Patricia Canaria', 'T. Alonzo, Baguio City', '912345678', 'F', '1997-08-30', 'registered', '2017-04-21 16:00:00', 'patricia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `invoiceid` int(11) NOT NULL,
  `amount` decimal(8,3) NOT NULL,
  `timestamp` date NOT NULL,
  `transactid` int(11) NOT NULL,
  PRIMARY KEY (`invoiceid`),
  KEY `transactid` (`transactid`)
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

CREATE TABLE IF NOT EXISTS `program` (
  `programid` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `desc` varchar(30) NOT NULL,
  `minsession` int(3) NOT NULL,
  PRIMARY KEY (`programid`),
  UNIQUE KEY `name_2` (`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `session` (
  `transactid` int(5) NOT NULL,
  `sessionNum` int(3) NOT NULL,
  `maxSession` int(3) NOT NULL,
  `date_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_fin` timestamp NOT NULL,
  KEY `transactid` (`transactid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`transactid`, `sessionNum`, `maxSession`, `date_start`, `date_fin`) VALUES
(1, 2, 4, '2017-04-27 15:03:28', '2017-04-27 15:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `transactid` int(5) NOT NULL AUTO_INCREMENT,
  `status` enum('pending','on going','done') NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `custid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `tutorid` int(11) NOT NULL,
  PRIMARY KEY (`transactid`),
  KEY `custid` (`custid`),
  KEY `programid` (`programid`),
  KEY `tutorid` (`tutorid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transactid`, `status`, `timestamp`, `custid`, `programid`, `tutorid`) VALUES
(1, 'on going', '2017-04-21 16:00:00', 1, 1, 1),
(2, 'pending', '2017-04-21 16:00:00', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE IF NOT EXISTS `tutor` (
  `tutorid` int(5) NOT NULL AUTO_INCREMENT,
  `email` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `birthday` date NOT NULL,
  `status` enum('registered','pending') NOT NULL DEFAULT 'pending',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(50) NOT NULL,
  `photo` blob,
  PRIMARY KEY (`tutorid`),
  UNIQUE KEY `email_2` (`email`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutorid`, `email`, `name`, `address`, `gender`, `birthday`, `status`, `timestamp`, `password`, `photo`) VALUES
(1, '2151372@slu.edu.ph', 'Jules Eguilos', 'T. Alonzo, Baguio City', 'M', '1998-06-20', 'registered', '2017-04-21 16:00:00', 'jules', NULL),
(2, '2152165@slu.edu.ph', 'Alissa Castro', 'T. Alonzo, Baguio CIty', 'F', '1997-09-24', 'registered', '2017-04-21 16:00:00', 'alissa', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tutorprogram`
--

CREATE TABLE IF NOT EXISTS `tutorprogram` (
  `tutorid` int(11) NOT NULL,
  `programid` int(11) NOT NULL,
  `tutorrate` decimal(8,3) NOT NULL,
  `companyrate` decimal(8,3) NOT NULL,
  PRIMARY KEY (`tutorid`,`programid`),
  KEY `fk_program` (`programid`)
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
-- Constraints for dumped tables
--

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
