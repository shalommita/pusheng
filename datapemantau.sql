-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 03:50 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard_pondok`
--

-- --------------------------------------------------------

--
-- Table structure for table `datapemantau`
--

CREATE TABLE `datapemantau` (
  `idPemantau` int(6) NOT NULL,
  `namaPemantau` varchar(50) DEFAULT NULL,
  `jkPemantau` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tempatPemantau` varchar(20) DEFAULT NULL,
  `tglPemantau` date DEFAULT NULL,
  `peran` enum('Pembina','Psikolog Klinis','Psikososial','Asisten Medis') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datapemantau`
--

INSERT INTO `datapemantau` (`idPemantau`, `namaPemantau`, `jkPemantau`, `tempatPemantau`, `tglPemantau`, `peran`) VALUES
(1, 'Ngizthy R.W. Nalle', 'Perempuan', 'Soe', '1975-05-30', 'Psikososial'),
(3, 'Alfred Abanat', 'Laki-laki', 'Sulawesi', '1979-11-11', 'Psikolog Klinis'),
(4, 'Kak Esa', 'Laki-laki', 'Yogyakarta', '1989-01-21', 'Asisten Medis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datapemantau`
--
ALTER TABLE `datapemantau`
  ADD PRIMARY KEY (`idPemantau`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datapemantau`
--
ALTER TABLE `datapemantau`
  MODIFY `idPemantau` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
