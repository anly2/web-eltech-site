-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 05, 2012 at 11:31 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `eltech`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `BID` mediumint(9) NOT NULL,
  `Title` varchar(150) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Contents` text NOT NULL,
  `Category` tinyint(4) NOT NULL DEFAULT '1',
  `Comments` int(11) NOT NULL DEFAULT '0',
  `Tags` varchar(100) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`BID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`BID`, `Title`, `Author`, `Contents`, `Category`, `Comments`, `Tags`, `Date`) VALUES
(2, 'The whole site is under construction', 'Andy', 'As of 1st of May the Eltech site is being under development.\r\nThe design is expected to be complete in two weeks (14th of May) and the completely functioning version of the site should be ready in the following week (till 21th)\r\nThank you for your patients!', 1, 1, 'Eltech Site Launch', '2012-05-01 04:43:08'),
(3, 'The site is nearing completion', 'Andy', '<p>Almost everything is now functioning.</p><p>The design is set and not more than a few minor changes are expected.</p><p>The functionality is done as well.</p><p>The only thing that is lacking is the Forum where you are supposed to express your opinion and ask the questions on your mind. Considering that this might have been the thing you looked forward to the most in this site I am pleased to tell you that it is not that far in the future.</p><p>For now, though, you will have to arm yourselves with patience!</p>', 2, 0, '', '2012-06-02 18:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE IF NOT EXISTS `blog_categories` (
  `Category` tinyint(4) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `BG_Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`Category`, `Name`, `BG_Name`) VALUES
(1, 'Announcement', 'Ð˜Ð·Ð²ÐµÑÑ‚Ð¸Ðµ'),
(2, 'Schedule', 'Ð“Ñ€Ð°Ñ„Ð¸Ðº');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UID` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Rights` tinyint(4) NOT NULL,
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `Username`, `Password`, `Rights`) VALUES
(1, 'Andy', '205245cf218de876a9ef1b0914199e4c', 6),
(2, 'petya7', '7973d592898e7139bc32bf0496bc1294', 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
