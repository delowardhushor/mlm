-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2018 at 01:54 PM
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
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `package` int(11) NOT NULL,
  `balance` int(99) NOT NULL DEFAULT '0',
  `tan_bal` int(11) NOT NULL DEFAULT '0',
  `rank` varchar(255) NOT NULL DEFAULT 'none',
  `cat` int(11) NOT NULL DEFAULT '0',
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

INSERT INTO `mlm_members` (`id`, `joined`, `name`, `email`, `pass`, `package`, `balance`, `tan_bal`, `rank`, `cat`, `parent_member`, `referred`, `got500`, `got1000`, `got2000`, `got3000`, `got4000`, `got5000`, `got6000`, `got7000`) VALUES
(22, '2018-10-25 09:58:04', 'Delowar', 'del@yahoo.com', 'a01610228fe998f515a72dd730294d87', 1, 900, 800, 'none', 1, 0, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(23, '2018-10-25 09:58:52', 'update', 'zxczxc@yahoo.com', 'a01610228fe998f515a72dd730294d87', 1, -220, 200, 'none', 0, 22, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(24, '2018-10-25 10:06:25', 'update', 'author@blog.com', 'a01610228fe998f515a72dd730294d87', 1, -220, 200, 'none', 0, 22, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(25, '2018-10-25 10:22:28', 'new', 'asas', 'baa7a52965b99778f38ef37f235e9053', 1, 2000, 200, 'none', 0, 22, 0, 0, 0, 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mlm_members`
--
ALTER TABLE `mlm_members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mlm_members`
--
ALTER TABLE `mlm_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
