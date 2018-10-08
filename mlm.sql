-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2018 at 01:58 PM
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
  `parent_member` int(99) NOT NULL,
  `child` int(255) NOT NULL DEFAULT '0',
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

INSERT INTO `mlm_members` (`id`, `name`, `balance`, `parent_member`, `child`, `got500`, `got1000`, `got2000`, `got3000`, `got4000`, `got5000`, `got6000`, `got7000`) VALUES
(1, 'dfdsfs', 1600, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(2, 'Hello', 80, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(3, 'Hello', 60, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 'Delowar', 40, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, '', 20, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 'fthfth', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
(1, 'Asdfsdfsd', '1200', 100, '1.sdsdss\r\n2.sdsdsd\r\n3.ZXDsdsdasd'),
(2, 'Tour Coxs', '30000', 50, '3 night'),
(3, 'C sdfsdfsdf', '12121111111111111', 2147483647, 'sdfsdfsdfsdd hegerger'),
(4, 'qwerqweqwe', '1231312312', 2147483647, 'sdfsdfvsfsdfvsdvsdvds'),
(5, 'Hello', '121212', 121212, '1212edwefcwrfwrfgergeg'),
(6, 'new 1231231233', '121212', 123123123, 'fvsvsvsvsvsdfgv'),
(7, 'asdascacacas', '12121212', 4545, 'uoiyiyuiyiyui'),
(8, 'today', '4512', 1000, 'asdasdasd'),
(9, 'change', '1200', 123213, 'sdfsdfsdf'),
(10, 'asdadasdasd', '1231123123123123123', 2147483647, 'hay therer'),
(11, '', '', 0, '');

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
(1, 'admin@blog.com', 'rootadmin');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mlm_packages`
--
ALTER TABLE `mlm_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `mlm_users`
--
ALTER TABLE `mlm_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
