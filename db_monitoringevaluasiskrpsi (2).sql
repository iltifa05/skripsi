-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Agu 2023 pada 11.25
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_monitoringevaluasiskrpsi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_bidang`
--

CREATE TABLE `tb_bidang` (
  `id_bidang` int(11) NOT NULL,
  `nama_bidang` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_bidang`
--

INSERT INTO `tb_bidang` (`id_bidang`, `nama_bidang`, `created`, `modified`) VALUES
(11, 'bidang fisik', NULL, NULL),
(12, 'bidang sosial', NULL, NULL),
(13, 'bidang ekonomi', NULL, NULL),
(14, 'Bidang Sosial Budaya Lingkungan Hidup', NULL, NULL),
(15, 'pospelayanan terpadu', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_hasil` int(11) NOT NULL,
  `tanggal_hasil` date DEFAULT NULL,
  `keterangan_hasil` text DEFAULT NULL,
  `upload_foto` text DEFAULT NULL,
  `status_hasil` enum('Proses','Selesai') DEFAULT 'Proses',
  `id_pembagian` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `satuan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_hasil`
--

INSERT INTO `tb_hasil` (`id_hasil`, `tanggal_hasil`, `keterangan_hasil`, `upload_foto`, `status_hasil`, `id_pembagian`, `volume`, `satuan`) VALUES
(17, '2023-08-15', 'sedang dilaksanakan', '1692083548580.jpeg', 'Selesai', 16, 300, 'Meter'),
(18, '2023-08-15', 'kegiatan telah dilaksanakan', '1692084179810.jpeg', 'Selesai', 15, 75, 'Meter'),
(19, '2023-08-15', 'tahap  pengerjaan perbaikan draenase', '1692085215570.jpg', 'Selesai', 14, 450, 'Meter'),
(20, '2023-08-15', 'telah dilaksanakan', '1692086340240.JPG', 'Selesai', 17, 3000, 'Meter'),
(21, '2023-08-15', 'telah dilaksanakan', '1692087530340.JPG', 'Selesai', 12, 1450, 'Meter'),
(22, '2023-08-15', 'telah dilaksanakan', '1692088125440.jpg', 'Selesai', 13, 200, 'Meter');

--
-- Trigger `tb_hasil`
--
DELIMITER $$
CREATE TRIGGER `hasil-hapus` AFTER DELETE ON `tb_hasil` FOR EACH ROW UPDATE tb_pembagian SET status_pembagian = '0' WHERE id_pembagian = OLD.id_pembagian
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hasil-tambah` AFTER INSERT ON `tb_hasil` FOR EACH ROW UPDATE tb_pembagian SET status_pembagian = '1' WHERE id_pembagian = NEW.id_pembagian
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(7, 'fungsional'),
(8, 'sekretariat'),
(9, 'sub bagian umum dan kepegawaian'),
(10, 'sub bagian perencanaan'),
(11, 'sub bagian keuangan'),
(12, 'Staff bidang kewilayahan'),
(13, 'Kasubbid Sarpraswil dan SDA'),
(14, 'Kabid Fisra'),
(15, 'Kasubbid permukiman'),
(16, 'Analis Monitoring Evaluasi dan Pelaporan'),
(17, 'Penelaah Laik Fungsi Prasarana Fisik'),
(18, 'Pengelola Sumber Daya Air'),
(19, 'Pengelola Pelestarian Sumber Daya Alam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_jadwal`
--

CREATE TABLE `tb_jadwal` (
  `id_jadwal` varchar(11) NOT NULL,
  `tanggal_jadwal` date DEFAULT NULL,
  `sampai_tanggal` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `id_pengaduan` int(11) DEFAULT NULL,
  `status_jadwal` enum('0','1') DEFAULT '0',
  `id_tugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_jadwal`
--

INSERT INTO `tb_jadwal` (`id_jadwal`, `tanggal_jadwal`, `sampai_tanggal`, `keterangan`, `id_pengaduan`, `status_jadwal`, `id_tugas`) VALUES
('JDW-0001', '2023-08-09', '2023-08-10', 'Prioritas', 2, '1', NULL),
('JDW-0002', '2023-08-14', '2023-08-21', 'Di Pantau', 3, '1', NULL),
('JDW-0003', '2023-08-11', '2023-08-12', 'Di Pertimbangkan', 4, '1', NULL),
('JDW-0004', '2023-08-12', '2023-08-13', 'Prioritas', 5, '0', NULL),
('JDW-0005', '2023-08-20', '2023-08-22', 'Di Pertimbangkan', 6, '1', NULL),
('JDW-0006', '2023-08-20', '2023-08-22', 'Prioritas', 9, '1', NULL),
('JDW-0007', '2023-08-22', '2023-08-24', 'Prioritas', 7, '1', NULL),
('JDW-0008', '2023-08-23', '2023-08-24', 'Mendesak', 8, '1', NULL),
('JDW-0009', '2023-08-17', '2023-08-19', 'Di Pertimbangkan', 10, '0', NULL);

--
-- Trigger `tb_jadwal`
--
DELIMITER $$
CREATE TRIGGER `jadwal-hapus` AFTER DELETE ON `tb_jadwal` FOR EACH ROW UPDATE tb_pengaduan SET status_pengaduan = '0' WHERE id_pengaduan = OLD.id_pengaduan
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `jadwal-tambah` AFTER INSERT ON `tb_jadwal` FOR EACH ROW UPDATE tb_pengaduan SET status_pengaduan = '1' WHERE id_pengaduan = NEW.id_pengaduan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kecamatan`
--

CREATE TABLE `tb_kecamatan` (
  `id_kecamatan` int(11) NOT NULL,
  `nama_kecamatan` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_kecamatan`
--

INSERT INTO `tb_kecamatan` (`id_kecamatan`, `nama_kecamatan`, `created`, `modified`) VALUES
(2, 'Banjarbaru Selatan', NULL, NULL),
(3, 'Banjarbaru Utara', NULL, NULL),
(4, 'Cempaka', NULL, NULL),
(5, 'Landasan Ulin', NULL, NULL),
(6, 'Liang Anggang', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelurahan`
--

CREATE TABLE `tb_kelurahan` (
  `id_kelurahan` int(11) NOT NULL,
  `fk_kecamatan` int(11) DEFAULT NULL,
  `nama_kelurahan` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_kelurahan`
--

INSERT INTO `tb_kelurahan` (`id_kelurahan`, `fk_kecamatan`, `nama_kelurahan`, `created`, `modified`) VALUES
(26, 2, 'Guntung Paikat', NULL, NULL),
(27, 2, 'Kemuning', NULL, NULL),
(28, 2, 'Loktabat Selatan', NULL, NULL),
(29, 2, 'Sungai Besar', NULL, NULL),
(30, 3, 'Komet', NULL, NULL),
(31, 3, 'Loktabat Utara', NULL, NULL),
(32, 3, 'Mentaos', NULL, NULL),
(33, 3, 'Sungai Ulin', NULL, NULL),
(34, 4, 'Bangkal', NULL, NULL),
(35, 4, 'Cempaka', NULL, NULL),
(36, 4, 'Palam', NULL, NULL),
(37, 4, 'Sungai Tiung', NULL, NULL),
(38, 5, 'Guntung manggis', NULL, NULL),
(39, 5, 'Guntung payung', NULL, NULL),
(40, 5, 'Landasan ulin timur', NULL, NULL),
(41, 5, 'Syamsudin  noor', NULL, NULL),
(42, 6, 'Landasan ulin barat', NULL, NULL),
(43, 6, 'Landasan ulin selatan', NULL, NULL),
(44, 6, 'Landasan ulin tengah', NULL, NULL),
(45, 6, 'Landasan ulin utara', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelaporan`
--

CREATE TABLE `tb_pelaporan` (
  `id_pelaporan` int(11) NOT NULL,
  `tanggal_pelaporan` date DEFAULT NULL,
  `id_tujuan` int(11) DEFAULT NULL,
  `id_hasil` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pelaporan`
--

INSERT INTO `tb_pelaporan` (`id_pelaporan`, `tanggal_pelaporan`, `id_tujuan`, `id_hasil`) VALUES
(3, '2023-08-09', 15, 9),
(4, '2023-08-14', 18, 16),
(5, '2023-08-14', 18, 11),
(6, '2023-08-14', 18, 12),
(7, '2023-08-14', 18, 13),
(8, '2023-08-14', 18, 14),
(9, '2023-08-14', 18, 10),
(10, '2023-08-15', 18, 18),
(11, '2023-08-15', 18, 17);

--
-- Trigger `tb_pelaporan`
--
DELIMITER $$
CREATE TRIGGER `hsl-hapus` AFTER DELETE ON `tb_pelaporan` FOR EACH ROW UPDATE tb_hasil SET status_hasil = 'Proses' WHERE id_hasil = OLD.id_hasil
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hsl-tambah` AFTER INSERT ON `tb_pelaporan` FOR EACH ROW UPDATE tb_hasil SET status_hasil = 'Selesai' WHERE id_hasil = NEW.id_hasil
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembagian`
--

CREATE TABLE `tb_pembagian` (
  `id_pembagian` int(11) NOT NULL,
  `tanggal_pembagian` date DEFAULT NULL,
  `id_jadwal` varchar(11) DEFAULT NULL,
  `status_pembagian` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pembagian`
--

INSERT INTO `tb_pembagian` (`id_pembagian`, `tanggal_pembagian`, `id_jadwal`, `status_pembagian`) VALUES
(12, '2023-08-09', 'JDW-0002', '1'),
(13, '2023-08-11', 'JDW-0003', '1'),
(14, '2023-08-13', 'JDW-0001', '1'),
(15, '2023-08-20', 'JDW-0005', '1'),
(16, '2023-08-21', 'JDW-0006', '1'),
(17, '2023-08-14', 'JDW-0008', '1'),
(19, '2023-08-14', 'JDW-0008', '0');

--
-- Trigger `tb_pembagian`
--
DELIMITER $$
CREATE TRIGGER `pembagian-hapus` AFTER DELETE ON `tb_pembagian` FOR EACH ROW UPDATE tb_jadwal SET status_jadwal = '0' WHERE id_jadwal = OLD.id_jadwal
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pembagian-tambah` AFTER INSERT ON `tb_pembagian` FOR EACH ROW UPDATE tb_jadwal SET status_jadwal = '1' WHERE id_jadwal = NEW.id_jadwal
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembagianbantu`
--

CREATE TABLE `tb_pembagianbantu` (
  `id_pembagianbantu` int(11) NOT NULL,
  `id_pembagian` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pembagianbantu`
--

INSERT INTO `tb_pembagianbantu` (`id_pembagianbantu`, `id_pembagian`, `id_petugas`) VALUES
(12, 12, 6),
(13, 13, 11),
(14, 14, 13),
(15, 15, 8),
(16, 16, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengaduan`
--

CREATE TABLE `tb_pengaduan` (
  `id_pengaduan` int(11) NOT NULL,
  `tanggal_pengaduan` date DEFAULT NULL,
  `usulan` text DEFAULT NULL,
  `permasalahan` text DEFAULT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `alamat_tambahan` text DEFAULT NULL,
  `place_id` text DEFAULT NULL,
  `id_kelurahan` int(11) DEFAULT NULL,
  `id_bidang` int(11) DEFAULT NULL,
  `status_pengaduan` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pengaduan`
--

INSERT INTO `tb_pengaduan` (`id_pengaduan`, `tanggal_pengaduan`, `usulan`, `permasalahan`, `lat`, `lng`, `alamat_tambahan`, `place_id`, `id_kelurahan`, `id_bidang`, `status_pengaduan`) VALUES
(2, '2023-08-09', 'Masih Adanya Kawasan Banjir Dan Genangan', 'REHABILITASI / PEMBANGUNAN DRAINASE JALAN UTAMA (Dreanese Rusak Berat Tidak Dapat Menampung Debit Air)', -3.4323419302086955, 114.86203282858885, 'Mentaos, Banjarbaru City, South Kalimantan, Indonesia', '', 32, 13, '1'),
(3, '2023-08-09', 'Masih Ada Kondisi Jalan Yang Rusak', 'REHABILITASI / PEMELIHARAAN JALAN (PENGASPALAN)', -3.4632716216351085, 114.84297647514649, 'Loktabat Selatan, Banjarbaru City, South Kalimantan, Indonesia', '', 28, 13, '1'),
(4, '2023-08-09', 'Masih Terdapatnya RTH Perumahan Dan Pemukiman  Yang Rusak', 'PERBAIKAN/PEMELIHARAAN SARANA PENUNJANG DI FASILITAS UMUM SIRING SUNGAI KEMUNING KAMPUNG PELANGI (KURSI DUDUK KAYU UNTUK PENGUNJUNG)', -3.4322562534801495, 114.86160367514647, 'Mentaos, Banjarbaru City, South Kalimantan, Indonesia', '', 32, 13, '1'),
(5, '2023-08-09', 'Masih Ada Kondisi Jembatan Yang Rusak', 'Perlunya Pemasangan Siring Karena Menjadikan Area  Sekitar Siring Lebih Rapi Dan Bersih', -3.331204, 114.9568169, 'sei durian', '', 30, 11, '1'),
(6, '2023-08-09', 'Masih Ada Kawasan Yang Gelap', 'Perlunya Penerangan Jalan Umum Karena Masih Ada  Jalan Yang Gelap', -3.331204, 114.9568169, 'jl.permata Rt.47, komp.balitan XII Rt.48 Rw.12', '', 31, 11, '1'),
(7, '2023-08-02', 'Mash Ada Kondisi Jalan Yang Rusak', 'Perlunya Pengaspalan Dikarenakan Jalan Becek', -3.331204, 114.9568169, 'jl. komplek Griya pemurus indah rt.004 rw.001', '', 39, 11, '1'),
(8, '2023-08-01', 'Masih Ada Kawasan Genangan Air Apabila Hari Hujan Karena Jalan Air Terhambat Disebabkan Oleh Pendangkalan Dan Penyempitan Draenase ', 'Perlunya Pelebaran Daraenase Karena Pada Saat Hujan Air Meluap Kejalan Dan Halaman Rumah Warga', -3.4343928, 114.7488457, 'Jl. Airbush, Landasan Ulin Utara, Banjarbaru City, South Kalimantan, Indonesia', '', 41, 11, '1'),
(9, '2023-08-05', 'Jalan Terlalu Sempit', 'Perlunya Pelebaran Jalan Dikarenakan Aktfitas Pengendara Sduah Mulai Padat', -3.331204, 114.9568169, 'guntung manggis rt.030 ', '', 38, 11, '1'),
(10, '2023-08-14', 'Masih Ada Kondisi Jalan Yang Rusak', 'Perlunya Perbaikan Jalan Lingkungan (pemasangan Paving Blok)Kondisi Jalan Rusak Parah', -3.4320849, 114.8597154, 'Mentaos, Banjarbaru Utara, Banjarbaru City, South Kalimantan, Indonesia', '', 32, 11, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pengguna`
--

CREATE TABLE `tb_pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `level` enum('Administrator','Petugas','Kelurahan','Kecamatan') DEFAULT 'Administrator',
  `status_pengguna` enum('0','1') DEFAULT '0',
  `fk_kecamatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_pengguna`
--

INSERT INTO `tb_pengguna` (`id_pengguna`, `nama_lengkap`, `username`, `password`, `level`, `status_pengguna`, `fk_kecamatan`) VALUES
(1, 'Admin ', 'admin', '$2y$10$EsONMeV4BR9xuJ2kmPmqwO9raFUYCEKtBSutfLQljb4O19nn9.veW', 'Administrator', '1', NULL),
(82, 'wahyuno', 'wahyuno', '$2y$10$kzlwgQHtKSqQ2uGiiLKB8ODFoPk.7RjnskU0SqG6yay5nykhkZczW', 'Kecamatan', '0', 2),
(83, 'Hanna', 'hanna', '$2y$10$jWSiVjhWQ1hXylXK7o23UOZ5qUpSq3Crk2ygo4u6.gUnA3MfP54x2', 'Petugas', '0', NULL),
(84, 'Dwi Yuniati, S.Pi', 'yuniati', '$2y$10$fnnOlKy/oBjzUWcMd8c5xeu5HHmR5GVDXNwEHQEZrA2qIoiZaG9Ye', 'Petugas', '0', NULL),
(85, 'Yulia Kurniati, S.Pt', 'yulia', '$2y$10$g/eNMiz2BVNnqfpkcrh3bulqyLMWOa.IGbE1vbKGWxSRdAcoVsue6', 'Petugas', '0', NULL),
(86, 'Herry Fuziyanto, A.Md ', 'herry', '$2y$10$Aj/8Kd/iUJgc.TDJK1h9ne/gW5Bk2efPnNC8TGMsioA9jUO3iP1hy', 'Petugas', '0', NULL),
(87, 'Siti Mariana, ST', 'siti', '$2y$10$sCpV/zXyL/mrD9pcSCRxheKWu6y9/icZQEBaUDL1CcTg2qDDMIeiy', 'Petugas', '0', NULL),
(88, 'Iltifa Khulqi', 'iltifa', '$2y$10$KW27TWsxSz7TFU22LwG/DOwCz1uwgK11euJ3zlDKF/wXFv92Ffqra', 'Petugas', '0', NULL),
(89, 'Romzi Rokan Suri', 'romzi', '$2y$10$aOh1nOvvJ5i9ED72JIMC6.Un8y.Ohv3Yu.FX58KnEP9dH1TgWwybW', 'Petugas', '0', NULL),
(90, 'Violita Oktaviani', 'violita', '$2y$10$SO7tYEDl/wnEA47LvSJlNOkOyOiCaMkeA4y68586fW.U8Z/A5dYHW', 'Petugas', '0', NULL),
(91, 'Siti juleha', 'siti juleha', '$2y$10$JrvaU.e7ShJvRexCZ.vSgeQVmsc6J33az0icDK6Mcxi/2rY85Gubq', 'Kecamatan', '0', 3),
(92, 'Syahril ', 'syahril', '$2y$10$xL97pvbTcWeiYIIg0.bj/uZiMgwHGVDYcBLhLYic6nTI/I8MlPPCy', 'Kecamatan', '0', 4),
(93, 'Arlinda suci', 'arlinda', '$2y$10$LIJEoPcN1JJLFT3tUYvAIeYz1cx7rN8d55S98OKmAoGF2Fqqxc.GC', 'Kecamatan', '0', 5),
(94, 'Siska novitasari', 'siska', '$2y$10$hkr.rCBxgTWSAHel4V0l4ud22fHHgEj7FMoMH9/wDqVUBZfbdaqje', 'Kecamatan', '0', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `nip_petugas` varchar(20) DEFAULT NULL,
  `nama_petugas` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `nomor_petugas` varchar(12) DEFAULT NULL,
  `upload_foto` text DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `status_petugas` enum('1','0') DEFAULT '0',
  `id_jabatan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `nip_petugas`, `nama_petugas`, `tempat_lahir`, `tanggal_lahir`, `nomor_petugas`, `upload_foto`, `username`, `status_petugas`, `id_jabatan`) VALUES
(6, '19920209 20067 007', 'Agnia', 'banjarbaru', '1992-02-09', '081226410815', 'FotoKTP_010d01c4a9a54356e1ed530328f9d95febc83423.jpeg', 'agnia', '1', 7),
(7, '19750620 20010012 ', 'Dwi Yuniati, S.Pi', 'Banjarbaru', '1975-07-20', '087865465525', 'Foto_676108788202c52c0931f98c590654f735cf3219.jpeg', 'yuniati', '1', 17),
(8, '19760721 200701 2 ', 'Yulia Kurniati, S.Pt', 'Barabai', '1976-07-21', '085821788993', 'FotoKTP_cf98682e0ef5dbd94d63cb097e0da4c7b7b58c82.jpeg', 'yulia', '1', 16),
(9, '1975019 401087 009', 'Herry Fuziyanto, A.Md ', 'Barabai', '1975-05-19', '085221466773', 'Foto_dfc744030efcbe8f1e609e0233eea4c2c633f10d.jpg', 'herry', '1', 18),
(10, '19910221 42587 009', 'Siti Mariana, ST', 'Martapura', '1991-02-21', '085234429001', 'FotoKTP_557bfafc426df1eaea967b6ec0c5b4eab7d77894.jpeg', 'siti', '1', 19),
(11, '20000511 60021 009', 'Iltifa Khulqi', 'Bawahan selan', '2000-05-11', '085821604919', 'FotoKTP_56d222e387024d8053c5eda4596d35665c9c8a56.jpg', 'iltifa', '1', 12),
(12, '20010525 60027 006', 'Romzi Rokan Suri', 'Rantau', '2001-05-25', '087856600221', 'FotoKTP_acac60312380326432652d3f59f2c14a8afd3034.jpg', 'romzi', '1', 12),
(13, '20001015 06052 004', 'Violita Oktaviani', 'Bawahan selan', '2000-10-15', '088276544113', 'FotoKTP_3848e72e56f98623ccabd456cc822f3da84c0353.jpeg', 'violita', '1', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tugas`
--

CREATE TABLE `tb_tugas` (
  `id_tugas` int(11) NOT NULL,
  `tanggal_tugas` date DEFAULT NULL,
  `nomor_tugas` varchar(100) DEFAULT NULL,
  `keterangan_tugas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tujuan`
--

CREATE TABLE `tb_tujuan` (
  `id_tujuan` int(11) NOT NULL,
  `nama_tujuan` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tb_tujuan`
--

INSERT INTO `tb_tujuan` (`id_tujuan`, `nama_tujuan`, `created`, `modified`) VALUES
(12, 'Dinas PUPR', NULL, NULL),
(13, 'Dinas Perkim', NULL, NULL),
(14, 'Dinas Pemuda,Olahraga,Kebudayaan dan Pariwisata', NULL, NULL),
(15, 'Dinas Koperasi Usaha Kecil Menengah dan Tenaga Kerja', NULL, NULL),
(16, 'Disdik', NULL, NULL),
(17, 'Disporbudpar', NULL, NULL),
(18, 'Dinas  Pekerjaan Umum dan Penataan Ruang', NULL, NULL),
(19, 'DISDALDUK KB,PMP & PA', NULL, NULL),
(20, 'Dinas Lingkungan Hidup', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_bidang`
--
ALTER TABLE `tb_bidang`
  ADD PRIMARY KEY (`id_bidang`) USING BTREE;

--
-- Indeks untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_hasil`) USING BTREE,
  ADD KEY `id_kegiatan` (`id_pembagian`) USING BTREE;

--
-- Indeks untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`) USING BTREE;

--
-- Indeks untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD PRIMARY KEY (`id_jadwal`) USING BTREE,
  ADD KEY `id_dinas` (`keterangan`(768)) USING BTREE,
  ADD KEY `id_kelurahan` (`id_pengaduan`) USING BTREE,
  ADD KEY `id_tugas` (`id_tugas`) USING BTREE;

--
-- Indeks untuk tabel `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`) USING BTREE;

--
-- Indeks untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`) USING BTREE,
  ADD KEY `FK_tb_kelurahan_tb_kecamatan` (`fk_kecamatan`) USING BTREE;

--
-- Indeks untuk tabel `tb_pelaporan`
--
ALTER TABLE `tb_pelaporan`
  ADD PRIMARY KEY (`id_pelaporan`) USING BTREE;

--
-- Indeks untuk tabel `tb_pembagian`
--
ALTER TABLE `tb_pembagian`
  ADD PRIMARY KEY (`id_pembagian`) USING BTREE,
  ADD KEY `id_petugas` (`id_jadwal`) USING BTREE;

--
-- Indeks untuk tabel `tb_pembagianbantu`
--
ALTER TABLE `tb_pembagianbantu`
  ADD PRIMARY KEY (`id_pembagianbantu`) USING BTREE,
  ADD KEY `id_pembagian` (`id_pembagian`) USING BTREE,
  ADD KEY `id_anggota` (`id_petugas`) USING BTREE;

--
-- Indeks untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`) USING BTREE,
  ADD KEY `id_kelurahan` (`id_kelurahan`) USING BTREE,
  ADD KEY `id_bidang` (`id_bidang`) USING BTREE;

--
-- Indeks untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  ADD PRIMARY KEY (`id_pengguna`) USING BTREE;

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`) USING BTREE,
  ADD KEY `id_jabatan` (`id_jabatan`) USING BTREE;

--
-- Indeks untuk tabel `tb_tugas`
--
ALTER TABLE `tb_tugas`
  ADD PRIMARY KEY (`id_tugas`) USING BTREE;

--
-- Indeks untuk tabel `tb_tujuan`
--
ALTER TABLE `tb_tujuan`
  ADD PRIMARY KEY (`id_tujuan`) USING BTREE;

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_bidang`
--
ALTER TABLE `tb_bidang`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_kecamatan`
--
ALTER TABLE `tb_kecamatan`
  MODIFY `id_kecamatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  MODIFY `id_kelurahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `tb_pelaporan`
--
ALTER TABLE `tb_pelaporan`
  MODIFY `id_pelaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_pembagian`
--
ALTER TABLE `tb_pembagian`
  MODIFY `id_pembagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `tb_pembagianbantu`
--
ALTER TABLE `tb_pembagianbantu`
  MODIFY `id_pembagianbantu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  MODIFY `id_pengaduan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_pengguna`
--
ALTER TABLE `tb_pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_tugas`
--
ALTER TABLE `tb_tugas`
  MODIFY `id_tugas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_tujuan`
--
ALTER TABLE `tb_tujuan`
  MODIFY `id_tujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD CONSTRAINT `tb_hasil_ibfk_1` FOREIGN KEY (`id_pembagian`) REFERENCES `tb_pembagian` (`id_pembagian`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_jadwal`
--
ALTER TABLE `tb_jadwal`
  ADD CONSTRAINT `tb_jadwal_ibfk_2` FOREIGN KEY (`id_tugas`) REFERENCES `tb_tugas` (`id_tugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_jadwal_ibfk_3` FOREIGN KEY (`id_pengaduan`) REFERENCES `tb_pengaduan` (`id_pengaduan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_kelurahan`
--
ALTER TABLE `tb_kelurahan`
  ADD CONSTRAINT `tb_kelurahan_ibfk_1` FOREIGN KEY (`fk_kecamatan`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembagian`
--
ALTER TABLE `tb_pembagian`
  ADD CONSTRAINT `tb_pembagian_ibfk_1` FOREIGN KEY (`id_jadwal`) REFERENCES `tb_jadwal` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pembagianbantu`
--
ALTER TABLE `tb_pembagianbantu`
  ADD CONSTRAINT `tb_pembagianbantu_ibfk_1` FOREIGN KEY (`id_pembagian`) REFERENCES `tb_pembagian` (`id_pembagian`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembagianbantu_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_pengaduan`
--
ALTER TABLE `tb_pengaduan`
  ADD CONSTRAINT `tb_pengaduan_ibfk_1` FOREIGN KEY (`id_kelurahan`) REFERENCES `tb_kelurahan` (`id_kelurahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pengaduan_ibfk_2` FOREIGN KEY (`id_bidang`) REFERENCES `tb_bidang` (`id_bidang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD CONSTRAINT `tb_petugas_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
