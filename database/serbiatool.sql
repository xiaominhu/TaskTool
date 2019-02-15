-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2019 at 03:56 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serbiatool`
--

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `chlorine` tinyint(1) DEFAULT NULL,
  `ph` tinyint(1) DEFAULT NULL,
  `total_alkalinity` tinyint(1) DEFAULT NULL,
  `salt` tinyint(1) DEFAULT NULL,
  `other` tinyint(1) DEFAULT NULL,
  `serviced_comments` text,
  `pool_comments` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `chlorine_action_taken` varchar(512) DEFAULT NULL,
  `ph_action_taken` varchar(512) DEFAULT NULL,
  `total_alkalinity_action_taken` varchar(512) DEFAULT NULL,
  `stabilizer` tinyint(1) DEFAULT NULL,
  `stabilizer_action_taken` varchar(512) DEFAULT NULL,
  `salt_action_taken` varchar(512) DEFAULT NULL,
  `other_action_taken` varchar(512) DEFAULT NULL,
  `sign` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`id`, `task_id`, `chlorine`, `ph`, `total_alkalinity`, `salt`, `other`, `serviced_comments`, `pool_comments`, `created_at`, `updated_at`, `chlorine_action_taken`, `ph_action_taken`, `total_alkalinity_action_taken`, `stabilizer`, `stabilizer_action_taken`, `salt_action_taken`, `other_action_taken`, `sign`) VALUES
(1, 1, 0, 1, NULL, NULL, NULL, NULL, 'dddddd', '2019-01-25 10:49:54', '2019-01-27 01:18:13', NULL, 'Jddd', NULL, NULL, NULL, NULL, NULL, 3),
(2, 2, 1, 1, NULL, NULL, 1, 'w', 'w', '2019-01-25 11:09:43', '2019-01-27 02:11:38', NULL, 'sdf', NULL, NULL, NULL, NULL, 'Hello world', 6),
(3, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-25 11:11:07', '2019-01-27 02:30:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 0, 1, NULL, NULL, NULL, NULL, 'sdsddds', '2019-01-25 11:11:24', '2019-01-27 01:19:09', NULL, 'DFD', NULL, NULL, NULL, NULL, NULL, 5),
(5, 7, 1, NULL, NULL, NULL, NULL, NULL, NULL, '2019-01-30 03:06:33', '2019-01-30 03:06:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5),
(6, 8, 1, 0, NULL, NULL, NULL, 'Very good', 'You are right.', '2019-01-30 03:11:28', '2019-01-31 01:58:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `maintenancesign`
--

CREATE TABLE `maintenancesign` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `color` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenancesign`
--

INSERT INTO `maintenancesign` (`id`, `title`, `color`, `created_at`, `updated_at`) VALUES
(3, 'BW3', '#8baf47', '2019-01-25 10:26:03', '2019-01-25 10:26:03'),
(5, 'BW1', '#cc3bcb', '2019-01-25 10:28:13', '2019-01-25 10:28:13'),
(6, 'BW4', '#cb0552', '2019-01-27 02:08:27', '2019-01-27 02:08:27');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_check`
--

CREATE TABLE `maintenance_check` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `property` varchar(32) NOT NULL,
  `property_value` varchar(32) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance_check`
--

INSERT INTO `maintenance_check` (`id`, `task_id`, `property`, `property_value`, `deleted`, `created_at`, `updated_at`) VALUES
(1, 1, 'equipment', 'salt_chlorinator_system', 0, '2019-01-25 10:49:54', '2019-01-27 02:10:59'),
(2, 1, 'equipment', 'pool_light', 0, '2019-01-25 10:49:54', '2019-01-27 02:10:59'),
(3, 1, 'poolowner', 'clean', 0, '2019-01-25 10:49:54', '2019-01-27 02:10:59'),
(4, 1, 'poolowner', 'waterto', 0, '2019-01-25 10:49:54', '2019-01-27 02:10:59'),
(5, 2, 'equipment', 'pump', 0, '2019-01-27 01:23:22', '2019-01-27 02:11:38'),
(6, 2, 'equipment', 'filter', 1, '2019-01-27 01:23:22', '2019-01-27 02:11:38'),
(7, 2, 'poolowner', 'clean', 0, '2019-01-27 01:34:49', '2019-01-27 02:11:38'),
(8, 2, 'poolowner', 'waterto', 1, '2019-01-27 01:34:49', '2019-01-27 02:11:38'),
(9, 2, 'poolowner', 'waterfrom', 0, '2019-01-27 01:35:32', '2019-01-27 02:11:38'),
(10, 3, 'equipment', 'pool_light', 0, '2019-01-27 02:30:52', '2019-01-27 02:37:42'),
(11, 3, 'equipment', 'spa_light', 0, '2019-01-27 02:30:52', '2019-01-27 02:37:42'),
(12, 8, 'equipment', 'heater', 0, '2019-01-30 03:11:28', '2019-01-31 01:58:32'),
(13, 8, 'equipment', 'heat_pump', 0, '2019-01-30 03:11:28', '2019-01-31 01:58:32'),
(14, 8, 'poolowner', 'clean', 0, '2019-01-31 01:58:32', '2019-01-31 01:58:32'),
(15, 8, 'poolowner', 'waterto', 0, '2019-01-31 01:58:33', '2019-01-31 01:58:33');

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_week`
--

CREATE TABLE `maintenance_week` (
  `id` int(11) NOT NULL,
  `employee` int(11) NOT NULL,
  `week` enum('1','2','3','4','5','6','7') NOT NULL,
  `rows` int(11) NOT NULL DEFAULT '1',
  `start_date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `maintenance_week`
--

INSERT INTO `maintenance_week` (`id`, `employee`, `week`, `rows`, `start_date`, `created_at`, `updated_at`) VALUES
(2, 3, '5', 10, '2019-01-21', '2019-01-25 02:59:21', '2019-01-27 02:45:18'),
(4, 3, '5', 12, '2019-01-28', '2019-01-30 03:06:12', '2019-01-30 03:06:12');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

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
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `job_description` text,
  `complited` tinyint(1) DEFAULT NULL,
  `billed` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `comments` text,
  `instructions` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `task_id`, `job_description`, `complited`, `billed`, `created_at`, `updated_at`, `comments`, `instructions`) VALUES
(1, 5, 'Test1', 1, 0, '2019-01-25 23:43:05', '2019-01-26 00:37:07', 'Hello world3', 'You are right.2'),
(2, 6, 'I do want to see this.\r\nIf you hire me I will do my best.\r\nThanks.', 1, 0, '2019-01-28 23:03:45', '2019-01-30 03:04:44', 'OK.\r\nHere are things what to do.', 'Yes. How are things with you.\r\nVery funny.');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `employee` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` enum('0','1') NOT NULL,
  `client` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `time` time NOT NULL,
  `maintenance_week_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `status`, `date`, `employee`, `created_at`, `updated_at`, `type`, `client`, `deleted`, `time`, `maintenance_week_id`) VALUES
(1, '0', '2019-01-22', 3, '2019-01-25 10:49:54', '2019-01-25 10:49:54', '0', 4, 0, '01:00:00', 2),
(2, '0', '2019-01-22', 3, '2019-01-25 11:09:43', '2019-01-25 11:09:43', '0', 4, 0, '01:00:00', 2),
(3, '0', '2019-01-25', 3, '2019-01-25 11:11:07', '2019-01-27 02:37:42', '0', 4, 0, '01:30:00', 2),
(4, '0', '2019-01-22', 3, '2019-01-25 11:11:24', '2019-01-25 11:11:24', '0', 6, 0, '01:00:00', 2),
(5, '1', '2019-01-25', 3, '2019-01-25 23:43:05', '2019-01-26 00:37:07', '1', 4, 0, '00:45:00', 4),
(6, '1', '2019-01-29', 3, '2019-01-28 23:03:45', '2019-01-30 03:04:44', '1', 4, 0, '01:00:00', 4),
(7, '0', '2019-01-30', 3, '2019-01-30 03:06:33', '2019-01-30 03:06:33', '0', 4, 0, '01:00:00', 4),
(8, '1', '2019-01-29', 3, '2019-01-30 03:11:28', '2019-01-31 01:58:33', '0', 4, 0, '00:45:00', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `usertype` enum('0','10','20') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `last_name` varchar(191) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `usertype`, `deleted`, `last_name`, `phone`, `company`, `address`, `color`) VALUES
(1, 'JinHui', 'shinegoldmaster@hotmail.com', '$2y$10$rwzbWxNQnF.29JdId/nvyekKaKS5/qMBE2cL8Ww0u.GC1eYlT2FAK', '3L0vqtoqo3CbAYStdqPTOJEg6haGD1ZkAJxTXCYqE3BSF2sVNAHSRwLme7Fv', '2019-01-17 15:14:34', '2019-01-17 15:14:34', '20', 0, '', NULL, NULL, NULL, NULL),
(3, 'John', 'admin@wifoot.ht', '$2y$10$g4dRGc5Ltj.mlS0ACVwH/.GCiCIEYkRqvaxk2ri/WmMFiGGfQbZWi', '8LsTPKZBwxGOdUcdY3nUoVydU0ZmdBbytfpddYhETQluEhNcn69PL2XkJvVn', '2019-01-17 18:58:29', '2019-01-21 15:52:59', '10', 0, 'Still', '123456789', NULL, NULL, NULL),
(4, 'Chen', 'cr3884489@gmail.com', '$2y$10$JfMIqQblw0kFOFmVUvTveOJc0WXFKbogJ5Pmfl/1juHDn1B7eI2q6', NULL, '2019-01-18 09:20:51', '2019-01-24 18:14:14', '0', 0, 'Jie', '123456789', 'self', 'Lao, sh-1, Liaoning, China', '#ba138b'),
(5, 'Merry', 'neilhuer@gmail.com', '$2y$10$bPuA0iN60J/KdwyEpeBG6.Ge7ZTJ8s5V4Z1HudhcBboG3VuBPC1lC', NULL, '2019-01-23 03:17:36', '2019-01-23 03:17:36', '10', 0, 'Steve', '998989992', NULL, NULL, NULL),
(6, 'James', 'whitebear@hotmail.com', '$2y$10$PKnI3NE0HXf7cckxh4Z5Q.58pAdQDdKyV7UOwJ4eyNOlfQer89Qlq', NULL, '2019-01-24 18:17:42', '2019-01-24 18:17:42', '0', 0, 'Bond', '334556673', 'KMP@LTD', 'Lao, 33, sh-1, Liaoning, China', '#36a864');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenancesign`
--
ALTER TABLE `maintenancesign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_check`
--
ALTER TABLE `maintenance_check`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_week`
--
ALTER TABLE `maintenance_week`
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
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT for table `maintenance`
--
ALTER TABLE `maintenance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `maintenancesign`
--
ALTER TABLE `maintenancesign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `maintenance_check`
--
ALTER TABLE `maintenance_check`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `maintenance_week`
--
ALTER TABLE `maintenance_week`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
