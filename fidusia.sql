-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Agu 2021 pada 03.57
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fidusia`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `arsip`
--

CREATE TABLE `arsip` (
  `id_arsip` int(8) NOT NULL,
  `id_pbr_fidusia` int(8) NOT NULL,
  `id_pnr_fidusia` int(8) NOT NULL,
  `nama_arsip` varchar(32) NOT NULL,
  `link_arsip` varchar(256) NOT NULL,
  `tgl_input_arsip` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `arsip`
--

INSERT INTO `arsip` (`id_arsip`, `id_pbr_fidusia`, `id_pnr_fidusia`, `nama_arsip`, `link_arsip`, `tgl_input_arsip`) VALUES
(1, 4, 4, 'Google', 'https://www.google.com', '2021-07-05 22:20:45'),
(2, 1, 3, 'Google', 'https://www.google.com', '2021-07-05 22:21:28'),
(3, 1, 1, 'Google', 'https://www.google.com', '2021-07-07 03:58:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_objek`
--

CREATE TABLE `kategori_objek` (
  `id_kategori` int(8) NOT NULL,
  `kategori` enum('Serial Nomor','Tidak Berserial Nomor') NOT NULL,
  `jenis_kategori` enum('Kendaraan R4','Kendaraan R2','Hewan Ternak','Barang') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_objek`
--

INSERT INTO `kategori_objek` (`id_kategori`, `kategori`, `jenis_kategori`) VALUES
(1, 'Serial Nomor', 'Kendaraan R4'),
(4, 'Serial Nomor', 'Kendaraan R2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `objek_fidusia`
--

CREATE TABLE `objek_fidusia` (
  `id_objek` int(8) NOT NULL,
  `id_pbr_fidusia` int(8) NOT NULL,
  `id_kategori` int(8) NOT NULL,
  `merk_objek` varchar(64) NOT NULL,
  `tipe_objek` varchar(64) NOT NULL,
  `tahun_objek` varchar(8) NOT NULL,
  `norak_objek` varchar(64) NOT NULL,
  `nomes_objek` varchar(64) NOT NULL,
  `warna_objek` varchar(32) NOT NULL,
  `bukti_objek` varchar(256) NOT NULL,
  `nilai_objek` varchar(64) NOT NULL,
  `nilai_penjaminan` varchar(64) NOT NULL,
  `jangka_waktu` enum('6 Bulan','12 Bulan','24 Bulan') NOT NULL,
  `Keterangan` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `objek_fidusia`
--

INSERT INTO `objek_fidusia` (`id_objek`, `id_pbr_fidusia`, `id_kategori`, `merk_objek`, `tipe_objek`, `tahun_objek`, `norak_objek`, `nomes_objek`, `warna_objek`, `bukti_objek`, `nilai_objek`, `nilai_penjaminan`, `jangka_waktu`, `Keterangan`) VALUES
(2, 2, 1, 'Kawasaki', 'ZX', '2019', 'mh158545gd446145', 'mh445fg446443567', 'Biru', '1625497881.jpg', '200.000.000', '400.000.000', '6 Bulan', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pbr_fidusia`
--

CREATE TABLE `pbr_fidusia` (
  `id_pbr_fidusia` int(8) NOT NULL,
  `id` int(11) NOT NULL,
  `pbr_nama` varchar(64) NOT NULL,
  `pbr_alamat` varchar(256) NOT NULL,
  `pbr_nik` int(16) NOT NULL,
  `pbr_jengkel` enum('Pria','Wanita') NOT NULL,
  `pbr_nmr_kontak` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pbr_fidusia`
--

INSERT INTO `pbr_fidusia` (`id_pbr_fidusia`, `id`, `pbr_nama`, `pbr_alamat`, `pbr_nik`, `pbr_jengkel`, `pbr_nmr_kontak`) VALUES
(1, 30, 'Aldi', 'Jakarta', 2147483647, 'Pria', '16548485415648'),
(2, 35, 'Akai', 'Bandung', 2147483647, 'Pria', '53245623654534'),
(3, 36, 'Aisyah', 'Bogor', 2147483647, 'Wanita', '64574575457845'),
(4, 38, 'Tina', 'Bogor', 2147483647, 'Wanita', '16548485414324');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pjm_fidusia`
--

CREATE TABLE `pjm_fidusia` (
  `id_pjm_fidusia` varchar(8) NOT NULL,
  `id` int(11) NOT NULL,
  `id_pbr_fidusia` int(8) NOT NULL,
  `id_objek` int(8) NOT NULL,
  `id_pnr_fidusia` int(8) NOT NULL,
  `tanggal_buat` datetime NOT NULL,
  `status` enum('Draf Minuta','Review','Salinan','Daftar Online','Selesai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pjm_fidusia`
--

INSERT INTO `pjm_fidusia` (`id_pjm_fidusia`, `id`, `id_pbr_fidusia`, `id_objek`, `id_pnr_fidusia`, `tanggal_buat`, `status`) VALUES
('PJMF0002', 35, 2, 2, 1, '2021-08-06 08:55:47', 'Review');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pnr_fidusia`
--

CREATE TABLE `pnr_fidusia` (
  `id_pnr_fidusia` int(8) NOT NULL,
  `pnr_nama` varchar(64) NOT NULL,
  `pnr_alamat` varchar(256) NOT NULL,
  `pnr_nik` int(16) NOT NULL,
  `pnr_jengkel` enum('Pria','Wanita') NOT NULL,
  `pnr_nmr_kontak` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pnr_fidusia`
--

INSERT INTO `pnr_fidusia` (`id_pnr_fidusia`, `pnr_nama`, `pnr_alamat`, `pnr_nik`, `pnr_jengkel`, `pnr_nmr_kontak`) VALUES
(1, 'Bayu', 'Solo', 2147483647, 'Pria', '54356346546456'),
(2, 'Serly', 'Cirebon', 2147483647, 'Wanita', '97544763427343'),
(3, 'Lesley', 'Tangerang Selatan', 2147483647, 'Wanita', 'dasdsdgsdgwtyg'),
(4, 'Harley', 'Depok', 2147483647, 'Pria', '47456547553465'),
(5, 'Nana', 'Ciputat', 2147483647, 'Wanita', '68455156591454'),
(6, 'Tini', 'Kerawang', 2147483647, 'Wanita', '48655466549856');

-- --------------------------------------------------------

--
-- Struktur dari tabel `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `id_pjm_fidusia` varchar(8) NOT NULL,
  `id_pbr_fidusia` int(8) NOT NULL,
  `id_pnr_fidusia` int(8) NOT NULL,
  `tanggal_buat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `progress`
--

INSERT INTO `progress` (`id`, `id_pjm_fidusia`, `id_pbr_fidusia`, `id_pnr_fidusia`, `tanggal_buat`) VALUES
(35, 'PJMF0002', 2, 1, '2021-08-06 08:55:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `role` enum('Notaris','Staff Akta','User') DEFAULT NULL,
  `nama_user` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `nama_user`) VALUES
(27, 'notaris1', '$2y$10$RBv7bMSfErgUTn9zr8cnOOoCHUyxmNsad1A0nlSGLsG.CIba.QSe2', 'Notaris', 'Sugih Haryati'),
(28, 'staff1', '$2y$10$cRn.wCEHrChjrHblPUKEO.e/xUhMhEMIW7ELlo4Qfipz66Idm.1/e', 'Staff Akta', 'Staff Akta'),
(30, 'aldi', '$2y$10$f4vSGgRoOfb1GO/C.HANnus8fpCk8to7aPG7Sf/BJGOvr1uCcDPIW', 'User', 'Aldi'),
(35, 'akai', '$2y$10$zvHP3PzA.VX7weQqG1S9z.DQz3pOG8veLitaIi8SVvHvexqOFTpuW', 'User', 'Akai'),
(36, 'aisyah', '$2y$10$.lFgrQLTxI93XVt6M7KkyOifN26RsbRHGFyCCCVYW9zl/3s0hg7Bi', 'User', 'Aisyah'),
(37, 'dinda', '$2y$10$r3tkN0zKmNEGeveBn4fKze5Q8/SY4OmFWjEZ1xjUOqkek8iaQTxtm', 'User', 'Dinda'),
(38, 'tina', '$2y$10$8wAmwjPDU9pkx9pVO6ypI.9yiR.8Lq3mQZ7H4pRvw0LSxGRU1AX2m', 'User', 'Tina');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `arsip`
--
ALTER TABLE `arsip`
  ADD PRIMARY KEY (`id_arsip`),
  ADD KEY `id_pbr_fidusia` (`id_pbr_fidusia`),
  ADD KEY `id_pnr_fidusia` (`id_pnr_fidusia`);

--
-- Indeks untuk tabel `kategori_objek`
--
ALTER TABLE `kategori_objek`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `objek_fidusia`
--
ALTER TABLE `objek_fidusia`
  ADD PRIMARY KEY (`id_objek`),
  ADD KEY `id_pbr_fidusia` (`id_pbr_fidusia`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `pbr_fidusia`
--
ALTER TABLE `pbr_fidusia`
  ADD PRIMARY KEY (`id_pbr_fidusia`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `pjm_fidusia`
--
ALTER TABLE `pjm_fidusia`
  ADD PRIMARY KEY (`id_pjm_fidusia`),
  ADD KEY `id_pbr_fidusia` (`id_pbr_fidusia`),
  ADD KEY `id_objek` (`id_objek`),
  ADD KEY `id_pnr_fidusia` (`id_pnr_fidusia`),
  ADD KEY `id` (`id`);

--
-- Indeks untuk tabel `pnr_fidusia`
--
ALTER TABLE `pnr_fidusia`
  ADD PRIMARY KEY (`id_pnr_fidusia`);

--
-- Indeks untuk tabel `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id_pjm_fidusia`) USING BTREE,
  ADD KEY `id` (`id`,`id_pjm_fidusia`,`id_pbr_fidusia`,`id_pnr_fidusia`),
  ADD KEY `id_pbr_fidusia` (`id_pbr_fidusia`),
  ADD KEY `id_pnr_fidusia` (`id_pnr_fidusia`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `arsip`
--
ALTER TABLE `arsip`
  MODIFY `id_arsip` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `kategori_objek`
--
ALTER TABLE `kategori_objek`
  MODIFY `id_kategori` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `objek_fidusia`
--
ALTER TABLE `objek_fidusia`
  MODIFY `id_objek` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pbr_fidusia`
--
ALTER TABLE `pbr_fidusia`
  MODIFY `id_pbr_fidusia` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pnr_fidusia`
--
ALTER TABLE `pnr_fidusia`
  MODIFY `id_pnr_fidusia` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `arsip`
--
ALTER TABLE `arsip`
  ADD CONSTRAINT `arsip_ibfk_1` FOREIGN KEY (`id_pnr_fidusia`) REFERENCES `pnr_fidusia` (`id_pnr_fidusia`),
  ADD CONSTRAINT `arsip_ibfk_2` FOREIGN KEY (`id_pbr_fidusia`) REFERENCES `pbr_fidusia` (`id_pbr_fidusia`);

--
-- Ketidakleluasaan untuk tabel `objek_fidusia`
--
ALTER TABLE `objek_fidusia`
  ADD CONSTRAINT `objek_fidusia_ibfk_1` FOREIGN KEY (`id_pbr_fidusia`) REFERENCES `pbr_fidusia` (`id_pbr_fidusia`),
  ADD CONSTRAINT `objek_fidusia_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_objek` (`id_kategori`);

--
-- Ketidakleluasaan untuk tabel `pjm_fidusia`
--
ALTER TABLE `pjm_fidusia`
  ADD CONSTRAINT `pjm_fidusia_ibfk_1` FOREIGN KEY (`id_objek`) REFERENCES `objek_fidusia` (`id_objek`),
  ADD CONSTRAINT `pjm_fidusia_ibfk_2` FOREIGN KEY (`id_pbr_fidusia`) REFERENCES `pbr_fidusia` (`id_pbr_fidusia`),
  ADD CONSTRAINT `pjm_fidusia_ibfk_3` FOREIGN KEY (`id_pnr_fidusia`) REFERENCES `pnr_fidusia` (`id_pnr_fidusia`),
  ADD CONSTRAINT `pjm_fidusia_ibfk_4` FOREIGN KEY (`id`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `progress_ibfk_2` FOREIGN KEY (`id_pjm_fidusia`) REFERENCES `pjm_fidusia` (`id_pjm_fidusia`),
  ADD CONSTRAINT `progress_ibfk_3` FOREIGN KEY (`id_pbr_fidusia`) REFERENCES `pbr_fidusia` (`id_pbr_fidusia`),
  ADD CONSTRAINT `progress_ibfk_4` FOREIGN KEY (`id_pnr_fidusia`) REFERENCES `pnr_fidusia` (`id_pnr_fidusia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
