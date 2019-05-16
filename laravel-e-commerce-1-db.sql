-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 16 May 2019, 17:12:28
-- Sunucu sürümü: 10.1.30-MariaDB
-- PHP Sürümü: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `laravel-e-commerce-1-db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `products_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `cart`
--

INSERT INTO `cart` (`id`, `products_id`, `product_name`, `product_code`, `product_color`, `size`, `price`, `quantity`, `user_email`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 14, 'shoes name 4', 'shoes-er-04', 'kırmızı', '40', 69.00, 10, 'customer@gmail.com', 'igJXIu42hl1jsWPxEHye1jseNIuT48Isrswa3RDc', '2019-05-16 11:02:35', '2019-05-16 11:02:35'),
(2, 24, 'purse name 4', 'purse-ka-040', 'siyah', 'medium', 40.00, 20, 'customer@gmail.com', 'igJXIu42hl1jsWPxEHye1jseNIuT48Isrswa3RDc', '2019-05-16 11:02:54', '2019-05-16 11:02:54'),
(3, 4, 'jeans name 4', 'jeans-er-04', 'mavi', '34', 35.00, 10, 'customer@gmail.com', 'igJXIu42hl1jsWPxEHye1jseNIuT48Isrswa3RDc', '2019-05-16 11:03:08', '2019-05-16 11:03:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `name`, `description`, `url`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 0, 'Erkek', 'Erkek main category', NULL, 1, NULL, '2019-05-16 09:07:22', '2019-05-16 09:07:22'),
(2, 0, 'Kadın', 'Kadın main category', NULL, 1, NULL, '2019-05-16 09:07:42', '2019-05-16 09:07:42'),
(3, 1, 'Jeans', 'jeans erkek category', NULL, 1, NULL, '2019-05-16 09:08:59', '2019-05-16 09:08:59'),
(4, 1, 'Ayakkabi', 'ayakkabi erkek category', NULL, 1, NULL, '2019-05-16 09:09:30', '2019-05-16 09:09:30'),
(5, 2, 'Çanta', 'çanta kadın category', NULL, 1, NULL, '2019-05-16 09:10:04', '2019-05-16 09:10:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `countries`
--

CREATE TABLE `countries` (
  `id` int(10) UNSIGNED NOT NULL,
  `country_code` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `countries`
--

INSERT INTO `countries` (`id`, `country_code`, `country_name`, `created_at`, `updated_at`) VALUES
(1, 'tr', 'turkey', NULL, NULL),
(2, '', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `users_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `delivery_address`
--

INSERT INTO `delivery_address` (`id`, `users_id`, `users_email`, `name`, `address`, `city`, `country`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 2, 'customer@gmail.com', 'customer', 'customer address', 'customer city', 'turkey', '0123456789', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(49, '2014_10_12_000000_create_users_table', 1),
(50, '2014_10_12_100000_create_password_resets_table', 1),
(51, '2019_05_02_141135_create_categories_table', 1),
(52, '2019_05_02_161003_create_products_table', 1),
(53, '2019_05_02_204431_create_product_att_table', 1),
(54, '2019_05_03_072651_create_tblgallery_table', 1),
(55, '2019_05_03_080659_create_coupons_table', 1),
(56, '2019_05_03_173321_create_cart_table', 1),
(57, '2019_05_04_161847_add_more_fields_to_users_table', 1),
(58, '2019_05_04_162227_create_countries_table', 1),
(59, '2019_05_04_175806_create_delivery_address_table', 1),
(60, '2019_05_04_211350_create_orders_table', 1),
(61, '2019_05_06_184236_create_order_products_table', 1),
(62, '2019_05_06_200527_add_more_fields_to_orders_table', 1),
(63, '2019_05_14_171302_add_more_fields_to_product_att_table', 1),
(64, '2019_05_15_150850_add_more_fields_to_order_products_table', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `users_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_charges` double(8,2) NOT NULL,
  `coupon_code` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coupon_amount` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `grand_total` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `shipping` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `orders`
--

INSERT INTO `orders` (`id`, `users_id`, `users_email`, `name`, `address`, `city`, `country`, `mobile`, `shipping_charges`, `coupon_code`, `coupon_amount`, `order_status`, `payment_method`, `grand_total`, `created_at`, `updated_at`, `paid`, `shipping`) VALUES
(1, 2, 'customer@gmail.com', 'customer', 'customer address', 'customer city', 'turkey', '0123456789', 0.00, 'No Coupon', '0', 'success', 'COD', '1840', '2019-05-16 11:05:54', '2019-05-16 11:06:51', 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_products`
--

CREATE TABLE `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `quantity`, `size`, `product_code`, `created_at`, `updated_at`, `product_color`) VALUES
(1, 1, 14, 10, '40', 'shoes-er-04', NULL, NULL, 'kırmızı'),
(2, 1, 24, 20, 'medium', 'purse-ka-040', NULL, NULL, 'siyah'),
(3, 1, 4, 10, '34', 'jeans-er-04', NULL, NULL, 'mavi');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `categories_id` int(11) NOT NULL,
  `p_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `categories_id`, `p_name`, `p_code`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 3, 'jeans name 1', 'jeans-er-01', '<p><span style=\"font-family: \'courier new\', courier, monospace;\"><strong>Jeans Description</strong></span></p>\r\n<p><span style=\"font-family: \'courier new\', courier, monospace;\"><strong>Jeans Description</strong></span></p>\r\n<p><span style=\"font-family: \'courier new\', courier, monospace;\"><strong>Jeans Description</strong></span></p>', 20.00, '1558008958-jeans-name-1.jpg', '2019-05-16 09:15:58', '2019-05-16 09:19:09'),
(2, 3, 'jeans name 2', 'jeans-er-02', '<p><strong>Jeans Description 2</strong></p>\r\n<p><strong>Jeans Description 2</strong></p>\r\n<p><strong>Jeans Description 2</strong></p>', 25.00, '1558009039-jeans-name-2.jpg', '2019-05-16 09:17:19', '2019-05-16 09:17:19'),
(3, 3, 'jeans name 3', 'jeans-er-03', '<p><em><strong>Jeans Description 3</strong></em></p>\r\n<p><em><strong>Jeans Description 3</strong></em></p>\r\n<p><em><strong>Jeans Description 3</strong></em></p>', 30.00, '1558009185-jeans-name-3.jpg', '2019-05-16 09:19:45', '2019-05-16 09:19:45'),
(4, 3, 'jeans name 4', 'jeans-er-04', '<p><em><strong>Jeans Description 4</strong></em></p>\r\n<p><em><strong>Jeans Description 4</strong></em></p>\r\n<p><em><strong>Jeans Description 4</strong></em></p>', 35.00, '1558009220-jeans-name-4.jpg', '2019-05-16 09:20:20', '2019-05-16 09:20:20'),
(5, 3, 'jeans name 5', 'jeans-er-05', '<p><em><strong>Jeans Description 5</strong></em></p>\r\n<p><em><strong>Jeans Description 5</strong></em></p>\r\n<p><em><strong>Jeans Description 5</strong></em></p>', 40.00, '1558009248-jeans-name-5.jpg', '2019-05-16 09:20:48', '2019-05-16 09:20:48'),
(6, 3, 'jeans name 6', 'jeans-er-06', '<p><span style=\"font-family: \'times new roman\', times, serif;\"><strong>Jeans Description 6</strong></span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif;\"><strong>Jeans Description 6</strong></span></p>\r\n<p><span style=\"font-family: \'times new roman\', times, serif;\"><strong>Jeans Description 6</strong></span></p>', 45.00, '1558009297-jeans-name-6.jpg', '2019-05-16 09:21:37', '2019-05-16 09:21:37'),
(7, 3, 'jeans name 7', 'jeans-er-07', '<p>Jeans Description 7</p>\r\n<p>Jeans Description 7</p>\r\n<p>Jeans Description 7</p>', 55.00, '1558009326-jeans-name-7.jpg', '2019-05-16 09:22:06', '2019-05-16 09:22:06'),
(8, 3, 'jeans name 8', 'jeans-er-08', '<p>Jeans Description 8</p>\r\n<p>Jeans Description 8</p>\r\n<p>Jeans Description 8</p>', 60.00, '1558009365-jeans-name-8.jpg', '2019-05-16 09:22:45', '2019-05-16 09:22:45'),
(9, 3, 'jeans name 9', 'jeans-er-09', '<p>Jeans Description 9</p>\r\n<p>Jeans Description 9</p>\r\n<p>Jeans Description 9</p>', 70.00, '1558009399-jeans-name-9.jpg', '2019-05-16 09:23:19', '2019-05-16 09:23:19'),
(10, 3, 'jeans name 10', 'jeans-er-010', '<p><strong>Jeans Description 10</strong></p>\r\n<p><strong>Jeans Description 10</strong></p>\r\n<p><strong>Jeans Description 10</strong></p>', 90.00, '1558009431-jeans-name-10.jpg', '2019-05-16 09:23:51', '2019-05-16 09:23:51'),
(11, 4, 'shoes name 1', 'shoes-er-01', '<p><em><strong>Shoes Description 1</strong></em></p>\r\n<p><em><strong>Shoes Description 1</strong></em></p>\r\n<p><em><strong>Shoes Description 1</strong></em></p>', 60.00, '1558009490-shoes-name-1.jpg', '2019-05-16 09:24:50', '2019-05-16 09:24:50'),
(12, 4, 'shoes name 2', 'shoes-er-02', '<p><strong>Shoes Description 2</strong></p>\r\n<p><strong>Shoes Description 2</strong></p>\r\n<p><strong>Shoes Description 2</strong></p>', 30.00, '1558009527-shoes-name-2.jpg', '2019-05-16 09:25:27', '2019-05-16 09:25:27'),
(13, 4, 'shoes name 3', 'shoes-er-03', '<p><em><strong>Shoes Description 3</strong></em></p>\r\n<p><em><strong>Shoes Description 3</strong></em></p>\r\n<p><em><strong>Shoes Description 3</strong></em></p>', 75.00, '1558009557-shoes-name-3.jpg', '2019-05-16 09:25:57', '2019-05-16 09:25:57'),
(14, 4, 'shoes name 4', 'shoes-er-04', '<p><strong>Shoes Description 4</strong></p>\r\n<p><strong>Shoes Description 4</strong></p>\r\n<p><strong>Shoes Description 4</strong></p>', 69.00, '1558009632-shoes-name-4.jpg', '2019-05-16 09:27:12', '2019-05-16 09:27:12'),
(15, 4, 'shoes name 5', 'shoes-er-05', '<p>Shoes Description 5</p>\r\n<p>Shoes Description 5</p>\r\n<p>Shoes Description 5</p>', 80.00, '1558009664-shoes-name-5.jpg', '2019-05-16 09:27:44', '2019-05-16 09:27:44'),
(16, 4, 'shoes name 6', 'shoes-er-06', '<p><strong>Shoes Description 6</strong></p>\r\n<p><strong>Shoes Description 6</strong></p>\r\n<p><strong>Shoes Description 6</strong></p>', 49.00, '1558009693-shoes-name-6.jpg', '2019-05-16 09:28:13', '2019-05-16 09:28:13'),
(17, 4, 'shoes name 7', 'shoes-er-07', '<p><strong>Shoes Description 7</strong></p>\r\n<p><strong>Shoes Description 7</strong></p>\r\n<p><strong>Shoes Description 7</strong></p>', 20.00, '1558009729-shoes-name-7.jpg', '2019-05-16 09:28:49', '2019-05-16 09:28:49'),
(18, 4, 'shoes name 8', 'shoes-er-08', '<p><strong>Shoes Description 8</strong></p>\r\n<p><strong>Shoes Description 8</strong></p>\r\n<p><strong>Shoes Description 8</strong></p>', 88.00, '1558009754-shoes-name-8.jpg', '2019-05-16 09:29:14', '2019-05-16 09:29:14'),
(19, 4, 'shoes name 9', 'shoes-er-09', '<p><strong>Shoes Description 9</strong></p>\r\n<p><strong>Shoes Description 9</strong></p>\r\n<p><strong>Shoes Description 9</strong></p>', 90.00, '1558009782-shoes-name-9.jpg', '2019-05-16 09:29:42', '2019-05-16 09:29:42'),
(20, 4, 'shoes name 10', 'shoes-er-010', '<p><strong>Shoes Description 10</strong></p>\r\n<p><strong>Shoes Description 10</strong></p>\r\n<p><strong>Shoes Description 10</strong></p>\r\n<p><strong>Shoes Description 10</strong></p>\r\n<p><strong>Shoes Description 10</strong></p>\r\n<p><strong>Shoes Description 10</strong></p>', 59.00, '1558009816-shoes-name-10.jpg', '2019-05-16 09:30:16', '2019-05-16 09:30:16'),
(21, 5, 'purse name 1', 'purse-ka-01', '<p><strong>Purse Description 1</strong></p>\r\n<p><strong>Purse Description 1</strong></p>\r\n<p><strong>Purse Description 1</strong></p>\r\n<p><strong>Purse Description 1&nbsp;</strong><strong>Purse Description 1&nbsp;</strong><strong>Purse Description 1</strong></p>\r\n<p><strong>Purse Description 1</strong></p>\r\n<p><strong>Purse Description 1</strong></p>', 19.00, '1558009920-purse-name-1.jpg', '2019-05-16 09:32:01', '2019-05-16 09:32:01'),
(22, 5, 'purse name 2', 'purse-ka-02', '<p><strong>Purse Description 2</strong></p>\r\n<p><strong>Purse Description 2</strong></p>\r\n<p><strong>Purse Description 2</strong></p>\r\n<p><strong>Purse Description 2</strong></p>', 20.00, '1558009949-purse-name-2.jpg', '2019-05-16 09:32:29', '2019-05-16 09:32:29'),
(23, 5, 'purse name 3', 'purse-ka-03', '<p><strong>Purse Description 3</strong></p>\r\n<p><strong>Purse Description 3</strong></p>\r\n<p><strong>Purse Description 3</strong></p>\r\n<p><strong>Purse Description 3</strong><strong>Purse Description 3</strong><strong>Purse Description 3</strong><strong>Purse Description 3</strong></p>', 30.00, '1558009978-purse-name-3.jpg', '2019-05-16 09:32:58', '2019-05-16 09:32:58'),
(24, 5, 'purse name 4', 'purse-ka-04', '<p><strong>Purse Description 4</strong></p>\r\n<p><strong>Purse Description 4</strong></p>\r\n<p><strong>Purse Description 4</strong><strong>Purse Description 4</strong><strong>Purse Description 4</strong><strong>Purse Description 4</strong></p>', 40.00, '1558010007-purse-name-4.jpg', '2019-05-16 09:33:27', '2019-05-16 09:33:27'),
(25, 5, 'purse name 5', 'purse-ka-05', '<p><strong>Purse Description 5</strong></p>\r\n<p><strong>Purse Description 5</strong></p>\r\n<p><strong>Purse Description 5</strong></p>', 50.00, '1558010034-purse-name-5.jpg', '2019-05-16 09:33:54', '2019-05-16 09:33:54'),
(26, 5, 'purse name 6', 'purse-ka-06', '<p><strong>Purse Description 6</strong></p>\r\n<p><strong>Purse Description 6</strong></p>\r\n<p><strong>Purse Description 6</strong><strong>Purse Description 6</strong><strong>Purse Description 6</strong></p>', 60.00, '1558010062-purse-name-6.jpg', '2019-05-16 09:34:22', '2019-05-16 09:34:22'),
(27, 5, 'purse name 7', 'purse-ka-07', '<p><strong>Purse Description 7</strong></p>\r\n<p><strong>Purse Description 7</strong></p>\r\n<p><strong>Purse Description 7</strong></p>', 70.00, '1558010088-purse-name-7.jpg', '2019-05-16 09:34:48', '2019-05-16 09:34:48'),
(28, 5, 'purse name 8', 'purse-ka-08', '<h1><strong>Purse Description 8</strong></h1>\r\n<h2><strong>Purse Description 8</strong></h2>\r\n<h3><strong>Purse Description 8</strong></h3>', 80.00, '1558010145-purse-name-8.jpg', '2019-05-16 09:35:45', '2019-05-16 09:35:45'),
(29, 5, 'purse name 9', 'purse-ka-09', '<h1><strong>Purse Description 9</strong></h1>\r\n<h2><strong>Purse Description 9</strong></h2>\r\n<h3><strong>Purse Description 9</strong></h3>', 90.00, '1558010191-purse-name-9.jpg', '2019-05-16 09:36:31', '2019-05-16 09:36:31'),
(30, 5, 'purse name 10', 'purse-ka-010', '<p><strong>Purse Description 10</strong></p>\r\n<p><strong>Purse Description 10</strong></p>\r\n<p><strong>Purse Description 10&nbsp;</strong><strong>Purse Description 10&nbsp;</strong><strong>Purse Description 10</strong></p>', 95.00, '1558010226-purse-name-10.jpg', '2019-05-16 09:37:06', '2019-05-16 09:37:06');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `product_att`
--

CREATE TABLE `product_att` (
  `id` int(10) UNSIGNED NOT NULL,
  `products_id` int(11) NOT NULL,
  `sku` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `product_att`
--

INSERT INTO `product_att` (`id`, `products_id`, `sku`, `size`, `price`, `stock`, `created_at`, `updated_at`, `color`) VALUES
(1, 30, 'purse-ka-0100', 'large', 95.00, 20, '2019-05-16 09:41:06', '2019-05-16 09:43:36', 'siyah'),
(2, 30, 'purse-ka-0110', 'medium', 95.00, 20, '2019-05-16 09:41:33', '2019-05-16 09:43:36', 'siyah'),
(3, 30, 'purse-ka-0120', 'large', 95.00, 20, '2019-05-16 09:41:49', '2019-05-16 09:43:36', 'beyaz'),
(4, 30, 'purse-ka-0130', 'medium', 95.00, 20, '2019-05-16 09:42:02', '2019-05-16 09:43:37', 'beyaz'),
(5, 29, 'purse-ka-090', 'large', 90.00, 20, '2019-05-16 09:42:32', '2019-05-16 09:43:05', 'siyah'),
(6, 29, 'purse-ka-091', 'medium', 90.00, 20, '2019-05-16 09:42:55', '2019-05-16 09:43:05', 'siyah'),
(7, 28, 'purse-ka-080', 'large', 80.00, 20, '2019-05-16 09:44:05', '2019-05-16 09:44:59', 'beyaz'),
(8, 28, 'purse-ka-081', 'medium', 80.00, 20, '2019-05-16 09:44:21', '2019-05-16 09:44:59', 'beyaz'),
(9, 28, 'purse-ka-082', 'large', 80.00, 20, '2019-05-16 09:44:51', '2019-05-16 09:44:59', 'orange'),
(10, 27, 'purse-ka-070', 'large', 70.00, 20, '2019-05-16 09:47:48', '2019-05-16 09:48:40', 'beyaz'),
(11, 27, 'purse-ka-071', 'medium', 70.00, 20, '2019-05-16 09:48:07', '2019-05-16 09:48:40', 'beyaz'),
(12, 27, 'purse-ka-072', 'large', 70.00, 20, '2019-05-16 09:48:25', '2019-05-16 09:48:40', 'kırmızı'),
(13, 26, 'purse-ka-060', 'large', 60.00, 20, '2019-05-16 09:49:07', '2019-05-16 09:50:16', 'siyah'),
(14, 26, 'purse-ka-061', 'large', 60.00, 20, '2019-05-16 09:49:20', '2019-05-16 09:50:16', 'beyaz'),
(15, 25, 'purse-ka-05', 'large', 50.00, 20, '2019-05-16 09:50:46', '2019-05-16 09:50:46', 'beyaz'),
(16, 24, 'purse-ka-040', 'medium', 40.00, 0, '2019-05-16 09:51:15', '2019-05-16 11:05:54', 'siyah'),
(17, 23, 'purse-ka-0300', 'large', 30.00, 20, '2019-05-16 09:54:03', '2019-05-16 09:55:15', 'siyah'),
(18, 23, 'purse-ka-031', 'medium', 30.00, 20, '2019-05-16 09:54:30', '2019-05-16 09:55:15', 'siyah'),
(19, 23, 'purse-ka-032', 'large', 30.00, 20, '2019-05-16 09:54:41', '2019-05-16 09:55:15', 'beyaz'),
(20, 23, 'purse-ka-033', 'medium', 30.00, 20, '2019-05-16 09:55:02', '2019-05-16 09:55:15', 'beyaz'),
(21, 22, 'purse-ka-020', 'large', 20.00, 20, '2019-05-16 09:55:39', '2019-05-16 09:55:43', 'siyah'),
(22, 21, 'purse-ka-010', 'medium', 19.00, 20, '2019-05-16 09:56:12', '2019-05-16 09:56:12', 'siyah'),
(23, 20, 'shoes-er-0101', '38', 59.00, 20, '2019-05-16 10:04:39', '2019-05-16 10:05:51', 'siyah'),
(24, 20, 'shoes-er-0102', '40', 59.00, 20, '2019-05-16 10:04:55', '2019-05-16 10:05:52', 'beyaz'),
(25, 20, 'shoes-er-0103', '42', 59.00, 20, '2019-05-16 10:05:16', '2019-05-16 10:05:52', 'beyaz'),
(26, 20, 'shoes-er-0104', '40', 59.00, 20, '2019-05-16 10:05:35', '2019-05-16 10:05:52', 'siyah'),
(27, 19, 'shoes-er-09', '40', 90.00, 10, '2019-05-16 10:09:17', '2019-05-16 10:09:17', 'siyah'),
(28, 19, 'shoes-er-09', '42', 90.00, 10, '2019-05-16 10:09:38', '2019-05-16 10:09:38', 'siyah'),
(29, 19, 'shoes-er-09', '44', 90.00, 10, '2019-05-16 10:09:50', '2019-05-16 10:09:50', 'siyah'),
(30, 18, 'shoes-er-08', '40', 88.00, 10, '2019-05-16 10:42:28', '2019-05-16 10:42:28', 'siyah'),
(31, 18, 'shoes-er-08', '42', 88.00, 10, '2019-05-16 10:42:42', '2019-05-16 10:42:42', 'siyah'),
(32, 18, 'shoes-er-08', '44', 88.00, 10, '2019-05-16 10:42:56', '2019-05-16 10:42:56', 'siyah'),
(33, 17, 'shoes-er-070', '40', 20.00, 10, '2019-05-16 10:44:14', '2019-05-16 10:45:16', 'beyaz'),
(34, 17, 'shoes-er-071', '42', 20.00, 10, '2019-05-16 10:44:54', '2019-05-16 10:45:16', 'beyaz'),
(35, 17, 'shoes-er-072', '44', 20.00, 10, '2019-05-16 10:45:07', '2019-05-16 10:45:16', 'beyaz'),
(36, 16, 'shoes-er-060', '40', 49.00, 10, '2019-05-16 10:46:22', '2019-05-16 10:47:28', 'kahverengi'),
(37, 16, 'shoes-er-061', '42', 49.00, 10, '2019-05-16 10:46:52', '2019-05-16 10:47:28', 'kahverengi'),
(38, 16, 'shoes-er-062', '44', 49.00, 10, '2019-05-16 10:47:14', '2019-05-16 10:47:29', 'kahverengi'),
(39, 15, 'shoes-er-050', '40', 80.00, 15, '2019-05-16 10:48:01', '2019-05-16 10:48:21', 'siyah'),
(40, 15, 'shoes-er-051', '42', 80.00, 15, '2019-05-16 10:48:14', '2019-05-16 10:48:21', 'siyah'),
(41, 10, 'jeans-er-010', '34', 90.00, 30, '2019-05-16 10:49:46', '2019-05-16 10:49:46', 'mavi'),
(42, 10, 'jeans-er-010', '36', 90.00, 30, '2019-05-16 10:50:01', '2019-05-16 10:50:01', 'mavi'),
(43, 10, 'jeans-er-010', '38', 90.00, 30, '2019-05-16 10:50:14', '2019-05-16 10:50:14', 'mavi'),
(44, 9, 'jeans-er-09', '30', 70.00, 15, '2019-05-16 10:50:52', '2019-05-16 10:50:52', 'mavi'),
(45, 9, 'jeans-er-09', '32', 70.00, 15, '2019-05-16 10:51:05', '2019-05-16 10:51:05', 'mavi'),
(46, 9, 'jeans-er-09', '34', 70.00, 15, '2019-05-16 10:51:19', '2019-05-16 10:51:19', 'mavi'),
(47, 9, 'jeans-er-09', '30', 70.00, 15, '2019-05-16 10:51:29', '2019-05-16 10:51:29', 'siyah'),
(48, 9, 'jeans-er-09', '32', 70.00, 15, '2019-05-16 10:51:47', '2019-05-16 10:51:47', 'siyah'),
(49, 9, 'jeans-er-09', '34', 70.00, 15, '2019-05-16 10:52:01', '2019-05-16 10:52:01', 'siyah'),
(50, 8, 'jeans-er-08', '28', 60.00, 10, '2019-05-16 10:52:48', '2019-05-16 10:52:48', 'mavi'),
(51, 8, 'jeans-er-08', '30', 60.00, 10, '2019-05-16 10:53:18', '2019-05-16 10:53:18', 'mavi'),
(52, 7, 'jeans name 7', '32', 55.00, 10, '2019-05-16 10:54:34', '2019-05-16 10:54:34', 'mavi'),
(53, 6, 'jeans-er-06', '36', 45.00, 30, '2019-05-16 10:55:04', '2019-05-16 10:55:04', 'mavi'),
(54, 5, 'jeans-er-05', '30', 40.00, 15, '2019-05-16 10:55:21', '2019-05-16 10:55:21', 'siyah'),
(55, 4, 'jeans-er-04', '34', 35.00, 0, '2019-05-16 10:55:40', '2019-05-16 11:05:55', 'mavi'),
(56, 3, 'jeans-er-03', '34', 30.00, 10, '2019-05-16 10:56:35', '2019-05-16 10:56:35', 'mavi'),
(57, 2, 'jeans-er-02', '34', 25.00, 20, '2019-05-16 10:56:52', '2019-05-16 10:56:52', 'siyah'),
(58, 1, 'jeans-er-01', '30', 20.00, 15, '2019-05-16 10:57:15', '2019-05-16 10:57:15', 'beyaz'),
(59, 14, 'shoes-er-04', '40', 69.00, 0, '2019-05-16 10:59:04', '2019-05-16 11:05:54', 'kırmızı'),
(60, 13, 'shoes-er-03', '44', 75.00, 10, '2019-05-16 10:59:29', '2019-05-16 10:59:29', 'beyaz'),
(61, 12, 'shoes-er-02', '38', 30.00, 10, '2019-05-16 10:59:48', '2019-05-16 10:59:48', 'siyah'),
(62, 11, 'shoes-er-01', '45', 60.00, 10, '2019-05-16 11:00:09', '2019-05-16 11:00:09', 'beyaz');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tblgallery`
--

CREATE TABLE `tblgallery` (
  `id` int(10) UNSIGNED NOT NULL,
  `products_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`, `address`, `city`, `country`, `mobile`) VALUES
(1, 'admin', 'admin@admin.com', NULL, '$2y$10$AD8zWFfyagLZac2.WxX.BOmTpHmWg1PA12/Udy6slde4CXwL6C4VS', 1, NULL, '2019-05-16 09:06:02', '2019-05-16 09:06:02', NULL, NULL, NULL, NULL),
(2, 'customer', 'customer@gmail.com', NULL, '$2y$10$SOLtZIeEB5qG6JPB1wOer.U6UYGOe2bgozJlHsL6pBbox1nq2VC4O', NULL, NULL, '2019-05-16 11:03:48', '2019-05-16 11:03:48', 'customer address', 'customer city', 'turkey', '0123456789');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`name`);

--
-- Tablo için indeksler `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `product_att`
--
ALTER TABLE `product_att`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `tblgallery`
--
ALTER TABLE `tblgallery`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- Tablo için AUTO_INCREMENT değeri `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `order_products`
--
ALTER TABLE `order_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `product_att`
--
ALTER TABLE `product_att`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- Tablo için AUTO_INCREMENT değeri `tblgallery`
--
ALTER TABLE `tblgallery`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
