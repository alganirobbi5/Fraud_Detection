-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 03, 2026 at 08:33 AM
-- Server version: 8.4.3
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fraud_detection`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` bigint UNSIGNED NOT NULL,
  `claim_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month_rec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_rec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claim_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claim_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_claim` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_policy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `effective_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expired_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `partner_distribution_chanel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `holder_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `insured_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `red_flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `benefit_per_day` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `benefit_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claim_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age_of_policy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_death` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `length_of_stay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_days_per_year_diare_dan_typhoid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remaining_days_per_year` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exgratia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_receive_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_complete_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `information_complete_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prev_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claim_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reject_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claim_amount` bigint DEFAULT NULL,
  `claim_amount_paid` bigint DEFAULT NULL,
  `claim_amount_not_paid` bigint DEFAULT NULL,
  `rop` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nilai_tunai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosis_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosis_description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `diagnosis_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surgery_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age_pending` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aging_pending` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `decision_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month_dec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_dec` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claimant_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2023_11_30_074339_create_data_table', 1),
(5, '2024_02_21_031705_scoring_table', 1);

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
-- Table structure for table `scoring`
--

CREATE TABLE `scoring` (
  `id` bigint UNSIGNED NOT NULL,
  `city_with_most_claim_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Highest_claim_amount` bigint NOT NULL,
  `highest_diagnosis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','member') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'member',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$c8wMRSF67oQ/R4SePL6iFefXgSbDW6pnjkXcJ8a4hZEHvWsuWilZa', 'admin', 'default.jpg', NULL, '2026-11-02 20:58:54', '2026-11-02 20:58:54');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scoring`
--
ALTER TABLE `scoring`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
