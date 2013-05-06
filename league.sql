-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 06, 2013 at 07:33 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `league`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `isactive` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `keywords`
--

CREATE TABLE IF NOT EXISTS `keywords` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sport` varchar(50) NOT NULL,
  `keywords` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `keywords`
--

INSERT INTO `keywords` (`id`, `sport`, `keywords`) VALUES
(1, 'baseball', 'pitcher,homerun,players,1st base,bases loaded,2nd base,hotdog,inning,out,strike,walk,little league,AAU,travel ball,all-star,allstar,flyball');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `sid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_id` int(10) unsigned NOT NULL,
  `type` enum('object','array','string') NOT NULL DEFAULT 'string',
  `name` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sid`, `site_id`, `type`, `name`, `value`) VALUES
(1, 1, 'string', 'theme', 'default'),
(2, 1, 'string', 'apikey', 'jkjhkjhkjhkjhkjhkjh');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(80) NOT NULL,
  `leaguename` varchar(200) NOT NULL,
  `sport` varchar(100) NOT NULL,
  `organization` varchar(100) NOT NULL,
  `slogan` varchar(100) NOT NULL,
  `existingdomain` varchar(200) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(25) NOT NULL,
  `country` varchar(100) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `fax` varchar(25) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isactive` enum('yes','pending','no') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`site_id`, `domain`, `leaguename`, `sport`, `organization`, `slogan`, `existingdomain`, `firstname`, `lastname`, `email`, `address`, `address2`, `city`, `state`, `zip`, `country`, `phone`, `fax`, `date_added`, `isactive`) VALUES
(1, 'league.com', 'Test League', 'baseball', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '2013-05-04 05:53:45', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`) VALUES
(1, NULL, 'ehask71@gmail.com', NULL, '$2a$14$Hrx5WsMN5rU/wTGJUrWQXe/5vTjVMrSrS8EKbNZ24Sr4gEr3mqwDu');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
