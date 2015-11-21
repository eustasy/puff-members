-- phpMyAdmin SQL Dump
-- version 4.3.8deb0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 21, 2015 at 12:14 PM
-- Server version: 10.1.8-MariaDB-1~trusty-log
-- PHP Version: 5.6.15-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Engineering`
--

-- --------------------------------------------------------

--
-- Table structure for table `KeyValues`
--

CREATE TABLE IF NOT EXISTS `KeyValues` (
  `Username` varchar(128) NOT NULL,
  `Key` varchar(128) NOT NULL,
  `Value` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

CREATE TABLE IF NOT EXISTS `Members` (
  `Username` varchar(128) NOT NULL,
  `Active` int(1) NOT NULL DEFAULT '1',
  `2FA Active` int(1) NOT NULL DEFAULT '0',
  `2FA Secret` varchar(16) NOT NULL,
  `PassHash` varchar(32) NOT NULL,
  `Password` varchar(128) NOT NULL,
  `Salt` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Sessions`
--

CREATE TABLE IF NOT EXISTS `Sessions` (
  `Username` varchar(128) NOT NULL,
  `Active` int(1) NOT NULL DEFAULT '1',
  `Session` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `KeyValues`
--
ALTER TABLE `KeyValues`
  ADD PRIMARY KEY (`Username`,`Key`);

--
-- Indexes for table `Members`
--
ALTER TABLE `Members`
  ADD PRIMARY KEY (`Username`), ADD KEY `Active` (`Active`);

--
-- Indexes for table `Sessions`
--
ALTER TABLE `Sessions`
  ADD PRIMARY KEY (`Session`), ADD KEY `Username` (`Username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
