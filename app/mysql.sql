-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Sep 27, 2021 at 01:57 PM
-- Server version: 5.7.18
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms`
--
CREATE DATABASE IF NOT EXISTS `tms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tms`;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tms_keys`
--

CREATE TABLE `tms_keys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tms_keys`
--

INSERT INTO `tms_keys` (`id`, `name`, `created`, `created_by`) VALUES
(105, 'morning.greeting', '2021-09-27 12:03:45', 1),
(107, 'afternoon.greeting', '2021-09-26 17:24:45', 1),
(108, 'evening.greeting', '2021-09-26 17:25:01', 1),
(110, 'warning.label', '2021-09-26 17:27:13', 1),
(112, 'ok.label', '2021-09-26 17:27:18', 1),
(116, 'error.label', '2021-09-26 17:27:23', 1),
(117, 'save.label', '2021-09-26 17:27:36', 1),
(118, 'delete.label', '2021-09-26 17:27:42', 1),
(119, 'read.label', '2021-09-26 17:27:48', 1),
(120, 'title.text', '2021-09-26 17:28:52', 1),
(125, 'goodbye.text', '2021-09-26 17:05:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tms_languages`
--

CREATE TABLE `tms_languages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tms_languages`
--

INSERT INTO `tms_languages` (`id`, `name`, `iso`, `rtl`) VALUES
(10, 'English', 'en', 0),
(11, 'Spanish', 'es', 0),
(12, 'French', 'fr', 0),
(13, 'German', 'de', 0),
(14, 'Russian', 'ru', 0),
(15, 'Chinese', 'zh', 0),
(16, 'Japanese', 'ja', 0),
(17, 'Arabic', 'ar', 1),
(18, 'Azerbaijani', 'az', 1),
(19, 'Hebrew', 'he', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tms_translations`
--

CREATE TABLE `tms_translations` (
  `id` int(11) NOT NULL,
  `key_id` int(11) NOT NULL,
  `language_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tms_translations`
--

INSERT INTO `tms_translations` (`id`, `key_id`, `language_id`, `translation`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1003, 105, '11', 'buenos días', '2021-09-23 08:54:54', 1, NULL, NULL),
(1012, 105, '12', 'bonjour', '2021-09-23 22:14:09', 1, NULL, NULL),
(1013, 107, '10', 'good afternoon', '2021-09-23 22:18:07', 1, NULL, NULL),
(1014, 107, '11', 'buenas tardes', '2021-09-23 22:19:33', 1, NULL, NULL),
(1015, 108, '10', 'good evening', '2021-09-23 22:41:11', 1, '2021-09-25 09:21:52', 1),
(1016, 108, '11', 'buenas noches', '2021-09-24 07:44:06', 1, NULL, NULL),
(1019, 107, '12', 'bonsoir', '2021-09-24 08:00:58', 1, NULL, NULL),
(1020, 108, '12', 'bonne nuit', '2021-09-24 11:55:56', 1, NULL, NULL),
(1025, 108, '14', 'Добрый вечер', '2021-09-24 21:21:12', 1, '2021-09-27 13:40:25', 1),
(1026, 120, '10', 'Welcome', '2021-09-25 09:47:58', 1, NULL, NULL),
(1027, 120, '11', 'Bienvenidos', '2021-09-25 09:48:13', 1, NULL, NULL),
(1028, 120, '12', 'Bienvenue', '2021-09-25 09:48:59', 1, NULL, NULL),
(1029, 120, '13', 'Willkommen', '2021-09-25 09:49:52', 1, NULL, NULL),
(1030, 120, '14', 'Добро пожаловать', '2021-09-25 09:50:32', 1, NULL, NULL),
(1031, 120, '15', '歡迎', '2021-09-25 09:51:26', 1, NULL, NULL),
(1033, 120, '17', '\'ahlan bik', '2021-09-25 09:52:15', 1, NULL, NULL),
(1034, 120, '18', 'Xoş gəldiniz', '2021-09-25 09:53:03', 1, NULL, NULL),
(1035, 120, '19', 'ברוך הבא', '2021-09-25 09:53:47', 1, NULL, NULL),
(1037, 119, '11', 'leer', '2021-09-25 16:36:08', 1, '2021-09-27 12:37:32', 1),
(1040, 108, '13', 'guten Abend', '2021-09-25 19:18:13', 1, '2021-09-27 12:28:51', 1),
(1041, 119, '10', 'read', '2021-09-27 12:38:08', 1, NULL, NULL),
(1051, 105, '13', 'guten morgen', '2021-09-27 13:22:48', 1, NULL, NULL),
(1052, 105, '14', 'Доброе утро', '2021-09-27 13:23:18', 1, NULL, NULL),
(1053, 105, '15', '早上好', '2021-09-27 13:24:07', 1, NULL, NULL),
(1054, 105, '16', 'おはよう', '2021-09-27 13:24:28', 1, NULL, NULL),
(1055, 105, '17', 'صباح الخير', '2021-09-27 13:24:54', 1, NULL, NULL),
(1056, 105, '18', 'sabahınız xeyir', '2021-09-27 13:26:28', 1, NULL, NULL),
(1057, 105, '19', 'בוקר טוב', '2021-09-27 13:26:57', 1, NULL, NULL),
(1059, 119, '13', 'lesen', '2021-09-27 13:32:56', 1, NULL, NULL),
(1060, 119, '12', 'lire', '2021-09-27 13:33:16', 1, NULL, NULL),
(1061, 119, '14', 'читать', '2021-09-27 13:33:49', 1, NULL, NULL),
(1062, 119, '15', '讀', '2021-09-27 13:35:45', 1, NULL, NULL),
(1063, 119, '16', '読んだ', '2021-09-27 13:35:58', 1, NULL, NULL),
(1064, 119, '17', 'اقرأ', '2021-09-27 13:36:41', 1, NULL, NULL),
(1065, 119, '18', 'oxumaq', '2021-09-27 13:37:01', 1, NULL, NULL),
(1066, 119, '19', 'לקרוא', '2021-09-27 13:37:16', 1, NULL, NULL),
(1068, 105, '10', 'good morning', '2021-09-26 13:54:59', 1, '2021-09-27 11:55:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tms_users`
--

CREATE TABLE `tms_users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_write` tinyint(1) NOT NULL,
  `roles` json NOT NULL,
  `token` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tms_users`
--

INSERT INTO `tms_users` (`id`, `name`, `read_write`, `roles`, `token`, `created`) VALUES
(1, 'Juan Carlos', 1, '[\"ROLE_ADMIN\", \"ROLE_USER\"]', 'f38adcb5a9f6310cbac75bcab7f7844c', '2021-09-20 23:23:25'),
(2, 'Readonly user', 2, '[\"ROLE_USER\"]', '49dd891aaffc81b8c716b785c350fa83', '2021-09-20 22:57:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tms_keys`
--
ALTER TABLE `tms_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_566D1A35E237E06` (`name`);

--
-- Indexes for table `tms_languages`
--
ALTER TABLE `tms_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tms_translations`
--
ALTER TABLE `tms_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5C4AEB16D145533` (`key_id`);

--
-- Indexes for table `tms_users`
--
ALTER TABLE `tms_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F251117D5F37A13B` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tms_keys`
--
ALTER TABLE `tms_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `tms_languages`
--
ALTER TABLE `tms_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tms_translations`
--
ALTER TABLE `tms_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1069;

--
-- AUTO_INCREMENT for table `tms_users`
--
ALTER TABLE `tms_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tms_translations`
--
ALTER TABLE `tms_translations`
  ADD CONSTRAINT `FK_5C4AEB169D7AE398` FOREIGN KEY (`key_id`) REFERENCES `tms_keys` (`id`);
--
-- Database: `tms__test`
--
CREATE DATABASE IF NOT EXISTS `tms__test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tms__test`;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tms_keys`
--

CREATE TABLE `tms_keys` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tms_keys`
--

INSERT INTO `tms_keys` (`id`, `name`, `created`, `created_by`) VALUES
(105, 'morning.greeting', '2021-09-26 17:23:04', 1),
(107, 'afternoon.greeting', '2021-09-26 17:24:45', 1),
(108, 'evening.greeting', '2021-09-26 17:25:01', 1),
(109, 'welcome.label', '2021-09-26 17:27:08', 1),
(110, 'warning.label', '2021-09-26 17:27:13', 1),
(112, 'ok.label', '2021-09-26 17:27:18', 1),
(116, 'error.label', '2021-09-26 17:27:23', 1),
(117, 'save.label', '2021-09-26 17:27:36', 1),
(118, 'delete.label', '2021-09-26 17:27:42', 1),
(119, 'read.label', '2021-09-26 17:27:48', 1),
(120, 'title.text', '2021-09-26 17:28:52', 1),
(122, 'subtitle.text', '2021-09-26 17:28:47', 1),
(123, 'paragraph.text', '2021-09-26 17:29:02', 1),
(125, 'goodbye.text', '2021-09-26 17:05:33', 1),
(128, 'main.heading888', '2021-09-27 00:22:05', 1),
(129, 'TESTING MODE TITLE', '2021-09-27 08:03:14', 1),
(130, 'testing.name', '2021-09-27 08:12:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tms_languages`
--

CREATE TABLE `tms_languages` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rtl` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tms_languages`
--

INSERT INTO `tms_languages` (`id`, `name`, `iso`, `rtl`) VALUES
(10, 'English', 'en', 0),
(11, 'Spanish', 'es', 0),
(12, 'French', 'fr', 0),
(13, 'German', 'de', 0),
(14, 'Russian', 'ru', 0),
(15, 'Chinese', 'zh', 0),
(16, 'Japanese', 'ja', 0),
(17, 'Arabic', 'ar', 1),
(18, 'Azerbaijani', 'az', 1),
(19, 'Hebrew', 'he', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tms_translations`
--

CREATE TABLE `tms_translations` (
  `id` int(11) NOT NULL,
  `key_id` int(11) NOT NULL,
  `language_id` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tms_translations`
--

INSERT INTO `tms_translations` (`id`, `key_id`, `language_id`, `translation`, `created`, `created_by`, `updated`, `updated_by`) VALUES
(1003, 105, '11', 'título principal', '2021-09-23 08:54:54', 1, NULL, NULL),
(1004, 105, '10', 'título principal - raw', '2021-09-24 12:05:29', 1, '2021-09-24 21:11:43', 2),
(1012, 105, '12', 'título principal', '2021-09-23 22:14:09', 1, NULL, NULL),
(1013, 107, '10', 'título principal', '2021-09-23 22:18:07', 1, NULL, NULL),
(1014, 107, '11', 'título principal', '2021-09-23 22:19:33', 1, NULL, NULL),
(1015, 108, '10', 'заглавие+', '2021-09-23 22:41:11', 1, '2021-09-25 09:21:52', 2),
(1016, 108, '11', 'título principal', '2021-09-24 07:44:06', 1, NULL, NULL),
(1017, 109, '10', 'título principal', '2021-09-24 07:44:14', 1, NULL, NULL),
(1018, 109, '11', 'título principal - raw', '2021-09-24 07:58:12', 1, NULL, NULL),
(1019, 107, '12', 'título principal - raw', '2021-09-24 08:00:58', 1, NULL, NULL),
(1020, 108, '12', 'título principal - raw', '2021-09-24 11:55:56', 1, NULL, NULL),
(1021, 109, '12', 'título principal - raw', '2021-09-24 11:55:58', 1, NULL, NULL),
(1022, 110, '12', 'título principal - raw', '2021-09-24 11:55:59', 1, NULL, NULL),
(1023, 122, '12', 'título principal - raw', '2021-09-24 11:56:00', 1, NULL, NULL),
(1025, 108, '14', 'заглавие', '2021-09-24 21:21:12', 1, '2021-09-25 23:48:27', 2),
(1026, 120, '10', 'Welcome', '2021-09-25 09:47:58', 1, NULL, NULL),
(1027, 120, '11', 'Bienvenidos', '2021-09-25 09:48:13', 1, NULL, NULL),
(1028, 120, '12', 'Bienvenue', '2021-09-25 09:48:59', 1, NULL, NULL),
(1029, 120, '13', 'Willkommen', '2021-09-25 09:49:52', 1, NULL, NULL),
(1030, 120, '14', 'Добро пожаловать', '2021-09-25 09:50:32', 1, NULL, NULL),
(1031, 120, '15', '歡迎', '2021-09-25 09:51:26', 1, NULL, NULL),
(1033, 120, '17', '\'ahlan bik', '2021-09-25 09:52:15', 1, NULL, NULL),
(1034, 120, '18', 'Xoş gəldiniz', '2021-09-25 09:53:03', 1, NULL, NULL),
(1035, 120, '19', 'ברוך הבא', '2021-09-25 09:53:47', 1, NULL, NULL),
(1040, 108, '13', 'Überschrift', '2021-09-25 19:18:13', 1, '2021-09-25 23:47:02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tms_users`
--

CREATE TABLE `tms_users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_write` tinyint(1) NOT NULL,
  `roles` json NOT NULL,
  `token` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tms_users`
--

INSERT INTO `tms_users` (`id`, `name`, `read_write`, `roles`, `token`, `created`) VALUES
(1, 'Juan Carlos', 1, '[\"ROLE_ADMIN\", \"ROLE_USER\"]', 'f38adcb5a9f6310cbac75bcab7f7844c', '2021-09-20 23:23:25'),
(2, 'Readonly user', 1, '[\"ROLE_USER\"]', '49dd891aaffc81b8c716b785c350fa83', '2021-09-20 22:57:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `tms_keys`
--
ALTER TABLE `tms_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_566D1A35E237E06` (`name`);

--
-- Indexes for table `tms_languages`
--
ALTER TABLE `tms_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tms_translations`
--
ALTER TABLE `tms_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5C4AEB16D145533` (`key_id`);

--
-- Indexes for table `tms_users`
--
ALTER TABLE `tms_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_F251117D5F37A13B` (`token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tms_keys`
--
ALTER TABLE `tms_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `tms_languages`
--
ALTER TABLE `tms_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tms_translations`
--
ALTER TABLE `tms_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1041;

--
-- AUTO_INCREMENT for table `tms_users`
--
ALTER TABLE `tms_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tms_translations`
--
ALTER TABLE `tms_translations`
  ADD CONSTRAINT `FK_5C4AEB169D7AE398` FOREIGN KEY (`key_id`) REFERENCES `tms_keys` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
