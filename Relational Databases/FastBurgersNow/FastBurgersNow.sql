-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2025 at 10:11 PM
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
-- Database: `FastBurgersNow`
--

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `customer_id` int(11) NOT NULL,
  `customer_surname` varchar(100) NOT NULL,
  `customer_firstname` varchar(100) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_postcode` varchar(20) NOT NULL,
  `customer_suburb` varchar(100) NOT NULL,
  `customer_email` varchar(50) NOT NULL,
  `customer_mobile` varchar(20) NOT NULL,
  `customer_allergy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`customer_id`, `customer_surname`, `customer_firstname`, `customer_address`, `customer_postcode`, `customer_suburb`, `customer_email`, `customer_mobile`, `customer_allergy`) VALUES
(1, 'Doe', 'John', '123 Memory Lane', 'eh1 123', 'trinity', 'johndoe@gmail.com', '0123456789', 'NONE'),
(21, 'Anderson', 'Laura', '12 Birch Street', 'EH1 224', 'Trinity', 'laura.anderson@example.com', '0711111111', 'None'),
(22, 'Miller', 'Jacob', '58 Riverbank Ave', 'EH2 337', 'Leith', 'jacob.miller@example.com', '0722222222', 'Gluten'),
(23, 'Young', 'Sophia', '90 Sunrise Road', 'EH3 448', 'New Town', 'sophia.young@example.com', '0733333333', 'Peanuts'),
(24, 'Harris', 'Daniel', '33 Ridgeway Lane', 'EH4 559', 'Morningside', 'daniel.harris@example.com', '0744444444', 'Shellfish'),
(25, 'King', 'Natalie', '210 Forest Park Dr', 'EH5 661', 'Portobello', 'natalie.king@example.com', '0755555555', 'None'),
(26, 'Wright', 'Ethan', '44 Meadow View', 'EH6 772', 'Stockbridge', 'ethan.wright@example.com', '0766666666', 'Dairy'),
(27, 'Scott', 'Ava', '6 Ocean Breeze Ct', 'EH7 883', 'Dalry', 'ava.scott@example.com', '0777777777', 'Soy'),
(28, 'Green', 'Oliver', '101 Glenwood Drive', 'EH8 994', 'Marchmont', 'oliver.green@example.com', '0788888888', 'Tree Nuts'),
(29, 'Baker', 'Chloe', '155 Lakeview St', 'EH9 112', 'Bruntsfield', 'chloe.baker@example.com', '0799999999', 'Eggs'),
(30, 'Adams', 'Liam', '77 Cedar Grove', 'EH10 221', 'Corstorphine', 'liam.adams@example.com', '0701234567', 'None');

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

CREATE TABLE `Item` (
  `item_id` int(11) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `quality` int(11) DEFAULT NULL,
  `item_name` varchar(100) NOT NULL,
  `menu_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Menu`
--

CREATE TABLE `Menu` (
  `menu_no` int(11) NOT NULL,
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_type` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Ordering`
--

CREATE TABLE `Ordering` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_item` varchar(100) NOT NULL,
  `order_type` varchar(100) NOT NULL,
  `order_time` time NOT NULL DEFAULT curtime(),
  `order_date` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Outlet`
--

CREATE TABLE `Outlet` (
  `outlet_id` int(11) NOT NULL,
  `outlet_suburb` varchar(100) NOT NULL,
  `outlet_phone` varchar(100) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Payment`
--

CREATE TABLE `Payment` (
  `payment_id` int(11) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_amount` decimal(6,2) NOT NULL,
  `sort_code` varchar(20) NOT NULL,
  `account_no` varchar(20) NOT NULL,
  `card_type` varchar(20) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE `Staff` (
  `staff_id` int(11) NOT NULL,
  `staff_surname` varchar(100) NOT NULL,
  `staff_firstname` varchar(100) NOT NULL,
  `staff_email` varchar(100) NOT NULL,
  `staff_mobile` varchar(100) NOT NULL,
  `role` varchar(200) DEFAULT NULL,
  `skill` int(11) DEFAULT NULL,
  `outlet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `Item`
--
ALTER TABLE `Item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `menu_no` (`menu_no`);

--
-- Indexes for table `Menu`
--
ALTER TABLE `Menu`
  ADD PRIMARY KEY (`menu_no`);

--
-- Indexes for table `Ordering`
--
ALTER TABLE `Ordering`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indexes for table `Outlet`
--
ALTER TABLE `Outlet`
  ADD PRIMARY KEY (`outlet_id`);

--
-- Indexes for table `Payment`
--
ALTER TABLE `Payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD KEY `outlet_id` (`outlet_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Item`
--
ALTER TABLE `Item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`menu_no`) REFERENCES `Menu` (`menu_no`);

--
-- Constraints for table `Ordering`
--
ALTER TABLE `Ordering`
  ADD CONSTRAINT `ordering_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`),
  ADD CONSTRAINT `ordering_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `Staff` (`staff_id`),
  ADD CONSTRAINT `ordering_ibfk_3` FOREIGN KEY (`payment_id`) REFERENCES `Payment` (`payment_id`);

--
-- Constraints for table `Payment`
--
ALTER TABLE `Payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `Customer` (`customer_id`);

--
-- Constraints for table `Staff`
--
ALTER TABLE `Staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`outlet_id`) REFERENCES `Outlet` (`outlet_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
