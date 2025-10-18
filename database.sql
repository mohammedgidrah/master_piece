-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2025 at 08:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `master_peace`
--

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE `billings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billings`
--

INSERT INTO `billings` (`id`, `user_id`, `order_id`, `first_name`, `last_name`, `email`, `phone`, `billing_city`, `billing_address`, `created_at`, `updated_at`) VALUES
(1, 11, 2, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-17 07:05:40', '2024-11-17 07:05:40'),
(3, 11, 7, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-17 08:32:25', '2024-11-17 08:32:25'),
(5, 11, 9, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-18 05:32:46', '2024-11-18 05:32:46'),
(6, 11, 10, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-18 06:47:28', '2024-11-18 06:47:28'),
(7, 11, 12, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-18 07:24:37', '2024-11-18 07:24:37'),
(8, 11, 15, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-18 19:41:59', '2024-11-18 19:41:59'),
(9, 11, 16, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-19 19:32:57', '2024-11-19 19:32:57'),
(10, 11, 18, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-19 19:33:36', '2024-11-19 19:33:36'),
(11, 11, 19, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-19 22:20:24', '2024-11-19 22:20:24'),
(12, 11, 21, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-19 22:20:59', '2024-11-19 22:20:59'),
(13, 11, 23, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-19 22:23:11', '2024-11-19 22:23:11'),
(14, 11, 29, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-20 07:42:04', '2024-11-20 07:42:04'),
(15, 36, 31, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-11-20 08:20:38', '2024-11-20 08:20:38'),
(17, 36, 32, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2024-12-15 11:37:52', '2024-12-15 11:37:52'),
(18, 36, 33, 'Mohammed', 'Qidrah', 'm7mdgidrah@gmail.com', '0798199473', 'Aqaba', 'العقبه/ الثامنه بجانب كارفور', '2025-01-05 10:38:51', '2025-01-05 10:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Aries', 'Aries is fiery, quick-tempered, and passionate, driven by bold energy, a love for adventure, and a fearless approach to challenges. They can be impulsive but are also fiercely loyal, determined, and always ready to take the lead with confidence and enthusiasm.', 'uploads/categories/0FcMdJjBEFxmwgc2AFblaByJNFWzM7YlCMN3XUbg.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:01:26'),
(3, 'Scorpio', 'Scorpios are known for their intense passion, magnetic presence, and unyielding determination. Famous Scorpio celebrities, including Katy Perry, Frank Ocean, Leonardo DiCaprio, and Julia Roberts, embody these traits, showing resilience and power in all they do.', 'uploads/categories/hOhW9Z06MNukbbdD2enuR4DiGOyTp1mHuvl4GGau.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:02:48'),
(4, 'Taurus', 'Taureans are dependable, patient, and deeply appreciative of life\'s finer things. They seamlessly balance a love for luxurious comforts with down-to-earth practicality. With  strong sense of stability, they find joy in the simple pleasures and stay grounded in all they do.', 'uploads/categories/gOOPYs76rOGkhWlrc3jVzbsSy6NJ0RqZ802bg9Pu.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:12:49'),
(5, 'Gemini', 'Gemini, the third sign of the Zodiac, is often described as curious, communicative, and intellectual. As an air sign, Geminis embrace change and are eager to explore a wide range of topics in conversation. They thrive on variety and enjoy sharing their ideas.', 'uploads/categories/kHp6HmWWqSrvgXsA5x4So2bnFufCAUSw70aNgoqM.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:04:04'),
(6, 'Cancer', 'Cancer is a disease where some of the body\'s cells grow uncontrollably and spread to other areas. It can begin in almost any part of the body, which consists of trillions of cells. The uncontrolled growth can form tumors and affect various organs and systems.', 'uploads/categories/k6ThgNChlMPzvfw8ldto2wTeR8kY6pnpFTGpxMBP.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:04:38'),
(7, 'Leo', 'Loyal, giving, confident, and hard-working are just a few words that describe Leos. They are action-oriented and eager to make things happen. Natural-born leaders, Leos often take charge, pulling others to the front with their strong presence and determination.', 'uploads/categories/CFdjHMGZ3O5j4lcWLYjQuGIlOUJMOOefc3JcjwBi.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:04:57'),
(8, 'Virgo', 'Virgo is defined by precision, intellect, and incredible focus. Known for their analytical minds and meticulous attention to detail, Virgos approach life with practicality and a desire for perfection. They excel in tasks that require careful thought and attention to every detail.', 'uploads/categories/iXbBS6EiM4GKypxeFFPdKfWkYawjRly7nd34DS6V.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:05:20'),
(9, 'Libra', 'Libra is an air sign, known for their desire to be in the company of others. Libras are extremely agreeable, honest, and value social connections. They believe strongly in the importance of balance and harmony in relationships, seeking peace and unity in all their interactions.', 'uploads/categories/JhmAW4aJa0jaUHdlxxZ9g5rX3KEXjimAuXOAQTEP.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:05:47'),
(10, 'Sagittarius', 'Sagittarians are lively, passionate, and intelligent, with a philosophical side often hidden beneath their playful energy. They value freedom above all and resist rules, regulations, and schedules. Their adventurous spirit drives them to explore life without constraints or limits.', 'uploads/categories/3rM3ueVYo8Y4Pe08svJFoh1uhsxUSod5alY57Gzt.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:06:15'),
(11, 'Capricorn', 'Capricorns are known for being hardworking visionaries, leaders, and trailblazers. Celebrities like Dolly Parton,   Katie Couric, Mary J. Blige, and John Legend embody their poise, sophistication, and unrivaled talents, making a lasting impact in their fields.', 'uploads/categories/KGfgRWm3QEPE5utLHDp0wUfe7FKppGeR7tmRGbsA.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:11:31'),
(12, 'Aquarius', 'Aquarius is known for being eccentric, unique, and marching to the beat of their own drum. Often seen as cold and detached, they dislike small talk, petty gossip, and people-pleasing, preferring deep conversations and meaningful connections.', 'uploads/categories/bzi0fLOMGfjykiNTI5X0941Pb4IL11WN2AOUfw2O.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:10:21'),
(13, 'Pisces', 'The last sign of the zodiac, Pisces are known for their dreamy nature, deep empathy, and artistic flair. Celebrities like Rihanna, Justin Bieber, Drew Barrymore,      and Albert Einstein perfectly embody Pisces’ imaginative abilities, showcasing their creative and intuitive talents.', 'uploads/categories/GAYH6gyIfkE0UK3wSy34VmLCDK5z8tBUbUQuWtKp.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 21:09:45'),
(21, 'jdc', 'decfbvbj', 'uploads/categories/MJe1cOVSYJBfhtSTU8DT57vBYoEOgQrBOwRYiPzX.png', NULL, '2024-12-19 09:21:35', '2024-12-19 09:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_10_06_072556_create_categories_table', 1),
(6, '2024_10_06_072557_create_products_table', 1),
(7, '2024_10_06_072613_create_orders_table', 1),
(8, '2024_10_06_072618_create_order_items_table', 1),
(9, '2024_10_06_072621_create_payments_table', 1),
(10, '2024_10_06_072625_create_reviews_table', 1),
(11, '2024_10_06_072628_create_shopping_cart_table', 1),
(12, '2024_10_06_072637_create_shipping_table', 1),
(13, '2024_10_13_110224_create_password_resets_table', 1),
(14, '2024_10_28_080603_create_billings_table', 1),
(15, '2024_10_31_020304_add_social_login_field', 1),
(16, '2024_10_31_123801_create_notifications_table', 1),
(17, '2024_10_31_145654_change_data_column_type_in_notifications_table', 1),
(18, '2024_11_05_095116_add_notifiable_type_to_notifications_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`data`)),
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `notifiable_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `type`, `data`, `is_read`, `created_at`, `updated_at`, `notifiable_type`) VALUES
(39, 36, 'google Registration', '{\"message\":\"An account has been registered by Google.\",\"user_name\":\"m7md qidrah\",\"user_id\":36,\"user_email\":\"m7mdgidrah@gmail.com\"}', 0, '2024-11-20 08:18:42', '2024-11-20 08:18:42', NULL),
(40, 36, 'New Order', '{\"message\":\"A new order has been placed successfully!\",\"order_id\":\"31\",\"user_name\":\"m7md qidrah\",\"user_email\":\"m7mdgidrah@gmail.com\",\"user_image\":\"\\/storage\\/uploads\\/usersprofiles\\/ssUt3hNJdrHB75RTnSFdTpcwvrXOmptnfNNjU1ds.png\"}', 0, '2024-11-20 08:20:38', '2024-11-20 08:20:38', NULL),
(41, 36, 'New Order', '{\"message\":\"A new order has been placed successfully!\",\"order_id\":\"32\",\"user_name\":\"m7md qidrah\",\"user_email\":\"m7mdgidrah@gmail.com\",\"user_image\":\"\\/storage\\/uploads\\/usersprofiles\\/ssUt3hNJdrHB75RTnSFdTpcwvrXOmptnfNNjU1ds.png\"}', 0, '2024-12-15 11:37:52', '2024-12-15 11:37:52', NULL),
(42, 36, 'New Order', '{\"message\":\"A new order has been placed successfully!\",\"order_id\":\"33\",\"user_name\":\"m7md qidrah\",\"user_email\":\"m7mdgidrah@gmail.com\",\"user_image\":\"\\/storage\\/uploads\\/usersprofiles\\/ssUt3hNJdrHB75RTnSFdTpcwvrXOmptnfNNjU1ds.png\"}', 0, '2025-01-05 10:38:51', '2025-01-05 10:38:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `order_status` enum('pending','processing','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `quantity` int(11) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `product_id`, `total_price`, `image`, `order_status`, `quantity`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 11, 10, 358.20, NULL, 'pending', 1, '2024-11-17 07:05:40', '2024-11-17 07:05:30', '2024-11-17 07:05:40'),
(2, 11, 9, 633.73, NULL, 'processing', 1, '2024-11-17 07:05:40', '2024-11-17 07:05:34', '2024-11-17 07:05:40'),
(6, 11, 10, 358.20, NULL, 'pending', 1, '2024-11-17 08:32:03', '2024-11-17 08:31:58', '2024-11-17 08:32:03'),
(7, 11, 10, 1432.80, NULL, 'processing', 4, '2024-11-17 08:32:25', '2024-11-17 08:32:13', '2024-11-17 08:32:25'),
(9, 11, 2, 44.10, NULL, 'processing', 3, '2024-11-18 05:32:46', '2024-11-18 05:32:32', '2024-11-18 05:32:46'),
(10, 11, 2, 14.70, NULL, 'processing', 1, '2024-11-18 06:47:28', '2024-11-18 06:47:20', '2024-11-18 06:47:28'),
(11, 11, 2, 12.00, NULL, 'pending', 4, '2024-11-18 07:24:37', '2024-11-18 07:21:31', '2024-11-18 07:24:37'),
(12, 11, 3, 6.00, NULL, 'processing', 2, '2024-11-18 07:24:37', '2024-11-18 07:24:16', '2024-11-18 07:24:37'),
(14, 11, 6, 3.00, NULL, 'pending', 1, '2024-11-18 19:41:59', '2024-11-18 19:40:41', '2024-11-18 19:41:59'),
(15, 11, 33, 3.00, NULL, 'processing', 1, '2024-11-18 19:41:59', '2024-11-18 19:41:38', '2024-11-18 19:41:59'),
(16, 11, 28, 3.00, NULL, 'processing', 1, '2024-11-19 19:32:57', '2024-11-19 19:32:49', '2024-11-19 19:32:57'),
(17, 11, 3, 3.00, NULL, 'pending', 1, '2024-11-19 19:33:36', '2024-11-19 19:33:26', '2024-11-19 19:33:36'),
(18, 11, 2, 3.00, NULL, 'processing', 1, '2024-11-19 19:33:36', '2024-11-19 19:33:32', '2024-11-19 19:33:36'),
(19, 11, 18, 3.00, NULL, 'processing', 1, '2024-11-19 22:20:24', '2024-11-19 22:20:19', '2024-11-19 22:20:24'),
(20, 11, 3, 3.00, NULL, 'pending', 1, '2024-11-19 22:20:59', '2024-11-19 22:20:47', '2024-11-19 22:20:59'),
(21, 11, 4, 3.00, NULL, 'processing', 1, '2024-11-19 22:20:59', '2024-11-19 22:20:51', '2024-11-19 22:20:59'),
(22, 11, 17, 3.00, NULL, 'pending', 1, '2024-11-19 22:23:11', '2024-11-19 22:22:59', '2024-11-19 22:23:11'),
(23, 11, 15, 3.00, NULL, 'processing', 1, '2024-11-19 22:23:11', '2024-11-19 22:23:05', '2024-11-19 22:23:11'),
(29, 11, 26, 3.00, NULL, 'processing', 1, '2024-11-20 07:42:04', '2024-11-20 07:41:57', '2024-11-20 07:42:04'),
(30, 36, 2, 6.00, NULL, 'pending', 2, '2024-11-20 08:20:38', '2024-11-20 08:19:46', '2024-11-20 08:20:38'),
(31, 36, 3, 12.00, NULL, 'delivered', 4, '2024-11-20 08:20:38', '2024-11-20 08:19:57', '2024-11-20 09:02:46'),
(32, 36, 3, 6.00, NULL, 'processing', 2, '2024-12-15 11:37:52', '2024-12-15 11:35:32', '2024-12-15 11:37:52'),
(33, 36, 4, 3.00, NULL, 'processing', 1, '2025-01-05 10:38:51', '2025-01-05 10:38:39', '2025-01-05 10:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_status` enum('pending','processing','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `user_id`, `order_status`, `quantity`, `price_per_unit`, `total_price`, `deleted_at`, `created_at`, `updated_at`) VALUES
(3, NULL, 10, NULL, 'processing', 1, 358.20, 358.20, NULL, '2024-11-17 07:09:13', '2024-11-17 07:09:13'),
(4, NULL, 9, NULL, 'processing', 1, 633.73, 633.73, NULL, '2024-11-17 07:09:13', '2024-11-17 07:09:13'),
(5, 7, 10, 11, 'processing', 4, 358.20, 1432.80, NULL, '2024-11-17 08:32:25', '2024-11-17 08:32:25'),
(6, NULL, 8, NULL, 'processing', 1, 351.57, 351.57, NULL, '2024-11-17 12:26:10', '2024-11-17 12:26:10'),
(7, 9, 2, 11, 'processing', 3, 14.70, 44.10, NULL, '2024-11-18 05:32:46', '2024-11-18 05:32:46'),
(8, 10, 2, 11, 'processing', 1, 14.70, 14.70, NULL, '2024-11-18 06:47:28', '2024-11-18 06:47:28'),
(9, 12, 2, 11, 'processing', 4, 3.00, 12.00, '2024-11-18 07:32:13', '2024-11-18 07:24:37', '2024-11-18 07:32:13'),
(10, 12, 3, 11, 'processing', 2, 3.00, 6.00, '2024-11-18 07:32:13', '2024-11-18 07:24:37', '2024-11-18 07:32:13'),
(11, 15, 6, 11, 'processing', 1, 3.00, 3.00, NULL, '2024-11-18 19:41:59', '2024-11-18 19:41:59'),
(12, 15, 33, 11, 'processing', 1, 3.00, 3.00, NULL, '2024-11-18 19:41:59', '2024-11-18 19:41:59'),
(13, 16, 28, 11, 'processing', 1, 3.00, 3.00, '2024-11-19 22:24:08', '2024-11-19 19:32:57', '2024-11-19 22:24:08'),
(14, 18, 3, 11, 'processing', 1, 3.00, 3.00, '2024-11-19 22:24:05', '2024-11-19 19:33:36', '2024-11-19 22:24:05'),
(15, 18, 2, 11, 'processing', 1, 3.00, 3.00, '2024-11-19 22:24:05', '2024-11-19 19:33:36', '2024-11-19 22:24:05'),
(16, 19, 18, 11, 'processing', 1, 3.00, 3.00, '2024-11-19 22:24:00', '2024-11-19 22:20:24', '2024-11-19 22:24:00'),
(17, 21, 3, 11, 'processing', 1, 3.00, 3.00, '2024-11-19 22:23:49', '2024-11-19 22:20:59', '2024-11-19 22:23:49'),
(18, 21, 4, 11, 'processing', 1, 3.00, 3.00, '2024-11-19 22:23:49', '2024-11-19 22:20:59', '2024-11-19 22:23:49'),
(19, 23, 17, 11, 'processing', 1, 3.00, 3.00, '2024-11-19 22:23:46', '2024-11-19 22:23:11', '2024-11-19 22:23:46'),
(20, 23, 15, 11, 'processing', 1, 3.00, 3.00, '2024-11-19 22:23:46', '2024-11-19 22:23:11', '2024-11-19 22:23:46'),
(21, 29, 26, 11, 'processing', 1, 3.00, 3.00, NULL, '2024-11-20 07:42:04', '2024-11-20 07:42:04'),
(22, 31, 2, 36, 'delivered', 2, 3.00, 6.00, NULL, '2024-11-20 08:20:38', '2024-11-20 09:02:46'),
(23, 31, 3, 36, 'delivered', 4, 3.00, 12.00, NULL, '2024-11-20 08:20:38', '2024-11-20 09:02:46'),
(24, 32, 3, 36, 'processing', 2, 3.00, 6.00, NULL, '2024-12-15 11:37:52', '2024-12-15 11:37:52'),
(25, 33, 4, 36, 'processing', 1, 3.00, 3.00, NULL, '2025-01-05 10:38:51', '2025-01-05 10:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('m7mdgidrah@gmail.com', 'UzvYPf8zLeXSrrqgYGyfZ2TGfKXZUThuaBOQWCX3sKepsXh0gYt94DAgA5or3wzA', '2024-11-20 08:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` enum('in_stock','out_of_stock') NOT NULL DEFAULT 'in_stock',
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `quantity`, `image`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 2, 'Red Jasper', 'Red Jasper is a fine-grained chalcedony, an opaque microcrystalline quartz with large grainy crystals', 3.00, 'in_stock', 10, 'uploads/products/gVaEH7JwNW7ulV8Fx8Fa4hmt4aZVceRyXIG8C8KH.jpg', NULL, '2024-11-17 07:05:23', '2024-11-20 08:56:57'),
(3, 2, 'Tigereye', 'Bewitching, enchanting, mesmerizing: all adjectives used frequently in an attempt to capture the exact effect that tiger’s eye crystal has over the human spirit', 3.00, 'out_of_stock', 0, 'uploads/products/ZtsWFm6kpQhT2yFBEwiqPr89n4cZkPzRAuYGVyRU.jpg', NULL, '2024-11-17 07:05:23', '2024-12-15 11:37:52'),
(4, 2, 'unakite', 'Unakite is a type of granitic rock that features mottled patterns of green epidote, white to gray quartz, and pink feldspar, occasionally with black veining.', 3.00, 'in_stock', 8, 'uploads/products/4qajOHbIVfqjd7etQyIQwaJgr0YG1kLH76E9uWz9.jpg', NULL, '2024-11-17 07:05:23', '2025-01-05 10:38:51'),
(5, 2, 'Clear Quartz', '‪Clear Quartz Crystal Meaning: Healing Properties & Uses‬‏\r\nClear Quartz is also known as crystal quartz and is a mineral made of oxygen and silicone atoms. It is part of the trigonal crystal system and has a vitreous luster', 3.00, 'in_stock', 12, 'uploads/products/0HQd8HxIfsTxExqr4uVEZ4xhe1dhDUQjhTz3IBOn.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 18:36:56'),
(6, 4, 'Tigereye', 'Bewitching, enchanting,\r\nmesmerizing: all adjectives\r\nused frequently in an attempt\r\nto capture the exact effect\r\nthat tiger’s eye crystal has\r\nover the human spirit', 3.00, 'in_stock', 7, 'uploads/products/88Va5x6VCdmtb6hUAcY0W48oYa1vP6RQUxh7k4ul.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 19:41:59'),
(7, 5, 'Moonstone', 'The moonstone is a lava stone crystal with an appearance that leaves you speechless. Thanks to its optical effect, the adularescence, the internal reflections of this majestic stone are', 3.00, 'in_stock', 10, 'uploads/products/WSVlSdNn05nQQBMhTaczUAY8mKHrCQSeFl3sqG5D.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 18:41:17'),
(8, 5, 'Tigereye', 'Bewitching, enchanting,\r\nmesmerizing: all adjectives\r\nused frequently in an attempt\r\nto capture the exact effect\r\nthat tiger’s eye crystal has\r\nover the human spirit', 3.00, 'in_stock', 10, 'uploads/products/wR18oAP4ESUmIEJlY67W59XYD7ykIhPRKIlANiRR.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 18:42:58'),
(9, 5, 'Malachite', '‬‏Malachite is a bright green copper carbonate hydroxide mineral contain 57.48% Cu in the purest form. The commercial quantity of malachite occurs worldwide including Congo, Gabon, Zambia, Namibia, Mexico, Australia, and with the largest deposit/mine in the Urals region, Russia', 3.00, 'in_stock', 15, 'uploads/products/OxhtB125UamTfyHfOQHZIxjCDwNmDLSDugmOFqwd.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 18:46:22'),
(10, 6, 'Moonstone', 'The moonstone is a lava stone crystal with an appearance that leaves you speechless. Thanks to its optical effect, the adularescence, the internal reflections of this majestic stone are', 3.00, 'in_stock', 10, 'uploads/products/1kIOGGWe1c2OjMpMv0snLzwq0JlQvgaXFjOCnmo9.jpg', NULL, '2024-11-17 07:05:23', '2024-11-18 18:47:35'),
(11, 6, 'Aventurine', 'Aventurine is a variety of quartz. The speckled look comes from the glistening scales of mica or hematite and is called aventurescence. It is formed in the cavities of igneous rock where rapid', 3.00, 'in_stock', 13, 'uploads/products/JOr6kxtdpDErQUQRKM7zc4G8yizCAm3nDklIoDFU.jpg', NULL, '2024-11-18 18:52:08', '2024-11-18 18:52:08'),
(12, 6, 'clear necklace pearl', '‪Pearl Just like the shell of a mollusk, a pearl is composed of calcium carbonate (mainly aragonite or a mixture of aragonite and calcite) in minute crystalline form, which has deposited in concentric layers.', 2.00, 'in_stock', 5, 'uploads/products/nuMXi9WA7npZEi4A7QKUEAEv1JSmFlYFMjVCTEew.jpg', NULL, '2024-11-18 18:55:24', '2024-11-18 19:00:54'),
(13, 6, 'green  necklace pearl', '‪Pearl Just like the shell of a mollusk, a pearl is composed of calcium carbonate (mainly aragonite or a mixture of aragonite and calcite) in minute crystalline form, which has deposited in concentric layers.', 3.00, 'in_stock', 5, 'uploads/products/bFg5U7hRO0RoNzA8zoj2bvKNWwHTVrkeX8hryUYI.jpg', NULL, '2024-11-18 18:57:58', '2024-11-18 19:01:13'),
(14, 6, 'blue necklace pearl', '‪Pearl Just like the shell of a mollusk, a pearl is composed of calcium carbonate (mainly aragonite or a mixture of aragonite and calcite) in minute crystalline form, which has deposited in concentric layers.', 3.00, 'in_stock', 5, 'uploads/products/rddZ3WLddJmyRKYdPZcnYA6DSZnt7JNVxsq6R73V.jpg', NULL, '2024-11-18 19:00:24', '2024-11-18 19:00:24'),
(15, 7, 'Onyx', 'Onyx is the parallel-banded variety of chalcedony, a silicate mineral. Agate and onyx are both varieties of layered chalcedony that differ only in the form of the bands. Onyx has parallel bands, while agate has curved bands.', 3.00, 'in_stock', 13, 'uploads/products/XOtTDb3fhII3e2gns75ET8FEnICtrnex6gDEtJeQ.jpg', NULL, '2024-11-18 19:03:56', '2024-11-19 22:23:11'),
(16, 7, 'Tigereye', 'Bewitching, enchanting, mesmerizing: all adjectives used frequently in an attempt to capture the exact effect that tiger’s eye crystal has over the human spirit', 3.00, 'in_stock', 13, 'uploads/products/epwYYXSkJFNA2UcppzhygL3wAJNbyrWKdh5dqPAf.jpg', NULL, '2024-11-18 19:04:48', '2024-11-18 19:04:48'),
(17, 7, 'citrine', 'citrine, transparent, coarse-grained variety of the silica mineral quartz (q.v.). Citrine is a semiprecious gem that is valued for its yellow to brownish colour and its resemblance to the rarer topaz', 3.00, 'in_stock', 9, 'uploads/products/iMbeFTl3LZYNM9CRzlEk5JL2JY6M5m5m80Ddpn1x.jpg', NULL, '2024-11-18 19:13:46', '2024-11-19 22:23:11'),
(18, 8, 'carnelian', 'carnelian, a translucent, semiprecious variety of the silica mineral chalcedony that owes its red to reddish brown colour to colloidally dispersed hematite (iron oxide)', 3.00, 'in_stock', 5, 'uploads/products/mI6XjtlmcaXpG16ODJwntpDwQuAiBwSs0y86fwHT.jpg', NULL, '2024-11-18 19:15:08', '2024-11-19 22:20:24'),
(19, 8, 'Moonstone', 'The moonstone is a lava stone crystal with an appearance that leaves you speechless. Thanks to its optical effect, the adularescence, the internal reflections of this majestic stone are', 3.00, 'in_stock', 10, 'uploads/products/VTktEp9LIDUJX2lWDzPTamngfmfCmGAYPlPJYoCq.jpg', NULL, '2024-11-18 19:15:53', '2024-11-18 19:15:53'),
(20, 8, 'citrine', 'citrine, transparent, coarse-grained variety of the silica mineral quartz (q.v.). Citrine is a semiprecious gem that is valued for its yellow to brownish colour and its resemblance to the rarer topaz', 3.00, 'in_stock', 15, 'uploads/products/jjAnyZuhMkvJtyiJiwVXGOFlkmBsqIWro41udscp.jpg', NULL, '2024-11-18 19:16:55', '2024-11-18 19:16:55'),
(21, 9, 'topaz', 'Topaz is a fluoro-silicate of aluminium, usually colourless, but can be white, yellow, light shades of grey, blue, orange, brown, green or pink', 3.00, 'in_stock', 16, 'uploads/products/YTCJtJq0ZMYQeVeTDnxQSV5BYlEXLcJuopX4bYHV.jpg', NULL, '2024-11-18 19:18:12', '2024-11-18 19:18:12'),
(22, 9, 'Aventurine', 'Aventurine is a variety of quartz. The speckled look comes from the glistening scales of mica or hematite and is called aventurescence. It is formed in the cavities of igneous rock where rapid', 3.00, 'in_stock', 12, 'uploads/products/1wWBqHdDbAV6gqOWifbSn1y1y394nN8d4QJOHOqE.jpg', NULL, '2024-11-18 19:19:12', '2024-11-18 19:19:12'),
(23, 9, 'jade', 'jade, either of two tough, compact, typically green gemstones that take a high polish. Both minerals have been carved into jewelry, ornaments, small sculptures, and utilitarian objects from earliest recorded times', 3.00, 'in_stock', 12, 'uploads/products/sEYbRoSWaZl85v1uqo8b6OHoXg1dUGLUUxNVVfGP.jpg', NULL, '2024-11-18 19:20:31', '2024-11-18 19:20:31'),
(24, 9, 'carnelian', 'carnelian, a translucent, semiprecious variety of the silica mineral chalcedony that owes its red to reddish brown colour to colloidally dispersed hematite (iron oxide)', 3.00, 'in_stock', 10, 'uploads/products/0eYxvI3iB6mjkw6EsSJU0BkiyYoMjbPC8Hx8ZE7s.jpg', NULL, '2024-11-18 19:22:50', '2024-11-18 19:22:50'),
(25, 3, 'Malachite', '‬‏Malachite is a bright green copper carbonate hydroxide mineral contain 57.48% Cu in the purest form. The commercial quantity of malachite occurs worldwide including Congo, Gabon, Zambia, Namibia, Mexico, Australia, and with the largest deposit/mine in the Urals region, Russia', 3.00, 'in_stock', 10, 'uploads/products/sJkACqDczEZfWitZMKGeJUqbDxvGSjkYwWJLZdK8.jpg', NULL, '2024-11-18 19:23:56', '2024-11-18 19:23:56'),
(26, 3, 'Turquoise', 'conchoidal. Despite its low hardness relative to other gems, turquoise takes a good polish', 3.00, 'in_stock', 14, 'uploads/products/LMgypv7jPiMoEC7lFFKQyddL1Hhh2VZ8L6LPDM7N.jpg', NULL, '2024-11-18 19:25:35', '2024-11-20 07:42:04'),
(27, 3, 'citrine', 'citrine, transparent, coarse-grained variety of the silica mineral quartz (q.v.). Citrine is a semiprecious gem that is valued for its yellow to brownish colour and its resemblance to the rarer topaz', 3.00, 'in_stock', 12, 'uploads/products/6xvNytPa2bxylHvoHthVqNVVa0OnnTJXR3cbPqwZ.jpg', NULL, '2024-11-18 19:26:23', '2024-11-18 19:26:23'),
(28, 11, 'Malachite', '‬‏Malachite is a bright green copper carbonate hydroxide mineral contain 57.48% Cu in the purest form. The commercial quantity of malachite occurs worldwide including Congo, Gabon, Zambia, Namibia, Mexico, Australia, and with the largest deposit/mine in the Urals region, Russia', 3.00, 'in_stock', 13, 'uploads/products/NV2QuTq1tSdGgi17wzlVhDAy1ZWAfyb9HNmwQWzX.jpg', NULL, '2024-11-18 19:27:30', '2024-11-19 19:32:57'),
(29, 11, 'Smoky quartz', 'Smoky quartz is a brownish grey, translucent variety of quartz that ranges in clarity from almost complete transparency to an almost-opaque brownish-gray or black crystals.', 3.00, 'in_stock', 10, 'uploads/products/V3V6HlenUfAK4MgVPeSZBaQGjqfaEPna8jmHjoIF.jpg', NULL, '2024-11-18 19:28:51', '2024-11-18 19:28:51'),
(30, 11, 'Tigereye', 'Bewitching, enchanting, mesmerizing: all adjectives used frequently in an attempt to capture the exact effect that tiger’s eye crystal has over the human spirit', 3.00, 'in_stock', 15, 'uploads/products/Muv0hynIlXdPwFC0NZlIa5oQvdIqL1BBTDLdevc0.jpg', NULL, '2024-11-18 19:29:44', '2024-11-18 19:29:44'),
(31, 12, 'jade', 'jade, either of two tough, compact, typically green gemstones that take a high polish. Both minerals have been carved into jewelry, ornaments, small sculptures, and utilitarian objects from earliest recorded times', 3.00, 'in_stock', 10, 'uploads/products/iO1VgSESozBlLqnuvdrnmjRs8zm6ZvrjMxY1tXT6.jpg', NULL, '2024-11-18 19:30:36', '2024-11-18 19:30:36'),
(32, 12, 'Red Jasper', 'Red Jasper is a fine-grained chalcedony, an opaque microcrystalline quartz with large grainy crystals', 3.00, 'in_stock', 10, 'uploads/products/4qXzrBnrqlSADrt3MiTiJHmsMvPhAlCZkuy007Tj.jpg', NULL, '2024-11-18 19:34:09', '2024-11-18 19:34:09'),
(33, 12, 'Turquoise', 'conchoidal. Despite its low hardness relative to other gems, turquoise takes a good polish', 3.00, 'in_stock', 11, 'uploads/products/8MSIFgekWYEOzVYA5khmCNit50c2mbybBc4JuOsw.jpg', NULL, '2024-11-18 19:35:37', '2024-11-18 19:41:59'),
(34, 13, 'jade', 'jade, either of two tough, compact, typically green gemstones that take a high polish. Both minerals have been carved into jewelry, ornaments, small sculptures, and utilitarian objects from earliest recorded times', 3.00, 'in_stock', 15, 'uploads/products/mfoaJ0UdecHGc9z5OPAgFu6VeJcMOQliFCa9HEJb.jpg', NULL, '2024-11-18 19:36:48', '2024-11-18 19:36:48'),
(35, 13, 'Clear Quartz', '‪Clear Quartz Crystal Meaning: Healing Properties & Uses‬‏ Clear Quartz is also known as crystal quartz and is a mineral made of oxygen and silicone atoms. It is part of the trigonal crystal system and has a vitreous luster', 3.00, 'in_stock', 16, 'uploads/products/mtUcuEhQ549sfvtyIjTK5UyfAOFtLtRY6VEt2Kw5.jpg', NULL, '2024-11-18 19:37:27', '2024-11-18 19:37:27'),
(36, 13, 'Tigereye', 'Bewitching, enchanting, mesmerizing: all adjectives used frequently in an attempt to capture the exact effect that tiger’s eye crystal has over the human spirit', 3.00, 'in_stock', 10, 'uploads/products/HZEIC6a7WVjnZFEu2ILBxZfMweWw2I366SwYYAfi.jpg', NULL, '2024-11-18 19:38:06', '2024-11-18 19:38:06'),
(37, 13, 'Turquoise', 'conchoidal. Despite its low hardness relative to other gems, turquoise takes a good polish', 3.00, 'in_stock', 13, 'uploads/products/YwEgaxEhCVGSxf5AgR74G6StDjjzD2ouEgFIxyRA.jpg', NULL, '2024-11-18 19:39:14', '2024-11-18 19:39:14'),
(38, 10, 'Turquoise', 'conchoidal. Despite its low hardness relative to other gems, turquoise takes a good polish', 3.00, 'in_stock', 15, 'uploads/products/gaDGEty8UcA7T2TzgkqLj4KIYik4GM0xsyRW6C7S.jpg', NULL, '2024-11-18 19:43:52', '2024-11-18 19:43:52');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

CREATE TABLE `shipping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `shipping_date` timestamp NULL DEFAULT NULL,
  `delivery_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cart`
--

CREATE TABLE `shopping_cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'uploads/usersprofiles/defaultimage/userimage.png',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `social_id` varchar(255) DEFAULT NULL,
  `social_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `role`, `phone`, `address`, `email_verified_at`, `image`, `is_verified`, `deleted_at`, `remember_token`, `created_at`, `updated_at`, `social_id`, `social_type`) VALUES
(1, 'Isom', 'Denesik', 'christophe.hoeger@example.net', '$2y$10$yrXwU8JS0Mb1ijWScwdgQeuohWPM9HTFCEcYbCJTKTox7XcVvWYoO', 'user', '(956) 565-1599', '2644 Rath Ranch Suite 310\nPort Kyler, DE 57614', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, '2024-12-15 11:46:16', 'c9fQ30p7wo', '2024-12-01 07:05:23', '2024-12-15 11:46:16', NULL, NULL),
(2, 'Roslyn', 'Breitenberg', 'glarson@example.org', '$2y$10$nj7bavTNrksIV5Q8V2q6WuwA6XgTMnSWPRyXsbp9B3r3sdhh5G0I.', 'admin', '410.826.2283', '100 Schimmel River\nElishashire, PA 33663', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, NULL, 'toSAYS6FNv', '2024-11-17 07:05:23', '2024-11-17 07:05:23', NULL, NULL),
(3, 'Percy', 'Durgan', 'shaina38@example.net', '$2y$10$QlYyUHZ6V.8JI2JyhqIroON93UsNcBrPYih9Vb9SEPqJ7/Ax.mgkC', 'admin', '+1 (320) 719-4160', '43458 Alvis Ridge\nNorth Ramonside, MS 03318-1626', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, NULL, 'sEELdBUK6E', '2024-11-17 07:05:23', '2024-11-17 07:05:23', NULL, NULL),
(4, 'Jarret', 'Bauch', 'bcartwright@example.com', '$2y$10$iyU7kEjetcMO4zAyrhLb3uqFlkDv4yDA4SR1KRuPQL4s2PmOaW7Ie', 'admin', '+13256607776', '34630 Willow Creek Suite 043\nYostchester, ID 88601-4078', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, NULL, '3FxU55WIPo', '2024-11-17 07:05:23', '2024-11-17 07:05:23', NULL, NULL),
(5, 'Krista', 'Lindgren', 'adam.nicolas@example.org', '$2y$10$QNMWJ4fsaAj/gKE73H8tR.P/67VtQRyzNHnK6PfJ.JA8k71qYnTJ6', 'admin', '+1-737-215-9247', '357 Wilkinson Lakes Apt. 265\nSouth Hosea, WY 65685-6705', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, NULL, 'Ix4WH53qjs', '2024-11-17 07:05:23', '2024-11-17 07:05:23', NULL, NULL),
(6, 'Elinore', 'Prosacco', 'iboehm@example.com', '$2y$10$S.hQAMi7iQvCv4.QBLYJpuYyVQOd2a.OvHxnNV9m6kjBDjNes2vaO', 'admin', '+1 (318) 512-2794', '25198 Mayert Gardens\nSouth Amiya, VA 00773', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, NULL, 'QesXFgsjUu', '2024-11-17 07:05:23', '2024-11-17 07:05:23', NULL, NULL),
(7, 'Sadye', 'Breitenberg', 'veum.lottie@example.com', '$2y$10$WrXDRAx8KAH6GeDGC2.3NuQ4MwUTQPwBsNJbpAz7YksCBdXo4uYzO', 'user', '1-262-773-3841', '282 Crist Mission Suite 350\nConstantinborough, RI 38735', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, NULL, 'gbLbJwSRaV', '2024-11-17 07:05:23', '2024-11-17 07:05:23', NULL, NULL),
(8, 'Justina', 'Kuvalis', 'wilber.mann@example.org', '$2y$10$nHF9Y0u.c7WxLPMnCehfkeUQm3QnLRfIp1hS./WrnzCl9V3DucNmG', 'admin', '470-877-6822', '93108 Legros Hill\nDickinsonbury, UT 87947', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, NULL, 'pB95uDfffb', '2024-11-17 07:05:23', '2024-11-17 07:05:23', NULL, NULL),
(9, 'Marilie', 'Cummerata', 'brakus.hosea@example.com', '$2y$10$U4julelQMCJBFSLHdStfLeCFoiKR.IwKXQMZMXkgQ0MIi3nLa/az2', 'admin', '1-331-501-0609', '903 Pacocha Ford Apt. 985\nWest Summer, DE 55990', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, NULL, 'izf8M2uc9D', '2024-11-17 07:05:23', '2024-11-17 07:05:23', NULL, NULL),
(10, 'Tina', 'Rogahn', 'santina67@example.net', '$2y$10$mNxyHow5rThKnYgWF4LvMeKYCmUy29x13zEugNPwuph4tj3kxUcJW', 'user', '+14193175232', '81029 Shanel Walk Suite 000\nJaronfort, ME 85069', '2024-11-17 07:05:23', 'uploads/usersprofiles/defaultimage/userimage.png', 0, NULL, '7BCDEeXsh3', '2024-11-17 07:05:23', '2024-11-17 07:05:23', NULL, NULL),
(11, 'Admin', 'User', 'admin@gmail.com', '$2y$10$7oGf8usv2oF5lvr8NJ9Wdep9fB9gr/TtmAyr2EgRyr5p.AJFdZRDC', 'admin', NULL, NULL, NULL, 'uploads/usersprofiles/Ra7EHIBB85IXsgJJwYTsF5OqonOhStzyxVLmCAKT.png', 0, NULL, NULL, '2024-11-17 07:05:23', '2025-01-05 10:41:52', NULL, NULL),
(36, 'm7md', 'qidrah', 'm7mdgidrah@gmail.com', '$2y$10$TMbgSBSSfK4Di9GsYgYG5.bzSOHCNaYRN/PEvSILEEohHpnl.wTs6', 'user', NULL, NULL, NULL, 'uploads/usersprofiles/ssUt3hNJdrHB75RTnSFdTpcwvrXOmptnfNNjU1ds.png', 1, NULL, NULL, '2024-11-20 08:18:42', '2024-11-20 08:28:49', NULL, 'google');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billings_user_id_foreign` (`user_id`),
  ADD KEY `billings_order_id_foreign` (`order_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_product_id_foreign` (`product_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_customer_id_foreign` (`customer_id`);

--
-- Indexes for table `shipping`
--
ALTER TABLE `shipping`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_order_id_foreign` (`order_id`);

--
-- Indexes for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_cart_customer_id_foreign` (`customer_id`),
  ADD KEY `shopping_cart_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shipping`
--
ALTER TABLE `shipping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billings`
--
ALTER TABLE `billings`
  ADD CONSTRAINT `billings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `billings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shopping_cart`
--
ALTER TABLE `shopping_cart`
  ADD CONSTRAINT `shopping_cart_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shopping_cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
