-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 15, 2024 at 02:42 AM
-- Server version: 10.11.8-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u827858342_fraud_det`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `claim_date` varchar(255) DEFAULT NULL,
  `month_rec` varchar(255) DEFAULT NULL,
  `year_rec` varchar(255) DEFAULT NULL,
  `claim_type` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `source_document` varchar(255) DEFAULT NULL,
  `claim_reason` varchar(255) DEFAULT NULL,
  `no_claim` varchar(255) DEFAULT NULL,
  `no_certificate` varchar(255) DEFAULT NULL,
  `status_policy` varchar(255) DEFAULT NULL,
  `effective_date` varchar(255) DEFAULT NULL,
  `expired_date` varchar(255) DEFAULT NULL,
  `partner_distribution_chanel` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `holder_name` varchar(255) DEFAULT NULL,
  `insured_name` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `red_flag` varchar(255) DEFAULT NULL,
  `benefit_per_day` varchar(255) DEFAULT NULL,
  `benefit_amount` varchar(255) DEFAULT NULL,
  `claim_year` varchar(255) DEFAULT NULL,
  `age_of_policy` varchar(255) DEFAULT NULL,
  `event_date_from` varchar(255) DEFAULT NULL,
  `event_date_to` varchar(255) DEFAULT NULL,
  `date_of_death` varchar(255) DEFAULT NULL,
  `length_of_stay` varchar(255) DEFAULT NULL,
  `icu` varchar(255) DEFAULT NULL,
  `remaining_days_per_year_diare_dan_typhoid` varchar(255) DEFAULT NULL,
  `remaining_days_per_year` varchar(255) DEFAULT NULL,
  `exgratia` varchar(255) DEFAULT NULL,
  `dokumen_status` varchar(255) DEFAULT NULL,
  `doc_receive_date` varchar(255) DEFAULT NULL,
  `doc_complete_date` varchar(255) DEFAULT NULL,
  `information_complete_date` varchar(255) DEFAULT NULL,
  `prev_status` varchar(255) DEFAULT NULL,
  `claim_status` varchar(255) DEFAULT NULL,
  `reject_status` varchar(255) DEFAULT NULL,
  `claim_amount` bigint(20) DEFAULT NULL,
  `claim_amount_paid` bigint(20) DEFAULT NULL,
  `claim_amount_not_paid` bigint(20) DEFAULT NULL,
  `rop` varchar(255) DEFAULT NULL,
  `nilai_tunai` varchar(255) DEFAULT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `doctor_specialization` varchar(255) DEFAULT NULL,
  `diagnosis_1` varchar(255) DEFAULT NULL,
  `diagnosis_description` varchar(255) DEFAULT NULL,
  `diagnosis_2` varchar(255) DEFAULT NULL,
  `surgery_name` varchar(255) DEFAULT NULL,
  `age_pending` varchar(255) DEFAULT NULL,
  `aging_pending` varchar(255) DEFAULT NULL,
  `decision_date` varchar(255) DEFAULT NULL,
  `month_dec` varchar(255) DEFAULT NULL,
  `year_dec` varchar(255) DEFAULT NULL,
  `modified_by` varchar(255) DEFAULT NULL,
  `claimant_relation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(22, '2014_10_12_000000_create_users_table', 1),
(23, '2014_10_12_100000_create_password_resets_table', 1),
(24, '2019_08_19_000000_create_failed_jobs_table', 1),
(25, '2023_11_16_063621_create_files_table', 1),
(31, '2023_11_30_074339_create_data_table', 2),
(32, '2024_01_03_015125_create_scoring_table', 3),
(33, '2024_01_03_023310_drop_scoring_table', 4),
(34, '2024_01_03_023743_drop_table_scoring', 5),
(35, '2024_01_03_024342_create_scoring_table', 6),
(36, '2024_01_03_095931_drop_scoring_table', 7),
(37, '2024_01_03_100354_create_scoring_table', 8),
(38, '2024_01_08_074739_drop_scoring_table', 9),
(39, '2024_01_08_075247_create_scoring_table', 10),
(40, '2024_01_08_080827_drop_scoring_table', 11),
(41, '2024_01_08_081238_create_scoring_table', 12),
(42, '2024_02_21_025718_drop_scoring_table', 13),
(43, '2024_02_21_031358_drop_scoring_table', 14),
(44, '2024_02_21_031705_scoring_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scoring`
--

CREATE TABLE `scoring` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city_with_most_claim_amount` varchar(255) NOT NULL,
  `Highest_claim_amount` bigint(20) NOT NULL,
  `highest_diagnosis` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','member') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$KvlYWMgKWWGGQz2aHNVD4.F23pF.2KLFvXpklWrwIlTfmNNXdZIby', 'admin', '1706596750_Gentleman.jpg', NULL, '2024-01-26 00:44:11', '2024-02-21 23:52:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
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
-- Indexes for table `scoring`
--
ALTER TABLE `scoring`
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
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=668;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `scoring`
--
ALTER TABLE `scoring`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
