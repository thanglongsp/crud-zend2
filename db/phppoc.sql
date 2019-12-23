-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2019 at 10:50 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phppoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(11) UNSIGNED NOT NULL,
  `category` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `category`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'thanglong1', '2019-12-23 02:13:03', '2019-12-23 02:13:03'),
(54, 1, 'thanglong2', '2019-12-20 10:21:58', '2019-12-20 10:21:58'),
(68, 2, 'thanglong3', '2019-12-23 02:13:08', '2019-12-23 02:13:08'),
(69, 3, 'thanglong4', '2019-12-23 02:13:12', '2019-12-23 02:13:12'),
(70, 4, 'thanglong5', '2019-12-23 02:13:21', '2019-12-23 02:13:21'),
(71, 3, 'thanglong6', '2019-12-23 02:13:27', '2019-12-23 02:13:27'),
(72, 1, 'thanglong7', '2019-12-23 02:13:50', '2019-12-23 02:13:50'),
(73, 1, 'thanglong8', '2019-12-23 02:13:55', '2019-12-23 02:13:55'),
(74, 2, 'thanglong9', '2019-12-23 02:13:59', '2019-12-23 02:13:59'),
(75, 1, 'thanglong10', '2019-12-23 02:14:04', '2019-12-23 02:14:04'),
(76, 1, 'thanglong11', '2019-12-23 02:14:21', '2019-12-23 02:14:21'),
(77, 1, 'thanglong12', '2019-12-23 02:14:26', '2019-12-23 02:14:26'),
(78, 1, 'thanglong13', '2019-12-23 02:14:30', '2019-12-23 02:14:30'),
(79, 1, 'thanglong14', '2019-12-23 02:14:35', '2019-12-23 02:14:35'),
(80, 1, 'thanglong15', '2019-12-23 02:14:43', '2019-12-23 02:14:43'),
(81, 1, 'thanglong16', '2019-12-23 02:14:50', '2019-12-23 02:14:50'),
(82, 1, 'thanglong17', '2019-12-23 02:14:56', '2019-12-23 02:14:56'),
(83, 1, 'thanglong18', '2019-12-23 02:15:03', '2019-12-23 02:15:03'),
(84, 2, 'thanglong3', '2019-12-23 07:27:37', '2019-12-23 07:27:37');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'type1', '2019-12-20 10:21:01', '2019-12-20 10:21:01'),
(2, 'type2', '2019-12-20 10:21:34', '2019-12-20 10:21:34'),
(3, 'type3', '2019-12-20 10:21:37', '2019-12-20 10:21:37'),
(4, 'type4', '2019-12-20 10:21:40', '2019-12-20 10:21:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
