-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2026 at 07:06 PM
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
-- Database: `MKTime`
--

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `full_name`, `email`, `address`) VALUES
(1, 'Jim Bob', 'jdvance@gmail.com', '123 Memory Lane'),
(2, 'Jim Bob', 'jdvance@gmail.com', '123 Memory Lane'),
(3, 'Jim Bob', 'jdvance@gmail.com', '123 Memory Lane'),
(4, 'Jim Bob', 'jdvance@gmail.com', '123 Memory Lane'),
(5, 'Jim Bob', 'jdvance@gmail.com', '123 Memory Lane'),
(6, 'Jim Bob', 'jdvance@gmail.com', '123 Memory Lane'),
(7, 'Jim Bob', 'jdvance@gmail.com', '123 Memory Lane'),
(8, 'Toast@gmail.com', 't@gmail.com', 'toaster');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `total` decimal(8,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total`, `order_date`, `first_name`, `last_name`, `email`, `shipping_address`, `home_address`, `postcode`) VALUES
(1, 3, 300.00, '2026-01-02 17:57:58', NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, 279.00, '2026-01-02 18:18:43', 't', 't', 'test@outlook.com', 't', 't', 't'),
(3, 3, 20000.00, '2026-01-02 18:33:12', 'test', 'test', 'test@outlook.com', 'a', 'a', '123'),
(4, NULL, 300.00, '2026-01-02 18:34:08', 'q', 'q', 'q@q.com', 'qwe', 'qwe', '123');

-- --------------------------------------------------------

--
-- Table structure for table `order_contents`
--

CREATE TABLE `order_contents` (
  `content_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `item_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_contents`
--

INSERT INTO `order_contents` (`content_id`, `order_id`, `item_id`, `quantity`, `price`) VALUES
(1, 1, 1, 3, 101.00),
(2, 2, 1, 1, 101.00),
(3, 2, 6, 1, 100.00),
(4, 3, 3, 1, 100.00),
(5, 4, 1, 2, 101.00),
(6, 5, 1, 2, 101.00),
(7, 6, 1, 2, 101.00),
(8, 6, 3, 1, 100.00),
(9, 6, 4, 1, 101.00),
(10, 6, 5, 3, 100.00),
(11, 7, 1, 2, 101.00),
(12, 8, 6, 1, 100.00),
(13, 8, 4, 1, 101.00),
(14, 8, 1, 1, 101.00),
(15, 9, 1, 5, 101.00),
(16, 9, 3, 2, 100.00),
(17, 9, 4, 10, 101.00),
(18, 9, 5, 2, 100.00),
(19, 9, 6, 10, 100.00),
(20, 10, 5, 1, 20000.00),
(21, 11, 5, 1, 20000.00),
(22, 1, 1, 1, 300.00),
(23, 2, 3, 1, 279.00),
(24, 3, 5, 1, 20000.00),
(25, 4, 1, 1, 300.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `item_id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(100) NOT NULL,
  `item_desc` varchar(255) NOT NULL,
  `item_img` varchar(255) NOT NULL,
  `item_price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`item_id`, `item_name`, `item_desc`, `item_img`, `item_price`) VALUES
(1, 'Apple Watch', 'The ultimate way to watch your health.', 'images/black_apple_watch.jpg', 300.00),
(3, 'Samsung Watch', 'Ultra comfort,\r\nfrom sleep to workout.', 'images/black_samsung_watch.jpg', 279.00),
(4, 'Fake Rolex Mariner', 'With a Mr. Ron Burgandy Face', 'images/golden_ron_burgandy.jpg', 3000.00),
(5, 'Fake Rolex Daytona', 'A Fake Watch With the Real Price, So You Can Show Your Mates How Much it Cost on the Bank Statements.', 'images/rose_gold_mariner.jpg', 20000.00),
(6, 'Fake Patek Phillip From Temu', '根據所有已知嘅航空法則，蜜蜂係冇可能飛得嘅。佢嘅翼太細，唔可以將佢肥肥嘅小身體從地面上拉開。\r\n當然，蜜蜂無論如何都會飛，因為蜜蜂唔會理人類覺得啲咩係唔可能嘅。', 'images/silver_patek_phillip.jpg', 57268.00);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `review_text` text NOT NULL,
  `review_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` tinyint(3) UNSIGNED NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `item_id`, `user_name`, `review_text`, `review_date`, `rating`) VALUES
(1, 1, 'Joe Bennet CEO', 'Dang Good! I like it.', '2025-12-31 13:43:47', 5),
(3, 6, 'Johny Doey', 'not 5 stars as is fake. 4 stars because its class.\r\nstar 1 - works, star 2 - looks great, star 3 - makes me look like a slick rick of a guy, star 4 - the ladies love it', '2025-12-31 17:13:30', 4),
(4, 4, 'Carol Singers', 'these watches are a hit in my dropshipping business!', '2025-12-31 17:17:13', 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `reg_date` datetime NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `shipping_address` varchar(255) DEFAULT NULL,
  `home_address` varchar(255) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `pass`, `reg_date`, `is_admin`, `shipping_address`, `home_address`, `postcode`) VALUES
(1, 'Jack', 'Fox', '123jf@gmail.com', '123456789', '2025-12-30 15:14:02', 0, NULL, NULL, NULL),
(2, 'John', 'Doe', 'JD123@aol.com', 'PS123', '2025-12-30 15:35:45', 0, NULL, NULL, NULL),
(3, 'test', 'test', 'test@outlook.com', 'test12', '2025-12-30 17:30:20', 0, NULL, NULL, NULL),
(103, 'Carol', 'Singers', 'falalalala@lalala.com', 'song', '2025-12-31 17:15:02', 0, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_contents`
--
ALTER TABLE `order_contents`
  ADD PRIMARY KEY (`content_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_contents`
--
ALTER TABLE `order_contents`
  MODIFY `content_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `item_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
