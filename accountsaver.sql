-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 14, 2022 at 10:39 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `accountsaver`
--

-- --------------------------------------------------------

--
-- Table structure for table `savedacc`
--

CREATE TABLE `savedacc` (
  `AccountsID` int(11) NOT NULL COMMENT 'Saved accounts Id',
  `UserID` int(11) NOT NULL COMMENT 'Saved accounts for User',
  `Websitename` varchar(255) NOT NULL COMMENT 'Saved accounts Website name',
  `Websitelink` varchar(255) NOT NULL COMMENT 'Saved accounts Website Link',
  `Usernameacc` varchar(255) NOT NULL COMMENT 'Saved accounts Username',
  `Emailacc` varchar(255) NOT NULL COMMENT 'Saved accounts Email',
  `Passwordacc` varchar(255) NOT NULL COMMENT 'Saved accounts Password'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL COMMENT 'Users Accounts Id',
  `Username` varchar(255) NOT NULL COMMENT 'Username for Accounts',
  `Email` varchar(255) NOT NULL COMMENT 'Email for Accounts',
  `Password` varchar(255) NOT NULL COMMENT 'Password for Accounts',
  `Fullname` varchar(255) NOT NULL COMMENT 'Fullname for Accounts'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `savedacc`
--
ALTER TABLE `savedacc`
  ADD PRIMARY KEY (`AccountsID`),
  ADD KEY `saving` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `savedacc`
--
ALTER TABLE `savedacc`
  MODIFY `AccountsID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Saved accounts Id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Users Accounts Id', AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `savedacc`
--
ALTER TABLE `savedacc`
  ADD CONSTRAINT `saving` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
