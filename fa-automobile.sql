-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 04, 2020 at 03:54 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fa-automobile`
--

-- --------------------------------------------------------

--
-- Table structure for table `historic`
--

CREATE TABLE `historic` (
  `id` int(11) NOT NULL,
  `table_db` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_action` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `element_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE `mark` (
  `id` int(11) NOT NULL,
  `mark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`id`, `mark`) VALUES
(1, 'Renault'),
(2, 'Peugeot');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `topic` text NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `second_name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `signin_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `second_name`, `mail`, `password`, `admin`, `signin_date`) VALUES
(46, 'COHEN', 'Sacha', 'contact@sacha-cohen.fr', '1F40FC92DA241694750979EE6CF582F2D5D7D28E18335DE05ABC54D0560E0F5302860C652BF08D560252AA5E74210546F369FBBBCE8C12CFC7957B2652FE9A75', 1, '2020-05-01 19:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `mark_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `v_year` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `mark_id`, `model`, `description`, `price`, `v_year`, `picture`, `date_added`) VALUES
(16, 1, 'Mégane', 'Mégane marron claire, 25 000 kilomètres au compteur sur une durée de 5 ans.', 20000, 2016, 'megane.jpg', '2020-04-23 19:51:08'),
(17, 2, '5008', 'Peugeot 5008 en très bon état, utilisée 1 an.', 25000, 2019, 'peugeot.jpg', '2020-04-23 20:05:07'),
(18, 2, '508', '508 grise, achetée en 2012 en vente car plus besoin.', 16000, 2012, 'peugeot 508.jpg', '2020-04-23 20:06:35'),
(19, 2, '206', 'Je vends ma Peugeot 206. 98 300 au compteur kilométrique.', 6000, 2005, '206.jpg', '2020-04-23 20:11:06'),
(20, 2, '308', 'Superbe 308 bleue', 14000, 2017, '308.jpg', '2020-04-23 20:17:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `historic`
--
ALTER TABLE `historic`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `element_id` (`element_id`);

--
-- Indexes for table `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mark_id` (`mark_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `historic`
--
ALTER TABLE `historic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `mark`
--
ALTER TABLE `mark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
