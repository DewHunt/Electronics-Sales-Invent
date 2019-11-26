-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2019 at 09:31 PM
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
  `showroomId` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'Admin', 'admin@gmail.com', 'admin', NULL, 1, '0', '$2y$10$wcjSEsgXU5pSM16fpwouju905lsZrFFxc5J68jQanfo8Jl6EQWXbe', 1, NULL, NULL, NULL),
(3, 'Salman', 'salman@gmail.com', 'salman', 'D:\\xampp\\tmp\\php13B2.tmp', 2, '1', '$2y$10$C2upubhDeyF0wm732wpGdeHB2dn68KOUpAAHCnynvHbyRXOxyoJzO', 0, NULL, '2019-11-24 01:28:37', '2019-11-24 01:28:37'),
(4, 'Dew Hunt', 'dew@gmail.com', 'DewHunt', 'public/uploads/admin_images/avatar7_20165942041.png', 2, '1', '$2y$10$nP/X0y6wMRBy7RqMk2Yz9.8SMR8FrDS2UWcs2NTAI6oTOQiiWKbIe', 0, NULL, '2019-11-24 02:03:40', '2019-11-24 07:10:28'),
(5, 'Fattah', 'fattah@gmail.com', 'fattah', 'public/uploads/admin_images/images_21444773304.jpg', 2, '1,3', '$2y$10$wpFxh0bQbgbOU2n9ZSBhPOiOFvloC3WiLvpEj8MccqmLarwjHOcG2', 0, NULL, '2019-11-24 02:09:05', '2019-11-24 03:15:50');

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
(3, '2019_04_17_062734_create_user_roles_table', 1),
(4, '2019_11_20_081346_create_tbl_user_menus_table', 1),
(5, '2019_11_20_082610_create_tbl_user_menu_actions_table', 1),
(6, '2019_11_21_101948_create_user_menu_actions_table', 1),
(7, '2019_11_21_102012_create_user_menus_table', 1),
(8, '2019_03_13_121439_create_menus_table', 2),
(9, '2019_03_19_065715_create_settings_table', 3),
(10, '2019_11_23_091359_create_tbl_showroom_table', 4),
(11, '2019_11_24_063948_add_columns_to_admins_table', 5),
(12, '2019_11_25_065701_create_tbl_categories_table', 6),
(13, '2019_11_26_041205_create_tbl_categories_table', 7);

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
(1, 'Smart Television', 'public/uploads/category_image/download_14321410993.jpg', 'public/uploads/category_image/W49E3000AS-1-220x220h_12931520932.jpg', 1, '2', 'Yes', 'Electronics || Bangladeshi Electronics Products', 'Electronics, Electronocs in Bangladesh', 'Electronics Products.', 2, '2019-11-26 00:07:28', '2019-11-26 01:32:11'),
(2, 'Television', 'public/uploads/category_image/81OwqiQckgL._SL1500__96781947791.jpg', 'public/uploads/category_image/43UM7400_original_65661783580.jpg', 1, NULL, 'Yes', 'Electronics || Bangladeshi Electronics Products', 'Electronics, Electronocs in Bangladesh', 'Electronics Products.', NULL, '2019-11-26 00:13:09', '2019-11-26 00:13:09');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_showroom`
--

INSERT INTO `tbl_showroom` (`id`, `prefix`, `name`, `contact_person`, `email`, `phone`, `fax`, `website`, `vat`, `tin`, `trade_license`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Dew', 'Dew Electronics', 'Dew Hunt', 'dewelectronics@gmail.com', '01317243494', '02243493', 'dewelectronics.com', 'v-12345', 'tin-12345', 'tl-12345', 'Mirpur 11, Dhaka, Bangladesh', '2019-11-23 04:17:46', '2019-11-23 04:17:46'),
(3, 'TEL', 'Techno Electronics Ltd.', 'Simon', 'simon@gmail.com', '01711116677', '02667711', 'technoelectronicsltd.com.bd', 'v-9876', 'tin-9876', 'tl-9876', 'Merul Badda, Bangladesh', '2019-11-23 05:20:18', '2019-11-23 05:20:18');

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
(1, '2', 'Menus', 'usermenu.index', 'fa fa-bars', 1, '1', '2019-11-21 05:22:02', '2019-11-21 05:22:02'),
(2, NULL, 'User Management', 'admin.index', 'fa fa-bars', 1, '1', '2019-11-21 05:56:43', '2019-11-21 05:56:43'),
(3, '2', 'Users Role', 'user-roles.index', 'fa fa-caret', 2, '1', '2019-11-21 06:44:26', '2019-11-23 00:39:34'),
(4, '2', 'Showroom Setup', 'showroomSetup.index', 'fa fa-caret', 3, '1', '2019-11-23 01:20:57', '2019-11-23 02:03:09'),
(5, '2', 'Create User', 'user.index', 'fa fa-caret', 4, '1', '2019-11-23 05:52:47', '2019-11-23 05:52:47'),
(6, NULL, 'Business Settings', 'admin.index', 'fa fa-bars', 5, '1', '2019-11-24 23:01:00', '2019-11-24 23:01:00'),
(7, '6', 'Category Setup', 'categorySetup.index', 'fa fa-caret', 1, '1', '2019-11-25 00:19:54', '2019-11-26 14:29:29'),
(8, '6', 'Product Setup', 'productSetup.index', 'fa fa-caret', 2, '1', '2019-11-26 03:04:52', '2019-11-26 03:04:52');

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
(1, 1, 1, 'Add', 'usermenu.add', 1, 1, '2019-11-21 06:16:57', '2019-11-21 06:16:57'),
(2, 1, 2, 'Edit', 'usermenu.edit', 2, 1, '2019-11-21 06:17:21', '2019-11-21 06:17:21'),
(3, 1, 3, 'Status', 'usermenu.status', 3, 1, '2019-11-21 06:17:51', '2019-11-21 06:17:51'),
(4, 1, 8, 'View Action Menu', 'usermenuLink.index', 4, 1, '2019-11-21 06:18:13', '2019-11-21 06:18:13'),
(5, 1, 4, 'Delete', 'usermenu-delete', 5, 1, '2019-11-21 06:18:32', '2019-11-21 06:18:32'),
(6, 3, 1, 'ADD', 'userRoleAdd.page', 6, 1, '2019-11-21 06:45:20', '2019-11-21 06:45:20'),
(7, 3, 2, 'Edit', 'userRole.edit', 7, 1, '2019-11-21 06:45:53', '2019-11-21 06:45:53'),
(8, 3, 3, 'Status', 'userRole.changeuserRoleStatus', 8, 1, '2019-11-21 06:46:19', '2019-11-21 06:46:19'),
(9, 3, 5, 'Permission', 'userRole.permission', 9, 1, '2019-11-21 06:46:43', '2019-11-21 06:46:43'),
(10, 3, 4, 'Delete User Role', 'userRole.delete', 10, 1, '2019-11-21 06:46:57', '2019-11-21 06:46:57'),
(11, 4, 1, 'Add New Showroom', 'showroomSetup.add', 11, 1, '2019-11-23 01:22:27', '2019-11-23 01:22:27'),
(12, 4, 3, 'Showroom Status', 'showroomSetup.status', 12, 1, '2019-11-23 01:28:18', '2019-11-23 01:28:18'),
(13, 4, 2, 'Edit Showroom', 'showroomSetup.edit', 13, 1, '2019-11-23 01:28:54', '2019-11-23 01:28:54'),
(14, 4, 4, 'Delete Showroom', 'showroomSetup.delete', 14, 1, '2019-11-23 01:29:30', '2019-11-23 01:29:30'),
(15, 5, 1, 'Add User', 'user.add', 15, 1, '2019-11-23 05:58:36', '2019-11-23 05:58:36'),
(16, 5, 2, 'Edit User', 'user.edit', 16, 1, '2019-11-23 05:59:13', '2019-11-23 05:59:13'),
(17, 5, 3, 'User Status', 'user.status', 20, 1, '2019-11-23 05:59:58', '2019-11-23 05:59:58'),
(18, 5, 6, 'Change User Password', 'user.changePassword', 18, 1, '2019-11-23 06:02:44', '2019-11-23 06:02:44'),
(19, 5, 4, 'Delete user', 'user.delete', 19, 1, '2019-11-23 06:04:45', '2019-11-23 06:04:45'),
(20, 5, 7, 'View User', 'user.viewProfile', 17, 1, '2019-11-23 06:06:17', '2019-11-23 06:06:17'),
(21, 7, 1, 'Add', 'categorySetup.add', 21, 1, '2019-11-25 00:20:28', '2019-11-25 00:20:28'),
(22, 7, 2, 'Edit', 'categorySetup.edit', 22, 1, '2019-11-25 00:20:54', '2019-11-25 00:20:54'),
(23, 7, 4, 'Delete', 'categorySetup.delete', 23, 1, '2019-11-25 00:38:43', '2019-11-25 00:38:43'),
(24, 7, 3, 'Status', 'categorySetup.status', 24, 1, '2019-11-25 00:40:19', '2019-11-26 03:10:39'),
(25, 8, 1, 'Add', 'productSetup.add', 25, 1, '2019-11-26 03:05:58', '2019-11-26 03:05:58'),
(26, 8, 2, 'Edit', 'productSetup.edit', 26, 1, '2019-11-26 03:06:22', '2019-11-26 03:06:22'),
(27, 8, 4, 'Delete', 'productSetup.delete', 27, 1, '2019-11-26 03:07:04', '2019-11-26 03:07:04'),
(28, 8, 3, 'Status', 'productSetup.status', 28, 1, '2019-11-26 03:10:00', '2019-11-26 03:10:00');

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
(1, 'Super Admin', 1, '1,2,3,4,5,6,7,8', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,20,18,19,17,21,22,23,24,25,26,27,28', '2019-11-21 04:48:03', '2019-11-26 03:11:01'),
(2, 'Admin', 0, NULL, NULL, '2019-11-24 01:10:16', '2019-11-24 01:10:16');

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
-- Indexes for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_showroom`
--
ALTER TABLE `tbl_showroom`
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
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_categories`
--
ALTER TABLE `tbl_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_showroom`
--
ALTER TABLE `tbl_showroom`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menus`
--
ALTER TABLE `user_menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_menu_actions`
--
ALTER TABLE `user_menu_actions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
