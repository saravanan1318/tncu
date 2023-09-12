-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2023 at 04:45 AM
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
  `isdifferentlyabledfile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `iswidow` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iswidowfile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `isserviceman` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isservicemanfile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `divorcee` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `divorceefile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `refugee` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `refugeefile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `athlete` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `athletefile` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `parentsign` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_params`
--

INSERT INTO `student_params` (`id`, `user_id`, `arrn_number`, `fullname`, `gender`, `dob`, `age`, `mobile1`, `mobile2`, `aadhar`, `email`, `parent`, `religion`, `otherreligion`, `plotno`, `streetname`, `city`, `district`, `state`, `pincode`, `pplotno`, `pstreetname`, `pcity`, `pdistrict`, `pstate`, `ppincode`, `community`, `subcaste`, `Communityfile`, `isdifferentlyabled`, `isdifferentlyabledfile`, `iswidow`, `iswidowfile`, `isserviceman`, `isservicemanfile`, `divorcee`, `divorceefile`, `refugee`, `refugeefile`, `athlete`, `athletefile`, `tccertificatefile`, `slmedium`, `slnameinst`, `slYOP`, `asltotalmark`, `aslsecumark`, `aslpercentage`, `slgrade`, `slmarksheetfile`, `hsmedium`, `hsnameinst`, `hsYOP`, `ahstotalmark`, `ahssecumark`, `ahspercentage`, `hsgrade`, `hsmarksheetfile`, `ugmedium`, `ugnameinst`, `ugYOP`, `ugtotalmark`, `ugsecumark`, `ugpercentage`, `uggrade`, `ugmarksheetfile`, `bgmedium`, `bgnameinst`, `bgYOP`, `bgtotalmark`, `bgsecumark`, `bgpercentage`, `bggrade`, `bgmarksheetfile`, `icm`, `Amount`, `UploadImg`, `fcsign`, `parentsign`, `created_at`, `updated_at`) VALUES
(1, '37', '252023000001', 'saravanan', 'Male', '1995-03-13', '28', '9344678370', '7904514647', '965478655313', 'saravanan@gmail.com', 'test', 'Christian', NULL, '33', 'sadfyth', 'fdyjhsfdjh', 'khsgdfyjhk', 'ksdgjk', '600096', '33', 'sadfyth', 'fdyjhsfdjh', 'khsgdfyjhk', 'ksdgjk', '600096', 'BC - Backward Class', '', 'uploads/community/1693357664_37_delete.png', 'Yes', 'NA', 'Yes', 'uploads/isserviceman/1693357664_37_Capture001.png', 'Yes', 'uploads/isserviceman/1693357664_37_Capture001.png', 'Yes', 'uploads/divorcee/1693357664_37_Capture001.png', 'Yes', 'uploads/refugee/1693357664_37_Capture001.png', 'Yes', 'uploads/athlete/1693357664_37_Capture001.png', 'uploads/tccertificate/1693357664_37_Capture001.png', 'English', 'jeeva', '2010', '500', '341', '68.2', '10th', NULL, 'English', 'akt', '2012', '1200', '787', '65.58', '12th', NULL, 'English', 'vrs', '2016', NULL, NULL, NULL, '2nd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '25', '118', 'uploads/profile/1693357664_37_Capture001.png', 'uploads/fcsign/1693357664_37_Capture001.png', 'uploads/parentsign/1693357664_37_Capture001.png', '2023-08-29 19:37:44', '2023-08-29 19:37:44'),
(2, '38', '22023000002', 'daniel', 'Male', '2004-01-28', '19', '9646468486', '9848665153', '986656546531', 'asdarghd@gmail.com', 'asgdfhasf', 'Athiest', NULL, '44', 'dfsdf', 'sfsdf', 'sdfsdf', 'dsfsdf', '600000', '44', 'dfsdf', 'sfsdf', 'sdfsdf', 'dsfsdf', '600000', 'BC - Backward Class', '', 'uploads/community/1693360609_38_messages-3.jpg', 'Yes', 'uploads/isdifferentlyabledfile/1693360609_38_news-1.jpg', 'Yes', 'uploads/isserviceman/1693360610_38_news-2.jpg', 'Yes', 'uploads/isserviceman/1693360609_38_news-3.jpg', 'Yes', 'uploads/divorcee/1693360610_38_news-4.jpg', 'Yes', 'uploads/refugee/1693360610_38_news-5.jpg', 'Yes', 'uploads/athlete/1693360610_38_product-1.jpg', 'uploads/tccertificate/1693360610_38_product-2.jpg', 'English', 'sdfsd', '2000', '500', '311', '62.2', '1', NULL, 'English', 'sdfs', '2012', '1200', '767', '63.92', '2', NULL, 'English', 'dfsdf', '2016', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '118', 'uploads/profile/1693360610_38_messages-2.jpg', 'uploads/fcsign/1693360610_38_messages-3.jpg', 'uploads/parentsign/1693360610_38_card.jpg', '2023-08-29 20:26:50', '2023-08-29 20:26:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_params`
--
ALTER TABLE `student_params`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `student_params_user_id_unique` (`user_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `student_params`
--
ALTER TABLE `student_params`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
