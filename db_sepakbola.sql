-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 03, 2023 at 12:15 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sepakbola`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `kode_buku` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `tahun` varchar(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `kode_buku`, `judul`, `kategori`, `stok`, `tahun`, `created_at`, `updated_at`) VALUES
(1, 'BK-0001', 'Para Pencari Tuhan', '1', 20, '2012', '2023-05-30 02:33:33', '2023-05-30 04:07:26'),
(2, 'BK-0002', 'Testingggg', '1', 12, '2011', '2023-05-30 03:43:23', '2023-05-30 04:28:31'),
(3, 'BK-0003', 'Test 123', '1', 12, '0', '2023-05-30 03:48:38', '2023-05-30 04:07:26'),
(6, 'BK-0006', 'Test 123', '1', 12, '', '2023-05-30 03:52:35', '2023-05-30 04:07:26'),
(7, 'BK-0009', 'Test 123', '1', 12, '', '2023-05-30 03:53:55', '2023-05-30 04:07:26'),
(10, 'BK-00011', 'Test', '1', 0, '2011', '2023-05-30 09:52:34', '2023-05-30 09:52:34'),
(11, 'BK-00013', 'Test', '3', 11, '2011', '2023-05-30 09:53:01', '2023-05-30 09:55:27');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Pengetahuan Umum', '2023-05-30 09:54:45', '2023-05-30 09:54:45'),
(2, 'Agama', '2023-05-30 04:45:30', '2023-05-30 04:45:30');

-- --------------------------------------------------------

--
-- Table structure for table `klub`
--

CREATE TABLE `klub` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `klub`
--

INSERT INTO `klub` (`id`, `nama`, `kota`, `created_at`, `updated_at`) VALUES
(1, 'Persib', 'Bandung', '2023-06-28 00:21:11', '2023-06-28 00:21:11'),
(2, 'Arema', 'Tidak Tau', '2023-06-28 00:21:11', '2023-06-28 00:21:11'),
(3, 'Persebaya', 'Surabaya', '2023-06-28 00:28:38', '2023-06-28 00:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(10) NOT NULL,
  `level` varchar(255) NOT NULL,
  `status` enum('PUBLISH','DRAFT','UNPUBLISH','DELETED') DEFAULT 'PUBLISH',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_create` int(10) NOT NULL DEFAULT '0',
  `user_update` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level`, `status`, `date_create`, `date_update`, `user_create`, `user_update`) VALUES
(1, 'administrator', 'PUBLISH', '2022-10-20 03:12:13', '2022-10-20 03:12:13', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `peminjam` varchar(255) NOT NULL,
  `nomor_hp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `buku` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `peminjam`, `nomor_hp`, `alamat`, `buku`, `jumlah`, `tanggal_pinjam`, `tanggal_kembali`, `created_at`, `updated_at`) VALUES
(3, 'raisyah', '+6285876543767', '8a Jalan Dakota', '2', 3, '2023-05-30', '2023-06-01', '2023-05-30 07:24:36', '2023-05-30 08:26:44'),
(4, 'raisyah123', '+62853728619', '8a Jalan Dakota', '3', 3, '2023-05-30', '2023-06-01', '2023-05-30 07:25:53', '2023-05-30 07:29:06'),
(6, 'Siti', '+62853728619', '8a Jalan Dakota', '1', 1, '2023-05-30', '2023-06-01', '2023-05-30 09:57:24', '2023-05-30 09:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `skor`
--

CREATE TABLE `skor` (
  `id` int(11) NOT NULL,
  `klub_1` varchar(255) NOT NULL,
  `skor_klub_1` int(11) NOT NULL,
  `klub_2` varchar(255) NOT NULL,
  `skor_klub_2` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skor`
--

INSERT INTO `skor` (`id`, `klub_1`, `skor_klub_1`, `klub_2`, `skor_klub_2`, `created_at`, `updated_at`) VALUES
(1, '2', 2, '1', 1, '2023-06-28 13:57:43', '2023-06-28 13:57:43'),
(2, '3', 2, '1', 1, '2023-06-28 13:59:37', '2023-06-28 13:59:37'),
(3, '3', 2, '2', 1, '2023-06-28 14:02:11', '2023-06-28 14:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `id_employee` int(10) UNSIGNED NOT NULL,
  `id_unit` int(10) DEFAULT '0',
  `id_level` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `id_area` int(10) DEFAULT '0',
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('PUBLISH','DRAFT','UNPUBLISH','DELETED') DEFAULT 'PUBLISH',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_create` int(10) NOT NULL DEFAULT '0',
  `user_update` int(10) NOT NULL DEFAULT '0',
  `id_cabang` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `id_employee`, `id_unit`, `id_level`, `id_area`, `email`, `username`, `password`, `status`, `date_create`, `date_update`, `user_create`, `user_update`, `id_cabang`) VALUES
(3, 71, 0, 1, 0, 'admin@gmail.com', 'admin', '$2y$10$iqV4MeairR06k/ij/V4niuzQQq/pHtFMxxlzBCFnAklYVPOgqRxU2', 'PUBLISH', '2020-07-02 05:12:23', '2020-07-02 05:12:23', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `klub`
--
ALTER TABLE `klub`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skor`
--
ALTER TABLE `skor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `klub`
--
ALTER TABLE `klub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `skor`
--
ALTER TABLE `skor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
