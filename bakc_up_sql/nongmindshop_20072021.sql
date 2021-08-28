-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 07:41 PM
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
(2, 'Minato_Namikaze.png', 'test', '123', 'MiNaTo', 'uchiha', 0),
(3, 'Narutos_Sage_Mode.jpg', 'mini', 'mini', 'mini', 'v2', 500),
(4, 'maxresdefault.jpg', 'mk', '1234', 'มาย', 'สุดสวย', 0),
(5, 'unnamed.jpg', '', '', '', '', 0),
(6, 'unnamed.jpg', 'kaimook', 'kaimook17', 'pimlaput', 'akanimat', 0),
(7, '', 'test', 'test', '', '', 0),
(9, '119662348_2941581005942522_2639461913280163768_n.jpg', 'nitipoom42', '1234', 'นิติภูมิ', 'พาภักดี', 0);

-- --------------------------------------------------------

--
-- Table structure for table `oder`
--

CREATE TABLE `oder` (
  `ID_Oder` float NOT NULL,
  `Oder_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ID_Member` int(11) NOT NULL,
  `oder_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oder`
--

INSERT INTO `oder` (`ID_Oder`, `Oder_date`, `ID_Member`, `oder_status`) VALUES
(13, '2021-07-19 13:15:59', 2, 1),
(14, '2021-07-19 13:16:20', 2, 1),
(15, '2021-07-19 13:16:52', 2, 1),
(16, '2021-07-19 13:17:51', 2, 1);

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
(309, '13', 35, 1),
(310, '14', 36, 3),
(311, '15', 35, 6),
(312, '15', 36, 7),
(314, '16', 35, 6),
(315, '16', 36, 7);

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
(34, 'ShotType1_540x540.jpg', 'เลย์', 35, 17, '1'),
(35, '8850765105098.jpg', 'ปูไทย', 23, 21, '1'),
(36, '8851959143018_4.jpg', 'โค้ก', 12, -29, '2');

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
-- Indexes for table `oder`
--
ALTER TABLE `oder`
  ADD PRIMARY KEY (`ID_Oder`);

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
  MODIFY `ID_Cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID_Member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `oder`
--
ALTER TABLE `oder`
  MODIFY `ID_Oder` float NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `oder_detail`
--
ALTER TABLE `oder_detail`
  MODIFY `Oder_Detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=317;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `ID_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `ID_Type_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
