-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 12, 2018 at 09:47 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

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
('enmm@nm.gh', 'Max Br', '89067675764'),
('mnm@bdfg.vom', 'Rokky', '+7 (346) 275 57 89'),
('nic@nm.gh', 'Nic Br', '89067675764');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

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
(72, 'bnmnb@nbv.bmn', '2018-06-12 16:30:47', 'ул. Mirnaya  д. 13/3 кв. 12 эт. 2', 'НАЛИЧНЫМИ', 'МОЖНО ПЕРЕЗВАНИВАТЬ', 'заказ с сайта все готово!!\r\n');

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
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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
