-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Agu 2023 pada 08.53
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsma`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jenis_sabun`
--

CREATE TABLE `tb_jenis_sabun` (
  `kode_jenis` varchar(16) NOT NULL,
  `nama_jenis` varchar(255) DEFAULT NULL,
  `gambar` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_periode`
--

CREATE TABLE `tb_periode` (
  `kode_periode` varchar(16) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_permintaan_sabun`
--

CREATE TABLE `tb_permintaan_sabun` (
  `ID` int(11) NOT NULL,
  `kode_periode` varchar(16) DEFAULT NULL,
  `kode_jenis` varchar(16) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `Id_pengguna` int(100) NOT NULL,
  `Nama_lengkap` varchar(225) NOT NULL,
  `Email` varchar(225) NOT NULL,
  `Username` varchar(16) DEFAULT NULL,
  `Password` varchar(16) DEFAULT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`Id_pengguna`, `Nama_lengkap`, `Email`, `Username`, `Password`, `level`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', 'admin', 'admin'),
(2, 'ROYAL', 'pimpinan@gmail.com', 'pimpinan', 'pimpinan', 'pimpinan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_jenis_sabun`
--
ALTER TABLE `tb_jenis_sabun`
  ADD PRIMARY KEY (`kode_jenis`);

--
-- Indeks untuk tabel `tb_periode`
--
ALTER TABLE `tb_periode`
  ADD PRIMARY KEY (`kode_periode`);

--
-- Indeks untuk tabel `tb_permintaan_sabun`
--
ALTER TABLE `tb_permintaan_sabun`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`Id_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_permintaan_sabun`
--
ALTER TABLE `tb_permintaan_sabun`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `Id_pengguna` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
