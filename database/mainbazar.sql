-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 08, 2024 at 03:46 PM
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
-- Database: `mainbazar`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tbl`
--

CREATE TABLE `admin_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_tbl`
--

INSERT INTO `admin_tbl` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$cgKLwbATp2L7palkBsHZhe7GKEgk.guww04eASpXY6.9St3ftSOAO');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(10) NOT NULL,
  `amenity` varchar(10) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenity`, `create_at`, `updated_at`) VALUES
(1, 'TV', '2024-05-15 18:07:15', '2024-05-15 18:07:15'),
(2, 'Wifi', '2024-05-15 18:07:15', '2024-05-15 18:07:15'),
(7, 'AC', '2024-05-16 15:54:42', '2024-05-16 15:54:42'),
(8, 'fridge', '2024-05-16 16:36:31', '2024-05-16 16:36:31'),
(10, 'balti', '2024-05-27 17:58:45', '2024-05-27 17:58:45');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `location` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(20) NOT NULL,
  `zip_code` varchar(20) NOT NULL,
  `prop_name` varchar(50) NOT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bathrooms` int(11) DEFAULT NULL,
  `area` decimal(10,2) DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `availability` enum('available','sold','under contract','off-market') DEFAULT 'available',
  `owner_name` varchar(100) DEFAULT NULL,
  `owner_contact` varchar(100) DEFAULT NULL,
  `add_by` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `description`, `price`, `location`, `city`, `state`, `country`, `zip_code`, `prop_name`, `bedrooms`, `bathrooms`, `area`, `amenities`, `availability`, `owner_name`, `owner_contact`, `add_by`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Silver Villas', '                                                                                                                bgdhhsjadf jdgfds fdsjfgdsfd c jsafgewifdb mdfkwiegeiufdb zmfewiudhei                                                                                                        ', 10000.00, 'kanpur', 'kanpur', 'up', 'india', '273212', 'Villa', 4, 4, 1200.00, 'TV,Wifi,AC,fridge', 'available', 'Avinash Kumar', '8564382012', 'avinashk8650@gmail.com', 1, '2024-05-09 15:45:25', '2024-05-16 16:47:45'),
(10, 'Golden Villas', '                                                        kjhdgjds fkjhfgbdsf dskjfchdikc zjdwgfshzj sljfgwdijvcxnvgrifudscv                                                     ', 120000.00, 'gorakhpur', 'gorakhpur', 'up', 'india', '273212', 'Villa', 4, 4, 1200.00, 'dcg jdgfbcx djbx chddbejd ccdhdbj,Wifi,TV', 'available', 'Bholu Chaurasiya', '8564024010', 'avinashk8650@gmail.com', 1, '2024-05-10 01:50:11', '2024-05-16 15:12:06'),
(11, 'Golden Saraswati Apartment', 'This is the best house', 1500.00, 'Sector 62', 'Noida', 'Uttar Pradesh', 'India', '273212', 'Appartment', 3, 2, 1200.00, 'Wifi,TV', 'available', 'Amit Kesaewani', '9876543210', 'admin@gmail.com', 1, '2024-05-16 15:04:03', '2024-05-16 15:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `pr_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `image`, `pr_id`, `create_at`, `updated_at`) VALUES
(36, '20240516183307_home3.jpg', 10, '2024-05-16 16:33:07', '2024-05-16 16:33:07'),
(37, '20240516183307_home2.jpg', 10, '2024-05-16 16:33:07', '2024-05-16 16:33:07'),
(38, '20240516183307_home1.jpeg', 10, '2024-05-16 16:33:07', '2024-05-16 16:33:07'),
(43, '20240527193732_Avinash.png', 11, '2024-05-27 17:37:32', '2024-05-27 17:37:32'),
(42, '20240527193657_Avinash.png', 9, '2024-05-27 17:36:57', '2024-05-27 17:36:57');

-- --------------------------------------------------------

--
-- Table structure for table `property_types`
--

CREATE TABLE `property_types` (
  `prop_id` int(11) NOT NULL,
  `prop_name` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_types`
--

INSERT INTO `property_types` (`prop_id`, `prop_name`, `created_at`, `updated_at`) VALUES
(1, 'Appartment', '2024-03-18 19:14:35', '2024-03-18 19:14:35'),
(2, 'Villa', '2024-03-18 19:23:20', '2024-03-18 19:23:20'),
(6, 'Office', '2024-03-19 17:30:00', '2024-03-19 17:30:00'),
(7, 'Housetown', '2024-03-19 17:30:08', '2024-03-19 17:34:55'),
(10, 'Home', '2024-05-27 17:58:27', '2024-05-27 17:58:27'),
(9, 'School', '2024-05-27 17:38:04', '2024-05-27 17:38:04');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `property_id`, `rating`, `name`, `email`, `comment`, `updated_at`, `created_at`) VALUES
(1, 2, 2, 'Avinash Chaurasiya', 'avinashk8650@gmail.com', 'this property is great', '2024-04-26 07:49:52', '2024-04-26 07:49:52'),
(2, 2, 5, 'Avinash Chaurasiya', 'jainradhika686@gmail.com', 'hdfjdshfkjdsfjdsafdsagas', '2024-04-26 08:28:31', '2024-04-26 08:28:31'),
(3, 2, 4, 'Avinash Chaurasiya', 'bholu@gmail.com', 'jsgsahdgsadsasa', '2024-04-26 08:35:59', '2024-04-26 08:35:59'),
(5, 2, 5, 'ram', 'av@gmail.com', 'jghfhj', '2024-04-26 08:37:31', '2024-04-26 08:37:31'),
(6, 2, 5, 'Avinash Chaurasiya', 'avinash@gmail.com', 'sdfafafdsacadsfeddsd', '2024-04-26 08:52:15', '2024-04-26 08:52:15'),
(17, 2, 5, 'Bholu Chaurasiya', 'admin@gmail.com', 'this propertty is bahut ghatiya hai', '2024-04-27 14:56:44', '2024-04-27 14:56:44'),
(18, 11, 5, 'Avinash Chaurasiya', 'avinash.k@nirvaat.com', 'This properties is best for every one', '2024-05-16 16:59:15', '2024-05-16 16:59:15'),
(19, 11, 4, 'Bholu Chaurasiya', 'avinashk8650@gmail.com', 'hello bhai saheb', '2024-05-16 16:59:39', '2024-05-16 16:59:39'),
(20, 9, 5, 'Avinash Kumar', 'avinash8564kumar@gmail.com', 'This properties is very best', '2024-05-27 17:49:41', '2024-05-27 17:49:41');

-- --------------------------------------------------------

--
-- Table structure for table `register_a_u`
--

CREATE TABLE `register_a_u` (
  `id` int(11) NOT NULL,
  `user_type` varchar(225) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `number` bigint(20) DEFAULT NULL,
  `isVerify` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_a_u`
--

INSERT INTO `register_a_u` (`id`, `user_type`, `name`, `email`, `password`, `image`, `number`, `isVerify`, `created_at`, `updated_at`) VALUES
(7, 'user', 'Bholu kumar', 'avinash8564kumar@gmail.com', '$2y$10$EEtyD6ZYHDu8sVJVyuDbHuLtea04iaPyXuYMGvgBT7nuBYbXdshCG', '20240527194803-Avinash.png', 8654377623, 1, '2024-05-27 17:47:12', '2024-05-27 17:48:24'),
(5, 'agent', 'Avinash Chaurasiya', 'avinashk8650@gmail.com', '$2y$10$Oq7oX.ZrhowAEmbYj0dLMeyXiXAKCNOUkRayaoHw4M1JRSfHSZ2kK', '20240505053134-IMG_20230824_105654_601-removebg-preview (1).png', 8650163913, 1, '2024-05-05 04:46:22', '2024-05-16 16:40:41'),
(6, 'user', 'Avinash Chaurasiya', 'avinash.k@nirvaat.com', '$2y$10$kSqQ9hkw9RwkYko3K4qzR.Mjq92vEiPLd3SCnPnlCgiUwQCAUurGq', '20240524192957-IMG_20230824_105654_601-removebg-preview (1).png', 8564024012, 1, '2024-05-16 16:51:42', '2024-05-26 11:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `feedback` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `name`, `email`, `feedback`, `image`, `create_at`) VALUES
(6, 'Avinash Kumar', '219555@kit.ac.in', 'lkwhsdfudsc dsmkfegf x ', 'Copy of FB_IMG_15336423465005763.jpg', '2024-05-18 06:41:54'),
(7, 'Avinash Kumar', 'avinash8564kumar@gmail.com', 'this property is best', 'Copy of FB_IMG_15336423465005763.jpg', '2024-05-18 06:56:16'),
(8, 'Akash kumar', 'avinashk8650@gmail.com', 'this platform is good for properties', 'IMG-20240401-WA0240.jpg', '2024-05-27 17:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(10) NOT NULL,
  `email` varchar(55) NOT NULL,
  `property_id` int(10) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `email`, `property_id`, `create_at`, `updated_at`) VALUES
(2, 'avinash.k@nirvaat.com', 10, '2024-05-26 05:19:39', '2024-05-26 05:19:39'),
(3, 'avinash.k@nirvaat.com', 11, '2024-05-26 05:19:49', '2024-05-26 05:19:49'),
(5, 'avinash8564kumar@gmail.com', 9, '2024-05-27 17:49:55', '2024-05-27 17:49:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `amenity` (`amenity`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_types`
--
ALTER TABLE `property_types`
  ADD PRIMARY KEY (`prop_id`),
  ADD UNIQUE KEY `prop_name` (`prop_name`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register_a_u`
--
ALTER TABLE `register_a_u`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_tbl`
--
ALTER TABLE `admin_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `property_types`
--
ALTER TABLE `property_types`
  MODIFY `prop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `register_a_u`
--
ALTER TABLE `register_a_u`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
