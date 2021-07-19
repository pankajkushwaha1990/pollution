-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2021 at 01:19 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pollution`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', 'admin@1234', '2021-06-08 09:57:46', '2021-06-08 05:10:57', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenure_from` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenure_to` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee_column` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `tenure_from`, `tenure_to`, `fee_column`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Red Large & Medium Scale', '04-01', '03-31', 'red_amount', '1', NULL, NULL),
(3, 'Orange', '10-01', '09-01', 'orange_amount', '1', NULL, NULL),
(4, 'Green', '01-01', '12-31', 'green_amount', '1', NULL, NULL),
(5, 'Red Small Scale Industry', '07-01', '06-30', 'red_amount', '1', NULL, NULL);

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
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenure_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_amount` int(255) NOT NULL,
  `end_amount` int(255) NOT NULL,
  `red_amount` int(255) NOT NULL,
  `orange_amount` int(255) NOT NULL,
  `green_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `tenure_id`, `start_amount`, `end_amount`, `red_amount`, `orange_amount`, `green_amount`, `created_at`, `updated_at`) VALUES
(10, '6', 0, 5, 1100, 700, '700', NULL, NULL),
(11, '6', 5, 10, 1400, 1100, '900', NULL, NULL),
(12, '6', 10, 25, 2200, 1800, '1400', NULL, NULL),
(13, '6', 25, 50, 3600, 2900, '2200', NULL, NULL),
(14, '6', 50, 75, 5400, 3600, '2900', NULL, NULL),
(15, '6', 75, 100, 7200, 5600, '4200', NULL, NULL),
(16, '6', 100, 200, 10800, 8400, '6400', NULL, NULL),
(17, '6', 200, 500, 14400, 10800, '8400', NULL, NULL),
(18, '6', 500, 1000, 21600, 18000, '10800', NULL, NULL),
(19, '6', 1000, 1500, 36000, 21000, '14400', NULL, NULL),
(20, '6', 1500, 2000, 42000, 24000, '18000', NULL, NULL),
(21, '6', 2000, 2500, 49200, 28800, '21600', NULL, NULL),
(22, '6', 2500, 3000, 56400, 36000, '24000', NULL, NULL),
(23, '6', 3000, 4000, 63600, 42000, '28800', NULL, NULL),
(24, '6', 4000, 5000, 72000, 56400, '42000', NULL, NULL),
(25, '6', 5000, 7500, 84000, 72000, '56400', NULL, NULL),
(26, '6', 7500, 10000, 105600, 84000, '72000', NULL, NULL),
(27, '6', 10000, 15000, 144000, 105600, '84000', NULL, NULL),
(28, '6', 15000, 20000, 216000, 144000, '105600', NULL, NULL),
(29, '6', 20000, 30000, 282000, 216000, '144000', NULL, NULL),
(30, '6', 30000, 40000, 360000, 282000, '216000', NULL, NULL),
(31, '6', 40000, 50000, 420000, 360000, '282000', NULL, NULL),
(32, '6', 50000, 100000, 564000, 420000, '360000', NULL, NULL),
(33, '6', 100000, 200000, 720000, 564000, '420000', NULL, NULL),
(34, '6', 200000, 500000, 1440000, 1080000, '720000', NULL, NULL),
(35, '6', 500000, 2147483647, 2880000, 2160000, '1440000', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE `industries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `industry_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `industry_category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `industry_scale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `industry_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`id`, `industry_name`, `address`, `mobile`, `email`, `longitude`, `latitude`, `industry_category`, `industry_scale`, `industry_type`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Nahar Sugar Mill', 'Testing Address', '1234567890', 'nahar@sugarmill.com', '200.300.400.500', '100.100.200.400', '1', 'large', '4117', '1', '2021-06-13 23:06:29', NULL);

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_13_143424_create_admins_table', 1),
(5, '2021_06_09_150303_create_industries_table', 2),
(6, '2021_06_09_152825_create_categories_table', 3),
(7, '2021_06_09_155730_create_tenures_table', 4),
(8, '2021_06_10_111317_create_fees_table', 5),
(9, '2021_06_19_071019_create_report_table', 6);

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
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `industry_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee_type` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `applied_on` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposited_fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deposited_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `final_fee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_ca` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_data` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `industry_id`, `fee_type`, `duration`, `applied_on`, `total_fee`, `deposited_fee`, `deposited_date`, `final_fee`, `current_ca`, `response_data`, `created_at`, `updated_at`) VALUES
(3, '3', 'fresh', '5', '2021-06-19', '3300', '500', '19/06/2021', '2800', '5', '{\"industry_name\":\"Nahar Sugar Mill\",\"industry_type\":\"Red Large & Medium Scale\",\"tenure_from\":\"01\\/April\",\"tenure_to\":\"31\\/March\",\"duration\":\"5\",\"industry_category\":\"Red\",\"applied_date\":\"19\\/06\\/2021\",\"table_details\":[{\"sr_no\":1,\"from_date\":\"19\\/06\\/2021\",\"to_date\":\"18\\/06\\/2022\",\"days\":365,\"ca_amount\":\"5\",\"cte_fees\":1100},{\"sr_no\":2,\"from_date\":\"19\\/06\\/2022\",\"to_date\":\"18\\/06\\/2023\",\"days\":365,\"ca_amount\":\"5\",\"cte_fees\":550},{\"sr_no\":3,\"from_date\":\"19\\/06\\/2023\",\"to_date\":\"18\\/06\\/2024\",\"days\":365,\"ca_amount\":\"5\",\"cte_fees\":550},{\"sr_no\":4,\"from_date\":\"19\\/06\\/2024\",\"to_date\":\"18\\/06\\/2025\",\"days\":365,\"ca_amount\":\"5\",\"cte_fees\":550},{\"sr_no\":5,\"from_date\":\"19\\/06\\/2025\",\"to_date\":\"18\\/06\\/2026\",\"days\":365,\"ca_amount\":\"5\",\"cte_fees\":550}],\"deposited_date\":\"19\\/06\\/2021\",\"deposited_amount\":\"500\",\"total_fee\":3300,\"final_fee\":2800}', '2021-06-19 05:39:49', NULL),
(4, '3', 'extension', '3', '2021-06-19', '2100', '500', '19/06/2021', '1600', '8', '{\"industry_name\":\"Nahar Sugar Mill\",\"industry_type\":\"Red Large & Medium Scale\",\"tenure_from\":\"01\\/April\",\"tenure_to\":\"31\\/March\",\"duration\":\"3\",\"industry_category\":\"Red\",\"applied_date\":\"19\\/06\\/2021\",\"table_details\":[{\"sr_no\":1,\"from_date\":\"19\\/06\\/2021\",\"to_date\":\"18\\/06\\/2022\",\"days\":365,\"ca_amount\":\"8\",\"cte_fees\":700},{\"sr_no\":2,\"from_date\":\"19\\/06\\/2022\",\"to_date\":\"18\\/06\\/2023\",\"days\":365,\"ca_amount\":\"8\",\"cte_fees\":700},{\"sr_no\":3,\"from_date\":\"19\\/06\\/2023\",\"to_date\":\"18\\/06\\/2024\",\"days\":365,\"ca_amount\":\"8\",\"cte_fees\":700}],\"deposited_date\":\"19\\/06\\/2021\",\"deposited_amount\":\"500\",\"total_fee\":2100,\"final_fee\":1600}', '2021-06-19 05:41:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenures`
--

CREATE TABLE `tenures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenures`
--

INSERT INTO `tenures` (`id`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, '0', '1994-10-09', NULL, NULL),
(2, '1994-10-10', '2004-09-30', NULL, NULL),
(3, '2004-10-01', '2009-10-21', NULL, NULL),
(4, '2009-10-22', '2013-07-17', NULL, NULL),
(5, '2013-07-18', '2018-10-28', NULL, NULL),
(6, '2018-10-29', '2035-01-01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industries`
--
ALTER TABLE `industries`
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
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenures`
--
ALTER TABLE `tenures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `industries`
--
ALTER TABLE `industries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tenures`
--
ALTER TABLE `tenures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
