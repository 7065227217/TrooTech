-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 25, 2021 at 07:04 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT 0,
  `sub_category_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `price` float NOT NULL DEFAULT 0,
  `created_time` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_time` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=umverify,1=verify,99=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `sub_category_id`, `name`, `price`, `created_time`, `updated_time`, `status`) VALUES
(1, 1, 12, 'firstwww444', 2002, '2021-05-25 22:17:18', '2021-05-25 22:19:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `category_id` int(11) NOT NULL,
  `category_parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=diabled, 1=enabled , 99=deleted',
  `created_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_parent_id`, `name`, `status`, `created_time`) VALUES
(1, 0, 'Level 1', 1, '2021-05-25 22:11:08'),
(2, 0, 'Level 2', 1, '2021-05-25 22:11:15'),
(3, 0, 'Level 3', 1, '2021-05-25 22:11:19'),
(4, 1, 'Level 1 Child 1', 1, '2021-05-25 22:12:16'),
(5, 1, 'Level 1 Child 2', 1, '2021-05-25 22:12:19'),
(6, 1, 'Level 1 Child 3', 1, '2021-05-25 22:12:23'),
(7, 2, 'Level 2 Child 1', 1, '2021-05-25 22:12:31'),
(8, 2, 'Level 2 Child 2', 1, '2021-05-25 22:12:34'),
(9, 3, 'Level 3 Child 1', 1, '2021-05-25 22:12:45'),
(10, 3, 'Level 3 Child 2', 1, '2021-05-25 22:12:48'),
(11, 3, 'Level 3 Child 3', 1, '2021-05-25 22:12:51'),
(12, 4, 'Level 1 Child 1 SubChlid 1', 1, '2021-05-25 22:13:44'),
(13, 4, 'Level 1 Child 1 SubChlid 2', 1, '2021-05-25 22:13:57'),
(14, 4, 'Level 1 Child 1 SubChlid 3', 1, '2021-05-25 22:14:00'),
(15, 12, 'Level 1 Child 1 SubChlid 1 SubSubChild 1', 1, '2021-05-25 22:14:43'),
(16, 12, 'Level 1 Child 1 SubChlid 1 SubSubChild 2', 1, '2021-05-25 22:14:46'),
(17, 12, 'Level 1 Child 1 SubChlid 1 SubSubChild 3', 1, '2021-05-25 22:14:50'),
(18, 0, 'level 4', 1, '2021-05-25 22:23:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
