-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2023 at 03:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fic`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `ID` int(10) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`ID`, `username`, `password`, `fname`, `lname`, `role`) VALUES
(1, 'sompong@example.com', '$2y$10$RYFQhnE9KZGp20z7npexEOIiGpDC/Bb7Gu3NVr3hyv9Rl9W4hin3O', 'สมปอง', 'สองคน', 'admin'),
(2, 'somsri@example.com', '$2y$10$if.25g/NOLOR/oCOPOk8N.aqSIA9EX1YS5BlwI3cGV8Z18/rgsgfm', 'สมศรี', 'ศรีสมอน', 'user'),
(3, 'poothai@example.com', '$2y$10$VFuzBVIeTcaXLHXzQfdJI.oCtlUei4MHgwRcP5ktx9A9Lx89afHWm', 'ปูไทย', 'หอยแครง', 'viewer'),
(4, 'user', '$2y$10$o/n.vD0S8531rV0YXMOo1.O85lR3L2Ps8cXIIPc3sCZBRQfo4Hdm2', 'user', 'user', 'user'),
(5, 'admin', '$2y$10$vv/t74EUnMn/dSLptRDVveswpZaPl/XWjClkfIQiA9RpB6aGVKRui', 'admin', 'admin', 'admin'),
(6, 'viewer', '$2y$10$LC0M5yGxALlDX9Kx4ObyDeN1UnAz0NJSkJs2.XacsStporUNInqZW', 'viewer', 'viewer', 'viewer'),
(7, 'viewer@gmail.com', '$2y$10$RwvNurYRFsO7Fm5SevYv5uP.ITCYExY8rZ.X3wqHViao8GqChkBsO', 'viewer', 'viewer', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
