-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 21, 2018 at 06:52 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `BatchNo` char(10) NOT NULL,
  `ItemCode` char(5) NOT NULL,
  `ExpiredDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`BatchNo`, `ItemCode`, `ExpiredDate`) VALUES
('20170501C4', 'D0005', '2019-01-01'),
('20170511C5', 'D0005', '2019-01-11'),
('20170303B1', 'L0003', '2019-03-03'),
('20171113C4', 'L0003', '2019-09-11'),
('20171225D1', 'C0002', '2019-05-28'),
('20171225D2', 'C0002', '2019-05-30'),
('20171225H2', 'C0002', '2019-02-30'),
('20171225H3', 'C0002', '2019-03-25'),
('20180125D1', 'L0018', '2021-02-15'),
('20180823A1', 'T0001', '2020-04-24'),
('20180926B1', 'T0001', '2020-06-30'),
('20180926B2', 'T0001', '2020-10-05'),
('MISS', 'MISS', '2000-01-01');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ClientCode` char(4) NOT NULL,
  `CompanyName` varchar(50) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `ContactNo` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ClientCode`, `CompanyName`, `Address`, `ContactNo`, `Email`, `Remark`) VALUES
('A001', 'Amazing Facial Salon', 'No. 3, Lane 6, Xiangyang Road, Fengyuan District, 420 Taichung City', '04-2515-1603', 'Amazing63coffee@yahoo.com', ''),
('C003', 'CoCo Space Beauty', 'No. 809, Dadun Road, Nantun District, Taichung City, 408', '04 2378 7886', 'CoCoSBeauty@outlook.com', ''),
('M002', 'Make Perfect Shop', '30, YongKang Road, Daan Dist., 106 Taipei', '02-23965208', 'makeperfect@gmail.com', ''),
('W003', 'Wonderful Land', 'No. 597, Heping Road, Hualien City, Hualien County, 970', '02 2331 2270', 'purchase@wonderful.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmployeeCode` char(4) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `ContactNo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmployeeCode`, `Name`, `ContactNo`) VALUES
('0001', 'Jiaze', '0932517250'),
('0002', 'Tina', '0901234789'),
('0023', 'Aloysia', '0966-754-615'),
('0088', 'Moses', '0903-220-077'),
('0133', 'Andy', '0903-908-572'),
('0256', 'Ted', '0951-267-958');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `LocationCode` varchar(10) NOT NULL,
  `LocationDescription` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`LocationCode`, `LocationDescription`) VALUES
('BA-1F-1A', 'Block A, 1 Floor, Area 1A'),
('BA-1F-1B', 'Block A, 1 Floor, Area 1B'),
('BA-1F-1C', 'Block A, 1 Floor, Area 1C'),
('BA-1F-1D', 'Block A, 1 Floor, Area 1D'),
('BA-2F-2A', 'Block A, 2 Floor, Area 2A'),
('BA-2F-2B', 'Block A, 2 Floor, Area 2B'),
('BA-2F-2C', 'Block A, 2 Floor, Area 2C'),
('BA-2F-2D', 'Block A, 2 Floor, Area 2D');

-- --------------------------------------------------------

--
-- Table structure for table `po_detail`
--

CREATE TABLE `po_detail` (
  `PONo` char(12) NOT NULL,
  `ItemCode` char(5) NOT NULL,
  `BatchNo` char(10) NOT NULL,
  `Qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `po_detail`
--

INSERT INTO `po_detail` (`PONo`, `ItemCode`, `BatchNo`, `Qty`) VALUES
('PO1711130120', 'L0003', '20171113C4', 30),
('PO1712250002', 'C0002', '20171225D1', 30),
('PO1801250033', 'L0018', '20180125D1', 30),
('PO1808230501', 'T0001', '20180823A1', 20),
('PO1809260265', 'T0001', '20180926B1', 25),
('PO1809260265', 'T0001', '20180926B2', 25);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ItemCode` char(5) NOT NULL,
  `ItemDescription` varchar(100) NOT NULL,
  `ItemType` varchar(20) DEFAULT NULL,
  `Brand` varchar(20) DEFAULT NULL,
  `Location` varchar(10) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  `wBatch` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ItemCode`, `ItemDescription`, `ItemType`, `Brand`, `Location`, `isActive`, `wBatch`) VALUES
('C0002', 'Facial Wash', 'Cleaser', 'Dr.Satin', 'BA-1F-1D', 1, 1),
('L0003', 'Whitening Lotion', 'Lotion', 'Dr.Satin', 'BA-1F-1D', 1, 1),
('L0018', 'Hydrating Lotion', 'Lotion', 'Naruko', 'BA-1F-1B', 1, 1),
('I0033', 'Moisture Lotion', 'Lotion', 'Shiseido ', 'BA-1F-1C', 1, 1),
('MISS', 'Missing Product', NULL, NULL, NULL, 1, 0),
('S0001', 'Hydrating Sunblock', 'Sunblock', 'Avene', 'BA-2F-2D', 1, 1),
('D0005', 'Refreshing Sunblock', 'Sunblock', 'Shiseido', 'BA-2F-2B', 1, 1),
('T0001', 'Hydrating Toner', 'Toner', 'Dr.Satin', 'BA-1F-1D', 1, 1),
('N0002', 'Hydrating Mask', 'Mask', 'SK-II', 'BA-2F-2C', 1, 1),
('H0002', 'Anti-aging Essence', 'Essence', 'Shiseido', 'BA-2F-2B', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `PONo` char(12) NOT NULL,
  `Date` date NOT NULL,
  `SupplierCode` char(4) DEFAULT NULL,
  `EmployeeCode` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`PONo`, `Date`, `SupplierCode`, `EmployeeCode`) VALUES
('PO1711130120', '2017-11-13', 'D001', '0023'),
('PO1712250002', '2017-12-25', 'D001', '0023'),
('PO1801250033', '2018-01-25', 'C004', '0088'),
('PO1808230501', '2018-08-23', 'D001', '0023'),
('PO1809260265', '2018-09-26', 'D001', '0023');

-- --------------------------------------------------------

--
-- Table structure for table `sale_order`
--

CREATE TABLE `sale_order` (
  `SONo` char(12) NOT NULL,
  `Date` date NOT NULL,
  `ClientCode` char(4) DEFAULT NULL,
  `EmployeeCode` char(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_order`
--

INSERT INTO `sale_order` (`SONo`, `Date`, `ClientCode`, `EmployeeCode`) VALUES
('SO1809030058', '2018-09-03', 'M002', '0023'),
('SO1810010083', '2018-10-01', 'W003', '0088'),
('SO1812201003', '2018-12-20', 'W003', '0088');

-- --------------------------------------------------------

--
-- Table structure for table `so_detail`
--

CREATE TABLE `so_detail` (
  `SONo` char(12) NOT NULL,
  `ItemCode` char(5) NOT NULL,
  `BatchNo` char(10) NOT NULL,
  `Qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `so_detail`
--

INSERT INTO `so_detail` (`SONo`, `ItemCode`, `BatchNo`, `Qty`) VALUES
('SO1809030058', 'T0001', '20180926B1', 5),
('SO1810010083', 'C0002', '20171225D1', 10),
('SO1812201003', 'C0002', '20171225D1', 2),
('SO1812201003', 'T0001', '20180926B1', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `StkBalanceByBatch`
-- (See below for the actual view)
--
CREATE TABLE `StkBalanceByBatch` (
`ItemCode` char(5)
,`BatchNo` char(10)
,`InQty` decimal(32,0)
,`OutQty` decimal(32,0)
,`Balance` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `StkBalanceByProduct`
-- (See below for the actual view)
--
CREATE TABLE `StkBalanceByProduct` (
`ItemCode` char(5)
,`InQty` decimal(32,0)
,`OutQty` decimal(32,0)
,`Balance` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierCode` char(4) NOT NULL,
  `CompanyName` varchar(50) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `ContactNo` varchar(20) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Remark` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierCode`, `CompanyName`, `Address`, `ContactNo`, `Email`, `Remark`) VALUES
('C004', 'Creative Company Limited', '168, MingChuan Road, ChungXi Dist., 700 Tainan', '06-2266680', 'creativeaswecan@yahoo.com', 'Naruko'),
('R001', 'Shiseido Company, Limited', '1-6-2, Higashi-shimbashi, Minato-ku, Tokyo 105-8310, Japan', '+1-883-572-5111', 'customerservice@shiseido.com', 'Shiseido'),
('S005', 'Procter & Gamble (P&G) ', '1-2 Procter and Gamble Plaza,Cincinnati,OH 45201,United States', '1-866-678-1770', 'customerservice@shop.sk-ii.com', 'SK-II'),
('D001', 'Delloyd Industries (M) Sdn Bhd', 'Lot 33004/5, Jalan Kebun, Techno Industrial Park, 42450 Klang, Selangor, Malaysia', '+60 3-5163 6888', 'sales@delloyd.com', 'Dr.Satin'),
('W005', 'Well Done', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure for view `StkBalanceByBatch`
--
DROP TABLE IF EXISTS `StkBalanceByBatch`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `StkBalanceByBatch`  AS  select `M`.`ItemCode` AS `ItemCode`,`M`.`BatchNo` AS `BatchNo`,ifnull((select sum(`P`.`Qty`) from `po_detail` `P` where ((`P`.`ItemCode` = `M`.`ItemCode`) and (`P`.`BatchNo` = `M`.`BatchNo`))),0) AS `InQty`,ifnull((select sum(`S`.`Qty`) from `so_detail` `S` where ((`M`.`ItemCode` = `S`.`ItemCode`) and (`M`.`BatchNo` = `S`.`BatchNo`))),0) AS `OutQty`,(ifnull((select sum(`P`.`Qty`) from `po_detail` `P` where ((`P`.`ItemCode` = `M`.`ItemCode`) and (`P`.`BatchNo` = `M`.`BatchNo`))),0) - ifnull((select sum(`S`.`Qty`) from `so_detail` `S` where ((`M`.`ItemCode` = `S`.`ItemCode`) and (`M`.`BatchNo` = `S`.`BatchNo`))),0)) AS `Balance` from `batch` `M` group by `M`.`ItemCode`,`M`.`BatchNo` ;

-- --------------------------------------------------------

--
-- Structure for view `StkBalanceByProduct`
--
DROP TABLE IF EXISTS `StkBalanceByProduct`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `StkBalanceByProduct`  AS  select `M`.`ItemCode` AS `ItemCode`,ifnull((select sum(`P`.`Qty`) from `po_detail` `P` where (`P`.`ItemCode` = `M`.`ItemCode`)),0) AS `InQty`,ifnull((select sum(`S`.`Qty`) from `so_detail` `S` where (`M`.`ItemCode` = `S`.`ItemCode`)),0) AS `OutQty`,(ifnull((select sum(`P`.`Qty`) from `po_detail` `P` where (`P`.`ItemCode` = `M`.`ItemCode`)),0) - ifnull((select sum(`S`.`Qty`) from `so_detail` `S` where (`M`.`ItemCode` = `S`.`ItemCode`)),0)) AS `Balance` from `product` `M` group by `M`.`ItemCode` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`BatchNo`,`ItemCode`),
  ADD KEY `ItemCode` (`ItemCode`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientCode`),
  ADD UNIQUE KEY `CompanyName` (`CompanyName`),
  ADD UNIQUE KEY `Address` (`Address`),
  ADD UNIQUE KEY `ContactNo`(`ContactNo`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmployeeCode`),
  ADD UNIQUE KEY `ContactNo` (`ContactNo`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`LocationCode`);

--
-- Indexes for table `po_detail`
--
ALTER TABLE `po_detail`
  ADD PRIMARY KEY (`PONo`,`ItemCode`,`BatchNo`),
  ADD KEY `ItemCode` (`ItemCode`),
  ADD KEY `BatchNo` (`BatchNo`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ItemCode`),
  ADD KEY `Location` (`Location`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`PONo`),
  ADD KEY `SupplierCode` (`SupplierCode`),
  ADD KEY `EmployeeCode` (`EmployeeCode`);

--
-- Indexes for table `sale_order`
--
ALTER TABLE `sale_order`
  ADD PRIMARY KEY (`SONo`),
  ADD KEY `ClientCode` (`ClientCode`),
  ADD KEY `EmployeeCode` (`EmployeeCode`);

--
-- Indexes for table `so_detail`
--
ALTER TABLE `so_detail`
  ADD PRIMARY KEY (`SONo`,`ItemCode`,`BatchNo`),
  ADD KEY `ItemCode` (`ItemCode`),
  ADD KEY `BatchNo` (`BatchNo`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierCode`),
  ADD UNIQUE KEY `CompanyName` (`CompanyName`),
  ADD UNIQUE KEY `Address` (`Address`),
  ADD UNIQUE KEY `ContactNo`(`ContactNo`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `batch`
--
ALTER TABLE `batch`
  ADD CONSTRAINT `batch_ibfk_1` FOREIGN KEY (`ItemCode`) REFERENCES `product` (`ItemCode`) ON UPDATE CASCADE;

--
-- Constraints for table `po_detail`
--
ALTER TABLE `po_detail`
  ADD CONSTRAINT `po_detail_ibfk_1` FOREIGN KEY (`PONo`) REFERENCES `purchase_order` (`PONo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `po_detail_ibfk_2` FOREIGN KEY (`ItemCode`) REFERENCES `product` (`ItemCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `po_detail_ibfk_3` FOREIGN KEY (`BatchNo`) REFERENCES `batch` (`BatchNo`) ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Location`) REFERENCES `location` (`LocationCode`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`SupplierCode`) REFERENCES `supplier` (`SupplierCode`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_order_ibfk_2` FOREIGN KEY (`EmployeeCode`) REFERENCES `employee` (`EmployeeCode`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `sale_order`
--
ALTER TABLE `sale_order`
  ADD CONSTRAINT `sale_order_ibfk_1` FOREIGN KEY (`ClientCode`) REFERENCES `client` (`ClientCode`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_order_ibfk_2` FOREIGN KEY (`EmployeeCode`) REFERENCES `employee` (`EmployeeCode`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `so_detail`
--
ALTER TABLE `so_detail`
  ADD CONSTRAINT `so_detail_ibfk_1` FOREIGN KEY (`SONo`) REFERENCES `sale_order` (`SONo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `so_detail_ibfk_2` FOREIGN KEY (`ItemCode`) REFERENCES `product` (`ItemCode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `so_detail_ibfk_3` FOREIGN KEY (`BatchNo`) REFERENCES `batch` (`BatchNo`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
