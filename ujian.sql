-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2015 at 06:41 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ujian`
--

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE IF NOT EXISTS `kendaraan` (
`kendaraan_id` int(11) NOT NULL,
  `kendaraan_platnomor` varchar(30) NOT NULL,
  `kendaraan_merk` varchar(100) NOT NULL,
  `kendaraan_tipe` varchar(47) NOT NULL,
  `kendaraan_tahunrakit` int(4) NOT NULL,
  `kendaraan_seat` int(11) NOT NULL,
  `kendaraan_foto` text NOT NULL,
  `kendaraan_fasilitas` text NOT NULL,
  `kendaraan_status` enum('bebas','jalan') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`kendaraan_id`, `kendaraan_platnomor`, `kendaraan_merk`, `kendaraan_tipe`, `kendaraan_tahunrakit`, `kendaraan_seat`, `kendaraan_foto`, `kendaraan_fasilitas`, `kendaraan_status`) VALUES
(1, 'B 1111 VGA', 'isuzu', 'NKR 55 CO', 2011, 11, '', 'Reclining seats, LCD 12", Multimedia player', 'jalan'),
(2, 'B 2222 VGA', 'Hino', 'Dutro Bus 130 MDBL', 2011, 25, '', 'Reclining seats, Foot rests, 2 LCD 19", Multimedia player, Wireless microphone, Koneksi wifi', ''),
(3, 'B 3333 VGA', 'hino', 'R 260', 2011, 43, 'ASAS', 'Reclining seats, Foot rests, 3 LCD 19", Multimedia player, Wireless microphone, Koneksi wifi', 'bebas'),
(4, 'B 4444 VGA', 'hino', 'RN 285', 2012, 40, 'asa', 'Reclining seats, Foot rests, 3 LCD 19", Multimedia player, Wireless microphone, Koneksi wifi, Toilet', 'bebas'),
(8, 'B 5555 VGA', 'Mercedes Benz', 'MB 1626', 2011, 43, 'DSDSDS', 'Reclining seats, Foot rests, 3 LCD 19", Multimedia player, Wireless microphone, Koneksi wifi, Toilet', 'bebas'),
(9, 'B 6666 VGA', 'Mercedes Benz', 'MB 1626', 2012, 40, 'DSD', 'Reclining seats, Foot rests, 3 LCD 19", Multimedia player, Wireless microphone, Koneksi wifi, Toilet', 'bebas'),
(10, 'B 7777 VGA', 'K310IB-4x2', 'SCANIA', 2010, 40, 'SDD', 'Reclining seats, Foot rests, 3 LCD 19", Multimedia player, Wireless microphone, Koneksi wifi, Toilet', 'bebas'),
(11, 'B 8888 VGA', 'Scania', 'K360IB-4x2', 2012, 40, 'SDSD', 'Reclining seats, Foot rests, 3 LCD 19", Multimedia player, Wireless microphone, Koneksi wifi, Toilet', 'bebas'),
(12, 'B 9999 VGA', 'MAN', 'MAN R37', 2012, 40, 'DSDSDSDSDSDS', 'Reclining seats, Foot rests, 5 LCD 19", Multimedia player, Wireless microphone, Koneksi wifi, Toilet', 'bebas');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE IF NOT EXISTS `pelanggan` (
`pelanggan_id` int(11) NOT NULL,
  `pelanggan_nama` varchar(50) NOT NULL,
  `pelanggan_alamat` text NOT NULL,
  `pelanggan_telpon` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_alamat`, `pelanggan_telpon`) VALUES
(1, 'NURIS AKBAR', 'BANDUNG', '082121473036'),
(2, 'andi', 'jakarta', '0812 1111'),
(3, 'tono', 'bekasi', '0812 2222'),
(4, 'citra', 'depok', '0812 3333'),
(5, 'dewi', 'bogor', '0812 4444'),
(6, 'marzuki', 'tangerang', '0812 5555');

-- --------------------------------------------------------

--
-- Table structure for table `sopir`
--

CREATE TABLE IF NOT EXISTS `sopir` (
`sopir_id` int(11) NOT NULL,
  `sopir_alamat` text NOT NULL,
  `sopir_nama` varchar(100) NOT NULL,
  `sopir_telpon` varchar(12) NOT NULL,
  `sopir_ktp` varchar(30) NOT NULL,
  `sopir_sim` varchar(30) NOT NULL,
  `sopir_status` enum('bebas','jalan') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sopir`
--

INSERT INTO `sopir` (`sopir_id`, `sopir_alamat`, `sopir_nama`, `sopir_telpon`, `sopir_ktp`, `sopir_sim`, `sopir_status`) VALUES
(1, 'BEKASI', 'Andreas', '08182222', '1234 2222', '6789 2222', 'bebas'),
(2, 'JAKARTA', 'Alexander', '08181111', '1234 1111', '6789 1111', 'jalan'),
(3, 'DEPOK', 'Bimo', '08183333', '1234 3333', '6789 3333', 'bebas'),
(4, 'bogor', 'Bima', '08184444', '1234 4444', '6789 4444', 'bebas'),
(5, 'jakarta', 'Chandra', '08185555', '1234 5555', '6789 5555', 'bebas'),
(6, 'benasi', 'David', '08186666', '1234 6666', '6789 6666', 'bebas'),
(7, '', 'Dhanil', '08187777', '1234 7777', '6789 7777', 'bebas'),
(8, 'bogor', 'Edward', '08188888', '1234 8888', '6789 8888', 'bebas'),
(9, 'tangerang', 'Fernando', '08189999', '1234 9999', '6789 9999', 'bebas');

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE IF NOT EXISTS `tarif` (
`tarif_id` int(11) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `tarif_perhari` int(11) NOT NULL,
  `tarif_overtime` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`tarif_id`, `kendaraan_id`, `tarif_perhari`, `tarif_overtime`) VALUES
(3, 1, 1000000, 1000000),
(4, 2, 2000000, 2000000),
(5, 3, 3000000, 3000000),
(6, 4, 4000000, 4000000),
(7, 8, 5000000, 5000000),
(8, 9, 6000000, 6000000),
(9, 10, 7000000, 7000000),
(10, 11, 8000000, 8000000),
(11, 12, 9000000, 9000000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
`transaksi_id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `sopir_id` int(11) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `transaksi_tglmulai` date NOT NULL,
  `transaksi_tglselesai` date DEFAULT NULL,
  `transaksi_hari` varchar(10) NOT NULL,
  `transaksi_tglovertime` date NOT NULL,
  `transaksi_hariovertime` int(11) NOT NULL,
  `transaksi_total` int(11) NOT NULL,
  `transaksi_status` enum('mulai','selesai') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `pelanggan_id`, `sopir_id`, `kendaraan_id`, `transaksi_tglmulai`, `transaksi_tglselesai`, `transaksi_hari`, `transaksi_tglovertime`, `transaksi_hariovertime`, `transaksi_total`, `transaksi_status`) VALUES
(1, 2, 2, 1, '2015-06-12', '2015-06-13', '1', '2015-06-19', 6, 6000000, 'selesai'),
(2, 2, 2, 1, '2015-06-11', '2015-06-13', '', '0000-00-00', 0, 0, 'mulai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
 ADD PRIMARY KEY (`kendaraan_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
 ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `sopir`
--
ALTER TABLE `sopir`
 ADD PRIMARY KEY (`sopir_id`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
 ADD PRIMARY KEY (`tarif_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
 ADD PRIMARY KEY (`transaksi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
MODIFY `kendaraan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sopir`
--
ALTER TABLE `sopir`
MODIFY `sopir_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
MODIFY `tarif_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
