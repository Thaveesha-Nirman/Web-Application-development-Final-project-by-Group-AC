-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2025 at 09:38 PM
-- Server version: 8.0.42
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mobile_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `created_at`) VALUES
(14, 21, 30, 1, '2025-09-14 09:20:28'),
(15, 21, 29, 1, '2025-09-14 09:20:30'),
(16, 21, 27, 1, '2025-09-14 09:20:31'),
(17, 21, 26, 1, '2025-09-14 09:20:32'),
(37, 18, 29, 1, '2025-09-16 19:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Smartphones'),
(2, 'Accessories'),
(3, 'Tablets');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `first_name`, `last_name`, `email`, `phone`, `subject`, `message`, `created_at`) VALUES
(1, 'ds', 'ds', 'ds@dsds.com', 'ds', 'general', 'dsd', '2025-09-11 22:02:32');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(50) DEFAULT NULL,
  `customer_address` text,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) DEFAULT 'COD',
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `total_amount`, `payment_method`, `order_date`, `status`, `created_at`) VALUES
(4, 18, 'Thaveesha', 'thaveesha@gmail.com', '0704250264', 'tangalle,srilanka', 295000.00, 'COD', '2025-09-17 00:58:01', 'Pending', '2025-09-16 19:28:01'),
(5, 18, 'dsds', 'sdsds@sdsds', '231321321', 'sdd', 47000.00, 'COD', '2025-09-17 00:58:53', 'Pending', '2025-09-16 19:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(4, 4, 30, 1, 295000.00),
(5, 5, 29, 1, 47000.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text,
  `price` decimal(10,2) DEFAULT NULL,
  `stock` int DEFAULT '0',
  `category_id` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `category_id`, `image`, `image2`, `created_at`) VALUES
(13, 'iPhone 16 Pro', '128GB • 6.1\" Display\r\nA18 Pro Chip • Triple Camera', 365000.00, 0, 1, '1757779223_1_16pm.png', '1757779223_2_16pm2.png', '2025-09-13 16:00:23'),
(14, 'Apple iPhone 15 128GB', '128GB • 6.8\" Display\r\nApple A16 Bionic chip', 198000.00, 0, 1, '1757779279_1_15pm1.png', '1757779279_2_152.png', '2025-09-13 16:01:19'),
(15, 'Apple iPhone 15 Pro Max 512GB', '512GB •Display: 6.7 inches\r\nProcessor: Apple A17 Pro • 48MP Main |Ultra Wide | Telephoto', 369900.00, 0, 1, '1757779334_1_1757686058_1_15pmx2.png', '1757779334_2_1757659331_15pmx1.png', '2025-09-13 16:02:14'),
(16, 'OnePlus 11 5G 16GB RAM 256GB', '256GB • 6.82\" Display\r\nSnapdragon 8 Gen 3 • 100W Fast Charge', 245700.00, 0, 1, '1757779376_1_2-333333333332-removebg-preview.png', '1757779376_2_1-2-removebg-preview.png', '2025-09-13 16:02:56'),
(17, 'Google Pixel 9 12GB RAM 256GB', '256GB • 6.36\" Display\r\nGoogle Tensor G4 Processor • Advanced camera and AI photo editing', 255500.00, 0, 1, '1757779420_1_xmobile-pixel-9pro-porceline-removebg-preview.png', '1757779420_2_xmobile-pixel-9pro-porceline-removebg-preview.png', '2025-09-13 16:03:40'),
(18, 'Google Pixel 8 8GB RAM 128GB', '128GB • 6.1\" Display\r\nTensor G3 Processor • 50MP + 12MP | 10.5MP Front Camera', 144990.00, 0, 1, '1757779494_1_Google-Pixel-8A-8GB-RAM-128GB-Bay-removebg-preview.png', '1757779494_2_33333333333333333-removebg-preview.png', '2025-09-13 16:04:54'),
(19, 'Samsung Galaxy S23 Ultra 12GB RAM 1TB', '1TB • 6.8\" Display\r\nSnapdragon 8 Gen 2 •200MP camera, the highest resolution on a phone', 300000.00, 0, 1, '1757779604_1_2eeeeeeeeeeee-5-removebg-preview.png', '1757779604_2_2eeeeeeeeeeee-5-removebg-preview.png', '2025-09-13 16:06:44'),
(20, 'Google Pixel 9 Pro Fold 16GB RAM 256GB', '256GB • 6.3\" Display\r\nGoogle Tensor G2 • AI Features', 449000.00, 0, 1, '1757779647_1_Goo2333333333333333333333gle-Pixel-9-Pro-Fold-16GB-RAM-256GB-2-removebg-preview.png', '1757779647_2_Google-Pixel-9-Pro-Fold-16GB-RAM-256GB-1-removebg-preview.png', '2025-09-13 16:07:27'),
(21, 'Honor X9B 12GB RAM 256GB', '256GB • 6.7\" Display\r\nSnapdragon 8 Gen 2 • 80W Fast Charge', 129999.00, 0, 1, '1757779742_1_555555555555-removebg-preview.png', '1757779742_2_XMOBILE-NEW-2024-SEPTEMBER-removebg-preview.png', '2025-09-13 16:09:02'),
(22, 'Samsung Galaxy Z Flip 6 12GB RAM 256GB', '256GB • 6.36\" Display\r\nSnapdragon 8 Gen 2 • 50MP + 12MP | 10MP Front Camera', 225000.00, 0, 1, '1757779765_1_Samsung-Galaxy-Z-Flip-6-12GB-RAM-256GB-1-removebg-preview.png', '1757779765_2_3333333333333333333333Samsung-Galaxy-Z-Flip-6-12GB-RAM-256GB-3-removebg-preview.png', '2025-09-13 16:09:25'),
(23, 'Nothing Phone (2) 12GB RAM 512GB', '512GB • Display: 6.7 inches\r\nSnapdragon 8+ Gen 1 • Dual Camera', 256600.00, 0, 1, '1757779793_1_nothing-phone-1__1_-removebg-preview.png', '1757779793_2_nothi66666666666666666666666666667ng-phone-1-2-removebg-preview.png', '2025-09-13 16:09:53'),
(25, 'Pixel 6 Pro', '128GB • 6.1\" Display\r\nGoogle Tensor • Triple Camera', 101300.00, 0, 1, '1757779864_1_Google-Pixel-6-Pro-12GB-RAM-128GB-removebg-preview.png', '1757779864_2_Google-Pixel-6-Pro-12GB-RAM-128GB-removebg-preview.png', '2025-09-13 16:11:04'),
(26, 'Samsung Galaxy Z Fold 7 512GB', '512GB • Bigger screen inside: 6.9” (up from 6.7”)\r\n• Triple Camera', 509900.00, 0, 1, '1757779910_1_Sa222222222222222222222msung-Galaxy-Z-Fold-7-256GB-2-removebg-preview.png', '1757779910_2_Samsung-Galaxy-Z-Fold-7-256GB-555-removebg-preview.png', '2025-09-13 16:11:50'),
(27, 'Samsung Galaxy S25 Plus 5G 12GB RAM 256GB', '256GB • 6.7\" Display\r\nChip: Qualcomm SM8750-AB Snapdragon 8 Elite (3 nm) • Triple Camera', 229000.00, 0, 1, '1757779943_1_sam1.png', '1757779943_2_sam2.png', '2025-09-13 16:12:23'),
(29, 'Samsung A06 5G 6GB RAM 128GB', '128GB • 6.6\" Display\r\nMediaTek 1080 • Dual camera', 47000.00, 4, 1, '1757780005_1_Sakkkkkkkkkkkkkkkkmsung-Galaxy-A06-3-removebg-preview.png', '1757780005_2_Samsung-Galaxy-A06-1-removebg-preview.png', '2025-09-13 16:13:25'),
(30, 'Samsung Galaxy S25 Ultra 5G 12GB RAM 512GB', '512GB • Display: 6.9″\r\nChip: Qualcomm SM8750-AB Snapdragon 8 Elite (3 nm) •Battery: Li-Ion 5000 mAh Battery', 295000.00, 0, 1, '1757780031_1_snnnnnnnnnnn25-u2-removebg-preview.png', '1757780031_2_phone2.png', '2025-09-13 16:13:51');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('superadmin','admin','customer') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(18, 'Admin', 'admin@admin.com', '$2y$10$r/7fmrNwvdIVX94B4VM8LOf7nIFemX7IXV.mDGQkGuJuFFZlO7dda', 'superadmin', '2025-09-14 08:39:02'),
(21, 'Thaveesha', 'thaveesha@gmail.com', '$2y$10$jp89wrFC28l2SDJY3.96zO1C7Lm2.id1B78DjdPHb1YRVaBrN54U6', 'superadmin', '2025-09-14 09:20:16'),
(25, 'User', 'user@user.com', '$2y$10$BiwXF0x1h65X5Yrk0hrwqODGRSYVprQ6qXIZx8qCV0r7ZGq6MCpDe', 'customer', '2025-09-16 19:24:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
