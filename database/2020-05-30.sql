-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2020 at 11:24 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fiverr_test_18`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_id`, `subject_type`, `causer_id`, `causer_type`, `properties`, `created_at`, `updated_at`) VALUES
(1, 'posts', 'created', 1, 'Modules\\Article\\Entities\\Post', 5, 'App\\Models\\User', '{\"attributes\":{\"name\":\"Chamara\",\"intro\":\"intro 1234\",\"content\":\"<p>hello world 123<\\/p>\\r\\n\\r\\n<h1>Hay guys<\\/h1>\",\"type\":\"Article\",\"category_id\":1,\"category_name\":\"Test\",\"is_featured\":1,\"meta_title\":\"Chamara\",\"meta_keywords\":null,\"meta_description\":null,\"published_at\":\"2020-05-28T06:42:51.000000Z\",\"moderated_at\":null,\"moderated_by\":null,\"status\":1,\"created_by_alias\":null}}', '2020-05-28 07:12:52', '2020-05-28 07:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `order` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `order`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test', 'test', 'test category description', NULL, 1, 1, 1, NULL, '2020-05-28 05:36:08', '2020-05-28 05:36:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `commentable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `commentable_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `moderated_by` int(10) UNSIGNED DEFAULT NULL,
  `moderated_at` datetime DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobposts`
--

CREATE TABLE `jobposts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jobtitle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jobdescription` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_og_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_og_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `moderated_by` int(10) UNSIGNED DEFAULT NULL,
  `moderated_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_alias` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobposts`
--

INSERT INTO `jobposts` (`id`, `jobtitle`, `jobdescription`, `intro`, `content`, `type`, `category_name`, `meta_title`, `meta_keywords`, `meta_description`, `meta_og_image`, `meta_og_url`, `status`, `moderated_by`, `moderated_at`, `created_by`, `created_by_name`, `created_by_alias`, `updated_by`, `deleted_by`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'test title', 'test description', 'this is introduction', 'this is content', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'codeNET', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-05-27 19:28:19', '2020-05-27 19:28:19', NULL),
(3, 'Edited Code GEN International', NULL, 'intructiobdsfk sdf', '<h1>VEGA Innovation 1234</h1>\r\n\r\n<p>codegen internation <em>ABCD</em></p>\r\n\r\n<p><strong>Helooo</strong></p>', 'Article', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'CMB Job', NULL, NULL, NULL, NULL, '2020-05-27 19:34:41', '2020-05-27 20:08:18', NULL),
(4, 'new Vacancies', NULL, 'This is a golden opportunity', '<blockquote>\r\n<p>Hay there, this is a offer from CodeGen Pvt Ltd.</p>\r\n</blockquote>\r\n\r\n<p>This is awasome.</p>', 'Permanent', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'Super Admin', NULL, NULL, NULL, NULL, '2020-05-28 15:23:28', '2020-05-28 15:23:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobresponses`
--

CREATE TABLE `jobresponses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jobposts_id` bigint(20) UNSIGNED NOT NULL,
  `users_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `users_cv` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users_firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `users_lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `reviewed_by` int(10) UNSIGNED DEFAULT NULL,
  `reviewed_by_name` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobresponses`
--

INSERT INTO `jobresponses` (`id`, `jobposts_id`, `users_email`, `users_cv`, `users_firstname`, `users_lastname`, `status`, `reviewed_by`, `reviewed_by_name`, `created_at`, `updated_at`) VALUES
(1, 3, 'cmbuni2@gmail.com', '/storage/cvs/test1.pdf', 'namal', 'kumara', 2, NULL, NULL, '2020-05-29 01:05:00', '2020-05-30 09:29:54'),
(2, 4, 'test@123.com', 'aaaa.pdf', 'tharindu', 'shan', 0, NULL, NULL, '2020-05-30 03:38:00', '2020-05-30 03:38:00'),
(3, 3, 'cmbuni2@gmail.com', '3', 'shavi', 'wick', 0, NULL, NULL, '2020-05-30 09:20:45', '2020-05-30 09:20:45'),
(4, 3, 'chamara@123.com', 'storage/uploadedcv/chamara@123.com-3.pdf', 'praven', 'chamal', 0, NULL, NULL, '2020-05-30 09:23:18', '2020-05-30 09:23:18');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `custom_properties` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `responsive_images` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 9, 'users', 'ea90e808b83da220f355c588b255e565', 'ea90e808b83da220f355c588b255e565.jpg', 'image/jpeg', 'public', 612029, '[]', '[]', '[]', 1, '2020-05-29 11:22:16', '2020-05-29 11:22:16');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_03_11_062135_create_posts_table', 1),
(4, '2018_03_12_062135_create_categories_table', 1),
(5, '2019_08_19_000000_create_failed_jobs_table', 1),
(6, '2020_02_19_152418_create_permission_tables', 1),
(7, '2020_02_19_164911_create_media_table', 1),
(8, '2020_02_19_173115_create_activity_log_table', 1),
(9, '2020_02_19_173641_create_settings_table', 1),
(10, '2020_02_19_173700_create_userprofiles_table', 1),
(11, '2020_02_19_173711_create_notifications_table', 1),
(12, '2020_02_22_115918_create_user_providers_table', 1),
(13, '2020_05_01_163442_create_tags_table', 1),
(14, '2020_05_01_163833_create_polymorphic_taggables_table', 1),
(15, '2020_05_04_151517_create_comments_table', 1),
(16, '2020_05_27_164643_create_jobposts_table', 2),
(17, '2020_05_29_175144_create_jobresponses_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 8),
(4, 'App\\Models\\User', 4),
(4, 'App\\Models\\User', 5),
(4, 'App\\Models\\User', 9),
(5, 'App\\Models\\User', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'view_backend', 'web', '2020-05-26 16:08:53', '2020-05-26 16:08:53'),
(2, 'edit_settings', 'web', '2020-05-26 16:08:53', '2020-05-26 16:08:53'),
(3, 'view_logs', 'web', '2020-05-26 16:08:53', '2020-05-26 16:08:53'),
(4, 'view_users', 'web', '2020-05-26 16:08:53', '2020-05-26 16:08:53'),
(5, 'add_users', 'web', '2020-05-26 16:08:53', '2020-05-26 16:08:53'),
(6, 'edit_users', 'web', '2020-05-26 16:08:54', '2020-05-26 16:08:54'),
(7, 'delete_users', 'web', '2020-05-26 16:08:54', '2020-05-26 16:08:54'),
(8, 'restore_users', 'web', '2020-05-26 16:08:54', '2020-05-26 16:08:54'),
(9, 'block_users', 'web', '2020-05-26 16:08:54', '2020-05-26 16:08:54'),
(10, 'view_roles', 'web', '2020-05-26 16:08:54', '2020-05-26 16:08:54'),
(11, 'add_roles', 'web', '2020-05-26 16:08:54', '2020-05-26 16:08:54'),
(12, 'edit_roles', 'web', '2020-05-26 16:08:54', '2020-05-26 16:08:54'),
(13, 'delete_roles', 'web', '2020-05-26 16:08:54', '2020-05-26 16:08:54'),
(14, 'restore_roles', 'web', '2020-05-26 16:08:55', '2020-05-26 16:08:55'),
(15, 'view_backups', 'web', '2020-05-26 16:08:55', '2020-05-26 16:08:55'),
(16, 'add_backups', 'web', '2020-05-26 16:08:55', '2020-05-26 16:08:55'),
(17, 'create_backups', 'web', '2020-05-26 16:08:55', '2020-05-26 16:08:55'),
(18, 'download_backups', 'web', '2020-05-26 16:08:55', '2020-05-26 16:08:55'),
(19, 'delete_backups', 'web', '2020-05-26 16:08:55', '2020-05-26 16:08:55'),
(20, 'view_posts', 'web', '2020-05-26 16:08:55', '2020-05-26 16:08:55'),
(21, 'add_posts', 'web', '2020-05-26 16:08:55', '2020-05-26 16:08:55'),
(22, 'edit_posts', 'web', '2020-05-26 16:08:56', '2020-05-26 16:08:56'),
(23, 'delete_posts', 'web', '2020-05-26 16:08:56', '2020-05-26 16:08:56'),
(24, 'restore_posts', 'web', '2020-05-26 16:08:56', '2020-05-26 16:08:56'),
(25, 'view_categories', 'web', '2020-05-26 16:08:59', '2020-05-26 16:08:59'),
(26, 'add_categories', 'web', '2020-05-26 16:08:59', '2020-05-26 16:08:59'),
(27, 'edit_categories', 'web', '2020-05-26 16:08:59', '2020-05-26 16:08:59'),
(28, 'delete_categories', 'web', '2020-05-26 16:09:00', '2020-05-26 16:09:00'),
(29, 'restore_categories', 'web', '2020-05-26 16:09:00', '2020-05-26 16:09:00'),
(30, 'view_tags', 'web', '2020-05-26 16:09:04', '2020-05-26 16:09:04'),
(31, 'add_tags', 'web', '2020-05-26 16:09:04', '2020-05-26 16:09:04'),
(32, 'edit_tags', 'web', '2020-05-26 16:09:04', '2020-05-26 16:09:04'),
(33, 'delete_tags', 'web', '2020-05-26 16:09:05', '2020-05-26 16:09:05'),
(34, 'restore_tags', 'web', '2020-05-26 16:09:05', '2020-05-26 16:09:05'),
(35, 'view_comments', 'web', '2020-05-26 16:09:12', '2020-05-26 16:09:12'),
(36, 'add_comments', 'web', '2020-05-26 16:09:12', '2020-05-26 16:09:12'),
(37, 'edit_comments', 'web', '2020-05-26 16:09:12', '2020-05-26 16:09:12'),
(38, 'delete_comments', 'web', '2020-05-26 16:09:12', '2020-05-26 16:09:12'),
(39, 'restore_comments', 'web', '2020-05-26 16:09:13', '2020-05-26 16:09:13'),
(40, 'view_jobposts', 'web', '2020-05-26 17:38:00', '2020-05-26 17:38:00'),
(41, 'add_jobposts', 'web', '2020-05-26 17:38:00', '2020-05-26 17:38:00'),
(42, 'edit_jobposts', 'web', '2020-05-26 17:38:00', '2020-05-26 17:38:00'),
(43, 'delete_jobposts', 'web', '2020-05-26 17:38:00', '2020-05-26 17:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `intro` text COLLATE utf8mb4_unicode_ci,
  `content` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` int(11) DEFAULT NULL,
  `featured_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_og_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_og_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hits` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `order` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `moderated_by` int(10) UNSIGNED DEFAULT NULL,
  `moderated_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_by_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_alias` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `name`, `slug`, `intro`, `content`, `type`, `category_id`, `category_name`, `is_featured`, `featured_image`, `meta_title`, `meta_keywords`, `meta_description`, `meta_og_image`, `meta_og_url`, `hits`, `order`, `status`, `moderated_by`, `moderated_at`, `created_by`, `created_by_name`, `created_by_alias`, `updated_by`, `deleted_by`, `published_at`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Chamara', 'chamara', 'intro 1234', '<p>hello world 123</p>\r\n\r\n<h1>Hay guys</h1>', 'Article', 1, 'Test', 1, 'http://127.0.0.1:8000/storage/1344866_5c41.jpg', 'Chamara', NULL, NULL, 'http://127.0.0.1:8000/storage/1344866_5c41.jpg', NULL, 8, NULL, 1, NULL, NULL, 5, 'Chamara Blogjob', NULL, 5, NULL, '2020-05-28 07:12:51', '2020-05-28 07:12:51', '2020-05-30 05:30:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'super admin', 'web', '2020-05-26 16:08:52', '2020-05-26 16:08:52'),
(2, 'administrator', 'web', '2020-05-26 16:08:53', '2020-05-26 16:08:53'),
(3, 'blog manager', 'web', '2020-05-26 16:08:53', '2020-05-26 17:54:44'),
(4, 'job manager', 'web', '2020-05-26 16:08:53', '2020-05-26 17:55:06'),
(5, 'user', 'web', '2020-05-26 16:08:53', '2020-05-28 05:16:05');

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
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(20, 3),
(21, 2),
(21, 3),
(22, 2),
(22, 3),
(23, 2),
(23, 3),
(24, 2),
(24, 3),
(25, 2),
(25, 3),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 4),
(41, 4),
(42, 4),
(43, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `val` text COLLATE utf8mb4_unicode_ci,
  `type` char(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'string',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `val`, `type`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'app_name', 'Laravel SEO', 'string', 1, 1, NULL, '2020-05-28 07:17:40', '2020-05-28 07:17:40', NULL),
(2, 'footer_text', '<a href=\"https://google.lk\">Google</a>', 'string', 1, 1, NULL, '2020-05-28 07:17:40', '2020-05-28 09:29:43', NULL),
(3, 'show_copyright', '1', 'text', 1, 1, NULL, '2020-05-28 07:17:40', '2020-05-28 07:17:40', NULL),
(4, 'email', 'info@example.com', 'string', 1, 1, NULL, '2020-05-28 07:17:40', '2020-05-28 07:17:40', NULL),
(5, 'facebook_url', '#', 'string', 1, 1, NULL, '2020-05-28 07:17:40', '2020-05-28 07:17:40', NULL),
(6, 'twitter_url', '#', 'string', 1, 1, NULL, '2020-05-28 07:17:40', '2020-05-28 07:17:40', NULL),
(7, 'linkedin_url', '#', 'string', 1, 1, NULL, '2020-05-28 07:17:41', '2020-05-28 07:17:41', NULL),
(8, 'youtube_url', '#', 'string', 1, 1, NULL, '2020-05-28 07:17:41', '2020-05-28 07:17:41', NULL),
(9, 'meta_site_name', 'test', 'text', 1, 1, NULL, '2020-05-28 07:17:41', '2020-05-28 09:30:34', NULL),
(10, 'meta_description', 'test', 'text', 1, 1, NULL, '2020-05-28 07:17:41', '2020-05-28 09:30:34', NULL),
(11, 'meta_keyword', 'Web Application,', 'text', 1, 1, NULL, '2020-05-28 07:17:42', '2020-05-28 09:30:34', NULL),
(12, 'meta_image', 'img/default_banner.jpg', 'text', 1, 1, NULL, '2020-05-28 07:17:42', '2020-05-28 07:17:42', NULL),
(13, 'meta_fb_app_id', '123456789', 'text', 1, 1, NULL, '2020-05-28 07:17:42', '2020-05-28 09:30:34', NULL),
(14, 'meta_twitter_site', '@acbd1234', 'text', 1, 1, NULL, '2020-05-28 07:17:42', '2020-05-28 09:30:35', NULL),
(15, 'meta_twitter_creator', '@abcd1234', 'text', 1, 1, NULL, '2020-05-28 07:17:42', '2020-05-28 09:30:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `taggables`
--

CREATE TABLE `taggables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_id` bigint(20) UNSIGNED NOT NULL,
  `taggable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keyword` text COLLATE utf8mb4_unicode_ci,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userprofiles`
--

CREATE TABLE `userprofiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_facebook` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_twitter` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_linkedin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url_3` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_privecy` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_metadata` text COLLATE utf8mb4_unicode_ci,
  `last_ip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_count` int(11) NOT NULL DEFAULT '0',
  `last_login` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userprofiles`
--

INSERT INTO `userprofiles` (`id`, `user_id`, `name`, `first_name`, `last_name`, `username`, `email`, `mobile`, `gender`, `url_website`, `url_facebook`, `url_twitter`, `url_linkedin`, `url_1`, `url_2`, `url_3`, `profile_privecy`, `date_of_birth`, `address`, `bio`, `avatar`, `user_metadata`, `last_ip`, `login_count`, `last_login`, `email_verified_at`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Super Admin', 'Super', 'Admin', '100001', 'super@admin.com', '731.228.1373 x445', 'Man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1975-04-20', NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 8, '2020-05-30 09:24:07', NULL, 1, NULL, 1, NULL, '2020-05-26 16:08:51', '2020-05-30 09:24:07', NULL),
(2, 2, 'Admin Istrator', 'Admin', 'Istrator', '100002', 'admin@admin.com', '1-830-856-4367 x3158', 'Man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2009-02-11', NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 2, '2020-05-27 16:59:38', NULL, 1, NULL, 2, NULL, '2020-05-26 16:08:51', '2020-05-27 16:59:38', NULL),
(3, 3, 'CMB Blog', 'CMB', 'Blog', '100003', 'manager@manager.com', '(657) 658-0126 x1341', 'Man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1976-08-31', NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 1, '2020-05-28 16:51:21', NULL, 1, NULL, 3, NULL, '2020-05-26 16:08:52', '2020-05-28 16:51:21', NULL),
(4, 4, 'CMB Job', 'CMB', 'Job', '100004', 'executive@executive.com', '1-343-409-6724', 'Man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Public', '2013-12-10', NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 3, '2020-05-27 12:38:54', NULL, 1, NULL, 4, NULL, '2020-05-26 16:08:52', '2020-05-27 12:38:54', NULL),
(5, 5, 'Chamara blogjob', 'Chamara', 'blogjob', '100005', 'user@user.com', '384-545-4418 x364', 'Man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Public', '2009-09-25', NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 1, '2020-05-28 05:14:36', NULL, 1, NULL, 5, NULL, '2020-05-26 16:08:52', '2020-05-28 05:14:36', NULL),
(6, 6, 'test name test last', 'test name', 'test last', NULL, 'ccc@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 1, '2020-05-26 16:13:57', NULL, 1, 1, 6, NULL, '2020-05-26 16:12:29', '2020-05-26 16:13:57', NULL),
(7, 7, 'second user fff', 'second user', 'fff', NULL, 'aaa@aaa.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, NULL, 0, NULL, NULL, 1, 1, 2, NULL, '2020-05-26 16:17:57', '2020-05-26 17:58:39', '2020-05-26 17:58:39'),
(8, 8, 'Shavi Comady', 'Shavi', 'Comady', NULL, 'shavi@123.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'img/default-avatar.jpg', NULL, '127.0.0.1', 1, '2020-05-29 10:38:42', NULL, 1, 1, 8, NULL, '2020-05-29 07:51:48', '2020-05-29 10:38:42', NULL),
(9, 9, 'Praveen Chamal', 'Praveen', 'Chamal', NULL, 'chamal@123.com', NULL, 'Man', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'http://127.0.0.1/storage/2/ea90e808b83da220f355c588b255e565.jpg', NULL, '127.0.0.1', 1, '2020-05-29 11:18:09', NULL, 1, 1, 9, NULL, '2020-05-29 11:17:21', '2020-05-29 11:22:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'img/default-avatar.jpg',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `username`, `email`, `mobile`, `gender`, `date_of_birth`, `email_verified_at`, `password`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'Super', 'Admin', '100001', 'super@admin.com', '731.228.1373 x445', 'Man', '1975-04-20', '2020-05-26 16:08:51', '$2y$10$GkXXj7ZXF0zFesK8LKYzhOPDrZHSx3X6wtowBYoURVZgo8ENoxktW', 'img/default-avatar.jpg', 1, NULL, '2020-05-26 16:08:51', '2020-05-26 16:08:51', NULL),
(2, 'Admin Istrator', 'Admin', 'Istrator', '100002', 'admin@admin.com', '1-830-856-4367 x3158', 'Man', '2009-02-11', '2020-05-26 16:08:51', '$2y$10$sOtjlxaLE5wWs/4.KtjfNefpRenxUpWYrvQd568dGuIquHALQSj0K', 'img/default-avatar.jpg', 1, NULL, '2020-05-26 16:08:51', '2020-05-26 16:08:51', NULL),
(3, 'CMB Blog', 'CMB', 'Blog', '100003', 'manager@manager.com', '(657) 658-0126 x1341', 'Man', '1976-08-31', '2020-05-26 16:08:51', '$2y$10$uoJ7ictYys4AmjnFbtsMmuK/fOWInaOhCS2PAQPzqIhKa0mROwmsO', 'img/default-avatar.jpg', 1, NULL, '2020-05-26 16:08:51', '2020-05-26 18:08:53', NULL),
(4, 'CMB Job', 'CMB', 'Job', '100004', 'executive@executive.com', '1-343-409-6724', 'Man', '2013-12-10', '2020-05-26 16:08:51', '$2y$10$VriEinKD7Tj7ivI5YqzEa.YqZ/bTOYDSmu8eEbMTGJNx297d65J8C', 'img/default-avatar.jpg', 1, NULL, '2020-05-26 16:08:51', '2020-05-26 18:08:26', NULL),
(5, 'Chamara blogjob', 'Chamara', 'blogjob', '100005', 'user@user.com', '384-545-4418 x364', 'Man', '2009-09-25', '2020-05-26 16:08:51', '$2y$10$vFpnZ9X0AU1EExagx2a5tunEOULI/po1wZLSLZWBtSNuvId0XCYi2', 'img/default-avatar.jpg', 1, NULL, '2020-05-26 16:08:51', '2020-05-26 18:07:12', NULL),
(6, 'test name test last', 'test name', 'test last', NULL, 'ccc@gmail.com', NULL, NULL, NULL, '2020-05-26 16:12:28', '$2y$10$bT.EMlsiGRlaKVdaRHa1MO/TXkamysBd/NuIvm2SnF6na8kM8GDBK', 'img/default-avatar.jpg', 1, NULL, '2020-05-26 16:12:28', '2020-05-26 17:55:58', '2020-05-26 17:55:58'),
(7, 'second user fff', 'second user', 'fff', NULL, 'aaa@aaa.com', NULL, NULL, NULL, '2020-05-26 16:17:56', '123456', 'img/default-avatar.jpg', 1, NULL, '2020-05-26 16:17:56', '2020-05-26 17:58:39', '2020-05-26 17:58:39'),
(8, 'Shavi Comady', 'Shavi', 'Comady', NULL, 'shavi@123.com', NULL, NULL, NULL, '2020-05-29 07:51:47', '$2y$10$91B0KxIPBZW6Ld29DQBAq.4vtd7mY1QKyABRM./nimjqAbR6ZXZDW', 'img/default-avatar.jpg', 1, NULL, '2020-05-29 07:51:47', '2020-05-29 10:36:59', NULL),
(9, 'Praveen Chamal', 'Praveen', 'Chamal', NULL, 'chamal@123.com', NULL, 'Man', NULL, '2020-05-29 11:17:21', '$2y$10$bFPofGkgg4jmPlqT8mh7h.2.30tZgKIoClpfL5xHYeaacrqCxw09e', 'http://127.0.0.1/storage/2/ea90e808b83da220f355c588b255e565.jpg', 1, NULL, '2020-05-29 11:17:21', '2020-05-29 11:22:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_providers`
--

CREATE TABLE `user_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_log_log_name_index` (`log_name`),
  ADD KEY `subject` (`subject_id`,`subject_type`),
  ADD KEY `causer` (`causer_id`,`causer_type`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobposts`
--
ALTER TABLE `jobposts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobresponses`
--
ALTER TABLE `jobresponses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taggables`
--
ALTER TABLE `taggables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_providers`
--
ALTER TABLE `user_providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_providers_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobposts`
--
ALTER TABLE `jobposts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobresponses`
--
ALTER TABLE `jobresponses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `taggables`
--
ALTER TABLE `taggables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofiles`
--
ALTER TABLE `userprofiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_providers`
--
ALTER TABLE `user_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_providers`
--
ALTER TABLE `user_providers`
  ADD CONSTRAINT `user_providers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
