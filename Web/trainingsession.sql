-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2017 at 05:54 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `trainingsession`
--

CREATE TABLE IF NOT EXISTS `trainingsession` (
  `sessionID` varchar(10) CHARACTER SET utf8 NOT NULL,
  `title` varchar(50) CHARACTER SET utf8 NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `fee` int(20) NOT NULL,
  `status` enum('Full','Available') CHARACTER SET utf8 NOT NULL,
  `notes` varchar(50) NOT NULL,
  `classType` enum('Dance','Sport','MMA') CHARACTER SET utf8 NOT NULL,
  `trainingType` enum('Personal','Group') CHARACTER SET utf8 NOT NULL,
  `maxParticipants` int(10) NOT NULL,
  `rating` int(5) NOT NULL,
  `trainername` varchar(50) NOT NULL,
  `trSpecial` enum('Dance','Sport','MMA') NOT NULL,
  `participants` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trainingsession`
--

INSERT INTO `trainingsession` (`sessionID`, `title`, `date`, `time`, `fee`, `status`, `notes`, `classType`, `trainingType`, `maxParticipants`, `rating`, `trainername`, `trSpecial`, `participants`) VALUES
('34706', 'dog2', '2017-11-25', '23:59:00', 11, 'Available', '', '', 'Personal', 1, 0, 'woof', 'Dance', 0),
('69590', 'personal1', '2017-11-24', '23:00:00', 12, 'Full', '', '', 'Personal', 1, 0, 'traintrain', 'Dance', 0),
('64740', 'group1', '2017-11-24', '23:00:00', 12, 'Available', '', 'MMA', 'Group', 15, 0, 'traintrain', 'Dance', 0),
('44417', 'group2', '2017-11-24', '23:02:00', 13, 'Available', '', 'Sport', 'Group', 17, 0, 'traintrain', 'Dance', 7),
('20827', 'personal12', '2017-11-25', '23:05:00', 12, 'Available', '', '', 'Personal', 1, 0, 'traintrain', 'Dance', 0),
('77599', 'notgroup', '2017-11-23', '00:59:00', 13, 'Available', '', 'Sport', 'Group', 51, 0, 'traintrain', 'Dance', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
