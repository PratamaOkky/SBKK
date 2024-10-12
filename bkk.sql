-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 24, 2024 at 03:14 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bkk`
--

-- --------------------------------------------------------

--
-- Table structure for table `lamaran`
--

CREATE TABLE `lamaran` (
  `id` int NOT NULL,
  `lowongan_id` int NOT NULL,
  `user_id` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telpon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slamaran` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `slamaran2` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lamaran`
--

INSERT INTO `lamaran` (`id`, `lowongan_id`, `user_id`, `nama`, `email`, `telpon`, `cv`, `slamaran`, `slamaran2`) VALUES
(29, 15, 45, 'Santoso', 'sultan@gmail.com', '0897654573618', 'Santoso_Social_Media_Admin_cig.pdf', 'Valid', 'Valid');

-- --------------------------------------------------------

--
-- Table structure for table `lowongan`
--

CREATE TABLE `lowongan` (
  `id` int NOT NULL,
  `perusahaan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lowongan`
--

INSERT INTO `lowongan` (`id`, `perusahaan`, `title`, `deskripsi`, `tanggal`) VALUES
(15, 'cig', 'Social Media Admin', 'Bekerja non-shift', '24-08-2024');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `nisn` int NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telpon` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Pending','Verified') COLLATE utf8mb4_general_ci DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nisn`, `nama`, `email`, `telpon`, `role`, `username`, `password`, `status`) VALUES
(27, 0, 'Novita', NULL, NULL, 'Admin', 'admin', '$2y$10$DT6xOwJhVzZKFG/PEH7TfOUJvPOn8M8csYXoVQZ4rvGAy7CaFwprO', 'Verified'),
(28, 0, 'Miguel', NULL, NULL, 'Staff', 'staff', '$2y$10$nVizI.P/3L0p5.8H7ePesuGvXG1YyJFZXm/qHcVQqvuyf0YT7oxbm', 'Verified'),
(43, 0, 'cig', NULL, NULL, 'Perusahaan', 'cig', '$2y$10$ZTrZcjNtj1BJqH9SLULSJeCvS.01lnhYS3wTuBSLHj/z5YAZcBr7y', 'Verified'),
(45, 87654321, 'Santoso', 'sultan@gmail.com', '0897654573618', 'Alumni', 'santoso', '$2y$10$lbavB6Vb4H9PE/kWql3h5.oPZZz3k.xhvNrm.e756s2tyElEMyKH2', 'Verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lowongan_id` (`lowongan_id`);

--
-- Indexes for table `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lamaran`
--
ALTER TABLE `lamaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lamaran`
--
ALTER TABLE `lamaran`
  ADD CONSTRAINT `lamaran_ibfk_1` FOREIGN KEY (`lowongan_id`) REFERENCES `lowongan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
