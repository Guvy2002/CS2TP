-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 12:24 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `uid` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PasswordHash` varchar(255) NOT NULL,
  `RecoveryHash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`uid`, `email`, `PasswordHash`, `RecoveryHash`) VALUES
(1, 'd@g', '$2y$10$Nduau.MPSL/79CwNKcm/UOQbpopvrQuBssVufaHm8kI2NJTAEt7DS', '$2y$10$oS6epu3sc/syGEXnOYv7PeRHl9eHz8ZHYWbq4ZBCmIGh1qQomqlnC'),
(2, 'r@g', '$2y$10$2QfF7wfsu11Jd4pYw.NJEeKbahkYLnJTzA4p/hVjSKnDZdYs16Ps.', '$2y$10$KoBvPGe3JzLfib7.ffqFZeK/NFx3lkFjHwDJbBXOyCsg4wY5OcL3q'),
(3, 'r@r', '$2y$10$09F3QbU2cywf4oFTDC0SZOWhZ/tkyxJAB2RbLY0x5iXAt9GfelCx.', '$2y$10$6xNb1oHJ2LX4UVaeSBECyesd8XTSAlk8u7xeklQiXzSMzoMPsCdyG');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `size` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `imgPath` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `userID`, `name`, `price`, `size`, `stock`, `imgPath`) VALUES
(1, 3, 'AJ1 black', 13.37, 10, 100, 0),
(2, 3, 'AJ1 black', 13.37, 10, 100, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `uid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
