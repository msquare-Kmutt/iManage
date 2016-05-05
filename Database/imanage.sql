-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 05, 2016 at 11:05 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imanage`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `restaurantID` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `menuID` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `menuName` text COLLATE utf32_unicode_ci NOT NULL,
  `menuPrice` float NOT NULL,
  `menuDetail` text COLLATE utf32_unicode_ci NOT NULL,
  `menuPic` text COLLATE utf32_unicode_ci NOT NULL,
  `statusMenu` int(11) NOT NULL,
  PRIMARY KEY (`restaurantID`,`menuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `restaurantInformation`
--

CREATE TABLE IF NOT EXISTS `restaurantInformation` (
  `restaurantID` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `restaurantName` text COLLATE utf32_unicode_ci NOT NULL,
  `restaurantAddress` text COLLATE utf32_unicode_ci NOT NULL,
  `restaurantLogo` text COLLATE utf32_unicode_ci NOT NULL,
  `ownerID` varchar(5) COLLATE utf32_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`restaurantID`),
  KEY `ownerID` (`ownerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `restaurantInformation`
--

INSERT INTO `restaurantInformation` (`restaurantID`, `restaurantName`, `restaurantAddress`, `restaurantLogo`, `ownerID`) VALUES
('R0001', 'NimRest', 'Twitter', '-', 'U0001');

-- --------------------------------------------------------

--
-- Table structure for table `typeUser`
--

CREATE TABLE IF NOT EXISTS `typeUser` (
  `userTypeID` int(5) NOT NULL,
  `userTypeName` text COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`userTypeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `typeUser`
--

INSERT INTO `typeUser` (`userTypeID`, `userTypeName`) VALUES
(1, 'Owner'),
(2, 'Manager'),
(3, 'Waiter'),
(4, 'Chef');

-- --------------------------------------------------------

--
-- Table structure for table `userInformation`
--

CREATE TABLE IF NOT EXISTS `userInformation` (
  `userID` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `userFirstName` text COLLATE utf32_unicode_ci NOT NULL,
  `userLastName` text COLLATE utf32_unicode_ci NOT NULL,
  `userType` int(11) NOT NULL,
  `restaurantID` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `address` text COLLATE utf32_unicode_ci NOT NULL,
  `telephoneNo` text COLLATE utf32_unicode_ci NOT NULL,
  `DOB` date NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userType` (`userType`),
  UNIQUE KEY `DOB` (`DOB`),
  UNIQUE KEY `userID` (`userID`),
  UNIQUE KEY `userID_2` (`userID`),
  KEY `restaurantID` (`restaurantID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `userInformation`
--

INSERT INTO `userInformation` (`userID`, `userFirstName`, `userLastName`, `userType`, `restaurantID`, `address`, `telephoneNo`, `DOB`) VALUES
('U0001', 'Nim', 'p68', 1, 'R0001', 'everyway', '095-555-5555', '2013-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `userPassword`
--

CREATE TABLE IF NOT EXISTS `userPassword` (
  `userID` varchar(5) COLLATE utf32_unicode_ci NOT NULL,
  `dateRegis` date NOT NULL,
  `password` text COLLATE utf32_unicode_ci NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `dateRegis` (`dateRegis`),
  KEY `dateRegis_2` (`dateRegis`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `userPassword`
--

INSERT INTO `userPassword` (`userID`, `dateRegis`, `password`) VALUES
('U0001', '2016-05-01', 'nimnimp68');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `restaurantInformation` (`restaurantID`);

--
-- Constraints for table `restaurantInformation`
--
ALTER TABLE `restaurantInformation`
  ADD CONSTRAINT `restaurantinformation_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `userInformation` (`userID`);

--
-- Constraints for table `userInformation`
--
ALTER TABLE `userInformation`
  ADD CONSTRAINT `userinformation_ibfk_2` FOREIGN KEY (`userType`) REFERENCES `typeUser` (`userTypeID`),
  ADD CONSTRAINT `userinformation_ibfk_1` FOREIGN KEY (`restaurantID`) REFERENCES `restaurantInformation` (`restaurantID`);

--
-- Constraints for table `userPassword`
--
ALTER TABLE `userPassword`
  ADD CONSTRAINT `userpassword_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `userInformation` (`userID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
