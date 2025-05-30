-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 15, 2025 at 02:48 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`) VALUES
(0, 'omkar chavan', 'omkarsprivatelimited@gmail.com', '$2y$10$bqOFh9gG.qh9pQzRBgBxm.mJ.ZHo4YFZPHebME1fIBWe4U4ImjwXa'),
(0, 'omkar chavan', 'oomkarchavan@gmail.com', '$2y$10$oUdiAAxjMUjNOrmDGXSXr.9A5/I2IFQk5Yzkqe5QmDxGSnEXijdFe'),
(0, 'abc', 'abc@gmail.com', '$2y$10$udBt0IVb34O3ja8zwc.3NuWeuqtIvHlHkNZ9zH9x5lRepJoMCa8ia'),
(0, 'user', 'admin@gmail.com', '$2y$10$kYwOaPJadP0dj7kFiNzjZOHWWr8M4KAwzX1uViUS.dpECrtUdhQ3i');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
