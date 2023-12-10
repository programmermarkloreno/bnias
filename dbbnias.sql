-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 06:39 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbbnias`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblrecord`
--

CREATE TABLE `tblrecord` (
  `id_record` int(11) NOT NULL,
  `child_name` varchar(50) NOT NULL,
  `guardian_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `sex` int(50) NOT NULL,
  `birthdate` date NOT NULL,
  `weight` int(50) NOT NULL,
  `height` int(50) NOT NULL,
  `age` int(50) NOT NULL,
  `age_in_months` int(50) NOT NULL,
  `weight_for_age_stat` varchar(50) NOT NULL,
  `height_for_age_stat` varchar(50) NOT NULL,
  `weight_for_ltht_stat` varchar(50) NOT NULL,
  `responsible_user` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblrecord`
--

INSERT INTO `tblrecord` (`id_record`, `child_name`, `guardian_name`, `address`, `sex`, `birthdate`, `weight`, `height`, `age`, `age_in_months`, `weight_for_age_stat`, `height_for_age_stat`, `weight_for_ltht_stat`, `responsible_user`, `created_at`, `updated_at`) VALUES
(1, 'Raymark Loreno', 'Raymark Loreno', 'St. Joseph Windfield 2 Brgy. Gulod', 2, '2001-09-09', 12, 12, 22, 267, 'N', 'N', 'Ob', 'username_test', '2023-12-09 21:22:11', '2023-12-09 21:22:11'),
(2, 'Test', 'test', 'address test', 1, '2020-09-09', 122, 12, 3, 39, 'N', 'N', 'Ob', 'username_test', '2023-12-09 21:49:10', '2023-12-09 21:49:10'),
(3, 'my child ', 'guard', 'sample address', 2, '2000-01-01', 20, 164, 23, 287, 'N', 'N', 'Ob', 'username_test', '2023-12-09 23:14:09', '2023-12-09 23:14:09'),
(4, 'username test edit', 'username test edit', 'St. Joseph Windfield 2 Brgy. Gulod', 2, '2021-09-09', 12, 121, 2, 27, 'N', 'N', 'Ob', 'username_test', '2023-12-10 13:31:52', '2023-12-10 13:31:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `userId` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `update_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userId`, `name`, `email`, `username`, `pass`, `created_date`, `update_date`) VALUES
(1, 'username test sample', 'test email', 'username_test', '098f6bcd4621d373cade4e832627b4f6', '2023-12-08 22:59:00', '2023-12-08 22:59:00'),
(2, 'Raymark Loreno', 'programmermarkloreno@gmail.com', 'b', '92eb5ffee6ae2fec3ad71c777531578f', '2023-12-09 10:48:13', '2023-12-09 10:48:13'),
(3, 'Raymark Loreno', 'programmermarkloreno@gmail.com', 'as', 'f970e2767d0cfe75876ea857f92e319b', '2023-12-09 13:42:05', '2023-12-09 13:42:05'),
(4, 'Raymark Loreno', 'programmermarkloreno@gmail.com', 'sx', 'f970e2767d0cfe75876ea857f92e319b', '2023-12-09 13:43:07', '2023-12-09 13:43:07'),
(5, 'Raymark Loreno', 'programmermarkloreno@gmail.com', 'sxsd', '6226f7cbe59e99a90b5cef6f94f966fd', '2023-12-09 13:43:40', '2023-12-09 13:43:40'),
(6, 'df', 'student-04-d1f7d2450bd1@qwiklabs.net', 'dsf', '6226f7cbe59e99a90b5cef6f94f966fd', '2023-12-09 13:44:12', '2023-12-09 13:44:12'),
(7, 'dsf', 'student-04-d1f7d2450bd1@qwiklabs.net', 'admin', '82d5984c2a2ad4c62caf1dd073b1c91c', '2023-12-09 13:48:07', '2023-12-09 13:48:07'),
(8, 'df', 'student-04-d1f7d2450bd1@qwiklabs.net', 'x', 'f970e2767d0cfe75876ea857f92e319b', '2023-12-09 13:49:22', '2023-12-09 13:49:22'),
(9, 'testing testing', 'exponicean@gmail.com', 'test1', 'ee11cbb19052e40b07aac0ca060c23ee', '2023-12-10 13:35:49', '2023-12-10 13:35:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblrecord`
--
ALTER TABLE `tblrecord`
  ADD PRIMARY KEY (`id_record`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblrecord`
--
ALTER TABLE `tblrecord`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `userId` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
