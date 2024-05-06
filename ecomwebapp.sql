-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 07:41 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecomwebapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `customerId` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(8, '2024_04_06_133413_create_users_table', 1),
(9, '2024_04_06_145146_create_sessions_table', 1),
(10, '2024_04_07_051824_create_products_table', 2),
(11, '2024_04_07_080707_create_carts_table', 3),
(12, '2024_04_07_114040_create_orders_table', 4),
(13, '2024_04_07_114126_create_order_items_table', 4),
(14, '2024_05_04_180546_add_column_status_to_users', 5),
(15, '2024_05_04_181353_add_column_status_to_users', 6),
(16, '2024_05_04_181609_add_column_status_to_users', 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customerId` int(11) NOT NULL,
  `bill` double NOT NULL,
  `status` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customerId`, `bill`, `status`, `address`, `fullname`, `phone`, `created_at`, `updated_at`) VALUES
(13, 2, 740, 'Delivered', 'Jaipur India', 'Vaibhav Vats', '2468101214', '2024-04-07 07:02:51', '2024-05-05 05:54:51'),
(14, 2, 440, 'Delivered', 'Jaipur India', 'Vaibhav Vats', '2334332211', '2024-04-07 07:32:27', '2024-05-05 05:51:20'),
(15, 2, 220, 'Paid', 'Jaipur India', 'Vaibhav Vats', '2334332211', '2024-04-07 08:43:26', '2024-04-07 08:43:26'),
(16, 2, 220, 'Paid', 'Jaipur India', 'Vaibhav Vats', '2334332211', '2024-04-07 08:44:25', '2024-04-07 08:44:25'),
(17, 2, 660, 'Accepted', 'Jaipur India', 'harsh', '9876543210', '2024-04-08 06:41:28', '2024-05-05 05:55:00'),
(18, 2, 440, 'Paid', 'test', 'test', '343445435345', '2024-04-29 01:31:08', '2024-04-29 01:31:08'),
(19, 2, 220, 'Paid', 'harshvatssharma5@gmail.com', 'test', '2468101214', '2024-04-29 01:34:36', '2024-04-29 01:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` int(11) NOT NULL DEFAULT 0,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `price` double NOT NULL DEFAULT 0,
  `orderId` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `productId`, `quantity`, `price`, `orderId`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 220, 13, '2024-04-07 07:02:51', '2024-04-07 07:02:51'),
(4, 2, 2, 150, 13, '2024-04-07 07:02:51', '2024-04-07 07:02:51'),
(5, 1, 2, 220, 14, '2024-04-07 07:32:27', '2024-04-07 07:32:27'),
(6, 1, 1, 220, 16, '2024-04-07 08:44:25', '2024-04-07 08:44:25'),
(7, 1, 3, 220, 17, '2024-04-08 06:41:28', '2024-04-08 06:41:28'),
(8, 1, 2, 220, 18, '2024-04-29 01:31:08', '2024-04-29 01:31:08'),
(9, 1, 1, 220, 19, '2024-04-29 01:34:36', '2024-04-29 01:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `picture`, `description`, `price`, `quantity`, `category`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Men\'s Bag', 'bag.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 220, 20, 'Accessories', 'Best Sellers', NULL, NULL),
(3, 'Men\'s Shoes', 'shoes.jpg', 'Lorem Ipsum is simply dummy shoes of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy shoes ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 190, 20, 'Shoes', 'hot-sales', NULL, NULL),
(4, 'New Black tshirt', 'product-8.jpg', 'Brand new black tshirt with collars. Slim fit durable and stretchable', 290, 20, 'Clothes', 'best-sellers', '2024-04-14 07:20:42', '2024-04-14 08:32:05');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hBYvznijThoFh1VYpHCRdROk8731i6lfax7nPvTT', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo1OntzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL215T3JkZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo2OiJfdG9rZW4iO3M6NDA6IkpabW5HOVJWNU8xSVZHTjBuWlNhNmpPd2RJVG5zQmJvMUdmN3V4SVQiO3M6MjoiaWQiO2k6MjtzOjQ6InR5cGUiO3M6ODoiQ3VzdG9tZXIiO30=', 1714924940);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'Customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `picture`, `type`, `created_at`, `updated_at`, `status`) VALUES
(2, 'harsh sharma', 'harshvatssharma5@gmail.com', '1234', '𝑪𝒓𝒊𝒔𝒕𝒊𝒂𝒏𝒐 𝑹𝒐𝒏𝒂𝒍𝒅𝒐 🥺✨.jpeg', 'Customer', '2024-04-06 23:03:11', '2024-05-05 05:24:57', 'Active'),
(3, 'vaibhav', 'vaibhavvats321@gmail.com', '123', '𝑪𝒓𝒊𝒔𝒕𝒊𝒂𝒏𝒐 𝑹𝒐𝒏𝒂𝒍𝒅𝒐 🥺✨.jpeg', 'Admin', '2024-04-08 09:57:21', '2024-05-05 10:17:00', 'Active'),
(4, 'harsh', 'harshvatssharma@gmail.com', '1234', '𝑪𝒓𝒊𝒔𝒕𝒊𝒂𝒏𝒐 𝑹𝒐𝒏𝒂𝒍𝒅𝒐 🥺✨.jpeg', 'Customer', '2024-04-08 09:57:43', '2024-05-05 05:25:15', 'Blocked');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
