-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 04, 2025 at 10:14 PM
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
-- Database: `fitlab`
--
CREATE DATABASE IF NOT EXISTS `fitlab` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fitlab`;

-- --------------------------------------------------------

--
-- Table structure for table `contact_form_sub`
--

DROP TABLE IF EXISTS `contact_form_sub`;
CREATE TABLE IF NOT EXISTS `contact_form_sub` (
  `contact_form_sub_ID` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `message` varchar(255) NOT NULL,
  `sub_date` varchar(45) DEFAULT NULL,
  `Users_user_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`contact_form_sub_ID`),
  KEY `Users_user_ID` (`Users_user_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form_sub`
--

INSERT INTO `contact_form_sub` (`contact_form_sub_ID`, `first_name`, `last_name`, `email`, `message`, `sub_date`, `Users_user_ID`) VALUES
(1, 'Jason Statham', '', 'jason.stathom@gmail.com', 'I have not received my items and its been 2 months.', '2025-04-21 19:14:48', NULL),
(2, 'Jane Foster', '', 'janefoster@yahoo.ie', 'Some of my items are incorrect and i didn\'t receive some.', '2025-04-27 18:44:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_ID` varchar(10) NOT NULL,
  `total_cost` varchar(45) NOT NULL,
  `order_date` varchar(45) NOT NULL,
  `Users_user_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_ID`),
  KEY `Users_user_ID` (`Users_user_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_ID`, `total_cost`, `order_date`, `Users_user_ID`) VALUES
('7206500429', '48.96', '2025-04-27 17:41:59', 2),
('9456582037', '56.96', '2025-05-04 20:09:15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` decimal(6,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 10,
  `category` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`product_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_ID`, `name`, `description`, `price`, `image`, `stock_quantity`, `category`) VALUES
(1, 'Choco Mint Whey Protein Powder', 'Delicious Choco Mint flavored whey protein', 20.99, 'products images/Choco Mint whey.png', 23, 'supplement'),
(2, 'Chocolate Flavour Vegan Protein Powder', 'Vegan-friendly chocolate protein powder', 18.99, 'products images/ChocolateVegan.png', 6, 'supplement'),
(3, 'Vanilla Vegan Protein Powder', 'Smooth vanilla vegan protein blend', 18.99, 'products images/Vanilla Vegan.png', 15, 'supplement'),
(4, 'ProteinWorks Vegan Protein Chocolate Silk', 'Premium vegan protein by ProteinWorks', 17.50, 'products images/proteinworks.jpg', 14, 'supplement'),
(5, 'VEGA Vegan Protein & Green Chocolate', 'Vega protein mix with greens', 19.50, 'products images/vegaprotein.jpg', 20, 'supplement'),
(6, 'Strawberry Mass Gainer', 'Strawberry flavored weight gainer', 23.99, 'products images/strawmass.jpg', 14, 'supplement'),
(7, 'Cinnamon Biscoff Whey Protein Powder', 'Cinnamon Biscoff flavored whey', 20.99, 'products images/Cinnamon Biscoff Whey.png', 7, 'supplement'),
(8, 'Strawberry Vegan Protein Powder', 'Tasty strawberry vegan protein', 18.99, 'products images/Strawberry Vegan.png', 7, 'supplement'),
(9, 'Cookies and Cream Whey Protein Powder', 'Classic cookies & cream whey', 20.99, 'products images/COOKIES AND Cream Whey.png', 11, 'supplement'),
(10, 'Protein Powder', 'Standard vanilla protein powder', 17.99, 'products images/protein powder.jpg', 7, 'supplement'),
(11, 'Serious Mass Gainer', 'High-calorie serious gainer', 21.99, 'products images/mass gainer.jpg', 21, 'supplement'),
(12, 'Clear Whey Cranberry & Raspberry', 'Fruity clear whey formula', 19.99, 'products images/clearwhey.jpg', 16, 'supplement'),
(13, 'Creatine Whey Apple', 'Apple-flavored whey creatine', 19.99, 'products images/apple.jpg', 12, 'supplement'),
(14, 'Clear Whey Watermelon', 'Watermelon whey isolate', 19.99, 'products images/clearwhey watermelon.jpg', 10, 'supplement'),
(15, 'Clear Whey Plum', 'Refreshing plum clear whey', 19.99, 'products images/clearwhey plum.jpg', 8, 'supplement'),
(16, 'Vegan Pea Protein Vanilla', 'Pea-based vanilla protein', 17.50, 'products images/peaprotein.png', 5, 'supplement'),
(17, 'Milk Protein Powder', 'Pure milk protein formula', 16.99, 'products images/milkprotein.jpg', 15, 'supplement'),
(18, 'Creatine Monohydrate', 'Muscle-building creatine powder', 16.99, 'products images/creatine.jpg', 18, 'supplement'),
(19, 'Creatine Pills', 'Convenient creatine tablets', 19.99, 'products images/creatinepills.jpg', 18, 'supplement'),
(20, 'Pre-Workout', 'Energy-boosting preworkout formula', 13.99, 'products images/pre.jpg', 12, 'supplement'),
(21, 'Gold Pre-Workout', 'Premium gold-label preworkout', 13.99, 'products images/preworkout.jpg', 21, 'supplement'),
(22, 'Black Hoodie - Mens', 'Mens black fitness hoodie', 34.99, 'clothing images/blackhoodiemens.jpg', 23, 'clothing'),
(23, 'Black Joggers - Mens', 'Mens black joggers', 14.99, 'clothing images/blackjoggersmens.jpg', 10, 'clothing'),
(24, 'Black T-Shirt - Mens', 'Mens black tee', 5.99, 'clothing images/blacktshirtmens.png', 17, 'clothing'),
(25, 'Black Shorts - Mens', 'Mens black workout shorts', 9.99, 'clothing images/blackshortsmens.jpg', 8, 'clothing'),
(26, 'White Hoodie - Mens', 'White hoodie for men', 33.99, 'clothing images/whitehoodiemen.jpg', 24, 'clothing'),
(27, 'White Joggers - Mens', 'Mens white joggers', 14.99, 'clothing images/whitejoggermens.jpg', 14, 'clothing'),
(28, 'White T-Shirt - Mens', 'Mens white tee', 3.99, 'clothing images/whitetshirtmens.jpg', 14, 'clothing'),
(29, 'White Shorts - Mens', 'Mens white shorts', 8.99, 'clothing images/whiteshortsmen.jpg', 5, 'clothing'),
(30, 'Navy Hoodie - Mens', 'Dark navy hoodie', 34.99, 'clothing images/navyhoodiemens.jpg', 15, 'clothing'),
(31, 'Navy Joggers - Mens', 'Navy mens joggers', 12.99, 'clothing images/navyjoggersmens.jpg', 17, 'clothing'),
(32, 'Navy T-Shirt - Mens', 'Navy mens t-shirt', 3.99, 'clothing images/navytshirtmens.jpg', 15, 'clothing'),
(33, 'Navy Shorts - Mens', 'Mens navy workout shorts', 8.99, 'clothing images/navyshortsmens.png', 21, 'clothing'),
(34, 'Black Hoodie - Womans', 'Womens hoodie in black', 30.99, 'clothing images/blackhoodiewomans.jpg', 16, 'clothing'),
(35, 'Black Leggings - Womans', 'Women’s workout leggings', 20.99, 'clothing images/blackleggingswomans.jpg', 10, 'clothing'),
(36, 'Black Sports Bra - Womans', 'Supportive black sports bra', 7.99, 'clothing images/blacksportswomans.jpg', 19, 'clothing'),
(37, 'Black Joggers - Womans', 'Black joggers for women', 22.99, 'clothing images/blackjoggers.jpg', 20, 'clothing'),
(38, 'White Hoodie - Womans', 'Women’s white hoodie', 31.99, 'clothing images/whitehoodie.jpg', 20, 'clothing'),
(39, 'White Leggings - Womans', 'White leggings for gym', 21.99, 'clothing images/whiteleggings.jpg', 13, 'clothing'),
(40, 'White Sports Bra - Womans', 'White bra for workout', 7.99, 'clothing images/whitesports.jpg', 21, 'clothing'),
(41, 'White Joggers - Womans', 'Comfy white joggers', 20.99, 'clothing images/whitejoggers.jpg', 23, 'clothing'),
(42, 'Pink Hoodie - Womans', 'Stylish pink hoodie', 29.99, 'clothing images/pinkhoodie.jpg', 6, 'clothing'),
(43, 'Pink Leggings - Womans', 'Pink stretch leggings', 18.99, 'clothing images/pinkleggings.jpg', 19, 'clothing'),
(44, 'Pink Sports Bra - Womans', 'Pink supportive bra', 6.99, 'clothing images/pinksports.jpg', 12, 'clothing'),
(45, 'Pink Joggers - Womans', 'Casual pink joggers', 20.99, 'clothing images/pinkjoggers.jpg', 17, 'clothing');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_and_payment`
--

DROP TABLE IF EXISTS `shipping_and_payment`;
CREATE TABLE IF NOT EXISTS `shipping_and_payment` (
  `Shipping_ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `phone_number` varchar(45) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_type` varchar(45) NOT NULL,
  `confirmation` varchar(45) NOT NULL,
  `Orders_order_ID` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`Shipping_ID`),
  KEY `Orders_order_ID` (`Orders_order_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipping_and_payment`
--

INSERT INTO `shipping_and_payment` (`Shipping_ID`, `name`, `phone_number`, `address`, `payment_type`, `confirmation`, `Orders_order_ID`) VALUES
(5, 'Tom Nathanael Antoniraj', '0894451401', '2 Curragh Hall Green', 'paypal', 'confirmed', '7206500429'),
(6, 'Tom Nathanael Antoniraj', '0894451401', '2 Curragh Hall Green', 'apple_pay', 'confirmed', '9456582037');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `email`, `password`) VALUES
(2, 'tomnathanael10@gmail.com', '$2y$10$zO6lrC66goOYK7hctkvKKepve3S4IZPhMgSEDRk3V/fNhgIxCAM66');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_form_sub`
--
ALTER TABLE `contact_form_sub`
  ADD CONSTRAINT `contact_form_sub_ibfk_1` FOREIGN KEY (`Users_user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`Users_user_ID`) REFERENCES `users` (`user_ID`) ON DELETE CASCADE;

--
-- Constraints for table `shipping_and_payment`
--
ALTER TABLE `shipping_and_payment`
  ADD CONSTRAINT `shipping_and_payment_ibfk_1` FOREIGN KEY (`Orders_order_ID`) REFERENCES `orders` (`order_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
