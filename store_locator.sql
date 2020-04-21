-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2020 at 03:03 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store_locator`
--

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL COMMENT 'Store name',
  `description` varchar(255) DEFAULT NULL COMMENT 'store description',
  `address_line` text DEFAULT NULL COMMENT 'complete address line',
  `street_number` varchar(255) DEFAULT NULL COMMENT 'store number',
  `route` varchar(255) DEFAULT NULL COMMENT 'route street or area',
  `city` varchar(255) DEFAULT NULL COMMENT 'store city name',
  `state` varchar(255) DEFAULT NULL COMMENT 'state name',
  `zipcode` varchar(10) DEFAULT NULL COMMENT 'Area code',
  `country` varchar(100) DEFAULT NULL COMMENT 'Country name',
  `phone` varchar(15) DEFAULT NULL COMMENT 'store contact number',
  `image` varchar(100) DEFAULT NULL COMMENT 'Store image name',
  `open_close_time` varchar(255) NOT NULL COMMENT 'store open time, close time',
  `is_delete` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'is delete no, 0, 1 for deleted',
  `active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1: active, 0: inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Store information table';

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `description`, `address_line`, `street_number`, `route`, `city`, `state`, `zipcode`, `country`, `phone`, `image`, `open_close_time`, `is_delete`, `active`) VALUES
(1, 'The Art Gallery', 'We serve better the artist skill', '45, Abhinandan Nagar Road, Sundar Nagar Colony, DDU Nagar, Sukhlia, Indore, Madhya Pradesh, India', '45', 'Abhinandan Nagar Road', 'Indore', 'MP', '452003', 'India', '08817932366', NULL, '', 0, 1),
(2, 'My book shop', 'Get you fav book', 'Florida Kalea, Vitoria-Gasteiz, Spain', '', 'Rajewadi Road', 'Rajewadi', 'MH', '410509', 'India', '1234567890', NULL, '', 0, 1),
(3, 'The lap care', 'Get your leptop ready', '1001, Bhagirath Pura Main Road, Khatik Mohalla, Pardesi Pura, Sukhlia, Indore, Madhya Pradesh, India', '1001', 'Bhagirath Pura Main Road', 'Indore', 'MP', '452003', 'India', '4785639110', NULL, '', 0, 1),
(4, 'Child care', 'Get  cloths for your child', 'A San Diego 45, San Diego Acapulco, Atlixco, Puebla, Mexico', '', 'Khajuri Bazaar Main Road', 'Indore', 'MP', '452002', 'India', '8965231478', NULL, '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `store_visitor`
--

CREATE TABLE `store_visitor` (
  `id` int(11) NOT NULL,
  `store_id` int(11) DEFAULT NULL COMMENT 'visited store id',
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL COMMENT 'user id',
  `is_checkin` tinyint(1) NOT NULL DEFAULT 0 COMMENT '1 checkit, 0: checkout'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_visitor`
--

INSERT INTO `store_visitor` (`id`, `store_id`, `date`, `user_id`, `is_checkin`) VALUES
(10, 1, '2020-04-18 15:42:20', 5, 0),
(11, 1, '2020-04-18 15:47:19', 1, 0),
(12, 4, '2020-04-18 15:47:34', 3, 1),
(13, 4, '2020-04-18 15:49:04', 8, 1),
(14, 1, '2020-04-18 15:49:38', 12, 1),
(15, 2, '2020-04-18 15:49:42', 18, 1),
(16, 3, '2020-04-18 15:49:46', 6, 1),
(17, 4, '2020-04-18 15:49:49', 16, 1),
(18, 1, '2020-04-18 15:50:15', 7, 0),
(19, 2, '2020-04-18 15:50:18', 4, 0),
(20, 3, '2020-04-18 15:50:22', 9, 0),
(21, 1, '2020-04-18 15:50:31', 14, 0),
(22, 3, '2020-04-18 15:51:17', 13, 0),
(23, 2, '2020-04-18 16:16:25', 17, 0),
(24, 1, '2020-04-18 16:16:46', 19, 0),
(25, 2, '2020-04-18 16:37:18', 2, 1),
(26, 1, '2020-04-18 16:42:33', 10, 1),
(27, 2, '2020-04-18 16:42:45', 11, 1),
(28, 3, '2020-04-18 16:43:03', 15, 0),
(29, 1, '2020-04-18 17:19:34', 20, 1),
(30, 1, '2020-04-18 17:38:28', 15, 1),
(31, 1, '2020-04-18 17:38:35', 14, 1),
(32, 3, '2020-04-18 17:39:01', 9, 1),
(33, 3, '2020-04-18 17:39:07', 4, 1),
(34, 1, '2020-04-18 17:39:13', 19, 1),
(35, 1, '2020-04-18 18:03:39', 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `stores` ADD FULLTEXT KEY `store_name` (`store_name`,`address_line`);
ALTER TABLE `stores` ADD FULLTEXT KEY `store_search` (`store_name`);

--
-- Indexes for table `store_visitor`
--
ALTER TABLE `store_visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `store_visitor`
--
ALTER TABLE `store_visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
