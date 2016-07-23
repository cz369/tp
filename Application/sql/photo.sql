-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2016 at 01:57 AM
-- Server version: 5.7.11
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo`
--

-- --------------------------------------------------------

--
-- Table structure for table `think_device`
--

CREATE TABLE `think_device` (
  `id` int(10) UNSIGNED NOT NULL,
  `device_id` int(11) NOT NULL,
  `device_group` int(11) NOT NULL DEFAULT '1',
  `device_photo_size` varchar(20) NOT NULL DEFAULT '800*600',
  `device_photo_quality` int(4) NOT NULL DEFAULT '100',
  `device_photo_starttime` time NOT NULL DEFAULT '01:00:00',
  `device_photo_endtime` time NOT NULL DEFAULT '23:00:00',
  `device_frequency` int(2) NOT NULL DEFAULT '15',
  `device_photo_auto` tinyint(1) NOT NULL DEFAULT '1',
  `device_online` tinyint(1) NOT NULL DEFAULT '0',
  `longitude` float DEFAULT '116.331',
  `latitude` float DEFAULT '39.8974',
  `device_need_photo` tinyint(1) DEFAULT NULL,
  `device_boot_time` time DEFAULT '05:30:00',
  `device_off_time` time DEFAULT '19:30:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_device`
--

INSERT INTO `think_device` (`id`, `device_id`, `device_group`, `device_photo_size`, `device_photo_quality`, `device_photo_starttime`, `device_photo_endtime`, `device_frequency`, `device_photo_auto`, `device_online`, `longitude`, `latitude`, `device_need_photo`, `device_boot_time`, `device_off_time`) VALUES
(1, 123, 1, '800*600', 100, '01:00:00', '23:00:00', 15, 0, 0, 116.331, 39.8974, 1, '05:30:00', '19:30:00'),
(2, 456, 1, '800*600', 100, '01:00:00', '23:00:00', 15, 1, 0, 100, 30, 1, '05:30:00', '19:30:00'),
(3, 789, 3, '800*600', 100, '01:00:00', '23:00:00', 15, 1, 0, 116.331, 39.8974, NULL, '05:30:00', '19:30:00'),
(4, 1111, 1, '800*600', 100, '01:00:00', '23:00:00', 15, 1, 0, 106, 36.6, NULL, '05:30:00', '19:30:00'),
(5, 113, 1, '800*600', 100, '01:00:00', '23:00:00', 15, 1, 0, 106.044, 36.033, NULL, '05:30:00', '19:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `think_group`
--

CREATE TABLE `think_group` (
  `id` int(11) NOT NULL,
  `group_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_group`
--

INSERT INTO `think_group` (`id`, `group_name`) VALUES
(1, 'a'),
(2, 'b'),
(3, 'c'),
(4, 'd');

-- --------------------------------------------------------

--
-- Table structure for table `think_picture`
--

CREATE TABLE `think_picture` (
  `id` int(10) UNSIGNED NOT NULL,
  `path` varchar(20) NOT NULL,
  `device_Id` int(11) NOT NULL,
  `photo_date` datetime DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_picture`
--

INSERT INTO `think_picture` (`id`, `path`, `device_Id`, `photo_date`, `width`, `height`) VALUES
(1, '1.jpg', 113, NULL, NULL, NULL),
(2, '1.jpg', 113, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `think_user`
--

CREATE TABLE `think_user` (
  `username` varchar(11) NOT NULL,
  `password` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `think_user`
--

INSERT INTO `think_user` (`username`, `password`) VALUES
('admin', 'password');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `think_device`
--
ALTER TABLE `think_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_group`
--
ALTER TABLE `think_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `think_picture`
--
ALTER TABLE `think_picture`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `think_device`
--
ALTER TABLE `think_device`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `think_group`
--
ALTER TABLE `think_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `think_picture`
--
ALTER TABLE `think_picture`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
