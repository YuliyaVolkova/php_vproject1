-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 13, 2018 at 08:04 PM
-- Server version: 5.7.20
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `burgers`
--
CREATE DATABASE IF NOT EXISTS `burgers` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `burgers`;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `email` varchar(128) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`email`, `name`, `phone`) VALUES
('bnmnb@nbv.bmn', 'josef', '+7 (435) 878 96 36'),
('bnmnbvmcb@nbv.bmn', 'test', '8094386908'),
('enmm@nm.gh', 'Max Br', '89067675764'),
('misha@nbv.bm', 'Misha', '+7 (435) 878 97 89'),
('mnm@bdfg.vom', 'Rokky', '+7 (346) 275 57 89'),
('nic@nm.gh', 'Nic Br', '89067675764'),
('ttt@tyui.jo', 'u909090', '+7 (435) 275 74 26');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `orderid` int(11) NOT NULL,
  `customeremail` varchar(128) NOT NULL,
  `dateorder` timestamp NULL DEFAULT NULL,
  `shippingaddress` varchar(255) DEFAULT NULL,
  `typepay` enum('НАЛИЧНЫМИ','КАРТОЙ') DEFAULT NULL,
  `callback` enum('НЕ ПЕРЕЗВАНИВАТЬ','МОЖНО ПЕРЕЗВАНИВАТЬ') DEFAULT NULL,
  `ordercomments` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `customeremail`, `dateorder`, `shippingaddress`, `typepay`, `callback`, `ordercomments`) VALUES
(70, 'bnmnb@nbv.bmn', '2018-06-12 16:22:42', 'ул. Mirnaya  д. 13/3 кв. 12 эт. 2', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'заказ с сайта'),
(71, 'bnmnb@nbv.bmn', '2018-06-12 16:29:25', 'ул. Mirnaya  д. 13/3 кв. 12 эт. 2', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'заказ с сайта'),
(72, 'bnmnb@nbv.bmn', '2018-06-12 16:30:47', 'ул. Mirnaya  д. 13/3 кв. 12 эт. 2', 'НАЛИЧНЫМИ', 'МОЖНО ПЕРЕЗВАНИВАТЬ', 'заказ с сайта все готово!!\r\n'),
(73, 'misha@nbv.bm', '2018-06-12 19:35:49', 'ул. Aviatorov Baltiki  д. 7/1 кв. 86 эт. 8', 'КАРТОЙ', 'МОЖНО ПЕРЕЗВАНИВАТЬ', 'Мишин заказ\r\n'),
(74, 'misha@nbv.bm', '2018-06-12 19:37:30', 'ул. Aviatorov Baltiki  д. 6/1 кв. 86 эт. 8', 'НАЛИЧНЫМИ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'Мишин заказ 2\r\n'),
(75, 'ttt@tyui.jo', '2018-06-13 14:53:38', 'ул. ddddddddd  д. 23/1 кв. 22 эт. 1', 'НАЛИЧНЫМИ', 'МОЖНО ПЕРЕЗВАНИВАТЬ', 'dddddddd'),
(76, 'mnm@bdfg.vom', '2018-06-13 15:09:28', 'ул. gghjhghg  д. 11/2 кв. 2 эт. 2', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'test'),
(77, 'mnm@bdfg.vom', '2018-06-13 15:11:37', 'ул. gghjhghg  д. 11/2 кв. 2 эт. 5', 'НАЛИЧНЫМИ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'test1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `customeremail` (`customeremail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customeremail`) REFERENCES `customers` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
