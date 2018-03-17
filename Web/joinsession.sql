-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2017 at 05:53 AM
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
-- Table structure for table `joinsession`
--

CREATE TABLE IF NOT EXISTS `joinsession` (
  `sessionID` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `trainingType` enum('Personal','Group') NOT NULL,
  `username` varchar(50) NOT NULL,
  `rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `joinsession`
--

INSERT INTO `joinsession` (`sessionID`, `title`, `date`, `time`, `trainingType`, `username`, `rating`) VALUES
('24523', 'meow', '2017-11-26', '23:01:00', 'Personal', 'qwe', 0),
('69590', 'personal1', '2017-11-24', '23:00:00', 'Personal', 'naa', 0),
('44417', 'group2', '2017-11-24', '23:02:00', 'Group', 'naa', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
