-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2022 at 10:03 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `description`, `order`, `created_at`, `updated_at`) VALUES
(1, 'banner 1', 1, '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(2, 'banner 2', 2, '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(3, 'banner 3', 3, '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(4, 'banner 4', 4, '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(5, 'banner 5', 5, '2022-05-31 14:23:01', '2022-05-31 14:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donors`
--

CREATE TABLE `blood_donors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `weight_in_kgs` int(10) UNSIGNED NOT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_unit` smallint(5) UNSIGNED NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `patient_age` smallint(5) UNSIGNED DEFAULT NULL,
  `hospital_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purpose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `external_app_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dieticians`
--

CREATE TABLE `dieticians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `degree` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diet_charts`
--

CREATE TABLE `diet_charts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diet_question_feedback_id` bigint(20) UNSIGNED NOT NULL,
  `dietician_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_upto` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diet_chart_items`
--

CREATE TABLE `diet_chart_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diet_chart_id` bigint(20) UNSIGNED NOT NULL,
  `slot` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_of_week` tinyint(4) NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diet_chart_templates`
--

CREATE TABLE `diet_chart_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dietician_id` bigint(20) UNSIGNED NOT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_upto` date DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diet_chart_template_items`
--

CREATE TABLE `diet_chart_template_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `diet_chart_template_id` bigint(20) UNSIGNED NOT NULL,
  `slot` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `day_of_week` tinyint(4) NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diet_question_feedbacks`
--

CREATE TABLE `diet_question_feedbacks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `question_set_id` bigint(20) UNSIGNED NOT NULL,
  `feedback` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`feedback`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No Name',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `airline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `use_for` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`use_for`)),
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint(20) UNSIGNED DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size_in_bytes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `model_type`, `model_id`, `path`, `filename`, `mime_type`, `size_in_bytes`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Banner', 1, '', '', '', '', NULL, '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(2, 'App\\Models\\Banner', 2, '', '', '', '', NULL, '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(3, 'App\\Models\\Banner', 3, '', '', '', '', NULL, '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(4, 'App\\Models\\Banner', 4, '', '', '', '', NULL, '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(5, 'App\\Models\\Banner', 5, '', '', '', '', NULL, '2022-05-31 14:23:01', '2022-05-31 14:23:01');

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
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(10, '2021_04_15_022903_create_customers_table', 1),
(11, '2021_05_20_105253_create_question_sets_table', 1),
(12, '2021_06_08_165343_create_foods_table', 1),
(13, '2021_06_13_124415_create_images_table', 1),
(14, '2021_06_19_061013_create_diet_question_feedbacks_table', 1),
(15, '2021_07_18_144003_create_diet_charts_table', 1),
(16, '2021_08_04_175819_create_diet_chart_items_table', 1),
(17, '2021_09_05_110812_create_diet_chart_templates_table', 1),
(18, '2021_09_05_112026_create_diet_chart_template_items_table', 1),
(19, '2021_09_11_105556_create_roles_table', 1),
(20, '2021_09_11_111143_create_user_role_table', 1),
(21, '2021_09_18_144138_add_status_field_in_users_table', 1),
(22, '2021_09_26_083414_create_dieticians_table', 1),
(23, '2021_09_26_135412_create_blood_donors_table', 1),
(24, '2021_09_26_153234_create_blood_requests_table', 1),
(25, '2021_10_07_150654_create_banners_table', 1),
(26, '2021_10_09_001241_create_opd_categories_table', 1),
(27, '2021_10_09_001322_create_opd_schedules_table', 1),
(28, '2021_10_16_183106_rename_mine_type_field_name_in_images_table', 1),
(29, '2022_05_17_161023_create_flights_table', 1),
(30, '2022_05_17_162154_create_doctors_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'eQZl1qk3NuCPdYiw3PeV9cTtRfkAG2FHaJeZVRGn', NULL, 'http://localhost', 1, 0, 0, '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(2, NULL, 'Laravel Password Grant Client', 'zORRwBvAXoavbWbDgWORDdUdGQApYz8pFRwsnogW', 'users', 'http://localhost', 0, 1, 0, '2022-05-31 14:23:01', '2022-05-31 14:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-05-31 14:23:01', '2022-05-31 14:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `opd_categories`
--

CREATE TABLE `opd_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `opd_categories`
--

INSERT INTO `opd_categories` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Cardiology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(2, 'Emergency and Critical Care', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(3, 'Gastroenterology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(4, 'General Medicine', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(5, 'Nephrology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(6, 'Neurology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(7, 'Ophthalmology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(8, 'Orthopaedics and Joint Replacement', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(9, 'Pathology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(10, 'Radiology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(11, 'Cardiac Surgery and CTVS', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(12, 'Dentistry', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(13, 'ENT', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(14, 'General and Laparoscopic Surgery', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(15, 'Interventional Cardiology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(16, 'Neuro and Spine Surgery', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(17, 'Obstetrics and Gynaecology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(18, 'Oral and Maxillofacial Surgery', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(19, 'Paediatrics', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(20, 'Pulmonology and Chest Medicine', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00'),
(21, 'Urology', 'deafult.jpg', '2020-12-31 18:30:00', '2020-12-31 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `opd_schedules`
--

CREATE TABLE `opd_schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `opd_category_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doctor_qualifications` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schedules` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`schedules`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `question_sets`
--

CREATE TABLE `question_sets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`)),
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_sets`
--

INSERT INTO `question_sets` (`id`, `details`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '[{\"label\":\"Demographic Details\",\"questions\":[{\"label\":\"Height (in cm)\",\"input_type\":\"custom_numeric\",\"required\":true,\"options\":[]},{\"label\":\"Weight (in kg)\",\"input_type\":\"custom_numeric\",\"required\":true,\"options\":[]}]},{\"label\":\"Life Style\\/ Health Condition\\/ Medical History\",\"questions\":[{\"label\":\"Do you Suffering from High Blood Pressure?\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Do you Suffering from Thyroid\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Polycystic Ovarian Disease (PCOD) [Women\\u2019s Only]\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Do you Suffering from Uric Acid\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Do you Suffering from Diabetes\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Mention Diabetes Level\",\"input_type\":\"text\",\"required\":false,\"options\":[]},{\"label\":\"Do you Suffering from Constipation \",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Do you Suffering from Sleeping Disorder\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Any Surgical Procedure Done before\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Mention that Surgery\",\"input_type\":\"text\",\"required\":false,\"options\":[]},{\"label\":\"Tobacco Consumption\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Alcohol Consumption\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Any Family Medical History\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Diabetes\",\"Kidney Disorder\",\"Heart Disease\"]},{\"label\":\"Your Level of Activity \",\"input_type\":\"option\",\"required\":true,\"options\":[\"Low\",\"Intermediate\",\"Active\",\"Very Active\"]},{\"label\":\"Your Food liking is aligned to which region\",\"input_type\":\"option\",\"required\":true,\"options\":[\"North Indian\",\"South Indian\",\"Bengali\",\"Others\"]}]},{\"label\":\"Diet Preference\",\"questions\":[{\"label\":\"Do you Have any Food Allergy\",\"input_type\":\"option\",\"required\":true,\"options\":[\"Yes\",\"No\"]},{\"label\":\"Do you Have any Food Allergy If Yes Mention that\",\"input_type\":\"option\",\"required\":false,\"options\":[\"Veg\",\"Non Veg\",\"Jain\"]}]}]', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(2, 'Dietitian', '2022-05-31 14:23:01', '2022-05-31 14:23:01'),
(3, 'User', '2022-05-31 14:23:01', '2022-05-31 14:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `country_code`, `phone_number`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Sabyasachi Ghosh', 'sg@nitcart.com', '91', '9051429969', '$2y$10$TTHoX/hi0YueryURch/yW.wyriRTwernSh1U.77omeceA66.JpVUy', NULL, NULL, '2022-05-31 14:23:01', '2022-05-31 14:23:01', 1),
(2, 'Deepak', 'deepak@gmail.com', '91', '7509356357', '$2y$10$4z7E/uBMU4.hRtsEqkutXufYYCkIpZGIZX1uxgw2Rqs/GLki2E1Q6', NULL, NULL, '2022-05-31 14:23:01', '2022-05-31 14:23:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_donors`
--
ALTER TABLE `blood_donors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blood_donors_name_index` (`name`),
  ADD KEY `blood_donors_blood_group_index` (`blood_group`),
  ADD KEY `blood_donors_email_index` (`email`),
  ADD KEY `blood_donors_mobile_number_index` (`mobile_number`),
  ADD KEY `blood_donors_pincode_index` (`pincode`),
  ADD KEY `blood_donors_state_index` (`state`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blood_requests_blood_group_index` (`blood_group`),
  ADD KEY `blood_requests_mobile_number_index` (`mobile_number`),
  ADD KEY `blood_requests_patient_name_index` (`patient_name`),
  ADD KEY `blood_requests_state_index` (`state`),
  ADD KEY `blood_requests_pincode_index` (`pincode`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_external_app_id_unique` (`external_app_id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`),
  ADD UNIQUE KEY `customers_phone_number_unique` (`phone_number`),
  ADD KEY `customers_country_code_index` (`country_code`);

--
-- Indexes for table `dieticians`
--
ALTER TABLE `dieticians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dieticians_user_id_foreign` (`user_id`);

--
-- Indexes for table `diet_charts`
--
ALTER TABLE `diet_charts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diet_charts_dietician_id_foreign` (`dietician_id`),
  ADD KEY `diet_charts_diet_question_feedback_id_foreign` (`diet_question_feedback_id`);

--
-- Indexes for table `diet_chart_items`
--
ALTER TABLE `diet_chart_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `diet_chart_items_diet_chart_id_slot_day_of_week_food_id_unique` (`diet_chart_id`,`slot`,`day_of_week`,`food_id`),
  ADD KEY `diet_chart_items_food_id_foreign` (`food_id`);

--
-- Indexes for table `diet_chart_templates`
--
ALTER TABLE `diet_chart_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diet_chart_templates_dietician_id_foreign` (`dietician_id`),
  ADD KEY `diet_chart_templates_name_index` (`name`);

--
-- Indexes for table `diet_chart_template_items`
--
ALTER TABLE `diet_chart_template_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `diet_chart_template_unique` (`diet_chart_template_id`,`slot`,`day_of_week`,`food_id`),
  ADD KEY `diet_chart_template_items_food_id_foreign` (`food_id`);

--
-- Indexes for table `diet_question_feedbacks`
--
ALTER TABLE `diet_question_feedbacks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diet_question_feedbacks_user_id_foreign` (`user_id`),
  ADD KEY `diet_question_feedbacks_question_set_id_foreign` (`question_set_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctors_email_unique` (`email`),
  ADD UNIQUE KEY `doctors_phone_number_unique` (`phone_number`),
  ADD KEY `doctors_country_code_index` (`country_code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `foods_name_unique` (`name`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `opd_categories`
--
ALTER TABLE `opd_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `opd_categories_name_unique` (`name`);

--
-- Indexes for table `opd_schedules`
--
ALTER TABLE `opd_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `opd_schedules_opd_category_id_foreign` (`opd_category_id`),
  ADD KEY `opd_schedules_doctor_name_index` (`doctor_name`),
  ADD KEY `opd_schedules_pincode_index` (`pincode`),
  ADD KEY `opd_schedules_state_index` (`state`),
  ADD KEY `opd_schedules_hospital_name_index` (`hospital_name`),
  ADD KEY `opd_schedules_contact_number_1_index` (`contact_number_1`),
  ADD KEY `opd_schedules_contact_number_2_index` (`contact_number_2`);

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
-- Indexes for table `question_sets`
--
ALTER TABLE `question_sets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD KEY `users_country_code_index` (`country_code`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD KEY `user_role_user_id_foreign` (`user_id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blood_donors`
--
ALTER TABLE `blood_donors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dieticians`
--
ALTER TABLE `dieticians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diet_charts`
--
ALTER TABLE `diet_charts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diet_chart_items`
--
ALTER TABLE `diet_chart_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diet_chart_templates`
--
ALTER TABLE `diet_chart_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diet_chart_template_items`
--
ALTER TABLE `diet_chart_template_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diet_question_feedbacks`
--
ALTER TABLE `diet_question_feedbacks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `opd_categories`
--
ALTER TABLE `opd_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `opd_schedules`
--
ALTER TABLE `opd_schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `question_sets`
--
ALTER TABLE `question_sets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dieticians`
--
ALTER TABLE `dieticians`
  ADD CONSTRAINT `dieticians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diet_charts`
--
ALTER TABLE `diet_charts`
  ADD CONSTRAINT `diet_charts_diet_question_feedback_id_foreign` FOREIGN KEY (`diet_question_feedback_id`) REFERENCES `diet_question_feedbacks` (`id`),
  ADD CONSTRAINT `diet_charts_dietician_id_foreign` FOREIGN KEY (`dietician_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `diet_chart_items`
--
ALTER TABLE `diet_chart_items`
  ADD CONSTRAINT `diet_chart_items_diet_chart_id_foreign` FOREIGN KEY (`diet_chart_id`) REFERENCES `diet_charts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diet_chart_items_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diet_chart_templates`
--
ALTER TABLE `diet_chart_templates`
  ADD CONSTRAINT `diet_chart_templates_dietician_id_foreign` FOREIGN KEY (`dietician_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diet_chart_template_items`
--
ALTER TABLE `diet_chart_template_items`
  ADD CONSTRAINT `diet_chart_template_items_diet_chart_template_id_foreign` FOREIGN KEY (`diet_chart_template_id`) REFERENCES `diet_chart_templates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `diet_chart_template_items_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `diet_question_feedbacks`
--
ALTER TABLE `diet_question_feedbacks`
  ADD CONSTRAINT `diet_question_feedbacks_question_set_id_foreign` FOREIGN KEY (`question_set_id`) REFERENCES `question_sets` (`id`),
  ADD CONSTRAINT `diet_question_feedbacks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `opd_schedules`
--
ALTER TABLE `opd_schedules`
  ADD CONSTRAINT `opd_schedules_opd_category_id_foreign` FOREIGN KEY (`opd_category_id`) REFERENCES `opd_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
