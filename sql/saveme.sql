-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 11:38 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saveme`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin@gmail.com', '$2y$10$CAggV5H4jCmw.Bkqt3HgWOpDF0dUn0KSqSFkQAdO1ERmNEm9T47zS', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `is_power_attorney` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`id`, `name`, `area`, `lat`, `lng`, `user_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(57, 'Allied Hospital', 'Faisalabad', NULL, NULL, 125, NULL, '2017-05-19 06:37:55', '2017-05-19 06:37:55'),
(58, 'Jinnah Hospital', 'Johar Town Lahore', NULL, NULL, 127, NULL, '2017-05-19 06:38:37', '2017-05-19 06:38:37'),
(62, 'Model Hospital', 'Lahore', NULL, NULL, 132, NULL, '2017-05-19 07:42:38', '2017-05-19 07:42:38'),
(64, 'CMH', 'M-2, Lahore, Punjab, Pakistan', 31.50964980000001, 74.24592159999997, 134, NULL, '2017-05-23 00:17:52', '2017-05-23 00:41:59'),
(67, 'Aziz Fatima', 'Gulistan Colony No. 1, Faisalabad, Punjab, Pakistan', 31.4398775, 73.10386360000007, 142, NULL, '2017-05-24 01:34:45', '2017-05-24 01:34:45'),
(91, 'Civil Hospital', 'Faisalabad, Punjab, Pakistan', 31.41871419999999, 73.07910730000003, 166, NULL, '2017-05-24 03:51:31', '2017-05-24 03:51:31');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_staffs`
--

CREATE TABLE `hospital_staffs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `hospital_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_image` text COLLATE utf8mb4_unicode_ci,
  `user_type` int(11) NOT NULL DEFAULT '1',
  `is_approved` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospital_staffs`
--

INSERT INTO `hospital_staffs` (`id`, `user_id`, `hospital_id`, `first_name`, `last_name`, `user_image`, `user_type`, `is_approved`, `created_at`, `updated_at`) VALUES
(61, 126, 57, 'allied1', 'Allied1', 'staff_images/159252757d8e39/Capture.PNG', 1, 1, '2017-05-19 06:38:22', '2017-05-24 01:27:53'),
(62, 128, 58, 'Jinnah1', 'Jinnah1', 'staff_images/1592528fcd3f4b/^2E41FCB0FAABB7BF5E346BAC48BCFD9CB505B933C529D603E2^pimgpsh_fullsize_distr.png', 2, 1, '2017-05-19 06:39:18', '2017-05-24 01:32:28'),
(65, 137, 57, 'allied2', 'allied2', 'staff_images/1592415841c7c9/Capture.PNG', 2, 1, '2017-05-23 05:38:41', '2017-05-23 05:57:08'),
(67, 141, 57, 'Allied3', 'Allied3', 'staff_images/1592528a56d34a/^2E41FCB0FAABB7BF5E346BAC48BCFD9CB505B933C529D603E2^pimgpsh_fullsize_distr.png', 2, 1, '2017-05-24 01:05:41', '2017-05-24 01:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `hospital_staff_documents`
--

CREATE TABLE `hospital_staff_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `staff_id` int(10) UNSIGNED NOT NULL,
  `document_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hospital_staff_documents`
--

INSERT INTO `hospital_staff_documents` (`id`, `staff_id`, `document_path`, `created_at`, `updated_at`) VALUES
(34, 61, '/staff/documents/15923da7e42482/Capture.PNG', NULL, NULL),
(42, 62, '/staff/documents/1592431b098516/download.jpg', NULL, NULL),
(48, 61, '/staff/documents/1592527f721540/Capture.PNG', NULL, NULL),
(52, 67, '/staff/documents/1592528a03ff84/5080386-nanga-parbat-mountain-wallpapers.jpg', NULL, NULL),
(53, 67, '/staff/documents/1592528a040342/Capture.PNG', NULL, NULL),
(54, 67, '/staff/documents/1592528a040615/download.jpg', NULL, NULL),
(55, 67, '/staff/documents/1592528b7a2f41/5080386-nanga-parbat-mountain-wallpapers.jpg', NULL, NULL),
(56, 62, '/staff/documents/1592528e368e13/Capture.PNG', NULL, NULL),
(58, 62, '/staff/documents/1592528f15a186/^2E41FCB0FAABB7BF5E346BAC48BCFD9CB505B933C529D603E2^pimgpsh_fullsize_distr.png', NULL, NULL),
(59, 62, '/staff/documents/1592528fcdceb5/download.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `insurances`
--

CREATE TABLE `insurances` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `carrier_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_documents`
--

CREATE TABLE `insurance_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `insurance_id` int(10) UNSIGNED NOT NULL,
  `document_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_documents`
--

CREATE TABLE `medical_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `document` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `doctor_id` int(11) NOT NULL DEFAULT '1',
  `illness_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `illness_detail` text COLLATE utf8mb4_unicode_ci,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_history_documents`
--

CREATE TABLE `medical_history_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `medical_history_id` int(10) UNSIGNED NOT NULL,
  `document_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(156, '2014_05_04_055533_create_admins_table', 1),
(157, '2014_10_12_000000_create_users_table', 1),
(158, '2014_10_12_100000_create_password_resets_table', 1),
(159, '2017_04_05_074248_create_medical_documents_table', 1),
(160, '2017_04_05_131532_create_emergency_contacts', 1),
(161, '2017_04_06_105733_create_insurance_table', 1),
(162, '2017_04_10_061404_create_medical_history_table', 1),
(163, '2017_04_10_132241_create_medical_history_documents_table', 1),
(164, '2017_04_27_093525_create_insurance_documents_table', 1),
(165, '2017_05_02_102620_create_power_of_attorney_table', 1),
(166, '2017_05_03_065621_create_reference_doctors_table', 1),
(167, '2017_05_04_101913_create_patient_will_table', 1),
(168, '2017_05_05_054521_create_patients_table', 1),
(169, '2017_05_05_070928_create_hospitals_table', 1),
(170, '2017_05_05_073118_create_hospital_staffs_table', 1),
(171, '2017_05_15_063324_create_hospital_staff_documents_table', 1),
(172, '2017_05_18_121318_create_hospital_staff_documents_table', 2),
(173, '2017_05_18_121711_create_hospital_staff_documents_table', 3);

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
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dl_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dnr` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fb_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_will`
--

CREATE TABLE `patient_will` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `document` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `power_of_attorney`
--

CREATE TABLE `power_of_attorney` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `emergency_contact_id` int(10) UNSIGNED NOT NULL,
  `document` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reference_doctors`
--

CREATE TABLE `reference_doctors` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT '0',
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `user_type`, `session_id`, `device_id`, `device_type`, `is_approved`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'superadmin@gmail.com', '$2y$10$CAggV5H4jCmw.Bkqt3HgWOpDF0dUn0KSqSFkQAdO1ERmNEm9T47zS', 3, '', NULL, NULL, 1, 'YpksBhynILkZWHn7LXZ8YeBdCCiNFodQkFdOCBFM3cy2xLg3mNeGPXBbI0Oo', NULL, NULL),
(125, 'allied@yahoo.com', '$2y$10$/KO9lEr3HDjiIQjxzTQ3EuUpSMRsby9BCRMvLtwPDl4c9WNk0nLUi', 4, '', NULL, NULL, 1, NULL, '2017-05-19 06:37:55', '2017-05-22 01:33:25'),
(126, 'allied1@gmail.com', '$2y$10$UIfS2d8CfzxZOtochRdc8eTuufh0KiBIkJETl0U8fe5EIHzmvUu.i', 1, '591ed92e338c6', NULL, NULL, 0, NULL, '2017-05-19 06:38:22', '2017-05-19 06:38:22'),
(127, 'jinnah@gmail.com', '$2y$10$TbS5SfOzaSgrefWmDANYYujaLRHJoGPbnA6c1kU0VD8QF7gn7ZGra', 4, '', NULL, NULL, 1, NULL, '2017-05-19 06:38:37', '2017-05-19 06:38:37'),
(128, 'jinnah1@gmail.com', '$2y$10$yWxp23yxAriE3Pce53d7POIFMGIQjCKYiFFuB7WnJ2orudIU4oGOW', 2, '591ed966ca6d1', NULL, NULL, 0, NULL, '2017-05-19 06:39:18', '2017-05-19 06:39:18'),
(132, 'model@gmail.com', '$2y$10$eitEPS7Z2EJF8/i4XAcOG./iK/lxTJ2K6U4foHMJmqFw/kZ/rDWha', 4, '', NULL, NULL, 0, NULL, '2017-05-19 07:42:38', '2017-05-19 07:45:58'),
(134, 'cmh@gmail.com', '$2y$10$HsHK24q9ho7rcr9musJReuVizozZ.XECJ9n35OFogng81BwkudjvO', 4, '', NULL, NULL, 1, NULL, '2017-05-23 00:17:52', '2017-05-23 00:17:52'),
(137, 'allied2@gmail.com', '$2y$10$vTEpEwOKeELD47ZJW6x0ve0AyQkY4A4ZAMqEmob9gAitdww55CK2q', 2, '592411311e8f9', NULL, NULL, 0, NULL, '2017-05-23 05:38:41', '2017-05-23 05:38:41'),
(141, 'allied3@gmail.com', '$2y$10$b/H2/u3jHEIqJaJqHnCWWeuwXifcTae7ugvoWOm5/H.COs.1RgKae', 2, '592522b567459', NULL, NULL, 0, NULL, '2017-05-24 01:05:41', '2017-05-24 01:05:41'),
(142, 'aziz@gmail.com', '$2y$10$yTWABQDr6f/UiYtr.IQSA.eOFb60JXtsp4bSyUFbAmkpunK3h2mry', 4, '', NULL, NULL, 1, NULL, '2017-05-24 01:34:44', '2017-05-24 01:34:44'),
(143, 'civil@gmail.com', '$2y$10$ZFLh.Pgct8JWOmPXX53Ec.0ohuEvFIS7vOw1OOX4Z1FU.Oq.yHBTC', 4, '', NULL, NULL, 0, NULL, '2017-05-24 02:05:40', '2017-05-24 02:05:40'),
(144, 'civil@gmail.com', '$2y$10$o7tHYhlZXha0IS9b7qdGs.HYTThPy3uQne25XutoNKLkwtPnIO5hC', 4, '', NULL, NULL, 0, NULL, '2017-05-24 02:25:59', '2017-05-24 02:25:59'),
(145, 'civil@gmail.com', '$2y$10$Ipo.1Ft550IvnXt6b5loWeI0sTj6G/bP0D/uqyUJ2LPgymC/F2Mza', 4, '', NULL, NULL, 0, NULL, '2017-05-24 02:47:55', '2017-05-24 02:47:55'),
(146, 'civil@gmail.com', '$2y$10$y5S2QcChJGUHOoD6rzrdpurD3ftm8uXUj3A5obbC2YSHGTwKwupXW', 4, '', NULL, NULL, 0, NULL, '2017-05-24 02:48:24', '2017-05-24 02:48:24'),
(147, 'civil@gmail.com', '$2y$10$ZxqhPrIHRWeywtXGYWeVn.OWCJPyZMOX.yTe6m4QOy0Qql78Zrx6S', 4, '', NULL, NULL, 0, NULL, '2017-05-24 02:49:32', '2017-05-24 02:49:32'),
(148, 'civil@gmail.com', '$2y$10$E0PDqmdzUlHY5BsRw12ePeAOFDPP0f/YvZZwA26.R2CgugV9HJtRu', 4, '', NULL, NULL, 0, NULL, '2017-05-24 02:49:54', '2017-05-24 02:49:54'),
(149, 'civil@gmail.com', '$2y$10$F.p4CEiEKGUUo7Ik6X2CqOeagoa6C9aN.KchBYwj1Ep1M95S3vYUW', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:31:51', '2017-05-24 03:31:51'),
(150, 'fafasfsafs', '$2y$10$NJZfTrzREHBuC9.q37/gPegXFrZ/SBE3DpbODBePWGFDDNM96Dtve', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:31:59', '2017-05-24 03:31:59'),
(151, 'fasfsafsafsaf', '$2y$10$qYTECcSEUji0o5bgt77oFuZwSDU6cJ1RJwTsEix7v7ucTeyLZ281y', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:32:52', '2017-05-24 03:32:52'),
(152, 'fasfasfsafsaf', '$2y$10$K3stAMem4VtqNh65oaQR3ewDMASFqldMLLyJTKUhicv0Ekp8uyosO', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:33:43', '2017-05-24 03:33:43'),
(153, 'fasfasfsafsaf', '$2y$10$sxMiGkXuMi28AtbS8vHATOO4ukSKcFuNHTy5vyNN2AtzUVh2hx79e', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:37:26', '2017-05-24 03:37:26'),
(154, 'fasfasfsafsaf', '$2y$10$p4fxJ23CAhojQQp9sSxMO.rVojjZj.aMTV7DJj21PIxJmIHSC42CW', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:38:02', '2017-05-24 03:38:02'),
(155, 'fasfasfsafsaf', '$2y$10$tvpyJqQ6rWbVIMrKZHAwVO7PvSygm.JAHTLC4YZtXR2jJup2LnVIi', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:39:00', '2017-05-24 03:39:00'),
(156, 'fasfasfsafsaf', '$2y$10$N5la4uFWm6Sck20MgE/CpuQ63NOwenC5IBglq10CLsPJM8JfxjaPu', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:39:11', '2017-05-24 03:39:11'),
(157, 'fasfasfsafsaf', '$2y$10$U7mOMRxNCn3JbZFN6Q5mxeDzj8kX0px5ZdVS1SleyEtw2jDADdD0q', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:39:29', '2017-05-24 03:39:29'),
(158, 'civil@gmail.com', '$2y$10$3HZ/q94X2Qt0Q0SM/Y0HHukCLBbx1TevBRN4rKIBv4cBFbfdSxXBW', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:41:28', '2017-05-24 03:41:28'),
(159, 'civil@gmail.com', '$2y$10$Atu6O6y3BU.qcmpUWsjmN.6zFdGtQaTcx7KFT8vJB.gqkoY6DrGa.', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:41:55', '2017-05-24 03:41:55'),
(160, 'civil@gmail.com', '$2y$10$GMuy8Mjbng9iofzWyFeaC.AcD9w6qKWO3xAWJ7NUsKZbjoKyLw/0S', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:42:13', '2017-05-24 03:42:13'),
(161, 'civil@gmail.com', '$2y$10$5wrSoNAJfzOnblpxtOhrA.qsCh6rZ7pxJy3BpnjNS7JiOLPdbyTD6', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:42:24', '2017-05-24 03:42:24'),
(162, 'civil@gmail.com', '$2y$10$xo3fifJavRauzQX/C6azceewMqtpnJeRfToPuKHMaMgpapE79ztBi', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:42:35', '2017-05-24 03:42:35'),
(163, 'civil@gmail.com', '$2y$10$9UJYt659XLyra/.BLimVjeHm.ou5/rElX6pkiou8rCz2K75qYRzQu', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:43:44', '2017-05-24 03:43:44'),
(164, 'civil@gmail.com', '$2y$10$1LeB/fbilQa1v3xnIVhON.DYu4Nta9to/H16lRJZ2bZPhaBSyz3zq', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:46:29', '2017-05-24 03:46:29'),
(165, 'fasfsfsaf', '$2y$10$dCOQHrBzutu0pp/1lgVeIOPqAIY9a/FuGgE5eWbZNiQZ9EPELR9zW', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:49:13', '2017-05-24 03:49:13'),
(166, 'civil@gmail.com', '$2y$10$OKOberNY/AKdMpX5ynFQ5Opj/xfgCMuzZ1GQMxo4ckXQ45xscwQFC', 4, '', NULL, NULL, 0, NULL, '2017-05-24 03:51:31', '2017-05-24 03:51:31');

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
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emergency_contacts_user_id_index` (`user_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospitals_user_id_index` (`user_id`);

--
-- Indexes for table `hospital_staffs`
--
ALTER TABLE `hospital_staffs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_staffs_user_id_index` (`user_id`),
  ADD KEY `hospital_staffs_hospital_id_index` (`hospital_id`);

--
-- Indexes for table `hospital_staff_documents`
--
ALTER TABLE `hospital_staff_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hospital_staff_documents_staff_id_index` (`staff_id`);

--
-- Indexes for table `insurances`
--
ALTER TABLE `insurances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insurances_user_id_index` (`user_id`);

--
-- Indexes for table `insurance_documents`
--
ALTER TABLE `insurance_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `insurance_documents_insurance_id_index` (`insurance_id`);

--
-- Indexes for table `medical_documents`
--
ALTER TABLE `medical_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_documents_user_id_index` (`user_id`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_history_user_id_index` (`user_id`);

--
-- Indexes for table `medical_history_documents`
--
ALTER TABLE `medical_history_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medical_history_documents_medical_history_id_index` (`medical_history_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patients_user_id_index` (`user_id`);

--
-- Indexes for table `patient_will`
--
ALTER TABLE `patient_will`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_will_user_id_index` (`user_id`);

--
-- Indexes for table `power_of_attorney`
--
ALTER TABLE `power_of_attorney`
  ADD PRIMARY KEY (`id`),
  ADD KEY `power_of_attorney_user_id_index` (`user_id`),
  ADD KEY `power_of_attorney_emergency_contact_id_index` (`emergency_contact_id`);

--
-- Indexes for table `reference_doctors`
--
ALTER TABLE `reference_doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reference_doctors_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `hospital_staffs`
--
ALTER TABLE `hospital_staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `hospital_staff_documents`
--
ALTER TABLE `hospital_staff_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `insurances`
--
ALTER TABLE `insurances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `insurance_documents`
--
ALTER TABLE `insurance_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medical_documents`
--
ALTER TABLE `medical_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `medical_history_documents`
--
ALTER TABLE `medical_history_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `patient_will`
--
ALTER TABLE `patient_will`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `power_of_attorney`
--
ALTER TABLE `power_of_attorney`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reference_doctors`
--
ALTER TABLE `reference_doctors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD CONSTRAINT `emergency_contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD CONSTRAINT `hospitals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hospital_staffs`
--
ALTER TABLE `hospital_staffs`
  ADD CONSTRAINT `hospital_staffs_hospital_id_foreign` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hospital_staffs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hospital_staff_documents`
--
ALTER TABLE `hospital_staff_documents`
  ADD CONSTRAINT `hospital_staff_documents_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `hospital_staffs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `insurances`
--
ALTER TABLE `insurances`
  ADD CONSTRAINT `insurances_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `insurance_documents`
--
ALTER TABLE `insurance_documents`
  ADD CONSTRAINT `insurance_documents_insurance_id_foreign` FOREIGN KEY (`insurance_id`) REFERENCES `insurances` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical_documents`
--
ALTER TABLE `medical_documents`
  ADD CONSTRAINT `medical_documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `medical_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `medical_history_documents`
--
ALTER TABLE `medical_history_documents`
  ADD CONSTRAINT `medical_history_documents_medical_history_id_foreign` FOREIGN KEY (`medical_history_id`) REFERENCES `medical_history` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_will`
--
ALTER TABLE `patient_will`
  ADD CONSTRAINT `patient_will_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `power_of_attorney`
--
ALTER TABLE `power_of_attorney`
  ADD CONSTRAINT `power_of_attorney_emergency_contact_id_foreign` FOREIGN KEY (`emergency_contact_id`) REFERENCES `emergency_contacts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `power_of_attorney_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reference_doctors`
--
ALTER TABLE `reference_doctors`
  ADD CONSTRAINT `reference_doctors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
