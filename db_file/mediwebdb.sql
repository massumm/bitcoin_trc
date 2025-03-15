-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2023 at 05:44 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediwebdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(9, '2014_10_12_100000_create_password_resets_table', 2),
(10, '2019_08_19_000000_create_failed_jobs_table', 2),
(11, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(12, '2023_03_29_100951_create_add_medicine_table', 2),
(13, '2023_04_03_061840_create_medicine_list_table', 2),
(14, '2023_04_04_160019_create_tbl_code_table', 2),
(15, '2023_04_05_093500_create_add_c_code_table', 2),
(16, '2023_04_06_104931_drop_users_table', 2),
(17, '2023_04_06_105009_create_tbl_admins_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(554, 'App\\Models\\UserModel', 25, 'XorMediShopLogin', 'b3bfc37e200b6e152adec784c741657f4cd1fb3c72857ea5a4262569890f729c', '[\"*\"]', NULL, '2023-06-25 14:04:14', '2023-06-25 14:04:14'),
(555, 'App\\Models\\UserModel', 25, 'XorMediShopLogin', '35cd7dc71a74f5162273c9afc7d1e31adfc724882721b667d027351316c5d099', '[\"*\"]', NULL, '2023-06-25 14:07:08', '2023-06-25 14:07:08'),
(556, 'App\\Models\\UserModel', 25, 'XorMediShopLogin', '5173ac9b40f9a988d9a1de985a6b646aeefa847d6d5baf412e1fe35eabd4422a', '[\"*\"]', NULL, '2023-06-25 14:12:08', '2023-06-25 14:12:08'),
(559, 'App\\Models\\UserModel', 25, 'XorMediShopLogin', '4b6b573526983738d79f96a1e457f1c6a9e23201011777349237bebfe9c20965', '[\"*\"]', NULL, '2023-06-25 14:37:50', '2023-06-25 14:37:50'),
(560, 'App\\Models\\UserModel', 75, 'XorMediShopLogin', '8f6a4271f7c099ca71d303bc84e4582ca23a605fe1c045efb0b37d1958c345d2', '[\"*\"]', '2023-06-26 04:14:17', '2023-06-26 04:12:24', '2023-06-26 04:14:17'),
(561, 'App\\Models\\UserModel', 76, 'XorMediShopReg', 'b8435de31b9d5c9613ebe90c10c67d9a1742e525e9e122214b825896161b5ab6', '[\"*\"]', '2023-06-26 06:01:59', '2023-06-26 04:27:11', '2023-06-26 06:01:59'),
(569, 'App\\Models\\UserModel', 25, 'XorMediShopLogin', '240f3b89990caa4b325b1c2d8a7209a769011a77f13a811ea50110d660bb982e', '[\"*\"]', NULL, '2023-06-26 08:05:35', '2023-06-26 08:05:35'),
(571, 'App\\Models\\UserModel', 25, 'XorMediShopLogin', '8cef105edd304a060458dd3aa3871d78a5569813f0ab954a81d29646f6fdbe64', '[\"*\"]', '2023-06-26 10:43:40', '2023-06-26 08:40:45', '2023-06-26 10:43:40'),
(578, 'App\\Models\\UserModel', 48, 'XorMediShopLogin', '731bf72cda1278d01a89c74192fa437d3834f4ff73ae0fd17855d927d473636c', '[\"*\"]', '2023-06-26 13:09:06', '2023-06-26 10:46:15', '2023-06-26 13:09:06'),
(579, 'App\\Models\\UserModel', 76, 'XorMediShopLogin', '50eb16b94bbff26a5a20f45ca5457b8a87cafd4ccb574d796c1eb7447af6d02b', '[\"*\"]', NULL, '2023-06-26 10:57:16', '2023-06-26 10:57:16'),
(580, 'App\\Models\\UserModel', 25, 'XorMediShopLogin', 'cc1c7e5f207772ad6a452c7aeacb09743dce743be49d88d08c3124ab34da4793', '[\"*\"]', '2023-06-26 11:42:12', '2023-06-26 10:57:24', '2023-06-26 11:42:12'),
(585, 'App\\Models\\UserModel', 25, 'XorMediShopLogin', 'd43bb9f9aa42a1d0967553eb7b89c7f647fcc838a4f818d82da5b5be4a703fad', '[\"*\"]', '2023-06-26 15:23:25', '2023-06-26 13:42:21', '2023-06-26 15:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

CREATE TABLE `tbl_admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'akash', 'ak@gmail.com', NULL, '$2y$10$PsGOXOGPbufFmwZQtqxVfu6xGjOmk1zJ3YfUN4qXjbTcFz62B1m0.', NULL, '2023-04-06 05:04:35', '2023-04-06 05:04:35'),
(3, 'masum object', 'object.masum@gmail.com', NULL, '$2y$10$PsGOXOGPbufFmwZQtqxVfu6xGjOmk1zJ3YfUN4qXjbTcFz62B1m0.', NULL, '2023-04-06 05:26:48', '2023-04-06 05:26:48'),
(10, 'masum', 'masum@gmail.com', NULL, '$2y$10$5769at4qXNpbdc5jS8XdUeX378Ouz8H5pqYMTIKKi1RCphVDSxcGO', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_basic_setting`
--

CREATE TABLE `tbl_basic_setting` (
  `id` int(11) NOT NULL,
  `d_title` varchar(255) DEFAULT NULL,
  `tax` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `push_id` varchar(255) DEFAULT NULL,
  `insurance_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_basic_setting`
--

INSERT INTO `tbl_basic_setting` (`id`, `d_title`, `tax`, `currency`, `push_id`, `insurance_status`, `created_at`, `updated_at`, `created_by`) VALUES
(9, 'Medishop', '5', '¥', NULL, 1, '2023-05-24 04:18:05', '2023-05-24 06:23:44', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_code`
--

CREATE TABLE `tbl_code` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `c_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_country_code`
--

CREATE TABLE `tbl_country_code` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `c_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_country_code`
--

INSERT INTO `tbl_country_code` (`id`, `c_code`, `status`, `created_at`, `updated_at`) VALUES
(2, '+881', 0, '2023-04-10 03:40:42', '2023-05-08 11:33:21'),
(3, '+882', 1, '2023-04-10 03:42:22', '2023-05-08 11:33:25'),
(4, '+883', 1, '2023-04-26 10:50:58', '2023-05-08 11:33:29'),
(5, '+880', 1, '2023-04-26 10:51:09', '2023-04-26 10:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notification`
--

CREATE TABLE `tbl_notification` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notification`
--

INSERT INTO `tbl_notification` (`id`, `uid`, `date`, `title`, `description`, `created_at`, `updated_at`) VALUES
(12, 15, '2023-04-17 09:19:10', 'Order Recieved', 'masum5, your prescription order has been Recieved', '2023-04-17 09:19:10', '2023-04-17 09:19:10'),
(13, 15, '2023-04-17 09:25:13', 'Prescription Order Confirmed', 'masum5, your prescription order #18 has been confirmed', '2023-04-17 09:25:13', '2023-04-17 09:25:13'),
(14, 15, '2023-04-17 09:29:53', 'Prescription Order Rejected', 'masum5, your prescription order #17 has been rejected', '2023-04-17 09:29:53', '2023-04-17 09:29:53'),
(15, 15, '2023-04-17 09:32:15', 'Prescription Order Confirmed', 'masum5, your prescription order #16 has been confirmed', '2023-04-17 09:32:15', '2023-04-17 09:32:15'),
(16, 2, '2023-04-17 09:46:34', 'Prescription Order Confirmed', 'akash, your prescription order #13 has been confirmed', '2023-04-17 09:46:34', '2023-04-17 09:46:34'),
(17, 15, '2023-04-17 09:51:39', 'Prescription Order Confirmed', 'masum5, your prescription order #18 has been confirmed', '2023-04-17 09:51:39', '2023-04-17 09:51:39'),
(18, 2, '2023-04-17 09:52:00', 'Prescription Order Rejected', 'akash, your prescription order #12 has been rejected', '2023-04-17 09:52:00', '2023-04-17 09:52:00'),
(19, 2, '2023-04-17 10:00:03', 'Prescription Order is in cart', 'akash, your prescription order #13 has been added in cart', '2023-04-17 10:00:03', '2023-04-17 10:00:03'),
(20, 15, '2023-04-17 10:39:13', 'Order Recieved', 'masum5, your prescription order  #19has been Recieved', '2023-04-17 10:39:13', '2023-04-17 10:39:13'),
(21, 10, '2023-04-17 10:39:34', 'Order Recieved', 'akash, your prescription order  #20has been Recieved', '2023-04-17 10:39:34', '2023-04-17 10:39:34'),
(22, 10, '2023-04-17 10:40:16', 'Prescription Order Confirmed', 'akash, your prescription order #20 has been confirmed', '2023-04-17 10:40:16', '2023-04-17 10:40:16'),
(23, 10, '2023-04-17 10:40:46', 'Prescription Order is in cart', 'akash, your prescription order #20 has been added in cart', '2023-04-17 10:40:46', '2023-04-17 10:40:46'),
(24, 16, '2023-04-17 11:10:22', 'Order Recieved', 'rakib, your prescription order  #21has been Recieved', '2023-04-17 11:10:22', '2023-04-17 11:10:22'),
(25, 16, '2023-04-17 11:10:47', 'Prescription Order Confirmed!!', 'rakib, your prescription order #21 has been confirmed', '2023-04-17 11:10:47', '2023-04-17 11:10:47'),
(26, 16, '2023-04-17 11:11:22', 'Prescription Order Cart Ready!!', 'rakib, your prescription order #21 Cart Ready.', '2023-04-17 11:11:22', '2023-04-17 11:11:22'),
(27, 16, '2023-04-18 03:54:58', 'Order Recieved', 'rakib, your prescription order  #22has been Recieved', '2023-04-18 03:54:58', '2023-04-18 03:54:58'),
(28, 15, '2023-04-18 05:34:35', 'Prescription Order Rejected', 'masum5, your prescription order #17 has been rejected', '2023-04-18 05:34:35', '2023-04-18 05:34:35'),
(29, 16, '2023-04-18 05:38:31', 'Prescription Order Rejected', 'rakib, your prescription order #22 has been rejected', '2023-04-18 05:38:31', '2023-04-18 05:38:31'),
(30, 10, '2023-04-18 07:29:06', 'Order Recieved', 'akash, your prescription order  #14has been Recieved', '2023-04-18 07:29:06', '2023-04-18 07:29:06'),
(31, 10, '2023-04-26 04:22:24', 'Order Recieved', 'akash, your prescription order  #15has been Recieved', '2023-04-26 04:22:24', '2023-04-26 04:22:24'),
(32, 12, '2023-04-26 10:18:18', 'Prescription Order Confirmed!!', 'akash, your prescription order #13 has been confirmed', '2023-04-26 10:18:18', '2023-04-26 10:18:18'),
(33, 12, '2023-04-26 11:08:19', 'Prescription Order Confirmed!!', 'akash, your prescription order #12 has been confirmed', '2023-04-26 11:08:19', '2023-04-26 11:08:19'),
(34, 2, '2023-04-26 12:37:02', 'Prescription Order Confirmed!!', 'Md. Mainuddin, your prescription order #9 has been confirmed', '2023-04-26 12:37:02', '2023-04-26 12:37:02'),
(35, 12, '2023-04-26 12:48:42', 'Prescription Order Rejected', 'akash, your prescription order #10 has been rejected', '2023-04-26 12:48:42', '2023-04-26 12:48:42'),
(36, 23, '2023-05-10 12:32:21', 'Order Recieved', 'Masum, your prescription order  #16has been Recieved', '2023-05-10 12:32:21', '2023-05-10 12:32:21'),
(37, 12, '2023-05-11 07:59:58', 'Order Recieved', 'akash, your prescription order  #17has been Recieved', '2023-05-11 07:59:58', '2023-05-11 07:59:58'),
(38, 12, '2023-05-11 08:09:22', 'Order Recieved', 'akash, your prescription order  #18has been Recieved', '2023-05-11 08:09:22', '2023-05-11 08:09:22'),
(39, 12, '2023-05-11 08:10:07', 'Order Recieved', 'akash, your prescription order  #19has been Recieved', '2023-05-11 08:10:07', '2023-05-11 08:10:07'),
(40, 12, '2023-05-11 08:12:40', 'Order Recieved', 'akash, your prescription order  #20has been Recieved', '2023-05-11 08:12:40', '2023-05-11 08:12:40'),
(41, 12, '2023-05-11 08:13:32', 'Order Recieved', 'akash, your prescription order  #21has been Recieved', '2023-05-11 08:13:32', '2023-05-11 08:13:32'),
(42, 23, '2023-05-11 08:48:58', 'Prescription Order Rejected', 'Masum, your prescription order #16 has been rejected', '2023-05-11 08:48:58', '2023-05-11 08:48:58'),
(43, 12, '2023-05-11 08:49:02', 'Prescription Order Rejected', 'akash, your prescription order #17 has been rejected', '2023-05-11 08:49:02', '2023-05-11 08:49:02'),
(44, 12, '2023-05-11 08:49:05', 'Prescription Order Rejected', 'akash, your prescription order #19 has been rejected', '2023-05-11 08:49:05', '2023-05-11 08:49:05'),
(45, 12, '2023-05-11 08:49:08', 'Prescription Order Rejected', 'akash, your prescription order #20 has been rejected', '2023-05-11 08:49:08', '2023-05-11 08:49:08'),
(46, 12, '2023-05-11 08:49:13', 'Prescription Order Rejected', 'akash, your prescription order #21 has been rejected', '2023-05-11 08:49:13', '2023-05-11 08:49:13'),
(47, 12, '2023-05-11 08:49:17', 'Prescription Order Rejected', 'akash, your prescription order #18 has been rejected', '2023-05-11 08:49:17', '2023-05-11 08:49:17'),
(48, 25, '2023-05-11 08:54:47', 'Order Recieved', 'আমি, your prescription order  #22has been Recieved', '2023-05-11 08:54:47', '2023-05-11 08:54:47'),
(49, 25, '2023-05-11 08:56:19', 'Prescription Order Confirmed!!', 'আমি, your prescription order #22 has been confirmed', '2023-05-11 08:56:19', '2023-05-11 08:56:19'),
(50, 25, '2023-05-11 09:09:21', 'Order Recieved', 'আমি, your prescription order  #23has been Recieved', '2023-05-11 09:09:21', '2023-05-11 09:09:21'),
(51, 25, '2023-05-11 09:10:07', 'Prescription Order Confirmed!!', 'আমি, your prescription order #23 has been confirmed', '2023-05-11 09:10:07', '2023-05-11 09:10:07'),
(52, 25, '2023-05-11 10:52:25', 'Order Recieved', 'আমি, your prescription order  #24has been Recieved', '2023-05-11 10:52:25', '2023-05-11 10:52:25'),
(53, 25, '2023-05-11 13:00:14', 'Prescription Order Confirmed!!', 'আমি, your prescription order #24 has been confirmed', '2023-05-11 13:00:14', '2023-05-11 13:00:14'),
(54, 25, '2023-05-11 13:17:35', 'Order Recieved', 'আমি, your prescription order  #25has been Recieved', '2023-05-11 13:17:35', '2023-05-11 13:17:35'),
(55, 25, '2023-05-11 13:18:00', 'Prescription Order Confirmed!!', 'আমি, your prescription order #25 has been confirmed', '2023-05-11 13:18:00', '2023-05-11 13:18:00'),
(56, 25, '2023-05-11 14:13:48', 'Order Recieved', 'আমি, your prescription order  #26has been Recieved', '2023-05-11 14:13:48', '2023-05-11 14:13:48'),
(57, 25, '2023-05-11 14:14:00', 'Prescription Order Rejected', 'আমি, your prescription order #26 has been rejected', '2023-05-11 14:14:00', '2023-05-11 14:14:00'),
(58, 25, '2023-05-15 09:27:28', 'Order Recieved', 'আমি, your prescription order  #27has been Recieved', '2023-05-15 09:27:28', '2023-05-15 09:27:28'),
(59, 25, '2023-05-15 09:30:40', 'Prescription Order Confirmed!!', 'আমি, your prescription order #27 has been confirmed', '2023-05-15 09:30:40', '2023-05-15 09:30:40'),
(60, 25, '2023-05-15 10:41:46', 'Order Recieved', 'আমি, your prescription order  #28has been Recieved', '2023-05-15 10:41:46', '2023-05-15 10:41:46'),
(61, 25, '2023-05-15 10:41:52', 'Prescription Order Confirmed!!', 'আমি, your prescription order #28 has been confirmed', '2023-05-15 10:41:52', '2023-05-15 10:41:52'),
(62, 25, '2023-05-15 11:48:22', 'Order Recieved', 'আমি, your prescription order  #29has been Recieved', '2023-05-15 11:48:22', '2023-05-15 11:48:22'),
(63, 25, '2023-05-15 11:48:27', 'Prescription Order Confirmed!!', 'আমি, your prescription order #29 has been confirmed', '2023-05-15 11:48:27', '2023-05-15 11:48:27'),
(64, 25, '2023-05-15 11:52:40', 'Order Recieved', 'আমি, your prescription order  #30has been Recieved', '2023-05-15 11:52:40', '2023-05-15 11:52:40'),
(65, 25, '2023-05-15 11:52:45', 'Prescription Order Confirmed!!', 'আমি, your prescription order #30 has been confirmed', '2023-05-15 11:52:45', '2023-05-15 11:52:45'),
(66, 25, '2023-05-15 12:41:46', 'Order Recieved', 'আমি, your prescription order  #31has been Recieved', '2023-05-15 12:41:46', '2023-05-15 12:41:46'),
(67, 25, '2023-05-15 12:41:50', 'Prescription Order Confirmed!!', 'আমি, your prescription order #31 has been confirmed', '2023-05-15 12:41:50', '2023-05-15 12:41:50'),
(68, 25, '2023-05-16 05:02:07', 'Order Recieved', 'আমি, your prescription order  #32has been Recieved', '2023-05-16 05:02:07', '2023-05-16 05:02:07'),
(69, 25, '2023-05-16 06:44:55', 'Order Recieved', 'আমি, your prescription order  #1has been Recieved', '2023-05-16 06:44:55', '2023-05-16 06:44:55'),
(70, 25, '2023-05-16 06:47:05', 'Order Recieved', 'আমি, your prescription order  #2has been Recieved', '2023-05-16 06:47:05', '2023-05-16 06:47:05'),
(71, 25, '2023-05-16 07:06:41', 'Prescription Order Rejected', 'আমি, your prescription order #1 has been rejected', '2023-05-16 07:06:41', '2023-05-16 07:06:41'),
(72, 25, '2023-05-16 07:11:49', 'Order Recieved', 'আমি, your prescription order  #3has been Recieved', '2023-05-16 07:11:49', '2023-05-16 07:11:49'),
(73, 25, '2023-05-16 07:11:57', 'Order Recieved', 'আমি, your prescription order  #4has been Recieved', '2023-05-16 07:11:57', '2023-05-16 07:11:57'),
(74, 25, '2023-05-16 07:12:46', 'Prescription Order Rejected', 'আমি, your prescription order #3 has been rejected', '2023-05-16 07:12:46', '2023-05-16 07:12:46'),
(75, 25, '2023-05-16 07:13:09', 'Order Recieved', 'আমি, your prescription order  #5has been Recieved', '2023-05-16 07:13:09', '2023-05-16 07:13:09'),
(76, 25, '2023-05-16 07:13:49', 'Prescription Order Confirmed!!', 'আমি, your prescription order #5 has been confirmed', '2023-05-16 07:13:49', '2023-05-16 07:13:49'),
(77, 25, '2023-05-16 07:41:34', 'Order Recieved', 'আমি, your prescription order  #6has been Recieved', '2023-05-16 07:41:34', '2023-05-16 07:41:34'),
(78, 25, '2023-05-16 07:41:55', 'Prescription Order Confirmed!!', 'আমি, your prescription order #6 has been confirmed', '2023-05-16 07:41:55', '2023-05-16 07:41:55'),
(79, 25, '2023-05-24 06:55:04', 'Order Recieved', 'আমি, your prescription order  #7has been Recieved', '2023-05-24 06:55:04', '2023-05-24 06:55:04'),
(80, 25, '2023-05-24 06:57:16', 'Prescription Order Confirmed!!', 'আমি, your prescription order #7 has been confirmed', '2023-05-24 06:57:16', '2023-05-24 06:57:16'),
(81, 25, '2023-05-24 10:58:44', 'Order Recieved', 'আমিআকাশ, your prescription order  #8 has been Recieved', '2023-05-24 10:58:44', '2023-05-24 10:58:44'),
(82, 25, '2023-05-24 11:00:17', 'Order Recieved', 'আমি, your prescription order #9 has been Recieved', '2023-05-24 11:00:17', '2023-05-24 11:00:17'),
(83, 25, '2023-05-24 11:22:05', 'Prescription Order Confirmed!!', 'আমি, your prescription order #8 has been confirmed', '2023-05-24 11:22:05', '2023-05-24 11:22:05'),
(84, 25, '2023-05-24 11:22:28', 'Prescription Order Rejected', 'আমি, your prescription order #4 has been rejected', '2023-05-24 11:22:28', '2023-05-24 11:22:28'),
(85, 25, '2023-05-24 11:27:55', 'Order Recieved', 'Moin, your prescription order #10 has been Recieved.', '2023-05-24 11:27:55', '2023-05-24 11:27:55'),
(86, 25, '2023-05-24 11:39:11', 'Prescription Order Cart Ready', 'Moin, your prescription order #8 Cart Ready.', '2023-05-24 11:39:11', '2023-05-24 11:39:11'),
(87, 25, '2023-05-24 11:44:31', 'Prescription Order Approved', 'Moin, your prescription order #10 has been approved.', '2023-05-24 11:44:31', '2023-05-24 11:44:31'),
(88, 25, '2023-06-08 05:29:42', 'Order Recieved', 'Moin, your prescription order #11 has been Recieved.', '2023-06-08 05:29:42', '2023-06-08 05:29:42'),
(89, 25, '2023-06-08 05:30:50', 'Prescription Order Approved', 'Moin, your prescription order #11 has been approved.', '2023-06-08 05:30:50', '2023-06-08 05:30:50'),
(90, 27, '2023-06-08 06:35:11', 'Order Recieved', 'ahad, your prescription order #12 has been Recieved.', '2023-06-08 06:35:11', '2023-06-08 06:35:11'),
(91, 27, '2023-06-08 06:38:10', 'Order Recieved', 'ahad, your prescription order #13 has been Recieved.', '2023-06-08 06:38:10', '2023-06-08 06:38:10'),
(92, 27, '2023-06-08 06:52:11', 'Order Recieved', 'ahad, your prescription order #14 has been Recieved.', '2023-06-08 06:52:11', '2023-06-08 06:52:11'),
(93, 27, '2023-06-08 06:53:35', 'Order Recieved', 'ahad, your prescription order #15 has been Recieved.', '2023-06-08 06:53:35', '2023-06-08 06:53:35'),
(94, 27, '2023-06-08 06:54:13', 'Order Recieved', 'ahad, your prescription order #16 has been Recieved.', '2023-06-08 06:54:13', '2023-06-08 06:54:13'),
(95, 27, '2023-06-08 06:56:18', 'Order Recieved', 'ahad, your prescription order #17 has been Recieved.', '2023-06-08 06:56:18', '2023-06-08 06:56:18'),
(96, 27, '2023-06-08 06:59:52', 'Order Recieved', 'ahad, your prescription order #18 has been Recieved.', '2023-06-08 06:59:52', '2023-06-08 06:59:52'),
(97, 25, '2023-06-08 07:54:04', 'Order Recieved', 'Moin, your prescription order #19 has been Recieved.', '2023-06-08 07:54:04', '2023-06-08 07:54:04'),
(98, 27, '2023-06-08 08:11:27', 'Order Recieved', 'ahad, your prescription order #20 has been Recieved.', '2023-06-08 08:11:27', '2023-06-08 08:11:27'),
(99, 27, '2023-06-08 08:12:07', 'Order Recieved', 'ahad, your prescription order #21 has been Recieved.', '2023-06-08 08:12:07', '2023-06-08 08:12:07'),
(100, 27, '2023-06-08 09:11:29', 'Order Recieved', 'ahad, your prescription order #22 has been Recieved.', '2023-06-08 09:11:29', '2023-06-08 09:11:29'),
(101, 27, '2023-06-08 09:12:01', 'Order Recieved', 'ahad, your prescription order #23 has been Recieved.', '2023-06-08 09:12:01', '2023-06-08 09:12:01'),
(102, 27, '2023-06-08 09:24:54', 'Order Recieved', 'ahad, your prescription order #24 has been Recieved.', '2023-06-08 09:24:54', '2023-06-08 09:24:54'),
(103, 25, '2023-06-08 10:13:22', 'Order Recieved', 'Moin, your prescription order #25 has been Recieved.', '2023-06-08 10:13:22', '2023-06-08 10:13:22'),
(104, 25, '2023-06-08 11:27:34', 'Prescription Order Approved', 'Moin, your prescription order #25 has been approved.', '2023-06-08 11:27:34', '2023-06-08 11:27:34'),
(105, 25, '2023-06-08 11:35:54', 'Prescription Order Cart Ready', 'Moin, your prescription order #25 Cart Ready.', '2023-06-08 11:35:54', '2023-06-08 11:35:54'),
(106, 25, '2023-06-08 11:53:05', 'Order Recieved', 'Moin, your prescription order #26 has been Recieved.', '2023-06-08 11:53:05', '2023-06-08 11:53:05'),
(107, 25, '2023-06-08 11:53:42', 'Prescription Order Approved', 'Moin, your prescription order #26 has been approved.', '2023-06-08 11:53:42', '2023-06-08 11:53:42'),
(108, 25, '2023-06-08 11:58:05', 'Prescription Order Cart Ready', 'Moin, your prescription order #26 Cart Ready.', '2023-06-08 11:58:05', '2023-06-08 11:58:05'),
(109, 25, '2023-06-08 12:01:29', 'Order Recieved', 'Moin, your prescription order #27 has been Recieved.', '2023-06-08 12:01:29', '2023-06-08 12:01:29'),
(110, 25, '2023-06-08 12:01:49', 'Prescription Order Approved', 'Moin, your prescription order #27 has been approved.', '2023-06-08 12:01:49', '2023-06-08 12:01:49'),
(111, 27, '2023-06-13 07:36:33', 'Prescription Order Approved', 'ahad, your prescription order #24 has been approved.', '2023-06-13 07:36:33', '2023-06-13 07:36:33'),
(112, 25, '2023-06-14 12:24:06', 'Order Recieved', 'Moin, your prescription order #28 has been Recieved.', '2023-06-14 12:24:06', '2023-06-14 12:24:06'),
(113, 25, '2023-06-14 12:24:27', 'Prescription Order Approved', 'Moin, your prescription order #28 has been approved.', '2023-06-14 12:24:27', '2023-06-14 12:24:27'),
(114, 25, '2023-06-15 12:45:22', 'Order Recieved', 'Mr Moin, your prescription order #29 has been Recieved.', '2023-06-15 12:45:22', '2023-06-15 12:45:22'),
(115, 25, '2023-06-15 12:46:11', 'Prescription Order Approved', 'Mr Moin, your prescription order #29 has been approved.', '2023-06-15 12:46:11', '2023-06-15 12:46:11'),
(116, 25, '2023-06-18 07:27:59', 'Order Recieved', 'Mr Moin, your prescription order #30 has been Recieved.', '2023-06-18 07:27:59', '2023-06-18 07:27:59'),
(117, 25, '2023-06-18 07:28:55', 'Order Recieved', 'Mr Moin, your prescription order #31 has been Recieved.', '2023-06-18 07:28:55', '2023-06-18 07:28:55'),
(118, 25, '2023-06-18 07:31:12', 'Prescription Order Approved', 'Mr Moin, your prescription order #31 has been approved.', '2023-06-18 07:31:12', '2023-06-18 07:31:12'),
(119, 25, '2023-06-18 07:33:31', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #31 Cart Ready.', '2023-06-18 07:33:31', '2023-06-18 07:33:31'),
(120, 27, '2023-06-19 10:13:49', 'Order Recieved', 'ahadul islam, your prescription order #32 has been Recieved.', '2023-06-19 10:13:49', '2023-06-19 10:13:49'),
(121, 27, '2023-06-19 10:14:28', 'Order Recieved', 'ahadul islam, your prescription order #33 has been Recieved.', '2023-06-19 10:14:28', '2023-06-19 10:14:28'),
(122, 27, '2023-06-20 04:43:56', 'Order Recieved', 'ahadul islam, your prescription order #34 has been Recieved.', '2023-06-20 04:43:56', '2023-06-20 04:43:56'),
(123, 27, '2023-06-20 04:46:08', 'Order Recieved', 'ahadul islam, your prescription order #35 has been Recieved.', '2023-06-20 04:46:08', '2023-06-20 04:46:08'),
(124, 25, '2023-06-20 05:08:55', 'Order Recieved', 'Mr Moin, your prescription order #36 has been Recieved.', '2023-06-20 05:08:55', '2023-06-20 05:08:55'),
(125, 27, '2023-06-20 06:01:47', 'Prescription Order Approved', 'ahadul islam, your prescription order #32 has been approved.', '2023-06-20 06:01:47', '2023-06-20 06:01:47'),
(126, 27, '2023-06-20 06:08:28', 'Prescription Order Approved', 'ahadul islam, your prescription order #33 has been approved.', '2023-06-20 06:08:28', '2023-06-20 06:08:28'),
(127, 27, '2023-06-20 06:10:21', 'Prescription Order Cart Ready', 'ahadul islam, your prescription order #33 Cart Ready.', '2023-06-20 06:10:21', '2023-06-20 06:10:21'),
(128, 25, '2023-06-20 10:06:13', 'Order Recieved', 'Mr Moin, your prescription order #37 has been Recieved.', '2023-06-20 10:06:13', '2023-06-20 10:06:13'),
(129, 31, '2023-06-20 11:18:41', 'Order Recieved', 'ahad, your prescription order #38 has been Recieved.', '2023-06-20 11:18:41', '2023-06-20 11:18:41'),
(130, 31, '2023-06-20 11:22:44', 'Order Recieved', 'ahad, your prescription order #39 has been Recieved.', '2023-06-20 11:22:44', '2023-06-20 11:22:44'),
(131, 37, '2023-06-21 05:36:40', 'Order Recieved', 'ahadulislam, your prescription order #40 has been Recieved.', '2023-06-21 05:36:40', '2023-06-21 05:36:40'),
(132, 25, '2023-06-22 09:38:02', 'Prescription Order Approved', 'Mr Moin, your prescription order #30 has been approved.', '2023-06-22 09:38:02', '2023-06-22 09:38:02'),
(133, 31, '2023-06-22 13:19:19', 'Prescription Order Approved', 'ahad, your prescription order #38 has been approved.', '2023-06-22 13:19:19', '2023-06-22 13:19:19'),
(134, 25, '2023-06-25 04:02:02', 'Order Recieved', 'Mr Moin, your prescription order #41 has been Recieved.', '2023-06-25 04:02:02', '2023-06-25 04:02:02'),
(135, 25, '2023-06-25 09:43:43', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-25 09:43:43', '2023-06-25 09:43:43'),
(136, 25, '2023-06-25 09:44:01', 'Prescription Order Rejected', 'Mr Moin, your prescription order #37 has been rejected.', '2023-06-25 09:44:01', '2023-06-25 09:44:01'),
(137, 25, '2023-06-25 10:05:38', 'Prescription Order Rejected', 'Mr Moin, your prescription order #36 has been rejected.', '2023-06-25 10:05:38', '2023-06-25 10:05:38'),
(138, 25, '2023-06-25 10:42:52', 'Prescription Order Rejected', 'Mr Moin, your prescription order #30 has been rejected.', '2023-06-25 10:42:52', '2023-06-25 10:42:52'),
(139, 25, '2023-06-25 10:50:38', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-25 10:50:38', '2023-06-25 10:50:38'),
(140, 25, '2023-06-25 13:27:53', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-25 13:27:53', '2023-06-25 13:27:53'),
(141, 25, '2023-06-25 14:32:40', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-25 14:32:40', '2023-06-25 14:32:40'),
(142, 75, '2023-06-25 14:36:25', 'Order Recieved', 'hacktest, your prescription order #42 has been Recieved.', '2023-06-25 14:36:25', '2023-06-25 14:36:25'),
(143, 75, '2023-06-25 14:36:49', 'Prescription Order Rejected', 'hacktest, your prescription order #42 has been rejected.', '2023-06-25 14:36:49', '2023-06-25 14:36:49'),
(144, 25, '2023-06-25 14:38:05', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-25 14:38:05', '2023-06-25 14:38:05'),
(145, 25, '2023-06-26 04:14:00', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 04:14:00', '2023-06-26 04:14:00'),
(146, 75, '2023-06-26 04:14:26', 'Prescription Order Rejected', 'hacktest, your prescription order #42 has been rejected.', '2023-06-26 04:14:26', '2023-06-26 04:14:26'),
(147, 25, '2023-06-26 04:21:15', 'Order Recieved', 'Mr Moin, your prescription order #43 has been Recieved.', '2023-06-26 04:21:15', '2023-06-26 04:21:15'),
(148, 25, '2023-06-26 04:21:23', 'Prescription Order Approved', 'Mr Moin, your prescription order #43 has been approved.', '2023-06-26 04:21:23', '2023-06-26 04:21:23'),
(149, 25, '2023-06-26 06:25:49', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 06:25:49', '2023-06-26 06:25:49'),
(150, 25, '2023-06-26 06:26:42', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 06:26:42', '2023-06-26 06:26:42'),
(151, 25, '2023-06-26 06:40:42', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 06:40:42', '2023-06-26 06:40:42'),
(152, 25, '2023-06-26 07:08:20', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 07:08:20', '2023-06-26 07:08:20'),
(153, 25, '2023-06-26 07:22:25', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 07:22:25', '2023-06-26 07:22:25'),
(154, 25, '2023-06-26 07:25:56', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 07:25:56', '2023-06-26 07:25:56'),
(155, 25, '2023-06-26 07:26:42', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 07:26:42', '2023-06-26 07:26:42'),
(156, 25, '2023-06-26 07:42:14', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 07:42:14', '2023-06-26 07:42:14'),
(157, 25, '2023-06-26 08:12:35', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 08:12:35', '2023-06-26 08:12:35'),
(158, 25, '2023-06-26 08:52:21', 'Prescription Order Rejected', 'Mr Moin, your prescription order #41 has been rejected.', '2023-06-26 08:52:21', '2023-06-26 08:52:21'),
(159, 25, '2023-06-26 09:00:14', 'Order Recieved', 'Mr Moin, your prescription order #44 has been Recieved.', '2023-06-26 09:00:14', '2023-06-26 09:00:14'),
(160, 25, '2023-06-26 09:01:03', 'Order Recieved', 'Mr Moin, your prescription order #45 has been Recieved.', '2023-06-26 09:01:03', '2023-06-26 09:01:03'),
(161, 25, '2023-06-26 09:01:19', 'Order Recieved', 'Mr Moin, your prescription order #46 has been Recieved.', '2023-06-26 09:01:19', '2023-06-26 09:01:19'),
(162, 25, '2023-06-26 09:01:42', 'Order Recieved', 'Mr Moin, your prescription order #47 has been Recieved.', '2023-06-26 09:01:42', '2023-06-26 09:01:42'),
(163, 25, '2023-06-26 09:06:16', 'Order Recieved', 'Mr Moin, your prescription order #48 has been Recieved.', '2023-06-26 09:06:16', '2023-06-26 09:06:16'),
(164, 25, '2023-06-26 09:08:35', 'Prescription Order Approved', 'Mr Moin, your prescription order #47 has been approved.', '2023-06-26 09:08:35', '2023-06-26 09:08:35'),
(165, 25, '2023-06-26 09:10:55', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #47 Cart Ready.', '2023-06-26 09:10:55', '2023-06-26 09:10:55'),
(166, 25, '2023-06-26 10:50:51', 'Order Recieved', 'Mr Moin, your prescription order #49 has been Recieved.', '2023-06-26 10:50:51', '2023-06-26 10:50:51'),
(167, 25, '2023-06-26 10:51:11', 'Prescription Order Approved', 'Mr Moin, your prescription order #49 has been approved.', '2023-06-26 10:51:11', '2023-06-26 10:51:11'),
(168, 25, '2023-06-26 10:54:01', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #49 Cart Ready.', '2023-06-26 10:54:01', '2023-06-26 10:54:01'),
(169, 25, '2023-06-26 11:01:42', 'Order Recieved', 'Mr Moin, your prescription order #50 has been Recieved.', '2023-06-26 11:01:42', '2023-06-26 11:01:42'),
(170, 25, '2023-06-26 11:01:57', 'Prescription Order Approved', 'Mr Moin, your prescription order #50 has been approved.', '2023-06-26 11:01:57', '2023-06-26 11:01:57'),
(171, 25, '2023-06-26 11:03:21', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #50 Cart Ready.', '2023-06-26 11:03:21', '2023-06-26 11:03:21'),
(172, 25, '2023-06-26 11:05:39', 'Order Recieved', 'Mr Moin, your prescription order #51 has been Recieved.', '2023-06-26 11:05:39', '2023-06-26 11:05:39'),
(173, 25, '2023-06-26 11:05:44', 'Prescription Order Approved', 'Mr Moin, your prescription order #51 has been approved.', '2023-06-26 11:05:44', '2023-06-26 11:05:44'),
(174, 25, '2023-06-26 11:31:23', 'Order Recieved', 'Mr Moin, your prescription order #52 has been Recieved.', '2023-06-26 11:31:23', '2023-06-26 11:31:23'),
(175, 25, '2023-06-26 11:31:29', 'Prescription Order Approved', 'Mr Moin, your prescription order #52 has been approved.', '2023-06-26 11:31:29', '2023-06-26 11:31:29'),
(176, 77, '2023-06-26 12:36:09', 'Order Recieved', 'hacktest, your prescription order #53 has been Recieved.', '2023-06-26 12:36:09', '2023-06-26 12:36:09'),
(177, 77, '2023-06-26 12:36:24', 'Prescription Order Approved', 'hacktest, your prescription order #53 has been approved.', '2023-06-26 12:36:24', '2023-06-26 12:36:24'),
(178, 77, '2023-06-26 12:37:32', 'Prescription Order Cart Ready', 'hacktest, your prescription order #53 Cart Ready.', '2023-06-26 12:37:32', '2023-06-26 12:37:32'),
(179, 25, '2023-06-26 13:45:12', 'Order Recieved', 'Mr Moin, your prescription order #54 has been Recieved.', '2023-06-26 13:45:12', '2023-06-26 13:45:12'),
(180, 25, '2023-06-26 13:59:34', 'Order Recieved', 'Mr Moin, your prescription order #55 has been Recieved.', '2023-06-26 13:59:34', '2023-06-26 13:59:34'),
(181, 25, '2023-06-26 14:00:39', 'Prescription Order Approved', 'Mr Moin, your prescription order #55 has been approved.', '2023-06-26 14:00:39', '2023-06-26 14:00:39'),
(182, 25, '2023-06-26 14:01:26', 'Prescription Order Approved', 'Mr Moin, your prescription order #54 has been approved.', '2023-06-26 14:01:26', '2023-06-26 14:01:26'),
(183, 25, '2023-06-26 14:08:19', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #55 Cart Ready.', '2023-06-26 14:08:19', '2023-06-26 14:08:19'),
(184, 25, '2023-06-26 14:13:54', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #54 Cart Ready.', '2023-06-26 14:13:54', '2023-06-26 14:13:54'),
(185, 25, '2023-06-26 14:14:23', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #52 Cart Ready.', '2023-06-26 14:14:23', '2023-06-26 14:14:23'),
(186, 25, '2023-06-26 14:15:01', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #51 Cart Ready.', '2023-06-26 14:15:01', '2023-06-26 14:15:01'),
(187, 25, '2023-06-26 14:19:58', 'Order Recieved', 'Mr Moin, your prescription order #56 has been Recieved.', '2023-06-26 14:19:58', '2023-06-26 14:19:58'),
(188, 25, '2023-06-26 14:21:53', 'Prescription Order Approved', 'Mr Moin, your prescription order #56 has been approved.', '2023-06-26 14:21:53', '2023-06-26 14:21:53'),
(189, 25, '2023-06-26 14:42:22', 'Order Recieved', 'Mr Moin, your prescription order #57 has been Recieved.', '2023-06-26 14:42:22', '2023-06-26 14:42:22'),
(190, 25, '2023-06-26 14:42:43', 'Prescription Order Approved', 'Mr Moin, your prescription order #57 has been approved.', '2023-06-26 14:42:43', '2023-06-26 14:42:43'),
(191, 25, '2023-06-26 14:44:46', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #57 Cart Ready.', '2023-06-26 14:44:46', '2023-06-26 14:44:46'),
(192, 25, '2023-06-26 15:07:50', 'Order Recieved', 'Mr Moin, your prescription order #58 has been Recieved.', '2023-06-26 15:07:50', '2023-06-26 15:07:50'),
(193, 25, '2023-06-26 15:09:02', 'Prescription Order Approved', 'Mr Moin, your prescription order #58 has been approved.', '2023-06-26 15:09:02', '2023-06-26 15:09:02'),
(194, 25, '2023-06-26 15:11:47', 'Prescription Order Cart Ready', 'Mr Moin, your prescription order #58 Cart Ready.', '2023-06-26 15:11:47', '2023-06-26 15:11:47'),
(195, 25, '2023-06-26 15:16:18', 'Order Recieved', 'Mr Moin, your prescription order #59 has been Recieved.', '2023-06-26 15:16:18', '2023-06-26 15:16:18'),
(196, 25, '2023-06-26 15:23:26', 'Order Recieved', 'Mr Moin, your prescription order #60 has been Recieved.', '2023-06-26 15:23:26', '2023-06-26 15:23:26'),
(197, 25, '2023-06-26 15:23:32', 'Prescription Order Approved', 'Mr Moin, your prescription order #60 has been approved.', '2023-06-26 15:23:32', '2023-06-26 15:23:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notify_uid`
--

CREATE TABLE `tbl_notify_uid` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `player_id` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_notify_uid`
--

INSERT INTO `tbl_notify_uid` (`id`, `uid`, `player_id`, `token`, `created_at`, `updated_at`) VALUES
(5, 75, 'ebfa5392-f32c-42be-8eb8-362f89c1510d', 'exUR7Ru9QoqTdYBL_DTrA0:APA91bGaHHLVivCJM6N-n6eql9eeSAqzotCY6gtgv-9XA2nOXdH4YPNdpu10RXPo4egQ6Gg7eqMgzRGeqRUTUsml6XoaUhH-kMCCoKUm4Y9A5SGlwY9Hqhfds0vMPQPdlq-TBg-WVHa3', '2023-06-26 04:12:24', '2023-06-26 04:12:24'),
(9, 25, '7bc5fb75-387d-4c33-81ab-db916549b14a', 'dKNhCpGOS7-JL0Ay9IANZA:APA91bHcuL8HzXat4paIOPGRFqxUpshYdxTjn-1Am-itmKebhXB_-AuvtD5m65zO1NVsxnyWdUFvQ2jhxC3GeVG8UwGlJhEyrzBB5luOhUnpzjLYJCdb7xH99cq61hENIwqeq9OcdHHS', '2023-06-26 06:19:06', '2023-06-26 06:19:06'),
(10, 25, '57f9f529-d147-481a-9791-9ddfeb474f70', 'dNZL3uMdRJCbsgo1idm0yS:APA91bHnc9ika2WhjP9UVE2UuK7ldEmbAIcymH0RYWQUPA4_Y43_W0tWrNIKCCRqrXW_Kdi66zD6vrdOR8nFHJbwfGK32Tl33qDzKTLSqY1pl3hjUBwUWSshqCqmIxpchPftV1Chzy_P', '2023-06-26 06:23:55', '2023-06-26 06:23:55'),
(13, 25, 'd5c42875-b2ac-411e-bba2-76442c34333a', 'eIRJ52qpQxyKYyzrVtaccN:APA91bH0OBzgmPGTK0bz5p1wMfpNSo67bb8T09h5KXLN2jRdhtiORR1Up5x8nYSe_B4fzCaO7K-SWWW-Is29gX-ckCSmK8ZzU37pjx9qrAqXUQuMBfFRrtSng9cDnrQnf2dlaTTpQLXW', '2023-06-26 08:05:35', '2023-06-26 08:05:35'),
(15, 25, '691e0ec2-8ffb-467c-a4aa-b56ddf878a51', 'ePip5qTNSryrDFf9xT4R1l:APA91bF4A7pL-j-Z_3HH7IHdZZ1nVctvNNapQby-dYHRz9E88K69znsWHOmsvuBEOdSSsc4XMoWqYvSuB3wQyKQxApaxYaiNbM-Wz69X2YGisfEesfW1MsQgs2Omvtq3WXhpv6N4acUU', '2023-06-26 08:40:45', '2023-06-26 08:40:45'),
(16, 48, 'a5683aa3-e20f-4b00-a064-28db3a45f38b', 'f-P257xjQEquTUY1OuPo4E:APA91bGW0VxRXK2sb1poBkhBQz_674YR5Y2ITjB0JNGO6HgPqDZyoC1GruFhcBhCQhZ4tuaxlwG6oiFmskPrtEp5yGK3OArps4jV6arfKd3Dxr8bhRC3i9ztIYCE2V0BGoaLaBELdekR', '2023-06-26 10:24:17', '2023-06-26 10:24:17'),
(17, 48, '27e350fb-f5d0-4201-9d29-4f5e3b7f830a', 'd0VRJOi9R0e6ozueGQgjRu:APA91bHPHYaEjnzFyLtNko0lRwLFjnRp4kMeenc_G5TtB38lhLdrinMCOUthfr3gFSFbOi91AuLleqHQ0PrSexyBlGc5fXtsuzXL30IegcvbTC-WJyuScSHyz9-3slwPHT1mUXqgURdg', '2023-06-26 10:29:26', '2023-06-26 10:29:26'),
(21, 48, '6f3c3e35-b1ef-4d2a-ade8-f24b9b567801', 'caEEj9EYQzmkGP6VU_BoFB:APA91bG_octVCSGQJTqQPJKMqIb0SeBzDV9B6k00rwYrvBfQlxHDNZM9W8l0tdwSVsCavsVmbpwmsE4wKnye5SvX9AURCiZl8KH5Xgrm_wngVTHdBow2BJpfXSwxM1AIMb-OsMmP7NNs', '2023-06-26 10:46:15', '2023-06-26 10:46:15'),
(22, 76, 'ebfa5392-f32c-42be-8eb8-362f89c1510d', 'exUR7Ru9QoqTdYBL_DTrA0:APA91bGaHHLVivCJM6N-n6eql9eeSAqzotCY6gtgv-9XA2nOXdH4YPNdpu10RXPo4egQ6Gg7eqMgzRGeqRUTUsml6XoaUhH-kMCCoKUm4Y9A5SGlwY9Hqhfds0vMPQPdlq-TBg-WVHa3', '2023-06-26 10:57:16', '2023-06-26 10:57:16'),
(23, 25, 'ebfa5392-f32c-42be-8eb8-362f89c1510d', 'exUR7Ru9QoqTdYBL_DTrA0:APA91bGaHHLVivCJM6N-n6eql9eeSAqzotCY6gtgv-9XA2nOXdH4YPNdpu10RXPo4egQ6Gg7eqMgzRGeqRUTUsml6XoaUhH-kMCCoKUm4Y9A5SGlwY9Hqhfds0vMPQPdlq-TBg-WVHa3', '2023-06-26 10:57:24', '2023-06-26 10:57:24'),
(27, 25, 'db25449a-c5c6-4e93-9f12-de918f796d78', 'fFXrXMOJSPqmOoeutwvrAR:APA91bE7TdK0IJvCdpfVAnlZkqWWlydcaQyKQAEFncRj7od_3SNHoqwN3KQi0paVAIcTML6w3O3AOOJAr4t2fgaBuxousS-WkmNkmD-sCspdeQEqE1X6_yJK2swwI_sS1DLb09Ne767c', '2023-06-26 13:42:21', '2023-06-26 13:42:21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `m_title` varchar(255) NOT NULL,
  `m_image` varchar(255) NOT NULL,
  `m_discount` int(11) NOT NULL,
  `m_price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `tottal_price` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `m_days` int(11) NOT NULL DEFAULT 1,
  `m_daily_dose` int(11) NOT NULL DEFAULT 0,
  `m_piese_per_dose` int(11) NOT NULL DEFAULT 0,
  `m_instruction` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `m_times` varchar(255) NOT NULL DEFAULT '',
  `m_notes` varchar(255) NOT NULL DEFAULT '',
  `m_types` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`id`, `p_id`, `m_id`, `m_title`, `m_image`, `m_discount`, `m_price`, `quantity`, `tottal_price`, `created_at`, `updated_at`, `m_days`, `m_daily_dose`, `m_piese_per_dose`, `m_instruction`, `created_by`, `m_times`, `m_notes`, `m_types`) VALUES
(49, 49, 3, 'Ace XR', 'uploads/medicins/img3.jpeg', 3, 18, 3, 54, '2023-06-26 10:52:26', '2023-06-26 10:52:26', 3, 5, 2, 1, 10, 'Lunch', 'test note', 'tablet'),
(50, 49, 28, 'Ambrox', 'uploads/medicins/img28.jpeg', 1, 50, 1, 50, '2023-06-26 10:52:26', '2023-06-26 10:52:26', 3, 3, 1, 2, 10, 'Sleep', 'test note 2', 'Syrup'),
(51, 49, 10, 'Arocef', 'uploads/medicins/img10.png', 1, 70, 1, 70, '2023-06-26 10:53:05', '2023-06-26 10:53:05', 1, 4, 3, 0, 10, 'Sleep', 'new note', 'Syrup'),
(52, 49, 33, 'ATP', 'uploads/medicins/img33.jpeg', 4, 20, 4, 80, '2023-06-26 10:53:56', '2023-06-26 10:53:56', 4, 4, 1, 0, 10, 'Sleep', 'Take good care of yourself', 'tablet'),
(53, 50, 3, 'Ace XR', 'uploads/medicins/img3.jpeg', 3, 18, 3, 54, '2023-06-26 11:03:14', '2023-06-26 11:03:14', 4, 5, 3, 0, 10, 'Breakfast/ Lunch', 'Take good care of yourself', 'tablet'),
(54, 50, 10, 'Arocef', 'uploads/medicins/img10.png', 3, 70, 3, 210, '2023-06-26 11:03:14', '2023-06-26 11:03:14', 3, 3, 3, 1, 10, 'Breakfast/ Dinner', 'Take good care of yourself', 'Syrup'),
(55, 51, 3, 'Ace XR', 'uploads/medicins/img3.jpeg', 3, 18, 3, 54, '2023-06-26 11:06:12', '2023-06-26 11:06:12', 3, 3, 1, 1, 10, 'Breakfast/ Dinner', 'note', 'tablet'),
(56, 52, 28, 'Ambrox', 'uploads/medicins/img28.jpeg', 4, 50, 4, 200, '2023-06-26 11:32:04', '2023-06-26 11:32:04', 3, 3, 1, 0, 10, 'Sleep', 'Take good care of yourself', 'Syrup'),
(57, 53, 28, 'Ambrox', 'uploads/medicins/img28.jpeg', 1, 50, 1, 50, '2023-06-26 12:37:25', '2023-06-26 12:37:25', 1, 1, 1, 1, 10, 'Dinner', '', 'Syrup'),
(58, 55, 36, 'Ace XR', 'uploads/medicins/img3.jpeg', 1, 18, 1, 18, '2023-06-26 14:07:57', '2023-06-26 14:07:57', 1, 3, 1, 1, 10, 'Breakfast/ Lunch', 'v', 'tablet'),
(59, 54, 3, 'Ace XR', 'uploads/medicins/img3.jpeg', 1, 18, 1, 18, '2023-06-26 14:13:11', '2023-06-26 14:13:11', 1, 3, 1, 0, 10, 'Lunch', 'new note', 'tablet'),
(60, 57, 3, 'Ace XR', 'uploads/medicins/img3.jpeg', 1, 18, 1, 18, '2023-06-26 14:44:42', '2023-06-26 14:44:42', 1, 3, 1, 0, 10, 'Dinner', 'Take good care of yourself', 'tablet'),
(61, 58, 3, 'Ace XR', 'uploads/medicins/img3.jpeg', 1, 18, 1, 18, '2023-06-26 15:11:44', '2023-06-26 15:11:44', 1, 3, 1, 2, 10, 'Sleep', 'sdd', 'tablet');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages_setting`
--

CREATE TABLE `tbl_pages_setting` (
  `id` int(11) NOT NULL,
  `privacy` text DEFAULT NULL,
  `about` text DEFAULT NULL,
  `contact` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pages_setting`
--

INSERT INTO `tbl_pages_setting` (`id`, `privacy`, `about`, `contact`, `terms`, `created_at`, `updated_at`, `created_by`) VALUES
(5, '<p>Privacy Policy for Medical App Introduction: This Privacy Policy outlines how we collect, use, and protect the personal information of users of our medical app. We are committed to safeguarding your privacy and ensuring the security of your information. By using our app, you consent to the practices described in this policy. Information We Collect: Personal Information: We may collect personal information such as your name, email address, contact number, and medical history. This information is collected when you register an account, complete forms, or interact with our app\'s features. Usage Data: We may collect non-personal information about your app usage, including device information, app version, IP address, and browsing activity. This data is collected to improve our services and enhance the user experience. Use of Information: Personalization: We use the collected information to personalize and customize your experience within the app, providing relevant content, recommendations, and features based on your medical history and preferences. Communication: We may use your contact information to send important updates, notifications, and promotional materials related to our app. You can opt-out of these communications at any time. Analytics and Improvements: We analyze usage data to understand how users interact with our app, identify trends, and improve our services, functionality, and user interface. Legal Requirements: We may disclose your information when required by law, court order, or governmental regulation to protect our legal rights, respond to legal claims, or comply with a judicial proceeding. Data Security: We have implemented industry-standard security measures to protect your personal information from unauthorized access, disclosure, alteration, or destruction. However, please note that no method of transmission over the internet or electronic storage is 100% secure. Third-Party Services: We may utilize third-party services, such as analytics providers or advertising networks, to enhance our app\'s functionality and deliver relevant content. These third parties may collect and process data as governed by their respective privacy policies. Data Retention: We retain your personal information for as long as necessary to fulfill the purposes outlined in this Privacy Policy, unless a longer retention period is required or permitted by law. Children\'s Privacy: Our app is not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If we discover that we have collected personal information from a child without parental consent, we will promptly delete it. Changes to the Privacy Policy: We reserve the right to modify or update this Privacy Policy at any time. We will notify users of any significant changes through app notifications or other means. Please review this policy periodically for any updates. Contact Us: If you have any questions, concerns, or requests regarding this Privacy Policy or the handling of your personal information, please contact us using the contact information provided in the app. By using our medical app, you acknowledge that you have read, understood, and agreed to the terms and practices described in this Privacy Policy.<br></p>', '<p style=\"margin-right: 0px; margin-bottom: 34px; margin-left: 0px; color: rgb(37, 37, 37); font-family: Lora, serif; font-size: 19px; letter-spacing: -0.2px;\">Their About Us page stands out by showcasing some of their unique and creative projects.</p><p style=\"margin-right: 0px; margin-bottom: 34px; margin-left: 0px; color: rgb(37, 37, 37); font-family: Lora, serif; font-size: 19px; letter-spacing: -0.2px;\">No number of words could hope to tell one of their potential clients nearly as much as these pictures can.</p><p style=\"margin-right: 0px; margin-bottom: 34px; margin-left: 0px; color: rgb(37, 37, 37); font-family: Lora, serif; font-size: 19px; letter-spacing: -0.2px;\">In this case, the 25 pictures featured on Band’s About Us page are worth much more than the 170 actual words you’ll read on the page.</p><p style=\"margin-right: 0px; margin-bottom: 34px; margin-left: 0px; color: rgb(37, 37, 37); font-family: Lora, serif; font-size: 19px; letter-spacing: -0.2px;\">The magical visuals and overall simple look and feel make this About Us page one of our top picks.</p>', '<p><span style=\"font-weight: 700; font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\"><u>Address:</u></span><br style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\"><span style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\">Keas 69 Str.</span><br style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\"><font face=\"Trebuchet MS, Tahoma, sans-serif\"><span style=\"font-size: 36px;\">XORGEEK</span></font><br style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\"><span style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\">Athens,</span><br style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\"><span style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\">Greece</span><br style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\"><br style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\"><span style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\">+30-2106019311 (landline)</span><br style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\"><span style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\">+30-6977664062 (mobile phone)</span><br style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\"><span style=\"font-family: &quot;Trebuchet MS&quot;, Tahoma, sans-serif; font-size: 14px;\">+30-2106398905 (fax)</span><br></p>', '<h1 style=\"margin-right: 0px; margin-bottom: 1em; margin-left: 0px; font-weight: 700; color: rgb(51, 51, 51); font-size: 24px; font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif;\">Terms and Conditions Sample Generator</h1><p style=\"margin: 1em 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px;\">Help protect your website and its users with clear and fair website terms and conditions. These terms and conditions for a website set out key issues such as acceptable use, privacy, cookies, registration and passwords, intellectual property, links to other sites, termination and disclaimers of responsibility. Terms and conditions are used and necessary to protect a website owner from liability of a user relying on the information or the goods provided from the site then suffering a loss.</p><p style=\"margin: 1em 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px;\">Making your own terms and conditions for your website is hard, not impossible, to do. It can take a few hours to few days for a person with no legal background to make. But worry no more; we are here to help you out.</p><p style=\"margin: 1em 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px;\">All you need to do is fill up the blank spaces and then you will receive an email with your personalized terms and conditions.</p><p style=\"margin: 1em 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px;\"><span style=\"font-weight: 700;\">Looking for a Privacy Policy?</span>&nbsp;Check out&nbsp;<a href=\"https://www.privacypolicygenerator.info/\" rel=\"noopener noreferrer\" style=\"color: rgb(93, 136, 179); text-decoration: none;\">Privacy Policy Generator</a>.</p><p style=\"margin: 1em 0px; color: rgb(51, 51, 51); font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, sans-serif; font-size: 16px;\">The accuracy of the generated document on this website is not legally binding. Use at your own risk.</p>', '2023-05-24 07:59:37', '2023-05-24 09:53:11', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_setting`
--

CREATE TABLE `tbl_payment_setting` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `attributes` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `p_show` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment_setting`
--

INSERT INTO `tbl_payment_setting` (`id`, `title`, `img`, `attributes`, `status`, `subtitle`, `p_show`, `created_at`, `updated_at`) VALUES
(2, 'Cash On Delivery', 'uploads/payments/1679558159.png', '-', 1, 'Pay via Cash at the time of delivery, It\'s free and only takes a few minutes', 0, '2023-05-21 07:01:53', '0000-00-00 00:00:00'),
(3, 'Paypal', 'uploads/payments/1679558139.png', 'PAYPAL_KEY,0', 1, 'Credit/Debit card with Easier way to pay – online and on your mobile.', 1, '2023-05-21 07:17:05', '0000-00-00 00:00:00'),
(4, 'Stripe', 'uploads/payments/1679558175.png', 'PRIMARY KEY,SECRET_KEY', 1, 'Accept all major debit and credit cards from customers in every country', 1, '2023-06-18 07:27:26', '2023-05-21 09:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prescription_order`
--

CREATE TABLE `tbl_prescription_order` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `pay_methode` varchar(255) NOT NULL DEFAULT '',
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `o_status` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `subtotal` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `total` float NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `p_image` varchar(255) NOT NULL,
  `cart_status` int(11) NOT NULL DEFAULT 0,
  `insurance_total` float NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `hospital` varchar(255) NOT NULL DEFAULT '',
  `department` varchar(255) NOT NULL DEFAULT '',
  `doctor_name` varchar(255) NOT NULL DEFAULT '',
  `ins_code` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_prescription_order`
--

INSERT INTO `tbl_prescription_order` (`id`, `uid`, `pay_methode`, `order_date`, `o_status`, `status`, `subtotal`, `tax`, `total`, `created_at`, `updated_at`, `p_image`, `cart_status`, `insurance_total`, `created_by`, `hospital`, `department`, `doctor_name`, `ins_code`) VALUES
(49, 25, '', '2023-06-26 10:50:50', 1, 0, 254, 38.1, 215.9, '2023-06-26 10:50:50', '2023-06-26 10:54:01', 'uploads/prescriptions/64996d8a58e4a.jpg;uploads/prescriptions/64996d8a58f62.jpg', 1, 76.2, 10, 'center hospital', 'eye dept', 'Dr Akash', 'ins'),
(50, 25, 'Cash On Delivery', '2023-06-26 11:01:41', 2, 4, 264, 39.6, 224.4, '2023-06-26 11:01:41', '2023-06-26 11:04:39', 'uploads/prescriptions/649970157922c.jpg', 1, 79.2, 10, 'hospital vila', 'new dept', 'new doc', '123456'),
(51, 25, '', '2023-06-26 11:05:39', 0, 3, 54, 8.1, 45.9, '2023-06-26 11:05:39', '2023-06-26 14:39:37', 'uploads/prescriptions/6499710308dee.jpg', 1, 16.2, 10, 'hospital vila', 'new dept', 'doct', '123456'),
(52, 25, 'Paypal', '2023-06-26 11:31:23', 2, 4, 200, 30, 170, '2023-06-26 11:31:23', '2023-06-26 14:40:41', 'uploads/prescriptions/6499770b176f9.jpg', 1, 60, 10, 'hospital vila', 'dept', 'new doc', '123456'),
(53, 77, '', '2023-06-26 12:36:08', 1, 0, 50, 7.5, 42.5, '2023-06-26 12:36:08', '2023-06-26 12:37:32', 'uploads/prescriptions/64998638de1e5.jpg', 1, 15, 10, 'hospital vila', 'dept', 'doct', '123456'),
(54, 25, '', '2023-06-26 13:45:11', 1, 0, 18, 2.7, 15.3, '2023-06-26 13:45:11', '2023-06-26 14:13:54', 'uploads/prescriptions/64999667a1918.jpg', 1, 5.4, 10, 'hospital vila', 'new dept', 'doct', '123456'),
(55, 25, '', '2023-06-26 13:59:33', 0, 3, 18, 2.7, 15.3, '2023-06-26 13:59:33', '2023-06-26 14:39:21', 'uploads/prescriptions/649999c5631bd.jpg', 1, 5.4, 10, 'hospital vila', 'dept', 'doct', '123456'),
(56, 25, '', '2023-06-26 14:19:57', 0, 3, 0, 0, 0, '2023-06-26 14:19:57', '2023-06-26 14:39:11', 'uploads/prescriptions/64999e8d827bf.jpg', 0, 0, 0, '', '', '', ''),
(57, 25, '', '2023-06-26 14:42:21', 1, 0, 18, 2.7, 15.3, '2023-06-26 14:42:21', '2023-06-26 14:44:46', 'uploads/prescriptions/6499a3cd682b5.jpg', 1, 5.4, 10, 'hospital vila', 'dept', 'doct', '123456'),
(58, 25, '', '2023-06-26 15:07:49', 1, 0, 18, 2.7, 15.3, '2023-06-26 15:07:49', '2023-06-26 15:11:47', 'uploads/prescriptions/6499a9c5d5adf.jpg', 1, 5.4, 10, '3ee', 'ddd', 'dd', 'eff'),
(59, 25, '', '2023-06-26 15:16:17', 1, 1, 0, 0, 0, '2023-06-26 15:16:17', '2023-06-26 15:16:17', 'uploads/prescriptions/6499abc14e729.jpg', 0, 0, 0, '', '', '', ''),
(60, 25, '', '2023-06-26 15:23:25', 1, 0, 0, 0, 0, '2023-06-26 15:23:25', '2023-06-26 15:23:32', 'uploads/prescriptions/6499ad6d32112.jpg', 0, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `daily_dose` int(11) NOT NULL,
  `piese_per_dose` int(11) NOT NULL,
  `instruction` int(11) NOT NULL,
  `stock_status` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `delete_flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `product_id`, `image`, `title`, `type`, `daily_dose`, `piese_per_dose`, `instruction`, `stock_status`, `price`, `created_at`, `updated_at`, `created_by`, `delete_flag`) VALUES
(1, 1, 'uploads/medicins/img1.jpeg', 'Oradin', 'tablet', 2, 1, 0, 1, 36, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(2, 2, 'uploads/medicins/img2.jpeg', 'Gaviscon', 'Syrup', 1, 1, 0, 1, 1420, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(3, 3, 'uploads/medicins/img3.jpeg', 'Ace XR', 'tablet', 3, 1, 0, 1, 18, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(4, 4, 'uploads/medicins/img4.jpeg', 'Napa Extra', 'tablet', 2, 1, 1, 1, 27, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(5, 5, 'uploads/medicins/img5.jpeg', 'Panadol', 'tablet', 2, 1, 0, 1, 710, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(6, 6, 'uploads/medicins/img6.png', 'Rhemex', 'capsule', 3, 1, 0, 0, 45, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(7, 7, 'uploads/medicins/img7.png', 'Carbolin DS', 'Syrup', 2, 1, 0, 1, 36, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(8, 8, 'uploads/medicins/img8.jpeg', 'Vilanti', 'capsule', 2, 2, 0, 0, 195, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(9, 9, 'uploads/medicins/img9.jpeg', 'Camlodin', 'tablet', 3, 1, 0, 1, 54, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(10, 10, 'uploads/medicins/img10.png', 'Arocef', 'Syrup', 1, 1, 0, 1, 70, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(11, 11, 'uploads/medicins/img11.jpeg', 'Virux', 'Syrup', 2, 1, 0, 1, 125, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(12, 12, 'uploads/medicins/img12.jpeg', 'Geston', 'tablet', 3, 2, 1, 1, 90, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(13, 13, 'uploads/medicins/img13.png', 'Xinc 20', 'tablet', 2, 1, 0, 1, 35, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(14, 14, 'uploads/medicins/img14.jpeg', 'Fexo 120', 'tablet', 2, 1, 0, 0, 90, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(15, 15, 'uploads/medicins/img15.jpeg', 'Famotack 20', 'tablet', 1, 2, 0, 1, 30, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(16, 16, 'uploads/medicins/img16.jpeg', 'Yamadin 40', 'tablet', 3, 1, 0, 0, 15, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(17, 17, 'uploads/medicins/img17.png', 'Lijenta 5', 'capsule', 2, 1, 0, 1, 330, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(18, 18, 'uploads/medicins/img18.jpeg', 'Neurolep', 'tablet', 4, 1, 0, 1, 60, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(19, 19, 'uploads/medicins/img19.png', 'Rupatrol', 'tablet', 2, 1, 0, 1, 120, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(20, 20, 'uploads/medicins/img20.jpeg', 'Puratrol', 'tablet', 2, 1, 1, 1, 8, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(21, 21, 'uploads/medicins/img21.png', 'Flemo', 'capsule', 3, 1, 0, 1, 120, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(22, 22, 'uploads/medicins/img22.jpeg', 'Gastrolin', 'Syrup', 1, 1, 0, 0, 160, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(23, 23, 'uploads/medicins/img23.jpeg', 'Eyevi', 'capsule', 2, 2, 0, 1, 60, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(24, 24, 'uploads/medicins/img24.jpeg', 'Optavit', 'capsule', 3, 1, 0, 0, 100, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(25, 25, 'uploads/medicins/img25.jpeg', 'D-Vine', 'capsule', 2, 1, 0, 1, 200, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(26, 26, 'uploads/medicins/img26.jpeg', 'Seclo 20', 'capsule', 1, 1, 0, 1, 60, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(27, 27, 'uploads/medicins/img27.jpeg', 'Max Pro20', 'tablet', 3, 1, 0, 1, 98, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(28, 28, 'uploads/medicins/img28.jpeg', 'Ambrox', 'Syrup', 1, 1, 1, 1, 50, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(29, 29, 'uploads/medicins/img29.jpeg', 'Fexo', 'Syrup', 3, 1, 0, 1, 55, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(30, 30, 'uploads/medicins/img30.jpg', 'Azithromycin', 'tablet', 2, 1, 0, 0, 180, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(31, 31, 'uploads/medicins/img31.jpg', 'Loratadine', 'tablet', 3, 2, 0, 1, 30, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(32, 32, 'uploads/medicins/img32.jpeg', 'Flurizin', 'tablet', 2, 1, 0, 0, 70, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(33, 33, 'uploads/medicins/img33.jpeg', 'ATP', 'tablet', 3, 1, 0, 1, 20, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(34, 34, 'uploads/medicins/img1.jpeg', 'Oradin', 'tablet', 2, 1, 0, 1, 36, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(35, 35, 'uploads/medicins/img2.jpeg', 'Gaviscon', 'Syrup', 1, 1, 0, 1, 1420, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(36, 36, 'uploads/medicins/img3.jpeg', 'Ace XR', 'tablet', 3, 1, 1, 1, 18, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(37, 37, 'uploads/medicins/img4.jpeg', 'Napa Extra', 'tablet', 2, 1, 0, 1, 27, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(38, 38, 'uploads/medicins/img5.jpeg', 'Panadol', 'tablet', 2, 1, 0, 0, 710, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(39, 39, 'uploads/medicins/img6.png', 'Rhemex', 'capsule', 3, 1, 0, 1, 45, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(40, 40, 'uploads/medicins/img7.png', 'Carbolin DS', 'Syrup', 2, 1, 0, 0, 36, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(41, 41, 'uploads/medicins/img8.jpeg', 'Vilanti', 'capsule', 2, 2, 0, 1, 195, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(42, 42, 'uploads/medicins/img9.jpeg', 'Camlodin', 'tablet', 3, 1, 0, 1, 54, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(43, 43, 'uploads/medicins/img10.png', 'Arocef', 'Syrup', 1, 1, 0, 1, 70, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(44, 44, 'uploads/medicins/img11.jpeg', 'Virux', 'Syrup', 2, 1, 1, 1, 125, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(45, 45, 'uploads/medicins/img12.jpeg', 'Geston', 'tablet', 3, 2, 0, 1, 90, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(46, 46, 'uploads/medicins/img13.png', 'Xinc 20', 'tablet', 2, 1, 0, 0, 35, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(47, 47, 'uploads/medicins/img14.jpeg', 'Fexo 120', 'tablet', 2, 1, 0, 1, 90, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(48, 48, 'uploads/medicins/img15.jpeg', 'Famotack 20', 'tablet', 1, 2, 0, 0, 30, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(49, 49, 'uploads/medicins/img16.jpeg', 'Yamadin 40', 'tablet', 3, 1, 0, 1, 15, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(50, 50, 'uploads/medicins/img17.png', 'Lijenta 5', 'capsule', 2, 1, 0, 1, 330, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(51, 51, 'uploads/medicins/img18.jpeg', 'Neurolep', 'tablet', 4, 1, 0, 1, 60, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(52, 52, 'uploads/medicins/img19.png', 'Rupatrol', 'tablet', 2, 1, 1, 1, 120, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(53, 53, 'uploads/medicins/img20.jpeg', 'Puratrol', 'tablet', 2, 1, 0, 1, 8, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(54, 54, 'uploads/medicins/img21.png', 'Flemo', 'capsule', 3, 1, 0, 0, 120, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(55, 55, 'uploads/medicins/img22.jpeg', 'Gastrolin', 'Syrup', 1, 1, 0, 1, 160, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(56, 56, 'uploads/medicins/img23.jpeg', 'Eyevi', 'capsule', 2, 2, 0, 0, 60, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(57, 57, 'uploads/medicins/img24.jpeg', 'Optavit', 'capsule', 3, 1, 0, 1, 100, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(58, 58, 'uploads/medicins/img25.jpeg', 'D-Vine', 'capsule', 2, 1, 0, 1, 200, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(59, 59, 'uploads/medicins/img26.jpeg', 'Seclo 20', 'capsule', 1, 1, 0, 1, 60, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(60, 60, 'uploads/medicins/img27.jpeg', 'Max Pro20', 'tablet', 3, 1, 1, 1, 98, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(61, 61, 'uploads/medicins/img28.jpeg', 'Ambrox', 'Syrup', 1, 1, 0, 1, 50, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(62, 62, 'uploads/medicins/img29.jpeg', 'Fexo', 'Syrup', 3, 1, 0, 0, 55, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(63, 63, 'uploads/medicins/img30.jpg', 'Azithromycin', 'tablet', 2, 1, 0, 1, 180, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(64, 64, 'uploads/medicins/img31.jpg', 'Loratadine', 'tablet', 3, 2, 0, 0, 30, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(65, 65, 'uploads/medicins/img32.jpeg', 'Flurizin', 'tablet', 2, 1, 0, 1, 70, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(66, 66, 'uploads/medicins/img33.jpeg', 'ATP', 'tablet', 3, 1, 0, 1, 20, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(67, 67, 'uploads/medicins/img1.jpeg', 'Oradin', 'tablet', 2, 1, 0, 1, 36, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(68, 68, 'uploads/medicins/img2.jpeg', 'Gaviscon', 'Syrup', 1, 1, 1, 1, 1420, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(69, 69, 'uploads/medicins/img3.jpeg', 'Ace XR', 'tablet', 3, 1, 0, 1, 18, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(70, 70, 'uploads/medicins/img4.jpeg', 'Napa Extra', 'tablet', 2, 1, 0, 0, 27, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(71, 71, 'uploads/medicins/img5.jpeg', 'Panadol', 'tablet', 2, 1, 0, 1, 710, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(72, 72, 'uploads/medicins/img6.png', 'Rhemex', 'capsule', 3, 1, 0, 0, 45, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(73, 73, 'uploads/medicins/img7.png', 'Carbolin DS', 'Syrup', 2, 1, 0, 1, 36, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(74, 74, 'uploads/medicins/img8.jpeg', 'Vilanti', 'capsule', 2, 2, 0, 1, 195, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(75, 75, 'uploads/medicins/img9.jpeg', 'Camlodin', 'tablet', 3, 1, 0, 1, 54, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(76, 76, 'uploads/medicins/img10.png', 'Arocef', 'Syrup', 1, 1, 1, 1, 70, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(77, 77, 'uploads/medicins/img11.jpeg', 'Virux', 'Syrup', 2, 1, 0, 1, 125, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(78, 78, 'uploads/medicins/img12.jpeg', 'Geston', 'tablet', 3, 2, 0, 0, 90, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(79, 79, 'uploads/medicins/img13.png', 'Xinc 20', 'tablet', 2, 1, 0, 1, 35, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(80, 80, 'uploads/medicins/img14.jpeg', 'Fexo 120', 'tablet', 2, 1, 0, 0, 90, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(81, 81, 'uploads/medicins/img15.jpeg', 'Famotack 20', 'tablet', 1, 2, 0, 1, 30, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(82, 82, 'uploads/medicins/img23.jpeg', 'Eyevi', 'capsule', 2, 2, 0, 1, 85, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1),
(83, 83, 'uploads/medicins/img24.jpeg', 'Optavit', 'capsule', 3, 1, 0, 1, 60, '2023-06-26 09:38:56', '2023-06-26 09:38:56', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_0`
--

CREATE TABLE `tbl_product_0` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `daily_dose` int(11) NOT NULL,
  `piese_per_dose` int(11) NOT NULL,
  `instruction` int(11) NOT NULL,
  `stock_status` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL,
  `delete_flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_0`
--

INSERT INTO `tbl_product_0` (`id`, `product_id`, `image`, `title`, `type`, `daily_dose`, `piese_per_dose`, `instruction`, `stock_status`, `price`, `created_at`, `updated_at`, `created_by`, `delete_flag`) VALUES
(1, 1, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 2, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(2, 2, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 0),
(3, 3, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 08:57:17', 2, 0),
(4, 4, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 08:57:30', 2, 1),
(5, 5, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 08:57:59', 2, 0),
(6, 6, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(7, 7, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(8, 8, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(9, 9, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 0),
(10, 10, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(11, 11, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(12, 12, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(13, 13, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(14, 14, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(15, 15, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(16, 16, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(17, 17, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(18, 18, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(19, 19, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(20, 20, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(21, 21, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(22, 22, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(23, 23, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(24, 24, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(25, 25, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(26, 26, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(27, 27, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(28, 28, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(29, 29, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(30, 30, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(31, 31, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(32, 32, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(33, 33, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(34, 34, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(35, 35, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(36, 36, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(37, 37, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(38, 38, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(39, 39, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(40, 40, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(41, 41, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(42, 42, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(43, 43, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(44, 44, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(45, 45, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(46, 46, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(47, 47, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(48, 48, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(49, 49, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(50, 50, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(51, 51, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(52, 52, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(53, 53, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(54, 54, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(55, 55, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(56, 56, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(57, 57, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(58, 58, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(59, 59, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(60, 60, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(61, 61, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(62, 62, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(63, 63, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(64, 64, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(65, 65, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(66, 66, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(67, 67, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(68, 68, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(69, 69, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(70, 70, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(71, 71, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(72, 72, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(73, 73, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(74, 74, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(75, 75, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(76, 76, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 2, 1, 1, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(77, 77, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(78, 78, 'uploads/medicins/1680088993.png', 'max pro', 'capsule', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(79, 79, 'uploads/medicins/1680088993.png', 'saclo', 'capsule', 3, 2, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(80, 80, 'uploads/medicins/1680088993.png', 'Napa Extra', 'tablet', 3, 1, 0, 0, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(81, 81, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(82, 82, 'uploads/medicins/1680088993.png', 'Napa', 'tablet', 4, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1),
(83, 83, 'uploads/medicins/1680088993.png', 'Ambrox', 'Syrup', 3, 1, 0, 1, 20, '2023-05-14 07:54:36', '2023-05-14 07:54:36', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_2`
--

CREATE TABLE `tbl_product_2` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `discount` int(11) NOT NULL,
  `stock_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product_2`
--

INSERT INTO `tbl_product_2` (`id`, `product_id`, `product_code`, `image`, `title`, `type`, `price`, `discount`, `stock_status`, `created_at`, `updated_at`) VALUES
(1, 1, '1', 'uploads/medicins/1680088993.png', 'Napa Extra update', '10 Tablet(s) in Strip$', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(2, 2, '2', 'uploads/medicins/1680088993.png', 'Napa Extra', '11 #Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(3, 3, '3', 'uploads/medicins/1680088993.png', 'Napa Extra', '12 Tablet(s) in Strip', 20, 5, '0', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(4, 4, '4', 'uploads/medicins/1680088993.png', 'Napa Extra', '13 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(5, 5, '5', 'uploads/medicins/1680088993.png', 'Napa Extra', '14 Tablet(s) in Strip', 20, 5, '0', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(6, 6, '6', 'uploads/medicins/1680088993.png', 'Napa Extra', '15 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(7, 7, '7', 'uploads/medicins/1680088993.png', 'Napa Extra', '16 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(8, 8, '8', 'uploads/medicins/1680088993.png', 'Napa Extra', '17 Tablet(s) in Strip', 20, 5, '0', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(9, 9, '9', 'uploads/medicins/1680088993.png', 'Napa Extra', '18 Tablet(s) in Strip', 20, 5, '0', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(10, 10, '10', 'uploads/medicins/1680088993.png', 'Napa Extra', '19 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(11, 11, '11', 'uploads/medicins/1680088993.png', 'Napa Extra', '20 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(12, 12, '12', 'uploads/medicins/1680088993.png', 'Napa Extra', '21 Tablet(s) in Strip', 20, 5, '0', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(13, 13, '13', 'uploads/medicins/1680088993.png', 'Napa Extra', '22 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(14, 14, '14', 'uploads/medicins/1680088993.png', 'Napa Extra', '23 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(15, 15, '15', 'uploads/medicins/1680088993.png', 'Napa Extra', '24 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(16, 16, '16', 'uploads/medicins/1680088993.png', 'Napa Extra', '25 Tablet(s) in Strip', 20, 5, '0', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(17, 17, '17', 'uploads/medicins/1680088993.png', 'Napa Extra', '26 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(18, 18, '18', 'uploads/medicins/1680088993.png', 'Napa Extra', '27 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(19, 19, '19', 'uploads/medicins/1680088993.png', 'Napa Extra', '28 Tablet(s) in Strip', 20, 5, '0', '2023-04-09 09:38:58', '2023-04-09 09:38:58'),
(20, 20, '20', 'uploads/medicins/1680088993.png', 'Napa Extra', '29 Tablet(s) in Strip', 20, 5, '1', '2023-04-09 09:38:58', '2023-04-09 09:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `c_code` varchar(255) NOT NULL,
  `fid` varchar(255) NOT NULL,
  `line_id` varchar(255) NOT NULL DEFAULT '-',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `fname`, `lname`, `address`, `mobile`, `email`, `password`, `c_code`, `fid`, `line_id`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Md Akash', 'Akash', 'dhaka, bangladesh', '01982255978', 'ahad07@gmail.com', '$2y$10$IIW1hdtVxWY3gc3dib0Ld.CMsHe/SncAHW7iNocSJkoro4oh5RcBy', 'akash', 'akash2', '-', 1, '2023-06-22 10:36:43', '2023-06-18 06:17:24'),
(10, 'akash', 'akash', 'akash', '01982255974', 'akash8@gmail.com', '$2y$10$1vFkrnAXsLDnQ.b878nFh.otrFrmu.5zwhto7512NG1TdAbwB6Gf6', 'akash', 'abcd', '-', 1, '2023-06-22 10:36:48', '2023-04-09 07:15:32'),
(12, 'Md Ahad', 'islam', 'dhaka, bangladesh', '01982255977', 'ahad1@gmail.com', '$2y$10$w2ELEVnI1po/L7BD5A93jOauXo7ywUN2pBQXDPXl7pGa5aRaw9QX6', 'akash', 'akash', '-', 1, '2023-06-22 10:36:49', '2023-06-18 07:36:22'),
(13, 'akash', 'akash', 'akash', '01982255988', 'akash3@gmail.com', '$2y$10$VxpPb3ZMpXs0AY/H8PldHOAEoo6bOlNMle4Huw8Ik7MQLjpvDlSzG', 'akash', 'akash', '-', 1, '2023-06-22 10:36:50', '2023-04-10 07:37:07'),
(14, 'akash', 'akash', 'akash', '01982255989', 'akash4@gmail.com', '$2y$10$/y0BMWuRtkKGCSNFLsfts.rmSTEmsfoxRYzfq/XDwPQcUUslQLnNq', 'akash', 'akash', '-', 1, '2023-06-22 10:36:52', '2023-05-09 06:59:17'),
(15, 'akash', 'akash', 'akash', '01982255966', 'akash4444@gmail.com', '$2y$10$6xT8eKu40I6DrwIYXlrxN.4L32NYlXlI/qVZ5fFFQpZzVskiAF6cq', 'akash', 'akash', '-', 1, '2023-06-22 10:36:53', '2023-05-09 10:25:42'),
(16, 'akash', 'akash', 'akash', '01982255961', 'akash4443@gmail.com', '$2y$10$y0ZNdNy1vet/onS2H/m1P.htpQDEd1q3VB8n8twaEJ39ja8yLHeZq', 'akash', 'akash', '-', 1, '2023-06-22 10:36:55', '2023-05-09 10:27:28'),
(18, 'akash', 'akash', 'akash', '01982255986', 'akash46@gmail.com', '$2y$10$x.LeJJOqsDWYTaqVyndBgOknuoMQivn9qTBFfTSgXAiNYCBFHUB7G', 'akash', 'akash', '-', 1, '2023-06-22 10:36:57', '2023-05-09 10:30:29'),
(19, 'hfu', 'jfu', '-', '1982255936', 'zf@fu.com', '$2y$10$tQtgq25ajM5F..XtiiyrLOtyMX3X5OKP0oNRK1zW8bE/yq2OPgs1u', '+880', '-', '-', 1, '2023-06-22 10:36:59', '2023-05-09 10:32:12'),
(20, 'dyd', 'hchd', '-', '1982255933', 'sfs@gg.com', '$2y$10$WsW4mCBzuPsSVvwSzkYImeQHu0HWO6WJwoqHFYn125/rhwdgUOoN2', '+880', '-', '-', 1, '2023-06-22 10:37:01', '2023-05-09 10:47:56'),
(22, 'hacktest', 'korbo', '-', '1982255963', 'hacktes@g.v', '$2y$10$JQUbDMnsZxtiKp.4Y.zI3uxp3UUjZjaWsV2B/o89Tpp4Hqm/LAf5K', '+880', '-', '-', 1, '2023-06-22 10:37:02', '2023-05-09 11:31:26'),
(23, 'Masum', 'Reza', '-', '1571776432', 'hacktestkorbo@gmail.com', '$2y$10$/hTvS8JTCPD6WeeiJPD0su2t.8JqAHo0thtBbua1WtTI6uyC2Evx2', '+880', '-', '-', 1, '2023-06-22 10:37:04', '2023-05-10 09:36:10'),
(25, 'Mr Moin', 'Akash', '-', '1982255977', 'moinakash@gmail.com', '$2y$10$87dP6YS2nkoXnaD06c2Vb.2XTvYGuCf/1zKF61iPE7z6pMaRdrSuu', '+880', 'cEy9edXSQTNGFGZTs81ufz4VLE23', '-', 1, '2023-06-22 10:37:03', '2023-06-20 10:06:07'),
(31, 'ahad', 'islam', '-', '1608417847', 'ahadul@gmail.com', '$2y$10$1TXRXu81xkfXSGmYWKn3bOeZnzTpXG0.2BXdG7ND82YTzJerQBdlK', '+880', '985KevFD4OSwruicPR3qdCe5T5p2', '-', 1, '2023-06-22 10:37:06', '2023-06-20 10:08:29'),
(33, 'akash', 'akash', 'akash', '1844992323', 'akash466@gmail.com', '$2y$10$W0L8XW/.l.gtg/DjGlKiUOidUn8saQh4dUccsWckiqq/2pSrWfaX6', 'akash', 'akash', '-', 1, '2023-06-22 10:37:07', '2023-06-20 12:16:05'),
(48, '12', '13', '-', '1581478762', '12@gmail.com', '$2y$10$52jk5raHLSkURagtivCidOXu4nkwuCkiNvZf58tsBPm6JZ2UGUyAu', '+880', 'uHOe0BieDibwhGPhSpd2SnKbPEC2', '-', 1, '2023-06-26 10:32:54', '2023-06-26 10:32:54'),
(61, 'akash', 'akash', 'akash', '18449923233', 'akash466@gmail.com3', '$2y$10$55uWi9sBs0QgS3GaHkSwQuV2sEL8nvPapK3Ivj4JGTdMoaOMfwGXu', 'akash', 'akash', '-', 1, '2023-06-22 11:02:46', '2023-06-22 11:02:46'),
(62, 'akash', 'akash', 'akash', '18449923235', 'akash466@gmail.com8', '$2y$10$g8/xgCPS8fmMhC7Seo3wd.FR/ZQkkTJwcalpuN6Wvk6TTVHawLVni', 'akash', 'akash', '-', 1, '2023-06-22 11:04:46', '2023-06-22 11:04:46'),
(63, 'akash', 'akash', 'akash', '18449923238', 'akash466@gmail.com89', '$2y$10$qD/1lF7zwcZwTVbQlxBZNeusro1kcfHJ/9tsEFnMXQW02SUseHbzq', 'akash', 'akash', '-', 1, '2023-06-22 11:05:38', '2023-06-22 11:05:38'),
(64, 'akash', 'akash', 'akash', '18449923238r', 'akash466@gmail.com5', '$2y$10$dgostYgDdlGWdaRL7uDt4.5Qg4in4iR0Cmi6COq5HgDdDfEFp30mO', 'akash', 'akash', '-', 1, '2023-06-22 11:06:52', '2023-06-22 11:06:52'),
(65, 'akash', 'akash', 'akash', '18449923234', 'akash466@gmail.com4', '$2y$10$Z8mJ1SBWkkY8WwQOj8T9HeNAMcK4UUuOOox1kHxjdsFzyEtkqBtZO', 'akash', 'akash', '-', 1, '2023-06-22 11:07:39', '2023-06-22 11:07:39'),
(66, 'akash', 'akash', 'akash', '184499232345', 'akash466@gmail.com45', '$2y$10$rAFsWm2Prdva4jmyti9SNuatPckHsraBEPZkytJ9CTDYI1Ne6zX1i', 'akash', 'akash', '-', 1, '2023-06-22 11:43:57', '2023-06-22 11:43:57'),
(67, 'akash', 'akash', 'akash', '184499232345s', 'akash466@gmail.com45s', '$2y$10$Gk6fGF1b6NWzcDri.qOuiuyhUJQG/Rz1m.Jhks3EXW9/mfdb8LeZy', 'akash', 'akash', '-', 1, '2023-06-22 12:06:34', '2023-06-22 12:06:34'),
(68, 'akash', 'akash', 'akash', '184499232345sd', 'akash466@gmail.com45sd', '$2y$10$Yu.GX3U0cqa/7Qu9aZ1ARuLMGMtu9nbmkKhknYzSwFgZljrrzfPDS', 'akash', 'akash', '-', 1, '2023-06-22 12:07:05', '2023-06-22 12:07:05'),
(69, 'akash', 'akash', 'akash', '184499232345w', 'akash466@gmail.com45d', '$2y$10$fr.yn2A08rWqBoOMKHRDN.T.6GLIz8pQqj0ddJmCqNxKeUCkNWuaa', 'akash', 'akash', '-', 1, '2023-06-22 12:07:53', '2023-06-22 12:07:53'),
(70, 'akash', 'akash', 'akash', '1844992323451', 'akash466@gmail.com42', '$2y$10$JubYcLEdc1wPxxflD13lQeDZw5XgGgFcPlGylq54/Ubxn8cVVhMji', 'akash', 'akash', '-', 1, '2023-06-22 12:10:16', '2023-06-22 12:10:16'),
(71, 'akash', 'akash', 'akash', '184499232333', 'akash466@gmail.com1', '$2y$10$a2YlbsiHlOAM18Na.G1CmujJDl4LFViPS6q9.x7pP34WZ326VLueW', 'akash', 'akash', '-', 1, '2023-06-22 12:13:16', '2023-06-22 12:13:16'),
(72, 'akash', 'akash', 'akash', '184499232334', 'akash466@gmail.com14', '$2y$10$U8KvFzMxmJF8JT2w4D4Vle0bWrqdG4a.KF5cBdpia//fpaGQj.gCC', 'akash', 'akash', '-', 1, '2023-06-22 12:21:45', '2023-06-22 12:21:45'),
(75, 'hacktest', 'korbo', '-', '1844992322', 'hacktestkorbo1@gmail.com', '$2y$10$rP4HeV/b5wIYf2CfSoEhl.N8WcvnUnT1sWFMPAIv2mCP0FrY.Ww0q', '+880', 'sEVPAoYsD1gkvUARowdRBAreVA43', '-', 1, '2023-06-26 13:40:38', '2023-06-26 13:40:38'),
(76, 'hacktest q', 'korbo', '-', '1982255966', 'hacktestkorboq@gmail.com', '$2y$10$PFqNeBb4GUBNnEMJZPpN.udmW35UyUcXae0UEdrof1He18XccjDkS', '+880', '9tIqfoHfiATwx5gsOFD6RFjy1pz1', '-', 1, '2023-06-26 04:27:11', '2023-06-26 04:27:11'),
(77, 'hacktest', 'korbo', '-', '1982255967', 'hacktestkorbor@gmail.com', '$2y$10$q.HsiB854/EUMZ0L.uf7Pey.WZLyjEvZsbzGcJ1N7E/06iahYtnbW', '+880', 'tfeT4dInaGZzFHR8lG80qzleKAk2', '-', 1, '2023-06-26 12:35:50', '2023-06-26 12:35:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_admins_email_unique` (`email`);

--
-- Indexes for table `tbl_basic_setting`
--
ALTER TABLE `tbl_basic_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_code`
--
ALTER TABLE `tbl_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_country_code`
--
ALTER TABLE `tbl_country_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_notify_uid`
--
ALTER TABLE `tbl_notify_uid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pages_setting`
--
ALTER TABLE `tbl_pages_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_payment_setting`
--
ALTER TABLE `tbl_payment_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_prescription_order`
--
ALTER TABLE `tbl_prescription_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_product_0`
--
ALTER TABLE `tbl_product_0`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `tbl_product_2`
--
ALTER TABLE `tbl_product_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mobile` (`mobile`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=586;

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_basic_setting`
--
ALTER TABLE `tbl_basic_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_code`
--
ALTER TABLE `tbl_code`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_country_code`
--
ALTER TABLE `tbl_country_code`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_notification`
--
ALTER TABLE `tbl_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `tbl_notify_uid`
--
ALTER TABLE `tbl_notify_uid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `tbl_pages_setting`
--
ALTER TABLE `tbl_pages_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_payment_setting`
--
ALTER TABLE `tbl_payment_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_prescription_order`
--
ALTER TABLE `tbl_prescription_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbl_product_0`
--
ALTER TABLE `tbl_product_0`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `tbl_product_2`
--
ALTER TABLE `tbl_product_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
