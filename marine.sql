-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Feb 2016 pada 11.09
-- Versi Server: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marine`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `certificate_task_shipping`
--

CREATE TABLE `certificate_task_shipping` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `status` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `certificate_task_shipping`
--

INSERT INTO `certificate_task_shipping` (`id`, `name`, `status`, `description`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'KOMPAS', 'Active', 'DETIK', '2016-01-31 05:30:29', 'System', '2016-01-31 05:33:17', 'System'),
(2, 'DDDDD', 'Active', 'KASKUS', '2016-01-31 05:30:46', 'System', '2016-01-31 05:31:19', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `code_notification`
--

CREATE TABLE `code_notification` (
  `id` bigint(20) NOT NULL,
  `code` varchar(100) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `directory_document`
--

CREATE TABLE `directory_document` (
  `id` bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `is_public_folder` tinyint(4) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `directory_document`
--

INSERT INTO `directory_document` (`id`, `name`, `parent_id`, `is_public_folder`, `description`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(3, 'Direktori Regulasi', NULL, 0, '', '2015-12-06 14:08:38', 'System', '2015-12-19 15:19:45', 'System'),
(16, 'SK Dirjen Hubla', 3, 1, '-', '2015-12-07 07:59:24', 'System', '2015-12-26 17:54:18', 'System'),
(34, 'Instruksi Menteri', 3, 1, '-', '2015-12-26 17:56:37', 'System', NULL, NULL),
(36, 'Instruksi Presiden', 3, 1, '-', '2015-12-26 17:57:09', 'System', NULL, NULL),
(39, 'Keputusan Menteri', 3, 1, 'Keputusan Menteri Perhubungan', '2016-02-08 19:06:30', 'System', NULL, NULL),
(40, 'Keputusan Presiden', 3, 1, 'Keputusan Presiden RI', '2016-02-08 19:23:24', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `directory_repo_document`
--

CREATE TABLE `directory_repo_document` (
  `id` bigint(20) NOT NULL,
  `name` varchar(500) NOT NULL,
  `parent_id` bigint(20) DEFAULT NULL,
  `is_public_folder` tinyint(4) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `document`
--

CREATE TABLE `document` (
  `id` bigint(20) NOT NULL,
  `id_emp` bigint(20) DEFAULT NULL,
  `id_dir` bigint(20) NOT NULL,
  `id_file` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `date_upload` datetime NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `document`
--

INSERT INTO `document` (`id`, `id_emp`, `id_dir`, `id_file`, `title`, `date_upload`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(5, NULL, 34, 35, '1 Tahun 2013.pdf', '2016-02-08 18:40:25', 'IM. No 1 Tahun 2013 Tentang Rencana Aksi Peningkatan Keselamatan Transportasi Tanggal 11 Januari 2013', 'Active', '2016-02-08 18:40:25', 'System', NULL, NULL),
(6, NULL, 36, 36, '5 Tahun 2005.pdf', '2016-02-08 18:41:32', 'INPRES No. 5 Tahun 2005 Tentang Pemberdayaan Industri Pelayaran Nasional Tanggal 28 Maret 2005', 'Active', '2016-02-08 18:41:32', 'System', NULL, NULL),
(7, NULL, 16, 37, 'PY.65.1.3-86.pdf', '2016-02-08 18:42:56', 'SK DIRJEN No. PY.65.1.3-86 Tentang Wewenang Pemeriksaan, Pemasangan Marka dan Penerbitan Sertifikat Garis Muat Kapal Indonesia Untuk Pelayaran Dalam Negeri Tanggal 07 Juli 1986', 'Active', '2016-02-08 18:42:56', 'System', NULL, NULL),
(8, NULL, 16, 38, 'PY.67.1.3-93.pdf', '2016-02-08 18:43:31', 'SK DIRJEN No. PY.67.1.3-93 Tahun 1993 tentang Jadual Pelimbungan  Pengedokan Kapal Indonesia Tanggal 07 Mei 1993', 'Active', '2016-02-08 18:43:31', 'System', NULL, NULL),
(9, NULL, 16, 39, 'PY.68.1.3-95.pdf', '2016-02-08 18:44:06', 'SK DIRJEN No. PY.68.1.3-95 tentang Pemberian Wewenang Kepada BKI Untuk Melaksanakan Pemeriksaan Keselamatan Kapal dan Pencegahan Pencemaran tanggal 06 April 1995', 'Active', '2016-02-08 18:44:06', 'System', NULL, NULL),
(10, NULL, 16, 40, 'PY.67.1.7-96.pdf', '2016-02-08 18:44:41', 'SK DIRJEN No. PY.67.1.7-96 tentang Pemberian Wewenang Kepada BKI Untuk Melaksanakan Verifikasi Manajemen Keselamatan Kapal Pada Kapal-Kapal Berbendera Indonesia 12 Juli 1996', 'Active', '2016-02-08 18:44:41', 'System', NULL, NULL),
(11, NULL, 16, 41, 'PY.66.1.4-03.pdf', '2016-02-08 18:45:12', 'SK DIRJEN No. PY.66.1.4-03 tentang Tata Cara Tetap Pelaksanaan Penyelenggaraan Kelaiklautan Kapal tanggal 18 Desember 2003', 'Active', '2016-02-08 18:45:12', 'System', NULL, NULL),
(12, NULL, 16, 42, 'HK.103.1.15-12.pdf', '2016-02-08 18:47:49', 'SK DIRJEN No. HK.103/1/15-12 tentang Pemberlakuan Kode International Maritim Muatan Padat Secara Curah (International Maritime Solid Bulk Cargoes Code) tanggal 12 Juli 2012', 'Active', '2016-02-08 18:47:49', 'System', NULL, NULL),
(13, NULL, 16, 43, 'HK.103.1.16-12.pdf', '2016-02-08 18:48:51', 'SK DIRJEN No. HK.103/1/16-12 tentang Pemberlakuan Kode International Mengenai Penerapan Tata Cara Pengujian Kebakaran, 2010 (FTP, 2010) tanggal 12 Juli 2012', 'Active', '2016-02-08 18:48:51', 'System', NULL, NULL),
(14, NULL, 16, 44, 'HK.103.1.17-12.pdf', '2016-02-08 18:49:52', 'SK DIRJEN No. HK.103/1/17-12 tentang Pemberlakuan Kode Keselamatan Dalam Penanganan Dan Pengamanan Muatan (Safe Practice For Cargo Stowage and Securing) 12 Juli 2012', 'Active', '2016-02-08 18:49:52', 'System', NULL, NULL),
(15, NULL, 16, 45, 'HK.103.1.18-12.pdf', '2016-02-08 18:51:41', 'SK DIRJEN No. HK.103/1/18-12 tentang Pemberlakuan Kode Konstruksi dan Perlengkapan dari Unit-Unit Pemboran Lepas-Pantai Berpindah (Offshore Driling Units, 1989) 12 Juli 2012', 'Active', '2016-02-08 18:51:41', 'System', NULL, NULL),
(16, NULL, 16, 46, 'HK.103.1.19-12.pdf', '2016-02-08 18:52:29', 'SK DIRJEN No. HK.103/1/19-12 tentang Pemberlakuan Kode Perlengkapan Keselamatan Jiwa (Life-Saving Appliance Code) tanggal 12 Juli 2012', 'Active', '2016-02-08 18:52:29', 'System', NULL, NULL),
(17, NULL, 16, 47, 'HK.103.1.20-12.pdf', '2016-02-08 18:54:41', 'SK DIRJEN No. HK.103/1/20-12 tentang Pemberlakuan Kode Internasional Untuk Sistem Keselamatan Kebakaran (International Code For Fire Safety System) tanggal 12 Juli 2012', 'Active', '2016-02-08 18:54:41', 'System', NULL, NULL),
(18, NULL, 16, 48, 'HK.103.2.2-12.pdf', '2016-02-08 18:55:38', 'SK DIRJEN No. HK.103/2/2-12 tentang Pemberlakuan Kode Konstruksi Dan Kapal-Kapal Yang Mengangkut Muatan Kimia Berbahaya Curah tanggal 12 Juli 2012', 'Active', '2016-02-08 18:55:38', 'System', NULL, NULL),
(19, NULL, 16, 49, 'HK.103.2.3-12.pdf', '2016-02-08 18:56:34', 'SK DIRJEN No. HK.103/2/3-12 tentang Pemberlakuan Kode International Kontruksi dan Peralatan Kapal-Kapal Yang Mengangkut Muatan Gas Cair (IGC Code) tanggal 12 Juli 2012', 'Active', '2016-02-08 18:56:34', 'System', NULL, NULL),
(20, NULL, 16, 50, 'HK.103.2.4-12.pdf', '2016-02-08 18:57:11', 'SK DIRJEN No. HK.103/2/4-12 tentang Pemberlakuan Kode Internasional Untuk Keselamatan Kapal Berkecepatan Tinggi Tahun 2000 (HSC Code) tanggal 12 Juli 2012', 'Active', '2016-02-08 18:57:11', 'System', NULL, NULL),
(21, NULL, 16, 51, 'HK.103.2.5-12.pdf', '2016-02-08 18:58:03', 'SK DIRJEN No. HK.103/2/5-12 tentang Pemberlakuan Pedoman Teknis Akses Masuk Dalam Rangka Pemeriksaan Kapal (Access For Inspection) tanggal 12 Juli 2012', 'Active', '2016-02-08 18:58:03', 'System', NULL, NULL),
(22, NULL, 16, 52, 'UM.008.9.20-12.pdf', '2016-02-08 18:59:30', 'SK DIRJEN No. UM.008/9/20-12 tentang Pemberlakuan Standar dan Petunjuk Teknis Pelaksanaan Kapal Non Konvensi Berbendera Indonesia tanggal 16 Februari 2012', 'Active', '2016-02-08 18:59:30', 'System', NULL, NULL),
(23, NULL, 16, 53, 'UM.008.23.20-14.pdf', '2016-02-08 19:00:31', 'SK DIRJEN No. UM.008/23/20-14 tentang Pembentukan Panitia Penyelenggaraan Kegiatan Sosialisasi SK. Dirjen HK.103-1-4-DJPL-14 tentang Pengedokan (Pelimbungan) 2 April 2014', 'Active', '2016-02-08 19:00:31', 'System', NULL, NULL),
(24, NULL, 16, 54, 'UM.008.34.10-14.pdf', '2016-02-08 19:01:10', 'SK DIRJEN No. UM.008/34/10-14 tentang Pemberlakuan Petunjuk Teknis Evaluasi Dan Penggantian Sistem Pelepasan Dan Pengembalian Sekoci tanggal 6 Mei 2014', 'Active', '2016-02-08 19:01:10', 'System', NULL, NULL),
(25, NULL, 16, 55, 'UM.008.43.4-14.pdf', '2016-02-08 19:02:04', 'SK DIRJEN No. UM.008/43/4-14 tentang Pemberlakuan Kode Maritime Barang Berbahaya tanggal 06 Juni 2014', 'Active', '2016-02-08 19:02:04', 'System', NULL, NULL),
(26, NULL, 39, 56, '46 Tahun 1996.pdf', '2016-02-08 19:07:48', 'KM. No 46 Tahun 1996 tentang Sertifikasi Kelaiklautan Kapal Penangkap Ikan Tgl. 25 Juni 1996', 'Active', '2016-02-08 19:07:48', 'System', NULL, NULL),
(27, NULL, 39, 57, '29 Tahun 1999.pdf', '2016-02-08 19:08:30', 'KM. No 29 Tahun 1999 tentang Keselamatan Kapal Kecepatan Tinggi tanggal 14 Mei 1999', 'Active', '2016-02-08 19:08:30', 'System', NULL, NULL),
(28, NULL, 39, 58, '17 Tahun 2000.pdf', '2016-02-08 19:09:26', 'KM. No 17 Tahun 2000 tentang Pedoman Penanganan Bahan Barang Berbahaya Dalam Kegiatan Pelayaran di Indonesia', 'Active', '2016-02-08 19:09:26', 'System', NULL, NULL),
(29, NULL, 39, 59, '33 Tahun 2003.pdf', '2016-02-08 19:10:23', 'KM. No 33 Tahun 2003 tentang Pemberlakuan Amandemen SOLAS 1974 tentang Pengamanan Kapal dan Fasilitas Pelabuhan (ISPS Code) Di Wilayah Indonesia tanggal 14 Agustus 2003', 'Active', '2016-02-08 19:10:23', 'System', NULL, NULL),
(30, NULL, 39, 60, '3 Tahun 2004.pdf', '2016-02-08 19:11:20', 'KM. No 3 Tahun 2004 tentang Penunjukan Direktur  Jenderal Perhubungan Laut Sebagai Desgnated Authority Pelaksanaan Pengamanan Kapal dan Fasilitas Pelabuhan tanggal 23 Januari 2004', 'Active', '2016-02-08 19:11:20', 'System', NULL, NULL),
(31, NULL, 39, 61, '70 Tahun 2004.pdf', '2016-02-08 19:11:53', 'KM. No 70 Tahun 2004 tentang Pedoman Pakaian Dinas Operasional Pegawai Negeri Sipil Pada Unit Pelaksana Teknis Direktorat Jenderal Perhubungan Laut tanggal 15 September 2004', 'Active', '2016-02-08 19:11:53', 'System', NULL, NULL),
(32, NULL, 39, 62, '4 Tahun 2005.pdf', '2016-02-08 19:12:41', 'KM. No 4 Tahun 2005 tentang Pencegahan Pencemaran Dari Kapal tanggal 20 Januari 2005', 'Active', '2016-02-08 19:12:41', 'System', NULL, NULL),
(33, NULL, 39, 63, '6 Tahun 2005.pdf', '2016-02-08 19:13:16', 'KM. No 6 Tahun 2005 tentang Pengukuran Kapal tanggal 20 Januari 2005', 'Active', '2016-02-08 19:13:16', 'System', NULL, NULL),
(34, NULL, 39, 64, '66 Tahun 2005.pdf', '2016-02-08 19:13:56', 'KM. No 66 Tahun 2005 tentang Ketentuan Pengoperasian Kapal Tangki Minyak Lambung Tunggan (Single Hull) tanggal 28 Oktober 2005', 'Active', '2016-02-08 19:13:56', 'System', NULL, NULL),
(36, NULL, 39, 66, '20 Tahun 2006.pdf', '2016-02-08 19:17:26', 'KM. No 20 Tahun 2006 tentang Kewajiban Bagi Kapal Berbendera Indonesia Untuk Masuk Klas Pada Biro Klasifikasi Indonesia tanggal 2 Mei 2006', 'Active', '2016-02-08 19:17:26', 'System', NULL, NULL),
(37, NULL, 39, 67, '9 Tahun 2008.pdf', '2016-02-08 19:18:13', 'KM. No 9 Tahun 2008 tentang Perubahan Kedua Atas Keputusan Menteri Perhubungan Nomor KM. 62 Tahun 2002 tentang Organisasi dan Tata Kerja Kantor Administrasi Pelabuhan', 'Active', '2016-02-08 19:18:13', 'System', NULL, NULL),
(38, NULL, 39, 68, '20 Tahun 2008.pdf', '2016-02-08 19:18:45', 'KM. No 20 Tahun 2008 tentang Perubahan Kelima Atas Peraturan Menteri Perhubungan Nomor KM. 43 Tahun 2005 tentang Organisasi dan Tata Kerja Departemen Perhubungan 30 Mei 2008', 'Active', '2016-02-08 19:18:45', 'System', NULL, NULL),
(39, NULL, 39, 69, '65 Tahun 2009.pdf', '2016-02-08 19:19:24', 'KM. No 65 Tahun 2009 tentang Standar Kapal Non Konvensi (Non Convention Vessel Standard) Berbendera Indonesia tanggal 17 September 2009', 'Active', '2016-02-08 19:19:24', 'System', NULL, NULL),
(40, NULL, 39, 70, '1 Tahun 2010.pdf', '2016-02-08 19:19:59', 'KM. No 1 Tahun 2010 tentang Tata Cara Penerbitan Surat Persetujuan Berlayar (Port Clearance) tanggal 08 Januari 2010', 'Active', '2016-02-08 19:19:59', 'System', NULL, NULL),
(41, NULL, 39, 71, '2 Tahun 2010.pdf', '2016-02-08 19:20:32', 'KM. No 2 Tahun 2010 tentang Perubahan Atas Keputusan Menteri Perhubungan Nomor KM. 17 Tahun 2000 tentang Pedoman Penanganan Bahan Barang Berbahaya Dalam Kegiatan Pelayaran Indonesia', 'Active', '2016-02-08 19:20:32', 'System', NULL, NULL),
(42, NULL, 39, 72, '60 Tahun 2010.pdf', '2016-02-08 19:21:04', 'KM. No 60 Tahun 2010 tentang Organisasi dan Tata Kerja Kementerian Perhubungan tanggal 05 November 2010', 'Active', '2016-02-08 19:21:04', 'System', NULL, NULL),
(43, NULL, 39, 73, '62 Tahun 2010.pdf', '2016-02-08 19:21:28', 'KM. No 62 Tahun 2010 tentang Organisasi Tata Cara Kerja Kantor Unit Penyelenggara Pelabuhan', 'Active', '2016-02-08 19:21:28', 'System', NULL, NULL),
(44, NULL, 39, 74, '63 Tahun 2010.pdf', '2016-02-08 19:21:51', 'KM. No 63 Tahun 2010 tentang Organisasi dan Tata Kerja Kantor Otoritas Pelabuhan', 'Active', '2016-02-08 19:21:51', 'System', NULL, NULL),
(45, NULL, 40, 75, '47 Tahun 1976.pdf', '2016-02-08 19:23:57', 'KEPPRES No. 47 Tahun 1976 tentang Mengesahkan International Convention On Load Lines 1966 tanggal 2 November 1976', 'Active', '2016-02-08 19:23:57', 'System', NULL, NULL),
(46, NULL, 40, 76, '50 Tahun 1979.pdf', '2016-02-08 19:24:20', 'KEPPRES No. 50 Tahun 1979 tentang Mengesahkan Convention On The International Regulations For Preventing Collisions At Sea, 1972 tanggal 11 Oktober 1979', 'Active', '2016-02-08 19:24:20', 'System', NULL, NULL),
(47, NULL, 40, 77, '65 Tahun 1980.pdf', '2016-02-08 19:24:59', 'KEPPRES No. 65 Tahun 1980 tentang Mengesahkan SOLAS 1974 tanggal 09 Desember 1980', 'Active', '2016-02-08 19:24:59', 'System', NULL, NULL),
(48, NULL, 40, 78, '14 Tahun 1996.pdf', '2016-02-08 19:25:34', 'KEPPRES No. 14 Tahun 1996 Tentang Pengesahan Amendments to the Convention on the International Maritime Organization - Institutionalization of The Facilitation Committee, 1991 tanggal 16 Pebruari 1976', 'Active', '2016-02-08 19:25:34', 'System', NULL, NULL),
(49, NULL, 40, 79, '52 Tahun 1999.pdf', '2016-02-08 19:25:59', 'KEPPRES No. 52 Tahun 1999 Tentang Pengesahan Protocol of 1992 to Amend The International Convention on Civil Liability For Oil Pollution Damage, 1969', 'Active', '2016-02-08 19:25:59', 'System', NULL, NULL),
(50, NULL, 40, 80, '45 Tahun  2000.pdf', '2016-02-08 19:26:31', 'KEPPRES No. 45 Tahun 2000 tentang Perubahan Atas Keputusan Presiden Nomor 102 Tahun 2000 tentang Kedudukan, Tugas, Fungsi, Kewenangan, Susunan Organisasi dan Tata Kerja Departemen tanggal 1 Juli 2002', 'Active', '2016-02-08 19:26:31', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `doc_file`
--

CREATE TABLE `doc_file` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `original_filename` varchar(1000) DEFAULT NULL,
  `file` longblob,
  `description` varchar(250) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data untuk tabel `doc_file`
--

INSERT INTO `doc_file` (`id`, `name`, `original_filename`, `file`, `description`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(8, 'AB51EC30-2D19-4E47-A0E5-E0558872F6CB.jpeg', 'avLpjyE_700b_v2.jpg', NULL, NULL, '2015-12-14 23:32:03', 'System', NULL, NULL),
(13, '2575F3EE-CC10-40BF-9673-951FA7CEA524.jpeg', '12191007_10154193339536840_758292746259324603_n.jpg', NULL, NULL, '2015-12-15 01:14:15', 'System', NULL, NULL),
(15, 'B2E6599F-3196-4F6B-A38A-74D06D52C348.jpeg', '12191007_10154193339536840_758292746259324603_n.jpg', NULL, NULL, '2015-12-15 01:18:58', 'System', NULL, NULL),
(16, 'D3529A96-8164-4454-90B1-6F00D6ECB668.jpeg', '12191007_10154193339536840_758292746259324603_n.jpg', NULL, NULL, '2015-12-15 01:21:42', 'System', NULL, NULL),
(17, 'C2C9581F-E19C-4BFD-8BCB-9B3EC2A50438.jpeg', 'a2YM9rZ_460s_v1.jpg', NULL, NULL, '2015-12-15 02:40:26', 'System', NULL, NULL),
(18, 'C1A92462-D7C6-45C1-A4C8-225ED67A06FA.pdf', 'chart.pdf', NULL, NULL, '2015-12-20 08:00:37', 'System', NULL, NULL),
(19, 'FDF2B706-D982-4FBB-B0B4-5EF0172EEB99.pdf', 'Si Dana Kas Maxima.pdf', NULL, NULL, '2015-12-22 14:36:13', 'System', NULL, NULL),
(22, '292177A9-BD2E-4920-AF4D-69453679EA0F.pdf', 'amru-thread_games.pdf', NULL, NULL, '2015-12-22 15:15:13', 'System', NULL, NULL),
(23, '0F282018-8B8C-40C0-A516-1A709DA3B356.pdf', 'amru-thread_games.pdf', NULL, NULL, '2015-12-22 15:30:51', 'System', NULL, NULL),
(24, '176E7205-BDF9-4503-B875-1788CB297470.pdf', 'b16c6227aa.pdf', NULL, NULL, '2015-12-22 15:34:41', 'System', NULL, NULL),
(25, '810B6132-53DE-401D-97AA-5CF7D9D08C56.pdf', 'bipublisherdatasheet-129370.pdf', NULL, NULL, '2015-12-22 15:35:41', 'System', NULL, NULL),
(26, '4B431543-7FCE-4AE6-B2EA-E69660A47F3F.pdf', 'laravel-sample.pdf', NULL, NULL, '2015-12-28 12:56:39', 'System', NULL, NULL),
(27, '27EDBB67-0F16-400E-98AB-A2538D9B073B.pdf', 'chart.pdf', NULL, NULL, '2015-12-28 12:57:37', 'System', NULL, NULL),
(28, 'C1EEDB0A-25AF-4F6C-B30C-C69D920AC292.pdf', 'EKO SUPRAPTO WIBOWO - Google Drive.pdf', NULL, NULL, '2016-01-31 04:43:16', 'System', NULL, NULL),
(29, '31A819A1-8EB5-425E-AB5F-5D70CC5EE02A.jpeg', '6812-01-indonesia-editable-map-16x9-2-558x313.jpg', NULL, NULL, '2016-02-08 08:14:21', 'System', NULL, NULL),
(30, '7A95FD62-57DD-4B82-9407-6DFDE65E4C68.png', 'map9.png', NULL, NULL, '2016-02-08 08:14:22', 'System', '2016-02-08 08:15:23', 'System'),
(35, '7C0874A8-9EBA-4094-846A-97410F7D9157.pdf', '1 Tahun 2013.pdf', NULL, NULL, '2016-02-08 18:40:25', 'System', NULL, NULL),
(36, 'CF752A91-57C2-4C56-AE04-62E92A2CA0DB.pdf', '5 Tahun 2005.pdf', NULL, NULL, '2016-02-08 18:41:31', 'System', NULL, NULL),
(37, '16BEB6F0-AA02-49CA-9BED-068CA708BDA6.pdf', 'PY.65.1.3-86.pdf', NULL, NULL, '2016-02-08 18:42:56', 'System', NULL, NULL),
(38, 'E374BC9B-B458-4FCF-9045-3754138BAC02.pdf', 'PY.67.1.3-93.pdf', NULL, NULL, '2016-02-08 18:43:31', 'System', NULL, NULL),
(39, '2F106247-42A2-40F4-ABFB-0EDE3A45FC0C.pdf', 'PY.68.1.3-95.pdf', NULL, NULL, '2016-02-08 18:44:06', 'System', NULL, NULL),
(40, 'C45EAF61-8FD2-4102-BD83-9C0F86732FA4.pdf', 'PY.67.1.7-96.pdf', NULL, NULL, '2016-02-08 18:44:41', 'System', NULL, NULL),
(41, '5A802324-56E2-4764-8EB5-E72BED6C8538.pdf', 'PY.66.1.4-03.pdf', NULL, NULL, '2016-02-08 18:45:12', 'System', NULL, NULL),
(42, '8A056343-2329-47D1-B3A9-2ED330F01C02.pdf', 'HK.103.1.15-12.pdf', NULL, NULL, '2016-02-08 18:47:49', 'System', NULL, NULL),
(43, 'DB45F1F1-921D-4910-B872-B6557C1F581C.pdf', 'HK.103.1.16-12.pdf', NULL, NULL, '2016-02-08 18:48:50', 'System', NULL, NULL),
(44, 'C66ED795-B187-467F-BB1D-70A03F818218.pdf', 'HK.103.1.17-12.pdf', NULL, NULL, '2016-02-08 18:49:52', 'System', NULL, NULL),
(45, 'C8374CA1-41B2-4309-8B2A-45B1F401C94A.pdf', 'HK.103.1.18-12.pdf', NULL, NULL, '2016-02-08 18:51:41', 'System', NULL, NULL),
(46, '7EC2DEA0-4EDF-4725-8D5F-F4412023E554.pdf', 'HK.103.1.19-12.pdf', NULL, NULL, '2016-02-08 18:52:28', 'System', NULL, NULL),
(47, '54ABC542-1D9F-4620-94F8-1AD71C28068B.pdf', 'HK.103.1.20-12.pdf', NULL, NULL, '2016-02-08 18:54:41', 'System', NULL, NULL),
(48, '6479A91E-D357-450F-9B2F-0CFE18F4EA1E.pdf', 'HK.103.2.2-12.pdf', NULL, NULL, '2016-02-08 18:55:38', 'System', NULL, NULL),
(49, '5DB1BCB4-B555-4D38-8CB9-AC44024A2642.pdf', 'HK.103.2.3-12.pdf', NULL, NULL, '2016-02-08 18:56:34', 'System', NULL, NULL),
(50, 'E0D9D62C-6576-4997-AE65-2EAAB7E1B710.pdf', 'HK.103.2.4-12.pdf', NULL, NULL, '2016-02-08 18:57:11', 'System', NULL, NULL),
(51, '73064588-10E4-4B45-9AFE-E27062D9C421.pdf', 'HK.103.2.5-12.pdf', NULL, NULL, '2016-02-08 18:58:03', 'System', NULL, NULL),
(52, '908130DA-7856-468A-BCBB-8DD80C106AA5.pdf', 'UM.008.9.20-12.pdf', NULL, NULL, '2016-02-08 18:59:30', 'System', NULL, NULL),
(53, 'B83BC8CE-0BE2-4A8F-9E6C-F5D2CA694360.pdf', 'UM.008.23.20-14.pdf', NULL, NULL, '2016-02-08 19:00:31', 'System', NULL, NULL),
(54, 'FA1C016D-92D4-4A2B-A861-BD368AC1B05A.pdf', 'UM.008.34.10-14.pdf', NULL, NULL, '2016-02-08 19:01:10', 'System', NULL, NULL),
(55, 'B68E7954-ED3D-4110-AECB-36FDCF31E538.pdf', 'UM.008.43.4-14.pdf', NULL, NULL, '2016-02-08 19:02:04', 'System', NULL, NULL),
(56, '2B5C9848-C9B9-4D6F-9E0F-D5947D217330.pdf', '46 Tahun 1996.pdf', NULL, NULL, '2016-02-08 19:07:48', 'System', NULL, NULL),
(57, '98C5FFE0-8478-4095-99B4-C4352BC68D3D.pdf', '29 Tahun 1999.pdf', NULL, NULL, '2016-02-08 19:08:29', 'System', NULL, NULL),
(58, 'CCD2D0BD-C1F9-413D-928E-44DEBDB6C59A.pdf', '17 Tahun 2000.pdf', NULL, NULL, '2016-02-08 19:09:26', 'System', NULL, NULL),
(59, '22924923-82F9-4319-A226-209BCEE697B1.pdf', '33 Tahun 2003.pdf', NULL, NULL, '2016-02-08 19:10:23', 'System', NULL, NULL),
(60, '28C2FB5B-21B4-40D2-8AB0-05C8D692A943.pdf', '3 Tahun 2004.pdf', NULL, NULL, '2016-02-08 19:11:20', 'System', NULL, NULL),
(61, 'F8C2EAA2-6D0C-4C63-9069-E257A14E84A4.pdf', '70 Tahun 2004.pdf', NULL, NULL, '2016-02-08 19:11:53', 'System', NULL, NULL),
(62, '015FC939-3FF3-45F2-9B6C-92B2DDD1984C.pdf', '4 Tahun 2005.pdf', NULL, NULL, '2016-02-08 19:12:40', 'System', NULL, NULL),
(63, 'E86F147B-8D8F-4FA4-BA91-254876FB9205.pdf', '6 Tahun 2005.pdf', NULL, NULL, '2016-02-08 19:13:15', 'System', NULL, NULL),
(64, 'B0437848-0F46-46F7-8B65-C82ED109D3C1.pdf', '66 Tahun 2005.pdf', NULL, NULL, '2016-02-08 19:13:56', 'System', NULL, NULL),
(66, '1A931797-5753-4026-A0C3-DABB393872BA.pdf', '20 Tahun 2006.pdf', NULL, NULL, '2016-02-08 19:17:26', 'System', NULL, NULL),
(67, 'C3AE4A73-6ECE-4FBE-B599-04867AC6B505.pdf', '9 Tahun 2008.pdf', NULL, NULL, '2016-02-08 19:18:13', 'System', NULL, NULL),
(68, '655B70E9-5278-4F71-A1DC-2303D0485D65.pdf', '20 Tahun 2008.pdf', NULL, NULL, '2016-02-08 19:18:45', 'System', NULL, NULL),
(69, '39402D4A-9086-4041-AD34-1A43953AB38E.pdf', '65 Tahun 2009.pdf', NULL, NULL, '2016-02-08 19:19:24', 'System', NULL, NULL),
(70, '665EA199-8DD5-42EA-9295-B4E2F683F6A9.pdf', '1 Tahun 2010.pdf', NULL, NULL, '2016-02-08 19:19:59', 'System', NULL, NULL),
(71, '8F3EC8ED-7BBB-4A4D-B8B5-9BB6748D00C3.pdf', '2 Tahun 2010.pdf', NULL, NULL, '2016-02-08 19:20:32', 'System', NULL, NULL),
(72, '81D7CC74-34E4-4205-9FE3-A9FAB036AC3E.pdf', '60 Tahun 2010.pdf', NULL, NULL, '2016-02-08 19:21:04', 'System', NULL, NULL),
(73, 'EBDE7C0C-9814-4387-AF11-DE0FE5F40A77.pdf', '62 Tahun 2010.pdf', NULL, NULL, '2016-02-08 19:21:28', 'System', NULL, NULL),
(74, '45AC4F5B-EED2-452D-B714-2D574A1171E3.pdf', '63 Tahun 2010.pdf', NULL, NULL, '2016-02-08 19:21:51', 'System', NULL, NULL),
(75, 'D26BB036-AA48-4135-AC85-6BA7911F7EFA.pdf', '47 Tahun 1976.pdf', NULL, NULL, '2016-02-08 19:23:57', 'System', NULL, NULL),
(76, 'D110E332-BDE9-4BBB-AAD4-A5E057CBC3BB.pdf', '50 Tahun 1979.pdf', NULL, NULL, '2016-02-08 19:24:20', 'System', NULL, NULL),
(77, 'BA9023B3-55C3-4D75-8F03-CC99805308B6.pdf', '65 Tahun 1980.pdf', NULL, NULL, '2016-02-08 19:24:59', 'System', NULL, NULL),
(78, '22A00CC0-2D1A-4711-AC3F-EF80CB0C95A3.pdf', '14 Tahun 1996.pdf', NULL, NULL, '2016-02-08 19:25:34', 'System', NULL, NULL),
(79, '0EEF0AA3-62D3-4286-8930-A2637BEB185C.pdf', '52 Tahun 1999.pdf', NULL, NULL, '2016-02-08 19:25:59', 'System', NULL, NULL),
(80, '485F9A57-18FA-491B-8D4E-5867D2E51309.pdf', '45 Tahun  2000.pdf', NULL, NULL, '2016-02-08 19:26:31', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `doc_type`
--

CREATE TABLE `doc_type` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `doc_type`
--

INSERT INTO `doc_type` (`id`, `name`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 'Laporan Pemeriksaan Radio Kapal', '', 'Active', '2015-12-09 14:26:10', 'System', '2015-12-26 19:50:33', 'System'),
(3, 'Brevet A', '', 'Active', '2015-12-09 14:26:27', 'System', '2015-12-26 19:51:03', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `education_level`
--

CREATE TABLE `education_level` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `education_level`
--

INSERT INTO `education_level` (`id`, `name`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'DI', '2015-12-22 22:14:20', 'System', NULL, NULL),
(2, 'DII', '2015-12-22 22:14:20', 'System', NULL, NULL),
(3, 'DIII', '2015-12-22 22:14:20', 'System', NULL, NULL),
(4, 'DIV', '2015-12-22 22:14:20', 'System', NULL, NULL),
(5, 'S1', '2015-12-22 22:14:20', 'System', NULL, NULL),
(6, 'S2', '2015-12-22 22:14:20', 'System', NULL, NULL),
(7, 'S3', '2015-12-22 22:14:20', 'System', NULL, NULL),
(8, 'SMA', '2015-12-22 22:14:20', 'System', NULL, NULL),
(9, 'ANT-I', '2015-12-22 22:14:20', 'System', NULL, NULL),
(10, 'ANT-II', '2015-12-22 22:14:20', 'System', NULL, NULL),
(11, 'ANT-III', '2015-12-22 22:14:20', 'System', NULL, NULL),
(12, 'ANT-IV', '2015-12-22 22:14:20', 'System', NULL, NULL),
(13, 'ATT-I', '2015-12-22 22:14:20', 'System', NULL, NULL),
(14, 'ATT-II', '2015-12-22 22:14:20', 'System', NULL, NULL),
(15, 'ATT-III', '2015-12-22 22:14:20', 'System', NULL, NULL),
(16, 'ATT-IV', '2015-12-22 22:14:20', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employee_photo`
--

CREATE TABLE `employee_photo` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `original_filename` varchar(1000) DEFAULT NULL,
  `file` longblob,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `employee_photo`
--

INSERT INTO `employee_photo` (`id`, `name`, `original_filename`, `file`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 'AE5552E6-B1FC-44D4-A23B-FB17634F9460.png', 'sample dashboard.png', NULL, '2015-12-13 17:46:19', 'System', NULL, NULL),
(3, 'E2A1B41B-D7F8-4455-ACA4-5699FBB28272.jpeg', 'a4LbKz1_460s.jpg', NULL, '2015-12-15 02:43:24', 'System', NULL, NULL),
(4, 'DF37900F-400A-4C5C-9DBA-5B0286D20F0D.png', 'gyro_compass.png', NULL, '2016-02-08 07:41:06', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `employee_profile`
--

CREATE TABLE `employee_profile` (
  `id` bigint(20) NOT NULL,
  `nip` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `birth_place` varchar(100) DEFAULT NULL,
  `birth_date` datetime DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `sex` varchar(5) NOT NULL,
  `npwp` varchar(100) DEFAULT NULL,
  `marital_status` varchar(100) DEFAULT NULL,
  `hobby` varchar(250) DEFAULT NULL,
  `id_photo` bigint(20) DEFAULT NULL,
  `phone1` varchar(100) DEFAULT NULL,
  `phone2` varchar(100) DEFAULT NULL,
  `phone3` varchar(100) DEFAULT NULL,
  `email01` varchar(250) DEFAULT NULL,
  `email02` varchar(250) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `status_desc` varchar(500) DEFAULT NULL,
  `id_functional` bigint(20) NOT NULL,
  `id_structural` bigint(20) NOT NULL,
  `struct_bidang` varchar(1000) DEFAULT NULL,
  `struct_seksi` varchar(1000) DEFAULT NULL,
  `id_harbour_master` bigint(20) NOT NULL,
  `id_grade` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `employee_profile`
--

INSERT INTO `employee_profile` (`id`, `nip`, `name`, `birth_place`, `birth_date`, `religion`, `sex`, `npwp`, `marital_status`, `hobby`, `id_photo`, `phone1`, `phone2`, `phone3`, `email01`, `email02`, `description`, `status`, `status_desc`, `id_functional`, `id_structural`, `struct_bidang`, `struct_seksi`, `id_harbour_master`, `id_grade`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(637, '195707191987031001', 'Hari Setyobudi', '-', '1957-07-19 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'hari_setyobudi@dephub.go.id', '', '-', 'Active', NULL, 1, 9, '', '', 292, 15, '2015-12-09 12:44:01', 'System', '2016-02-06 20:21:49', 'System'),
(1025, '195609121985031002', 'Capt. Bobby R. Mamahit', '-', '1956-09-12 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'bobby_r@dephub.go.id', '', '-', 'Active', NULL, 1, 2, '', '', 292, 18, '2015-12-09 12:44:01', 'System', '2016-02-06 20:22:31', 'System'),
(1027, '196705111998081001', 'Victor Vikki Subroto, M.Mar.E', '-', '1967-05-11 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'victor_vikki@dephub.go.id', '', '-', 'Active', NULL, 1, 5, '', '', 292, 14, '2015-12-09 12:44:01', 'System', '2016-02-06 20:20:46', 'System'),
(1028, '197105151997031002', 'Abdi Sabda, S.T., M.H.', '-', '1971-05-15 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'abdi_sabda@dephub.go.id', '', '-', 'Active', NULL, 1, 15, '', '', 292, 14, '2015-12-09 12:44:01', 'System', '2016-02-06 20:20:23', 'System'),
(1029, '196308141994031002', 'Ir. Junaidi, M.M.', '-', '1963-08-14 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'junaidi1408@dephub.go.id', '', '-', 'Active', NULL, 1, 12, '', '', 30, 14, '2015-12-09 12:44:01', 'System', '2016-02-06 20:19:57', 'System'),
(1030, '196208031989031001', 'Ir. Rahmatullah, M.Si.', '-', '1962-08-03 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'rahmatullah0308@dephub.go.id', '', '-', 'Active', NULL, 1, 13, '', '', 292, 14, '2015-12-09 12:44:01', 'System', '2016-02-06 20:21:34', 'System'),
(1031, '197410311998081001', 'Capt. Hendri Ginting, M.M.', '-', '1974-10-31 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'hendri_ginting@dephub.go.id', '', '-', 'Active', NULL, 1, 12, '', '', 23, 13, '2015-12-09 12:44:01', 'System', '2016-02-06 20:24:23', 'System'),
(1032, '197311252007121001', 'Capt. Diaz Saputra, M.M.', '-', '1973-11-25 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'diaz.saputra@dephub.go.id', '', '-', 'Active', NULL, 1, 7, '', '', 292, 12, '2015-12-09 12:44:01', 'System', '2016-02-06 20:24:54', 'System'),
(1033, '197205312002121002', 'Capt. Renaldo Sjukri, M.M.', '-', '1972-05-31 00:00:00', 'Islam', 'L', '', '', '', NULL, '-', '', '', 'renaldo_sjukri@dephub.go.id', '', '-', 'Active', NULL, 1, 20, '', '', 292, 13, '2015-12-09 12:44:01', 'System', '2016-02-09 07:38:43', 'System'),
(1034, '197601082005021002', 'Capt. Bharto Ari Raharjo', '-', '1976-01-08 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'bharto_ari@dephub.go.id', '', '-', 'Active', NULL, 1, 23, '', '', 292, 13, '2015-12-09 12:44:01', 'System', '2016-02-06 20:26:21', 'System'),
(1035, '197709152003121002', 'Muhamad Syaiful', '-', '1977-09-15 00:00:00', 'Islam', 'L', '', '', '', NULL, '-', '', '', 'muhamad_syaiful@dephub.go.id', '', '-', 'Active', NULL, 1, 17, '', '', 292, 12, '2015-12-09 12:44:01', 'System', '2016-02-09 07:36:02', 'System'),
(1036, '196908121998031006', 'Agustinus Maun, S.T., M.T.', '-', '1969-08-12 00:00:00', 'Kristen', 'L', '', '', '', NULL, '-', '', '', 'agustinus_maun@dephub.go.id', '', '-', 'Active', NULL, 1, 18, '', '', 292, 14, '2015-12-09 12:44:01', 'System', '2016-02-09 07:36:20', 'System'),
(1037, '197712022006042002', 'Capt. Cristiana Yustita', '-', '1977-12-02 00:00:00', 'Islam', 'P', '', '', '', NULL, '-', '', '', 'cristiana_yustita@dephub.go.id', '', '-', 'Active', NULL, 1, 19, '', '', 292, 13, '2015-12-09 12:44:01', 'System', '2016-02-09 07:38:29', 'System'),
(1038, '197401242003121001', 'Rajuman Sibarani', '-', '1974-01-24 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'rajumansibarani@dephub.go.id', '', '-', 'Active', NULL, 1, 26, '', '', 292, 13, '2015-12-09 12:44:01', 'System', '2016-02-06 20:35:29', 'System'),
(1039, '197604302007121001', 'Irsal Isa', '-', '1976-04-30 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'irsal_isa@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1040, '197407082009121001', 'Ferro Hidayah', '-', '1974-07-08 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'ferro_hidayah@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1041, '197508082009121003', 'Capt. Dikki Zulkarnaen A.', '-', '1975-08-08 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'dikki_zulkarnaen@dephub.go.id', '', '-', 'Active', NULL, 1, 8, '', '', 292, 11, '2015-12-09 12:44:01', 'System', '2016-02-06 18:49:37', 'System'),
(1042, '197503222003122001', 'Astri Wahyuningsih', '-', '1975-03-22 00:00:00', 'Islam', 'P', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'astri_wahyuningsih@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1043, '197101192010121001', 'Asdi Amani', '-', '1971-01-19 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'asdiamani@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1044, '196909211998091001', 'Hendi Prasetyo', '-', '1969-09-21 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'hendi_prasetyo@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1045, '197911302007121001', 'Adib Zuhairi', '-', '1979-11-30 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'adib_zuhairi@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1046, '198501172009121007', 'Totok Joni D.P.S.', '-', '1985-01-17 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'totok_joni@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1047, '198703222010121001', 'Aulia Akbar', '-', '1987-03-22 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'aulia_akbar@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1048, '197604152008121002', 'Rudin', '-', '1976-04-15 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'rudin@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1049, '197901162007121001', 'Helmi Candra', '-', '1979-01-16 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'helmi_candra@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1050, '197804142006041001', 'Iwan Dwi Nugroho', '-', '1978-04-14 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'iwan_dwi@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1051, '197412072007121001', 'R. Deddy Erryanto', '-', '1974-12-07 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'raden_deddy@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1052, '198404042009121002', 'Hotman Naibaho', '-', '1984-04-04 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'hotman_naibaho@dephub.go.id', '', '-', 'Active', NULL, 1, 8, '', '', 292, 11, '2015-12-09 12:44:01', 'System', '2016-02-06 18:48:04', 'System'),
(1054, '197608172006042001', 'Erlina Setyaningtyas', '-', '1976-08-17 00:00:00', 'Islam', 'P', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'erlina_setyaningtyas@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1055, '197809192007122001', 'Sri Suharni', '-', '1978-09-19 00:00:00', 'Kristen', 'P', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'sri_suharni@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1056, '197111082006041002', 'Semuel Tandipasau Darmawan, S.T.', '-', '1971-11-08 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'semuel_tandipasau@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1057, '197507012007121001', 'Andri M. Setiawan', '-', '1975-07-01 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'andri_muhamad@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1058, '197911232010122001', 'Dini Novitasari, S.T.', '-', '1979-11-23 00:00:00', 'Islam', 'P', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'dini_novitasari@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1059, '197707052009121003', 'Capt. Ari Wibowo', '-', '1977-07-05 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'ari_wibowo0507@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1060, '198002232006042001', 'Febriyanti', '-', '1980-02-23 00:00:00', 'Islam', 'P', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'febriyanti@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1061, '197512151998081001', 'Fadli Suryanto Bulkia', '-', '1975-12-15 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'fadli_suryanto@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1062, '197512232010121001', 'Delsy Analisa', '-', '1975-12-23 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'delsy_analisa@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1063, '197605122007121002', 'Faisal Rahman', '-', '1976-05-12 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'faisal_rahman1205@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1065, '198101122007121002', 'Richard Christian', '-', '1981-01-12 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'richard_christian@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1066, '196909071998031001', 'Alwan Rasyid', '-', '1969-09-07 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'alwan_rasyid@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1067, '197706162008121001', 'Capt. Suganjar', '-', '1977-06-16 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'suganjar@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1069, '197709202005021001', 'Stephanus Risdiyanto', '-', '1977-09-20 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'stephanus_risdiyanto@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1070, '198303222008121002', 'Rachmat A. Nirang', '-', '1983-03-22 00:00:00', 'Kristen', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'rachmat_antonius@dephub.go.id', '', '-', 'Active', NULL, 1, 8, '', '', 292, 10, '2015-12-09 12:44:01', 'System', '2016-02-06 18:49:06', 'System'),
(1072, '197906062010121002', 'Capt. Ilham Akbar', '-', '1979-06-06 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', NULL, NULL, 'ilham_akbar0606@dephub.go.id', NULL, '-', 'Active', NULL, 1, 8, NULL, NULL, 292, 10, '2015-12-09 12:44:01', 'System', NULL, NULL),
(1074, '196306181989031002', 'Ir. Zahara Saputra', '-', '1963-06-18 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'zahara_saputra@dephub.go.id', '', '-', 'Active', NULL, 1, 27, '', '', 292, 14, '2015-12-09 12:44:01', 'System', '2016-02-06 20:38:39', 'System'),
(1077, '197811062005022001', 'Renta Novaliana Siahaan', '-', '1978-11-06 00:00:00', 'Kristen', 'P', NULL, NULL, NULL, NULL, '-', '', '', 'renta_novaliana@dephub.go.id', '', '', 'Active', NULL, 1, 6, '', '', 292, 13, '2016-02-06 14:56:52', 'System', '2016-02-06 20:36:48', 'System'),
(1078, '197902282008121001', 'Ari Sasmito', '-', '1979-02-28 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'ari_sasmito@dephub.go.id', '', '', 'Active', NULL, 1, 8, '', '', 292, 11, '2016-02-06 18:20:18', 'System', '2016-02-06 18:47:17', 'System'),
(1079, '197603152002121001', 'Capt. Amir Makbul', '-', '1976-03-15 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '08118404437', '', '', 'amir_makbul@dephub.go.id', '', '', 'Active', NULL, 1, 8, '', '', 292, 13, '2016-02-06 18:23:37', 'System', '2016-02-06 18:26:00', 'System'),
(1080, '198005292006041001', 'Ahmad Ridho', '-', '1980-05-29 00:00:00', 'Islam', 'L', NULL, NULL, NULL, NULL, '-', '', '', 'ahmad_ridho@dephub.go.id', '', '', 'Active', NULL, 1, 8, '', '', 292, 10, '2016-02-06 18:25:31', 'System', '2016-02-06 18:48:35', 'System'),
(1081, '123456789012345678', 'Satya', 'Jakarta', '1982-05-08 00:00:00', 'Islam', 'L', '-', 'Belum Menikah', 'Main air', 4, '081295123467', '0010000000', '0010000000', 'satya109@gmail.com', '', 'Kebanyakan', 'Active', NULL, 4, 8, 'Makanan', 'All U Can Eat', 292, 3, '2016-02-08 07:41:06', 'System', '2016-02-08 18:18:06', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_addresses`
--

CREATE TABLE `emp_addresses` (
  `id` bigint(20) NOT NULL,
  `id_emp` bigint(20) NOT NULL,
  `jalan` varchar(250) DEFAULT NULL,
  `kelurahan` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `kabupaten` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kodepos` varchar(100) DEFAULT NULL,
  `is_current` tinyint(4) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `emp_addresses`
--

INSERT INTO `emp_addresses` (`id`, `id_emp`, `jalan`, `kelurahan`, `kecamatan`, `kabupaten`, `provinsi`, `kodepos`, `is_current`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(7, 1081, 'Cendrawasih, Kavling DKI Blok 124 A No. 1', 'Meruya Ilir', 'Kembangan', 'Jakarta Barat', 'DKI Jakarta', '11650', 1, '2016-02-08 08:02:16', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_basic_education`
--

CREATE TABLE `emp_basic_education` (
  `id` bigint(20) NOT NULL,
  `id_emp` bigint(20) NOT NULL,
  `level_education` varchar(100) NOT NULL,
  `school_name` varchar(150) DEFAULT NULL,
  `graduate_year` int(11) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `head_master` varchar(150) DEFAULT NULL,
  `id_certificate_file` bigint(20) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `emp_basic_education`
--

INSERT INTO `emp_basic_education` (`id`, `id_emp`, `level_education`, `school_name`, `graduate_year`, `location`, `head_master`, `id_certificate_file`, `description`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, 1081, 'TK', 'Indira', 1988, 'Blok M', 'Lupa', NULL, 'TK Kramat Pela', '2016-02-08 08:04:29', 'System', NULL, NULL),
(3, 1081, 'SD', 'SDN Kramat Pela 03 Pagi', 1994, 'Blok M', 'Lupa', NULL, 'SD Saya', '2016-02-08 08:05:16', 'System', '2016-02-08 08:06:20', 'System'),
(4, 1081, 'SLTP', 'SMPN 12 Wijaya', 1997, 'Blok M', 'Lupa', NULL, 'SMP Saya', '2016-02-08 08:06:04', 'System', NULL, NULL),
(5, 1081, 'SLTA', 'SMU Triguna', 2001, 'Hang Lekir Blok M', 'Lupa', NULL, 'SMU Saya', '2016-02-08 08:07:05', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_education`
--

CREATE TABLE `emp_education` (
  `id` bigint(20) NOT NULL,
  `id_university` bigint(20) NOT NULL,
  `id_faculty` bigint(20) DEFAULT NULL,
  `id_major` bigint(20) DEFAULT NULL,
  `id_education_level` bigint(20) DEFAULT NULL,
  `id_emp` bigint(20) NOT NULL,
  `graduate_year` int(11) NOT NULL,
  `graduate_date` datetime NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `professor` varchar(150) DEFAULT NULL,
  `id_certificate_file` bigint(20) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `emp_education`
--

INSERT INTO `emp_education` (`id`, `id_university`, `id_faculty`, `id_major`, `id_education_level`, `id_emp`, `graduate_year`, `graduate_date`, `location`, `professor`, `id_certificate_file`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(4, 3, 6, 10, 5, 1081, 2015, '2015-07-23 00:00:00', NULL, NULL, NULL, '', 'Active', '2016-02-08 08:11:25', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_email`
--

CREATE TABLE `emp_email` (
  `id` bigint(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL,
  `id_emp` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_experience`
--

CREATE TABLE `emp_experience` (
  `id` bigint(20) NOT NULL,
  `id_emp` bigint(20) NOT NULL,
  `position` varchar(150) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `level_position` varchar(100) DEFAULT NULL,
  `basic_salary` decimal(18,2) DEFAULT NULL,
  `officer` varchar(150) DEFAULT NULL,
  `letter_of_number` varchar(150) DEFAULT NULL,
  `letter_date` datetime DEFAULT NULL,
  `id_certificate_file` bigint(20) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `emp_experience`
--

INSERT INTO `emp_experience` (`id`, `id_emp`, `position`, `start_date`, `end_date`, `level_position`, `basic_salary`, `officer`, `letter_of_number`, `letter_date`, `id_certificate_file`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(3, 1081, 'Implementor', '2007-02-20 00:00:00', '2007-05-30 00:00:00', 'Officer', '3000000.00', NULL, '-', '2007-05-30 00:00:00', NULL, '2016-02-08 08:17:39', 'System', NULL, NULL),
(4, 1081, 'Support', '2008-01-07 00:00:00', '2008-12-26 00:00:00', 'Support', '3000000.00', NULL, '-', '2008-12-31 00:00:00', NULL, '2016-02-08 08:19:21', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_grade`
--

CREATE TABLE `emp_grade` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `emp_grade`
--

INSERT INTO `emp_grade` (`id`, `name`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Juru Muda (I/a)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:02:22', 'System'),
(2, 'Juru Muda Tingkat I (I/b)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:02:29', 'System'),
(3, 'Juru (I/c)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:02:35', 'System'),
(5, 'Juru Tingkat (I/d)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:02:48', 'System'),
(6, 'Pengatur Muda (II/a)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:03:00', 'System'),
(7, 'Pengatur Muda Tingkat (II/b)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:03:07', 'System'),
(8, 'Pengatur (II/c)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:03:16', 'System'),
(9, 'Pengatur Tingkat I (II/d)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:03:24', 'System'),
(10, 'Penata Muda (III/a)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:04:01', 'System'),
(11, 'Penata Muda Tingkat I (III/b)', '', 'Active', '2015-12-09 08:30:19', 'System', '2015-12-26 19:04:18', 'System'),
(12, 'Penata (III/c)', NULL, NULL, '2015-12-09 08:30:19', 'System', NULL, NULL),
(13, 'Penata Tingkat I (III/d)', NULL, NULL, '2015-12-09 08:30:19', 'System', NULL, NULL),
(14, 'Pembina (IV/a)', NULL, NULL, '2015-12-09 08:30:19', 'System', NULL, NULL),
(15, 'Pembina Tingkat I (IV/b)', NULL, NULL, '2015-12-09 08:30:19', 'System', NULL, NULL),
(16, 'Pembina Utama Muda (IV/c)', NULL, NULL, '2015-12-09 08:30:19', 'System', NULL, NULL),
(17, 'Pembina Utama Madya (IV/d)', NULL, NULL, '2015-12-09 08:30:19', 'System', NULL, NULL),
(18, 'Pembina Utama (IV/e)', NULL, NULL, '2015-12-09 08:30:19', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_physical_appearance`
--

CREATE TABLE `emp_physical_appearance` (
  `id` bigint(20) NOT NULL,
  `id_emp` bigint(20) NOT NULL,
  `height` decimal(15,2) DEFAULT NULL,
  `weight` decimal(15,2) DEFAULT NULL,
  `hair` varchar(150) DEFAULT NULL,
  `facial_shape` varchar(150) DEFAULT NULL,
  `skin_color` varchar(150) DEFAULT NULL,
  `distinguishable` varchar(250) DEFAULT NULL,
  `body_part_defect` varchar(250) DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `emp_physical_appearance`
--

INSERT INTO `emp_physical_appearance` (`id`, `id_emp`, `height`, `weight`, `hair`, `facial_shape`, `skin_color`, `distinguishable`, `body_part_defect`, `blood_type`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(5, 1081, '168.00', '80.00', 'Hitam', 'Oval', 'Sawo Matang', 'Bingung', 'Nda Ada', '', '2016-02-08 07:52:47', 'System', '2016-02-08 07:59:41', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `emp_training`
--

CREATE TABLE `emp_training` (
  `id` bigint(20) NOT NULL,
  `id_employee_profile` bigint(20) NOT NULL,
  `id_training` bigint(20) NOT NULL,
  `training_title` varchar(250) DEFAULT NULL,
  `date_taken_from` datetime DEFAULT NULL,
  `date_taken_to` datetime DEFAULT NULL,
  `graduate_date` datetime NOT NULL,
  `graduate_year` int(11) NOT NULL,
  `certificate_no` varchar(100) NOT NULL,
  `mi_card` varchar(100) DEFAULT NULL,
  `mi_date` datetime DEFAULT NULL,
  `id_certificate_file` bigint(20) DEFAULT NULL,
  `id_mi_card_file` bigint(20) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `refreshment` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `emp_training`
--

INSERT INTO `emp_training` (`id`, `id_employee_profile`, `id_training`, `training_title`, `date_taken_from`, `date_taken_to`, `graduate_date`, `graduate_year`, `certificate_no`, `mi_card`, `mi_date`, `id_certificate_file`, `id_mi_card_file`, `location`, `description`, `refreshment`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(3, 1081, 3, NULL, '2010-01-10 00:00:00', '2010-01-10 00:00:00', '2010-03-20 00:00:00', 2010, 'R-00001', 'MI-R.00001', '2011-12-30 00:00:00', 29, 30, 'Jakarta', 'Isian', 'Ya', 'Active', '2016-02-08 08:14:22', 'System', '2016-02-08 08:15:23', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `faculty`
--

CREATE TABLE `faculty` (
  `id` bigint(20) NOT NULL,
  `id_university` bigint(20) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `faculty`
--

INSERT INTO `faculty` (`id`, `id_university`, `name`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 2, 'Teknik', '', 'Active', '2015-12-09 15:08:15', 'System', '2015-12-19 04:14:53', 'System'),
(2, 2, 'Ekonomi', '', 'Active', '2015-12-09 15:08:23', 'System', NULL, NULL),
(3, 1, 'Hukum', '', 'Active', '2015-12-09 15:08:34', 'System', NULL, NULL),
(4, 1, 'Ilmu Sosial dan Ilmu Politik', '', 'Active', '2015-12-09 15:08:45', 'System', NULL, NULL),
(5, 1, 'Ilmu Komunikasi', '', 'Active', '2015-12-09 15:08:56', 'System', NULL, NULL),
(6, 3, 'Teknologi Informasi', 'FTI', 'Active', '2016-02-08 08:09:09', 'System', NULL, NULL),
(8, 94, 'Pelayaran', 'Fakultas Pelayaran', 'Active', '2016-02-09 13:33:39', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_categories`
--

CREATE TABLE `forum_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT '0',
  `enable_threads` tinyint(1) NOT NULL DEFAULT '0',
  `private` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_posts`
--

CREATE TABLE `forum_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `thread_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `post_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_threads`
--

CREATE TABLE `forum_threads` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pinned` tinyint(1) NOT NULL,
  `locked` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `forum_threads_read`
--

CREATE TABLE `forum_threads_read` (
  `thread_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `functional_title`
--

CREATE TABLE `functional_title` (
  `id` bigint(20) NOT NULL,
  `level` varchar(100) DEFAULT NULL,
  `upper_level` varchar(100) DEFAULT NULL,
  `upper_id` bigint(20) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `functional_title`
--

INSERT INTO `functional_title` (`id`, `level`, `upper_level`, `upper_id`, `name`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, '1', '', NULL, 'Marine Inspector', '-', 'Active', '2015-12-09 12:16:52', 'System', '2015-12-26 18:55:26', 'System'),
(2, '1', '', NULL, 'Auditor ISM Code', '-', 'Active', '2015-12-26 18:53:58', 'System', '2015-12-26 18:55:54', 'System'),
(3, '1', '', NULL, 'Surveyor Rancang Bangun', '-', 'Active', '2015-12-26 18:55:08', 'System', NULL, NULL),
(4, '1', '1', 1, 'Test', 'Test', 'Active', '2016-02-08 18:17:20', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harbour_area`
--

CREATE TABLE `harbour_area` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `harbour_area`
--

INSERT INTO `harbour_area` (`id`, `name`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Nanggroe Aceh Darussalam', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(2, 'Sumatra Utara', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(3, 'Sumatra Barat', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-01-08 15:03:01', 'System'),
(4, 'Riau', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(5, 'Kepulauan Riau', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(6, 'Jambi', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(7, 'Sumatra Selatan', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(8, 'Bengkulu', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(9, 'Lampung', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(10, 'Bangka Belitung', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(11, 'DKI Jakarta', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(12, 'Jawa Barat', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(13, 'Banten', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(14, 'Jawa Tengah', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(15, 'Daerah Istimewa Yogyakarta (DIY)', '', 'Not Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:58:55', 'System'),
(16, 'Jawa Timur', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(17, 'Bali', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(18, 'Nusa Tenggara Barat', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(19, 'Nusa Tenggara Timur', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(20, 'Kalimantan Barat', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(21, 'Kalimantan Tengah', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(22, 'Kalimantan Selatan', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(23, 'Kalimantan Timur', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(24, 'Kalimantan Utara', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(25, 'Sulawesi Utara', NULL, 'Active', '2015-12-09 12:05:06', 'System', NULL, NULL),
(26, 'Gorontalo', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:56:29', 'System'),
(27, 'Sulawesi Tengah', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:56:49', 'System'),
(28, 'Sulawesi Selatan', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:57:07', 'System'),
(29, 'Sulawesi Barat', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:57:22', 'System'),
(30, 'Sulawesi Tenggara', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:57:34', 'System'),
(31, 'Maluku', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:57:45', 'System'),
(32, 'Maluku utara', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:57:56', 'System'),
(33, 'Papua', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:58:13', 'System'),
(34, 'Papua Barat', '', 'Active', '2015-12-09 12:05:06', 'System', '2016-02-06 12:58:29', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harbour_grade`
--

CREATE TABLE `harbour_grade` (
  `id` bigint(20) NOT NULL,
  `code` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

--
-- Dumping data untuk tabel `harbour_grade`
--

INSERT INTO `harbour_grade` (`id`, `code`, `name`, `description`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, '00', '-', 'Kesyahbandaran / Otoritas Pelabuhan Utama', '2015-12-13 15:58:10', 'System', '2016-02-07 06:38:38', 'System'),
(2, '01', 'Kelas I', 'Kantor Pelabuhan Kelas I', '2015-12-13 15:58:23', 'System', '2016-02-06 13:03:23', 'System'),
(3, '02', 'Kelas II', 'Kantor Pelabuhan Kelas II', '2015-12-13 15:58:31', 'System', '2016-02-06 13:03:12', 'System'),
(4, '03', 'Kelas III', 'Kantor Pelabuhan Kelas III', '2015-12-13 15:58:38', 'System', '2016-02-06 13:02:52', 'System'),
(5, '04', 'Kelas IV', 'Kantor Pelabuhan Kelas IV', '2015-12-13 15:58:48', 'System', '2016-02-06 13:02:42', 'System'),
(6, '05', 'Kelas V', 'Kantor Pelabuhan Kelas V', '2015-12-13 15:58:56', 'System', '2016-02-06 13:02:26', 'System'),
(7, '06', '--', 'Atase Perhubungan', '2016-02-06 13:06:10', 'System', '2016-02-06 17:52:59', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harbour_head`
--

CREATE TABLE `harbour_head` (
  `id` bigint(20) NOT NULL,
  `id_harbour` bigint(20) NOT NULL,
  `id_emp` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `harbour_master`
--

CREATE TABLE `harbour_master` (
  `id` bigint(20) NOT NULL,
  `id_harbour_area` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `id_grade` bigint(20) DEFAULT NULL,
  `phone1` varchar(100) DEFAULT NULL,
  `phone2` varchar(100) DEFAULT NULL,
  `phone3` varchar(100) DEFAULT NULL,
  `address01` varchar(1000) DEFAULT NULL,
  `address02` varchar(1000) DEFAULT NULL,
  `address03` varchar(1000) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `web_address` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `harbour_master`
--

INSERT INTO `harbour_master` (`id`, `id_harbour_area`, `name`, `description`, `id_grade`, `phone1`, `phone2`, `phone3`, `address01`, `address02`, `address03`, `city`, `zipcode`, `email`, `web_address`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 2, 'Syahbandar Utama Belawan', '', 1, '(061) 6941424', '(061) 6942375', '', 'Jl. Ujung Baru Terminal Penumpang Belawan 20411', '', '', '', '', NULL, NULL, 'Active', '2015-12-09 12:06:04', 'System', '2015-12-09 15:02:09', 'System'),
(2, 11, 'Syahbandar Utama Tanjung Priok Jakarta', '', 1, '(021) 43931364 (021) 43800054', '(021) 43935405', '', 'Jl. Padamarang No. 4 Tanjung Priok Jakarta Utara 14310', '', '', '', '', NULL, NULL, 'Active', '2015-12-09 12:06:04', 'System', '2015-12-13 16:07:33', 'System'),
(3, 16, 'Syahbandar Utama Tanjung Perak Surabaya', NULL, 1, '(031) 3291364', '(031) 3291858', NULL, 'Jl. Kalimas Baru No. 194 Surabaya Jawa Timur 60165', NULL, NULL, NULL, NULL, 'syahbandarsby@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(4, 28, 'Syahbandar Makassar', NULL, 1, '(0411) 327555(0411) 3627555', '(0411) 323656(0411) 3626856', NULL, 'Jl. Hatta No. 2 Makassar Sulawesi Selatan 90173', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(5, 2, 'Otoritas Pelabuhan Belawan', NULL, 1, '(061) 6941051', '(061) 6941051', NULL, 'Jl. Suar No. 1 Pelabuhan Belawan 20411', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(6, 11, 'Otoritas Pelabuhan Tg Priok', NULL, 1, '(021) 43910256', '(021) 3506207(021) 43910259', NULL, 'Jl. Palmas No. 1 Pelabuhan Tanjung Priok Jakarta 14310', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(7, 16, 'Otoritas Pelabuhan Tanjung Perak', NULL, 1, '(031) 3291479', '(031) 3291480', NULL, 'Jl. Tanjung Perak Timur No. 396 Surabaya', NULL, NULL, NULL, NULL, 'op3tgperak@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(8, 2, 'Otoritas Pelabuhan Makassar', NULL, 1, '(0411) 3616444', '(0411) 3616444', NULL, 'Jl. Madura No. 1 Pelabuhan Makassar', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(9, 5, 'Kantor Pelabuhan Laut Batam', NULL, 2, '(0778) 430996', '(0778) 428179', NULL, 'Jl. Yos Sudarso No. 3 Batu Ampar Batam Kepulauan Riau', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(10, 1, 'KSOP Sabang', NULL, 6, '(0652) 21017', '-', NULL, 'Jl. Malahayati No. 82 Sabang - NAD 23512', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(11, 1, 'KSOP Kuala Langsa', NULL, 6, '(0641) 23459', '(0641) 425582', NULL, 'Jl. Pelabuhan No. 4 Kuala Langsa - NAD 24451', NULL, NULL, NULL, NULL, 'adpelklgs@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(12, 1, 'KSOP Lhokseumawe', NULL, 4, '(0645) 43485', '(0645) 43485', NULL, 'Jl. Pelabuhan No. 1 Lhokseumawe 24315', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(13, 1, 'KSOP Meulaboh', NULL, 6, '(0655) 7006020', '(0655) 7551443', NULL, 'Jl. Sudirman No. 20 Meulaboh - Aceh Barat - NAD 23611', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(14, 4, 'KSOP Dumai', NULL, 2, '(0765) 36114 (0765) 31162', '(0765) 31162', NULL, 'Jl. Yos Sudarso No. 9 Dumai Riau 28814', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(15, 9, 'KSOP Panjang', NULL, 2, '(0721) 31303 (0721) 33220', '(0721) 31392', NULL, 'Jl. Yos Sudarso No. 34A Panjang Bandar Lampung 35241', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(16, 13, 'KSOP Banten', NULL, 2, '(0254) 571717', '(0254) 571066', NULL, 'Jl. Yos Sudarso No. 102 Merak Banten 42438', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(17, 14, 'KSOP Tanjung Emas', NULL, 2, '(024) 3582335', '(024) 3582335', NULL, 'Jl. Yos Sudarso No. 30 Kel. Tanjung Emas Kec. Semarang Jawa Tengah 50174', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(18, 22, 'KSOP Banjarmasin', NULL, 2, '(0511) 3352640', '(0511) 3353734', NULL, 'Jl. Duyung Raya Komp. Lumba-lumba No. 45 Trisakti Banjarmasin Kalimantan Selatan 70119', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(19, 23, 'KSOP Balikpapan', NULL, 2, '(0542) 422096 (0542) 736276', '(0542) 472368', NULL, 'Jl. Yos Sudarso No. 1 Balikpapan Kalimantan Timur 76111', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(20, 25, 'KSOP Bitung', NULL, 2, '(0438) 21044 (0438) 35762 (0438) 36701', '(0438) 21044 (0438) 35762', NULL, 'Jl. Ir. Soekarno No. 4 Bitung Sulawesi Utara 95225', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(21, 31, 'KSOP Ambon', NULL, 2, '(0911) 352727', '(0911) 347108', NULL, 'Jl. Yos Sudarso Komp. Pelabuhan Ambon Maluku 97126', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(22, 34, 'KSOP Sorong', NULL, 2, '(0951) 321302 (0951) 321844', '(0951) 321302', NULL, 'Jl. Jend. A. Yani No. 19 Sorong - Papua Barat 98413', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(23, 5, 'KSOP Tanjung Pinang', NULL, 3, '(0771) 21014', '(0771) 21014', NULL, 'Jl. SM. Amin No. 18 Kota Tanjungpinang Kepulauan Riau 291111', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(24, 5, 'KSOP Tanjung Balai Karimun', NULL, 3, '(0777) 324108', '(0777) 324108', NULL, 'Jl. Yos Sudarso No. 02 Tanjung Balai Karimun Kepulauan Riau 29161', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(25, 5, 'KSOP Kijang', NULL, 3, '(0771) 463766 (0771) 463765', '(0771) 61561', NULL, 'Jl. Pelabuhan Sri Bayinten Kijang Kepri 29151', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(26, 3, 'KSOP Teluk Bayur', NULL, 3, '(0751) 61633', '(0751) 767388', NULL, 'Jl. Tanjung Priok No. 4 Teluk Bayur Sumatera Barat 25217', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(27, 7, 'KSOP Palembang', NULL, 3, '(0711) 711359 (0711) 713551 (0711) 713561', '(0711) 713450', NULL, 'Jl. Mayor Memet Sastrawirya No. 147 Palembang Sumatera Selatan 30115', NULL, NULL, NULL, NULL, 'adpel_plg@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(28, 12, 'KSOP Cirebon', NULL, 3, '(0231) 209723', '(0231) 209723', NULL, 'Jl. Donggala No. 3 Cirebon Jawa Barat 45112', NULL, NULL, NULL, NULL, 'adpel_crb@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(29, 14, 'KSOP Cilacap', NULL, 3, '(0282) 532158', '(0282) 532711', NULL, 'Jl. Niaga No. 9 Cilacap Jawa Tengah 53213', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(30, 16, 'KSOP Gresik', NULL, 3, '(031) 3981902', '(031) 3990588', NULL, 'Jl. Yos Sudarso No. 36 Gresik Jawa Timur 61114', NULL, NULL, NULL, NULL, 'adpelgresik@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(31, 17, 'KSOP Benoa', NULL, 3, '(0361) 720225', '(0361) 721122', NULL, 'Jl. Raya Pelabuhan Benoa Bali 80223', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(32, 20, 'KSOP Pontianak', NULL, 3, '(0561) 732307 (0561) 732043', '(0561) 739426', NULL, 'Jl. Rahadi Usman No. 2 Pontianak Kalimantan Barat', NULL, NULL, NULL, NULL, 'adpel@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(33, 23, 'KSOP Samarinda', NULL, 3, '(0541) 7411046', '(0541) 742425', NULL, 'Jl Yos Sudarso No. 2 Samarinda Kalimantan Timur 75112', NULL, NULL, NULL, NULL, 'ksop.samarinda@dephub.go.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(34, 30, 'KSOP Kendari', NULL, 3, '(0401) 3121884', '(0401) 3124254', NULL, 'Jl. Jend. Sudirman No. 68 RT.01/RW.01 Kendari - Sulawesi Utara 93127', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(35, 32, 'KSOP Ternate', NULL, 3, '(0921) 3121767 (0921) 3211572', '(0921) 3211572', NULL, 'Jl. Komp. Pelabuhan Ahmad Yani Ternate Maluku Utara 97724', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(36, 33, 'KSOP Jayapura', NULL, 3, '(0967) 534018', '(0967) 533923', NULL, 'Jl. Koti No. 9 Jayapura 99221', NULL, NULL, NULL, NULL, 'adpel_jayapura@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(37, 33, 'KSOP Biak', NULL, 3, '(0981) 21951 (0981) 21662', '(0981) 21591 (0981) 21011', NULL, 'Jl. Jenderal Sudirman No. 53 Biak Papua 98115', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(38, 4, 'KSOP Pekanbaru', NULL, 4, '(0761) 22827 (0761) 29404', '(0761) 22827 (0761) 29404', NULL, 'Jl. Kampung Dalam I Rt.01/05 Pekanbaru - Riau 28152', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(39, 4, 'KSOP Kuala Enok', NULL, 4, '(0768) 328663', '(0768) 328663', NULL, 'Jl. Pelabuhan No. 1 Kuala Enok 29271', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(40, 4, 'KSOP Sungai Pakning', NULL, 4, '(0766) 91014', '(0766) 91014', NULL, 'Jl. Yos Sudarso No. 1 Sungai Pakning Riau 28761', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(41, 5, 'KSOP Pulau Sumbu', NULL, 4, '(0778) 310485 (0778) 7023130', '(0778) 310485 (0778) 7023130', NULL, 'Jl. Pelabuhan No. 1 RT.001/RW.006 Pulau Sumbu Kepulauan Riau 29411', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(42, 6, 'KSOP Jambi', NULL, 4, '(0741) 22020', '(0741) 25280', NULL, 'Jl. Raya Pelabuhan Km. 9 Talang Dukuh - Jambi 36381', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(43, 8, 'KSOP Pulau Baai Bengkulu', NULL, 4, '(0736) 51694', '(0736) 51694', NULL, 'Jl. Ir. Rustandi Sugianto Pulau Baai Bengkulu 38216', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(44, 11, 'KSOP Sunda Kelapa', NULL, 4, '(021) 6907321', '(021) 6912004', NULL, 'Jl. Raya Baruna No. 2 Pelabuhan Sunda Kelapa Jakarta Utara 14430', NULL, NULL, NULL, NULL, 'ksop@portofsundakelapa.org', 'www.portofsundakelapa.org', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(45, 16, 'KSOP Tanjung Wangi', NULL, 4, '(0333) 510939 (0333) 510253', '(0333) 510295', NULL, 'Jl. Raya Situbondo Ketapang Banyuwangi Jawa Timur 68451', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(46, 18, 'KSOP Lembar', NULL, 4, '(0370) 681187', '(0370) 681019', NULL, 'Jl. Raya Pelabuhan Lembar Nusa Tenggara Barat 83364', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(47, 19, 'KSOP Kupang', NULL, 4, '(0380) 890019', '(0380) 890063', NULL, 'Jl. Yos Sudarso No. 27 Tenau Kupang NTT 85351', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(48, 21, 'KSOP Sampit', NULL, 4, '(0531) 21097', '(0531) 22488', NULL, 'Jl. Iskandar No. 3 Sampit Kalimantan Tengah 74322', NULL, NULL, NULL, NULL, 'ksop_sampit@ymail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(49, 23, 'KSOP Tarakan', NULL, 4, '(0551) 35808', '(0551) 35809', NULL, 'Jl. Yos Sudarso No. 8 Lingkas Ujung Tarakan Kalimantan Timur 77126', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(50, 25, 'KSOP Manado', NULL, 4, '(0431) 867054', '(0431) 859721', NULL, 'Jl. Pelabuhan Manado Sulawesi Utara 95111', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(51, 27, 'KSOP Pantoloan', NULL, 4, '(0451) 491037 (0451) 491500', '(0451) 492353', NULL, 'Jl. Samudera Pantoloan Palu - Sulawesi Tengah 94352', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(52, 28, 'KSOP Parepare', NULL, 4, '(0421) 21803', '(0421) 24642', NULL, 'Jl. Tarakan Komplek Pelabuhan Cappa Ujung Parepare Sulawesi Selatan 91112', NULL, NULL, NULL, NULL, 'ksop.parepare@dephub.go.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(53, 1, 'KSOP Malahayati', NULL, 5, '(0651) 48555', '(0651) 48555', NULL, 'Jl. Pattimura No. 94 Kel. Sukaramai Blower Banda Aceh', NULL, NULL, NULL, NULL, 'adpelmalahayati@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(54, 2, 'KSOP Pangkalan Susu', NULL, 5, '(0620) 51024', '(0620) 51024', NULL, 'Jl. Pelabuhan No. 05 Pangkalan Susu Langkat - Sumatera Utara 20858', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(55, 4, 'KSOP Tembilahan', NULL, 5, '(0768) 22033', '(0768) 22033', NULL, 'Jl. Jend. Sudirman No. 75 Tembilahan Kab. Indragiri Hilir - Riau 29212', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(56, 4, 'KSOP Rengat', NULL, 5, '(0769) 323355', '(0769) 323466', NULL, 'Jl. Ahmad Yani No. 10 Rengat Inhu - Riau 29319', NULL, NULL, NULL, NULL, 'ksoprengat42@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(57, 10, 'KSOP Pangkal Balam', NULL, 5, '(0717) 421611', '(0717) 421611', NULL, 'Jl. Yos Sudarso Pangkal Pinang Kepulauan Bangka Belitung 33115', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(58, 14, 'KSOP Tegal', NULL, 5, '(0283) 356038', '(0283) 356038', NULL, 'Jl. Kesatrian No. 6 Tegal - Jawa Tengah 52111', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(59, 16, 'KSOP Probolinggo', NULL, 5, '(0335) 426648', '(0335) 429273', NULL, 'Jl. Tanjung Tembaga Timur Probolinggo - Jawa Timur 67218', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(60, 17, 'KSOP Padangbai', NULL, 5, '(0363) 41188', '(0363) 41515', NULL, 'Jl. Pelabuhan Padangbai Bali 80872', NULL, NULL, NULL, NULL, 'adpel_padangbai@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(61, 18, 'KSOP Bima', NULL, 5, '(0374) 42219', '(0374) 44627', NULL, 'Jl. Martadinata No. 1 Bima - Nusa Tenggara Barat 84114', NULL, NULL, NULL, NULL, 'adpelbima@gmail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(62, 21, 'KSOP Kumai', NULL, 5, '(0532) 61495', '(0532) 61698', NULL, 'Jl. Bendahara No. 230 Kumai Kab. Kotawaringin Barat - Kalteng 74181', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(63, 22, 'KSOP Kota Baru', NULL, 5, '(0518) 21239', '-', NULL, 'Jl. Pangeran Indera Kesuma Jaya Komp. Pelabuhan Panjang Kota Baru - Kalsel 72113', NULL, NULL, NULL, NULL, 'adpel_kotabaru@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(64, 23, 'KSOP Nunukan', NULL, 5, '(0556) 21021', '(0556) 21021', NULL, 'Jl. Pelabuhan Baru No. 142 Nunukan - Kalimantan Timur 77482', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(65, 26, 'KSOP Gorontalo', NULL, 5, '(0435) 821074', '(0435) 821074', NULL, 'Jl. Manyor Dullah Kota Gorontalo Gorontalo 96118', NULL, NULL, NULL, NULL, 'adpel_gorontalo@gmail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(66, 27, 'KSOP Tolitoli', NULL, 5, '(0453) 21480', '-', NULL, 'Komp. Pelabuhan Tolitoli Sulawesi Tengah 94500', NULL, NULL, NULL, NULL, 'adpeltolis@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(67, 33, 'KSOP Merauke', NULL, 5, '(0971) 321384', '(0971) 325729', NULL, 'Jl. Sabang No. 312 Papua 99613 Kotak Pos 189', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(68, 34, 'KSOP Manokwari', NULL, 5, '(0986) 211833', '(0986) 211821', NULL, 'Jl. Banjarmasin No. 6 Manokwari Papua Barat 98311', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(69, 2, 'KSOP Tanjung Balai Asahan', NULL, 6, '(0623) 92038', '(0623) 92038', NULL, 'Jl. Pelabuhan Teluk Nibung 21351', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(70, 2, 'KSOP Kuala Tanjung', NULL, 6, '(0622) 31311 ext. 6113', '-', NULL, 'Jl. Pelabuhan Kuala Tanjung Sumatera Utara 21257', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(71, 2, 'KSOP Sibolga', NULL, 6, '(0631) 21663', '(0631) 22663', NULL, 'Jl. Horas Pelabuhan Sibolga Sibolga - Sumatera Utara 22532', NULL, NULL, NULL, NULL, 'ksop_sibolga@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(72, 2, 'KSOP Gunung Sitoli', NULL, 6, '(0639) 21414', '(0639) 21414', NULL, 'Jl. Yos Sudarso No. 194 Km. 2 Pelabuhan Angin Gunung Sitoli - Sumatera Utara 22812', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(73, 4, 'KSOP Bagan Siapiapi', NULL, 6, '(0767) 21264', '(0767) 23150', NULL, 'Jl. Syahbandar No. 4/B Bagan Siapiapi', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(74, 4, 'KSOP Bengkalis', NULL, 6, '(0766) 21033', '(0766) 21033', NULL, 'Jl. A. Yani No. 5 Rt. 01/Rw. 01 Bengkalis - Riau 28712', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(75, 4, 'KSOP Selat Panjang', NULL, 6, '(0763) 31134', '(0763) 33347', NULL, 'Jl. Pelabuhan No. 2 Selat Panjang Riau 28753', NULL, NULL, NULL, NULL, 'adpelsip@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(76, 6, 'KSOP Kuala Tungkal', NULL, 6, '(0742) 21012 (0742) 21532', '(0742) 21532', NULL, 'Jl. Kesejahteraan No. 86 Rt.19 Kuala Tungkal Kab. Tanjung Jabung Barat Jambi 36513', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(77, 6, 'KSOP Muara Sabak Jambi', NULL, 6, '-', '-', NULL, 'Jl. Syahbandar No. 5 Jambi', NULL, NULL, NULL, NULL, 'adpelsabak@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(78, 10, 'KSOP Tanjung Pandan', NULL, 6, '(0719) 21067', '(0719) 22949', NULL, 'Jl. Pelabuhan No. 1 Tanjung Pandan Belitung 33411', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(79, 10, 'KSOP Muntok', NULL, 6, '(0716) 21130', '(0716) 21521', NULL, 'Jl. Yos Sudarso No. 1 Muntok Bangka Belitung 33311', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(80, 9, 'KSOP Bakauheni', NULL, 6, '(0727) 331341', '(0727) 331116', NULL, 'Jl. Komp.Pelabuhan Penyeberangan Bakauheni Kab. Lampung Selatan 35592', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(81, 11, 'KSOP Marunda', NULL, 6, '(021) 4405367', '(021) 44853360', NULL, 'Jl. Jayapura No. 1 KBN Marunda Cilincing Jakarta Utara 141210', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(82, 11, 'KSOP Kepulauan Seribu', NULL, 6, '(021) 4357439', '(021) 43909882', NULL, 'Jl. Raya Ancol Baru No. 1 Tanjung Priok Jakarta Utara 14140', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(83, 11, 'KSOP Kalibaru', NULL, 6, '(021) 4407414  44833849', '(021) 4407414  44833849', NULL, 'Jl. Raya Pelabuhan Kalibaru No. 1 Jakarta Utara 14140', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(84, 11, 'KSOP Muara Karang/Muara Angke', NULL, 6, '(021) 6602236', '(021) 6602236', NULL, 'Jl. Dermaga No. 1 Pelabuhan Muara Angke Jakarta Utara 14450', NULL, NULL, NULL, NULL, 'angke_hubla@gmail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(85, 11, 'KSOP Muara Baru', NULL, 6, '(021) 98209489', '(021) 6694473', NULL, 'Jl. Muara Baru Ujung Penjaringan Jakarta Utara 14440', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(86, 16, 'KSOP Pasuruan', NULL, 6, '(0343) 424800', '(0343) 426826', NULL, 'Jl. Yos Sudarso No. 158 Pasuruan Jawa Timur 67123', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(87, 16, 'KSOP Panarukan', NULL, 6, '(0338) 672416', '-', NULL, 'Jl. Pelabuhan Kec. Panarukan Kab. Situbondo Jawa Timur 68351', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(88, 16, 'KSOP Kalianget', NULL, 6, '(0328) 662304', '(0328) 674333', NULL, 'Jl. Komplek Pelabuhan No. 02 Kalianget Sumenep Jawa Timur 69471', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(89, 17, 'KSOP Celukan Bawang', NULL, 6, '(0362) 93266', '(0362) 93266', NULL, 'Jl. Pelabuhan No. 36 Celukan Bawang Bali 81155', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(90, 18, 'KSOP Badas', NULL, 6, '(0371) 2706098', '(0371) 23785', NULL, 'Jl. Raya Pelabuhan Badas Sumbawa Besar - Nusa Tenggara Barat 84351', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(91, 19, 'KSOP Waingapu', NULL, 6, '(0387) 6141800', '(0387) 6141800', NULL, 'Jl. Nangamesi No. 11 Waingapu Nusa Tenggara Timur 87110', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(92, 19, 'KSOP Ende', NULL, 6, '(0381) 21162  21383', '(0381) 21162', NULL, 'Jl. Adi Sucipto Ippi Ende NTT 86316', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(93, 19, 'KSOP Laurentius Say Maumere', NULL, 6, '(0382) 21147', '(0382) 21407', NULL, 'Jl. R. E Marthadinata No. 7 Maumere - Nusa Tenggara Timur 86113', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(94, 19, 'KSOP Kalabahi', NULL, 6, '(0386) 21417', '(0386) 21417', NULL, 'Jl. R. E. Marthadinata No. 7 NTT 85813', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(95, 20, 'KSOP Telok Air', NULL, 6, '(0561) 566763', '(0561) 566763', NULL, 'Jl. Pelabuhan No. 1 Kec. Batu Ampar Kab. Kubu Raya Pontianak Kalimantan Barat 78385', NULL, NULL, NULL, NULL, 'adpel_telukair@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(96, 20, 'KSOP Sintete', NULL, 6, '(0562) 243213', '(0562) 243213', NULL, 'Jl. Pelabuhan No. 1 Sintete Kalimantan Barat 79453', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(97, 20, 'KSOP Ketapang', NULL, 6, '(0534) 32337', '(0534) 32337', NULL, 'Jl. Gajah Mada No. 542 Ketapang Kalimantan Barat 78851', NULL, NULL, NULL, NULL, 'adpel.ketapang@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(98, 21, 'KSOP Kuala Pembuang', NULL, 6, '(0538) 21214   21944', '(0538) 21214', NULL, 'Jl. AIS Nasution Kuala Pembuang Kalimantan Tengah 74211', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(99, 21, 'KSOP Samuda', NULL, 6, '(0531) 61078', '(0531) 61464', NULL, 'Jl. H. M. Noor No. 5 Rt.01/Rw.01 Samuda Kalimantan Tengah 74363', NULL, NULL, NULL, NULL, 'adpel_samuda@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(100, 21, 'KSOP Pulang Pisau', NULL, 6, '(0513) 61146', '-', NULL, 'Jl. Samudera No. 137 Rt. XIII Pulang Pisau Kalimantan Tengah 73561', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(101, 21, 'KSOP Pangkalan Bun', NULL, 6, '(0532) 21070', '(0532) 22857', NULL, 'Jl. Pangeran Antasari Komp. Pelabuhan Pangkalan Bun Kalimantan Tengah', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(102, 21, 'KSOP Sukamara', NULL, 6, '(0532) 26015', '(0532) 26015', NULL, 'Jl. Pelabuhan No. 14 Sukamara Kalimantan Tengah 74172', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(103, 21, 'KSOP Pegatan Mendawai', NULL, 6, '(0531) 2062400', ' (0531) 2062400', NULL, 'Jl. Merdeka No. 2 Pegatan Mendawai Kalimantan Tengah 74463', NULL, NULL, NULL, NULL, 'adpel_pegatanmdw@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(104, 31, 'KSOP Bandanaira', NULL, 6, '(0910) 21172', '(0910) 21172', NULL, 'Jl. Pelabuhan Bandanaira Maluku Tengah 97593', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(105, 34, 'KSOP Fakfak', NULL, 6, '(0956) 22600', '(0956) 22604', NULL, 'Jl. Izak Telussa No. 1 Fakfak Irian Jaya Barat 98611', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(106, 1, 'UPP Susoh', NULL, 4, '(0659) 91285', '(0659) 91285', NULL, 'Jl. Datuk Digaduang No. 167 Susoh Kab Aceh Barat Daya Propinsi NAD 23765', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(107, 1, 'UPP Singkil', NULL, 4, '(0658) 21374', '-', NULL, 'Jl. Utama No. 20 Singkil Nangroe Aceh Darusalam 24785', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(108, 1, 'UPP Tapak Tuan', NULL, 4, '(0656) 21337', '(0656) 21337', NULL, 'Jl. Merdeka No. 41 Tapak Tuan Aceh Selatan Nangroe Aceh Darusalam 23711', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(109, 1, 'UPP Sinabang', NULL, 4, '(0650) 21038', '(0650) 20134', NULL, 'Jl. Nasional No. 212 Sinabang NAD 23691', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(110, 1, 'UPP Idi', '', 4, '(0641) 21208', '(0641) 21208', NULL, 'Jl. Petuah Husain No. 1 Kec. Idie Rayeuk Kab. Aceh Timur 24454', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(111, 1, 'UPP Calang', NULL, 4, '(0654) 2210219', '(0654) 2210219', NULL, 'Jl. Pelabuhan No. 9 Calang Kab. Aceh Jaya Nangroe Aceh Darusalam 23654', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(112, 5, 'UPP Tanjung Uban', NULL, 2, '(0771) 483154', '(0771) 483154', NULL, 'Jl. Nusa Indah No. 1 Tanjung Uban Bintan Utara Kepulauan Riau 29152', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(113, 10, 'UPP Manggar', NULL, 2, '(0719) 91140', '(0719) 91686', NULL, 'Jl. Jend. Sudirman No. 74 Rt.27/12 Manggar Kab. Belitung Timur - Bangka Belitung 33472', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(114, 23, 'UPP Pelabuhan Tanjung Laut', NULL, 2, '(0548) 21568   5105441', '(0548) 21568', NULL, 'Jl. Pelabuhan No.28 Tanjung Laut Bontang Kalimantan Timur 75321', NULL, NULL, NULL, NULL, 'kanpel_tg.laut@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(115, 23, 'UPP Lhok Tuan', NULL, 2, '(0548) 41860', '(0548) 41860', NULL, 'Gedung Shipping Lt. 1 PT. Pupuk Kaltim - Bontang 75313', NULL, NULL, NULL, NULL, 'kanpeloktuan@gmail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(116, 30, 'UPP Baubau', NULL, 2, '(0402) 2821184', '(0402) 2824763', NULL, 'Jl. Yos Sudarso No. 5 Baubau Sultra 93711', NULL, NULL, NULL, NULL, 'kanpelbaus@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(117, 5, 'UPP Dabo Singkep', NULL, 3, '(0776) 21256', '(0776) 21256', NULL, 'Jl. Pelabuhan Rt.01 Rw. 03 Dabo SIngkep Kepulauan Riau 29171', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(118, 5, 'UPP Tanjung Batu Kundur', NULL, 3, '(0779) 21020   21001', '-', NULL, 'Jl. Pemuda No. 21 Tanjung Batu Kota Kec. Kundur Kab. Karimun Kepulauan Riau 29662', NULL, NULL, NULL, NULL, 'uoo_tanjungbatukundur@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(119, 6, 'UPP Nipah Panjang Jambi', NULL, 3, '-', '-', NULL, 'Jl. Pelabuhan No. 1 Kec. Nipah Panjang Kab. Tanjung Jabung Timur Jambi 36571', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(120, 14, 'UPP Pekalongan', NULL, 3, '(0285) 421046', '(0285) 421046', NULL, 'Jl.WR. Supratman No. 2A Pekalongan Jawa Tengah 51141', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(121, 23, 'UPP Tanah Grogot', NULL, 3, '(0543) 21040', '(0543) 21040', NULL, 'Jl. Negara Desa Pondong Kec. Kuaro Kab. Paser Kalimantan Timur 76211', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(122, 23, 'UPP Tanjung Santan', NULL, 3, '(0542) 7568263', '(0542) 7568182', NULL, 'Tanjung Santan Terminal Balikpapan P.O. BOX 276', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(123, 23, 'UPP Sangatta', NULL, 3, '(0549) 21989', '(0549) 25688', NULL, 'Jl. Pelabuhan No.6 Sangatta Selatan Kab. Kutai Timur Kalimantan Timur 75387', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(124, 25, 'UPP Tahuna Sulawesi Utara', NULL, 3, '(0432) 24460', '(0432) 21148', NULL, 'Jl.Pelabuhan Tahuna No. 1 Kab. Kepl. Sangihe Tahuna Sulawesi Utara 95851', NULL, NULL, NULL, NULL, 'kanpeltahuna@ymail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(125, 27, 'UPP Poso Sulawesi Tengah', NULL, 3, '(0452) 21620', '-', NULL, 'Jl. Pattimura No. 3 Poso Sulawesi Tengah 94616', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(126, 28, 'UPP Palopo', NULL, 3, '(0471) 22658', '-', NULL, 'Jl. Yos Sudarso No. 80 Palopo Rt.2/1 Sulawesi Selatan 91912', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(127, 30, 'UPP Pomalaa', NULL, 3, '(0405) 310241', '(0405) 310241', NULL, 'Jl. Protokol No. 1 Pomala Sulawesi Tenggara 93562', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(128, 31, 'UPP Namlea Maluku', NULL, 3, '(0913) 21849', '(0913) 21849', NULL, 'Jl. Dermaga Pelabuhan Namlea Kabupaten Buru Maluku 97571', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(129, 31, 'UPP Tulehu Maluku', NULL, 3, '(0911) 3303435', '-', NULL, 'Jl. Pelabuhan Hurnala Tulehu Maluku 97582', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(130, 31, 'UPP Tual Maluku', NULL, 3, '(0916) 22288', '-', NULL, 'Jl. Pidnang Armau No. 1 Komp. Pelabuhan Tual Maluku 97613', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(131, 31, 'UPP Saumlaki Maluku', NULL, 3, '(0918) 21279', '(0918) 21086', NULL, 'Jl. Pelabuhan Saumlaki Kec. Tanibar Selatan Kab. Maluku Tenggara Barat Saumlaki Maluku 97664', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(132, 32, 'UPP Tobelo Maluku Utara', NULL, 3, '(0924) 2621020', '(0924) 2621020', NULL, 'Komp. Pelabuhan Tobelo Kec. Tobelo Kab. Halmahera Utara - Maluku Utara 97762', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(133, 32, 'UPP Sanana Maluku Utara', NULL, 3, '-', '-', NULL, 'Jl. Komplek Pelabuhan Sanana Sanana Maluku Utara 97795', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(134, 33, 'UPP Amamapare', NULL, 3, '(0901) 425236    425324    425478', '(0901) 425535   425280   302008', NULL, 'Komp. Pelabuhan Amamapare Timika Papua 99900', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(135, 31, 'UPP Dobo Maluku', NULL, 3, '(0917) 21359', '(0917) 21904', NULL, 'Jl. Pelabuhan No. 3 Dobo Maluku 97662', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(136, 32, 'UPP Labuha/Babang', NULL, 3, '(0972) 21320', '-', NULL, 'Jl. Pelabuhan Labuha / Babang Kec. Bacan Timur Maluku Utara 97791', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(137, 2, 'UPP Teluk Dalam', NULL, 4, '(0630) 7321326', '(0630) 7321326', NULL, 'Jl. Imam Bonjol Komp. Dermaga Baru Kab. Nias Selatan Sumatera Utara 22865', NULL, NULL, NULL, NULL, 'kanpel_tdm@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(138, 2, 'UPP Sirombu', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan Angin No. 1 Sirombu Sumatera Utara 22863 Kotak Pos 62', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(139, 2, 'UPP Lahewa', NULL, 4, '-', '-', NULL, 'Jl. Bowo No. 1 Lahewa Sumatera Utara 22853', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(140, 2, 'UPP Pulau Tello', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan No. 1 Kec. Pulau Batu Kab. Nias Pulau Tello Sumatera Utara 22881', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(141, 3, 'UPP Pantai Cermin', NULL, 4, '(061) 7970102', '(061) 7970102', NULL, 'Jl. HT. Rizal Nurdin No. 465 Pantai Cermin 20987', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(142, 2, 'UPP Tanjung Beringin', NULL, 4, '(0621) 7343349', '(0621) 7343349', NULL, 'Jl. Nelayan No. 10 Tanjung Beringin Serdang Bedagai Sumatera Utara 20696', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(143, 2, 'UPP Pangkalan Dodek', NULL, 4, '(0622) 613117', '(0622) 613117', NULL, 'Jl. T. Amir Hamzah No. 58 Pangkalan Dodek Sumatera Utara 21258', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(144, 2, 'UPP Tanjung Tiram', NULL, 4, '(0623) 51248', '(0623) 451706', NULL, 'Jl. Merdeka No. 3 Tanjung Tiram Sumatera Utara 21253', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(145, 2, 'UPP Leidong', NULL, 4, '(0623) 71071', '(0623) 71371', NULL, 'Jl. Bondar No. 79 Tanjung Leidong Sumatera Utara 21475', NULL, NULL, NULL, NULL, 'upp.leidong@gmail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(146, 2, 'UPP Sarang Elang', NULL, 4, '-', '-', NULL, 'Jl. Raya Tanjung Sarang Elang Kab. Labuhan Batu Sumatera Utara 21472', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(147, 2, 'UPP Sikara-Kara/Natal', NULL, 4, '(0636) 7325071', '(0636) 7325071', NULL, 'Jl. Pelabuhan No. 28 Natal Kab. Mandailing Natal Sumatera Utara 22987', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(148, 2, 'UPP Sei Berombang', NULL, 4, '(0624) 571005', '(0624) 571505', NULL, 'Jl. Syahbandar No. 86 Sei Berombang Sumatera Utara 21473', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(149, 2, 'UPP Tanjung Pura', NULL, 4, '(061) 8960736', '(061) 8960736', NULL, 'Jl. Pembangunan No. 175 Tanjung Pura Sumatera Utara 20853', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(150, 2, 'UPP Pulau Kampai', NULL, 4, '(061) 8960736', '(061) 8960736', NULL, 'Jl. Pelabuhan No. 28 Pulau Kampai Kec. Pangkalan Susu Sumatera Utara 20858', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(151, 5, 'UPP Tarempa', NULL, 4, '(0772) 31148', '(0772) 31148', NULL, 'Jl. Pelabuhan Perintis No. 1 Tarempa Kec. Siantan Kab. Natuna Kepulauan Riau 29791', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(152, 5, 'UPP Senayang', NULL, 4, '-', '-', NULL, 'Jl. Nusantara No. 66 Kec. Senayang Kab. Lingga Kepulauan Riau 29873', NULL, NULL, NULL, NULL, 'azwaraja78@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(153, 4, 'UPP Kuala Gaung Riau', NULL, 4, '(0768) 7011069', '-', NULL, 'Jl. Pelabuhan Kuala Gaung No. 2 Riau', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(154, 4, 'UPP Sinaboi', NULL, 4, '-', '-', NULL, 'Jl. Utama No. 112 Sinaboi - Riau 28951', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(155, 4, 'UPP Tanjung Medang Riau', NULL, 4, '(0761) 857216', '-', NULL, 'Jl. Dt. Laksamana No. 03 Tanjung Medang Riau 28811', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(156, 4, 'UPP Panipahan Riau', NULL, 4, '(0624) 581464', '-', NULL, 'Jl. Bakti No. 14 Kec. Pasir Limau Kapas Kab. Rokan Hilir Panipahan Riau 28993', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(157, 4, 'UPP Batu Panjang Riau', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan No. 01 Rt.01/Rw.01 Batu Panjang Rupat Bengkalis Riau 28881', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(158, 4, 'UPP Sungai Guntung', NULL, 4, '(0779) 55161', '-', NULL, 'Jl. Yos Sudarso No. 1 Inhil - Riau 29255', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(159, 3, 'UPP Siuban', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan No. 1 Siuban Sumatera Barat 25392', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(160, 3, 'UPP Muara Siberut', NULL, 4, '(0759) 21073', '(0759) 21073', NULL, 'Jl. Raya Pelabuhan No. 1 Muara Siberut Kec. Siberut Selatan Kab. Kep. Mentawai Sumbar', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(161, 3, 'UPP Sikakap', NULL, 4, '(0759) 322006   322083', '(0759) 322083', NULL, 'Sikakap Kec. Pagai Utara Selatan Kab. Kepulauan Mentawai Sumatera Barat 25391', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(162, 6, 'UPP Kuala Mendahara', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan No. 1 Kec. Nipah Panjang Kab. Tarjab Timur Mendahara Hilir Jambi 36564', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(163, 8, 'UPP Malakoni-Enggano', NULL, 4, '(0736) 345468', '(0736) 345468', NULL, 'Jl. Dermaga Pelabuhan Melakoni Enggano Bengkulu Utara 38223', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(164, 8, 'UPP Linau Bintuhan', NULL, 4, '(0736) 345468', '(0736) 345468', NULL, 'Jl. Pelabuhan Linau Bintuhan Kab. Kaur Bengkulu 38565', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(165, 7, 'UPP Sungai Lumpur', NULL, 4, '(0711) 8454789', '(0711) 712404', NULL, 'Jl. Pelabuhan No. 1 Desa Sungai Lumpur Kab. OKI Sumatera Selatan', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(166, 10, 'UPP Toboali', NULL, 4, '(0718) 41151', '-', NULL, 'Jl. Pelabuhan No. 037 Toboali Bangka Selatan Kepulauan Bangka Belitung 33183', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(167, 9, 'UPP Menggala Lampung', NULL, 4, '(0721) 265726', '(0721) 265726', NULL, 'Jl. Raya Lintas Timur Cakat Nyenyek Menggala Kab. Tulang Bawang', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(168, 9, 'UPP Kota Agung Lampung', NULL, 4, '(0722) 21112', '(0722) 21924', NULL, 'Jl. Samudera Kec. Kota Agung Kab. Tanggamus Lampung 35384', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(169, 9, 'UPP Labuhan Maringgai', NULL, 4, '-', '-', NULL, 'Muara Gading Mas Labuhan Maringgai Lampung Timur', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(170, 9, 'UPP Mesuji Lampung', NULL, 4, '(0721) 7690023', '(0721) 7690023', NULL, 'Komp. Pelabuhan Mesuji Desa Sungai Sidang Kec. Rawajitu Utara Kab. Tulang Bawang Lampung', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(171, 9, 'UPP Teluk Betung', NULL, 4, '(0721) 482189', '(0721) 474057', NULL, 'Jl. Ikan Kembung No. 30 Teluk Betung Lampung 35223', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(172, 12, 'UPP Pelabuhan Ratu', NULL, 4, '(0266) 431060', '(0266) 431060', NULL, 'Jl. Siliwangi Kec. Pelabuhanratu Kab. Sukabumi Jawa Barat 43364', NULL, NULL, NULL, NULL, 'kanpel_pelratu@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(173, 12, 'UPP Pangandaran', NULL, 4, '(0265) 639421', '(0265) 639421', NULL, 'Jl. Kidang Pananjung No. 229 Pangandaran Jawa Barat 46396', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(174, 12, 'UPP Pamanukan', NULL, 4, '(0260) 522709', '(0260) 522709', NULL, 'Jl. Raya Pelelangan Blanakan Kab. Subang Jawa Barat 41259', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(175, 12, 'UPP Indramayu', NULL, 4, '(0234) 272326', '(0234) 272326', NULL, 'Jl. Pabean Udik No. 223 Indramayu Jabar 45219', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(176, 13, 'UPP Anyer Lor Banten', NULL, 4, '(0254) 601407', '(0254) 601407', NULL, 'Jl. Pelabuhan Paku Anyer Kab. Serang Banten 42166', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(177, 13, 'UPP Labuhan Banten', NULL, 4, '(0253) 801720', '(0253) 801720', NULL, 'Jl. Pelelangan Ikan No. 52 Desa Teluk Kec. Labuan Kab. Pandeglang Banten 42264', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(178, 13, 'UPP Karangantu Banten', NULL, 4, '(0254) 202140', '(0254) 202140', NULL, 'Jl. Bandar Banten No. 2 Karangantu Serang Banten 42191', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(179, 13, 'UPP Bojonegara Banten', NULL, 4, '(0254) 5750237', '(0254) 5750237', NULL, 'Jl. Raya Bojonegara Kp. Wadas Kec. Bojonegara Kab. Serang Banten 42454', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(180, 14, 'UPP Brebes Jawa Tengah', NULL, 4, '(0283) 870443', '(0283) 870443', NULL, 'Jl. TPI No. 15 Kluwut Brebes Jawa Tengah 52253', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(181, 14, 'UPP Jepara Jawa Tengah', NULL, 4, '(0291) 591039', '-', NULL, 'Jl. Patiunus Jepara Jawa Tengah 59416', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(182, 14, 'UPP Karimunjawa', NULL, 4, '(0297) 312233', '-', NULL, 'Jl. Pelabuhan No. 1 Rt.01/Rw.03 Karimunjawa Jepara Jawa Tengah 59455', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(183, 14, 'UPP Juwana', NULL, 4, '(0295) 471082', '(0295) 471082', NULL, 'Jl. Hang Tuah No. 472 Desa Bajomulyo Kec. Juwana Kab. Pati Jawa Tengah 59185', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(184, 14, 'UPP Rembang', NULL, 4, '(0295) 691221', '(0295) 691221', NULL, 'Jl. Pelabuhan No. 2 Rembang Rembang Jawa Tengah 59212', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(185, 14, 'UPP Batang Jawa Tengah', NULL, 4, '(0285) 392065', '(0285) 392065', NULL, 'Jl. Laks. Yos Sudarso Utara Batang Jawa Tengah 51213', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(186, 16, 'UPP Bawean Jawa Timur', NULL, 4, '(0325) 421022', '(0325) 421621', NULL, 'Jl. Beringin No. 1 Sangkapura Jawa Timur 61181', NULL, NULL, NULL, NULL, 'kpl.bwn@gmail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(187, 16, 'UPP Telagabiru', NULL, 4, '(031) 3071224', '(031) 3071224', NULL, 'Jl. Pelabuhan No. 60 Telagabiru Bangkalan Madura Jawa Timur 69156', NULL, NULL, NULL, NULL, 'kanpeltelagabiru@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(188, 16, 'UPP Branta Jawa Timur', NULL, 4, '(0324) 327032', '(0324) 327032', NULL, 'Jl. Raya Pelabuhan No. 1 Branta Pamekasan Jawa Timur 69371', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(189, 16, 'UPP Sapudi Jawa Timur', NULL, 4, '(0327) 811075', '-', NULL, 'Jl. Pelabuhan No. 1 Gayam Sapudi Kab. Sumenep Madura Jawa Timur 69483', NULL, NULL, NULL, NULL, 'upp.sapudi@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(190, 16, 'UPP Sapekan Jawa Timur', NULL, 4, '-', '-', NULL, '-', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(191, 16, 'UPP Kalbut', NULL, 4, '(0338) 677864', '(0338) 677864', NULL, 'Jl. Pelabuhan No. 1 Kalbut Situbondo Jawa Timur 68363', NULL, NULL, NULL, NULL, 'kantorpuukalbut@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(192, 16, 'UPP Masalembo', NULL, 4, '(0327) 611070', '-', NULL, 'Jl. Raya Pelabuhan No. 1 Masalembu Jawa Timur', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(193, 16, 'Brondong Jawa Timur', NULL, 4, '(0322) 662080', '(0322) 622814', NULL, 'Jl. Pelabuhan No.1 Sedayulawas Brondong Lamongan Jawa Timur 62263', NULL, NULL, NULL, NULL, 'kanpel_brondong@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(194, 16, 'UPP Ketapang Sumenep', NULL, 4, '(0333) 426181', '(0333) 417366', NULL, 'Jl. Jend. Gatot Subroto No. 2 Ketapang Banyuwangi Jawa Timur 68401', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(195, 17, 'Nusa Penida Bali', NULL, 4, '-', '-', NULL, 'Desa Ped Kec. Nusa Penida Kab. Klungkung Bali', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(196, 17, 'UPP Gilimanuk Bali', NULL, 4, '(0365) 61014', '(0365) 61259', NULL, 'Jl. Parkir Manuver No. 5 Gilimanuk Kab. Jembrana Bali 82253', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(197, 17, 'UPP Buleleng Bali', NULL, 4, '(0362) 27843   7005118', '(0362) 27843', NULL, 'Jl. Pelabuhan Sangsit Singaraja Buleleng Bali 81171', NULL, NULL, NULL, NULL, 'kanpel_buleleng@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(198, 18, 'UPP Labuhan Lombok', NULL, 4, '(0376) 21756', '(0376) 21756', NULL, 'Jl. Khayangan Labuhan Lombok Kec. Pringgabaya Kab. Lombok Timur Nusa Tenggara Barat 83655', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(199, 18, 'UPP Sape Nusa Tenggara Barat', NULL, 4, '(0374) 71367', '(0374) 71367', NULL, 'Jl. Pelabuhan Niaga No. 1 Sape - Bima Kab. Bima Nusa Tenggara Barat', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(200, 18, 'UPP Calabahi NTB', NULL, 4, '-', '-', NULL, 'Jl. Raya Pelabuhan Calabahi Kab. Dompu PO. Box. 123 Dompu Nusa Tenggara Barat 84200', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(201, 18, 'UPP Benete Nusa Tenggara Barat', NULL, 4, '(0372) 6700100', '(0372) 635550', NULL, 'Jl. Pelabuhan Benete Kec. Maluk Kab. Sumbawa Barat Nusa Tenggara Barat 84356', NULL, NULL, NULL, NULL, 'junhar.sybh_bnt@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(202, 18, 'UPP Pemenang/Tanjung', NULL, 4, '(0370) 6844884', '-', NULL, 'Jl. Pariwisata Gili Indah Pemenang Kab. Lombok Utara Pemenang NTB 83352', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(203, 19, 'UPP Larantuka NTT', NULL, 4, '(0383) 21075', '(0383) 21075', NULL, 'Jl. Niaga No. 71 Larantuka NTT 86216', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(204, 19, 'UPP Reo NTT', NULL, 4, '(0385) 61200', '(0385) 61213', NULL, 'Jl. Pelabuhan Reo Kec. Reo Kab. Manggarai Kediri Nusa Tenggara Timur 86592', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(205, 19, 'UPP Waikelo NTT', NULL, 4, '(0387) 24087', '-', NULL, 'Jl. Waikelo Kec. Luara Kab. Sumbawa Barat Kab. Waikelo Nusa Tenggara Timur 87254', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(206, 19, 'UPP Atapupu', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan No. 1 Atapupu Nusa Tenggara Timur', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(207, 19, 'UPP Baranusa NTT', NULL, 4, '-', '-', NULL, 'Komplek Pelabuhan Baranusa Nusa Tenggara Timur', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(208, 19, 'UPP Ba''a Rote', NULL, 4, '(0380) 871026', '(0380) 871026', NULL, 'Jl. Pelabuhan No. 1 Ba''a - Rote NTT', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(209, 19, 'UPP Seba NTT', NULL, 4, '(0380) 861039', '-', NULL, 'Jl. Pelabuhan No. 01 Kec. Sabu Barat Kab. Seburaijua Seba Nusa Tenggara Timur 85391', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(210, 19, 'UPP Maropokot Nusa Tenggara Timur', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan Marapokot No. 01 Maropokot Nusa Tenggara Timur 86472', NULL, NULL, NULL, NULL, 'sby_marapokot@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(211, 19, 'UPP Labuhan Bajo Nusa Tenggara Timur', NULL, 4, '(0385) 41139', '(0385) 41139', NULL, 'Jl. Yos Sudarso Labuhan Bajo NTT 86554', NULL, NULL, NULL, NULL, 'kanpel_bajo@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(212, 20, 'UPP Paloh/Sakura', NULL, 4, '(0562) 4395100', '(0562) 4395100', NULL, 'Komp. Pelabuhan Merbau Paloh Kab. Sambas Kalimantan Barat 79466', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(213, 20, 'UPP Telok Melano', NULL, 4, '-', '-', NULL, 'Jl. Gusti Aplos No. 93 Telok Melano Kalbar 78835', NULL, NULL, NULL, NULL, 'kanpel_melano@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(214, 20, 'UPP Kendawangan', NULL, 4, '(0534) 70202', '(0534) 70202', NULL, 'Jl. Rahadi Usman No. 1 Kec. Kendawangan Kalimantan Barat 78862', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(215, 21, 'UPP Kereng Bengkirai', NULL, 4, '(0536) 3226951', '-', NULL, 'Jl. Matal No. 8 Kereng Bengkirai Palangkaraya Kalimantan Tengah 73111', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(216, 22, 'UPP Sei Danau Satui', NULL, 4, '(0512) 61133', '(0512) 61133', NULL, 'Jl. Kuripan No. 94 Rt.02 Sei Danau Satui Kab. Tanah Bumbu Sei Danau Satui Kalimantan Selatan 72175', NULL, NULL, NULL, NULL, 'kanpelseidanau@yahoo.co.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(217, 22, 'UPP Tanjung Batu', NULL, 4, '-', '-', NULL, 'Jl. Pangeran Arga Kusuma No. 2 Kec. Kelumpang Tengah Kab. Kotabaru Tanjung Batu Kotabaru Kalimantan Selatan 72164', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(218, 22, 'UPP Sebuku Kalimantan Selatan', NULL, 4, '(0518) 70757', '(0518) 70757', NULL, 'Jl. Pelabuhan Samudera No. 126 Rt.3 Kec. Simpang Empat Kab. Tanah Bumbu Sebuku Kalimantan Selatan 72171', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL);
INSERT INTO `harbour_master` (`id`, `id_harbour_area`, `name`, `description`, `id_grade`, `phone1`, `phone2`, `phone3`, `address01`, `address02`, `address03`, `city`, `zipcode`, `email`, `web_address`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(219, 22, 'UPP Kintap', NULL, 4, '(0512) 61573', '-', NULL, 'Jl. Batu Anting Desa Kintap Kecil Kec. Kintap Kab. Tanah Laut Kintap Kalimantan Selatan 70883', NULL, NULL, NULL, NULL, 'kanpelkintap@gmail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(220, 23, 'UPP Sangkulirang', NULL, 4, '(0542) 593334', '(0542) 593334', NULL, 'Jl. Pelabuhan No. 20 Sangkulirang Kalimantan Timur 75384', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(221, 23, 'UPP Tanjung Selor', NULL, 4, '(0552) 21125', '(0552) 21125', NULL, 'Jl. Jend. Sudirman Rt.VIII No.16 Tanjung Selor Kalimantan Timur 77212', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(222, 23, 'UPP Sungai Nyamuk', NULL, 4, '(0556) 28031', '-', NULL, 'Jl. Dermaga No. 1 Sungai Nyamuk Kec. Sebatik Kab. Nunukan Kalimantan Timur 77483', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(223, 23, 'UPP Tanjung Redep', NULL, 4, '(0554) 21160', '(0554) 21160', NULL, 'Jl. P. Antasari No. 27 Rt.01/Rw.01 Tanjung Redeb Berau Kalimantan Timur 77312', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(224, 23, 'UPP Pulau Bunyu', NULL, 4, '(0551) 2055615', '(0551) 2055615', NULL, 'Jl. Dermaga No. 2 Pulau Bunyu Kec. Bunyu Kab. Bulunga Kalimantan Timur 77181', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(225, 23, 'UPP Kuala Samboja/Sebulu', NULL, 4, '(0542) 460114', '(0542) 460114', NULL, 'Jl. Balikpapan Handil II No. 2 Rt.V Kuala Samboja Kalimantan Timur 75277', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(226, 25, 'UPP Lirung Sulawesi Utara', NULL, 4, '(0433) 311433', '-', NULL, 'Komp. Pelabuhan Lirung Kec. Lirung Kab. Talaud Sulawesi Utara 95871', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(227, 25, 'UPP Ulu Siau', NULL, 4, '(0432) 310292', '(0432) 310292', NULL, 'Jl. Pelabuhan Rt.04/Rw.01 Ulu Siau Kec. Siau Timur Kab. Kep. Siau Tagulandang Biaro Sulawesi Utara', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(228, 25, 'UPP Belang', NULL, 4, '(0431) 77288', '-', NULL, 'Jl. Posokan No. 83 Jaga II Desa Borgo Kec. Belangbelang Kab. Minahasa Sulawesi Utara 95697', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(229, 25, 'UPP Kotabunan', NULL, 4, '(0431) 3177828', '-', NULL, 'Komp. Pelabuhan Kotabunan Kec. Kotabunan Kab. Bolmong Kotabunan Sulut 95782', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(230, 25, 'UPP Labuan Uki', NULL, 4, '(0434) 2626020', '-', NULL, 'Jl. Pelabuhan No.128 Desa Labuan Uki Kec. Lolak Kab. Bolaang Mongondow Sulawesi Utara 95761', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(231, 25, 'UPP Likupang', NULL, 4, '(0431) 8894284', '(0431) 8894284', NULL, 'Jl. Raya Manado Likupang Sulawesi Utara 95375', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(232, 26, 'UPP Kwandang Gorontalo', NULL, 4, '(0442) 310048', '(0442) 310048', NULL, 'Komplek Pelabuhan Desa Moluo Kec. Kwandang Gorontalo 96252', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(233, 26, 'UPP Tilamuta Gorontalo', NULL, 4, '(0443) 210829', '-', NULL, 'Jl. Pelabuhan No. 106 Kec. Tilamuta Kab. Boalemo Gorontalo 96263', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(234, 26, 'UPP Anggrek Gorontalo', NULL, 4, '(0435) 835107', '(0435) 835107', NULL, 'Komplek Pelabuhan Kec.Anggrek Kab. Gorontalo Anggrek Gorontalo Utara 96252', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(235, 27, 'UPP Leok Sulawesi Tengah', NULL, 4, '(0445) 211051', '(0445) 211094', NULL, 'Jl. Syarif Mansyur No. 356 Kel. Leok. 1 Kec. Biau Kab. Buol Sulawesi Tengah 94563', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(236, 27, 'UPP Ogoamas', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan No. 7 Ogoamas II Kab.Donggala Sulawesi Tengah', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(237, 27, 'UPP Parigi', NULL, 4, '(0450) 21004   21750', '-', NULL, 'Jl. Pelabuhan Parigi No.92 Kec. Parigi Kab. Donggala Parigi Palu - Sulawesi Tengah 94371', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(238, 27, 'UPP Moutong', NULL, 4, '-', '-', NULL, 'Sulawesi Tengah', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(239, 27, 'UPP Ampana', NULL, 4, '(0464) 21073', '(0464) 21073', NULL, 'Jl. Yos Sudarso No.25 Ampana Sulawesi Tengah 94683', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(240, 27, 'UPP Bunta', NULL, 4, '(0463) 21019', '(0463) 21500', NULL, 'Jl. RA. Kartini No.42 Bunta Sulawesi Tengah 94753', NULL, NULL, NULL, NULL, 'kampel.bunta@gmail.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(241, 27, 'UPP Pagimana', NULL, 4, '(0461) 731389', '(0461) 731389', NULL, 'Jl. Pelabuhan No.1 Kec. Pagimana Kab.Banggai Pagimana Sulawesi Tengah 94752', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(242, 27, 'UPP Banggai', NULL, 4, '(0462) 21150', '(0462) 21150', NULL, 'Komp. Pelabuhan Banggai Kab. Banggai Kepulauan Sulawesi Tengah 94791', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(243, 27, 'UPP Kolonedale', NULL, 4, '(0465) 21058', '(0465) 21765', NULL, 'Jl. Pelabuhan No. 1 Kolonedale Sulawesi Tengah 94671', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(244, 27, 'UPP Luwuk', NULL, 4, '(0461) 21941', '(0461) 22474', NULL, 'Jl. Yos Sudarso No.1 Kel. Simpong Kec. Luwuk Kab. Banggai Sulawesi Tengah 94715', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(245, 27, 'UPP Wani Sulawesi Tengah', NULL, 4, '(0451) 49140', '(0451) 49140', NULL, 'Jl. Pelabuhan No. 6 Wani Sulawesi Tengah 94352', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(246, 29, 'UPP Mamuju', NULL, 4, '(0426) 2323902', '-', NULL, 'Jl. Yos Sudarso No.2 Mamuju Kab. Mamuju Sulawesi Barat 91511', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(247, 29, 'UPP Majene Sulawesi Barat', NULL, 4, '(0422) 21057', '(0422) 21057', NULL, 'Jl. Ammana Wewang No.21 Kab. Majene Sulawesi Barat 91411', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(248, 28, 'UPP Malili', NULL, 4, '(0474) 321206', '-', NULL, 'Jl. Jend. Sudirman No. 16 Malili Kab. Luwu Timur Sulawesi Selatan 91981', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(249, 29, 'UPP Polewali', NULL, 4, '(0428) 21023', '(0428) 21023', NULL, 'Jl. Bahari I No. 1 Polewali Sulawesi Barat 91311', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(250, 28, 'UPP Awarenge/Barru', NULL, 4, '(0427) 2324411', '-', NULL, 'Jl. Pelabuhan No.57 Awarenge Kab. Barru Sulawesi Selatan 90752', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(251, 28, 'UPP Bulukumba', NULL, 4, '(0413) 81295', '(0413) 92685', NULL, 'Jl. Pelabuhan Leppe''e No. 1 Bulukumba Sulawesi Selatan 92511', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(252, 28, 'UPP Janeponto', NULL, 4, '(0419) 2425614', '(0419) 2425614', NULL, 'Jl. Dermaga Desa Bungeng Kec. Batang Kec. Jeneponto Sulawesi Selatan 92361', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(253, 28, 'UPP Selayar', NULL, 4, '(0414) 21038', '(0414) 21038', NULL, 'Jl. Pelabuhan No. 1 Benteng Selayar Sulawesi Selatan 92812', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(254, 28, 'UPP Jampea', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan No.1 Benteng Jampea Sulawesi Selatan', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(255, 28, 'UPP Sinjai', NULL, 4, '(0482) 21151', '(0482) 21151', NULL, 'Jl. Halim Perdana Kusuma Sinjai Sulawesi Selatan 92614', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(256, 29, 'UPP Belang-belang', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan Samudera No.3 Belang-belang Sulawesi Barat 91561', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(257, 28, 'UPP Bajoe', NULL, 4, '(0481) 21436', '(0481) 2911962', NULL, 'Jl. Pelabuhan No. 1 Bajoe Kab. Bone Sulawesi Selatan 92781', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(258, 28, 'UPP Siwa', NULL, 4, '(0472) 321004', '(0472) 321004', NULL, 'Jl. Pelabuhan No. 1 Kec. Pitumpauna Kab. Wajo Siwa Sulawesi Selatan 90992', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(259, 28, 'UPP Pattirobajo', NULL, 4, '(0481) 2001075', '(0481) 24029', NULL, 'Jl. Pelabuhan No.1 Kec. Sibulue Kab. Bone Sulawesi Selatan 92781', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(260, 28, 'UPP Biringkassi', NULL, 4, '(0410) 2316024   2316005', '-', NULL, 'Jl. Pelabuhan Biringkassi Pangkep Sulawesi Selatan 90651', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(261, 30, 'UPP Raha', NULL, 4, '(0403) 2521033', '(0403) 2521033', NULL, 'Jl. Pelabuhan No. 3 Raha Sulawesi Tenggara 93611', NULL, NULL, NULL, NULL, 'kanpel_raha@yahoo.com', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(262, 30, 'UPP Kolaka', NULL, 4, '(0405) 22583', '(0405) 21222', NULL, 'Jl. Dermaga No. 1 Komp. Pelabuhan Nusantara Kolaka Sulawesi Tenggara 93512', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(263, 30, 'UPP Langara', NULL, 4, '(0868) 12119', '-', NULL, 'Jl. Pelabuhan No.25 Langara 93393 P. Wawoni Kab. Konawe Sulawesi Tenggara', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(264, 31, 'UPP Amahai Maluku', NULL, 4, '(0914) 21351', '-', NULL, 'Jl. Christina Martha Tiahahu Komp. Pelabuhan Amahai Maluku 97511', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(265, 31, 'UPP Geser Maluku', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan Geser Maluku 97594', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(266, 32, 'UPP Laiwui Maluku Utara', NULL, 4, '-', '-', NULL, 'Komplek Pelabuhan Laiwui Maluku Utara 97792', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(267, 31, 'UPP Leksula Maluku', NULL, 4, '(0911) 343279', '-', NULL, 'Jl. Komplek Pelabuhan Leksula Kec. Leksula Kab. Buru Selatan - Ambon Maluku 97573', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(268, 31, 'UPP Wonreli Maluku', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan Wonreli Maluku 97653', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(269, 31, 'UPP Wahai Maluku', NULL, 4, '(0914) 81031', '-', NULL, 'Jl. Pelabuhan Teluk Hatiling Wahai Maluku 97557', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(270, 31, 'UPP Waisarisa Maluku', NULL, 4, '(0911) 362155', '(0911) 362155', NULL, 'Jl. Pelabuhan Waisarisa Maluku', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(271, 32, 'UPP Soa Sio Maluku Utara', NULL, 4, '(0921) 61447', '(0921) 61447', NULL, 'Jl. Yos Sudarso Kota Tidore Kepulauan 97813', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(272, 32, 'UPP Jailolo Maluku Utara', NULL, 4, '(0922) 3221243', '(0922) 2221524', NULL, 'Jl. Pelabuhan Jailolo Kab. Halmahera Barat Maluku Utara 97752', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(273, 32, 'UPP Daruba', NULL, 4, '(0923) 2221065', '(0923) 2221166', NULL, 'Jl. Komplek Pelabuhan Daruba Kab. Pulau Morotai Daruba Maluku Utara 97771', NULL, NULL, NULL, NULL, 'kupp.daruba@yahoocom', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(274, 32, 'UPP Buli Maluku Utara', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan Buli Kec. Maba Kab. Halmahera Maluku Utara', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(275, 32, 'UPP Pulau Gebe', NULL, 4, '-', '-', NULL, 'Jl. Pulau Fao Kec. Pulau Gebe Kab. Halmahera Tengah Komp. Pelabuhan Gebe Maluku Utara', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(276, 33, 'UPP Serui Papua', NULL, 4, '(0983) 31301', '(0983) 32980', NULL, 'Jl. Moh Hatta No.2 Serui Papua 98201', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(277, 33, 'UPP Waren Papua', NULL, 4, '-', '-', NULL, 'Jl. Inpres Waren Urei Faisei Kab. Waropen Papua', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(278, 33, 'UPP Nabire/Teluk Kimi', NULL, 4, '(0984) 21133', '-', NULL, 'Jl. Pintu Masuk Pelabuhan No. 1 Kab. Nabire Papua 98851', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(279, 33, 'UPP Kaimana Papua', NULL, 4, '(0957) 21131', '(0957) 21131', NULL, 'Jl. Pelabuhan Kaimana Irian Jaya Barat 98654', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(280, 33, 'UPP Sarmi Papua', NULL, 4, '(0966) 31252', '(0966) 31106', NULL, 'Jl. Brasildi No.1 Sarmi Kota Papua 99373', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(281, 34, 'UPP Korido Papua Barat', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan Korido Kec. Supiori Selatan Korido Papua', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(282, 34, 'UPP Oransbari', NULL, 4, '-', '-', NULL, 'Komplek Pelabuhan Oransbari Irian Jaya', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(283, 34, 'UPP Wasior Papua Barat', NULL, 4, '(0986) 215323', '-', NULL, 'Jl. Kuri Pasai No.1 Rt.1/Rw.1 Wasior Papua Barat 98362', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(284, 34, 'UPP Teminabuan Papua Barat', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan Teminabuan Kab. Sorong Selatan Irian Jaya Barat', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(285, 34, 'UPP Saonek Papua Barat', NULL, 4, '-', '-', NULL, 'Jl. Pelabuhan Saonek Kab. Irian Jaya Barat', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(286, 34, 'UPP Kokas Papua Barat', NULL, 4, '-', '-', NULL, 'Jl. Rumagesan Komp. Pelabuhan No. 1 Kab. Fak-fak Irian Jaya Barat', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(287, 34, 'UPP Pomako Papua Barat', NULL, 4, '-', '-', NULL, 'Komp. Pelabuhan Pomako Timika Papua 99910', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(288, 34, 'UPP Agats Papua Barat', NULL, 4, '(0902) 31042   31192', '-', NULL, 'Jl. Yos Sudarso Pelabuhan No. 1 Agats Kab. Asmat Papua', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(289, 34, 'UPP Bade Papua Barat', NULL, 4, '(0974) 21071', '-', NULL, 'Jl. Pelita No.32 Kec. Edeea Bade Kab. Merauke Bade Papua 99653', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(290, 34, 'UPP Bintuni Papua Barat', NULL, 4, '(0955) 31052   31053', '-', NULL, 'Jl. Raya Bintuni Manokwari Irian Jaya 98364', NULL, NULL, NULL, NULL, '-', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(291, 11, 'Atase Perhubungan Jepang Sub Perhubungan Laut', NULL, 1, '0123456789', '0123456789', NULL, 'Jepang', NULL, NULL, NULL, NULL, 'ryan_partigor@dephub.go.id', '-', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL),
(292, 11, 'Kantor Pusat', NULL, 1, '(021) 3811308', '(021) 3505681', NULL, 'Jl. Medan Merdeka Barat No. 8 Jakarta Pusat', NULL, NULL, NULL, NULL, 'ditkapel@dephub.go.id', 'ditkapel.dephub.go.id', NULL, '2015-12-09 12:06:04', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `major`
--

CREATE TABLE `major` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` varchar(100) NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` varchar(100) DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `major`
--

INSERT INTO `major` (`id`, `name`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Perkapalan', '', 'Active', '2015-12-09 15:10:00', 'System', NULL, NULL),
(2, 'Komputer', '', 'Active', '2015-12-09 15:10:06', 'System', NULL, NULL),
(3, 'Ekonomi', '', 'Active', '2015-12-09 15:10:12', 'System', NULL, NULL),
(4, 'Hukum', '', 'Active', '2015-12-09 15:10:18', 'System', NULL, NULL),
(5, 'Ilmu Komunikasi', '', 'Active', '2015-12-09 15:10:26', 'System', NULL, NULL),
(6, 'Magister Maritim', '', 'Active', '2015-12-09 15:10:33', 'System', '2016-02-09 13:25:47', 'System'),
(7, 'Magister Hukum', '', 'Active', '2015-12-09 15:10:40', 'System', NULL, NULL),
(10, 'Sistem Informasi', 'SI', 'Active', '2016-02-08 08:09:37', 'System', NULL, NULL),
(11, 'Nautika', 'Diploma IV Nautika', 'Active', '2016-02-09 13:24:24', 'System', NULL, NULL),
(12, 'Teknika', 'Diploma IV Teknika', 'Active', '2016-02-09 13:24:37', 'System', NULL, NULL),
(13, 'Ketatalaksanaan Angkutan Laut dan Kepelabuhanan', 'Diploma IV Ketatalaksanaan Angkutan Laut dan Kepelabuhanan (KALK)', 'Active', '2016-02-09 13:25:09', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapping_map_harbour_master`
--

CREATE TABLE `mapping_map_harbour_master` (
  `id` bigint(20) NOT NULL,
  `id_harbour_master` bigint(20) NOT NULL,
  `x` decimal(20,17) NOT NULL,
  `y` decimal(20,17) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mapping_map_harbour_master`
--

INSERT INTO `mapping_map_harbour_master` (`id`, `id_harbour_master`, `x`, `y`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(162, 292, '-89.14611656991661000', '-31.90612094210038000', '2016-01-10 14:10:59', 'System', NULL, NULL),
(163, 29, '-68.57646894752958000', '-45.50863464803104000', '2016-02-13 04:30:29', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapping_role_module`
--

CREATE TABLE `mapping_role_module` (
  `id` bigint(20) NOT NULL,
  `id_role` bigint(20) NOT NULL,
  `id_module` bigint(20) NOT NULL,
  `is_granted_to_view` tinyint(4) DEFAULT NULL,
  `is_granted_to_add` tinyint(4) DEFAULT NULL,
  `is_granted_to_edit` tinyint(4) DEFAULT NULL,
  `is_granted_to_delete` tinyint(4) DEFAULT NULL,
  `is_granted_to_download` tinyint(4) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapping_user_role`
--

CREATE TABLE `mapping_user_role` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_role` bigint(20) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `thread_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `messages`
--

INSERT INTO `messages` (`id`, `thread_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '<p>bvnvmn</p>\r\n', '2016-01-12 08:21:55', '2016-01-12 08:21:55'),
(2, 1, 1, '<p>Saya mau test</p>\r\n', '2016-01-13 06:59:04', '2016-01-13 06:59:04'),
(3, 1, 1, '<p>Dan jika itu OK</p>\r\n', '2016-01-13 06:59:10', '2016-01-13 06:59:10'),
(4, 1, 1, '<p>Lag dan lagi sampai selesai</p>\r\n', '2016-01-13 06:59:18', '2016-01-13 06:59:18'),
(5, 1, 1, '<p>dan seterusnya</p>\r\n', '2016-01-13 06:59:29', '2016-01-13 06:59:29'),
(6, 1, 1, '<p>Aku mau makan</p>\r\n', '2016-01-13 06:59:38', '2016-01-13 06:59:38'),
(7, 2, 1, '<p>test</p>\r\n', '2016-02-06 11:59:56', '2016-02-06 11:59:56'),
(8, 2, 40, '<p><strong>test juga</strong></p>\r\n', '2016-02-08 01:22:48', '2016-02-08 01:22:48'),
(9, 2, 38, '<p>ok</p>\r\n', '2016-02-11 05:33:03', '2016-02-11 05:33:03'),
(10, 2, 38, '<p>menunya apa ya?</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2016-02-11 05:33:20', '2016-02-11 05:33:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_05_19_151759_create_forum_table_categories', 1),
('2014_05_19_152425_create_forum_table_threads', 1),
('2014_05_19_152611_create_forum_table_posts', 1),
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_04_14_180344_create_forum_table_threads_read', 1),
('2015_07_22_181406_update_forum_table_categories', 1),
('2015_07_22_181409_update_forum_table_threads', 1),
('2015_07_22_181417_update_forum_table_posts', 1),
('2014_10_28_175635_create_threads_table', 2),
('2014_10_28_175710_create_messages_table', 2),
('2014_10_28_180224_create_participants_table', 2),
('2014_11_03_154831_add_soft_deletes_to_participants_table', 2),
('2014_11_10_083449_add_nullable_to_last_read_in_participants_table', 2),
('2014_11_20_131739_alter_last_read_in_participants_table', 2),
('2014_12_04_124531_add_softdeletes_to_threads_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `module`
--

CREATE TABLE `module` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `url` varchar(1000) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL,
  `modulcol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `module`
--

INSERT INTO `module` (`id`, `name`, `url`, `created_date`, `created_by`, `updated_date`, `updated_by`, `modulcol`) VALUES
(16, 'Doc_Type', 'AppHttpControllersDoc_TypeController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(17, 'Doc_Type', 'AppHttpControllersDoc_TypeController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(18, 'Doc_Type', 'AppHttpControllersDoc_TypeController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(19, 'Doc_Type', 'AppHttpControllersDoc_TypeController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(20, 'Doc_Type', 'AppHttpControllersDoc_TypeController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(21, 'Doc_Type', 'AppHttpControllersDoc_TypeController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(22, 'Doc_Type', 'AppHttpControllersDoc_TypeController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(23, 'Doc_Type', 'AppHttpControllersDoc_TypeController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(24, 'Faculty', 'AppHttpControllersFacultyController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(25, 'Faculty', 'AppHttpControllersFacultyController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(26, 'Faculty', 'AppHttpControllersFacultyController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(27, 'Faculty', 'AppHttpControllersFacultyController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(28, 'Faculty', 'AppHttpControllersFacultyController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(29, 'Faculty', 'AppHttpControllersFacultyController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(30, 'Faculty', 'AppHttpControllersFacultyController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(31, 'Faculty', 'AppHttpControllersFacultyController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(32, 'Major', 'AppHttpControllersMajorController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(33, 'Major', 'AppHttpControllersMajorController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(34, 'Major', 'AppHttpControllersMajorController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(35, 'Major', 'AppHttpControllersMajorController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(36, 'Major', 'AppHttpControllersMajorController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(37, 'Major', 'AppHttpControllersMajorController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(38, 'Major', 'AppHttpControllersMajorController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(39, 'Major', 'AppHttpControllersMajorController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(40, 'University', 'AppHttpControllersUniversityController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(41, 'University', 'AppHttpControllersUniversityController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(42, 'University', 'AppHttpControllersUniversityController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(43, 'University', 'AppHttpControllersUniversityController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(44, 'University', 'AppHttpControllersUniversityController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(45, 'University', 'AppHttpControllersUniversityController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(46, 'University', 'AppHttpControllersUniversityController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(47, 'University', 'AppHttpControllersUniversityController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(48, 'Training_Type', 'AppHttpControllersTraining_TypeController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(49, 'Training_Type', 'AppHttpControllersTraining_TypeController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(50, 'Training_Type', 'AppHttpControllersTraining_TypeController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(51, 'Training_Type', 'AppHttpControllersTraining_TypeController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(52, 'Training_Type', 'AppHttpControllersTraining_TypeController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(53, 'Training_Type', 'AppHttpControllersTraining_TypeController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(54, 'Training_Type', 'AppHttpControllersTraining_TypeController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(55, 'Training_Type', 'AppHttpControllersTraining_TypeController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(56, 'Emp_Grade', 'AppHttpControllersEmp_GradeController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(57, 'Emp_Grade', 'AppHttpControllersEmp_GradeController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(58, 'Emp_Grade', 'AppHttpControllersEmp_GradeController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(59, 'Emp_Grade', 'AppHttpControllersEmp_GradeController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(60, 'Emp_Grade', 'AppHttpControllersEmp_GradeController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(61, 'Emp_Grade', 'AppHttpControllersEmp_GradeController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(62, 'Emp_Grade', 'AppHttpControllersEmp_GradeController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(63, 'Emp_Grade', 'AppHttpControllersEmp_GradeController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(64, 'Harbour_Head', 'AppHttpControllersHarbour_HeadController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(65, 'Harbour_Head', 'AppHttpControllersHarbour_HeadController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(66, 'Harbour_Head', 'AppHttpControllersHarbour_HeadController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(67, 'Harbour_Head', 'AppHttpControllersHarbour_HeadController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(68, 'Harbour_Head', 'AppHttpControllersHarbour_HeadController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(69, 'Harbour_Head', 'AppHttpControllersHarbour_HeadController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(70, 'Harbour_Head', 'AppHttpControllersHarbour_HeadController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(71, 'Harbour_Head', 'AppHttpControllersHarbour_HeadController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(72, 'Harbour_Area', 'AppHttpControllersHarbour_AreaController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(73, 'Harbour_Area', 'AppHttpControllersHarbour_AreaController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(74, 'Harbour_Area', 'AppHttpControllersHarbour_AreaController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(75, 'Harbour_Area', 'AppHttpControllersHarbour_AreaController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(76, 'Harbour_Area', 'AppHttpControllersHarbour_AreaController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(77, 'Harbour_Area', 'AppHttpControllersHarbour_AreaController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(78, 'Harbour_Area', 'AppHttpControllersHarbour_AreaController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(79, 'Harbour_Area', 'AppHttpControllersHarbour_AreaController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(80, 'Harbour_Master', 'AppHttpControllersHarbour_MasterController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(81, 'Harbour_Master', 'AppHttpControllersHarbour_MasterController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(82, 'Harbour_Master', 'AppHttpControllersHarbour_MasterController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(83, 'Harbour_Master', 'AppHttpControllersHarbour_MasterController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(84, 'Harbour_Master', 'AppHttpControllersHarbour_MasterController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(85, 'Harbour_Master', 'AppHttpControllersHarbour_MasterController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(86, 'Harbour_Master', 'AppHttpControllersHarbour_MasterController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(87, 'Harbour_Master', 'AppHttpControllersHarbour_MasterController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(88, 'Harbour_Grade', 'AppHttpControllersHarbour_GradeController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(89, 'Harbour_Grade', 'AppHttpControllersHarbour_GradeController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(90, 'Harbour_Grade', 'AppHttpControllersHarbour_GradeController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(91, 'Harbour_Grade', 'AppHttpControllersHarbour_GradeController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(92, 'Harbour_Grade', 'AppHttpControllersHarbour_GradeController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(93, 'Harbour_Grade', 'AppHttpControllersHarbour_GradeController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(94, 'Harbour_Grade', 'AppHttpControllersHarbour_GradeController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(95, 'Harbour_Grade', 'AppHttpControllersHarbour_GradeController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(96, 'Shipping_Company', 'AppHttpControllersShipping_CompanyController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(97, 'Shipping_Company', 'AppHttpControllersShipping_CompanyController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(98, 'Shipping_Company', 'AppHttpControllersShipping_CompanyController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(99, 'Shipping_Company', 'AppHttpControllersShipping_CompanyController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(100, 'Shipping_Company', 'AppHttpControllersShipping_CompanyController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(101, 'Shipping_Company', 'AppHttpControllersShipping_CompanyController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(102, 'Shipping_Company', 'AppHttpControllersShipping_CompanyController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(103, 'Shipping_Company', 'AppHttpControllersShipping_CompanyController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(104, 'Functional_Title', 'AppHttpControllersFunctional_TitleController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(105, 'Functional_Title', 'AppHttpControllersFunctional_TitleController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(106, 'Functional_Title', 'AppHttpControllersFunctional_TitleController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(107, 'Functional_Title', 'AppHttpControllersFunctional_TitleController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(108, 'Functional_Title', 'AppHttpControllersFunctional_TitleController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(109, 'Functional_Title', 'AppHttpControllersFunctional_TitleController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(110, 'Functional_Title', 'AppHttpControllersFunctional_TitleController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(111, 'Functional_Title', 'AppHttpControllersFunctional_TitleController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(112, 'Structural_Title', 'AppHttpControllersStructural_TitleController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(113, 'Structural_Title', 'AppHttpControllersStructural_TitleController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(114, 'Structural_Title', 'AppHttpControllersStructural_TitleController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(115, 'Structural_Title', 'AppHttpControllersStructural_TitleController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(116, 'Structural_Title', 'AppHttpControllersStructural_TitleController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(117, 'Structural_Title', 'AppHttpControllersStructural_TitleController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(118, 'Structural_Title', 'AppHttpControllersStructural_TitleController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(119, 'Structural_Title', 'AppHttpControllersStructural_TitleController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(120, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@index', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(121, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@demo', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(122, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@get_emp_profile', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(123, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@filter_by_training_type', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(124, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@filter_by_graduate_date', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(125, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@filter_by_mi_date', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(126, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@filter_by_harbour', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(127, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@filter_by_education', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(128, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@list_only', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(129, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(130, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(131, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(132, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(133, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(134, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@get_photo', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(135, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@get_icon_photo', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(136, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@search', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(137, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(138, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@edit_profile', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(139, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@save_profile', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(140, 'Employee_Profile', 'AppHttpControllersEmployee_ProfileController@list_employee_by_harbour_id', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(141, 'Emp_Training', 'AppHttpControllersEmp_TrainingController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(142, 'Emp_Training', 'AppHttpControllersEmp_TrainingController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(143, 'Emp_Training', 'AppHttpControllersEmp_TrainingController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(144, 'Emp_Training', 'AppHttpControllersEmp_TrainingController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(145, 'Emp_Training', 'AppHttpControllersEmp_TrainingController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(146, 'Emp_Training', 'AppHttpControllersEmp_TrainingController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(147, 'Emp_Training', 'AppHttpControllersEmp_TrainingController@download', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(148, 'Emp_Education', 'AppHttpControllersEmp_EducationController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(149, 'Emp_Education', 'AppHttpControllersEmp_EducationController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(150, 'Emp_Education', 'AppHttpControllersEmp_EducationController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(151, 'Emp_Education', 'AppHttpControllersEmp_EducationController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(152, 'Emp_Education', 'AppHttpControllersEmp_EducationController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(153, 'Emp_Education', 'AppHttpControllersEmp_EducationController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(154, 'Emp_Education', 'AppHttpControllersEmp_EducationController@download', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(155, 'Emp_Profile_Training', 'AppHttpControllersEmp_Profile_TrainingController@add', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(156, 'Emp_Profile_Training', 'AppHttpControllersEmp_Profile_TrainingController@save', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(157, 'Emp_Profile_Training', 'AppHttpControllersEmp_Profile_TrainingController@edit', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(158, 'Emp_Profile_Training', 'AppHttpControllersEmp_Profile_TrainingController@update', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(159, 'Emp_Profile_Training', 'AppHttpControllersEmp_Profile_TrainingController@delete', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(160, 'Emp_Profile_Training', 'AppHttpControllersEmp_Profile_TrainingController@detail', '2016-01-14 21:49:45', 'System', NULL, NULL, NULL),
(161, 'Emp_Profile_Training', 'AppHttpControllersEmp_Profile_TrainingController@download', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(162, 'Emp_Profile_Educatio', 'AppHttpControllersEmp_Profile_EducationController@add', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(163, 'Emp_Profile_Educatio', 'AppHttpControllersEmp_Profile_EducationController@save', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(164, 'Emp_Profile_Educatio', 'AppHttpControllersEmp_Profile_EducationController@edit', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(165, 'Emp_Profile_Educatio', 'AppHttpControllersEmp_Profile_EducationController@update', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(166, 'Emp_Profile_Educatio', 'AppHttpControllersEmp_Profile_EducationController@delete', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(167, 'Emp_Profile_Educatio', 'AppHttpControllersEmp_Profile_EducationController@detail', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(168, 'Emp_Profile_Educatio', 'AppHttpControllersEmp_Profile_EducationController@download', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(169, 'Map', 'AppHttpControllersMapController@index', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(170, 'Map', 'AppHttpControllersMapController@manage', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(171, 'Map', 'AppHttpControllersMapController@list_marker', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(172, 'Map', 'AppHttpControllersMapController@save_location', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(173, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@Browse_Only', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(174, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@index', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(175, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@add', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(176, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@save', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(177, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@upload_document', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(178, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@delete', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(179, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@download', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(180, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@search', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(181, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@create_folder', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(182, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@rename_folder', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(183, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@remove_folder', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(184, 'Document_Explorer', 'AppHttpControllersDocument_ExplorerController@get_tree_dir', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(185, 'User', 'AppHttpControllersUserController@index', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(186, 'User', 'AppHttpControllersUserController@add', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(187, 'User', 'AppHttpControllersUserController@save', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(188, 'User', 'AppHttpControllersUserController@edit', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(189, 'User', 'AppHttpControllersUserController@update', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(190, 'User', 'AppHttpControllersUserController@delete', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(191, 'User', 'AppHttpControllersUserController@reset_password', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(192, 'User', 'AppHttpControllersUserController@save_password', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(193, 'Email', 'AppHttpControllersEmailController@index', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(194, 'email', 'AppHttpControllersemailController@send_email_all', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(195, 'email', 'AppHttpControllersemailController@view', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(196, 'email', 'AppHttpControllersemailController@success', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(197, 'Messages', 'AppHttpControllersMessagesController@index', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(198, 'Messages', 'AppHttpControllersMessagesController@create', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(199, 'Messages', 'AppHttpControllersMessagesController@store', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(200, 'Messages', 'AppHttpControllersMessagesController@show', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(201, 'Messages', 'AppHttpControllersMessagesController@update', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL),
(202, 'Messages', 'AppHttpControllersMessagesController@delete', '2016-01-14 21:49:46', 'System', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `participants`
--

CREATE TABLE `participants` (
  `id` bigint(20) NOT NULL,
  `thread_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `last_read` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `participants`
--

INSERT INTO `participants` (`id`, `thread_id`, `user_id`, `last_read`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2016-02-12 21:30:42', '2016-01-12 08:21:56', '2016-02-12 21:30:42', NULL),
(2, 2, 1, '2016-02-08 21:24:17', '2016-02-06 11:59:56', '2016-02-08 21:24:17', NULL),
(3, 2, 40, '2016-02-08 01:22:48', '2016-02-08 01:22:48', '2016-02-08 01:22:48', NULL),
(4, 2, 38, '2016-02-11 05:33:20', '2016-02-11 05:33:03', '2016-02-11 05:33:20', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `repo_document`
--

CREATE TABLE `repo_document` (
  `id` bigint(20) NOT NULL,
  `id_emp` bigint(20) DEFAULT NULL,
  `id_file` bigint(20) NOT NULL,
  `id_version` bigint(20) NOT NULL,
  `id_dir` bigint(20) DEFAULT NULL,
  `id_doc_type` bigint(20) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `date_upload` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `is_admin` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `name`, `is_admin`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'administrator', 1, '2015-12-11 06:56:58', 'System', NULL, NULL),
(3, 'mi', 0, '2015-12-11 06:57:34', 'System', NULL, NULL),
(4, 'pimpinan', 1, '2015-12-11 06:57:34', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) NOT NULL,
  `code` varchar(200) NOT NULL,
  `value` varchar(1000) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `code`, `value`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'directory.repository.document', '', '2015-12-11 21:58:12', 'System', NULL, NULL),
(2, 'directory.regulasi.document', 'C:\\xampp\\htdocs\\marine\\upload\\dokumen regulasi', '2015-12-11 21:58:35', 'System', NULL, NULL),
(3, 'directory.employee.photo', 'C:\\xampp\\htdocs\\marine\\upload\\photo', '2015-12-11 21:58:49', 'System', NULL, NULL),
(4, 'directory.employee.certificate', 'C:\\xampp\\htdocs\\marine\\upload\\employee_certificate', '2015-12-11 21:59:05', 'System', NULL, NULL),
(5, 'directory.employee.mi_card', 'C:\\xampp\\htdocs\\marine\\upload\\mi_card', '2015-12-11 21:59:10', 'System', NULL, NULL),
(6, 'directory.shipping_task.certificate', 'C:\\xampp\\htdocs\\marine\\upload\\shipping_task_certificate', '2016-01-31 05:21:05', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipping_company`
--

CREATE TABLE `shipping_company` (
  `id` bigint(20) NOT NULL,
  `reg_no` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone1` varchar(100) DEFAULT NULL,
  `phone2` varchar(100) DEFAULT NULL,
  `phone3` varchar(100) DEFAULT NULL,
  `address01` varchar(1000) DEFAULT NULL,
  `address02` varchar(1000) DEFAULT NULL,
  `address03` varchar(1000) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `email01` varchar(100) DEFAULT NULL,
  `email02` varchar(100) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `branch` varchar(250) DEFAULT NULL,
  `upper_id` bigint(20) DEFAULT NULL,
  `grade` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `shipping_company`
--

INSERT INTO `shipping_company` (`id`, `reg_no`, `name`, `phone1`, `phone2`, `phone3`, `address01`, `address02`, `address03`, `city`, `zipcode`, `email01`, `email02`, `location`, `branch`, `upper_id`, `grade`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(3, 'P.00001', 'PT. Daya Persada', '021-3102030', '021-3102040', '081213141516', 'Jakarta', 'Lombok', '', 'Jakarta', '10111', NULL, NULL, NULL, NULL, NULL, '1', 'Perusahaan Pelayaran Internasional', 'Active', '2015-12-05 18:20:59', 'System', '2015-12-26 20:36:24', 'System'),
(4, '12231351', 'PT SIndang Jaya', '0034782957', '', '', 'Jln kandang haur Eretan Wetan Indramayu', '', '', '', '', NULL, NULL, 'dom', 'Indramayu', 3, '2', 'OK', 'null', '2016-01-31 07:20:15', 'System', '2016-01-31 07:24:48', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `shipping_task`
--

CREATE TABLE `shipping_task` (
  `id` bigint(20) NOT NULL,
  `id_shipping_company` bigint(20) NOT NULL,
  `id_vessel` bigint(20) NOT NULL,
  `id_employee_profile` bigint(20) NOT NULL,
  `date_inspection` datetime NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `country` varchar(150) DEFAULT NULL,
  `id_harbour_master` bigint(20) NOT NULL,
  `id_certificate` bigint(20) DEFAULT NULL,
  `date_expired` datetime DEFAULT NULL,
  `id_certificate_file` bigint(20) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `shipping_task`
--

INSERT INTO `shipping_task` (`id`, `id_shipping_company`, `id_vessel`, `id_employee_profile`, `date_inspection`, `location`, `country`, `id_harbour_master`, `id_certificate`, `date_expired`, `id_certificate_file`, `description`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 3, 1, 1030, '2016-01-31 00:00:00', 'dom', 'Jakarta', 61, NULL, '2016-02-04 00:00:00', 28, '', '2016-01-31 04:17:46', 'System', '2016-01-31 05:42:00', 'System');

-- --------------------------------------------------------

--
-- Struktur dari tabel `status_notification`
--

CREATE TABLE `status_notification` (
  `id` bigint(20) NOT NULL,
  `code` varchar(100) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `message` varchar(500) NOT NULL,
  `last_read_date` datetime DEFAULT NULL,
  `url_action` varchar(1000) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `structural_title`
--

CREATE TABLE `structural_title` (
  `id` bigint(20) NOT NULL,
  `level` varchar(100) DEFAULT NULL,
  `upper_level` varchar(100) DEFAULT NULL,
  `upper_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `structural_title`
--

INSERT INTO `structural_title` (`id`, `level`, `upper_level`, `upper_id`, `name`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, '1', '1', NULL, 'Menteri Perhubungan', 'Menteri Perhubungan RI', 'Active', '2015-12-09 12:42:26', 'System', '2015-12-26 18:57:54', 'System'),
(2, '2', '1', 1, 'Direktur Jenderal Perhubungan Laut', 'Dirjen Hubla, Direktorat Jenderal Perhubungan Laut', 'Active', '2015-12-09 12:42:26', 'System', '2015-12-26 18:57:33', 'System'),
(3, '3', '1, 2', 2, 'Sekretaris Direktorat Jenderal Perhubungan Laut', 'Sesditjen Hubla, Direktorat Jenderal Perhubungan Laut', 'Active', '2015-12-09 12:42:26', 'System', '2015-12-26 18:58:11', 'System'),
(4, '4', '1, 2, 3', 2, 'Direktur Perkapalan dan Kepelautan', 'Dirkapel, Direktorat Jenderal Perhubungan Laut', 'Active', '2015-12-09 12:42:26', 'System', '2015-12-26 18:58:33', 'System'),
(5, '5', '1, 2, 3, 4', 4, 'Kasubdit Keselamatan Kapal', 'Kepala Sub Direktorat Keselamatan Kapal, Direktorat Perkapalan dan Kepelautan', 'Active', '2015-12-09 12:42:26', 'System', '2016-02-06 19:11:00', 'System'),
(6, '6', '1, 2, 3, 4, 5', 5, 'Kasi Keselamatan Kapal Barang dan Peti Kemas', 'Kepala Seksi Keselamatan Kapal Barang dan Peti Kemas', 'Active', '2015-12-09 12:42:26', 'System', '2016-02-06 19:57:33', 'System'),
(7, '6', '1, 2, 3, 4, 5', 5, 'Kasi Keselamatan Kapal Penumpang dan KPI', 'Kepala Seksi Keselamatan Kapal Penumpang dan Kapal Penangkap Ikan', 'Active', '2015-12-09 12:42:26', 'System', '2016-02-06 19:59:09', 'System'),
(8, '7', '5, 6, 7', 5, 'Staf', '', 'Active', '2015-12-09 12:42:26', 'System', '2015-12-26 18:59:33', 'System'),
(9, '4', '1, 2, 3', 2, 'Direktur Lalu Lintas Angkutan Laut', 'Direktur Direktorat Lalu Lintas Angkutan Laut', 'Active', '2016-02-06 19:07:22', 'System', NULL, NULL),
(10, '4', '1, 2, 3', 2, 'Kepala Syahbandar Utama Tanjung Priok', 'Kepala Syahbandar Utama Tanjung Priok', 'Active', '2016-02-06 19:42:28', 'System', NULL, NULL),
(11, '5', '1, 2, 3, 4', 2, 'Kepala KSOP Tanjungpinang', 'Kepala Kantor Syahbandar dan Otoritas Pelabuhan Tanjungpinang', 'Active', '2016-02-06 19:44:47', 'System', NULL, NULL),
(12, '5', '1, 2, 3, 4', 2, 'Kepala KSOP Gresik', 'Kepala Kantor Syahbandar dan Otoritas Pelabuhan Gresik', 'Active', '2016-02-06 19:46:42', 'System', NULL, NULL),
(13, '5', '1, 2, 3, 4', 4, 'Kasubdit RSG', 'Kepala Sub Direktorat Rancang Bangun, Stabilitas dan Garis Muat Kapal', 'Active', '2016-02-06 19:52:21', 'System', NULL, NULL),
(14, '5', '1, 2, 3, 4', 4, 'Kasubdit PMKKPLP', 'Kepala Sub Direktorat Pencemaran dan Manajemen Keselamatan Kapal dan Perlindungan Lingkungan di Perairan', 'Active', '2016-02-06 19:54:07', 'System', NULL, NULL),
(15, '5', '1, 2, 3, 4', 4, 'Kasubdit PPK', 'Kepala Sub Direktorat Pengukuran, Pendaftaran dan Kebangsaan Kapal', 'Active', '2016-02-06 19:54:41', 'System', NULL, NULL),
(16, '5', '1, 2, 3, 4', 4, 'Kasubdit Kepelautan', 'Kepala Sub Direktorat Kepelautan', 'Active', '2016-02-06 19:55:08', 'System', NULL, NULL),
(17, '6', '1, 2, 3, 4, 5', 13, 'Kasi RSG Kapal Barang dan Peti Kemas', 'Kepala Seksi Rancang Bangun, Stabilitas dan Garis Muat Kapal Barang dan Peti Kemas', 'Active', '2016-02-06 20:03:21', 'System', NULL, NULL),
(18, '6', '1, 2, 3, 4, 5', 13, 'Kasi RSG Kapal Penumpang dan KPI', 'Kepala Seksi Rancang Bangun, Stabilitas dan Garis Muat Kapal Penumpang dan Kapal Penangkap Ikan', 'Active', '2016-02-06 20:04:23', 'System', NULL, NULL),
(19, '6', '1, 2, 3, 4, 5', 14, 'Kasi PMKKBKP', 'Kepala Seksi Pencemaran dan Manajemen Keselamatan Kapal Barang dan Peti Kemas', 'Active', '2016-02-06 20:05:35', 'System', NULL, NULL),
(20, '6', '1, 2, 3, 4, 5', 14, 'Kasi PMKKPKPI', 'Kepala Seksi Pencemaran dan Manajemen Keselamatan Kapal Penumpang dan Kapal Penangkap Ikan', 'Active', '2016-02-06 20:07:39', 'System', NULL, NULL),
(21, '6', '1, 2, 3, 4, 5', 15, 'Kasi PPKBPK', 'Kepala Seksi Pengukuran, Pendaftaran dan Kebangsaan Kapal Barang dan Peti Kemas', 'Active', '2016-02-06 20:08:46', 'System', NULL, NULL),
(22, '6', '1, 2, 3, 4, 5', 15, 'Kasi PPKPKPI', 'Kepala Seksi Pengukuran, Pendaftaran dan Kebangsaan Kapal Penumpang dan Kapal Penangkap Ikan', 'Active', '2016-02-06 20:10:30', 'System', NULL, NULL),
(23, '6', '1, 2, 3, 4, 5', 16, 'Kasi PKSSTPM', 'Kepala Seksi Pengawakan Kapal dan Standardisasi Sertifikasi Pelaut Tingkat Manajerial', 'Active', '2016-02-06 20:11:58', 'System', NULL, NULL),
(24, '6', '1, 2, 3, 4, 5', 16, 'Kasi PKSSTPO', 'Kepala Seksi Pengawakan Kapal dan Standardisasi Sertifikasi Pelaut Tingkat Operasional', 'Active', '2016-02-06 20:13:30', 'System', NULL, NULL),
(25, '4', '1, 2, 3', 2, 'Direktur Kesatuan Penjagaan Laut dan Pantai', 'Direktur Direktorat Kesatuan Penjagaan Laut dan Pantai', 'Active', '2016-02-06 20:30:41', 'System', '2016-02-06 20:34:08', 'System'),
(26, '6', '1, 2, 3, 4, 5', 25, 'Kasi Direktorat KPLP', 'Kepala Seksi Direktorat Kesatuan Penjagaan Laut dan Pantai', 'Active', '2016-02-06 20:31:50', 'System', '2016-02-06 20:34:36', 'System'),
(27, '4', '1, 2, 3', 2, 'Kepala Bagian Perencanaan', 'Kepala Bagian Perencanaan Direktorat Jenderal Perhubungan Laut', 'Active', '2016-02-06 20:37:38', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `threads`
--

CREATE TABLE `threads` (
  `id` bigint(20) NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data untuk tabel `threads`
--

INSERT INTO `threads` (`id`, `subject`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'knklljj;j', '2016-01-12 08:21:55', '2016-01-13 06:59:38', NULL),
(2, 'Makan', '2016-02-01 13:30:57', '2016-02-11 05:33:20', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `training_type`
--

CREATE TABLE `training_type` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `refreshment` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `training_type`
--

INSERT INTO `training_type` (`id`, `name`, `description`, `refreshment`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Marine Inspector Type A', 'Diklat Marine Inspector Type A', 1, 1, '2015-12-09 14:51:13', 'System', '2016-02-13 02:53:39', 'System'),
(2, 'Marine Inspector Type B', 'Diklat Marine Inspector Type B', 1, 1, '2015-12-09 14:51:27', 'System', '2016-02-13 02:47:43', 'System'),
(3, 'Marine Inspector Type R', 'Diklat Marine Inspector Type R', 1, 1, '2015-12-09 14:51:36', 'System', '2016-02-13 02:47:50', 'System'),
(4, 'Auditor ISM Code', 'Diklat Auditor ISM Code', NULL, 1, '2015-12-09 14:51:44', 'System', '2016-02-06 16:00:44', 'System'),
(5, 'Auditor Sekolah', 'Diklat Auditor Sekolah', NULL, 1, '2015-12-09 14:51:54', 'System', '2016-02-06 16:01:21', 'System'),
(6, 'Auditor QSS', 'Diklat Auditor QSS', NULL, 1, '2015-12-09 14:52:26', 'System', '2016-02-06 16:01:33', 'System'),
(7, 'Pengukuran Kapal', 'Diklat Pengukuran Kapal', NULL, 1, '2015-12-09 14:52:34', 'System', '2016-02-06 16:05:52', 'System'),
(8, 'Surveyor Rancang Bangun', 'Diklat Surveyor Rancang Bangun Kapal', NULL, 1, '2015-12-09 14:52:44', 'System', '2016-02-06 16:02:07', 'System'),
(9, 'Surveyor MLC', 'Diklat Surveyor MLC', NULL, 1, '2015-12-09 14:52:54', 'System', '2016-02-06 16:02:48', 'System'),
(10, 'Pendaftaran dan Kebangsaan Kapal', 'Diklat Pendaftaran dan Kebangsaan Kapal', NULL, 1, '2016-02-06 15:58:28', 'System', NULL, NULL),
(11, 'TTBPL ANG. 1', 'Diklat Teknis Terpadu Bidang Perhubungan Laut Angkatan Pertama', NULL, 1, '2016-02-06 16:03:56', 'System', NULL, NULL),
(12, 'Port State Control (PSC)', 'Diklat Port State Control (PSC)', NULL, 1, '2016-02-06 16:04:55', 'System', NULL, NULL),
(13, 'Kesyahbandaran Klas A', 'Diklat Kesyahbandaran Klas A', NULL, 1, '2016-02-06 16:06:18', 'System', NULL, NULL),
(21, 'DOC - I', 'Diklat Pelaut Pemutakhiran Ahli Nautika Tingkat – I (Deck Officer Class - I)', 0, 1, '2016-02-14 16:09:56', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `university`
--

CREATE TABLE `university` (
  `id` bigint(20) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `university`
--

INSERT INTO `university` (`id`, `name`, `description`, `status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Universitas Indonesia', 'Universitas  Indonesia', 'Active', '2015-12-05 12:23:35', 'System', '2015-12-26 19:13:21', 'System'),
(2, 'Institut Teknologi Bandung', 'Institut Teknologi Bandung', 'Active', '2015-12-09 05:37:35', 'System', '2015-12-26 19:13:39', 'System'),
(3, 'Universitas Budi Luhur', 'Universitas Budi Luhur', 'Active', '2016-02-08 08:08:16', 'System', '2016-02-08 08:08:35', 'System'),
(4, 'Universitas Gadjah Mada', 'Universitas Gadjah Mada Yogyakarta', 'Active', '2016-02-09 12:46:59', 'System', NULL, NULL),
(5, 'Universitas Padjadjaran', 'Universitas Padjadjaran Bandung', 'Active', '2016-02-09 12:47:51', 'System', NULL, NULL),
(6, 'Universitas Gunadarma', 'Universitas Gunadarma Depok', 'Active', '2016-02-09 12:48:17', 'System', NULL, NULL),
(7, 'Universitas Brawijaya', 'Universitas Brawijaya Malang', 'Active', '2016-02-09 12:48:44', 'System', NULL, NULL),
(8, 'Institut Pertanian Bogor', 'Institut Pertanian Bogor', 'Active', '2016-02-09 12:49:11', 'System', NULL, NULL),
(9, 'Universitas Airlangga', 'Universitas Airlangga', 'Active', '2016-02-09 12:49:47', 'System', NULL, NULL),
(10, 'Universitas Diponegoro', 'Universitas Diponegoro Semarang', 'Active', '2016-02-09 12:50:12', 'System', NULL, NULL),
(11, 'Universitas Atma Jaya', 'Universitas Atma Jaya', 'Active', '2016-02-09 12:50:34', 'System', NULL, NULL),
(12, 'Institut Teknologi Sepuluh November', 'Institut Teknologi Sepuluh November', 'Active', '2016-02-09 12:51:03', 'System', NULL, NULL),
(13, 'Universitas Muhammadiyah Yogyakarta', 'Universitas Muhammadiyah Yogyakarta', 'Active', '2016-02-09 12:51:23', 'System', NULL, NULL),
(14, 'Universitas Sumatera Utara', 'Universitas Sumatera Utara (USU)', 'Active', '2016-02-09 12:51:56', 'System', NULL, NULL),
(15, 'STISI Telkom', 'Sekolah Tinggi Ilmu Seni Rupa dan Desain Indonesia Telkom', 'Active', '2016-02-09 12:53:13', 'System', NULL, NULL),
(16, 'Universitas Esa Unggul', 'Universitas Esa Unggul', 'Active', '2016-02-09 12:53:49', 'System', NULL, NULL),
(17, 'Universitas Sriwijaya', 'Universitas Sriwijaya', 'Active', '2016-02-09 12:54:08', 'System', NULL, NULL),
(18, 'Universitas Sebelas Maret', 'Universitas Sebelas Maret', 'Active', '2016-02-09 12:54:35', 'System', NULL, NULL),
(19, 'Universitas Islam Indonesia', 'Universitas Islam Indonesia (UII)', 'Active', '2016-02-09 12:55:01', 'System', NULL, NULL),
(20, 'Universitas Mercu Buana', 'Universitas Mercu Buana', 'Active', '2016-02-09 12:55:33', 'System', NULL, NULL),
(21, 'Universitas Negeri Malang', 'Universitas Negeri Malang', 'Active', '2016-02-09 12:55:57', 'System', NULL, NULL),
(22, 'Universitas Muhammadiyah Surakarta', 'Universitas Muhammadiyah Surakarta', 'Active', '2016-02-09 12:56:40', 'System', NULL, NULL),
(23, 'Universitas Hang Tuah', 'Universitas Hang Tuah', 'Active', '2016-02-09 12:57:01', 'System', NULL, NULL),
(24, 'Universitas Hasanuddin', 'Universitas Hasanuddin', 'Active', '2016-02-09 12:57:31', 'System', NULL, NULL),
(25, 'Universitas Andalas', 'Universitas Andalas', 'Active', '2016-02-09 12:57:50', 'System', NULL, NULL),
(26, 'Universitas Negeri Jakarta', 'Universitas Negeri Jakarta', 'Active', '2016-02-09 12:58:28', 'System', NULL, NULL),
(27, 'Universitas Udayana', 'Universitas Udayana', 'Active', '2016-02-09 12:58:43', 'System', NULL, NULL),
(28, 'Universitas Jenderal Soedirman', 'Universitas Jenderal Soedirman', 'Active', '2016-02-09 12:59:05', 'System', NULL, NULL),
(29, 'Institut Teknologi Nasional', 'Institut Teknologi Nasional', 'Active', '2016-02-09 12:59:24', 'System', NULL, NULL),
(30, 'Universitas Negeri Semarang', 'Universitas Negeri Semarang', 'Active', '2016-02-09 12:59:37', 'System', NULL, NULL),
(31, 'Universitas Lampung', 'Universitas Lampung', 'Active', '2016-02-09 12:59:59', 'System', NULL, NULL),
(32, 'Universitas Surabaya', 'Universitas Surabaya', 'Active', '2016-02-09 13:00:13', 'System', NULL, NULL),
(33, 'Institut Teknologi Medan', 'Institut Teknologi Medan', 'Active', '2016-02-09 13:00:36', 'System', NULL, NULL),
(34, 'Universitas Riau', 'Universitas Riau', 'Active', '2016-02-09 13:00:50', 'System', NULL, NULL),
(35, 'Universitas Syiah Kuala', 'Universitas Syiah Kuala', 'Active', '2016-02-09 13:01:11', 'System', NULL, NULL),
(36, 'Politeknik Negeri Malang', 'Politeknik Negeri Malang', 'Active', '2016-02-09 13:01:26', 'System', NULL, NULL),
(38, 'Universitas Ahmad Dahlan', 'Universitas Ahmad Dahlan', 'Active', '2016-02-09 13:02:30', 'System', NULL, NULL),
(39, 'Universitas Jember', 'Universitas Jember', 'Active', '2016-02-09 13:02:43', 'System', NULL, NULL),
(40, 'Institut Teknologi Telkom (STT Telkom)', 'Institut Teknologi Telkom (STT Telkom)', 'Active', '2016-02-09 13:03:10', 'System', NULL, NULL),
(41, 'Universitas Terbuka', 'Universitas Terbuka', 'Active', '2016-02-09 13:03:26', 'System', NULL, NULL),
(42, 'Universitas Negeri Papua', 'Universitas Negeri Papua', 'Active', '2016-02-09 13:03:43', 'System', NULL, NULL),
(43, 'UPN Veteran Yogyakarta', 'UPN Veteran Yogyakarta', 'Active', '2016-02-09 13:04:06', 'System', NULL, NULL),
(44, 'UPN Veteran Jakarta', 'UPN Veteran Jakarta', 'Active', '2016-02-09 13:04:20', 'System', NULL, NULL),
(45, 'Universitas Negeri Padang', 'Universitas Negeri Padang', 'Active', '2016-02-09 13:04:43', 'System', NULL, NULL),
(46, 'Universitas Al-Azhar', 'Universitas Al-Azhar', 'Active', '2016-02-09 13:05:05', 'System', NULL, NULL),
(47, 'Universitas Negeri Makassar', 'Universitas Negeri Makassar', 'Active', '2016-02-09 13:05:24', 'System', NULL, NULL),
(48, 'Universitas Sam Ratulangi', 'Universitas Sam Ratulangi', 'Active', '2016-02-09 13:05:44', 'System', NULL, NULL),
(49, 'UIN Syarif Hidayatullah Jakarta', 'UIN Syarif Hidayatullah Jakarta', 'Active', '2016-02-09 13:06:06', 'System', NULL, NULL),
(50, 'Universitas Lambung Mangkurat', 'Universitas Lambung Mangkurat', 'Active', '2016-02-09 13:06:22', 'System', NULL, NULL),
(51, 'Universitas Trisakti', 'Universitas Trisakti', 'Active', '2016-02-09 13:07:40', 'System', NULL, NULL),
(52, 'Universitas Bengkulu', 'Universitas Bengkulu', 'Active', '2016-02-09 13:07:57', 'System', NULL, NULL),
(53, 'Universitas Pasundan', 'Universitas Pasundan', 'Active', '2016-02-09 13:08:11', 'System', NULL, NULL),
(54, 'UIN Sunan Kalijaga Yogyakarta', 'UIN Sunan Kalijaga Yogyakarta', 'Active', '2016-02-09 13:08:32', 'System', NULL, NULL),
(55, 'Universitas Pancasila', 'Universitas Pancasila', 'Active', '2016-02-09 13:08:59', 'System', NULL, NULL),
(56, 'Universitas Bangka Belitung', 'Universitas Bangka Belitung', 'Active', '2016-02-09 13:09:30', 'System', NULL, NULL),
(58, 'Akademi Maritim Nusantara Malahayati Banda Aceh', 'Akademi Maritim Nusantara Malahayati Banda Aceh', 'Not Active', '2016-02-09 13:10:52', 'System', '2016-02-14 15:59:02', 'System'),
(59, 'BP2IP Aceh', 'Balai Pendidikan dan Pelatihan Ilmu Pelayaran Aceh', 'Active', '2016-02-09 13:11:09', 'System', '2016-02-09 13:14:13', 'System'),
(60, 'Akademi Maritim Indonesia Medan', 'Akademi Maritim Indonesia Medan', 'Active', '2016-02-09 13:11:24', 'System', NULL, NULL),
(62, 'Akademi Maritim Sapta Samudra', 'Akademi Maritim Sapta Samudra, Padang', 'Not Active', '2016-02-09 13:11:58', 'System', '2016-02-14 15:59:24', 'System'),
(63, 'Sekolah Tinggi Ilmu Maritim Mutiara Jaya', 'Sekolah Tinggi Ilmu Maritim Mutiara Jaya, Lampung Selatan', 'Active', '2016-02-09 13:12:26', 'System', NULL, NULL),
(64, 'BP2IP Tangerang', 'Balai Pendidikan dan Pelatihan Ilmu Pelayaran Tangerang', 'Active', '2016-02-09 13:13:02', 'System', NULL, NULL),
(66, 'BP3IP Jakarta', 'Balai Besar Pendidikan, Penyegaran dan Peningkatan Ilmu Pelayaran, Jakarta', 'Active', '2016-02-09 13:13:50', 'System', NULL, NULL),
(67, 'Balai Pendidikan dan Pelatihan Transportasi Laut', 'Balai Pendidikan dan Pelatihan Transportasi Laut', 'Active', '2016-02-09 13:14:43', 'System', NULL, NULL),
(68, 'Sekolah Tinggi Ilmu Maritim AMI', 'Sekolah Tinggi Ilmu Maritim AMI, Jakarta', 'Active', '2016-02-09 13:14:58', 'System', NULL, NULL),
(69, 'Akademi Maritim Nasional Jakarta Raya', 'Akademi Maritim Nasional Jakarta Raya', 'Not Active', '2016-02-09 13:15:11', 'System', '2016-02-14 15:58:32', 'System'),
(71, 'Akademi Maritim Pembangunan', 'Akademi Maritim Pembangunan', 'Not Active', '2016-02-09 13:15:32', 'System', '2016-02-14 15:59:15', 'System'),
(73, 'Akademi Maritim Suaka Bahari', 'Akademi Maritim Suaka Bahari, Cirebon', 'Not Active', '2016-02-09 13:16:00', 'System', '2016-02-14 15:59:46', 'System'),
(74, 'Politeknik Ilmu Pelayaran Semarang', 'Politeknik Ilmu Pelayaran Semarang', 'Active', '2016-02-09 13:16:19', 'System', NULL, NULL),
(75, 'Politeknik Maritim Negeri Indonesia', 'Politeknik Maritim Negeri Indonesia, Semarang', 'Active', '2016-02-09 13:16:34', 'System', NULL, NULL),
(76, 'Sekolah Tinggi Maritim dan Transport AMNI Semarang', 'Sekolah Tinggi Maritim dan Transport AMNI Semarang', 'Active', '2016-02-09 13:16:49', 'System', NULL, NULL),
(77, 'Akademi Maritim Nusantara Cilacap', 'Akademi Maritim Nusantara Cilacap', 'Not Active', '2016-02-09 13:17:00', 'System', '2016-02-14 15:58:54', 'System'),
(78, 'Akademi Pelayaran Nasional Surakarta', 'Akademi Pelayaran Nasional Surakarta, Solo', 'Not Active', '2016-02-09 13:17:14', 'System', '2016-02-14 16:00:05', 'System'),
(79, 'Akademi Pelayaran Niaga Indonesia', 'Akademi Pelayaran Niaga Indonesia, Semarang', 'Active', '2016-02-09 13:17:28', 'System', NULL, NULL),
(80, 'Akademi Maritim Yogyakarta', 'Akademi Maritim Yogyakarta', 'Not Active', '2016-02-09 13:17:42', 'System', '2016-02-14 15:59:57', 'System'),
(83, 'Politeknik Perkapalan Negeri Surabaya', 'Politeknik Perkapalan Negeri Surabaya', 'Active', '2016-02-09 13:18:22', 'System', NULL, NULL),
(84, 'Akademi Maritim Nusantara Banjarmasin', 'Akademi Maritim Nusantara Banjarmasin', 'Not Active', '2016-02-09 13:18:36', 'System', '2016-02-14 15:58:43', 'System'),
(85, 'Akademi Maritim Indonesia Samarinda', 'Akademi Maritim Indonesia Samarinda', 'Not Active', '2016-02-09 13:18:47', 'System', '2016-02-14 15:58:00', 'System'),
(86, 'Politeknik Ilmu Pelayaran (PIP) Balikpapan', 'Politeknik Ilmu Pelayaran (PIP) Balikpapan', 'Active', '2016-02-09 13:18:57', 'System', NULL, NULL),
(87, 'Akademi Maritim Indonesia Bitung', 'Akademi Maritim Indonesia Bitung', 'Not Active', '2016-02-09 13:19:11', 'System', '2016-02-14 15:57:33', 'System'),
(88, 'Politeknik Ilmu Pelayaran Makassar', 'Politeknik Ilmu Pelayaran Makassar', 'Active', '2016-02-09 13:19:20', 'System', NULL, NULL),
(89, 'BP3IP Barombong', 'Balai Pendidikan dan Pelatihan Ilmu Pelayaran Barombong, Makassar', 'Active', '2016-02-09 13:19:42', 'System', '2016-02-09 13:21:19', 'System'),
(90, 'Akademi Maritim Indonesia AIPI', 'Akademi Maritim Indonesia AIPI, Makassar', 'Active', '2016-02-09 13:19:57', 'System', '2016-02-14 12:13:20', 'System'),
(91, 'Akademi Maritim Indonesia Veteran', 'Akademi Maritim Indonesia Veteran, Makassar', 'Active', '2016-02-09 13:20:11', 'System', NULL, NULL),
(92, 'Akademi Maritim Maluku', 'Akademi Maritim Maluku, Ambon', 'Not Active', '2016-02-09 13:20:41', 'System', '2016-02-14 15:58:20', 'System'),
(93, 'BP3IP Sorong', 'Balai Pendidikan dan Pelatihan Ilmu Pelayaran Sorong', 'Active', '2016-02-09 13:21:05', 'System', NULL, NULL),
(94, 'Sekolah Tinggi Ilmu Pelayaran', 'Sekolah Tinggi Ilmu Pelayaran, Jakarta', 'Active', '2016-02-09 13:33:19', 'System', NULL, NULL),
(95, 'Akademi Maritim Aceh Darussalam', 'Akademi Maritim Aceh Darussalam, NAD', 'Not Active', '2016-02-14 15:44:20', 'System', NULL, NULL),
(96, 'Akademi Maritim Belawan, Medan', 'Akademi Maritim Belawan, Medan', 'Not Active', '2016-02-14 15:45:48', 'System', NULL, NULL),
(97, 'Akademi Maritim Guna Nusantara', 'Akademi Maritim Guna Nusantara, Cilegon', 'Not Active', '2016-02-14 15:47:15', 'System', NULL, NULL),
(98, 'Akademi Maritim Djadajat', 'Akademi Maritim Djadajat', 'Not Active', '2016-02-14 15:52:00', 'System', NULL, NULL),
(99, 'Akademi Maritim Cirebon', 'Akademi Maritim Cirebon, Cirebon', 'Not Active', '2016-02-14 15:52:58', 'System', NULL, NULL),
(100, 'Akademi Maritim Ganesha Yogyakarta', 'Akademi Maritim Ganesha Yogyakarta', 'Not Active', '2016-02-14 15:55:31', 'System', NULL, NULL),
(101, 'Akademi Ketatalaksanaan Pelayaran Niaga Bahtera', 'Akademi Ketatalaksanaan Pelayaran Niaga Bahtera, Yogyakarta', 'Not Active', '2016-02-14 15:55:53', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `last_login` varchar(250) DEFAULT NULL,
  `ip_address` varchar(250) DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL,
  `id_employee` bigint(20) DEFAULT NULL,
  `id_role` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(250) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `last_login`, `ip_address`, `remember_token`, `id_employee`, `id_role`, `is_active`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'root', '$2y$10$HR29mKRAJ/.QjK989rUm.O1aLydf9DLAQWOr55n0cpX2praKmoyEi', 'ahmalidi@gmail.com', NULL, NULL, 'tQUzP5laPbbmst8UaG0WizH8Vuv4xMUW4xRK8Og0B6jvb7XidX5LxZMqH4dN', NULL, 1, 1, '2015-12-10 22:03:10', 'System', '2016-01-12 17:54:05', 'System'),
(4, '196705111998081001', '$2y$10$yyeby109hanbb9gSz0n/7.CKrN5D886bJhwvhUSgfCxz1p0pa5/BG', 'victor_vikki@dephub.go.id', NULL, NULL, NULL, 1027, 4, 1, '2016-02-06 14:20:56', 'System', NULL, NULL),
(5, '197311252007121001', '$2y$10$qHgrKAjhp43oZo.ke/1pcOMw3Rs0hgsGkBGWcSEcO6iqvUUx4ozby', 'diaz.saputra@dephub.go.id', NULL, NULL, NULL, 1032, 4, 1, '2016-02-06 14:22:00', 'System', NULL, NULL),
(6, '197604302007121001', '$2y$10$aCBaLBrFW6Mp59/s6.r5Je4jPs5UqU8YFwOV/l/OfSMtfxGxUgZdK', 'irsal_isa@dephub.go.id', NULL, NULL, NULL, 1039, 3, 1, '2016-02-06 14:22:56', 'System', NULL, NULL),
(7, '197407082009121001', '$2y$10$GVFCw3x3CyxyGx7uqgXXFeJZHQSmgBVtIkkSYnC6LiwhpA8gcwbvK', 'ferro_hidayah@dephub.go.id', NULL, NULL, NULL, 1040, 3, 1, '2016-02-06 14:23:51', 'System', NULL, NULL),
(8, '197508082009121003', '$2y$10$lo80SpOIvehOlQg1FK87IOBKFdvVBvOhALLvBgJp3DuRmDKut95RG', 'dikki_zulkarnaen@dephub.go.id', NULL, NULL, NULL, 1041, 3, 1, '2016-02-06 14:30:54', 'System', NULL, NULL),
(9, '197503222003122001', '$2y$10$ndcl7pWotYETBdblX7Ixeu3im76RIk2No/4ycjcBppSvKx/lavhJm', 'astri_wahyuningsih@dephub.go.id', NULL, NULL, NULL, 1042, 3, 1, '2016-02-06 14:31:26', 'System', NULL, NULL),
(10, '197101192010121001', '$2y$10$6qU0z3kqZvkolTChIOQ3wOGz3GSVobWXXIgLbW458bz7she.a29KW', 'asdiamani@dephub.go.id', NULL, NULL, NULL, 1043, 3, 1, '2016-02-06 14:32:06', 'System', '2016-02-06 14:32:16', 'System'),
(11, '196909211998091001', '$2y$10$9GyoDe9BOB7L2OL0KYxY2.d7G6iac.eJ/G7rzSfuKIFxLVQRUpAH6', 'hendi_prasetyo@dephub.go.id', NULL, NULL, NULL, 1044, 3, 1, '2016-02-06 14:33:04', 'System', NULL, NULL),
(12, '197911302007121001', '$2y$10$FrwqyWWDr.HC00mtXJaNzui9IrTZRiXNLdpXP7lh.G0Du0myCxprG', 'adib_zuhairi@dephub.go.id', NULL, NULL, NULL, 1045, 3, 1, '2016-02-06 14:34:32', 'System', NULL, NULL),
(13, '198501172009121007', '$2y$10$juEBOY0tW2rlJMJRNFocgOKxIpSWjBlQdcLnYz.ixv6UmqYhk2Ym6', 'totok_joni@dephub.go.id', NULL, NULL, NULL, 1046, 3, 1, '2016-02-06 14:35:12', 'System', NULL, NULL),
(14, '198703222010121001', '$2y$10$RBIm0vdsen8EL.CY3t9iZOSs2neWiYM1LrpH9u/eE.im0FajeLfhe', 'aulia_akbar@dephub.go.id', NULL, NULL, 'LSsg6XtlMhslZeImvzaq0i3VLcduhbKguSztdim3JJi0gEQCzDUxQniYmoUX', 1047, 3, 1, '2016-02-06 14:35:55', 'System', NULL, NULL),
(15, '197604152008121002', '$2y$10$mazm.tfRk/kJsNPeNP0N/.bIorQFkZnbJAZ8iSaoLD8.h2Owi4wxW', 'rudin@dephub.go.id', NULL, NULL, NULL, 1048, 3, 1, '2016-02-06 14:36:32', 'System', NULL, NULL),
(16, '197901162007121001', '$2y$10$jmUToiW.zPghjrC9o7DruOEDsHQIk6oKYCpPGjXiZEqGzjfRGUR.W', 'helmi_candra@dephub.go.id', NULL, NULL, NULL, 1049, 3, 1, '2016-02-06 14:37:24', 'System', NULL, NULL),
(17, '197804142006041001', '$2y$10$Mrwvfc.nmblWpbsGXjUFUeEUuzNXVEYegmZxcNadC4R19y34zOfbu', 'iwan_dwi@dephub.go.id', NULL, NULL, NULL, 1050, 3, 1, '2016-02-06 14:38:01', 'System', NULL, NULL),
(18, '197412072007121001', '$2y$10$ZhFuhR4p1OLSdY6F3R8CYOZ08PnZLU73ib3.5iPR2aWyLCfp2LmqS', 'raden_deddy@dephub.go.id', NULL, NULL, NULL, 1051, 3, 1, '2016-02-06 14:38:37', 'System', NULL, NULL),
(19, '198404042009121002', '$2y$10$GHnPcWh.BV7t6G/1V01SLOWGF72inMhT4q2MliZ/aF9JoQpm3BHgS', 'hotman_naibaho@dephub.go.id', NULL, NULL, NULL, 1052, 3, 1, '2016-02-06 14:39:24', 'System', NULL, NULL),
(20, '197608172006042001', '$2y$10$161/7qLFZIFIL1m0s8aqReY3C8JdnpH.0P2K0sqvS4ki0eNsTYtgq', 'erlina_setyaningtyas@dephub.go.id', NULL, NULL, NULL, 1054, 3, 1, '2016-02-06 14:40:08', 'System', NULL, NULL),
(21, '197809192007122001', '$2y$10$FF9qJhirpYA23SH3PS.sFeDgriUCGlm.bMzh.awjkqRMbgRHgB4qK', 'sri_suharni@dephub.go.id', NULL, NULL, NULL, 1055, 3, 1, '2016-02-06 14:40:39', 'System', NULL, NULL),
(22, '197111082006041002', '$2y$10$erKi0b6keBSvdaZfetlWgO6j5A/a0F3dblVi5sEhrYFzdAaSB06kO', 'semuel_tandipasau@dephub.go.id', NULL, NULL, NULL, 1056, 3, 1, '2016-02-06 14:41:18', 'System', NULL, NULL),
(23, '197507012007121001', '$2y$10$Dxn78Tq5.rSlvSbWeUQCGOZvbfUH/S1VzzaWXfZqrpdzElZ6wdOnm', 'andri_muhamad@dephub.go.id', NULL, NULL, NULL, 1057, 3, 1, '2016-02-06 14:42:00', 'System', NULL, NULL),
(24, '197911232010122001', '$2y$10$YR3Lg5.R0Y1UdnS1XFTSceysjBejmnyzG9EKhCUcmz6J66EpShcle', 'dini_novitasari@dephub.go.id', NULL, NULL, NULL, 1058, 3, 1, '2016-02-06 14:42:34', 'System', NULL, NULL),
(25, '197707052009121003', '$2y$10$d10izIG56nJg6Es83Gk2/./QIm1aktor6hZVlAoA2b4Iv3a78ULCG', 'ari_wibowo0507@dephub.go.id', NULL, NULL, NULL, 1059, 3, 1, '2016-02-06 14:44:24', 'System', NULL, NULL),
(26, '198002232006042001', '$2y$10$niM8LlMhN1pxJPPVN3.KAuq7lBD7g9/CDRK24QiL1xAuYEzm0QWCS', 'febriyanti@dephub.go.id', NULL, NULL, NULL, 1060, 3, 1, '2016-02-06 14:45:04', 'System', NULL, NULL),
(27, '197512151998081001', '$2y$10$3ThWwdPN/dyesOwE2psZ6eeduhATChKeEoYavEAXn.rnjTi2i450S', 'fadli_suryanto@dephub.go.id', NULL, NULL, NULL, 1061, 3, 1, '2016-02-06 14:45:35', 'System', NULL, NULL),
(28, '197512232010121001', '$2y$10$xJNgQaZvvWMd21xnZhaPxe4G/cUX/Xt/RmPobvKaCQ2OO87293M0a', 'delsy_analisa@dephub.go.id', NULL, NULL, NULL, 1062, 3, 1, '2016-02-06 14:46:13', 'System', NULL, NULL),
(29, '197605122007121002', '$2y$10$PuhzLpY9uSLAoVzJsju.x.2ARnUCIkxniS.8ImgnALAcs5RfM.64O', 'faisal_rahman1205@dephub.go.id', NULL, NULL, NULL, 1063, 3, 1, '2016-02-06 14:46:58', 'System', NULL, NULL),
(30, '198101122007121002', '$2y$10$evRCKVkJq89FrQQuBC9xg.7zPN8lDiX.yTh/iE/gj6AiNNWQKTwEq', 'richard_christian@dephub.go.id', NULL, NULL, NULL, 1065, 3, 1, '2016-02-06 14:47:38', 'System', NULL, NULL),
(31, '196909071998031001', '$2y$10$XVJAlQYC6t91zL5r1MUAwuRGjvfBA16DF3wm9OkGDTiDgH1I3tF1y', 'alwan_rasyid@dephub.go.id', NULL, NULL, NULL, 1066, 3, 1, '2016-02-06 14:48:17', 'System', NULL, NULL),
(32, '197706162008121001', '$2y$10$cbrWLDiYRvwolb.MU49lXeChVPHZiuw8L4s2zw7KMJuG9Y2PxiMNi', 'suganjar@dephub.go.id', NULL, NULL, NULL, 1067, 3, 1, '2016-02-06 14:48:52', 'System', NULL, NULL),
(33, '197709202005021001', '$2y$10$lRekPLvo179NQy/36hPKKepGrxRv/xkbZk9TVGEjUB1QBxxyUwbJ6', 'stephanus_risdiyanto@dephub.go.id', NULL, NULL, NULL, 1069, 3, 1, '2016-02-06 14:49:28', 'System', NULL, NULL),
(34, '198303222008121002', '$2y$10$LYe3Pd6wivIww/p7lv67VeB2AyxFuXnAHUEkz/Qqu33xKKXICWqyC', 'rachmat_antonius@dephub.go.id', NULL, NULL, NULL, 1070, 3, 1, '2016-02-06 14:50:07', 'System', NULL, NULL),
(35, '197906062010121002', '$2y$10$1vdDSeG8xdHOaYaiE4cuX.gss/Y2cTgdixVCxPWQoYOlIFLzh5f.K', 'ilham_akbar0606@dephub.go.id', NULL, NULL, NULL, 1072, 3, 1, '2016-02-06 14:50:40', 'System', NULL, NULL),
(36, '197811062005022001', '$2y$10$vgEDVXZGr8XqYsYEkX8qqesvHcWasUYi5XfZBBuTJJnrKWCUmfaGW', 'renta_novaliana@dephub.go.id', NULL, NULL, 'ukFfYBJeH2kudKG7FCT1p7yF3iUbFnmIvhx9NGdQAWzniubuJATZ9YwBfGWN', 1077, 4, 1, '2016-02-06 14:57:32', 'System', NULL, NULL),
(37, '197902282008121001', '$2y$10$8s67YI168X2BLpFpisSS..mz/IFrbOs99d9XL4SUq3y1WjROe1t1q', 'ari_sasmito@dephub.go.id', NULL, NULL, NULL, 1078, 3, 1, '2016-02-06 18:26:58', 'System', NULL, NULL),
(38, '197603152002121001', '$2y$10$ybu8O3dYbhHBTiTXmCO8RuU.GTBjaOepFJqyzzRIXRJgSP61YOFFW', 'amir_makbul@dephub.go.id', NULL, NULL, NULL, 1079, 3, 1, '2016-02-06 18:27:43', 'System', NULL, NULL),
(39, '198005292006041001', '$2y$10$MlqE31w6bcZPhcUB5PN78uqnjO93HTZk1oDr9CHUbEWZCYf9Q0kH.', 'ahmad_ridho@dephub.go.id', NULL, NULL, NULL, 1080, 3, 1, '2016-02-06 18:29:47', 'System', NULL, NULL),
(40, 'satya', '$2y$10$hkKP9uyysj31oPUHvkK7AeOZh4FQbStgVtCOkvE015fM53IkvXmm6', 'satya109@gmail.com', NULL, NULL, 'oMbgGyy80YIjdjKf5Zw2lFVe8bMHxICOa7UOoP7GQRdCohO4dw8AsPhdOGWB', 1081, 3, 1, '2016-02-08 08:20:01', 'System', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `vessel`
--

CREATE TABLE `vessel` (
  `id` bigint(20) NOT NULL,
  `vessel_name` varchar(100) DEFAULT NULL,
  `vessel_type` varchar(100) DEFAULT NULL,
  `call_sign` varchar(100) DEFAULT NULL,
  `imo_number` varchar(100) DEFAULT NULL,
  `mmsi_number` varchar(100) DEFAULT NULL,
  `certificate` varchar(100) DEFAULT NULL,
  `id_shipping_company` bigint(20) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `vessel`
--

INSERT INTO `vessel` (`id`, `vessel_name`, `vessel_type`, `call_sign`, `imo_number`, `mmsi_number`, `certificate`, `id_shipping_company`, `status`, `description`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'dfsafasfsafsaf', '11111', '2222', '3333', '789787', '', NULL, 'null', '', '2016-01-30 14:55:45', 'System', '2016-01-31 05:49:40', 'System');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_document`
--
CREATE TABLE `vw_document` (
`id` bigint(20)
,`id_emp` bigint(20)
,`id_dir` bigint(20)
,`id_file` bigint(20)
,`title` varchar(100)
,`date_upload` datetime
,`description` varchar(1000)
,`status` varchar(100)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`nip` varchar(100)
,`name` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_employee_profile`
--
CREATE TABLE `vw_employee_profile` (
`id` bigint(20)
,`nip` varchar(100)
,`name` varchar(250)
,`birth_place` varchar(100)
,`birth_date` datetime
,`religion` varchar(100)
,`sex` varchar(5)
,`npwp` varchar(100)
,`marital_status` varchar(100)
,`hobby` varchar(250)
,`id_photo` bigint(20)
,`phone1` varchar(100)
,`phone2` varchar(100)
,`phone3` varchar(100)
,`email01` varchar(250)
,`email02` varchar(250)
,`description` varchar(1000)
,`status` varchar(100)
,`status_desc` varchar(500)
,`id_functional` bigint(20)
,`id_structural` bigint(20)
,`struct_bidang` varchar(1000)
,`struct_seksi` varchar(1000)
,`id_harbour_master` bigint(20)
,`id_grade` bigint(20)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`address` text
,`provinsi` varchar(100)
,`kodepos` varchar(100)
,`functional_name` varchar(250)
,`functional_description` varchar(1000)
,`functional_level` varchar(100)
,`structural_name` varchar(100)
,`structural_description` varchar(1000)
,`structural_level` varchar(100)
,`harbour_master_name` varchar(150)
,`harbour_master_description` varchar(1000)
,`id_harbour_area` bigint(20)
,`harbour_area_name` varchar(250)
,`harbour_area_description` varchar(1000)
,`emp_grade_name` varchar(150)
,`emp_grade_description` varchar(1000)
,`jenis_mi` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_emp_education`
--
CREATE TABLE `vw_emp_education` (
`id` bigint(20)
,`id_university` bigint(20)
,`id_faculty` bigint(20)
,`id_major` bigint(20)
,`id_education_level` bigint(20)
,`id_emp` bigint(20)
,`graduate_year` int(11)
,`graduate_date` datetime
,`location` varchar(150)
,`professor` varchar(150)
,`id_certificate_file` bigint(20)
,`description` varchar(1000)
,`status` varchar(100)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`university_name` varchar(250)
,`faculty_name` varchar(250)
,`major_name` varchar(150)
,`education_level` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_emp_profile_education`
--
CREATE TABLE `vw_emp_profile_education` (
`id` bigint(20)
,`nip` varchar(100)
,`name` varchar(250)
,`birth_place` varchar(100)
,`birth_date` datetime
,`religion` varchar(100)
,`sex` varchar(5)
,`npwp` varchar(100)
,`marital_status` varchar(100)
,`hobby` varchar(250)
,`id_photo` bigint(20)
,`phone1` varchar(100)
,`phone2` varchar(100)
,`phone3` varchar(100)
,`email01` varchar(250)
,`email02` varchar(250)
,`description` varchar(1000)
,`status` varchar(100)
,`status_desc` varchar(500)
,`id_functional` bigint(20)
,`id_structural` bigint(20)
,`struct_bidang` varchar(1000)
,`struct_seksi` varchar(1000)
,`id_harbour_master` bigint(20)
,`id_grade` bigint(20)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`address` text
,`provinsi` varchar(100)
,`kodepos` varchar(100)
,`functional_name` varchar(250)
,`functional_description` varchar(1000)
,`functional_level` varchar(100)
,`structural_name` varchar(100)
,`structural_description` varchar(1000)
,`structural_level` varchar(100)
,`harbour_master_name` varchar(150)
,`harbour_master_description` varchar(1000)
,`id_harbour_area` bigint(20)
,`harbour_area_name` varchar(250)
,`harbour_area_description` varchar(1000)
,`emp_grade_name` varchar(150)
,`emp_grade_description` varchar(1000)
,`university_name` varchar(250)
,`faculty_name` varchar(250)
,`major_name` varchar(150)
,`education_level` varchar(250)
,`graduate_date` datetime
,`graduate_year` int(11)
,`id_university` bigint(20)
,`id_faculty` bigint(20)
,`id_major` bigint(20)
,`id_education_level` bigint(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_emp_profile_training`
--
CREATE TABLE `vw_emp_profile_training` (
`id` bigint(20)
,`nip` varchar(100)
,`name` varchar(250)
,`birth_place` varchar(100)
,`birth_date` datetime
,`religion` varchar(100)
,`sex` varchar(5)
,`npwp` varchar(100)
,`marital_status` varchar(100)
,`hobby` varchar(250)
,`id_photo` bigint(20)
,`phone1` varchar(100)
,`phone2` varchar(100)
,`phone3` varchar(100)
,`email01` varchar(250)
,`email02` varchar(250)
,`description` varchar(1000)
,`status` varchar(100)
,`status_desc` varchar(500)
,`id_functional` bigint(20)
,`id_structural` bigint(20)
,`struct_bidang` varchar(1000)
,`struct_seksi` varchar(1000)
,`id_harbour_master` bigint(20)
,`id_grade` bigint(20)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`address` text
,`provinsi` varchar(100)
,`kodepos` varchar(100)
,`functional_name` varchar(250)
,`functional_description` varchar(1000)
,`functional_level` varchar(100)
,`structural_name` varchar(100)
,`structural_description` varchar(1000)
,`structural_level` varchar(100)
,`harbour_master_name` varchar(150)
,`harbour_master_description` varchar(1000)
,`id_harbour_area` bigint(20)
,`harbour_area_name` varchar(250)
,`harbour_area_description` varchar(1000)
,`emp_grade_name` varchar(150)
,`emp_grade_description` varchar(1000)
,`date_taken_from` datetime
,`date_taken_to` datetime
,`graduate_date` datetime
,`graduate_year` int(11)
,`certificate_no` varchar(100)
,`mi_card` varchar(100)
,`mi_date` datetime
,`training_description` varchar(1000)
,`refreshment` varchar(100)
,`training_status` varchar(100)
,`training_type_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_emp_training`
--
CREATE TABLE `vw_emp_training` (
`id` bigint(20)
,`id_employee_profile` bigint(20)
,`id_training` bigint(20)
,`training_title` varchar(250)
,`date_taken_from` datetime
,`date_taken_to` datetime
,`graduate_date` datetime
,`graduate_year` int(11)
,`certificate_no` varchar(100)
,`mi_card` varchar(100)
,`mi_date` datetime
,`id_certificate_file` bigint(20)
,`id_mi_card_file` bigint(20)
,`location` varchar(250)
,`description` varchar(1000)
,`refreshment` varchar(100)
,`status` varchar(100)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`training_type_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_emp_type_training_flatten`
--
CREATE TABLE `vw_emp_type_training_flatten` (
`id_employee_profile` bigint(20)
,`jenis_mi` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_faculty`
--
CREATE TABLE `vw_faculty` (
`id` bigint(20)
,`id_university` bigint(20)
,`name` varchar(250)
,`description` varchar(1000)
,`status` varchar(100)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`university_name` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_harbour_head`
--
CREATE TABLE `vw_harbour_head` (
`id` bigint(20)
,`id_harbour` bigint(20)
,`id_emp` bigint(20)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`harbour_master_name` varchar(150)
,`harbour_master_address` varchar(1000)
,`employee_nip` varchar(100)
,`employee_name` varchar(250)
,`employee_sex` varchar(5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_harbour_master`
--
CREATE TABLE `vw_harbour_master` (
`id` bigint(20)
,`id_harbour_area` bigint(20)
,`name` varchar(150)
,`description` varchar(1000)
,`id_grade` bigint(20)
,`phone1` varchar(100)
,`phone2` varchar(100)
,`phone3` varchar(100)
,`address01` varchar(1000)
,`address02` varchar(1000)
,`address03` varchar(1000)
,`city` varchar(100)
,`zipcode` varchar(100)
,`email` varchar(250)
,`web_address` varchar(100)
,`status` varchar(100)
,`created_date` datetime
,`created_by` varchar(100)
,`updated_date` datetime
,`updated_by` varchar(100)
,`harbour_area_name` varchar(250)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_mapping_role_module`
--
CREATE TABLE `vw_mapping_role_module` (
`id` bigint(20)
,`id_role` bigint(20)
,`id_module` bigint(20)
,`is_granted_to_view` tinyint(4)
,`is_granted_to_add` tinyint(4)
,`is_granted_to_edit` tinyint(4)
,`is_granted_to_delete` tinyint(4)
,`is_granted_to_download` tinyint(4)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`role_name` varchar(250)
,`is_admin` tinyint(4)
,`module_name` varchar(250)
,`module_url` varchar(1000)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_mapping_user_role`
--
CREATE TABLE `vw_mapping_user_role` (
`id` bigint(20)
,`id_user` bigint(20)
,`id_role` bigint(20)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`username` varchar(250)
,`role_name` varchar(250)
,`is_admin` tinyint(4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_repo_document`
--
CREATE TABLE `vw_repo_document` (
`id` bigint(20)
,`id_emp` bigint(20)
,`id_file` bigint(20)
,`id_version` bigint(20)
,`id_dir` bigint(20)
,`id_doc_type` bigint(20)
,`title` varchar(150)
,`description` varchar(1000)
,`date_upload` varchar(100)
,`status` varchar(100)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`nip` varchar(100)
,`name` varchar(250)
,`doc_type_name` varchar(150)
,`doc_type_description` varchar(1000)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user`
--
CREATE TABLE `vw_user` (
`id` bigint(20)
,`username` varchar(250)
,`password` varchar(250)
,`email` varchar(250)
,`last_login` varchar(250)
,`ip_address` varchar(250)
,`remember_token` varchar(250)
,`id_employee` bigint(20)
,`id_role` bigint(20)
,`is_active` tinyint(4)
,`created_date` datetime
,`created_by` varchar(250)
,`updated_date` datetime
,`updated_by` varchar(250)
,`role_name` varchar(250)
,`is_admin` tinyint(4)
,`employee_nip` varchar(100)
,`employee_name` varchar(250)
,`employee_sex` varchar(5)
,`employee_email` varchar(250)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_document`
--
DROP TABLE IF EXISTS `vw_document`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_document`  AS  select `d`.`id` AS `id`,`d`.`id_emp` AS `id_emp`,`d`.`id_dir` AS `id_dir`,`d`.`id_file` AS `id_file`,`d`.`title` AS `title`,`d`.`date_upload` AS `date_upload`,`d`.`description` AS `description`,`d`.`status` AS `status`,`d`.`created_date` AS `created_date`,`d`.`created_by` AS `created_by`,`d`.`updated_date` AS `updated_date`,`d`.`updated_by` AS `updated_by`,`e`.`nip` AS `nip`,`e`.`name` AS `name` from (`document` `d` left join `employee_profile` `e` on((`d`.`id_emp` = `e`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_employee_profile`
--
DROP TABLE IF EXISTS `vw_employee_profile`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_employee_profile`  AS  select `ep`.`id` AS `id`,`ep`.`nip` AS `nip`,`ep`.`name` AS `name`,`ep`.`birth_place` AS `birth_place`,`ep`.`birth_date` AS `birth_date`,`ep`.`religion` AS `religion`,`ep`.`sex` AS `sex`,`ep`.`npwp` AS `npwp`,`ep`.`marital_status` AS `marital_status`,`ep`.`hobby` AS `hobby`,`ep`.`id_photo` AS `id_photo`,`ep`.`phone1` AS `phone1`,`ep`.`phone2` AS `phone2`,`ep`.`phone3` AS `phone3`,`ep`.`email01` AS `email01`,`ep`.`email02` AS `email02`,`ep`.`description` AS `description`,`ep`.`status` AS `status`,`ep`.`status_desc` AS `status_desc`,`ep`.`id_functional` AS `id_functional`,`ep`.`id_structural` AS `id_structural`,`ep`.`struct_bidang` AS `struct_bidang`,`ep`.`struct_seksi` AS `struct_seksi`,`ep`.`id_harbour_master` AS `id_harbour_master`,`ep`.`id_grade` AS `id_grade`,`ep`.`created_date` AS `created_date`,`ep`.`created_by` AS `created_by`,`ep`.`updated_date` AS `updated_date`,`ep`.`updated_by` AS `updated_by`,concat(`ea`.`jalan`,' ',`ea`.`kelurahan`,' ',`ea`.`kecamatan`,' ',`ea`.`kabupaten`,' ',`ea`.`provinsi`,' ') AS `address`,`ea`.`provinsi` AS `provinsi`,`ea`.`kodepos` AS `kodepos`,`ft`.`name` AS `functional_name`,`ft`.`description` AS `functional_description`,`ft`.`level` AS `functional_level`,`st`.`name` AS `structural_name`,`st`.`description` AS `structural_description`,`st`.`level` AS `structural_level`,`hm`.`name` AS `harbour_master_name`,`hm`.`description` AS `harbour_master_description`,`hm`.`id_harbour_area` AS `id_harbour_area`,`ha`.`name` AS `harbour_area_name`,`ha`.`description` AS `harbour_area_description`,`eg`.`name` AS `emp_grade_name`,`eg`.`description` AS `emp_grade_description`,`vet`.`jenis_mi` AS `jenis_mi` from (((((((`employee_profile` `ep` left join `emp_addresses` `ea` on(((`ep`.`id` = `ea`.`id_emp`) and (`ea`.`is_current` = 1)))) left join `functional_title` `ft` on((`ep`.`id_functional` = `ft`.`id`))) left join `structural_title` `st` on((`ep`.`id_structural` = `st`.`id`))) left join `harbour_master` `hm` on((`ep`.`id_harbour_master` = `hm`.`id`))) left join `harbour_area` `ha` on((`hm`.`id_harbour_area` = `ha`.`id`))) left join `emp_grade` `eg` on((`ep`.`id_grade` = `eg`.`id`))) left join `vw_emp_type_training_flatten` `vet` on((`ep`.`id` = `vet`.`id_employee_profile`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_emp_education`
--
DROP TABLE IF EXISTS `vw_emp_education`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_emp_education`  AS  select `ed`.`id` AS `id`,`ed`.`id_university` AS `id_university`,`ed`.`id_faculty` AS `id_faculty`,`ed`.`id_major` AS `id_major`,`ed`.`id_education_level` AS `id_education_level`,`ed`.`id_emp` AS `id_emp`,`ed`.`graduate_year` AS `graduate_year`,`ed`.`graduate_date` AS `graduate_date`,`ed`.`location` AS `location`,`ed`.`professor` AS `professor`,`ed`.`id_certificate_file` AS `id_certificate_file`,`ed`.`description` AS `description`,`ed`.`status` AS `status`,`ed`.`created_date` AS `created_date`,`ed`.`created_by` AS `created_by`,`ed`.`updated_date` AS `updated_date`,`ed`.`updated_by` AS `updated_by`,`u`.`name` AS `university_name`,`f`.`name` AS `faculty_name`,`m`.`name` AS `major_name`,`el`.`name` AS `education_level` from ((((`emp_education` `ed` left join `university` `u` on((`ed`.`id_university` = `u`.`id`))) left join `faculty` `f` on((`ed`.`id_faculty` = `f`.`id`))) left join `major` `m` on((`ed`.`id_major` = `m`.`id`))) left join `education_level` `el` on((`ed`.`id_education_level` = `el`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_emp_profile_education`
--
DROP TABLE IF EXISTS `vw_emp_profile_education`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_emp_profile_education`  AS  select `ep`.`id` AS `id`,`ep`.`nip` AS `nip`,`ep`.`name` AS `name`,`ep`.`birth_place` AS `birth_place`,`ep`.`birth_date` AS `birth_date`,`ep`.`religion` AS `religion`,`ep`.`sex` AS `sex`,`ep`.`npwp` AS `npwp`,`ep`.`marital_status` AS `marital_status`,`ep`.`hobby` AS `hobby`,`ep`.`id_photo` AS `id_photo`,`ep`.`phone1` AS `phone1`,`ep`.`phone2` AS `phone2`,`ep`.`phone3` AS `phone3`,`ep`.`email01` AS `email01`,`ep`.`email02` AS `email02`,`ep`.`description` AS `description`,`ep`.`status` AS `status`,`ep`.`status_desc` AS `status_desc`,`ep`.`id_functional` AS `id_functional`,`ep`.`id_structural` AS `id_structural`,`ep`.`struct_bidang` AS `struct_bidang`,`ep`.`struct_seksi` AS `struct_seksi`,`ep`.`id_harbour_master` AS `id_harbour_master`,`ep`.`id_grade` AS `id_grade`,`ep`.`created_date` AS `created_date`,`ep`.`created_by` AS `created_by`,`ep`.`updated_date` AS `updated_date`,`ep`.`updated_by` AS `updated_by`,`ep`.`address` AS `address`,`ep`.`provinsi` AS `provinsi`,`ep`.`kodepos` AS `kodepos`,`ep`.`functional_name` AS `functional_name`,`ep`.`functional_description` AS `functional_description`,`ep`.`functional_level` AS `functional_level`,`ep`.`structural_name` AS `structural_name`,`ep`.`structural_description` AS `structural_description`,`ep`.`structural_level` AS `structural_level`,`ep`.`harbour_master_name` AS `harbour_master_name`,`ep`.`harbour_master_description` AS `harbour_master_description`,`ep`.`id_harbour_area` AS `id_harbour_area`,`ep`.`harbour_area_name` AS `harbour_area_name`,`ep`.`harbour_area_description` AS `harbour_area_description`,`ep`.`emp_grade_name` AS `emp_grade_name`,`ep`.`emp_grade_description` AS `emp_grade_description`,`ed`.`university_name` AS `university_name`,`ed`.`faculty_name` AS `faculty_name`,`ed`.`major_name` AS `major_name`,`ed`.`education_level` AS `education_level`,`ed`.`graduate_date` AS `graduate_date`,`ed`.`graduate_year` AS `graduate_year`,`ed`.`id_university` AS `id_university`,`ed`.`id_faculty` AS `id_faculty`,`ed`.`id_major` AS `id_major`,`ed`.`id_education_level` AS `id_education_level` from (`vw_employee_profile` `ep` left join `vw_emp_education` `ed` on((`ep`.`id` = `ed`.`id_emp`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_emp_profile_training`
--
DROP TABLE IF EXISTS `vw_emp_profile_training`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_emp_profile_training`  AS  select `ep`.`id` AS `id`,`ep`.`nip` AS `nip`,`ep`.`name` AS `name`,`ep`.`birth_place` AS `birth_place`,`ep`.`birth_date` AS `birth_date`,`ep`.`religion` AS `religion`,`ep`.`sex` AS `sex`,`ep`.`npwp` AS `npwp`,`ep`.`marital_status` AS `marital_status`,`ep`.`hobby` AS `hobby`,`ep`.`id_photo` AS `id_photo`,`ep`.`phone1` AS `phone1`,`ep`.`phone2` AS `phone2`,`ep`.`phone3` AS `phone3`,`ep`.`email01` AS `email01`,`ep`.`email02` AS `email02`,`ep`.`description` AS `description`,`ep`.`status` AS `status`,`ep`.`status_desc` AS `status_desc`,`ep`.`id_functional` AS `id_functional`,`ep`.`id_structural` AS `id_structural`,`ep`.`struct_bidang` AS `struct_bidang`,`ep`.`struct_seksi` AS `struct_seksi`,`ep`.`id_harbour_master` AS `id_harbour_master`,`ep`.`id_grade` AS `id_grade`,`ep`.`created_date` AS `created_date`,`ep`.`created_by` AS `created_by`,`ep`.`updated_date` AS `updated_date`,`ep`.`updated_by` AS `updated_by`,`ep`.`address` AS `address`,`ep`.`provinsi` AS `provinsi`,`ep`.`kodepos` AS `kodepos`,`ep`.`functional_name` AS `functional_name`,`ep`.`functional_description` AS `functional_description`,`ep`.`functional_level` AS `functional_level`,`ep`.`structural_name` AS `structural_name`,`ep`.`structural_description` AS `structural_description`,`ep`.`structural_level` AS `structural_level`,`ep`.`harbour_master_name` AS `harbour_master_name`,`ep`.`harbour_master_description` AS `harbour_master_description`,`ep`.`id_harbour_area` AS `id_harbour_area`,`ep`.`harbour_area_name` AS `harbour_area_name`,`ep`.`harbour_area_description` AS `harbour_area_description`,`ep`.`emp_grade_name` AS `emp_grade_name`,`ep`.`emp_grade_description` AS `emp_grade_description`,`et`.`date_taken_from` AS `date_taken_from`,`et`.`date_taken_to` AS `date_taken_to`,`et`.`graduate_date` AS `graduate_date`,`et`.`graduate_year` AS `graduate_year`,`et`.`certificate_no` AS `certificate_no`,`et`.`mi_card` AS `mi_card`,`et`.`mi_date` AS `mi_date`,`et`.`description` AS `training_description`,`et`.`refreshment` AS `refreshment`,`et`.`status` AS `training_status`,`et`.`training_type_name` AS `training_type_name` from (`vw_employee_profile` `ep` left join `vw_emp_training` `et` on((`ep`.`id` = `et`.`id_employee_profile`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_emp_training`
--
DROP TABLE IF EXISTS `vw_emp_training`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_emp_training`  AS  select `et`.`id` AS `id`,`et`.`id_employee_profile` AS `id_employee_profile`,`et`.`id_training` AS `id_training`,`et`.`training_title` AS `training_title`,`et`.`date_taken_from` AS `date_taken_from`,`et`.`date_taken_to` AS `date_taken_to`,`et`.`graduate_date` AS `graduate_date`,`et`.`graduate_year` AS `graduate_year`,`et`.`certificate_no` AS `certificate_no`,`et`.`mi_card` AS `mi_card`,`et`.`mi_date` AS `mi_date`,`et`.`id_certificate_file` AS `id_certificate_file`,`et`.`id_mi_card_file` AS `id_mi_card_file`,`et`.`location` AS `location`,`et`.`description` AS `description`,`et`.`refreshment` AS `refreshment`,`et`.`status` AS `status`,`et`.`created_date` AS `created_date`,`et`.`created_by` AS `created_by`,`et`.`updated_date` AS `updated_date`,`et`.`updated_by` AS `updated_by`,`tt`.`name` AS `training_type_name` from (`emp_training` `et` join `training_type` `tt` on((`et`.`id_training` = `tt`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_emp_type_training_flatten`
--
DROP TABLE IF EXISTS `vw_emp_type_training_flatten`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_emp_type_training_flatten`  AS  select `et`.`id_employee_profile` AS `id_employee_profile`,group_concat((case when (`et`.`id_training` = 1) then 'A' when (`et`.`id_training` = 2) then 'B' when (`et`.`id_training` = 3) then 'R' else '-' end) separator ', ') AS `jenis_mi` from (`emp_training` `et` join `training_type` `tt` on((`et`.`id_training` = `tt`.`id`))) group by `et`.`id_employee_profile` order by group_concat((case when (`et`.`id_training` = 1) then 'A' when (`et`.`id_training` = 2) then 'B' when (`et`.`id_training` = 3) then 'R' else '-' end) separator ', ') ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_faculty`
--
DROP TABLE IF EXISTS `vw_faculty`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_faculty`  AS  select `f`.`id` AS `id`,`f`.`id_university` AS `id_university`,`f`.`name` AS `name`,`f`.`description` AS `description`,`f`.`status` AS `status`,`f`.`created_date` AS `created_date`,`f`.`created_by` AS `created_by`,`f`.`updated_date` AS `updated_date`,`f`.`updated_by` AS `updated_by`,`u`.`name` AS `university_name` from (`faculty` `f` join `university` `u` on((`f`.`id_university` = `u`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_harbour_head`
--
DROP TABLE IF EXISTS `vw_harbour_head`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_harbour_head`  AS  select `hh`.`id` AS `id`,`hh`.`id_harbour` AS `id_harbour`,`hh`.`id_emp` AS `id_emp`,`hh`.`created_date` AS `created_date`,`hh`.`created_by` AS `created_by`,`hh`.`updated_date` AS `updated_date`,`hh`.`updated_by` AS `updated_by`,`hm`.`name` AS `harbour_master_name`,`hm`.`address01` AS `harbour_master_address`,`ep`.`nip` AS `employee_nip`,`ep`.`name` AS `employee_name`,`ep`.`sex` AS `employee_sex` from ((`harbour_head` `hh` join `harbour_master` `hm` on((`hh`.`id_harbour` = `hm`.`id`))) join `employee_profile` `ep` on((`hh`.`id_emp` = `ep`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_harbour_master`
--
DROP TABLE IF EXISTS `vw_harbour_master`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_harbour_master`  AS  select `hm`.`id` AS `id`,`hm`.`id_harbour_area` AS `id_harbour_area`,`hm`.`name` AS `name`,`hm`.`description` AS `description`,`hm`.`id_grade` AS `id_grade`,`hm`.`phone1` AS `phone1`,`hm`.`phone2` AS `phone2`,`hm`.`phone3` AS `phone3`,`hm`.`address01` AS `address01`,`hm`.`address02` AS `address02`,`hm`.`address03` AS `address03`,`hm`.`city` AS `city`,`hm`.`zipcode` AS `zipcode`,`hm`.`email` AS `email`,`hm`.`web_address` AS `web_address`,`hm`.`status` AS `status`,`hm`.`created_date` AS `created_date`,`hm`.`created_by` AS `created_by`,`hm`.`updated_date` AS `updated_date`,`hm`.`updated_by` AS `updated_by`,`ha`.`name` AS `harbour_area_name` from (`harbour_master` `hm` join `harbour_area` `ha` on((`hm`.`id_harbour_area` = `ha`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_mapping_role_module`
--
DROP TABLE IF EXISTS `vw_mapping_role_module`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_mapping_role_module`  AS  select `mrm`.`id` AS `id`,`mrm`.`id_role` AS `id_role`,`mrm`.`id_module` AS `id_module`,`mrm`.`is_granted_to_view` AS `is_granted_to_view`,`mrm`.`is_granted_to_add` AS `is_granted_to_add`,`mrm`.`is_granted_to_edit` AS `is_granted_to_edit`,`mrm`.`is_granted_to_delete` AS `is_granted_to_delete`,`mrm`.`is_granted_to_download` AS `is_granted_to_download`,`mrm`.`created_date` AS `created_date`,`mrm`.`created_by` AS `created_by`,`mrm`.`updated_date` AS `updated_date`,`mrm`.`updated_by` AS `updated_by`,`r`.`name` AS `role_name`,`r`.`is_admin` AS `is_admin`,`m`.`name` AS `module_name`,`m`.`url` AS `module_url` from ((`mapping_role_module` `mrm` join `role` `r` on((`mrm`.`id_role` = `r`.`id`))) join `module` `m` on((`mrm`.`id_module` = `m`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_mapping_user_role`
--
DROP TABLE IF EXISTS `vw_mapping_user_role`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_mapping_user_role`  AS  select `mur`.`id` AS `id`,`mur`.`id_user` AS `id_user`,`mur`.`id_role` AS `id_role`,`mur`.`created_date` AS `created_date`,`mur`.`created_by` AS `created_by`,`mur`.`updated_date` AS `updated_date`,`mur`.`updated_by` AS `updated_by`,`u`.`username` AS `username`,`r`.`name` AS `role_name`,`r`.`is_admin` AS `is_admin` from ((`mapping_user_role` `mur` join `user` `u` on((`mur`.`id_user` = `u`.`id`))) join `role` `r` on((`mur`.`id_role` = `r`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_repo_document`
--
DROP TABLE IF EXISTS `vw_repo_document`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_repo_document`  AS  select `d`.`id` AS `id`,`d`.`id_emp` AS `id_emp`,`d`.`id_file` AS `id_file`,`d`.`id_version` AS `id_version`,`d`.`id_dir` AS `id_dir`,`d`.`id_doc_type` AS `id_doc_type`,`d`.`title` AS `title`,`d`.`description` AS `description`,`d`.`date_upload` AS `date_upload`,`d`.`status` AS `status`,`d`.`created_date` AS `created_date`,`d`.`created_by` AS `created_by`,`d`.`updated_date` AS `updated_date`,`d`.`updated_by` AS `updated_by`,`e`.`nip` AS `nip`,`e`.`name` AS `name`,`dt`.`name` AS `doc_type_name`,`dt`.`description` AS `doc_type_description` from ((`repo_document` `d` left join `employee_profile` `e` on((`d`.`id_emp` = `e`.`id`))) left join `doc_type` `dt` on((`d`.`id_doc_type` = `dt`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `vw_user`
--
DROP TABLE IF EXISTS `vw_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_user`  AS  select `u`.`id` AS `id`,`u`.`username` AS `username`,`u`.`password` AS `password`,`u`.`email` AS `email`,`u`.`last_login` AS `last_login`,`u`.`ip_address` AS `ip_address`,`u`.`remember_token` AS `remember_token`,`u`.`id_employee` AS `id_employee`,`u`.`id_role` AS `id_role`,`u`.`is_active` AS `is_active`,`u`.`created_date` AS `created_date`,`u`.`created_by` AS `created_by`,`u`.`updated_date` AS `updated_date`,`u`.`updated_by` AS `updated_by`,`r`.`name` AS `role_name`,`r`.`is_admin` AS `is_admin`,`ep`.`nip` AS `employee_nip`,`ep`.`name` AS `employee_name`,`ep`.`sex` AS `employee_sex`,`ep`.`email01` AS `employee_email` from ((`user` `u` join `role` `r` on((`u`.`id_role` = `r`.`id`))) left join `employee_profile` `ep` on((`u`.`id_employee` = `ep`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate_task_shipping`
--
ALTER TABLE `certificate_task_shipping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code_notification`
--
ALTER TABLE `code_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `directory_document`
--
ALTER TABLE `directory_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directory_parent_dir_idx` (`parent_id`);

--
-- Indexes for table `directory_repo_document`
--
ALTER TABLE `directory_repo_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directory_repo_parent_dir_idx` (`parent_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_emp_idx` (`id_emp`),
  ADD KEY `document_dir_idx` (`id_dir`),
  ADD KEY `document_file_idx` (`id_file`);

--
-- Indexes for table `doc_file`
--
ALTER TABLE `doc_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doc_type`
--
ALTER TABLE `doc_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `education_level`
--
ALTER TABLE `education_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_photo`
--
ALTER TABLE `employee_photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_profile`
--
ALTER TABLE `employee_profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_profile_emp_photo_idx` (`id_photo`),
  ADD KEY `employee_profile_functional_idx` (`id_functional`),
  ADD KEY `employee_profile_structural_idx` (`id_structural`),
  ADD KEY `employee_profile_harbour_master_idx` (`id_harbour_master`),
  ADD KEY `employee_profile_grade_idx` (`id_grade`);

--
-- Indexes for table `emp_addresses`
--
ALTER TABLE `emp_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_address_employee_idx` (`id_emp`);

--
-- Indexes for table `emp_basic_education`
--
ALTER TABLE `emp_basic_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_basic_education_employee_idx` (`id_emp`);

--
-- Indexes for table `emp_education`
--
ALTER TABLE `emp_education`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_education_university_idx` (`id_university`),
  ADD KEY `emp_education_major_idx` (`id_major`),
  ADD KEY `emp_education_faculty_idx` (`id_faculty`),
  ADD KEY `emp_education_emp_profile_idx` (`id_emp`),
  ADD KEY `emp_education_certification_idx` (`id_certificate_file`),
  ADD KEY `emp_education_level_idx` (`id_education_level`);

--
-- Indexes for table `emp_email`
--
ALTER TABLE `emp_email`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_employee_profile_idx` (`id_emp`);

--
-- Indexes for table `emp_experience`
--
ALTER TABLE `emp_experience`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_experience_employee_idx` (`id_emp`);

--
-- Indexes for table `emp_grade`
--
ALTER TABLE `emp_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_physical_appearance`
--
ALTER TABLE `emp_physical_appearance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_physical_appearance_employee_profile_idx` (`id_emp`);

--
-- Indexes for table `emp_training`
--
ALTER TABLE `emp_training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_training_emp_profile_idx` (`id_employee_profile`),
  ADD KEY `emp_training_idx` (`id_training`),
  ADD KEY `emp_training_mi_card_file_idx` (`id_mi_card_file`),
  ADD KEY `emp_training_certificate_file_idx` (`id_certificate_file`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faculty_university_idx` (`id_university`);

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_threads`
--
ALTER TABLE `forum_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `functional_title`
--
ALTER TABLE `functional_title`
  ADD PRIMARY KEY (`id`),
  ADD KEY `functional_title_upper_functional_idx` (`upper_id`);

--
-- Indexes for table `harbour_area`
--
ALTER TABLE `harbour_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harbour_grade`
--
ALTER TABLE `harbour_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harbour_head`
--
ALTER TABLE `harbour_head`
  ADD PRIMARY KEY (`id`),
  ADD KEY `harbour_head_master_idx` (`id_harbour`),
  ADD KEY `harbour_head_emp_profile_idx` (`id_emp`);

--
-- Indexes for table `harbour_master`
--
ALTER TABLE `harbour_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `harbour_master_harbour_area_idx` (`id_harbour_area`);

--
-- Indexes for table `major`
--
ALTER TABLE `major`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mapping_map_harbour_master`
--
ALTER TABLE `mapping_map_harbour_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapping_map_harbour_master_idx` (`id_harbour_master`);

--
-- Indexes for table `mapping_role_module`
--
ALTER TABLE `mapping_role_module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapping_role_module_role_idx` (`id_role`),
  ADD KEY `mapping_role_module_module_idx` (`id_module`);

--
-- Indexes for table `mapping_user_role`
--
ALTER TABLE `mapping_user_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mapping_user_role_idx` (`id_user`),
  ADD KEY `mapping_user_role_role_idx` (`id_role`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_thread_idx` (`thread_id`),
  ADD KEY `messages_user_idx` (`user_id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participants_thread_idx` (`thread_id`),
  ADD KEY `participants_user_idx` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `repo_document`
--
ALTER TABLE `repo_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repo_document_emp_idx` (`id_emp`),
  ADD KEY `repo_document_file_idx` (`id_file`),
  ADD KEY `repo_document_directory_idx` (`id_dir`),
  ADD KEY `repo_document_doc_type_idx` (`id_doc_type`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_company`
--
ALTER TABLE `shipping_company`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_company_parent_idx` (`upper_id`);

--
-- Indexes for table `shipping_task`
--
ALTER TABLE `shipping_task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipping_task_shipping_company_idx` (`id_shipping_company`),
  ADD KEY `shipping_task_vessel_idx` (`id_vessel`),
  ADD KEY `shipping_task_employee_profile_idx` (`id_employee_profile`),
  ADD KEY `shipping_task_harbour_master_idx` (`id_harbour_master`),
  ADD KEY `shipping_task_certificate_idx` (`id_certificate`),
  ADD KEY `shipping_task_doc_file_idx` (`id_certificate_file`);

--
-- Indexes for table `status_notification`
--
ALTER TABLE `status_notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status_notification_user_idx` (`id_user`);

--
-- Indexes for table `structural_title`
--
ALTER TABLE `structural_title`
  ADD PRIMARY KEY (`id`),
  ADD KEY `structural_upper_structural_idx` (`upper_id`);

--
-- Indexes for table `threads`
--
ALTER TABLE `threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_type`
--
ALTER TABLE `training_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `university`
--
ALTER TABLE `university`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_employee_profile_idx` (`id_employee`),
  ADD KEY `user_role_idx` (`id_role`);

--
-- Indexes for table `vessel`
--
ALTER TABLE `vessel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vessel_shipping_company_idx` (`id_shipping_company`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate_task_shipping`
--
ALTER TABLE `certificate_task_shipping`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `code_notification`
--
ALTER TABLE `code_notification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `directory_document`
--
ALTER TABLE `directory_document`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `directory_repo_document`
--
ALTER TABLE `directory_repo_document`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `doc_file`
--
ALTER TABLE `doc_file`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `doc_type`
--
ALTER TABLE `doc_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `education_level`
--
ALTER TABLE `education_level`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `employee_photo`
--
ALTER TABLE `employee_photo`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee_profile`
--
ALTER TABLE `employee_profile`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1082;
--
-- AUTO_INCREMENT for table `emp_addresses`
--
ALTER TABLE `emp_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `emp_basic_education`
--
ALTER TABLE `emp_basic_education`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emp_education`
--
ALTER TABLE `emp_education`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `emp_email`
--
ALTER TABLE `emp_email`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emp_experience`
--
ALTER TABLE `emp_experience`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `emp_grade`
--
ALTER TABLE `emp_grade`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `emp_physical_appearance`
--
ALTER TABLE `emp_physical_appearance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `emp_training`
--
ALTER TABLE `emp_training`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_threads`
--
ALTER TABLE `forum_threads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `functional_title`
--
ALTER TABLE `functional_title`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `harbour_area`
--
ALTER TABLE `harbour_area`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `harbour_grade`
--
ALTER TABLE `harbour_grade`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `harbour_head`
--
ALTER TABLE `harbour_head`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `harbour_master`
--
ALTER TABLE `harbour_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;
--
-- AUTO_INCREMENT for table `major`
--
ALTER TABLE `major`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `mapping_map_harbour_master`
--
ALTER TABLE `mapping_map_harbour_master`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;
--
-- AUTO_INCREMENT for table `mapping_role_module`
--
ALTER TABLE `mapping_role_module`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mapping_user_role`
--
ALTER TABLE `mapping_user_role`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;
--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `repo_document`
--
ALTER TABLE `repo_document`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `shipping_company`
--
ALTER TABLE `shipping_company`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `shipping_task`
--
ALTER TABLE `shipping_task`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `status_notification`
--
ALTER TABLE `status_notification`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `structural_title`
--
ALTER TABLE `structural_title`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `threads`
--
ALTER TABLE `threads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `training_type`
--
ALTER TABLE `training_type`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `university`
--
ALTER TABLE `university`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `vessel`
--
ALTER TABLE `vessel`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `directory_document`
--
ALTER TABLE `directory_document`
  ADD CONSTRAINT `directory_parent_dir` FOREIGN KEY (`parent_id`) REFERENCES `directory_document` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `directory_repo_document`
--
ALTER TABLE `directory_repo_document`
  ADD CONSTRAINT `directory_repo_parent_dir` FOREIGN KEY (`parent_id`) REFERENCES `directory_repo_document` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `document_dir` FOREIGN KEY (`id_dir`) REFERENCES `directory_document` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `document_emp` FOREIGN KEY (`id_emp`) REFERENCES `employee_profile` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `document_file` FOREIGN KEY (`id_file`) REFERENCES `doc_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `employee_profile`
--
ALTER TABLE `employee_profile`
  ADD CONSTRAINT `employee_profile_emp_photo` FOREIGN KEY (`id_photo`) REFERENCES `employee_photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_profile_functional` FOREIGN KEY (`id_functional`) REFERENCES `functional_title` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_profile_grade` FOREIGN KEY (`id_grade`) REFERENCES `emp_grade` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_profile_harbour_master` FOREIGN KEY (`id_harbour_master`) REFERENCES `harbour_master` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `employee_profile_structural` FOREIGN KEY (`id_structural`) REFERENCES `structural_title` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `emp_addresses`
--
ALTER TABLE `emp_addresses`
  ADD CONSTRAINT `emp_address_employee` FOREIGN KEY (`id_emp`) REFERENCES `employee_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `emp_basic_education`
--
ALTER TABLE `emp_basic_education`
  ADD CONSTRAINT `emp_basic_education_employee` FOREIGN KEY (`id_emp`) REFERENCES `employee_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `emp_education`
--
ALTER TABLE `emp_education`
  ADD CONSTRAINT `emp_education_certification` FOREIGN KEY (`id_certificate_file`) REFERENCES `doc_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_education_emp_profile` FOREIGN KEY (`id_emp`) REFERENCES `employee_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_education_faculty` FOREIGN KEY (`id_faculty`) REFERENCES `faculty` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_education_level` FOREIGN KEY (`id_education_level`) REFERENCES `education_level` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_education_major` FOREIGN KEY (`id_major`) REFERENCES `major` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_education_university` FOREIGN KEY (`id_university`) REFERENCES `university` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `emp_email`
--
ALTER TABLE `emp_email`
  ADD CONSTRAINT `email_employee_profile` FOREIGN KEY (`id_emp`) REFERENCES `employee_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `emp_experience`
--
ALTER TABLE `emp_experience`
  ADD CONSTRAINT `emp_experience_employee` FOREIGN KEY (`id_emp`) REFERENCES `employee_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `emp_physical_appearance`
--
ALTER TABLE `emp_physical_appearance`
  ADD CONSTRAINT `emp_physical_appearance_employee_profile` FOREIGN KEY (`id_emp`) REFERENCES `employee_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `emp_training`
--
ALTER TABLE `emp_training`
  ADD CONSTRAINT `emp_training_certificate_file` FOREIGN KEY (`id_certificate_file`) REFERENCES `doc_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_training_emp_profile` FOREIGN KEY (`id_employee_profile`) REFERENCES `employee_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_training_mi_card_file` FOREIGN KEY (`id_mi_card_file`) REFERENCES `doc_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emp_training_training_type` FOREIGN KEY (`id_training`) REFERENCES `training_type` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_university` FOREIGN KEY (`id_university`) REFERENCES `university` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `functional_title`
--
ALTER TABLE `functional_title`
  ADD CONSTRAINT `functional_title_upper_functional` FOREIGN KEY (`upper_id`) REFERENCES `functional_title` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `harbour_head`
--
ALTER TABLE `harbour_head`
  ADD CONSTRAINT `harbour_head_emp_profile` FOREIGN KEY (`id_emp`) REFERENCES `employee_profile` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `harbour_head_master` FOREIGN KEY (`id_harbour`) REFERENCES `harbour_master` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `harbour_master`
--
ALTER TABLE `harbour_master`
  ADD CONSTRAINT `harbour_master_harbour_area` FOREIGN KEY (`id_harbour_area`) REFERENCES `harbour_area` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mapping_map_harbour_master`
--
ALTER TABLE `mapping_map_harbour_master`
  ADD CONSTRAINT `mapping_map_harbour_master` FOREIGN KEY (`id_harbour_master`) REFERENCES `harbour_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mapping_role_module`
--
ALTER TABLE `mapping_role_module`
  ADD CONSTRAINT `mapping_role_module_module` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `mapping_role_module_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mapping_user_role`
--
ALTER TABLE `mapping_user_role`
  ADD CONSTRAINT `mapping_user_role_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `mapping_user_role_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_thread` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `participants`
--
ALTER TABLE `participants`
  ADD CONSTRAINT `participants_thread` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `participants_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `repo_document`
--
ALTER TABLE `repo_document`
  ADD CONSTRAINT `repo_document_directory` FOREIGN KEY (`id_dir`) REFERENCES `directory_repo_document` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `repo_document_doc_type` FOREIGN KEY (`id_doc_type`) REFERENCES `doc_type` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `repo_document_emp` FOREIGN KEY (`id_emp`) REFERENCES `employee_profile` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `repo_document_file` FOREIGN KEY (`id_file`) REFERENCES `doc_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `shipping_company`
--
ALTER TABLE `shipping_company`
  ADD CONSTRAINT `shipping_company_parent` FOREIGN KEY (`upper_id`) REFERENCES `shipping_company` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `shipping_task`
--
ALTER TABLE `shipping_task`
  ADD CONSTRAINT `shipping_task_certificate` FOREIGN KEY (`id_certificate`) REFERENCES `certificate_task_shipping` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_task_doc_file` FOREIGN KEY (`id_certificate_file`) REFERENCES `doc_file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_task_employee_profile` FOREIGN KEY (`id_employee_profile`) REFERENCES `employee_profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_task_harbour_master` FOREIGN KEY (`id_harbour_master`) REFERENCES `harbour_master` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_task_shipping_company` FOREIGN KEY (`id_shipping_company`) REFERENCES `shipping_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shipping_task_vessel` FOREIGN KEY (`id_vessel`) REFERENCES `vessel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `status_notification`
--
ALTER TABLE `status_notification`
  ADD CONSTRAINT `status_notification_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `structural_title`
--
ALTER TABLE `structural_title`
  ADD CONSTRAINT `structural_upper_structural` FOREIGN KEY (`upper_id`) REFERENCES `structural_title` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_employee_profile` FOREIGN KEY (`id_employee`) REFERENCES `employee_profile` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `vessel`
--
ALTER TABLE `vessel`
  ADD CONSTRAINT `vessel_shipping_company` FOREIGN KEY (`id_shipping_company`) REFERENCES `shipping_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
