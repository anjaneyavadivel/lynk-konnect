-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2022 at 08:19 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lynk_konnect_v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `latitude` int(11) DEFAULT NULL,
  `longitutude` int(11) DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_no2` varbinary(255) NOT NULL,
  `website` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `address`, `landmark`, `postcode`, `state_id`, `city_id`, `latitude`, `longitutude`, `contact_person`, `contact_no1`, `contact_no2`, `website`, `created_at`, `updated_at`) VALUES
(1, 'TravelsA', 'address', 'near bus', '645789', 4, NULL, NULL, NULL, 'suresh', '887001314', 0x3938393435343634, 'garlinfo.com', '2021-09-12 01:26:58', '2021-09-12 01:26:58'),
(2, 'TravelsB', 'address', 'near terminal', '654789', 4, NULL, NULL, NULL, 'subbbu', '7894561230', 0x313233343536373930, 'garlinfo.com', '2021-09-12 07:45:49', '2021-09-12 07:45:49'),
(3, 'TravelsC', 'address', 'near tea shop', '789852', 1, NULL, NULL, NULL, 'Ramesh', '4567891230', 0x33303132343536373839, 'garlcrm.com', '2021-09-12 07:46:29', '2021-09-12 07:46:29'),
(4, 'Lynk-Konnect-Company', 'address', 'near bakery', '789456', 22, NULL, NULL, NULL, 'MIke', '7894561230', 0x32333031343536373839, 'lynk-konnect.co.uk', '2021-09-12 07:57:20', '2021-09-12 07:57:20');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `description`, `flag`, `created_at`, `updated_at`) VALUES
(1, 'London', NULL, NULL, NULL, NULL),
(2, 'Northern Ireland', NULL, NULL, NULL, NULL),
(3, 'Scotland', NULL, NULL, NULL, NULL),
(4, 'Wales', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `badge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(4, '2021_05_26_113334_create_permission_tables', 1),
(5, '2021_05_26_125953_create_products_table', 1),
(6, '2021_06_08_111530_create_company_table', 1),
(7, '2021_06_12_115527_create_country_table', 1),
(8, '2021_06_12_120241_create_state_table', 1),
(9, '2021_06_12_120249_create_city_table', 1),
(10, '2021_06_20_171538_create_driver_table', 1),
(11, '2021_06_27_121022_create_trip_table', 1),
(12, '2021_06_30_103929_create_transaction_table', 1),
(13, '2021_07_20_163628_create_routes_table', 1),
(14, '2021_09_12_082746_create_stops_table', 2),
(15, '2016_06_01_000001_create_oauth_auth_codes_table', 3),
(16, '2016_06_01_000002_create_oauth_access_tokens_table', 3),
(17, '2016_06_01_000003_create_oauth_refresh_tokens_table', 3),
(18, '2016_06_01_000004_create_oauth_clients_table', 3),
(19, '2016_06_01_000005_create_oauth_personal_access_clients_table', 3),
(20, '2021_09_19_134208_create_projects_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, NULL, 'Lynk-Konnect Personal Access Client', 'HVfUkU4bCSKDXx8cp7fuc39OQefYqkDd6xchR4PD', NULL, 'http://localhost', 1, 0, 0, '2021-09-17 06:55:38', '2021-09-17 06:55:38'),
(2, NULL, 'Lynk-Konnect Password Grant Client', '4RoM8UUrIlWS9AtTGKWxcgb8JTCuEGFcT4SFEsPt', 'users', 'http://localhost', 0, 1, 0, '2021-09-17 06:55:38', '2021-09-17 06:55:38');

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
(1, 1, '2021-09-17 06:55:38', '2021-09-17 06:55:38');

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
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('test@mail.com', '$2y$10$ItGVA6QDad0WgkhaXnzLuu0HlV4BuinSUA5oeEFw5fI6P0hKHISB.', '2021-05-26 05:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2021-05-26 08:30:27', '2021-05-26 08:30:27'),
(2, 'role-create', 'web', '2021-05-26 08:30:27', '2021-05-26 08:30:27'),
(3, 'role-edit', 'web', '2021-05-26 08:30:27', '2021-05-26 08:30:27'),
(4, 'role-delete', 'web', '2021-05-26 08:30:27', '2021-05-26 08:30:27'),
(5, 'company-list', 'web', '2021-05-26 08:30:28', '2021-05-26 08:30:28'),
(6, 'company-create', 'web', '2021-05-26 08:30:28', '2021-05-26 08:30:28'),
(7, 'company-edit', 'web', '2021-05-26 08:30:28', '2021-05-26 08:30:28'),
(8, 'company-delete', 'web', '2021-05-26 08:30:28', '2021-05-26 08:30:28'),
(9, 'permission-list', 'web', '2021-06-07 11:18:37', '2021-06-07 11:23:38'),
(10, 'permission-create', 'web', NULL, NULL),
(11, 'permission-edit', 'web', NULL, NULL),
(12, 'permission-delete', 'web', NULL, NULL),
(13, 'trip-list', 'web', NULL, NULL),
(14, 'trip-list-own', 'web', NULL, NULL),
(15, 'trip-create', 'web', NULL, NULL),
(16, 'trip-edit', 'web', NULL, NULL),
(17, 'trip-delete', 'web', NULL, NULL),
(18, 'user-list', 'web', NULL, NULL),
(19, 'user-create', 'web', NULL, NULL),
(20, 'user-edit', 'web', NULL, NULL),
(21, 'user-delete', 'web', NULL, NULL),
(22, 'state-list', 'web', '2021-09-12 02:08:21', '2021-09-12 02:08:21'),
(23, 'state-create', 'web', '2021-09-12 02:08:28', '2021-09-12 02:08:28'),
(24, 'state-edit', 'web', '2021-09-12 02:08:35', '2021-09-12 02:08:35'),
(25, 'state-delete', 'web', '2021-09-12 02:08:43', '2021-09-12 02:08:43'),
(26, 'city-list', 'web', '2021-09-12 02:14:41', '2021-09-12 02:14:41'),
(27, 'city-create', 'web', '2021-09-12 02:14:48', '2021-09-12 02:14:48'),
(28, 'city-edit', 'web', '2021-09-12 02:14:53', '2021-09-12 02:14:53'),
(29, 'city-delete', 'web', '2021-09-12 02:14:59', '2021-09-12 02:14:59'),
(30, 'route-list', 'web', '2021-09-12 02:35:40', '2021-09-12 02:35:40'),
(31, 'route-create', 'web', '2021-09-12 02:35:45', '2021-09-12 02:35:45'),
(32, 'route-edit', 'web', '2021-09-12 02:35:54', '2021-09-12 02:35:54'),
(33, 'route-delete', 'web', '2021-09-12 02:36:01', '2021-09-12 02:36:01'),
(34, 'stop-list', 'web', '2021-09-12 02:36:48', '2021-09-12 02:36:48'),
(35, 'stop-create', 'web', '2021-09-12 02:36:54', '2021-09-12 02:36:54'),
(36, 'stop-edit', 'web', '2021-09-12 02:37:00', '2021-09-12 02:37:00'),
(37, 'stop-delete', 'web', '2021-09-12 02:37:06', '2021-09-12 02:37:06'),
(38, 'dashboard-admin', 'web', '2021-09-12 07:35:50', '2021-09-12 07:35:50'),
(39, 'dashboard-operator', 'web', '2021-09-12 07:35:58', '2021-09-12 07:35:58'),
(40, 'dashboard-driver', 'web', '2021-09-12 07:36:06', '2021-09-12 07:36:06');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', '2021-05-26 08:38:13', '2021-05-26 08:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `introduction` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Drivers', 'web', '2021-05-26 08:32:04', '2021-09-12 07:16:40'),
(2, 'Operators', 'web', '2021-06-02 10:40:22', '2021-09-12 07:16:10'),
(3, 'Lynk-Super_Admin', 'web', '2021-06-07 02:37:28', '2021-09-12 00:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 1),
(13, 2),
(13, 3),
(14, 1),
(14, 2),
(14, 3),
(15, 1),
(15, 2),
(15, 3),
(16, 1),
(16, 2),
(16, 3),
(17, 1),
(17, 2),
(17, 3),
(18, 2),
(18, 3),
(19, 2),
(19, 3),
(20, 2),
(20, 3),
(21, 2),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 3),
(37, 3),
(38, 1),
(38, 2),
(38, 3);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from_route_state_id` int(11) NOT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_route_city_id` int(11) DEFAULT NULL,
  `to_route_state_id` int(11) NOT NULL,
  `to_route_city_id` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `from_route_state_id`, `route_name`, `from_route_city_id`, `to_route_state_id`, `to_route_city_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bedfordshire To  Dorset', NULL, 11, NULL, 'Bedfordshire To  Dorset', '2022-04-18 10:51:07', '2022-04-18 10:51:07'),
(2, 49, 'Aberdeen City To East Renfrewshire', NULL, 60, NULL, 'Aberdeen City To East Renfrewshire', '2022-04-18 11:05:34', '2022-04-18 11:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `country_id`, `state_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bedfordshire', NULL, NULL, NULL),
(2, 1, 'Berkshire', NULL, NULL, NULL),
(3, 1, 'Bristol', NULL, NULL, NULL),
(4, 1, 'Buckinghamshire', NULL, NULL, NULL),
(5, 1, 'Cambridgeshire', NULL, NULL, NULL),
(6, 1, 'Cheshire', NULL, NULL, NULL),
(7, 1, 'Cornwall', NULL, NULL, NULL),
(8, 1, 'Cumbria', NULL, NULL, NULL),
(9, 1, 'Derbyshire', NULL, NULL, NULL),
(10, 1, 'Devon', NULL, NULL, NULL),
(11, 1, 'Dorset', NULL, NULL, NULL),
(12, 1, 'Durham', NULL, NULL, NULL),
(13, 1, 'Essex', NULL, NULL, NULL),
(14, 1, 'Gloucestershire', NULL, NULL, NULL),
(15, 1, 'Greater London', NULL, NULL, NULL),
(16, 1, 'Greater Manchester', NULL, NULL, NULL),
(17, 1, 'Hampshire', NULL, NULL, NULL),
(18, 1, 'Herefordshire', NULL, NULL, NULL),
(19, 1, 'Isle of Wight', NULL, NULL, NULL),
(20, 1, 'Kent', NULL, NULL, NULL),
(21, 1, 'Lancashire', NULL, NULL, NULL),
(22, 1, 'Leicestershire', NULL, NULL, NULL),
(23, 1, 'Lincolnshire', NULL, NULL, NULL),
(24, 1, 'Merseyside', NULL, NULL, NULL),
(25, 1, 'Norfolk', NULL, NULL, NULL),
(26, 1, 'Northamptonshire', NULL, NULL, NULL),
(27, 1, 'Northumberland', NULL, NULL, NULL),
(28, 1, 'Nottinghamshire', NULL, NULL, NULL),
(29, 1, 'Oxfordshire', NULL, NULL, NULL),
(30, 1, 'Rutland', NULL, NULL, NULL),
(31, 1, 'Shropshire', NULL, NULL, NULL),
(32, 1, 'Somerset', NULL, NULL, NULL),
(33, 1, 'Staffordshire', NULL, NULL, NULL),
(34, 1, 'Suffolk', NULL, NULL, NULL),
(35, 1, 'Surrey', NULL, NULL, NULL),
(36, 1, 'Sussex', NULL, NULL, NULL),
(37, 1, 'Tyne and Wear', NULL, NULL, NULL),
(38, 1, 'Warwickshire', NULL, NULL, NULL),
(39, 1, 'West Midlands', NULL, NULL, NULL),
(40, 1, 'Wiltshire', NULL, NULL, NULL),
(41, 1, 'Worcestershire', NULL, NULL, NULL),
(42, 1, 'Yorkshirev', NULL, NULL, NULL),
(43, 2, 'County Antrimv', NULL, NULL, NULL),
(44, 2, 'County Armagh', NULL, NULL, NULL),
(45, 2, 'County Down', NULL, NULL, NULL),
(46, 2, 'County Fermanagh', NULL, NULL, NULL),
(47, 2, 'County Londonderry', NULL, NULL, NULL),
(48, 2, 'County Tyrone', NULL, NULL, NULL),
(49, 3, 'Aberdeen City', NULL, NULL, NULL),
(50, 3, 'Aberdeenshire', NULL, NULL, NULL),
(51, 3, 'Angus', NULL, NULL, NULL),
(52, 3, 'Argyll and Bute', NULL, NULL, NULL),
(53, 3, 'City of Edinburgh', NULL, NULL, NULL),
(54, 3, 'Clackmannanshire', NULL, NULL, NULL),
(55, 3, 'Dumfries and Galloway', NULL, NULL, NULL),
(56, 3, 'Dundee City', NULL, NULL, NULL),
(57, 3, 'East Ayrshire', NULL, NULL, NULL),
(58, 3, 'East Dunbartonshire', NULL, NULL, NULL),
(59, 3, 'East Lothian', NULL, NULL, NULL),
(60, 3, 'East Renfrewshire', NULL, NULL, NULL),
(61, 3, 'Falkirk', NULL, NULL, NULL),
(62, 3, 'Fife', NULL, NULL, NULL),
(63, 3, 'Glasgow City', NULL, NULL, NULL),
(64, 3, 'Highland', NULL, NULL, NULL),
(65, 3, 'Inverclyde', NULL, NULL, NULL),
(66, 3, 'Midlothian', NULL, NULL, NULL),
(67, 3, 'Moray', NULL, NULL, NULL),
(68, 3, 'North Ayrshire', NULL, NULL, NULL),
(69, 3, 'North Lanarkshire', NULL, NULL, NULL),
(70, 3, 'Scottish Borders', NULL, NULL, NULL),
(71, 3, 'South Ayrshire', NULL, NULL, NULL),
(72, 3, 'South Lanarkshire', NULL, NULL, NULL),
(73, 3, 'Stirling', NULL, NULL, NULL),
(74, 3, 'West Dunbartonshire', NULL, NULL, NULL),
(75, 3, 'West Lothian', NULL, NULL, NULL),
(76, 4, 'Anglesey', NULL, NULL, NULL),
(77, 4, 'Carmarthenshire', NULL, NULL, NULL),
(78, 4, 'Ceredigion', NULL, NULL, NULL),
(79, 4, 'Conwy', NULL, NULL, NULL),
(80, 4, 'Denbighshire', NULL, NULL, NULL),
(81, 4, 'Flintshire', NULL, NULL, NULL),
(82, 4, 'Glamorgan', NULL, NULL, NULL),
(83, 4, 'Gwynedd', NULL, NULL, NULL),
(84, 4, 'Monmouthshire', NULL, NULL, NULL),
(85, 4, 'Pembrokeshire', NULL, NULL, NULL),
(86, 4, 'Powys', NULL, NULL, NULL),
(87, 4, 'Wrexham', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stops`
--

CREATE TABLE `stops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `route_id` int(11) NOT NULL,
  `stop_state_id` int(11) NOT NULL,
  `stop_city_id` int(11) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stops`
--

INSERT INTO `stops` (`id`, `route_id`, `stop_state_id`, `stop_city_id`, `position`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 1, NULL, '2022-04-18 10:55:01', NULL),
(2, 1, 2, NULL, 2, NULL, '2022-04-18 10:55:01', NULL),
(3, 1, 3, NULL, 3, NULL, '2022-04-18 10:55:01', NULL),
(4, 1, 4, NULL, 4, NULL, '2022-04-18 10:55:01', NULL),
(5, 1, 5, NULL, 5, NULL, '2022-04-18 10:55:01', NULL),
(6, 1, 6, NULL, 6, NULL, '2022-04-18 10:55:01', NULL),
(7, 1, 7, NULL, 7, NULL, '2022-04-18 10:55:01', NULL),
(8, 1, 8, NULL, 8, NULL, '2022-04-18 10:55:01', NULL),
(9, 1, 9, NULL, 9, NULL, '2022-04-18 10:55:01', NULL),
(10, 1, 10, NULL, 10, NULL, '2022-04-18 10:55:01', NULL),
(11, 1, 11, NULL, 11, NULL, '2022-04-18 10:55:01', NULL),
(12, 2, 49, NULL, 1, 'tesig', '2022-05-06 08:23:03', NULL),
(13, 2, 51, NULL, 2, 'tesig', '2022-05-06 08:23:03', NULL),
(14, 2, 52, NULL, 3, 'tesig', '2022-05-06 08:23:03', NULL),
(15, 2, 53, NULL, 4, 'tesig', '2022-05-06 08:23:03', NULL),
(16, 2, 54, NULL, 5, 'tesig', '2022-05-06 08:23:03', NULL),
(17, 2, 55, NULL, 6, 'tesig', '2022-05-06 08:23:03', NULL),
(18, 2, 56, NULL, 7, 'tesig', '2022-05-06 08:23:03', NULL),
(19, 2, 57, NULL, 8, 'tesig', '2022-05-06 08:23:03', NULL),
(20, 2, 58, NULL, 9, 'tesig', '2022-05-06 08:23:03', NULL),
(21, 2, 59, NULL, 10, 'tesig', '2022-05-06 08:23:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uniq_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trip`
--

CREATE TABLE `trip` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `trip_owner_user_id` int(11) NOT NULL,
  `trip_owner_company_id` int(11) NOT NULL,
  `from_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_state_id` int(11) NOT NULL,
  `from_city_id` int(11) DEFAULT NULL,
  `from_postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_state_id` int(11) NOT NULL,
  `to_city_id` int(11) DEFAULT NULL,
  `to_postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_trip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_of_passengers` int(11) NOT NULL,
  `trip_amount` bigint(20) DEFAULT NULL,
  `trip_confirm_user_id` int(11) DEFAULT NULL,
  `trip_confirm_company_id` int(11) DEFAULT NULL,
  `trip_status` int(11) DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `return_route_id` int(11) DEFAULT NULL,
  `trip_date` date DEFAULT NULL,
  `trip_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trip`
--

INSERT INTO `trip` (`id`, `trip_owner_user_id`, `trip_owner_company_id`, `from_address`, `from_state_id`, `from_city_id`, `from_postcode`, `to_address`, `to_state_id`, `to_city_id`, `to_postcode`, `description_trip`, `no_of_passengers`, `trip_amount`, `trip_confirm_user_id`, `trip_confirm_company_id`, `trip_status`, `route_id`, `return_route_id`, `trip_date`, `trip_time`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'Aberdeenshire', 50, NULL, '2222', 'Dundee City', 56, NULL, '3444', 'test trip', 2, 252, NULL, NULL, NULL, 0, 0, '2022-05-17', '00:30:00', '2022-05-06 08:27:11', '2022-05-06 08:27:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `users` (`id`, `company_id`, `fname`, `lname`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 4, 'Admin', NULL, 'admin@mail.com', NULL, '$2y$10$MpQGkQJGK6CRIOueezqR4ese6M872FWiapXdO5xjb5.PyZ.E55Vlm', NULL, '2021-05-26 08:32:04', '2021-09-12 01:27:34'),
(3, 1, 'testone', 'testone', 'test1@mail.com', NULL, '$2y$10$N.pxTAj9tEm9HRXyhC5ndOne/7YP5yfpYAF./V1PpD77fLveIBS9G', NULL, '2021-06-04 10:18:56', '2021-09-12 07:40:21'),
(4, 2, 'test', 'two', 'test2@mail.com', NULL, '$2y$10$y8U0SATWpn9bGZsTYUFMB.i04Y1bv.lp0NU0avP7ceQQvfVNi.Ymq', NULL, '2021-06-04 10:21:28', '2021-09-12 07:47:49'),
(5, 3, 'test', 'three', 'test3@mail.com', NULL, '$2y$10$Md.SRUP8IwpXJBjzWqUKx.bkR6zMlRv6s38lEJs2jVeo8ZyAJ3Fkq', NULL, '2021-06-05 01:45:34', '2021-09-12 07:53:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stops`
--
ALTER TABLE `stops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip`
--
ALTER TABLE `trip`
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
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `stops`
--
ALTER TABLE `stops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip`
--
ALTER TABLE `trip`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
