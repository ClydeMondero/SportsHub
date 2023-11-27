-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 02:18 PM
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
-- Database: `dbsportshub`
--

-- --------------------------------------------------------

--
-- Table structure for table `tborders`
--

CREATE TABLE `tborders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `order_arrival_date` date DEFAULT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tborders`
--

INSERT INTO `tborders` (`order_id`, `product_id`, `user_id`, `order_date`, `order_arrival_date`, `order_status`) VALUES
(1, 49, 10, '2023-11-27', NULL, 'In Transit');

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
  `product_size` varchar(255) NOT NULL,
  `product_stocks` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_brand` varchar(255) NOT NULL,
  `product_price` int(11) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbproducts`
--

INSERT INTO `tbproducts` (`product_id`, `product_name`, `product_description`, `product_category`, `product_sport`, `product_size`, `product_stocks`, `product_image`, `product_brand`, `product_price`, `date_added`) VALUES
(49, 'Air Jordan 1 Low SE', 'Fresh look, familiar feel. Every time the AJ1 gets a remake, you get the classic sneaker in new colours and textures. Premium materials and accents give modern expression to an all-time favourite.', 'Shoes', 'Casual', '12', 1, '65641efc5df26.png', 'Nike', 6895, '2023-11-27'),
(52, 'Nike Air Force 1 07 LV8', 'The radiance lives on in the Air Force 1 07 LV8. This b-ball original puts a fresh spin on what you know best: durably stitched overlays, clean finishes and the perfect amount of flash to make you shine. This winter-ready version helps keep you warm and has traction to beat the elements.', 'Shoes', 'Casual', '12', 5, '65641fbde3eb7.png', 'Nike', 6895, '2023-11-27'),
(53, 'Nike Superfly 9 Elite Mercurial Dream Speed', 'You`ve perfected your skill through endless training and channelled your inner fire into your craft. Now, when the weight of the match is squarely on your shoulders, rise to the occasion and deliver. Bold reds and gentle oranges speak to the fearless-yet-grounded attitude needed to embrace these pressure-packed moments. Loaded with a football-specific Zoom Air unit and sticky touch, the Elite boot helps you—and the world`s biggest stars—take your game to the next level and put the pedal down in the waning minutes of a match, when it matters most.', 'Shoes', 'Soccer', '10', 10, '656420acf1f93.png', 'Nike', 15195, '2023-11-27'),
(54, 'Nike Downshifter 12', 'Take those first steps on your running journey in the Nike Downshifter 12. Made from at least 20% recycled content by weight, it has a supportive fit and stable ride, with a lightweight feel that easily transitions from your workout to hangout. Your trek begins. Lace up and hit the road.', 'Shoes', 'Basketball', '11', 14, '65642124cc18a.png', 'Nike', 2995, '2023-11-27');

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
(1, 'Danrick Macatanong', 'danrickxsam', 'samxdanrick', 'danricksam@gmail.com', '09123456789', 'Angat, Bulacan', 'customer'),
(3, 'Dandrick Salamat', 'salamatsam', 'samsalamat', 'salamat@gmail.com', '09987654321', 'Bustos, Bulacan', 'customer'),
(9, 'Markjames Villagonzalo', 'markjames', 'markjames123', 'markjames@gmail.com', '09214512312', 'Subic, Baliuag, Bulacan', 'admin'),
(10, 'Andrei Poma', 'andreipoma', 'pomaandrei', 'poma@gmail.com', '09214512314', 'Capihan, San Rafael, Bulacan', 'customer');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `tborders`
--
ALTER TABLE `tborders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbproducts`
--
ALTER TABLE `tbproducts`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `tbusers`
--
ALTER TABLE `tbusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

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
