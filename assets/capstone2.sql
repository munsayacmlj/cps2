-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 28, 2018 at 04:54 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone2`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`) VALUES
(1, 'Saint Laurent'),
(2, 'Versace'),
(3, 'Kate Spade'),
(4, 'Gucci'),
(5, 'Ralph Lauren'),
(6, 'Barba Napoli'),
(7, 'Brioni'),
(8, 'Salvatore Ferragamo'),
(9, 'Allen Edmonds'),
(10, 'Berluti'),
(11, 'Stuart Weitzman'),
(12, 'Manolo Blahnik'),
(13, 'Christian Louboutin'),
(14, 'Jimmy Choo'),
(15, 'Balenciaga');

-- --------------------------------------------------------

--
-- Table structure for table `genders`
--

CREATE TABLE `genders` (
  `id` int(11) NOT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genders`
--

INSERT INTO `genders` (`id`, `gender`) VALUES
(1, 'men'),
(2, 'women');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_date`, `user_id`, `status`) VALUES
(26, '2018-01-24', 4, 'pending'),
(28, '2018-01-26', 3, 'done'),
(29, '2018-01-26', 3, 'done'),
(30, '2018-01-26', 3, 'pending'),
(31, '2018-01-27', 9, 'pending'),
(32, '2018-01-28', 6, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `quantity`, `total_price`, `product_id`, `order_id`) VALUES
(70, 1, 62500, 45, 28),
(71, 1, 62500, 45, 28),
(72, 1, 62500, 45, 28),
(73, 1, 62500, 45, 28),
(74, 1, 62500, 45, 28),
(77, 1, 24000, 31, 29),
(78, 1, 23791, 37, 29),
(82, 1, 43000, 14, 31),
(84, 1, 23000, 16, 31),
(85, 1, 7200, 9, 31),
(86, 1, 119300, 26, 31),
(87, 1, 39750, 46, 31),
(105, 1, 32140, 58, 32);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `product_type_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `picture`, `description`, `brand_id`, `gender_id`, `product_type_id`) VALUES
(1, 'Allen Edmonds Dark Red Checkered Shirt', 7900, 'assets/images/allen_edmonds_shirt_1_m.jpg', 'Cotton Shirt', 9, 1, 3),
(3, 'Allen Edmonds Dark Purple Checkered Shirt', 4900, 'assets/images/allen_edmonds_shirt_3_m.jpg', 'Cotton Shirt', 9, 1, 3),
(4, 'Allen Edmonds Light Blue Checkered Shirt', 4900, 'assets/images/allen_edmonds_shirt_4_m.jpg', 'Cotton Shirt', 9, 1, 3),
(5, 'Allen Edmonds Black and White Casual Shoes', 19750, 'assets/images/allen_edmonds_shoes_1_m.jpg', 'Nice Shoes', 9, 1, 2),
(6, 'Allen Edmonds Brown Casual Shoes', 19750, 'assets/images/allen_edmonds_shoes_2_m.jpg', 'Nice Shoes', 9, 1, 2),
(7, 'Balenciaga Black Casual Shoes with Silver Flowers', 25980, 'assets/images/balenciaga_shoes_1_w.jpg', 'Nice Shoes', 15, 2, 2),
(8, 'Barba Napoli Purple Shirt', 6599, 'assets/images/barba_napoli_shirt_1_m.jpg', 'Nice Shirt', 6, 1, 3),
(9, 'Barba Napoli White Shirt', 7200, 'assets/images/barba_napoli_shirt_1_w.jpg', 'Nice Shirt', 6, 2, 3),
(10, 'Barba Napoli Lavender Shirt', 6500, 'assets/images/barba_napoli_shirt_2_m.jpg', 'Nice Shirt', 6, 1, 3),
(11, 'Barba Napoli Silky Black Shirt', 7330, 'assets/images/barba_napoli_shirt_2_w.jpg', 'Nice Shirt', 6, 2, 3),
(12, 'Berluti Black Leather Shoes', 36990, 'assets/images/berluti_shoes_1_m.jpg', 'Nice Shoes', 10, 1, 2),
(13, 'Berluti Teal Dress Shoes', 45000, 'assets/images/berluti_shoes_2_m.jpg', 'Nice Shoes', 10, 1, 2),
(14, 'Berluti Classic Brown Leather Casual Shoes', 43000, 'assets/images/berluti_shoes_3_m.jpg', 'Nice Shoes', 10, 1, 2),
(15, 'Brioni Sky Blue Formal Shirt', 14560, 'assets/images/brioni_shirt_1_m.jpg', 'Nice Shirt', 7, 1, 3),
(16, 'Brioni Navy Blue Formal Shirt', 23000, 'assets/images/brioni_shirt_2_m.jpg', 'Nice Shirt', 7, 1, 3),
(17, 'Brioni Gray Formal Shirt', 27999, 'assets/images/brioni_shirt_3_m.jpg', 'Nice Shirt', 7, 1, 3),
(18, 'Christian Louboutin Fiesta Stilleto', 45000, 'assets/images/christian_louboutin_shoes_1_w.jpg', 'Nice Stilleto', 13, 2, 2),
(19, 'Christian Louboutin Crystal Silver Stilleto', 49000, 'assets/images/christian_louboutin_shoes_2_w.jpg', 'Nice Stilleto', 13, 2, 2),
(20, 'Christian Louboutin Gold Flowers Stilleto', 49000, 'assets/images/christian_louboutin_shoes_3_w.jpg', 'Nice Stilleto', 13, 2, 2),
(21, 'Gucci Black Body Bag', 95500, 'assets/images/gucci_bag_1_m.jpg', 'Nice Bag', 4, 1, 1),
(22, 'Gucci Medium Shoulder Bag', 119500, 'assets/images/gucci_bag_1_w.jpg', 'Nice bag', 4, 2, 1),
(23, 'Gucci Supreme Backpack with Web', 79500, 'assets/images/gucci_bag_2_m.jpg', 'Nice bag', 4, 1, 1),
(24, 'Gucci Small Shoulder Bag', 85800, 'assets/images/gucci_bag_2_w.jpg', 'Nice Bag', 4, 2, 1),
(25, 'Gucci Wolf print Supreme Backpack', 79500, 'assets/images/gucci_bag_3_m.jpg', 'Nice Bag', 4, 1, 1),
(26, 'Gucci Small Black Tote Bag', 119300, 'assets/images/gucci_bag_3_w.jpg', 'Nice Bag', 4, 2, 1),
(27, 'Cotton Polo with Gucci Stripes', 24000, 'assets/images/gucci_shirt_1_m.jpg', 'Cotton Shirt', 4, 1, 3),
(28, 'Washed T-Shirt with Gucci Logo', 24000, 'assets/images/gucci_shirt_1_w.jpg', 'Cotton Shirt', 4, 2, 3),
(29, 'Cotton Polo with Snake Design on colar', 24000, 'assets/images/gucci_shirt_2_m.jpg', 'Cotton Shirt', 4, 1, 3),
(30, 'White T-Shirt with Gucci Logo', 24000, 'assets/images/gucci_shirt_2_w.jpg', 'Cotton Shirt', 4, 2, 3),
(31, 'Black Cotton T-Shirt with Gucci Web Logo', 24000, 'assets/images/gucci_shirt_3_m.jpg', 'Cotton Shirt', 4, 1, 3),
(32, 'Light Pink Shirt with Ribbon', 32000, 'assets/images/gucci_shirt_3_w.jpg', 'Nice Shirt', 4, 2, 3),
(33, 'Navy Blue Mid Cut Casual Shoes', 34362, 'assets/images/jimmy_choo_shoes_1_m.jpg', 'Nice Shoes', 14, 1, 2),
(34, 'Pointed Suede Pumps in Black and Gold', 33668, 'assets/images/jimmy_choo_shoes_1_w.jpg', 'Nice Pumps', 14, 2, 2),
(35, 'Gum Sole High Cut Blue Leather Sneakers', 14114, 'assets/images/jimmy_choo_shoes_2_m.jpg', 'Nice Shoes', 14, 1, 2),
(36, 'Pointed Suede Crystal White Pumps with Glitters', 35000, 'assets/images/jimmy_choo_shoes_2_w.jpg', 'Nice Pumps', 14, 2, 2),
(37, 'Cassius Black Leather High Top Sneakers', 23791, 'assets/images/jimmy_choo_shoes_3_m.jpg', 'Nice Sneakers', 14, 1, 2),
(38, 'Pointed Suede Beige Pump with Pearls', 43930, 'assets/images/jimmy_choo_shoes_3_w.jpg', 'Nice Pumps', 14, 2, 2),
(39, 'Logan Street Large Eloisa', 16400, 'assets/images/kate_spade_bag_1_w.jpg', 'Nice Handbag', 3, 2, 1),
(40, 'Cameron Street Lottie', 16400, 'assets/images/kate_spade_bag_2_w.jpg', 'Nice Handbag', 3, 2, 1),
(41, 'Ghazalisi', 46250, 'assets/images/manolo_blahnik_shoes_1_w.jpg', 'Nice Shoes', 12, 2, 2),
(42, 'Ralph Lauren Light Blue Long Sleeves Polo', 6250, 'assets/images/ralph_lauren_shirt_1_m.jpg', 'Nice Shirt', 5, 1, 3),
(43, 'Ralph Lauren Washed Long Sleeves Polo Shirt', 6250, 'assets/images/ralph_lauren_shirt_2_m.jpg', 'Nice Shirt', 5, 1, 3),
(44, 'Ralph Lauren Black Dress Shirt', 7300, 'assets/images/ralph_lauren_shirt_3_m.jpg', 'Nice Shirt', 5, 1, 3),
(45, 'Ralph Lauren White and Blue Polo Shirt', 62500, 'assets/images/ralph_lauren_shirt_4_m.jpg', 'Nice Shirt', 5, 1, 3),
(46, 'Tanger Sandals with crisscrossed ties in black suede', 39750, 'assets/images/saint_laurent_shoes_1_w.jpg', 'Nice Sandals', 1, 2, 2),
(47, 'Tanger Sandals with crisscrossed ties in crimson red', 39750, 'assets/images/saint_laurent_shoes_2_w.jpg', 'Nice Sandals', 1, 2, 2),
(48, 'Short Sleeves Polo', 13800, 'assets/images/salvatore_ferragamo_shirt_1_m.jpg', 'Nice Polo', 8, 1, 3),
(49, 'Short Sleeves T-Shirt', 14500, 'assets/images/salvatore_ferragamo_shirt_2_m.jpg', 'Nice T-Shirt', 8, 1, 3),
(50, 'Brown Casual Ferragamo Shoes', 26500, 'assets/images/salvatore_ferragamo_shoes_1_m.jpg', 'Nice Shoes', 8, 1, 2),
(51, 'Peony Petal Bow Pump Shoe', 29750, 'assets/images/salvatore_ferragamo_shoes_1_w.jpg', 'Nice Pump', 8, 2, 2),
(52, 'Plain-toe Oxford Shoe', 29750, 'assets/images/salvatore_ferragamo_shoes_2_m.jpg', 'Nice Shoe', 8, 1, 2),
(53, 'Grape Foular Sandals', 44750, 'assets/images/salvatore_ferragamo_shoes_2_w.jpg', 'Nice Sandals', 8, 2, 2),
(54, 'Sneaker Shoe High Cut', 27500, 'assets/images/salvatore_ferragamo_shoes_3_m.jpg', 'Nice Shoe', 8, 1, 2),
(55, 'Bright Red Foular Sandals', 44750, 'assets/images/salvatore_ferragamo_shoes_3_w.jpg', 'Nice Sandals', 8, 2, 2),
(56, 'Sleek Pump', 23250, 'assets/images/stuart_weitzman_shoes_1_w.jpg', 'Nice Pump', 11, 2, 2),
(57, 'Raven Flat', 23250, 'assets/images/stuart_weitzman_shoes_2_w.jpg', 'Nice Flat', 11, 2, 2),
(58, 'Plain Black Backpack with Versace Logo', 32140, 'assets/images/versace_bag_1_m.jpg', 'Versace on the floor', 2, 1, 1),
(59, 'Beige Large Handbag', 150000, 'assets/images/versace_bag_1_w.jpg', 'Versace on the floor', 2, 2, 1),
(60, 'Versace Black Body bag', 32500, 'assets/images/versace_bag_2_m.jpg', 'Versace on the floor', 2, 1, 1),
(61, 'Black Large Handbag', 199000, 'assets/images/versace_bag_2_w.jpg', 'Versace on the floor', 2, 2, 1),
(66, 'Dark Brown Leather Jacket', 62399, 'assets/images/versace_shirt_2_m_2018-01-25_a.jpg', 'Versace on the floor', 2, 1, 3),
(68, 'Sunset Summer Golden Shirt', 12800, 'assets/images/versace_shirt_1_m_2018-01-25_a_2018-01-27_a.jpg', 'Versace hit the floor', 2, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `type`) VALUES
(1, 'bag'),
(2, 'shoes'),
(3, 'shirt');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'regular'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `role_id`, `status_id`) VALUES
(3, 'Elon', 'Musk', 'elonmusk', '8de1d5f15dfc6c31d469833767992297779a7a98', 1, 1),
(4, 'Mark', 'Munsayac', 'markmunsayac', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1, 1),
(5, NULL, NULL, 'admin', 'D033E22AE348AEB5660FC2140AEC35850C4DA997', 2, 1),
(6, 'Lorence', 'Munsayac', 'lorence', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1, 1),
(7, 'bose', 'aomine', 'boseaomine', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2, 1),
(8, NULL, NULL, 'admin2', 'd033e22ae348aeb5660fc2140aec35850c4da997', 2, 1),
(9, 'Nikola', 'Tesla', 'tesla', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_status`
--

CREATE TABLE `user_status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_status`
--

INSERT INTO `user_status` (`id`, `status`) VALUES
(1, 'ok'),
(2, 'banned');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `user_status`
--
ALTER TABLE `user_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_status`
--
ALTER TABLE `user_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`gender_id`) REFERENCES `genders` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `user_status` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlists_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
