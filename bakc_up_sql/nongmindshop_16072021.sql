-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2021 at 06:51 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nongmindshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID_Cart` int(11) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `ID_Member` int(11) NOT NULL,
  `QTY` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`ID_Cart`, `ID_Product`, `ID_Member`, `QTY`) VALUES
(32, 34, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `ID_Member` int(11) NOT NULL,
  `IMG_User` varchar(255) NOT NULL,
  `User` varchar(255) NOT NULL,
  `Pass` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Point` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`ID_Member`, `IMG_User`, `User`, `Pass`, `Name`, `Lastname`, `Point`) VALUES
(1, 'Minato_Namikaze.png', 'nitipoom', '1234', 'นิติภูมิ', 'พาภักดี', 0),
(2, 'Minato_Namikaze.png', 'test', '123', 'MiNaTo', 'uchiha', 0);

-- --------------------------------------------------------

--
-- Table structure for table `oder`
--

CREATE TABLE `oder` (
  `ID_Oder` varchar(255) NOT NULL,
  `Oder_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_Member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oder`
--

INSERT INTO `oder` (`ID_Oder`, `Oder_date`, `ID_Member`) VALUES
('1661da6bb5', '0000-00-00 00:00:00', 2),
('1662f0fd06', '0000-00-00 00:00:00', 1),
('166ad995b1', '0000-00-00 00:00:00', 1),
('169170a952', '0000-00-00 00:00:00', 1),
('1693fc7b84', '0000-00-00 00:00:00', 1),
('169839da51', '0000-00-00 00:00:00', 1),
('16989c9376', '0000-00-00 00:00:00', 1),
('169b0f01d9', '0000-00-00 00:00:00', 1),
('169bbecea8', '0000-00-00 00:00:00', 1),
('169d1d325a', '0000-00-00 00:00:00', 1),
('16a2b500ea', '0000-00-00 00:00:00', 1),
('16f3988fe1', '0000-00-00 00:00:00', 1),
('16f3cd172a', '0000-00-00 00:00:00', 1),
('16f3eaf7ba', '0000-00-00 00:00:00', 1),
('16f6466bac', '0000-00-00 00:00:00', 1),
('16fc482298', '0000-00-00 00:00:00', 1),
('16fc7de4bb', '0000-00-00 00:00:00', 1),
('16ff3854aa', '0000-00-00 00:00:00', 1),
('17040eef46', '0000-00-00 00:00:00', 1),
('1704322c47', '0000-00-00 00:00:00', 1),
('170441367a', '0000-00-00 00:00:00', 1),
('1704de7f23', '0000-00-00 00:00:00', 1),
('17051b9af1', '0000-00-00 00:00:00', 1),
('1707c1d7e1', '0000-00-00 00:00:00', 1),
('171b6a3de4', '2021-07-16 11:47:02', 1),
('171be2b94f', '2021-07-16 11:47:10', 1),
('171d5ac430', '2021-07-16 11:47:33', 1),
('1818c7cf24', '2021-07-16 12:54:36', 1),
('1', '2021-07-16 13:02:38', 22),
('18dab93f45', '2021-07-16 13:46:19', 1),
('18dcb44408', '2021-07-16 13:46:51', 1),
('18de5a8ce9', '2021-07-16 13:47:17', 1),
('18e1710be0', '2021-07-16 13:48:07', 1),
('18e25e6bd3', '2021-07-16 13:48:21', 1),
('18eed71d14', '2021-07-16 13:51:41', 1),
('18f2b13e52', '2021-07-16 13:52:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oder_detail`
--

CREATE TABLE `oder_detail` (
  `Oder_Detail_ID` int(11) NOT NULL,
  `ID_Oder` varchar(255) NOT NULL,
  `ID_Product` int(11) NOT NULL,
  `QTY` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oder_detail`
--

INSERT INTO `oder_detail` (`Oder_Detail_ID`, `ID_Oder`, `ID_Product`, `QTY`) VALUES
(123, '1', 4124, 124),
(124, '1662f0fd06', 34, 108),
(125, '1662f0fd06', 35, 27),
(127, '1661da6bb5', 36, 142),
(128, '1661da6bb5', 37, 89),
(130, '1661da6bb5', 36, 2),
(131, '1661da6bb5', 37, 2),
(133, '1661da6bb5', 36, 2),
(134, '1662f0fd06', 34, 5),
(135, '1662f0fd06', 34, 5),
(136, '1662f0fd06', 35, 3),
(138, '1662f0fd06', 36, 1),
(139, '1662f0fd06', 37, 2),
(141, '1662f0fd06', 36, 1),
(142, '1662f0fd06', 37, 2);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `ID_Product` int(11) NOT NULL,
  `IMG_Product` varchar(255) NOT NULL,
  `NAME_Product` varchar(255) NOT NULL,
  `PRICE_Product` float NOT NULL,
  `QTY_Product` float NOT NULL,
  `TYPE_Product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`ID_Product`, `IMG_Product`, `NAME_Product`, `PRICE_Product`, `QTY_Product`, `TYPE_Product`) VALUES
(34, 'ShotType1_540x540.jpg', 'เลย์', 35, 82, '1'),
(35, '8850765105098.jpg', 'ปูไทย', 23, 86, '1'),
(36, '8851959143018_4.jpg', 'โค้ก', 12, 38, '2'),
(37, '8854698005050_1.webp', 'โออิชิ', 30, 33, '2');

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `ID_Type_Product` int(11) NOT NULL,
  `INFO_Type_Product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_product`
--

INSERT INTO `type_product` (`ID_Type_Product`, `INFO_Type_Product`) VALUES
(1, 'ขนม'),
(2, 'เครื่องดื่ม');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`ID_Cart`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`ID_Member`);

--
-- Indexes for table `oder_detail`
--
ALTER TABLE `oder_detail`
  ADD PRIMARY KEY (`Oder_Detail_ID`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID_Product`);

--
-- Indexes for table `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`ID_Type_Product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID_Cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID_Member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oder_detail`
--
ALTER TABLE `oder_detail`
  MODIFY `Oder_Detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `ID_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `ID_Type_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
