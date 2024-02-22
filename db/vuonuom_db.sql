-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 04:54 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vuonuom_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `businessid` int(11) NOT NULL,
  `businessname` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `premiumstatus` int(11) NOT NULL DEFAULT 0,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`businessid`, `businessname`, `image`, `premiumstatus`, `userid`) VALUES
(1, 'TVU', 'upload/icon.jpg', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `businesspackages`
--

CREATE TABLE `businesspackages` (
  `businesspackageid` int(11) NOT NULL,
  `businessid` int(11) NOT NULL,
  `packageid` int(11) NOT NULL,
  `startdate` datetime NOT NULL,
  `enddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `packageid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` bigint(20) NOT NULL,
  `packagedate` int(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`packageid`, `name`, `price`, `packagedate`, `description`) VALUES
(1, 'Gói thường', 5000000, 1, 'lamdasmds'),
(3, 'Gói bạc', 6000000, 6, 'lamdasmds'),
(4, 'Gói Vàng', 7000000, 12, 'lamdasmds'),
(5, 'Gói Kim cương', 7000000, 12, 'lamdasmds'),
(14, 'Gói VIP', 10000000, 1, 'dkansd'),
(20, 'ads', 1, 1, 'qdasd'),
(21, 'adsda', 1123123, 3, '<p>sdaasdasdad</p><figure class=\"media\"><oembed url=\"https://www.youtube.com/watch?v=ukHK1GVyr0I&amp;list=RDuf8pPNXMO-I&amp;index=7\"></oembed></figure>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` int(11) NOT NULL COMMENT '0 = customer, 1 = bussiness, 2 = admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `email`, `password`, `fullname`, `address`, `phone`, `role`) VALUES
(1, 'admin@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', 2),
(2, 'user@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', 0),
(3, 'business@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', 1),
(5, 'tuna@gmail.com', '4297f44b13955235245b2497399d7a93', 'Kim Tuna', '123, đường quang trung , Hà nội', '0922347678', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`businessid`);

--
-- Indexes for table `businesspackages`
--
ALTER TABLE `businesspackages`
  ADD PRIMARY KEY (`businesspackageid`),
  ADD KEY `businessid` (`businessid`),
  ADD KEY `packageid` (`packageid`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`packageid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `businessid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `businesspackages`
--
ALTER TABLE `businesspackages`
  MODIFY `businesspackageid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `packageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `businesspackages`
--
ALTER TABLE `businesspackages`
  ADD CONSTRAINT `businesspackages_ibfk_1` FOREIGN KEY (`businessid`) REFERENCES `businesses` (`businessid`),
  ADD CONSTRAINT `businesspackages_ibfk_2` FOREIGN KEY (`packageid`) REFERENCES `packages` (`packageid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
