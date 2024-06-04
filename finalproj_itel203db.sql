-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2024 at 05:40 PM
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
-- Database: `finalproj_itel203db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_contact`
--

CREATE TABLE `admin_contact` (
  `contact_id` int(11) NOT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `contact_value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_contact`
--

INSERT INTO `admin_contact` (`contact_id`, `contact`, `contact_value`) VALUES
(1, 'facebook', 'clark catle'),
(2, 'instagram', 'holy_per'),
(5, 'location', 'san pablo city'),
(6, 'twitter', 'andriano'),
(7, 'tiktok', 'chupapi_munyanyo');

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE `admin_info` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`id`, `username`, `password`) VALUES
(1, '$2y$10$hCmIVzlVVq9xnK24PRGyGOtH0NHXTcJoI3ZerY6FWe4a/Tcfj1oo6', '$2y$10$Jmx08OvaR.zdV9vh1WTz7O79Lp4kQTHIf9E6yYUyMPNHZrNVf.LNe');

-- --------------------------------------------------------

--
-- Table structure for table `admin_need_info`
--

CREATE TABLE `admin_need_info` (
  `admin_id` int(11) NOT NULL,
  `admin_info` varchar(255) DEFAULT NULL,
  `admin_info_values` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_need_info`
--

INSERT INTO `admin_need_info` (`admin_id`, `admin_info`, `admin_info_values`) VALUES
(1, 'fullname', 'clark david m. catle'),
(2, 'nickname', 'clark david'),
(5, 'gmail', '0322-1967@lspu.edu.ph'),
(6, 'phone', '+1234524352'),
(7, 'telephone', '(1234) 4211-1231'),
(8, 'picture', '6659d80b50916admin picture.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bedroom`
--

CREATE TABLE `bedroom` (
  `bedroom_id` int(11) NOT NULL,
  `house_design_id` int(11) DEFAULT NULL,
  `bedroom_pic` varchar(255) DEFAULT NULL,
  `bedroom_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bedroom`
--

INSERT INTO `bedroom` (`bedroom_id`, `house_design_id`, `bedroom_pic`, `bedroom_path`) VALUES
(38, 157, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cr`
--

CREATE TABLE `cr` (
  `cr_id` int(11) NOT NULL,
  `house_design_id` int(11) DEFAULT NULL,
  `cr_pic` varchar(255) DEFAULT NULL,
  `cr_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cr`
--

INSERT INTO `cr` (`cr_id`, `house_design_id`, `cr_pic`, `cr_path`) VALUES
(38, 157, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dinning_room`
--

CREATE TABLE `dinning_room` (
  `dinning_room_id` int(11) NOT NULL,
  `house_design_id` int(11) DEFAULT NULL,
  `dinning_room_pic` varchar(255) DEFAULT NULL,
  `dinning_room_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dinning_room`
--

INSERT INTO `dinning_room` (`dinning_room_id`, `house_design_id`, `dinning_room_pic`, `dinning_room_path`) VALUES
(47, 157, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `house_info_table`
--

CREATE TABLE `house_info_table` (
  `id` int(11) NOT NULL,
  `house_num` int(11) NOT NULL,
  `house_type` varchar(50) NOT NULL,
  `house_site` varchar(50) NOT NULL,
  `house_price` int(11) NOT NULL,
  `monthly_price` int(11) NOT NULL,
  `picture_path` varchar(255) NOT NULL,
  `picture_name` varchar(50) DEFAULT NULL,
  `house_description` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `house_info_table`
--

INSERT INTO `house_info_table` (`id`, `house_num`, `house_type`, `house_site`, `house_price`, `monthly_price`, `picture_path`, `picture_name`, `house_description`) VALUES
(157, 43, 'single attached', 'caliya', 1234567, 1234, '6659d44ebba26caliya single attached.jpg', 'caliya single attached', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cumque maiores voluptatibus unde officia consequatur, autem veritatis quod quas doloremque officiis deleniti et dolor quam delectus itaque cum assumenda adipisci ut!Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cumque maiores ');

-- --------------------------------------------------------

--
-- Table structure for table `living_room`
--

CREATE TABLE `living_room` (
  `living_room_id` int(11) NOT NULL,
  `house_design_id` int(11) DEFAULT NULL,
  `living_room_pic` varchar(255) DEFAULT NULL,
  `living_room_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `living_room`
--

INSERT INTO `living_room` (`living_room_id`, `house_design_id`, `living_room_pic`, `living_room_path`) VALUES
(104, 157, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_bedroom`
--

CREATE TABLE `master_bedroom` (
  `master_bedroom_id` int(11) NOT NULL,
  `house_design_id` int(11) DEFAULT NULL,
  `master_bedroom_pic` varchar(255) DEFAULT NULL,
  `master_bedroom_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_bedroom`
--

INSERT INTO `master_bedroom` (`master_bedroom_id`, `house_design_id`, `master_bedroom_pic`, `master_bedroom_path`) VALUES
(49, 157, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `other_id` int(11) NOT NULL,
  `house_design_id` int(11) DEFAULT NULL,
  `other_pic` varchar(255) DEFAULT NULL,
  `other_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other`
--

INSERT INTO `other` (`other_id`, `house_design_id`, `other_pic`, `other_path`) VALUES
(41, 157, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_message`
--

CREATE TABLE `user_message` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(250) DEFAULT NULL,
  `user_contact` varchar(250) DEFAULT NULL,
  `user_message_to_admin` varchar(2000) DEFAULT NULL,
  `interest` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_message`
--

INSERT INTO `user_message` (`user_id`, `user_name`, `user_contact`, `user_message_to_admin`, `interest`) VALUES
(22, 'jac', '123456', 'psst hoy', NULL),
(23, 'basil', '1232', 'asevlfajhnljkf', NULL),
(24, 'tinoki', '123123', 'asje v;sejkdnaljsheljkf', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_contact`
--
ALTER TABLE `admin_contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `admin_info`
--
ALTER TABLE `admin_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_need_info`
--
ALTER TABLE `admin_need_info`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bedroom`
--
ALTER TABLE `bedroom`
  ADD PRIMARY KEY (`bedroom_id`),
  ADD KEY `house_design_id` (`house_design_id`);

--
-- Indexes for table `cr`
--
ALTER TABLE `cr`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `house_design_id` (`house_design_id`);

--
-- Indexes for table `dinning_room`
--
ALTER TABLE `dinning_room`
  ADD PRIMARY KEY (`dinning_room_id`),
  ADD KEY `house_design_id` (`house_design_id`);

--
-- Indexes for table `house_info_table`
--
ALTER TABLE `house_info_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `living_room`
--
ALTER TABLE `living_room`
  ADD PRIMARY KEY (`living_room_id`),
  ADD KEY `house_design_id` (`house_design_id`);

--
-- Indexes for table `master_bedroom`
--
ALTER TABLE `master_bedroom`
  ADD PRIMARY KEY (`master_bedroom_id`),
  ADD KEY `house_design_id` (`house_design_id`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`other_id`),
  ADD KEY `house_design_id` (`house_design_id`);

--
-- Indexes for table `user_message`
--
ALTER TABLE `user_message`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_contact`
--
ALTER TABLE `admin_contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `admin_info`
--
ALTER TABLE `admin_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_need_info`
--
ALTER TABLE `admin_need_info`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bedroom`
--
ALTER TABLE `bedroom`
  MODIFY `bedroom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `cr`
--
ALTER TABLE `cr`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `dinning_room`
--
ALTER TABLE `dinning_room`
  MODIFY `dinning_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `house_info_table`
--
ALTER TABLE `house_info_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `living_room`
--
ALTER TABLE `living_room`
  MODIFY `living_room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `master_bedroom`
--
ALTER TABLE `master_bedroom`
  MODIFY `master_bedroom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `other_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `user_message`
--
ALTER TABLE `user_message`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bedroom`
--
ALTER TABLE `bedroom`
  ADD CONSTRAINT `bedroom_ibfk_1` FOREIGN KEY (`house_design_id`) REFERENCES `house_info_table` (`id`);

--
-- Constraints for table `cr`
--
ALTER TABLE `cr`
  ADD CONSTRAINT `cr_ibfk_1` FOREIGN KEY (`house_design_id`) REFERENCES `house_info_table` (`id`);

--
-- Constraints for table `dinning_room`
--
ALTER TABLE `dinning_room`
  ADD CONSTRAINT `dinning_room_ibfk_1` FOREIGN KEY (`house_design_id`) REFERENCES `house_info_table` (`id`);

--
-- Constraints for table `living_room`
--
ALTER TABLE `living_room`
  ADD CONSTRAINT `living_room_ibfk_1` FOREIGN KEY (`house_design_id`) REFERENCES `house_info_table` (`id`);

--
-- Constraints for table `master_bedroom`
--
ALTER TABLE `master_bedroom`
  ADD CONSTRAINT `master_bedroom_ibfk_1` FOREIGN KEY (`house_design_id`) REFERENCES `house_info_table` (`id`);

--
-- Constraints for table `other`
--
ALTER TABLE `other`
  ADD CONSTRAINT `other_ibfk_1` FOREIGN KEY (`house_design_id`) REFERENCES `house_info_table` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
