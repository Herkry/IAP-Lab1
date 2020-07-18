-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2020 at 02:05 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icslab1`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE `api_keys` (
  `id` int(11) NOT NULL,
  `api_key` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_name` varchar(255) NOT NULL,
  `units` int(11) DEFAULT NULL,
  `unit_price` double(3,2) DEFAULT NULL,
  `order_status` varchar(32) DEFAULT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `first_name` varchar(32) NOT NULL,
  `last_name` varchar(32) DEFAULT NULL,
  `user_city` varchar(32) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` text,
  `utc_timestmp` varchar(200) NOT NULL,
  `offset` varchar(200) NOT NULL,
  `filePath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `user_city`, `username`, `password`, `utc_timestmp`, `offset`, `filePath`) VALUES
(1, 'Harry', 'Karani', 'Meru', NULL, NULL, '', '', ''),
(2, 'Harry', 'Karani', 'Meru', NULL, NULL, '', '', ''),
(3, 'Harry', 'Karani', 'Meru', NULL, NULL, '', '', ''),
(4, 'dq', 'dw', '', NULL, NULL, '', '', ''),
(5, 'Harry', 'Karani', 'Meru', 'thomwalkom@gmail.com', '$2y$10$vKfbyFZLzawzs2UhaXUtqODGSO9fpW2TSDibCHxhX6cU1AzKClBaO', '', '', ''),
(6, 'qwertyui', 'ghjk', 'dfghjk', 'dfghj', '$2y$10$Uv7OJFwjWlYeu1bYF3FqIOhrkRmWPa3cWpPlhVUZhUIiHizfdZbB2', '', '', ''),
(7, 'Harry', 'Karani', 'Meru', 'qwerty', '$2y$10$Pr49H/ANxXGJna4n2t2QTe60nlV3wDLkQiCmUl5E8/eBBknL8lVCW', '', '', ''),
(8, 'Harry', 'Karani', 'Meru', '111201', '$2y$10$fE6cXFnR9fpO1P5jJNlKyO56D9N/faI0rXUHoW6RXSgLbJb0qamce', '1590464588560', '-180', '/uploadsCapture1.JPG'),
(9, 'Harry', 'Karani', 'Meru', 'qw', '$2y$10$xK82ZnPA6g.54z01pSmaq.i6uT5CgJoyI.2KohDVTmdXObTjryU8y', '1590470240500', '-180', '/uploadsCapture1.JPG'),
(10, 'Harry', 'Karani', 'Meru', 'qwr', '$2y$10$Zmt.Wugt1vlfU/INtBZjvuA1fBVxuT3SfBi3rDEAD.XUlPhQ0JEk.', '1590470659621', '-180', 'uploads/Capture1.JPG'),
(11, 'Harry', 'Karani', 'Meru', 'qwry', '$2y$10$eKJDtoqZvNzS3LQz3SJdkOwWmXc0fKyqBT7ApLSi3RHUzA0MFW9Fu', '1590470738626', '-180', 'uploads/Capture1.JPG'),
(12, 'Harry', 'Karani', 'Meru', 'qwryu', '$2y$10$i4jzyfO51fM6tUgdUg1in.GTKRF9TBBtdZyqHcQu0/671LivTbRji', '1590470781421', '-180', 'uploads/Capture1.JPG'),
(13, 'km', 'km', 'km', 'km', '$2y$10$pgKFoJBjY0QRJELB8CQAJ.Z/9bRgd7g6c6cGr4jqH7EQHTTiCSbtq', '1594959674024', '-180', 'uploads/android1.JPG'),
(14, 'lm', 'lm', 'lm', 'lm', '$2y$10$FSUEfIJuDoWkhrwfht2mke1npU7ke76E2LGAacc4tIfmdqn01VCuq', '1595018347875', '-180', 'uploads/android2.JPG'),
(15, 'jm', 'jm', 'jm', 'jm', '$2y$10$Fr.Mh4qUkyJDQp11eFlq1OUgpWIBQVH4WDmA4f7SJcyVrHhk7cmoS', '1595019184677', '-180', 'uploads/Capture1.JPG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_keys`
--
ALTER TABLE `api_keys`
  ADD CONSTRAINT `api_keys_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
