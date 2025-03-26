-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 07, 2018 at 05:07 AM
-- Server version: 10.0.27-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.26-2+ubuntu16.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `link_merge_admin_panel`
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
(1, 'superadmin@gmail.com', '$2y$10$ATVOESifK0UCf.sg9/mGZerPdH/GwDsM2du1gvHzKX5Q8esKD8K3u', NULL, NULL, NULL);

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
(1, 'codingpixel', 'lahore', NULL, NULL, 2, NULL, '2017-05-19 13:11:20', '2017-05-19 13:11:20'),
(8, 'CMH', 'M-2, Lahore, Punjab, Pakistan', 31.50964980000001, 74.24592159999997, 12, NULL, '2017-05-23 11:26:27', '2017-05-23 11:26:43'),
(9, 'Jinnah Hospital', 'Johar Town Lahore', NULL, NULL, 15, NULL, '2017-05-23 11:31:45', '2017-05-23 11:31:45'),
(10, 'asdas', 'asdasd', NULL, NULL, 16, NULL, '2017-05-23 12:05:51', '2017-05-23 12:05:51'),
(15, 'Aldre Silva', 'model town', NULL, NULL, 24, NULL, '2017-05-26 10:55:22', '2017-05-26 10:55:22'),
(16, 'new1', 'hospital', NULL, NULL, 26, NULL, '2017-05-26 11:26:39', '2017-05-26 11:26:39');

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
(4, 14, 8, 'Cmh1', 'cmh1', 'staff_images/159254a0d231b8/Capture.PNG', 2, 1, '2017-05-23 11:30:15', '2017-05-24 08:53:33'),
(5, 18, 9, 'jinnah1', 'jinnah1', 'staff_images/159251486b6467/download.jpg', 2, 1, '2017-05-24 05:05:10', '2017-05-24 05:05:10'),
(6, 19, 8, 'Gulab', 'khan', 'staff_images/1592517a79dfc0/Awesome_small.png', 2, 1, '2017-05-24 05:14:10', '2017-05-24 05:48:50'),
(7, 25, 1, 'new', 'hospital', 'staff_images/159280faa355bd/Screenshot_6.png', 1, 1, '2017-05-26 11:21:14', '2017-05-26 11:21:56');

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
(7, 4, '/staff/documents/159241d47b6df6/Capture.PNG', NULL, NULL),
(9, 5, '/staff/documents/159251486b6ade/download.jpg', NULL, NULL),
(11, 6, '/staff/documents/1592517a79ea2d/n.txt', NULL, NULL),
(12, 4, '/staff/documents/159254a135e6dd/Capture.PNG', NULL, NULL),
(13, 7, '/staff/documents/159280faa35cde/Screenshot_6.png', NULL, NULL);

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
(1, '2014_05_04_055533_create_admins_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2017_04_05_074248_create_medical_documents_table', 1),
(5, '2017_04_05_131532_create_emergency_contacts', 1),
(6, '2017_04_06_105733_create_insurance_table', 1),
(7, '2017_04_10_061404_create_medical_history_table', 1),
(8, '2017_04_10_132241_create_medical_history_documents_table', 1),
(9, '2017_04_27_093525_create_insurance_documents_table', 1),
(10, '2017_05_02_102620_create_power_of_attorney_table', 1),
(11, '2017_05_03_065621_create_reference_doctors_table', 1),
(12, '2017_05_04_101913_create_patient_will_table', 1),
(13, '2017_05_05_054521_create_patients_table', 1),
(14, '2017_05_05_070928_create_hospitals_table', 1),
(15, '2017_05_05_073118_create_hospital_staffs_table', 1),
(16, '2017_05_18_121711_create_hospital_staff_documents_table', 1);

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
(1, 'superadmin@gmail.com', '$2y$10$ATVOESifK0UCf.sg9/mGZerPdH/GwDsM2du1gvHzKX5Q8esKD8K3u', 3, '', NULL, NULL, 1, 'ERXnQezf0fc3lsbLgG4zpfHDg0hkmuGTdbmSGTKYrb4nPqtzo4ToyokiGsdc', NULL, NULL),
(2, 'test1@test.com', '$2y$10$bPRTRAMhf/FlWtLOMYdSbeM5Of/rYikBHFD6XGveBn51V1GpEepS2', 4, '', NULL, NULL, 1, NULL, '2017-05-19 13:11:20', '2017-05-23 11:49:03'),
(12, 'cmh@gmail.com', '$2y$10$z2dgxC9rYpnp3CxOIM7CouSjIZz5yBhBvtW7KIVzv5h3Z4v7K0TH2', 4, '', NULL, NULL, 1, NULL, '2017-05-23 11:26:27', '2017-05-23 11:26:27'),
(14, 'cmh1@gmail.com', '$2y$10$VpWzy6wPus76QdRfhzv/x.qktC77EV1s5K4LFvb6NFSngMBwA/ZGe', 2, '59241d47b5f7b', NULL, NULL, 0, NULL, '2017-05-23 11:30:15', '2017-05-23 11:30:15'),
(15, 'jinnah@gmail.com', '$2y$10$amHXcZtGMNWnJMnbngH9Qex3i5wTjtxJ0L5Iv3zuQkdMIwrYtWpiK', 4, '', NULL, NULL, 0, NULL, '2017-05-23 11:31:45', '2017-05-23 11:31:45'),
(16, 'test@test.com', '$2y$10$aPkvTlF.RoV5Hv4utAwBru1HA5/1HnTWxdKTiCTsV6GT0EK1f20Au', 4, '', NULL, NULL, 1, NULL, '2017-05-23 12:05:51', '2017-05-23 12:05:51'),
(18, 'jinnah1@gmail.com', '$2y$10$rsFoaU1ZkZ8meaESI.vSs.28VknhubV.7kHRz5gePMNsGKtoqLJ5W', 2, '59251486b5c7d', NULL, NULL, 0, NULL, '2017-05-24 05:05:10', '2017-05-24 05:05:10'),
(19, 'gulab@devi.com', '$2y$10$db3BqldRR0AaWKKmIr.Us.lb2hpYyNuAo4mL0YMFdhENS1qr733O6', 2, '592516a2a35b6', NULL, NULL, 0, NULL, '2017-05-24 05:14:10', '2017-05-24 05:14:10'),
(20, 'national@gmail.com', '$2y$10$I1Sf10ktai9PRxNLyU7fk.Asm60yRYmHdWjem8qiSP3T/4wKSsU8e', 4, '', NULL, NULL, 0, NULL, '2017-05-24 08:59:28', '2017-05-24 08:59:28'),
(21, 'ali@gmail.com', '$2y$10$BNrcACseOaDiYMOmEEpwvei9P9KmIa2cmgrFlNgbKIiPT4a0O3hpO', 4, '', NULL, NULL, 0, NULL, '2017-05-24 10:07:14', '2017-05-24 10:07:14'),
(23, 'john@doe.com', '$2y$10$CvRtLmGbv98sfwbZzwu.cuGzZNNOjiYVMOsUR06BD1v5UuM60O4Om', 1, '5928073fc0ab2', NULL, NULL, 0, NULL, '2017-05-26 10:45:19', '2017-05-26 10:45:19'),
(24, 'Aldre@silva.com', '$2y$10$hV0faDKGPk8XnHYWAx5pwuhvQWXh.opofno47vswCrdq70N3j4FEW', 4, '', NULL, NULL, 1, NULL, '2017-05-26 10:55:22', '2017-05-26 11:23:54'),
(25, 'newhospital@gmail.com', '$2y$10$jL0t7AeuyfBVg8nT3c/F1uBGFZNTrnXg08XLarKP1aQGVp7BEICp2', 1, '59280faa34dc2', NULL, NULL, 0, NULL, '2017-05-26 11:21:14', '2017-05-26 11:21:14'),
(26, 'new1hospital@gmail.com', '$2y$10$ip8jPFV7kPWZ5NpJC42NOetFK5v43BKF9Jt5RsncqvGx1vk6t0Dx.', 4, '', NULL, NULL, 1, NULL, '2017-05-26 11:26:39', '2017-05-26 11:32:04');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `hospital_staffs`
--
ALTER TABLE `hospital_staffs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `hospital_staff_documents`
--
ALTER TABLE `hospital_staff_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
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
