-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2024 at 06:50 AM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praktikum_paw`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `address`) VALUES
(1, 'John Doe', '1234567890', '123 Main Street'),
(2, 'Jane Smith', '0987654321', '456 Elm Street'),
(3, 'Michael Johnson', '9876543210', '789 Oak Street'),
(4, 'Emily Davis', '6789012345', '101 Maple Avenue'),
(5, 'David Wilson', '5678901234', '202 Pine Street'),
(6, 'Sarah Brown', '4567890123', '303 Cedar Street'),
(7, 'Robert Taylor', '3456789012', '404 Birch Street'),
(8, 'Jennifer Martinez', '2345678901', '505 Walnut Street'),
(9, 'William Anderson', '1234567890', '606 Cherry Street'),
(10, 'Jessica Thomas', '0123456789', '707 Peach Street');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `qty`) VALUES
(1, 'Laptop', 1000, 5),
(2, 'Smartphone', 800, 10),
(3, 'Tablet', 500, 8),
(4, 'Headphones', 100, 15),
(5, 'Mouse', 20, 20),
(6, 'Keyboard', 50, 12),
(7, 'Monitor', 300, 7),
(8, 'Printer', 200, 6),
(9, 'External Hard Drive', 150, 9),
(10, 'Router', 80, 11);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `purchased_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer_id`, `purchased_at`, `total`) VALUES
(1, 1, '2024-05-01 03:00:00', 2000),
(2, 2, '2024-05-02 04:30:00', 1600),
(3, 3, '2024-05-03 05:45:00', 400),
(4, 4, '2024-05-04 02:15:00', 150),
(5, 5, '2024-05-05 07:20:00', 250),
(6, 6, '2024-05-06 09:00:00', 300),
(7, 7, '2024-05-07 10:30:00', 600),
(8, 8, '2024-05-08 11:45:00', 700),
(9, 9, '2024-05-09 13:00:00', 900),
(10, 10, '2024-05-10 14:15:00', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `product_id`, `qty`, `subtotal`) VALUES
(1, 1, 1, 2, 2000),
(2, 2, 2, 1, 800),
(3, 3, 3, 2, 1000),
(4, 4, 4, 3, 450),
(5, 5, 5, 1, 250),
(6, 6, 6, 2, 600),
(7, 7, 7, 1, 150),
(8, 8, 8, 3, 700),
(9, 9, 9, 2, 800),
(10, 10, 10, 1, 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`),
  ADD CONSTRAINT `transaction_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
