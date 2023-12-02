-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 04:11 PM
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
-- Table structure for table `dataklien`
--

CREATE TABLE `dataklien` (
  `idKlien` int(6) NOT NULL,
  `noRM` int(6) NOT NULL,
  `noKTP` varchar(16) DEFAULT NULL,
  `namaKlien` varchar(255) NOT NULL,
  `jkKlien` enum('Laki-laki','Perempuan') NOT NULL,
  `tempatLahirKlien` varchar(20) NOT NULL,
  `tglLahirKlien` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` enum('Aktif','Non Aktif') NOT NULL,
  `tglMasuk` date NOT NULL,
  `kondisiAwl` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dataklien`
--

INSERT INTO `dataklien` (`idKlien`, `noRM`, `noKTP`, `namaKlien`, `jkKlien`, `tempatLahirKlien`, `tglLahirKlien`, `alamat`, `status`, `tglMasuk`, `kondisiAwl`) VALUES
(1, 1, '6201056101950001', 'Ariska Lola Priadi', 'Perempuan', 'Palangkaraya, Kalima', '1995-12-01', 'Palangkaraya, Kalimantan Tengah', 'Aktif', '2023-06-01', 'Tidak terkontrol'),
(2, 2, '6201056101950002', 'Revyanto', 'Laki-laki', 'Toraja', '2002-12-04', 'Toraja', 'Non Aktif', '2015-12-01', '-');

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

-- --------------------------------------------------------

--
-- Table structure for table `evalemosional`
--

CREATE TABLE `evalemosional` (
  `idEmosi` int(6) NOT NULL,
  `idKlien` int(6) DEFAULT NULL,
  `idJadwal` int(6) DEFAULT NULL,
  `idPemantau` int(6) DEFAULT NULL,
  `catatanEval` varchar(255) DEFAULT NULL,
  `kategori` enum('Salomo','Victory','Istimewa') DEFAULT NULL,
  `skor` int(3) DEFAULT NULL,
  `waktuCatat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evalkognitif`
--

CREATE TABLE `evalkognitif` (
  `idKognitif` int(6) NOT NULL,
  `idKlien` int(6) DEFAULT NULL,
  `idJadwal` int(6) DEFAULT NULL,
  `idPemantau` int(6) DEFAULT NULL,
  `catatanEval` varchar(255) DEFAULT NULL,
  `kategori` enum('Salomo','Victory','Istimewa') DEFAULT NULL,
  `skor` int(3) DEFAULT NULL,
  `waktuCatat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evalmedis`
--

CREATE TABLE `evalmedis` (
  `idMedis` int(6) NOT NULL,
  `idKlien` int(6) DEFAULT NULL,
  `idJadwal` int(6) DEFAULT NULL,
  `idPemantau` int(6) DEFAULT NULL,
  `catatanEval` varchar(255) DEFAULT NULL,
  `obatDiminum` varchar(100) DEFAULT NULL,
  `dosisObat` int(11) DEFAULT NULL,
  `kategori` enum('Salomo','Victory','Istimewa') DEFAULT NULL,
  `skor` int(3) DEFAULT NULL,
  `waktuCatat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evalperilaku`
--

CREATE TABLE `evalperilaku` (
  `idPerilaku` int(6) NOT NULL,
  `idKlien` int(6) DEFAULT NULL,
  `idJadwal` int(6) DEFAULT NULL,
  `idPemantau` int(6) DEFAULT NULL,
  `catatanEval` varchar(255) DEFAULT NULL,
  `kategori` enum('Salomo','Victory','Istimewa') DEFAULT NULL,
  `skor` int(3) DEFAULT NULL,
  `waktuCatat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwalharian`
--

CREATE TABLE `jadwalharian` (
  `idJadwal` int(6) NOT NULL,
  `idPemantau` int(6) DEFAULT NULL,
  `hariTgl` datetime NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `koordHarian` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwalharian`
--

INSERT INTO `jadwalharian` (`idJadwal`, `idPemantau`, `hariTgl`, `kegiatan`, `koordHarian`) VALUES
(1, 1, '2023-12-02 08:00:00', 'Doa pagi', 'Kak Ngizthy dan tim'),
(2, 3, '2023-12-02 10:00:00', 'Senam pagi', 'Anak-anak magang');

-- --------------------------------------------------------

--
-- Table structure for table `rekapkonflik`
--

CREATE TABLE `rekapkonflik` (
  `idKonflik` int(6) NOT NULL,
  `konflik` enum('Ya','Tidak') NOT NULL,
  `catatanKonflik` varchar(255) NOT NULL,
  `idKlien` int(6) NOT NULL,
  `idJadwal` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(8) NOT NULL,
  `username` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dataklien`
--
ALTER TABLE `dataklien`
  ADD PRIMARY KEY (`idKlien`);

--
-- Indexes for table `datapemantau`
--
ALTER TABLE `datapemantau`
  ADD PRIMARY KEY (`idPemantau`);

--
-- Indexes for table `evalemosional`
--
ALTER TABLE `evalemosional`
  ADD PRIMARY KEY (`idEmosi`),
  ADD KEY `fk_evalEmosi_dataklien` (`idKlien`),
  ADD KEY `fk_jadwalEmosi_dataklien` (`idJadwal`),
  ADD KEY `fk_pemantauEmosi_dataklien` (`idPemantau`);

--
-- Indexes for table `evalkognitif`
--
ALTER TABLE `evalkognitif`
  ADD PRIMARY KEY (`idKognitif`),
  ADD KEY `fk_evalKognitif_dataklien` (`idKlien`),
  ADD KEY `fk_jadwalKogni_dataklien` (`idJadwal`),
  ADD KEY `fk_pemantaukogni_dataklien` (`idPemantau`);

--
-- Indexes for table `evalmedis`
--
ALTER TABLE `evalmedis`
  ADD PRIMARY KEY (`idMedis`),
  ADD KEY `fk_evalMedis_dataklien` (`idKlien`),
  ADD KEY `fk_jadwalMedis_dataklien` (`idJadwal`),
  ADD KEY `fk_pemantaumedis_dataklien` (`idPemantau`);

--
-- Indexes for table `evalperilaku`
--
ALTER TABLE `evalperilaku`
  ADD PRIMARY KEY (`idPerilaku`),
  ADD KEY `fk_evalPerilaku_dataklien` (`idKlien`),
  ADD KEY `fk_jadwalPerilaku_dataklien` (`idJadwal`),
  ADD KEY `fk_pemantauperilaku_dataklien` (`idPemantau`);

--
-- Indexes for table `jadwalharian`
--
ALTER TABLE `jadwalharian`
  ADD PRIMARY KEY (`idJadwal`),
  ADD KEY `jadwalharian_ibfk_1` (`idPemantau`);

--
-- Indexes for table `rekapkonflik`
--
ALTER TABLE `rekapkonflik`
  ADD PRIMARY KEY (`idKonflik`),
  ADD KEY `rekapkonflik_ibfk_1` (`idKlien`),
  ADD KEY `rekapkonflik_ibfk_2` (`idJadwal`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dataklien`
--
ALTER TABLE `dataklien`
  MODIFY `idKlien` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `datapemantau`
--
ALTER TABLE `datapemantau`
  MODIFY `idPemantau` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `evalemosional`
--
ALTER TABLE `evalemosional`
  MODIFY `idEmosi` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evalkognitif`
--
ALTER TABLE `evalkognitif`
  MODIFY `idKognitif` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evalmedis`
--
ALTER TABLE `evalmedis`
  MODIFY `idMedis` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwalharian`
--
ALTER TABLE `jadwalharian`
  MODIFY `idJadwal` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evalemosional`
--
ALTER TABLE `evalemosional`
  ADD CONSTRAINT `fk_evalEmosi_dataklien` FOREIGN KEY (`idKlien`) REFERENCES `dataklien` (`idKlien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwalEmosi_dataklien` FOREIGN KEY (`idJadwal`) REFERENCES `jadwalharian` (`idJadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemantauEmosi_dataklien` FOREIGN KEY (`idPemantau`) REFERENCES `datapemantau` (`idPemantau`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evalkognitif`
--
ALTER TABLE `evalkognitif`
  ADD CONSTRAINT `fk_evalKognitif_dataklien` FOREIGN KEY (`idKlien`) REFERENCES `dataklien` (`idKlien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwalKogni_dataklien` FOREIGN KEY (`idJadwal`) REFERENCES `jadwalharian` (`idJadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemantaukogni_dataklien` FOREIGN KEY (`idPemantau`) REFERENCES `datapemantau` (`idPemantau`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evalmedis`
--
ALTER TABLE `evalmedis`
  ADD CONSTRAINT `fk_evalMedis_dataklien` FOREIGN KEY (`idKlien`) REFERENCES `dataklien` (`idKlien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwalMedis_dataklien` FOREIGN KEY (`idJadwal`) REFERENCES `jadwalharian` (`idJadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemantaumedis_dataklien` FOREIGN KEY (`idPemantau`) REFERENCES `datapemantau` (`idPemantau`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evalperilaku`
--
ALTER TABLE `evalperilaku`
  ADD CONSTRAINT `fk_evalPerilaku_dataklien` FOREIGN KEY (`idKlien`) REFERENCES `dataklien` (`idKlien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_jadwalPerilaku_dataklien` FOREIGN KEY (`idJadwal`) REFERENCES `jadwalharian` (`idJadwal`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pemantauperilaku_dataklien` FOREIGN KEY (`idPemantau`) REFERENCES `datapemantau` (`idPemantau`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwalharian`
--
ALTER TABLE `jadwalharian`
  ADD CONSTRAINT `jadwalharian_ibfk_1` FOREIGN KEY (`idPemantau`) REFERENCES `datapemantau` (`idPemantau`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekapkonflik`
--
ALTER TABLE `rekapkonflik`
  ADD CONSTRAINT `rekapkonflik_ibfk_1` FOREIGN KEY (`idKlien`) REFERENCES `dataklien` (`idKlien`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rekapkonflik_ibfk_2` FOREIGN KEY (`idJadwal`) REFERENCES `jadwalharian` (`idJadwal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
