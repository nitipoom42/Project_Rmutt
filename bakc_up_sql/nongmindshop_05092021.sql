-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2021 at 07:40 PM
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
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `ID_bank` int(11) NOT NULL,
  `IMG_bank` varchar(255) NOT NULL,
  `NAME_bank` varchar(255) NOT NULL,
  `NUM_bank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`ID_bank`, `IMG_bank`, `NAME_bank`, `NUM_bank`) VALUES
(10, 'ธ_กสิกรไทย.jpg', 'กสิกร', 123),
(11, 'เว็บไซต์ทำ-QR-Code-ชำระเงิน-บัญชีพร้อมเพย์.jpg', 'พร้อมเพย์', 123);

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `ID_Banner` int(11) NOT NULL,
  `IMG_Banner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`ID_Banner`, `IMG_Banner`) VALUES
(6, 'asdasd-07.jpg'),
(7, '307324.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `ID_Cart` int(11) NOT NULL,
  `ID_Product` varchar(255) NOT NULL,
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
  `Tel` varchar(255) NOT NULL,
  `Point` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`ID_Member`, `IMG_User`, `User`, `Pass`, `Name`, `Lastname`, `Tel`, `Point`) VALUES
(1, 'Minato_Namikaze.png', 'nitipoom', '1234', 'นิติภูมิ', 'พาภักดี', '0912345678', 10.75),
(2, 'Minato_Namikaze.png', 'test', '123', 'MiNaTo', 'uchiha', '0989523564', 117.35),
(11, '119662348_2941581005942522_2639461913280163768_n.jpg', 'admin', 'admin', 'นิติภูมิ', 'พาภักดี', '', 0),
(12, 'ShotType1_540x540.jpg', 'nitipoom', '0989523564', 'Nitipoom', 'Phapakdee', '', 0),
(13, 'OFM1005845_X2.jpg', 'eye', '1234', 'อาย', 'อายอาย', '', 2.75);

-- --------------------------------------------------------

--
-- Table structure for table `oder`
--

CREATE TABLE `oder` (
  `ID_Oder` float NOT NULL,
  `Oder_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_Member` int(11) NOT NULL,
  `oder_status` int(1) NOT NULL COMMENT '0=ยังไม่ชำระเงิน\r\n1=ชำระเงินแล้ว\r\n2=กรุณาไปรับสินค้า\r\n3=รับสินค้าแล้ว\r\n4=หน้าร้าน\r\n',
  `status_onti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oder`
--

INSERT INTO `oder` (`ID_Oder`, `Oder_date`, `ID_Member`, `oder_status`, `status_onti`) VALUES
(116, '2021-09-04 16:10:21', 11, 4, 0),
(117, '2021-09-04 16:10:57', 11, 4, 0),
(118, '2021-09-04 16:12:05', 2, 3, 0),
(120, '2021-09-04 16:59:57', 11, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `oder_detail`
--

CREATE TABLE `oder_detail` (
  `Oder_Detail_ID` int(11) NOT NULL,
  `ID_Oder` varchar(255) NOT NULL,
  `ID_Product` varchar(255) NOT NULL,
  `QTY` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oder_detail`
--

INSERT INTO `oder_detail` (`Oder_Detail_ID`, `ID_Oder`, `ID_Product`, `QTY`) VALUES
(468, '116', '6970493060482', 1),
(469, '117', '6970493060482', 1),
(470, '118', '456', 1),
(471, '118', '8859126000508', 2),
(473, '119', '6970493060482', 1),
(474, '120', '6970493060482', 1),
(475, '120', '6970493060482', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pay`
--

CREATE TABLE `pay` (
  `ID_Pay` int(11) NOT NULL,
  `ID_Oder` int(11) NOT NULL,
  `ID_Member` int(11) NOT NULL,
  `IMG_Pay` varchar(255) NOT NULL,
  `NAME_bank` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pay`
--

INSERT INTO `pay` (`ID_Pay`, `ID_Oder`, `ID_Member`, `IMG_Pay`, `NAME_bank`) VALUES
(71, 96, 2, 'w644.jpg', 11),
(72, 98, 2, 'w644.jpg', 10),
(73, 99, 1, 'w644.jpg', 11),
(74, 100, 1, 'cryu2p.jpg', 11),
(75, 101, 2, 'w644.jpg', 11),
(76, 118, 2, 'w644.jpg', 11);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `ID_Pro` int(11) NOT NULL,
  `ID_Product` varchar(255) NOT NULL,
  `IMG_Product` varchar(255) NOT NULL,
  `NAME_Product` varchar(255) NOT NULL,
  `PRICE_Product` float NOT NULL,
  `QTY_Product` float NOT NULL,
  `TYPE_Product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`ID_Pro`, `ID_Product`, `IMG_Product`, `NAME_Product`, `PRICE_Product`, `QTY_Product`, `TYPE_Product`) VALUES
(46, '8850304081272', 'OFM1005845_X2.jpg', 'ปากกาก 1 ด้าม', 20, 195, '4'),
(47, '8859126000508', '8855199141018.jpg', 'น้ำโค้ก 500 มล.', 18, 195, '3'),
(48, '123', 'ShotType1_540x540.jpg', 'ลิปตัน 445 มล.', 20, 196, '3'),
(50, '456', '8850718801893_e17-07-2020.jpg', 'เลย์ สาหร่าย 50 กรัม', 35, 13, '2'),
(80, '45676', 'เว็บไซต์ทำ-QR-Code-ชำระเงิน-บัญชีพร้อมเพย์.jpg', 'สาหร่ายเถ้าแก่น้อย', 35, 33, '2'),
(81, '432', 'asdasd-07.jpg', 'ปากกาก', 20, 196, '2'),
(83, '6970493060482', '8850718801138_4.jpg', 'เลย์ รสพริกเผา  50 กรัม', 20, 5, '2');

-- --------------------------------------------------------

--
-- Table structure for table `stock_promotion`
--

CREATE TABLE `stock_promotion` (
  `ID_Product_Promotion` int(11) NOT NULL,
  `IMG_Product` varchar(255) NOT NULL,
  `NAME_Product` varchar(255) NOT NULL,
  `POINT_Product` float NOT NULL,
  `QTY_Product` float NOT NULL,
  `TYPE_Product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock_promotion`
--

INSERT INTO `stock_promotion` (`ID_Product_Promotion`, `IMG_Product`, `NAME_Product`, `POINT_Product`, `QTY_Product`, `TYPE_Product`) VALUES
(1, '307324.jpg', 'ddd', 11, 9, '1');

-- --------------------------------------------------------

--
-- Table structure for table `type_product`
--

CREATE TABLE `type_product` (
  `ID_Type_Product` int(11) NOT NULL,
  `IMG_Type_Product` varchar(255) NOT NULL,
  `INFO_Type_Product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_product`
--

INSERT INTO `type_product` (`ID_Type_Product`, `IMG_Type_Product`, `INFO_Type_Product`) VALUES
(1, 'promotion.jpg', 'โปรโมชั่น'),
(2, '1de159ab9f3e98f208746d4fdc9b68f8.jpg', 'ขนม'),
(3, 'WATER-BOTTLE.jpg', 'เครื่องดื่ม'),
(4, 'cryu2p.jpg', 'เครื่องเขียน');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`ID_bank`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`ID_Banner`);

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
-- Indexes for table `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`ID_Pay`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`ID_Pro`);

--
-- Indexes for table `stock_promotion`
--
ALTER TABLE `stock_promotion`
  ADD PRIMARY KEY (`ID_Product_Promotion`);

--
-- Indexes for table `type_product`
--
ALTER TABLE `type_product`
  ADD PRIMARY KEY (`ID_Type_Product`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `ID_bank` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `ID_Banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID_Cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=560;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID_Member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `oder`
--
ALTER TABLE `oder`
  MODIFY `ID_Oder` float NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `oder_detail`
--
ALTER TABLE `oder_detail`
  MODIFY `Oder_Detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=477;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `ID_Pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `ID_Pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `stock_promotion`
--
ALTER TABLE `stock_promotion`
  MODIFY `ID_Product_Promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `ID_Type_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
