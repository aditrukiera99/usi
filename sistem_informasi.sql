-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2018 at 12:49 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_informasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `ak_grup_kode_akun`
--

CREATE TABLE `ak_grup_kode_akun` (
  `ID` int(255) NOT NULL,
  `GRUP` varchar(255) DEFAULT NULL,
  `KODE_GRUP` varchar(255) DEFAULT NULL,
  `NAMA_GRUP` varchar(255) DEFAULT NULL,
  `UNIT` int(11) DEFAULT NULL,
  `APPROVE` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ak_grup_kode_akun`
--

INSERT INTO `ak_grup_kode_akun` (`ID`, `GRUP`, `KODE_GRUP`, `NAMA_GRUP`, `UNIT`, `APPROVE`) VALUES
(3, 'ASET LANCAR', '100', 'Kas dan Setara Kas', 1, 3),
(4, 'ASET LANCAR', '101', 'Deposito', 1, 3),
(5, 'ASET LANCAR', '102', 'Kas Transfer(Post Silang)', 1, 3),
(6, 'ASET LANCAR', '110', 'Piutang Usaha', 1, 3),
(7, 'ASET LANCAR', '111', 'Cadangan penyisihan penurunan nilai piutang', 1, 3),
(8, 'ASET LANCAR', '112', 'Piutang Lain Lain', 1, 3),
(9, 'ASET LANCAR', '113', 'Pendapatan Yang akan Diterima', 1, 3),
(10, 'ASET LANCAR', '120', 'Persediaan', 1, 3),
(11, 'ASET LANCAR', '130', 'Biaya Dibayar Dimuka', 1, 3),
(12, 'ASET LANCAR', '140', 'Pajak Dibayar Dimuka', 1, 3),
(13, 'ASET LANCAR', '141', 'PPN Masukan', 1, 3),
(14, 'ASET TIDAK LANCAR', '160', 'Investasi Jangka Panjang', 1, 3),
(15, 'ASET TIDAK LANCAR', '161', 'Investasi Untuk Unit', 1, 3),
(16, 'ASET TIDAK LANCAR', '170', 'Aset Tetap Berwujud', 1, 3),
(17, 'ASET TIDAK LANCAR', '171', 'Akumulasi Penyusutan Aset Tetap', 1, 3),
(18, 'ASET TIDAK LANCAR', '180', 'Aset Tetap Tak Berwujud', 1, 3),
(19, 'ASET TIDAK LANCAR', '190', 'Pajak Tangguhan', 1, 3),
(20, 'ASET TIDAK LANCAR', '150', 'Aset Tidak Lancar Lainnya', 1, 3),
(21, 'KEWAJIBAN LANCAR', '200', 'Hutang Usaha', 1, 3),
(22, 'KEWAJIBAN LANCAR', '210', 'Pendapatan Diterima dimuka', 1, 3),
(23, 'KEWAJIBAN LANCAR', '220', 'Biaya yang Masih Harus Dibayar', 1, 3),
(24, 'KEWAJIBAN LANCAR', '230', 'Hutang Bank Jangka Pendek', 1, 3),
(25, 'KEWAJIBAN LANCAR', '240', 'Hutang Pajak', 1, 3),
(26, 'KEWAJIBAN LANCAR', '241', 'PPN Keluaran', 1, 3),
(27, 'KEWAJIBAN LANCAR', '250', 'Cadangan Pembagian Laba', 1, 3),
(28, 'KEWAJIBAN LANCAR', '260', 'Hutang Lancar Lain - lain', 1, 3),
(29, 'KEWAJIBAN LANCAR', '270', 'KEWAJIBAN JANGKA PANJANG', 1, 3),
(30, 'KEWAJIBAN LAIN LAIN', '280', 'Hubungan Rekening Kantor', 1, 3),
(31, 'KEWAJIBAN LAIN LAIN', '310', 'Modal Sendiri', 1, 3),
(32, 'KEWAJIBAN LAIN LAIN', '281', 'Kewajiban Lainnya', 1, 3),
(33, 'EKUITAS', '300', 'Modal', 1, 3),
(34, 'EKUITAS', '310', 'Modal Sendiri', 1, 3),
(36, 'EKUITAS', '330', 'Laba (rugi) Tahun Berjalan', 1, 3),
(37, 'PENDAPATAN', '401', 'Pendapatan Usaha', 1, 3),
(38, 'PENDAPATAN', '404', 'Pendapatan Usaha Lainnya', 1, 3),
(39, 'BIAYA', '501', 'Biaya Usaha', 1, 3),
(40, 'BIAYA', '600', 'Biaya Pemasaran', 1, 3),
(41, 'BIAYA', '610', 'Biaya Admin & Umum', 1, 3),
(42, 'PENDAPATAN', '400', 'Pendapatan Usaha', 5, 3),
(43, 'PENDAPATAN', '403', 'Pendapatan Jasa', 5, 3),
(44, 'PENDAPATAN', '404', 'Pendapatan Usaha Lainnya', 5, 3),
(45, 'PENDAPATAN', '410', 'Pengurangan Pendapatan', 5, 3),
(46, 'PENDAPATAN', '700', 'Pendapatan Luar Usaha', 5, 3),
(47, 'BIAYA', '501', 'Beban Operasional Langsung', 5, 3),
(48, 'BIAYA', '503', 'Beban Departementalisasi', 5, 3),
(60, 'ASET LANCAR', '100', 'Kas dan Setara Kas', 2, 3),
(61, 'ASET LANCAR', '101', 'Deposito', 2, 3),
(62, 'ASET LANCAR', '100', 'Kas dan Setara Kas', 17, 3),
(63, 'ASET LANCAR', '101', 'DEPOSITO', 17, 3),
(64, 'ASET LANCAR', '102', 'KAS TRANSFER (POS SILANG)', 17, 3),
(65, 'ASET LANCAR', '110', 'PIUTANG USAHA', 17, 3),
(66, 'ASET LANCAR', '111', 'Cadangan Penyisihan Penurunan Nilai Piutang', 17, 0),
(67, 'ASET LANCAR', '113', 'Pendapatan yang akan diterima', 17, 0),
(68, 'ASET LANCAR', '120', 'Persediaan', 17, 0),
(69, 'ASET LANCAR', '130', 'Biaya dibayar dimuka', 17, 0),
(70, 'ASET LANCAR', '140', 'Pajak dibayar dimuka', 17, 0),
(71, 'ASET LANCAR', '141', 'PPN Masukan', 17, 0),
(72, 'ASET TIDAK LANCAR', '160', 'Investasi Jangka Panjang', 17, 0),
(73, 'ASET TIDAK LANCAR', '161', 'Investasi untuk unit', 17, 0),
(74, 'ASET TIDAK LANCAR', '170', 'Aset Tetap Berwujud', 17, 0),
(75, 'ASET TIDAK LANCAR', '171', 'Akumulasi Penyusutan Aset Tetap', 17, 0),
(76, 'ASET TIDAK LANCAR', '180', 'Aset Tetap Tak Berujud', 17, 0),
(77, 'ASET TIDAK LANCAR', '190', 'Pajak Tangguhan', 17, 0),
(78, 'ASET TIDAK LANCAR', '150', 'Aset Tidak Lancar Lainnya', 17, 0),
(79, 'KEWAJIBAN LANCAR', '200', 'Hutang Usaha', 17, 0),
(80, 'KEWAJIBAN LANCAR', '210', 'Pendapatan diterima dimuka', 17, 0),
(81, 'KEWAJIBAN LANCAR', '220', 'Biaya yang masih harus dibayar', 17, 0),
(82, 'KEWAJIBAN LANCAR', '230', 'Hutang bank jangka pendek', 17, 0),
(83, 'KEWAJIBAN LANCAR', '240', 'Hutang Pajak', 17, 0),
(84, 'KEWAJIBAN LANCAR', '241', 'PPN Keluaran', 17, 0),
(85, 'KEWAJIBAN LANCAR', '250', 'Cadangan Pembagian Laba', 17, 0),
(86, 'KEWAJIBAN LANCAR', '251', 'Cadangan LAin - lain', 17, 0),
(87, 'KEWAJIBAN LANCAR', '260', 'Hutang Lancar lain - lain', 17, 0),
(88, 'KEWAJIBAN LANCAR', '270', 'KEWAJIBAN JANGKA PANJANG', 17, 0),
(89, 'KEWAJIBAN LAIN LAIN', '280', 'Hubungan Rekening Kantor', 17, 0),
(90, 'KEWAJIBAN LAIN LAIN', '281', 'Kewajiban Lainnya', 17, 0),
(91, 'EKUITAS', '300', 'Modal', 17, 0),
(92, 'EKUITAS', '310', 'Modal Sendiri', 17, 0),
(93, 'EKUITAS', '320', 'Laba (Rugi) Tahun Lalu', 17, 0),
(94, 'EKUITAS', '330', 'Laba (Rugi) Tahun Berjalan', 17, 0),
(95, 'ASET LANCAR', '112', 'Piutang Lain Lain', 17, 0),
(96, 'PENDAPATAN', '401', 'Penjualan Barang Dagangan', 17, 0),
(97, 'PENDAPATAN', '402', 'Penjualan Hasil Produksi', 17, 0),
(98, 'PENDAPATAN', '403', 'Pendapatan Jasa', 17, 0),
(99, 'PENDAPATAN', '404', 'Pendapatan Usaha Lainnya', 17, 0),
(100, 'BIAYA', '500', 'BEBAN OPERASIONAL LANGSUNG', 17, 0),
(101, 'BIAYA', '501', 'BEBAN POKOK PENJUALAN', 17, 0),
(102, 'BIAYA', '502', 'BEBAN POKOK JASA', 17, 0),
(103, 'BIAYA', '503', 'BEBAN DEPARTEMENTALISASI', 17, 0),
(104, 'BIAYA', '600', 'BIAYA PEMASARAN', 17, 0),
(105, 'BIAYA', '610', 'Biaya Umum dan Administrasi', 17, 0),
(106, 'PENDAPATAN', '700', 'PENDAPATAN LUAR USHA', 17, 0),
(107, 'BIAYA', '710', 'BIAYA LUAR USAHA', 17, 0),
(108, 'BIAYA', '720', 'Beban Pajak Penghasilan', 17, 0),
(109, 'BIAYA', '620', 'Beban Administrasi Lainnya', 1, 3),
(110, 'BIAYA', '630', 'Beban Administrasi Lainnya 2', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ak_kategori_akun`
--

CREATE TABLE `ak_kategori_akun` (
  `ID` int(11) NOT NULL,
  `ID_KLIEN` int(11) DEFAULT NULL,
  `NAMA_KATEGORI` varchar(255) DEFAULT NULL,
  `DESKRIPSI` text,
  `APPROVE` int(11) DEFAULT '0',
  `USER_INPUT` varchar(255) DEFAULT NULL,
  `TGL_INPUT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ak_kategori_akun`
--

INSERT INTO `ak_kategori_akun` (`ID`, `ID_KLIEN`, `NAMA_KATEGORI`, `DESKRIPSI`, `APPROVE`, `USER_INPUT`, `TGL_INPUT`) VALUES
(1, 13, 'Kas & Bank', 'Satuan Akun Kas & Bank', 3, NULL, NULL),
(2, 13, 'Akun Piutang', NULL, 3, NULL, NULL),
(3, 13, 'Aktiva Lancar Lainnya', NULL, 3, NULL, NULL),
(4, 13, 'Persediaan', NULL, 3, NULL, NULL),
(5, 13, 'Aktiva Tetap', NULL, 3, NULL, NULL),
(6, 13, 'Depresiasi & Amortisasi', NULL, 3, NULL, NULL),
(7, 13, 'Akun Hutang', NULL, 3, NULL, NULL),
(8, 13, 'Kewajiban Lancar Lainnya', NULL, 3, NULL, NULL),
(9, 13, 'Ekuitas', NULL, 3, NULL, NULL),
(10, 13, 'Pendapatan', NULL, 3, NULL, NULL),
(11, 13, 'Harga Pokok Penjualan', NULL, 3, NULL, NULL),
(12, 13, 'Beban', NULL, 3, NULL, NULL),
(13, 13, 'Pendapatan Lainnya', 'Kategori akun untuk pendapatan lainnya', 3, NULL, NULL),
(14, 13, 'Beban Lainnya', 'Kategori Akun Beban Lainnya', 3, NULL, NULL),
(15, 13, 'Pengurang Pendapatan', '-', 3, '40', '09-11-2017, 17:47'),
(16, 13, 'Pos - Pos Lain Dalam Laba Rugi', '-', 3, '40', '14-11-2017, 17:35'),
(17, 1, 'Kategori AB', 'Kategori AB', 0, 'oke', '19-10-2017');

-- --------------------------------------------------------

--
-- Table structure for table `ak_kode_akuntansi`
--

CREATE TABLE `ak_kode_akuntansi` (
  `ID` int(11) NOT NULL,
  `KODE_AKUN` varchar(255) DEFAULT NULL,
  `NAMA_AKUN` varchar(255) DEFAULT NULL,
  `TIPE` varchar(255) DEFAULT NULL,
  `KATEGORI` varchar(255) DEFAULT NULL,
  `DESKRIPSI` text,
  `LEVEL` varchar(255) DEFAULT NULL,
  `ANAK_DARI` varchar(255) DEFAULT NULL,
  `ID_KLIEN` int(11) DEFAULT NULL,
  `APPROVE` int(255) DEFAULT '0',
  `USER_INPUT` varchar(255) DEFAULT NULL,
  `TGL_INPUT` varchar(255) DEFAULT NULL,
  `KODE_GRUP` varchar(255) DEFAULT NULL,
  `KODE_SUB` varchar(255) DEFAULT NULL,
  `UNIT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `ak_kode_akuntansi`
--

INSERT INTO `ak_kode_akuntansi` (`ID`, `KODE_AKUN`, `NAMA_AKUN`, `TIPE`, `KATEGORI`, `DESKRIPSI`, `LEVEL`, `ANAK_DARI`, `ID_KLIEN`, `APPROVE`, `USER_INPUT`, `TGL_INPUT`, `KODE_GRUP`, `KODE_SUB`, `UNIT`) VALUES
(1, '100.01.01', 'Kas Kantor Pusat', NULL, 'Kas', '', NULL, NULL, 13, 3, NULL, NULL, '100', '01', '1'),
(2, '100.01.02', 'Kas Unit Usaha', NULL, 'Kas', '', NULL, NULL, 13, 3, NULL, NULL, '100', '01', '1'),
(3, '100.02.01', 'Simpanan Kantor Pusat', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '100', '02', '1'),
(4, '100.02.02', 'Simpanan Unit Usaha', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '100', '02', '1'),
(5, '120.02.01', 'Persediaan Bahan Baku', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '120', '02', '1'),
(6, '120.02.02', 'Persediaan Bahan Pembantu', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '120', '02', '1'),
(7, '120.02.03', 'Persediaan Dalam Proses', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '120', '02', '1'),
(8, '170.01.01', 'Tanah', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '01', '1'),
(9, '170.01.02', 'Gedung dan Bangunan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '01', '1'),
(10, '170.01.03', 'Kendaraan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '01', '1'),
(11, '170.02.01', 'Aset dalam Penyelesaian', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '02', '1'),
(12, '170.02.02', 'Tanaman Belum Menghasilkan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '02', '1'),
(13, '190.02.01', 'Beban Tangguhan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '190', '02', '1'),
(14, '190.02.02', 'Akumulasi Amortisasi', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '190', '02', '1'),
(15, '150.02.01', 'Aset tetap tidak berfungsi', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '02', '1'),
(16, '150.02.02', 'Obat Kadaluarsa', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '02', '1'),
(17, '150.02.03', 'Obat Rusak', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '02', '1'),
(18, '150.03.01', 'Biaya Perintisan Usaha', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '03', '1'),
(19, '150.03.02', 'Biaya Perijinan Usaha', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '03', '1'),
(20, '150.03.03', 'Biaya Dibayar Dimuka Jangka Panjang', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '03', '1'),
(21, '150.04.01', 'Penyertaan Modal', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '1'),
(22, '150.04.02', 'Laba Usaha', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '1'),
(23, '150.04.03', 'Simpanan Dana', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '1'),
(24, '404.02.03', 'Pendapatan Lain Lain', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '404', '02', '1'),
(25, '404.02.04', 'Bunga Giro/Bank', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '404', '02', '1'),
(26, '501.02.01', 'Baku (Obat)', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '501', '02', '1'),
(27, '501.02.02', 'Pembantu/Embalage', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '501', '02', '1'),
(28, '401.01.01', 'Penjualan Resep', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '401', '01', '1'),
(29, '401.01.02', 'Penjualan HV/Swamedikasi', NULL, 'Lainnya', '', NULL, NULL, 13, 3, NULL, NULL, '401', '01', '1'),
(30, '401.01.03', 'Penjualan Kredit', NULL, 'Lainnya', '', NULL, NULL, 13, 3, NULL, NULL, '401', '01', '1'),
(31, '403.01.01', 'Sewa Kamar', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '403', '01', '5'),
(32, '403.01.02', 'Gedung Pertemuan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '403', '01', '5'),
(33, '403.01.03', 'Makanan dan Minuman', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '403', '01', '5'),
(34, '404.02.02', 'Sewa Pembiayaan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '404', '02', '5'),
(35, '501.02.01', 'Biaya Kamar', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '501', '02', '5'),
(36, '501.02.02', 'Biaya Gedung Pertemuan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '501', '02', '5'),
(37, '501.02.03', 'Biaya Makanan dan Minuman', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '501', '02', '5'),
(39, '100.01.01', 'KAS KANTOR PUSAT', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '100', '01', '17'),
(40, '100.01.02', 'KAS UNIT USAHA', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '100', '01', '17'),
(41, '100.02.01', 'Simpanan Kantor Pusat', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '100', '02', '17'),
(42, '100.02.02', 'Simpanan Unit Usaha', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '100', '02', '17'),
(43, '120.02.01', 'Persediaan bahan baku', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '120', '02', '17'),
(44, '120.02.02', 'Persediaan bahan pembantu', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '120', '02', '17'),
(45, '120.02.03', 'Persediaan dalam proses', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '120', '02', '17'),
(46, '120.02.04', 'Persediaan barang jadi', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '120', '02', '17'),
(47, '120.02.05', 'Persediaan dalam perjalanan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '120', '02', '17'),
(48, '170.01.01', 'Tanah', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '01', '17'),
(49, '170.01.02', 'Gedung dan Bangunan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '01', '17'),
(50, '170.01.03', 'Inventaris Kendaraan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '01', '17'),
(51, '170.01.04', 'Mesin dan Instalasi', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '01', '17'),
(52, '170.01.05', 'Inventaris Kantor', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '01', '17'),
(53, '170.01.06', 'Tanaman Produktif', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '01', '17'),
(54, '170.02.01', 'Aset dalam penyeleaian', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '02', '17'),
(55, '170.02.02', 'Tanaman belum menghasilkan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '170', '02', '17'),
(56, '190.02.01', 'Beban tangguhan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '190', '02', '17'),
(57, '190.02.02', 'Akumulasi amortisasi', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '190', '02', '17'),
(58, '150.02.01', 'Aset tetap tidak berfungsi', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '02', '17'),
(59, '150.02.02', 'Obat kadaluarsa', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '02', '17'),
(60, '150.02.03', 'Uang rusak', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '02', '17'),
(61, '150.03.01', 'Biaya Perintisan Usaha', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '03', '17'),
(62, '150.03.02', 'Biaya perijinan usaha', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '03', '17'),
(63, '150.03.03', 'Biaya dibayar dimuka jangka panjang', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '03', '17'),
(64, '150.03.04', 'Biaya yang ditangguhkan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '03', '17'),
(65, '150.04.01', 'Penyertaan Modal', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '17'),
(66, '150.04.02', 'Laba (rugi) usaha', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '17'),
(67, '150.04.03', 'Simpanan Dana', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '17'),
(68, '150.04.04', 'Perpajakan', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '17'),
(69, '150.04.05', 'Pinjaman sementara', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '17'),
(70, '150.04.06', 'Kontribusi', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '17'),
(71, '150.04.07', 'Hubungan R/K Lainnya', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '150', '04', '17'),
(72, '401.02.01', 'Premium', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '401', '02', '17'),
(73, '401.02.02', 'Solar', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '401', '02', '17'),
(74, '401.02.03', 'Pertamax', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '401', '02', '17'),
(75, '401.02.04', 'Pertalite', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '401', '02', '17'),
(76, '401.02.05', 'LPG', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '401', '02', '17'),
(77, '401.04.01', 'Pupuk', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '401', '04', '17'),
(78, '401.04.02', 'Beras', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '401', '04', '17'),
(79, '401.04.03', 'Palawija', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '401', '04', '17'),
(80, '402.03.01', 'Penjualan karet ', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '03', '17'),
(81, '402.03.02', 'Penjualan Kopi', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '03', '17'),
(82, '402.03.03', 'Penjualan Cengkeh', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '03', '17'),
(83, '402.03.04', 'Penjualan Kapok', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '03', '17'),
(84, '402.03.05', 'Penjualan Kopi Bubuk', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '03', '17'),
(85, '402.03.06', 'Penjualan Buah - buahan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '03', '17'),
(86, '402.03.07', 'Penjualan Kayu (Sengon, dll)', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '03', '17'),
(87, '402.03.09', 'Penjualan Komoditi Perkebunan Lainnya', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '03', '17'),
(88, '402.04.01', 'Kambing', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '04', '17'),
(89, '402.04.02', 'Sapi', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '04', '17'),
(90, '402.04.09', 'Penjualan Ternak Lainnya', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '402', '04', '17'),
(91, '403.01.01', 'Sewa Kamar', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '403', '01', '17'),
(92, '403.01.02', 'Gedung Pertemuan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '403', '01', '17'),
(93, '403.01.03', 'Makanan dan Minuman', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '403', '01', '17'),
(94, '403.01.04', 'Penggunaan Fasilitas Hotel dan Pariwisata', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '403', '01', '17'),
(95, '403.01.09', 'Jasa Hotel, Resto dan Pariwisata Lainnya', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '403', '01', '17'),
(96, '404.01.01', 'Sewa Mobil', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '404', '01', '17'),
(97, '404.01.02', 'Sewa Gedung', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '404', '01', '17'),
(98, '404.02.01', 'Kontribusi BOT / BGS', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '404', '02', '17'),
(99, '404.02.02', 'Sewa Pembiayaan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '404', '02', '17'),
(100, '502.01.01', 'Gaji dan Tunjangan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '01', '17'),
(101, '502.01.02', 'Honor / Upah', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '01', '17'),
(102, '502.01.03', 'Lembur / Uang Lelah', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '01', '17'),
(103, '502.01.04', 'Pakaian Dinas', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '01', '17'),
(104, '502.01.05', 'Biaya Pajak', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '01', '17'),
(105, '502.02.01', 'Bahan Bakar', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '02', '17'),
(106, '502.02.02', 'Parkir, Tol dan Kendaraan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '02', '17'),
(107, '502.02.03', 'Uang saku, Bonus, Insentif', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '02', '17'),
(108, '502.02.03', 'Uang saku, Bonus, Insentif', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '02', '17'),
(109, '502.02.04', 'Penyusutan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '02', '17'),
(110, '502.02.05', 'Pemeliharaan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '502', '02', '17'),
(111, '600.01.01', 'Gaji', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(112, '600.01.02', 'Tunjangan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(113, '600.01.02', 'Tunjangan Jabatan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(114, '600.01.02', 'Tunjangan Natura', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(115, '600.01.02', 'Tunjangan Insentif Perusahaan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(116, '600.01.02', 'Tunjangan UBJ', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(117, '600.01.03', 'Iuran Jaminan Hari Tua - BPJS Ketenagakerjaan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(118, '600.01.03', 'Iuran JKN - BPJS Kesehatan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(119, '600.01.04', 'Tunjangan HAri Raya', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(120, '600.01.05', 'Biaya Seminar, Penataran, dan Pendidikan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(121, '600.01.06', 'Biaya Penggantian Pengobatan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(122, '600.01.07', 'Honor / Upah', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(123, '600.01.08', 'Perjalanan dinas', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(124, '600.01.09', 'Insentif Pegawai', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(125, '600.01.10', 'Lembur / Uang Lelah', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(126, '600.01.11', 'Pakaian Kerja/ Dinas', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(127, '600.01.12', 'Minuman Karyawan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(128, '600.01.13', 'Pajak Penghasilan (PPh Final & PPh 21)', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(129, '600.01.14', 'PBB, Pajak Daerah, Retribusi, dan Pajak Reklame', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(130, '600.01.15', 'Biaya Pegawai Lainnya', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '600', '01', '17'),
(131, '610.01.01', 'Gaji', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(132, '610.01.02', 'Tunjangan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(133, '610.01.02', 'Tunjangan jabatan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(134, '610.01.02', 'Tunjangan Natura', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(135, '610.01.02', 'Tunjangan Insentif Perusahaan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(136, '610.01.02', 'Tunjangan UBJ', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(137, '610.01.03', 'Iuran Jaminan Hari Tua - BPJS Ketenagakerjaan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(138, '610.01.03', 'Iuran JKN - BPJS Kesehatan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(139, '610.01.04', 'Tunjangan Hari Raya', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(140, '610.01.05', 'Biaya Seminar, Penataran, dan Pendidikan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(141, '610.01.06', 'Biaya Penggantian Pengobatan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(142, '610.01.07', 'Honor / Upah', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(143, '610.01.08', 'Perjalanan dinas', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(144, '610.01.09', 'Insentif Pegawai', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(145, '610.01.10', 'Lembur / Uang Lelah', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(146, '610.01.11', 'Pakaian Kerja/ Dinas', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(147, '610.01.12', 'Minuman KAryawan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(148, '610.01.13', 'Pajak Penghasilan (PPh Final & PPh 21)', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(149, '610.01.14', 'PBB, Pajak Daerah, Retribusi, dan Pajak Reklame', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(150, '610.01.15', 'Biaya Pegawai Lainnya', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '01', '17'),
(151, '610.02.01', 'Sewa Listrik / PLN', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(152, '610.02.02', 'Pemakaian ATK, Cetakan, Fotocopy', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(153, '610.02.03', 'Biaya Telekomunikasi', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(154, '610.02.04', 'Air/ PAM', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(155, '610.02.05', 'Biaya Transport', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(156, '610.02.06', 'Benda Pos', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(157, '610.02.07', 'Majalah/ Surat Kabar', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(158, '610.02.08', 'Biaya Rumah Tangga', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(159, '610.02.09', 'Biaya Pemeriksaan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(160, '610.02.10', 'Biaya Rapat', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(161, '610.02.11', 'Biaya Sewa Gedung', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(162, '610.02.12', 'Pajak (PBB, PPh 21, PPh Final)', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(163, '610.02.13', 'Biaya Pajak Kendaraan, Asuransi, KIR', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(164, '610.02.14', 'Biaya Perjalanan Dinas', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(165, '610.02.15', 'Biaya Umum dan administrasi lainnya', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '02', '17'),
(166, '610.03.01', 'Pemeliharaan Gedung', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '03', '17'),
(167, '610.03.02', 'Pemeliharaan Rumah Dinas', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '03', '17'),
(168, '610.03.03', 'Pemeliharaan Inventaris Kantor', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '03', '17'),
(169, '610.03.04', 'Pemeliharaan Kendaraan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '03', '17'),
(170, '610.04.01', 'Gedung dan Bangunan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '04', '17'),
(171, '610.04.02', 'Inventaris Kendaraan', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '04', '17'),
(172, '610.04.03', 'Mesin dan Instalasi', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '04', '17'),
(173, '610.04.04', 'Inventaris Kantor', NULL, NULL, NULL, NULL, NULL, 13, 0, NULL, NULL, '610', '04', '17'),
(174, '401.01.97', 'Peminjaman Uang', NULL, 'Akun Hutang', '', NULL, NULL, 13, 3, NULL, NULL, '401', '01', '1'),
(175, '300.01.01', 'Modal Dasar', NULL, NULL, NULL, NULL, NULL, 13, 3, NULL, NULL, '300', '01', '1'),
(176, '200.03.01', 'Hutang Usaha Lainnya', NULL, 'Akun Hutang', NULL, NULL, NULL, 13, 3, NULL, NULL, '200', '03', '1'),
(177, '120.02.04', 'Persediaan Barang Jadi', NULL, 'Lainnya', NULL, NULL, NULL, 13, 3, NULL, NULL, '120', '02', '1'),
(178, '110.02.01', 'Piutang Usaha Dagang', NULL, 'Akun Piutang', NULL, NULL, NULL, 13, 3, NULL, NULL, '110', '02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `master_barang`
--

CREATE TABLE `master_barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(100) NOT NULL,
  `harga_jual` double NOT NULL,
  `harga_beli` double NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `kode_barang`, `nama_barang`, `id_satuan`, `nama_satuan`, `harga_jual`, `harga_beli`, `id_supplier`, `nama_supplier`, `id_kategori`, `nama_kategori`) VALUES
(1, 'KB0001', 'Barang A', 2, 'kilogram', 50000, 30000, 2, 'Wahana Mitra', 4, 'Minuman'),
(2, 'KB0002', 'Barang B', 3, 'gram', 55000, 45000, 5, 'Ultra Sinergi', 5, 'Makanan'),
(3, 'KB0003', 'Barang C', 4, 'liter', 15000, 10000, 5, 'Ultra Sinergi', 6, 'Solar'),
(4, 'KB0004', 'Barang D', 2, 'kilogram', 60000, 30000, 3, 'Akward', 3, 'Kecil'),
(5, 'KB0005', 'Barang E', 2, 'kilogram', 80000, 70000, 4, 'Teredhom', 5, 'Makanan');

-- --------------------------------------------------------

--
-- Table structure for table `master_departemen`
--

CREATE TABLE `master_departemen` (
  `id_depart` int(11) NOT NULL,
  `kode_depart` varchar(50) NOT NULL,
  `nama_depart` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_departemen`
--

INSERT INTO `master_departemen` (`id_depart`, `kode_depart`, `nama_depart`) VALUES
(5, 'A0001', 'Depart A'),
(6, 'A0002', 'Depart B'),
(7, 'A0003', 'Depart C'),
(8, 'A0004', 'Depart D'),
(9, 'A0005', 'Depart E');

-- --------------------------------------------------------

--
-- Table structure for table `master_divisi`
--

CREATE TABLE `master_divisi` (
  `id_divisi` int(11) NOT NULL,
  `id_depart` int(11) NOT NULL,
  `kode_divisi` varchar(50) NOT NULL,
  `nama_divisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_divisi`
--

INSERT INTO `master_divisi` (`id_divisi`, `id_depart`, `kode_divisi`, `nama_divisi`) VALUES
(3, 5, 'DIV0001', 'Divisi A'),
(4, 6, 'DIV0002', 'Divisi B'),
(5, 7, 'DIV0003', 'Divisi C'),
(6, 8, 'DIV0004', 'Divisi D'),
(7, 9, 'DIV0005', 'Divisi E');

-- --------------------------------------------------------

--
-- Table structure for table `master_jabatan`
--

CREATE TABLE `master_jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_jabatan`
--

INSERT INTO `master_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'direktur'),
(3, 'hrd'),
(5, 'kepala gudang'),
(6, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `master_kategori_barang`
--

CREATE TABLE `master_kategori_barang` (
  `id_kategori` int(11) NOT NULL,
  `kode_kategori` varchar(100) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_kategori_barang`
--

INSERT INTO `master_kategori_barang` (`id_kategori`, `kode_kategori`, `nama_kategori`) VALUES
(2, 'KT00001', 'Besar'),
(3, 'KT00002', 'Kecil'),
(4, 'KT00003', 'Minuman'),
(5, 'KT00004', 'Makanan'),
(6, 'KT00005', 'Solar');

-- --------------------------------------------------------

--
-- Table structure for table `master_keluarga`
--

CREATE TABLE `master_keluarga` (
  `id_keluarga` int(11) NOT NULL,
  `status_keluarga` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_keluarga`
--

INSERT INTO `master_keluarga` (`id_keluarga`, `status_keluarga`) VALUES
(3, 'belum menikah'),
(4, 'menikah');

-- --------------------------------------------------------

--
-- Table structure for table `master_konversi`
--

CREATE TABLE `master_konversi` (
  `id_konversi` int(11) NOT NULL,
  `kode_satuan_1` varchar(50) NOT NULL,
  `kode_satuan_2` varchar(50) NOT NULL,
  `nilai_1` varchar(50) NOT NULL,
  `nilai_2` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_konversi`
--

INSERT INTO `master_konversi` (`id_konversi`, `kode_satuan_1`, `kode_satuan_2`, `nilai_1`, `nilai_2`) VALUES
(1, '1 Kg', '1 liter', '1000 G', '1000 Ml');

-- --------------------------------------------------------

--
-- Table structure for table `master_pegawai`
--

CREATE TABLE `master_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `id_status` int(11) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` varchar(100) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `pendidikan` varchar(100) NOT NULL,
  `id_keluarga` int(11) NOT NULL,
  `id_depart` int(11) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `kode_gaji` varchar(100) NOT NULL,
  `tgl_masuk` varchar(100) NOT NULL,
  `tgl_keluar` varchar(100) NOT NULL,
  `jamsostek` varchar(100) NOT NULL,
  `mutasi` varchar(100) NOT NULL,
  `pengalaman_kerja` text NOT NULL,
  `kursus` varchar(100) NOT NULL,
  `foto` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `tipe_jadwal` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `ket_depart` varchar(100) NOT NULL,
  `digaji` varchar(100) NOT NULL,
  `no_rekening` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pegawai`
--

INSERT INTO `master_pegawai` (`id_pegawai`, `id_status`, `nik`, `nama`, `alamat`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `kota`, `agama`, `pendidikan`, `id_keluarga`, `id_depart`, `id_jabatan`, `kode_gaji`, `tgl_masuk`, `tgl_keluar`, `jamsostek`, `mutasi`, `pengalaman_kerja`, `kursus`, `foto`, `id_user`, `tipe_jadwal`, `nama_bank`, `ket_depart`, `digaji`, `no_rekening`) VALUES
(9, 0, 'NIK0001', 'tyas', 'jl. jojoran III no.16', 'perempuan', 'surabaya', '23-10-1994', 'Surabaya', 'Islam', 'Strata 1', 3, 5, 6, 'KG0001', '10-02-2010', '', 'aktiv', 'tidak', 'admin di pt. mkp', 'mengemudi', 'tyas.jpg', 0, 'full time', 'mandiri', 'depart A', 'bulan', '510590876430');

-- --------------------------------------------------------

--
-- Table structure for table `master_pelanggan`
--

CREATE TABLE `master_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `kode_pelanggan` varchar(50) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat_pelanggan` text NOT NULL,
  `telp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `npwp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_pelanggan`
--

INSERT INTO `master_pelanggan` (`id_pelanggan`, `kode_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `telp`, `email`, `npwp`) VALUES
(1, 'A0001', 'jhoe ramadhan', 'jl. ketintang ', '085706002655', 'jhoeramadhan@gmail.com', '908090000000'),
(2, 'A0002', 'Gita Suara', 'jl. Raden Saleh', '031-925648', 'gita_suara@gmail.com', '6464666'),
(3, 'A0003', 'Juned Geo', 'Jl. Soemolo waru ', '031-888777', 'junedgeo@gmail.com', '00005546'),
(4, 'A0004', 'Helena', 'jl. Bratang Binangun', '031-446653', 'helena@gmail.com', '4446555'),
(5, 'A0005', 'Reynald', 'jl. Ahmad Yani', '013-544455', 'reynald@gmail.com', '47903878');

-- --------------------------------------------------------

--
-- Table structure for table `master_satuan`
--

CREATE TABLE `master_satuan` (
  `id_satuan` int(11) NOT NULL,
  `kode_satuan` varchar(50) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_satuan`
--

INSERT INTO `master_satuan` (`id_satuan`, `kode_satuan`, `nama_satuan`) VALUES
(2, 'kg', 'kilogram'),
(3, 'gr', 'gram'),
(4, 'L', 'liter');

-- --------------------------------------------------------

--
-- Table structure for table `master_status`
--

CREATE TABLE `master_status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_status`
--

INSERT INTO `master_status` (`id_status`, `status`) VALUES
(2, 'aktiv'),
(3, 'non aktiv');

-- --------------------------------------------------------

--
-- Table structure for table `master_supplier`
--

CREATE TABLE `master_supplier` (
  `id_supplier` int(11) NOT NULL,
  `kode_supplier` varchar(50) NOT NULL,
  `nama_supplier` varchar(100) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `telp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `npwp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_supplier`
--

INSERT INTO `master_supplier` (`id_supplier`, `kode_supplier`, `nama_supplier`, `alamat_supplier`, `telp`, `email`, `npwp`) VALUES
(2, 'KS0001', 'Wahana Mitra', 'jl. Hr. Muhammad', '031-746987', 'wahanamitra@gmail.com', '908990876'),
(3, 'KS0002', 'Akward', 'jl. Dr. Soetomo', '031-8745621', 'akward@gmail.com', '05469879'),
(4, 'KS0003', 'Teredhom', 'Jl. Darmo Satelit', '031-796532', 'teredhom@gmail.com', '01356897'),
(5, 'KS0004', 'Ultra Sinergi', 'jl. Raya Darmo', '031-222333', 'ultra.sinergi@gmail.com', '79654312'),
(6, 'KS0005', 'Lolipop', 'jl. Kalibokor', '031-987655', 'Lolipop@gmail.com', '77766651');

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id_invoice` int(11) NOT NULL,
  `no_invoice` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `sales_order` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_invoice_detail`
--

CREATE TABLE `tb_invoice_detail` (
  `id` int(11) NOT NULL,
  `id_induk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kuantitas` varchar(100) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan_penerimaan`
--

CREATE TABLE `tb_laporan_penerimaan` (
  `id_laporan` int(11) NOT NULL,
  `no_lpb` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `diterima` varchar(100) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL,
  `no_opb` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_laporan_penerimaan_detail`
--

CREATE TABLE `tb_laporan_penerimaan_detail` (
  `id` int(11) NOT NULL,
  `id_induk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL,
  `id_opb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_pembelian`
--

CREATE TABLE `tb_order_pembelian` (
  `id_order` int(11) NOT NULL,
  `no_opb` varchar(100) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `uraian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order_pembelian`
--

INSERT INTO `tb_order_pembelian` (`id_order`, `no_opb`, `tanggal`, `uraian`) VALUES
(1, 'OPB0001', '12-03-2018', 'uraian'),
(2, 'OPB0002', '12-03-2018', 'uraian'),
(3, 'OPB0003', '12-03-2018', 'uraian'),
(4, 'OPB0004', '12-03-2018', 'uraian'),
(5, 'OPB0005', '12-03-2018', 'uraian'),
(6, 'OPB99999', '12-03-2018', 'uraian'),
(7, 'OPB1000', '12-03-2018', 'uraian');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_pembelian_detail`
--

CREATE TABLE `tb_order_pembelian_detail` (
  `id` int(11) NOT NULL,
  `id_induk` int(11) DEFAULT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `no_spb` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order_pembelian_detail`
--

INSERT INTO `tb_order_pembelian_detail` (`id`, `id_induk`, `id_produk`, `nama_produk`, `keterangan`, `kuantitas`, `harga`, `total`, `satuan`, `no_spb`) VALUES
(1, 1, 0, 'Barang A', 'keterangan', '7', 0, 0, 'kilogram', '0'),
(2, 1, 0, 'Barang C', 'keterangan', '6', 0, 0, 'liter', '0'),
(3, 2, 0, 'Barang E', 'keterangan', '5', 0, 0, 'kilogram', '0'),
(4, 2, 0, 'Barang E', 'keterangan', '5', 0, 0, 'kilogram', '0'),
(5, 3, 0, 'Barang D', 'keterangan', '3', 0, 0, 'kilogram', '0'),
(6, 4, 0, 'Barang B', 'keterangan', '3', 0, 0, 'gram', '0'),
(7, 5, 0, 'Barang C', 'keterangan', '6', 0, 0, 'liter', '0'),
(8, 5, 0, 'Barang B', 'keterangan', '3', 0, 0, 'gram', '0'),
(9, 5, 0, 'Barang A', 'keterangan', '7', 0, 0, 'kilogram', '0'),
(10, 6, 0, 'Barang C', 'keterangan', '6', 0, 0, 'liter', '0'),
(11, 6, 0, 'Barang E', 'keterangan', '5', 0, 0, 'kilogram', '0'),
(12, 6, 0, 'Barang A', 'keterangan', '7', 0, 0, 'kilogram', '0'),
(13, 7, 0, 'Barang C', 'keterangan', '6', 0, 0, 'liter', 'SPB0005'),
(14, 7, 0, 'Barang E', 'keterangan', '5', 0, 0, 'kilogram', 'SPB0005'),
(15, 7, 0, 'Barang A', 'keterangan', '7', 0, 0, 'kilogram', 'SPB0005');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan_barang`
--

CREATE TABLE `tb_permintaan_barang` (
  `id_permintaan` int(11) NOT NULL,
  `no_spb` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `uraian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_permintaan_barang`
--

INSERT INTO `tb_permintaan_barang` (`id_permintaan`, `no_spb`, `tanggal`, `uraian`) VALUES
(1, 'SPB0001', '12-03-2018', 'uraian'),
(2, 'SPB0002', '12-03-2018', 'uraian'),
(3, 'SPB0003', '12-03-2018', 'uraian'),
(4, 'SPB0004', '12-03-2018', 'uraian'),
(5, 'SPB0005', '12-03-2018', 'uraian');

-- --------------------------------------------------------

--
-- Table structure for table `tb_permintaan_barang_detail`
--

CREATE TABLE `tb_permintaan_barang_detail` (
  `id` int(11) NOT NULL,
  `id_induk` int(11) NOT NULL,
  `id_spb` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `jumlah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_permintaan_barang_detail`
--

INSERT INTO `tb_permintaan_barang_detail` (`id`, `id_induk`, `id_spb`, `id_produk`, `nama_produk`, `keterangan`, `kuantitas`, `satuan`, `harga`, `jumlah`) VALUES
(1, 1, 0, 0, 'Barang E', 'keterangan', '3', 'kilogram', 70000, 210000),
(2, 2, 0, 0, 'Barang B', 'keterangan', '3', 'gram', 45000, 135000),
(3, 3, 0, 0, 'Barang D', 'keterangan', '3', 'kilogram', 30000, 90000),
(4, 3, 0, 0, 'Barang D', 'keterangan', '3', 'kilogram', 30000, 90000),
(5, 4, 0, 0, 'Barang E', 'keterangan', '5', 'kilogram', 70000, 350000),
(6, 5, 0, 0, 'Barang C', 'keterangan', '6', 'liter', 10000, 60000),
(7, 5, 0, 0, 'Barang E', 'keterangan', '5', 'kilogram', 70000, 350000),
(8, 5, 0, 0, 'Barang A', 'keterangan', '7', 'kilogram', 30000, 210000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_order`
--

CREATE TABLE `tb_purchase_order` (
  `id_purchase` int(11) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `supplier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_purchase_order`
--

INSERT INTO `tb_purchase_order` (`id_purchase`, `no_po`, `tanggal`, `supplier`) VALUES
(1, 'PO0001', '12-03-2018', 'Wahana Mitra'),
(2, 'PO0002', '12-03-2018', 'Teredhom'),
(3, 'PO0003', '12-03-2018', 'Lolipop'),
(4, 'PO0004', '12-03-2018', 'Lolipop'),
(6, 'PO9999', '12-03-2018', 'Teredhom');

-- --------------------------------------------------------

--
-- Table structure for table `tb_purchase_order_detail`
--

CREATE TABLE `tb_purchase_order_detail` (
  `id` int(11) NOT NULL,
  `id_induk` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL,
  `no_opb` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_purchase_order_detail`
--

INSERT INTO `tb_purchase_order_detail` (`id`, `id_induk`, `id_produk`, `nama_produk`, `keterangan`, `kuantitas`, `harga`, `total`, `no_opb`) VALUES
(1, 1, 0, 'Barang E', 'keterangan', '3', 70000, 210000, ''),
(2, 1, 0, 'Barang D', 'keterangan', '2', 30000, 60000, ''),
(3, 2, 0, 'Barang E', 'keterangan', '4', 70000, 280000, ''),
(4, 3, 0, 'Barang E', 'keterangan', '8', 70000, 560000, ''),
(5, 4, 0, 'Barang A', 'keterangan', '5', 30000, 150000, ''),
(7, 6, 0, 'Barang D', 'keterangan', '3', 15000, 15000, 'OPB0003');

-- --------------------------------------------------------

--
-- Table structure for table `tb_retur_pembelian`
--

CREATE TABLE `tb_retur_pembelian` (
  `id_retur` int(11) NOT NULL,
  `no_retur` varchar(50) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `no_po` varchar(50) NOT NULL,
  `diterima` varchar(100) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL,
  `no_opb` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_retur_pembelian_detail`
--

CREATE TABLE `tb_retur_pembelian_detail` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `harga` double NOT NULL,
  `total` double NOT NULL,
  `id_opb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sales_order`
--

CREATE TABLE `tb_sales_order` (
  `id_sales` int(11) NOT NULL,
  `pelanggan` varchar(100) NOT NULL,
  `divisi` varchar(100) NOT NULL,
  `alamat_penagihan` text NOT NULL,
  `tanggal_transaksi` varchar(50) NOT NULL,
  `no_transaksi` varchar(50) NOT NULL,
  `uraian` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_sales_order_detail`
--

CREATE TABLE `tb_sales_order_detail` (
  `id` int(11) NOT NULL,
  `id_induk` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `kode_akun` varchar(100) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `kuantitas` varchar(50) NOT NULL,
  `satuan` varchar(100) NOT NULL,
  `harga` double NOT NULL,
  `tax` varchar(50) NOT NULL,
  `jumlah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `nama_user`, `foto`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ak_grup_kode_akun`
--
ALTER TABLE `ak_grup_kode_akun`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `ak_kategori_akun`
--
ALTER TABLE `ak_kategori_akun`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `ak_kode_akuntansi`
--
ALTER TABLE `ak_kode_akuntansi`
  ADD PRIMARY KEY (`ID`) USING BTREE;

--
-- Indexes for table `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `master_departemen`
--
ALTER TABLE `master_departemen`
  ADD PRIMARY KEY (`id_depart`);

--
-- Indexes for table `master_divisi`
--
ALTER TABLE `master_divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `master_kategori_barang`
--
ALTER TABLE `master_kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `master_keluarga`
--
ALTER TABLE `master_keluarga`
  ADD PRIMARY KEY (`id_keluarga`);

--
-- Indexes for table `master_konversi`
--
ALTER TABLE `master_konversi`
  ADD PRIMARY KEY (`id_konversi`);

--
-- Indexes for table `master_pegawai`
--
ALTER TABLE `master_pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `master_satuan`
--
ALTER TABLE `master_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `master_status`
--
ALTER TABLE `master_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `master_supplier`
--
ALTER TABLE `master_supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `tb_invoice_detail`
--
ALTER TABLE `tb_invoice_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_laporan_penerimaan`
--
ALTER TABLE `tb_laporan_penerimaan`
  ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `tb_laporan_penerimaan_detail`
--
ALTER TABLE `tb_laporan_penerimaan_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_order_pembelian`
--
ALTER TABLE `tb_order_pembelian`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tb_order_pembelian_detail`
--
ALTER TABLE `tb_order_pembelian_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_permintaan_barang`
--
ALTER TABLE `tb_permintaan_barang`
  ADD PRIMARY KEY (`id_permintaan`);

--
-- Indexes for table `tb_permintaan_barang_detail`
--
ALTER TABLE `tb_permintaan_barang_detail`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tb_purchase_order`
--
ALTER TABLE `tb_purchase_order`
  ADD PRIMARY KEY (`id_purchase`);

--
-- Indexes for table `tb_purchase_order_detail`
--
ALTER TABLE `tb_purchase_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_retur_pembelian`
--
ALTER TABLE `tb_retur_pembelian`
  ADD PRIMARY KEY (`id_retur`);

--
-- Indexes for table `tb_retur_pembelian_detail`
--
ALTER TABLE `tb_retur_pembelian_detail`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `tb_sales_order`
--
ALTER TABLE `tb_sales_order`
  ADD PRIMARY KEY (`id_sales`);

--
-- Indexes for table `tb_sales_order_detail`
--
ALTER TABLE `tb_sales_order_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ak_grup_kode_akun`
--
ALTER TABLE `ak_grup_kode_akun`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `ak_kategori_akun`
--
ALTER TABLE `ak_kategori_akun`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `ak_kode_akuntansi`
--
ALTER TABLE `ak_kode_akuntansi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;
--
-- AUTO_INCREMENT for table `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_departemen`
--
ALTER TABLE `master_departemen`
  MODIFY `id_depart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `master_divisi`
--
ALTER TABLE `master_divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `master_jabatan`
--
ALTER TABLE `master_jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `master_kategori_barang`
--
ALTER TABLE `master_kategori_barang`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `master_keluarga`
--
ALTER TABLE `master_keluarga`
  MODIFY `id_keluarga` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_konversi`
--
ALTER TABLE `master_konversi`
  MODIFY `id_konversi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_pegawai`
--
ALTER TABLE `master_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `master_pelanggan`
--
ALTER TABLE `master_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `master_satuan`
--
ALTER TABLE `master_satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_status`
--
ALTER TABLE `master_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `master_supplier`
--
ALTER TABLE `master_supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `id_invoice` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_invoice_detail`
--
ALTER TABLE `tb_invoice_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_laporan_penerimaan`
--
ALTER TABLE `tb_laporan_penerimaan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_laporan_penerimaan_detail`
--
ALTER TABLE `tb_laporan_penerimaan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_order_pembelian`
--
ALTER TABLE `tb_order_pembelian`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_order_pembelian_detail`
--
ALTER TABLE `tb_order_pembelian_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tb_permintaan_barang`
--
ALTER TABLE `tb_permintaan_barang`
  MODIFY `id_permintaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_permintaan_barang_detail`
--
ALTER TABLE `tb_permintaan_barang_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tb_purchase_order`
--
ALTER TABLE `tb_purchase_order`
  MODIFY `id_purchase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_purchase_order_detail`
--
ALTER TABLE `tb_purchase_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_retur_pembelian`
--
ALTER TABLE `tb_retur_pembelian`
  MODIFY `id_retur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_retur_pembelian_detail`
--
ALTER TABLE `tb_retur_pembelian_detail`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_sales_order`
--
ALTER TABLE `tb_sales_order`
  MODIFY `id_sales` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_sales_order_detail`
--
ALTER TABLE `tb_sales_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
