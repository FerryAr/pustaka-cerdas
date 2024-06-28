-- Adminer 4.8.1 MySQL 11.4.2-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `perpus`;
CREATE DATABASE `perpus` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `perpus`;

DROP TABLE IF EXISTS `buku`;
CREATE TABLE `buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(250) NOT NULL,
  `pengarang` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `penerbit` varchar(250) NOT NULL,
  `isbn` varchar(100) NOT NULL,
  `edisi` varchar(100) NOT NULL,
  `tahun_terbit` varchar(20) NOT NULL,
  `klasifikasi` varchar(50) NOT NULL,
  `no_panggil` varchar(25) NOT NULL,
  `jumlah_buku` int(11) NOT NULL,
  `foto_sampul` text NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kategori` (`id_kategori`),
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_buku` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `buku` (`id`, `judul`, `pengarang`, `deskripsi`, `penerbit`, `isbn`, `edisi`, `tahun_terbit`, `klasifikasi`, `no_panggil`, `jumlah_buku`, `foto_sampul`, `id_kategori`) VALUES
(3,	'Buku pintar app inventor untuk pemula',	'Abdul Kadir',	'-',	'Yogyakarta : Andi',	'-',	'-',	'2017',	'006.6',	'006.6 KAD b',	2,	'f14ff3d7e7d67de7a2407f480f81d6c5.jpg',	2);

DROP TABLE IF EXISTS `kategori_buku`;
CREATE TABLE `kategori_buku` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(100) NOT NULL,
  `slug` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kategori_buku` (`id`, `nama_kategori`, `slug`) VALUES
(2,	'Karya Umum',	'karya-umum');

DROP TABLE IF EXISTS `mhs`;
CREATE TABLE `mhs` (
  `nim` int(25) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `prodi` varchar(250) NOT NULL,
  PRIMARY KEY (`nim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mhs` (`nim`, `nama`, `prodi`) VALUES
(202351094,	'Yunus',	'TI'),
(202351099,	'Azriel',	'TI'),
(202351103,	'Mail',	'TI');

DROP TABLE IF EXISTS `peminjam`;
CREATE TABLE `peminjam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` int(25) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status_kembali` tinyint(2) NOT NULL COMMENT '0 = belum kembali, 1 = kembali',
  PRIMARY KEY (`id`),
  KEY `nim` (`nim`),
  CONSTRAINT `peminjam_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `mhs` (`nim`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `peminjam` (`id`, `nim`, `tanggal_pinjam`, `tanggal_kembali`, `status_kembali`) VALUES
(4,	202351094,	'2024-06-24',	'2024-07-01',	1),
(5,	202351103,	'2024-06-24',	'2024-07-02',	0),
(6,	202351094,	'2024-06-25',	'2024-07-02',	0);

DROP TABLE IF EXISTS `peminjam_detail`;
CREATE TABLE `peminjam_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_peminjam` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_peminjam` (`id_peminjam`),
  KEY `id_buku` (`id_buku`),
  CONSTRAINT `peminjam_detail_ibfk_1` FOREIGN KEY (`id_peminjam`) REFERENCES `peminjam` (`id`) ON DELETE CASCADE,
  CONSTRAINT `peminjam_detail_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `peminjam_detail` (`id`, `id_peminjam`, `id_buku`) VALUES
(4,	4,	3),
(5,	5,	3),
(6,	6,	3);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL COMMENT '1 = admin, 2  = petugas, 3 = users',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1,	'admin',	'$2a$12$ebQz1GxzTvRpX0ieVoyT..Xnf/DLr3jlEPFMxiDhdr4dpbTHH41Bm',	1),
(4,	'202351099',	'$2y$10$IjjnYQ/BgcgJQRrKwPVvs.4IeCvLTIQIiE7sQOpwcoM39kpo2tncK',	3),
(6,	'petugas1',	'$2y$10$rcky6DV0Qi/Zio1q7857a.Who1mwv220Thun6MiHC8ZSUjO8RO4pS',	2),
(7,	'202351094',	'$2y$10$Ize8LAH/DPkwvPuRuOzIJ.NiFRrIFDYGmbElD6YTJOwOz6uJpMYqy',	3),
(8,	'202351103',	'$2y$10$4stp9ItMN86fS8CZBXSzy..ReNRFfsIKCLOA8IE/yeUNOtY0oJeTu',	3);

-- 2024-06-25 08:12:12
