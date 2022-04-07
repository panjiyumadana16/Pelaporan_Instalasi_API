-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 24, 2022 at 10:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_pelaporan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_admin` char(5) NOT NULL COMMENT '(Generate No.Unik 5 Digit',
  `name` varchar(255) NOT NULL,
  `no_tlpn` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL COMMENT 'Aktif,\r\nNon Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `id_admin`, `name`, `no_tlpn`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ABC34', 'Syahroni Ahmad Maulana', '081876454123', 'Aktif', '2022-01-08 12:58:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '01', 'kesehatan', '2022-01-08 12:40:28', '2022-01-09 12:40:28'),
(2, '02', 'pemeritah', '2022-01-14 04:22:30', '2022-01-14 04:22:30'),
(3, '03', 'industry', '2022-01-08 12:40:28', '2022-01-09 12:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `components`
--

CREATE TABLE `components` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `components`
--

INSERT INTO `components` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, '01', 'ticketing', NULL, NULL),
(2, '02', 'caller', NULL, NULL),
(3, '03', 'digital signame', NULL, NULL),
(4, '04', 'hardware', NULL, NULL),
(5, '05', 'jaringan', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `installations`
--

CREATE TABLE `installations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `number_of_technicians` bigint(20) NOT NULL COMMENT 'banyak teknisi yang bertugas',
  `category_instansi` varchar(50) NOT NULL,
  `technician_id` bigint(20) NOT NULL COMMENT 'relation from technicians for leader',
  `date_instalation` date NOT NULL,
  `pic_name` varchar(255) DEFAULT NULL,
  `pic_phone` varchar(20) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 baru\r\n2 proses',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `installations`
--

INSERT INTO `installations` (`id`, `code`, `number_of_technicians`, `category_instansi`, `technician_id`, `date_instalation`, `pic_name`, `pic_phone`, `status`, `created_at`, `updated_at`) VALUES
(1, 'AA134', 3, 'pemerintahan', 12, '2022-01-08', NULL, NULL, 1, '2022-01-08 12:40:28', '2022-01-09 12:40:28'),
(3, '26567', 2, 'kesehatan', 5, '2022-03-24', NULL, NULL, 1, '2022-03-24 08:47:01', '2022-03-24 08:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_manager` char(5) NOT NULL COMMENT '(Generate No.Unik 5 Digit',
  `name` varchar(255) NOT NULL,
  `no_tlpn` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL COMMENT 'Aktif,\r\nNon Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `id_manager`, `name`, `no_tlpn`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ABC12', 'Ahmad Anton Firsmansyah', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `programmers`
--

CREATE TABLE `programmers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_programmer` char(5) NOT NULL COMMENT '(Generate No.Unik 5 Digit',
  `name` varchar(255) NOT NULL,
  `no_tlpn` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL COMMENT 'Aktif,\r\nNon Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programmers`
--

INSERT INTO `programmers` (`id`, `id_programmer`, `name`, `no_tlpn`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ABC@1', 'Syamsul Arifin Bianka', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `report_components`
--

CREATE TABLE `report_components` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) NOT NULL,
  `component_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_components`
--

INSERT INTO `report_components` (`id`, `report_id`, `component_id`, `created_at`, `updated_at`) VALUES
(4, 4, 2, '2022-03-24 15:19:10', '2022-03-24 15:19:10');

-- --------------------------------------------------------

--
-- Table structure for table `report_installations`
--

CREATE TABLE `report_installations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `installation_id` bigint(20) NOT NULL,
  `start_installation` datetime DEFAULT NULL,
  `start_training` datetime DEFAULT NULL,
  `complete_training` datetime DEFAULT NULL,
  `completed_installation` datetime DEFAULT NULL,
  `condition` text DEFAULT NULL,
  `problem` text DEFAULT NULL,
  `video` text DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '1 proses\r\n2 selesai',
  `anydesk_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_installations`
--

INSERT INTO `report_installations` (`id`, `installation_id`, `start_installation`, `start_training`, `complete_training`, `completed_installation`, `condition`, `problem`, `video`, `status`, `anydesk_id`, `created_at`, `updated_at`) VALUES
(4, 3, NULL, NULL, NULL, NULL, 'Hancur lebur maszzeh', NULL, 'ReportVideos/Iy9W2u1fPxABs1M5cC5EdtPkH2It4X7PxvY5WAje.mp4', 1, NULL, '2022-03-24 09:49:53', '2022-03-24 11:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `report_photos`
--

CREATE TABLE `report_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` bigint(20) NOT NULL,
  `photos` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report_photos`
--

INSERT INTO `report_photos` (`id`, `report_id`, `photos`, `created_at`, `updated_at`) VALUES
(1, 4, 'ReportPhotos/UAa5cb2pU3Dl8kuSjInrnF6fEP1JPIG4AC49p0Q2.png', '2022-03-24 15:30:11', '2022-03-24 15:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE `technicians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_technician` char(5) NOT NULL COMMENT '(Generate No.Unik 5 Digit',
  `name` varchar(255) NOT NULL,
  `no_tlpn` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL COMMENT 'Aktif,\r\nNon Aktif',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`id`, `id_technician`, `name`, `no_tlpn`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ABC44', 'Bagas Pratam Pramdya Hirmawan', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28'),
(2, 'ABC45', 'Bagas Madarian Hadi', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28'),
(3, 'ABC46', 'Jefri Al Berto', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28'),
(4, 'ABC47', 'Edward New gate', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28'),
(9, 'ABC48', 'Marshal D teach', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28'),
(10, 'ABC49', 'Marco Sirohige', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28'),
(11, 'ABC50', 'Monkey D Dragon', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28'),
(12, 'ABC51', 'Monkey D luffy', '081876454123', 'Aktif', '2022-01-08 12:40:28', '2022-01-09 12:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `technician_installations`
--

CREATE TABLE `technician_installations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tecnician_id` bigint(20) NOT NULL COMMENT 'relation from technicians for crew',
  `installation_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `technician_installations`
--

INSERT INTO `technician_installations` (`id`, `tecnician_id`, `installation_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, NULL, NULL),
(2, 6, 1, NULL, NULL),
(3, 7, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticketings`
--

CREATE TABLE `ticketings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `instance_name` varchar(50) NOT NULL COMMENT 'relation from instances',
  `address` text NOT NULL,
  `date_created` date DEFAULT NULL,
  `date_complete` date DEFAULT NULL,
  `no_ticketing` varchar(255) DEFAULT NULL,
  `component_id` bigint(20) NOT NULL,
  `problem` text DEFAULT NULL,
  `status` char(10) NOT NULL COMMENT 'Open , Proses , Pending , Close',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ticketings`
--

INSERT INTO `ticketings` (`id`, `instance_name`, `address`, `date_created`, `date_complete`, `no_ticketing`, `component_id`, `problem`, `status`, `created_at`, `updated_at`) VALUES
(1, 'pt abcd', 'malang', '2022-01-14', '2022-01-14', 'TKT-0001', 1, 'internet not connected', 'Open', '2022-01-08 12:40:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ticket_solves`
--

CREATE TABLE `ticket_solves` (
  `id` bigint(20) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `problem` text NOT NULL,
  `solving` text NOT NULL,
  `no_tikecting` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Administrator,\r\nAdmin,\r\nTeknisi,\r\nProgrammer,\r\nManager',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'Administrator', 'admin', 'admin@web_pelaporan.com', NULL, '$2y$10$MdyZHmEAGZhZwgPejnJmyuxTmnOQKVTxNY84Jpm/EWiiAuVIsbYa.', NULL, '2022-03-19 22:57:56', '2022-03-19 22:57:56');

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
-- Indexes for table `components`
--
ALTER TABLE `components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installations`
--
ALTER TABLE `installations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programmers`
--
ALTER TABLE `programmers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_components`
--
ALTER TABLE `report_components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_installations`
--
ALTER TABLE `report_installations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report_photos`
--
ALTER TABLE `report_photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technicians`
--
ALTER TABLE `technicians`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technician_installations`
--
ALTER TABLE `technician_installations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticketings`
--
ALTER TABLE `ticketings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_solves`
--
ALTER TABLE `ticket_solves`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `components`
--
ALTER TABLE `components`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `installations`
--
ALTER TABLE `installations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programmers`
--
ALTER TABLE `programmers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `report_components`
--
ALTER TABLE `report_components`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `report_installations`
--
ALTER TABLE `report_installations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `report_photos`
--
ALTER TABLE `report_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `technicians`
--
ALTER TABLE `technicians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `technician_installations`
--
ALTER TABLE `technician_installations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ticketings`
--
ALTER TABLE `ticketings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket_solves`
--
ALTER TABLE `ticket_solves`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
