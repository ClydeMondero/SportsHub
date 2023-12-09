-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2023 at 05:33 AM
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
-- Database: `dbsportshub`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbcarts`
--

CREATE TABLE `tbcarts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `cart_product_size` varchar(255) NOT NULL,
  `cart_quantity` int(11) DEFAULT NULL,
  `cart_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tborders`
--

CREATE TABLE `tborders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_product_size` varchar(255) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_price` int(11) NOT NULL,
  `order_payment_method` varchar(255) NOT NULL,
  `order_address` varchar(255) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_arrival_date` date DEFAULT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tborders`
--

INSERT INTO `tborders` (`order_id`, `product_id`, `order_product_size`, `order_quantity`, `user_id`, `order_price`, `order_payment_method`, `order_address`, `order_date`, `order_arrival_date`, `order_status`) VALUES
(54, 49, '7', 2, 19, 13790, 'GCash', 'Mabini, Tambubong, San Rafael, Bulacan', '2023-12-09', '2023-12-16', 'Pending'),
(55, 49, '12', 1, 19, 6895, 'GCash', 'Mabini, Tambubong, San Rafael, Bulacan', '2023-12-09', '2023-12-16', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbproducts`
--

CREATE TABLE `tbproducts` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_description` varchar(1000) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_sport` varchar(255) NOT NULL,
  `product_stocks` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbproducts`
--

INSERT INTO `tbproducts` (`product_id`, `product_name`, `product_description`, `product_category`, `product_sport`, `product_stocks`, `product_image`, `product_brand`, `product_price`, `date_added`) VALUES
(49, 'Air Jordan 1 Low SE', 'Fresh look, familiar feel. Every time the AJ1 gets a remake, you get the classic sneaker in new colours and textures. Premium materials and accents give modern expression to an all-time favourite.', 'Shoes', 'General', 0, '65641efc5df26.png', 'Nike', 6895, '2023-11-27'),
(52, 'Nike Air Force 1 07 LV8', 'The radiance lives on in the Air Force 1 07 LV8. This b-ball original puts a fresh spin on what you know best: durably stitched overlays, clean finishes and the perfect amount of flash to make you shine. This winter-ready version helps keep you warm and has traction to beat the elements.', 'Tops', 'General', 5, '6565f17cc7302.png', 'Nike', 6895, '2023-11-27'),
(53, 'Nike Superfly 9 Elite Mercurial Dream Speed', 'You`ve perfected your skill through endless training and channelled your inner fire into your craft. Now, when the weight of the match is squarely on your shoulders, rise to the occasion and deliver. Bold reds and gentle oranges speak to the fearless-yet-grounded attitude needed to embrace these pressure-packed moments. Loaded with a football-specific Zoom Air unit and sticky touch, the Elite boot helps you—and the world`s biggest stars—take your game to the next level and put the pedal down in the waning minutes of a match, when it matters most.', 'Shoes', 'Football', 0, '656420acf1f93.png', 'Nike', 15195, '2023-11-27'),
(54, 'Nike Downshifter 12', 'Take those first steps on your running journey in the Nike Downshifter 12. Made from at least 20% recycled content by weight, it has a supportive fit and stable ride, with a lightweight feel that easily transitions from your workout to hangout. Your trek begins. Lace up and hit the road.', 'Shoes', 'Basketball', 3, '65642124cc18a.png', 'Nike', 2995, '2023-11-27'),
(57, 'Sando', 'Lorem Ipsum', 'Innerwears', 'General', 5, '656f03f5ef3aa.png', 'Nike', 1200, '2023-12-05'),
(58, 'Basketball Ball', 'Lorem Ipsum', 'Accessories and Equipment', 'Basketball', 2, '656f047fce4d6.jpg', 'Molten', 1500, '2023-12-05'),
(59, 'Tshirt', 'Lorem Ipsum', 'Tops', 'General', 6, '656f05a5b930e.png', 'Adidas', 1600, '2023-12-05'),
(60, 'Shorts', 'Lorem Ipsum', 'Bottoms', 'General', 4, '656f06b5c415e.png', 'Adidas', 1600, '2023-12-05'),
(61, 'Test1', 'Lorem Ipsum', 'Accessories and Equipment', 'Tennis', 6, '65703a57545f8.png', 'Asics', 1600, '2023-12-06'),
(62, 'Test 2', 'Raketa', 'Accessories and Equipment', 'Football', 3, '6572b10021ed6.png', 'Yonex', 4000, '2023-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `tbusers`
--

CREATE TABLE `tbusers` (
  `user_id` int(11) NOT NULL,
  `user_fullName` varchar(255) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_contactNo` varchar(255) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `acc_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbusers`
--

INSERT INTO `tbusers` (`user_id`, `user_fullName`, `user_username`, `user_password`, `user_email`, `user_contactNo`, `user_address`, `acc_type`) VALUES
(11, 'Eurie Oliveria', 'eurie', '$2y$10$h7ehCle9Y9z2lS/YBBA1Eu62JLykCX4JluoMuHkFrEEERUn/ocygm', 'eurie1@gmail.com', '09123412312', 'Manila', 'admin'),
(18, 'Markjames Villagonzalo', 'markjames', '$2y$10$SXH2u752PHsLCb3Dti4fGuHCMWaZOQdD3dwP7/.oPkQegXh3rxV/K', 'markjames@gmail.com', '09213456544', 'Baliuag, Bulacan', 'seller'),
(19, 'Andrei Poma', 'andrei123', '$2y$10$rHmJFBRluecS5SAmRz2FlO8PmKCRgRYzbQpXmomzVkMqxtl8Cd6iO', 'andrei@gmail.com', '09123253212', 'San Rafael, Bulacan', 'customer'),
(20, 'Rikki Vinas', 'rikki123', '$2y$10$PAllP794EKSSAlKXVewmC.xs9HPf3g4SroxOA6dS.SC3sRysI6dMK', 'rikki@gmail.com', '09231512342', 'Baliuag, Bulacan', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbcarts`
--
ALTER TABLE `tbcarts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tborders`
--
ALTER TABLE `tborders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id(fk)` (`product_id`),
  ADD KEY `user_id(fk)` (`user_id`);

--
-- Indexes for table `tbproducts`
--
ALTER TABLE `tbproducts`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbusers`
--
ALTER TABLE `tbusers`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbcarts`
--
ALTER TABLE `tbcarts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tborders`
--
ALTER TABLE `tborders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `tbproducts`
--
ALTER TABLE `tbproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `tbusers`
--
ALTER TABLE `tbusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbcarts`
--
ALTER TABLE `tbcarts`
  ADD CONSTRAINT `tbcarts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbproducts` (`product_id`),
  ADD CONSTRAINT `tbcarts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbusers` (`user_id`);

--
-- Constraints for table `tborders`
--
ALTER TABLE `tborders`
  ADD CONSTRAINT `product_id(fk)` FOREIGN KEY (`product_id`) REFERENCES `tbproducts` (`product_id`),
  ADD CONSTRAINT `user_id(fk)` FOREIGN KEY (`user_id`) REFERENCES `tbusers` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
