-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 04:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onemed_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kal`
--

CREATE TABLE `tb_kal` (
  `Nama Alat Ukur` varchar(100) NOT NULL,
  `No. ID` varchar(10) NOT NULL,
  `Merk` varchar(100) NOT NULL,
  `Tanggal Kalibrasi` datetime NOT NULL,
  `Tanggal Re-Kalibrasi` datetime NOT NULL,
  `Poin Kalibrasi` varchar(100) NOT NULL,
  `Hasil Pengukuran` varchar(100) NOT NULL,
  `Koreksi` varchar(100) NOT NULL,
  `U95` varchar(100) NOT NULL,
  `Koreksi & U95 yang diijinkan` varchar(100) NOT NULL,
  `Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kal`
--

INSERT INTO `tb_kal` (`Nama Alat Ukur`, `No. ID`, `Merk`, `Tanggal Kalibrasi`, `Tanggal Re-Kalibrasi`, `Poin Kalibrasi`, `Hasil Pengukuran`, `Koreksi`, `U95`, `Koreksi & U95 yang diijinkan`, `Status`) VALUES
('onemed', '1', '123', '2025-04-06 14:56:00', '2025-04-29 14:55:00', 's123', '123', '123', '123', '123', 'OK'),
('onemed', '123', '123', '2025-04-03 14:30:00', '2025-04-30 14:30:00', 's123', '123', '123', '123', '123', 'OK'),
('switch alert', '1233', 'rfff', '2025-04-03 16:28:00', '2025-05-01 16:28:00', 'sdfsd', 'sdgsd', 'dffg', 'dfg', 'g', 'OK'),
('Larutan Standard untuk viscometer Brookfield 30000', '123q', 'qwewqe', '2025-04-02 15:03:00', '2025-05-21 15:02:00', 'fdsafdsa', 'sdafasd', 'dsafds', 'asdfasd', 'dsfasdf', 'OK'),
('21', '21', '21', '2025-04-09 14:47:00', '2025-05-20 14:47:00', '123', '123', '123', '123', '123', '123'),
('sdfsdfgb', '435345', '435', '2025-04-09 16:34:00', '2025-04-30 16:34:00', '345', '34', '345', '345', '3', 'OK'),
('sdfsdfgb', '435345w', '435', '2025-04-09 16:34:00', '2025-04-30 16:34:00', '345', '34', '345', '345', '3', 'OK'),
('g', 'a', 'a', '2025-04-30 16:33:00', '2025-04-30 16:32:00', 'a', 'a', 'a', 'a', 'a', 'OK'),
('g', 'a21312321', 'a', '2025-04-30 16:33:00', '2025-04-30 16:32:00', 'a', 'a', 'a', 'a', 'a', 'OK'),
('Larutan Standard untuk viscometer Brookfield 300001', 'as', 'as', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'as', 'as', 'as', 'as', 'as', 'OK'),
('onemed3432432', 'asdfdsfsad', '123', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 's123', 'onemed', 's123', '123', 'onemed', 'OK'),
('coba30', 'coba31', 'coba30', '2025-04-03 13:16:00', '2025-05-27 13:16:00', 'coba21', 'coba21', 'coba21', 'coba21', 'coba21', 'coba21'),
('hasan', 'hasan', 'hasan', '2025-04-24 16:33:00', '2025-05-01 16:33:00', 'onemed', 'f', 'f', 'f', 'f', 'OK'),
('hasan', 'hasan2', 'hasan', '2025-04-24 16:33:00', '2025-05-01 16:33:00', 'onemed', 'f', 'f', 'f', 'f', 'OK'),
('merah', 'merah', 'merah', '2025-04-23 14:40:00', '2025-04-29 14:40:00', 'merah', 'merah', 'merah', 'merah', 'merah', 'OK'),
('wqeqwewqewq', 'qwewqqweee', 'ff', '2025-04-09 16:39:00', '2025-06-18 16:39:00', 'ffsdfsd', 'dsf', 'dsf', 'fd', 'sdf', 'OK'),
('sanhh', 'sanh', 'sdfasd', '2025-04-02 16:42:00', '2025-05-21 16:42:00', 'dsafs', 'sdter', 'ert', 'ert', 'ert', 'OK'),
('Larutan Standard untuk viscometer Brookfield 30000sdf', 'senaaaa12', 'asdfads', '2025-04-08 16:23:00', '2025-05-06 16:23:00', 'sdafsdaf', 'sdfasd', 'asdf', 'sdf', 'hsdf', 'OK'),
('onemed', 'wqewq q ', '4123541', '2025-04-23 16:30:00', '2025-05-01 16:30:00', 'sdfasd', 'fdsaf', 'sdafasd', 'sdaf', 'sdfa', 'OK'),
('onemed', 'wqewq q 21', '4123541', '2025-04-23 16:30:00', '2025-05-01 16:30:00', 'sdfasd', 'fdsaf', 'sdafasd', 'sdaf', 'sdfa', 'OK');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `full_name`, `email`, `password`) VALUES
(1, 'saya saya', 'rahmahdiandian@gmail.com', '$2y$10$XwH7vlJJhqD6ROYSS/jlbOHp5aNeOfaVOc1dJ1StsTdxnubmQnsNm'),
(2, 'karimah nurhalizah', 'sadam.abc25@gmail.com', '$2y$10$h0BMyPxFYQkHyNZj9VtXSu1KIOxGyaK7g8HH3L6G7MYWHlnx72262');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kal`
--
ALTER TABLE `tb_kal`
  ADD PRIMARY KEY (`No. ID`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
