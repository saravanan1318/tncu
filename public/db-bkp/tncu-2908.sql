-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2023 at 04:43 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tncu`
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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_200000_add_two_factor_columns_to_users_table', 2),
(6, '2023_08_01_010622_create_student_params', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mtr_icm`
--

CREATE TABLE `mtr_icm` (
  `id` int(11) NOT NULL,
  `icm_name` varchar(255) DEFAULT NULL,
  `status` int(12) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mtr_icm`
--

INSERT INTO `mtr_icm` (`id`, `icm_name`, `status`) VALUES
(1, 'Ramalingam ICM', 1),
(2, 'Dr.M.G.R, ICM', 1),
(3, 'Dharmapuri ICM', 1),
(4, 'Dindigul ICM', 1),
(5, 'Erode ICM', 1),
(6, 'Perarignar Anna ICM', 1),
(7, 'Pandianadu ICM', 1),
(8, 'Nagercoil ICM', 1),
(9, 'Namakkal ICM', 1),
(10, 'Nachiappa ICM', 1),
(11, 'Thiyagi Sankaralinganar ICM', 1),
(12, 'Sivagangai ICM', 1),
(13, 'Samiappa ICM', 1),
(14, 'Theni ICM', 1),
(15, 'Thiruvannamalai ICM', 1),
(16, 'Thiruvarur ICM', 1),
(17, 'M.D.K ICM', 1),
(18, 'Trichy ICM', 1),
(19, 'Vellore ICM', 1),
(20, 'Villupuram ICM', 1),
(21, 'Bargur ITI', 1),
(22, 'Pattukkottai ITI', 1),
(23, 'Lalgudi Polytechnic', 1),
(24, 'Lalgudi Polytechnic - ICM', 1),
(25, 'Chennai ICM', 1),
(26, 'Thoothukudi ICM', 1),
(27, 'Ramanathapuram ICM', 1),
(28, 'ACSTI -Madhavaram', 1),
(29, 'Pondicherry ICM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mtr_icm_subcentres`
--

CREATE TABLE `mtr_icm_subcentres` (
  `id` int(11) NOT NULL,
  `icm_id` varchar(255) DEFAULT NULL,
  `subcentre_name` varchar(255) DEFAULT NULL,
  `status` int(12) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mtr_icm_subcentres`
--

INSERT INTO `mtr_icm_subcentres` (`id`, `icm_id`, `subcentre_name`, `status`) VALUES
(1, '1', 'Coimbatore', 1),
(2, '1', 'Ooty', 1),
(3, '2', 'Cuddalore', 1),
(4, '3', 'Morappur', 1),
(5, '4', 'Dindigul', 1),
(6, '5', 'Erode', 1),
(7, '6', 'Kancheepuram', 1),
(8, '7', 'Madurai', 1),
(9, '8', 'Nagercoil', 1),
(10, '9', 'Namakkal', 1),
(11, '10', 'Salem', 1),
(12, '11', 'Sattur', 1),
(13, '12', 'Sivagangai', 1),
(14, '13', 'Thanjavur', 1),
(15, '14', 'Aundipatti', 1),
(16, '15', 'Thiruvannamalai', 1),
(17, '16', 'Thiruvarur', 1),
(18, '17', 'Tirunelveli', 1),
(19, '18', 'Trichy', 1),
(20, '18', 'Makkal Mandram', 1),
(21, '19', 'Vellore', 1),
(22, '20', 'Villupuram', 1),
(23, '21', 'Bargur', 1),
(24, '22', 'Pattukkottai', 1),
(25, '23', 'Lalgudi', 1),
(26, '24', 'Perambalur', 1),
(27, '25', 'Chennai', 1),
(28, '25', 'Teynampet', 1),
(29, '25', 'Redhills', 1),
(30, '26', 'Thoothukudi', 1),
(31, '27', 'Ramanathapuram', 1),
(32, '28', 'Chennai', 1),
(33, '29', 'Pudhuchery', 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `student_params`
--

CREATE TABLE `student_params` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arrn_number` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `religion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `otherreligion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plotno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `streetname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pplotno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pstreetname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdistrict` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pstate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ppincode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `community` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subcaste` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Communityfile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isdifferentlyabled` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typeofd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iswidow` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isserviceman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `divorcee` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `refugee` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `athlete` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tccertificatefile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slmedium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slnameinst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slYOP` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asltotalmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aslsecumark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aslpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slgrade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slmarksheetfile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hsmedium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hsnameinst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hsYOP` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ahstotalmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ahssecumark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ahspercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hsgrade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hsmarksheetfile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ugmedium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ugnameinst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ugYOP` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ugtotalmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ugsecumark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ugpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uggrade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ugmarksheetfile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgmedium` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgnameinst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgYOP` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgtotalmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgsecumark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgpercentage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bggrade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bgmarksheetfile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icm` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `UploadImg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fcsign` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `icm_id` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `state`, `email`, `role`, `icm_id`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `status_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ramalingam ICM', '9999999999', 'Tamilnadu', 'RamalingamICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(2, 'Dr.M.G.R, ICM', '9999999999', 'Tamilnadu', 'MGRICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(3, 'Dharmapuri ICM', '9999999999', 'Tamilnadu', 'DharmapuriICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(4, 'Dindigul ICM', '9999999999', 'Tamilnadu', 'DindigulICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(5, 'Erode ICM', '9999999999', 'Tamilnadu', 'ErodeICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(6, 'Perarignar Anna ICM', '9999999999', 'Tamilnadu', 'PerarignarAnnaICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(7, 'Pandianadu ICM', '9999999999', 'Tamilnadu', 'PandianaduICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(8, 'Nagercoil ICM', '9999999999', 'Tamilnadu', 'NagercoilICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(9, 'Namakkal ICM', '9999999999', 'Tamilnadu', 'NamakkalICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(10, 'Nachiappa ICM', '9999999999', 'Tamilnadu', 'NachiappaICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(11, 'Thiyagi Sankaralinganar ICM', '9999999999', 'Tamilnadu', 'ThiyagiSankaralinganarICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(12, 'Sivagangai ICM', '9999999999', 'Tamilnadu', 'SivagangaiICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(13, 'Samiappa ICM', '9999999999', 'Tamilnadu', 'SamiappaICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(14, 'Theni ICM', '9999999999', 'Tamilnadu', 'TheniICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(15, 'Thiruvannamalai ICM', '9999999999', 'Tamilnadu', 'ThiruvannamalaiICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(16, 'Thiruvarur ICM', '9999999999', 'Tamilnadu', 'ThiruvarurICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(17, 'M.D.K ICM', '9999999999', 'Tamilnadu', 'MDKICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(18, 'Trichy ICM', '9999999999', 'Tamilnadu', 'TrichyICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(19, 'Vellore ICM', '9999999999', 'Tamilnadu', 'VelloreICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(20, 'Villupuram ICM', '9999999999', 'Tamilnadu', 'VillupuramICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(21, 'Bargur ITI', '9999999999', 'Tamilnadu', 'BargurITI', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(22, 'Pattukkottai ITI', '9999999999', 'Tamilnadu', 'PattukkottaiITI', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(23, 'Lalgudi Polytechnic', '9999999999', 'Tamilnadu', 'LalgudiPolytechnic', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(24, 'Lalgudi Polytechnic - ICM', '9999999999', 'Tamilnadu', 'LalgudiPolytechnicICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(25, 'Chennai ICM', '9999999999', 'Tamilnadu', 'ChennaiICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(26, 'Thoothukudi ICM', '9999999999', 'Tamilnadu', 'ThoothukudiICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(27, 'Ramanathapuram ICM', '9999999999', 'Tamilnadu', 'RamanathapuramICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(28, 'ACSTI -Madhavaram', '9999999999', 'Tamilnadu', 'ACSTIMadhavaram', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00'),
(29, 'Pondicherry ICM', '9999999999', 'Tamilnadu', 'PondicherryICM', 2, 1, NULL, '$2y$10$xY4dzFMF8K4jrQd/ox1Pe.Bc5aCIQPDSlgW1NCdLYu5nMh70Z/rJW', NULL, NULL, NULL, 1, NULL, '2023-08-28 13:00:00', '2023-08-28 13:00:00');

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
-- Indexes for table `mtr_icm`
--
ALTER TABLE `mtr_icm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mtr_icm_subcentres`
--
ALTER TABLE `mtr_icm_subcentres`
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
-- Indexes for table `student_params`
--
ALTER TABLE `student_params`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `student_params_user_id_unique` (`user_id`) USING BTREE;

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mtr_icm`
--
ALTER TABLE `mtr_icm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `mtr_icm_subcentres`
--
ALTER TABLE `mtr_icm_subcentres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_params`
--
ALTER TABLE `student_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
