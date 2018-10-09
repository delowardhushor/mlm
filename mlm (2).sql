-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2018 at 11:49 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mlm`
--

-- --------------------------------------------------------

--
-- Table structure for table `mlm_members`
--

CREATE TABLE `mlm_members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `balance` int(99) NOT NULL DEFAULT '0',
  `rank` varchar(255) NOT NULL DEFAULT 'none',
  `parent_member` int(99) DEFAULT NULL,
  `referred` int(255) NOT NULL DEFAULT '0',
  `got500` int(11) NOT NULL DEFAULT '0',
  `got1000` int(11) DEFAULT '0',
  `got2000` int(11) NOT NULL DEFAULT '0',
  `got3000` int(11) NOT NULL DEFAULT '0',
  `got4000` int(11) NOT NULL DEFAULT '0',
  `got5000` int(11) NOT NULL DEFAULT '0',
  `got6000` int(11) NOT NULL DEFAULT '0',
  `got7000` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlm_members`
--

INSERT INTO `mlm_members` (`id`, `name`, `balance`, `rank`, `parent_member`, `referred`, `got500`, `got1000`, `got2000`, `got3000`, `got4000`, `got5000`, `got6000`, `got7000`) VALUES
(1, 'Delowar', 0, 'none', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_packages`
--

CREATE TABLE `mlm_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `stock` int(255) NOT NULL,
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlm_packages`
--

INSERT INTO `mlm_packages` (`id`, `name`, `price`, `stock`, `details`) VALUES
(1, 'Package A', '40000', 19, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `mlm_users`
--

CREATE TABLE `mlm_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlm_users`
--

INSERT INTO `mlm_users` (`id`, `email`, `pass`) VALUES
(1, 'admin@mlm.com', '63c4b1baf3b4460fa9936b1a20919bec');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mlm_members`
--
ALTER TABLE `mlm_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_packages`
--
ALTER TABLE `mlm_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_users`
--
ALTER TABLE `mlm_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mlm_members`
--
ALTER TABLE `mlm_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_packages`
--
ALTER TABLE `mlm_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_users`
--
ALTER TABLE `mlm_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
