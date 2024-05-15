-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2024 at 08:29 AM
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
-- Database: `restaurant-management-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE `Admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'https://placehold.co/600x400/orange/white',
  `staff_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Admins`
--

INSERT INTO `Admins` (`id`, `username`, `email`, `password`, `profile_pic`, `staff_id`) VALUES
(1, 'admin1', 'admin1@example.com', '$2y$10$REIDjCNszwO.BSuK7r6KsOd6G6vZQohs/79MKPU./hebG8KoQpoR6', 'https://placehold.co/600x400/orange/white', 1),
(2, 'admin2', 'admin2@example.com', '$2y$10$REIDjCNszwO.BSuK7r6KsOd6G6vZQohs/79MKPU./hebG8KoQpoR6', 'https://placehold.co/600x400/orange/white', 2),
(3, 'admin3', 'admin3@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white', 3),
(4, 'admin4', 'admin4@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white', 4),
(5, 'admin5', 'admin5@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white', 5),
(6, 'admin6', 'admin6@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white', 6),
(7, 'admin7', 'admin7@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white', 7),
(8, 'admin8', 'admin8@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white', 8),
(9, 'admin9', 'admin9@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white', 9),
(10, 'admin10', 'admin10@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white', 10);

-- --------------------------------------------------------

--
-- Table structure for table `Customers`
--

CREATE TABLE `Customers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT 'https://placehold.co/600x400/orange/white'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Customers`
--

INSERT INTO `Customers` (`id`, `username`, `email`, `password`, `profile_pic`) VALUES
(1, 'john_roberts', 'john.doe@example.com', '$2y$10$REIDjCNszwO.BSuK7r6KsOd6G6vZQohs/79MKPU./hebG8KoQpoR6', 'https://placehold.co/600x400/orange/white'),
(2, 'jane_brown', 'jane.smith@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white'),
(3, 'michael_johnson', 'michael.johnson@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white'),
(4, 'emily_williams', 'emily.williams@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white'),
(5, 'david_brown', 'david.brown@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white'),
(6, 'jennifer_anderson', 'jennifer.anderson@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white'),
(7, 'christopher_martinez', 'christopher.martinez@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white'),
(8, 'sarah_wilson', 'sarah.wilson@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white'),
(9, 'matthew_taylor', 'matthew.taylor@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white'),
(10, 'jessica_garcia', 'jessica.garcia@example.com', '$2y$10$A0V9a2g4emjGOu3Qhd4Z6u1cKbKI4DjX9FJawxh/EJKQFMxFSRPdy', 'https://placehold.co/600x400/orange/white');

-- --------------------------------------------------------

--
-- Table structure for table `MenuItems`
--

CREATE TABLE `MenuItems` (
  `MenuItemId` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL,
  `ImageUrl` varchar(255) DEFAULT 'https://placehold.co/600x400.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `MenuItems`
--

INSERT INTO `MenuItems` (`MenuItemId`, `Name`, `Description`, `Price`, `ImageUrl`) VALUES
(1, 'Grilled Chicken Salad', 'Fresh salad with grilled chicken, mixed greens, and dressing', 12.99, 'https://placehold.co/600x400.png'),
(2, 'Margherita Pizza', 'Classic pizza with tomatoes, fresh mozzarella, basil and pineapple', 25.50, 'https://placehold.co/600x400.png'),
(3, 'Spaghetti Bolognese', 'Homemade spaghetti pasta with meat sauce', 10.75, 'https://placehold.co/600x400.png'),
(4, 'Cheeseburger', 'Juicy beef patty with cheese, lettuce, tomato, and pickles', 9.99, 'https://placehold.co/600x400.png'),
(5, 'Caesar Salad', 'Traditional Caesar salad with romaine lettuce and Caesar dressing', 8.50, 'https://placehold.co/600x400.png'),
(6, 'Fish and Chips', 'Crispy fried fish served with fries and tartar sauce', 14.25, 'https://placehold.co/600x400.png'),
(7, 'Vegetable Stir-Fry', 'Assorted vegetables stir-fried with tofu in a savory sauce', 11.50, 'https://placehold.co/600x400.png'),
(8, 'Chicken Alfredo Pasta', 'Creamy Alfredo sauce with grilled chicken and pasta', 13.75, 'https://placehold.co/600x400.png'),
(9, 'Mushroom Risotto', 'Creamy risotto with mushrooms, garlic, and Parmesan cheese', 16.00, 'https://placehold.co/600x400.png'),
(10, 'Fruit Smoothie', 'Refreshing smoothie with assorted fresh fruits and yogurt', 6.99, 'https://placehold.co/600x400.png'),
(11, 'Chicken Chop', 'Just chicken chop', 10.90, 'https://placehold.co/600x400.png'),
(12, 'Lamb Shoulder', 'Some Lamb Shoulder', 55.90, 'https://placehold.co/600x400.png'),
(20, 'Grilled Salmon', 'Just some salmon', 200.99, 'https://placehold.co/600x400.png'),
(21, 'Banana Leaf', 'Banana Leaf Set', 15.67, 'https://placehold.co/600x400.png'),
(23, 'Indian Cuisine', 'Delicious Indian Cuisine', 200.00, 'https://placehold.co/600x400.png'),
(26, 'Butter Omellete ', 'Sunny side up ', 20.19, 'https://placehold.co/600x400.png'),
(27, 'Grilled Chicken Salad', 'Freshly grilled chicken breast served on a bed of mixed greens with cherry tomatoes, cucumbers, and balsamic vinaigrette dressing.', 9.99, 'https://placehold.co/600x400.png'),
(28, 'Vegetarian Pizza', 'A delicious pizza topped with fresh vegetables such as bell peppers, mushrooms, onions, olives, and melted mozzarella cheese.', 12.99, 'https://placehold.co/600x400.png'),
(29, 'Shrimp Scampi Pasta', 'Delicious pasta dish featuring sautéed shrimp, garlic, lemon butter sauce, and fresh parsley, served with a side of garlic bread.', 16.99, 'https://placehold.co/600x400.png'),
(31, 'BBQ Ribs Platter', 'Tender and juicy BBQ ribs smothered in a tangy barbecue sauce, served with coleslaw and crispy fries.', 25.99, 'https://placehold.co/600x400.png'),
(33, 'Classic Cheeseburger', 'A juicy beef patty topped with melted cheddar cheese, lettuce, tomato, onion, and pickles, served on a toasted bun with fries.', 11.99, 'https://placehold.co/600x400.png'),
(34, 'Mocktail', 'Refreshing Mocktail', 29.97, 'https://placehold.co/600x400.png'),
(35, 'Orange Strawberry Juice', 'Refreshing Orange Strawberry Juice', 30.76, 'https://placehold.co/600x400.png');

-- --------------------------------------------------------

--
-- Table structure for table `OrderItems`
--

CREATE TABLE `OrderItems` (
  `id` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `MenuId` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL CHECK (`Quantity` >= 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `OrderItems`
--

INSERT INTO `OrderItems` (`id`, `OrderId`, `MenuId`, `Quantity`) VALUES
(1, 1, 11, 2),
(2, 1, 4, 3),
(3, 2, 5, 1),
(4, 2, 2, 2),
(5, 2, 31, 3),
(6, 6, 1, 1),
(7, 6, 5, 1),
(8, 8, 6, 3),
(11, 8, 3, 3),
(25, 8, 10, 2),
(26, 7, 8, 3),
(27, 7, 26, 2),
(33, 12, 28, 2),
(34, 12, 11, 3),
(35, 12, 10, 3),
(36, 12, 4, 2),
(37, 12, 1, 2),
(38, 13, 6, 2),
(39, 13, 10, 2),
(40, 14, 7, 2),
(41, 14, 9, 2),
(42, 14, 1, 2),
(43, 15, 3, 2),
(44, 16, 21, 1),
(45, 16, 35, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `id` int(11) NOT NULL,
  `OrderNumber` varchar(20) NOT NULL,
  `TableId` int(11) NOT NULL,
  `CustomerId` int(11) DEFAULT NULL,
  `StaffId` int(11) NOT NULL,
  `Status` enum('processing','completed') DEFAULT 'processing',
  `Payment_Method` enum('creditCard','debitCard','QRPay','Cash','T&G','GrabPay','ApplePay','SamsungPay') DEFAULT NULL,
  `CreatedTime` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`id`, `OrderNumber`, `TableId`, `CustomerId`, `StaffId`, `Status`, `Payment_Method`, `CreatedTime`, `UpdatedTime`) VALUES
(1, 'ABC123', 3, NULL, 4, 'processing', NULL, '2024-03-24 08:59:43', '2024-03-24 08:59:43'),
(2, 'XYZ789', 7, 8, 9, 'processing', NULL, '2024-03-24 09:53:10', '2024-03-24 09:53:10'),
(6, 'q2Oaig', 5, 2, 1, 'processing', NULL, '2024-03-28 15:31:40', '2024-03-28 15:31:40'),
(7, 'kkH0a3', 5, 2, 1, 'processing', NULL, '2024-03-28 15:34:05', '2024-03-28 15:34:05'),
(8, '4aBJjs', 2, 1, 1, 'processing', NULL, '2024-03-29 16:55:52', '2024-03-29 16:55:52'),
(12, 'HJksUA', 4, 3, 1, 'processing', NULL, '2024-04-06 08:05:32', '2024-04-06 08:05:32'),
(13, 'odb69d', 8, NULL, 1, 'processing', NULL, '2024-04-06 08:08:24', '2024-04-06 08:08:24'),
(14, 'OSqBXO', 6, 10, 2, 'processing', NULL, '2024-04-06 08:09:47', '2024-04-06 08:09:47'),
(15, 'W6bwqq', 5, NULL, 2, 'processing', NULL, '2024-04-06 08:10:23', '2024-04-06 08:10:23'),
(16, 'FPxDk7', 1, NULL, 2, 'processing', NULL, '2024-04-06 08:10:47', '2024-04-06 08:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE `Staff` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `NRIC` varchar(255) DEFAULT NULL CHECK (char_length(`NRIC`) >= 12),
  `Phone_no` varchar(255) DEFAULT NULL CHECK (char_length(`Phone_no`) >= 10),
  `Position` enum('waiter','cashier','manager','cook') DEFAULT 'waiter'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Staff`
--

INSERT INTO `Staff` (`id`, `FirstName`, `LastName`, `NRIC`, `Phone_no`, `Position`) VALUES
(1, 'John', 'Williams', '123456789012', '1234567890', 'waiter'),
(2, 'Jane', 'Roberts', '987654321012', '9876543210', 'cashier'),
(3, 'Michael', 'Johnson', '456789012345', '4567890123', 'manager'),
(4, 'Emily', 'Williams', '789012345678', '7890123456', 'cook'),
(5, 'David', 'Brown', '654321012345', '6543210123', 'waiter'),
(6, 'Jennifer', 'Anderson', '012345678901', '0123456789', 'cashier'),
(7, 'Christopher', 'Martinez', '321012345678', '3210123456', 'manager'),
(8, 'Sarah', 'Wilson', '901234567890', '9012345678', 'cook'),
(9, 'Matthew', 'Taylor', '567890123456', '5678901234', 'waiter'),
(10, 'Jessica', 'Garcia', '234567890123', '2345678901', 'cashier');

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `id` int(11) NOT NULL,
  `status` enum('free','occupied') DEFAULT 'free',
  `capacity` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`id`, `status`, `capacity`) VALUES
(1, 'free', 4),
(2, 'occupied', 6),
(3, 'free', 5),
(4, 'occupied', 3),
(5, 'free', 7),
(6, 'free', 5),
(7, 'occupied', 2),
(8, 'occupied', 5),
(9, 'free', 4),
(10, 'free', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admins`
--
ALTER TABLE `Admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MenuItems`
--
ALTER TABLE `MenuItems`
  ADD PRIMARY KEY (`MenuItemId`);

--
-- Indexes for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD PRIMARY KEY (`id`),
  ADD KEY `OrderId` (`OrderId`),
  ADD KEY `MenuId` (`MenuId`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `OrderNumber` (`OrderNumber`),
  ADD KEY `TableId` (`TableId`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `StaffId` (`StaffId`);

--
-- Indexes for table `Staff`
--
ALTER TABLE `Staff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admins`
--
ALTER TABLE `Admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `MenuItems`
--
ALTER TABLE `MenuItems`
  MODIFY `MenuItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `OrderItems`
--
ALTER TABLE `OrderItems`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `Staff`
--
ALTER TABLE `Staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admins`
--
ALTER TABLE `Admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `Staff` (`id`);

--
-- Constraints for table `OrderItems`
--
ALTER TABLE `OrderItems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `Orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`MenuId`) REFERENCES `MenuItems` (`MenuItemId`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`TableId`) REFERENCES `Tables` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`CustomerId`) REFERENCES `Customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`StaffId`) REFERENCES `Staff` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
