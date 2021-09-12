-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2021 at 08:15 PM
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
(10, '241380421_575498553577608_8428704524412989389_n.png'),
(13, '240933043_579624199887287_5855372878033585043_n.png'),
(14, '240910616_376206203988199_2610302686109873337_n.png');

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
  `Point` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`ID_Member`, `IMG_User`, `User`, `Pass`, `Name`, `Lastname`, `Tel`, `Point`) VALUES
(1, 'Minato_Namikaze.png', 'nitipoom', '1234', 'นิติภูมิ', 'พาภักดี', '0912345678', '11'),
(2, 'Minato_Namikaze.png', 'test', '123', 'MiNaTo', 'uchiha', '0989523564', '153'),
(11, '119662348_2941581005942522_2639461913280163768_n.jpg', 'admin', 'admin', 'นิติภูมิ', 'พาภักดี', '0989522564', '300'),
(15, '1de159ab9f3e98f208746d4fdc9b68f8.jpg', 'mini', 'mini', 'นิติภูมิ', 'พาภักดี', '0989523561', '0');

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
(170, '2021-09-10 17:10:20', 2, 3, 0),
(171, '2021-09-09 17:14:19', 2, 3, 0),
(172, '2021-09-10 17:19:26', 11, 4, 0),
(173, '2021-09-06 17:29:29', 11, 4, 0),
(174, '2021-09-08 04:45:08', 11, 4, 0),
(187, '2021-09-11 11:15:20', 2, 3, 0),
(189, '2021-09-11 11:55:05', 2, 3, 0),
(193, '2021-09-11 15:15:52', 2, 3, 0),
(196, '2021-09-11 16:09:07', 11, 4, 0),
(197, '2021-09-11 16:09:25', 11, 4, 0),
(198, '2021-09-11 16:10:09', 11, 4, 0),
(199, '2021-09-11 16:11:51', 11, 4, 0),
(200, '2021-09-11 16:49:57', 11, 4, 0),
(201, '2021-09-11 16:51:03', 11, 4, 0),
(205, '2021-09-11 16:57:13', 2, 3, 0),
(206, '2021-09-11 16:58:13', 11, 4, 0),
(207, '2021-09-11 16:59:34', 2, 1, 0),
(210, '2021-09-11 17:07:21', 11, 4, 0),
(211, '2021-09-11 17:08:34', 11, 4, 0),
(212, '2021-09-11 17:09:24', 11, 4, 0),
(213, '2021-09-11 17:33:15', 11, 4, 0);

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
(633, '170', '345634', 5),
(634, '170', '1232345', 3),
(635, '170', '8850304002604', 1),
(636, '170', '8859126000508', 3),
(637, '170', '8850304081272', 5),
(640, '171', '8850304081272', 5),
(641, '172', '8850304002604', 1),
(642, '173', '8850304002604', 1),
(643, '173', '8850304081272', 1),
(645, '174', '8850304002604', 1),
(646, '174', '8850304002604', 1),
(647, '174', '8850304002604', 1),
(670, '187', '8850304081272', 1),
(674, '189', '456', 3),
(678, '193', '345634', 1),
(683, '196', '6970493060482', 1),
(684, '197', '6970493060482', 1),
(685, '198', '6970493060482', 1),
(686, '199', '6970493060482', 1),
(687, '200', '6970493060482', 1),
(688, '201', '6970493060482', 1),
(692, '205', '1234', 4),
(693, '206', '6970493060482', 1),
(694, '207', '8850304081272', 1),
(697, '210', '8850304002604', 1),
(698, '211', '6970493060482', 1),
(699, '212', '8850304002604', 1),
(700, '213', '6970493060482', 1);

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
(76, 118, 2, 'w644.jpg', 11),
(77, 124, 2, 'w644.jpg', 11),
(78, 125, 2, 'w644.jpg', 11),
(79, 134, 2, 'w644.jpg', 11),
(80, 142, 2, 'File_001-900x733.jpg', 11),
(81, 143, 2, '8850718801138_4.jpg', 11),
(82, 149, 2, 'w644.jpg', 10),
(83, 153, 2, 'w644.jpg', 11),
(84, 160, 2, '10 นิติภูมิ.png', 11),
(85, 159, 2, '1de159ab9f3e98f208746d4fdc9b68f8.jpg', 11),
(86, 158, 2, '307324.jpg', 11),
(87, 168, 2, '10 นิติภูมิ.png', 10),
(88, 170, 2, 'w644.jpg', 10),
(89, 171, 2, '8855199141018.jpg', 10),
(90, 187, 2, '10 นิติภูมิ.png', 10),
(91, 188, 2, '8850718801893_e17-07-2020.jpg', 11),
(92, 189, 2, 'w644.jpg', 11),
(93, 192, 2, 'w644.jpg', 10),
(94, 193, 2, '241380421_575498553577608_8428704524412989389_n.png', 11),
(95, 195, 2, '307324.jpg', 10),
(96, 194, 2, '8850718801138_4.jpg', 10),
(97, 202, 2, '10 นิติภูมิ.png', 10),
(98, 203, 2, '10 นิติภูมิ.png', 10),
(99, 204, 2, '8850718801893_e17-07-2020.jpg', 10),
(100, 205, 2, '8855199141018.jpg', 10),
(101, 207, 2, '8850718801138_4.jpg', 10);

-- --------------------------------------------------------

--
-- Table structure for table `status_product`
--

CREATE TABLE `status_product` (
  `ID_Status_Product` int(11) NOT NULL,
  `INFO_Status_Product` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_product`
--

INSERT INTO `status_product` (`ID_Status_Product`, `INFO_Status_Product`) VALUES
(1, 'พร้อมใช้งาน'),
(2, 'ยกเลิกการขาย');

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
  `Cost_PRICE_Product` float NOT NULL,
  `TYPE_Product` varchar(255) NOT NULL,
  `Status_Product` int(11) NOT NULL COMMENT '1=แสดงค้า\r\n 2=ไม่แสดงสินค้า'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`ID_Pro`, `ID_Product`, `IMG_Product`, `NAME_Product`, `PRICE_Product`, `QTY_Product`, `Cost_PRICE_Product`, `TYPE_Product`, `Status_Product`) VALUES
(46, '8850304081272', 'OFM1005845_X2.jpg', 'ปากกาก 1 ด้าม', 20, 153, 15, '4', 1),
(47, '8859126000508', '8855199141018.jpg', 'น้ำโค้ก 500 มล.', 18, 181, 12, '3', 1),
(48, '8850304002604', 'ShotType1_540x540.jpg', 'ลิปตัน 445 มล.', 20, 354, 15, '3', 1),
(50, '456', '8850718801893_e17-07-2020.jpg', 'เลย์ สาหร่าย 50 กรัม', 35, 203, 20, '2', 1),
(83, '6970493060482', '8850718801138_4.jpg', 'เลย์ รสพริกเผา  50 กรัม', 50, 41, 20, '2', 2),
(84, '1232345', 'ShotType1_540x540 (1).jpg', 'ขนมไก่ย่าง', 23, 216, 10, '2', 1),
(85, '345634', 'ShotType1_540x540 (2).jpg', 'โปเต้', 15, 15, 7, '2', 1),
(86, '6970493060482', '307324.jpg', 'asdf', 35, 63, 20, '4', 1),
(87, '1234', '240910616_376206203988199_2610302686109873337_n.png', 'ทดสอบ', 80, 116, 50, '3', 1);

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
(3, '8858868803088.jpg', 'ข้าวหอมมะลิ ตราฉัตร', 80, 5, '1');

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
-- Indexes for table `status_product`
--
ALTER TABLE `status_product`
  ADD PRIMARY KEY (`ID_Status_Product`);

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
  MODIFY `ID_Banner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `ID_Cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `ID_Member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `oder`
--
ALTER TABLE `oder`
  MODIFY `ID_Oder` float NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT for table `oder_detail`
--
ALTER TABLE `oder_detail`
  MODIFY `Oder_Detail_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701;

--
-- AUTO_INCREMENT for table `pay`
--
ALTER TABLE `pay`
  MODIFY `ID_Pay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `status_product`
--
ALTER TABLE `status_product`
  MODIFY `ID_Status_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `ID_Pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `stock_promotion`
--
ALTER TABLE `stock_promotion`
  MODIFY `ID_Product_Promotion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_product`
--
ALTER TABLE `type_product`
  MODIFY `ID_Type_Product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
