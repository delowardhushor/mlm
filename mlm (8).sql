-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2018 at 10:18 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

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
-- Table structure for table `mlm_cashout`
--

CREATE TABLE `mlm_cashout` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `approve` varchar(255) DEFAULT 'pending',
  `mobile_from` varchar(255) DEFAULT NULL,
  `tan_id` varchar(255) DEFAULT NULL,
  `mode` varchar(255) NOT NULL,
  `pay_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_comhis`
--

CREATE TABLE `mlm_comhis` (
  `id` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `com_by` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_genhis`
--

CREATE TABLE `mlm_genhis` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `member` int(11) NOT NULL,
  `gen` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_income`
--

CREATE TABLE `mlm_income` (
  `id` int(11) NOT NULL,
  `member` int(11) NOT NULL,
  `by_refer` int(11) NOT NULL DEFAULT '0',
  `by_generation` int(11) NOT NULL DEFAULT '0',
  `by_rank` int(11) NOT NULL DEFAULT '0',
  `by_board` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_members`
--

CREATE TABLE `mlm_members` (
  `id` int(11) NOT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
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
  `got7000` int(11) NOT NULL DEFAULT '0',
  `package_pen` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_packages`
--

CREATE TABLE `mlm_packages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `stock` int(255) NOT NULL,
  `details` text NOT NULL,
  `cost` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlm_packages`
--

INSERT INTO `mlm_packages` (`id`, `name`, `price`, `stock`, `details`, `cost`) VALUES
(1, 'Package A', '3000', 92, '', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `mlm_rank`
--

CREATE TABLE `mlm_rank` (
  `id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sil` int(11) NOT NULL DEFAULT '0',
  `gol` int(11) NOT NULL DEFAULT '0',
  `pla` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mlm_users`
--

CREATE TABLE `mlm_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `balance` int(11) NOT NULL,
  `gen_bal` int(11) NOT NULL DEFAULT '0',
  `board_bal` int(11) NOT NULL DEFAULT '0',
  `id_bal` int(11) NOT NULL DEFAULT '0',
  `account` int(11) NOT NULL DEFAULT '0',
  `vat` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mlm_users`
--

INSERT INTO `mlm_users` (`id`, `email`, `pass`, `balance`, `gen_bal`, `board_bal`, `id_bal`, `account`, `vat`) VALUES
(1, 'admin', 'cd92a26534dba48cd785cdcc0b3e6bd1', 0, 0, 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mlm_cashout`
--
ALTER TABLE `mlm_cashout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_comhis`
--
ALTER TABLE `mlm_comhis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_genhis`
--
ALTER TABLE `mlm_genhis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mlm_income`
--
ALTER TABLE `mlm_income`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `mlm_rank`
--
ALTER TABLE `mlm_rank`
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
-- AUTO_INCREMENT for table `mlm_cashout`
--
ALTER TABLE `mlm_cashout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_comhis`
--
ALTER TABLE `mlm_comhis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_genhis`
--
ALTER TABLE `mlm_genhis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_income`
--
ALTER TABLE `mlm_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_members`
--
ALTER TABLE `mlm_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_packages`
--
ALTER TABLE `mlm_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mlm_rank`
--
ALTER TABLE `mlm_rank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mlm_users`
--
ALTER TABLE `mlm_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
