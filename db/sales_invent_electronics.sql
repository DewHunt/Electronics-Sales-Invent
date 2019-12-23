-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2019 at 08:23 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

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
  `username` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  `showroomId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `image`, `role`, `showroomId`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', NULL, 1, '0', '$2y$10$wcjSEsgXU5pSM16fpwouju905lsZrFFxc5J68jQanfo8Jl6EQWXbe', 1, NULL, NULL, NULL),
(3, 'Salman', 'salman@gmail.com', 'salman', 'D:\\xampp\\tmp\\php13B2.tmp', 5, '1', '$2y$10$C2upubhDeyF0wm732wpGdeHB2dn68KOUpAAHCnynvHbyRXOxyoJzO', 0, NULL, '2019-11-23 13:28:37', '2019-11-23 13:28:37'),
(4, 'Dew Hunt', 'dew@gmail.com', 'DewHunt', 'public/uploads/admin_images/avatar7_20165942041.png', 5, '1', '$2y$10$nP/X0y6wMRBy7RqMk2Yz9.8SMR8FrDS2UWcs2NTAI6oTOQiiWKbIe', 1, NULL, '2019-11-23 14:03:40', '2019-12-15 06:04:49'),
(5, 'Fattah', 'fattah@gmail.com', 'fattah', 'public/uploads/admin_images/images_21444773304.jpg', 5, '1', '$2y$10$wpFxh0bQbgbOU2n9ZSBhPOiOFvloC3WiLvpEj8MccqmLarwjHOcG2', 0, NULL, '2019-11-23 14:09:05', '2019-11-23 15:15:50');

-- --------------------------------------------------------

--
-- Table structure for table `alphabets`
--

CREATE TABLE `alphabets` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
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
  `menuContent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menuStatus` tinyint(1) NOT NULL DEFAULT 1,
  `menuType` int(11) NOT NULL DEFAULT 1,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(32, '2019_12_05_055508_create_tbl_payment_to_company_table', 17),
(33, '2019_12_07_071621_create_tbl_groups_table', 18),
(34, '2019_12_07_074641_create_tbl_groups_table', 19),
(35, '2019_12_10_070802_create_tbl_groups_sales_target_table', 20),
(36, '2019_12_10_072434_create_tbl_groups_sales_target_category_table', 20),
(37, '2019_12_08_061650_create_tbl_customers_table', 21),
(38, '2019_12_08_062220_create_tbl_customer_products_table', 21),
(39, '2019_12_10_072428_create_tbl_customer_guarantor_table', 21),
(40, '2019_12_11_060002_create_tbl_customer_products_table', 22),
(41, '2019_12_11_063735_create_tbl_customers_table', 23),
(42, '2019_12_10_102159_create_tbl_invoice_table', 24),
(43, '2019_12_11_101249_create_tbl_customer_products_table', 25),
(44, '2019_12_11_101423_create_tbl_invoice_table', 25),
(45, '2019_12_12_064811_create_tbl_customer_products_table', 26),
(46, '2019_12_12_080031_create_tbl_invoice_table', 27),
(47, '2019_12_11_121426_create_tbl_cash_collection_table', 28),
(48, '2019_12_14_082259_create_tbl_invoice_table', 29),
(49, '2019_12_14_085623_create_tbl_invoice_table', 30),
(50, '2019_12_14_090732_create_tbl_lifting_products_table', 31),
(51, '2019_12_14_094319_create_tbl_invoice_table', 32),
(52, '2019_12_13_161937_create_tbl_installment_table', 33),
(53, '2019_12_13_162441_create_tbl_installment_schedule_table', 33),
(54, '2019_12_14_110135_create_tbl_installment_collection_table', 33),
(55, '2019_12_14_110402_create_tbl_installment_collection_list_table', 33),
(56, '2019_12_15_074151_create_admins_table', 34),
(57, '2019_12_15_082743_create_tbl_showroom_table', 35),
(58, '2019_12_18_095202_create_tbl_dealers_table', 36),
(59, '2019_12_18_102145_create_tbl_dealers_table', 37),
(60, '2019_12_20_081505_create_tbl_dealers_table', 38),
(61, '2019_12_21_053354_create_tbl_liftings_table', 39),
(62, '2019_12_21_053958_create_tbl_liftings_table', 40),
(63, '2019_12_21_064729_create_tbl_transfer_products_table', 41),
(64, '2019_12_21_073947_create_tbl_transfers_table', 42),
(65, '2019_12_21_114555_create_tbl_liftings_table', 43),
(66, '2019_12_21_114623_create_tbl_lifting_products_table', 43),
(67, '2019_12_21_120031_create_tbl_liftings_table', 44),
(68, '2019_12_21_123008_create_tbl_liftings_table', 45),
(69, '2019_12_22_062554_create_tbl_transfers_table', 46),
(70, '2019_12_22_063043_create_tbl_transfer_products_table', 46),
(71, '2019_12_22_071029_create_tbl_transfer_products_table', 47),
(72, '2019_12_22_071351_create_tbl_liftings_table', 47),
(73, '2019_12_22_071446_create_tbl_lifting_products_table', 47),
(74, '2019_12_22_091356_create_tbl_transfers_table', 48),
(75, '2019_12_22_091504_create_tbl_transfer_products_table', 48),
(76, '2019_12_22_094704_create_tbl_transfers_table', 49),
(77, '2019_12_22_100323_create_tbl_transfer_products_table', 50),
(78, '2019_12_22_114503_create_tbl_liftings_table', 51),
(79, '2019_12_22_114628_create_tbl_lifting_products_table', 51),
(80, '2019_12_23_062450_create_tbl_lifting_returns_table', 52),
(81, '2019_12_23_062907_create_tbl_lifting_return_products_table', 53),
(82, '2019_12_23_071031_create_tbl_lifting_returns_table', 54);

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
  `siteLogo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adminLogo` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteEmail1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteEmail2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteAddress1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `siteAddress2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sitestatus` int(11) DEFAULT NULL,
  `metaTitle` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaKeyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `metaDescription` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_area`
--

INSERT INTO `tbl_area` (`id`, `code`, `name`, `incharge_name`, `address`, `contact`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'm11', 'Mirpur - 11', 'Dew Hunt', 'Mirpur - 11', '01317243494', 'dew@gmail.com', 1, '2019-11-30 04:33:14', '2019-11-30 06:21:02'),
(3, 'gu-00', 'Gulshan', 'Salman', 'Gulshan', '01317243494', 'sdsd@sdsd.com', 1, '2019-11-30 06:20:03', '2019-11-30 14:26:48'),
(5, 'bar-000', 'Barisal Sadar', 'Kuddus', 'Barisal', '01717243595', 'kuddus@gmail.com', 1, '2019-12-20 02:38:38', '2019-12-20 02:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank`
--

CREATE TABLE `tbl_bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_business_staffs`
--

CREATE TABLE `tbl_business_staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
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
-- Table structure for table `tbl_cash_collection`
--

CREATE TABLE `tbl_cash_collection` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `collection_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `previous_collection` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_date` date DEFAULT NULL,
  `collection_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_due` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_cash_collection`
--

INSERT INTO `tbl_cash_collection` (`id`, `invoice_id`, `collection_no`, `invoice_amount`, `previous_collection`, `collection_date`, `collection_amount`, `current_due`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(25, 26, 'col-1-19-10001', '35000.00', '0.00', '2019-12-17', '25000', '10000.00', NULL, 1, '2019-12-17 01:19:40', '2019-12-17 01:19:40'),
(26, 26, 'col-26-19-10026', '35000.00', '25000.00', '2019-12-17', '10000.00', '0', NULL, 1, '2019-12-17 01:19:58', '2019-12-17 01:19:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE `tbl_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `parent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_in_home_page` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_categories`
--

INSERT INTO `tbl_categories` (`id`, `name`, `cover_image`, `image`, `status`, `parent`, `show_in_home_page`, `meta_title`, `meta_keyword`, `meta_description`, `order_by`, `created_at`, `updated_at`) VALUES
(8, 'Television', '', '', 1, NULL, NULL, NULL, NULL, NULL, 1, '2019-12-16 00:18:32', '2019-12-16 00:23:52'),
(9, 'Refrigerator & Freezer', '', '', 1, NULL, NULL, NULL, NULL, NULL, 2, '2019-12-16 00:19:15', '2019-12-16 00:23:49'),
(10, 'Air Conditioner', NULL, NULL, 1, NULL, 'No', NULL, NULL, NULL, 2, '2019-12-16 00:43:26', '2019-12-16 00:46:37'),
(11, 'Home Applince', '', '', 1, NULL, NULL, NULL, NULL, NULL, 4, '2019-12-16 00:45:24', '2019-12-16 00:45:30'),
(12, 'LED TV', '', '', 1, NULL, NULL, NULL, NULL, NULL, 6, '2019-12-16 22:32:14', '2019-12-16 22:33:02'),
(13, 'Fridge (Beverage Cooler)', '', '', 1, '9', NULL, NULL, NULL, NULL, 2, '2019-12-17 01:40:25', '2019-12-17 01:40:25');

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
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_company`
--

INSERT INTO `tbl_company` (`id`, `prefix`, `name`, `email`, `phone`, `fax`, `website`, `vat`, `tin`, `trade_license`, `address`, `created_at`, `updated_at`) VALUES
(1, 'mnhe', 'MNH Enterprise', 'msmnh06521@gmail.com', '01716814940', '01844484530', 'www.dewsoft.com', 'vat46546gffg', 'tin567e5', 'tl32435dy5', 'Char Hogla Lodge, West Bogura Road, Munsi Graje, Barishal', '2019-12-03 02:51:19', '2019-12-07 00:27:53'),
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
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marital_status` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fathers_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_residence` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence_duration` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_family_member` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession_duration` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_earning_member` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_income` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `work_place_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`id`, `code`, `name`, `nick_name`, `age`, `phone_no`, `marital_status`, `spouse_name`, `fathers_name`, `mothers_name`, `gender`, `current_residence`, `residence_duration`, `total_family_member`, `present_address`, `permanent_address`, `profession_name`, `profession_duration`, `total_earning_member`, `designation`, `monthly_income`, `work_place_address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'mnh-1-494', 'Md. Salman Sabbir', 'Salman', 30, '01317243494', 'Married', 'Jorina', 'Abdul Jabbar', 'Shamima Khatun', 'Male', 'own', '9', '5', 'Mirpur', 'Mirpur', 'Service Holder', '5', '1', 'Software Engineer', '35000', 'Badda', 1, '2019-12-11 01:04:07', '2019-12-11 01:04:07'),
(2, 'mnh-3-744', 'Md. Dew Hunt', 'Salman', 30, '01515269744', 'Unmarried', NULL, 'Md. Aziz', 'Shamima Ferdous', 'Male', 'rent', '8', '5', 'Mirpur - 1', 'Mirpur - 1', 'Service Holder', '7', '2', 'Software Engineer', '30000', 'Badda', 1, '2019-12-11 01:08:56', '2019-12-11 01:15:30'),
(4, 'mnh-3-746', 'Mrs. Simran Khan', 'Simran', 26, '01715283746', 'Married', 'Md. Siam Khan', 'Md. Aziz', 'Mrs. Kumkum', 'Female', 'rent', '7', '3', 'Dhanmondi', 'Dhanmondi', 'Housewife', NULL, '1', NULL, NULL, NULL, 1, '2019-12-11 02:27:57', '2019-12-11 02:27:57'),
(5, 'mnh-5-746', 'Mrs. Akhi Akter', 'Akhi', 28, '01715394746', 'Married', 'Md. Soleman', 'Md. Razib', 'Mrs. Selina', 'Female', 'rent', '4', '2', 'Uttara', 'Uttara', 'Housewife', NULL, '1', NULL, NULL, NULL, 1, '2019-12-11 02:35:50', '2019-12-11 02:35:50'),
(6, 'mnh-6-915', 'Md. Sajal', 'sajal', 23, '01790941915', 'Unmarried', NULL, 'Md Ranjit', 'Mrs. Chadni', 'Male', 'own', '23', '2', 'Barisal', 'Barisal', 'Service Holder', '1', '2', 'Computer Operator', '25000', 'Barisal', 1, '2019-12-16 01:46:34', '2019-12-16 01:46:34'),
(7, 'mnh-7-541', 'Tonni Das', 'Tonni', 25, '01765984541', 'Unmarried', NULL, 'Md. Aziz', 'Shamima Khatun', 'Female', 'own', '10', '5', 'Barishal', 'Barishal', 'Service Holder', '1', '2', 'Computer Operator', '10000', 'Barshal', 1, '2019-12-16 02:33:12', '2019-12-16 02:33:12'),
(8, 'mnh-8-746', 'Md. Salman Sabbir', 'Salman', 28, '01715394746', 'Unmarried', NULL, 'Abdul Jabbar', 'Mrs. Chadni', 'Male', 'rent', '4', '2', 'Barishal', 'Barishal', 'Service Holder', '3', '1', 'Computer Operator', '10000', 'Barishal', 1, '2019-12-16 02:38:08', '2019-12-16 02:38:08'),
(9, 'mnh-9-746', 'Md. Nasir', 'Opu', 27, '01715394746', 'Married', 'Mrs. Tumpa', 'Md. Ranjit', 'Mrs. Chadni', 'Male', 'rent', '7', '5', 'Dhaka', 'Dhaka', 'Service Holder', '8', '2', 'Banker', '25000', 'Dhaka', 1, '2019-12-16 13:54:19', '2019-12-16 13:54:19'),
(10, 'mnh-10-465', 'gfsdfsfgdsfg', NULL, 23, '1234235465', 'Unmarried', NULL, 'fasdgfsdg', 'sdfsdgg', 'Male', 'own', '1', '4', 'sdgasd', 'asdgad', 'asdgadsg', '23', '23', '5fdggdfb', '3242', 'zxcbzcbc', 1, '2019-12-16 16:01:44', '2019-12-16 16:02:38'),
(11, 'mnh-11-746', 'Md. Saddam', 'saddam', 29, '01715283746', 'Unmarried', NULL, 'Md. Aziz', 'Mrs. Chadni', 'Male', 'rent', '8', '5', 'Barisal', 'Barisal', 'Service Holder', '5', '1', 'Computer Operator', '25000', 'Barisal', 1, '2019-12-16 22:57:53', '2019-12-16 22:57:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_guarantor`
--

CREATE TABLE `tbl_customer_guarantor` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `gurantor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gurantor_phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gurantor_age` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_marital_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_present_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_permanent_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_profession_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_workplace_phone_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_monthly_income` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor_work_place_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_customer_guarantor`
--

INSERT INTO `tbl_customer_guarantor` (`id`, `customer_id`, `product_id`, `gurantor_name`, `gurantor_phone_no`, `gurantor_age`, `guarantor_marital_status`, `guarantor_spouse_name`, `guarantor_father_name`, `guarantor_present_address`, `guarantor_permanent_address`, `guarantor_profession_name`, `guarantor_designation`, `guarantor_workplace_phone_no`, `guarantor_monthly_income`, `guarantor_work_place_address`, `created_at`, `updated_at`) VALUES
(1, 2, 3, 'Md. Salam', '01415239865', '35', 'Married', 'Halima', 'Md. Selim', 'Mirpur', 'Mirpur', 'Service Holder', 'Accountant', '01415239865', '40000', 'Uttara', NULL, NULL),
(2, 2, 3, 'Md. Hanif', '01617269635', '40', 'Married', 'Simu', 'Md. Rajjak', 'Mirpur', 'Mirpur', 'Service Holder', 'Accountant', '01617269635', '40000', 'Gulshan', NULL, NULL),
(3, 2, 7, 'Md. Hanif', '01617269635', '40', 'Married', 'Simu', 'Md. Rajjak', 'Mirpur', 'Mirpur', 'Service Holder', 'Accountant', '01617269635', '40000', 'U', NULL, NULL),
(4, 2, 7, 'Md. Salam', '01415239865', '35', 'Married', 'Halima', 'Md. Selim', 'Mirpur', 'Mirpur', 'Service Holder', 'Accountant', '01415239865', '40000', 't', NULL, NULL),
(9, 6, 12, 'Md. Salam', '01415239865', '35', 'Married', 'Simu', 'Md. Selim', 'Barisal', 'Barisal', 'Service Holder', 'Accountant', '0172348909', '40000', 'Barisal', NULL, NULL),
(10, 6, 12, 'Md. Hanif', '01415239865', '40', 'Married', 'Simu', 'Md. Rajjak', 'Barisal', 'Barisal', 'Service Holder', 'Accountant', '01923455779', '45000', 'Barisal', NULL, NULL),
(11, 6, 11, 'Md. Salam', '01415239865', '35', 'Married', 'Simu', 'Md. Selim', 'Barisal', 'Barisal', 'Service Holder', 'Accountant', '0172348909', '40000', 'B', NULL, NULL),
(12, 6, 11, 'Md. Hanif', '01415239865', '40', 'Married', 'Simu', 'Md. Rajjak', 'Barisal', 'Barisal', 'Service Holder', 'Accountant', '01923455779', '45000', 'a', NULL, NULL),
(13, 7, 10, 'Sajal', '01617269635', '30', 'Unmarried', NULL, 'Md. Selim', 'Barishal', 'Barishal', 'Service Holder', 'Accountant', '019874273647', '199998', 'Barishal', NULL, NULL),
(14, 7, 10, 'Md. Hanif', '01415239865', '25', 'Unmarried', NULL, 'Md. Rajjak', 'Barishal', 'Barishal', 'Service Holder', 'Accountant', '01415239865', '20002', 'Barishal', NULL, NULL),
(15, 9, 8, 'Md. Salam', '01415239865', '40', 'Married', 'Simu', 'Md. Selim', 'Dhaka', 'Dhaka', 'Service Holder', 'Accountant', '01627920223', '40000', 'Dhaka', NULL, '2019-12-16 15:52:27'),
(16, 9, 8, 'Md. Hanif', '01415239865', '35', 'Married', 'Himu', 'Md. Selim', 'Dhaka', 'Dhaka', 'Service Holder', 'Accountant', '019235473', '35000', 'Dhaka', NULL, '2019-12-16 15:52:54'),
(19, 9, 12, 'Md. Salam', '01415239865', '40', 'Married', 'Simu', 'Md. Selim', 'Dhaka', 'Dhaka', 'Service Holder', 'Accountant', '01627920223', '40000', 'D', NULL, NULL),
(20, 9, 12, 'Md. Hanif', '01415239865', '35', 'Married', 'Himu', 'Md. Selim', 'Dhaka', 'Dhaka', 'Service Holder', 'Accountant', '019235473', '35000', 'h', NULL, NULL),
(21, 11, 12, 'Md. Salam', '01415239865', '26', 'Unmarried', NULL, 'Md. Selim', 'Barisal', 'Barisal', 'Service Holder', 'Accountant', '015829374343', '29000', 'Barisal', NULL, NULL),
(22, 11, 12, 'Md. Salam', '01415239865', '25', 'Unmarried', NULL, 'Md. Selim', 'Barisal', 'Barisal', 'Service Holder', 'Accountant', '017236345734', '30000', 'Barisal', NULL, NULL),
(23, 11, 10, 'Md. Salam', '01415239865', '26', 'Unmarried', NULL, 'Md. Selim', 'Barisal', 'Barisal', 'Service Holder', 'Accountant', '015829374343', '29000', 'B', NULL, NULL),
(24, 11, 10, 'Md. Salam', '01415239865', '25', 'Unmarried', NULL, 'Md. Selim', 'Barisal', 'Barisal', 'Service Holder', 'Accountant', '017236345734', '30000', 'a', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_products`
--

CREATE TABLE `tbl_customer_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `showroom_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `warranty` int(11) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `purchase_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cash_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_installment` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `monthly_installment_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_usage_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_customer_products`
--

INSERT INTO `tbl_customer_products` (`id`, `customer_id`, `product_id`, `showroom_id`, `qty`, `warranty`, `purchase_date`, `purchase_type`, `installment_type`, `product_model`, `cash_price`, `mrp_price`, `deposite`, `installment_price`, `total_installment`, `monthly_installment_amount`, `product_usage_address`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 1, 5, '2019-12-11', 'Long Installment', 'Monthly', 'wal890', '45000', '', '15000', '54432', '12', '3286', 'MMirpur', 0, '2019-12-10 13:04:07', '2019-12-17 01:56:31'),
(2, 2, 3, 1, 1, 5, '2019-12-11', 'Long Installment', 'Monthly', 'wal890', '45000', '', '15000', '54432', '12', '3286', 'MMirpur', 0, '2019-12-10 13:08:56', '2019-12-16 22:21:47'),
(3, 2, 7, 3, 1, 10, '2019-12-11', 'Long Installment', 'Monthly', 'Wal119', '65000', '', '25000', '78624', '15', '3575', 'Mirpur - 1', 0, '2019-12-10 13:19:38', '2019-12-16 22:22:04'),
(5, 4, 5, 3, 1, 5, '2019-12-11', 'Cash', NULL, 'wal1234', '35000', '37800', NULL, NULL, NULL, NULL, 'Dhanmondi', 0, '2019-12-10 14:27:57', '2019-12-17 01:09:59'),
(6, 5, 6, 1, 1, 10, '2019-12-11', 'Cash', NULL, 'wal8126', '25000', '27000', NULL, NULL, NULL, NULL, 'Uttara', 0, '2019-12-10 14:35:50', '2019-12-17 01:15:02'),
(7, 2, 5, 1, 1, 5, '2019-12-11', 'Cash', NULL, 'wal1234', '35000', '', '', '', '', '', 'Mirpur', 0, '2019-12-10 14:45:40', '2019-12-16 22:21:28'),
(8, 5, 6, 1, 1, 10, '2019-12-12', 'Cash', NULL, 'wal8126', '25000', '27000', '', '', '', '', 'Mirpur', 0, '2019-12-12 03:07:41', '2019-12-17 01:15:11'),
(9, 6, 12, 1, 1, 10, '2019-12-16', 'Short Installment', 'Weekly', 'MSN-12K-ECXXA', '35500', '38340', '10000', '', '12', '2362', 'Barisal', 0, '2019-12-16 01:46:34', '2019-12-16 22:23:14'),
(10, 6, 11, 3, 1, 5, '2019-12-16', 'Short Installment', 'Bi-Monthlyt', 'MSD49FD-1.245 m (49\'\')', '49900', '53892', '10000', '', '12', '3658', 'Barisal', 0, '2019-12-16 01:53:45', '2019-12-16 22:25:25'),
(11, 6, 8, 1, 1, 12, '2019-12-16', 'Cash', NULL, 'MFO-JET-RXXX-XX', '10990', '11869', '', '', '', '', 'Barisal', 0, '2019-12-16 01:59:01', '2019-12-17 01:15:18'),
(12, 7, 10, 3, 1, 5, '2019-12-16', 'Long Installment', 'Monthly', 'MSD55FD-1.397 m (55\'\')', '59900', '', '50000', '72455', '12', '1871', 'Barishal', 0, '2019-12-16 02:33:12', '2019-12-16 22:24:49'),
(13, 8, 8, 1, 1, 12, '2019-12-16', 'Cash', NULL, 'MFO-JET-RXXX-XX', '10990', '11869', '', '', '', '', 'Barishal', 0, '2019-12-16 02:38:08', '2019-12-17 01:15:25'),
(14, 9, 11, 1, 1, 5, '2019-12-17', 'Cash', NULL, 'MSD49FD-1.245 m (49\'\')', '49900', '', '', '', '', '', 'Dhaka', 0, '2019-12-16 13:54:19', '2019-12-17 01:15:31'),
(15, 9, 8, 1, 1, 12, '2019-12-17', 'Short Installment', 'Weekly', 'MFO-JET-RXXX-XX', '10990', '11869', '1869', '', '10', '1000', 'Dhaka', 0, '2019-12-16 14:55:13', '2019-12-17 01:54:22'),
(18, 9, 12, 3, 1, 10, '2019-12-17', 'Long Installment', 'Monthly', 'MSN-12K-ECXXA', '35500', '', '2941', '42941', '12', '3333', 'Dhaka', 0, '2019-12-16 15:56:15', '2019-12-17 01:56:36'),
(19, 10, 12, 1, 1, 10, '2019-12-17', 'Short Installment', NULL, 'MSN-12K-ECXXA', '35500', '38340', '1232', '', '12', '3092', NULL, 0, '2019-12-16 16:01:44', '2019-12-17 01:54:28'),
(20, 11, 12, 3, 1, 10, '2019-12-17', 'Long Installment', 'Daily', 'MSN-12K-ECXXA', '35500', '', '10000', '42941', '18', '1830', 'Barisal', 0, '2019-12-16 22:57:53', '2019-12-17 01:56:45'),
(21, 11, 10, 1, 1, 5, '2019-12-17', 'Short Installment', 'Bi-Monthlyt', 'MSD55FD-1.397 m (55\'\')', '59900', '64692', '10000', '', '12', '4558', 'Barisal', 0, '2019-12-16 23:06:55', '2019-12-17 01:56:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dealers`
--

CREATE TABLE `tbl_dealers` (
  `id` int(10) UNSIGNED NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `upazila_id` int(11) DEFAULT NULL,
  `territory_id` int(11) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_limit` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_dealers`
--

INSERT INTO `tbl_dealers` (`id`, `district_id`, `upazila_id`, `territory_id`, `type`, `code`, `name`, `contact_person`, `mobile`, `email`, `address`, `credit_limit`, `status`, `created_at`, `updated_at`) VALUES
(1, 35, 9, 4, 'Non-Executive', 'es-000', 'Electronics Shop', 'Dew Hunt', '01317243494', 'dew@gmail.com', 'Barisal', '50000', 1, '2019-12-20 02:40:34', '2019-12-20 13:28:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_districts`
--

CREATE TABLE `tbl_districts` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bangla_name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_districts`
--

INSERT INTO `tbl_districts` (`id`, `name`, `bangla_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', 'ঢাকা', 1, NULL, NULL),
(2, 'Faridpur', 'ফরিদপুর', 1, NULL, NULL),
(3, 'Gazipur', 'গাজীপুর', 1, NULL, NULL),
(4, 'Gopalganj', 'গোপালগঞ্জ', 1, NULL, NULL),
(5, 'Jamalpur', 'জামালপুর', 1, NULL, NULL),
(6, 'Kishoreganj', 'কিশোরগঞ্জ', 1, NULL, NULL),
(7, 'Madaripur', 'মাদারীপুর', 1, NULL, NULL),
(8, 'Manikganj', 'মানিকগঞ্জ', 1, NULL, NULL),
(9, 'Munshiganj', 'মুন্সিগঞ্জ', 1, NULL, NULL),
(10, 'Mymensingh', 'ময়মনসিং', 1, NULL, NULL),
(11, 'Narayanganj', 'নারায়াণগঞ্জ', 1, NULL, NULL),
(12, 'Narsingdi', 'নরসিংদী', 1, NULL, NULL),
(13, 'Netrokona', 'নেত্রকোনা', 1, NULL, NULL),
(14, 'Rajbari', 'রাজবাড়ি', 1, NULL, NULL),
(15, 'Shariatpur', 'শরীয়তপুর', 1, NULL, NULL),
(16, 'Sherpur', 'শেরপুর', 1, NULL, NULL),
(17, 'Tangail', 'টাঙ্গাইল', 1, NULL, NULL),
(18, 'Bogra', 'বগুড়া', 1, NULL, NULL),
(19, 'Joypurhat', 'জয়পুরহাট', 1, NULL, NULL),
(20, 'Naogaon', 'নওগাঁ', 1, NULL, NULL),
(21, 'Natore', 'নাটোর', 1, NULL, NULL),
(22, 'Nawabganj', 'নবাবগঞ্জ', 1, NULL, NULL),
(23, 'Pabna', 'পাবনা', 1, NULL, NULL),
(24, 'Rajshahi', 'রাজশাহী', 1, NULL, NULL),
(25, 'Sirajgonj', 'সিরাজগঞ্জ', 1, NULL, NULL),
(26, 'Dinajpur', 'দিনাজপুর', 1, NULL, NULL),
(27, 'Gaibandha', 'গাইবান্ধা', 1, NULL, NULL),
(28, 'Kurigram', 'কুড়িগ্রাম', 1, NULL, NULL),
(29, 'Lalmonirhat', 'লালমনিরহাট', 1, NULL, NULL),
(30, 'Nilphamari', 'নীলফামারী', 1, NULL, NULL),
(31, 'Panchagarh', 'পঞ্চগড়', 1, NULL, NULL),
(32, 'Rangpur', 'রংপুর', 1, NULL, NULL),
(33, 'Thakurgaon', 'ঠাকুরগাঁও', 1, NULL, NULL),
(34, 'Barguna', 'বরগুনা', 1, NULL, NULL),
(35, 'Barisal', 'বরিশাল', 1, NULL, NULL),
(36, 'Bhola', 'ভোলা', 1, NULL, NULL),
(37, 'Jhalokati', 'ঝালকাঠি', 1, NULL, NULL),
(38, 'Patuakhali', 'পটুয়াখালী', 1, NULL, NULL),
(39, 'Pirojpur', 'পিরোজপুর', 1, NULL, NULL),
(40, 'Bandarban', 'বান্দরবান', 1, NULL, NULL),
(41, 'Brahmanbaria', 'ব্রাহ্মণবাড়িয়া', 1, NULL, NULL),
(42, 'Chandpur', 'চাঁদপুর', 1, NULL, NULL),
(43, 'Chittagong', 'চট্টগ্রাম', 1, NULL, NULL),
(44, 'Comilla', 'কুমিল্লা', 1, NULL, NULL),
(45, 'Cox\'s Bazar', 'কক্স বাজার', 1, NULL, NULL),
(46, 'Feni', 'ফেনী', 1, NULL, NULL),
(47, 'Khagrachari', 'খাগড়াছড়ি', 1, NULL, NULL),
(48, 'Lakshmipur', 'লক্ষ্মীপুর', 1, NULL, NULL),
(49, 'Noakhali', 'নোয়াখালী', 1, NULL, NULL),
(50, 'Rangamati', 'রাঙ্গামাটি', 1, NULL, NULL),
(51, 'Habiganj', 'হবিগঞ্জ', 1, NULL, NULL),
(52, 'Maulvibazar', 'মৌলভীবাজার', 1, NULL, NULL),
(53, 'Sunamganj', 'সুনামগঞ্জ', 1, NULL, NULL),
(54, 'Sylhet', 'সিলেট', 1, NULL, NULL),
(55, 'Bagerhat', 'বাগেরহাট', 1, NULL, NULL),
(56, 'Chuadanga', 'চুয়াডাঙ্গা', 1, NULL, NULL),
(57, 'Jessore', 'যশোর', 1, NULL, NULL),
(58, 'Jhenaidah', 'ঝিনাইদহ', 1, NULL, NULL),
(59, 'Khulna', 'খুলনা', 1, NULL, NULL),
(60, 'Kushtia', 'কুষ্টিয়া', 1, NULL, NULL),
(61, 'Magura', 'মাগুরা', 1, NULL, NULL),
(62, 'Meherpur', 'মেহেরপুর', 1, NULL, NULL),
(63, 'Narail', 'নড়াইল', 1, NULL, NULL),
(64, 'Satkhira', 'সাতক্ষীরা', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups`
--

CREATE TABLE `tbl_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_leader` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `team_member` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_groups`
--

INSERT INTO `tbl_groups` (`id`, `name`, `team_leader`, `team_member`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Group - 1', '1', '2,4', 1, '2019-12-07 03:38:38', '2019-12-07 05:36:13'),
(10, 'Group - 2', '2', '4,3', 1, '2019-12-07 03:50:48', '2019-12-07 05:36:23');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups_sales_target`
--

CREATE TABLE `tbl_groups_sales_target` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(11) NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_groups_sales_target`
--

INSERT INTO `tbl_groups_sales_target` (`id`, `group_id`, `year`, `month`, `total_target`, `created_at`, `updated_at`) VALUES
(1, 9, '2019', '12', '35', '2019-12-10 05:32:44', '2019-12-10 07:05:06'),
(2, 10, '2019', '12', '55', '2019-12-10 05:49:52', '2019-12-10 05:49:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_groups_sales_target_category`
--

CREATE TABLE `tbl_groups_sales_target_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_sales_target_id` int(11) NOT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_groups_sales_target_category`
--

INSERT INTO `tbl_groups_sales_target_category` (`id`, `group_sales_target_id`, `category_id`, `target`, `created_at`, `updated_at`) VALUES
(3, 2, '4', '25', NULL, NULL),
(4, 2, '2', '30', NULL, NULL),
(5, 1, '4', '15', NULL, NULL),
(6, 1, '2', '20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_installment`
--

CREATE TABLE `tbl_installment` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_installment`
--

INSERT INTO `tbl_installment` (`id`, `customer_product_id`, `customer_id`, `product_id`, `invoice_no`, `customer_name`, `installment_price`, `booking_amount`, `installment_qty`, `installment_amount`, `status`, `created_at`, `updated_at`) VALUES
(11, 15, 9, 8, 'inv-32-19-10032', 'Md. Nasir', '11869', '1869', '10', '1000', 0, '2019-12-17 05:51:05', '2019-12-17 07:04:35'),
(12, 19, 10, 12, 'inv-33-19-10033', 'gfsdfsfgdsfg', '38340', '1232', '12', '3092', 1, '2019-12-17 05:51:46', '2019-12-17 22:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_installment_collection`
--

CREATE TABLE `tbl_installment_collection` (
  `id` int(10) UNSIGNED NOT NULL,
  `installment_id` int(11) NOT NULL,
  `customer_product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_installment_collection`
--

INSERT INTO `tbl_installment_collection` (`id`, `installment_id`, `customer_product_id`, `customer_id`, `product_id`, `invoice_no`, `customer_name`, `installment_price`, `booking_amount`, `installment_qty`, `installment_amount`, `status`, `created_at`, `updated_at`) VALUES
(11, 11, 15, 9, 8, 'inv-32-19-10032', 'Md. Nasir', '11869', '1869', '10', '1000', 1, '2019-12-17 07:04:34', '2019-12-17 07:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_installment_collection_list`
--

CREATE TABLE `tbl_installment_collection_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `installment_id` int(11) NOT NULL,
  `installment_schedule_id` int(11) NOT NULL,
  `installment_collection_id` int(11) NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_schedule_date` date DEFAULT NULL,
  `installment_schedule_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_installment_collection_list`
--

INSERT INTO `tbl_installment_collection_list` (`id`, `installment_id`, `installment_schedule_id`, `installment_collection_id`, `invoice_no`, `installment_schedule_date`, `installment_schedule_amount`, `status`, `created_at`, `updated_at`) VALUES
(103, 11, 132, 11, 'inv-32-19-10032', '2019-12-17', '1869', 1, '2019-12-17 07:04:34', '2019-12-17 07:04:34'),
(104, 11, 133, 11, 'inv-32-19-10032', '2020-01-17', '1000', 1, '2019-12-17 07:04:34', '2019-12-17 07:04:34'),
(105, 11, 134, 11, 'inv-32-19-10032', '2020-02-17', '1000', 1, '2019-12-17 07:04:34', '2019-12-17 07:04:34'),
(106, 11, 135, 11, 'inv-32-19-10032', '2020-03-17', '1000', 1, '2019-12-17 07:04:34', '2019-12-17 07:04:34'),
(107, 11, 136, 11, 'inv-32-19-10032', '2020-04-17', '1000', 1, '2019-12-17 07:04:35', '2019-12-17 07:04:35'),
(108, 11, 137, 11, 'inv-32-19-10032', '2020-05-17', '1000', 1, '2019-12-17 07:04:35', '2019-12-17 07:04:35'),
(109, 11, 138, 11, 'inv-32-19-10032', '2020-06-17', '1000', 1, '2019-12-17 07:04:35', '2019-12-17 07:04:35'),
(110, 11, 139, 11, 'inv-32-19-10032', '2020-07-17', '1000', 1, '2019-12-17 07:04:35', '2019-12-17 07:04:35'),
(111, 11, 140, 11, 'inv-32-19-10032', '2020-08-17', '1000', 1, '2019-12-17 07:04:35', '2019-12-17 07:04:35'),
(112, 11, 141, 11, 'inv-32-19-10032', '2020-09-17', '1000', 1, '2019-12-17 07:04:35', '2019-12-17 07:04:35'),
(113, 11, 142, 11, 'inv-32-19-10032', '2020-10-17', '1000', 1, '2019-12-17 07:04:35', '2019-12-17 07:04:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_installment_schedule`
--

CREATE TABLE `tbl_installment_schedule` (
  `id` int(10) UNSIGNED NOT NULL,
  `installment_id` int(11) NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `installment_schedule_date` date DEFAULT NULL,
  `installment_schedule_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_installment_schedule`
--

INSERT INTO `tbl_installment_schedule` (`id`, `installment_id`, `invoice_no`, `installment_schedule_date`, `installment_schedule_amount`, `status`, `created_at`, `updated_at`) VALUES
(132, 11, 'inv-32-19-10032', '2019-12-17', '1869', 0, NULL, '2019-12-17 07:04:34'),
(133, 11, 'inv-32-19-10032', '2020-01-17', '1000', 0, NULL, '2019-12-17 07:04:34'),
(134, 11, 'inv-32-19-10032', '2020-02-17', '1000', 0, NULL, '2019-12-17 07:04:34'),
(135, 11, 'inv-32-19-10032', '2020-03-17', '1000', 0, NULL, '2019-12-17 07:04:34'),
(136, 11, 'inv-32-19-10032', '2020-04-17', '1000', 0, NULL, '2019-12-17 07:04:35'),
(137, 11, 'inv-32-19-10032', '2020-05-17', '1000', 0, NULL, '2019-12-17 07:04:35'),
(138, 11, 'inv-32-19-10032', '2020-06-17', '1000', 0, NULL, '2019-12-17 07:04:35'),
(139, 11, 'inv-32-19-10032', '2020-07-17', '1000', 0, NULL, '2019-12-17 07:04:35'),
(140, 11, 'inv-32-19-10032', '2020-08-17', '1000', 0, NULL, '2019-12-17 07:04:35'),
(141, 11, 'inv-32-19-10032', '2020-09-17', '1000', 0, NULL, '2019-12-17 07:04:35'),
(142, 11, 'inv-32-19-10032', '2020-10-17', '1000', 0, NULL, '2019-12-17 07:04:35'),
(143, 12, 'inv-33-19-10033', '2019-12-17', '1232', 1, NULL, '2019-12-17 22:06:25'),
(144, 12, 'inv-33-19-10033', '2020-01-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(145, 12, 'inv-33-19-10033', '2020-02-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(146, 12, 'inv-33-19-10033', '2020-03-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(147, 12, 'inv-33-19-10033', '2020-04-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(148, 12, 'inv-33-19-10033', '2020-05-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(149, 12, 'inv-33-19-10033', '2020-06-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(150, 12, 'inv-33-19-10033', '2020-07-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(151, 12, 'inv-33-19-10033', '2020-08-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(152, 12, 'inv-33-19-10033', '2020-09-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(153, 12, 'inv-33-19-10033', '2020-10-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(154, 12, 'inv-33-19-10033', '2020-11-17', '3092', 1, NULL, '2019-12-17 22:06:25'),
(155, 12, 'inv-33-19-10033', '2020-12-17', '3092', 1, NULL, '2019-12-17 22:06:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoice`
--

CREATE TABLE `tbl_invoice` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_product_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_product_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_product_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_product_waranty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_product_usage_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_product_purchase_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_invoice`
--

INSERT INTO `tbl_invoice` (`id`, `invoice_date`, `invoice_no`, `collection_type`, `customer_id`, `customer_product_id`, `product_id`, `product_serial_no`, `product_name`, `customer_product_price`, `customer_product_model`, `customer_product_color`, `customer_product_waranty`, `qty`, `customer_product_usage_address`, `customer_product_purchase_date`, `status`, `created_at`, `updated_at`) VALUES
(26, '2019-12-17', 'inv-1-19-10001', 'Cash', 4, 5, 5, '09373848', 'Walton LED TV', '35000', 'wal1234', 'Silver', '5', '1', 'Dhanmondi', '2019-12-11', 0, '2019-12-17 01:09:59', '2019-12-17 01:19:58'),
(27, '2019-12-17', 'inv-27-19-10027', 'Cash', 5, 6, 6, 'fsdafa', 'Walton Freezer', '25000', 'wal8126', 'White', '10', '1', 'Uttara', '2019-12-11', 1, '2019-12-17 01:15:02', '2019-12-17 01:15:02'),
(28, '2019-12-17', 'inv-28-19-10028', 'Cash', 5, 8, 6, '09364573', 'Walton Freezer', '25000', 'wal8126', 'White', '10', '1', 'Mirpur', '2019-12-12', 1, '2019-12-17 01:15:11', '2019-12-17 01:15:11'),
(29, '2019-12-17', 'inv-29-19-10029', 'Cash', 6, 11, 8, 'mar123408', 'Marcel Refrigerator', '10990', 'MFO-JET-RXXX-XX', 'Black', '12', '1', 'Barisal', '2019-12-16', 1, '2019-12-17 01:15:18', '2019-12-17 01:15:18'),
(30, '2019-12-17', 'inv-30-19-10030', 'Cash', 8, 13, 8, 'mmmm', 'Marcel Refrigerator', '10990', 'MFO-JET-RXXX-XX', 'Black', '12', '1', 'Barishal', '2019-12-16', 1, '2019-12-17 01:15:25', '2019-12-17 01:15:25'),
(31, '2019-12-17', 'inv-31-19-10031', 'Cash', 9, 14, 11, 'mar123557456845', 'Marcel LED TV', '49900', 'MSD49FD-1.245 m (49\'\')', 'White', '5', '1', 'Dhaka', '2019-12-17', 1, '2019-12-17 01:15:31', '2019-12-17 01:15:31'),
(32, '2019-12-17', 'inv-32-19-10032', 'Short Installment', 9, 15, 8, '4567gibjjkuygf', 'Marcel Refrigerator', '11869', 'MFO-JET-RXXX-XX', 'Black', '12', '1', 'Dhaka', '2019-12-17', 0, '2019-12-17 01:54:21', '2019-12-17 05:51:05'),
(33, '2019-12-17', 'inv-33-19-10033', 'Short Installment', 10, 19, 12, 'esefef', 'Marcel Air Conditioner', '38340', 'MSN-12K-ECXXA', 'White', '10', '1', NULL, '2019-12-17', 0, '2019-12-17 01:54:28', '2019-12-17 05:51:46'),
(34, '2019-12-17', 'inv-34-19-10034', 'Short Installment', 11, 21, 10, '09huiy546ets4', 'Marcel LED TV', '64692', 'MSD55FD-1.397 m (55\'\')', 'Black', '5', '1', 'Barisal', '2019-12-17', 1, '2019-12-17 01:56:22', '2019-12-17 01:56:22'),
(35, '2019-12-17', 'inv-35-19-10035', 'Long Installment', 1, 1, 3, 'poiuytrty', 'Walton ANDROID  ATV', '54432', 'wal890', 'Black', '5', '1', 'MMirpur', '2019-12-11', 1, '2019-12-17 01:56:31', '2019-12-17 01:56:31'),
(36, '2019-12-17', 'inv-36-19-10036', 'Long Installment', 9, 18, 12, 'sssdfd', 'Marcel Air Conditioner', '42941', 'MSN-12K-ECXXA', 'White', '10', '1', 'Dhaka', '2019-12-17', 1, '2019-12-17 01:56:36', '2019-12-17 01:56:36'),
(37, '2019-12-17', 'inv-37-19-10037', 'Long Installment', 11, 20, 12, '34536577i', 'Marcel Air Conditioner', '42941', 'MSN-12K-ECXXA', 'White', '10', '1', 'Barisal', '2019-12-17', 1, '2019-12-17 01:56:45', '2019-12-17 01:56:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_liftings`
--

CREATE TABLE `tbl_liftings` (
  `id` int(10) UNSIGNED NOT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaouchar_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `store_or_showroom_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_or_showroom_id` int(11) DEFAULT NULL,
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

INSERT INTO `tbl_liftings` (`id`, `serial_no`, `vaouchar_no`, `vendor_id`, `store_or_showroom_type`, `store_or_showroom_id`, `purchase_by`, `submission_date`, `vouchar_date`, `total_qty`, `total_price`, `total_mrp_price`, `total_haire_price`, `discount`, `vat`, `net_amount`, `created_at`, `updated_at`) VALUES
(2, '1000001', '56789546', 6, 'store', 4, 'Admin', '2019-11-01', '2019-12-01', '3', '135000.00', '145800.00', '163296.00', NULL, NULL, NULL, '2019-12-01 03:43:11', '2019-12-22 06:07:51'),
(3, '1000003', '01273', 6, 'showroom', 3, 'Admin', '2019-11-15', '2019-12-03', '3', '95000.00', '102600.00', '114912.00', NULL, NULL, NULL, '2019-12-01 03:56:03', '2019-12-22 06:07:42'),
(4, '1000004', 'vou-001', 5, 'showroom', 1, 'Admin', '2019-12-16', '2014-01-01', '3', '149700.00', '161676.00', '181077.00', NULL, NULL, NULL, '2019-12-15 01:12:40', '2019-12-22 06:07:30'),
(6, '1000005', 'VOU-004', 6, 'store', 5, 'Admin', '2019-12-16', '2019-12-16', '2', '70000.00', '75600.00', '84672.00', NULL, NULL, NULL, '2019-12-15 01:20:19', '2019-12-22 06:07:20'),
(7, '1000007', '768867', 5, 'store', 6, 'Admin', '2019-12-16', '2019-12-07', '3', '106500.00', '115020.00', '128823.00', NULL, NULL, NULL, '2019-12-15 01:27:48', '2019-12-22 06:07:13'),
(8, '1000008', 'vou-006', 5, 'store', 7, 'Admin', '2019-12-16', '2014-01-03', '2', '29190.00', '31525.00', '35309.00', NULL, NULL, NULL, '2019-12-15 02:23:19', '2019-12-22 06:07:05'),
(9, '1000009', 'hhdhd', 5, 'store', 4, 'Admin', '2019-12-16', '2019-12-16', '1', '10990.00', '11869.00', '13294.00', NULL, NULL, NULL, '2019-12-15 02:43:19', '2019-12-22 06:06:58'),
(10, '1000010', 'fasd', 5, 'showroom', 3, 'Admin', '2019-12-16', '2019-12-16', '1', '49900.00', '53892.00', '60359.00', NULL, NULL, NULL, '2019-12-15 02:46:03', '2019-12-22 06:06:40'),
(11, '1000011', 'vou-978654', 5, 'showroom', 1, 'Admin', '2019-12-16', '2019-12-16', '1', '59900.00', '64692.00', '72455.00', NULL, NULL, NULL, '2019-12-15 03:41:51', '2019-12-22 06:06:31'),
(12, '1000012', '245467i8outg', 5, 'store', 7, 'Admin', '2019-12-17', '2019-12-17', '3', '106500.00', '115020.00', '128823.00', NULL, NULL, NULL, '2019-12-15 22:48:24', '2019-12-22 05:56:35'),
(13, '1000013', '67984gdfghcvt58', 5, 'store', 6, 'Admin', '2019-12-17', '2019-12-17', '4', '43960.00', '47476.00', '53176.00', NULL, NULL, NULL, '2019-12-16 01:53:48', '2019-12-22 05:56:04'),
(14, '1000014', '0970igiyufcted', 5, 'store', 5, 'Admin', '2019-12-17', '2019-12-17', '4', '239600.00', '258768.00', '289820.00', NULL, NULL, NULL, '2019-12-16 01:56:03', '2019-12-22 05:55:51'),
(15, '1000015', '56789546', 5, 'store', 4, 'Admin', '2019-12-18', '2019-12-18', '4', '420', '454', '507', NULL, NULL, NULL, '2019-12-17 02:11:45', '2019-12-22 05:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lifting_products`
--

CREATE TABLE `tbl_lifting_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `lifting_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `store_or_showroom_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_or_showroom_id` int(11) DEFAULT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `haire_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_lifting_products`
--

INSERT INTO `tbl_lifting_products` (`id`, `lifting_id`, `vendor_id`, `product_id`, `store_or_showroom_type`, `store_or_showroom_id`, `model_no`, `serial_no`, `color`, `qty`, `price`, `mrp_price`, `haire_price`, `status`, `created_at`, `updated_at`) VALUES
(160, 15, 5, 14, 'store', 4, 'MSN-21K-0101-RXXXB', 'asfasdf', 'Red', '1', '100', '108', '121', 1, NULL, NULL),
(161, 15, 5, 14, 'store', 4, 'MSN-21K-0101-RXXXB', 'asfasdf', 'Red', '1', '150', '162', '181', 1, NULL, NULL),
(162, 15, 5, 14, 'store', 4, 'MSN-21K-0101-RXXXB', 'asfasdf', 'Red', '1', '50', '54', '60', 1, NULL, NULL),
(163, 15, 5, 14, 'store', 4, 'MSN-21K-0101-RXXXB', 'asfasdf', 'Red', '1', '120', '130', '145', 1, NULL, NULL),
(164, 14, 5, 10, 'store', 5, 'MSD55FD-1.397 m (55\'\')', '09huiy546ets4', 'Black', '1', '59900', '64692', '72455', 1, NULL, NULL),
(165, 14, 5, 10, 'store', 5, 'MSD55FD-1.397 m (55\'\')', '095f53drjfyjh', 'Black', '1', '59900', '64692', '72455', 1, NULL, NULL),
(166, 14, 5, 10, 'store', 5, 'MSD55FD-1.397 m (55\'\')', '907hutt65546f', 'Black', '1', '59900', '64692', '72455', 1, NULL, NULL),
(167, 14, 5, 10, 'store', 5, 'MSD55FD-1.397 m (55\'\')', '090787576rufy', 'Black', '1', '59900', '64692', '72455', 1, NULL, NULL),
(168, 13, 5, 8, 'store', 6, 'MFO-JET-RXXX-XX', '4567gibjjkuygf', 'Black', '1', '10990', '11869', '13294', 1, NULL, NULL),
(169, 13, 5, 8, 'store', 6, 'MFO-JET-RXXX-XX', '09uy6ygkhs', 'Black', '1', '10990', '11869', '13294', 1, NULL, NULL),
(170, 13, 5, 8, 'store', 6, 'MFO-JET-RXXX-XX', '0gh0oivhjknbr', 'Black', '1', '10990', '11869', '13294', 1, NULL, NULL),
(171, 13, 5, 8, 'store', 6, 'MFO-JET-RXXX-XX', '098hjkr5rfedfgh', 'Black', '1', '10990', '11869', '13294', 1, NULL, NULL),
(172, 12, 5, 12, 'store', 7, 'MSN-12K-ECXXA', '34536577i', 'White', '1', '35500', '38340', '42941', 1, NULL, NULL),
(173, 12, 5, 12, 'store', 7, 'MSN-12K-ECXXA', '35657iore', 'White', '1', '35500', '38340', '42941', 1, NULL, NULL),
(174, 12, 5, 12, 'store', 7, 'MSN-12K-ECXXA', 'nmg7zsnbn vd', 'White', '1', '35500', '38340', '42941', 1, NULL, NULL),
(175, 11, 5, 10, 'showroom', 1, 'MSD55FD-1.397 m (55\'\')', '234567890', 'Black', '1', '59900', '64692', '72455', 1, NULL, NULL),
(176, 10, 5, 11, 'showroom', 3, 'MSD49FD-1.245 m (49\'\')', 'eeee', 'White', '1', '49900', '53892', '60359', 1, NULL, NULL),
(177, 9, 5, 8, 'store', 4, 'MFO-JET-RXXX-XX', 'mmmm', 'Black', '1', '10990', '11869', '13294', 1, NULL, NULL),
(178, 8, 5, 9, 'store', 7, 'MFD-1B6-RXXX-XX', 'mar345678', 'Silver', '1', '18200', '19656', '22015', 1, NULL, NULL),
(179, 8, 5, 8, 'store', 7, 'MFO-JET-RXXX-XX', 'mar123408', 'Black', '1', '10990', '11869', '13294', 1, NULL, NULL),
(180, 7, 5, 12, 'store', 6, 'MSN-12K-ECXXA', 'fgdgdgsdf', 'White', '1', '35500', '38340', '42941', 1, NULL, NULL),
(181, 7, 5, 12, 'store', 6, 'MSN-12K-ECXXA', 'esefef', 'White', '1', '35500', '38340', '42941', 1, NULL, NULL),
(182, 7, 5, 12, 'store', 6, 'MSN-12K-ECXXA', 'sssdfd', 'White', '1', '35500', '38340', '42941', 1, NULL, NULL),
(183, 6, 6, 6, 'store', 5, 'wal8126', 'SDADAER3434', 'White', '1', '25000', '27000', '30240', 1, NULL, NULL),
(184, 6, 6, 3, 'store', 5, 'wal890', 'FSEDF456456', 'Black', '1', '45000', '48600', '54432', 1, NULL, NULL),
(185, 4, 5, 11, 'showroom', 1, 'MSD49FD-1.245 m (49\'\')', 'mar3423412412', 'White', '1', '49900', '53892', '60359', 1, NULL, NULL),
(186, 4, 5, 11, 'showroom', 1, 'MSD49FD-1.245 m (49\'\')', 'mar123557456845', 'White', '1', '49900', '53892', '60359', 1, NULL, NULL),
(187, 4, 5, 11, 'showroom', 1, 'MSD49FD-1.245 m (49\'\')', 'mar0990756', 'White', '1', '49900', '53892', '60359', 1, NULL, NULL),
(188, 3, 6, 5, 'showroom', 3, 'wal1234', '09373848', 'Silver', '1', '35000', '37800', '42336', 1, NULL, NULL),
(189, 3, 6, 6, 'showroom', 3, 'wal8126', '09364573', 'White', '1', '25000', '27000', '30240', 1, NULL, NULL),
(190, 3, 6, 5, 'showroom', 3, 'wal1234', 'u7gfrth0987', 'Silver', '1', '35000', '37800', '42336', 1, NULL, NULL),
(191, 2, 6, 3, 'store', 4, 'wal890', 'poiuytrty', 'Black', '1', '45000', '48600', '54432', 1, NULL, NULL),
(192, 2, 6, 6, 'store', 4, 'wal8126', 'fsdafa', 'White', '1', '25000', '27000', '30240', 1, NULL, NULL),
(193, 2, 6, 7, 'store', 4, 'Wal119', 'sdgfasdgasd', 'Red', '1', '65000', '70200', '78624', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lifting_returns`
--

CREATE TABLE `tbl_lifting_returns` (
  `id` int(10) UNSIGNED NOT NULL,
  `lifting_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `store_or_showroom_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_or_showroom_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_mrp_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_haire_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lifting_return_products`
--

CREATE TABLE `tbl_lifting_return_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `lifting_return_id` int(11) DEFAULT NULL,
  `lifting_id` int(11) DEFAULT NULL,
  `lifting_product_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `store_or_showroom_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `store_or_showroom_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `haire_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_payment_to_company`
--

INSERT INTO `tbl_payment_to_company` (`id`, `vendor_id`, `payment_no`, `payment_date`, `current_due`, `payment_now`, `balance`, `money_receipt`, `payment_type`, `remarks`, `created_at`, `updated_at`) VALUES
(5, 1, '1000001', '2019-12-15', '135000', '5000', '130000.00', 'phoohlik', 'Cash', 'kgkjhgkhj', '2019-12-15 03:46:29', '2019-12-15 03:46:29');

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
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`id`, `category_id`, `name`, `code`, `model_no`, `color`, `uom`, `price`, `mrp_price`, `haire_price`, `discount`, `warranty`, `reorder_level_qty`, `order_by`, `transport_point`, `status`, `youtube_link`, `tag_line`, `short_description`, `long_description`, `meta_title`, `meta_keyword`, `meta_description`, `created_at`, `updated_at`) VALUES
(3, '1', 'Walton ANDROID  ATV', 'wal123', 'wal890', 'Black', 'Pcs', 45000, 48600, 54432, '1000', 5, 5, 2, 3, 1, NULL, 'Smart TV', 'rogif;f;ehflk;lfjds;fanfkrengahglkan', ';jglangfarngfarnvafngabrflbFBDLB', 'Smart Tv', 'Smart Tv', 'Smart Tv', '2019-11-27 19:04:54', '2019-12-08 03:17:55'),
(5, '3', 'Walton LED TV', 'wal009', 'wal1234', 'Silver', 'Pcs', 35000, 37800, 42336, '1000', 5, 5, 2, 5, 1, NULL, 'LED TV', 'LED Tv', 'LED TV', 'LED Tv', 'LED Tv', 'LED Tv', '2019-12-01 04:31:48', '2019-12-01 04:33:04'),
(6, '5', 'Walton Freezer', 'wal567', 'wal8126', 'White', 'Pcs', 25000, 27000, 30240, '2500', 10, 5, 9, 5, 1, NULL, 'freezer', 'Walton Freezer', 'Walton Freezer', 'Walton Freezer', 'Walton Freezer', 'Walton Freezer', '2019-12-01 04:37:18', '2019-12-01 04:45:31'),
(7, '6', 'Walton Side by Side Intelligent Inverter Refrigerator', 'wal009', 'Wal119', 'Red', 'Pcs', 65000, 70200, 78624, '4998', 10, 5, 7, 8, 1, NULL, 'Walton Non Frost Freez', 'Walton Non Frost Freez', 'Walton Non Frost Freez', 'Walton Freezer', 'Walton Freezer', 'Walton Freezer', '2019-12-01 04:48:04', '2019-12-01 04:50:28'),
(8, '9', 'Marcel Refrigerator', 'mar-001', 'MFO-JET-RXXX-XX', 'Black', 'Pcs', 10990, 11869, 13294, NULL, 12, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:27:51', '2019-12-16 00:34:18'),
(9, '9', 'Marcel Refrigerator', 'Mar-002', 'MFD-1B6-RXXX-XX', 'Silver', 'Pcs', 18200, 19656, 22015, NULL, 12, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:31:13', '2019-12-16 00:37:29'),
(10, '8', 'Marcel LED TV', 'Mar-tv-001', 'MSD55FD-1.397 m (55\'\')', 'Black', 'Pcs', 59900, 64692, 72455, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:37:12', '2019-12-16 00:37:21'),
(11, '8', 'Marcel LED TV', 'Mar-tv-002', 'MSD49FD-1.245 m (49\'\')', 'White', 'Pcs', 49900, 53892, 60359, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:38:43', '2019-12-16 00:40:02'),
(12, '10', 'Marcel Air Conditioner', 'mar-ac-001', 'MSN-12K-ECXXA', 'White', 'Kg', 35500, 38340, 42941, NULL, 10, 5, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:49:32', '2019-12-16 00:52:05'),
(13, '11', 'Marcel FAN', 'mar-fan-001', 'MCF5601 WR', 'White', 'Pcs', 2700, 2916, 3266, NULL, 5, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:56:30', '2019-12-16 00:56:30'),
(14, '10', 'AIr conditioner', 'ac-002', 'MSN-21K-0101-RXXXB', 'Red', 'Kg', 52900, 57132, 63988, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 01:00:08', '2019-12-16 22:42:40'),
(15, '12', 'Walton LED TV', 'sam123', 'sam890', 'Black', NULL, 12000, 12960, 14515, NULL, 5, 5, -2, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 22:41:43', '2019-12-16 22:42:37');

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
(7, 7, 'New Arrival,Top Rated', '6', '10', 'free', 60000, '0000-00-00', NULL, NULL, '2019-12-01 04:48:04', '2019-12-01 04:48:30'),
(8, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:27:51', '2019-12-16 00:27:51'),
(9, 9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:31:13', '2019-12-16 00:31:13'),
(10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:37:12', '2019-12-16 00:37:12'),
(11, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:38:43', '2019-12-16 00:38:43'),
(12, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:49:32', '2019-12-16 00:49:32'),
(13, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 00:56:30', '2019-12-16 00:56:30'),
(14, 14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 01:00:08', '2019-12-16 01:00:08'),
(15, 15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-16 22:41:43', '2019-12-16 22:41:43');

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
  `prefix` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_license` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_showroom`
--

INSERT INTO `tbl_showroom` (`id`, `prefix`, `name`, `contact_person`, `email`, `phone`, `fax`, `website`, `vat`, `tin`, `trade_license`, `address`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dew', 'Dew Electronics', 'Dew Hunt', 'dewelectronics@gmail.com', '01317243494', '02243493', 'dewelectronics.com', 'v-12345', 'tin-12345', 'tl-12345', 'Mirpur 11, Dhaka, Bangladesh', 1, '2019-11-22 16:17:46', '2019-11-22 16:17:46'),
(3, 'TEL', 'Techno Electronics Ltd.', 'Simon', 'simon@gmail.com', '01711116677', '02667711', 'technoelectronicsltd.com.bd', 'v-9876', 'tin-9876', 'tl-9876', 'Merul Badda, Bangladesh', 1, '2019-11-22 17:20:18', '2019-11-22 17:20:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_staffs`
--

CREATE TABLE `tbl_staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stores`
--

CREATE TABLE `tbl_stores` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_stores`
--

INSERT INTO `tbl_stores` (`id`, `code`, `type`, `name`, `address`, `remarks`, `status`, `created_at`, `updated_at`) VALUES
(4, 'cas', 'Finish Stock (Warehouse)', 'College Avenue Store', 'Barisal', 'College Avenue Store', 1, '2019-12-16 01:09:24', '2019-12-16 01:09:24'),
(5, 'st-0001', 'Finish Stock (Warehouse)', 'Store 1', 'Barisal', 'Store 1', 1, '2019-12-16 22:43:44', '2019-12-21 03:22:13'),
(6, 'st-0002', 'Finish Stock (Warehouse)', 'Store 2', 'Barisal', 'Store - 2', 1, '2019-12-21 03:22:43', '2019-12-21 03:22:43'),
(7, 'st-0003', 'Finish Stock (Warehouse)', 'Store 3', 'Barisal', 'Store - 3', 1, '2019-12-21 03:23:04', '2019-12-21 03:23:04');

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
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_territories`
--

INSERT INTO `tbl_territories` (`id`, `area_id`, `code`, `name`, `incharge_name`, `address`, `contact`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'm00', 'Mirpur Territory', 'Dew Hunt', 'Mirpur', '01317243494', 1, '2019-11-30 05:36:54', '2019-12-20 02:13:43'),
(4, 5, 'bar-terr-000', 'Barisal Sadar Territory', 'Salman', 'Barisal', '01724394735', 1, '2019-12-20 02:39:48', '2019-12-20 02:39:54');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfers`
--

CREATE TABLE `tbl_transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `transfer_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `destination_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_transfers`
--

INSERT INTO `tbl_transfers` (`id`, `vendor_id`, `product_id`, `transfer_no`, `date`, `host_type`, `host_id`, `destination_type`, `destination_id`, `total_qty`, `status`, `created_at`, `updated_at`) VALUES
(4, 5, 14, '1000001', '2019-12-22', 'store', '4', 'showroom', '1', '2', 1, '2019-12-22 23:17:32', '2019-12-22 23:20:28'),
(5, 5, 10, '1000005', '2019-12-22', 'store', '5', 'showroom', '3', '2', 1, '2019-12-22 23:18:07', '2019-12-22 23:22:37'),
(6, 6, 7, '1000006', '2019-12-23', 'store', '4', 'store', '7', '1', 1, '2019-12-22 23:23:28', '2019-12-22 23:23:28'),
(7, 5, 11, '1000007', '2019-12-23', 'showroom', '3', 'showroom', '1', '1', 1, '2019-12-22 23:25:01', '2019-12-22 23:25:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer_products`
--

CREATE TABLE `tbl_transfer_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `transfer_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `lifting_product_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_transfer_products`
--

INSERT INTO `tbl_transfer_products` (`id`, `transfer_id`, `vendor_id`, `lifting_product_id`, `product_id`, `name`, `model_no`, `serial_no`, `color`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(18, 4, 5, 160, 14, 'AIr conditioner', 'MSN-21K-0101-RXXXB', 'asfasdf', 'Red', '1', 1, NULL, NULL),
(19, 4, 5, 161, 14, 'AIr conditioner', 'MSN-21K-0101-RXXXB', 'asfasdf', 'Red', '1', 1, NULL, NULL),
(20, 5, 5, 164, 10, 'Marcel LED TV', 'MSD55FD-1.397 m (55\'\')', '09huiy546ets4', 'Black', '1', 1, NULL, NULL),
(21, 5, 5, 165, 10, 'Marcel LED TV', 'MSD55FD-1.397 m (55\'\')', '095f53drjfyjh', 'Black', '1', 1, NULL, NULL),
(22, 6, 6, 193, 7, 'Walton Side by Side Intelligent Inverter Refrigerator', 'Wal119', 'sdgfasdgasd', 'Red', '1', 1, NULL, NULL),
(23, 7, 5, 176, 11, 'Marcel LED TV', 'MSD49FD-1.245 m (49\'\')', 'eeee', 'White', '1', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_upazilas`
--

CREATE TABLE `tbl_upazilas` (
  `id` int(11) UNSIGNED NOT NULL,
  `district_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `bangla_name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_upazilas`
--

INSERT INTO `tbl_upazilas` (`id`, `district_id`, `name`, `bangla_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 34, 'Amtali Upazila', 'আমতলী', 1, NULL, NULL),
(2, 34, 'Bamna Upazila', 'বামনা', 1, NULL, NULL),
(3, 34, 'Barguna Sadar Upazila', 'বরগুনা সদর', 1, NULL, NULL),
(4, 34, 'Betagi Upazila', 'বেতাগি', 1, NULL, NULL),
(5, 34, 'Patharghata Upazila', 'পাথরঘাটা', 1, NULL, NULL),
(6, 34, 'Taltali Upazila', 'তালতলী', 1, NULL, NULL),
(7, 35, 'Muladi Upazila', 'মুলাদি', 1, NULL, NULL),
(8, 35, 'Babuganj Upazila', 'বাবুগঞ্জ', 1, NULL, NULL),
(9, 35, 'Agailjhara Upazila', 'আগাইলঝরা', 1, NULL, NULL),
(10, 35, 'Barisal Sadar Upazila', 'বরিশাল সদর', 1, NULL, NULL),
(11, 35, 'Bakerganj Upazila', 'বাকেরগঞ্জ', 1, NULL, NULL),
(12, 35, 'Banaripara Upazila', 'বানাড়িপারা', 1, NULL, NULL),
(13, 35, 'Gaurnadi Upazila', 'গৌরনদী', 1, NULL, NULL),
(14, 35, 'Hizla Upazila', 'হিজলা', 1, NULL, NULL),
(15, 35, 'Mehendiganj Upazila', 'মেহেদিগঞ্জ ', 1, NULL, NULL),
(16, 35, 'Wazirpur Upazila', 'ওয়াজিরপুর', 1, NULL, NULL),
(17, 36, 'Bhola Sadar Upazila', 'ভোলা সদর', 1, NULL, NULL),
(18, 36, 'Burhanuddin Upazila', 'বুরহানউদ্দিন', 1, NULL, NULL),
(19, 36, 'Char Fasson Upazila', 'চর ফ্যাশন', 1, NULL, NULL),
(20, 36, 'Daulatkhan Upazila', 'দৌলতখান', 1, NULL, NULL),
(21, 36, 'Lalmohan Upazila', 'লালমোহন', 1, NULL, NULL),
(22, 36, 'Manpura Upazila', 'মনপুরা', 1, NULL, NULL),
(23, 36, 'Tazumuddin Upazila', 'তাজুমুদ্দিন', 1, NULL, NULL),
(24, 37, 'Jhalokati Sadar Upazila', 'ঝালকাঠি সদর', 1, NULL, NULL),
(25, 37, 'Kathalia Upazila', 'কাঁঠালিয়া', 1, NULL, NULL),
(26, 37, 'Nalchity Upazila', 'নালচিতি', 1, NULL, NULL),
(27, 37, 'Rajapur Upazila', 'রাজাপুর', 1, NULL, NULL),
(28, 38, 'Bauphal Upazila', 'বাউফল', 1, NULL, NULL),
(29, 38, 'Dashmina Upazila', 'দশমিনা', 1, NULL, NULL),
(30, 38, 'Galachipa Upazila', 'গলাচিপা', 1, NULL, NULL),
(31, 38, 'Kalapara Upazila', 'কালাপারা', 1, NULL, NULL),
(32, 38, 'Mirzaganj Upazila', 'মির্জাগঞ্জ ', 1, NULL, NULL),
(33, 38, 'Patuakhali Sadar Upazila', 'পটুয়াখালী সদর', 1, NULL, NULL),
(34, 38, 'Dumki Upazila', 'ডুমকি', 1, NULL, NULL),
(35, 38, 'Rangabali Upazila', 'রাঙ্গাবালি', 1, NULL, NULL),
(36, 39, 'Bhandaria', 'ভ্যান্ডারিয়া', 1, NULL, NULL),
(37, 39, 'Kaukhali', 'কাউখালি', 1, NULL, NULL),
(38, 39, 'Mathbaria', 'মাঠবাড়িয়া', 1, NULL, NULL),
(39, 39, 'Nazirpur', 'নাজিরপুর', 1, NULL, NULL),
(40, 39, 'Nesarabad', 'নেসারাবাদ', 1, NULL, NULL),
(41, 39, 'Pirojpur Sadar', 'পিরোজপুর সদর', 1, NULL, NULL),
(42, 39, 'Zianagar', 'জিয়ানগর', 1, NULL, NULL),
(43, 40, 'Bandarban Sadar', 'বান্দরবন সদর', 1, NULL, NULL),
(44, 40, 'Thanchi', 'থানচি', 1, NULL, NULL),
(45, 40, 'Lama', 'লামা', 1, NULL, NULL),
(46, 40, 'Naikhongchhari', 'নাইখংছড়ি ', 1, NULL, NULL),
(47, 40, 'Ali kadam', 'আলী কদম', 1, NULL, NULL),
(48, 40, 'Rowangchhari', 'রউয়াংছড়ি ', 1, NULL, NULL),
(49, 40, 'Ruma', 'রুমা', 1, NULL, NULL),
(50, 41, 'Brahmanbaria Sadar Upazila', 'ব্রাহ্মণবাড়িয়া সদর', 1, NULL, NULL),
(51, 41, 'Ashuganj Upazila', 'আশুগঞ্জ', 1, NULL, NULL),
(52, 41, 'Nasirnagar Upazila', 'নাসির নগর', 1, NULL, NULL),
(53, 41, 'Nabinagar Upazila', 'নবীনগর', 1, NULL, NULL),
(54, 41, 'Sarail Upazila', 'সরাইল', 1, NULL, NULL),
(55, 41, 'Shahbazpur Town', 'শাহবাজপুর টাউন', 1, NULL, NULL),
(56, 41, 'Kasba Upazila', 'কসবা', 1, NULL, NULL),
(57, 41, 'Akhaura Upazila', 'আখাউরা', 1, NULL, NULL),
(58, 41, 'Bancharampur Upazila', 'বাঞ্ছারামপুর', 1, NULL, NULL),
(59, 41, 'Bijoynagar Upazila', 'বিজয় নগর', 1, NULL, NULL),
(60, 42, 'Chandpur Sadar', 'চাঁদপুর সদর', 1, NULL, NULL),
(61, 42, 'Faridganj', 'ফরিদগঞ্জ', 1, NULL, NULL),
(62, 42, 'Haimchar', 'হাইমচর', 1, NULL, NULL),
(63, 42, 'Haziganj', 'হাজীগঞ্জ', 1, NULL, NULL),
(64, 42, 'Kachua', 'কচুয়া', 1, NULL, NULL),
(65, 42, 'Matlab Uttar', 'মতলব উত্তর', 1, NULL, NULL),
(66, 42, 'Matlab Dakkhin', 'মতলব দক্ষিণ', 1, NULL, NULL),
(67, 42, 'Shahrasti', 'শাহরাস্তি', 1, NULL, NULL),
(68, 43, 'Anwara Upazila', 'আনোয়ারা', 1, NULL, NULL),
(69, 43, 'Banshkhali Upazila', 'বাশখালি', 1, NULL, NULL),
(70, 43, 'Boalkhali Upazila', 'বোয়ালখালি', 1, NULL, NULL),
(71, 43, 'Chandanaish Upazila', 'চন্দনাইশ', 1, NULL, NULL),
(72, 43, 'Fatikchhari Upazila', 'ফটিকছড়ি', 1, NULL, NULL),
(73, 43, 'Hathazari Upazila', 'হাঠহাজারী', 1, NULL, NULL),
(74, 43, 'Lohagara Upazila', 'লোহাগারা', 1, NULL, NULL),
(75, 43, 'Mirsharai Upazila', 'মিরসরাই', 1, NULL, NULL),
(76, 43, 'Patiya Upazila', 'পটিয়া', 1, NULL, NULL),
(77, 43, 'Rangunia Upazila', 'রাঙ্গুনিয়া', 1, NULL, NULL),
(78, 43, 'Raozan Upazila', 'রাউজান', 1, NULL, NULL),
(79, 43, 'Sandwip Upazila', 'সন্দ্বীপ', 1, NULL, NULL),
(80, 43, 'Satkania Upazila', 'সাতকানিয়া', 1, NULL, NULL),
(81, 43, 'Sitakunda Upazila', 'সীতাকুণ্ড', 1, NULL, NULL),
(82, 44, 'Barura Upazila', 'বড়ুরা', 1, NULL, NULL),
(83, 44, 'Brahmanpara Upazila', 'ব্রাহ্মণপাড়া', 1, NULL, NULL),
(84, 44, 'Burichong Upazila', 'বুড়িচং', 1, NULL, NULL),
(85, 44, 'Chandina Upazila', 'চান্দিনা', 1, NULL, NULL),
(86, 44, 'Chauddagram Upazila', 'চৌদ্দগ্রাম', 1, NULL, NULL),
(87, 44, 'Daudkandi Upazila', 'দাউদকান্দি', 1, NULL, NULL),
(88, 44, 'Debidwar Upazila', 'দেবীদ্বার', 1, NULL, NULL),
(89, 44, 'Homna Upazila', 'হোমনা', 1, NULL, NULL),
(90, 44, 'Comilla Sadar Upazila', 'কুমিল্লা সদর', 1, NULL, NULL),
(91, 44, 'Laksam Upazila', 'লাকসাম', 1, NULL, NULL),
(92, 44, 'Monohorgonj Upazila', 'মনোহরগঞ্জ', 1, NULL, NULL),
(93, 44, 'Meghna Upazila', 'মেঘনা', 1, NULL, NULL),
(94, 44, 'Muradnagar Upazila', 'মুরাদনগর', 1, NULL, NULL),
(95, 44, 'Nangalkot Upazila', 'নাঙ্গালকোট', 1, NULL, NULL),
(96, 44, 'Comilla Sadar South Upazila', 'কুমিল্লা সদর দক্ষিণ', 1, NULL, NULL),
(97, 44, 'Titas Upazila', 'তিতাস', 1, NULL, NULL),
(98, 45, 'Chakaria Upazila', 'চকরিয়া', 1, NULL, NULL),
(100, 45, 'Cox\'s Bazar Sadar Upazila', 'কক্স বাজার সদর', 1, NULL, NULL),
(101, 45, 'Kutubdia Upazila', 'কুতুবদিয়া', 1, NULL, NULL),
(102, 45, 'Maheshkhali Upazila', 'মহেশখালী', 1, NULL, NULL),
(103, 45, 'Ramu Upazila', 'রামু', 1, NULL, NULL),
(104, 45, 'Teknaf Upazila', 'টেকনাফ', 1, NULL, NULL),
(105, 45, 'Ukhia Upazila', 'উখিয়া', 1, NULL, NULL),
(106, 45, 'Pekua Upazila', 'পেকুয়া', 1, NULL, NULL),
(107, 46, 'Feni Sadar', 'ফেনী সদর', 1, NULL, NULL),
(108, 46, 'Chagalnaiya', 'ছাগল নাইয়া', 1, NULL, NULL),
(109, 46, 'Daganbhyan', 'দাগানভিয়া', 1, NULL, NULL),
(110, 46, 'Parshuram', 'পরশুরাম', 1, NULL, NULL),
(111, 46, 'Fhulgazi', 'ফুলগাজি', 1, NULL, NULL),
(112, 46, 'Sonagazi', 'সোনাগাজি', 1, NULL, NULL),
(113, 47, 'Dighinala Upazila', 'দিঘিনালা ', 1, NULL, NULL),
(114, 47, 'Khagrachhari Upazila', 'খাগড়াছড়ি', 1, NULL, NULL),
(115, 47, 'Lakshmichhari Upazila', 'লক্ষ্মীছড়ি', 1, NULL, NULL),
(116, 47, 'Mahalchhari Upazila', 'মহলছড়ি', 1, NULL, NULL),
(117, 47, 'Manikchhari Upazila', 'মানিকছড়ি', 1, NULL, NULL),
(118, 47, 'Matiranga Upazila', 'মাটিরাঙ্গা', 1, NULL, NULL),
(119, 47, 'Panchhari Upazila', 'পানছড়ি', 1, NULL, NULL),
(120, 47, 'Ramgarh Upazila', 'রামগড়', 1, NULL, NULL),
(121, 48, 'Lakshmipur Sadar Upazila', 'লক্ষ্মীপুর সদর', 1, NULL, NULL),
(122, 48, 'Raipur Upazila', 'রায়পুর', 1, NULL, NULL),
(123, 48, 'Ramganj Upazila', 'রামগঞ্জ', 1, NULL, NULL),
(124, 48, 'Ramgati Upazila', 'রামগতি', 1, NULL, NULL),
(125, 48, 'Komol Nagar Upazila', 'কমল নগর', 1, NULL, NULL),
(126, 49, 'Noakhali Sadar Upazila', 'নোয়াখালী সদর', 1, NULL, NULL),
(127, 49, 'Begumganj Upazila', 'বেগমগঞ্জ', 1, NULL, NULL),
(128, 49, 'Chatkhil Upazila', 'চাটখিল', 1, NULL, NULL),
(129, 49, 'Companyganj Upazila', 'কোম্পানীগঞ্জ', 1, NULL, NULL),
(130, 49, 'Shenbag Upazila', 'শেনবাগ', 1, NULL, NULL),
(131, 49, 'Hatia Upazila', 'হাতিয়া', 1, NULL, NULL),
(132, 49, 'Kobirhat Upazila', 'কবিরহাট ', 1, NULL, NULL),
(133, 49, 'Sonaimuri Upazila', 'সোনাইমুরি', 1, NULL, NULL),
(134, 49, 'Suborno Char Upazila', 'সুবর্ণ চর ', 1, NULL, NULL),
(135, 50, 'Rangamati Sadar Upazila', 'রাঙ্গামাটি সদর', 1, NULL, NULL),
(136, 50, 'Belaichhari Upazila', 'বেলাইছড়ি', 1, NULL, NULL),
(137, 50, 'Bagaichhari Upazila', 'বাঘাইছড়ি', 1, NULL, NULL),
(138, 50, 'Barkal Upazila', 'বরকল', 1, NULL, NULL),
(139, 50, 'Juraichhari Upazila', 'জুরাইছড়ি', 1, NULL, NULL),
(140, 50, 'Rajasthali Upazila', 'রাজাস্থলি', 1, NULL, NULL),
(141, 50, 'Kaptai Upazila', 'কাপ্তাই', 1, NULL, NULL),
(142, 50, 'Langadu Upazila', 'লাঙ্গাডু', 1, NULL, NULL),
(143, 50, 'Nannerchar Upazila', 'নান্নেরচর ', 1, NULL, NULL),
(144, 50, 'Kaukhali Upazila', 'কাউখালি', 1, NULL, NULL),
(145, 1, 'Dhamrai Upazila', 'ধামরাই', 1, NULL, NULL),
(146, 1, 'Dohar Upazila', 'দোহার', 1, NULL, NULL),
(147, 1, 'Keraniganj Upazila', 'কেরানীগঞ্জ', 1, NULL, NULL),
(148, 1, 'Nawabganj Upazila', 'নবাবগঞ্জ', 1, NULL, NULL),
(149, 1, 'Savar Upazila', 'সাভার', 1, NULL, NULL),
(150, 2, 'Faridpur Sadar Upazila', 'ফরিদপুর সদর', 1, NULL, NULL),
(151, 2, 'Boalmari Upazila', 'বোয়ালমারী', 1, NULL, NULL),
(152, 2, 'Alfadanga Upazila', 'আলফাডাঙ্গা', 1, NULL, NULL),
(153, 2, 'Madhukhali Upazila', 'মধুখালি', 1, NULL, NULL),
(154, 2, 'Bhanga Upazila', 'ভাঙ্গা', 1, NULL, NULL),
(155, 2, 'Nagarkanda Upazila', 'নগরকান্ড', 1, NULL, NULL),
(156, 2, 'Charbhadrasan Upazila', 'চরভদ্রাসন ', 1, NULL, NULL),
(157, 2, 'Sadarpur Upazila', 'সদরপুর', 1, NULL, NULL),
(158, 2, 'Shaltha Upazila', 'শালথা', 1, NULL, NULL),
(159, 3, 'Gazipur Sadar-Joydebpur', 'গাজীপুর সদর', 1, NULL, NULL),
(160, 3, 'Kaliakior', 'কালিয়াকৈর', 1, NULL, NULL),
(161, 3, 'Kapasia', 'কাপাসিয়া', 1, NULL, NULL),
(162, 3, 'Sripur', 'শ্রীপুর', 1, NULL, NULL),
(163, 3, 'Kaliganj', 'কালীগঞ্জ', 1, NULL, NULL),
(164, 3, 'Tongi', 'টঙ্গি', 1, NULL, NULL),
(165, 4, 'Gopalganj Sadar Upazila', 'গোপালগঞ্জ সদর', 1, NULL, NULL),
(166, 4, 'Kashiani Upazila', 'কাশিয়ানি', 1, NULL, NULL),
(167, 4, 'Kotalipara Upazila', 'কোটালিপাড়া', 1, NULL, NULL),
(168, 4, 'Muksudpur Upazila', 'মুকসুদপুর', 1, NULL, NULL),
(169, 4, 'Tungipara Upazila', 'টুঙ্গিপাড়া', 1, NULL, NULL),
(170, 5, 'Dewanganj Upazila', 'দেওয়ানগঞ্জ', 1, NULL, NULL),
(171, 5, 'Baksiganj Upazila', 'বকসিগঞ্জ', 1, NULL, NULL),
(172, 5, 'Islampur Upazila', 'ইসলামপুর', 1, NULL, NULL),
(173, 5, 'Jamalpur Sadar Upazila', 'জামালপুর সদর', 1, NULL, NULL),
(174, 5, 'Madarganj Upazila', 'মাদারগঞ্জ', 1, NULL, NULL),
(175, 5, 'Melandaha Upazila', 'মেলানদাহা', 1, NULL, NULL),
(176, 5, 'Sarishabari Upazila', 'সরিষাবাড়ি ', 1, NULL, NULL),
(177, 5, 'Narundi Police I.C', 'নারুন্দি', 1, NULL, NULL),
(178, 6, 'Astagram Upazila', 'অষ্টগ্রাম', 1, NULL, NULL),
(179, 6, 'Bajitpur Upazila', 'বাজিতপুর', 1, NULL, NULL),
(180, 6, 'Bhairab Upazila', 'ভৈরব', 1, NULL, NULL),
(181, 6, 'Hossainpur Upazila', 'হোসেনপুর ', 1, NULL, NULL),
(182, 6, 'Itna Upazila', 'ইটনা', 1, NULL, NULL),
(183, 6, 'Karimganj Upazila', 'করিমগঞ্জ', 1, NULL, NULL),
(184, 6, 'Katiadi Upazila', 'কতিয়াদি', 1, NULL, NULL),
(185, 6, 'Kishoreganj Sadar Upazila', 'কিশোরগঞ্জ সদর', 1, NULL, NULL),
(186, 6, 'Kuliarchar Upazila', 'কুলিয়ারচর', 1, NULL, NULL),
(187, 6, 'Mithamain Upazila', 'মিঠামাইন', 1, NULL, NULL),
(188, 6, 'Nikli Upazila', 'নিকলি', 1, NULL, NULL),
(189, 6, 'Pakundia Upazila', 'পাকুন্ডা', 1, NULL, NULL),
(190, 6, 'Tarail Upazila', 'তাড়াইল', 1, NULL, NULL),
(191, 7, 'Madaripur Sadar', 'মাদারীপুর সদর', 1, NULL, NULL),
(192, 7, 'Kalkini', 'কালকিনি', 1, NULL, NULL),
(193, 7, 'Rajoir', 'রাজইর', 1, NULL, NULL),
(194, 7, 'Shibchar', 'শিবচর', 1, NULL, NULL),
(195, 8, 'Manikganj Sadar Upazila', 'মানিকগঞ্জ সদর', 1, NULL, NULL),
(196, 8, 'Singair Upazila', 'সিঙ্গাইর', 1, NULL, NULL),
(197, 8, 'Shibalaya Upazila', 'শিবালয়', 1, NULL, NULL),
(198, 8, 'Saturia Upazila', 'সাঠুরিয়া', 1, NULL, NULL),
(199, 8, 'Harirampur Upazila', 'হরিরামপুর', 1, NULL, NULL),
(200, 8, 'Ghior Upazila', 'ঘিওর', 1, NULL, NULL),
(201, 8, 'Daulatpur Upazila', 'দৌলতপুর', 1, NULL, NULL),
(202, 9, 'Lohajang Upazila', 'লোহাজং', 1, NULL, NULL),
(203, 9, 'Sreenagar Upazila', 'শ্রীনগর', 1, NULL, NULL),
(204, 9, 'Munshiganj Sadar Upazila', 'মুন্সিগঞ্জ সদর', 1, NULL, NULL),
(205, 9, 'Sirajdikhan Upazila', 'সিরাজদিখান', 1, NULL, NULL),
(206, 9, 'Tongibari Upazila', 'টঙ্গিবাড়ি', 1, NULL, NULL),
(207, 9, 'Gazaria Upazila', 'গজারিয়া', 1, NULL, NULL),
(208, 10, 'Bhaluka', 'ভালুকা', 1, NULL, NULL),
(209, 10, 'Trishal', 'ত্রিশাল', 1, NULL, NULL),
(210, 10, 'Haluaghat', 'হালুয়াঘাট', 1, NULL, NULL),
(211, 10, 'Muktagachha', 'মুক্তাগাছা', 1, NULL, NULL),
(212, 10, 'Dhobaura', 'ধবারুয়া', 1, NULL, NULL),
(213, 10, 'Fulbaria', 'ফুলবাড়িয়া', 1, NULL, NULL),
(214, 10, 'Gaffargaon', 'গফরগাঁও', 1, NULL, NULL),
(215, 10, 'Gauripur', 'গৌরিপুর', 1, NULL, NULL),
(216, 10, 'Ishwarganj', 'ঈশ্বরগঞ্জ', 1, NULL, NULL),
(217, 10, 'Mymensingh Sadar', 'ময়মনসিং সদর', 1, NULL, NULL),
(218, 10, 'Nandail', 'নন্দাইল', 1, NULL, NULL),
(219, 10, 'Phulpur', 'ফুলপুর', 1, NULL, NULL),
(220, 11, 'Araihazar Upazila', 'আড়াইহাজার', 1, NULL, NULL),
(221, 11, 'Sonargaon Upazila', 'সোনারগাঁও', 1, NULL, NULL),
(222, 11, 'Bandar', 'বান্দার', 1, NULL, NULL),
(223, 11, 'Naryanganj Sadar Upazila', 'নারায়ানগঞ্জ সদর', 1, NULL, NULL),
(224, 11, 'Rupganj Upazila', 'রূপগঞ্জ', 1, NULL, NULL),
(225, 11, 'Siddirgonj Upazila', 'সিদ্ধিরগঞ্জ', 1, NULL, NULL),
(226, 12, 'Belabo Upazila', 'বেলাবো', 1, NULL, NULL),
(227, 12, 'Monohardi Upazila', 'মনোহরদি', 1, NULL, NULL),
(228, 12, 'Narsingdi Sadar Upazila', 'নরসিংদী সদর', 1, NULL, NULL),
(229, 12, 'Palash Upazila', 'পলাশ', 1, NULL, NULL),
(230, 12, 'Raipura Upazila, Narsingdi', 'রায়পুর', 1, NULL, NULL),
(231, 12, 'Shibpur Upazila', 'শিবপুর', 1, NULL, NULL),
(232, 13, 'Kendua Upazilla', 'কেন্দুয়া', 1, NULL, NULL),
(233, 13, 'Atpara Upazilla', 'আটপাড়া', 1, NULL, NULL),
(234, 13, 'Barhatta Upazilla', 'বরহাট্টা', 1, NULL, NULL),
(235, 13, 'Durgapur Upazilla', 'দুর্গাপুর', 1, NULL, NULL),
(236, 13, 'Kalmakanda Upazilla', 'কলমাকান্দা', 1, NULL, NULL),
(237, 13, 'Madan Upazilla', 'মদন', 1, NULL, NULL),
(238, 13, 'Mohanganj Upazilla', 'মোহনগঞ্জ', 1, NULL, NULL),
(239, 13, 'Netrakona-S Upazilla', 'নেত্রকোনা সদর', 1, NULL, NULL),
(240, 13, 'Purbadhala Upazilla', 'পূর্বধলা', 1, NULL, NULL),
(241, 13, 'Khaliajuri Upazilla', 'খালিয়াজুরি', 1, NULL, NULL),
(242, 14, 'Baliakandi Upazila', 'বালিয়াকান্দি', 1, NULL, NULL),
(243, 14, 'Goalandaghat Upazila', 'গোয়ালন্দ ঘাট', 1, NULL, NULL),
(244, 14, 'Pangsha Upazila', 'পাংশা', 1, NULL, NULL),
(245, 14, 'Kalukhali Upazila', 'কালুখালি', 1, NULL, NULL),
(246, 14, 'Rajbari Sadar Upazila', 'রাজবাড়ি সদর', 1, NULL, NULL),
(247, 15, 'Shariatpur Sadar -Palong', 'শরীয়তপুর সদর ', 1, NULL, NULL),
(248, 15, 'Damudya Upazila', 'দামুদিয়া', 1, NULL, NULL),
(249, 15, 'Naria Upazila', 'নড়িয়া', 1, NULL, NULL),
(250, 15, 'Jajira Upazila', 'জাজিরা', 1, NULL, NULL),
(251, 15, 'Bhedarganj Upazila', 'ভেদারগঞ্জ', 1, NULL, NULL),
(252, 15, 'Gosairhat Upazila', 'গোসাইর হাট ', 1, NULL, NULL),
(253, 16, 'Jhenaigati Upazila', 'ঝিনাইগাতি', 1, NULL, NULL),
(254, 16, 'Nakla Upazila', 'নাকলা', 1, NULL, NULL),
(255, 16, 'Nalitabari Upazila', 'নালিতাবাড়ি', 1, NULL, NULL),
(256, 16, 'Sherpur Sadar Upazila', 'শেরপুর সদর', 1, NULL, NULL),
(257, 16, 'Sreebardi Upazila', 'শ্রীবরদি', 1, NULL, NULL),
(258, 17, 'Tangail Sadar Upazila', 'টাঙ্গাইল সদর', 1, NULL, NULL),
(259, 17, 'Sakhipur Upazila', 'সখিপুর', 1, NULL, NULL),
(260, 17, 'Basail Upazila', 'বসাইল', 1, NULL, NULL),
(261, 17, 'Madhupur Upazila', 'মধুপুর', 1, NULL, NULL),
(262, 17, 'Ghatail Upazila', 'ঘাটাইল', 1, NULL, NULL),
(263, 17, 'Kalihati Upazila', 'কালিহাতি', 1, NULL, NULL),
(264, 17, 'Nagarpur Upazila', 'নগরপুর', 1, NULL, NULL),
(265, 17, 'Mirzapur Upazila', 'মির্জাপুর', 1, NULL, NULL),
(266, 17, 'Gopalpur Upazila', 'গোপালপুর', 1, NULL, NULL),
(267, 17, 'Delduar Upazila', 'দেলদুয়ার', 1, NULL, NULL),
(268, 17, 'Bhuapur Upazila', 'ভুয়াপুর', 1, NULL, NULL),
(269, 17, 'Dhanbari Upazila', 'ধানবাড়ি', 1, NULL, NULL),
(270, 55, 'Bagerhat Sadar Upazila', 'বাগেরহাট সদর', 1, NULL, NULL),
(271, 55, 'Chitalmari Upazila', 'চিতলমাড়ি', 1, NULL, NULL),
(272, 55, 'Fakirhat Upazila', 'ফকিরহাট', 1, NULL, NULL),
(273, 55, 'Kachua Upazila', 'কচুয়া', 1, NULL, NULL),
(274, 55, 'Mollahat Upazila', 'মোল্লাহাট ', 1, NULL, NULL),
(275, 55, 'Mongla Upazila', 'মংলা', 1, NULL, NULL),
(276, 55, 'Morrelganj Upazila', 'মরেলগঞ্জ', 1, NULL, NULL),
(277, 55, 'Rampal Upazila', 'রামপাল', 1, NULL, NULL),
(278, 55, 'Sarankhola Upazila', 'স্মরণখোলা', 1, NULL, NULL),
(279, 56, 'Damurhuda Upazila', 'দামুরহুদা', 1, NULL, NULL),
(280, 56, 'Chuadanga-S Upazila', 'চুয়াডাঙ্গা সদর', 1, NULL, NULL),
(281, 56, 'Jibannagar Upazila', 'জীবন নগর ', 1, NULL, NULL),
(282, 56, 'Alamdanga Upazila', 'আলমডাঙ্গা', 1, NULL, NULL),
(283, 57, 'Abhaynagar Upazila', 'অভয়নগর', 1, NULL, NULL),
(284, 57, 'Keshabpur Upazila', 'কেশবপুর', 1, NULL, NULL),
(285, 57, 'Bagherpara Upazila', 'বাঘের পাড়া ', 1, NULL, NULL),
(286, 57, 'Jessore Sadar Upazila', 'যশোর সদর', 1, NULL, NULL),
(287, 57, 'Chaugachha Upazila', 'চৌগাছা', 1, NULL, NULL),
(288, 57, 'Manirampur Upazila', 'মনিরামপুর ', 1, NULL, NULL),
(289, 57, 'Jhikargachha Upazila', 'ঝিকরগাছা', 1, NULL, NULL),
(290, 57, 'Sharsha Upazila', 'সারশা', 1, NULL, NULL),
(291, 58, 'Jhenaidah Sadar Upazila', 'ঝিনাইদহ সদর', 1, NULL, NULL),
(292, 58, 'Maheshpur Upazila', 'মহেশপুর', 1, NULL, NULL),
(293, 58, 'Kaliganj Upazila', 'কালীগঞ্জ', 1, NULL, NULL),
(294, 58, 'Kotchandpur Upazila', 'কোট চাঁদপুর ', 1, NULL, NULL),
(295, 58, 'Shailkupa Upazila', 'শৈলকুপা', 1, NULL, NULL),
(296, 58, 'Harinakunda Upazila', 'হাড়িনাকুন্দা', 1, NULL, NULL),
(297, 59, 'Terokhada Upazila', 'তেরোখাদা', 1, NULL, NULL),
(298, 59, 'Batiaghata Upazila', 'বাটিয়াঘাটা ', 1, NULL, NULL),
(299, 59, 'Dacope Upazila', 'ডাকপে', 1, NULL, NULL),
(300, 59, 'Dumuria Upazila', 'ডুমুরিয়া', 1, NULL, NULL),
(301, 59, 'Dighalia Upazila', 'দিঘলিয়া', 1, NULL, NULL),
(302, 59, 'Koyra Upazila', 'কয়ড়া', 1, NULL, NULL),
(303, 59, 'Paikgachha Upazila', 'পাইকগাছা', 1, NULL, NULL),
(304, 59, 'Phultala Upazila', 'ফুলতলা', 1, NULL, NULL),
(305, 59, 'Rupsa Upazila', 'রূপসা', 1, NULL, NULL),
(306, 60, 'Kushtia Sadar', 'কুষ্টিয়া সদর', 1, NULL, NULL),
(307, 60, 'Kumarkhali', 'কুমারখালি', 1, NULL, NULL),
(308, 60, 'Daulatpur', 'দৌলতপুর', 1, NULL, NULL),
(309, 60, 'Mirpur', 'মিরপুর', 1, NULL, NULL),
(310, 60, 'Bheramara', 'ভেরামারা', 1, NULL, NULL),
(311, 60, 'Khoksa', 'খোকসা', 1, NULL, NULL),
(312, 61, 'Magura Sadar Upazila', 'মাগুরা সদর', 1, NULL, NULL),
(313, 61, 'Mohammadpur Upazila', 'মোহাম্মাদপুর', 1, NULL, NULL),
(314, 61, 'Shalikha Upazila', 'শালিখা', 1, NULL, NULL),
(315, 61, 'Sreepur Upazila', 'শ্রীপুর', 1, NULL, NULL),
(316, 62, 'angni Upazila', 'আংনি', 1, NULL, NULL),
(317, 62, 'Mujib Nagar Upazila', 'মুজিব নগর', 1, NULL, NULL),
(318, 62, 'Meherpur-S Upazila', 'মেহেরপুর সদর', 1, NULL, NULL),
(319, 63, 'Narail-S Upazilla', 'নড়াইল সদর', 1, NULL, NULL),
(320, 63, 'Lohagara Upazilla', 'লোহাগাড়া', 1, NULL, NULL),
(321, 63, 'Kalia Upazilla', 'কালিয়া', 1, NULL, NULL),
(322, 64, 'Satkhira Sadar Upazila', 'সাতক্ষীরা সদর', 1, NULL, NULL),
(323, 64, 'Assasuni Upazila', 'আসসাশুনি ', 1, NULL, NULL),
(324, 64, 'Debhata Upazila', 'দেভাটা', 1, NULL, NULL),
(325, 64, 'Tala Upazila', 'তালা', 1, NULL, NULL),
(326, 64, 'Kalaroa Upazila', 'কলরোয়া', 1, NULL, NULL),
(327, 64, 'Kaliganj Upazila', 'কালীগঞ্জ', 1, NULL, NULL),
(328, 64, 'Shyamnagar Upazila', 'শ্যামনগর', 1, NULL, NULL),
(329, 18, 'Adamdighi', 'আদমদিঘী', 1, NULL, NULL),
(330, 18, 'Bogra Sadar', 'বগুড়া সদর', 1, NULL, NULL),
(331, 18, 'Sherpur', 'শেরপুর', 1, NULL, NULL),
(332, 18, 'Dhunat', 'ধুনট', 1, NULL, NULL),
(333, 18, 'Dhupchanchia', 'দুপচাচিয়া', 1, NULL, NULL),
(334, 18, 'Gabtali', 'গাবতলি', 1, NULL, NULL),
(335, 18, 'Kahaloo', 'কাহালু', 1, NULL, NULL),
(336, 18, 'Nandigram', 'নন্দিগ্রাম', 1, NULL, NULL),
(337, 18, 'Sahajanpur', 'শাহজাহানপুর', 1, NULL, NULL),
(338, 18, 'Sariakandi', 'সারিয়াকান্দি', 1, NULL, NULL),
(339, 18, 'Shibganj', 'শিবগঞ্জ', 1, NULL, NULL),
(340, 18, 'Sonatala', 'সোনাতলা', 1, NULL, NULL),
(341, 19, 'Joypurhat S', 'জয়পুরহাট সদর', 1, NULL, NULL),
(342, 19, 'Akkelpur', 'আক্কেলপুর', 1, NULL, NULL),
(343, 19, 'Kalai', 'কালাই', 1, NULL, NULL),
(344, 19, 'Khetlal', 'খেতলাল', 1, NULL, NULL),
(345, 19, 'Panchbibi', 'পাঁচবিবি', 1, NULL, NULL),
(346, 20, 'Naogaon Sadar Upazila', 'নওগাঁ সদর', 1, NULL, NULL),
(347, 20, 'Mohadevpur Upazila', 'মহাদেবপুর', 1, NULL, NULL),
(348, 20, 'Manda Upazila', 'মান্দা', 1, NULL, NULL),
(349, 20, 'Niamatpur Upazila', 'নিয়ামতপুর', 1, NULL, NULL),
(350, 20, 'Atrai Upazila', 'আত্রাই', 1, NULL, NULL),
(351, 20, 'Raninagar Upazila', 'রাণীনগর', 1, NULL, NULL),
(352, 20, 'Patnitala Upazila', 'পত্নীতলা', 1, NULL, NULL),
(353, 20, 'Dhamoirhat Upazila', 'ধামইরহাট ', 1, NULL, NULL),
(354, 20, 'Sapahar Upazila', 'সাপাহার', 1, NULL, NULL),
(355, 20, 'Porsha Upazila', 'পোরশা', 1, NULL, NULL),
(356, 20, 'Badalgachhi Upazila', 'বদলগাছি', 1, NULL, NULL),
(357, 21, 'Natore Sadar Upazila', 'নাটোর সদর', 1, NULL, NULL),
(358, 21, 'Baraigram Upazila', 'বড়াইগ্রাম', 1, NULL, NULL),
(359, 21, 'Bagatipara Upazila', 'বাগাতিপাড়া', 1, NULL, NULL),
(360, 21, 'Lalpur Upazila', 'লালপুর', 1, NULL, NULL),
(361, 21, 'Natore Sadar Upazila', 'নাটোর সদর', 1, NULL, NULL),
(362, 21, 'Baraigram Upazila', 'বড়াই গ্রাম', 1, NULL, NULL),
(363, 22, 'Bholahat Upazila', 'ভোলাহাট', 1, NULL, NULL),
(364, 22, 'Gomastapur Upazila', 'গোমস্তাপুর', 1, NULL, NULL),
(365, 22, 'Nachole Upazila', 'নাচোল', 1, NULL, NULL),
(366, 22, 'Nawabganj Sadar Upazila', 'নবাবগঞ্জ সদর', 1, NULL, NULL),
(367, 22, 'Shibganj Upazila', 'শিবগঞ্জ', 1, NULL, NULL),
(368, 23, 'Atgharia Upazila', 'আটঘরিয়া', 1, NULL, NULL),
(369, 23, 'Bera Upazila', 'বেড়া', 1, NULL, NULL),
(370, 23, 'Bhangura Upazila', 'ভাঙ্গুরা', 1, NULL, NULL),
(371, 23, 'Chatmohar Upazila', 'চাটমোহর', 1, NULL, NULL),
(372, 23, 'Faridpur Upazila', 'ফরিদপুর', 1, NULL, NULL),
(373, 23, 'Ishwardi Upazila', 'ঈশ্বরদী', 1, NULL, NULL),
(374, 23, 'Pabna Sadar Upazila', 'পাবনা সদর', 1, NULL, NULL),
(375, 23, 'Santhia Upazila', 'সাথিয়া', 1, NULL, NULL),
(376, 23, 'Sujanagar Upazila', 'সুজানগর', 1, NULL, NULL),
(377, 24, 'Bagha', 'বাঘা', 1, NULL, NULL),
(378, 24, 'Bagmara', 'বাগমারা', 1, NULL, NULL),
(379, 24, 'Charghat', 'চারঘাট', 1, NULL, NULL),
(380, 24, 'Durgapur', 'দুর্গাপুর', 1, NULL, NULL),
(381, 24, 'Godagari', 'গোদাগারি', 1, NULL, NULL),
(382, 24, 'Mohanpur', 'মোহনপুর', 1, NULL, NULL),
(383, 24, 'Paba', 'পবা', 1, NULL, NULL),
(384, 24, 'Puthia', 'পুঠিয়া', 1, NULL, NULL),
(385, 24, 'Tanore', 'তানোর', 1, NULL, NULL),
(386, 25, 'Sirajganj Sadar Upazila', 'সিরাজগঞ্জ সদর', 1, NULL, NULL),
(387, 25, 'Belkuchi Upazila', 'বেলকুচি', 1, NULL, NULL),
(388, 25, 'Chauhali Upazila', 'চৌহালি', 1, NULL, NULL),
(389, 25, 'Kamarkhanda Upazila', 'কামারখান্দা', 1, NULL, NULL),
(390, 25, 'Kazipur Upazila', 'কাজীপুর', 1, NULL, NULL),
(391, 25, 'Raiganj Upazila', 'রায়গঞ্জ', 1, NULL, NULL),
(392, 25, 'Shahjadpur Upazila', 'শাহজাদপুর', 1, NULL, NULL),
(393, 25, 'Tarash Upazila', 'তারাশ', 1, NULL, NULL),
(394, 25, 'Ullahpara Upazila', 'উল্লাপাড়া', 1, NULL, NULL),
(395, 26, 'Birampur Upazila', 'বিরামপুর', 1, NULL, NULL),
(396, 26, 'Birganj', 'বীরগঞ্জ', 1, NULL, NULL),
(397, 26, 'Biral Upazila', 'বিড়াল', 1, NULL, NULL),
(398, 26, 'Bochaganj Upazila', 'বোচাগঞ্জ', 1, NULL, NULL),
(399, 26, 'Chirirbandar Upazila', 'চিরিরবন্দর', 1, NULL, NULL),
(400, 26, 'Phulbari Upazila', 'ফুলবাড়ি', 1, NULL, NULL),
(401, 26, 'Ghoraghat Upazila', 'ঘোড়াঘাট', 1, NULL, NULL),
(402, 26, 'Hakimpur Upazila', 'হাকিমপুর', 1, NULL, NULL),
(403, 26, 'Kaharole Upazila', 'কাহারোল', 1, NULL, NULL),
(404, 26, 'Khansama Upazila', 'খানসামা', 1, NULL, NULL),
(405, 26, 'Dinajpur Sadar Upazila', 'দিনাজপুর সদর', 1, NULL, NULL),
(406, 26, 'Nawabganj', 'নবাবগঞ্জ', 1, NULL, NULL),
(407, 26, 'Parbatipur Upazila', 'পার্বতীপুর', 1, NULL, NULL),
(408, 27, 'Fulchhari', 'ফুলছড়ি', 1, NULL, NULL),
(409, 27, 'Gaibandha sadar', 'গাইবান্ধা সদর', 1, NULL, NULL),
(410, 27, 'Gobindaganj', 'গোবিন্দগঞ্জ', 1, NULL, NULL),
(411, 27, 'Palashbari', 'পলাশবাড়ী', 1, NULL, NULL),
(412, 27, 'Sadullapur', 'সাদুল্যাপুর', 1, NULL, NULL),
(413, 27, 'Saghata', 'সাঘাটা', 1, NULL, NULL),
(414, 27, 'Sundarganj', 'সুন্দরগঞ্জ', 1, NULL, NULL),
(415, 28, 'Kurigram Sadar', 'কুড়িগ্রাম সদর', 1, NULL, NULL),
(416, 28, 'Nageshwari', 'নাগেশ্বরী', 1, NULL, NULL),
(417, 28, 'Bhurungamari', 'ভুরুঙ্গামারি', 1, NULL, NULL),
(418, 28, 'Phulbari', 'ফুলবাড়ি', 1, NULL, NULL),
(419, 28, 'Rajarhat', 'রাজারহাট', 1, NULL, NULL),
(420, 28, 'Ulipur', 'উলিপুর', 1, NULL, NULL),
(421, 28, 'Chilmari', 'চিলমারি', 1, NULL, NULL),
(422, 28, 'Rowmari', 'রউমারি', 1, NULL, NULL),
(423, 28, 'Char Rajibpur', 'চর রাজিবপুর', 1, NULL, NULL),
(424, 29, 'Lalmanirhat Sadar', 'লালমনিরহাট সদর', 1, NULL, NULL),
(425, 29, 'Aditmari', 'আদিতমারি', 1, NULL, NULL),
(426, 29, 'Kaliganj', 'কালীগঞ্জ', 1, NULL, NULL),
(427, 29, 'Hatibandha', 'হাতিবান্ধা', 1, NULL, NULL),
(428, 29, 'Patgram', 'পাটগ্রাম', 1, NULL, NULL),
(429, 30, 'Nilphamari Sadar', 'নীলফামারী সদর', 1, NULL, NULL),
(430, 30, 'Saidpur', 'সৈয়দপুর', 1, NULL, NULL),
(431, 30, 'Jaldhaka', 'জলঢাকা', 1, NULL, NULL),
(432, 30, 'Kishoreganj', 'কিশোরগঞ্জ', 1, NULL, NULL),
(433, 30, 'Domar', 'ডোমার', 1, NULL, NULL),
(434, 30, 'Dimla', 'ডিমলা', 1, NULL, NULL),
(435, 31, 'Panchagarh Sadar', 'পঞ্চগড় সদর', 1, NULL, NULL),
(436, 31, 'Debiganj', 'দেবীগঞ্জ', 1, NULL, NULL),
(437, 31, 'Boda', 'বোদা', 1, NULL, NULL),
(438, 31, 'Atwari', 'আটোয়ারি', 1, NULL, NULL),
(439, 31, 'Tetulia', 'তেতুলিয়া', 1, NULL, NULL),
(440, 32, 'Badarganj', 'বদরগঞ্জ', 1, NULL, NULL),
(441, 32, 'Mithapukur', 'মিঠাপুকুর', 1, NULL, NULL),
(442, 32, 'Gangachara', 'গঙ্গাচরা', 1, NULL, NULL),
(443, 32, 'Kaunia', 'কাউনিয়া', 1, NULL, NULL),
(444, 32, 'Rangpur Sadar', 'রংপুর সদর', 1, NULL, NULL),
(445, 32, 'Pirgachha', 'পীরগাছা', 1, NULL, NULL),
(446, 32, 'Pirganj', 'পীরগঞ্জ', 1, NULL, NULL),
(447, 32, 'Taraganj', 'তারাগঞ্জ', 1, NULL, NULL),
(448, 33, 'Thakurgaon Sadar Upazila', 'ঠাকুরগাঁও সদর', 1, NULL, NULL),
(449, 33, 'Pirganj Upazila', 'পীরগঞ্জ', 1, NULL, NULL),
(450, 33, 'Baliadangi Upazila', 'বালিয়াডাঙ্গি', 1, NULL, NULL),
(451, 33, 'Haripur Upazila', 'হরিপুর', 1, NULL, NULL),
(452, 33, 'Ranisankail Upazila', 'রাণীসংকইল', 1, NULL, NULL),
(453, 51, 'Ajmiriganj', 'আজমিরিগঞ্জ', 1, NULL, NULL),
(454, 51, 'Baniachang', 'বানিয়াচং', 1, NULL, NULL),
(455, 51, 'Bahubal', 'বাহুবল', 1, NULL, NULL),
(456, 51, 'Chunarughat', 'চুনারুঘাট', 1, NULL, NULL),
(457, 51, 'Habiganj Sadar', 'হবিগঞ্জ সদর', 1, NULL, NULL),
(458, 51, 'Lakhai', 'লাক্ষাই', 1, NULL, NULL),
(459, 51, 'Madhabpur', 'মাধবপুর', 1, NULL, NULL),
(460, 51, 'Nabiganj', 'নবীগঞ্জ', 1, NULL, NULL),
(461, 51, 'Shaistagonj Upazila', 'শায়েস্তাগঞ্জ', 1, NULL, NULL),
(462, 52, 'Moulvibazar Sadar', 'মৌলভীবাজার', 1, NULL, NULL),
(463, 52, 'Barlekha', 'বড়লেখা', 1, NULL, NULL),
(464, 52, 'Juri', 'জুড়ি', 1, NULL, NULL),
(465, 52, 'Kamalganj', 'কামালগঞ্জ', 1, NULL, NULL),
(466, 52, 'Kulaura', 'কুলাউরা', 1, NULL, NULL),
(467, 52, 'Rajnagar', 'রাজনগর', 1, NULL, NULL),
(468, 52, 'Sreemangal', 'শ্রীমঙ্গল', 1, NULL, NULL),
(469, 53, 'Bishwamvarpur', 'বিসশম্ভারপুর', 1, NULL, NULL),
(470, 53, 'Chhatak', 'ছাতক', 1, NULL, NULL),
(471, 53, 'Derai', 'দেড়াই', 1, NULL, NULL),
(472, 53, 'Dharampasha', 'ধরমপাশা', 1, NULL, NULL),
(473, 53, 'Dowarabazar', 'দোয়ারাবাজার', 1, NULL, NULL),
(474, 53, 'Jagannathpur', 'জগন্নাথপুর', 1, NULL, NULL),
(475, 53, 'Jamalganj', 'জামালগঞ্জ', 1, NULL, NULL),
(476, 53, 'Sulla', 'সুল্লা', 1, NULL, NULL),
(477, 53, 'Sunamganj Sadar', 'সুনামগঞ্জ সদর', 1, NULL, NULL),
(478, 53, 'Shanthiganj', 'শান্তিগঞ্জ', 1, NULL, NULL),
(479, 53, 'Tahirpur', 'তাহিরপুর', 1, NULL, NULL),
(480, 54, 'Sylhet Sadar', 'সিলেট সদর', 1, NULL, NULL),
(481, 54, 'Beanibazar', 'বেয়ানিবাজার', 1, NULL, NULL),
(482, 54, 'Bishwanath', 'বিশ্বনাথ', 1, NULL, NULL),
(483, 54, 'Dakshin Surma Upazila', 'দক্ষিণ সুরমা', 1, NULL, NULL),
(484, 54, 'Balaganj', 'বালাগঞ্জ', 1, NULL, NULL),
(485, 54, 'Companiganj', 'কোম্পানিগঞ্জ', 1, NULL, NULL),
(486, 54, 'Fenchuganj', 'ফেঞ্চুগঞ্জ', 1, NULL, NULL),
(487, 54, 'Golapganj', 'গোলাপগঞ্জ', 1, NULL, NULL),
(488, 54, 'Gowainghat', 'গোয়াইনঘাট', 1, NULL, NULL),
(489, 54, 'Jaintiapur', 'জয়ন্তপুর', 1, NULL, NULL),
(490, 54, 'Kanaighat', 'কানাইঘাট', 1, NULL, NULL),
(491, 54, 'Zakiganj', 'জাকিগঞ্জ', 1, NULL, NULL),
(492, 54, 'Nobigonj', 'নবীগঞ্জ', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicles`
--

CREATE TABLE `tbl_vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `registration_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
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
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_vendors`
--

INSERT INTO `tbl_vendors` (`id`, `code`, `name`, `contact_person`, `contact`, `email`, `address`, `status`, `created_at`, `updated_at`) VALUES
(4, 'je', 'Jamuna Electronics & Automobiles', 'Kroim', '01724394735', 'korim@gmail.com', 'Barisal', 1, '2019-12-16 01:05:42', '2019-12-16 01:05:50'),
(5, 'mar', 'Marcel Electronics', 'Sajjad', '01417243595', 'sajjad@gmailc.com', 'Barisal', 1, '2019-12-16 01:06:37', '2019-12-16 01:06:40'),
(6, 'whti', 'Walton Hi-Tech Industries Ltd.', 'Saddam', '01717243595', 'sadddam@gmail.com', 'Barisal', 1, '2019-12-16 01:07:51', '2019-12-16 01:09:49');

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
(25, '19', 'Vendor Statement', 'vendorStatement.index', 'fa fa-caret', 18, '1', '2019-12-05 06:30:54', '2019-12-05 06:30:54'),
(26, '6', 'Group Setup', 'groupSetup.index', 'fa fa-caret', 19, '1', '2019-12-07 00:56:48', '2019-12-07 23:18:33'),
(27, '19', 'Lifting Record', 'liftingRecord.index', 'fa fa-caret', 20, '1', '2019-12-07 23:18:06', '2019-12-07 23:18:06'),
(28, '19', 'Payment Summery', 'liftingPaymentSummary.index', 'fa fa-caret', 21, '1', '2019-12-08 05:24:21', '2019-12-18 03:49:21'),
(29, NULL, 'Inventory Management', 'admin.index', 'fa fa-bars', 22, '1', '2019-12-08 22:20:50', '2019-12-08 22:20:50'),
(30, '29', 'Out Of Stock', 'outOfStock.index', 'fa fa-caret', 23, '1', '2019-12-08 22:21:38', '2019-12-08 22:21:38'),
(31, '29', 'Stock Valuation', 'stockValuation.index', 'fa fa-caret', 24, '1', '2019-12-08 23:18:53', '2019-12-08 23:18:53'),
(32, '29', 'Stock Status', 'stockStatus.index', 'fa fa-caret', 25, '1', '2019-12-09 03:10:22', '2019-12-09 03:11:49'),
(33, NULL, 'Sales Management', 'admin.index', 'fa fa-bars', 26, '1', '2019-12-10 00:56:50', '2019-12-10 00:56:50'),
(34, '33', 'Group Sales Target', 'groupSalesTargetSetup.index', 'fa fa-caret', 27, '1', '2019-12-10 00:57:26', '2019-12-10 00:57:26'),
(35, '33', 'Customer Registration', 'customerRegistraionSetup.index', 'fa fa-caret', 28, '1', '2019-12-10 23:34:27', '2019-12-10 23:34:27'),
(36, '33', 'Invoice Setup', 'invoiceSetup.index', 'fa fa-caret', 29, '1', '2019-12-11 03:50:06', '2019-12-11 03:50:06'),
(37, '33', 'Customer Outstanding', 'customerOutstanding.index', NULL, 30, '1', '2019-12-11 05:46:00', '2019-12-11 05:46:00'),
(38, '33', 'Cash Collection', 'cashCollection.index', 'fa fa-caret', 31, '1', '2019-12-12 04:34:25', '2019-12-12 04:34:25'),
(39, '33', 'Customer Statements', 'customerStatement.index', 'fa fa-caret', 32, '1', '2019-12-12 07:14:33', '2019-12-12 07:14:33'),
(40, NULL, 'Installment Management', 'admin.index', 'fa fa-bars', 33, '1', '2019-12-14 14:43:55', '2019-12-14 14:43:55'),
(41, '40', 'Installment Schedule', 'installmentSchedule.index', 'fa fa-caret', 34, '1', '2019-12-14 14:45:08', '2019-12-14 14:45:08'),
(42, '40', 'Installment Collection', 'installmentCollection.index', 'fa fa-caret', 35, '1', '2019-12-14 14:47:55', '2019-12-14 14:47:55'),
(43, '6', 'Dealer Setup', 'dealerSetup.index', 'fa fa-bars', 36, '1', '2019-12-18 03:37:33', '2019-12-18 03:37:33'),
(44, '29', 'Product Transfer', 'transferProduct.index', 'fa fa-bars', 37, '1', '2019-12-21 02:24:10', '2019-12-21 02:24:10'),
(45, '19', 'Lifting Return', 'liftingReturn.index', 'fa fa-bars', 14, '1', '2019-12-22 23:51:07', '2019-12-22 23:57:52');

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
(67, 20, 4, 'Delete', 'lifting.delete', 80, 1, '2019-12-01 01:37:55', '2019-12-07 06:21:52'),
(69, 21, 11, 'Print Product List', 'productList.print', 68, 1, '2019-12-02 04:21:36', '2019-12-02 04:21:36'),
(70, 22, 1, 'Add', 'companySetup.add', 69, 1, '2019-12-03 01:42:18', '2019-12-03 01:42:18'),
(71, 22, 2, 'Edit', 'companySetup.edit', 70, 1, '2019-12-03 01:42:40', '2019-12-03 01:42:40'),
(72, 23, 1, 'Add', 'paymentToCompany.add', 71, 1, '2019-12-04 23:29:44', '2019-12-04 23:29:44'),
(73, 23, 2, 'Edit', 'paymentToCompany.edit', 72, 1, '2019-12-04 23:29:59', '2019-12-04 23:29:59'),
(74, 23, 4, 'Delete', 'paymentToCompany.delete', 73, 1, '2019-12-04 23:30:16', '2019-12-04 23:30:16'),
(75, 24, 11, 'Print Product Record', 'paymentRecord.print', 74, 1, '2019-12-05 05:27:38', '2019-12-05 05:27:38'),
(76, 25, 11, 'Print Vendor Statement', 'vendorStatement.print', 75, 1, '2019-12-05 06:31:33', '2019-12-05 06:31:33'),
(77, 26, 1, 'Add', 'groupSetup.add', 76, 1, '2019-12-07 00:57:35', '2019-12-07 00:57:35'),
(78, 26, 2, 'Edit', 'groupSetup.edit', 77, 1, '2019-12-07 00:57:50', '2019-12-07 00:57:50'),
(79, 26, 4, 'Delete', 'groupSetup.delete', 78, 1, '2019-12-07 00:58:24', '2019-12-07 00:58:24'),
(80, 26, 3, 'Status', 'groupSetup.status', 79, 1, '2019-12-07 00:58:47', '2019-12-07 00:58:47'),
(81, 20, 11, 'Print Product Lifting Chalan', 'lifting.print', 67, 1, '2019-12-07 06:20:33', '2019-12-07 06:22:00'),
(82, 27, 11, 'Print Lifting Record', 'liftingRecord.print', 81, 1, '2019-12-07 23:19:05', '2019-12-07 23:19:05'),
(83, 28, 11, 'Print Lifting Payment Summery', 'liftingPaymentSummary.print', 82, 1, '2019-12-08 05:24:58', '2019-12-08 05:24:58'),
(84, 30, 11, 'Print Out Of Stock', 'outOfStock.print', 83, 1, '2019-12-08 22:22:16', '2019-12-08 22:22:16'),
(85, 31, 11, 'Print Stock Valuation', 'stockValuation.print', 84, 1, '2019-12-08 23:19:38', '2019-12-08 23:19:38'),
(86, 32, 11, 'Print Stock Status', 'stockStatus.print', 85, 1, '2019-12-09 03:11:07', '2019-12-09 03:11:07'),
(88, 34, 1, 'Add', 'groupSalesTargetSetup.add', 86, 1, '2019-12-10 00:58:18', '2019-12-10 00:58:18'),
(89, 34, 2, 'Edit', 'groupSalesTargetSetup.edit', 87, 1, '2019-12-10 01:00:07', '2019-12-10 01:00:07'),
(90, 34, 4, 'Delete', 'groupSalesTargetSetup.delete', 88, 1, '2019-12-10 01:00:29', '2019-12-10 01:00:29'),
(91, 35, 1, 'Add', 'customerRegistraionSetup.add', 89, 1, '2019-12-10 23:43:40', '2019-12-10 23:43:40'),
(92, 35, 2, 'Edit', 'customerRegistraionSetup.edit', 90, 0, '2019-12-10 23:43:53', '2019-12-10 23:45:31'),
(93, 35, 4, 'Delete', 'customerRegistraionSetup.delete', 93, 1, '2019-12-10 23:44:06', '2019-12-11 01:10:58'),
(94, 35, 8, 'View Customer Details', 'customerRegistraionSetup.view', 91, 1, '2019-12-10 23:44:53', '2019-12-11 01:11:47'),
(95, 35, 11, 'Print Customer Details', 'customerRegistraionSetup.print', 92, 1, '2019-12-10 23:45:12', '2019-12-11 01:11:52'),
(96, 36, 1, 'Add', 'invoiceSetup.add', 94, 1, '2019-12-11 03:50:28', '2019-12-11 03:50:28'),
(97, 36, 8, 'View Invoice', 'invoiceSetup.view', 95, 1, '2019-12-11 03:50:57', '2019-12-11 03:50:57'),
(98, 36, 11, 'Print Invoice', 'invoiceSetup.printInvoice', 96, 1, '2019-12-11 03:51:20', '2019-12-11 03:51:20'),
(99, 36, 4, 'Delete', 'invoiceSetup.delete', 98, 1, '2019-12-11 03:51:33', '2019-12-12 06:35:10'),
(100, 37, 11, 'Print Customer Outstanding Report', 'customerOutstanding.print', 98, 1, '2019-12-11 05:46:53', '2019-12-11 05:46:53'),
(101, 38, 1, 'Add', 'cashCollection.add', 99, 1, '2019-12-12 04:35:04', '2019-12-12 04:35:04'),
(102, 38, 2, 'Edit', 'cashCollection.edit', 100, 1, '2019-12-12 04:35:14', '2019-12-12 04:35:14'),
(103, 38, 4, 'Delete', 'cashCollection.delete', 102, 1, '2019-12-12 04:35:28', '2019-12-12 04:53:47'),
(104, 38, 11, 'Print Money Receipt', 'cashCollection.print', 101, 1, '2019-12-12 04:35:58', '2019-12-14 13:54:10'),
(105, 36, 11, 'Print Chalan', 'invoiceSetup.printChalan', 97, 1, '2019-12-12 06:36:00', '2019-12-12 06:36:15'),
(106, 39, 11, 'Print Customer Statement', 'customerStatement.print', 103, 1, '2019-12-12 07:15:30', '2019-12-12 07:15:30'),
(107, 41, 1, 'Add', 'installmentSchedule.add', 104, 1, '2019-12-14 14:45:48', '2019-12-14 14:45:48'),
(108, 41, 2, 'Edit', 'installmentSchedule.edit', 105, 1, '2019-12-14 14:46:06', '2019-12-14 14:46:06'),
(109, 41, 4, 'Delete', 'installmentSchedule.delete', 106, 1, '2019-12-14 14:46:42', '2019-12-14 14:46:42'),
(110, 42, 1, 'Add', 'installmentCollection.add', 107, 1, '2019-12-14 14:48:38', '2019-12-14 14:48:38'),
(111, 42, 2, 'Edit', 'installmentCollection.edit', 108, 1, '2019-12-14 14:48:55', '2019-12-14 14:48:55'),
(112, 42, 4, 'Delete', 'installmentCollection.delete', 109, 1, '2019-12-14 14:49:14', '2019-12-14 14:49:14'),
(113, 43, 1, 'Add', 'dealerSetup.add', 110, 1, '2019-12-18 03:47:21', '2019-12-18 03:47:21'),
(114, 43, 2, 'Edit', 'dealerSetup.edit', 111, 1, '2019-12-18 03:47:48', '2019-12-18 03:47:48'),
(115, 43, 4, 'Delete', 'dealerSetup.delete', 112, 1, '2019-12-18 03:48:17', '2019-12-18 03:48:17'),
(116, 43, 3, 'Status', 'dealerSetup.status', 113, 1, '2019-12-18 03:48:30', '2019-12-18 03:48:30'),
(117, 44, 1, 'Add', 'transferProduct.add', 114, 1, '2019-12-21 02:24:34', '2019-12-21 02:24:34'),
(118, 44, 2, 'Edit', 'transferProduct.edit', 115, 1, '2019-12-21 02:24:47', '2019-12-21 02:24:47'),
(119, 44, 4, 'Delete', 'transferProduct.delete', 116, 1, '2019-12-21 02:24:59', '2019-12-21 02:24:59'),
(120, 44, 11, 'Print Product Transfer', 'transferProduct.print', 117, 1, '2019-12-21 02:25:31', '2019-12-21 02:25:31'),
(121, 45, 1, 'Add', 'liftingReturn.add', 118, 1, '2019-12-22 23:51:46', '2019-12-22 23:51:46'),
(122, 45, 2, 'Edit', 'liftingReturn.edit', 119, 1, '2019-12-22 23:52:06', '2019-12-22 23:52:06'),
(123, 45, 4, 'Delete', 'liftingReturn.delete', 121, 1, '2019-12-22 23:52:24', '2019-12-22 23:53:57'),
(124, 45, 11, 'Print Lifting Return', 'liftingReturn.print', 120, 1, '2019-12-22 23:53:35', '2019-12-22 23:54:08');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `permission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `actionPermission` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `status`, `permission`, `actionPermission`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, '1,2,3,4,5,6,7,8,10,11,12,13,14,15,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,20,18,19,17,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,57,58,59,60,61,62,63,64,65,66,81,67,69,70,71,72,73,74,75,76,77,78,79,80,82,83,84,85,86,88,89,90,91,94,95,93,96,97,98,105,99,100,101,102,104,103,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,124,123', '2019-11-20 22:48:03', '2019-12-22 23:54:30'),
(5, 'Admin', 0, '1,2,5,22', '16,20,18,19,17', '2019-11-29 03:26:52', '2019-12-15 06:09:43');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_customer_outstanding`
-- (See below for the actual view)
--
CREATE TABLE `view_customer_outstanding` (
`customerId` int(11)
,`customerName` varchar(255)
,`customerPhoneNo` varchar(255)
,`productId` int(11)
,`invoiceNo` varchar(100)
,`productName` varchar(191)
,`salesAmount` varchar(255)
,`collection` double
,`balance` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_customer_statement`
-- (See below for the actual view)
--
CREATE TABLE `view_customer_statement` (
`date` date
,`customerId` int(11)
,`customerName` varchar(255)
,`productId` int(11)
,`invoiceNo` varchar(100)
,`productName` varchar(191)
,`salesAmount` varchar(255)
,`collection` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_lifting_payment_summary`
-- (See below for the actual view)
--
CREATE TABLE `view_lifting_payment_summary` (
`vendorId` int(11)
,`vendorName` varchar(191)
,`date` varchar(191)
,`lifting` varchar(191)
,`payment` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_lifting_record`
-- (See below for the actual view)
--
CREATE TABLE `view_lifting_record` (
`liftingDate` date
,`liftingNo` varchar(191)
,`vendorId` int(11)
,`vendorName` varchar(191)
,`categoryId` varchar(191)
,`parentId` text
,`categoryName` varchar(191)
,`productId` int(11)
,`productName` varchar(191)
,`productModelNo` varchar(191)
,`productColor` varchar(191)
,`productSerialNo` varchar(191)
,`productQty` varchar(191)
,`price` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_stock_valuation`
-- (See below for the actual view)
--
CREATE TABLE `view_stock_valuation` (
`date` date
,`vendorId` int(11)
,`vendorName` varchar(191)
,`categoryId` varchar(191)
,`categoryParent` text
,`categoryName` varchar(191)
,`productId` int(11)
,`productName` varchar(191)
,`serialNo` varchar(191)
,`modelNo` varchar(191)
,`color` varchar(191)
,`reorderQty` int(11)
,`liftingQty` varchar(191)
,`liftingAmount` varchar(191)
,`liftingReturnQty` int(1)
,`liftingReturnAmount` int(1)
,`salesQty` int(1)
,`salesAmount` int(1)
,`salesReturnQty` int(1)
,`salesReturnAmount` int(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_store_and_showroom`
-- (See below for the actual view)
--
CREATE TABLE `view_store_and_showroom` (
`id` int(10) unsigned
,`type` varchar(8)
,`storeType` varchar(191)
,`name` varchar(191)
);

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
,`others` int(1)
);

-- --------------------------------------------------------

--
-- Structure for view `view_customer_outstanding`
--
DROP TABLE IF EXISTS `view_customer_outstanding`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_customer_outstanding`  AS  select `tbl_customer_products`.`customer_id` AS `customerId`,`tbl_customers`.`name` AS `customerName`,`tbl_customers`.`phone_no` AS `customerPhoneNo`,`tbl_customer_products`.`product_id` AS `productId`,`tbl_invoice`.`invoice_no` AS `invoiceNo`,`tbl_products`.`name` AS `productName`,`tbl_invoice`.`customer_product_price` AS `salesAmount`,sum(`tbl_cash_collection`.`collection_amount`) AS `collection`,`tbl_invoice`.`customer_product_price` - sum(`tbl_cash_collection`.`collection_amount`) AS `balance` from ((((`tbl_customer_products` left join `tbl_invoice` on(`tbl_invoice`.`customer_product_id` = `tbl_customer_products`.`id`)) left join `tbl_products` on(`tbl_products`.`id` = `tbl_customer_products`.`product_id`)) left join `tbl_customers` on(`tbl_customers`.`id` = `tbl_customer_products`.`customer_id`)) left join `tbl_cash_collection` on(`tbl_cash_collection`.`invoice_id` = `tbl_invoice`.`id`)) where `tbl_customer_products`.`purchase_type` = 'Cash' group by `tbl_invoice`.`invoice_no`,`tbl_cash_collection`.`invoice_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_customer_statement`
--
DROP TABLE IF EXISTS `view_customer_statement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_customer_statement`  AS  select `tbl_customer_products`.`purchase_date` AS `date`,`tbl_customer_products`.`customer_id` AS `customerId`,`tbl_customers`.`name` AS `customerName`,`tbl_customer_products`.`product_id` AS `productId`,`tbl_invoice`.`invoice_no` AS `invoiceNo`,`tbl_products`.`name` AS `productName`,`tbl_invoice`.`customer_product_price` AS `salesAmount`,0 AS `collection` from (((`tbl_customer_products` left join `tbl_invoice` on(`tbl_invoice`.`customer_product_id` = `tbl_customer_products`.`id`)) left join `tbl_products` on(`tbl_products`.`id` = `tbl_customer_products`.`product_id`)) left join `tbl_customers` on(`tbl_customers`.`id` = `tbl_customer_products`.`customer_id`)) where `tbl_customer_products`.`purchase_type` = 'Cash' union all select `tbl_cash_collection`.`collection_date` AS `date`,`tbl_customer_products`.`customer_id` AS `customerId`,`tbl_customers`.`name` AS `customerName`,`tbl_customer_products`.`product_id` AS `productId`,`tbl_invoice`.`invoice_no` AS `invoiceNo`,`tbl_products`.`name` AS `productName`,0 AS `salesAmount`,`tbl_cash_collection`.`collection_amount` AS `collection` from ((((`tbl_cash_collection` left join `tbl_invoice` on(`tbl_invoice`.`id` = `tbl_cash_collection`.`invoice_id`)) left join `tbl_customer_products` on(`tbl_customer_products`.`id` = `tbl_invoice`.`customer_product_id`)) left join `tbl_customers` on(`tbl_customers`.`id` = `tbl_invoice`.`customer_id`)) left join `tbl_products` on(`tbl_products`.`id` = `tbl_invoice`.`product_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_lifting_payment_summary`
--
DROP TABLE IF EXISTS `view_lifting_payment_summary`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_lifting_payment_summary`  AS  select `tbl_liftings`.`vendor_id` AS `vendorId`,`tbl_vendors`.`name` AS `vendorName`,`tbl_liftings`.`vouchar_date` AS `date`,`tbl_liftings`.`total_price` AS `lifting`,0 AS `payment` from (`tbl_liftings` join `tbl_vendors` on(`tbl_vendors`.`id` = `tbl_liftings`.`vendor_id`)) union all select `tbl_payment_to_company`.`vendor_id` AS `vendorId`,`tbl_vendors`.`name` AS `vendorName`,`tbl_payment_to_company`.`payment_date` AS `date`,0 AS `lifting`,`tbl_payment_to_company`.`payment_now` AS `payment` from (`tbl_payment_to_company` join `tbl_vendors` on(`tbl_vendors`.`id` = `tbl_payment_to_company`.`vendor_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_lifting_record`
--
DROP TABLE IF EXISTS `view_lifting_record`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_lifting_record`  AS  select `tbl_liftings`.`vouchar_date` AS `liftingDate`,`tbl_liftings`.`vaouchar_no` AS `liftingNo`,`tbl_liftings`.`vendor_id` AS `vendorId`,`tbl_vendors`.`name` AS `vendorName`,`tbl_products`.`category_id` AS `categoryId`,`tbl_categories`.`parent` AS `parentId`,`tbl_categories`.`name` AS `categoryName`,`tbl_lifting_products`.`product_id` AS `productId`,`tbl_products`.`name` AS `productName`,`tbl_products`.`model_no` AS `productModelNo`,`tbl_products`.`color` AS `productColor`,`tbl_lifting_products`.`serial_no` AS `productSerialNo`,`tbl_lifting_products`.`qty` AS `productQty`,`tbl_lifting_products`.`price` AS `price` from ((((`tbl_liftings` join `tbl_vendors` on(`tbl_vendors`.`id` = `tbl_liftings`.`vendor_id`)) join `tbl_lifting_products` on(`tbl_lifting_products`.`lifting_id` = `tbl_liftings`.`id`)) join `tbl_products` on(`tbl_products`.`id` = `tbl_lifting_products`.`product_id`)) join `tbl_categories` on(`tbl_categories`.`id` = `tbl_products`.`category_id`)) order by `tbl_lifting_products`.`product_id` ;

-- --------------------------------------------------------

--
-- Structure for view `view_stock_valuation`
--
DROP TABLE IF EXISTS `view_stock_valuation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_stock_valuation`  AS  select `tbl_liftings`.`vouchar_date` AS `date`,`tbl_liftings`.`vendor_id` AS `vendorId`,`tbl_vendors`.`name` AS `vendorName`,`tbl_products`.`category_id` AS `categoryId`,`tbl_categories`.`parent` AS `categoryParent`,`tbl_categories`.`name` AS `categoryName`,`tbl_lifting_products`.`product_id` AS `productId`,`tbl_products`.`name` AS `productName`,`tbl_lifting_products`.`serial_no` AS `serialNo`,`tbl_products`.`model_no` AS `modelNo`,`tbl_products`.`color` AS `color`,`tbl_products`.`reorder_level_qty` AS `reorderQty`,`tbl_lifting_products`.`qty` AS `liftingQty`,`tbl_lifting_products`.`price` AS `liftingAmount`,0 AS `liftingReturnQty`,0 AS `liftingReturnAmount`,0 AS `salesQty`,0 AS `salesAmount`,0 AS `salesReturnQty`,0 AS `salesReturnAmount` from ((((`tbl_liftings` join `tbl_vendors` on(`tbl_vendors`.`id` = `tbl_liftings`.`vendor_id`)) join `tbl_lifting_products` on(`tbl_lifting_products`.`lifting_id` = `tbl_liftings`.`id`)) join `tbl_products` on(`tbl_products`.`id` = `tbl_lifting_products`.`product_id`)) join `tbl_categories` on(`tbl_categories`.`id` = `tbl_products`.`category_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_store_and_showroom`
--
DROP TABLE IF EXISTS `view_store_and_showroom`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_store_and_showroom`  AS  select `tbl_stores`.`id` AS `id`,'store' AS `type`,`tbl_stores`.`type` AS `storeType`,`tbl_stores`.`name` AS `name` from `tbl_stores` where `tbl_stores`.`status` = '1' union select `tbl_showroom`.`id` AS `id`,'showroom' AS `type`,'' AS `storeType`,`tbl_showroom`.`name` AS `name` from `tbl_showroom` where `tbl_showroom`.`status` = '1' ;

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
-- Indexes for table `tbl_cash_collection`
--
ALTER TABLE `tbl_cash_collection`
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
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_guarantor`
--
ALTER TABLE `tbl_customer_guarantor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_customer_products`
--
ALTER TABLE `tbl_customer_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_dealers`
--
ALTER TABLE `tbl_dealers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_groups_sales_target`
--
ALTER TABLE `tbl_groups_sales_target`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_groups_sales_target_category`
--
ALTER TABLE `tbl_groups_sales_target_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_installment`
--
ALTER TABLE `tbl_installment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_installment_collection`
--
ALTER TABLE `tbl_installment_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_installment_collection_list`
--
ALTER TABLE `tbl_installment_collection_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_installment_schedule`
--
ALTER TABLE `tbl_installment_schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
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
-- Indexes for table `tbl_lifting_returns`
--
ALTER TABLE `tbl_lifting_returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lifting_return_products`
--
ALTER TABLE `tbl_lifting_return_products`
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
-- Indexes for table `tbl_transfers`
--
ALTER TABLE `tbl_transfers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_transfer_products`
--
ALTER TABLE `tbl_transfer_products`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_area`
--
ALTER TABLE `tbl_area`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `tbl_cash_collection`
--
ALTER TABLE `tbl_cash_collection`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_company`
--
ALTER TABLE `tbl_company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_couriers`
--
ALTER TABLE `tbl_couriers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_customer_guarantor`
--
ALTER TABLE `tbl_customer_guarantor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_customer_products`
--
ALTER TABLE `tbl_customer_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_dealers`
--
ALTER TABLE `tbl_dealers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_groups`
--
ALTER TABLE `tbl_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_groups_sales_target`
--
ALTER TABLE `tbl_groups_sales_target`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_groups_sales_target_category`
--
ALTER TABLE `tbl_groups_sales_target_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_installment`
--
ALTER TABLE `tbl_installment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_installment_collection`
--
ALTER TABLE `tbl_installment_collection`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_installment_collection_list`
--
ALTER TABLE `tbl_installment_collection_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- AUTO_INCREMENT for table `tbl_installment_schedule`
--
ALTER TABLE `tbl_installment_schedule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `tbl_invoice`
--
ALTER TABLE `tbl_invoice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_liftings`
--
ALTER TABLE `tbl_liftings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_lifting_products`
--
ALTER TABLE `tbl_lifting_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `tbl_lifting_returns`
--
ALTER TABLE `tbl_lifting_returns`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_lifting_return_products`
--
ALTER TABLE `tbl_lifting_return_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_payment_to_company`
--
ALTER TABLE `tbl_payment_to_company`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_product_advance`
--
ALTER TABLE `tbl_product_advance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_stores`
--
ALTER TABLE `tbl_stores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_territories`
--
ALTER TABLE `tbl_territories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_transfers`
--
ALTER TABLE `tbl_transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_transfer_products`
--
ALTER TABLE `tbl_transfer_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_vehicles`
--
ALTER TABLE `tbl_vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_vendors`
--
ALTER TABLE `tbl_vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_menus`
--
ALTER TABLE `user_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user_menu_actions`
--
ALTER TABLE `user_menu_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
