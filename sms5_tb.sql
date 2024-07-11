-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2024 at 03:44 PM
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
-- Database: `sms5_tb`
--

-- --------------------------------------------------------

--
-- Table structure for table `komoditas`
--

CREATE TABLE `komoditas` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komoditas`
--

INSERT INTO `komoditas` (`id`, `nama`, `harga`) VALUES
(1, 'Kambing', 2500000),
(2, 'Sapi', 10000000),
(3, 'Ikan', 350000),
(4, 'Ayam', 500000),
(5, 'Domba', 5000000);

-- --------------------------------------------------------

--
-- Table structure for table `lokasi`
--

CREATE TABLE `lokasi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `kode_zip` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokasi`
--

INSERT INTO `lokasi` (`id`, `nama`, `kode_zip`) VALUES
(1, 'Jakarta', 10210),
(2, 'Bogor', 16110),
(3, 'Depok', 16411),
(4, 'Tangerang', 15111),
(5, 'Bekasi', 17111);

-- --------------------------------------------------------

--
-- Table structure for table `surveyor`
--

CREATE TABLE `surveyor` (
  `id` int(11) NOT NULL,
  `marketing_nama` varchar(50) NOT NULL COMMENT 'Ambil dari User yang submit',
  `waktu` date NOT NULL DEFAULT current_timestamp() COMMENT 'Tanggal proses submit data',
  `komoditas_id` int(11) NOT NULL COMMENT 'Ambil dari data master',
  `lokasi_id` int(11) NOT NULL COMMENT 'Ambil dari data master',
  `repeat_order` tinyint(1) NOT NULL,
  `hasil_survey` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surveyor`
--

INSERT INTO `surveyor` (`id`, `marketing_nama`, `waktu`, `komoditas_id`, `lokasi_id`, `repeat_order`, `hasil_survey`) VALUES
(1, 'Syawal Adidana', '2024-07-06', 1, 1, 0, NULL),
(2, 'Rio Orangono', '2024-07-06', 1, 2, 0, NULL),
(3, 'Isti Lahnyatuh', '2024-07-06', 1, 3, 0, NULL),
(4, 'Ijrabe Rabe', '2024-07-06', 1, 1, 0, NULL),
(5, 'Sime Disin', '2024-07-06', 2, 2, 0, NULL),
(6, 'Isti Lahnyatuh', '2024-07-06', 2, 3, 0, NULL),
(7, 'Test User', '2024-07-06', 2, 1, 0, NULL),
(8, 'Lampa Uidia', '2024-07-06', 3, 2, 0, NULL),
(9, 'Kharis', '2024-07-06', 3, 3, 0, NULL),
(10, 'Denny', '2024-07-07', 1, 1, 0, NULL),
(11, 'Intan', '2024-07-07', 2, 1, 0, NULL),
(12, 'Alvin', '2024-07-07', 3, 2, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `no_telp` varchar(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `komoditas`
--
ALTER TABLE `komoditas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi`
--
ALTER TABLE `lokasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveyor`
--
ALTER TABLE `surveyor`
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
-- AUTO_INCREMENT for table `komoditas`
--
ALTER TABLE `komoditas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `lokasi`
--
ALTER TABLE `lokasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `surveyor`
--
ALTER TABLE `surveyor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
