-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 03:38 PM
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
  `Status` varchar(100) NOT NULL,
  `pelaksana` varchar(20) NOT NULL,
  `no_dokumen` varchar(20) NOT NULL,
  `lokasi` varchar(10) NOT NULL,
  `divisi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kal`
--

INSERT INTO `tb_kal` (`Nama Alat Ukur`, `No. ID`, `Merk`, `Tanggal Kalibrasi`, `Tanggal Re-Kalibrasi`, `Poin Kalibrasi`, `Hasil Pengukuran`, `Koreksi`, `U95`, `Koreksi & U95 yang diijinkan`, `Status`, `pelaksana`, `no_dokumen`, `lokasi`, `divisi`) VALUES
('onemed', '1', '123', '2025-04-06 14:56:00', '2025-04-29 14:55:00', 's123', '123', '123', '123', '123', 'OK', 'PASCA', '123', 'GUDANG', 'gudang'),
('Timbangan Digital 60 kg Sayaki', '11E002', 'a12e', '2025-05-02 14:30:00', '2025-05-02 14:30:00', '(1,00 ~ 60,00) Kg', '(180; 230; 280) °C', '(180; 230; 280) °C2', '0,00 °C', '0,1157°C', '1,5°C/0,5°C', 'OK', 'PASCA', 'TH/1A/024/', 'Injection '),
('onemed', '123', '123', '2025-05-14 14:30:00', '2025-04-30 14:30:00', 's123', '123', '123', '123', '123', 'OK', 'PASCA ', '123 ', 'GUDANG', 'gudang'),
('Screw Driver', '72003', '72003', '2025-05-30 14:30:00', '2026-04-11 14:30:00', '(0,4 ; 0,4 ; 0,4 Nm)', '(0,4 ; 0,4 ; 0,4 Nm)', '(0,01Nm)', '0,00 °C', '0,1157°C', '1,5°C/0,5°C', 'OK', 'PASCA', 'TH/1A/024/', 'Elektromed');

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
(2, 'karimah nurhalizah', 'sadam.abc25@gmail.com', '$2y$10$h0BMyPxFYQkHyNZj9VtXSu1KIOxGyaK7g8HH3L6G7MYWHlnx72262'),
(3, 'dsa dsaf', 'e@email.com', '$2y$10$W2aTFMZNnJdq/SCsDOIl.uLjsvU9kE3vGj47xIB99TKEOLRZACfjm'),
(4, 'dsa dsaf', 'ea@email.com', '$2y$10$F8N3uK/MxftTGjRFh6pB.uuJyuDuc4xSjqz5wlLoZsk/XYBRuaHjy'),
(5, 'dsa dsaf', 'ewa@email.com', '$2y$10$NmLENA6ZYTKdpVN5sk7uYe0gLsBmRVIhavAxDePCmEH6EuXg8EBsq'),
(6, 'dsa dsaf', 'ewsa@email.com', '$2y$10$7qMUMCplnEKVAvjIF4ge2enE0wI4f/wreCiHVqIndmrlCYE3Zhvq2'),
(7, 'karimah nurhalizah', 'sandya@gmail.com', '$2y$10$rYuS3FQhgIqbSjOFKFjXf.L3m1zjh0dvBgvNmCr4pkVcZb.Vtau5i'),
(8, 'karimah nurhalizah', 'sandybd@gmail.com', '$2y$10$thyL20sc/eRXdw4r.WSZg.RgOoeEld2hLDyFs/A8R/3S03cef5ubS'),
(9, 'karimah nurhalizah', 'saandy@gmail.com', '$2y$10$/B5cYYICUNNpjR3MyHEEoe0RSC8GlZF6rrT/uBmJ9USYi3Arwlo4e'),
(10, 'ss ss', 'f@gmail.com', '$2y$10$osjTTtCaNm9IrwDpLmi67OvmVas9Do/zxhSA26SWAh5HzjdqBxKY.');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
