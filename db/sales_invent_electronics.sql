-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2019 at 09:47 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sales_invent_electronics`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `role` int(11) DEFAULT NULL,
  `showroomId` int(11) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `image`, `role`, `showroomId`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', NULL, 1, 0, '$2y$10$wcjSEsgXU5pSM16fpwouju905lsZrFFxc5J68jQanfo8Jl6EQWXbe', 1, NULL, NULL, NULL),
(3, 'Salman', 'salman@gmail.com', 'salman', 'D:\\xampp\\tmp\\php13B2.tmp', 5, 1, '$2y$10$C2upubhDeyF0wm732wpGdeHB2dn68KOUpAAHCnynvHbyRXOxyoJzO', 0, NULL, '2019-11-23 19:28:37', '2019-11-23 19:28:37'),
(4, 'Dew Hunt', 'dew@gmail.com', 'DewHunt', 'public/uploads/admin_images/avatar7_20165942041.png', 5, 1, '$2y$10$nP/X0y6wMRBy7RqMk2Yz9.8SMR8FrDS2UWcs2NTAI6oTOQiiWKbIe', 0, NULL, '2019-11-23 20:03:40', '2019-11-30 02:44:47'),
(5, 'Fattah', 'fattah@gmail.com', 'fattah', 'public/uploads/admin_images/images_21444773304.jpg', 5, 1, '$2y$10$wpFxh0bQbgbOU2n9ZSBhPOiOFvloC3WiLvpEj8MccqmLarwjHOcG2', 0, NULL, '2019-11-23 20:09:05', '2019-11-23 21:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `alphabets`
--

CREATE TABLE `alphabets` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `alphabets`
--

INSERT INTO `alphabets` (`id`, `name`, `status`) VALUES
(1, 'A', 1),
(2, 'B', 1),
(3, 'C', 1),
(4, 'D', 1),
(5, 'E', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `menuName` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuTitle` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuContent` text COLLATE utf8mb4_unicode_ci,
  `menuStatus` tinyint(1) NOT NULL DEFAULT '1',
  `menuType` int(11) NOT NULL DEFAULT '1',
  `metaTitle` text COLLATE utf8mb4_unicode_ci,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci,
  `metaDescription` text COLLATE utf8mb4_unicode_ci,
  `orderBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2018_07_22_211328_create_admins_table', 1),
(3, '2019_03_13_121439_create_menus_table', 1),
(4, '2019_03_19_065715_create_settings_table', 1),
(5, '2019_04_17_062734_create_user_roles_table', 1),
(6, '2019_11_21_101948_create_user_menu_actions_table', 1),
(7, '2019_11_21_102012_create_user_menus_table', 1),
(8, '2019_11_23_091359_create_tbl_showroom_table', 1),
(9, '2019_11_24_063948_add_columns_to_admins_table', 1),
(10, '2019_11_26_041205_create_tbl_categories_table', 1),
(11, '2019_11_27_074459_create_tbl_products_table', 1),
(12, '2019_11_27_074832_create_tbl_product_images_table', 1),
(13, '2019_11_27_074944_create_tbl_product_advance_table', 1),
(14, '2019_11_27_120510_add_product_section_to_tbl_product_advance_table', 1),
(15, '2019_11_28_204832_create_tbl_stores_table', 1),
(16, '2019_11_30_052005_create_tbl_bank_table', 2),
(17, '2019_11_30_064735_create_tbl_couriers_table', 3),
(18, '2019_11_30_071841_create_tbl_vehicles_table', 4),
(19, '2019_11_30_082555_create_tbl_vehicles_table', 5),
(20, '2019_11_30_091827_create_tbl_area_table', 6),
(21, '2019_11_30_110119_create_tbl_territories_table', 7),
(22, '2019_11_30_123531_create_tbl_business_staffs_table', 8),
(23, '2019_12_01_045331_create_tbl_staffs_table', 9),
(24, '2019_12_01_054500_create_tbl_vendors_table', 10),
(25, '2019_12_01_074119_create_tbl_lifting_table', 11),
(26, '2019_12_01_081248_create_tbl_lifting_products_table', 12),
(27, '2019_12_01_175830_create_tbl_liftings_table', 13),
(28, '2019_12_01_182810_create_tbl_lifting_products_table', 13),
(29, '2019_12_02_064734_create_tbl_lifting_products_table', 14),
(30, '2019_12_03_071520_create_tbl_company_table', 15),
(31, '2019_12_05_052019_create_tbl_payment_to_company_table', 16),
(32, '2019_12_05_055508_create_tbl_payment_to_company_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `siteLogo` text COLLATE utf8mb4_unicode_ci,
  `adminLogo` text COLLATE utf8mb4_unicode_ci,
  `mobile1` text COLLATE utf8mb4_unicode_ci,
  `mobile2` text COLLATE utf8mb4_unicode_ci,
  `siteEmail1` text COLLATE utf8mb4_unicode_ci,
  `siteEmail2` text COLLATE utf8mb4_unicode_ci,
  `siteAddress1` text COLLATE utf8mb4_unicode_ci,
  `siteAddress2` text COLLATE utf8mb4_unicode_ci,
  `sitestatus` int(11) DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci,
  `metaDescription` text COLLATE utf8mb4_unicode_ci,
  `orderBy` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_area`
--

CREATE TABLE `tbl_area` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incharge_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`id`, `code`, `name`, `incharge_name`, `address`, `contact`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'm11', 'Mirpur - 11', 'Dew Hunt', 'Mirpur - 11', '01317243494', 'dew@gmail.com', 1, '2019-11-30 04:33:14', '2019-11-30 06:21:02'),
(3, 'gu-00', 'Gulshan', 'Salman', 'Gulshan', '01317243494', 'sdsd@sdsd.com', 1, '2019-11-30 06:20:03', '2019-11-30 14:26:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_bank`
--

INSERT INTO `tbl_bank` (`id`, `code`, `name`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'bal-00', 'Bank Asia Ltd.', '01317243494', 'Mirpur - 11', 0, '2019-11-30 00:15:25', '2019-11-30 14:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_business_staffs`
--

CREATE TABLE `tbl_business_staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_business_staffs`
--

INSERT INTO `tbl_business_staffs` (`id`, `code`, `name`, `contact`, `address`, `email`, `national_id`, `joining_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dh007', 'Dew Hunt', '01317243494', 'Mirpur - 11', 'dew@gmail.com', '5089769966', '2019-02-01', 0, '2019-11-30 14:07:30', '2019-11-30 14:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `parent` text COLLATE utf8mb4_unicode_ci,
  `show_in_home_page` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `name`, `cover_image`, `image`, `status`, `parent`, `show_in_home_page`, `meta_title`, `meta_keyword`, `meta_description`, `order_by`, `created_at`, `updated_at`) VALUES
(1, '4K Ultra HD TV', 'public/uploads/category_image/download_14321410993.jpg', 'public/uploads/category_image/W49E3000AS-1-220x220h_12931520932.jpg', 1, '2', 'Yes', 'Electronics || Bangladeshi Electronics Products', 'Electronics, Electronocs in Bangladesh', 'Electronics Products.', 2, '2019-11-25 18:07:28', '2019-12-01 04:11:06'),
(2, 'Television', 'public/uploads/category_image/81OwqiQckgL._SL1500__96781947791.jpg', 'public/uploads/category_image/43UM7400_original_65661783580.jpg', 1, NULL, 'Yes', 'Electronics || Bangladeshi Electronics Products', 'Electronics, Electronocs in Bangladesh', 'Electronics Products.', NULL, '2019-11-25 18:13:09', '2019-11-30 14:15:44'),
(3, 'LED TV', 'public/uploads/category_image/81wNGMjOgjL._SL1500__79232159608.jpg', 'public/uploads/category_image/W49E3000AS-1-220x220h_58193168071.jpg', 1, '2', 'Yes', 'LED TV', 'LED TV', 'LED TV', 4, '2019-12-01 04:13:46', '2019-12-01 04:13:46'),
(4, 'Refrigerator & Freezer', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-01 04:15:37', '2019-12-01 22:15:46'),
(5, 'Freezer', '', '', 1, '4', NULL, NULL, NULL, NULL, NULL, '2019-12-01 04:19:17', '2019-12-01 04:20:05'),
(6, 'Non-Frost Refrigerator', '', '', 1, '4', NULL, NULL, NULL, NULL, NULL, '2019-12-01 04:20:02', '2019-12-01 04:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company`
--

CREATE TABLE `tbl_company` (
  `id` int(10) UNSIGNED NOT NULL,
  `prefix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_license` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`id`, `prefix`, `name`, `email`, `phone`, `fax`, `website`, `vat`, `tin`, `trade_license`, `address`, `created_at`, `updated_at`) VALUES
(1, 'dew-hunt', 'Dew Soft Ltd.', 'dew@gmail.com', '01317243494', '02243493', 'www.dewsoft.com', 'vat46546gffg', 'tin567e5', 'tl32435dy5', 'Gulshan', '2019-12-03 02:51:19', '2019-12-03 07:00:46'),
(2, 'gsdfhgdh', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_couriers`
--

CREATE TABLE `tbl_couriers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_couriers`
--

INSERT INTO `tbl_couriers` (`id`, `code`, `name`, `phone`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'scl-00', 'Sundarban Courier Ltd', '01418253595', 'Mirpur - 11', 0, '2019-11-30 01:04:15', '2019-11-30 14:24:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_liftings`
--

CREATE TABLE `tbl_liftings` (
  `id` int(10) UNSIGNED NOT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaouchar_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `purchase_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `vouchar_date` date DEFAULT NULL,
  `total_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_mrp_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_haire_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `net_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_liftings`
--

INSERT INTO `tbl_liftings` (`id`, `serial_no`, `vaouchar_no`, `vendor_id`, `purchase_by`, `submission_date`, `vouchar_date`, `total_qty`, `total_price`, `total_mrp_price`, `total_haire_price`, `discount`, `vat`, `net_amount`, `created_at`, `updated_at`) VALUES
(2, '1000001', '56789546', 1, 'Admin', '2019-11-01', '2019-12-01', '3', '135000.00', '145800.00', '163296.00', NULL, NULL, NULL, '2019-12-02 03:43:11', '2019-12-05 12:29:59'),
(3, '1000003', '01273', 2, 'Admin', '2019-11-15', '2019-12-03', '2', '60000.00', '64800.00', '72576.00', NULL, NULL, NULL, '2019-12-02 03:56:03', '2019-12-05 12:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lifting_products`
--

CREATE TABLE `tbl_lifting_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `lifting_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `haire_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_lifting_products`
--

INSERT INTO `tbl_lifting_products` (`id`, `lifting_id`, `product_id`, `model_no`, `serial_no`, `color`, `qty`, `price`, `mrp_price`, `haire_price`, `created_at`, `updated_at`) VALUES
(16, 2, 3, 'wal890', 'poiuytrty', 'Black', '1', '45000', '48600', '54432', NULL, NULL),
(17, 2, 6, 'wal8126', 'fsdafa', 'White', '1', '25000', '27000', '30240', NULL, NULL),
(18, 2, 7, 'Wal119', 'sdgfasdgasd', 'Red', '1', '65000', '70200', '78624', NULL, NULL),
(19, 3, 5, 'wal1234', '09373848', 'Silver', '1', '35000', '37800', '42336', NULL, NULL),
(20, 3, 6, 'wal8126', '09364573', 'White', '1', '25000', '27000', '30240', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_to_company`
--

CREATE TABLE `tbl_payment_to_company` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `payment_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_due` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_now` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `balance` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_payment_to_company`
--

INSERT INTO `tbl_payment_to_company` (`id`, `vendor_id`, `payment_no`, `payment_date`, `current_due`, `payment_now`, `balance`, `money_receipt`, `payment_type`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, '1000001', '2019-12-04', '135000', '5000', '130000.00', 'd12e34w', 'Cash', 'Five Thousand Taka Cash.', '2019-12-05 03:31:53', '2019-12-05 05:58:10'),
(2, 1, '1000002', '2019-12-03', '130000', '2000', '128000.00', 'e348je0k', 'Cash', 'Two Thousand Taka Cash.', '2019-12-05 03:57:43', '2019-12-05 04:07:49'),
(3, 1, '1000003', '2019-12-02', '127000', '4000', '123000.00', 'lk43n93jc', 'Cash', 'Four Thousand Taka Cash.', '2019-12-05 03:58:54', '2019-12-05 03:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `mrp_price` int(11) DEFAULT NULL,
  `haire_price` int(11) DEFAULT NULL,
  `discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `warranty` int(11) DEFAULT NULL,
  `reorder_level_qty` int(11) DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `transport_point` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `youtube_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag_line` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `long_description` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `category_id`, `name`, `code`, `model_no`, `color`, `uom`, `price`, `mrp_price`, `haire_price`, `discount`, `warranty`, `reorder_level_qty`, `order_by`, `transport_point`, `status`, `youtube_link`, `tag_line`, `short_description`, `long_description`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(3, '1,2', 'Walton ANDROID  ATV', 'wal123', 'wal890', 'Black', 'Pcs', 45000, 48600, 54432, '1000', 5, 5, 2, 3, 1, NULL, 'Smart TV', 'rogif;f;ehflk;lfjds;fanfkrengahglkan', ';jglangfarngfarnvafngabrflbFBDLB', 'Smart Tv', 'Smart Tv', 'Smart Tv', '2019-11-27 19:04:54', '2019-12-01 04:30:27'),
(5, '3,2', 'Walton LED TV', 'wal009', 'wal1234', 'Silver', 'Pcs', 35000, 37800, 42336, '1000', 5, 5, 2, 5, 1, NULL, 'LED TV', 'LED Tv', 'LED TV', 'LED Tv', 'LED Tv', 'LED Tv', '2019-12-01 04:31:48', '2019-12-01 04:33:04'),
(6, '5,4', 'Walton Freezer', 'wal567', 'wal8126', 'White', 'Pcs', 25000, 27000, 30240, '2500', 10, 5, 9, 5, 1, NULL, 'freezer', 'Walton Freezer', 'Walton Freezer', 'Walton Freezer', 'Walton Freezer', 'Walton Freezer', '2019-12-01 04:37:18', '2019-12-01 04:45:31'),
(7, '6,4', 'Walton Side by Side Intelligent Inverter Refrigerator', 'wal009', 'Wal119', 'Red', 'Pcs', 65000, 70200, 78624, '4998', 10, 5, 7, 8, 1, NULL, 'Walton Non Frost Freez', 'Walton Non Frost Freez', 'Walton Non Frost Freez', 'Walton Freezer', 'Walton Freezer', 'Walton Freezer', '2019-12-01 04:48:04', '2019-12-01 04:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_advance`
--

CREATE TABLE `tbl_product_advance` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_section` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_product_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pre_order_duration` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot_discount` int(11) DEFAULT NULL,
  `hot_discount_date` date DEFAULT NULL,
  `special_discount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `special_discount_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_product_advance`
--

INSERT INTO `tbl_product_advance` (`id`, `product_id`, `product_section`, `related_product_id`, `pre_order_duration`, `shipping`, `hot_discount`, `hot_discount_date`, `special_discount`, `special_discount_date`, `created_at`, `updated_at`) VALUES
(3, 3, 'New Arrival,Best Seller', '3', '160', 'free', 40000, '0000-00-00', NULL, NULL, '2019-11-27 19:04:54', '2019-11-28 01:18:22'),
(5, 5, 'Featured Product,Top Rated', '3', '10', 'free', 30000, '0000-00-00', NULL, NULL, '2019-12-01 04:31:48', '2019-12-01 04:32:31'),
(6, 6, 'Top Rated,Best Seller', '', '16', NULL, 20000, '0000-00-00', NULL, NULL, '2019-12-01 04:37:18', '2019-12-01 04:44:45'),
(7, 7, 'New Arrival,Top Rated', '6', '10', 'free', 60000, '0000-00-00', NULL, NULL, '2019-12-01 04:48:04', '2019-12-01 04:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_images`
--

CREATE TABLE `tbl_product_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_product_images`
--

INSERT INTO `tbl_product_images` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(24, 3, 'public/uploads/product_image/43UM7400_original_126870338730.jpg', '2019-11-27 23:26:13', '2019-11-27 23:26:13'),
(26, 3, 'public/uploads/product_image/download_25597070270.jpg', '2019-11-28 01:20:42', '2019-11-28 01:20:42'),
(29, 5, 'public/uploads/product_image/81OwqiQckgL._SL1500__35032082461.jpg', '2019-12-01 04:32:42', '2019-12-01 04:32:42'),
(30, 5, 'public/uploads/product_image/43UM7400_original_47227219350.jpg', '2019-12-01 04:32:51', '2019-12-01 04:32:51'),
(31, 6, 'public/uploads/product_image/2-155x145_26415505539.jpg', '2019-12-01 04:45:00', '2019-12-01 04:45:00'),
(32, 6, 'public/uploads/product_image/WCF-2T5-FHL-3-155x145_95541091669.jpg', '2019-12-01 04:45:09', '2019-12-01 04:45:09'),
(33, 7, 'public/uploads/product_image/Front-View_91014294857.png', '2019-12-01 04:49:53', '2019-12-01 04:49:53'),
(34, 7, 'public/uploads/product_image/Stylish-Design_46185949142.png', '2019-12-01 04:50:10', '2019-12-01 04:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_showroom`
--

CREATE TABLE `tbl_showroom` (
  `id` int(10) UNSIGNED NOT NULL,
  `prefix` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_license` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_showroom`
--

INSERT INTO `tbl_showroom` (`id`, `prefix`, `name`, `contact_person`, `email`, `phone`, `fax`, `website`, `vat`, `tin`, `trade_license`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dew', 'Dew Electronics', 'Dew Hunt', 'dewelectronics@gmail.com', '01317243494', '02243493', 'dewelectronics.com', 'v-12345', 'tin-12345', 'tl-12345', 'Mirpur 11, Dhaka, Bangladesh', 1, '2019-11-22 22:17:46', '2019-11-22 22:17:46'),
(3, 'TEL', 'Techno Electronics Ltd.', 'Simon', 'simon@gmail.com', '01711116677', '02667711', 'technoelectronicsltd.com.bd', 'v-9876', 'tin-9876', 'tl-9876', 'Merul Badda, Bangladesh', 1, '2019-11-22 23:20:18', '2019-11-22 23:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staffs`
--

CREATE TABLE `tbl_staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_staffs`
--

INSERT INTO `tbl_staffs` (`id`, `code`, `name`, `contact`, `address`, `email`, `national_id`, `joining_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'dh007', 'Dew Hunt', '01317243494', 'Mirpur', 'dew@gmail.com', '5089769966', '2019-02-01', 0, '2019-11-30 23:30:01', '2019-11-30 23:32:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stores`
--

CREATE TABLE `tbl_stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_stores`
--

INSERT INTO `tbl_stores` (`id`, `code`, `type`, `name`, `address`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(1, 'st-00', 'Purchase Item Stock,Production Floor (Raw/Finish)', 'Dew Store', 'Mirpur', 'Best Store', 1, '2019-11-29 02:34:43', '2019-11-30 05:52:19'),
(3, 'st-01', 'Production Floor (Raw/Finish)', 'Dew Hunt Store', 'dsga', 'sgasgasgd', 0, '2019-11-29 04:47:34', '2019-11-30 05:52:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_territories`
--

CREATE TABLE `tbl_territories` (
  `id` int(10) UNSIGNED NOT NULL,
  `area_id` int(11) NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incharge_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_territories`
--

INSERT INTO `tbl_territories` (`id`, `area_id`, `code`, `name`, `incharge_name`, `address`, `contact`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'm00', 'Mirpur Territory', 'Dew Hunt', 'Mirpur', '01317243494', 0, '2019-11-30 05:36:54', '2019-11-30 14:27:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

CREATE TABLE `tbl_vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `registration_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_vehicles`
--

INSERT INTO `tbl_vehicles` (`id`, `registration_no`, `type`, `capacity`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Kha-12-3045', 'Heavy', '12', 0, '2019-11-30 02:27:04', '2019-11-30 14:25:56'),
(2, 'Ga-12-3467', 'Medium', '12', 0, '2019-11-30 02:31:59', '2019-11-30 05:57:59'),
(3, 'Ga-12-3478', 'Pickup Van', '12', 0, '2019-11-30 02:32:32', '2019-11-30 02:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vendors`
--

CREATE TABLE `tbl_vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_vendors`
--

INSERT INTO `tbl_vendors` (`id`, `code`, `name`, `contact_person`, `contact`, `email`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'v001', 'Dew Hunt', 'Salman', '01317243494', 'dew@gmail.com', 'Mirpur', 1, '2019-12-01 00:56:51', '2019-12-01 01:14:11'),
(2, 'v002', 'Jisan', 'Jisan', '01417243595', 'jishan@gmail.com', 'Badda', 1, '2019-12-01 01:15:02', '2019-12-01 01:15:05'),
(3, 'v003', 'Ritu', 'Ritu', '01717243595', 'ritu@gmail.com', 'Uttar Badda', 1, '2019-12-01 01:16:12', '2019-12-01 01:16:14');

-- --------------------------------------------------------

--
-- Table structure for table `user_menus`
--

CREATE TABLE `user_menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentMenu` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuLink` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuIcon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderBy` int(11) NOT NULL,
  `menuStatus` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_menus`
--

INSERT INTO `user_menus` (`id`, `parentMenu`, `menuName`, `menuLink`, `menuIcon`, `orderBy`, `menuStatus`, `created_at`, `updated_at`) VALUES
(1, '2', 'Menus', 'usermenu.index', 'fa fa-bars', 1, '1', '2019-11-20 23:22:02', '2019-11-20 23:22:02'),
(2, NULL, 'User Management', 'admin.index', 'fa fa-bars', 1, '1', '2019-11-20 23:56:43', '2019-11-30 03:00:24'),
(3, '2', 'Users Role', 'user-roles.index', 'fa fa-caret', 2, '1', '2019-11-21 00:44:26', '2019-11-22 18:39:34'),
(4, '2', 'Showroom Setup', 'showroomSetup.index', 'fa fa-caret', 3, '1', '2019-11-22 19:20:57', '2019-11-22 20:03:09'),
(5, '2', 'Create User', 'user.index', 'fa fa-caret', 4, '1', '2019-11-22 23:52:47', '2019-11-22 23:52:47'),
(6, NULL, 'Business Settings', 'admin.index', 'fa fa-bars', 5, '1', '2019-11-24 17:01:00', '2019-11-24 17:01:00'),
(7, '6', 'Category Setup', 'categorySetup.index', 'fa fa-caret', 1, '1', '2019-11-24 18:19:54', '2019-11-26 08:29:29'),
(8, '6', 'Product Setup', 'productSetup.index', 'fa fa-caret', 2, '1', '2019-11-25 21:04:52', '2019-11-25 21:04:52'),
(9, '6', 'Drop Down Prob', 'dropDownProb.index', 'fa fa-caret', 3, '1', '2019-11-27 07:20:07', '2019-11-27 07:20:07'),
(10, '6', 'Store Setup', 'storeSetup.index', 'fa fa-bars', 4, '1', '2019-11-29 02:36:29', '2019-11-29 02:36:29'),
(11, '6', 'Bank Setup', 'bankSetup.index', 'fa fa-caret', 5, '1', '2019-11-29 22:55:21', '2019-11-29 22:55:21'),
(12, '6', 'Courier Setup', 'courierSetup.index', 'fa fa-caret', 6, '1', '2019-11-30 00:43:18', '2019-11-30 00:43:18'),
(13, '6', 'Vehicle Setup', 'vehicleSetup.index', 'fa fa-caret', 7, '1', '2019-11-30 02:15:31', '2019-11-30 02:15:31'),
(14, '6', 'Area Setup', 'areaSetup.index', 'fa fa-caret', 8, '1', '2019-11-30 03:15:11', '2019-11-30 03:15:11'),
(15, '6', 'Territory Setup', 'territorySetup.index', 'fa fa-caret', 9, '1', '2019-11-30 04:59:08', '2019-11-30 04:59:08'),
(17, '6', 'Staff Setup', 'staffSetup.index', 'fa fa-caret', 11, '1', '2019-11-30 23:27:00', '2019-11-30 23:27:00'),
(18, '6', 'Vendor Setup', 'vendorSetup.index', 'fa fa-caret', 10, '1', '2019-11-30 23:41:41', '2019-11-30 23:41:41'),
(19, NULL, 'Product Lifting', 'admin.index', 'fa fa-bars', 12, '1', '2019-12-01 01:30:30', '2019-12-01 01:30:30'),
(20, '19', 'Lifting', 'lifting.index', 'fa fa-caret', 13, '1', '2019-12-01 01:34:52', '2019-12-01 01:34:52'),
(21, '6', 'Product List', 'productList.index', 'fa fa-caret', 14, '1', '2019-12-02 04:19:05', '2019-12-02 04:19:05'),
(22, '2', 'Company Setup', 'companySetup.index', 'fa fa-caret', 15, '1', '2019-12-03 01:41:12', '2019-12-03 01:41:12'),
(23, '19', 'Payment To Company', 'paymentToCompany.index', 'fa fa-caret', 16, '1', '2019-12-04 23:23:10', '2019-12-04 23:23:10'),
(24, '19', 'Payment Record', 'paymentRecord.index', NULL, 17, '1', '2019-12-05 05:26:06', '2019-12-05 05:28:09'),
(25, '19', 'Vendor Statement', 'vendorStatement.index', 'fa fa-caret', 18, '1', '2019-12-05 06:30:54', '2019-12-05 06:30:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_menu_actions`
--

CREATE TABLE `user_menu_actions` (
  `id` int(10) UNSIGNED NOT NULL,
  `parentmenuId` int(11) NOT NULL,
  `menuType` int(11) NOT NULL,
  `actionName` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `actionLink` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `orderBy` int(11) NOT NULL,
  `actionStatus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_menu_actions`
--

INSERT INTO `user_menu_actions` (`id`, `parentmenuId`, `menuType`, `actionName`, `actionLink`, `orderBy`, `actionStatus`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Add', 'usermenu.add', 1, 1, '2019-11-21 00:16:57', '2019-11-21 00:16:57'),
(2, 1, 2, 'Edit', 'usermenu.edit', 2, 1, '2019-11-21 00:17:21', '2019-11-21 00:17:21'),
(3, 1, 3, 'Status', 'usermenu.status', 3, 1, '2019-11-21 00:17:51', '2019-11-21 00:17:51'),
(4, 1, 8, 'View Action Menu', 'usermenuLink.index', 4, 1, '2019-11-21 00:18:13', '2019-11-21 00:18:13'),
(5, 1, 4, 'Delete', 'usermenu-delete', 5, 1, '2019-11-21 00:18:32', '2019-11-21 00:18:32'),
(6, 3, 1, 'ADD', 'userRoleAdd.page', 6, 1, '2019-11-21 00:45:20', '2019-11-21 00:45:20'),
(7, 3, 2, 'Edit', 'userRole.edit', 7, 1, '2019-11-21 00:45:53', '2019-11-21 00:45:53'),
(8, 3, 3, 'Status', 'userRole.changeuserRoleStatus', 8, 1, '2019-11-21 00:46:19', '2019-11-21 00:46:19'),
(9, 3, 5, 'Permission', 'userRole.permission', 9, 1, '2019-11-21 00:46:43', '2019-11-21 00:46:43'),
(10, 3, 4, 'Delete User Role', 'userRole.delete', 10, 1, '2019-11-21 00:46:57', '2019-11-21 00:46:57'),
(11, 4, 1, 'Add New Showroom', 'showroomSetup.add', 11, 1, '2019-11-22 19:22:27', '2019-11-22 19:22:27'),
(12, 4, 3, 'Showroom Status', 'showroomSetup.status', 12, 1, '2019-11-22 19:28:18', '2019-11-22 19:28:18'),
(13, 4, 2, 'Edit Showroom', 'showroomSetup.edit', 13, 1, '2019-11-22 19:28:54', '2019-11-22 19:28:54'),
(14, 4, 4, 'Delete Showroom', 'showroomSetup.delete', 14, 1, '2019-11-22 19:29:30', '2019-11-22 19:29:30'),
(15, 5, 1, 'Add User', 'user.add', 15, 1, '2019-11-22 23:58:36', '2019-11-22 23:58:36'),
(16, 5, 2, 'Edit User', 'user.edit', 16, 1, '2019-11-22 23:59:13', '2019-11-22 23:59:13'),
(17, 5, 3, 'User Status', 'user.status', 20, 1, '2019-11-22 23:59:58', '2019-11-22 23:59:58'),
(18, 5, 6, 'Change User Password', 'user.changePassword', 18, 1, '2019-11-23 00:02:44', '2019-11-23 00:02:44'),
(19, 5, 4, 'Delete user', 'user.delete', 19, 1, '2019-11-23 00:04:45', '2019-11-23 00:04:45'),
(20, 5, 7, 'View User', 'user.viewProfile', 17, 1, '2019-11-23 00:06:17', '2019-11-23 00:06:17'),
(21, 7, 1, 'Add', 'categorySetup.add', 21, 1, '2019-11-24 18:20:28', '2019-11-24 18:20:28'),
(22, 7, 2, 'Edit', 'categorySetup.edit', 22, 1, '2019-11-24 18:20:54', '2019-11-24 18:20:54'),
(23, 7, 4, 'Delete', 'categorySetup.delete', 23, 1, '2019-11-24 18:38:43', '2019-11-24 18:38:43'),
(24, 7, 3, 'Status', 'categorySetup.status', 24, 1, '2019-11-24 18:40:19', '2019-11-25 21:10:39'),
(25, 8, 1, 'Add', 'productSetup.add', 25, 1, '2019-11-25 21:05:58', '2019-11-25 21:05:58'),
(26, 8, 2, 'Edit', 'productSetup.edit', 26, 1, '2019-11-25 21:06:22', '2019-11-25 21:06:22'),
(27, 8, 4, 'Delete', 'productSetup.delete', 27, 1, '2019-11-25 21:07:04', '2019-11-25 21:07:04'),
(28, 8, 3, 'Status', 'productSetup.status', 28, 1, '2019-11-25 21:10:00', '2019-11-25 21:10:00'),
(29, 10, 1, 'Add', 'storeSetup.add', 29, 1, '2019-11-29 02:36:54', '2019-11-29 02:36:54'),
(30, 10, 2, 'Edit', 'storeSetup.edit', 30, 1, '2019-11-29 02:38:50', '2019-11-29 02:38:50'),
(31, 10, 4, 'Delete', 'storeSetup.delete', 31, 1, '2019-11-29 02:39:26', '2019-11-29 02:39:26'),
(32, 10, 3, 'Status', 'storeSetup.status', 32, 1, '2019-11-29 02:39:36', '2019-11-29 02:39:36'),
(33, 11, 1, 'Add', 'bankSetup.add', 33, 1, '2019-11-29 23:03:56', '2019-11-29 23:03:56'),
(34, 11, 2, 'Edit', 'bankSetup.edit', 34, 1, '2019-11-29 23:07:00', '2019-11-29 23:07:00'),
(35, 11, 4, 'Delete', 'bankSetup.delete', 35, 1, '2019-11-29 23:07:17', '2019-11-29 23:07:17'),
(36, 11, 3, 'Status', 'bankSetup.status', 36, 1, '2019-11-29 23:10:44', '2019-11-29 23:10:44'),
(37, 12, 1, 'Add', 'courierSetup.add', 37, 1, '2019-11-30 00:43:53', '2019-11-30 00:43:53'),
(38, 12, 2, 'Edit', 'courierSetup.edit', 38, 1, '2019-11-30 00:44:27', '2019-11-30 00:44:27'),
(39, 12, 4, 'Delete', 'courierSetup.delete', 39, 1, '2019-11-30 00:45:08', '2019-11-30 00:45:08'),
(40, 12, 3, 'Status', 'courierSetup.status', 40, 1, '2019-11-30 00:45:25', '2019-11-30 00:45:25'),
(41, 13, 1, 'Add', 'vehicleSetup.add', 41, 1, '2019-11-30 02:15:54', '2019-11-30 02:15:54'),
(42, 13, 2, 'Edit', 'vehicleSetup.edit', 42, 1, '2019-11-30 02:16:08', '2019-11-30 02:16:08'),
(43, 13, 4, 'Delete', 'vehicleSetup.delete', 43, 1, '2019-11-30 02:16:20', '2019-11-30 02:16:20'),
(44, 13, 3, 'Status', 'vehicleSetup.status', 44, 1, '2019-11-30 02:16:37', '2019-11-30 02:16:37'),
(45, 14, 1, 'Add', 'areaSetup.add', 45, 1, '2019-11-30 03:15:37', '2019-11-30 03:15:37'),
(46, 14, 2, 'Edit', 'areaSetup.edit', 46, 1, '2019-11-30 03:15:53', '2019-11-30 03:15:53'),
(47, 14, 4, 'Delete', 'areaSetup.delete', 47, 1, '2019-11-30 03:16:06', '2019-11-30 03:16:06'),
(48, 14, 3, 'Status', 'areaSetup.status', 48, 1, '2019-11-30 03:16:23', '2019-11-30 03:16:23'),
(49, 15, 1, 'Add', 'territorySetup.add', 49, 1, '2019-11-30 04:59:29', '2019-11-30 04:59:29'),
(50, 15, 2, 'Edit', 'territorySetup.edit', 50, 1, '2019-11-30 04:59:40', '2019-11-30 04:59:40'),
(51, 15, 4, 'Delete', 'territorySetup.delete', 51, 1, '2019-11-30 04:59:54', '2019-11-30 04:59:54'),
(52, 15, 3, 'Status', 'territorySetup.status', 52, 1, '2019-11-30 05:00:10', '2019-11-30 05:00:10'),
(57, 17, 1, 'Add', 'staffSetup.add', 57, 1, '2019-11-30 23:27:52', '2019-11-30 23:27:52'),
(58, 17, 2, 'Edit', 'staffSetup.edit', 58, 1, '2019-11-30 23:28:08', '2019-11-30 23:28:08'),
(59, 17, 4, 'Delete', 'staffSetup.delete', 59, 1, '2019-11-30 23:28:26', '2019-11-30 23:28:26'),
(60, 17, 3, 'Status', 'staffSetup.staff', 60, 1, '2019-11-30 23:28:39', '2019-11-30 23:28:39'),
(61, 18, 1, 'Add', 'vendorSetup.add', 61, 1, '2019-11-30 23:42:13', '2019-11-30 23:42:13'),
(62, 18, 2, 'Edit', 'vendorSetup.edit', 62, 1, '2019-11-30 23:42:28', '2019-11-30 23:42:28'),
(63, 18, 4, 'Delete', 'vehicleSetup.delete', 63, 1, '2019-11-30 23:42:42', '2019-11-30 23:42:42'),
(64, 18, 3, 'Status', 'vehicleSetup.status', 64, 1, '2019-11-30 23:42:57', '2019-11-30 23:42:57'),
(65, 20, 1, 'Add', 'lifting.add', 65, 1, '2019-12-01 01:36:51', '2019-12-01 01:36:51'),
(66, 20, 2, 'Edit', 'lifting.edit', 66, 1, '2019-12-01 01:37:41', '2019-12-01 01:37:41'),
(67, 20, 4, 'Delete', 'lifting.delete', 67, 1, '2019-12-01 01:37:55', '2019-12-01 01:37:55'),
(69, 21, 11, 'Print Product List', 'productList.print', 68, 1, '2019-12-02 04:21:36', '2019-12-02 04:21:36'),
(70, 22, 1, 'Add', 'companySetup.add', 69, 1, '2019-12-03 01:42:18', '2019-12-03 01:42:18'),
(71, 22, 2, 'Edit', 'companySetup.edit', 70, 1, '2019-12-03 01:42:40', '2019-12-03 01:42:40'),
(72, 23, 1, 'Add', 'paymentToCompany.add', 71, 1, '2019-12-04 23:29:44', '2019-12-04 23:29:44'),
(73, 23, 2, 'Edit', 'paymentToCompany.edit', 72, 1, '2019-12-04 23:29:59', '2019-12-04 23:29:59'),
(74, 23, 4, 'Delete', 'paymentToCompany.delete', 73, 1, '2019-12-04 23:30:16', '2019-12-04 23:30:16'),
(75, 24, 11, 'Print Product Record', 'paymentRecord.print', 74, 1, '2019-12-05 05:27:38', '2019-12-05 05:27:38'),
(76, 25, 11, 'Print Vendor Statement', 'vendorStatement.print', 75, 1, '2019-12-05 06:31:33', '2019-12-05 06:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci,
  `actionPermission` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `status`, `permission`, `actionPermission`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,17,18,19,20,21,22,23,24,25', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,20,18,19,17,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,57,58,59,60,61,62,63,64,65,66,67,69,70,71,72,73,74,75,76', '2019-11-20 22:48:03', '2019-12-05 06:31:51'),
(5, 'Admin', 0, NULL, NULL, '2019-11-29 03:26:52', '2019-11-29 03:26:52');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_vendor_statement_report`
-- (See below for the actual view)
--
CREATE TABLE `view_vendor_statement_report` (
`vendorId` int(11)
,`date` varchar(191)
,`lifting` double
,`payment` double
,`others` bigint(20)
);

-- --------------------------------------------------------

--
-- Structure for view `view_vendor_statement_report`
--
DROP TABLE IF EXISTS `view_vendor_statement_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_vendor_statement_report`  AS  select `tbl_liftings`.`vendor_id` AS `vendorId`,`tbl_liftings`.`vouchar_date` AS `date`,sum(`tbl_liftings`.`total_price`) AS `lifting`,0 AS `payment`,0 AS `others` from `tbl_liftings` group by `tbl_liftings`.`vouchar_date`,`tbl_liftings`.`vendor_id` union all select `tbl_payment_to_company`.`vendor_id` AS `vendorId`,`tbl_payment_to_company`.`payment_date` AS `date`,0 AS `lifting`,sum(`tbl_payment_to_company`.`payment_now`) AS `payment`,0 AS `others` from `tbl_payment_to_company` group by `tbl_payment_to_company`.`payment_date`,`tbl_payment_to_company`.`vendor_id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `alphabets`
--
ALTER TABLE `alphabets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_area`
--
ALTER TABLE `tbl_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_business_staffs`
--
ALTER TABLE `tbl_business_staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_company`
--
ALTER TABLE `tbl_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_couriers`
--
ALTER TABLE `tbl_couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_liftings`
--
ALTER TABLE `tbl_liftings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lifting_products`
--
ALTER TABLE `tbl_lifting_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment_to_company`
--
ALTER TABLE `tbl_payment_to_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_advance`
--
ALTER TABLE `tbl_product_advance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_showroom`
--
ALTER TABLE `tbl_showroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_staffs`
--
ALTER TABLE `tbl_staffs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_stores`
--
ALTER TABLE `tbl_stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_territories`
--
ALTER TABLE `tbl_territories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menus`
--
ALTER TABLE `user_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_menu_actions`
--
ALTER TABLE `user_menu_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `alphabets`
--
ALTER TABLE `alphabets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_bank`
--
ALTER TABLE `tbl_bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_business_staffs`
--
ALTER TABLE `tbl_business_staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_couriers`
--
ALTER TABLE `tbl_couriers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_liftings`
--
ALTER TABLE `tbl_liftings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_lifting_products`
--
ALTER TABLE `tbl_lifting_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_payment_to_company`
--
ALTER TABLE `tbl_payment_to_company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product_advance`
--
ALTER TABLE `tbl_product_advance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product_images`
--
ALTER TABLE `tbl_product_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_showroom`
--
ALTER TABLE `tbl_showroom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_staffs`
--
ALTER TABLE `tbl_staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_stores`
--
ALTER TABLE `tbl_stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_territories`
--
ALTER TABLE `tbl_territories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menus`
--
ALTER TABLE `user_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_menu_actions`
--
ALTER TABLE `user_menu_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
