-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 12:42 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2daw20_daw`
--

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `type` varchar(25) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `profileimg` varchar(255) NOT NULL DEFAULT 'default_profile.png',
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `pass`, `type`, `date`, `profileimg`, `isAdmin`) VALUES
(11, 'admin', 'admin', 'admin@admin.com', '$2y$10$C7CG5LT4Cji1A6iJuzrnv.dUvdTwWKSeMLmj2ojx/.nGRjMeocv5W', 'premium', '2020-12-15 17:36:59', 'default_profile.png', 1),
(24, 'carlos', 's', 'carlos@gmail.com', '$2y$10$ElwYfgxfYnrgZwWnztthPO/REXpHxpFu65yV0oG69DG3Xnc.ltdJC', 'premium', '2021-05-22 10:09:14', '../assets/img/profiles/carlos@gmail.com.png', 1),
(25, 'pepe', 'pepe', 'pepe123@gmail.com', '$2y$10$gudUZmiVUp78cVuNCMw2Yu1HFLPjA01/SxVnKj/Ggk3KGZ8b3gFWi', 'normal', '2021-05-22 10:27:43', '../assets/img/profiles/pepe123@gmail.com.jpg', 0),
(28, 'prova2', 'prova', 'prova12@gmail.com', '$2y$10$7KXLEVLNOkITB0IawB3IfOSJHiJqBuVjozh/NBuSV6/MvGof2H8Pa', 'normal', '2021-05-22 10:17:40', '../assets/img/profiles/prova12@gmail.com.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
