-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 14, 2018 at 05:48 PM
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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) UNSIGNED NOT NULL,
  `userId` int(11) UNSIGNED NOT NULL,
  `dateOrder` timestamp NOT NULL,
  `shippingAddress` varchar(255) NOT NULL,
  `typePayment` enum('НАЛИЧНЫМИ','КАРТОЙ') NOT NULL,
  `callback` enum('НЕ ПЕРЕЗВАНИВАТЬ','МОЖНО ПЕРЕЗВАНИВАТЬ') NOT NULL,
  `comments` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `userId`, `dateOrder`, `shippingAddress`, `typePayment`, `callback`, `comments`) VALUES
(1, 11, '2018-06-14 14:15:20', 'dbfmgbndmf vbnm vb', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'bn'),
(2, 11, '2018-06-14 14:18:41', 'dbfmgbndmf vbnm vb', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'bn'),
(3, 11, '2018-06-14 14:20:25', 'dbfmgbndmf vbnm vb', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'bn'),
(4, 11, '2018-06-14 14:20:45', 'dbfmgbndmf vbnm vb', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'bn'),
(5, 11, '2018-06-14 14:22:28', 'dbfmgbndmf vbnm vb', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'bn'),
(6, 11, '2018-06-14 14:28:36', 'dbfmgbndmf vbnm vb', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'bn'),
(7, 11, '2018-06-14 14:30:04', 'dbfmgbndmf vbnm vb', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'bn'),
(8, 11, '2018-06-14 14:30:23', 'dbfmgbndmf vbnm vb', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'bn'),
(9, 20, '2018-06-14 14:33:22', 'ул. sdgdgdf  д. 1/1 кв. 11 эт. 1', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 's'),
(10, 21, '2018-06-14 14:35:02', 'ул. sdgdgdf  д. 14/17 кв. 11 эт. 1', 'НАЛИЧНЫМИ', 'МОЖНО ПЕРЕЗВАНИВАТЬ', ''),
(11, 22, '2018-06-14 14:41:20', 'ул. Mirnaya  д. 14/17 кв. 11 эт. 1', 'КАРТОЙ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'протестили'),
(12, 22, '2018-06-14 14:42:41', 'ул. Mirnaya  д. 14/17 кв. 11 эт. 1', 'НАЛИЧНЫМИ', 'НЕ ПЕРЕЗВАНИВАТЬ', 'протестили');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `phone`) VALUES
(7, 'qwqwq@we.aa', 'qwqwq', '121221221'),
(9, 'qwqwq@we.aaa', 'Greg', '856-34687-578'),
(10, 'qwqwq@we.aaaa', 'Greg', '856-34687-578'),
(11, 'qwqwq111@we.aaaa', 'Greg', '856-34687-578'),
(20, 'mnm@bdfg.vom', 'vasya', '+7 (325) 532 53 64'),
(21, 'dfgh@bdfg.vom', 'Vasya', '+7 (325) 532 53 64'),
(22, 'billetter@bdfg.v', 'Юля', '+7 (453) 876 94 56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
