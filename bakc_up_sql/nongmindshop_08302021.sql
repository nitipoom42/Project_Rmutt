-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2021 at 06:41 PM
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
(358, 1, 2, 2),
(359, 1, 2, 1);

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
(1, 'Minato_Namikaze.png', 'nitipoom', '1234', 'นิติภูมิ', 'พาภักดี', '', 7),
(2, 'Minato_Namikaze.png', 'test', '123', 'MiNaTo', 'uchiha', '0989523564', 0),
(11, '119662348_2941581005942522_2639461913280163768_n.jpg', 'mini', 'mini', 'นิติภูมิ', 'พาภักดี', '', 0),
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
  `oder_status` int(1) NOT NULL COMMENT '0=ยังไม่ชำระเงิน\r\n1=ชำระเงินแล้ว\r\n2=กรุณาไปรับสินค้า\r\n3=รับสินค้าแล้ว',
  `status_onti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oder`
--

INSERT INTO `oder` (`ID_Oder`, `Oder_date`, `ID_Member`, `oder_status`, `status_onti`) VALUES
(96, '2021-08-30 13:27:23', 2, 3, 0),
(97, '2021-08-30 15:28:24', 2, 0, 0);

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
(433, '96', 1, 1),
(434, '96', 49, 1),
(436, '97', 1, 5),
(437, '97', 49, 1);

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
(71, 96, 2, 'w644.jpg', 11);

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
(46, 'OFM1005845_X2.jpg', 'ปากกาก 1 ด้าม', 20, 15, '4'),
(47, '8855199141018.jpg', 'น้ำโค้ก 500 มล.', 18, 10, '3'),
(48, 'ShotType1_540x540.jpg', 'ลิปตัน 445 มล.', 20, 0, '3'),
(49, '8850718801138_4.jpg', 'เลย์ พริกเผา 50 กรัม', 35, 0, '2'),
(50, '8850718801893_e17-07-2020.jpg', 'เลย์ สาหร่าย 50 กรัม', 35, 0, '2');

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
(1, '307324.jpg', 'asdf', 10, 188, '1');

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
(1, 'โปรโมชั่น'),
(2, 'ขนม'),
(3, 'เครื่องดื่ม'),
(4, 'เครื่องเขียน');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`ID_bank`);

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
  ADD PRIMARY KEY (`ID_Product`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID_Cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID_Member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `oder`
--
ALTER TABLE `oder`
  MODIFY `ID_Oder` float NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `oder_detail`
--
ALTER TABLE `oder_detail`
  MODIFY `Oder_Detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=438;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `ID_Pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `ID_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `stock_promotion`
--
ALTER TABLE `stock_promotion`
  MODIFY `ID_Product_Promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `ID_Type_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
