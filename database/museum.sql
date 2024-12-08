-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 08:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `museum`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `status` enum('new','progress','delivered','cancel') NOT NULL DEFAULT 'new',
  `quantity` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `order_id`, `user_id`, `price`, `status`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 100.00, 'new', 2, 200.00, '2024-11-10 05:26:05', '2024-11-10 05:34:01'),
(2, 1, NULL, 1, 100.00, 'new', 1, 100.00, '2024-11-10 05:34:26', '2024-11-10 05:34:26'),
(3, 2, 2, 24, 150.00, 'new', 1, 150.00, '2024-11-11 01:33:07', '2024-11-11 02:12:15'),
(4, 1, 2, 24, 100.00, 'new', 1, 100.00, '2024-11-11 01:43:01', '2024-11-11 02:12:15'),
(5, 2, 3, 26, 150.00, 'new', 1, 150.00, '2024-11-11 02:42:05', '2024-11-11 02:43:49'),
(6, 1, NULL, 24, 100.00, 'new', 1, 100.00, '2024-11-11 04:32:17', '2024-11-11 04:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `summary` text DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT 1,
  `is_sub_category` tinyint(1) DEFAULT 0,
  `is_child_sub_category` tinyint(1) DEFAULT 0,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `platform` enum('web','app') NOT NULL DEFAULT 'web',
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `summary`, `photo`, `is_parent`, `is_sub_category`, `is_child_sub_category`, `parent_id`, `platform`, `added_by`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Digital Images', 'digital-images', '<p><b>Test</b></p>', 'photos/ProductCategory/1731232919.jpg', 1, 0, 0, NULL, 'web', NULL, 'active', '2024-11-10 05:01:59', '2024-11-10 05:01:59'),
(2, 'Artefacts', 'artefacts', '<p>test</p>', 'photos/ProductCategory/1731232942.jpg', 1, 0, 0, NULL, 'web', NULL, 'active', '2024-11-10 05:02:22', '2024-11-10 05:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_07_10_025334_create_banners_table', 1),
(6, '2020_07_10_112147_create_categories_table', 1),
(7, '2020_07_11_063857_create_products_table', 1),
(11, '2020_07_13_151329_create_messages_table', 1),
(12, '2020_07_14_023748_create_shippings_table', 1),
(13, '2020_07_15_054356_create_orders_table', 1),
(14, '2020_07_15_102626_create_carts_table', 1),
(15, '2020_07_16_041623_create_notifications_table', 1),
(16, '2020_07_16_053240_create_coupons_table', 1),
(17, '2020_07_23_143757_create_wishlists_table', 1),
(18, '2020_07_24_074930_create_product_reviews_table', 1),
(19, '2020_07_24_131727_create_post_comments_table', 1),
(20, '2020_08_01_143408_create_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_total` double(8,2) NOT NULL,
  `discount` decimal(10,0) NOT NULL DEFAULT 0,
  `shipping_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon` double(8,2) DEFAULT NULL,
  `total_amount` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_method` enum('stripe','paypal','cash','cardpay') NOT NULL DEFAULT 'stripe',
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `status` enum('new','process','delivered','cancel') NOT NULL DEFAULT 'new',
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `post_code` varchar(255) DEFAULT NULL,
  `tracking_number` text DEFAULT NULL,
  `address1` text DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `sub_total`, `discount`, `shipping_id`, `coupon`, `total_amount`, `quantity`, `payment_method`, `payment_status`, `status`, `first_name`, `last_name`, `email`, `phone`, `country`, `post_code`, `tracking_number`, `address1`, `address2`, `created_at`, `updated_at`) VALUES
(1, 'ORD-V1WD7I6LDA', 1, 200.00, 0, 2, NULL, 210.00, 2, 'stripe', 'paid', 'new', 'Shawaz', 'ul Rehman', 'bajwashawaz11@gmail.com', '3147851757', 'PK', '51530', NULL, 'test', 'test', '2024-11-10 05:32:40', '2024-11-10 05:34:01'),
(2, 'ORD-TLEF08OCTV', 24, 250.00, 0, 2, NULL, 260.00, 2, 'stripe', 'paid', 'new', 'Shawaz', 'ul Rehman', 'bajwashawaz11@gmail.com', '3147851757', 'US', '51530', NULL, 'test', 'test', '2024-11-11 02:11:01', '2024-11-11 02:12:15'),
(3, 'ORD-QAIJJKKWCF', 26, 150.00, 0, 1, NULL, 150.00, 1, 'stripe', 'paid', 'new', 'Tester', 'Test', 'tester@test.com', '3147851757', 'AF', '51530', NULL, 'test', 'test', '2024-11-11 02:43:22', '2024-11-11 02:43:49'),
(4, 'ORD-NEMUKIVSNL', 24, 100.00, 0, 2, NULL, 115.00, 1, 'stripe', 'unpaid', 'new', 'Test', 'Hi', 'test@test', '102983', 'US', '51539', NULL, 'west', 'test', '2024-11-11 04:35:46', '2024-11-11 04:35:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('bajwashawaz@gmail.com', '$2y$10$wfH6sXdfgDszBJfOn0pU0.emRHnJ13BnLgS/AUVwvtR8FT2prxPU6', '2024-05-13 04:11:47'),
('admin@cosmoseworld.fr', '$2y$10$s4yyz5ZFH86mpzKzV/YzCuOHtIfqAub3ja4t.mD5P/bYxs5bvi7La', '2024-05-27 07:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `summary` text NOT NULL,
  `description` longtext DEFAULT NULL,
  `photo` text NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `mainfile` text DEFAULT NULL,
  `condition` enum('default','new','hot') NOT NULL DEFAULT 'default',
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `discount` double(8,2) NOT NULL DEFAULT 0.00,
  `is_featured` tinyint(1) NOT NULL,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `summary`, `description`, `photo`, `stock`, `price`, `mainfile`, `condition`, `status`, `discount`, `is_featured`, `cat_id`, `child_cat_id`, `created_at`, `updated_at`) VALUES
(1, 'White Statue', 'white-statue', '<p>White Statue</p>', '<p>White Statue</p>', 'photos/Product/1731233752.jpg', 100, 100.00, NULL, 'new', 'active', 0.00, 1, 2, NULL, '2024-11-10 05:15:52', '2024-11-10 05:15:52'),
(2, 'Real Painting', 'real-painting', '<p>Beautiful Historical Painting</p>', '<p>Good Painting</p>', 'photos/Product/1731305438.png', 1000, 150.00, 'Digital/1731305438_images.zip', 'hot', 'active', 0.00, 1, 1, NULL, '2024-11-11 01:10:38', '2024-11-11 01:10:38'),
(3, 'Test', 'test', '<p>test</p>', '<p>test</p>', 'photos/Product/1731311422.jpg', 1000, 200.00, 'Digital/1731311422_images.zip', 'default', 'active', 0.00, 1, 1, NULL, '2024-11-11 02:50:22', '2024-11-11 02:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `type`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Digital', 0.00, 'active', '2024-11-10 05:03:53', '2024-11-10 05:03:53'),
(2, 'Home Delivery', 15.00, 'active', '2024-11-10 05:04:10', '2024-11-11 02:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `username` text DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `postal_code` text DEFAULT NULL,
  `city` text DEFAULT NULL,
  `country` text DEFAULT NULL,
  `role` enum('admin','user','vendor','author') NOT NULL DEFAULT 'user',
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address1` text DEFAULT NULL,
  `address2` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `postal_code`, `city`, `country`, `role`, `status`, `remember_token`, `created_at`, `updated_at`, `phone`, `address1`, `address2`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', '2024-06-05 18:06:50', '$2y$10$81Pf2wirDHhBzaLADHDEJuaTTh5cAK4IBAgbVZEkzRzAv8GBdRnM2', 'photos/User/1717488598.jpg', '59000', 'LILLE', 'FR', 'admin', 'active', NULL, '2024-11-11 01:54:13', '2024-11-11 01:54:13', '031457245367', 'Lahore', 'DHA'),
(24, 'Test', NULL, 'test@gmail.com', NULL, '$2y$10$MDaOho/IbLRAI.1krhwnKuSCaZFa7dZckPYJpVm5iwO/6fERh70Y2', '/storage/photos/24/ancient-3143739_1920.jpg', NULL, NULL, NULL, 'user', 'active', NULL, '2024-11-11 00:16:07', '2024-11-11 00:36:23', NULL, NULL, NULL),
(25, 'Shawaz Bajwa', NULL, 'bajwashawaz11@gmail.com', NULL, '$2y$10$g42918DxFWJYfa3rEzBoLeysQfKGuhTwjmlBr3.nqSmI5PmEviD.i', 'photos/User/1731303986.jpg', NULL, NULL, NULL, 'user', 'active', NULL, '2024-11-11 00:46:26', '2024-11-11 00:46:26', NULL, NULL, NULL),
(26, 'Tester', NULL, 'tester@test.com', NULL, '$2y$10$CRmPwKfVzsk3bLIOJdQfC.aXL8OMue1U6XciE5RoZK1.VB.T1NdWe', NULL, NULL, NULL, NULL, 'user', 'active', NULL, '2024-11-11 02:41:19', '2024-11-11 02:41:19', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `cart_id`, `user_id`, `price`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 1, 100.00, 1, 100.00, '2024-11-10 05:19:24', '2024-11-10 05:19:24'),
(2, 1, NULL, 26, 100.00, 1, 100.00, '2024-11-11 02:42:16', '2024-11-11 02:42:16'),
(3, 2, NULL, 24, 150.00, 1, 150.00, '2024-11-11 04:32:23', '2024-11-11 04:32:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_order_id_foreign` (`order_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_added_by_foreign` (`added_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_shipping_id_foreign` (`shipping_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_cat_id_foreign` (`cat_id`),
  ADD KEY `products_child_cat_id_foreign` (`child_cat_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_cart_id_foreign` (`cart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_child_cat_id_foreign` FOREIGN KEY (`child_cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
