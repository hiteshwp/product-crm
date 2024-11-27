-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2024 at 07:00 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_product_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_master`
--

CREATE TABLE `tbl_admin_master` (
  `admin_master_id` int(10) NOT NULL,
  `admin_master_owner_name` varchar(100) NOT NULL,
  `admin_master_company_name` varchar(200) NOT NULL,
  `admin_master_email_address` varchar(150) NOT NULL,
  `admin_master_password` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `admin_master_status` enum('1','2','3','4') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin_master`
--

INSERT INTO `tbl_admin_master` (`admin_master_id`, `admin_master_owner_name`, `admin_master_company_name`, `admin_master_email_address`, `admin_master_password`, `created_at`, `updated_at`, `deleted_at`, `admin_master_status`) VALUES
(1, 'Hitesh Prajapati', 'My Company', 'hitesh.wp@gmail.com', 'a8e8088da68f6734bf01eb58c89e3769bcecd88271f1a461e07cfb12673f097e67db40c51fb9c1a8fd511d649f1e3c4f988a9626a413f73ec120816eb6aca623dhzZgUKGpyr5TMm+7tgKJ39i4CeDZHiCPRa9MA==', '2024-10-15 04:41:38', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category_master`
--

CREATE TABLE `tbl_category_master` (
  `category_master_id` int(10) NOT NULL,
  `category_master_name` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `category_master_status` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category_master`
--

INSERT INTO `tbl_category_master` (`category_master_id`, `category_master_name`, `created_at`, `updated_at`, `deleted_at`, `category_master_status`) VALUES
(1, 'sdfsdf', '2024-11-01 12:47:33', NULL, NULL, '1'),
(2, 'Test Category', '2024-11-18 00:19:04', '2024-11-18 00:19:04', NULL, '1'),
(3, 'Power', '2024-11-18 00:19:58', '2024-11-18 00:19:58', NULL, '1'),
(4, 'Charger', '2024-11-18 00:20:03', '2024-11-18 00:20:03', NULL, '1'),
(5, 'New Category', '2024-11-18 00:20:12', '2024-11-18 03:20:29', NULL, '1'),
(6, 'Power1', '2024-11-18 00:41:39', '2024-11-18 00:41:39', NULL, '1'),
(7, 'Power2', '2024-11-18 00:45:56', '2024-11-18 00:45:56', NULL, '1'),
(8, 'Test', '2024-11-18 00:46:23', '2024-11-18 00:46:23', NULL, '1'),
(9, 'Test 2', '2024-11-18 00:47:32', '2024-11-18 00:47:32', NULL, '1'),
(10, 'Test 3', '2024-11-18 01:16:54', '2024-11-18 03:43:19', '2024-11-18 03:41:17', '1'),
(11, 'New Category 2', '2024-11-18 02:44:39', '2024-11-18 03:26:49', NULL, '2');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_component_master`
--

CREATE TABLE `tbl_component_master` (
  `component_master_id` int(10) NOT NULL,
  `component_master_category` varchar(250) DEFAULT NULL,
  `component_master_specification` longtext DEFAULT NULL,
  `component_master_value` varchar(250) DEFAULT NULL,
  `component_master_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `component_master_status` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_component_master`
--

INSERT INTO `tbl_component_master` (`component_master_id`, `component_master_category`, `component_master_specification`, `component_master_value`, `component_master_price`, `created_at`, `updated_at`, `deleted_at`, `component_master_status`) VALUES
(1, 'Register', '104, 80v', '10pp', '2.50', '2024-11-18 04:05:30', '2024-11-18 04:30:02', NULL, '1'),
(2, 'Test Component', '10k, 25622kjds, detail', '10pp', '1500.00', '2024-11-18 04:29:53', '2024-11-18 06:50:00', '2024-11-18 04:44:33', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_bom_details`
--

CREATE TABLE `tbl_product_bom_details` (
  `product_bom_id` int(10) NOT NULL,
  `product_bom_product_id` int(10) DEFAULT NULL,
  `product_bom_component_id` int(10) DEFAULT NULL,
  `product_bom_specifications` longtext DEFAULT NULL,
  `product_bom_value` varchar(250) DEFAULT NULL,
  `product_bom_price` decimal(10,2) DEFAULT NULL,
  `product_bom_qty` int(10) DEFAULT NULL,
  `product_bom_total_price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_bom_status` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_bom_details`
--

INSERT INTO `tbl_product_bom_details` (`product_bom_id`, `product_bom_product_id`, `product_bom_component_id`, `product_bom_specifications`, `product_bom_value`, `product_bom_price`, `product_bom_qty`, `product_bom_total_price`, `created_at`, `updated_at`, `deleted_at`, `product_bom_status`) VALUES
(3, 2, 2, '10k, 25622kjds, detail', '10pp', '1500.00', 3, '4500.00', '2024-11-19 03:05:57', '2024-11-19 03:05:57', NULL, '1'),
(4, 2, 1, '104, 80v', '10pp', '2.50', 10, '25.00', '2024-11-19 03:05:57', '2024-11-19 03:05:57', NULL, '1'),
(13, 1, 1, '104, 80v', '10pp', '2.50', 4, '10.00', '2024-11-26 06:32:45', '2024-11-26 06:32:45', NULL, '1'),
(14, 1, 2, '10k, 25622kjds, detail', '10pp', '1500.00', 7, '10500.00', '2024-11-26 06:32:45', '2024-11-26 06:32:45', NULL, '1'),
(15, 1, 1, '104, 80v', '10pp', '2.50', 50, '125.00', '2024-11-26 06:32:45', '2024-11-26 06:32:45', NULL, '1'),
(18, 3, 1, '104, 80v', '10pp', '2.50', 5, '12.50', '2024-11-26 06:37:07', '2024-11-26 06:37:07', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_documents`
--

CREATE TABLE `tbl_product_documents` (
  `product_documents_id` int(10) NOT NULL,
  `product_documents_product_id` int(10) DEFAULT NULL,
  `product_documents_type` varchar(250) DEFAULT NULL,
  `product_documents_path` varchar(250) DEFAULT NULL,
  `product_documents_title` text DEFAULT NULL,
  `product_documents_extension` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_documents_status` enum('1','2','3','4') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_documents`
--

INSERT INTO `tbl_product_documents` (`product_documents_id`, `product_documents_product_id`, `product_documents_type`, `product_documents_path`, `product_documents_title`, `product_documents_extension`, `created_at`, `updated_at`, `deleted_at`, `product_documents_status`) VALUES
(1, 3, 'design', 'design/1732609653_72261eb7b6febe30799d.jpg', '1731641810858', 'jpg', '2024-11-26 02:57:33', '2024-11-26 02:57:33', NULL, '1'),
(2, 3, 'r&d', 'r&d/1732609653_d13ab9b35fef3b08b6c0.docx', 'Terms & Condition', 'docx', '2024-11-26 02:57:33', '2024-11-26 02:57:33', NULL, '1'),
(3, 3, 'customer', 'customer/1732609653_6abc1389c6b010c6146a.png', 'video-poster', 'png', '2024-11-26 02:57:33', '2024-11-26 02:57:33', NULL, '1'),
(4, 3, 'design', 'design/1732609923_ac6e67f830e61aed53b4.png', 'activity_3', 'png', '2024-11-26 03:02:03', '2024-11-26 03:02:03', '2024-11-27 00:15:01', '3'),
(5, 3, 'r&d', 'r&d/1732609923_39ce55df74e0338c19ee.pdf', '23-10-2024 HAMLOG', 'pdf', '2024-11-26 03:02:03', '2024-11-26 03:02:03', '2024-11-27 00:14:36', '3'),
(6, 3, 'customer', 'customer/1732609923_c8528174b5b21df14f83.pdf', 'OD332461960620876100', 'pdf', '2024-11-26 03:02:03', '2024-11-26 03:02:03', '2024-11-27 00:14:23', '3'),
(7, 2, 'design', 'design/1732612244_20fbeba1a489e22b476c.pdf', 'PATAN Earthquake Report (15, November-2024)', 'pdf', '2024-11-26 03:40:44', '2024-11-26 03:40:44', NULL, '1'),
(8, 2, 'r&d', 'r&d/1732612332_08f550adb1d783af9b60.png', 'activity_5', 'png', '2024-11-26 03:42:12', '2024-11-26 03:42:12', NULL, '1'),
(9, 2, 'r&d', 'r&d/1732612332_fc3e8e01586c518edb7d.pdf', '4341XXXXXXXXXX40_17-10-2024', 'PDF', '2024-11-26 03:42:12', '2024-11-26 03:42:12', NULL, '1'),
(10, 2, 'customer', 'customer/1732612332_d04bd39f3b45a3982f70.png', 'acad_pro_img_1', 'png', '2024-11-26 03:42:12', '2024-11-26 03:42:12', NULL, '1'),
(11, 2, 'customer', 'customer/1732614238_7becce5c76d8ade7be3d.png', 'acad_pro_img_4', 'png', '2024-11-26 04:13:58', '2024-11-26 04:13:58', '2024-11-26 04:42:10', '3'),
(12, 2, 'customer', 'customer/1732614238_cd1040a6052688af904e.png', 'acad_pro_img_4', 'png', '2024-11-26 04:13:58', '2024-11-26 04:13:58', '2024-11-26 04:42:00', '3'),
(13, 2, 'customer', 'customer/1732614238_177593d0dea1726d8666.png', 'activity_4', 'png', '2024-11-26 04:13:58', '2024-11-26 04:13:58', '2024-11-26 04:43:29', '3'),
(14, 2, 'customer', 'customer/1732614238_94a31012295889cca34e.pdf', '23-10-2024 HAMLOG', 'pdf', '2024-11-26 04:13:58', '2024-11-26 04:13:58', NULL, '1'),
(15, 3, 'r&d', 'r&d/1732614362_1a32b6367af13121ce38.pdf', '23-10-2024 HAMLOG', 'pdf', '2024-11-26 04:16:02', '2024-11-26 04:16:02', '2024-11-26 04:41:23', '3'),
(16, 3, 'design', 'design/1732622735_2894e86582ecf38b5073.png', 'icon-verified-campaign-1', 'png', '2024-11-26 06:35:35', '2024-11-26 06:35:35', '2024-11-26 06:35:52', '3'),
(17, 3, 'r&d', 'r&d/1732622812_f6f181ae772a2c1cc7dd.png', 'banner_img_1', 'png', '2024-11-26 06:36:52', '2024-11-26 06:36:52', '2024-11-26 06:37:17', '3'),
(18, 1, 'customer', 'customer/1732622939_f1c4b5e39dfe490a12aa.jpg', 'photo-1570295999919-56ceb5ecca61 (2)', 'jpg', '2024-11-26 06:38:59', '2024-11-26 06:38:59', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_master`
--

CREATE TABLE `tbl_product_master` (
  `product_id` int(10) NOT NULL,
  `product_category_id` int(10) NOT NULL,
  `product_model` varchar(250) DEFAULT NULL,
  `product_total_amount` decimal(10,2) DEFAULT NULL,
  `product_document_upload` enum('1','2') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_status` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_master`
--

INSERT INTO `tbl_product_master` (`product_id`, `product_category_id`, `product_model`, `product_total_amount`, `product_document_upload`, `created_at`, `updated_at`, `deleted_at`, `product_status`) VALUES
(1, 4, 'Model 1', '10635.00', '1', '2024-11-19 02:29:33', '2024-11-26 06:32:45', NULL, '1'),
(2, 3, 'New Model', '4525.00', '1', '2024-11-19 03:05:57', '2024-11-19 03:05:57', NULL, '1'),
(3, 4, 'New Model 1', '12.50', '1', '2024-11-19 03:45:47', '2024-11-26 06:37:07', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_specification`
--

CREATE TABLE `tbl_product_specification` (
  `product_specification_id` int(10) NOT NULL,
  `product_master_id` int(10) DEFAULT NULL,
  `product_specification_type` text DEFAULT NULL,
  `product_specification_value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `product_specification_status` enum('1','2','3','4') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_specification`
--

INSERT INTO `tbl_product_specification` (`product_specification_id`, `product_master_id`, `product_specification_type`, `product_specification_value`, `created_at`, `updated_at`, `deleted_at`, `product_specification_status`) VALUES
(6, 2, 'Test details', 'value 1', '2024-11-19 03:05:57', '2024-11-19 03:05:57', NULL, '1'),
(7, 2, 'New test detail', 'Value 2', '2024-11-19 03:05:57', '2024-11-19 03:05:57', NULL, '1'),
(22, 1, 'Specification 1', 'Specification Value 1', '2024-11-26 06:32:45', '2024-11-26 06:32:45', NULL, '1'),
(23, 1, 'Specification 10', 'Specification Value 50', '2024-11-26 06:32:45', '2024-11-26 06:32:45', NULL, '1'),
(24, 1, 'Specification 3', 'Specification Value 40', '2024-11-26 06:32:45', '2024-11-26 06:32:45', NULL, '1'),
(25, 1, 'Specification 7', 'Specification Value 35', '2024-11-26 06:32:45', '2024-11-26 06:32:45', NULL, '1'),
(26, 1, 'Next type', 'Next value', '2024-11-26 06:32:45', '2024-11-26 06:32:45', NULL, '1'),
(29, 3, 'Test 1', 'Value 1', '2024-11-26 06:37:07', '2024-11-26 06:37:07', NULL, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_master`
--
ALTER TABLE `tbl_admin_master`
  ADD PRIMARY KEY (`admin_master_id`);

--
-- Indexes for table `tbl_category_master`
--
ALTER TABLE `tbl_category_master`
  ADD PRIMARY KEY (`category_master_id`);

--
-- Indexes for table `tbl_component_master`
--
ALTER TABLE `tbl_component_master`
  ADD PRIMARY KEY (`component_master_id`);

--
-- Indexes for table `tbl_product_bom_details`
--
ALTER TABLE `tbl_product_bom_details`
  ADD PRIMARY KEY (`product_bom_id`);

--
-- Indexes for table `tbl_product_documents`
--
ALTER TABLE `tbl_product_documents`
  ADD PRIMARY KEY (`product_documents_id`);

--
-- Indexes for table `tbl_product_master`
--
ALTER TABLE `tbl_product_master`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_product_specification`
--
ALTER TABLE `tbl_product_specification`
  ADD PRIMARY KEY (`product_specification_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_master`
--
ALTER TABLE `tbl_admin_master`
  MODIFY `admin_master_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category_master`
--
ALTER TABLE `tbl_category_master`
  MODIFY `category_master_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_component_master`
--
ALTER TABLE `tbl_component_master`
  MODIFY `component_master_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_product_bom_details`
--
ALTER TABLE `tbl_product_bom_details`
  MODIFY `product_bom_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_product_documents`
--
ALTER TABLE `tbl_product_documents`
  MODIFY `product_documents_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_product_master`
--
ALTER TABLE `tbl_product_master`
  MODIFY `product_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product_specification`
--
ALTER TABLE `tbl_product_specification`
  MODIFY `product_specification_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
